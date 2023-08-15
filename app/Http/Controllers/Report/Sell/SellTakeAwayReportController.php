<?php

namespace App\Http\Controllers\Report\Sell;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SellTakeAwayReportController extends Controller
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
        $active_nav = 'Báo Cáo Món Mang Về';
        return view('report.sell.take_away.index', compact('active_nav'));
    }
    public function dataTakeAwayReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $is_take_away_food = ENUM_SELECTED;
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $select_sort = $request->get('selectSort');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_TAKE_AWAY_FOOD_V2, $brand, $branch, $is_take_away_food, $type, $time, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_chart = [];
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
                    "timeline" => $data_mix['food_name'],
                    "valueTotal" => $data_mix['total_amount'],
                    "valueOriginalTotal" => $data_mix['total_original_amount'],
                    "valueProfit" => $data_mix['total_profit'],
                    "quantity" => $data_mix['quantity']
                );
                $i++;
            }

            $data_chart_ratio = [
                "timeline" => collect($data)->pluck('food_name'),
                'value' => collect($data)->pluck('profit_ratio'),
            ];

            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $detail = TEXT_DETAIL;
            $dataTable = DataTables::of($data)
                ->addColumn('avatar', function ($row) use ($domain) {
                    if(mb_strlen($row['food_name']) > 30){
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . mb_substr($row['food_name'], 0, 27)  . '...' . '<br>
                             <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i></label>

                             <div class="tag seemt-blue seemt-bg-blue d-flex mt-1" style="width: fit-content">
                               <i class="fi-rr-hastag"></i>
                               <label class="m-0">'.$row['unit_name'].'</label>
                             </div>
                         </label>';
                    } else {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . $row['food_name'] . '<br>
                             <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i></label>

                              <div class="tag seemt-blue seemt-bg-blue d-flex mt-1" style="width: fit-content">
                               <i class="fi-rr-hastag"></i>
                               <label class="m-0">'.$row['unit_name'].'</label>
                             </div>
                         </label>';
                    }
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('total_original_amount', function ($row) {
                    return $this->numberFormat($row['total_original_amount']);
                })
                ->addColumn('profit', function ($row) {
                    return $this->numberFormat($row['total_profit']);
                })
                ->addColumn('profit_ratio', function ($row) {
                    return $this->numberFormat($row['profit_ratio']);
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $type, $time, $detail) {

                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"
                            data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-id="' . $row['food_id'] . '"
                            data-name="' . $row['food_name'] . '" data-gift="-1" data-cancel="-1" data-brand="' . $brand . '" data-branch="' . $branch . '" data-type="' . $type . '"
                            data-time="' . $time . '" data-title="Chi tiết món mang về" onclick="openDetailTakeAwaySellReport($(this))"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'avatar'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total' => $this->numberFormat($config['data']['total_amount']),
                'sum_quantity' => $this->numberFormat(collect($config['data']['list'])->sum('quantity')),
                'sum_total_original' => $this->numberFormat($config['data']['total_original_amount']),
                'sum_profit' => $this->numberFormat($config['data']['total_profit_amount']),
            ];
            $dataTotal_1 = [
                'Doanh thu' => $this->numberFormat($config['data']['total_amount']),
                'Giá vốn' => $this->numberFormat($config['data']['total_original_amount']),
                'Lợi nhuận' => $this->numberFormat($config['data']['total_profit_amount']),
            ];
            return [$data_chart, $dataTable, $config, $dataTotal, $dataTotal_1, $data_chart_ratio];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    function detail(Request $request) {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $id = $request->get('id');
        $isGift = $request->get('gift');
        $isCancel = $request->get('cancel');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key_search = $this->keySearch(($request->get('search'))['value']);
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_DETAIL_TAKE_AWAY, $brand, $branch, $type,
            $time, $id, $isGift, $isCancel, $key_search, $from, $to, $page, $limit);
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
