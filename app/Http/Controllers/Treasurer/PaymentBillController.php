<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PaymentBillController extends Controller
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
        $active_nav = 'Phiếu chi';
        return view('treasurer.payment_bill.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $type = Config::get('constants.type.addition_fee.OUT');
        $branch_id = $request->get('branch_id');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $from = $request->get('from');
        $to = $request->get('to');
        $is_count_to_revenue = $request->get('accounting');
        $object_type = ENUM_GET_ALL ;
        $addition_fee_reason_id = $request->get('reason_id');
        $addition_fee_reason_type_id =  $request->get('addition_fee_reason_type_id');
        $is_take_auto_generated = Config::get('constants.type.addition_fee.GET_ALL');
        $status = $request->get('type');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $restaurant_budget_id = Config::    get('constants.type.default.RESTAURANT_PERIOD');
        $order_session_id = Config::get('constants.type.addition_fee.GET_ALL');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $employee_id = ENUM_STATUS_GET_ALL;
        $report_type = ENUM_STATUS_GET_ALL;
        $auto_generated_type = ENUM_STATUS_GET_ALL;
        $key = $this->keySearch(($request->get('search'))['value']);
        $payment_method_id = ENUM_GET_ALL;
        $object_id = ENUM_GET_ALL;
        $is_paid_debt = ENUM_GET_ALL;
        $is_restaurant_budget_closed = Config::get('constants.type.AdditionFeeStatusEnum.GET_ALL');
        $api = sprintf(API_REASON_ADDITION_FEE_GET_DATA, $restaurant_brand_id, $branch_id, $page, $restaurant_budget_id, $from, $to, $type, $is_take_auto_generated, $order_session_id, $employee_id, $limit, $report_type, $auto_generated_type, $object_type, $addition_fee_reason_id, $addition_fee_reason_type_id, $status, $is_count_to_revenue, $key, $payment_method_id, $object_id, $is_paid_debt, $is_restaurant_budget_closed);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $tab = $request->get('type_tab');
        $api = sprintf(API_REASON_ADDITION_FEE_GET_TOTAL_PAYMENT, $branch_id, $tab, $key, $from, $to, $object_type, $object_id, $addition_fee_reason_id, $addition_fee_reason_type_id, $is_count_to_revenue, $is_paid_debt);
        $requestTab = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTab]);

        try {
            $config = $configAll[0];
            $per = in_array('EDIT_ADDITION_FEE_WHEN_COMPLETED', Session::get(SESSION_PERMISSION)) || in_array('OWNER', Session::get(SESSION_PERMISSION));
            switch ($status) {
                case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRM_PAYMENT'): // chờ duyệt chi
                    for ($i = 0; $i < count($config['data']['list']); $i++) {
                        $config['data']['list'][$i] = $this->convertData($i, $page, $limit, $config['data']['list'][$i]);
//                        $config['data']['list'][$i]['action'] = '<div class="checkbox-fade fade-in-primary mr-0 check-confirm-payment-bill d-none">
//                                 <label><input type="checkbox" value="' . $config['data']['list'][$i]['id'] . '" data-branch="' . $config['data']['list'][$i]['branch']['id'] . '" onclick="checkWaitingConfirmPaymentBill($(this))"/><span class="cr mr-0"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span></label>
//                                </div>
                        $config['data']['list'][$i]['action'] = '<div class="d-flex align-items-center justify-content-center">
                                <div class="btn-group btn-group-sm float-right btn-event-payment-bill" style="margin-right: 8px">' . $this->buttonRemove($config['data']['list'][$i]['is_restaurant_budget_closed'], true, $config['data']['list'][$i]['id'], $config['data']['list'][$i]['branch']['id'], $config['data']['list'][$i]['is_automatically_generated']) . '
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green seemt-bg-green seemt-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONFIRM_PAYMENT . '" onclick="confirmPaymentPaymentBill($(this))" data-id="' . $config['data']['list'][$i]['id'] . '" data-branch="' . $config['data']['list'][$i]['branch']['id'] . '"><i class="fi-rr-check"></i></button><br>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id="' . $config['data']['list'][$i]['id'] . '" data-branch="' . $config['data']['list'][$i]['branch']['id'] . '" data-fee="' . $config['data']['list'][$i]['addition_fee_reason_id'] . '"  onclick="openModalUpdatePaymentBill($(this))"><i class="fi-rr-pencil"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailPaymentBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
                                </div>
                                <div class="btn-group btn-group-sm float-right checkbox-fade fade-in-primary check-confirm-payment-bill m-0 d-none">
                                    <div class="checkbox-form-group">
                                    <input class="m-0" type="checkbox" value="' . $config['data']['list'][$i]['id'] . '" data-branch="' . $config['data']['list'][$i]['branch']['id'] . '" onclick="checkWaitingConfirmPaymentBill($(this))">
                                    </div>
                                </div>
                                </div>';
                        $config['data']['list'][$i]['note'] = $config['data']['list'][$i]['note'] === '' ? '---' : $config['data']['list'][$i]['note'];
                        $config['data']['list'][$i]['addition_fee_reason_name'] = $config['data']['list'][$i]['addition_fee_reason_name'] === '' ? '---' : $config['data']['list'][$i]['addition_fee_reason_name'];
                        $config['data']['list'][$i]['fee_month'] = '<label>' . $this->convertDateTime($config['data']['list'][$i]['fee_month']) . '</label>';
                    }
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.WAITING_PAYMENT'): // chờ chi
                    for ($i = 0; $i < count($config['data']['list']); $i++) {
                        $config['data']['list'][$i] = $this->convertData($i, $page, $limit, $config['data']['list'][$i]);
//                        $config['data']['list'][$i]['action'] = '<div class="checkbox-fade fade-in-primary mr-0 check-confirm-payment-bill d-none">
//                                 <label><input type="checkbox" value="' . $config['data']['list'][$i]['id'] . '" data-branch="' . $config['data']['list'][$i]['branch']['id'] . '" onclick="checkboxWaitingPaymentBill($(this))"/><span class="cr mr-0"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span></label>
//                            </div>
                            $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right checkbox-fade fade-in-primary check-confirm-payment-bill d-none">
                                                    <div class="checkbox-form-group">
                                                        <input type="checkbox" value="' . $config['data']['list'][$i]['id'] . '" data-branch="' . $config['data']['list'][$i]['branch']['id'] . '" onclick="checkboxWaitingPaymentBill($(this))">
                                                    </div>
                                                </div>
                            <div class="btn-group btn-group-sm float-right btn-event-payment-bill">' . $this->buttonRemove($config['data']['list'][$i]['is_restaurant_budget_closed'], true, $config['data']['list'][$i]['id'], $config['data']['list'][$i]['branch']['id'], $config['data']['list'][$i]['is_automatically_generated']) . '<br>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green seemt-bg-green seemt-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ADDITION_FEE . '" onclick="paymentPaymentBill($(this))" data-cash-flow-time="'. $config['data']['list'][$i]['cash_flow_time'] .'" data-id="' . $config['data']['list'][$i]['id'] . '" data-branch="' . $config['data']['list'][$i]['branch']['id'] . '"><span class="icofont icofont-money-bag"></span></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailPaymentBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
                            </div>';
                        $config['data']['list'][$i]['note'] = $config['data']['list'][$i]['note'] === '' ? '---' : $config['data']['list'][$i]['note'];
                        $config['data']['list'][$i]['addition_fee_reason_name'] = $config['data']['list'][$i]['addition_fee_reason_name'] === '' ? '---' : $config['data']['list'][$i]['addition_fee_reason_name'];
                        $config['data']['list'][$i]['fee_month'] = '<label>' . $this->convertDateTime($config['data']['list'][$i]['fee_month']) . '</label>';

                    }
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRMED'): // đã hoàn tất
                    for ($i = 0; $i < count($config['data']['list']); $i++) {
                        $config['data']['list'][$i] = $this->convertData($i, $page, $limit, $config['data']['list'][$i]);
                        $config['data']['list'][$i]['note'] = $config['data']['list'][$i]['note'] === '' ? '---' : $config['data']['list'][$i]['note'];
                        $config['data']['list'][$i]['updated_at'] = '<label>' . $this->convertDateTime($config['data']['list'][$i]['fee_month']) . '</label>';
                        if ($config['data']['list'][$i]['object_type'] === 1){
                            $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">
                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailPaymentBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
                            </div>';
                        }else{
                            if ($config['data']['list'][$i]['is_automatically_generated'] || $config['data']['list'][$i]['is_restaurant_budget_closed'] === ENUM_SELECTED) {
                                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">' .'
                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailPaymentBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
                            </div>';
                            } else {
                                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">' . $this->buttonRemove($config['data']['list'][$i]['is_restaurant_budget_closed'], $per, $config['data']['list'][$i]['id'], $config['data']['list'][$i]['branch']['id'], $config['data']['list'][$i]['is_automatically_generated']) . '
                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailPaymentBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
                            </div>';
                            }
                        }
                    }
                    break;
                default: // huỷ
                    for ($i = 0; $i < count($config['data']['list']); $i++) {
                        $config['data']['list'][$i] = $this->convertData($i, $page, $limit, $config['data']['list'][$i]);
                        $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">
                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailPaymentBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
                           </div>';
                        $config['data']['list'][$i]['note'] = $config['data']['list'][$i]['note'] === '' ? '---' : $config['data']['list'][$i]['note'];
                        $config['data']['list'][$i]['addition_fee_reason_name'] = $config['data']['list'][$i]['addition_fee_reason_name'] === '' ? '---' : $config['data']['list'][$i]['addition_fee_reason_name'];
                        $config['data']['list'][$i]['updated_at'] = '<label>' . $this->convertDateTime($config['data']['list'][$i]['fee_month']) . '</label>';
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

            $data_table['total_record_confirm_payment'] = $this->numberFormat($config['data']['waitting_approve_payment']);
            $data_table['total_record_confirm'] = $this->numberFormat($config['data']['waitting_payment']);
            $data_table['total_record_done'] = $this->numberFormat($config['data']['addition_fee_completed']);
            $data_table['total_record_cancel'] = $this->numberFormat($config['data']['addition_fee_cancel']);
            $data_table['total_amount'] = $this->numberFormat($config['data']['total_amount_addition_fee']);
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function buttonRemove($check, $per, $id, $branch, $auto)
    {
        $cancel = TEXT_CANCELED_ENUM;
        return '<button type="button" class="btn seemt-btn-hover-red seemt-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $cancel . '" onclick="cancelPaymentBill($(this))" data-id="' . $id . '" data-branch="' . $branch . '"><i class="fi-rr-trash"></i></button>';
    }

    public function convertData($index, $page, $limit, $data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        if (mb_strlen($data['note']) > 20) $data['note'] = mb_substr($data['note'], 0, 17) . '...';
        if (mb_strlen($data['object_name']) > 20) $data['object_name'] = mb_substr($data['object_name'], 0, 17) . '...';
        if (mb_strlen($data['addition_fee_reason_name']) > 20) $data['addition_fee_reason_name'] = mb_substr($data['addition_fee_reason_name'], 0, 17) . '...';
        $accounting = ($data['is_count_to_revenue'] === ENUM_SELECTED) ? '<div class="tag seemt-green seemt-bg-green d-flex" style="width: fit-content">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">Hạch toán</label>
                                                                    </div>' : '';
        $debt = ($data['is_paid_debt'] === ENUM_SELECTED) ? '<div class="tag seemt-orange seemt-bg-orange d-flex" style="width: fit-content">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">Chi công nợ</label>
                                                                    </div>' : '';
        $data['name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $data['employee']['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $data['employee']['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle"></i>' . $data['employee']['role_name'] . '</label>
                         </label>';
        $data['code'] = $data['code'] . '<br>' . $accounting . $debt;
        $data['amount'] = $this->numberFormat($data['amount']);
//        $data['fee_month'] = ($data['is_automatically_generated'] === 1) ? $data['fee_month'] : substr($data['fee_month'], 0, 10);
        $data['index'] = ($page - 1) * $limit + $index + 1;
        return $data;
    }

    public function reason(Request $request)
    {
        $is_cost = ENUM_SELECTED;
        $is_system_auto_generate = ENUM_GET_ALL;
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_REASON, $status, $is_cost, $is_system_auto_generate);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $option = '<option data-reason-type-id="'. ENUM_GET_ALL .'" value="' . ENUM_GET_ALL . '" selected>Hạng mục chi</option>';
            $optionModal = '<option value="" selected disabled>Vui lòng chọn</option>';
            foreach ($config['data'] as $db) {
                $option .= '<option data-system-auto-generate="'. $db['is_system_auto_generate'] .'" data-reason-type-id="'. $db['addition_fee_reason_type_id'] .'" value="' . $db['id'] . '">' . $db['name'] . '</option>';
                if ($db['is_system_auto_generate'] === Config::get('constants.type.checkbox.DIS_SELECTED')) {
                    $optionModal .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                }
            }
            if ($option === '<option value="" selected disabled>Vui lòng chọn</option>') $option = '<option value="" selected disabled>Dữ liệu rỗng</option>';
            if ($optionModal === '<option value="" selected disabled>Vui lòng chọn</option>') $optionModal = '<option value="" selected disabled>Dữ liệu rỗng</option>';
            return [$option, $optionModal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
    public function supplier(Request $request)
    {
        $branch = $request->get('branch');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_GET_DATA, $status, $branch);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];

            if ($data == [] || $data == null) {
                $option = '<option value="' . ENUM_GET_ALL . '">' . TEXT_NULL_OPTION . '</option>';
            } else {
                $option = '<option value="' . $data[0]['id'] . '" selected>' . $data[0]['name'] . '</option>';
                for ($i = 1; $i < count($data); $i++) {
                    $option .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function employee(Request $request)
    {
        $branch_id = $request->get('branch');
        $status = ENUM_SELECTED;
//        $is_include_restaurant_manager = ENUM_DIS_SELECTED;
//        $time = $request->get('time');
//        $is_only_take_owner = ENUM_DIS_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_EMPLOYEE_V2, $branch_id, $status);
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
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
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

    public function order(Request $request)
    {
        $branch_id = $request->get('branch');
        $supplier_id = $request->get('supplier');
        $page = ENUM_DEFAULT_PAGE;
        $from = $request->get('from');
        $to = $request->get('to');
        $is_get_debt_amount = $request->get('is_debt');
        $key = '';
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_SUPPLIER_ORDER, $branch_id, $supplier_id, $is_get_debt_amount, $from, $to, $page, $limit, $key);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $dataList = $collection->where('payment_status', ENUM_DIS_SELECTED)->toArray();
            $data_table = DataTables::of($dataList)
                ->addColumn('checkbox', function ($row) {
//                    return '<div class="checkbox-fade fade-in-primary m-0">
//                                 <label>
//                                      <input type="checkbox" value="' . $row['id'] . '" class="checkbox-supplier-order-create-payment-bill" onclick="checkItemSupplierOrderCreatePaymentBill()"/>
//                                      <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
//                                 </label>
//                             </div>';
                    return '<div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="checkbox" value="' . $row['id'] . '" class="checkbox-supplier-order-create-payment-bill" onclick="checkItemSupplierOrderCreatePaymentBill()">
                                                    </div>
                                                </div>';
                })
                ->addColumn('code', function ($row) {
                    return '<label class="">' . $row['code'] . '</label>';
                })
                ->addColumn('retention_money', function ($row) {
                    if ($row['is_retention_money'] === ENUM_SELECTED) {
                        return '<div class="btn-group btn-group-sm"><i class="text-success fa fa-dot-circle-o"></i></div>';
                    } else {
                        return '<div class="btn-group btn-group-sm"><i class="text-warning fa fa-circle-o"></i></div>';
                    }
                })
                ->addColumn('return_amount', function ($row) {
                    return $this->numberFormat($row['total_amount_reality'] - $row['restaurant_debt_amount']);
                })
                ->addColumn('employee_complete', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee_complete_avatar'] . '" class="img-inline-name-data-table">
                             <label class="name-inline-data-table">' . $row['employee_complete_full_name'] . '<br>
                                  <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle"> '. $row['employee_complete_role_name'] .'</i></label>
                             </label>';
                })
                ->addColumn('total_amount_reality', function ($row) {
                    return $this->numberFormat($row['total_amount_reality']);
                })
                ->addColumn('restaurant_debt_amount', function ($row) {
                    return $this->numberFormat($row['restaurant_debt_amount']);
                })
                ->addColumn('received_at', function ($row) {
                    return $this->convertDateTime($row['received_at']);
                })

                ->addColumn('action', function ($row) {
                    $detail = TEXT_DETAIL;
                    return '<div class="btn-group btn-group-sm">
                               <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $row['id'] . ' ,' . $row['branch_id'] . ', ' . $row['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                           </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['retention_money', 'checkbox', 'received_at' , 'code', 'action','employee_complete'])
                ->addIndexColumn()
                ->make(true);
            $totalOriginal = array_sum(array_column($dataList, 'total_amount_reality'));
            $totalDebt = array_sum(array_column($dataList, 'restaurant_debt_amount'));
            $data_total = [
                'total_original' => $this->numberFormat($totalOriginal),
                'total_det_amount' => $this->numberFormat($totalDebt),
                'total_return' => $this->numberFormat($totalOriginal - $totalDebt),
            ];
            return [$data_table, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $type = Config::get('constants.type.addition_fee.OUT');
        $id = Config::get('constants.type.id.DEFAULT');
        $branch_id = $request->get('branch');
        $addition_fee_reason_id = $request->get('addition_fee_reason_id');
        $amount = $request->get('amount');
        $date = $request->get('date') . ' ' . date('H:i:s');
        $is_count_to_revenue = $request->get('is_count_to_revenue');
        $note = sprintf($request->get('note'));
        $object_id = $request->get('object_id');
        $object_name = sprintf($request->get('object_name'));
        $object_type = $request->get('object_type');
        $payment_method_id = $request->get('payment_method_id');
        $supplier_order_ids = $request->get('supplier_order_ids');
        $is_paid_debt = $request->get('is_paid_debt');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_REASON_ADDITION_FEE_POST_CREATE);
        $body = [
            'branch_id' => $branch_id,
            "addition_fee_reason_id" => $addition_fee_reason_id,
            "supplier_order_ids" => $supplier_order_ids,
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
            "is_paid_debt" => $is_paid_debt,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $branch_id = $request->get('branch');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_DETAIL, $id, $branch_id);
        $body = null;
//        $requestDetail = [
//            'project' => ENUM_PROJECT_ID_ORDER,
//            'method' => ENUM_METHOD_GET,
//            'api' => $api,
//            'body' => $body,
//        ];

//        $is_cost = ENUM_SELECTED;
//        $is_system_auto_generate = ENUM_DIS_SELECTED;
//        $status = Config::get('constants.type.status.GET_ACTIVE');
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
            switch ($config['data']['object_type']) {
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.SUPPLIER'):
                    $config['data']['object_type_text'] = TEXT_SUPPLIER;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.EMPLOYEE'):
                    $config['data']['object_type_text'] = TEXT_EMPLOYEE;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.CUSTOMER'):
                    $config['data']['object_type_text'] = TEXT_CUSTOMER;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.ORDER'):
                    $config['data']['object_type_text'] = TEXT_RECEIPT_BILL;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.OTHER'):
                    $config['data']['object_type_text'] = TEXT_OTHER;
                    break;
                case Config::get('constants.type.AdditionFeeObjectTypeEnum.BOOKING'):
                    $config['data']['object_type_text'] = TEXT_BOOKING;
                    break;
                default:
                    $config['data']['object_type_text'] = TEXT_OTHER;
            }
            $config['data']['is_paid_debt_text'] = ($config['data']['is_paid_debt'] === ENUM_SELECTED) ? 'Chi công nợ' : 'Chi trong tháng';
            $data_table = DataTables::of($config['data']['supplier_orders'])
                ->addColumn('checkbox', function ($row) {
                    return '<div class="checkbox-fade fade-in-primary m-0">
                                <label>
                                    <input type="checkbox" value="' . $row['id'] . '" class="checkbox-supplier-order-create-payment-bill" name="order" checked onclick="checkItemSupplierOrderUpdatePaymentBill()"/>
                                       <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                </label>
                            </div>';
                })
                ->addColumn('retention_money', function ($row) {
                    if ($row['is_retention_money'] === ENUM_SELECTED) {
                        return '<div class="btn-group btn-group-sm"><i class="text-success fa fa-dot-circle-o"></i></div>';
                    } else {
                        return '<div class="btn-group btn-group-sm"><i class="text-warning fa fa-circle-o"></i></div>';
                    }
                })
                ->addColumn('code', function ($row) {
                    return '<label class="">' . $row['code'] . '</label>';
                })
                ->addColumn('return_amount', function ($row) {
                    return $this->numberFormat($row['total_amount_reality'] - $row['restaurant_debt_amount']);
                })
                ->addColumn('total_amount_reality', function ($row) {
                    return $this->numberFormat($row['total_amount_reality']);
                })
                ->addColumn('employee_complete', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee_complete_avatar'] . '" class="img-inline-name-data-table">
                             <label class="name-inline-data-table">' . $row['employee_complete_full_name'] . '<br>
                                  <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle"></i>' . $row['employee_complete_role_name'] . '</label>
                             </label>';
                })
                ->addColumn('restaurant_debt_amount', function ($row) {
                    return $this->numberFormat($row['restaurant_debt_amount']);
                })
                ->addColumn('action', function ($row) {
                    $detail = TEXT_DETAIL;
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $row['id'] . ' ,' . $row['branch_id'] . ', ' . $row['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['checkbox', 'retention_money', 'action', 'code','employee_complete'])
                ->addIndexColumn()
                ->make(true);
            $totalOriginal = array_sum(array_column($config['data']['supplier_orders'], 'restaurant_debt_amount'));
            $data_total = [
                'total_restaurant_debt_amount' => $this->numberFormat($totalOriginal)
            ];
//            if (!empty($configAll[1]['data'])) {
//                $collectData = collect($configAll[1]['data']);
//                $reason = $collectData->where('is_system_auto_generate', (int)Config::get('constants.type.checkbox.DIS_SELECTED'));
//            } else {
//                $reason = "";
//            }
            return [$config['data'], $data_table, $config, $data_total];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $branch_id = $request->get('branch');
        $addition_fee_reason_id = $request->get('addition_fee_reason_id');
        $amount = $request->get('amount');
        $date = $request->get('date') . ' ' . date('H:i:s');
        $is_count_to_revenue = $request->get('is_count_to_revenue');
        $note = $request->get('note');
        $payment_method_id = $request->get('payment_method_id');
        $supplier_order_ids = $request->get('supplier_order_ids');
        $object_name = $request->get('object_name');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_REASON_ADDITION_FEE_POST_UPDATE, $id);
        $body = [
            'branch_id' => $branch_id,
            "addition_fee_reason_id" => $addition_fee_reason_id,
            "id" => $id,
            "amount" => $amount,
            "date" => $date,
            "is_count_to_revenue" => $is_count_to_revenue,
            "note" => $note,
            "payment_method_id" => $payment_method_id,
            "supplier_order_ids" => $supplier_order_ids,
            "object_name" => $object_name,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === (int)Config::get('constants.type.status.STATUS_SUCCESS')) {
            if (mb_strlen($config['data']['note']) > 20) $config['data']['note'] = mb_substr($config['data']['note'], 0, 17) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $config['data']['note'] . '"></i>';
            if (mb_strlen($config['data']['addition_fee_reason_name']) > 20) $config['data']['addition_fee_reason_name'] = mb_substr($config['data']['addition_fee_reason_name'], 0, 17) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $config['data']['addition_fee_reason_name'] . '"></i>';
        }
        return $config;
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
            $data['fee_month'] = ($data['is_automatically_generated'] === 1) ? $data['fee_month'] : substr($data['fee_month'], 0, 10);
            $data['created_at'] = ($data['is_automatically_generated'] === 1) ? $data['created_at'] : substr($data['created_at'], 0, 10);
            $data['updated_at'] = ($data['is_automatically_generated'] === 1) ? $data['updated_at'] : substr($data['updated_at'], 0, 10);
            $data['is_count_to_revenue_name'] = ($data['is_count_to_revenue'] === ENUM_SELECTED) ? 'Hạch toán' : 'Không Hạch toán';
            switch ($data['addition_fee_status']) {
                case Config::get('constants.type.AdditionFeeStatusEnum.WAITING_PAYMENT'):
//                    $status = '<label class="label label-warning">' . TEXT_PAYMENT_APPROVED . '</label>';
//                    $status = '<div class="status-new seemt-orange seemt-border-orange d-flex">
//                                    <i class="fi-rr-time-quarter-to d-flex align-center justify-content-center"></i>
//                                    <label class="m-0">' . TEXT_PAYMENT_APPROVED . '</label>
//                                </div>';
                    $status = '<div class="seemt-orange seemt-border-orange status-new">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">'. TEXT_PAYMENT_APPROVED .'</label>
                                </div>';


                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRMED'):
//                    $status = '<label class="label label-success">' . TEXT_SALARY_CONFIRMED . '</label>';
//                    $status = '<div class="status-new seemt-green seemt-border-green d-flex">
//                                                                        <i class="fi-rr-time-quarter-to d-flex align-center justify-content-center"></i>
//                                                                        <label class="m-0">' . TEXT_SALARY_CONFIRMED . '</label>
//                                                                    </div>';

                    $status = '<div class="seemt-green seemt-border-green status-new">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">'. TEXT_SALARY_CONFIRMED .'</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL'):
//                    $status = '<label class="label label-danger">' . TEXT_CANCELED_ENUM . '</label>';
//                    $status = '<div class="status-new seemt-red seemt-border-red d-flex">
//                                                                        <i class="fi-rr-time-quarter-to d-flex align-center justify-content-center"></i>
//                                                                        <label class="m-0">' . TEXT_CANCELED_ENUM . '</label>
//                                                                    </div>';

                    $status = '<div class="seemt-red seemt-border-red status-new">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">'. TEXT_CANCELED_ENUM .'</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.PAID'):
//                    $status = '<label class="label label-warning">' . TEXT_WAITING . '</label>';
//                    $status = '<div class="status-new seemt-orange seemt-border-orange d-flex">
//                                                                        <i class="fi-rr-time-quarter-to d-flex align-center justify-content-center"></i>
//                                                                        <label class="m-0">' . TEXT_WAITING . '</label>
//                                                                    </div>';
                    $status = '<div class="seemt-orange seemt-border-orange status-new">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">'. TEXT_WAITING .'</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL_PAYMENT'):
//                    $status = '<label class="label label-inverse">' . TEXT_CANCEL_PAYMENT . '</label>';
//                    $status = '<div class="status-new seemt-green seemt-border-green d-flex">
//                                                                        <i class="fi-rr-time-quarter-to d-flex align-center justify-content-center"></i>
//                                                                        <label class="m-0">' . TEXT_SALARY_CONFIRMED . '</label>
//                                                                    </div>';

                    $status = '<div class="seemt-green seemt-border-green status-new">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">'. TEXT_SALARY_CONFIRMED .'</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL_PAYMENT_REFUNDED'):
//                    $status = '<label class="label label-danger">' . Config::get('constants.TEXT_CANCEL_PAYMENT_REFUNDED') . '</label>';
//                    $status = '<div class="status-new seemt-red seemt-border-red d-flex">
//                                                                        <i class="fi-rr-time-quarter-to d-flex align-center justify-content-center"></i>
//                                                                        <label class="m-0">' . Config::get('constants.TEXT_CANCEL_PAYMENT_REFUNDED') . '</label>
//                                                                    </div>';

                    $status = '<div class="seemt-red seemt-border-red status-new">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">'. Config::get('constants.TEXT_CANCEL_PAYMENT_REFUNDED') .'</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRM_PAYMENT'):
//                    $status = '<label class="label label-warning">' . TEXT_CONFIRMED_PAYMENT . '</label>';
//                    $status = '<div class="status-new seemt-orange seemt-border-orange d-flex">
//                                                                        <i class="fi-rr-time-quarter-to d-flex align-center justify-content-center"></i>
//                                                                        <label class="m-0">' . TEXT_CONFIRMED_PAYMENT . '</label>
//                                                                    </div>';


                    $status = '<div class="seemt-orange seemt-border-orange status-new">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">'. TEXT_CONFIRMED_PAYMENT .'</label>
                                </div>';
                    break;
                case Config::get('constants.type.AdditionFeeStatusEnum.ORDER_PAYMENT'):
//                    $status = '<label class="label label-success">' . TEXT_SUPPLIER_PAID . '</label>';
//                    $status = '<div class="status-new seemt-green seemt-border-green d-flex">
//                                                                        <i class="fi-rr-time-quarter-to d-flex align-center justify-content-center"></i>
//                                                                        <label class="m-0">' . TEXT_SUPPLIER_PAID . '</label>
//                                                                    </div>';


                    $status = '<div class="seemt-green seemt-border-green status-new">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">'. TEXT_SUPPLIER_PAID .'</label>
                                </div>';
                    break;
                default:
//                    $status = '<label class="label label-inverse">' . TEXT_OTHER . '</label>';
//                    $status = '<div class="status-new seemt-blue seemt-border-blue d-flex">
//                                                                        <i class="fi-rr-time-quarter-to d-flex align-center justify-content-center"></i>
//                                                                        <label class="m-0">' . TEXT_OTHER . '</label>
//                                                                    </div>';

                    $status = '<div class="seemt-blue seemt-border-blue status-new">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">'. TEXT_OTHER .'</label>
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
            $data['status_text'] = $status;
            $detail = TEXT_DETAIL;
            $data_table = DataTables::of($config['data']['supplier_orders'])
                ->addColumn('category_type_name', function ($row) {
                    return '---';
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['restaurant_debt_amount']);
                })
                ->addColumn('received_at', function ($row) {
                     return $this->convertDateTime($row['received_at']);
                })
                ->addColumn('retention_money', function ($row) {
                    if ($row['is_retention_money'] === ENUM_SELECTED) {
                        return '<div class="btn-group btn-group-sm"><i class="text-success fa fa-dot-circle-o"></i></div>';
                    } else {
                        return '<div class="btn-group btn-group-sm"><i class="text-warning fa fa-circle-o"></i></div>';
                    }
                })
                ->addColumn('action', function ($row) use ($detail) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $row['id'] . ',' . $row['branch_id'] . ',' . $row['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['retention_money', 'action' , 'received_at'])
                ->addIndexColumn()
                ->make();

            $total_amount_supplier_orders = count($config['data']['supplier_orders']) > 0 ? array_sum(array_column($config['data']['supplier_orders'], 'restaurant_debt_amount')) : 0;
            $data_total = [
                'total_amount_supplier_orders' => $this->numberFormat($total_amount_supplier_orders)
            ];
            return [$data, $data_table, $config, $data_total];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function confirmPayment(Request $request)
    {
        $id = $request->get('id');
        $status = Config::get('constants.type.AdditionFeeStatusEnum.WAITING_PAYMENT');
        $branch_id = $request->get('branch');
        $cash_flow_time = $request->get('cash_flow_time') ? $request->get('cash_flow_time') : '';
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_REASON_ADDITION_FEE_POST_CHANGE_STATUS, $id);
        $body = [
            'branch_id' => $branch_id,
            'addition_fee_status' => $status,
            'image_urls' => [],
            'cancel_reason' => "",
            'cash_flow_time' => $cash_flow_time
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function confirmPaymentMulti(Request $request)
    {
        $id = $request->get('id');
        $status = Config::get('constants.type.AdditionFeeStatusEnum.WAITING_PAYMENT');
        $branch_id = $request->get('branch');
        $cash_flow_time = $request->get('cash_flow_time') ? $request->get('cash_flow_time') : '';
        $project = ENUM_PROJECT_ID_ORDER_VERSION;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_REASON_ADDITION_FEE_POST_MULTI_CHANGE_STATUS);
        $body = [
            'branch_id' => $branch_id,
            'addition_fees' => (array)$id,
            'addition_fee_status' => $status,
            'image_urls' => [],
            'cancel_reason' => "",
            'cash_flow_time' => $cash_flow_time
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function payment(Request $request)
    {
        $id = $request->get('id');
        $status = Config::get('constants.type.AdditionFeeStatusEnum.CONFIRMED');
        $branch_id = $request->get('branch');
        $cash_flow_time = $request->get('cash_flow_time') ? $request->get('cash_flow_time') : '';
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_REASON_ADDITION_FEE_POST_CHANGE_STATUS, $id);
        $body = [
            'branch_id' => $branch_id,
            'addition_fee_status' => $status,
            'image_urls' => [],
            'cancel_reason' => "",
            'cash_flow_time' => $cash_flow_time
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function paymentMulti(Request $request)
    {
        $id = $request->get('id');
        $status = Config::get('constants.type.AdditionFeeStatusEnum.CONFIRMED');
        $branch_id = $request->get('branch');
        $cash_flow_time = $request->get('cash_flow_time') ? $request->get('cash_flow_time') : '';
        $project = ENUM_PROJECT_ID_ORDER_VERSION;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_REASON_ADDITION_FEE_POST_MULTI_CHANGE_STATUS);
        $body = [
            'branch_id' => $branch_id,
            'addition_fees' => (array)$id,
            'addition_fee_status' => $status,
            'image_urls' => [],
            'cancel_reason' => "",
            'cash_flow_time' => $cash_flow_time
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function cancel(Request $request)
    {
        $id = $request->get('id');
        $reason = $request->get('reason');
        $status = Config::get('constants.type.AdditionFeeStatusEnum.CANCEL');
        $branch_id = $request->get('branch');
        $cash_flow_time = $request->get('cash_flow_time') ? $request->get('cash_flow_time') : '';
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_REASON_ADDITION_FEE_POST_CHANGE_STATUS, $id);
        $body = [
            'branch_id' => $branch_id,
            'addition_fee_status' => $status,
            'image_urls' => [],
            'cancel_reason' => $reason,
            "cash_flow_time" => $cash_flow_time
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function listFund (Request $request)
    {
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $limit = ENUM_DEFAULT_LIMIT_100;
        $page = 1;
        $api = sprintf(API_PAYMENT_BILL_GET_LIST_FUND, $limit, $page);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $list_fund = '';
            if(count($config['data']['list']) > 0) {
                foreach ($config['data']['list'] as $db) {
                    $list_fund .= '<option value="'. $db['time_value'] .'">'. $db['time_string'] .'</option>';
                }
            }else {
                $list_fund = '<option value="">Chưa có nguồn tiền</option>';
            }
            return [$list_fund, $config];
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
