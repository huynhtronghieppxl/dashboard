<?php

namespace App\Http\Controllers\BuildData\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Collection;

class PointDataController extends Controller
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
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Thang điểm thưởng';
        return view('build_data.personnel.point.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $role = $request->get('role');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SALARY_TARGETS_GET_DATA , $role);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $permission_list = collect($config['data']);
            $permission_point = $permission_list->where('is_actived', 1);
            $table = DataTables::of($permission_point)
                ->addColumn('point', function ($row) {
                    return $this->numberFormat($row['point']);
                })
                ->addColumn('salary', function ($row) {
                    return $this->numberFormat($row['bonus_salary']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removePointData($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_REMOVE . '"><i class="fi-rr-trash"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdatePointData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id="' . $row['id'] . '" data-point="' . $this->numberFormat($row['point']) . '" data-salary="' . $this->numberFormat($row['bonus_salary']) . '"><i class="fi-rr-pencil"></i></button>
                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
            return [$table, $config,$permission_point];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function role(){
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_ROLE_GET_DATA_EMPLOYEE_ROLE,ENUM_GET_ALL , ENUM_GET_ALL  , ENUM_ROLE_TYPE_BUSINESS);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_role = '';
            $data = $config['data'];
            for ($i = 0; $i < count($data); $i++) {
                $data_role .= '<option value="' . $data[$i]['id'] . '" data-role-owner="' . $data[$i]['role_leader_id'] . '">' . $data[$i]['name'] . ' </option>';
            }
            return [$data_role, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $id = ENUM_ID_NONE;
        $role = $request->get('role');
        $point = $request->get('point');
        $salary = $request->get('salary');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api =sprintf(API_SALARY_TARGETS_POST_MANAGE_POINT, $id, $point, $salary);
        $body = [
            'id' => $id,
            'point' => $point,
            'bonus_salary' => $salary,
            'employee_role_id' => $role,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        return $config;
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $role = $request->get('role');
        $point = $request->get('point');
        $salary = $request->get('salary');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SALARY_TARGETS_POST_MANAGE_POINT, $id, $point, $salary);
        $body = [
            'id' => $id,
            'point' => $point,
            'bonus_salary' => $salary,
            'employee_role_id'  => $role
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function remove(Request $request)
    {
        $id= $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api =sprintf(API_REMOVE_POINT_POST_DATA, $id);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}

