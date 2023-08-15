<?php

namespace App\Http\Controllers\BuildData\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class PermissionSalesController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Quyền doanh số';
        return view('build_data.business.permission_sales.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $employeeManage = [
            'id' => collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('id', $branch)->first()['employee_id'],
            'name' => collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('id', $branch)->first()['employee_manager_full_name'],
        ];
        $api = sprintf(API_CHANGE_MANAGER_TEMPORARY_FOOD_ASSIGN, $branch);
        $body = null;
        $requestListAreas = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $is_include_restaurant_manager = ENUM_GET_ALL;
        $status = ENUM_SELECTED;
        $is_take_myself = ENUM_GET_ALL;
        $api = sprintf(API_CHANGE_MANAGER_GET_DATA, $branch, $status, $is_include_restaurant_manager, $is_take_myself);
        $body = null;
        $requestListEmployee = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestListAreas, $requestListEmployee]);
        try {
            $update = TEXT_UPDATE;
            $dataTableArea = DataTables::of($configAll[0]['data']['list'])
                ->addColumn('action', function ($row) use ($update) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-id="' . $row['id'] . '" data-employee="' . $row['employee_id'] . '" data-area="' . $row['name'] . '" data-employee-manager="' . $row['employee_manager_full_name'] . '" onclick="openModalUpdatePermissionSalesAreasData($(this))"><span class="icofont icofont-ui-edit"></span>
                            </button>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            $dataTableEmployee = DataTables::of($configAll[1]['data']['list'])
                ->addColumn('name', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/><label class="title-name-new-table" >' . $row['name'] . '<br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>'.$row['role_name'].'</label></label>';
                })
                ->addColumn('check', function ($row) {
                    return '<div class="form-group validate-group " style="margin: 0 !important;">
                        <div class="form-validate-checkbox m-0 p-0" >
                            <div class="checkbox-form-group justify-content-center  ">
                                <input class="m-0" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" class="radio" name="check" onclick="checkEmployeeManageBranch($(this))" type="checkbox">
                             </div>
                        </div>
                    </div>';
                })
                ->addColumn('gender', function ($rows) {
                    if ($rows['gender'] == Config::get('constants.type.gender.female.VALUE')) {
                        $message =  '<i class="ion-female mr-1 "></i>'.TEXT_FEMALE;
                    } else {
                        $message = '<i class="ion-male mr-1 text-primary"></i>'.TEXT_MALE;
                    }
                    return $message;
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['check', 'name','gender'])
                ->addIndexColumn()
                ->make(true);
            return [$employeeManage, $dataTableArea, $dataTableEmployee, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataUpdate(Request $request)
    {
        $is_include_restaurant_manager = ENUM_GET_ALL;
        $status = ENUM_SELECTED;
        $is_take_myself = ENUM_GET_ALL;
        $id = $request->get('id');
        $branch = $request->get('branch');
        $api = sprintf(API_CHANGE_MANAGER_GET_DATA, $branch, $status, $is_include_restaurant_manager, $is_take_myself);
        $body = null;
        $requestListEmployee = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $api = sprintf(API_SALARY_GET_EMPLOYEE_DETAIL, $id);
        $body = null;
        $requestEmployeeDetail = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $configAll = $this->callApiMultiGatewayTemplate([$requestListEmployee, $requestEmployeeDetail]);
        try {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $data = collect($configAll[0]['data']['list'])->where('id', '!=', $id)->all();
            $dataTableEmployee = DataTables::of($data)
                ->addColumn('employee_avatar', function ($row) use ($domain) {
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/></label>';
                })
                ->addColumn('check', function ($row) use ($id) {
                    return '<div class="checkbox-fade fade-in-primary m-auto">
                                <label>
                                    <input type="radio" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" class="radio" name="manage" onclick="checkEmployee($(this))"/>
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                </label>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['check', 'employee_avatar'])
                ->addIndexColumn()
                ->make(true);
            $dataDetailEmployee = "Chưa có hưởng danh số khu vực";
            if ($id != 0) {
                $dataDetailEmployee = $configAll[1]['data'];
                $dataDetailEmployee['avatar'] = $domain . $dataDetailEmployee['avatar'];
            }
            return [$dataTableEmployee, $dataDetailEmployee, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function manageBranch(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CHANGE_MANAGER_POST_BRANCH, $id);
        $body = [
            "branch_id" => $branch,
            "privilege_tag_id" => ENUM_SELECTED
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $dataList = Session::get(SESSION_KEY_DATA_BRANCH);
            for ($i = 0; $i < count($dataList); $i++) {
                if ($dataList[$i]['id'] === $config['data']['branch_id']) {
                    $dataList[$i]['employee_id'] = $config['data']['id'];
                    $dataList[$i]['employee_manager_full_name'] = $config['data']['full_name'];
                }
            }
            Session::put(SESSION_KEY_DATA_BRANCH, $dataList);
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
