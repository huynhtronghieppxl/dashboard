<?php

namespace App\Http\Controllers\BuildData\Food;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\Datatables\Datatables;

class UnitFoodDataController extends Controller
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
        $active_nav = 'Đơn vị';
        return view('build_data.food.unit.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = API_FOOD_UNIT_GET;
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $remove = TEXT_REMOVE;
            $update = TEXT_UPDATE;
            $data_table = DataTables::of($data)
                ->addColumn('action', function ($row) use ($remove, $update) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button seemt-red btn seemt-btn-hover-red waves-effect waves-light" onclick="removeUnitFoodData($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $remove . '">  <i class="fi-rr-trash"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light " data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" onclick="openModalUpdateUnitFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            return [$data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $name = $request->get('name');
        $id = Config::get('constants.type.id.GET_ALL');
        $delete = Config::get('constants.type.checkbox.DIS_SELECTED');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_FOOD_UNIT_POST_CRUD, $id);
        $body = [
            "name" => $name,
            "is_delete" => $delete,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        if($config['status'] === 200){
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
        }
        return $config;
    }

    public function update(Request $request)
    {
        $name = $request->get('name');
        $id = $request->get('id');
        $delete = Config::get('constants.type.checkbox.DIS_SELECTED');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_FOOD_UNIT_POST_CRUD, $id);
        $body = [
            "id" => $id,
            "name" => $name,
            "is_delete" => $delete,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        return $config;
    }

    public function remove(Request $request)
    {
        $id = $request->get('id');
        $name = Config::get('constants.type.data.NONE');
        $delete = Config::get('constants.type.checkbox.SELECTED');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_FOOD_UNIT_POST_CRUD, $id);
        $body = [
            "id" => $id,
            "name" => $name,
            "is_delete" => $delete,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
}
