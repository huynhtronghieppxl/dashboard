<?php

namespace App\Http\Controllers\BuildData\GroupMaterial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class MapGroupMaterialController extends Controller
{
    //
    function index(){
        $active_nav = 'build_data.map-group-material';
        return view('build_data.group_material.map_group_material.index' ,  compact('active_nav'));
    }

    function dataCategory(Request $request)
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
            $option = '';
            if(count($config['data']) == Config::get('constants.type.checkbox.SELECTED')){
                $option = '<option value="-1" selected>' . TEXT_NULL_OPTION . '</option>';
            }
            foreach ($config['data'] as $data){
                if($data['id'] != Config::get('constants.type.checkbox.DIS_SELECTED'))
                    $option .= '<option value="'. $data['id'] .'">'.  $data['name']  . '</option>';
            }
            return [$option , $config['config']];
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    function materialCategory(Request $request)
    {
        $brach_id = $request->get('branch_id');
        $id = $request->get('id');
        $is_account_created = Config::get('constants.type.checkbox.SELECTED');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_CATEGORY_GROUP_MATERIAL_GET_DATA_UPDATE, $id , $is_account_created , $brach_id);
        $body = [];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if( $config['data'] == null) {
                $config['data']['materials'] = [];
            }
            $data = $config['data']['materials'];
            $data_table_select = Datatables::of($data)
                ->addColumn('action', function ($row) {
                    return '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer" data-action="0" onclick="removeCheckmaterialGroupData($(this))" data-id="' . $row['id'] . '" data-unit="' . $row['material_unit_full_name'] . '"></i>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
            return [$data_table_select, $config['config']];
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function material(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $is_account_created = Config::get('constants.type.checkbox.SELECTED');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GROUP_MATERIAL_GET_LIST_MAP, $is_account_created , $branch_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try{
        $data = $config['data'];
        $data_table_not_select = $this->tablematerial($data);
        return [$data_table_not_select ,$config['config']];
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function tablematerial($data)
    {
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                return '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" data-action="0" onclick="checkmaterialGroupData($(this))" data-id="' . $row['id'] . '" data-unit="' . $row['material_unit_full_name'] . '"></i>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function mapMaterial(Request $request)
    {
        $id = $request->get('id');
        $material = $request->get('material');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_CATEGORY_GROUP_MATERIAL_POST_MAP_GROUP_MATERIAL, $id);
        $body = [
            'restaurant_material_ids' => $material
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
}
