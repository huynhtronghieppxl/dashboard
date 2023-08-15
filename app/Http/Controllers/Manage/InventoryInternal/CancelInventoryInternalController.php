<?php

namespace App\Http\Controllers\Manage\InventoryInternal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CancelInventoryInternalController extends Controller
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
        $active_nav = 'Hủy hàng kho bộ phận';
        return view('manage.inventory_internal.cancel_inventory.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $inventory = Config::get('constants.type.ExportInventoryTypeEnum.BAR_KITCHEN');
        $branch = $request->get('branch');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $type = Config::get('constants.type.WarehouseTypeEnum.CANCELLED');
        $from = $request->get('from');
        $to = $request->get('to');
        $key = '';
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_INVENTORY_INTERNAL_GET_LIST, $branch, $inventory, $type, $from, $to, $key, $limit, $page);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $kitchen = $collection->where('branch_inner_inventory_type', Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN'))->toArray();
            $bar = $collection->where('branch_inner_inventory_type', Config::get('constants.type.ExportInventoryTypeEnum.BAR'))->toArray();
            $tableKitchen = DataTables::of($kitchen)
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('employee', function ($row) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_avatar'] . "'" . ')" class="img-inline-name-data-table">
                            <label class="title-name-new-table">' . $row['employee_full_name'] . '<br>
                                   <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_role_name'] . '</label>
                            </label>';
                })
                ->addColumn('total_material', function ($row) {
                    return $this->numberFormat($row['total_material']);
                })
                ->addColumn('action', function ($rows) {
                    return '<div class="btn-group btn-group-sm">
                                          <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openDetailCancelInventoryManage(' . $rows['id'] . ',' . $rows['branch_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
                })
                ->rawColumns(['employee', 'action'])
                ->addIndexColumn()
                ->make(true);
            $tableBar = DataTables::of($bar)
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('employee', function ($row) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_avatar'] . '" onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_avatar'] . "'" . ')" class="img-inline-name-data-table">
                            <label class="title-name-new-table">' . $row['employee_full_name'] . '<br>
                                   <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_role_name'] . '</label>
                            </label>';
                })
                ->addColumn('total_material', function ($row) {
                    return $this->numberFormat($row['total_material']);
                })
                ->addColumn('action', function ($rows) {
                    return '<div class="btn-group btn-group-sm">
                                          <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openDetailCancelInventoryManage(' . $rows['id'] . ',' . $rows['branch_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
                })
                ->rawColumns(['employee', 'action'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total_record_kitchen' => $this->numberFormat(count($kitchen)),
                'total_record_bar' => $this->numberFormat(count($bar)),
            ];
            return [$tableKitchen, $tableBar, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function material(Request $request)
    {
        $branch = $request->get('branch');
        $type_parent_id = $request->get('inventory');
        $type_id = Config::get('constants.type.checkbox.GET_ALL');
        $category_id = Config::get('constants.type.checkbox.GET_ALL');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $is_only_for_check = Config::get('constants.type.checkbox.GET_ALL');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_CHECK_LIST_GOOD_GET_OF_BRANCH, $branch, $type_parent_id, $type_id, $category_id, $status, $is_only_for_check);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            if (count($data) === 0) {
                $data_material = '<option value="" disabled>' . TEXT_NULL_OPTION . '</option>';
            } else {
                $data_material = '<option value="" disabled selected>Chọn nguyên liệu</option>';
                for ($i = 0; $i < count($data); $i++) {
                    $keysearch = $this->keySearchDatatableTemplate([$data[$i]['name'], $data[$i]['system_last_small_quantity'], $data[$i]['unit_full_name']]);
                    $data_material .= '<option data-unit="' . $data[$i]['unit_full_name'] . '" data-small-quantity="' . $data[$i]['system_last_small_quantity'] . '" data-unit-value="' . $data[$i]['unit_specification_exchange_name'] . '"  value="' . $data[$i]['restaurant_material_id'] . '" data-data-value="' . $data[$i]['unit_specification_exchange_value'] . '" data-keysearch="'. $keysearch  .'">' . $data[$i]['name'] . '</option>';
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
        $object = $request->get('object');
        $db_client = $request->get('table');
        $note = $request->get('note');
        $date = $request->get('date');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_CREATE_CANCEL_INVENTORY);
        $body = [
            'branch_inner_inventory_type' => $object,
            'branch_id' => $branch,
            'note' => $note,
            'time' => $date,
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
                    $unit_1 = $data[$i]['unit_full_name'];
                    $unit_value_1 = 1;
                    $unit_data_1 = 1 / $data[$i]['unit_specification_exchange_value'];
                    $unit_2 = $data[$i]['unit_specification_exchange_name'];
                    $unit_value_2 = 2;
                    $unit_data_2 = $data[$i]['unit_specification_exchange_value'];
                } else {
                    $unit_1 = $data[$i]['unit_specification_exchange_name'];
                    $unit_value_1 = 2;
                    $unit_data_1 = $data[$i]['unit_specification_exchange_value'];
                    $unit_2 = $data[$i]['unit_full_name'];
                    $unit_value_2 = 1;
                    $unit_data_2 = 1 / $data[$i]['unit_specification_exchange_value'];
                }
                if ($config['data']['material_category_type_parent_id'] === Config::get('constants.type.inventory.GOODS')) {
                    $data_unit = '<option value="' . $unit_value_1 . '" data-value="' . $unit_data_1 . '">' . $unit_1 . '</option>
                                  <option value="' . $unit_value_2 . '" data-value="' . $unit_data_2 . '">' . $unit_2 . '</option>';
                } else {
                    $data_unit = '<option value="' . $unit_value_2 . '" data-value="' . $unit_data_2 . '" class="d-none">' . $unit_2 . '</option>
                                  <option value="' . $unit_value_1 . '" data-value="' . $unit_data_1 . '">' . $unit_1 . '</option>';
                }
                $data_table .= '<tr>
                                    <td class="text-center">
                                        <label>' . $data[$i]['material_name'] . '</label>
                                        <input value="' . $data[$i]['material_id'] . '" class="d-none" data-id="' . $data[$i]['id'] . '" data-type="1"/>
                                    </td>
                                    <td>
                                        <input class="form-control text-right cancel-quantity rounded" data-type="currency-edit" data-min="1" data-max="100000000" value="' . $this->numberFormat($data[$i]['user_input_quantity']) . '"/><label class="d-none label-quantity">' . $data[$i]['user_input_quantity'] . '</label></td>
                                    <td class="text-center"><select class="form-control edit-height-select-group rounded select-unit">' . $data_unit . '</select></td>
                                    <td><input class="form-control rounded note" data-nt value="' . $data[$i]['note'] . '"/></td>
                                    <td class="text-center"><div class="btn-group-sm">
                                    <button class="tabledit-delete-button btn seemt-btn-hover-red waves-effect waves-light" onclick="removeRowUpdateCancelInventoryManage(this)"><i class="fi-rr-trash"></i></button>
                                    </div></td></tr>';
            }

            $data_detail = [
                'code' => $config['data']['code'],
                'delivery_date' => $config['data']['delivery_date'],
                'employee' => $config['data']['employee']['name'],
                'employee_confirm' => $config['data']['employee_confirm']['name'],
                'employee_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_avatar'],
                'branch' => $config['data']['branch']['name'],
                'branch_id' => $config['data']['branch']['id'],
                'note' => $config['data']['note'],
                'inventory' => $config['data']['material_category_type_parent_id'],
                'list_material' => $list_id_material,
            ];

            return [$data_detail, $data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $branch = $request->get('branch');
        $inventory = $request->get('inventory');
        $db_client = $request->get('table');
        $note = $request->get('note');
        $date = $request->get('date');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_UPDATE_CANCEL_INVENTORY, $id);
        $body = [
            'branch_id' => $branch,
            'note' => $note,
            'time' => $date,
            'material_category_type_parent_id' => $inventory,
            'datas' => $db_client
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function cancel(Request $request)
    {
        $branch = $request->get('branch');
        $id = $request->get('id');
        $note = $request->get('note');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_INVENTORY_POST_CANCEL, $id);
        $body = [
            'note' => $note,
            'branch_id' => $branch
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function confirm(Request $request)
    {
        $branch = $request->get('branch');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_CONFIRM_CANCEL_INVENTORY, $id);
        $body = [
            'branch_id' => $branch
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_RETURN_INVENTORY_MANAGER_GET_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            switch ($data['branch_inner_inventory_type']) {
                case Config::get('constants.type.ExportInventoryTypeEnum.OTHER'):
                    $data['inventory'] = TEXT_OTHER;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN'):
                    $data['inventory'] = TEXT_INVENTORY_KITCHEN;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.BAR'):
                    $data['inventory'] = TEXT_INVENTORY_BAR;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.BUSINESS_EMPLOYEE'):
                    $data['inventory'] = TEXT_BUSINESS_EMPLOYEE;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.INTERNAL'):
                    $data['inventory'] = TEXT_USE_INTERNAL;
                    break;
                default:
                    $data['inventory'] = '';
            }
            $data_table = Datatables::of($data['details'])
                ->addColumn('restaurant_material_name', function ($row) {
                    $unit = ($row['material_unit_type'] === Config::get('constants.type.unit_type_enum.BIG')) ? $row['unit_full_name'] : $row['unit_specification_exchange_name'];
                    return $row['restaurant_material_name'] . '<br>
                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                    <i class="fi-rr-hastag"></i>
                    <label class="m-0">' . $unit . '</label>
                    </div>';
                })
                ->addColumn('user_input_quantity', function ($row) {
                    return ($row['material_unit_type'] === Config::get('constants.type.unit_type_enum.BIG')) ? $this->numberFormat($row['quantity']) : $this->numberFormat($row['small_quantity']);
                })
                ->addColumn('note', function ($row) {
                    return (mb_strlen($row['note']) > 30) ? '<span style="font-size: 14px !important;" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['note'] . '">'. mb_substr($row['note'], 0, 27) . '...' .'</span>' : $row['note'];
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['restaurant_material_name', 'action', 'note', 'unit_price'])
                ->addIndexColumn()
                ->make(true);
            $data_detail = [
                'employee_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_avatar'],
            ];
            return [$data, $data_table, $config, $data_detail];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function materialInternal(Request $request)
    {
        $branch = $request->get('branch');
        $key = '';
        $limit = 50000;
        $page = 1;
        $inventory = $request->get('inventory');
        $material_status = ENUM_SELECTED;
        $is_delete = ENUM_DIS_SELECTED;
        $is_get_system_last_quantity_different_zero = Config::get('constants.type.checkbox.GET_ALL');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_MATERIAL_CANCEL_INVENTORY, $branch, $inventory, $material_status, $is_delete, $is_get_system_last_quantity_different_zero, $key, $limit, $page);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $data = $config['data']['list'];
        $data_inventory = '<option value="" disabled selected>' . TEXT_CHOOSE_MATERIAL . '</option>';
        for ($i = 0; $i < count($data); $i++) {
            $keysearch = $this->keySearchDatatableTemplate([$data[$i]['name'], $data[$i]['system_last_quantity'], $data[$i]['material_unit_full_name']]);
            $data_inventory .= '<option value="' . $data[$i]['id'] . '" data-small-quantity="' . $data[$i]['system_last_small_quantity'] . '" data-quantity="' . $data[$i]['system_last_quantity'] . '" data-unit="' . $data[$i]['material_unit_full_name'] . '" data-unit-value="' . $data[$i]['material_unit_specification_exchange_name'] . '" data-keysearch="'. $keysearch  .'">' . $data[$i]['name'] . '</option>';
        }
        if ($data_inventory === '<option value="" disabled selected>' . TEXT_CHOOSE_MATERIAL . '</option>') {
            $data_inventory = '<option value="">' . TEXT_NULL_OPTION . '</option>';
        }
        return [$data_inventory, $config];
    }
}
