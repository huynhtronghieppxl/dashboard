<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ReceiptsBillController extends Controller
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
        $active_nav = 'Phiếu thu';
        return view('treasurer.receipts_bill.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $type = Config::get('constants.type.addition_fee.IN');
        $branch_id = $request->get('branch_id');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $from = $request->get('from');
        $to = $request->get('to');
        $is_count_to_revenue = $request->get('accounting');
        $object_type = $request->get('object_type');
        $addition_fee_reason_id = $request->get('reason_id');
        $addition_fee_reason_type_id =  $request->get('addition_fee_reason_type_id');
        $is_take_auto_generated = ENUM_STATUS_GET_ALL;
        $status = $request->get('status');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $key = $this->keySearch(($request->get('search'))['value']);
        $restaurant_budget_id = Config::get('constants.type.default.RESTAURANT_PERIOD');
        $order_session_id = Config::get('constants.type.addition_fee.GET_ALL');
        $limit = Config::get('constants.type.default.LIMIT_100');
        $employee_id = ENUM_STATUS_GET_ALL;
        $report_type = ENUM_STATUS_GET_ALL;
        $auto_generated_type = ENUM_GET_ALL;
        $payment_method_id = ENUM_GET_ALL;
        $object_id = ENUM_GET_ALL;
        $debt = ENUM_GET_ALL;
        $is_restaurant_budget_closed = ENUM_GET_ALL;
        $type_tab = $request->get('type_tab');
        $api = sprintf(API_REASON_ADDITION_FEE_GET_DATA, $restaurant_brand_id, $branch_id, $page, $restaurant_budget_id, $from, $to, $type, $is_take_auto_generated, $order_session_id, $employee_id, $limit, $report_type, $auto_generated_type, $object_type, $addition_fee_reason_id, $addition_fee_reason_type_id, $status, $is_count_to_revenue, $key, $payment_method_id, $object_id, $debt, $is_restaurant_budget_closed);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $tab = $request->get('type_tab');
        $api = sprintf(API_REASON_ADDITION_FEE_GET_TOTAL_RECEIPT, $branch_id, $tab, $key, $from, $to, $object_type, $object_id, $addition_fee_reason_id, $addition_fee_reason_type_id, $auto_generated_type, $is_count_to_revenue,$type_tab);
        $body = null;
        $requestTab = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTab]);
        try {
            $config = $configAll[0];
            $detail = TEXT_DETAIL;
            $update = TEXT_UPDATE;
            $per = in_array('EDIT_ADDITION_FEE_WHEN_COMPLETED', Session::get(SESSION_PERMISSION)) || in_array('OWNER', Session::get(SESSION_PERMISSION));
            for ($i = 0; $i < count($config['data']['list']); $i++) {
//                $date = date()
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['code'] = '<lable class="text">' . $config['data']['list'][$i]['code'] . '</lable>';
                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                $config['data']['list'][$i]['order'] = ($config['data']['list'][$i]['object_type'] === (int)Config::get('constants.type.AdditionFeeObjectTypeEnum.ORDER')) ? '#' . $config['data']['list'][$i]['object_id'] : '---';
                $config['data']['list'][$i]['fee_month'] = $this->convertDateTime(($config['data']['list'][$i]['is_automatically_generated'] === 1) ? $config['data']['list'][$i]['fee_month'] : substr($config['data']['list'][$i]['fee_month'], 0, 10));
                $config['data']['list'][$i]['note'] = $config['data']['list'][$i]['note'] === '' ? '---' : ((mb_strlen($config['data']['list'][$i]['note']) > 20) ? mb_substr($config['data']['list'][$i]['note'], 0, 17) . '...' : $config['data']['list'][$i]['note']);
                $config['data']['list'][$i]['employee']['name'] =  '<img onerror="imageDefaultOnLoadError($(this))" src="' . $config['data']['list'][$i]['employee']['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $config['data']['list'][$i]['employee']['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle"></i>' . $config['data']['list'][$i]['employee']['role_name'] . '</label>
                         </label>';
                if (mb_strlen($config['data']['list'][$i]['object_name']) > 20) $config['data']['list'][$i]['object_name'] = mb_substr($config['data']['list'][$i]['object_name'], 0, 17) . '...';
                if (mb_strlen($config['data']['list'][$i]['addition_fee_reason_name']) > 20) $config['data']['list'][$i]['addition_fee_reason_name'] = mb_substr($config['data']['list'][$i]['addition_fee_reason_name'], 0, 17) . '...';
                if ($config['data']['list'][$i]['is_count_to_revenue'] === ENUM_SELECTED) {
                    $config['data']['list'][$i]['code'] =  $config['data']['list'][$i]['code'] . '<br><div class="tag seemt-green seemt-bg-green d-flex" style="width: fit-content !important;">
                                                                                                            <i class="fi-rr-hastag"></i>
                                                                                                            <label class="m-0">Hạch toán</label>
                                                                                                        </div>';
                }
                if ($config['data']['list'][$i]['is_automatically_generated'] == ENUM_SELECTED || $config['data']['list'][$i]['is_restaurant_budget_closed'] == ENUM_SELECTED) {
                    $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">' . '
                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" onclick="openModalDetailReceiptsBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
                           </div>';
                } else {
                    $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">' . $this->buttonRemove($config['data']['list'][$i]['is_restaurant_budget_closed'], $per, $config['data']['list'][$i]['id'], $config['data']['list'][$i]['branch']['id']) . '
                            <button type="button" class="btn seemt-btn-hover-orange mx-1 waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" onclick="openModalUpdateReceiptsBill(' . $config['data']['list'][$i]['id'] . ')"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" onclick="openModalDetailReceiptsBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
                        </div>';
                }
                if ($config['data']['list'][$i]['addition_fee_status'] === Config::get('constants.type.AdditionFeeStatusEnum.CANCEL')) {
                    $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">
                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" onclick="openModalDetailReceiptsBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
                        </div>';
                }
                switch ($config['data']['list'][$i]['addition_fee_status']) {
                    case Config::get('constants.type.AdditionFeeStatusEnum.WAITING_PAYMENT'):
                        $config['data']['list'][$i]['status_text'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_PAYMENT_APPROVED . '</label>
                                                </div>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRMED'):
                        $config['data']['list'][$i]['status_text'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_SALARY_CONFIRMED . '</label>
                                                </div>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL'):
                        $config['data']['list'][$i]['status_text'] = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_CANCELED_ENUM . '</label>
                                                </div>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.PAID'):
                        $config['data']['list'][$i]['status_text'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_WAITING . '</label>
                                                </div>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL_PAYMENT'):
                        $config['data']['list'][$i]['status_text'] = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_CANCEL_PAYMENT . '</label>
                                                </div>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL_PAYMENT_REFUNDED'):
                        $config['data']['list'][$i]['status_text'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . Config::get('constants.TEXT_CANCEL_PAYMENT_REFUNDED') . '</label>
                                                </div>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRM_PAYMENT'):
                        $config['data']['list'][$i]['status_text'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_CONFIRMED_PAYMENT . '</label>
                                                </div>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.ORDER_PAYMENT'):
                        $config['data']['list'][$i]['status_text'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_SUPPLIER_PAID . '</label>
                                                </div>';
                        break;
                    default:
                        $config['data']['list'][$i]['status_text'] = '<div class="seemt-gray-w400 seemt-border-gray status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_SUPPLIER_PAID . '</label>
                                                </div>';
                }
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
            $config['data']['addition_fee_in'] = '';
            $data_table['user_count'] = $this->numberFormat($config['data']['addition_fee_in']);
            $data_table['cancel_count'] = $this->numberFormat($config['data']['addition_fee_in_cancel']);
            $data_table['total_amount'] = $this->numberFormat(array_sum(array_column($configAll[0]['data']['list'], 'amount')));
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function buttonRemove($check, $per, $id, $branch)
    {
        $cancel = TEXT_CANCELED_ENUM;
        if ($check === ENUM_DIS_SELECTED && $per === true) {
            return '<button type="button" class="btn seemt-btn-hover-red seemt-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $cancel . '" onclick="cancelReceiptsBill(' . $id . ', ' . $branch . ')" ><i class="fi-rr-trash"></i></button>';
        } else {
            return '';
        }
    }

    public function reason(Request $request)
    {
        $is_cost = ENUM_DIS_SELECTED;
        $is_system_auto_generate = ENUM_GET_ALL;
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_REASON, $status, $is_cost, $is_system_auto_generate);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $collection = collect($data);
            $auto_generate = $collection->where('is_system_auto_generate', ENUM_DIS_SELECTED);

            if (!empty($auto_generate)) {
                $option = '<option value="' . Config::get('constants.type.id.NONE') . '" disabled selected hidden >' . TEXT_DEFAULT_OPTION . '</option>';
                $option1 = '<option value="' . ENUM_GET_ALL . '" selected >Hạng mục thu</option>';
                foreach ($auto_generate as $db) {
                    $option .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                    $option1 .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                }
                if ($option === '<option value="' . Config::get('constants.type.id.NONE') . '" disabled selected hidden >' . TEXT_DEFAULT_OPTION . '</option>')
                    $option = '<option value="' . Config::get('constants.type.id.NONE') . '">' . TEXT_NULL_OPTION . '</option>';
                if ($option1 === '<option value="' . Config::get('constants.type.id.NONE') . '">' . TEXT_DEFAULT_OPTION . '</option>')
                    $option1 = '<option value="' . Config::get('constants.type.id.NONE') . '">' . TEXT_NULL_OPTION . '</option>';
            } else {
                $option = '<option value="' . Config::get('constants.type.id.NONE') . '">' . TEXT_NULL_OPTION . '</option>';
                $option1 = '<option value="' . Config::get('constants.type.id.NONE') . '">' . TEXT_NULL_OPTION . '</option>';
            }
            $option_all = '<option data-type-id="'. ENUM_GET_ALL .'" value="' . ENUM_GET_ALL . '" selected >Hạng mục thu</option>';
            foreach ($data as $db) {
                $option_all .= '<option data-auto-generate="'. $db['is_system_auto_generate'] .'" data-type-id="'. $db['addition_fee_reason_type_id'] .'" value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
            return [$option, $config, $option1, $option_all];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function supplier(Request $request)
    {
        $branch_id = ENUM_GET_ALL;
        $status = ENUM_STATUS_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_GET_DATA, $status, $branch_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $option = '';
            if(count($data) === ENUM_DIS_SELECTED){
                $option = '<option value="' . Config::get('constants.type.id.NONE') . '" selected disabled>' . TEXT_NULL_OPTION . '</option>';
            }else{
                for ($i = 0; $i < count($data); $i++) {
                    $option .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function getVAT(Request $request)
    {
        $id = $request->get('bill_id');
        $branch_id = $request->get('branch');
        $food_status = ENUM_DIS_SELECTED;
        $is_print_bill = ENUM_DIS_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_ADDITION_FEE_REASON_GET_VAT_CALCULATE, $id, $branch_id, $food_status, $is_print_bill);
        $body = [];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function getListBill(Request $request) {
        $restaurant_brand_id = $request->get('brand');
        $branch_id = $request->get('branch_id');
        $limit = ENUM_DEFAULT_LIMIT_1000;
        $page = ENUM_DEFAULT_PAGE;
        $order_status = ENUM_ID_NONE;
        $area_id = ENUM_ID_NONE;
        $order_id = ENUM_ID_NONE;
        $table_ids = ENUM_ID_NONE;
        $from = ENUM_ID_NONE;
        $to = ENUM_ID_NONE;
        $is_apply_vat = ENUM_DIS_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_ADDITION_FEE_REASON_LIST_ORDER_GET, $restaurant_brand_id, $branch_id, $limit, $page, $order_status, $area_id, $order_id, $table_ids, $from, $to, $is_apply_vat);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $datatable = DataTables::of($data)
                ->addColumn('checkbox', function ($row) {
                    return '<div class="d-flex justify-content-center"><div class="form-validate-checkbox mt-2">
                            <div class="checkbox-form-group">
                                <input name="print-kitchen-create-food-brand-manage" type="checkbox">
                                <label class="name-checkbox"
                                       for="print-kitchen-create-food-brand-manage">
                                </label>
                            </div>
                        </div></div>';
                })
                ->addColumn('customer_phone', function ($row) {
                    return $row['customer']['phone'] = $row['customer']['phone'] == '' ? '---' : $row['customer']['phone'];
                })
                ->addColumn('payment_date', function ($row) {
                   return $this->convertDateTime($row['payment_date']);
                })
                ->addColumn('customer_name', function ($row) {
                    if($row['customer']['name'] == ''){
                        return $row['customer']['name'] = '---';
                    }else{
                        return (mb_strlen($row['customer']['name']) > 30) ? $row['customer']['name'] = mb_substr($row['customer']['name'], 0, 27) . '...' : $row['customer']['name'];
                    }
                })
                ->addColumn('vat_amount', function ($row) {
                    return $this->numberFormat($row['vat_amount']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-is-print="1" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" data-id="'. $row['id'] .'" data-cancel="0" onclick="openBillDetail($(this))"><i class="fi-rr-eye"></i></button></div>';
                })
                ->addIndexColumn()
                ->rawColumns(['checkbox', 'customer_phone', 'customer_name', 'action', 'payment_date'])
                ->make(true);
            return [$datatable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function employee(Request $request)
    {
        $branch = $request->get('branch');
//        $brand_id = $request->get('restaurant_brand_id');
        $status = Config::get('constants.type.status.GET_ACTIVE');
//        $is_include_restaurant_manager = Config::get('constants.type.data.DEFAULT');
//        $is_take_myself = Config::get('constants.type.data.DEFAULT');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_EMPLOYEE_V2, $branch, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $option = '';
            for ($i = 0; $i < count($data); $i++) {
                $option .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
            }
            if ($option === '<option value="' . Config::get('constants.type.id.NONE') . '">' . TEXT_DEFAULT_OPTION . '</option>') {
                $option = '<option value="' . Config::get('constants.type.id.NONE') . '">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function customer(Request $request)
    {
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_CUSTOMERS_GET, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $option = '';
            for ($i = 0; $i < count($data); $i++) {
                $option .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
            }
            if ($option === '<option value="' . Config::get('constants.type.id.NONE') . '">' . TEXT_DEFAULT_OPTION . '</option>') {
                $option = '<option value="' . Config::get('constants.type.id.NONE') . '">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$option, $config];

        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function create(Request $request)
    {
        $type = Config::get('constants.type.addition_fee.IN');
        $id = Config::get('constants.type.id.DEFAULT');
        $branch_id = $request->get('branch');
        $addition_fee_reason_id = $request->get('addition_fee_reason_id');
        $amount = $request->get('amount');
        $date = $request->get('date') . ' ' . date('h:i:s');
        $is_count_to_revenue = $request->get('is_count_to_revenue');
        $note = $request->get('note');
        $object_id = $request->get('object_id');
        $object_name = $request->get('object_name');
        $object_type = $request->get('object_type');
        $payment_method_id = $request->get('payment_method_id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = API_REASON_ADDITION_FEE_POST_CREATE;
        $body = [
            'branch_id' => $branch_id,
            "addition_fee_reason_id" => $addition_fee_reason_id,
            "id" => $id,
            "amount" => $amount,
            "date" => $date,
            "is_count_to_revenue" => $is_count_to_revenue,
            "note" => $note,
            "object_id" => $object_id,
            "object_name" => $object_name,
            "object_type" => $object_type,
            "payment_method_id" => $payment_method_id,
            "type" => $type,
            "supplier_order_ids" => [],
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $branch_id = $request->get('branch');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_DETAIL, $id, $branch_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data['is_automatically_generated_name'] = ($data['is_automatically_generated'] === ENUM_SELECTED) ? 'Phiếu thu tự động' : 'Phiếu thu';
            $data['is_count_to_revenue_name'] = ($data['is_count_to_revenue'] === ENUM_SELECTED) ? 'Hạch toán' : 'Không Hạch toán';
            $data['employee']['avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $data['employee']['avatar'];
            $data['employee_confirm']['avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $data['employee_confirm']['avatar'];
            $data['employee_edit']['avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $data['employee_edit']['avatar'];
            $data['fee_month'] = ($data['is_automatically_generated'] === 1) ? $data['fee_month'] : substr($data['fee_month'], 0, 10);
            $data['created_at'] = ($data['is_automatically_generated'] === 1) ? $data['created_at'] : substr($data['created_at'], 0, 10);
            $data['updated_at'] = ($data['is_automatically_generated'] === 1) ? $data['updated_at'] : substr($data['updated_at'], 0, 10);
            switch ($data['addition_fee_status']) {
                case Config::get('constants.type.AdditionFeeStatusEnum.WAITING_PAYMENT'):
                    $status = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_PAYMENT_APPROVED . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRMED'):
                    $status = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_SALARY_CONFIRMED . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL'):
                    $status = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_CANCELED_ENUM . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.PAID'):
                    $status = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_WAITING . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL_PAYMENT'):
                    $status = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_CANCEL_PAYMENT . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL_PAYMENT_REFUNDED'):
                    $status = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . Config::get('constants.TEXT_CANCEL_PAYMENT_REFUNDED') . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRM_PAYMENT'):
                    $status = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_CONFIRMED_PAYMENT . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.ORDER_PAYMENT'):
                    $status = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_SUPPLIER_PAID . '</label>
                                </div>';
                    break;
                default:
                    $status = '<div class="seemt-gray-w400 seemt-border-gray status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_OTHER . '</label>
                                </div>';
            }
            switch ($data['object_type']) {
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.SUPPLIER'):
                    $data['object_type_text'] = TEXT_SUPPLIER;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.EMPLOYEE'):
                    $data['object_type_text'] = TEXT_EMPLOYEE;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.CUSTOMER'):
                    $data['object_type_text'] = TEXT_CUSTOMER;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.ORDER'):
                    $data['object_type_text'] = TEXT_RECEIPT_BILL;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.OTHER'):
                    $data['object_type_text'] = TEXT_OTHER;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.BOOKING'):
                    $data['object_type_text'] = TEXT_BOOKING;
                    break;
                default:
                    $data['object_type_text'] = TEXT_OTHER;
            }
            $data['status'] = $status;
            return [$data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $branch_id = $request->get('branch');
        $api = sprintf(API_REASON_ADDITION_FEE_GET_DETAIL, $id, $branch_id);
        $body = null;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
//        $requestDetail = [
//            'project' => ENUM_PROJECT_ID_ORDER,
//            'method' => ENUM_METHOD_GET,
//            'api' => $api,
//            'body' => $body,
//        ];
//        $is_cost = ENUM_DIS_SELECTED;
//        $status = Config::get('constants.type.status.GET_ACTIVE');
//        $is_system_auto_generate = ENUM_DIS_SELECTED;
//        $api = sprintf(API_REASON_ADDITION_FEE_GET_REASON, $status, $is_cost, $is_system_auto_generate);
//        $body = null;
//        $requestReason = [
//            'project' => ENUM_PROJECT_ID_ORDER,
//            'method' => ENUM_METHOD_GET,
//            'api' => $api,
//            'body' => $body,
//        ];
//        $configAll = $this->callApiMultiGatewayTemplate2([$requestDetail, $requestReason]);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data['employee']['avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $data['employee']['avatar'];
            $data['employee_confirm']['avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $data['employee_confirm']['avatar'];
            $data['employee_edit']['avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $data['employee_edit']['avatar'];
            switch ($data['payment_method_id']) {
                case Config::get('constants.type.PaymentMethodEnum.CASH'):
                    $data['payment_method'] = TEXT_CASH;
                    break;
                case Config::get('constants.type.PaymentMethodEnum.BANK'):
                    $data['payment_method'] = TEXT_BANK;
                    break;
                case Config::get('constants.type.PaymentMethodEnum.TRANSFER'):
                    $data['payment_method'] = TEXT_TRANSFER;
                    break;
                default:
                    $data['payment_method'] = '';
            }
            switch ($data['addition_fee_status']) {
                case Config::get('constants.type.AdditionFeeStatusEnum.WAITING_PAYMENT'):
                    $status = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_PAYMENT_APPROVED . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRMED'):
                    $status = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_SALARY_CONFIRMED . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL'):
                    $status = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_CANCELED_ENUM . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.PAID'):
                    $status = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_WAITING . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL_PAYMENT'):
                    $status = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_CANCEL_PAYMENT . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL_PAYMENT_REFUNDED'):
                    $status = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . Config::get('constants.TEXT_CANCEL_PAYMENT_REFUNDED') . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRM_PAYMENT'):
                    $status = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_CONFIRMED_PAYMENT . '</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.ORDER_PAYMENT'):
                    $status = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_SUPPLIER_PAID . '</label>
                                </div>';
                    break;
                default:
                    $status = '<div class="seemt-gray-w400 seemt-border-gray status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_SUPPLIER_PAID . '</label>
                                </div>';
            }
            switch ($data['object_type']) {
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.SUPPLIER'):
                    $data['object_type_text'] = TEXT_SUPPLIER;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.EMPLOYEE'):
                    $data['object_type_text'] = TEXT_EMPLOYEE;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.CUSTOMER'):
                    $data['object_type_text'] = TEXT_CUSTOMER;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.ORDER'):
                    $data['object_type_text'] = TEXT_RECEIPT_BILL;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.OTHER'):
                    $data['object_type_text'] = TEXT_OTHER;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.BOOKING'):
                    $data['object_type_text'] = TEXT_BOOKING;
                    break;
                default:
                    $data['object_type_text'] = TEXT_OTHER;
            }
            $data['status'] = $status;
            $data['amount'] = $this->numberFormat($data['amount']);
//            $data_reason = $configAll[1]['data'];
//            if (!empty($data_reason)) {
//                $option = '<option value="" disabled selected >' . TEXT_DEFAULT_OPTION . '</option>';
//                for ($i = 0; $i < count($data_reason); $i++) {
//                    if($data_reason[$i]['is_system_auto_generate'] === 0){
//                        if ($data_reason[$i]['id'] === $data['addition_fee_reason_id']  ) {
//                            $option .= '<option value="' . $data_reason[$i]['id'] . '" selected>' . $data_reason[$i]['name'] . '</option>';
//                        } else {
//                            $option .= '<option value="' . $data_reason[$i]['id'] . '">' . $data_reason[$i]['name'] . '</option>';
//                        }}
//                }
//                if ($option === '<option value="" disabled selected >' . TEXT_DEFAULT_OPTION . '</option>')
//                    $option = '<option value="" disabled selected >' . TEXT_NULL_OPTION . '</option>';
//            } else {
//                $option = '<option value="' . Config::get('constants.type.id.NONE') . '">' . TEXT_NULL_OPTION . '</option>';
//            }
            return [$data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $addition_fee_reason_id = $request->get('addition_fee_reason_id');
        $date = $request->get('date');
        $note = $request->get('note');
        $object_name = $request->get('object_name');
        $object_type = $request->get('object_type');
        $amount = $request->get('amount');
        $is_count_to_revenue = $request->get('is_count_to_revenue');
        $payment_method_id = $request->get('payment_method_id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_REASON_ADDITION_FEE_POST_UPDATE, $id);
        $body = [
            "branch_id" => $branch,
            "id" => $id,
            "addition_fee_reason_id" => $addition_fee_reason_id,
            "date" => $date,
            "note" => $note,
            "is_count_to_revenue" => $is_count_to_revenue,
            "object_name" => $object_name,
            "amount" => $amount,
            "payment_method_id" => $payment_method_id,
            "object_type" => $object_type
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function cancel(Request $request)
    {
        $id = $request->get('id');
        $status = Config::get('constants.type.AdditionFeeStatusEnum.CANCEL');
        $reason = $request->get('reason');
        $branch_id = $request->get('branch');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_REASON_ADDITION_FEE_POST_CHANGE_STATUS, $id);
        $body = [
            'branch_id' => $branch_id,
            'addition_fee_status' => $status,
            'cancel_reason' => $reason
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
