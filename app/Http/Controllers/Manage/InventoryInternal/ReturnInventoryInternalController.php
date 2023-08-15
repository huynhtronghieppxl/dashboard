<?php

namespace App\Http\Controllers\Manage\InventoryInternal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class ReturnInventoryInternalController extends Controller
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
        $active_nav = 'Trả hàng kho bộ phận';
        return view('manage.inventory_internal.return_inventory.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $inventory = Config::get('constants.type.ExportInventoryTypeEnum.FOUR_INVENTORY');
        $branch = $request->get('branch');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $type = Config::get('constants.type.WarehouseTypeEnum.RETURN');
        $from = $request->get('from');
        $to = $request->get('to');
        $key = '';
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_INVENTORY_INTERNAL_GET_LIST, $branch, $inventory, $type, $from, $to, $key, $limit, $page);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $kitchen = $collection->where('branch_inner_inventory_type', Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN'))->toArray();
            $bar = $collection->where('branch_inner_inventory_type', Config::get('constants.type.ExportInventoryTypeEnum.BAR'))->toArray();
            $businessEmployee = $collection->where('branch_inner_inventory_type', Config::get('constants.type.ExportInventoryTypeEnum.BUSINESS_EMPLOYEE'))->toArray();
            $foodEmployee = $collection->where('branch_inner_inventory_type', Config::get('constants.type.ExportInventoryTypeEnum.INTERNAL'))->toArray();
            $tableKitchen = $this->drawDatableReturnInventoryInternal($kitchen);
            $tableBar = $this->drawDatableReturnInventoryInternal($bar);
            $tableBusinessEmployee = $this->drawDatableReturnInventoryInternal($businessEmployee);
            $tableEmployeeFood = $this->drawDatableReturnInventoryInternal($foodEmployee);
            $dataTotal = [
                'total_record_kitchen' => $this->numberFormat(count($kitchen)),
                'total_record_bar' => $this->numberFormat(count($bar)),
                'total_record_business_employee' => $this->numberFormat(count($businessEmployee)),
                'total_record_food_employee' => $this->numberFormat(count($foodEmployee)),
            ];
            return [$tableKitchen, $tableBar, $tableBusinessEmployee, $tableEmployeeFood, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawDatableReturnInventoryInternal($data){
        return DataTables::of($data)
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('employee', function ($row) {
                return '<img onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_avatar'] . "'" . ')" onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_avatar'] . '" class="img-inline-name-data-table">
                            <label class="title-name-new-table">' . $row['employee_full_name'] . '<br>
                                   <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_role_name'] . '</label>
                            </label>';
            })
            ->addColumn('total_material', function ($row) {
                return $this->numberFormat($row['total_material']);
            })
            ->addColumn('action', function ($rows) {
                return '<div class="btn-group btn-group-sm float-right">
                                          <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailReturnInventoryInternalManage(' . $rows['id'] . ',' . $rows['branch_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
            })
            ->rawColumns(['employee', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function dataInventory(Request $request)
    {
        $branch_id = $request->get('branch');
        $inventory = $request->get('inventory');
        $id = Config::get('constants.type.id.NONE');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $type = Config::get('constants.type.WarehouseTypeEnum.IN');
        $paid_status = Config::get('constants.type.WarehouseSessionPaidStatusEnum.WAITING_PAYMENT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $is_take_canceled = Config::get('constants.type.is_take_canceled.GET_ALL');
        $from = Config::get('constants.type.date.NONE');
        $to = Config::get('constants.type.date.NONE');
        $target_types = '';
        $is_liabilities = Config::get('constants.type.is_liabilities.GET_ALL');
        $import = Config::get('constants.type.ImportInventoryTypeEnum.SUPPLIER');
        $export = Config::get('constants.type.ExportInventoryTypeEnum.NONE');
        $is_all_debt_amount = Config::get('constants.type.checkbox.DIS_SELECTED');
        $key_word = '';
        $target_branch_id = Config::get('constants.type.is_liabilities.GET_ALL');
        $inventoryStatus = Config::get('constants.type.WarehouseSessionStatusEnum.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_INVENTORY_GET_LIST, $page, $branch_id, $type, $paid_status, $is_take_canceled, $id, $from, $to, $is_liabilities, $limit, $import, $export, $is_all_debt_amount, $inventory, $target_branch_id, $target_types, $key_word, $inventoryStatus);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $data_inventory = '<option disabled selected >' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['material_category_type_parent_id'] === (int)$inventory) {
                    $data_inventory .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['code'] . '</option>';
                }
            }
            if (count($data) === 0) {
                $data_inventory = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$data_inventory, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function detailInventory(Request $request)
    {
        $branch = $request->get('branch');
        $id = $request->get('inventory');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_INVENTORY_GET_DETAIL, $id, $branch);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['details'];
            $data_table = '';
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['user_input_unit_type'] === (int)Config::get('constants.type.unit_type_enum.BIG')) {
                    $unit = '<select class="form-control">
                               <option value="' . Config::get('constants.type.unit_type_enum.BIG') . '" selected>' . $data[$i]['unit_name'] . '</option>
                               <option value="' . Config::get('constants.type.unit_type_enum.SMALL') . '">' . $data[$i]['unit_specification_exchange_name'] . '</option>
                             </select>';
                } else {
                    $unit = '<select class="form-control">
                                <option value="' . Config::get('constants.type.unit_type_enum.SMALL') . '" selected>' . $data[$i]['unit_specification_exchange_name'] . '</option>
                                <option value="' . Config::get('constants.type.unit_type_enum.BIG') . '">' . $data[$i]['unit_name'] . '</option>
                              </select>';
                }
                $data_table .= '<tr>
                                      <td class="text-center"><label>' . $data[$i]['material_name'] . '</label><input value="' . $data[$i]['id'] . '" class="d-none"/></td>
                                      <td class="text-center">' . $data[$i]['supplier_material_name'] . '</label></td>
                                      <td class="text-center">' . $unit . '</td>
                                      <td class="text-center"><label data-quantity="' . $data[$i]['user_input_quantity'] . '">' . $this->numberFormat($data[$i]['user_input_quantity']) . '</label></td>
                                      <td class="text-center"><input class="form-control text-left return" data-type="currency-edit" value="1"/><label class="d-none">1</label></td>
                                      <td class="text-center">
                                            <div class="btn-group-sm">
                                                <button class="tabledit-delete-button btn seemt-red seemt-btn-hover-red waves-effect" onclick="removeRowCreateReturnInventoryInternalManage(this)"><i class="fi-rr-trash"></i></button>
                                            </div>
                                      </td>
                                </tr>';
            }
            return [$data_table, $config];
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
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_INVENTORY_POST_CREATE_INNER_RETURN);
        $body = [
            'branch_inner_inventory_type' => $object,
            'branch_id' => $branch,
            'note' => $note,
            'time' => $date,
            'session_details' => $db_client
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function cancel(Request $request)
    {
        $branch = $request->get('branch');
        $id = $request->get('id');
        $note = $request->get('note');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(Config::get('constants.api.API_POST_INVENTORY_CANCEL'), $id);
        $body = [
            'note' => $note,
            'branch_id' => $branch
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_RETURN_INVENTORY_MANAGER_GET_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data['employee_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $data['employee_avatar'];
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
                    return '<div class="d-flex justify-content-start"> <div class="flex-column"><div>'.$row['restaurant_material_name'] . '</div>
                     <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                    <i class="fi-rr-hastag"></i>
                    <label class="m-0">' . $unit. '</label>
                    </div></div></div>';
                })
                ->addColumn('user_input_quantity', function ($row) {
                    return ($row['material_unit_type'] === Config::get('constants.type.unit_type_enum.BIG')) ? $this->numberFormat($row['quantity']) : $this->numberFormat($row['small_quantity']);
                })
                ->addColumn('unit_price', function ($row) {
                    $unit_price = ($row['material_unit_type'] === Config::get('constants.type.unit_type_enum.BIG')) ? $row['unit_price'] : ($row['unit_price']/$row['unit_specification_exchange_value']);
                    return $this->numberFormat($unit_price);
                })
                ->addColumn('note', function ($row) {
                    return (mb_strlen($row['note']) > 30) ? '<span style="font-size: 14px !important;" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['note'] . '">'. mb_substr($row['note'], 0, 27) . '...' .'</span>' : $row['note'];
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['restaurant_material_name', 'action', 'note'])
                ->addIndexColumn()
                ->make(true);
            return [$data, $data_table, $config];
        } catch
        (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function materialInternal(Request $request)
    {
        $branch = $request->get('branch');
        $key = '';
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $inventory = $request->get('inventory');
        $material_status = Config::get('constants.type.checkbox.SELECTED');
        $is_delete = Config::get('constants.type.checkbox.DIS_SELECTED');
        $is_get_system_last_quantity_different_zero = Config::get('constants.type.checkbox.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_MATERIAL_CANCEL_INVENTORY, $branch, $inventory, $material_status, $is_delete, $is_get_system_last_quantity_different_zero, $key, $limit, $page);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
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
        }catch(Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
