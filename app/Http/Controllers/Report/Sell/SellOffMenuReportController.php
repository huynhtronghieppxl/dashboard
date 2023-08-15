<?php

namespace App\Http\Controllers\Report\Sell;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SellOffMenuReportController extends Controller
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
        $active_nav = 'Báo cáo ngoài menu';
        return view('report.sell.off_menu_dishes.index', compact('active_nav'));
    }

    public function dataOffMenuReport(Request $request)
    {
        $restaurant_brand_id = $request->get('brand');
        $branch_id = $request->get('branch');
        $category_types = ENUM_SELECTED;
        $category_id = ENUM_GET_ALL;
        $food_id = ENUM_DIS_SELECTED;
        $report_type = $request->get('type');
        $date_string = $request->get('time');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $is_gift = ENUM_DIS_SELECTED;
        $is_combo = ENUM_GET_ALL;
        $type_sort = $request->get('sortSelect');
        $is_cancelled_food = ENUM_DIS_SELECTED;
        $is_take_away_food = ENUM_GET_ALL;
        $is_goods = $request->get('inventory');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_OFF_DISHED_MENU_2,
            $restaurant_brand_id,
            $branch_id,
            $category_types,
            $category_id,
            $food_id,
            $report_type,
            $date_string,
            $from_date,
            $to_date,
            $is_gift,
            $is_combo,
            $is_cancelled_food,
            $is_take_away_food,
            $is_goods, $type_sort);
        $body = null;

        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $dataChart = [];

            $data = $config['data']['list'];
            $i = 0;
            foreach ($data as $db) {
                $dataChart[$i] = array(
                    'timeline' => $db['food_name'],
                    'total_amount' => $db['total_amount'],
                    'original_amount' => $db['total_original_amount'],
                    'quantity' => $db['quantity']
                );
                $i++;
            }
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $detail = 'Chi tiết';
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
                ->addColumn('profit', function ($row) {
                    return $this->numberFormat($row['total_profit']);
                })
                ->addColumn('profit_ratio', function ($row) {
                    return $this->numberFormat($row['profit_ratio']) . '%';
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    if(mb_strlen($row['food_name']) > 30){
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . mb_substr($row['food_name'], 0, 27)  . '...' . '<br>
                             <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i></label><div class="tag seemt-blue seemt-bg-blue d-flex mr-2" style="width: max-content">
                                                                                                                    <i class="fi-rr-hastag"></i>
                                                                                                                    <label class="m-0">'.($row['unit_name'] !== '' ? $row['unit_name'] : '---').'</label>
                                                                                                                </div>
                         </label>';
                    } else {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . $row['food_name'] . '<br>
                             <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i></label><div class="tag seemt-blue seemt-bg-blue d-flex mr-2" style="width: max-content">
                                                                                                                    <i class="fi-rr-hastag"></i>
                                                                                                                    <label class="m-0">'.($row['unit_name'] !== '' ? $row['unit_name'] : '---').'</label>
                                                                                                                </div>
                         </label>';
                    }
                })
                ->addColumn('action', function ($row) use ($restaurant_brand_id, $branch_id, $report_type, $date_string, $detail) {

                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"
                            data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-amount="' . $row['original_price'] . '" data-id="' . $row['food_id'] . '" data-quantity="' . $row['quantity'] . '"
                            data-name="' . $row['food_name'] . '" data-gift="-1" data-cancel="-1" data-brand="' . $restaurant_brand_id . '" data-branch="' . $branch_id . '" data-type="' . $report_type . '"
                            data-time="' . $date_string . '" data-food-name="' . $row['food_name'] . '" data-title="Chi tiết món mang về" onclick="openDetailOffMenuSellReport($(this))"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->rawColumns(['avatar', 'profit_ratio', 'quantity', 'total_original_amount', 'total_amount', 'profit', 'action'])
                ->addIndexColumn()
                ->make(true);

            $dataTotal = [
                'sum_quantity' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'quantity'))),
                'sum_total_original' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_original_amount'))),
                'total' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_amount'))),
                'sum_profit' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_profit'))),
            ];

            $dataTotalChart = [
                'Giá bán' => $this->numberFormat($config['data']['total_amount']),
                'Giá vốn' => $this->numberFormat($config['data']['total_original_amount']),
            ];
            return [$dataTable, $dataChart, $dataTotal, $config, $dataTotalChart];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    function detail(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $food_name = $request->get('food_name');
        $amount = $request->get('amount');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key_search = $this->keySearch(($request->get('search'))['value']);
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_DETAIL_OFF_MENU, $brand, $branch, $type,
            $time, $food_name, $amount, $key_search, $from, $to, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['quantity'] = $this->numberFormat($config['data']['list'][$i]['quantity']);
                $config['data']['list'][$i]['total_amount_by_food_id'] = $this->numberFormat($config['data']['list'][$i]['total_amount_by_food_id']);
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount']);
                $config['data']['list'][$i]['customer_slot_number'] = $this->numberFormat($config['data']['list'][$i]['customer_slot_number']);
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['action'] = '';
                $config['data']['list'][$i]['created_at'] = '<label>' . $this->convertDateTime($config['data']['list'][$i]['created_at']) . '</label>';
                $config['data']['list'][$i]['name'] = '<label>'.$config['data']['list'][$i]['employee_full_name'].'</label>';
            }
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_quantity' => $this->numberFormat($config['data']['total_record']),
                'total_original' => $this->numberFormat($config['data']['total_original_price']),
                'total_price' => $this->numberFormat($config['data']['total_price']),
                'total_profit' => $this->numberFormat($config['data']['total_profit']),
                'total_rate' => $this->numberFormat($config['data']['total_rate_profit']),
                'total_amount' => $this->numberFormat($config['data']['total_amount']),
                'key' => $key_search,
                'page' => $page,
                'config' => $config
            );
            return json_encode($dataTable);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
