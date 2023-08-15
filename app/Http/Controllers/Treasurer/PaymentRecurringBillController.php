<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class PaymentRecurringBillController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ADDITION_FEE_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Phiếu chi định kỳ';
        return view('treasurer.payment_recurring_bill.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $status = Config::get('constants.type.status.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_PAYMENT_RECURRING_BILL_GET_LIST, $branch, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $collection = collect($data);
            $data_enable = $collection->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all();
            $data_total_enable = $collection->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->count();
            $data_amount_enable = $collection->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->sum('amount');
            $data_disable = $collection->where('status', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->all();
            $data_total_disable = $collection->where('status', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->count();
            $data_amount_disable = $collection->where('status', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->sum('amount');
            $disable = TEXT_DISABLE_STATUS;
            $enable = TEXT_ENABLE;
            $update = TEXT_UPDATE;
            $data_table1 = DataTables::of($data_enable)
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('addition_fee_reason_name', function ($row) {
                    return (mb_strlen($row['addition_fee_reason_name']) > 30) ? mb_substr($row['addition_fee_reason_name'], 0, 27) . '...' : $row['addition_fee_reason_name'];
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('type', function ($row) {
                    switch ($row['cycle_repeats_type']) {
                        case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.DAILY'):
                            return 'Mỗi ' . $row['repeat_time'] . ' ' . TEXT_DAY;
                        case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.MONTHLY'):
                            return 'Mỗi ' . $row['repeat_time'] . ' ' . TEXT_MONTH;
                        case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.QUARTERLY'):
                            return 'Mỗi ' . $row['repeat_time'] . ' ' . TEXT_QUARTER;
                        default:
                            return 'Mỗi ' . $row['repeat_time'] . ' ' . TEXT_YEAR;
                    }
                })
                ->addColumn('note', function ($row) {
                    return $row['note'] !== '' ? ((mb_strlen($row['note'])) > 30 ? mb_substr($row['note'], 0, 25) . '...' : $row['note']) : '---';
                })
                ->addColumn('object_name', function ($row) {
                    return (mb_strlen($row['object_name']) > 30) ? mb_substr($row['object_name'], 0, 25) . '...' : $row['object_name'];
                })
                ->addColumn('action', function ($row) use ($disable, $update) {
                    return '<div class="btn-group btn-group-sm">
                          <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" data-status="' . $row['status'] . '" onclick="changeStatusPaymentRecurringBill($(this))"><i class="fi-rr-cross"></i></button>
                          <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" onclick="openModalUpdatePaymentRecurringBill($(this))"><i class="fi-rr-pencil"></i></button>
                          <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailPaymentRecurringBill($(this))" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                        </div>';
                })
                ->rawColumns(['action', 'note', 'object_name'])
                ->addIndexColumn()
                ->make(true);
            $data_table2 = DataTables::of($data_disable)
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('addition_fee_reason_name', function ($row) {
                    return (mb_strlen($row['addition_fee_reason_name']) > 30) ? mb_substr($row['addition_fee_reason_name'], 0, 27) . '...' : $row['addition_fee_reason_name'];
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('type', function ($row) {
                    switch ($row['cycle_repeats_type']) {
                        case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.DAILY'):
                            return 'Mỗi ' . $row['repeat_time'] . ' ' . TEXT_DAY;
                        case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.MONTHLY'):
                            return 'Mỗi ' . $row['repeat_time'] . ' ' . TEXT_MONTH;
                        case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.QUARTERLY'):
                            return 'Mỗi ' . $row['repeat_time'] . ' ' . TEXT_QUARTER;
                        default:
                            return 'Mỗi ' . $row['repeat_time'] . ' ' . TEXT_YEAR;
                    }
                })
                ->addColumn('note', function ($row) {
                    return $row['note'] !== '' ? ((mb_strlen($row['note'])) > 30 ? mb_substr($row['note'], 0, 25) . '...' : $row['note']) : '---';
                })
                ->addColumn('object_name', function ($row) {
                    return (mb_strlen($row['object_name']) > 30) ? mb_substr($row['object_name'], 0, 25) . '...' : $row['object_name'];
                })
                ->addColumn('action', function ($row) use ($enable, $update) {
                    return '<div class="btn-group btn-group-sm">
                          <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" data-status="' . $row['status'] . '" onclick="changeStatusPaymentRecurringBill($(this))"><i class="fi-rr-check"></i></button>
                          <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" onclick="openModalUpdatePaymentRecurringBill($(this))"><i class="fi-rr-pencil"></i></button>
                          <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailPaymentRecurringBill($(this))" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>

                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'note', 'object_name'])
                ->addIndexColumn()
                ->make(true);
            $data_total = [
                'total_record_tab1' => $this->numberFormat($data_total_enable),
                'total_record_tab2' => $this->numberFormat($data_total_disable),
                'total_tab1' => $this->numberFormat($data_amount_enable),
                'total_tab2' => $this->numberFormat($data_amount_disable),
            ];
            return [$data_table1, $data_table2, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function reason(Request $request)
    {
        $is_cost = Config::get('constants.type.checkbox.SELECTED');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $is_system_auto_generate = ENUM_GET_ALL;
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REASON_ADDITION_FEE_GET_REASON, $status, $is_cost,$is_system_auto_generate);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $collection = collect($data);
            $auto_generate = $collection->where('is_system_auto_generate', (int)Config::get('constants.type.checkbox.DIS_SELECTED'));
            $option = '<option value="" disabled selected >' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($auto_generate as $db) {
                $option .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
            if ($option === '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>') {
                $option = '<option value="' . Config::get('constants.type.id.NONE') . '">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $branch = $request->get('branch');
        $type = Config::get('constants.type.addition_fee.OUT');
        $payment_method_id = $request->get('payment_method_id');
        $addition_fee_reason_id = $request->get('addition_fee_reason_id');
        $object_id = '';
        $object_name = $request->get('target');
        $object_type = '5';
        $cycle_repeats_type = $request->get('type_recurring');
        $amount = $request->get('amount');
        $is_count_to_revenue = $request->get('is_count_to_revenue');
        $note = $request->get('note');
        $repeat_time = $request->get('recurring');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_PAYMENT_RECURRING_BILL_POST_CREATE);
        $body = [
            'branch_id' => $branch,
            "type" => $type,
            "payment_method_id" => $payment_method_id,
            "addition_fee_reason_id" => $addition_fee_reason_id,
            "object_id" => $object_id,
            "object_name" => $object_name,
            "object_type" => $object_type,
            "is_count_to_revenue" => $is_count_to_revenue,
            "cycle_repeats_type" => $cycle_repeats_type,
            "amount" => $amount,
            "note" => $note,
            "repeat_time" => $repeat_time,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            $config['data']['amount_format'] = $this->numberFormat($config['data']['amount']);
            switch ($config['data']['cycle_repeats_type']) {
                case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.DAILY'):
                    $config['data']['type'] = 'Mỗi ' . $config['data']['repeat_time'] . ' ' . TEXT_DAY;
                    break;
                case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.MONTHLY'):
                    $config['data']['type'] = 'Mỗi ' . $config['data']['repeat_time'] . ' ' . TEXT_MONTH;
                    break;
                case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.QUARTERLY'):
                    $config['data']['type'] = 'Mỗi ' . $config['data']['repeat_time'] . ' ' . TEXT_QUARTER;
                    break;
                case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.YEARLY'):
                    $config['data']['type'] = 'Mỗi ' . $config['data']['repeat_time'] . ' ' . TEXT_YEAR;
                    break;
//                default:
//                    $config['data']['type'] = 'Mỗi ' . $config['data']['repeat_time'] . ' ' . TEXT_YEAR;
            }
            if (mb_strlen($config['data']['note']) > 30) {
                $config['data']['note'] = mb_substr($config['data']['note'], 0, 25) . '...';
            }
            $disable = TEXT_DISABLE_STATUS;
            $update = TEXT_UPDATE;
            $config['data']['action'] = '<div class="btn-group btn-group-sm">
                          <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '" data-id="' . $config['data']['id'] . '" data-branch="' . $config['data']['branch_id'] . '" data-status="' . $config['data']['status'] . '" onclick="changeStatusPaymentRecurringBill($(this))"><i class="fi-rr-cross"></i></button><br>
                          <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-id="' . $config['data']['id'] . '" data-branch="' . $config['data']['branch_id'] . '" onclick="openModalUpdatePaymentRecurringBill($(this))"><i class="fi-rr-pencil"></i></button>
                          <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailPaymentRecurringBill($(this))" data-id="' . $config['data']['id'] . '" data-branch="' . $config['data']['branch_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                        </div>';
        }
        return $config;
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $branch_id = $request->get('branch');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_PAYMENT_RECURRING_BILL_GET_DETAIL, $id, $branch_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
//            $config1 = $config;
            $data_detail = $config['data'];
            $data_detail['amount'] = $this->numberFormat($data_detail['amount']);
//            $is_system_auto_generate = ENUM_GET_ALL;
//            $is_cost = Config::get('constants.type.checkbox.SELECTED');
//            $status = Config::get('constants.type.status.GET_ACTIVE');
//            $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
//            $method = Config::get('constants.GATEWAY.METHOD.GET');
//            $api = sprintf(API_REASON_ADDITION_FEE_GET_REASON, $status, $is_cost, $is_system_auto_generate);
//            $body = null;
//            $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
//            $data = $config['data'];
//            $collection = collect($data);
//            $auto_generate = $collection->where('is_system_auto_generate', (int)Config::get('constants.type.checkbox.DIS_SELECTED'));
//            $option = '<option value="" disabled selected >' . TEXT_DEFAULT_OPTION . '</option>';
//            foreach ($auto_generate as $db) {
//                $option .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
//            }
//            if ($option === '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>') {
//                $option = '<option value="' . Config::get('constants.type.id.NONE') . '">' . TEXT_NULL_OPTION . '</option>';
//            }
            return [$data_detail, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $branch = $request->get('branch');
        $id = $request->get('id');
        $type = Config::get('constants.type.addition_fee.OUT');
        $payment_method_id = $request->get('payment_method_id');
        $addition_fee_reason_id = $request->get('addition_fee_reason_id');
        $object_id = '0';
        $object_name = $request->get('target');
        $object_type = '5';
        $cycle_repeats_type = $request->get('type_recurring');
        $amount = $request->get('amount');
        $is_count_to_revenue = $request->get('is_count_to_revenue');
        $note = sprintf($request->get('note'));
        $repeat_time = $request->get('recurring');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_PAYMENT_RECURRING_BILL_POST_UPDATE, $id);
        $body = [
            'branch_id' => $branch,
            "type" => $type,
            "payment_method_id" => $payment_method_id,
            "addition_fee_reason_id" => $addition_fee_reason_id,
            "object_id" => $object_id,
            "object_name" => $object_name,
            "object_type" => $object_type,
            "is_count_to_revenue" => $is_count_to_revenue,
            "cycle_repeats_type" => $cycle_repeats_type,
            "amount" => $amount,
            "note" => $note,
            "repeat_time" => $repeat_time,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === 200){
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            $config['data']['amount_format'] = $this->numberFormat($config['data']['amount']);
            switch ($config['data']['cycle_repeats_type']) {
                case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.DAILY'):
                    $config['data']['type'] = 'Mỗi ' . $config['data']['repeat_time'] . ' ' . TEXT_DAY;
                    break;
                case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.MONTHLY'):
                    $config['data']['type'] = 'Mỗi ' . $config['data']['repeat_time'] . ' ' . TEXT_MONTH;
                    break;
                default:
                    $config['data']['type'] = 'Mỗi ' . $config['data']['repeat_time'] . ' ' . TEXT_YEAR;
            }
            if (mb_strlen($config['data']['note']) > 30) {
                $config['data']['note'] = mb_substr($config['data']['note'], 0, 25) . '...';
            }
        }
        return $config;
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $status = $request->get('status');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_PAYMENT_RECURRING_BILL_POST_CHANGE_STATUS, $id);
        $body = [
            "branch_id" => $branch,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');;
        $branch = $request->get('branch');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_PAYMENT_RECURRING_BILL_GET_DETAIL, $id, $branch);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        switch ($config['data']['cycle_repeats_type']) {
            case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.DAILY'):
                $config['data']['type'] = 'Mỗi ' . $config['data']['repeat_time'] . ' ' . TEXT_DAY;
                break;
            case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.MONTHLY'):
                $config['data']['type'] = 'Mỗi ' . $config['data']['repeat_time'] . ' ' . TEXT_MONTH;
                break;
            case (int)Config::get('constants.type.RecurringCostCircleRepeatTypeEnum.QUARTERLY'):
                $config['data']['type'] = 'Mỗi ' . $config['data']['repeat_time'] . ' ' . TEXT_QUARTER;
                break;
            default:
                $config['data']['type'] = 'Mỗi ' . $config['data']['repeat_time'] . ' ' . TEXT_YEAR;
        }
        $config['data']['repeat_time'] = 'Mỗi ' . $config['data']['repeat_time'] . ' ' . TEXT_MONTH;
        $config['data']['is_count_to_revenue'] = ($config['data']['is_count_to_revenue'] === Config::get('constants.type.checkbox.SELECTED')) ? 'Có hạch toán' : 'Không có hạch toán' ;
        return $config;
    }
}
