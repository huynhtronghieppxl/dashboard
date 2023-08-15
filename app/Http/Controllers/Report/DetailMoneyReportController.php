<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class DetailMoneyReportController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Chi tiết tiền mặt';
        return view('report.detail_money.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $addition_type = $request->get('object_type');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_CASH_BOOK_V2, $brand, $branch, $type, $time, $key, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
//        dd($config);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        try {
            $detail = TEXT_DETAIL;
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                $config['data']['list'][$i]['create_at'] = substr($config['data']['list'][$i]['create_at'], 0, 10);
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                if (mb_strlen($config['data']['list'][$i]['employee_full_name']) > 30) {
                    $config['data']['list'][$i]['employee_full_name'] = mb_substr($config['data']['list'][$i]['employee_full_name'], 0, 27) . '...';
                }
//                if (mb_strlen($config['data']['list'][$i]['employee_full_name']) > 30) {
//                    $config['data']['list'][$i]['employee_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['list'][$i]['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $config['data']['list'][$i]['avatar'] . "'" . ')">
//                            <label class="title-name-new-table" >'. mb_substr($config['data']['list'][$i]['employee_full_name'], 0, 27) .'<br>
//                            <label class="label-new-table">
//                            <i class="zmdi zmdi-account-circle mr-1"></i>'.$config['data']['list'][$i]['employee_role_name'].'</label></label>';
////                }
                if (mb_strlen($config['data']['list'][$i]['object_name']) > 30) {
                    $config['data']['list'][$i]['object_name'] = mb_substr($config['data']['list'][$i]['object_name'], 0, 27) . '...';
                }
                if (mb_strlen($config['data']['list'][$i]['addition_fee_reason_content']) > 30) {
                    $config['data']['list'][$i]['addition_fee_reason_content'] = mb_substr($config['data']['list'][$i]['addition_fee_reason_content'], 0, 27) . '...';
                }
                if ($addition_type == 0) {
                    $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" onclick="openModalDetailReceiptsBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch_id'] . ')"><span class="icofont icofont-eye-alt"></span></button>
                            </div>';
                } else {
                    $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" onclick="openModalDetailPaymentBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch_id'] . ')"><span class="icofont icofont-eye-alt"></span></button>
                            </div>';
                }
                $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list'][$i]);
                $config['data']['list'][$i]['create_at'] = date("d-m-Y", strtotime($config['data']['list'][$i]['create_at']));
            }
            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_amount_payment' => $this->numberFormat($config['data']['total_amount_payment']),
                'total_record_payment' => $this->numberFormat($config['data']['total_record_payment']),
                'total_amount_receipt' => $this->numberFormat($config['data']['total_amount_receipt']),
                'total_record_receipt' => $this->numberFormat($config['data']['total_record_receipt']),
                'key' => $key,
                'page' => $page,
                'config' => $config
            );
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
