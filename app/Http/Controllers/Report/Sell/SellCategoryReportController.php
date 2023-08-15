<?php

namespace App\Http\Controllers\Report\Sell;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SellCategoryReportController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'MARKETING_MANAGER', 'BUSINESS_ACTIVE_REPORT', 'SALE_REPORT', 'CASHIER_ACCESS', 'CHEF_COOK_ACCESS', 'BAR_ACCESS']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(0);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Báo Cáo Danh mục Món Ăn';
        return view('report.sell.category.index', compact('active_nav'));
    }

    public function dataCategoryRevenue(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from_date');
        $category_type = $request->get('category_type');
        $to = $request->get('to_date');
        $category_id = (int)$request->get('category');
        $category_type = $request->get('category_type');
        $select_sort = $request->get('selectSort');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_CATEGORY_FOOD, $brand, $branch, $type, $time, $from, $to, $category_id, $category_type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_chart = [];
            $data_chart_old = [];
            $collection = collect($config['data']['list']);
            switch ($select_sort) {
                case 1:
                    $data = $collection->SortByDesc('total_original_amount');
                    break;
                case 2:
                    $data = $collection->SortByDesc('total_profit');
                    break;
                case 3:
                    $data = $collection->SortByDesc('profit_ratio');
                    break;
                default:
                    $data = $collection->SortByDesc('total_amount');
                    break;
            }
            $i = 0;
            foreach ($data as $data_mix) {
                $data_chart[$i] = array(
                    "timeline" => $data_mix['category_name'],
                    "valueTotal" => $data_mix['total_amount'],
                    "valueOriginalTotal" => $data_mix['total_original_amount'],
                    "valueProfit" => $data_mix['profit'],
                    "valueProfitRatio" => $data_mix['profit_ratio']);
                $i++;
            }

            $data_chart_ratio = [
                "timeline" => collect($data)->pluck('category_name'),
                'value' => collect($data)->pluck('profit_ratio'),
            ];
            $detail = TEXT_DETAIL;
            $dataTable = DataTables::of($data)
                ->addColumn('category_name', function ($row) {
                    return (mb_strlen($row['category_name']) > 30) ? mb_substr($row['category_name'], 0, 27) . '...' : $row['category_name'];
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('total_original_amount', function ($row) {
                    return $this->numberFormat($row['total_original_amount']);
                })
                ->addColumn('total_profit', function ($row) {
                    return $this->numberFormat($row['profit']);
                })
                ->addColumn('profit_ratio', function ($row) {
                    return $this->numberFormat($row['profit_ratio']);
                })
                ->addColumn('action', function ($row) use ($detail, $brand, $branch, $type, $time, $from, $to) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-name="' . $row['category_name'] . '" data-brand="' . $brand . '" data-branch="' . $branch . '" data-type="' . $type . '" data-time="' . $time . '" data-id="' . $row['category_id'] . '" data-from="' . $from . '" data-to="' . $to . '" onclick="openDetailCategorySellReport($(this))" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'total_profit'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total' => $this->numberFormat($config['data']['total_amount']),
                'sum_total_original' => $this->numberFormat($config['data']['total_original_amount']),
                'sum_profit' => $this->numberFormat($config['data']['total_profit']),
            ];
            $dataTotalChart = [
                'Doanh thu' => $this->numberFormat($config['data']['total_amount']),
                'Giá vốn' => $this->numberFormat($config['data']['total_original_amount']),
                'Lợi nhuận' => $this->numberFormat($config['data']['total_profit']),
            ];
            return [$data_chart, $dataTable, $dataTotal, $config, $data_chart_old, $dataTotalChart, $data_chart_ratio];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataFoodCategory(Request $request)
    {
        $restaurant_brand_id = $request->get('brand');
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_CATEGORY_MANAGE, $restaurant_brand_id, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $select_category = '';
            if (count($data) === 0) {
                $select_category = '<option value="-1"selected>' . TEXT_NULL_OPTION . '</option>';
            } else {
                $select_category .= '<option value="-1" data-category-type="-1"  selected>Danh mục</option>';
                foreach ($data as $db) {
                    $select_category .= '<option value="' . $db['id'] . '" data-category-type="' . $db['category_type'] . '">' . $db['name'] . '</option>';
                }
            }
            return [$select_category, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detailCategoryRevenue(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $categoryID = $request->get('category');
        $category = '';
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $isGift = ENUM_DIS_SELECTED;
        $isCombo = ENUM_GET_ALL;
        $isCancel = ENUM_DIS_SELECTED;
        $isTakeAway = ENUM_GET_ALL;
        $isGoods = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_PROFIT_FOOD, $brand, $branch, $category,
            $categoryID, $type, $time, $from , $to, $isGift, $isCombo, $isCancel, $isTakeAway, $isGoods);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $dataTable = DataTables::of($data)
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('total_original_amount', function ($row) {
                    return $this->numberFormat($row['total_original_amount']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('total_profit', function ($row) {
                    return $this->numberFormat($row['total_profit']);
                })
                ->addColumn('profit_ratio', function ($row) {
                    return $this->numberFormat($row['profit_ratio']) . '%';
                })
                ->addColumn('avatar', function ($row) use ($domain) {
//                    if(mb_strlen($row['food_name']) > 30){
//                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
//                         <label class="name-inline-data-table">' . mb_substr($row['food_name'], 0, 27)  . '...' . '<br>
//                         <div class="tag seemt-blue seemt-bg-blue d-flex mr-2" style="width: max-content;">
//                                <i class="fi-rr-hastag"></i>
//                                <label class="m-0">'.$row['unit_name'].'</label>
//                            </div>';
//                    } else {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . $row['food_name'] . '<br>
                         <div class="tag seemt-blue seemt-bg-blue d-flex mr-2" style="width: max-content;">
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">'.$row['unit_name'].'</label>
                            </div>';
                })
                ->rawColumns(['avatar', 'profit_ratio'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'sum_total_original' => $this->numberFormat($config['data']['total_original_amount']),
                'sum_total' => $this->numberFormat($config['data']['total_amount']),
                'sum_profit' => $this->numberFormat($config['data']['total_profit_amount']),
                'sum_rate_profit' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'profit_ratio'))),
            ];
            return $data_response = [$dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
