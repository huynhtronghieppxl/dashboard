<?php
namespace App\Http\Controllers\Manage\Warehouse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
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
        $active_nav = 'Kiểm kê kho tổng';
        return view('manage.warehouse.inventory.index', compact('active_nav'));
    }
    public function data(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $branch = $request->get('branch');
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $statuses = ENUM_INVENTORY_REPORT_STATUS_GET_ALL;
        $material_category_type_parent_id = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $body = null;
        $api = sprintf(API_GET_LIST_CHECKLIST_GOODS, $page, $limit, $branch, $material_category_type_parent_id, $from, $to, $statuses);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $data_material = $collection->where('material_category_type_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_MATERIAL)->where('status', '!==', ENUM_INVENTORY_REPORT_STATUS_CANCELLED)->all();
            $data_goods = $collection->where('material_category_type_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_GOODS)->where('status', '!==', ENUM_INVENTORY_REPORT_STATUS_CANCELLED)->all();
            $data_internal = $collection->where('material_category_type_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_INTERNAL)->where('status', '!==', ENUM_INVENTORY_REPORT_STATUS_CANCELLED)->all();
            $data_other = $collection->where('material_category_type_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_OTHER)->where('status', '!==', ENUM_INVENTORY_REPORT_STATUS_CANCELLED)->all();
            $data_cancel = $collection->where('status', ENUM_INVENTORY_REPORT_STATUS_CANCELLED)->all();
            $data_table_material = $this->drawTableInventoryWarehouse($data_material);
            $data_table_goods = $this->drawTableInventoryWarehouse($data_goods);
            $data_table_internal = $this->drawTableInventoryWarehouse($data_internal);
            $data_table_other = $this->drawTableInventoryWarehouse($data_other);
            $data_table_cancel = $this->drawTableInventoryWarehouse($data_cancel);
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

    public function drawTableInventoryWarehouse($data)
    {
        return DataTables::of($data)
            ->addColumn('status_text', function ($row) {
                switch ($row['status']) {
                    case ENUM_INVENTORY_REPORT_STATUS_PENDING:
//                        return '<label class="label label-warning">' . TEXT_BALANCE . '</label>';
                        return '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_BALANCE . '</label>
                                </div>';
                    case ENUM_INVENTORY_REPORT_STATUS_CONFIRMED:
//                        return '<label class="label label-success">' . TEXT_BALANCED . '</label>';
                        return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_BALANCED . '</label>
                                </div>';
                    default:
//                        return '<label class="label label-danger">' . TEXT_CANCELED_TEXT . '</label>';
                        return '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_CANCELED_TEXT . '</label>
                                </div>';
                }
            })
            ->addColumn('employee_create_name', function ($row) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_create_avartar'] . '" class="img-inline-name-data-table">
                        <label class="title-name-new-table">' . $row['employee_create_name'] . '<br>
                              <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_create_role_name'] . '</label>
                        </label>';
            })
            ->addColumn('employee_confirm_name', function ($row) {
                if($row['employee_confirm_employee_role_name'] !=''){
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_confirm_avartar'] . '" class="img-inline-name-data-table">
                        <label class="title-name-new-table">' . $row['employee_confirm_name'] . '<br>
                              <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_confirm_employee_role_name'] . '</label>
                        </label>';
                }
                else {
                    return '';
                }

            })
            ->addColumn('employee_cancel_name', function ($row) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_cancel_avartar'] . '" class="img-inline-name-data-table">
                        <label class="title-name-new-table">' . $row['employee_cancel_name'] . '<br>
                              <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_cancel_employee_role_name'] . '</label>
                        </label>';
            })
            ->addColumn('action', function ($row) {
                if ($row['is_checked'] === ENUM_SELECTED && $row['status'] === ENUM_INVENTORY_REPORT_STATUS_PENDING) {
                    return '<div class="btn-group btn-group-sm float-right">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="confirmInventoryWarehouseManage($(this))" data-id="'. $row['id'] .'" data-reason="'. $row['note'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONFIRM . '"><i class="fi-rr-check"></i></span></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="confirmCheckListNextMonthGoodsManage($(this))" data-id="'. $row['id'] .'" data-reason="'. $row['note'] .'" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận chuyển giao tháng tiếp theo"><i class="fi-rr-angle-double-right"></i></button><br>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" data-inventory="' . $row['material_category_type_parent_id'] . '" data-time="' . $row['time'] . '" onclick="openConfirmInventoryWarehouseManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></span></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" data-inventory="' . $row['material_category_type_parent_id'] . '" data-time="' . $row['time'] . '" onclick="openDetailInventoryWarehouseManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                } else if ($row['status'] === ENUM_INVENTORY_REPORT_STATUS_PENDING) {
                    return '<div class="btn-group btn-group-sm float-right">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" data-inventory="' . $row['material_category_type_parent_id'] . '" data-time="' . $row['time'] . '" onclick="confirmCheckListNextMonthGoodsManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận chuyển giao tháng tiếp theo"><i class="fi-rr-angle-double-right"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green  waves-effect waves-light" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" data-inventory="' . $row['material_category_type_parent_id'] . '" data-time="' . $row['time'] . '" onclick="openConfirmInventoryWarehouseManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></span></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" data-inventory="' . $row['material_category_type_parent_id'] . '" data-time="' . $row['time'] . '" onclick="openDetailInventoryWarehouseManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                } else {
                    return '<div class="btn-group btn-group-sm float-right">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" data-inventory="' . $row['material_category_type_parent_id'] . '" data-time="' . $row['time'] . '" onclick="openDetailInventoryWarehouseManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                }
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate([$row['code'], $row['employee_create_name'], $row['employee_confirm_name'], $row['time']]);
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
        $api = sprintf(API_GET_MATERIAL_CHECKLIST_GOODS_CATEGORY, $id, $branch, $inventory, $time, $id);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            if ($inventory === ENUM_MATERIAL_CATEGORY_PARENT_GOODS) {
                $data_table_material = DataTables::of($data)
                    ->addColumn('system_last_quantity', function ($row) {
                        return $this->numberFormat($row['system_last_quantity']);
                    })
                    ->addColumn('confirm', function ($row) {
                        return '<div class="input-group border-group validate-table-validate">
                                    <input class="form-control text-center rounded quantity border-0 w-100" data-max="999999" data-float="1" value="' . $this->numberFormat($row['confirm_quantity']) . '" data-type="currency-edit" data-min="0">
                                </div>';
                    })
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
                    ->addColumn('confirm_quantity', function ($row) {
                        return $this->numberFormat($row['confirm_quantity']);
                    })
                    ->addColumn('confirm_wastage_quantity', function ($row) {
                        return $this->numberFormat($row['confirm_wastage_quantity']);
                    })
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
                    ->addColumn('confirm', function ($row) {
                        return '<div class="input-group border-group validate-table-validate">
                                  <input class="form-control text-center rounded quantity border-0 w-100" data-max="999999" value="' . $this->numberFormat($row['confirm_big_quantity']) . '" data-type="currency-edit" data-min="0" data-float="1">
                                </div>';
                    })
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
                    ->addColumn('confirm_quantity', function ($row) {
                        return $this->numberFormat($row['confirm_big_quantity']);
                    })
                    ->addColumn('confirm_wastage_quantity', function ($row) {
                        return $this->numberFormat($row['confirm_wastage_big_quantity']);
                    })
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
        $from = Config::get('constants.type.data.NONE');
        $to = Config::get('constants.type.data.NONE');
        $branch = $request->get('branch');
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_100;
        $statuses = ENUM_INVENTORY_REPORT_STATUS_GET_NOT_CANCEL;
        $material_category_type_parent_id = $request->get('inventory');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $body = null;
        $api = sprintf(API_GET_LIST_CHECKLIST_GOODS, $page, $limit, $branch, $material_category_type_parent_id, $from, $to, $statuses);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if (count($config['data']['list']) === 1) {
                $time = $config['data']['list'][0]['time'];
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
        $branch = $request->get('branch');
        $note = $request->get('note');
        $time = $request->get('time');
        $material_category_type_parent_id = $request->get('material_category_type_parent_id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_POST_CREATE_CHECKLIST_GOODS);
        $body = [
            'branch_id' => $branch,
            'note' => $note,
            'time' => $time,
            'material_category_type_parent_id' => $material_category_type_parent_id,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $api = sprintf(API_POST_CONFIRM_CHECKLIST_GOODS, $config['data']);
            $body = [
                'branch_id' => $branch,
                'inventory_report_id' => $config['data'],
                'materials' => $materials
            ];
            $config['material'] = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        }
        return $config;
    }

    public function dataDetail(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_DETAIL_CHECKLIST_GOODS, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            switch ($data['status']) {
                case ENUM_INVENTORY_REPORT_STATUS_PENDING:
//                    $data['status_label'] = '<label class="label label-lg label-warning">' . TEXT_EDIT . '</label>';
                    $data['status_label'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                <label class="m-0">' . TEXT_EDIT . '</label>
                                            </div>';
                    break;
                case ENUM_INVENTORY_REPORT_STATUS_CONFIRMED:
//                    $data['status_label'] = '<label class="label label-lg label-success">' . TEXT_DONE . '</label>';
                    $data['status_label'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                <label class="m-0">' . TEXT_DONE . '</label>
                                            </div>';
                    break;
                default:
//                    $data['status_label'] = '<label class="label label-lg label-danger">' . TEXT_CANCELED . '</label>';
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
                $data_table_material = DataTables::of($data['list_material'])
                    ->addColumn('name', function ($row) {
//                        return $row['name'] . '<br><label class="m-t-2 label label-info">' . $row['material_unit_specification_exchange_name'] . '</label>';
                        return $row['name'] . '<br><div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['material_unit_specification_exchange_name'] . '</label>
                                                                    </div>';
                    })
                    ->addColumn('system_last_quantity', function ($row) {
                        return $this->numberFormat($row['system_last_quantity']);
                    })
                    ->addColumn('confirm', function ($row) {
                        return '<div class="input-group border-group validate-table-validate">
                                    <input class="form-control text-center rounded quantity border-0 w-100" data-type="currency-edit" data-max="999999" data-min="0" data-float="1" value="' . $this->numberFormat($row['confirm_quantity']) . '"/>
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
                        return $this->numberFormat($row['confirm_quantity']);
                    })
                    ->addColumn('confirm_wastage_quantity', function ($row) {
                        return $this->numberFormat($row['confirm_quantity'] - $row['system_last_quantity']);
                    })
                    ->addColumn('action', function ($row) {
                        return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light material-id" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" data-unit-value="1" data-id="' . $row['id'] . '" onclick="openModalDetailMaterialData(' . $row['id'] . ')"><i class="fi-rr-eye"></i></button>
                                </div>';
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['name', 'confirm', 'note', 'note_input', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            } else {
                $data_table_material = DataTables::of($data['list_material'])
                    ->addColumn('name', function ($row) {
//                        return $row['name'] . '<br><label class="m-t-2 label label-info">' . $row['material_unit_full_name'] . '</label>';
                        return $row['name'] . '<br><div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['material_unit_full_name'] . '</label>
                                                                    </div>';
                    })
                    ->addColumn('system_last_quantity', function ($row) {
                        return $this->numberFormat($row['system_last_big_quantity']);
                    })
                    ->addColumn('confirm', function ($row) {
                        return '<div class="input-group border-group validate-table-validate">
                                    <input class="form-control text-center rounded quantity  border-0 w-100" data-max="999999" data-min="0" data-float="1" value="' . $this->numberFormat($row['confirm_big_quantity']) . '"/>
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
                        return $this->numberFormat($row['confirm_big_quantity']);
                    })
                    ->addColumn('confirm_wastage_quantity', function ($row) {
                        return $this->numberFormat($row['confirm_big_quantity'] - $row['system_last_big_quantity']);
                    })
                    ->addColumn('action', function ($row) {
                        return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light material-id" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" data-unit-value="' . $row['material_unit_specification_exchange_value'] . '"  data-id="' . $row['id'] . '" onclick="openModalDetailMaterialData(' . $row['id'] . ')"><i class="fi-rr-eye"></i></button>
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
        $note = $request->get('note');
        $api =sprintf(API_POST_UPDATE_CHECKLIST_GOODS, $id);
        $body = [
            'id' => $id,
            'note' => $note,
        ];
        $requestUpdate = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body,
        ];
        $materials = $request->get('material');
        $branch = $request->get('branch');
        $api = sprintf(API_POST_CONFIRM_CHECKLIST_GOODS, $id);
        $body = [
            'inventory_report_id' => $id,
            'branch_id' => $branch,
            'materials' => $materials
        ];
        $requestConfirm = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body,
        ];
        return $this->callApiMultiGatewayTemplate2([$requestUpdate, $requestConfirm]);
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

    public function cancel(Request $request)
    {
        $id = $request->get('id');
        $reason = $request->get('reason');
        $status = ENUM_INVENTORY_REPORT_STATUS_CANCELLED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_POST_STATUS_CHECKLIST_GOODS, $id);
        $body = [
            'status' => $status,
            'inventory_report_id' => $id,
            'reason' => $reason,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
