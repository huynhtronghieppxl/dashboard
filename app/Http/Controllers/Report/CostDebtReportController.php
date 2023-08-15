<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class CostDebtReportController extends Controller
{
    public function index()
    {
        $active_nav = 'Chi phí công nợ';
        return view('report.cost_debt.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $isReal = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_ANALYSIS_COST_V2, $brand, $branch, $type, $time, $from, $to, $isReal);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table = DataTables::of($config['data'])
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('addition_fee_reason_content', function ($row) {
                    return (mb_strlen($row['addition_fee_reason_content']) > 30) ? $row['addition_fee_reason_content'] = mb_substr($row['addition_fee_reason_content'], 0, 27) . '...' : $row['addition_fee_reason_content'];
                })
                ->addColumn('debt_amount', function ($row) {
                    return $this->numberFormat($row['debt_amount']);
                })
                ->addColumn('waiting_amount', function ($row) {
                    return $this->numberFormat($row['waiting_amount']);
                })
                ->addColumn('action', function ($row)  {
                    if ($row['is_automatically_generated'] === 1) {
                        return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" data-original-title="' . TEXT_DETAIL . '" data-id="' . $row['addition_fee_reason_id'] . '" data-name="' . $row['addition_fee_reason_content'] . '" data-type="' . TEXT_ADDITION_FEE_AUTO_PAYMENT . '" data-amount="' . $this->numberFormat($row['amount']) . '" data-auto="' . $row['is_automatically_generated'] . '" data-generated-type="2" onclick="openModalDetailCostDebtReport($(this))"><span class="icofont icofont-eye-alt"></span></button>
                         </div>';
                    } else {
                        return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" data-original-title="' . TEXT_DETAIL . '" data-id="' . $row['addition_fee_reason_id'] . '" data-name="' . $row['addition_fee_reason_content'] . '" data-type="' . TEXT_ADDITION_FEE_PAYMENT . '" data-amount="' . $this->numberFormat($row['amount']) . '" data-auto="' . $row['is_automatically_generated'] . '" data-generated-type="-1" onclick="openModalDetailCostDebtReport($(this))"><span class="icofont icofont-eye-alt"></span></button>
                         </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['addition_fee_reason_content'])
                ->addIndexColumn()
                ->make(true);
            $data_total = [
                'total_amount' => $this->numberFormat(array_sum(array_column($config['data'], 'amount'))),
                'total_waiting' => $this->numberFormat(array_sum(array_column($config['data'], 'waiting_amount'))),
                'total_debt' => $this->numberFormat(array_sum(array_column($config['data'], 'debt_amount')))
            ];
            return [$data_table, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $type = Config::get('constants.type.addition_fee.OUT');
        $branch_id = $request->get('branch');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $type_client = $request->get('type');
        $from = Config::get('constants.type.data.NONE');
        $to = Config::get('constants.type.data.NONE');
        switch ($type_client) {
            case Config::get('constants.type.date.TODAY'):
                $from = $request->get('date');
                $to = $request->get('date');
                break;
            case Config::get('constants.type.date.WEEK'):
                $from = date('d/m/Y', strtotime('last monday'));
                $to = date('d/m/Y');
                break;
            case Config::get('constants.type.date.MONTH'):
                $from = '1/' . $request->get('date');
                $to = date('d/') . $request->get('date');
                break;
            case Config::get('constants.type.date.THREE_MONTH'):
                $from = date('d/m/Y', strtotime("-3 month"));
                $to = date('d/m/Y');
                break;
            case Config::get('constants.type.date.YEAR'):
                $from = '1/1/' . $request->get('date');
                $to = date('d/m/') . $request->get('date');
                break;
            case Config::get('constants.type.date.THREE_YEAR'):
                $from = date('d/m/Y', strtotime("-3 year"));
                $to = date('d/m/');
                break;
            case Config::get('constants.type.date.ALL_YEAR'):
                $from = '';
                $to = '';
                break;
        }
        $is_count_to_revenue = ENUM_GET_ALL;
        $object_type = ENUM_GET_ALL;
        $addition_fee_reason_id = $request->get('id');
        $is_take_auto_generated = ENUM_GET_ALL;
        if ($request->get('auto') === ENUM_SELECTED) {
            $addition_fee_reason_id = ENUM_ID_GET_ALL;
            $is_take_auto_generated = ENUM_SELECTED;
        }
        $addition_fee_reason_type_id = ENUM_GET_ALL;
        $status = ENUM_STATUS_GET_ALL;
        $page = ENUM_DEFAULT_PAGE;
        $restaurant_budget_id = ENUM_DIS_SELECTED;
        $order_session_id = ENUM_GET_ALL;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $employee_id = ENUM_STATUS_GET_ALL;
        $report_type = ENUM_STATUS_GET_ALL;
        $auto_generated_type = ENUM_STATUS_GET_ALL;
        $key = ENUM_ID_NONE;
        $payment_method_id = ENUM_ID_GET_ALL;
        $object_id = ENUM_ID_GET_ALL;
        $debt = ENUM_GET_ALL;
        $is_restaurant_budget_closed = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_DATA, $restaurant_brand_id, $branch_id, $page, $restaurant_budget_id, $from, $to, $type, $is_take_auto_generated, $order_session_id, $employee_id, $limit, $report_type, $auto_generated_type, $object_type, $addition_fee_reason_id, $addition_fee_reason_type_id, $status, $is_count_to_revenue, $key, $payment_method_id, $object_id, $debt, $is_restaurant_budget_closed);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];

            $data_table = DataTables::of($data)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailPaymentBill(' . $row['id'] . ',' . $row['branch']['id'] . ')"><span class="icofont icofont-eye-alt"></span></button>
                            </div>';
                })
                ->rawColumns(['amount', 'action', 'code'])
                ->addIndexColumn()
                ->make(true);

            return [$data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
