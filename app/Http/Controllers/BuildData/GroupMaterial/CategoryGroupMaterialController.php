<?php

namespace App\Http\Controllers\BuildData\GroupMaterial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class CategoryGroupMaterialController extends Controller
{
    public function index()
    {
        $active_nav = 'build_data.category-group-material';
        return view('build_data.group_material.category_group_material.index', compact('active_nav'));
    }

    public function data(Request $request)
    {

        $brach_id = $request->get('branch_id');
        $employee_created_id = Session::get(SESSION_JAVA_ACCOUNT)['id'];
        $is_account_created = Config::get('constants.type.checkbox.SELECTED');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_CATEGORY_GROUP_MATERIAL_GET_DATA, $brach_id , $employee_created_id , $is_account_created);
        $body = [];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data_table = $this->drawTableGroupMaterial($config['data']);
            return [$data_table, $config['config']];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function create(Request $request)
    {
        $note = $request->get('note');
        $brach_id = $request->get('branch_id');
        $is_account_created = Config::get('constants.type.checkbox.SELECTED');
        $name = $request->get('name');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_CATEGORY_GROUP_MATERIAL_POST_CREATE;
        $body = [
            "branch_id" => $brach_id,
            "restaurant_material_ids" =>  [],
            'description' => $note,
            'is_account_created' => $is_account_created,
            "name" => $name,
            "sort" => 0,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function dataUpdate(Request $request){
        $branch = $request->get('branch');
        $id = $request->get('id');
        $is_account_created = Config::get('constants.type.checkbox.SELECTED');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_CATEGORY_GROUP_MATERIAL_GET_DATA_UPDATE, $id , $is_account_created , $branch);
        $body = [];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        return [$config['data'], $config['config']];
    }

    public function update(Request $request){
        $materials = $request->get('materials');
        $id = $request->get('id');
        $note = $request->get('note');
        $name = $request->get('name');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api =sprintf(API_CATEGORY_GROUP_MATERIAL_POST_UPDATE, $id);
        $body = [
            'materials' => $materials,
            'description' => $note,
            "name" => $name,
            "sort" => 0,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function delect(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_CATEGORY_GROUP_MATERIAL_POST_DELETE, $id);
        $body = null;
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function drawTableGroupMaterial($data)
    {
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $update = TEXT_UPDATE;
                $disable = TEXT_DISABLE_STATUS;
                return '<div class="btn-group btn-group-sm text-center">
                            <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" title="' . $update . '" onclick="openModalUpdateCategoryMaterial($(this))" data-name="'. $row['name'] .'" data-description="'. $row['description'] .'" data-branch="'. $row['branch_id'] .'" data-id="'. $row['id'] .'">
                                <span class="icofont icofont-ui-edit"></span>
                            </button>
                            <button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light" title="' . $disable . '" onclick="delectCategoryMaterial('. $row['id'] . ', '. $row['branch_id'] . ')">
                                <span class="icofont icofont-ui-close"></span>
                            </button>
                        </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
