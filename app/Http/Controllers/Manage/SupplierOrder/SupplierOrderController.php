<?php

namespace App\Http\Controllers\Manage\SupplierOrder;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Description;
use Yajra\DataTables\Facades\DataTables;

class SupplierOrderController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'BRANCH_INVENTORY_MANAGEMENT']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Quản lý mua hàng';
        return view('manage.supplier_order.index', compact('active_nav'));
    }

    public function dataListRequest(Request $request)
    {
        $branch = $request->get('branch');
        $brand = $request->get('brand');
        $employee_role_id = ENUM_ID_GET_ALL;
        $employee_create_id = $request->get('employee_create_id');
        $employee_confirm_id = $request->get('employee_confirm_id');
        $employee_cancel_id = $request->get('employee_cancel_id');
        $material_category_type_parent_id = '';
        $branch_inner_inventory_type = ENUM_ID_GET_ALL;
        $is_user = ENUM_ID_DEFAULT;
        $from_date = $request->get('from');
        $to_date = $request->get('to');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $status = Config::get('constants.type.OrderSupplierInternalStatusEnum.WEB');
        $api = sprintf(API_GET_LIST_REQUEST_ORDER, $brand, $branch, $employee_role_id, $status, $key, $employee_create_id, $employee_confirm_id, $employee_cancel_id, $from_date, $to_date, $material_category_type_parent_id, $branch_inner_inventory_type, $is_user, $page, $limit, );
        $body = null;
        $requestList = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $type = Config::get('constants.type.TypeSearchSupplierOrder.RESTAURANT_MATERIAL_ORDER_REQUEST');
        $api = sprintf(API_GET_COUNT_ORDER_SUPPLIER, $branch, $from_date, $to_date, $key, $type);
        $body = null;
        $requestTab = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTab]);
        try {
            $config = $configAll[0];
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                if ($config['data']['list'][$i]['status'] === Config::get('constants.type.OrderSupplierInternalStatusEnum.CONFIRMED')) {
                    $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                    $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                    switch ($config['data']['list'][$i]['branch_inner_inventory_type']) {
                        case 1:
                            $config['data']['list'][$i]['inventory'] = TEXT_INVENTORY_KITCHEN;
                            break;
                        case 2:
                            $config['data']['list'][$i]['inventory'] = TEXT_INVENTORY_BAR;
                            break;
                        case 3:
                            $config['data']['list'][$i]['inventory'] = TEXT_INVENTORY_BUSINESS_EMPLOYEE;
                            break;
                        case 4:
                            $config['data']['list'][$i]['inventory'] = TEXT_INVENTORY_FOOD_EMPLOYEE;
                            break;
                        default:
                            break;
                    }
                    $config['data']['list'][$i]['employee_create_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_create_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_create_avatar'] . "'" . ')">
                                                                               <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_create_full_name'] . '<br>
                                                                                    <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_create_employee_role_name'] . '</label>
                                                                               </label>';
                    $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">
                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="confirmRequestSupplierOrder(' . $config['data']['list'][$i]['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_SEND_SUPPLIER . '"><i class="fi-rr-check"></i></button>
                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRequestSupplierOrder(' . $config['data']['list'][$i]['id'] . ', ' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ', $(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                              </div>';
                } else {
                    $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                    $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                    switch ($config['data']['list'][$i]['branch_inner_inventory_type']) {
                        case 1:
                            $config['data']['list'][$i]['inventory'] = TEXT_INVENTORY_KITCHEN;
                            break;
                        case 2:
                            $config['data']['list'][$i]['inventory'] = TEXT_INVENTORY_BAR;
                            break;
                        case 3:
                            $config['data']['list'][$i]['inventory'] = TEXT_INVENTORY_BUSINESS_EMPLOYEE;
                            break;
                        case 4:
                            $config['data']['list'][$i]['inventory'] = TEXT_INVENTORY_FOOD_EMPLOYEE;
                            break;
                        default:
                            break;
                    }
                    $config['data']['list'][$i]['employee_create_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_create_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_create_avatar'] . "'" . ')">
                                                               <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_create_full_name'] . '<br>
                                                                    <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_create_employee_role_name'] . '</label>
                                                               </label>';
                    $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">
                                                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openUpdateRequestSupplierOrder(' . $config['data']['list'][$i]['id'] . ', ' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ', ' . $config['data']['list'][$i]['material_category_type_parent_id'] . ', $(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRequestSupplierOrder(' . $config['data']['list'][$i]['id'] . ', ' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ', $(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                              </div>';
                }
            }
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'key' => $key,
                'page' => $page,
                'config' => $configAll,
            );
            $config_count = $configAll[1];
            $dataTable['count_import_order'] = $config_count['data']['import_request'];
            $dataTable['count_waiting_order'] = $config_count['data']['supplier_waiting_confirm'];
            $dataTable['count_delivery_order'] = $config_count['data']['order'];
            $dataTable['count_return_order'] = $config_count['data']['order_return'];
            $dataTable['count_cancel_order'] = $config_count['data']['cancel'];
            $dataTable['count_done_order'] = $config_count['data']['done'];
            $dataTable['count_history_request_order'] = $config_count['data']['restaurant_order_request_complete'];

            $dataTable['amount_waiting'] = 0;

            $dataTable['amount_received'] = 0;
            $dataTable['vat_received'] = 0;
            $dataTable['discount_received'] = 0;
            $dataTable['total_amount_received'] = 0;

            $dataTable['amount_done'] = 0;
            $dataTable['vat_done'] = 0;
            $dataTable['discount_done'] = 0;
            $dataTable['total_amount_done'] = 0;
            $dataTable['total_return_done'] = 0;
            $dataTable['total_payment_done'] = 0;

            $dataTable['amount_cancel'] = 0;
            $dataTable['vat_cancel'] = 0;
            $dataTable['discount_cancel'] = 0;
            $dataTable['total_amount_cancel'] = 0;

            $dataTable['amount_return'] = 0;
            $dataTable['vat_return'] = 0;
            $dataTable['discount_return'] = 0;
            $dataTable['total_amount_return'] = 0;
            return json_encode($dataTable);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataListOrderRestaurant(Request $request)
    {
        $branch = $request->get('branch');
        $supplier = Config::get('constants.type.id.NONE');
        $from_date = $request->get('from');
        $to_date = $request->get('to');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $status = Config::get('constants.type.OrderSupplierRestaurantStatusEnum.WEB');
        $api = sprintf(API_GET_LIST_ORDER_RESTAURANT, $branch, $supplier, $status, $from_date, $to_date, $page, $limit, $key);
        $body = null;
        $requestList = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $type = Config::get('constants.type.TypeSearchSupplierOrder.SUPPLIER_ORDER_REQUEST');
        $api = sprintf(API_GET_COUNT_ORDER_SUPPLIER, $branch, $from_date, $to_date, $key, $type);
        $requestTab = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $api = sprintf(API_GET_TOTAL_ORDER_RESTAURANT, $branch, $supplier, $from_date, $to_date, $status, $key);
        $requestTotal = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTab, $requestTotal]);
        try {
            $config = $configAll[0];
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">
                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openUpdateRestaurantSupplierOrder(' . $config['data']['list'][$i]['id'] . ', ' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRestaurantSupplierOrder(' . $config['data']['list'][$i]['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                          </div>';
                $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                <label class="title-name-new-table">' . $config['data']['list'][$i]['supplier_name'] . '<br>
                                                                </label>';
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['employee_created_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_created_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_created_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                               <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_created_full_name'] . '<br>
                                                                                    <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_created_employee_role_name'] . '</label>
                                                                               </label>';
                $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount']);
                $config['data']['list'][$i]['employee_created_avatar'] = $domain.$config['data']['list'][$i]['employee_created_avatar'] ;
                $config['data']['list'][$i]['expected_delivery_time'] = substr($config['data']['list'][$i]['expected_delivery_time'], 0, 10);
            }
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'key' => $key,
                'page' => $page,
                'config' => $configAll,
            );
            $config_count = $configAll[1];
            $dataTable['count_import_order'] = $config_count['data']['import_request'];
            $dataTable['count_waiting_order'] = $config_count['data']['supplier_waiting_confirm'];
            $dataTable['count_delivery_order'] = $config_count['data']['order'];
            $dataTable['count_return_order'] = $config_count['data']['order_return'];
            $dataTable['count_cancel_order'] = $config_count['data']['cancel'];
            $dataTable['count_done_order'] = $config_count['data']['done'];
            $dataTable['count_history_request_order'] = $config_count['data']['restaurant_order_request_complete'];

            $config_total = $configAll[2];
            $dataTable['amount_waiting'] = $this->numberFormat($config_total['data']['total_amount']);
            $dataTable['amount_received'] = 0;
            $dataTable['vat_received'] = 0;
            $dataTable['discount_received'] = 0;
            $dataTable['total_amount_received'] = 0;

            $dataTable['amount_done'] = 0;
            $dataTable['vat_done'] = 0;
            $dataTable['discount_done'] = 0;
            $dataTable['total_amount_done'] = 0;
            $dataTable['total_return_done'] = 0;
            $dataTable['total_payment_done'] = 0;

            $dataTable['amount_cancel'] = 0;
            $dataTable['vat_cancel'] = 0;
            $dataTable['discount_cancel'] = 0;
            $dataTable['total_amount_cancel'] = 0;

            $dataTable['amount_return'] = 0;
            $dataTable['vat_return'] = 0;
            $dataTable['discount_return'] = 0;
            $dataTable['total_amount_return'] = 0;
            return json_encode($dataTable);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataListOrder(Request $request)
    {
        $is_return_all_total_material = $request->get('is_return_all_total_material');
        $branch = $request->get('branch');
        $supplier = Config::get('constants.type.id.NONE');
        $from_date = $request->get('from');
        $to_date = $request->get('to');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $status = $request->get('status');
        $api = sprintf(API_GET_LIST_ORDER_SUPPLIER, $branch, $supplier, $status, $from_date, $to_date, $page, $limit, $is_return_all_total_material, $key);
        $body = null;
        $requestList = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $type = $request->get('type');
        $api = sprintf(API_GET_COUNT_ORDER_SUPPLIER, $branch, $from_date, $to_date, $key, $type);
        $body = null;
        $requestTab = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $api = sprintf(API_GET_TOTAL_ORDER_SUPPLIER, $branch, $supplier, $status, $from_date, $to_date, $page, $limit, $is_return_all_total_material, $key);
        $body = null;
        $requestTotal = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTab, $requestTotal]);
        try {
            $config = $configAll[0];
                switch ($status) {
                case Config::get('constants.type.OrderSupplierStatusEnum.WEB_WAITING'):
                    for ($i = 0; $i < count($config['data']['list']); $i++) {
                        switch ($config['data']['list'][$i]['status']) {
                            case Config::get('constants.type.OrderSupplierStatusEnum.WAITING_DELIVERY'):
                                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                                $config['data']['list'][$i]['code'] = '<lable class="text ">' . $config['data']['list'][$i]['code'] . '</lable>';
                                $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                                $config['data']['list'][$i]['amount_reality'] = $this->numberFormat($config['data']['list'][$i]['amount_reality']);
                                $config['data']['list'][$i]['total_amount_reality'] = $this->numberFormat($config['data']['list'][$i]['total_amount_reality']);
                                $config['data']['list'][$i]['discount_amount'] = $this->numberFormat($config['data']['list'][$i]['discount_amount']);
                                $config['data']['list'][$i]['vat_amount'] = $this->numberFormat($config['data']['list'][$i]['vat_amount']);
                                $config['data']['list'][$i]['employee_created_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_created_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_created_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                           <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_created_full_name'] . '<br>
                                                                                   <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_created_role_name'] . '</label>
                                                                           </label>';
                                $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                                    <label class="title-name-new-table">' . $config['data']['list'][$i]['supplier_name'] . '<br>
                                                                               </label>';
                                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                                            <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="cancelOrderSupplierOrder(' . $config['data']['list'][$i]['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CANCEL . '"><i class="fi-rr-cross"></i></button>
                                                                            <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $config['data']['list'][$i]['id'] . ' ,' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ', ' . $config['data']['list'][$i]['supplier_id'] .')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                                        </div>';
                                break;
                            case Config::get('constants.type.OrderSupplierStatusEnum.DELIVERING'):
                                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                                $config['data']['list'][$i]['code'] = '<lable class="text">' . $config['data']['list'][$i]['code'] . '</lable>';
                                $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                                $config['data']['list'][$i]['amount_reality'] = $this->numberFormat($config['data']['list'][$i]['amount_reality']);
                                $config['data']['list'][$i]['total_amount_reality'] = $this->numberFormat($config['data']['list'][$i]['total_amount_reality']);
                                $config['data']['list'][$i]['discount_amount'] = $this->numberFormat($config['data']['list'][$i]['discount_amount']);
                                $config['data']['list'][$i]['vat_amount'] = $this->numberFormat($config['data']['list'][$i]['vat_amount']);
                                $config['data']['list'][$i]['employee_created_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_created_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_created_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                                               <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_created_full_name'] . '<br>
                                                                                                     <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_created_role_name'] . '</label>
                                                                                               </label>';
                                $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')">
                                                                                    <label class="title-name-new-table">' . $config['data']['list'][$i]['supplier_name'] . '<br>
                                                                               </label>';
                                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                                            <button class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="openReceivedOrderSupplierOrder(' . $config['data']['list'][$i]['id'] . ', ' . $config['data']['list'][$i]['supplier_id'] . ', ' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_GOODS_RECEIVED . '"><i class="fi-rr-box"></i></button>
                                                                            <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="cancelOrderSupplierOrder(' . $config['data']['list'][$i]['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CANCEL . '"><i class="fi-rr-cross"></i></button>
                                                                            <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $config['data']['list'][$i]['id'] . ' ,' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ', ' . $config['data']['list'][$i]['supplier_id'] .')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                                         </div>';
                                break;
                            default:
                                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                                $config['data']['list'][$i]['code'] = '<lable class="text">' . $config['data']['list'][$i]['code'] . '</lable>';
                                $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                                $config['data']['list'][$i]['amount_reality'] = $this->numberFormat($config['data']['list'][$i]['amount_reality']);
                                $config['data']['list'][$i]['total_amount_reality'] = $this->numberFormat($config['data']['list'][$i]['total_amount_reality']);
                                $config['data']['list'][$i]['discount_amount'] = $this->numberFormat($config['data']['list'][$i]['discount_amount']);
                                $config['data']['list'][$i]['vat_amount'] = $this->numberFormat($config['data']['list'][$i]['vat_amount']);
                                $config['data']['list'][$i]['employee_created_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_created_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_created_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                                               <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_created_full_name'] . '<br>
                                                                                                     <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_created_role_name'] . '</label>
                                                                                               </label>';
                                $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')">
                                                                                    <label class="title-name-new-table">' . $config['data']['list'][$i]['supplier_name'] . '<br>
                                                                               </label>';
                                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm ">
                                                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $config['data']['list'][$i]['id'] . ' ,' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ', ' . $config['data']['list'][$i]['supplier_id'] .')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                                        </div>';
                        }
                    }
                    break;
                case Config::get('constants.type.OrderSupplierStatusEnum.WEB_DONE'):
                    for ($i = 0; $i < count($config['data']['list']); $i++) {
                        $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                        $config['data']['list'][$i]['code'] = '<lable class="text">' . $config['data']['list'][$i]['code'] . '</lable>';
                        $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                        $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                        $config['data']['list'][$i]['total_amount_of_return_material_reality'] = $this->numberFormat($config['data']['list'][$i]['total_amount_of_return_material_reality']);
                        $config['data']['list'][$i]['amount_reality'] = $this->numberFormat($config['data']['list'][$i]['amount_reality']);
                        $config['data']['list'][$i]['return_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount_reality'] - $config['data']['list'][$i]['restaurant_debt_amount']);
                        $config['data']['list'][$i]['employee_complete_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_complete_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_complete_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                           <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_complete_full_name'] . '<br>
                                                                <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_complete_role_name'] . '</label>
                                                           </label>';
                        $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                                    <label class="title-name-new-table">' . $config['data']['list'][$i]['supplier_name'] . '<br>
                                                                               </label>';
                        if ($config['data']['list'][$i]['supplier_order_detail'][0]['quantity'] == 0 || ($config['data']['list'][$i]['payment_status'] == 1) || ($config['data']['list'][$i]['payment_status'] == 2)) {
                            //                                                                        <button type="button" class="btn btn-warning waves-effect waves-light" onclick="openNotReturnOrderSupplierOrder()" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_RETURN_TO_SUPPLIER . '"><span class="icofont icofont-ui-reply"></span></button>
                            $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                                       <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $config['data']['list'][$i]['id'] . ' ,' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ', ' . $config['data']['list'][$i]['supplier_id'] .')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                                    </div>';
                        } else {
                            $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm ">
                                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="openReturnOrderSupplierOrder(' . $config['data']['list'][$i]['id'] . ' ,' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_RETURN_TO_SUPPLIER . '"><i class="fi-rr-rotate-right"></i></button>
                                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $config['data']['list'][$i]['id'] . ' ,' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ', ' . $config['data']['list'][$i]['supplier_id'] .')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                                    </div>';
                        }
                        $config['data']['list'][$i]['total_amount_reality'] = $this->numberFormat($config['data']['list'][$i]['total_amount_reality']);
                        $config['data']['list'][$i]['discount_amount'] = $this->numberFormat($config['data']['list'][$i]['discount_amount']);
                        $config['data']['list'][$i]['vat_amount'] = $this->numberFormat($config['data']['list'][$i]['vat_amount']);
                        $config['data']['list'][$i]['restaurant_debt_amount'] = $this->numberFormat($config['data']['list'][$i]['restaurant_debt_amount']);
                        $config['data']['list'][$i]['received_at'] = substr($config['data']['list'][$i]['received_at'], 0, 10);
                    }
                    break;
                default:
                    for ($i = 0; $i < count($config['data']['list']); $i++) {
                        $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                        $config['data']['list'][$i]['code'] = '<lable class="text">' . $config['data']['list'][$i]['code'] . '</lable>';
                        $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                        $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                        $config['data']['list'][$i]['amount_reality'] = $this->numberFormat($config['data']['list'][$i]['amount_reality']);
                        $config['data']['list'][$i]['total_amount_reality'] = $this->numberFormat($config['data']['list'][$i]['total_amount_reality']);
                        $config['data']['list'][$i]['discount_amount'] = $this->numberFormat($config['data']['list'][$i]['discount_amount']);
                        $config['data']['list'][$i]['vat_amount'] = $this->numberFormat($config['data']['list'][$i]['vat_amount']);
                        $config['data']['list'][$i]['employee_cancel_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_cancel_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_cancel_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                           <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_cancel_full_name'] . '<br>
                                                                <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_cancel_role_name'] . '</label>
                                                           </label>';
                        $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                                    <label class="title-name-new-table">' . $config['data']['list'][$i]['supplier_name'] . '<br>
                                                                               </label>';
                        $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $config['data']['list'][$i]['id'] . ' ,' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ', ' . $config['data']['list'][$i]['supplier_id'] .')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                                </div>';
                    }
            }
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'key' => $key,
                'page' => $page,
                'config' => $configAll
            );

            $config_count = $configAll[1];
            $dataTable['count_import_order'] = $config_count['data']['import_request'];
            $dataTable['count_waiting_order'] = $config_count['data']['supplier_waiting_confirm'];
            $dataTable['count_delivery_order'] = $config_count['data']['order'];
            $dataTable['count_return_order'] = $config_count['data']['order_return'];
            $dataTable['count_cancel_order'] = $config_count['data']['cancel'];
            $dataTable['count_done_order'] = $config_count['data']['done'];
            $dataTable['count_history_request_order'] = $config_count['data']['restaurant_order_request_complete'];

            $config_total = $configAll[2];
            switch ($status) {
                case Config::get('constants.type.OrderSupplierStatusEnum.WEB_WAITING'):
                    $dataTable['amount_waiting'] = 0;
                    $dataTable['amount_received'] = $config_total['data']['amount'];
                    $dataTable['vat_received'] = $config_total['data']['vat_amount'];
                    $dataTable['discount_received'] = $config_total['data']['discount_amount'];
                    $dataTable['total_amount_received'] = $config_total['data']['total_amount'];

                    $dataTable['amount_done'] = 0;
                    $dataTable['vat_done'] = 0;
                    $dataTable['discount_done'] = 0;
                    $dataTable['total_amount_done'] = 0;
                    $dataTable['total_return_done'] = 0;
                    $dataTable['total_payment_done'] = 0;

                    $dataTable['amount_cancel'] = 0;
                    $dataTable['vat_cancel'] = 0;
                    $dataTable['discount_cancel'] = 0;
                    $dataTable['total_amount_cancel'] = 0;

                    $dataTable['amount_return'] = 0;
                    $dataTable['vat_return'] = 0;
                    $dataTable['discount_return'] = 0;
                    $dataTable['total_amount_return'] = 0;
                    break;
                case Config::get('constants.type.OrderSupplierStatusEnum.WEB_DONE'):
                    $dataTable['amount_waiting'] = 0;
                    $dataTable['amount_received'] = 0;
                    $dataTable['vat_received'] = 0;
                    $dataTable['discount_received'] = 0;
                    $dataTable['total_amount_received'] = 0;
                    $dataTable['amount_done'] = $config_total['data']['amount'];
                    $dataTable['vat_done'] = $config_total['data']['vat_amount'];
                    $dataTable['discount_done'] = $config_total['data']['discount_amount'];
                    $dataTable['total_amount_done'] = $config_total['data']['total_amount'];
                    $dataTable['total_return_done'] = $config_total['data']['total_amount_return'];
                    $dataTable['total_payment_done'] = $config_total['data']['total_payment'];

                    $dataTable['amount_cancel'] = 0;
                    $dataTable['vat_cancel'] = 0;
                    $dataTable['discount_cancel'] = 0;
                    $dataTable['total_amount_cancel'] = 0;

                    $dataTable['amount_return'] = 0;
                    $dataTable['vat_return'] = 0;
                    $dataTable['discount_return'] = 0;
                    $dataTable['total_amount_return'] = 0;
                    break;
                default:
                    $dataTable['amount_waiting'] = 0;

                    $dataTable['amount_received'] = 0;
                    $dataTable['vat_received'] = 0;
                    $dataTable['discount_received'] = 0;
                    $dataTable['total_amount_received'] = 0;

                    $dataTable['amount_done'] = 0;
                    $dataTable['vat_done'] = 0;
                    $dataTable['discount_done'] = 0;
                    $dataTable['total_amount_done'] = 0;

                    $dataTable['amount_cancel'] = $config_total['data']['amount'];
                    $dataTable['vat_cancel'] = $config_total['data']['vat_amount'];
                    $dataTable['discount_cancel'] = $config_total['data']['discount_amount'];
                    $dataTable['total_amount_cancel'] = $config_total['data']['total_amount'];
                    $dataTable['total_return_done'] = $config_total['data']['total_amount_return'];
                    $dataTable['total_payment_done'] = $config_total['data']['total_payment'];

                    $dataTable['amount_return'] = 0;
                    $dataTable['vat_return'] = 0;
                    $dataTable['discount_return'] = 0;
                    $dataTable['total_amount_return'] = 0;
            }
            return json_encode($dataTable);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataListReturn(Request $request)
    {
        $branch = $request->get('branch');
        $from_date = $request->get('from');
        $to_date = $request->get('to');
        $supplier = Config::get('constants.type.id.NONE');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $status = Config::get('constants.type.status.GET_ALL');
        $api = sprintf(API_GET_RETURN_ORDER_SUPPLIER, $branch, $status, $from_date, $to_date, $supplier, $page, $limit, $key);
        $body = null;
        $requestList = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $type = Config::get('constants.type.TypeSearchSupplierOrder.supplier_material_RETURN_REQUEST');
        $api = sprintf(API_GET_COUNT_ORDER_SUPPLIER, $branch, $from_date, $to_date, $key, $type);
        $body = null;
        $requestTab = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_GET_TOTAL_ORDER_RETURN, $branch, $status, $from_date, $to_date, $supplier, $page, $limit, $key);
        $body = null;
        $requestTotal = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTab, $requestTotal]);
        try {
            $config = $configAll[0];
              for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount']);
                $config['data']['list'][$i]['discount_amount'] = $this->numberFormat($config['data']['list'][$i]['discount_amount']);
                $config['data']['list'][$i]['vat_amount'] = $this->numberFormat($config['data']['list'][$i]['vat_amount']);
                $config['data']['list'][$i]['employee_created_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_created_avatar'] .'" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_created_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                               <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_created_full_name'] . '<br>
                                                                               <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_role_name'] . '</label>
                                                                               </label>';

                $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                                    <label class="title-name-new-table">' . $config['data']['list'][$i]['supplier_name'] . '<br>
                                                                               </label>';
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailReturnOrder(' . $config['data']['list'][$i]['id'] . ' )" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                         </div>';
            }
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'key' => $key,
                'page' => $page,
                'config' => $configAll,
            );
            $config_count = $configAll[1];
            $dataTable['count_import_order'] = $config_count['data']['import_request'];
            $dataTable['count_waiting_order'] = $config_count['data']['supplier_waiting_confirm'];
            $dataTable['count_delivery_order'] = $config_count['data']['order'];
            $dataTable['count_return_order'] = $config_count['data']['order_return'];
            $dataTable['count_cancel_order'] = $config_count['data']['cancel'];
            $dataTable['count_done_order'] = $config_count['data']['done'];
            $dataTable['count_history_request_order'] = $config_count['data']['restaurant_order_request_complete'];

            $config_total = $configAll[2];
            $dataTable['amount_waiting'] = 0;

            $dataTable['amount_received'] = 0;
            $dataTable['vat_received'] = 0;
            $dataTable['discount_received'] = 0;
            $dataTable['total_amount_received'] = 0;

            $dataTable['amount_done'] = 0;
            $dataTable['vat_done'] = 0;
            $dataTable['discount_done'] = 0;
            $dataTable['total_amount_done'] = 0;
            $dataTable['total_return_done'] = 0;
            $dataTable['total_payment_done'] = 0;

            $dataTable['amount_cancel'] = 0;
            $dataTable['vat_cancel'] = 0;
            $dataTable['discount_cancel'] = 0;
            $dataTable['total_amount_cancel'] = 0;

            $dataTable['amount_return'] = $config_total['data']['amount'];
            $dataTable['vat_return'] = $config_total['data']['vat_amount'];
            $dataTable['discount_return'] = $config_total['data']['discount_amount'];
            $dataTable['total_amount_return'] = $config_total['data']['total_amount'];
            return json_encode($dataTable);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function historyRequest(Request $request)
    {
        $branch = $request->get('branch');
        $status =  "2,3,4,5,6,7";
        $from_date = $request->get('from');
        $to_date = $request->get('to');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $api = sprintf(API_GET_LIST_INTERNAL_ORDER_SUPPLIER, $branch, $status, $from_date, $to_date, $page, $limit, $key);
        $body = null;
        $requestList = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $type = 0;
        $api = sprintf(API_GET_COUNT_ORDER_SUPPLIER, $branch, $from_date, $to_date, $key, $type);
        $body = null;
        $requestTab = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTab]);
        $config = $configAll[0];
        for ($i = 0; $i < count($config['data']['list']); $i++) {
            $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
            $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
            $config['data']['list'][$i]['code'] = $config['data']['list'][$i]['code'];
//            $config['data']['list'][$i]['inventory'] = ($config['data']['list'][$i]['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.MATERIAL')) ? TEXT_INVENTORY_KITCHEN : TEXT_INVENTORY_BAR;
            switch ($config['data']['list'][$i]['branch_inner_inventory_type']) {
                case 1:
                    $config['data']['list'][$i]['inventory'] = TEXT_INVENTORY_KITCHEN;
                    break;
                case 2:
                    $config['data']['list'][$i]['inventory'] = TEXT_INVENTORY_BAR;
                    break;
                case 3:
                    $config['data']['list'][$i]['inventory'] = TEXT_INVENTORY_BUSINESS_EMPLOYEE;
                    break;
                case 4:
                    $config['data']['list'][$i]['inventory'] = TEXT_INVENTORY_FOOD_EMPLOYEE;
                    break;
                default:
                    break;
            }
            $config['data']['list'][$i]['created_at'] = $config['data']['list'][$i]['created_at'];
            $config['data']['list'][$i]['material_quantity'] = $config['data']['list'][$i]['material_quantity'];
            $config['data']['list'][$i]['employee_create_full_name'] = '<img onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_create_avatar'] . "'" . ')" onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_create_avatar'] . '" class="img-inline-name-data-table">
                                                                               <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_create_full_name'] . '<br> <label class="department-inline-name-data-table"> <i class="zmdi zmdi-account-circle mr-1"></i>'. $config['data']['list'][$i]['employee_create_employee_role_name'] .'</label></label>';
            switch ($config['data']['list'][$i]['status']) {
                case 5 :
                    $paid_status_name = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                            <label class="m-0">' . TEXT_CANCELED . '</label>
                                         </div>';
                    break;
                case 7:
                    $paid_status_name = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                            <label class="m-0">' . TEXT_DONE . '</label>
                                         </div>';
                    break;
                default :
                    $paid_status_name = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                            <label class="m-0">Chờ xuất kho</label>
                                         </div>';
                    break;
            }
            $config['data']['list'][$i]['paid_status'] = $paid_status_name;
            $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRequestSupplierOrder(' . $config['data']['list'][$i]['id'] . ', ' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ', $(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                         </div>';
        }
        $config_count = $configAll[1];
        $dataTable = array(
            'draw' => $request->get('draw'),
            'recordsTotal' => $config['data']['total_record'],
            'recordsFiltered' => $config['data']['total_record'],
            'data' => $config['data']['list'],
            'key' => $key,
            'page' => $page,
            'config' => $configAll,
        );
        $dataTable['count_import_order'] = $config_count['data']['import_request'];
        $dataTable['count_waiting_order'] = $config_count['data']['supplier_waiting_confirm'];
        $dataTable['count_delivery_order'] = $config_count['data']['order'];
        $dataTable['count_return_order'] = $config_count['data']['order_return'];
        $dataTable['count_cancel_order'] = $config_count['data']['cancel'];
        $dataTable['count_done_order'] = $config_count['data']['done'];
        $dataTable['count_history_request_order'] = $config_count['data']['restaurant_order_request_complete'];
        $dataTable['amount_waiting'] = 0;

        $dataTable['amount_received'] = 0;
        $dataTable['vat_received'] = 0;
        $dataTable['discount_received'] = 0;
        $dataTable['total_amount_received'] = 0;

        $dataTable['amount_done'] = 0;
        $dataTable['vat_done'] = 0;
        $dataTable['discount_done'] = 0;
        $dataTable['total_amount_done'] = 0;
        $dataTable['total_return_done'] = 0;
        $dataTable['total_payment_done'] = 0;

        $dataTable['amount_cancel'] = 0;
        $dataTable['vat_cancel'] = 0;
        $dataTable['discount_cancel'] = 0;
        $dataTable['total_amount_cancel'] = 0;

        $dataTable['amount_return'] = 0;
        $dataTable['vat_return'] = 0;
        $dataTable['discount_return'] = 0;
        $dataTable['total_amount_return'] = 0;
        return json_encode($dataTable);
    }

    public function materialSupplier(Request $request)
    {
        $branch = (int)$request->get('branch');
        $inventory = Config::get('constants.type.data.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_LIST_MATERIAL_ORDER_SUPPLIER, $branch, $inventory);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $data = [
                'material' => $collection->where('material_category_type_parent_id', Config::get('constants.type.inventory.MATERIAL'))->toArray(),
                'goods' => $collection->where('material_category_type_parent_id', Config::get('constants.type.inventory.GOODS'))->toArray(),
                'internal' => $collection->where('material_category_type_parent_id', Config::get('constants.type.inventory.INTERNAL'))->toArray(),
                'other' => $collection->where('material_category_type_parent_id', Config::get('constants.type.inventory.OTHER'))->toArray(),
            ];
            $material_table = $this->drawTableSelectMultiMaterial($data['material']);
            $goods_table = $this->drawTableSelectMultiMaterial($data['goods']);
            $internal_table = $this->drawTableSelectMultiMaterial($data['internal']);
            $other_table = $this->drawTableSelectMultiMaterial($data['other']);
            $material = '<option value="" selected disabled>' . TEXT_CHOOSE_MATERIAL . '</option>';
            $goods = '<option value="" selected disabled>' . TEXT_CHOOSE_MATERIAL . '</option>';
            $internal = '<option value="" selected disabled>' . TEXT_CHOOSE_MATERIAL . '</option>';
            $other = '<option value="" selected disabled >' . TEXT_CHOOSE_MATERIAL . '</option>';
            foreach ($config['data'] as $db) {
                $price = $db['is_office_material'] ? $this->numberFormat($db['price']) : $this->numberFormat($db['suppliers'][0]['retail_price']);
                switch ($db['material_category_type_parent_id']) {
                    case Config::get('constants.type.inventory.MATERIAL'):
                        $material .= '<option value="' . $db['restaurant_material_id'] . '" data-is-office="'. $db['is_office_material'] .'" data-remain-quantity="' . $this->numberFormat($db['system_last_quantity']) . '" data-unit="' . $db['material_unit_full_name'] . '" data-price="' . $price . '" data-keysearch="' . $this->keySearchDatatableTemplate([$db['material_unit_full_name'], $db['name']]) . '">' . $db['name'] . '</option>';
                        break;
                    case Config::get('constants.type.inventory.GOODS'):
                        $goods .= '<option value="' . $db['restaurant_material_id'] . '" data-is-office="'. $db['is_office_material'] .'" data-remain-quantity="' . $this->numberFormat($db['system_last_quantity']) . '" data-unit="' . $db['material_unit_full_name'] . '" data-price="' . $price . '" data-keysearch="' . $this->keySearchDatatableTemplate([$db['material_unit_full_name'], $db['name']]) . '">' . $db['name'] . '</option>';
                        break;
                    case Config::get('constants.type.inventory.INTERNAL'):
                        $internal .= '<option value="' . $db['restaurant_material_id'] . '" data-is-office="'. $db['is_office_material'] .'" data-remain-quantity="' . $this->numberFormat($db['system_last_quantity']) . '" data-unit="' . $db['material_unit_full_name'] . '" data-price="' . $price . '" data-keysearch="' . $this->keySearchDatatableTemplate([$db['material_unit_full_name'], $db['name']]) . '">' . $db['name'] . '</option>';
                        break;
                    case Config::get('constants.type.inventory.OTHER'):
                        $other .= '<option value="' . $db['restaurant_material_id'] . '" data-is-office="'. $db['is_office_material'] .'" data-remain-quantity="' . $this->numberFormat($db['system_last_quantity']) . '" data-unit="' . $db['material_unit_full_name'] . '" data-price="' . $price . '" data-keysearch="' . $this->keySearchDatatableTemplate([$db['material_unit_full_name'], $db['name']]) . '">' . $db['name'] . '</option>';
                        break;
                    default:
                        break;
                }
            }
            if ($material === '<option value="" selected disabled>' . TEXT_DEFAULT_OPTION . '</option>') {
                $material = '<option value="" selected>' . TEXT_NULL_OPTION . '</option>';
            }
            if ($goods === '<option value="" selected disabled>' . TEXT_DEFAULT_OPTION . '</option>') {
                $goods = '<option value="" selected>' . TEXT_NULL_OPTION . '</option>';
            }
            if ($internal === '<option value="" selected disabled>' . TEXT_DEFAULT_OPTION . '</option>') {
                $internal = '<option value="" selected>' . TEXT_NULL_OPTION . '</option>';
            }
            if ($other === '<option value="" selected disabled>' . TEXT_DEFAULT_OPTION . '</option>') {
                $other = '<option value="" selected>' . TEXT_NULL_OPTION . '</option>';
            }
            return [$material, $goods, $internal, $other, $data, $config, $material_table, $goods_table, $internal_table, $other_table];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTableSelectMultiMaterial ($data)
        {
            return DataTables::of($data)
                ->addColumn('checkbox', function ($row) {
                    $price = $row['is_office_material'] ? number_format($row['price']) : number_format($row['suppliers'][0]['retail_price']);
                    return '<div class="form-validate-checkbox">
                                <div class="checkbox-form-group" style="justify-content: flex-start" data-id="'. $row['restaurant_material_id'].'" data-remain-quantity="' . $this->numberFormat($row['system_last_quantity']) . '"
                                    data-is-office="'. $row['is_office_material'] .'" data-price="' . $price . '" data-unit="' . $row['material_unit_full_name'] . '" data-keysearch="' . $this->keySearchDatatableTemplate([$row['material_unit_full_name'], $row['name']]) . '">
                                    <input type="checkbox" style="top: 4px" class="check-apply-material"/>
                                </div>
                            </div>';
                })
                ->addColumn('price', function ($row) {
                    return number_format($row['price']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['checkbox', 'price'])
                ->addIndexColumn()
                ->make(true);
        }
    public function supplier(Request $request)
    {
        $branch = $request->get('branch');
        $is_restaurant_supplier = Config::get('constants.type.status.GET_ALL');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SUPPLIER_POST_ASSIGN_TO_RESTAURANT_BRANCH, $branch, $is_restaurant_supplier, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $data = $collection->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->where('is_take_my_supplier', (int)Config::get('constants.type.checkbox.SELECTED'))->toArray();
            if (count($data) === 0) {
                $supplier = '<option value="" selected>' . TEXT_NULL_OPTION . '</option>';
            } else {
                $supplier = '';
                foreach ($data as $db) {
                    $supplier .= '<option value="' . $db['id'] . '" data-type="' . $db['is_restaurant_supplier'] . '">' . $db['name'] . '</option>';
                }
            }
            return [$supplier, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
    public function create(Request $request)
    {
        $id = Config::get('constants.type.id.NONE');
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $material = $request->get('material');
        $send = Config::get('constants.type.checkbox.SELECTED');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_POST_UPDATE_REQUEST_ORDER_SUPPLIER;
        $body = [
            'restaurant_brand_id' => $brand,
            'branch_id' => $branch,
            'restaurant_material_order_request_id' => $id,
            'list_material' => $material,
            'date' => $request->get('date'),
            'status' => $send,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataUpdateRequest(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $export = $request->get('export');
        $api = sprintf(API_GET_DETAIL_REQUEST_ORDER_SUPPLIER, $id);
        $body = null;
        $requestDetail = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_GET_LIST_MATERIAL_ORDER_SUPPLIER, $branch, $export);
        $body = null;
        $requestMaterialRestaurant = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $is_user = ENUM_SELECTED;
        $api = sprintf(API_GET_DETAIL_MATERIAL_REQUEST_ORDER_SUPPLIER, $id, $brand, $branch, $is_user);
        $body = null;
        $requestMaterialOrder = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestDetail, $requestMaterialRestaurant, $requestMaterialOrder]);
        try {
            $data = $configAll[0]['data'];
//            $data['inventory'] = ($data['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.MATERIAL')) ? TEXT_INVENTORY_KITCHEN : TEXT_INVENTORY_BAR;
            $dataDetail = $data;
            $dataDetail['employee_create_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['employee_create_avatar'];
            $material = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            if (count($configAll[1]['data']) > 0) {
                $material = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
                foreach ($configAll[1]['data'] as $db) {
                    $material .= '<option value="' . $db['restaurant_material_id'] . '">' . $db['name'] . '</option>';
                }
            }
            $dataTableMaterial = DataTables::of($configAll[2]['data'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('restaurant_material_name', function ($row) use ($data){
                    foreach ($data['restaurant_material_order_request_detail'] as $db) {
                          return $row['restaurant_material_name'] . '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['restaurant_unit_full_name'] . '</label>
                                                                    </div>';
                    }
                })
                ->addColumn('system_last_quantity', function ($row) {
                    return $this->numberFormat($row['system_last_quantity']);
                })
                ->addColumn('quantity', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input class="form-control adjustment text-center rounded border-0 w-100" data-max="9999" data-min="0" data-type="currency-edit" data-float="1" value="' . $this->numberFormat($row['account_quantity']) . '">
                            </div>';
                })
                ->addColumn('price', function ($row) {
                    if ($row['supplier_id'] === 0) {
                        return $this->numberFormat($row['suppliers'][0]['retail_price']);
                    } else {
                        return $this->numberFormat(collect($row['suppliers'])->where('id', $row['supplier_id'])->first()['retail_price']);
                    }
                })
                ->addColumn('total_price_not_format', function ($row) {
                    if ($row['supplier_id'] === 0) {
                        return $row['account_quantity'] * $row['suppliers'][0]['retail_price'];
                    } else {
                        return $row['account_quantity'] * collect($row['suppliers'])->where('id', $row['supplier_id'])->first()['retail_price'];
                    }
                })
                ->addColumn('total_price', function ($row) {
                    if ($row['supplier_id'] === 0) {
                        return $this->numberFormat($row['account_quantity'] * $row['suppliers'][0]['retail_price']);
                    } else {
                        return $this->numberFormat($row['account_quantity'] * collect($row['suppliers'])->where('id', $row['supplier_id'])->first()['retail_price']);
                    }
                })
                ->addColumn('suppliers', function ($row) {
                    $provide = '';
                    foreach ($row['suppliers'] as $supplier) {
                        $select = ($supplier['id'] === $row['supplier_id']) ? 'selected' : '';
                        $provide .= '<option ' . $select . ' value="' . $supplier['id'] . '" data-type="' . $supplier['restaurant_id'] . '" data-price="' . $supplier['retail_price'] . '" data-wholesale-price="' . $supplier['wholesale_price'] . '" data-wholesale-quantity="' . $supplier['wholesale_price_quantity'] . '">' . $supplier['name'] . ' ('. $this->numberFormat($supplier['retail_price']) .')</option>';
                    }
                    return '<select class="js-example-basic-single">' . $provide . '</select>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $row['restaurant_material_id'] . '" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['restaurant_material_name', 'quantity', 'suppliers', 'action'])
                ->addIndexColumn()
                ->make();
            $dataTotal = $this->numberFormat(collect($dataTableMaterial->original['data'])->sum('total_price_not_format'));
            return [$dataDetail, $material, $configAll[1]['data'], $dataTableMaterial, $dataTotal, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function updateRequest(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $material = $request->get('material');
        $send = $request->get('send');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_UPDATE_REQUEST_ORDER_SUPPLIER);
        $body = [
            'restaurant_brand_id' => $brand,
            'branch_id' => $branch,
            'restaurant_material_order_request_id' => $id,
            'list_material' => $material,
            'date' => $request->get('date'),
            'status' => $send,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function cancelRequest(Request $request)
    {
        $id = $request->get('id');
        $reason = $request->get('reason');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_STATUS_REQUEST_ORDER_SUPPLIER, $id);
        $body = [
            'status' => Config::get('constants.type.OrderSupplierInternalStatusEnum.CANCELLED'),
            'reason' => $reason,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function confirmRequest(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_CONFIRM_REQUEST_ORDER_SUPPLIER);
        $body = [
            'restaurant_material_order_request_id' => $id,
            'status' => Config::get('constants.type.OrderSupplierInternalStatusEnum.WAITING_CONFIRM'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataDetailRequest(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $api = sprintf(API_GET_DETAIL_REQUEST_ORDER_SUPPLIER, $id);
        $body = null;
        $requestDetail = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $is_user = ENUM_SELECTED;
        $api = sprintf(API_GET_DETAIL_MATERIAL_REQUEST_ORDER_SUPPLIER, $id, $brand, $branch, $is_user);
        $body = null;
        $requestMaterial = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestDetail, $requestMaterial]);
        try {
            $data = $configAll[0]['data'];
            switch ($data['status']) {
                case 5 :
                    $paid_status = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">Đã hủy</label>
                                     </div>';
                    break;
                case 7 :
                    $paid_status = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">Hoàn tất</label>
                                     </div>';
                    break;
                default :
                    $paid_status = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">Chờ xuất kho</label>
                                     </div>';
                    break;
            }
            $data['employee_create_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $data['employee_create_avatar'];
            $data['paid_status'] = $paid_status;
            $dataDetail = $data;
            $dataTableMaterial = DataTables::of($configAll[1]['data'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('name', function ($row) {
                      return $row['restaurant_material_name'] . '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['restaurant_unit_full_name'] . '</label>
                                                                    </div>';
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['account_quantity']);
                })
                ->addColumn('system_last_quantity', function ($row) {
                    return $this->numberFormat($row['system_last_quantity']);
                })
                ->addColumn('price', function ($row) {
                    if ($row['supplier_id'] === 0) {
                        return $this->numberFormat($row['suppliers'][0]['retail_price']);
                    } else {
                        return $this->numberFormat(collect($row['suppliers'])->where('id', $row['supplier_id'])->first()['retail_price']);
                    }
                })
                ->addColumn('total_price_not_format', function ($row) {
                    if ($row['supplier_id'] === 0) {
                        return $row['account_quantity'] * $row['suppliers'][0]['retail_price'];
                    } else {
                        return $row['account_quantity'] * collect($row['suppliers'])->where('id', $row['supplier_id'])->first()['retail_price'];
                    }
                })
                ->addColumn('total_price', function ($row) {
                    if ($row['supplier_id'] === 0) {
                        return $this->numberFormat($row['account_quantity'] * $row['suppliers'][0]['retail_price']);
                    } else {
                        return $this->numberFormat($row['account_quantity'] * collect($row['suppliers'])->where('id', $row['supplier_id'])->first()['retail_price']);
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $row['restaurant_material_id'] . '" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                })
                ->rawColumns(['name', 'quantity', 'suppliers', 'action', 'employee_create_avatar'])
                ->addIndexColumn()
                ->make();
            $dataTotal = $this->numberFormat(collect($dataTableMaterial->original['data'])->sum('total_price_not_format'));
            return [$dataDetail, $dataTableMaterial, $dataTotal, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function confirmRestaurant(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_CONFIRM_RESTAURANT_ORDER_SUPPLIER);
        $body = [
            'supplier_order_request_id' => $id,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function cancelRestaurant(Request $request)
    {
        $id = $request->get('id');
        $reason = $request->get('reason');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_STATUS_RESTAURANT_ORDER_SUPPLIER, $id);
        $body = [
            'status' => Config::get('constants.type.OrderSupplierRestaurantStatusEnum.CANCELLED'),
            'reason' => $reason,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataUpdateRestaurant(Request $request)
    {
        $id = $request->get('id');
        $api = sprintf(API_GET_DETAIL_MATERIAL_RESTAURANT_ORDER_SUPPLIER, $id);
        $body = null;
        $requestDetail = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_GET_LIST_MATERIAL_RESTAURANT_ORDER_SUPPLIER, $id);
        $body = null;
        $requestMaterialRestaurant = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestDetail, $requestMaterialRestaurant]);
        try {
            $dataDetail = $configAll[0]['data'];
            if ($dataDetail['status'] === Config::get('constants.type.OrderSupplierRestaurantStatusEnum.WAITING_RESTAURANT_CREATE_SUPPLIER_ORDER')) {
                $dataDetail['supplier_amount'] = $this->numberFormat($dataDetail['supplier_total_amount']);
            } else {
                $dataDetail['supplier_amount'] = $this->numberFormat($dataDetail['total_amount']);
            }

            $dataDetail['expected_delivery_time'] = explode(' ', $dataDetail['expected_delivery_time'])[0];
            $dataDetail['employee_created_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['employee_created_avatar'];
            $dataDetail['supplier_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['supplier_avatar'];
            $dataDetail['branch_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['branch_avatar'];

            $dataDetail['type'] = 0;
            $dataTableMaterial = DataTables::of($configAll[1]['data'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('restaurant_material_name', function ($row) {
                      return $row['restaurant_material_name'] . '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['restaurant_material_unit_full_name'] . '</label>
                                                                    </div>';
                })
                ->addColumn('quantity', function ($row) {
                    if ($row['status'] === Config::get('constants.type.OrderSupplierRestaurantStatusEnum.WAITING_RESTAURANT_CREATE_SUPPLIER_ORDER')) {
                        $quantity = $this->numberFormat($row['supplier_quantity']);
                    } else {
                        $quantity = $this->numberFormat($row['quantity']);
                    }
                    return '<div class="input-group border-group validate-table-validate">
                              <input class="form-control adjustment text-center rounded border-0 w-100" data-float="1" data-min="0" data-max="9999" value="' . $quantity . '" data-type="currency-edit">
                            </div>';
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['retail_price']);
                })
                ->addColumn('total_price', function ($row) {
                    if ($row['status'] === Config::get('constants.type.OrderSupplierRestaurantStatusEnum.WAITING_RESTAURANT_CREATE_SUPPLIER_ORDER')) {
                        return $this->numberFormat($row['supplier_total_amount']);
                    } else {
                        return $this->numberFormat($row['total_amount']);
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $row['id'] . '" data-id-supplier="' . $row['supplier_material_id'] . '" data-id-restaurant="' . $row['restaurant_material_id'] . '" data-supplier="' . $row['supplier_id'] . '" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['restaurant_material_name', 'quantity', 'action'])
                ->addIndexColumn()
                ->make();
            return [$dataDetail, $dataTableMaterial, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function updateRestaurant(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $material = $request->get('material');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_UPDATE_RESTAURANT_ORDER_SUPPLIER, $id);
        $body = [
            'restaurant_brand_id' => $brand,
            'branch_id' => $branch,
            'restaurant_material_order_request_id' => $id,
            'list_material' => $material,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataDetailRestaurant(Request $request)
    {
        $id = $request->get('id');
        $api = sprintf(API_GET_DETAIL_MATERIAL_RESTAURANT_ORDER_SUPPLIER, $id);
        $body = null;
        $requestDetail = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_GET_LIST_MATERIAL_RESTAURANT_ORDER_SUPPLIER, $id);
        $body = null;
        $requestMaterial = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestDetail, $requestMaterial]);
        try {
            $dataDetail = $configAll[0]['data'];
            if ($dataDetail['status'] === Config::get('constants.type.OrderSupplierRestaurantStatusEnum.WAITING_RESTAURANT_CREATE_SUPPLIER_ORDER')) {
                $dataDetail['supplier_amount'] = $this->numberFormat($dataDetail['supplier_total_amount']);
            } else {
                $dataDetail['supplier_amount'] = $this->numberFormat($dataDetail['total_amount']);
            }
            $dataDetail['expected_delivery_time'] = explode(' ', $dataDetail['expected_delivery_time'])[0];
            $dataDetail['employee_created_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['employee_created_avatar'];
            $dataDetail['branch_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['branch_avatar'];
            $dataDetail['supplier_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['supplier_avatar'];
            $dataTableMaterial = DataTables::of($configAll[1]['data'])
                ->addColumn('name', function ($row) {
                    return $row['restaurant_material_name'] . '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['restaurant_material_unit_full_name'] . '</label>
                                                                    </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    $keysearch = [$row['restaurant_material_name'], $row['restaurant_material_unit_full_name'], $row['quantity'], $row['retail_price'], $row['total_amount']];
                    return $this->keySearchDatatableTemplate($keysearch);
                })
                ->addColumn('quantity', function ($row) {
                    if ($row['status'] === Config::get('constants.type.OrderSupplierRestaurantStatusEnum.WAITING_RESTAURANT_CREATE_SUPPLIER_ORDER')) {
                        return $this->numberFormat($row['supplier_quantity']);
                    } else {
                        return $this->numberFormat($row['quantity']);
                    }
                })
                ->addColumn('quantity_supplier', function ($row) {
                    return $this->numberFormat($row['supplier_quantity']);
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['retail_price']);
                })
                ->addColumn('total_price', function ($row) {
                    if ($row['status'] === Config::get('constants.type.OrderSupplierRestaurantStatusEnum.WAITING_RESTAURANT_CREATE_SUPPLIER_ORDER')) {
                        return $this->numberFormat($row['supplier_total_amount']);
                    } else {
                        return $this->numberFormat($row['total_amount']);
                    }
                })
                ->addColumn('supplier_total_amount', function ($row) {
                    return $this->numberFormat($row['supplier_total_amount']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['name', 'quantity', 'action'])
                ->addIndexColumn()
                ->make();
            return [$dataDetail, $dataTableMaterial, $configAll];
        } catch (Exception $e) {
            return [$configAll, $e];
        }
    }

    public function confirmOrder(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_STATUS_ORDER_SUPPLIER, $id);
        $body = [
            'status' => Config::get('constants.type.OrderSupplierStatusEnum.DELIVERING'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function cancelOrder(Request $request)
    {
        $id = $request->get('id');
        $reason = $request->get('reason');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_STATUS_ORDER_SUPPLIER, $id);
        $body = [
            'status' => Config::get('constants.type.OrderSupplierStatusEnum.CANCELED'),
            'reason' => $reason,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataReceivedOrder(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $supplier = $request->get('supplier');
        $api = sprintf(API_GET_DETAIL_ORDER_SUPPLIER, $id);
        $body = null;
        $requestDetail = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_GET_MATERIAL_ORDER_SUPPLIER, $id, $brand, $branch, $supplier);
        $body = null;
        $requestMaterial = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestDetail, $requestMaterial]);
            try {
            $dataTableMaterial = DataTables::of($configAll[1]['data'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('request_quantity', function ($row) {
                    return $this->numberFormat($row['total_quantity']);
                })
                ->addColumn('name', function ($row) {
//                    return $row['restaurant_material_name'] . '<br><label class="m-t-2 label label-info">' . $row['restaurant_material_unit_full_name'] . '</label>';
                      return $row['restaurant_material_name'] . '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['restaurant_material_unit_full_name'] . '</label>
                                                                    </div>';
                })
                ->addColumn('accept_quantity', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input class="form-control adjustment text-center rounded border-0 w-100" data-max="9999" data-min="0" data-float="1" data-rate="' . $row['material_unit_conversion_rate'] . '" value="' . $this->numberFormat($row['total_quantity']) . '" data-type="currency-edit" >
                            </div>';
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('total_price_reality', function ($row) {
                    return $this->numberFormat($row['total_price_reality']);
                })
                ->addColumn('price_reality', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input class="form-control price text-center rounded border-0 w-100" data-max="100000000" data-min="0" data-float="1" value="' . $this->numberFormat($row['price']) . '" data-type="currency-edit" data-money="1">
                            </div>';
                })
                ->addColumn('total_price', function ($row) {
                    return $this->numberFormat($row['total_price']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $row['id'] . '" data-material="' . $row['supplier_material_id'] . '" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                })
                ->rawColumns(['name', 'accept_quantity', 'request_quantity', 'price_reality', 'action'])
                ->addIndexColumn()
                ->make();
            $configAll[0]['data']['employee_created_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $configAll[0]['data']['employee_created_avatar'];
            $configAll[0]['data']['supplier_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $configAll[0]['data']['supplier_avatar'];
            $configAll[0]['data']['restaurant_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $configAll[0]['data']['restaurant_avatar'];
            return [$configAll[0]['data'], $dataTableMaterial, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function receivedOrder(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $supplier = $request->get('supplier');
        $material = $request->get('material');
        $received = $request->get('received');
        $vat = $request->get('vat');
        $discount = $request->get('discount');
        $discount_amount = $request->get('discount_amount');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_RECEIVED_ORDER_SUPPLIER, $id);
        $body = [
            'restaurant_brand_id' => $brand,
            'branch_id' => $branch,
            'supplier_employee_delivering_name' => '',
            'supplier_employee_delivering_avatar' => '',
            'supplier_id' => $supplier,
            'vat' => $vat,
            'discount_percent' => $discount,
            'discount_amount' => $discount_amount,
            'list_material' => $material,
            'received_at' => $received,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function detailOrder(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $supplier = $request->get('supplier');
        $api = sprintf(API_GET_DETAIL_ORDER_SUPPLIER, $id);
        $body = null;
        $requestDetail = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_GET_MATERIAL_ORDER_SUPPLIER, $id, $brand, $branch, $supplier);
        $body = null;
        $requestMaterial = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestDetail, $requestMaterial]);
        try {
            $dataDetail = $configAll[0]['data'];
            $dataDetail['supplier_employee_delivering_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['supplier_employee_delivering_avatar'];
            $dataDetail['employee_created_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['employee_created_avatar'];
            $dataDetail['supplier_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['supplier_avatar'];
            $dataDetail['restaurant_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['restaurant_avatar'];
            $dataDetail['employee_cancel_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['employee_cancel_avatar'];
            $dataDetail['employee_complete_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['employee_complete_avatar'];
            $dataTableMaterial = DataTables::of($configAll[1]['data'])
                ->addColumn('keysearch', function ($row) {
                    $keysearch = [$row['restaurant_material_name'], $row['restaurant_material_unit_full_name'], $row['accept_quantity'], $row['request_quantity'], $row['response_quantity'], $row['return_quantity'], $row['price'], $row['price_reality'], $row['total_price_reality']];
                    return $this->keySearchDatatableTemplate($keysearch);
                })
                ->addColumn('name', function ($row) {
                      return $row['restaurant_material_name'] . '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['restaurant_material_unit_full_name'] . '</label>
                                                                    </div>';
                })
                ->addColumn('quantity', function ($row) {
                    return 'Yêu cầu: ' . $this->numberFormat($row['request_quantity']) . '<br>
                            Giao: ' . $this->numberFormat($row['response_quantity']) . '<br>
                            <label class="d-flex">Trả: ' . $this->numberFormat($row['return_quantity']) . '<i class="icofont icofont-long-arrow-down text-danger pl-1"></i>' . '</label>
                            <label class="font-weight-bold d-flex">Nhận: ' . $this->numberFormat($row['accept_quantity']) . ' <i class="icofont icofont-check text-success pl-1"></i>' . '</label>';
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('price_reality', function ($row) {
                    return $this->numberFormat($row['price_reality']);
                })
                ->addColumn('total_price', function ($row) {
                    return $this->numberFormat($row['total_price']);
                })
                ->addColumn('total_price_reality', function ($row) {
                    return $this->numberFormat($row['total_price_reality']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                })
                ->rawColumns(['name', 'quantity', 'action'])
                ->addIndexColumn()
                ->make();
            return [$dataDetail, $dataTableMaterial, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataReturnOrder(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $supplier = $request->get('supplier');
        $api = sprintf(API_GET_DETAIL_ORDER_SUPPLIER, $id);
        $body = null;
        $requestDetail = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_GET_MATERIAL_ORDER_SUPPLIER, $id, $brand, $branch, $supplier);
        $body = null;
        $requestMaterial = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestDetail, $requestMaterial]);
        try {
            $dataDetail = $configAll[0]['data'];
            $dataDetail['supplier_employee_delivering_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['supplier_employee_delivering_avatar'];
            $dataDetail['employee_complete_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['employee_complete_avatar'];
            $dataDetail['supplier_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['supplier_avatar'];
            $dataDetail['employee_created_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['employee_created_avatar'];
            $dataDetail['restaurant_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $dataDetail['restaurant_avatar'];
            $dataTableMaterial = DataTables::of($configAll[1]['data'])
                ->addColumn('keysearch', function ($row) {
                    $keysearch = [$row['restaurant_material_name'], $row['restaurant_material_unit_full_name'], $row['accept_quantity'], $row['request_quantity'], $row['response_quantity'], $row['return_quantity'], $row['price'], $row['price_reality'], $row['total_price_reality']];
                    return $this->keySearchDatatableTemplate($keysearch);
                })
                ->addColumn('name', function ($row) {
                     return $row['restaurant_material_name'] . '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['restaurant_material_unit_full_name'] . '</label>
                                                                    </div>';
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['accept_quantity']);
                })
                ->addColumn('quantity_return', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input class="form-control quantity text-center rounded border-0 w-100" data-max="' . $row['accept_quantity'] . '" value="0" data-type="currency-edit" >
                            </div>';
                })
                ->addColumn('price_reality', function ($row) {
                    return $this->numberFormat($row['price_reality']);
                })
                ->addColumn('total_price_reality', function ($row) {
                    return 0;
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $row['restaurant_material_id'] . '" data-order-id="' . $row['id'] . '" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['name', 'quantity_return', 'action'])
                ->addIndexColumn()
                ->make();
            return [$dataDetail, $dataTableMaterial, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function returnOrder(Request $request)
    {
        $delivery_date = $request->get('delivery_date');
        $supplier = $request->get('supplier_id');
        $supplier_order_id = $request->get('supplier_order_id');
        $branch = $request->get('branch');
        $note = $request->get('note');
        $material = $request->get('material');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_RETURN_ORDER_SUPPLIER);
        $body = [
            'branch_id' => $branch,
            'note' => $note,
            'supplier_id' => $supplier,
            'supplier_order_id' => $supplier_order_id,
            'delivery_date' => $delivery_date,
            'session_details' => $material,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataRequest(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $api = sprintf(API_GET_DETAIL_REQUEST_ORDER_SUPPLIER, $id);
        $body = null;
        $requestDetail = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $is_user = ENUM_SELECTED;
        $api = sprintf(API_GET_DETAIL_MATERIAL_REQUEST_ORDER_SUPPLIER, $id, $brand, $branch, $is_user);
        $body = null;
        $requestOrder = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestDetail, $requestOrder]);
        try {
            return [$configAll[0]['data'], $configAll[1]['data'], $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function detailReturnOrder(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_DETAIL_RETURN_INVENTORY_ORDER, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $dataTable = Datatables::of($config['data']['supplier_material_return_request_details'])
                ->addColumn('name', function ($row) {
                      return  $row['restaurant_material_name'] . '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['restaurant_material_unit_full_name'] . '</label>
                                                                    </div>';
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('total_price', function ($row) {
                    return $this->numberFormat($row['total_price']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['material_code', 'action', 'name'])
                ->addIndexColumn()
                ->make(true);
            $config['data']['employee_created_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_created_avatar'];
            return [$dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
