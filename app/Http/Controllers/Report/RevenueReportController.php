<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class RevenueReportController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'BUSINESS_ACTIVE_REPORT']);
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
        $active_nav = 'Báo cáo doanh thu';
        return view('report.revenue.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_REASON_REVENUE_V2, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data_chart_column = '';
            $data_chart_color = '';
            $check_chart = null;
            $detail = TEXT_DETAIL;
            for ($i = 0; $i < count($data); $i++) {
                $data_chart_column .= '["' . $data[$i]['addition_fee_reason_content'] . '",' . $data[$i]['amount'] . '],';
                $data_chart_color .= '"#' . dechex(rand(0x000000, 0xFFFFFF)) . '",';
                if ($data[$i]['amount'] > 0) {
                    $check_chart = 1;
                }
            }
            $data_chart_pie = collect($config['data'])->map(function ($item) {
                return collect($item)
                    ->only(['addition_fee_reason_content', 'amount'])
                    ->all();
            });
            if ($data_chart_column !== '') {
                $data_chart_column = substr($data_chart_column, 0, strlen($data_chart_column) - 1);
                $data_chart_color = substr($data_chart_color, 0, strlen($data_chart_color) - 1);
            }
            $data_chart = [
                'data_chart_column' => '[' . $data_chart_column . ']',
                'data_chart_color' => '[' . $data_chart_color . ']',
                'check_chart' => $check_chart,
            ];
            $dataTable = DataTables::of($data)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('action', function ($row) use ($time, $type, $detail){
                    if ($row['is_automatically_generated'] === 1) {
                        return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-type-action=" ' . $type . ' " data-time-action=" ' . $time . ' " data-id="' . $row['addition_fee_reason_id'] . '" data-name="' . $row['addition_fee_reason_content'] . '" data-type="' . TEXT_ADDITION_FEE_AUTO_RECEIPT . '" data-amount="' . $this->numberFormat($row['amount']) . '" data-auto="' . $row['is_automatically_generated'] . '" data-generated-type="' . $row['automatically_generated_type'] . '" data-addition-fee-reason="'. $row['addition_fee_reason_type_id'] .'" onclick="openModalDetailRevenueReport($(this))"><i class="fi-rr-eye"></i></button>
                         </div>';
                    } else {
                        return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-type-action=" ' . $type . ' " data-time-action=" ' . $time . ' " data-id="' . $row['addition_fee_reason_id'] . '" data-name="' . $row['addition_fee_reason_content'] . '" data-type="' . TEXT_ADDITION_FEE_RECEIPT . '" data-amount="' . $this->numberFormat($row['amount']) . '" data-auto="' . $row['is_automatically_generated'] . '" data-generated-type="' . $row['automatically_generated_type'] . '" data-addition-fee-reason="'. $row['addition_fee_reason_type_id'] .'"  onclick="openModalDetailRevenueReport($(this))"><i class="fi-rr-eye"></i></button>
                         </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            $data_total = [
                'total_amount_revenue' => $this->numberFormat(array_sum(array_column($config['data'], 'amount'))),
            ];
            return [$data_chart, $dataTable, $data_total, $config, $data_total, $data_chart_pie];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $type = ENUM_DIS_SELECTED;
        $branch_id = $request->get('branch');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $type_client = $request->get('type');
        $from = Config::get('constants.type.data.NONE');
        $to = Config::get('constants.type.data.NONE');
        switch ($type_client) {
            case Config::get('constants.type.date.TODAY'):
                $from = $request->get('time');
                $to = $request->get('time');
                break;
            case Config::get('constants.type.date.WEEK'):
                $from = date('d/m/Y', strtotime('last monday'));
                $to = date('d/m/Y');
                break;
            case Config::get('constants.type.date.MONTH'):
                $month = Carbon::createFromFormat('m/Y', $request->get('time'));
                $is_now_month = $month->isCurrentMonth();
                if($is_now_month) {
                    $from = '1/' . $request->get('time');
                    $to = date('d/') . $request->get('time');
                }else{
                    $from = '1/' . $request->get('time');
                    $to = $month->endOfMonth()->format('d/m/Y');
                }
                break;
            case Config::get('constants.type.date.THREE_MONTH'):
                $from = date('d/m/Y', strtotime("-3 month"));
                $to = date('d/m/Y');
                break;
            case Config::get('constants.type.date.YEAR'):
                $from = '1/1/' . $request->get('time');
                $to = date('d/m/') . $request->get('time');
                break;
            case Config::get('constants.type.date.THREE_YEAR'):
                $from = date('d/m/Y', strtotime("-3 year"));
                $to = date('d/m/Y');
                break;
            case Config::get('constants.type.date.ALL_YEAR'):
                $from = '';
                $to = '';
                break;
        }
        $is_count_to_revenue = ENUM_SELECTED;
        $object_type = ENUM_GET_ALL;
        $addition_fee_reason_id = $request->get('id');
        $is_take_auto_generated = ENUM_GET_ALL;
        if ((int)$request->get('auto') === ENUM_SELECTED) {
            $addition_fee_reason_id = ENUM_GET_ALL;
            $is_take_auto_generated = ENUM_SELECTED;
        }
        $addition_fee_reason_type_id = $request->get('addition_reason_type_id');
        $status = ENUM_INVENTORY_REPORT_STATUS_CONFIRMED;
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $restaurant_budget_id = ENUM_DIS_SELECTED;
        $order_session_id = ENUM_GET_ALL;
        $limit = 100;
        $employee_id = ENUM_GET_ALL;
        $report_type = ENUM_GET_ALL;
        $auto_generated_type = $request->get('generated_type');
        $key = $this->keySearch(($request->get('search'))['value']);
        $payment_method_id = ENUM_GET_ALL;
        $object_id = ENUM_GET_ALL;
        $debt = ENUM_GET_ALL;
        $is_restaurant_budget_closed = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_DATA, $restaurant_brand_id, $branch_id, $page, $restaurant_budget_id, $from, $to, $type, $is_take_auto_generated, $order_session_id, $employee_id, $limit, $report_type, $auto_generated_type, $object_type, $addition_fee_reason_id, $addition_fee_reason_type_id, $status, $is_count_to_revenue, $key, $payment_method_id, $object_id, $debt, $is_restaurant_budget_closed);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $detail = TEXT_DETAIL;
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['employee']['name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee']['avatar'] . '" class="img-inline-name-data-table">
                            <label class="title-name-new-table">' . $config['data']['list'][$i]['employee']['name'] . '<br>
                                   <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee']['role_name'] . '</label>
                            </label>';
                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                $config['data']['list'][$i]['fee_month'] = '<label>' . $this->convertDateTime($config['data']['list'][$i]['fee_month']) . '</label>';
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" title="' . $detail . '" onclick="openModalDetailReceiptsBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
                                                        </div>';
            }
            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_record' => $this->numberFormat($config['data']['total_record']),
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
