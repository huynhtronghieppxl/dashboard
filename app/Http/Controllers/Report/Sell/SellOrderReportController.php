<?php

namespace App\Http\Controllers\Report\Sell;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class SellOrderReportController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'SALE_REPORT', 'BUSINESS_ACTIVE_REPORT', 'CASHIER_ACCESS']);
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
        $active_nav = 'Báo Cáo Đơn Hàng';
        return view('report.sell.order.index', compact('active_nav'));
    }
    public function dataOrderReport(Request $request)
    {
        $branch_id = (int)$request->get('branch_id');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $is_force_online = ENUM_GET_ALL;
        $limit = ENUM_DEFAULT_LIMIT_100;
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $order_status = Config::get('constants.type.order_status.ORDER_STATUS_REPORT'); //2,5
        $area_id = Config::get('constants.type.data.NONE');
        $order_id = Config::get('constants.type.data.NONE');
        $table_ids = Config::get('constants.type.data.NONE');
        $is_apply_vat = -1;
        $is_service_restaurant_charge = $request->get('filter_status_order');
        $from = $request->get('from');
        $to = $request->get('to');
        $key = $this->keySearch(($request->get('search'))['value']);
        $api = sprintf(API_LIST_ORDER_GET, $restaurant_brand_id, $branch_id, $limit, $page, $order_status, $area_id, $order_id, $table_ids, $is_apply_vat, $is_service_restaurant_charge, $from, $to, $key);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_LIST_ORDER_GET_TOTAL, $branch_id, $order_status, $area_id, $order_id, $table_ids, $from, $to, $is_force_online, $key);
        $body = null;
        $requestTotal = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTotal]);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        try {
            $config = $configAll[0];
            $detail = TEXT_DETAIL;
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                if((mb_strlen( $config['data']['list'][$i]['employee']['name']) > 30)){
                    $config['data']['list'][$i]['employee_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['list'][$i]['employee']['avatar'] . '"  class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $config['data']['list'][$i]['employee']['avatar'] . "'" . ')"/><label class="title-name-new-table">' .
                        mb_substr( $config['data']['list'][$i]['employee']['name'], 0, 27) . '...' . ' <br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>'. $config['data']['list'][$i]['employee']['role_name'] .'</label></label>';
                }else{
                    $config['data']['list'][$i]['employee_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['list'][$i]['employee']['avatar'] . '"  class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $config['data']['list'][$i]['employee']['avatar'] . "'" . ')"/><label class="title-name-new-table">' .$config['data']['list'][$i]['employee']['name'].'<br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>'. $config['data']['list'][$i]['employee']['role_name'] .'</label></label>';
                }
                if (mb_strlen( $config['data']['list'][$i]['table_name']) > 20)  $config['data']['list'][$i]['table_name'] = mb_substr( $config['data']['list'][$i]['table_name']  , 0, 17) . '...';
                if ($config['data']['list'][$i]['payment_date'] === '') {
                    $config['data']['list'][$i]['payment_date'] =  '<div class="seemt-red seemt-border-red status-new">
                                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                        <label class="m-0">Chưa thanh toán</label>
                                                                    </div>';
                } else {
                    $config['data']['list'][$i]['payment_date'] = $this->convertDateTime($config['data']['list'][$i]['payment_date']);
                }
                $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                $config['data']['list'][$i]['vat_amount'] = $this->numberFormat($config['data']['list'][$i]['vat_amount']);
                $config['data']['list'][$i]['discount_amount'] = $this->numberFormat($config['data']['list'][$i]['discount_amount']);
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount']);
                $config['data']['list'][$i]['membership_total_point_used_amount'] = $this->numberFormat($config['data']['list'][$i]['membership_total_point_used_amount']);
                $config['data']['list'][$i]['customer_name'] = $config['data']['list'][$i]['customer']['name'] === '' ? '---' : $config['data']['list'][$i]['customer']['name'];
                if($config['data']['list'][$i]['order_status'] === 5){
                    $config['data']['list'][$i]['order_status_name'] = '<div class="seemt-red seemt-border-red status-new">
                                                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                            <label class="m-0">' . $config['data']['list'][$i]['order_status_name'] . '</label>
                                                                        </div>';
                }else{
                    $config['data']['list'][$i]['order_status_name'] = '<div class="seemt-green seemt-border-green status-new">
                                                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                            <label class="m-0">' . $config['data']['list'][$i]['order_status_name'] . '</label>
                                                                        </div>';
                }


                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-id="' . $config['data']['list'][$i]['id'] . '" data-is-print="0" data-cancel="0" onclick="openBillDetail($(this))"><i class="fi-rr-eye"></i></button>
                                                        </div>';
                $config['data']['list'][$i]['id'] = '<lable class="texts">' . $config['data']['list'][$i]['id'] . '</lable>';

                if ($config['data']['list'][$i]['is_service_restaurant_charge'] == 1) {
                    $config['data']['list'][$i]['is_service_restaurant_charge'] = '<div class="btn-group btn-group-sm"><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="Có tính chi phí dịch vụ"></i></div>';
                } else {
                    $config['data']['list'][$i]['is_service_restaurant_charge'] = '<div class="btn-group btn-group-sm"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="Không tính chi phí dịch vụ"></i></div>';
                }

                $config['data']['list'][$i]['membership_point_added'] = $this->numberFormat($config['data']['list'][$i]['membership_point_added']);
                $config['data']['list'][$i]['original_price'] = $this->numberFormat($config['data']['list'][$i]['original_price']);
            }
            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_record' => $this->numberFormat($config['data']['total_record']),
                'key' => $key,
                'page' => $page,
                'config' => $configAll
            );
            $config = $configAll[1];
            $data_table['amount'] = $this->numberFormat($config['data']['amount']);
            $data_table['vat_amount'] = $this->numberFormat($config['data']['vat_amount']);
            $data_table['discount_amount'] = $this->numberFormat($config['data']['discount_amount']);
            $data_table['total_amount'] = $this->numberFormat($config['data']['total_amount']);
            $data_table['total_slot_customer'] = $this->numberFormat($config['data']['total_customer_slot_number']);
            $data_table['membership_accumulate_point_used'] = $this->numberFormat($config['data']['membership_total_point_used_amount']);
            $data_table['membership_point_added'] = $this->numberFormat($config['data']['membership_point_added']);
            $data_table['total_original_price'] = $this->numberFormat($config['data']['total_original_price']);
            $data_table['average_rate_profit'] = $this->numberFormat($config['data']['average_rate_profit']);
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataExcel(Request $request){
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $key = '';
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_ORDER_V2, $brand, $branch, $type, $time, $page, $limit, $key, $from, $to);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
