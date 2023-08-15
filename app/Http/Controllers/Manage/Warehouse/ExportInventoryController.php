<?php
namespace App\Http\Controllers\Manage\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Exception;
class ExportInventoryController extends Controller
{
    public function index (Request $request)
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
        $active_nav = 'Xuất xuống kho chi nhánh';
        return view('manage.warehouse.export_inventory.index', compact('active_nav'));
    }

    public function data (Request $request)
    {
        $inventory = $request->get('type');
        $branch = $request->get('branch_id');
        $supplier = Config::get('constants.type.id.NONE');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = Config::get('constants.type.default.LIMIT_100');
        $type = Config::get('constants.type.WarehouseTypeEnum.OUT');
        $status = Config::get('constants.type.status.GET_ALL');
        $is_take_canceled = Config::get('constants.type.is_take_canceled.GET_ALL');
        $from = $request->get('from');
        $to = $request->get('to');
        $is_liabilities = Config::get('constants.type.is_liabilities.GET_ALL');
        $is_all_debt_amount = Config::get('constants.type.checkbox.DIS_SELECTED');
        $target_branch_id = Config::get('constants.type.is_liabilities.GET_ALL');
        $key = $this->keySearch(($request->get('search'))['value']);
        $target = Config::get('constants.type.WarehouseSessionTargetTypeEnum.INTERNAL');
        $inventoryStatus = $request->get('warehouse_session_statuses');
        $api = sprintf(API_INVENTORY_GET_LIST, $page, $branch, $type, $status, $is_take_canceled, $supplier, $from, $to, $is_liabilities, $limit, $is_all_debt_amount, $inventory, $target_branch_id, $target, $key, $inventoryStatus);
        $body = null;
        $requestGetListInventory = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $inventory = $request->get('type_count');
        $warehouse_session_statuses_count = $request->get('warehouse_session_statuses_count');
        $api = sprintf(API_INVENTORY_GET_COUNT_OUT, $branch, $inventory, $type, $from, $to, $key, $target, $target_branch_id, $warehouse_session_statuses_count);
        $requestGetCountInventory = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestGetListInventory, $requestGetCountInventory]);
        try {
            for ($i = 0; $i < count($configAll[0]['data']['list']); $i++) {
                $configAll[0]['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $configAll[0]['data']['list'][$i]['total_material'] = $this->numberFormat($configAll[0]['data']['list'][$i]['total_material']);
                $configAll[0]['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($configAll[0]['data']['list'][$i]);
                $configAll[0]['data']['list'][$i]['total_amount'] = $this->numberFormat($configAll[0]['data']['list'][$i]['total_amount']);
                switch ($configAll[0]['data']['list'][$i]['warehouse_session_status']) {
                    case Config::get('constants.type.WarehouseSessionStatusEnum.PROCESSING'):
                        $configAll[0]['data']['list'][$i]['session_status_name'] = '<div class="d-flex status-new seemt-orange seemt-border-orange" style="display: inline !important; max-width: max-content;">
                                                                                     <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                                    <label class="m-0">' . TEXT_WAITING . ' </label>
                                                                                    </div>';
                        break;
                    case Config::get('constants.type.WarehouseSessionStatusEnum.COMPLETED'):
                        $configAll[0]['data']['list'][$i]['session_status_name'] = '<div class="d-flex status-new seemt-green seemt-border-green" style="display: inline !important; max-width: max-content;">
                                                                                     <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                                    <label class="m-0">' . TEXT_DONE . '</label>
                                                                                    </div>';
                        break;
                    default:
                        $configAll[0]['data']['list'][$i]['session_status_name'] = '<div class="d-flex status-new seemt-red seemt-border-red" style="display: inline !important; max-width: max-content;">
                                                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                                    <label class="m-0">' . TEXT_CANCELED . '</label>
                                                                                    </div>';
                }
                $configAll[0]['data']['list'][$i]['employee'] = '<img onerror="imageDefaultOnLoadError($(this))" onclick="modalImageComponent(' . "'" . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $configAll[0]['data']['list'][$i]['employee']['avatar'] . "'" . ')" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $configAll[0]['data']['list'][$i]['employee']['avatar'] . '" class="img-inline-name-data-table">
                                                               <label class="title-name-new-table" >' . $configAll[0]['data']['list'][$i]['employee']['name'] . '<br>
                                                                   <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $configAll[0]['data']['list'][$i]['employee']['role_name'] . '</label>
                                                               </label>';
                $configAll[0]['data']['list'][$i]['export'] = $this->typeExportDataInInventoryManage($configAll[0]['data']['list'][$i]['target_type']);
                $configAll[0]['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                                    <button type="button" class="tabledit-edit-button btn  seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailExportWarehouse(' . $configAll[0]['data']['list'][$i]['id'] . ', ' . $configAll[0]['data']['list'][$i]['branch']['id'] . ' )" data-toggle="tooltip" data-placement="top" data-id="' . $configAll[0]['data']['list'][$i]['id'] . '" data-branch="' . $configAll[0]['data']['list'][$i]['branch']['id'] . '" data-original-title="' . TEXT_DETAIL . '"> <i class="fi-rr-eye"></i></button>
                                                                </div>';
            }
            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $configAll[0]['data']['total_record'],
                'recordsFiltered' => $configAll[0]['data']['total_record'],
                'data' => $configAll[0]['data']['list'],
                'key' => $key,
                'page' => $page,
                'config' => $configAll,
                'count_material' => $this->numberFormat($configAll[1]['data']['count_material']),
                'total_amount_material' => $this->numberFormat($configAll[1]['data']['total_amount_material']),
                'count_goods' => $this->numberFormat($configAll[1]['data']['count_goods']),
                'total_amount_goods' => $this->numberFormat($configAll[1]['data']['total_amount_goods']),
                'count_internal' => $this->numberFormat($configAll[1]['data']['count_internal']),
                'total_amount_internal' => $this->numberFormat($configAll[1]['data']['total_amount_internal']),
                'count_other' => $this->numberFormat($configAll[1]['data']['count_other']),
                'total_amount_other' => $this->numberFormat($configAll[1]['data']['total_amount_other']),
                'count_other_cancel_out' => $this->numberFormat($configAll[1]['data']['count_other_cancel_out']),
                'total_amount_cancel_out' => $this->numberFormat($configAll[1]['data']['amount_other_cancel_out']),
            );
            return json_encode($data_table);

        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function typeExportDataInInventoryManage($type)
    {
        switch ($type) {
            case Config::get('constants.type.ExportInventoryTypeEnum.BAR'):
                return TEXT_INVENTORY_BAR;
            case Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN'):
                return TEXT_INVENTORY_KITCHEN;
            case Config::get('constants.type.ExportInventoryTypeEnum.BUSINESS_EMPLOYEE'):
                return TEXT_BUSINESS_EMPLOYEE;
            case Config::get('constants.type.ExportInventoryTypeEnum.INTERNAL'):
                return TEXT_USE_INTERNAL;
            default :
                return TEXT_OTHER;
        }
    }

    public function listBranch (Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $branch_office_id = $request->get('branch_office_id');
        $api = sprintf('/branches/branch-by-branch-office?branch_office_id=%s', $branch_office_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $branch_option = '';
            foreach ($config['data'] as $db) {
                $branch_option .= '<option value="'. $db['id'] .'">'. $db['name'] .'</option>';
            }
            return [$branch_option, $config];
        }catch(Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function listRequest (Request $request)
    {
        $branch = $request->get('branch');
        $status = Config::get('constants.type.OrderSupplierInternalStatusEnum.ALL_ORDER');
        $from_date = date(" d/m/Y", strtotime("-30 day"));
        $to_date = date("d/m/Y");
        $page = 1;
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = '';
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf('/supplier-order-request/office-branch?branch_id=%s&status=%s&from_date=%s&to_date=%s&page=%s&limit=%s&key_search=%s', $branch, $status, $from_date, $to_date, $page, $limit, $key);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
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
//            if ($data_material === '<option value="" disabled selected>Chọn phiếu yêu cầu</option>') {
//                $data_material = '<option value="0">' . TEXT_NULL_OPTION . '</option>';
//            }
            return [$data_material, $config];

        }catch (Exception $e) {
            return $this->catchTemplate($config,$e);
        }
    }

    public function material (Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $branch_id = $request->get('branch');
        $target_branch_id = $request->get('branchTarget');
        $material_category_type_parent_id = $request->get('categoryTypeParent');
        $api = sprintf('/warehouses/inventory-by-branch?branch_id=%s&target_branch_id=%s&material_category_type_parent_id=%s', $branch_id, $target_branch_id, $material_category_type_parent_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);

        try {
                $inventory = '<option value="" disabled selected>' . TEXT_MATERIAL_DEFAULT_OPTION . '</option>';
                foreach ($config['data'] as $db) {
                    $disabled = ($db['system_last_quantity'] <= 0 || $db['system_last_small_quantity'] <= 0) ? 'disabled' : '';
                    $inventory .= '<option class="'. $disabled .'" '. $disabled .' value="' . $db['restaurant_material_id'] . '" data-system-small="' . $db['system_last_small_quantity'] . '"  data-remain-quantity="' . $db['system_last_quantity'] . '" data-remain-quantity-format="' . $this->numberFormat($db['system_last_quantity']) . '" data-unit="' . $db['material_unit_full_name'] . '"  data-unit-value="' . $db['material_unit_specification_exchange_name'] . '"
                       data-inventory=" '. $db['material_category_type_parent_id'] .' " data-keysearch="' . $this->keySearchDatatableTemplate([$db['name']]) . '">' . $db['name'] . '</option>';
                }
            return [$inventory, $config];
        }catch(Exception $e)
        {
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
        $api = API_INVENTORY_INTERNAL_POST_CREATE;
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
    public function detail(Request $request)
    {
        $branch_id = $request->get('branch');
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_INVENTORY_GET_DETAIL, $id, $branch_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table = Datatables::of($config['data']['details'])
                ->addColumn('user_input_quantity', function ($row) {
                    return ($row['material_unit_type'] === 2) ? $this->numberFormat($row['small_quantity']) : $this->numberFormat($row['quantity']);
                })
                ->addColumn('user_input_price', function ($row) {
                    return ($row['material_unit_type'] === 2) ? $this->numberFormat($row['small_unit_price']) : $this->numberFormat($row['unit_price']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_price']);
                })
                ->addColumn('restaurant_material_name', function ($row) {
                    $unit = ($row['material_unit_type'] === 1) ? $row['unit_full_name'] : $row['unit_specification_exchange_name'];
                    return $row['restaurant_material_name'] . '<br>
                            <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content">
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">' . $unit . ' </label>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                            <button type="button" class="tabledit-edit-button btn  seemt-btn-hover-blue waves-effect waves-light ml-1" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"> <i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['restaurant_material_name', 'action'])
                ->addIndexColumn()
                ->make(true);

            switch ($config['data']['warehouse_session_status']) {
                case Config::get('constants.type.WarehouseSessionStatusEnum.PROCESSING'):
                    $status = '<div class="d-flex status-new seemt-orange seemt-border-orange" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_WAITING . ' </label>
                                </div>';
                    break;
                case Config::get('constants.type.WarehouseSessionStatusEnum.COMPLETED'):
                    $status = '<div class="d-flex status-new seemt-green seemt-border-green" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_DONE . '</label>
                                </div>';
                    break;
                default:
                    $status = '<div class="d-flex status-new seemt-red seemt-border-red" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_CANCELED . '</label>
                                </div>';
            }

            switch ($config['data']['material_category_type_parent_id']) {
                case Config::get('constants.type.inventory.MATERIAL'):
                    $inventory = TEXT_INVENTORY_MATERIAL;
                    break;
                case Config::get('constants.type.inventory.GOODS'):
                    $inventory = TEXT_INVENTORY_GOODS;
                    break;
                case Config::get('constants.type.inventory.INTERNAL'):
                    $inventory = TEXT_INVENTORY_INTERNAL;
                    break;
                case Config::get('constants.type.inventory.OTHER'):
                    $inventory = TEXT_INVENTORY_OTHER;
                    break;
                default:
                    $inventory = '---';
            }

            switch ($config['data']['target_type']) {
                case Config::get('constants.type.ExportInventoryTypeEnum.BAR'):
                    $export = TEXT_INVENTORY_BAR;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN'):
                    $export = TEXT_INVENTORY_KITCHEN;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.BUSINESS_EMPLOYEE'):
                    $export = TEXT_BUSINESS_EMPLOYEE;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.INTERNAL'):
                    $export = TEXT_USE_INTERNAL;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.OTHER'):
                    $export = TEXT_OTHER;
                    break;
                default:
                    $export = '---';
            }
            $total_amount_out = array_sum(array_column($config['data']['details'], 'total_price'));

            $data_detail = [
                'status' => $status,
                'code' => $config['data']['code'],
                'create' => $config['data']['created_at'],
                'delivery' => $config['data']['delivery_date'],
                'update' => $config['data']['updated_at'],
                'employee' => $config['data']['employee']['name'],
                'employee_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee']['avatar'],
                'employee_confirm' => $config['data']['employee_complete']['name'],
                'employee_confirm_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_complete']['avatar'],
                'employee_cancel' => $config['data']['employee_complete']['name'],
                'employee_cancel_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_complete']['avatar'],
                'note' => $config['data']['note'],
                'inventory' => $inventory,
                'target' => $export,
                'branch' => $config['data']['branch']['name'],
                'id' => $config['data']['id'],
                'type' => $config['data']['type'],
                'total_record' => $this->numberFormat($config['data']['total_material']),
                'total' => $this->numberFormat($config['data']['total_amount']),
                'total_amount' => $this->numberFormat($total_amount_out),
            ];
            return [$data_table, $data_detail, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

}
