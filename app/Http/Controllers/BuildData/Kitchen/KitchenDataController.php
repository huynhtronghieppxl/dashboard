<?php

namespace App\Http\Controllers\BuildData\Kitchen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\DataTables;

class KitchenDataController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(0);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Bếp';
        return view('build_data.kitchen.kitchen.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $branchID = $request->get('branch_id');
        $status = ENUM_GET_ALL;
        $isHavePrinter = ENUM_GET_ALL;
        $isBarKitchen = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_KITCHEN_DATA_GET_DATA, $restaurant_brand_id, $branchID, $status, $isHavePrinter, $isBarKitchen);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $enableData = $collection->where('status', ENUM_SELECTED);
            $tableEnableData = $this->drawTableKitchen($enableData);
            $disableData = $collection->where('status', ENUM_DIS_SELECTED);
            $tableDisableData = $this->drawTableKitchen($disableData);
            $data_total = [
                'total_enable_kitchen' => $this->numberFormat(count($enableData)),
                'total_kitchen_kitchen' => $this->numberFormat(count($disableData)),
            ];
            return [$tableEnableData, $tableDisableData, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTableKitchen($data)
    {
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                if ($row['id'] !== ENUM_DIS_SELECTED) {
                    if ($row['status'] === ENUM_SELECTED) {
                        return '<div class="btn-group btn-group-sm text-center">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Gán bếp cho nhân viên" onclick="openModalKitchenAssignForEmployee($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '">
                                        <i class="fi-rr-user-add"></i>
                                    </button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '" onclick="changeStatusKitchenData($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '">
                                        <i class="fi-rr-cross"></i>
                                    </button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" onclick="openModalUpdateKitchenData($(this))" data-id="' . $row['id'] . '" data-type="' . $row['type'] . '" data-status="' . $row['status'] . '">
                                        <i class="fi-rr-pencil"></i>
                                    </button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailKitchenData($(this))" data-id="' . $row['id'] . '" data-restaurant-brand-id="' . $row['restaurant_brand_id'] . '">
                                        <i class="fi-rr-eye"></i>
                                    </button>
                                </div>';
                    } else {
                        return '<div class="btn-group btn-group-sm text-center">
                                    <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '" onclick="changeStatusKitchenData($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '">
                                        <i class="fi-rr-check"></i>
                                    </button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" onclick="openModalUpdateKitchenData($(this))" data-id="' . $row['id'] . '" data-type="' . $row['type'] . '" data-status="' . $row['status'] . '">
                                        <i class="fi-rr-pencil"></i>
                                    </button>
                                </div>';
                    }
                } else {
                    return '<p class="text text-warning border-resize-datatable">' . TEXT_KITCHEN_DATA_NOTE_KITCHEN . '</p>';
                }
            })
            ->addColumn('description', function ($row) {
                if (mb_strlen($row['description']) > 30) {
                    return mb_substr($row['description'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse"  data-toggle="tooltip" data-placement="top" data-original-title="' . $this->removeSpecialCharacterAttr($row['description']) . '"></i>';
                } else {
                    return $row['description'];
                }
            })
            ->addColumn('type_text', function ($row) {
                switch ($row['type']) {
                    case ENUM_KITCHEN_BUILD_DATA_BEER_BAR_GOODS:
                        return TEXT_KITCHEN_BUILD_DATA_BEER_BAR_GOODS;
                    case ENUM_KITCHEN_BUILD_DATA_KITCHEN:
                        return TEXT_KITCHEN_BUILD_DATA_KITCHEN;
                    case ENUM_KITCHEN_BUILD_DATA_CASHIER:
                        return TEXT_KITCHEN_BUILD_DATA_CASHIER;
                    case ENUM_KITCHEN_BUILD_DATA_FISH_BOWL:
                        return TEXT_KITCHEN_BUILD_DATA_FISH_BOWL;
                    case ENUM_KITCHEN_BUILD_DATA_TOPPING:
                        return TEXT_KITCHEN_BUILD_DATA_TOPPING;
                    default:
                        return TEXT_KITCHEN_BUILD_DATA_CASHIER;
                }
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'description'])
            ->make(true);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');;
        $api = sprintf(API_KITCHEN_DATA_GET_DETAIL, $id);
        $body = null;
        $requestInfoKitchen = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $key = '';
        $branch_id = $request->get('branch_id');
        $status = ENUM_SELECTED;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $is_get_food_by_kitchen_id = ENUM_DIS_SELECTED;
        $is_deleted = ENUM_DIS_SELECTED;
        $kitchen_id = $request->get('id');
        $api = sprintf(API_KITCHEN_DATA_GET_FOOD, $restaurant_brand_id, $branch_id, $kitchen_id, $status, $is_deleted, $is_get_food_by_kitchen_id, $key, $limit, $page);
        $body = null;
        $requestFoodKitchen = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestInfoKitchen, $requestFoodKitchen]);
        try{
        $dataInfo = $configAll[0]['data'];
        $dataInfo['type'] = ($dataInfo['type'] === ENUM_DIS_SELECTED) ? TEXT_KITCHEN_BUILD_DATA_BEER_BAR_GOODS : TEXT_KITCHEN_BUILD_DATA_KITCHEN;
        $dataInfo['printer_paper_size'] = $dataInfo['printer_paper_size'] . 'mm' ;

        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $detail = TEXT_DETAIL;
        $dataFoodKitchen = DataTables::of($configAll[1]['data']['list'])
            ->addColumn('name', function ($row) use ($domain) {
                if (mb_strlen($row['name']) > 30) {
                    return mb_substr($row['name'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['name'] . '"></i>';
                } else {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $row['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' . $row['code'] . '</label>
                         </label>';
                }
            })
            ->addColumn('price', function ($row) use ($domain) {
                return $this->numberFormat($row['price']);
            })
            ->addColumn('action', function ($row) use ($detail) {
                $row['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');
                return '<div class="btn-group btn-group-sm text-center">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . $detail . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                        </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['name', 'avatar', 'action'])
            ->addIndexColumn()
            ->make(true);

        $dataTotal = count($configAll[1]['data']['list']);

        return [$dataInfo, $dataFoodKitchen, $dataTotal ,$configAll];
        }catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function create(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $name = $request->get('name');
        $description = $request->get('description');
        $printerName = $request->get('printer_name');
        $printerIPAddress = $request->get('printer_ip_address');
        $printerPort = $request->get('printer_port');
        $printerPaperSize = $request->get('printer_paper_size');
        $isHavePrinter = $request->get('is_have_printer');
        $isPrintEachFood = $request->get('is_print_each_food');
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_KITCHEN_DATA_POST_CREATE);
        $body = [
            "restaurant_brand_id" => $restaurantBrandID,
            "branch_id" => $branch_id,
            "name" => $name,
            "description" => $description,
            "status" => $status,
            "printer_name" => $printerName,
            "printer_ip_address" => $printerIPAddress,
            "printer_port" => $printerPort,
            "printer_paper_size" => $printerPaperSize,
            "is_have_printer" => $isHavePrinter,
            "is_print_each_food" => $isPrintEachFood,
            "type" => $request->get('type'),
            "printer_type" => $request->get('printer_type'),
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $config['data']['type_text'] = ($config['data']['type'] === ENUM_DIS_SELECTED) ? TEXT_KITCHEN_BUILD_DATA_BEER_BAR_GOODS : TEXT_KITCHEN_BUILD_DATA_KITCHEN;
                $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_KITCHEN_ASSIGN_EMPLOYEE . '" onclick="openModalKitchenAssignForEmployee($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '">
                                                <i class="fi-rr-user-add"></i>
                                            </button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '" onclick="changeStatusKitchenData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '">
                                                <i class="fi-rr-cross"></i>
                                            </button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-type="' . $config['data']['type'] . '" onclick="openModalUpdateKitchenData($(this))" data-id="' . $config['data']['id'] . '">
                                                <i class="fi-rr-pencil"></i>
                                            </button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" data-id="' . $config['data']['id'] . '" onclick="openModalDetailKitchenData($(this))" data-restaurant-brand-id="' . $config['data']['restaurant_brand_id'] . '">
                                                <i class="fi-rr-eye"></i>
                                            </button>
                                        </div>';
                if (mb_strlen($config['data']['description']) > 30) $config['data']['description'] = mb_substr($config['data']['description'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse"  data-toggle="tooltip" data-placement="top" data-original-title="' . $this->removeSpecialCharacterAttr($config['data']['description']) . '"></i>';
            }
            return $config;
        }catch (Exception $e) {
                return $this->catchTemplate($config, $e);
            }
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_KITCHEN_DATA_GET_DETAIL, $id);
        $body = null;
        return $this->callApiGatewayTemplate($project, $method, $api, $body);

    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $description = $request->get('description');
        $status = $request->get('status');
        $printerName = $request->get('printer_name');
        $printerIPAddress = $request->get('printer_ip_address');
        $printerPort = $request->get('printer_port');
        $printerPaperSize = $request->get('printer_paper_size');
        $isHavePrinter = $request->get('is_have_printer');
        $isPrintEachFood = $request->get('is_print_each_food');
        $printType = $request->get('print_type');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_KITCHEN_DATA_GET_DETAIL, $id);
        $body = [
            "name" => $name,
            "description" => $description,
            "status" => $status,
            "printer_name" => $printerName,
            "printer_ip_address" => $printerIPAddress,
            "printer_port" => $printerPort,
            "printer_paper_size" => $printerPaperSize,
            "is_have_printer" => $isHavePrinter,
            "is_print_each_food" => $isPrintEachFood,
            "printer_type" => $printType,
            "type" => $request->get('type'),
            "branch_id" => $request->get('branch_id'),
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try{
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate([$config['data']['name'], $config['data']['type'], $config['data']['description']]);
            if ($config['data']['status'] === ENUM_SELECTED) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_KITCHEN_ASSIGN_EMPLOYEE . '" onclick="openModalKitchenAssignForEmployee($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '">
                                                <i class="fi-rr-user-add"></i>
                                            </button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '" onclick="changeStatusKitchenData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '">
                                                <i class="fi-rr-cross"></i>
                                            </button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-type="' . $config['data']['type'] . '" onclick="openModalUpdateKitchenData($(this))" data-id="' . $config['data']['id'] . '">
                                                <i class="fi-rr-pencil"></i>
                                            </button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" data-id="' . $config['data']['id'] . '" onclick="openModalDetailKitchenData($(this))" data-restaurant-brand-id="' . $config['data']['restaurant_brand_id'] . '">
                                                <i class="fi-rr-eye"></i>
                                            </button>
                                        </div>';
            } else {
                $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                    <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '" onclick="changeStatusKitchenData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '">
                                        <i class="fi-rr-check"></i>
                                    </button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" onclick="openModalUpdateKitchenData($(this))" data-id="' . $config['data']['id'] . '" data-type="' . $config['data']['type'] . '" data-status="' . $config['data']['status'] . '">
                                        <i class="fi-rr-pencil"></i>
                                    </button>
                                </div>';
            }
            $config['data']['type_text'] = ($config['data']['type'] === ENUM_DIS_SELECTED) ? TEXT_KITCHEN_BUILD_DATA_BEER_BAR_GOODS : TEXT_KITCHEN_BUILD_DATA_KITCHEN;
            if (mb_strlen($config['data']['description']) > 30) $config['data']['description'] = mb_substr($config['data']['description'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse"  data-toggle="tooltip" data-placement="top" data-original-title="' . $this->removeSpecialCharacterAttr($config['data']['description']) . '"></i>';
        }
        return $config;
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function employeeData(Request $request)
    {
        $restaurant_kitchen_place_id = $request->get('restaurant_kitchen_place_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_KITCHEN_DATA_GET_EMPLOYEE,$restaurant_kitchen_place_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $data_selected = $collection->where('is_in_restaurant_kitchen_place',  ENUM_SELECTED)->all();
            $data_unselected = $collection->where('is_in_restaurant_kitchen_place', ENUM_DIS_SELECTED)->all();
            $data_table_selected = DataTables::of($data_selected)
                ->addColumn('name', function ($row) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . $row['full_name'] . '<label>';
                })
                ->addColumn('role', function ($row) {
                    return $row['employee_role_name'];
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light btn-convert-right-to-left pointer"  onclick="unCheckKitchenEmployeeData($(this))" data-id="' . $row['employee_id'] . '" data-type="1"><i class="fi-rr-arrow-small-left " ></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
            $data_table_unselected = DataTables::of($data_unselected)
                ->addColumn('name', function ($row) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . $row['full_name'] . '<label>';
                })
                ->addColumn('role', function ($row) {
                        return $row['employee_role_name'];
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light btn-convert-left-to-right pointer"  onclick="checkKitchenEmployeeData($(this))" data-id="' . $row['employee_id'] . '" data-type="0"><i class="fi-rr-arrow-small-right " ></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
            return [$data_table_unselected, $data_table_selected, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function assignEmployee(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_KITCHEN_DATA_ASSIGN_EMPLOYEE;
        $body = [
            "restaurant_kitchen_place_id" => $request->get('id'),
            "employee_insert_ids" => $request->get('employees_id_insert'),
            "employee_delete_ids" => $request->get('employees_id_delete')
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_KITCHEN_DATA_POST_CHANGE_STATUS, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try{
        if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            if ($config['data']['status'] === ENUM_SELECTED) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Gán bếp cho nhân viên" onclick="openModalKitchenAssignForEmployee($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '">
                                        <i class="fi-rr-user-add"></i>
                                    </button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '" onclick="changeStatusKitchenData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '">
                                        <i class="fi-rr-cross"></i>
                                    </button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" onclick="openModalUpdateKitchenData($(this))" data-id="' . $config['data']['id'] . '" data-type="' . $config['data']['type'] . '" data-status="' . $config['data']['status'] . '">
                                        <i class="fi-rr-pencil"></i>
                                    </button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailKitchenData($(this))" data-id="' . $config['data']['id'] . '" data-restaurant-brand-id="' . $config['data']['restaurant_brand_id'] . '">
                                        <i class="fi-rr-eye"></i>
                                    </button>
                                </div>';
            } else {
                $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                    <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '" onclick="changeStatusKitchenData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '">
                                        <i class="fi-rr-check"></i>
                                    </button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" onclick="openModalUpdateKitchenData($(this))" data-id="' . $config['data']['id'] . '" data-type="' . $config['data']['type'] . '" data-status="' . $config['data']['status'] . '">
                                        <i class="fi-rr-pencil"></i>
                                    </button>
                                </div>';
            }
            if (mb_strlen($config['data']['description']) > 30) $config['data']['description'] = mb_substr($config['data']['description'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse"  data-toggle="tooltip" data-placement="top" data-original-title="' . $this->removeSpecialCharacterAttr($config['data']['description']) . '"></i>';
            $config['data']['type_text'] = ($config['data']['type'] === 0) ? 'Kho bia/ Quầy bar/ Hàng hoá' : 'Bếp nấu';

        }
        return $config;
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
