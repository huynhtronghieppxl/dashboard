<?php

namespace App\Http\Controllers\Report\Sell;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SellGiftFoodReportController extends Controller
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
        $active_nav = 'Báo Cáo Món Tặng';
        return view('report.sell.gift_food.index', compact('active_nav'));
    }

    public function dataGiftFoodReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $report_type = $request->get('type');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $type = ENUM_SELECTED;
        $date_string = $request->get('time');
        $is_gift = ENUM_SELECTED;
        $is_group = ENUM_SELECTED;
        $api = sprintf(API_REPORT_GET_GIFT_FOOD_TIME, $brand, $branch, $report_type, $date_string, $is_gift, $from, $to);
        $body = null;
        $requestGiftByTime = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $type_sort = $request->get('sortSelect');
        $api = sprintf(API_REPORT_GET_GIFT_FOOD, $brand, $branch, $type, $report_type, $date_string, $from, $to, $type_sort,$is_group);
        $body = null;
        $requestGiftByOrder = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestGiftByTime, $requestGiftByOrder]);
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $api = sprintf(API_REPORT_GET_GIFT_FOOD, $brand, $branch, $type, $report_type, $date_string, $from, $to, $type_sort,ENUM_DEFAULT);
        $method = ENUM_METHOD_GET;
        $body = null;
        $config1 = $this->callApiGatewayTemplate($project,$method,$api,$body);
        try {
            $data_chart = [];
            $dataChart = $configAll[1]['data']['list'];
            $i = 0;
            foreach ($dataChart as $db) {
                $data_chart[$i] = array(
                    'timeline' => $db['food_name'],
                    'total_amount' => $db['total_amount'],
                    'original_amount' => $db['total_original_amount'],
                    'quantity' => $db['quantity']
                );
                $i++;
            }


            $data = $config1['data']['list'];
            $detail = TEXT_DETAIL;
            $isGift = ENUM_SELECTED;
            $isCancel = ENUM_DIS_SELECTED;
            $dataTable = DataTables::of($data)
                ->addColumn('name', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    if (mb_strlen($row['employee_name']) > 30) {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee_avatar'] . "'" . ')">
                            <label class="title-name-new-table" >' . mb_substr($row['employee_name'], 0, 27) . '...' . '<br>
                            <label class="label-new-table">
                            <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_role_name'] . '</label></label>';
                    } else {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee_avatar'] . "'" . ')">
                            <label class="title-name-new-table" >' . $row['employee_name'] . '<br>
                            <label class="label-new-table">
                            <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_role_name'] . '</label></label>';
                    }
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('customer_slot_number', function ($row) {
                    return $this->numberFormat($row['customer_slot_number']);
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('day', function ($row) {
                    return (date('d/m/Y', strtotime($row['day'])));
                })
                ->addColumn('table_name', function ($row) {
                    return ($row['table_name'] !== null ? $row['table_name'] : '---');
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $report_type, $date_string, $detail, $isGift, $isCancel) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-id="' . $row['order_id'] . '" data-order-id="' . $row['order_id'] . '" data-name="' . $row['food_name'] . '" data-gift="' . $isGift . '" data-cancel="' . $isCancel . '" data-brand="' . $brand . '" data-branch="' . $branch . '" data-is-print="1" data-type="' . $report_type . '" data-time="' . $date_string . '" data-title="Chi tiết món tặng" onclick="openBillDetail($(this))"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'name', 'day'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total' => $this->numberFormat(array_sum(array_column($data, 'total_amount'))),
                'quantity' => $this->numberFormat(array_sum(array_column($data, 'quantity'))),
            ];

            $dataTotalChart = [
                'Giá bán' => $this->numberFormat($configAll[1]['data']['total_amount']),
                'Giá vốn' => $this->numberFormat($configAll[1]['data']['total_original_amount']),
            ];
            return [$dataTable, $dataTotal, $data_chart, $dataTotalChart, $configAll,$config1];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }
}
