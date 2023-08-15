<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class WorkHistoryController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ADDITION_FEE_MANAGER']);
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
        $active_nav = 'Chốt ca thu ngân';
        return view('treasurer.work_history.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $from = $request->get('from');
        $to = $request->get('to');
        $page = ENUM_DEFAULT_PAGE;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_WORK_HISTORY_GET_LIST, $branch, $from, $to, $page);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        if ($config['status'] !== ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $config['data']['list'] = [];
        }
        try {
            $dataTable = Datatables::of($config['data']['list'])
                ->addColumn('close_employee_name', function ($row) {
                    if ($row['close_employee_name'] == '0') {
                        return '---';
                    } else {
                        return $this->numberFormat($row['close_employee_name']);
                    }
                })
                ->addColumn('close_time', function ($row) {
                    if ($row['close_time'] == '') {
                        return '---';
                    } else {
                        return $this->numberFormat($row['close_time']);
                    }
                })
                ->addColumn('id', function ($row) {
                    return '#' . $row['id'];
                })
                ->addColumn('open_time', function ($row) {
                    return $this->convertDateTime($row['open_time']);
                })
                ->addColumn('close_time', function ($row) {
                    return $this->convertDateTime($row['close_time']);
                })
                ->addColumn('before_cash', function ($row) {
                    return $this->numberFormat($row['before_cash']);
                })
                ->addColumn('number_orders', function ($row) {
                    return $this->numberFormat($row['number_orders']);
                })
                ->addColumn('total_receipt_amount_final', function ($row) {
                    return $this->numberFormat($row['total_receipt_amount_final']);
                })
                ->addColumn('total_cost_final', function ($row) {
                    return $this->numberFormat($row['total_cost_final']);
                })
                ->addColumn('after_cash', function ($row) {
                    return $this->numberFormat($row['after_cash']);
                })
                ->addColumn('cash_amount', function ($row) {
                    return $this->numberFormat($row['cash_amount']);
                })
                ->addColumn('real_amount', function ($row) {
                    return $this->numberFormat($row['real_amount']);
                })
                ->addColumn('revenue', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('difference_amount', function ($row) {
                    return $this->numberFormat($row['real_amount'] - $row['total_receipt_amount_final']);
                })
                ->addColumn('action', function ($row) {
                    $detail = TEXT_DETAIL;
                    return '<div class="btn-group btn-group-sm">
                       <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" onclick="openModalDetailWorkHistory(' . $row['id'] . ')" ><i class="fi-rr-eye"></i></button></div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'id','open_time','close_time'])
                ->make(true);
            $dataTotal = [
                'total_orders' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'number_orders'))),
                'total_before_cash' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'before_cash'))),
                'total_receipt_amount_final' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_receipt_amount_final'))),
                'total_cost_final' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_cost_final'))),
                'total_after_cash' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'after_cash'))),
                'total_real_amount' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'real_amount'))),
                'total_difference_amount' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'real_amount')) - array_sum(array_column($config['data']['list'], 'total_receipt_amount_final'))),
                'total_amount' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_amount'))  )
            ];
            return [$dataTable, $config, $dataTotal];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $branch = $request->get('branch');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_WORK_HISTORY_GET_DETAIL, $id, $branch);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $config['data']['difference_amount'] = $config['data']['real_amount'] - $config['data']['total_receipt_amount_final'];
            $dataTable = Datatables::of($config['data']['cash_value'])
                ->addColumn('value', function ($row) {
                    return $this->numberFormat($row['value']);
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('amount', function ($row) {
                    return '<label class="text-warning">' . $this->numberFormat($row['value'] * $row['quantity']) . '</label>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['amount'])
                ->addIndexColumn()
                ->make(true);
            return [$config['data'], $dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function revenueDetail(Request $request)
    {
        $id = $request->get('id');
        $paymentType = -1;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_WORK_HISTORY_GET_REVENUE_DETAIL, $id, $paymentType);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $cash = $collection->where('cash_amount', '!=', 0)->toArray();
            $bank = $collection->where('bank_amount', '!=', 0)->toArray();
            $transfer = $collection->where('transfer_amount', '!=', 0)->toArray();
            $point = $collection->where('membership_point_used_amount', '!=', 0)->toArray();
            $other = $collection->where('cash_amount', 0)->where('bank_amount', 0)->where('transfer_amount', 0)->where('membership_point_used_amount', 0)->toArray();
            $totalCash = $collection->where('cash_amount', '!=', 0)->sum('cash_amount');
            $totalBank = $collection->where('bank_amount', '!=', 0)->sum('bank_amount');
            $totalTransfer = $collection->where('transfer_amount', '!=', 0)->sum('transfer_amount');
            $totalPoint = $collection->where('membership_point_used_amount', '!=', 0)->sum('membership_point_used_amount');
            $totalOther = $collection->where('cash_amount', 0)->where('bank_amount', 0)->where('transfer_amount', 0)->where('membership_point_used_amount', 0)->sum('total_amount');
            $dataTableCash = $this->drawTableRevenueDetail($cash);
            $dataTableBank = $this->drawTableRevenueDetail($bank);
            $dataTableTransfer = $this->drawTableRevenueDetail($transfer);
            $dataTablePoint = $this->drawTableRevenueDetail($point);
            $dataTableUnknow = $this->drawTableRevenueDetail($other);
            $dataTotal = [
                'total_record_cash' => $this->numberFormat(count($cash)),
                'total_record_bank' => $this->numberFormat(count($bank)),
                'total_record_transfer' => $this->numberFormat(count($transfer)),
                'total_record_point' => $this->numberFormat(count($point)),
                'total_record_unknow' => $this->numberFormat(count($other)),
                'total_cash' => $this->numberFormat($totalCash),
                'total_bank' => $this->numberFormat($totalBank),
                'total_transfer' => $this->numberFormat($totalTransfer),
                'total_point' => $this->numberFormat($totalPoint),
                'total_unknow' => $this->numberFormat($totalOther),
            ];
            return [$dataTableCash, $dataTableBank, $dataTableTransfer, $dataTablePoint, $dataTableUnknow, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTableRevenueDetail($data)
    {
        return Datatables::of($data)
            ->addColumn('total_amount', function ($row) {
                return $this->numberFormat($row['total_amount']);
            })
            ->addColumn('cash_amount', function ($row) {
                return $this->numberFormat($row['cash_amount']);
            })
            ->addColumn('bank_amount', function ($row) {
                return $this->numberFormat($row['bank_amount']);
            })
            ->addColumn('transfer_amount', function ($row) {
                return $this->numberFormat($row['transfer_amount']);
            })
            ->addColumn('membership_point_used_amount', function ($row) {
                return $this->numberFormat($row['membership_point_used_amount']);
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('action', function ($row) {
                $detail = TEXT_DETAIL;
                return '<div class="btn-group btn-group-sm">
                       <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-is-print="1" data-id="' . $row['id'] . '" data-cancel="0" onclick="openBillDetail($(this))" data-toggle="tooltip" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button></div>';
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function paymentDetail(Request $request)
    {
        $restaurant_brands_id = $request->get('restaurant_brands_id');
        $type = Config::get('constants.type.addition_fee.OUT');
        $branch_id = $request->get('branch');
        $from = Config::get('constants.type.date.NONE');
        $to = Config::get('constants.type.date.NONE');
        $is_count_to_revenue = ENUM_GET_ALL;
        $object_type = ENUM_ID_NONE;
        $addition_fee_reason_id = ENUM_GET_ALL;
        $addition_fee_reason_type_id = ENUM_GET_ALL;
        $is_take_auto_generated = ENUM_GET_ALL;
        $status = ENUM_ID_NONE;
        $page = ENUM_DEFAULT_PAGE;
        $restaurant_budget_id = Config::get('constants.type.default.RESTAURANT_PERIOD');
        $order_session_id = $request->get('id');
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $employee_id = ENUM_GET_ALL;
        $report_type = ENUM_GET_ALL;
        $auto_generated_type = ENUM_GET_ALL;
        $key = '';
        $payment_method_id = ENUM_GET_ALL;
        $object_id = ENUM_GET_ALL;
        $debt = ENUM_GET_ALL;
        $is_restaurant_budget_closed = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_WORK_HISTORY_ADDITION_FEE_GET_DATA, $restaurant_brands_id , $branch_id , $page, $restaurant_brands_id, $type , $is_count_to_revenue, $is_take_auto_generated , $order_session_id, $employee_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $cash = $collection->where('payment_method_id', Config::get('constants.type.PaymentMethodEnum.CASH'))->where('addition_fee_reason_type_id', '!=',23)->toArray();
            $transfer = $collection->where('payment_method_id', Config::get('constants.type.PaymentMethodEnum.TRANSFER'))->toArray();
            $totalCash = $collection->where('payment_method_id', Config::get('constants.type.PaymentMethodEnum.CASH'))->where('addition_fee_reason_type_id', '!=',23)->sum('amount');
            $totalTransfer = $collection->where('payment_method_id', Config::get('constants.type.PaymentMethodEnum.TRANSFER'))->sum('amount');
            $generated_type = collect($collection->whereIn('automatically_generated_type', [0, 6, 10])->toArray());
            $array = $generated_type->toArray();
            $tableCash = $this->drawTablePaymentDetail($cash);
            $tableTransfer = $this->drawTablePaymentDetail($transfer);
            $total = [
                'total_record_cash' => $this->numberFormat(count($cash)),
                'total_record_transfer' => $this->numberFormat(count($transfer)),
                'total_amount_transfer' => $this->numberFormat($totalTransfer),
                'total_amount' => $this->numberFormat($totalCash),
            ];
            return [$tableCash, $tableTransfer, $total, $generated_type, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTablePaymentDetail($data)
    {
        $detail = TEXT_DETAIL;
        return Datatables::of($data)
            ->addColumn('amount', function ($row) {
                return $this->numberFormat($row['amount']);
            })
            ->addColumn('action', function ($row) use ($detail) {
                return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailPaymentBill(' . $row['id'] . ', ' . $row['branch']['id'] . ')" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                        </div>';
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function receiptDetail(Request $request)
    {
        $type = Config::get('constants.type.addition_fee.IN');
        $branch_id = $request->get('branch');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $from = Config::get('constants.type.date.NONE');
        $to = Config::get('constants.type.date.NONE');
        $is_count_to_revenue = ENUM_GET_ALL;
        $object_type = ENUM_ID_NONE;
        $addition_fee_reason_id = ENUM_GET_ALL;
        $addition_fee_reason_type_id = ENUM_GET_ALL;
        $is_take_auto_generated = ENUM_DIS_SELECTED;
        $status = ENUM_ID_NONE;
        $page = ENUM_DEFAULT_PAGE;
        $restaurant_budget_id = Config::get('constants.type.default.RESTAURANT_PERIOD');
        $order_session_id = $request->get('id');
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $employee_id = ENUM_GET_ALL;
        $report_type = ENUM_GET_ALL;
        $auto_generated_type = ENUM_GET_ALL;
        $key = '';
        $payment_method_id = ENUM_GET_ALL;
        $object_id = ENUM_GET_ALL;
        $debt = ENUM_GET_ALL;
        $is_restaurant_budget_closed = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_DATA, $restaurant_brand_id, $branch_id, $page, $restaurant_budget_id, $from, $to, $type, $is_take_auto_generated, $order_session_id, $employee_id, $limit, $report_type, $auto_generated_type, $object_type, $addition_fee_reason_id, $addition_fee_reason_type_id, $status, $is_count_to_revenue, $key, $payment_method_id, $object_id, $debt, $is_restaurant_budget_closed);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $cash = $collection->where('payment_method_id', Config::get('constants.type.PaymentMethodEnum.CASH'))->toArray();
            $bank = $collection->where('payment_method_id', Config::get('constants.type.PaymentMethodEnum.BANK'))->toArray();
            $transfer = $collection->where('payment_method_id', Config::get('constants.type.PaymentMethodEnum.TRANSFER'))->toArray();
            $totalCash = $collection->where('payment_method_id', Config::get('constants.type.PaymentMethodEnum.CASH'))->sum('amount');
            $totalBank = $collection->where('payment_method_id', Config::get('constants.type.PaymentMethodEnum.BANK'))->sum('amount');
            $totalTransfer = $collection->where('payment_method_id', Config::get('constants.type.PaymentMethodEnum.TRANSFER'))->sum('amount');
            $tableCash = $this->drawTableReceiptDetail($cash);
            $tableBank = $this->drawTableReceiptDetail($bank);
            $tableTransfer = $this->drawTableReceiptDetail($transfer);
            $total = [
                'total_record_cash' => $this->numberFormat(count($cash)),
                'total_record_bank' => $this->numberFormat(count($bank)),
                'total_record_transfer' => $this->numberFormat(count($transfer)),
                'total_amount_cash' => $this->numberFormat($totalCash),
                'total_amount_bank' => $this->numberFormat($totalBank),
                'total_amount_transfer' => $this->numberFormat($totalTransfer),
            ];
            return [$tableCash, $tableBank, $tableTransfer, $total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTableReceiptDetail($data)
    {
        $detail = TEXT_DETAIL;
        return Datatables::of($data)
            ->addColumn('amount', function ($row) {
                return $this->numberFormat($row['amount']);
            })
            ->addColumn('action', function ($row) use ($detail) {
                return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailReceiptsBill(' . $row['id'] . ', ' . $row['branch']['id'] . ')" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                        </div>';
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function depositDetail(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_WORK_HISTORY_GET_DEPOSIT_DETAIL, $id, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data_cash = [];
            $data_bank = [];
            $data_transfer = [];
            $total_cash = 0;
            $total_bank = 0;
            $total_transfer = 0;
            $a = 0;
            $b = 0;
            $c = 0;
            for ($i = 0; $i < count($data); $i++) {
                switch ($data[$i]['payment_method']) {
                    case (int)Config::get('constants.type.PaymentMethodEnum.CASH'):
                        $data_cash[$a] = $data[$i];
                        $total_cash += $data[$i]['amount'];
                        $a++;
                        break;
                    case (int)Config::get('constants.type.PaymentMethodEnum.BANK'):
                        $data_bank[$b] = $data[$i];
                        $total_bank += $data[$i]['amount'];
                        $b++;
                        break;
                    case (int)Config::get('constants.type.PaymentMethodEnum.TRANSFER'):
                        $data_transfer[$c] = $data[$i];
                        $total_transfer += $data[$i]['amount'];
                        $c++;
                        break;
                }
            }
            if ($type == 1) {
                $dataTableCash = $this->drawTableDepositDetail($data_cash);
                $dataTableBank = $this->drawTableDepositDetail($data_bank);
                $dataTableTransfer = $this->drawTableDepositDetail($data_transfer);
                $dataTotal = [
                    'total_record_cash' => $this->numberFormat($a),
                    'total_record_bank' => $this->numberFormat($b),
                    'total_record_transfer' => $this->numberFormat($c),
                    'total_cash' => $this->numberFormat($total_cash),
                    'total_bank' => $this->numberFormat($total_bank),
                    'total_transfer' => $this->numberFormat($total_transfer),
                ];
                return [$dataTableCash, $dataTableBank, $dataTableTransfer, $dataTotal, $config];
            } else {
                $dataTableCash = $this->drawTableDepositDetail($data_cash);
                $dataTableTransfer = $this->drawTableDepositDetail($data_transfer);
                $dataTotal = [
                    'total_record_cash' => $this->numberFormat($a),
                    'total_record_transfer' => $this->numberFormat($c),
                    'total_cash' => $this->numberFormat($total_cash),
                    'total_transfer' => $this->numberFormat($total_transfer),
                ];
                return [$dataTableCash, $dataTableTransfer, $dataTotal, $config];
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTableDepositDetail($data)
    {
        return Datatables::of($data)
            ->addColumn('amount', function ($row) {
                return $this->numberFormat($row['amount']);
            })
            ->addIndexColumn()
            ->make(true);
    }
}
