<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use DateTime;

class BillLiabilitiesController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ADDITION_FEE_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }

        $active_nav = 'Sổ mua hàng';
        return view('treasurer.bill_liabilities.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $brand = $request->get('brand');
        $from = $request->get('from');
        $to = $request->get('to');
        $isTakeAll = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BILL_LIABILITIES_GET_LIST, $brand, $branch, $isTakeAll, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $detail = TEXT_DETAIL;
            $dataTable = DataTables::of($config['data']['list'])
                ->addColumn('total_order_amount', function ($row) {
                    $class = ($row['number_order'] === 0) ? 'number-order-hidden' : '';
                    return '<label class=" ' . $class . '">' . $this->numberFormat($row['total_order_amount'])  . '</label><br>
                            <label class="number-order ' . $class . '">'. $this->numberFormat($row['number_order']) . '<em> đơn hàng</em></label>';
                })
                ->addColumn('total_order_amount_return', function ($row) {
                    $class = ($row['number_order_return'] === 0) ? 'number-order-hidden' : '';
                    return '<label class=" ' . $class . '">' . $this->numberFormat($row['total_order_amount_return'])  . '</label><br>
                            <label class="number-order ' . $class . '">'. $this->numberFormat($row['number_order_return'] ) . '<em> đơn hàng</em></label>';
                })
                ->addColumn('total_order_amount_paid', function ($row) {
                    $class = ($row['number_order_paid'] === 0) ? 'number-order-hidden' : '';
                    return '<label class=" ' . $class . '">' . $this->numberFormat($row['total_order_amount_paid'])  . '</label><br>
                            <label class="number-order ' . $class . '" >'. $this->numberFormat($row['number_order_paid'] ) . '<em> đơn hàng</em></label>';
                })
                ->addColumn('total_order_amount_waiting_payment', function ($row) {
                    $class = ($row['number_order_waiting_payment'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['total_order_amount_waiting_payment'])  . '</label><br>
                            <label class="number-order ' . $class . '">'. $this->numberFormat($row['number_order_waiting_payment'] ) . '<em> đơn hàng</em></label>';
                })
                ->addColumn('total_order_amount_debt', function ($row) {
                    $class = ($row['number_debt'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['total_order_amount_debt'])  . '</label><br>
                            <label class="number-order ' . $class . ' ">'. $this->numberFormat($row['number_debt'] ) . '<em> đơn hàng</em></label>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('supplier_name', function ($row) {
                    if ($row['is_handbook_supplier'] === ENUM_DIS_SELECTED) {
                        if ($row['status'] === ENUM_DIS_SELECTED) {
                            return '<label>'. $row['supplier_name'] .'<br><div class="d-flex">
                                        <div class="tag seemt-blue seemt-bg-blue d-flex">
                                             <i class="fi-rr-hastag"></i>
                                             <label class="m-0">'.TEXT_SYSTEM_SUPPLIER.'</label>
                                        </div>
                                        <div class="tag seemt-red seemt-bg-red d-flex">
                                             <i class="fi-rr-hastag"></i>
                                             <label class="m-0">Tạm ngưng</label>
                                        </div>
                                    </div></label>';
                        } else{
                            return '<label>'. $row['supplier_name'] .'<br><div class="tag seemt-green seemt-bg-green d-flex">
                                                                                    <i class="fi-rr-hastag"></i>
                                                                                    <label class="m-0">'.TEXT_SYSTEM_SUPPLIER.'</label>
                                                                                </div></label>';
                        }

                    } else {
                        if ($row['status'] === ENUM_DIS_SELECTED) {
                            return '<label>'. $row['supplier_name'] .'<br><div class="d-flex">
                                        <div class="tag seemt-blue seemt-bg-blue d-flex">
                                             <i class="fi-rr-hastag"></i>
                                             <label class="m-0">NCC Sổ Tay</label>
                                        </div>
                                        <div class="tag seemt-red seemt-bg-red d-flex">
                                             <i class="fi-rr-hastag"></i>
                                             <label class="m-0">Tạm ngưng</label>
                                        </div>
                                    </div></label>';
                        } else{
                            return '<label>'. $row['supplier_name'] .'<br><div class="tag seemt-blue seemt-bg-blue d-flex">
                                                                                    <i class="fi-rr-hastag"></i>
                                                                                    <label class="m-0">NCC Sổ Tay</label>
                                                                                </div></label>';
                        }

                    }
                })
                ->addColumn('action', function ($row) use ($detail) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailBillLiabilities($(this))" data-id="' .$row['supplier_id']. '" data-name="' .$row['supplier_name']. '" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                })
                ->rawColumns(['action',
                                'total_order_amount',
                                'total_order_amount_return',
                                'total_order_amount_paid',
                                'total_order_amount_waiting_payment',
                                'total_order_amount_debt',
                                'supplier_name'])
                ->addIndexColumn()
                ->make();
            $dataTotal = [
                'total_record_done' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'number_order_paid'))),
                'total_amount_done' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_order_amount_paid'))),
                'total_record_return' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'number_order_return'))),
                'total_amount_return' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_order_amount_return'))),
                'total_record_confirm' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'number_order_waiting_payment'))),
                'total_amount_confirm' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_order_amount_waiting_payment'))),
                'total_record_session' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'number_order'))),
                'total_amount_session' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_order_amount'))),
                'total_record_payment' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'number_debt'))),
                'total_amount_payment' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_order_amount_debt')))
            ];
            return [$dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $supplier = $request->get('id');
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_GET_DETAIL_ALL, $supplier, $brand, $branch);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = [
                'name' => $config['data']['name'],
                'type' => ($config['data']['restaurant_id'] === ENUM_ID_DEFAULT) ? 'NCC Hệ thống' : 'NCC Sổ tay',
                'phone' => $config['data']['phone'],
                'address' => $config['data']['address'],
                'website' => $config['data']['website'],
                'email' => $config['data']['email'],
                'tax_code' => $config['data']['tax_code'],
            ];
            return [$data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function reason(Request $request)
    {
        $isCost = ENUM_SELECTED;
        $status = ENUM_SELECTED;
        $isSystemAutoGenerate = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_REASON, $status, $isCost,$isSystemAutoGenerate);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collect = collect($config['data'])->where('is_system_auto_generate', ENUM_DIS_SELECTED)->all();
            $option = '<option value="' . ENUM_ID_GET_ALL . '" disabled selected >'. TEXT_DEFAULT_OPTION .'</option>';
            $optionModal = '<option value="-1" selected >'.TEXT_DEFAULT_OPTION.'</option>';
            foreach ($collect as $db) {
                $option .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                if ($db['is_system_auto_generate'] === ENUM_DIS_SELECTED) {
                    $optionModal .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                }
            }
            if ($optionModal === '<option value="" selected >'.TEXT_DEFAULT_OPTION.'</option>') $optionModal .= '<option value="" selected >'.TEXT_NULL_OPTION.'</option>';
            return [$option, $optionModal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function order(Request $request)
    {
        $brand = $request->get('brand');
        $supplier = $request->get('id');
        $branch = $request->get('branch_id');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = 100;
        $type = $request->get('type');
        $from = $request->get('from');
        $to = $request->get('to');
        $key = $this->keySearch(($request->get('search'))['value']);
        $api = sprintf(API_BILL_LIABILITIES_GET_DETAIL, $supplier, $brand, $branch, $from, $to, $type, $page, $limit, $key);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_BILL_LIABILITIES_GET_TAB_DETAIL, $supplier, $branch, $from, $to, $key, $type);
        $requestTab = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestList, $requestTab]);
        try {
            $config = $configAll[0];
            $detail = TEXT_DETAIL;
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list'][$i]);
                $config['data']['list'][$i]['employee_complete'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['list'][$i]['employee_complete_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $config['data']['list'][$i]['employee_complete_avatar'] . "'" . ')"><label class="title-name-new-table" >' . $config['data']['list'][$i]['employee_complete_full_name'] . '<br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_role_name'] . '</label></label>';
                $config['data']['list'][$i]['employee_cancel_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['list'][$i]['employee_cancel_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $config['data']['list'][$i]['employee_cancel_avatar'] . "'" . ')"><label class="title-name-new-table" >' . $config['data']['list'][$i]['employee_cancel_full_name'] . '<br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_cancel_role_name'] . '</label></label>';
                $config['data']['list'][$i]['total_amount_reality'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                $config['data']['list'][$i]['received_at'] = mb_strlen($config['data']['list'][$i]['received_at']) > 10 ? mb_substr($config['data']['list'][$i]['received_at'], 0, 10) : $config['data']['list'][$i]['received_at'];
                $config['data']['list'][$i]['updated_at'] = mb_strlen($config['data']['list'][$i]['updated_at']) > 10 ? mb_substr($config['data']['list'][$i]['updated_at'], 0, 10) : $config['data']['list'][$i]['received_at'];
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">
                                                    <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $config['data']['list'][$i]['order_id'] . ',' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                                                </div>';
                if ($config['data']['list'][$i]['payment_status'] === ENUM_SELECTED) {
                    $config['data']['list'][$i]['retention_money'] = '<label class="text-danger">Đã được tạo phiếu chi</label>';
                } else {
                    if($config['data']['list'][$i]['is_retention_money'] === ENUM_SELECTED){
                        $config['data']['list'][$i]['retention_money'] = '<div class="form-validate-checkbox m-0 p-0">
                                                                                <div class="checkbox-form-group justify-content-center align-items-center">
                                                                                    <input class="checkbox-order-retention-money-bill-liabilities" value="' . $config['data']['list'][$i]['order_id'] . '" checked name="check-vat-food-brand-manage" type="checkbox">
                                                                                    <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">
                                                                                    </label>
                                                                                </div>
                                                                            </div>';
                    }else{
                        $config['data']['list'][$i]['retention_money'] = '<div class="form-validate-checkbox m-0 p-0">
                                                                                <div class="checkbox-form-group justify-content-center align-items-center">
                                                                                    <input class="checkbox-order-retention-money-bill-liabilities" value="' . $config['data']['list'][$i]['order_id'] . '" name="check-vat-food-brand-manage" type="checkbox">
                                                                                    <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">
                                                                                    </label>
                                                                                </div>
                                                                            </div>';
                    }

                }
            }
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'totalAmount' => $this->numberFormat($config['data']['total_amount']),
                'key' => $key,
                'page' => $page,
                'config' => $configAll
            );
            $config = $configAll[1];
            $dataTable['count_waiting'] = $this->numberFormat($config['data']['number_order_waiting_payment']);
            $dataTable['count_paid'] = $this->numberFormat($config['data']['number_order_paid']);
            $dataTable['count_cancel'] = $this->numberFormat($config['data']['number_order_cancel']);
            $dataTable['count_debt'] = $this->numberFormat($config['data']['number_order_debt']);
            return json_encode($dataTable);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataOrder(Request $request)
    {
        $branchID = $request->get('branch');
        $supplierID = $request->get('supplier');
        $page = 1;
        $from = $request->get('from');
        $to = $request->get('to');
        $isGetDebtAmount = $request->get('is_debt');
        $key = '';
        $limit = 5000;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_SUPPLIER_ORDER, $branchID, $supplierID, $isGetDebtAmount, $from, $to, $page, $limit, $key);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $dataTable = DataTables::of($data)
                ->addColumn('checkbox', function ($row) {
                    if ($row['payment_status'] === ENUM_SELECTED){
                        return '<label class="text-danger">Đã được tạo phiếu chi</label>';
                    } else {
                        return '<div class="checkbox-fade fade-in-primary m-0">
                                  <label>
                                        <input checked disabled type="checkbox" value="' . $row['id'] . '" class="checkbox-supplier-order-create-payment-bill" name="order"/>
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                  </label>
                            </div>';
                    }
                })
                ->addColumn('code', function ($row) {
                    return '<label class="text-primary">' . $row['code'] . '</label>';
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
                ->addColumn('total_amount_reality', function ($row) {
                    return $this->numberFormat($row['total_amount_reality']);
                })
                ->addColumn('restaurant_debt_amount', function ($row) {
                    return $this->numberFormat($row['restaurant_debt_amount']);
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
                ->rawColumns(['retention_money', 'checkbox', 'code', 'action', 'payment_status', 'employee_complete'])
                ->addIndexColumn()
                ->make(true);
            return [$dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function retentionMoney(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BILL_LIABILITIES_POST_RETENTION_MONEY, $id);
        $body = null;
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
}
