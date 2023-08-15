<?php

namespace App\Http\Controllers\BuildData\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;
use Exception;

class RoleDataController extends Controller
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
        $active_nav = 'Quyền bộ phận';
        return view('build_data.personnel.role.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = Config::get('constants.type.id.GET_ALL');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $type = $request->get('role_id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_ROLE_GET_DATA_ROLE, $branch, $status, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = collect($config['data'])->where('role_leader_id', '!==', Config::get('constants.type.checkbox.DIS_SELECTED'))->toArray();
            $data_table = Datatables::of($data)
                ->addColumn('group', function ($row) {
                    switch ($row['type']) {
                        case Config::get('constants.type.EmployeeRoleTypeEnum.OFFICE'):
                            return TEXT_OFFICE;
                        case Config::get('constants.type.EmployeeRoleTypeEnum.BUSINESS'):
                            return TEXT_BUSINESS;
                        case Config::get('constants.type.EmployeeRoleTypeEnum.PRODUCTION'):
                            return TEXT_PRODUCTION;
                        case Config::get('constants.type.EmployeeRoleTypeEnum.MARKETING'):
                            return TEXT_MARKETING;
                        default:
                            return '';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" type="button" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id="' . $row['id'] . '" data-role="' . $row['role_leader_id'] . '" data-type="' . $row['type'] . '" data-description="' . $row['descripttion'] . '" data-name="' . $row['name'] . '" class=" tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" onclick="openModalUpdateRoleData($(this))" title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil "></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            $select_role = '<option value="" selected disabled>' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($config['data'] as $db) {
                $select_role .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }

            return [$data_table, $select_role, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function permission(Request $request)
    {
        $id = $request->get('id');
        $role = $request->get('role');
        $branch = $request->get('branch');
        $api = sprintf(API_PRIVILEGES_ROLE_GET_DATA, $id, $branch);
        $body = null;
        $requestRolePrivilege = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_PRIVILEGES_ROLE_GET_DATA_GROUPS, $id, $branch);
        $requestPrivilege = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $configAll = $this->callApiMultiGatewayTemplate2([$requestRolePrivilege, $requestPrivilege]);
        try{
        $permissionActive = collect($configAll[0]['data'])->pluck('id')->toArray();
        $permissionGroup = collect($configAll[1]['data'])->where('leader_id', 0);
        $permissionAll = collect($configAll[1]['data'])->where('leader_id', 1);
        $privilege = '';
        foreach ($permissionGroup as $data) {
            $class = '';
            $status = 'fa-square';
            $countRole = count($data['privileges']);
            $dataList = collect($data['privileges'])->pluck('id')->toArray();
            if (count(array_intersect($dataList, $permissionActive)) === count($dataList)) {
                $status = 'fa-check-square';
                $class = 'active-role-data';
            }
            $privilege .= '<div class="card custom-div-part flex-sub"><div class="zoneQA" data-id="' . implode(",", $dataList) . '">';
            $privilege .= ' <div class="ques group-role-permision">
                                <div class="ques-title widget-title ">' . $data['name'] . ' <i class="fa fa-2x ' . $status . ' role-fa-square"></i>
                                    <br>
                                    <span>' . $data['description'] . '</span>
                                </div>
                                <div class="hidden-general-info"">
                                    <span class="detail-role">Chi tiết</span>
                                </div>
                            </div>
                            ';
            foreach ($data['privileges'] as $key => $db) {
                $count = $key + 1;
                $key_search = $this->keySearchDatatableTemplate([$data['name'] . $db['name'] . $db['name'] . $db['description'] . $db['code']]);
                $privilege .= '<div class="ans" data-search="' . $key_search . '" data-id="' . $db['id'] . '">
                                <ul class="followers ps-container ps-theme-default ps-active-y"
                                    data-ps-id="754e5a55-a29f-3aa0-6447-2b9deb2e17f6">
                                    <li class="' . $class . '">
                                        <div style="display: inline-block;vertical-align: super"
                                             class="btn-group btn-group-sm">
                                        </div>
                                        <div class="friend-meta d-inline-block">
                                            <h4 class="description-role">' . $count . '.' . $db['name'] . '</h4>
                                            <span>' . $db['description'] . '</span>
                                        </div>

                                    </li>
                                </ul>
                            </div>';
            }
            $privilege .= '</div></div>';
        }

        if ($permissionGroup === [] || $permissionAll === []) {
            $privilege .= '';
        } else {
            $privilege .= '';
        }
        foreach ($permissionAll as $data) {
            $privilege .= '<div class="px-0 col-lg-12 pt-4 group-permision">
                                <div class="card">
                                    <div class="group-title-permission pointer">
                                        <div class="title-name-group d-flex"> ' . $data['name'] . ' <i class="icofont icofont-caret-up text-black-50 ml-1"></i></div>
                                    </div>
                                    <div class="card-block pb-0 pt-4" style="min-height: 42px !important;">';
            foreach ($data['privileges'] as $key => $db) {
                $class = 'work-not-active';
                $status = '<i class="fa fa-2x fa-square" style="width: 20px !important;font-size: 20px !important;"></i>';
                if (in_array($db['id'], $permissionActive)) {
                    $class = 'work-active';
                    $status = '<i class="fa fa-2x fa-check-square" style="width: 20px !important;font-size: 20px !important;"></i>';
                }
                $key_search = $this->keySearchDatatableTemplate([$data['name'] . $db['name'] . $db['name'] . $db['description'] . $db['code']]);
                $privilege .= '<div class="card-block2 edit-flex-auto-fill">
                                    <div class="sortable-moves flex-sub ' . $class . '" data-search="' . $key_search . '" data-id="' . $db['id'] . '">
                                         <div class="btn-group btn-group-sm"><button type="button" class="btn btn-inverse waves-effect waves-light btn-index-work">' . ($key + 1) . '</button></div>
                                         <h6>' . $db['name'] . '</h6>
                                         <p>' . $db['description'] . '</p>
                                         <span>' . $status . '</span>
                                    </div>
                               </div>';
            }
            $privilege .= '</div></div></div>';
        }
        return [$privilege, $permissionActive, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function updatePrivileges(Request $request)
    {
        $id = $request->get('id');
        $privileges = ($request->get('privilege_ids') == null) ? [] : $request->get('privilege_ids');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $confirmed = $request->get('confirmed');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_PRIVILEGES_ROLE_UPDATE, $id);
        $body = [
            'privilege_ids' => $privileges,
            'confirmed' => $confirmed
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataPermission(Request $request)
    {
        $branch = Config::get('constants.type.id.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_PRIVILEGES_ROLE_GET_DATA_GROUPS, $branch);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $privilege = '';
            $permissionGroup = collect($config['data'])->where('leader_id', ENUM_DIS_SELECTED);
            $permissionAll = collect($config['data'])->where('leader_id', ENUM_SELECTED);
            foreach ($permissionGroup as $data) {
                $class = '';
                $status = 'fa-square';
                $dataList = collect($data['privileges'])->pluck('id')->toArray();
                $privilege .= '<div class="card custom-div-part flex-sub mb-0"><div class="zoneQA" data-id="' . implode(",", $dataList) . '">';
                $privilege .= ' <div class="ques group-employee-role-permision">
                                <div class="ques-title widget-title ">' . $data['name'] . ' <i class="fa fa-2x ' . $status . ' create-role-fa-square" ></i>
                                    <br>
                                    <span>' . $data['description'] . '</span>
                                </div>
                                <div class="hidden-general-info">
                                    <span class="detail-role">Chi tiết</span>
                                </div>
                            </div>';
                foreach ($data['privileges'] as $key => $db) {
                    $count = $key + 1;
                    $key_search = $this->keySearchDatatableTemplate([$data['name'] . $db['name'] . $db['name'] . $db['description'] . $db['code']]);
                    $privilege .= '<div class="ans" data-search="' . $key_search . '" data-id="' . $db['id'] . '">
                                <ul class="followers ps-container ps-theme-default ps-active-y"
                                    data-ps-id="754e5a55-a29f-3aa0-6447-2b9deb2e17f6">
                                    <li class="' . $class . '">
                                        <div
                                             class="btn-group btn-group-sm d-inline-block">
                                        </div>
                                        <div class="friend-meta d-inline-block">
                                            <h4 class="description-role">' . $count . '.' . $db['name'] . '</h4>
                                            <span">' . $db['description'] . '</span>
                                        </div>

                                    </li>
                                </ul>
                            </div>';
                }
                $privilege .= '</div></div>';
            }

            if ($permissionGroup === [] || $permissionAll === []) {
                $privilege .= '';
            } else {
                $privilege .= '';
            }
            foreach ($permissionAll as $data) {
                $privilege .= '<div class="col-lg-12 pt-3 px-0">
                                        <div class="card" style="margin-bottom: 10px !important;">
                                        <div class="group-title-permission"><div style="margin-top: -20px">' . $data['name'] . '</div></div>';
                $x = 1;
                if ($data['privileges'] == []) {
                    $privilege .= '<div class="card-block pb-0 pt-4"><div class=\'empty-datatable-custom w-100 text-center\'><img src=\'../../../../files/assets/images/nodata-datatable2.png\'></div></div>';
                } else {
                    $privilege .= '<div class="card-block pb-0 pt-4"><div class="row m-0 justify-content-center"><div class="col-lg-12 row">';
                    $y = 1;
                    foreach ($data['privileges'] as $key => $db) {
                        $class = 'work-not-active';
                        $status = '<i class="fa fa-2x fa-square" style="width: 20px !important;font-size: 20px !important;"></i>';
                        $key_search = $this->keySearchDatatableTemplate([$data['name'] . $db['name'] . $db['name'] . $db['description'] . $db['code']]);
                        $privilege .= '<div class="col-lg-12 card-block2 edit-flex-auto-fill"><div class="sortable-moves flex-sub ' . $class . '" data-search="' . $key_search . '" data-id="' . $db['id'] . '">
                                           <div class="btn-group btn-group-sm"><button type="button" class="btn btn-inverse waves-effect waves-light btn-index-work">' . $y . '</button></div>
                                           <h6>' . $db['name'] . '</h6>
                                           <p>' . $db['description'] . '</p>
                                           <span>
                                               ' . $status . '
                                           </span>
                                       </div></div>';
                        $y++;
                    }
                    $privilege .= '</div></div></div>';
                }
                $privilege .= '</div></div>';

                $privilege .= '</div></div>';
            }
            return [$privilege, $config];
        }catch (Exception $e){
            return $this->catchTemplate($config , $e);
        }
    }

    public function create(Request $request)
    {
        $name = $request->get('name');
        $role_leader_id = $request->get('role');
        $privileges = $request->get('privileges');
        $type = $request->get('type');
        $description = $request->get('description');
        $employee_privilege_group_ids = [];
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_ROLE_CREATE;
        $body = [
            'name' => $name,
            'role_leader_id' => $role_leader_id,
            'description' => $description,
            'type' => $type,
            'employee_privilege_group_ids' => $employee_privilege_group_ids,
            'node_access_token' => Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT)

        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
        if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
            $id = $config['data']['id'];
            $privileges = ($request->get('employee_privilege_group_ids') == null) ? [] : $request->get('employee_privilege_group_ids');
            $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
            $method = Config::get('constants.GATEWAY.METHOD.POST');
            $api = sprintf(API_PRIVILEGES_ROLE_UPDATE, $id);
            $body = [
                'privilege_ids' => $privileges
            ];
            return $this->callApiGatewayTemplate2($project, $method, $api, $body);
        }
        return  $config;
        }catch (Exception $e){
            return $this->catchTemplate($config , $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $role = $request->get('role_manage');
        $type = $request->get('type');
        $description = $request->get('description');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_ROLE_UPDATE, $id);
        $body = [
            'name' => $name,
            'role_leader_id' => $role,
            'description' => $description,
            'node_access_token' => Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT),
            'type' => $type,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
