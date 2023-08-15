<?php

namespace App\Http\Controllers\Manage\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class GoodsPurchaseController extends Controller
{
    public function index ()
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(1);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Quản lý mua hàng';
        return view('manage.warehouse.goods_purchase.index', compact('active_nav'));
    }

    // Danh sách kho tổng
    public function listTotalWarehouse (Request $request)
    {
        $status = ENUM_STATUS_GET_ACTIVE;
        $is_office = 1;
        $restaurant_brand_id = -1;
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_WAREHOUSE_CENTER_BRANCH, $restaurant_brand_id, $status, $is_office);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $list_total_warehouse = '';
            if(!count($config['data'])) {
                $list_total_warehouse = '<option value="">Chưa có kho tổng</option>';
            }else{
                foreach ($config['data'] as $db) {
                    $list_total_warehouse .= '<option value="'. $db['id'] .'" data-brand-id="'. $db['restaurant_brand_id'] .'">'. $db['name'] .'</option>';
                }
            }
            return [$list_total_warehouse, $config];
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    // -----------Phần phiếu yêu cầu từ kho chi nhánh trực thuộc----------
    public function dataRequest(Request $request)
    {
        $branch = ENUM_GET_ALL;
        $office = $request->get('branch');
        $status = $request->get('status');
        $from_date = $request->get('from');
        $to_date = $request->get('to');
        $page = 1;
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = '';
        $api = sprintf(API_GET_ORDER_REQUEST_WAREHOUSE_CENTER_BRANCH, $branch,$office , $from_date, $to_date, $status, $page, $limit, $key);
        $body = null;
        $requestList = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $type = Config::get('constants.type.TypeSearchSupplierOrder.RESTAURANT_MATERIAL_ORDER_REQUEST');
        $from_date = $request->get('from');
        $to_date = $request->get('to');
        $api = sprintf(API_GET_COUNT_ORDER_SUPPLIER, $office, $from_date, $to_date, $key, $type);
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
//                if ($config['data']['list'][$i]['status'] === Config::get('constants.type.OrderSupplierInternalStatusEnum.PENDING')) {
//                    $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
//                    $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
////                    $config['data']['list'][$i]['inventory'] = ($config['data']['list'][$i]['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.MATERIAL')) ? TEXT_INVENTORY_KITCHEN : TEXT_INVENTORY_BAR;
//                    $config['data']['list'][$i]['employee_create_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_create_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_create_avatar'] . "'" . ')">
//                                                                               <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_create_full_name'] . '<br>
//                                                                                    <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_create_employee_role_name'] . '</label>
//                                                                               </label>';
//                    $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">
//                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="confirmRequestSupplierOrder(' . $config['data']['list'][$i]['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_SEND_SUPPLIER . '"><i class="fi-rr-check"></i></button>
//                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRequestSupplierOrder(' . $config['data']['list'][$i]['id'] . ', ' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
//                                                              </div>';
//                }
                if ($config['data']['list'][$i]['status'] === Config::get('constants.type.OrderSupplierInternalStatusEnum.PENDING')){
                    $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                    $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                    $config['data']['list'][$i]['created_at'] = explode(' ', $config['data']['list'][$i]['created_at'])[0];
                    $config['data']['list'][$i]['employee_created_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_created_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_created_avatar'] . "'" . ')">
                                                               <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_created_full_name'] . '<br>
                                                                    <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_created_employee_role_name'] . '</label>
                                                               </label>';
                    $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">
                                                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openUpdateRequestWarehouse(' . $config['data']['list'][$i]['id'] . ', ' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ', ' . $config['data']['list'][$i]['material_category_type_parent_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRequestSupplierOrder(' . $config['data']['list'][$i]['id'] . ', ' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
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

    // -----------Phần đơn hàng chờ nhà cung cấp xác nhận-----------
    public function listOrderWaitingSupplierConfirm(Request $request)
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
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">
                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openUpdateOrderWaitingSupplier(' . $config['data']['list'][$i]['id'] . ', ' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRestaurantSupplierOrder(' . $config['data']['list'][$i]['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                          </div>';
                $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                <label class="title-name-new-table">' . $config['data']['list'][$i]['supplier_name'] . '<br>
                                                                </label>';
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['employee_created_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_created_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_created_avatar'] . "'" . ')" class="img-inline-name-data-table">
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
    public function dataUpdateOrderWaitingSupplier(Request $request)
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
            $dataDetail['employee_created_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $dataDetail['employee_created_avatar'];
            $dataDetail['supplier_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $dataDetail['supplier_avatar'];
            $dataDetail['branch_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $dataDetail['branch_avatar'];

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

    public function cancelOrderWaitingSupplier(Request $request)
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

    // ----------Phần đơn hàng-----------
    public function dataListOrder (Request $request)
    {
        $is_return_all_total_material = $request->get('is_return_all_total_material');
        $branch = $request->get('branch');
        $supplier = Config::get('constants.type.id.GET_ALL');
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
                                $config['data']['list'][$i]['employee_created_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_created_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_created_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                           <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_created_full_name'] . '<br>
                                                                                   <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_created_role_name'] . '</label>
                                                                           </label>';
                                $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')" class="img-inline-name-data-table">
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
                                $config['data']['list'][$i]['employee_created_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_created_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_created_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                                               <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_created_full_name'] . '<br>
                                                                                                     <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_created_role_name'] . '</label>
                                                                                               </label>';
                                $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')">
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
                                $config['data']['list'][$i]['employee_created_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_created_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_created_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                                               <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_created_full_name'] . '<br>
                                                                                                     <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_created_role_name'] . '</label>
                                                                                               </label>';
                                $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')">
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
                        $config['data']['list'][$i]['employee_complete_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_complete_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_complete_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                           <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_complete_full_name'] . '<br>
                                                                <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_complete_role_name'] . '</label>
                                                           </label>';
                        $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                                    <label class="title-name-new-table">' . $config['data']['list'][$i]['supplier_name'] . '<br>
                                                                               </label>';
                        if ($config['data']['list'][$i]['supplier_order_detail'][0]['quantity'] == 0) {
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
                        $config['data']['list'][$i]['employee_cancel_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_cancel_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_cancel_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                           <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_cancel_full_name'] . '<br>
                                                                <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_cancel_role_name'] . '</label>
                                                           </label>';
                        $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')" class="img-inline-name-data-table">
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
                $config['data']['list'][$i]['employee_created_full_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_created_avatar'] .'" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_created_avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                               <label class="title-name-new-table">' . $config['data']['list'][$i]['employee_created_full_name'] . '<br>
                                                                               <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_role_name'] . '</label>
                                                                               </label>';

                $config['data']['list'][$i]['supplier_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['supplier_avatar'] . "'" . ')" class="img-inline-name-data-table">
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
        $status =  $request->get('status');
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
            $config['data']['list'][$i]['inventory'] = ($config['data']['list'][$i]['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.MATERIAL')) ? TEXT_INVENTORY_KITCHEN : TEXT_INVENTORY_BAR;
            $config['data']['list'][$i]['created_at'] = $config['data']['list'][$i]['created_at'];
            $config['data']['list'][$i]['material_quantity'] = $config['data']['list'][$i]['material_quantity'];
            $config['data']['list'][$i]['employee_create_full_name'] = '<img onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_create_avatar'] . "'" . ')" onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['list'][$i]['employee_create_avatar'] . '" class="img-inline-name-data-table">
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
                                                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRequestSupplierOrder(' . $config['data']['list'][$i]['id'] . ', ' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
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

    public function material(Request $request)
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
            $material = '<option value="" selected disabled>' . TEXT_CHOOSE_MATERIAL . '</option>';
            $goods = '<option value="" selected disabled>' . TEXT_CHOOSE_MATERIAL . '</option>';
            $internal = '<option value="" selected disabled>' . TEXT_CHOOSE_MATERIAL . '</option>';
            $other = '<option value="" selected disabled >' . TEXT_CHOOSE_MATERIAL . '</option>';
            foreach ($config['data'] as $db) {
                switch ($db['material_category_type_parent_id']) {
                    case Config::get('constants.type.inventory.MATERIAL'):
                        $material .= '<option value="' . $db['restaurant_material_id'] . '" data-remain-quantity="' . $this->numberFormat($db['system_last_quantity']) . '" data-unit="' . $db['material_unit_full_name'] . '" data-price="' . $this->numberFormat($db['suppliers'][0]['retail_price']) . '" data-keysearch="' . $this->keySearchDatatableTemplate([$db['material_unit_full_name'], $db['name']]) . '">' . $db['name'] . '</option>';
                        break;
                    case Config::get('constants.type.inventory.GOODS'):
                        $goods .= '<option value="' . $db['restaurant_material_id'] . '" data-remain-quantity="' . $this->numberFormat($db['system_last_quantity']) . '" data-unit="' . $db['material_unit_full_name'] . '" data-price="' . $this->numberFormat($db['suppliers'][0]['retail_price']) . '" data-keysearch="' . $this->keySearchDatatableTemplate([$db['material_unit_full_name'], $db['name']]) . '">' . $db['name'] . '</option>';
                        break;
                    case Config::get('constants.type.inventory.INTERNAL'):
                        $internal .= '<option value="' . $db['restaurant_material_id'] . '" data-remain-quantity="' . $this->numberFormat($db['system_last_quantity']) . '" data-unit="' . $db['material_unit_full_name'] . '" data-price="' . $this->numberFormat($db['suppliers'][0]['retail_price']) . '" data-keysearch="' . $this->keySearchDatatableTemplate([$db['material_unit_full_name'], $db['name']]) . '">' . $db['name'] . '</option>';
                        break;
                    case Config::get('constants.type.inventory.OTHER'):
                        $other .= '<option value="' . $db['restaurant_material_id'] . '" data-remain-quantity="' . $this->numberFormat($db['system_last_quantity']) . '" data-unit="' . $db['material_unit_full_name'] . '" data-price="' . $this->numberFormat($db['suppliers'][0]['retail_price']) . '" data-keysearch="' . $this->keySearchDatatableTemplate([$db['material_unit_full_name'], $db['name']]) . '">' . $db['name'] . '</option>';
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
            return [$material, $goods, $internal, $other, $data, $config];
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

    public function createByRequest(Request $request)
    {
        $branch_id = $request->get('branch');
        $note = $request->get('note');
        $delivery_date = $request->get('delivery_date');
        $material = $request->get('material');
        $request_id = $request->get('request_id');
        $is_complete_export = $request->get('is_complete_export');
        $export_type = $request->get('export_type');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_INVENTORY_POST_CREATE;
        $body = [
            'branch_id' => $branch_id,
            'delivery_date' => $delivery_date,
            'note' => $note,
            'branch_inner_inventory_type' => $export_type,
            'restaurant_material_order_request_id' => $request_id,
            'is_complete_export' => $is_complete_export,
            'session_details' => $material
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
    public function export(Request $request)
    {
        $branch = ENUM_GET_ALL;
        $office = $request->get('officeId');
        $status = $request->get('status');
        $from_date = date(" d/m/Y", strtotime("-30 day"));
        $to_date = date("d/m/Y");
        $page = 1;
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = '';
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_ORDER_REQUEST_WAREHOUSE_CENTER_BRANCH, $branch,$office , $from_date, $to_date, $status, $page, $limit, $key);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $data = $config['data']['list'];
        $data_material = '<option value="" disabled selected>Chọn phiếu yêu cầu từ kho chi nhánh</option>';
        $data = collect($data)->sortBy('status')->toArray();
        for ($i = 0; $i < count($data); $i++) {
            $inventory = '';
            $export = '';
            $exportId = '';
            switch ($data[$i]['material_category_type_parent_id']) {
                case Config::get('constants.type.MaterialCategoryParentId.MATERIAL'):
                    $inventory = TEXT_INVENTORY_MATERIAL;
                    $export = TEXT_INVENTORY_KITCHEN;
                    $exportId = Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN');
                    break;
                case Config::get('constants.type.MaterialCategoryParentId.GOODS'):
                    $inventory = TEXT_INVENTORY_GOODS;
                    $export = TEXT_INVENTORY_BAR;
                    $exportId = Config::get('constants.type.ExportInventoryTypeEnum.BAR');
                    break;
                case Config::get('constants.type.MaterialCategoryParentId.INTERNAL'):
                    $inventory = TEXT_INVENTORY_INTERNAL;
                    $export = TEXT_INVENTORY_KITCHEN;
                    $exportId = Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN');
                    break;
                case Config::get('constants.type.MaterialCategoryParentId.OTHER'):
                    $inventory = TEXT_INVENTORY_OTHER;
                    $export = TEXT_INVENTORY_KITCHEN;
                    $exportId = Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN');
                    break;
                default:
                    break;
            }
            $text = ($data[$i]['status'] === Config::get('constants.type.OrderSupplierInternalStatusEnum.REQUEST_ORDER_TO_SUPPLIER')) ? ' (Chưa xuất)' : ' (Đang xuất)';
            $data_material .= '<option value="' . $data[$i]['id'] . '" data-inventory="' . $data[$i]['material_category_type_parent_id'] . '" data-id="' . $exportId . '" data-name="' . $inventory . '" data-export="' . $export . '">  ' . $data[$i]['code'] . ' - ' . $inventory . ' - ' . $data[$i]['date'] . $text . '</option>';
        }
        if ($data_material === '<option value="" disabled selected>Chọn phiếu yêu cầu</option>') {
            $data_material = '<option value="0">' . TEXT_NULL_OPTION . '</option>';
        }
        return [$data_material, $config];
    }

    public function dataExport(Request $request)
    {
        $id = $request->get('id');
        $is_user = ENUM_DIS_SELECTED;
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_DETAIL_MATERIAL_REQUEST_ORDER_SUPPLIER, $id, $brand, $branch, $is_user);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table = DataTables::of($config['data'])
                ->addColumn('name', function ($row) {
                    return $row['restaurant_material_name'] . '<br>
                            <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content">
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">' . $row['restaurant_unit_full_name'] . '</label>
                            </div>';
                })
                ->addColumn('system_last_quantity', function ($row) {
                    return $this->numberFormat($row['system_last_quantity']);
                })
                ->addColumn('quantity_request', function ($row) {
                    $need_export = ($row['account_quantity'] - $row['account_export_material_quantity']) >= 0
                        ? '<label class="font-weight-bold">Cần xuất: ' . $this->numberFormat($row['restaurant_quantity'] - $row['account_export_material_quantity']) . '</label>'
                        : '<label class="font-weight-bold seemt-red">Đã xuất vượt yêu cầu</label>';
                    return 'Yêu cầu: ' . $this->numberFormat($row['restaurant_quantity']) . '<br>
                            Đã xuất: ' . $this->numberFormat($row['account_export_material_quantity']) . '<br>' . $need_export;
//                        . '<br><label class="font-weight-bold">Cần xuất: ' . $this->numberFormat($row['account_quantity'] - $row['account_export_material_quantity']) . '</label>';
                })
                ->addColumn('quantity', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                        <input class="form-control quantity text-center border-0 w-100" data-max="' . $row['system_last_quantity'] . '" data-float="1" value="0" data-type="currency-edit" data-check="0">
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $row['restaurant_material_id'] . '" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i> </button>
                            </div>';
                })
                ->rawColumns(['name', 'quantity_request', 'quantity', 'action'])
                ->addIndexColumn()
                ->make(true);
            return [$data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function handleOrderRequest (Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $restaurant_brand_id = $request->get('brandId');
        $branch_id = $request->get('branch_id');
        $id = $request->get('orderId');
        $date = $request->get('date');
        $list_material = $request->get('listMaterial');
        $expected_delivery_time_string = $request->get('date');
        $status =  $request->get('status');
        $cate_type_id = $request->get('cateTypeId');
        $expected_delivery_time = $request->get('date');
        $api = '/supplier-order-request/office-confirm';
        $body = [
            "restaurant_brand_id" => $restaurant_brand_id,
            "branch_id" => $branch_id,
            "supplier_order_request_id" => $id,
            "date" => $date,
            "list_material" => $list_material,
            "status" => $status,
            "expected_delivery_time_string" => $date,
            "material_category_type_parent_id" => $cate_type_id,
            "expected_delivery_time" => $date
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function detailOrderRequest(Request $request)
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
//            if ($dataDetail['status'] === Config::get('constants.type.OrderSupplierRestaurantStatusEnum.WAITING_RESTAURANT_CREATE_SUPPLIER_ORDER')) {
//                $dataDetail['supplier_amount'] = $this->numberFormat($dataDetail['supplier_total_amount']);
//            } else {
//                $dataDetail['supplier_amount'] = $this->numberFormat($dataDetail['total_amount']);
//            }
//            $dataDetail['expected_delivery_time'] = explode(' ', $dataDetail['expected_delivery_time'])[0];
            $dataDetail['employee_created_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $dataDetail['employee_created_avatar'];
            switch ($dataDetail['material_category_type_parent_id']) {
                case 1:
                    $dataDetail['material_category_type_parent_id'] = TEXT_INVENTORY_MATERIAL;
                    break;
                case 2:
                    $dataDetail['material_category_type_parent_id'] = TEXT_INVENTORY_GOODS;
                    break;
                case 3:
                    $dataDetail['material_category_type_parent_id'] = TEXT_INVENTORY_INTERNAL;
                    break;
                default:
                    $dataDetail['material_category_type_parent_id'] = TEXT_INVENTORY_OTHER;
            }
//            $dataDetail['branch_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $dataDetail['branch_avatar'];
//            $dataDetail['supplier_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $dataDetail['supplier_avatar'];
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
//                ->addColumn('quantity', function ($row) {
//                    if ($row['status'] === Config::get('constants.type.OrderSupplierRestaurantStatusEnum.WAITING_RESTAURANT_CREATE_SUPPLIER_ORDER')) {
//                        return $this->numberFormat($row['supplier_quantity']);
//                    } else {
//                        return $this->numberFormat($row['quantity']);
//                    }
//                })
//                ->addColumn('quantity_supplier', function ($row) {
//                    return $this->numberFormat($row['supplier_quantity']);
//                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['retail_price']);
                })
                ->addColumn('total_price', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('supplier_total_amount', function ($row) {
                    return $this->numberFormat($row['supplier_total_amount']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['name', 'action'])
                ->addIndexColumn()
                ->make();
            $dataTotal = $this->numberFormat(collect($dataTableMaterial->original['data'])->sum('total_amount'));
            return [$dataDetail, $dataTableMaterial, $dataTotal, $configAll];
        } catch (Exception $e) {
            return [$configAll, $e];
        }
    }
}
