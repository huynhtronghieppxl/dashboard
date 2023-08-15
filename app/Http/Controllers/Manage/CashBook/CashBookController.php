<?php

namespace App\Http\Controllers\Manage\CashBook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Redis;

class CashBookController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'manage.cash_book';
        return view('manage.cash_book.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_CASH_BOOK_MANAGE_GET_DATA, $branch, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $a = 0;
            $b = 0;
            $c = 0;
            $data_total_opening_amount_waiting = 0;
            $data_total_opening_amount_done = 0;
            $data_total_opening_amount_cancel = 0;
            $data_total_in_amount_waiting = 0;
            $data_total_in_amount_done = 0;
            $data_total_in_amount_cancel = 0;
            $data_total_out_amount_waiting = 0;
            $data_total_out_amount_done = 0;
            $data_total_out_amount_cancel = 0;
            $data_total_order_amount_waiting = 0;
            $data_total_order_amount_done = 0;
            $data_total_order_amount_cancel = 0;
            $data_total_closing_amount_waiting = 0;
            $data_total_closing_amount_done = 0;
            $data_total_closing_amount_cancel = 0;
            $data_total_changing_amount_waiting = 0;
            $data_total_changing_amount_done = 0;
            $data_total_changing_amount_cancel = 0;
            $data_waiting = [];
            $data_done = [];
            $data_cancel = [];
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['status'] === (int)Config::get('constants.type.RestaurantBudgetStatusEnum.PENDING')) {
                    $data_waiting[$a] = $data[$i];
                    $data_total_opening_amount_waiting += $data[$i]['openning_amount'];
                    $data_total_in_amount_waiting += $data[$i]['in_amount'];
                    $data_total_out_amount_waiting += $data[$i]['out_amount'];
                    $data_total_order_amount_waiting += $data[$i]['order_amount'];
                    $data_total_closing_amount_waiting += $data[$i]['closing_amount'];
                    $data_total_changing_amount_waiting += $data[$i]['changing_amount'];
                    $a++;
                } else if ($data[$i]['status'] === (int)Config::get('constants.type.RestaurantBudgetStatusEnum.COMPLETED')) {
                    $data_done[$b] = $data[$i];
                    $data_total_opening_amount_done += $data[$i]['openning_amount'];
                    $data_total_in_amount_done += $data[$i]['in_amount'];
                    $data_total_out_amount_done += $data[$i]['out_amount'];
                    $data_total_order_amount_done += $data[$i]['order_amount'];
                    $data_total_closing_amount_done += $data[$i]['closing_amount'];
                    $data_total_changing_amount_done += $data[$i]['changing_amount'];
                    $b++;
                } else {
                    $data_cancel[$c] = $data[$i];
                    $data_total_opening_amount_cancel += $data[$i]['openning_amount'];
                    $data_total_in_amount_cancel += $data[$i]['in_amount'];
                    $data_total_out_amount_cancel += $data[$i]['out_amount'];
                    $data_total_order_amount_cancel += $data[$i]['order_amount'];
                    $data_total_closing_amount_cancel += $data[$i]['closing_amount'];
                    $data_total_changing_amount_cancel += $data[$i]['changing_amount'];
                    $c++;
                }
            }
            $data_table_waiting = $this->drawTableCashBookManage($data_waiting);
            $data_table_done = $this->drawTableCashBookManage($data_done);
            $data_table_cancel = $this->drawTableCashBookManage($data_cancel);
            $data_total = [
                'total_record_waiting' => $this->numberFormat($a),
                'total_record_done' => $this->numberFormat($b),
                'total_record_cancel' => $this->numberFormat($c),
                'data_total_opening_amount_waiting' => $this->numberFormat($data_total_opening_amount_waiting),
                'data_total_opening_amount_done' => $this->numberFormat($data_total_opening_amount_done),
                'data_total_opening_amount_cancel' => $this->numberFormat($data_total_opening_amount_cancel),
                'data_total_in_amount_waiting' => $this->numberFormat($data_total_in_amount_waiting),
                'data_total_in_amount_done' => $this->numberFormat($data_total_in_amount_done),
                'data_total_in_amount_cancel' => $this->numberFormat($data_total_in_amount_cancel),
                'data_total_out_amount_waiting' => $this->numberFormat($data_total_out_amount_waiting),
                'data_total_out_amount_done' => $this->numberFormat($data_total_out_amount_done),
                'data_total_out_amount_cancel' => $this->numberFormat($data_total_out_amount_cancel),
                'data_total_order_amount_waiting' => $this->numberFormat($data_total_order_amount_waiting),
                'data_total_order_amount_done' => $this->numberFormat($data_total_order_amount_done),
                'data_total_order_amount_cancel' => $this->numberFormat($data_total_order_amount_cancel),
                'data_total_closing_amount_waiting' => $this->numberFormat($data_total_closing_amount_waiting),
                'data_total_closing_amount_done' => $this->numberFormat($data_total_closing_amount_done),
                'data_total_closing_amount_cancel' => $this->numberFormat($data_total_closing_amount_cancel),
                'data_total_changing_amount_waiting' => $this->numberFormat($data_total_changing_amount_waiting),
                'data_total_changing_amount_done' => $this->numberFormat($data_total_changing_amount_done),
                'data_total_changing_amount_cancel' => $this->numberFormat($data_total_changing_amount_cancel),
            ];
            return $data_res = [$data_table_waiting, $data_table_done, $data_table_cancel, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTableCashBookManage($data)
    {
        return DataTables::of($data)
            ->addColumn('openning_amount', function ($row) {
                return $this->numberFormat($row['openning_amount']);
            })
            ->addColumn('in_amount', function ($row) {
                return $this->numberFormat($row['in_amount']);
            })
            ->addColumn('out_amount', function ($row) {
                return $this->numberFormat($row['out_amount']);
            })
            ->addColumn('order_amount', function ($row) {
                return $this->numberFormat($row['order_amount']);
            })
            ->addColumn('closing_amount', function ($row) {
                return $this->numberFormat($row['closing_amount']);
            })
            ->addColumn('changing_amount', function ($row) {
                return $this->numberFormat($row['changing_amount']);
            })
            ->addColumn('action', function ($row) {
                $detail = TEXT_DETAIL;
                $confirm = TEXT_CONFIRM;
                $cancel = TEXT_CANCEL;
                if ($row['status'] == Config::get('constants.type.RestaurantBudgetStatusEnum.PENDING')) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-success waves-effect waves-light" title="' . $confirm . '" onclick="confirmCashBookManage(' . $row['id'] . ',' . $row['branch_id'] . ')" ><span class="icofont icofont-ui-check"></span></button>
                            <button type="button" class="btn btn-danger waves-effect waves-light" title="' . $cancel . '" onclick="cancelCashBookManage(' . $row['id'] . ',' . $row['branch_id'] . ')"><span class="icofont icofont-ui-close"></span></button>
                            <button type="button" class="btn btn-primary waves-effect waves-light" title="' . $detail . '" onclick="openModalDetailCashBookManage($(this))" data-from="' . $row['from'] . '" data-to="' . $row['to'] . '" data-name="' . $row['name'] . '" data-note="' . $row['note'] . '" data-employee="' . $row['employee_name'] . '" data-employee-complete="' . $row['employee_complete_name'] . '" data-openning="' . $this->numberFormat($row['openning_amount']) . '" data-in="' . $this->numberFormat($row['in_amount']) . '" data-out="' . $this->numberFormat($row['out_amount']) . '" data-order="' . $this->numberFormat($row['order_amount']) . '" data-closing="' . $this->numberFormat($row['closing_amount']) . '" data-changing="' . $this->numberFormat($row['changing_amount']) . '" data-status="' . $row['status'] . '" data-status-name="' . $row['status_name'] . '" data-branch="' . $row['branch_id'] . '"><span class="icofont icofont-eye-alt"></span></button>
                            </div>';
                } else {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary waves-effect waves-light" title="' . $detail . '" onclick="openModalDetailCashBookManage($(this))" data-from="' . $row['from'] . '" data-to="' . $row['to'] . '" data-name="' . $row['name'] . '" data-note="' . $row['note'] . '" data-employee="' . $row['employee_name'] . '" data-employee-complete="' . $row['employee_complete_name'] . '" data-openning="' . $this->numberFormat($row['openning_amount']) . '" data-in="' . $this->numberFormat($row['in_amount']) . '" data-out="' . $this->numberFormat($row['out_amount']) . '" data-order="' . $this->numberFormat($row['order_amount']) . '" data-closing="' . $this->numberFormat($row['closing_amount']) . '" data-changing="' . $this->numberFormat($row['changing_amount']) . '" data-status="' . $row['status'] . '" data-status-name="' . $row['status_name'] . '" data-branch="' . $row['branch_id'] . '"><span class="icofont icofont-eye-alt"></span></button>
                            </div>';
                }
            })
            ->rawColumns(['status_text', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function confirm(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $note = Config::get('constants.type.data.NONE');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_CASH_BOOK_MANAGE_POST_CONFIRM, $id);
        $body = [
            'branch_id' => $branch,
            'id' => $id,
            'note' => $note,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === (int)Config::get('constants.type.status.STATUS_SUCCESS')) {
            Redis::del('cash-book-treasurer.time?branch=' . $request->get('branch'));
        }
        return $config;
    }

    public function cancel(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $note = Config::get('constants.type.data.NONE');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_CASH_BOOK_MANAGE_POST_CANCEL, $id);
        $body = [
            'branch_id' => $branch,
            'id' => $id,
            'note' => $note,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function detail(Request $request)
    {
        $type = $request->get('type');
        $branch_id = $request->get('branch_id');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $from = $request->get('from');
        $to = $request->get('to');
        $is_count_to_revenue = Config::get('constants.type.checkbox.GET_ALL');
        $object_type = Config::get('constants.type.addition_fee.GET_ALL');
        $addition_fee_reason_id = Config::get('constants.type.id.GET_ALL');
        $addition_fee_reason_type_id = Config::get('constants.type.addition_fee.GET_ALL');
        $is_take_auto_generated = Config::get('constants.type.status.GET_ALL');
        $status = Config::get('constants.type.AdditionFeeStatusEnum.CONFIRMED');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $restaurant_budget_id = Config::get('constants.type.default.RESTAURANT_PERIOD');
        $order_session_id = Config::get('constants.type.addition_fee.GET_ALL');
        $limit = $request->get('limit');
        $employee_id = Config::get('constants.type.status.GET_ALL');
        $report_type = Config::get('constants.type.status.GET_ALL');
        $auto_generated_type = Config::get('constants.type.status.GET_ALL');
        $key = $this->keySearch(($request->get('search'))['value']);
        $payment_method_id = Config::get('constants.type.id.GET_ALL');
        $object_id = Config::get('constants.type.id.GET_ALL');
        $debt = Config::get('constants.type.checkbox.GET_ALL');
        $is_restaurant_budget_closed = Config::get('constants.type.checkbox.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REASON_ADDITION_FEE_GET_DATA, $restaurant_brand_id, $branch_id, $page, $restaurant_budget_id, $from, $to, $type, $is_take_auto_generated, $order_session_id, $employee_id, $limit, $report_type, $auto_generated_type, $object_type, $addition_fee_reason_id, $addition_fee_reason_type_id, $status, $is_count_to_revenue, $key, $payment_method_id, $object_id, $debt, $is_restaurant_budget_closed);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $detail = TEXT_DETAIL;
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                if ($type === Config::get('constants.type.addition_fee.IN')) {
                    $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary waves-effect waves-light" title="' . $detail . '" onclick="openModalDetailReceiptsBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch']['id'] . ')"><span class="icofont icofont-eye-alt"></span></button>
                           </div>';
                } else {
                    $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary waves-effect waves-light" title="' . $detail . '" onclick="openModalDetailPaymentBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch']['id'] . ')"><span class="icofont icofont-eye-alt"></span></button>
                           </div>';
                }
                if ($config['data']['list'][$i]['status'] == Config::get('constants.type.AdditionFeeStatusEnum.WAITING_PAYMENT') || $config['data']['list'][$i]['status'] == Config::get('constants.type.AdditionFeeStatusEnum.PAID')) {
                    $class = 'text-warning';
                } elseif ($config['data']['list'][$i]['status'] == Config::get('constants.type.AdditionFeeStatusEnum.CONFIRMED')) {
                    $class = 'text-success';
                } elseif ($config['data']['list'][$i]['status'] == Config::get('constants.type.AdditionFeeStatusEnum.CANCEL') || $config['data']['list'][$i]['status'] == Config::get('constants.type.AdditionFeeStatusEnum.CANCEL_PAYMENT')) {
                    $class = 'text-danger';
                } else {
                    $class = 'text-inverser';
                }
                $config['data']['list'][$i]['status_text'] = '<div class="' . $class . '">' . $config['data']['list'][$i]['status_text'] . '</div>';
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
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REASON_ADDITION_FEE_GET_TOTAL_TAB, $branch_id, $from, $to, $type, $key, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table['in_count'] = $this->numberFormat($config['data']['addition_fee_in']);
            $data_table['out_count'] = $this->numberFormat($config['data']['addition_fee_out']);
            $data_table['total_in_amount'] = $this->numberFormat($config['data']['total_amount']);
            $data_table['total_out_amount'] = $this->numberFormat($config['data']['total_amount']);
            $data_table['config_count'] = $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
        return json_encode($data_table);
    }
}
