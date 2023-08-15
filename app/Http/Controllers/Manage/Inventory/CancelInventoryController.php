<?php

namespace App\Http\Controllers\Manage\Inventory;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CancelInventoryController extends Controller
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
        $active_nav = 'Hủy hàng kho chi nhánh';
        return view('manage.inventory.cancel_inventory.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $inventory = $request->get('type');
        $branch = $request->get('branch_id');
        $supplier = Config::get('constants.type.id.NONE');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = Config::get('constants.type.default.LIMIT_100');
        $type = Config::get('constants.type.WarehouseTypeEnum.CANCELLED');
        $status = Config::get('constants.type.status.GET_ALL');
        $is_take_canceled = Config::get('constants.type.is_take_canceled.GET_ALL');
        $from = $request->get('from');
        $to = $request->get('to');
        $target_branch_id = Config::get('constants.type.is_liabilities.GET_ALL');
        $is_liabilities = Config::get('constants.type.is_liabilities.GET_ALL');
        $is_all_debt_amount = Config::get('constants.type.checkbox.DIS_SELECTED');
        $key = $this->keySearch(($request->get('search'))['value']);
        $target = Config::get('constants.type.WarehouseSessionTargetTypeEnum.GET_ALL');
        $inventoryStatus = Config::get('constants.type.WarehouseSessionStatusEnum.GET_ALL');
        $api = sprintf(API_INVENTORY_GET_LIST, $page, $branch, $type, $status, $is_take_canceled, $supplier, $from, $to, $is_liabilities, $limit, $is_all_debt_amount, $inventory, $target_branch_id, $target, $key, $inventoryStatus);
        $body = null;
        $requestGetListInventory = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $api = sprintf(API_INVENTORY_GET_COUNT, $branch, $inventory, $type, $from, $to, $key, $target, $target_branch_id);
        $requestGetCountInventory = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $configAll = $this->callApiMultiGatewayTemplate2([$requestGetListInventory, $requestGetCountInventory]);
        try {
            $config = $configAll[0];
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                $config['data']['list'][$i]['employee'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee']['avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee']['avatar'] . "'" . ')" class="img-inline-name-data-table">
                                                           <label class="title-name-new-table">' . $config['data']['list'][$i]['employee']['name'] . '<br>
                                                                <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee']['role_name'] . '</label>
                                                           </label>';
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailCancelInventoryManage($(this))" data-id="' . $config['data']['list'][$i]['id'] . '" data-branch="' . $config['data']['list'][$i]['branch']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                         </div>';
            }
            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'key' => $key,
                'page' => $page,
                'config' => $configAll
            );

            $config = $configAll[1];
            $data_table['count_material'] = $this->numberFormat($config['data']['count_material']);
            $data_table['count_goods'] = $this->numberFormat($config['data']['count_goods']);
            $data_table['count_internal'] = $this->numberFormat($config['data']['count_internal']);
            $data_table['count_other'] = $this->numberFormat($config['data']['count_other']);
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function material(Request $request)
    {
        $branch = $request->get('branch');
        $inventory = $request->get('category_type');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_LIST_MATERIAL_INVENTORY_ORDER_SUPPLIER, $branch, $inventory);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            if (count($data) === 0) {
                $data_material = '<option   value="">' . TEXT_NULL_OPTION . '</option>';
            } else {
                $data_material = '<option value="" disabled selected>Chọn nguyên liệu</option>';
                for ($i = 0; $i < count($data); $i++) {
                    $a = ($data[$i]['system_last_quantity'] <= 0 || $data[$i]['system_last_small_quantity'] <= 0) ? 'disabled' : '';
                    $keysearch = $this->keySearchDatatableTemplate([$data[$i]['name'], $data[$i]['system_last_quantity'], $data[$i]['material_unit_full_name']]);
                    if(mb_strlen($data[$i]['name'])>17)
                    $data_material .= '<option class="'. $a .'" '. $a .' data-quantity="' . $this->numberFormat($data[$i]['system_last_quantity']) . '" data-small-quantity="' . $this->numberFormat($data[$i]['system_last_small_quantity']) . '" data-unit="' . $data[$i]['material_unit_full_name'] . '" data-unit-value="' . $data[$i]['material_unit_specification_exchange_name'] . '"  value="' . $data[$i]['restaurant_material_id'] . '" data-data-value="' . $data[$i]['material_unit_specification_exchange_value'] . '" data-keysearch="'. $keysearch  .'" data-toggle="tooltip" data-placement="top"
                                                     data-original-title="' . $data[$i]['name'] . '">' . mb_substr($data[$i]['name'], 0, 17 ) . '...</option>';
                    else{
                        $data_material .= '<option class="'. $a .'" '. $a .' data-quantity="' . $this->numberFormat($data[$i]['system_last_quantity']) . '" data-small-quantity="' . $this->numberFormat($data[$i]['system_last_small_quantity']) . '" data-unit="' . $data[$i]['material_unit_full_name'] . '" data-unit-value="' . $data[$i]['material_unit_specification_exchange_name'] . '"  value="' . $data[$i]['restaurant_material_id'] . '" data-data-value="' . $data[$i]['material_unit_specification_exchange_value'] . '" data-keysearch="'. $keysearch  .'" data-toggle="tooltip" data-placement="top"
                                                     data-original-title="' . $data[$i]['name'] . '">' . $data[$i]['name']. '</option>';
                    }
                }
            }
            return [$data_material, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $branch = $request->get('branch');
        $parent = $request->get('parent');
        $db_client = $request->get('table');
        $note = $request->get('note');
        $date = $request->get('date');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_CANCEL_INVENTORY_MANAGE_GET_LIST);
        $body = [
            'material_category_type_parent_id' => $parent,
            'branch_id' => $branch,
            'cancel_reason' => $note,
            'delivery_date' => $date,
            'session_details' => $db_client
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $branch_id = $request->get('branch');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_INVENTORY_GET_DETAIL, $id, $branch_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table = Datatables::of($config['data']['details'])
                ->addColumn('user_input_quantity', function ($row) {
                    if(($row['material_unit_type'] === 1)){
                        return $this->numberFormat($row['quantity']);
                    }
                    return $this->numberFormat($row['small_quantity']);
                })
                ->addColumn('restaurant_material_name', function ($row) {
                    $unit = ($row['material_unit_type'] === 1) ? $row['unit_full_name'] : $row['unit_specification_exchange_name'];
                    return (mb_strlen($row['restaurant_material_name']) > 30) ? mb_substr($row['restaurant_material_name'], 0, 27) . '...' . '<br>
                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                    <i class="fi-rr-hastag"></i>
                    <label class="m-0">' .  $unit  . '</label>
                    </div>'
                        : $row['restaurant_material_name'] . '<br>
                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                    <i class="fi-rr-hastag"></i>
                    <label class="m-0">' .  $unit . '</label>
                    </div>';
                })
                ->addColumn('unit_price', function ($row) {
                    $unit_price = ($row['material_unit_type'] === 1) ? $row['unit_price'] : $row['small_unit_price'];
                    return $this->numberFormat($unit_price);
                })
                ->addColumn('note', function ($row) {
                    return (mb_strlen($row['note']) > 70) ? mb_substr($row['note'], 0, 67) . '...' : $row['note'];
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['restaurant_material_name', 'action'])
                ->addIndexColumn()
                ->make(true);

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
                default:
                    $inventory = TEXT_INVENTORY_OTHER;
            }

            $data_detail = [
                'code' => $config['data']['code'],
                'create' => $config['data']['created_at'],
                'delivery' => $config['data']['delivery_date'],
                'employee' => $config['data']['employee']['name'],
                'employee_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee']['avatar'],
                'supplier' => $config['data']['restaurant_supplier']['name'],
                'inventory' => $inventory,
                'branch' => $config['data']['branch']['name'],
                'id' => $config['data']['id'],
                'type' => $config['data']['type'],
                'note' => $config['data']['note'],
                'cancel_reason' => $config['data']['cancel_reason']
            ];

            return [$data_table, $data_detail, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
