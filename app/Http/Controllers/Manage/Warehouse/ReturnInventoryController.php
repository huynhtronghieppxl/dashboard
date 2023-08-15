<?php

namespace App\Http\Controllers\Manage\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ReturnInventoryController extends Controller
{
    public function index(Request $request)
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
        $active_nav = 'Trả hàng';
        return view('manage.warehouse.return_inventory.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $inventory = $request->get('type');
        $branch = $request->get('branch_id');
        $supplier = Config::get('constants.type.id.NONE');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = 100;
        $warehouse_session_statuses = $request->get('warehouse_session_statuses');
        $status = ENUM_GET_ALL;
        $is_take_canceled = ENUM_GET_ALL;
        $from = $request->get('from');
        $type = Config::get('constants.type.WarehouseTypeEnum.ALL_IN');
        $to = $request->get('to');
        $is_liabilities = ENUM_GET_ALL;
        $is_all_debt_amount = ENUM_DIS_SELECTED;
        $key = $this->keySearch(($request->get('search'))['value']);
        $target = Config::get('constants.type.WarehouseSessionTargetTypeEnum.BRANCH');
        $target_branch_id = Config::get('constants.type.id.GET_ALL');
        $api = sprintf(API_INVENTORY_GET_LIST, $page, $branch, $type, $status, $is_take_canceled, $supplier, $from, $to, $is_liabilities, $limit, $is_all_debt_amount, $inventory, $target_branch_id, $target, $key, $warehouse_session_statuses);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' =>ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

//        $type = Config::get('constants.type.WarehouseTypeEnum.IN');
        $branch = $request->get('branch_id');
        $target_branch_id = $request->get('branch_id');
        $api = sprintf(API_INVENTORY_GET_COUNT, $branch, $inventory, $type, $from, $to, $key, $target, $target_branch_id);
        $requestTab = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' =>ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTab]);
        try {
            for ($i = 0; $i < count($configAll[0]['data']['list']); $i++) {
                $configAll[0]['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $configAll[0]['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($configAll[0]['data']['list']);
                $configAll[0]['data']['list'][$i]['total_material'] = $this->numberFormat($configAll[0]['data']['list'][$i]['total_material']);
                $configAll[0]['data']['list'][$i]['total_amount'] = $this->numberFormat($configAll[0]['data']['list'][$i]['total_amount']);
                $configAll[0]['data']['list'][$i]['employee'] = '<img onclick="modalImageComponent('. "'" . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $configAll[0]['data']['list'][$i]['employee']['avatar'] .  "'" . ')" onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $configAll[0]['data']['list'][$i]['employee']['avatar'] . '" class="img-inline-name-data-table">
                                                                 <label class="title-name-new-table" >' . $configAll[0]['data']['list'][$i]['employee']['name'] . '<br>
                                                                    <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $configAll[0]['data']['list'][$i]['employee']['role_name'] . '</label>
                                                                 </label>';
                $configAll[0]['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm ">
                                                                <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openDetailReturnInventoryWarehouseManage(' . $configAll[0]['data']['list'][$i]['id'] . ',' . $configAll[0]['data']['list'][$i]['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                            </div>';
            }

            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $configAll[0]['data']['total_record'],
                'recordsFiltered' => $configAll[0]['data']['total_record'],
                'data' => $configAll[0]['data']['list'],
                'key' => $key,
                'page' => $page,
                'count_material' => $this->numberFormat($configAll[1]['data']['count_material']),
                'total_amount_material' => $this->numberFormat($configAll[1]['data']['total_amount_material']),
                'count_goods' => $this->numberFormat($configAll[1]['data']['count_goods']),
                'total_amount_goods' => $this->numberFormat($configAll[1]['data']['total_amount_goods']),
                'count_internal' => $this->numberFormat($configAll[1]['data']['count_internal']),
                'total_amount_internal' => $this->numberFormat($configAll[1]['data']['total_amount_internal']),
                'count_other' => $this->numberFormat($configAll[1]['data']['count_other']),
                'total_amount_other' => $this->numberFormat($configAll[1]['data']['total_amount_other']),
                'count_cancel' => $this->numberFormat($configAll[1]['data']['count_other_cancel']),
                'total_amount_cancel' => $this->numberFormat($configAll[1]['data']['total_amount_other_cancel']),
                'count_waiting_confirm' => $this->numberFormat($configAll[1]['data']['count_waiting_confirm']),
                'total_amount_waiting_confirm' => $this->numberFormat($configAll[1]['data']['amount_waiting_confirm']),
                'config' => $configAll
            );
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataOutInventory(Request $request)
    {
        $inventory = $request->get('type');
        $branch = Config::get('constants.type.WarehouseSessionTargetTypeEnum.GET_ALL');
        $supplier = Config::get('constants.type.id.NONE');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $type = ($request->get('is_cancel') === 1) ? Config::get('constants.type.WarehouseTypeEnum.CANCELLED') : Config::get('constants.type.WarehouseTypeEnum.OUT');
        $warehouse_session_statuses = $request->get('warehouse_session_statuses');
        $status = $request->get('status');
        $is_take_canceled = Config::get('constants.type.is_take_canceled.GET_ALL');
        $from = $request->get('from');
        $to = $request->get('to');
        $is_liabilities = Config::get('constants.type.is_liabilities.GET_ALL');
        $is_all_debt_amount = ENUM_DIS_SELECTED;
        $key = $this->keySearch(($request->get('search'))['value']);
        $target = Config::get('constants.type.WarehouseSessionTargetTypeEnum.GET_ALL');
        $target_branch_id = $request->get('branch_id');
        $api =sprintf(API_INVENTORY_GET_LIST, $page, $branch, $type, $status, $is_take_canceled, $supplier, $from, $to, $is_liabilities, $limit, $is_all_debt_amount, $inventory, $target_branch_id, $target, $key, $warehouse_session_statuses);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' =>ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $inventory = Config::get('constants.type.inventory.IN');
        $branch = $request->get('branch_id');
        $target_branch_id = $request->get('branch_id');
        $type = Config::get('constants.type.inventory.WAIT');
        $target = Config::get('constants.type.WarehouseSessionTargetTypeEnum.BRANCH');
        $api = sprintf(API_INVENTORY_GET_COUNT, $branch, $type, $inventory, $from, $to, $key, $target, $target_branch_id);
        $requestTab = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' =>ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];


        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTab]);
        try {
            for ($i = 0; $i < count($configAll[0]['data']['list']); $i++) {
                $configAll[0]['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $configAll[0]['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($configAll[0]['data']['list'][$i]);
                $configAll[0]['data']['list'][$i]['total_material'] = $this->numberFormat($configAll[0]['data']['list'][$i]['total_material']);
                $configAll[0]['data']['list'][$i]['total_amount'] = $this->numberFormat($configAll[0]['data']['list'][$i]['total_amount']);
                $configAll[0]['data']['list'][$i]['employee'] = '<img onerror="imageDefaultOnLoadError($(this))" onclick="modalImageComponent('. "'" . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $configAll[0]['data']['list'][$i]['employee']['avatar'] .  "'" . ')" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $configAll[0]['data']['list'][$i]['employee']['avatar'] . '" class="img-inline-name-data-table">
                                                                 <label class="title-name-new-table" >' . $configAll[0]['data']['list'][$i]['employee']['name'] . '<br>
                                                                    <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $configAll[0]['data']['list'][$i]['employee']['role_name'] . '</label>
                                                                 </label>';
                if ($configAll[0]['data']['list'][$i]['warehouse_session_status'] === Config::get('constants.type.WarehouseSessionStatusEnum.PROCESSING')) {
                    $configAll[0]['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">
                                                <button type="button" class="tabledit-edit-button btn  seemt-btn-hover-green waves-effect waves-light" data-id="'. $configAll[0]['data']['list'][$i]['id'] .'" data-created-at="'. $configAll[0]['data']['list'][$i]['created_at'] .'" data-branch="'. $configAll[0]['data']['list'][$i]['target_branch']['id'] .'" data-note="'. $configAll[0]['data']['list'][$i]['note'] .'" onclick="confirmReturnInventoryWarehouseManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONFIRM . '"><i class="fi-rr-check"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="rejectReturnInventoryWarehouseManage($(this))" data-target-branch="' . $configAll[0]['data']['list'][$i]['target_branch']['id'] . '" data-id="' . $configAll[0]['data']['list'][$i]['id'] . '" data-note="' . $configAll[0]['data']['list'][$i]['note'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DENIED . '"><span class="fi-rr-cross"></span></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailReturnInventoryWarehouseManage(' . $configAll[0]['data']['list'][$i]['id'] . ',' . $configAll[0]['data']['list'][$i]['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                            </div>';
                } else {
                    $configAll[0]['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailReturnInventoryWarehouseManage(' . $configAll[0]['data']['list'][$i]['id'] . ',' . $configAll[0]['data']['list'][$i]['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                            </div>';
                }
            }
            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $configAll[0]['data']['total_record'],
                'recordsFiltered' => $configAll[0]['data']['total_record'],
                'data' => $configAll[0]['data']['list'],
                'key' => $key,
                'page' => $page,
                'count_material' => $this->numberFormat($configAll[1]['data']['count_material']),
                'total_amount_material' => $this->numberFormat($configAll[1]['data']['total_amount_material']),
                'count_goods' => $this->numberFormat($configAll[1]['data']['count_goods']),
                'total_amount_goods' => $this->numberFormat($configAll[1]['data']['total_amount_goods']),
                'count_internal' => $this->numberFormat($configAll[1]['data']['count_internal']),
                'total_amount_internal' => $this->numberFormat($configAll[1]['data']['total_amount_internal']),
                'count_other' => $this->numberFormat($configAll[1]['data']['count_other']),
                'total_amount_other' => $this->numberFormat($configAll[1]['data']['total_amount_other']),
                'count_cancel' => $this->numberFormat($configAll[1]['data']['count_other_cancel']),
                'total_amount_cancel' => $this->numberFormat($configAll[1]['data']['total_amount_other_cancel']),
                'count_waiting_confirm' => $this->numberFormat($configAll[1]['data']['count_waiting_confirm']),
                'total_amount_waiting_confirm' => $this->numberFormat($configAll[1]['data']['amount_waiting_confirm']),
                'config' => $configAll
            );
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll[0], $e);
        }
    }

    public function detail(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_INVENTORY_GET_DETAIL, $id, $branch_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table = Datatables::of($config['data']['details'])
                ->addColumn('restaurant_material_name', function ($row) {
                    $unit = ($row['material_unit_type'] === Config::get('constants.type.unit_type_enum.BIG')) ? $row['unit_full_name'] : $row['unit_specification_exchange_name'];
                    return $row['restaurant_material_name'] . '<br>
                                <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content">
                               <i class="fi-rr-hastag"></i>
                               <label class="m-0">' .  $unit . '</label>
                               </div>';
                })
                ->addColumn('user_input_quantity', function ($row) {
                    if ($row['material_unit_type'] === (int)Config::get('constants.type.UnitMaterialTypeEnum.BIG')) {
                        return $this->numberFormat($row['quantity']);
                    } else {
                        return $this->numberFormat($row['small_quantity']);
                    }
                })
                ->addColumn('user_input_price', function ($row) {
                    if ($row['material_unit_type'] === (int)Config::get('constants.type.UnitMaterialTypeEnum.BIG')) {
                        return $this->numberFormat($row['unit_price']);
                    } else {
                        return $this->numberFormat($row['small_unit_price']);
                    }
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_price']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light ml-1" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" title="Chi tiết"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['restaurant_material_name', 'action'])
                ->addIndexColumn()
                ->make(true);

            switch ($config['data']['material_category_type_parent_id']) {
                case Config::get('constants.type.inventory.MATERIAL'):
                    $config['data']['inventory'] = TEXT_INVENTORY_MATERIAL;
                    break;
                case Config::get('constants.type.inventory.GOODS'):
                    $config['data']['inventory'] = TEXT_INVENTORY_GOODS;
                    break;
                case Config::get('constants.type.inventory.INTERNAL'):
                    $config['data']['inventory'] = TEXT_INVENTORY_INTERNAL;
                    break;
                case Config::get('constants.type.inventory.OTHER'):
                    $config['data']['inventory'] = TEXT_INVENTORY_OTHER;
                    break;
                default:
                    $config['data']['inventory'] = '---';
            }
            switch ($config['data']['warehouse_session_status']) {
                case 1:
                    $config['data']['status_text'] = '<div class="d-flex status-new seemt-orange seemt-border-orange" style="display: inline !important; max-width: max-content;">
                                                      <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                      <label class="m-0">' . TEXT_WAITING . '</label>
                                                      </div>';
                    break;
                case 2:
                    $config['data']['status_text'] = '<div class="d-flex status-new seemt-green seemt-border-green" style="display: inline !important; max-width: max-content;">
                                                      <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                      <label class="m-0">' . TEXT_DONE . '</label>
                                                      </div>';
                    break;
                default:
                    $config['data']['status_text'] = '<div class="d-flex status-new seemt-red seemt-border-red" style="display: inline !important; max-width: max-content;">
                                                      <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                      <label class="m-0">Đã từ chối</label>
                                                      </div>';
            }
            $config['data']['employee']['avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee']['avatar'];
            return [$data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function confirm(Request $request)
    {
        $branch_id = $request->get('branch');
        $id = $request->get('id');
        $note = $request->get('note');
        $delivery_date = $request->get('delivery');
        $status = Config::get('constants.type.WarehouseSessionStatusEnum.COMPLETED');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_INVENTORY_POST_CONFIRM_OUT, $id);
        $body = [
            'note' => $note,
            'branch_id' => $branch_id,
            'warehouse_session_status' => $status,
            'delivery_date' => $delivery_date,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function cancel(Request $request)
    {
        $branch = $request->get('branch');
        $id = $request->get('id');
        $note = $request->get('note');
        $reason = $request->get('cancel_reason');
        $reject_date = $request->get('reject_date');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_INVENTORY_POST_REJECT, $id);
        $body = [
            'note' => $note,
            'branch_id' => $branch,
            'cancel_reason' => $reason,
            'delivery_date' => $reject_date,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
