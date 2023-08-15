<?php

namespace App\Http\Controllers\Manage\Inventory;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class OutInventoryBranchController extends Controller
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
        $active_nav = 'Xuất sang chi nhánh khác';
        return view('manage.inventory.out_inventory_branch.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $inventory = $request->get('type');
        $branch = $request->get('branch_id');
        $supplier = Config::get('constants.type.id.NONE');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = Config::get('constants.type.default.LIMIT_100');
        $type = Config::get('constants.type.WarehouseTypeEnum.ALL_OUT');
        $status = Config::get('constants.type.status.GET_ALL');
        $is_take_canceled = Config::get('constants.type.is_take_canceled.GET_ALL');
        $from = $request->get('from');
        $to = $request->get('to');
        $is_liabilities = Config::get('constants.type.is_liabilities.GET_ALL');
        $is_all_debt_amount = Config::get('constants.type.checkbox.DIS_SELECTED');
        $target_branch_id = Config::get('constants.type.is_liabilities.GET_ALL');
        $key = $this->keySearch(($request->get('search'))['value']);
        $target = Config::get('constants.type.WarehouseSessionTargetTypeEnum.BRANCH');
        $inventoryStatus = $request->get('warehouse_session_statuses');
        $api = sprintf(API_INVENTORY_GET_LIST, $page, $branch, $type, $status, $is_take_canceled, $supplier, $from, $to, $is_liabilities, $limit, $is_all_debt_amount, $inventory, $target_branch_id, $target, $key, $inventoryStatus);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $inventory = $request->get('type_all');
        $warehouse_session_statuses = $request->get('warehouse_session_statuses_count');
        $api = sprintf(API_INVENTORY_GET_COUNT_OUT, $branch, $inventory, $type, $from, $to, $key, $target, $target_branch_id, $warehouse_session_statuses);
        $requestTab = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTab]);
        try {
            for ($i = 0; $i < count($configAll[0]['data']['list']); $i++) {
                $configAll[0]['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $configAll[0]['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($configAll[0]['data']['list']);
                $configAll[0]['data']['list'][$i]['total_amount'] = $this->numberFormat($configAll[0]['data']['list'][$i]['total_amount']);
                $configAll[0]['data']['list'][$i]['total_material'] = $this->numberFormat($configAll[0]['data']['list'][$i]['total_material']);
                $configAll[0]['data']['list'][$i]['employee'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $configAll[0]['data']['list'][$i]['employee']['avatar'] . '" onclick="modalImageComponent(' . "'" . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $configAll[0]['data']['list'][$i]['employee']['avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                                 <label class="title-name-new-table" >' . $configAll[0]['data']['list'][$i]['employee']['name'] . '<br>
                                                                    <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $configAll[0]['data']['list'][$i]['employee']['role_name'] . '</label>
                                                                 </label>';
                if ($configAll[0]['data']['list'][$i]['warehouse_session_status'] === Config::get('constants.type.WarehouseSessionStatusEnum.PROCESSING')) {
                    $configAll[0]['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                                <button type="button" data-target-branch = "'. $configAll[0]['data']['list'][$i]['target_branch']['name'] .'" class="tabledit-edit-button btn  seemt-btn-hover-red waves-effect waves-light" onclick="cancelOutInventoryInternalManageBranch($(this))" data-id="'.$configAll[0]['data']['list'][$i]['id'].'" data-note="'.$configAll[0]['data']['list'][$i]['note'].'" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CANCEL . '"><span class="fi-rr-cross"></span></button>
                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOutInventoryInternalManage(' . $configAll[0]['data']['list'][$i]['id'] . ',' . $configAll[0]['data']['list'][$i]['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                            </div>';
                } else {
                    $configAll[0]['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOutInventoryInternalManage(' . $configAll[0]['data']['list'][$i]['id'] . ',' . $configAll[0]['data']['list'][$i]['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
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
                'config' => $configAll,
                'count_waiting_confirm' => $this->numberFormat($configAll[1]['data']['count_waiting_confirm']),
                'count_material' => $this->numberFormat($configAll[1]['data']['count_material']),
                'count_goods' => $this->numberFormat($configAll[1]['data']['count_goods']),
                'count_internal' => $this->numberFormat($configAll[1]['data']['count_internal']),
                'count_other' => $this->numberFormat($configAll[1]['data']['count_other']),
            );
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function detail(Request $request)
    {
        $branch_id = $request->get('branch');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_INVENTORY_GET_DETAIL, $id, $branch_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table = Datatables::of($config['data']['details'])
                ->addColumn('restaurant_material_name', function ($row) {
                    $unit = ($row['material_unit_type'] === 2) ? $row['unit_specification_exchange_name'] : $row['unit_full_name'];
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
                ->addColumn('user_input_unit_name', function ($row) {
                    if ($row['material_unit_type'] === (int)Config::get('constants.type.UnitMaterialTypeEnum.BIG')) {
                        return $row['unit_full_name'];
                    } else {
                        return $row['unit_specification_exchange_name'];
                    }
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_price']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue  waves-effect waves-light ml-1" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['material_code', 'action','restaurant_material_name'])
                ->addIndexColumn()
                ->make(true);

            switch ($config['data']['warehouse_session_status']) {
                case 1:
                    $status = '<div class="d-flex status-new seemt-orange seemt-border-orange" style="display: inline !important; max-width: max-content;">
                               <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                               <label class="m-0">Đang giao </label>
                               </div>';
                    break;
                case 2:
                    $status = '<div class="d-flex status-new seemt-green seemt-border-green" style="display: inline !important; max-width: max-content;">
                               <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                               <label class="m-0">Hoàn tất</label>
                               </div>';
                    break;
                default:
                    $status = '<div class="d-flex status-new seemt-red seemt-border-red" style="display: inline !important; max-width: max-content;">
                               <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                               <label class="m-0">Đã hủy - Từ chối</label>
                               </div>';
            }

            switch ($config['data']['material_category_type_parent_id']) {
                case (int)Config::get('constants.type.inventory.MATERIAL'):
                    $inventory = TEXT_INVENTORY_MATERIAL;
                    break;
                case (int)Config::get('constants.type.inventory.GOODS'):
                    $inventory = TEXT_INVENTORY_GOODS;
                    break;
                case (int)Config::get('constants.type.inventory.INTERNAL'):
                    $inventory = TEXT_INVENTORY_INTERNAL;
                    break;
                case (int)Config::get('constants.type.inventory.OTHER'):
                    $inventory = TEXT_INVENTORY_OTHER;
                    break;
                default:
                    $inventory = '---';
            }
            $data_detail = [
                'code' => $config['data']['code'],
                'create' => $config['data']['created_at'],
                'date_confirm' => $config['data']['updated_at'],
                'delivery' => $config['data']['delivery_date'],
                'employee' => $config['data']['employee']['name'],
                'employee_id' => $config['data']['employee']['id'],
                'employee_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee']['avatar'],
                'employee_confirm' => $config['data']['employee_complete']['name'],
                'employee_confirm_id' => $config['data']['employee_complete']['id'],
                'employee_confirm_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_complete']['avatar'],
                'employee_cancel' => $config['data']['employee_edit']['name'],
                'employee_cancel_id' => $config['data']['employee_edit']['id'],
                'employee_cancel_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_edit']['avatar'],
                'target' => $config['data']['target_branch']['name'],
                'note' => $config['data']['note'],
                'cancel_reason' => $config['data']['cancel_reason'],
                'branch' => $config['data']['branch']['name'],
                'status' => $status,
                'inventory' => $inventory,
                'total' => $this->numberFormat($config['data']['total_amount']),
                'total_record' => $this->numberFormat($config['data']['total_material']),
            ];
            return [$data_table, $data_detail, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function material(Request $request)
    {
        $branch_id = $request->get('branch');
        $type_parent_id = $request->get('inventory');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_LIST_MATERIAL_INVENTORY_ORDER_SUPPLIER, $branch_id, $type_parent_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_material = '<option value="" selected disabled >' . TEXT_CHOOSE_MATERIAL . '</option>';
            foreach ($config['data'] as $db) {
                $disabled = ($db['system_last_quantity'] <= 0 || $db['system_last_small_quantity'] <= 0) ? 'disabled' : '';
                $data_material .= ' <option class="'. $disabled .'" '.$disabled.' value="' . $db['restaurant_material_id'] . '" data-system-small="' . $db['system_last_small_quantity'] . '"  data-remain-quantity="' . $db['system_last_quantity'] . '" data-remain-quantity-format="' . $this->numberFormat($db['system_last_quantity']) . '" data-unit="' . $db['material_unit_full_name'] . '" data-keysearch="' . $this->keySearchDatatableTemplate([$db['material_unit_full_name'], $db['name'], $db['system_last_quantity']]) . '"  data-unit-value="' . $db['material_unit_specification_exchange_name'] . '">' . $db['name'] . '</option>';
            }
            return [$data_material, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $target_branch_id = $request->get('target_branch_id');
        $note = $request->get('note');
        $delivery_date = $request->get('date');
        $db_client = $request->get('table');
        $inventory = $request->get('inventory');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_INVENTORY_INTERNAL_POST_CREATE);
        $body = [
            'branch_id' => $branch_id,
            'note' => $note,
            'target_branch_id' => $target_branch_id,
            'delivery_date' => $delivery_date,
            'material_category_type_parent_id' => $inventory,
            'session_details' => $db_client
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataUpdate(Request $request)
    {
        $branch = $request->get('branch');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_INVENTORY_GET_DETAIL, $id, $branch);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['details'];
            $data_table = '';
            $list_id_material = [];
            for ($i = 0; $i < count($data); $i++) {
                $list_id_material[$i] = $data[$i]['material_id'];
                if ($data[$i]['user_input_unit_type'] === 1) {
                    $unit_1 = $data[$i]['unit_name'];
                    $unit_value_1 = 1;
                    $unit_2 = $data[$i]['unit_specification_exchange_name'];
                    $unit_value_2 = 2;
                } else {
                    $unit_1 = $data[$i]['unit_specification_exchange_name'];
                    $unit_value_1 = 2;
                    $unit_2 = $data[$i]['unit_name'];
                    $unit_value_2 = 1;
                }
                $data_table .= '<tr>
                <td class="text-center"><label>' . $data[$i]['material_name'] . '</label><input value="' . $data[$i]['material_id'] . '" class="d-none" data-type="1" data-id-update="' . $data[$i]['id'] . '"/></td>
                <td class="text-center">' . $data[$i]['supplier_material_name'] . '</td>
                <td class="text-center"><label>' . $data[$i]['material_name'] . '</label></td>
                <td class="text-center"><select class="form-control edit-height-select-group change-type-table">
                <option value="' . $unit_value_1 . '">' . $unit_1 . '</option>
                <option value="' . $unit_value_2 . '">' . $unit_2 . '</option>
                </select></td>
                <td><input class="form-control quantity text-right" data-type="currency-edit" value="' . $this->numberFormat($data[$i]['user_input_quantity']) . '"/><label class="d-none quantity-label">' . $data[$i]['user_input_quantity'] . '</label></td>
                <td><input class="form-control price text-right" data-type="currency-edit" value="' . $this->numberFormat($data[$i]['user_input_price']) . '"/><label class="d-none price-label">' . $data[$i]['user_input_price'] . '</label></td>
                <td class="text-center"><label class="total">' . $this->numberFormat($data[$i]['total_amount']) . '</label></td>
                <td class="text-center">
                <div class="btn-group-sm">
                <button class="tabledit-delete-button btn btn-danger waves-effect waves-light" onclick="removeMaterialUpdateOutInventoryInternalManage(this)"><span class="icofont icofont-ui-delete"></span></button>
                </div></td></tr>';
            }

            switch ($config['data']['material_category_type_parent_id']) {
                case (int)Config::get('constants.type.inventory.MATERIAL'):
                    $inventory = TEXT_INVENTORY_MATERIAL;
                    break;
                case (int)Config::get('constants.type.inventory.GOODS'):
                    $inventory = TEXT_INVENTORY_GOODS;
                    break;
                case (int)Config::get('constants.type.inventory.INTERNAL'):
                    $inventory = TEXT_INVENTORY_INTERNAL;
                    break;
                case (int)Config::get('constants.type.inventory.OTHER'):
                    $inventory = TEXT_INVENTORY_OTHER;
                    break;
                default:
                    $inventory = '---';
            }

            $data_detail = [
                'code' => $config['data']['code'],
                'create' => $config['data']['created_at'],
                'date' => $config['data']['delivery_date'],
                'employee' => $config['data']['employee']['name'],
                'branch' => $config['data']['branch']['name'],
                'branch_id' => $config['data']['branch']['id'],
                'target_branch' => $config['data']['target_branch']['name'],
                'target_branch_id' => $config['data']['target_branch']['id'],
                'inventory' => $inventory,
                'inventory_id' => $config['data']['material_category_type_parent_id'],
                'note' => $config['data']['note'],
                'total_amount' => $this->numberFormat($config['data']['total_amount']),
                'total_record_material' => $this->numberFormat($config['data']['total_material']),
                'list_material' => $list_id_material,
            ];
            return $data_response = [$data_table, $data_detail, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $target_branch_id = $request->get('target_branch_id');
        $note = $request->get('note');
        $delivery_date = $request->get('date');
        $db_client = $request->get('table');
        $inventory = $request->get('inventory');
        $export_type = Config::get('constants.type.ExportInventoryTypeEnum.BRANCH');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(Config::get('constants.api.API_POST_CREATE_OUT_INVENTORY'));
        $body = [
            'branch_id' => $branch_id,
            'target_branch_id' => $target_branch_id,
            'discount_amount' => 0, // default
            'discount_percent' => 0, // default
            'discount_type' => 0, // default
            'is_include_vat' => 0, // default
            'delivery_date' => $delivery_date,
            'note' => $note,
            'export_type' => $export_type,
            'material_category_type_parent_id' => $inventory,
            'session_details' => $db_client
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function cancel(Request $request)
    {
        $branch_id = $request->get('branch');
        $id = $request->get('id');
        $note = $request->get('note');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_INVENTORY_POST_CANCEL, $id);
        $body = [
            'note' => $note,
            'branch_id' => $branch_id
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
