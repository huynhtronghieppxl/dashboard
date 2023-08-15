<?php

namespace App\Http\Controllers\Manage\Inventory;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CheckListGoodsController extends Controller
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
        $active_nav = 'Kiểm kê kho chi nhánh';
        return view('manage.inventory.checklist_goods.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $branch = $request->get('branch');
        $page = ENUM_DEFAULT_PAGE;
        $limit = 5000;
        $statuses = ENUM_INVENTORY_REPORT_STATUS_GET_ALL;
        $material_category_type_parent_id = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $body = null;
        $api = sprintf(API_GET_LIST_CHECKLIST_BRANCH_INVENTORY, $branch, $material_category_type_parent_id, $statuses, $from, $to, $page, $limit );
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $data_material = $collection->where('material_category_type_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_MATERIAL)->where('status', '!==', ENUM_INVENTORY_REPORT_STATUS_CANCELLED)->all();
            $data_goods = $collection->where('material_category_type_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_GOODS)->where('status', '!==', ENUM_INVENTORY_REPORT_STATUS_CANCELLED)->all();
            $data_internal = $collection->where('material_category_type_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_INTERNAL)->where('status', '!==', ENUM_INVENTORY_REPORT_STATUS_CANCELLED)->all();
            $data_other = $collection->where('material_category_type_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_OTHER)->where('status', '!==', ENUM_INVENTORY_REPORT_STATUS_CANCELLED)->all();
            $data_cancel = $collection->where('status', ENUM_INVENTORY_REPORT_STATUS_CANCELLED)->all();
            $data_table_material = $this->drawTableCheckListGoods($data_material);
            $data_table_goods = $this->drawTableCheckListGoods($data_goods);
            $data_table_internal = $this->drawTableCheckListGoods($data_internal);
            $data_table_other = $this->drawTableCheckListGoods($data_other);
            $data_table_cancel = $this->drawTableCheckListGoods($data_cancel);
            $data_total = [
                'total_record_material' => $this->numberFormat(count($data_material)),
                'total_record_goods' => $this->numberFormat(count($data_goods)),
                'total_record_internal' => $this->numberFormat(count($data_internal)),
                'total_record_other' => $this->numberFormat(count($data_other)),
                'total_record_cancel' => $this->numberFormat(count($data_cancel)),
            ];
            return [$data_table_material, $data_table_goods, $data_table_internal, $data_table_other, $data_table_cancel, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTableCheckListGoods($data)
    {
        return DataTables::of($data)
            ->addColumn('status_text', function ($row) {
                switch ($row['status']) {
                    case ENUM_INVENTORY_REPORT_STATUS_PENDING:
                        return '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">Chờ xác nhận</label>
                                </div>';
                    case ENUM_INVENTORY_REPORT_STATUS_WAITING_CONFIRM:
                        return '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_BALANCE . '</label>
                                </div>';
                    case ENUM_INVENTORY_REPORT_STATUS_CONFIRMED:
                        return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_BALANCED . '</label>
                                </div>';
                    default:
                        return '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_CANCELED_TEXT . '</label>
                                </div>';
                }
            })
            ->addColumn('employee_create_name', function ($row) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $row['employee_avartar'] . '" data-src="'. $row['employee_avartar'] .'" class="img-inline-name-data-table">
                        <label class="title-name-new-table"><span style="font-size: 14px !important;">' . $row['employee_name'] . '</span><br>
                              <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_role_name'] . '</label>
                        </label>';
            })
            ->addColumn('employee_confirm_name', function ($row) {
                if($row['status'] === 1) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA)  . $row['employee_confirm_avartar'] . '" data-src="'. $row['employee_confirm_avartar'] .'" class="img-inline-name-data-table">
                        <label class="title-name-new-table"><span style="font-size: 14px !important;">' . $row['employee_confirm_name'] . '</span><br>
                              <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_confirm_employee_role_name'] . '</label>
                        </label>';
                }elseif (($row['status'] === 2)){
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA)  . $row['employee_complete_avartar'] . '" data-src="'. $row['employee_complete_avartar'] .'" class="img-inline-name-data-table">
                        <label class="title-name-new-table"><span style="font-size: 14px !important;">' . $row['employee_complete_name'] . '</span><br>
                              <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_complete_employee_role_name'] . '</label>
                        </label>';
                }else{
                    return '---';
                }
            })
            ->addColumn('employee_cancel_name', function ($row) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA)  . $row['employee_cancel_avartar'] . '" data-src="'. $row['employee_cancel_avartar'] .'" class="img-inline-name-data-table">
                        <label class="title-name-new-table"><span style="font-size: 14px !important;">' . $row['employee_cancel_name'] . '</span><br>
                              <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_cancel_employee_role_name'] . '</label>
                        </label>';
            })
            ->addColumn('action', function ($row) {
                 if ($row['status'] === ENUM_INVENTORY_REPORT_STATUS_PENDING) {
                    return '<div class="btn-group btn-group-sm float-right">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="confirmCheckListGoodsManage($(this), 1)" data-id="'. $row['id'] .'" data-reason="'. $row['employee_create_note'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONFIRM . '"><i class="fi-rr-check"></i></span></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green  waves-effect waves-light" data-id="' . $row['id'] . '" data-branch-id="'. $row['branch_id'] .'" data-branch="' . $row['branch_name'] . '" data-employee-update-avatar="' . $row['employee_update_avartar'] . '" data-employee-update-at="'. $row['employee_update_at'] .'" data-employee-update-name="' . $row['employee_update_name'] . '" onclick="openConfirmCheckListGoodsManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></span></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $row['id'] . '" data-branch="' . $row['branch_name'] . '" data-employee-update-avatar="' . $row['employee_update_avartar'] . '" data-employee-update-at="'. $row['employee_update_at'] .'" data-employee-update-name="' . $row['employee_update_name'] . '" onclick="openDetailCheckListGoodsManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                } elseif ($row['status'] === ENUM_INVENTORY_REPORT_STATUS_WAITING_CONFIRM) {
                     return '<div class="btn-group btn-group-sm float-right">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $row['id'] . '" onclick="confirmCheckListGoodsManage($(this), 2)" data-toggle="tooltip" data-placement="top" data-original-title="Cân bằng kho"><i class="fi-rr-list-check"></i></span></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="'. $row['id'] .'" onclick="confirmCheckListNextMonthGoodsManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận chuyển giao tháng tiếp theo"><i class="fi-rr-angle-double-right"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $row['id'] . '" data-branch="' . $row['branch_name'] . '" data-employee-update-avatar="' . $row['employee_update_avartar'] . '" data-employee-update-at="'. $row['employee_update_at'] .'" data-employee-update-name="' . $row['employee_update_name'] . '" onclick="openDetailCheckListGoodsManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                 } else {
                    return '<div class="btn-group btn-group-sm float-right">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $row['id'] . '" data-branch="' . $row['branch_name'] . '" data-employee-update-avatar="' . $row['employee_update_avartar'] . '" data-employee-update-at="'. $row['employee_update_at'] .'" data-employee-update-name="' . $row['employee_update_name'] . '" onclick="openDetailCheckListGoodsManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                }
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['employee', 'employee_create_name', 'employee_cancel_name', 'employee_confirm_name' ,'status_text', 'action', 'code'])
            ->addIndexColumn()
            ->make(true);
    }

    public function dataMaterial(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $inventory = (int)$request->get('inventory');
        $time = $request->get('time');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $body = null;
//        $api = sprintf(API_GET_MATERIAL_CHECKLIST_GOODS_CATEGORY, $id, $branch, $inventory, $time, $id);
        $api = sprintf(API_GET_MATERIAL_CHECKLIST_BRANCH_WAREHOUSE, $branch, $inventory);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            if ($inventory === ENUM_MATERIAL_CATEGORY_PARENT_GOODS) {
                $data_table_material = DataTables::of($data)
                    ->addColumn('system_last_quantity', function ($row) {
                        return $this->numberFormat($row['system_last_quantity']);
                    })
//                    ->addColumn('confirm', function ($row) {
//                        return '<div class="input-group border-group validate-table-validate">
//                                    <input class="form-control text-center rounded quantity border-0 w-100" data-max="999999" data-float="1" value="' . $this->numberFormat($row['confirm_quantity']) . '" data-type="currency-edit" data-min="0">
//                                </div>';
//                    })
                    ->addColumn('confirm_create', function ($row) {
                        return '<div class="input-group border-group validate-table-validate">
                                  <input class="form-control text-center rounded quantity border-0 w-100" data-max="999999" data-float="1"  value="' . $this->numberFormat($row['system_last_quantity']) . '" data-type="currency-edit" data-min="0">
                                </div>';
                    })
                    ->addColumn('confirm_create_wastage_quantity', function ($row) {
                        return 0;
                    })
                    ->addColumn('name', function ($row) {
//                        return $row['name'] . '<br><label class="m-t-2 label label-info">' . $row['material_unit_specification_exchange_name'] . '</label>';
                        return $row['name'] . '<br><div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['material_unit_specification_exchange_name'] . '</label>
                                                                    </div>';
                    })
                    ->addColumn('note', function () {
                        return '<div class="input-group border-group validate-table-validate">
                                  <input class="form-control rounded note border-0 w-100" data-max-length="255">
                                </div>';
                    })
//                    ->addColumn('confirm_quantity', function ($row) {
//                        return $this->numberFormat($row['confirm_quantity']);
//                    })
//                    ->addColumn('confirm_wastage_quantity', function ($row) {
//                        return $this->numberFormat($row['confirm_wastage_quantity']);
//                    })
                    ->addColumn('action', function ($row) {
                        return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light material-id" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" data-unit-value="1" data-id="' . $row['id'] . '" onclick="openModalDetailMaterialData(' . $row['id'] . ')"><i class="fi-rr-eye"></i></button>
                                </div>';
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['name', 'confirm', 'note', 'action', 'confirm_create'])
                    ->addIndexColumn()
                    ->make(true);
            } else {
                $data_table_material = DataTables::of($data)
                    ->addColumn('system_last_quantity', function ($row) {
                        return $this->numberFormat($row['system_last_big_quantity']);
                    })
//                    ->addColumn('confirm', function ($row) {
//                        return '<div class="input-group border-group validate-table-validate">
//                                  <input class="form-control text-center rounded quantity border-0 w-100" data-max="999999" value="' . $this->numberFormat($row['confirm_big_quantity']) . '" data-type="currency-edit" data-min="0" data-float="1">
//                                </div>';
//                    })
                    ->addColumn('confirm_create', function ($row) {
                        return '<div class="input-group border-group validate-table-validate">
                                  <input class="form-control text-center rounded quantity border-0 w-100" data-max="999999" value="' . $this->numberFormat($row['system_last_big_quantity']) . '" data-type="currency-edit" data-min="0" data-float="1">
                                </div>';
                    })
                    ->addColumn('confirm_create_wastage_quantity', function ($row) {
                        return 0;
                    })
                    ->addColumn('name', function ($row) {
//                        return $row['name'] . '<br><label class="m-t-2 label label-info">' . $row['material_unit_full_name'] . '</label>';
                        return $row['name'] . '<br><div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['material_unit_full_name'] . '</label>
                                                                    </div>';
                    })
                    ->addColumn('note', function () {
                        return '<div class="input-group border-group validate-table-validate">
                                  <input class="form-control rounded note border-0 w-100" data-max-length="255">
                                </div>';
                    })
//                    ->addColumn('confirm_quantity', function ($row) {
//                        return $this->numberFormat($row['confirm_big_quantity']);
//                    })
//                    ->addColumn('confirm_wastage_quantity', function ($row) {
//                        return $this->numberFormat($row['confirm_wastage_big_quantity']);
//                    })
                    ->addColumn('action', function ($row) {
                        return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light material-id" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" data-unit-value="' . $row['material_unit_specification_exchange_value'] . '"  data-id="' . $row['id'] . '" onclick="openModalDetailMaterialData(' . $row['id'] . ')"><i class="fi-rr-eye"></i></button>
                        </div>';
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['name', 'confirm', 'note', 'action', 'confirm_create'])
                    ->addIndexColumn()
                    ->make(true);
            }

            return [$data_table_material, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function finalChecklistGoods(Request $request)
    {
        $branch = $request->get('branch');
        $material_category_type_parent_id = $request->get('inventory');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $body = null;
        $api = sprintf(API_GET_MOST_RECENT_CHECKLIST_GOOD, $branch, $material_category_type_parent_id);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if (isset($config['data'])) {
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
        $materials = $request->get('material');
        $restaurant_materials = $request->get('restaurant_materials');
        $branch = $request->get('branch');
        $note = $request->get('note');
        $material_category_type_parent_id = $request->get('material_category_type_parent_id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = API_POST_CREATE_CHECKLIST_BRANCH_WAREHOUSE;
        $body = [
            'branch_id' => $branch,
            'note' => $note,
            'material_category_type_parent_id' => $material_category_type_parent_id,
            'restaurant_materials'=> $restaurant_materials
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if($config['status'] === 400 && isset($config['data'])) {
                $config['table_unfinished_order']=$this->drawDatatableUnfinishedOrder($config['data']);
            }
            return $config;
        }catch(Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawDatatableUnfinishedOrder($data)
    {
        return DataTables::of($data)
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('action', function ($row) {
                return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOutInventoryInternalManage('. $row['id'] .', '. $row['branch'] .')"
                             data-id="'. $row['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                        </div>';
            })
            ->addIndexColumn()
            ->make(true);
    }
    public function dataDetail(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_DETAIL_CHECKLIST_BRANCH_WAREHOUSE, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            switch ($data['status']) {
                case ENUM_INVENTORY_REPORT_STATUS_PENDING:
                    $data['status_label'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                <label class="m-0">Chờ xác nhận</label>
                                            </div>';
                    break;
                case ENUM_INVENTORY_REPORT_STATUS_WAITING_CONFIRM:
                    $data['status_label'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                <label class="m-0">' . TEXT_EDIT . '</label>
                                            </div>';
                    break;
                case ENUM_INVENTORY_REPORT_STATUS_CONFIRMED:
                    $data['status_label'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                <label class="m-0">' . TEXT_DONE . '</label>
                                            </div>';
                    break;
                default:
                    $data['status_label'] = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                <label class="m-0">' . TEXT_CANCELED . '</label>
                                            </div>';
                    break;
            }
            switch ($data['material_category_type_parent_id']) {
                case ENUM_MATERIAL_CATEGORY_PARENT_MATERIAL:
                    $data['inventory'] = TEXT_INVENTORY_MATERIAL;
                    break;
                case ENUM_MATERIAL_CATEGORY_PARENT_GOODS:
                    $data['inventory'] = TEXT_INVENTORY_GOODS;
                    break;
                case ENUM_MATERIAL_CATEGORY_PARENT_INTERNAL:
                    $data['inventory'] = TEXT_INVENTORY_INTERNAL;
                    break;
                default:
                    $data['inventory'] = TEXT_INVENTORY_OTHER;
                    break;
            }
            if ($data['material_category_type_parent_id'] === ENUM_MATERIAL_CATEGORY_PARENT_GOODS) {
                $data_table_material = DataTables::of($data['Inventory_warehouse_session_details'])
                    ->addColumn('name', function ($row) {
                        return $row['restaurant_material_name'] . '<br><div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['material_unit_specification_name'] . '</label>
                                                                    </div>';
                    })
                    ->addColumn('system_last_quantity', function ($row) {
                        return $this->numberFormat($row['system_last_quantity']);
                    })
                    ->addColumn('confirm', function ($row) {
                        return '<div class="input-group border-group validate-table-validate">
                                    <input class="form-control text-center rounded quantity border-0 w-100" data-type="currency-edit" data-max="999999" data-min="0" data-float="1" value="' . $this->numberFormat($row['accountant_quantity']) . '"/>
                                </div>';
                    })
                    ->addColumn('note', function ($row) {
                        return (mb_strlen($row['note']) > 30) ? mb_substr($row['note'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['note'] . '"></i>' : $row['note'];
                    })
                    ->addColumn('note_input', function ($row) {
                        return '<div class="input-group border-group validate-table-validate">
                                    <input class="form-control text-center rounded border-0 w-100" data-max-length="255" value="' . $row['note'] . '"/>
                                </div>';
                    })
                    ->addColumn('confirm_quantity', function ($row) {
                        return $this->numberFormat($row['accountant_quantity']);
                    })
                    ->addColumn('confirm_wastage_quantity', function ($row) {
                        return $this->numberFormat($row['difference_quantity']);
                    })
                    ->addColumn('action', function ($row) {
                        return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light material-id" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" data-unit-value="1" data-id="' . $row['id'] . '" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')"><i class="fi-rr-eye"></i></button>
                                </div>';
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['name', 'confirm', 'note', 'note_input', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            } else {
                $data_table_material = DataTables::of($data['Inventory_warehouse_session_details'])
                    ->addColumn('name', function ($row) {
                        return $row['restaurant_material_name'] . '<br><div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['material_unit_full_name'] . '</label>
                                                                    </div>';
                    })
                    ->addColumn('system_last_quantity', function ($row) {
                        return $this->numberFormat($row['system_last_big_quantity']);
                    })
                    ->addColumn('confirm', function ($row) {
                        return '<div class="input-group border-group validate-table-validate">
                                    <input class="form-control text-center rounded quantity  border-0 w-100" data-max="999999" data-min="0" data-float="1" value="' . $this->numberFormat($row['accountant_big_quantity']) . '"/>
                            </div>';
                    })
                    ->addColumn('note', function ($row) {
                        return (mb_strlen($row['note']) > 30) ? mb_substr($row['note'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['note'] . '"></i>' : $row['note'];
                    })
                    ->addColumn('note_input', function ($row) {
                        return '<div class="input-group border-group validate-table-validate">
                                    <input class="form-control rounded border-0 w-100" data-max-length="255" data-note="1" value="' . $row['note'] . '"/>
                            </div>';
                    })
                    ->addColumn('confirm_quantity', function ($row) {
                        return $this->numberFormat($row['accountant_big_quantity']);
                    })
                    ->addColumn('confirm_wastage_quantity', function ($row) {
                        return $this->numberFormat($row['difference_big_quantity']);
                    })
                    ->addColumn('action', function ($row) {
                        return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light material-id" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" data-unit-value="' . $row['material_unit_specification_id'] . '"  data-id="' . $row['id'] . '" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')"><i class="fi-rr-eye"></i></button>
                                </div>';
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['name', 'confirm', 'note', 'note_input', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            }
            return [$data, $data_table_material, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function confirm(Request $request)
    {
        $id = $request->get('id');
        $materials = $request->get('material');
        $branch = $request->get('branch');
        $note = $request->get('note');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api =sprintf(API_POST_UPDATE_CHECKLIST_BRANCH_WAREHOUSE, $id);
        $body = [
            'note' => $note,
            'branch_id' => $branch,
            'material_category_type_parent_id' => $id,
            'details' => $materials,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function confirmChecklist(Request $request)
    {
        $id = $request->get('id');
        $is_confirm = $request->get('is_confirm');
        $is_export_inventory_next_month = $request->get('is_export_inventory_next_month');
        $status = ENUM_INVENTORY_REPORT_STATUS_CONFIRMED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_POST_STATUS_CHECKLIST_GOODS, $id);
        $body = [
            'status' => $status,
            'inventory_report_id' => $id,
            'reason' => $request->get('reason'),
            'is_export_inventory_next_month' => $is_export_inventory_next_month,
            'is_confirm' => $is_confirm,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function changeStatusCheckList (Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');
        $is_export_inventory_next_month = $request->get('is_export_inventory_next_month');
        $reason = $request->get('reason');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_POST_CHANGE_STATUS_CHECKLIST_BRANCH_WAREHOUSE, $id);
        $body = [
            'status' => $status,
            'inventory_warehouse_session_id' => $id,
            'reason' => $reason,
            'is_export_inventory_next_month' => $is_export_inventory_next_month,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

//    public function cancel(Request $request)
//    {
//        $id = $request->get('id');
//        $reason = $request->get('reason');
//        $status = ENUM_INVENTORY_REPORT_STATUS_CANCELLED;
//        $project = ENUM_PROJECT_ID_ORDER;
//        $method = ENUM_METHOD_POST;
//        $api = sprintf(API_POST_STATUS_CHECKLIST_GOODS, $id);
//        $body = [
//            'status' => $status,
//            'inventory_report_id' => $id,
//            'reason' => $reason,
//        ];
//        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
//    }
}
