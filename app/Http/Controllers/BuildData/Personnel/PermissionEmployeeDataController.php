<?php

namespace App\Http\Controllers\BuildData\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Yajra\Datatables\Datatables;
use Exception;

class PermissionEmployeeDataController extends Controller
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
        $active_nav = 'Quyền nhân viên';
        return view('build_data.personnel.permission_employee.index', compact('active_nav'));
    }

    public function employee(Request $request)
    {
        $branch_id = $request->get('branch');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_EMPLOYEE_GET_DATA_NOT_OWNER, $branch_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data_table = Datatables::of($data)
                ->addColumn('name', function ($row) {
                    return $row['name'] . '<input class="d-none" value="' . $row['id'] . '"/>';
                })
                ->rawColumns(['name'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->make(true);
            return [$data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function permission(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $api = sprintf(API_PRIVILEGES_EMPLOYEE_GET_DATA, $id, $branch);
        $body = null;
        $requestRolePrivilege = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_PRIVILEGES_ROLE_GET_DATA_GROUPS, $branch);
        $body = null;
        $requestPrivilege = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestRolePrivilege, $requestPrivilege]);
        try{
        $permissionActive = collect($configAll[0]['data']['privileges'])->pluck('id')->toArray();
        $permissionGroup = collect($configAll[1]['data'])->where('leader_id', 0);
        $permissionAll = collect($configAll[1]['data'])->where('leader_id', 1);
        $privilege = '';
        foreach ($permissionGroup as $data) {
            $dataList = collect($data['privileges'])->pluck('id')->toArray();
            $status = 'fa-square';
            $class = '';
            if (count(array_intersect($dataList, $permissionActive)) === count($dataList)) {
                $status = 'fa-check-square';
                $class = 'active-employee-role-data';
            }
            $privilege .='<div class="card custom-div-part flex-sub"><div class="zoneQA" data-id="' . implode(",", $dataList) . '">';
            $privilege .='<div class="ques group-employee-permission">
                                <div class="ques-title widget-title">'. $data['name'] . ' <i class="fa fa-2x ' . $status . ' employee-fa-square"></i>
                                    <br>
                                    <span>'.$data['description'].'</span>
                                </div>
                                <div class="hidden-general-info">
                                    <span class="detail-role">Chi tiết</span>
                                </div>
                            </div>';
            foreach ($data['privileges'] as $key => $db) {
                $count= $key + 1;
                $key_search = $this->keySearchDatatableTemplate([$data['name'] . $db['name'] . $db['name'] . $db['description'] . $db['code']]);
                $privilege .='
                                <div class="ans">
                                <ul class="followers ps-container ps-theme-default ps-active-y"
                                    data-ps-id="754e5a55-a29f-3aa0-6447-2b9deb2e17f6">
                                    <li class="'.$class.'">
                                        <div class="btn-group btn-group-sm d-inline-block">
                                        </div>
                                        <div class="friend-meta d-inline-block">
                                            <h4 class="description-role">'.$count.'.' . $db['name'] . '</h4>
                                            <span>' . $db['description'] . '</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>';
            }
            $privilege .= '</div></div>';
        }

        foreach ($permissionAll as $data) {
            $privilege .= '<div class="col-lg-12 pt-3 group-permision px-0">
                                <div class="card">
                                    <div class="group-title-permission">
                                        <div>' . $data['name'] . '</div>
                                    </div>
                                    <div class="card-block pb-0 pt-4">';
            foreach ($data['privileges'] as $key => $db) {
                $class = 'work-not-active';
                $status = '<i class="fa fa-2x fa-square"></i>';
                if (in_array($db['id'], $permissionActive)) {
                    $class = 'work-active';
                    $status = '<i class="fa fa-2x fa-check-square"></i>';
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
        }catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $privileges = $request->get('privileges');
        $confirmed = $request->get('confirmed');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_PRIVILEGES_EMPLOYEE_UPDATE, $id);
        $body = [
            'privileges' => $privileges,
            'employee_privilege_group_ids' => [],
            'confirmed' => $confirmed
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
