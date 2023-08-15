<?php

namespace App\Http\Controllers\BuildData\Kitchen;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PermissionKitchenDataController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Quyền doanh số bếp';
        return view('build_data.kitchen.permission.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $brand=$request->get('brand');
        $type = 2;
        $api = sprintf(API_KITCHEN_DATA_GET_LIST_EMPLOYEE,$brand, $branch, $type);
        $body = null;
        $requestEmployeeDisSelected = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $type = 1;
        $api = sprintf(API_KITCHEN_DATA_GET_LIST_EMPLOYEE,$brand, $branch, $type);
        $body = null;
        $requestEmployeeSelected = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $type = 2;
        $api = sprintf(API_KITCHEN_DATA_GET_LIST_EMPLOYEE_LEADER, $branch, $type);
        $body = null;
        $requestLeaderDisSelected = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $type = 1;
        $api = sprintf(API_KITCHEN_DATA_GET_LIST_EMPLOYEE_LEADER, $branch, $type);
        $body = null;
        $requestLeaderSelected = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestEmployeeDisSelected, $requestEmployeeSelected, $requestLeaderDisSelected, $requestLeaderSelected]);
        try {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $dataTableEmployeeDisSelected = DataTables::of($configAll[0]['data'])
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                                  <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalInfoEmployeeManage(' . $row['id'] . ')" title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('check', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"   onclick="checkEmployeeKitchen($(this))" data-id="' . $row['id'] . '" data-type="0">
                                <i class="fi-rr-arrow-small-right"></i>
                            </button>
                            </div>';
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table"
                             onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/><label class="align-middle">' . $row['full_name'] . '<br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1" mr-1></i>'. $row['employee_role_name'] .'</label></label>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('role_group', function ($row) {
                    return '<label>' . $row['employee_role_type_name'] . '</label>';
                })
                ->rawColumns(['action', 'avatar', 'check','role_group'])
                ->addIndexColumn()
                ->make(true);
            $dataTableEmployeeSelected = DataTables::of($configAll[1]['data'])
                ->addColumn('action', function ($row){
                    return '<div class="btn-group btn-group-sm text-center">
                                  <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalInfoEmployeeManage(' . $row['id'] . ')" title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('check', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"   onclick="unCheckEmployeeKitchen($(this))" data-id="' . $row['id'] . '" data-type="1">
                                <i class="fi-rr-arrow-small-left"></i>
                            </button>
                            </div>';
                })
                ->addColumn('role_group', function ($row) {
                    return '<label>' . $row['employee_role_type_name'] . '</label>';
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/><label class="align-middle">' . $row['full_name'] . '<br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1" mr-1></i>'. $row['employee_role_name'] .'</label></label>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })

                ->rawColumns(['action', 'avatar', 'check','role_group'])
                ->addIndexColumn()
                ->make(true);
            $dataTableLeaderDisSelected = DataTables::of($configAll[2]['data'])
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                                  <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalInfoEmployeeManage(' . $row['id'] . ')" title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('checkbox', function ($row) {
                    return '<div class="form-group validate-group " style="margin: 0 !important;">
                        <div class="form-validate-checkbox m-0 p-0" >
                            <div class="checkbox-form-group justify-content-center  ">
                                <input class="m-0" data-id="' . $row['id'] . '" data-name="' . $row['full_name'] . '" class="radio" name="check" onclick="checkEmployeeLeaderKitchen($(this))" type="checkbox">
                             </div>
                        </div>
                    </div>';
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>' . $row['full_name'] . '</label>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'avatar', 'checkbox'])
                ->addIndexColumn()
                ->make(true);
            if (count($configAll[3]['data']) === 0) {
                $dataLeaderKitchen = [
                    'id' => '',
                    'name' => 'Chưa có',
                ];
            } else {
                $dataLeaderKitchen = [
                    'id' => $configAll[3]['data'][0]['id'],
                    'name' => '<b   style="font-size: 15px;font-weight: bold; cursor: pointer"" onclick="openModalInfoEmployeeManage(' . $configAll[3]['data'][0]['id'] . ')">' . $configAll[3]['data'][0]['full_name'] . '</b>',
                ];
            }
            return [$dataTableEmployeeDisSelected, $dataTableEmployeeSelected, $dataTableLeaderDisSelected, $dataLeaderKitchen, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function update(Request $request)
    {
        $employeeInsert = $request->get('employee_insert');
        $employeeDelete = $request->get('employee_delete');
        $branch = $request->get('branch');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_KITCHEN_DATA_POST_UPDATE_PERMISSION;
        $body = [
            'employee_id_insert' => $employeeInsert,
            'employee_id_delete' => $employeeDelete,
            'branch_id' => $branch,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function updateLeader(Request $request)
    {
        $employee = $request->get('employee');
        $branch = $request->get('branch');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_KITCHEN_DATA_POST_UPDATE_PERMISSION_LEADER;
        $body = [
            'employee_id' => $employee,
            'branch_id' => $branch,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
}
