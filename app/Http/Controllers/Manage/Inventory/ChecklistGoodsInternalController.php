<?php

namespace App\Http\Controllers\Manage\Inventory;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ChecklistGoodsInternalController extends Controller
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
        $active_nav = 'Kiểm kê kho bộ phận';
        return view('manage.inventory.checklist_goods_internal.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $type = $request->get('type');
        $inventory = ENUM_GET_ALL;
        $status = '';
        $creator = ENUM_GET_ALL;
        $from = $request->get('from');
        $to = $request->get('to');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_5000');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_LIST_CHECKLIST_GOODS_INTERNAL_WAREHOUSE, $branch, $type, $inventory, $creator, $status, $from, $to, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $data_pending = $collection->where('status', (int)Config::get('constants.type.BranchInventoryReportStatusEnum.PENDING'))->all();
            $data_waiting = $collection->where('status', (int)Config::get('constants.type.BranchInventoryReportStatusEnum.CONFIRM'))->all();
            $data_complete = $collection->where('status', (int)Config::get('constants.type.BranchInventoryReportStatusEnum.COMPLETE'))->all();
            $data_cancel = $collection->where('status', (int)Config::get('constants.type.BranchInventoryReportStatusEnum.CANCEL'))->all();
            $data_table_pending = DataTables::of($data_pending)
                ->addColumn('employee', function ($row) {
                    return '<img onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_create']['avatar'] . "'" . ')" onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_create']['avatar'] . '" class="img-inline-name-data-table">
                            <label class="title-name-new-table">' . $row['employee_create']['name'] . '<br>
                                <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_create']['role_name'] . '</label>
                            </label>';
                })
                ->addColumn('branch_inner_inventory_type', function ($row) {
                    switch ($row['branch_inner_inventory_type']) {
                        case Config::get('constants.type.ExportInventoryTypeEnum.OTHER'):
                            return TEXT_OTHER;
                        case Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN'):
                            return TEXT_INVENTORY_KITCHEN;
                        case Config::get('constants.type.ExportInventoryTypeEnum.BAR'):
                            return TEXT_INVENTORY_BAR;
                        case Config::get('constants.type.ExportInventoryTypeEnum.BUSINESS_EMPLOYEE'):
                            return TEXT_BUSINESS_EMPLOYEE;
                        case Config::get('constants.type.ExportInventoryTypeEnum.INTERNAL'):
                            return TEXT_USE_INTERNAL;
                        default:
                            return '';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm float-right">
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-status="'. $row['status'] .'" onclick="openUpdateChecklistGoodsInternalManage(' . $row['id'] . ', ' . $row['creator_type'] . ')"><i class="fi-rr-pencil"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['employee', 'action'])
                ->addIndexColumn()
                ->make(true);
            $data_table_waiting = DataTables::of($data_waiting)
                ->addColumn('employee', function ($row) {
                    return '<img onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_create']['avatar'] . "'" . ')" onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_create']['avatar'] . '" class="img-inline-name-data-table">
                            <label class="title-name-new-table">' . $row['employee_create']['name'] . '<br>
                               <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_create']['role_name'] . '</label>
                            </label>';
                })
                ->addColumn('branch_inner_inventory_type', function ($row) {
                    switch ($row['branch_inner_inventory_type']) {
                        case Config::get('constants.type.ExportInventoryTypeEnum.OTHER'):
                            return TEXT_OTHER;
                        case Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN'):
                            return TEXT_INVENTORY_KITCHEN;
                        case Config::get('constants.type.ExportInventoryTypeEnum.BAR'):
                            return TEXT_INVENTORY_BAR;
                        case Config::get('constants.type.ExportInventoryTypeEnum.BUSINESS_EMPLOYEE'):
                            return TEXT_BUSINESS_EMPLOYEE;
                        case Config::get('constants.type.ExportInventoryTypeEnum.INTERNAL'):
                            return TEXT_USE_INTERNAL;
                        default:
                            return '';
                    }
                })
                ->addColumn('action', function ($row) {
                        return '<div class="btn-group btn-group-sm float-right">
                                     <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONFIRM . '" onclick="confirmChecklistGoodsInternalManage($(this), 2, 0)" data-id="' . $row['id'] . '" data-reason="' . $row['employee_create_note'] . '"><i class="fi-rr-check"></i></button>
                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận chuyển giao tháng tiếp theo" onclick="confirmChecklistGoodsInternalManage($(this), 2, 1)" data-id="' . $row['id'] . '" data-reason="' . $row['employee_create_note'] . '"><i class="fi-rr-angle-double-small-right"></i></button></br>
                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" onclick="openUpdatePeriodChecklistGoodsInternalManage(' . $row['id'] . ', '. $row['creator_type'] .')"><i class="fi-rr-pencil"></i></button>
                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openDetailPeriodChecklistGoodsInternalManage(' . $row['id'] . ', '. $row['creator_type'] .')"><i class="fi-rr-eye"></i></button>
                                </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['employee', 'action'])
                ->addIndexColumn()
                ->make(true);
            $data_table_complete = DataTables::of($data_complete)
                ->addColumn('employee', function ($row) {
                    return '<img onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $row['employee_create']['avatar'] . "'" . ')" onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $row['employee_create']['avatar'] . '" class="img-inline-name-data-table">
                            <label class="title-name-new-table">' . $row['employee_create']['name'] . '<br>
                                   <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_create']['role_name'] . '</label>
                            </label>';
                })
                ->addColumn('employee_update', function ($row) {
                    return '<img onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $row['employee_complete']['avatar'] . "'" . ')" onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $row['employee_complete']['avatar'] . '" class="img-inline-name-data-table">
                            <label class="title-name-new-table">' . $row['employee_complete']['name'] . '<br>
                                   <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_complete']['role_name'] . '</label>
                            </label>';
                })
                ->addColumn('branch_inner_inventory_type', function ($row) {
                    switch ($row['branch_inner_inventory_type']) {
                        case Config::get('constants.type.ExportInventoryTypeEnum.OTHER'):
                            return TEXT_OTHER;
                        case Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN'):
                            return TEXT_INVENTORY_KITCHEN;
                        case Config::get('constants.type.ExportInventoryTypeEnum.BAR'):
                            return TEXT_INVENTORY_BAR;
                        case Config::get('constants.type.ExportInventoryTypeEnum.BUSINESS_EMPLOYEE'):
                            return TEXT_BUSINESS_EMPLOYEE;
                        case Config::get('constants.type.ExportInventoryTypeEnum.INTERNAL'):
                            return TEXT_USE_INTERNAL;
                        default:
                            return '';
                    }
                })
                ->addColumn('action', function ($row) {
                    if ($row['branch_inner_inventory_type'] === 1) {
                        return '<div class="btn-group btn-group-sm float-right">
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openDetailChecklistGoodsInternalManage(' . $row['id'] . ', ' . $row['creator_type'] . ')"><i class="fi-rr-eye"></i></button>
                        </div>';
                    } else {
                        return '<div class="btn-group btn-group-sm float-right">
                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openDetailPeriodChecklistGoodsInternalManage(' . $row['id'] . ', '. $row['creator_type'] .')"><i class="fi-rr-eye"></i></button>
                                </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row) . ($row['branch_inner_inventory_type'] != Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN') ? 'khobia' : 'khobep');
                })
                ->rawColumns(['employee', 'employee_update', 'action'])
                ->addIndexColumn()
                ->make(true);
            $data_table_cancel = DataTables::of($data_cancel)
                ->addColumn('employee', function ($row) {
                    return '<img onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $row['employee_create']['avatar'] . "'" . ')" onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $row['employee_create']['avatar'] . '" class="img-inline-name-data-table">
                            <label class="title-name-new-table">' . $row['employee_create']['name'] . '<br>
                                   <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_create']['role_name'] . '</label>
                            </label>';
                })
                ->addColumn('employee_update', function ($row) {
                    return '<img onclick="modalImageComponent(' . "'"  . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $row['employee_create']['avatar'] . "'" . ')" onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $row['employee_create']['avatar'] . '" class="img-inline-name-data-table">
                            <label class="title-name-new-table">' . $row['employee_create']['name'] . '<br>
                                   <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_create']['role_name'] . '</label>
                            </label>';
                })
                ->addColumn('branch_inner_inventory_type', function ($row) {
                    switch ($row['branch_inner_inventory_type']) {
                        case Config::get('constants.type.ExportInventoryTypeEnum.OTHER'):
                            return TEXT_OTHER;
                        case Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN'):
                            return TEXT_INVENTORY_KITCHEN;
                        case Config::get('constants.type.ExportInventoryTypeEnum.BAR'):
                            return TEXT_INVENTORY_BAR;
                        case Config::get('constants.type.ExportInventoryTypeEnum.BUSINESS_EMPLOYEE'):
                            return TEXT_BUSINESS_EMPLOYEE;
                        case Config::get('constants.type.ExportInventoryTypeEnum.INTERNAL'):
                            return TEXT_USE_INTERNAL;
                        default:
                            return '';
                    }
                })
                ->addColumn('action', function ($row) {
                    if ($row['branch_inner_inventory_type'] === 1) {
                        return '<div class="btn-group btn-group-sm">
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openDetailChecklistGoodsInternalManage(' . $row['id'] . ', ' . $row['creator_type'] . ')"><i class="fi-rr-eye"></i></button>
                        </div>';
                    } else {
                        return '<div class="btn-group btn-group-sm">
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openDetailPeriodChecklistGoodsInternalManage(' . $row['id'] . ', '. $row['creator_type'] .')"><i class="fi-rr-eye"></i></button>
                        </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row) . ($row['branch_inner_inventory_type'] != Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN') ? 'khobia' : 'khobep');
                })
                ->rawColumns(['employee', 'employee_update', 'action'])
                ->addIndexColumn()
                ->make(true);

            $data_total = [
                'total_record_pending' => $this->numberFormat(count($data_pending)),
                'total_record_waiting' => $this->numberFormat(count($data_waiting)),
                'total_record_complete' => $this->numberFormat(count($data_complete)),
                'total_record_cancel' => $this->numberFormat(count($data_cancel)),
            ];
            return [$data_table_pending, $data_table_waiting, $data_table_complete, $data_table_cancel, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataMaterial(Request $request)
    {
        $branch = $request->get('branch');
        $type = $request->get('type');
        $inventory = $request->get('inventory');
        $time = $request->get('time');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $body = null;
        $api = sprintf(API_GET_MATERIAL_CHECKLIST_GOODS, $branch, $type, $inventory, $time);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data_table_material = DataTables::of($data)
                ->addColumn('quantity', function ($row) {
                    if ($row['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.GOODS')) {
                        return $this->numberFormat($row['system_last_small_quantity']);
                    } else {
                        return $this->numberFormat($row['system_last_quantity']);
                    }
                })
                ->addColumn('name', function ($row) {
                    $unit = ($row['material_category_type_parent_id'] !== ENUM_MATERIAL_CATEGORY_PARENT_GOODS) ? $row['material_unit_full_name'] : $row['material_unit_specification_exchange_name'];
                      return $row['name'] . '<div data-cate-type-parent="'. $row['material_category_type_parent_id'] .'" class="unit-material tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $unit . '</label>
                                                                    </div>';
                })
                ->addColumn('check_quantity', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                    <input class="form-control text-center rounded check-quantity border-0 w-100" data-min="0" data-max="999999" value="0">
                            </div>';
                })
                ->addColumn('check_note', function ($row) {
                    return '';
                })
                ->addColumn('confirm_quantity', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                    <input class="form-control text-center rounded confirm-quantity border-0 w-100" data-min="0"  data-max="999999" value="0" data-type="currency-edit">
                            </div>';
                })
                ->addColumn('confirm_note', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input class="form-control border-0 w-100" value="" data-max-length="255">
                             </div>';
                })
                ->addColumn('deficiency_treasurer', function ($row) {
                    return 0;
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('deficiency_system', function ($row) {
                    if ($row['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.GOODS')) {
                        return $this->numberFormat(0 - $row['system_last_small_quantity']);
                    } else {
                        return $this->numberFormat(0 - $row['system_last_quantity']);
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top"  data-id="' . $row['id'] . '" onclick="openModalDetailMaterialData(' . $row['id'] . ')" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                })
                ->rawColumns(['name', 'check_quantity', 'confirm_quantity', 'confirm_note', 'action'])
                ->addIndexColumn()
                ->make(true);
            return [$data_table_material, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataSelectMaterial(Request $request)
    {
        $branch = $request->get('branch');
        $type = $request->get('type');
        $inventory = $request->get('inventory');
        $time = $request->get('time');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $body = null;
        $api = sprintf(API_GET_MATERIAL_CHECKLIST_GOODS, $branch, $type, $inventory, $time);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table_material = DataTables::of($config['data'])
                ->addColumn('name', function ($row) {
                    $unit = ($row['material_category_type_parent_id'] !== ENUM_MATERIAL_CATEGORY_PARENT_GOODS) ? $row['material_unit_full_name']
                        : $row['material_unit_specification_exchange_name'];
                    $material_name = (mb_strlen($row['name']) < 30) ? $row['name']
                        : mb_substr($row['name'], 0, 27) . '...';
                    return $material_name . '<div data-cate-type-parent="'. $row['material_category_type_parent_id'] .'" class="unit-material tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                 <i class="fi-rr-hastag"></i>
                                                 <label class="m-0">' . $unit . '</label>
                                           </div>';
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['system_last_quantity']);
                })
                ->addColumn('confirm_quantity', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input class="form-control text-center rounded confirm-quantity border-0 w-100" data-max="999999" data-min="0" data-type="currency-edit" data-float="1" value="'. $this->numberFormat($row['system_last_quantity']) .'">
                            </div>';
                })
                ->addColumn('deficiency_system', function ($row) {
                    return $this->numberFormat(0);
                })
                ->addColumn('confirm_note', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input class="form-control border-0 w-100" value="" data-max-length="255">
                           </div>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                               <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top"
                                data-original-title="Chi tiết" data-id="'. $row['id'] .'" data-cate-type-parent="'. $row['material_category_type_parent_id'] .'" onclick="openModalDetailMaterialData('. $row['id'] .')"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['name', 'check_quantity', 'confirm_quantity', 'confirm_note', 'action'])
                ->addIndexColumn()
                ->make(true);
            return [$data_table_material, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function finalChecklistGoods(Request $request)
    {
        $branch = $request->get('branch');
        $inventory_report_type = $request->get('type');
        $branch_inner_inventory_type = $request->get('inventory');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $body = null;
        $api = sprintf(API_GET_CHECKLIST_GOOD_INTERNAL_FINAL, $branch, $inventory_report_type, $branch_inner_inventory_type);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['data']['id']) {
                $time = $config['data']['time'];
            } else {
                $time = 'Chưa kiểm kê';
            }
            return [$time, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $branch = $request->get('branch');
        $note = $request->get('note');
        $time = $request->get('time');
        $type = $request->get('type');
        $inventory = $request->get('inventory');
        $materials = $request->get('materials');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = API_POST_CREATE_CHECKLIST_GOODS_INTERNAL;
        $body = [
            'branch_id' => $branch,
            'type' => $type,
            'branch_inner_inventory_type' => $inventory,
            'note' => $note,
            'time' => $time,
            'creator_type' => 2, // kế toán tạo
            'restaurant_materials' => $materials
        ];
       return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $body = null;
        $api = sprintf(API_GET_DETAIL_CHECKLIST_GOODS_INTERNAL, $id);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            switch ($config['data']['branch_inner_inventory_type']) {
                case Config::get('constants.type.ExportInventoryTypeEnum.OTHER'):
                    $config['data']['inventory'] = TEXT_OTHER;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN'):
                    $config['data']['inventory'] = TEXT_INVENTORY_KITCHEN;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.BAR'):
                    $config['data']['inventory'] = TEXT_INVENTORY_BAR;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.BUSINESS_EMPLOYEE'):
                    $config['data']['inventory'] = TEXT_BUSINESS_EMPLOYEE;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.INTERNAL'):
                    $config['data']['inventory'] = TEXT_USE_INTERNAL;
                    break;
                default:
                    $config['data']['inventory'] = '';
            }
            $status_checklist = $config['data']['status'];
            $data_table_material = DataTables::of($config['data']['details'])
                ->addColumn('quantity', function ($row) {
                    if ($row['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.GOODS')) {
                        return $this->numberFormat($row['system_last_quantity']);
                    } else {
                        return $this->numberFormat($row['system_last_big_quantity']);
                    }
                })
                ->addColumn('name', function ($row) {
                    $unit = ($row['material_category_type_parent_id'] === ENUM_MATERIAL_CATEGORY_PARENT_GOODS) ? $row['material_unit_specification_exchange_name']
                        : $row['material_unit_full_name'];
                    $material_name = (mb_strlen($row['restaurant_material_name']) < 30) ? $row['restaurant_material_name']
                        : mb_substr($row['restaurant_material_name'], 0, 27) . '...';
                      return $material_name . '<div data-cate-type-parent="'. $row['material_category_type_parent_id'] .'" class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $unit . '</label>
                                                                    </div>';
                })
                ->addColumn('check_quantity', function ($row) {
                    if ($row['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.GOODS')) {
                        return $this->numberFormat($row['kitchen_quantity']);
                    } else {
                        return $this->numberFormat($row['kitchen_big_quantity']);
                    }
                })
                ->addColumn('confirm_quantity', function ($row) use ($status_checklist) {
                    $accountant_quantity = $status_checklist === 0 ? $row['kitchen_quantity'] : $row['accountant_quantity'];
                    $accountant_quantity_big = $status_checklist === 0 ? $row['kitchen_big_quantity'] : $row['accountant_big_quantity'];
                    if ($row['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.GOODS')) {
                        return '<div class="input-group border-group validate-table-validate">
                                    <input class="form-control text-center rounded confirm-quantity border-0 w-100" data-float="1" data-max="999999" value="' . $this->numberFormat($accountant_quantity) . '" data-type="currency-edit">
                                </div>';
                    } else {
                        return '<div class="input-group border-group validate-table-validate">
                                    <input class="form-control text-center rounded confirm-quantity border-0 w-100" data-float="1" data-max="999999" value="' . $this->numberFormat($accountant_quantity_big) . '" data-type="currency-edit">
                                </div>';
                    }
                })
                ->addColumn('confirm_note', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input class="form-control border-0 w-100" data-max-length="255" value="' . $row['note'] . '">
                             </div>';
                })
                ->addColumn('deficiency_treasurer', function ($row) {
                    if ($row['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.GOODS')) {
                        return $this->numberFormat($row['kitchen_difference_quantity']);
                    } else {
                        return $this->numberFormat($row['kitchen_difference_big_quantity']);
                    }
                })
                ->addColumn('deficiency_system', function ($row) use ($status_checklist) {
                    $accountant_deficiency = $status_checklist === 0 ? $row['kitchen_difference_quantity'] : $row['accountant_difference_quantity'];
                    $accountant_deficiency_big = $status_checklist === 0 ? $row['kitchen_difference_big_quantity'] : $row['accountant_difference_big_quantity'];
                    if ($row['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.GOODS')) {
                        return $this->numberFormat($accountant_deficiency);
                    } else {
                        return $this->numberFormat($accountant_deficiency_big);
                    }
                })
                ->addColumn('action', function ($row) {
                    if ($row['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.GOODS')) {
                        return '<div class="btn-group btn-group-sm">
                                    <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  data-id="' . $row['material_category_type_parent_id'] . '" data-material-id="' . $row['id'] . '" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                    } else {
                        return '<div class="btn-group btn-group-sm">
                                    <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  data-id="' . $row['material_category_type_parent_id'] . '" data-material-id="' . $row['id'] . '" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['name', 'confirm_quantity', 'confirm_note', 'check_note', 'action'])
                ->addIndexColumn()
                ->make(true);
            $config['data']['employee']['avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_create']['avatar'];
            $config['data']['employee_edit']['avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_edit']['avatar'];
            return [$data_table_material, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $confirmNote = $request->get('confirm_note');
        $creator_type = $request->get('creator_type');
        $details = $request->get('details_material');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_POST_UPDATE_CHECKLIST_GOODS_INTERNAL, $id);
        $body = [
            'note' => $confirmNote,
            "creator_type" => $creator_type,
            'details' => $details
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if($config['status'] === 200) {
            $status = ENUM_INVENTORY_REPORT_STATUS_WAITING_CONFIRM;
            $api = sprintf(API_POST_STATUS_CHECKLIST_GOODS_INTERNAL, $id);
            $body = [
                'status' => $status,
                'note' => '',
                'is_export_inventory_next_month' => 0,
            ];
            $this->callApiGatewayTemplate2($project, $method, $api, $body);
        }
        return $config;
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $reason = $request->get('reason');
        $status = $request->get('status');
        $is_export_inventory_next_month = $request->get('is_export_inventory_next_month');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_POST_STATUS_CHECKLIST_GOODS_INTERNAL, $id);
        $body = [
            'status' => $status,
            'note' => $reason,
            'is_export_inventory_next_month' => $is_export_inventory_next_month,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $body = null;
        $api = sprintf(API_GET_DETAIL_CHECKLIST_GOODS_INTERNAL, $id);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $config['data']['type'] = ($config['data']['type'] === 1) ? 'Kiểm kê ngày' : 'Kiểm kê kỳ';
            switch ($config['data']['branch_inner_inventory_type']) {
                case Config::get('constants.type.ExportInventoryTypeEnum.OTHER'):
                    $config['data']['inventory'] = TEXT_OTHER;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN'):
                    $config['data']['inventory'] = TEXT_INVENTORY_KITCHEN;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.BAR'):
                    $config['data']['inventory'] = TEXT_INVENTORY_BAR;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.BUSINESS_EMPLOYEE'):
                    $config['data']['inventory'] = TEXT_BUSINESS_EMPLOYEE;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.INTERNAL'):
                    $config['data']['inventory'] = TEXT_USE_INTERNAL;
                    break;
                default:
                    $config['data']['inventory'] = '';
            }
            $data_table_material = DataTables::of($config['data']['details'])
                ->addColumn('quantity', function ($row) {
                    if ($row['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.GOODS')) {
                        return $this->numberFormat($row['system_last_quantity']);
                    } else {
                        return $this->numberFormat($row['system_last_big_quantity']);
                    }
                })
                ->addColumn('name', function ($row) {
                    $unit = ($row['material_category_type_parent_id'] === ENUM_MATERIAL_CATEGORY_PARENT_GOODS) ? $row['material_unit_specification_exchange_name'] :
                        $row['material_unit_full_name'];
                      return $row['restaurant_material_name'] . '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $unit . '</label>
                                                                    </div>';
                })
                ->addColumn('check_quantity', function ($row) {
                    if ($row['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.GOODS')) {
                        return $this->numberFormat($row['kitchen_quantity']);
                    } else {
                        return $this->numberFormat($row['kitchen_big_quantity']);
                    }
                })
                ->addColumn('check_note', function ($row) {
                    return (mb_strlen($row['note']) < 12) ? $row['note'] : '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title=' . $row['note'] . '></i>';
                })
                ->addColumn('confirm_quantity', function ($row) {
                    if ($row['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.GOODS')) {
                        return $this->numberFormat($row['accountant_quantity']);
                    } else {
                        return $this->numberFormat($row['accountant_big_quantity']);
                    }
                })
                ->addColumn('confirm_note', function ($row) {
                    return (mb_strlen($row['note']) < 10) ? $row['note'] : '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['note'] . '"></i>';

                })
                ->addColumn('deficiency_treasurer', function ($row) {
                    if ($row['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.GOODS')) {
                        return $this->numberFormat($row['kitchen_difference_quantity']);
                    } else {
                        return $this->numberFormat($row['kitchen_difference_big_quantity']);
                    }
                })
                ->addColumn('deficiency_system', function ($row) {
                    if ($row['material_category_type_parent_id'] === Config::get('constants.type.MaterialCategoryParentId.GOODS')) {
                        return $this->numberFormat($row['accountant_difference_quantity']);
                    } else {
                        return $this->numberFormat($row['accountant_difference_big_quantity']);
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" title="' . TEXT_DETAIL . '" data-toggle="tooltip" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['name', 'confirm_note', 'check_note', 'action'])
                ->addIndexColumn()
                ->make(true);
            $data_detail = [
                'employee_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_create']['avatar'],
                'employee_cancel_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_cancel']['avatar'],
                'employee_confirm_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_confirm']['avatar'],
                'employee_edit_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_edit']['avatar'],
            ];
            return [$data_table_material, $config, $data_detail];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

}
