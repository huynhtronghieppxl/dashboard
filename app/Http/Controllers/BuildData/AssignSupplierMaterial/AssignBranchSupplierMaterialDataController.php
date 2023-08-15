<?php

namespace App\Http\Controllers\BuildData\AssignSupplierMaterial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class AssignBranchSupplierMaterialDataController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Gán nguyên liệu NCC về chi nhánh';
        return view('build_data.assign_supplier_material.branch.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $is_just_take_assigned = ENUM_GET_ALL;
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_GET_SUPPLIER_MAP_IN_BRANCH, $branch, $is_just_take_assigned);
        $body = null;
        $config = $this->callApiGatewayTemplate($project_id, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $data_selected = $collection->where('is_selected', ENUM_SELECTED)->all();
            $data_dis_selected = $collection->where('is_selected', ENUM_DIS_SELECTED)->all();
            $data_table_dis_selected = DataTables::of($data_dis_selected)
                ->addColumn('supplier_names', function ($row) {
                    return implode(', ', $row['supplier_names']);
                })
                ->addColumn('material_name', function ($row) {
                    return '<label>'. $row['restaurant_material_name'] .'</label><label class="label label-info">'. $row['restaurant_material_unit_full_name'] .'</label>';
                })
                ->addColumn('action', function ($row) {
                    return '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" data-action="0" onclick="checkSystemSupplierMaterialData($(this))" data-id="' . $row['restaurant_material_id'] . '" data-unit="' . $row['restaurant_material_unit_full_name'] . '" data-category="' . $row['material_category_name'] . '"></i>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action',])
                ->make(true);

            $data_table_selected = DataTables::of($data_selected)
                ->addColumn('action', function ($row) {
                    return '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer" data-action="1" onclick="unCheckSystemSupplierMaterialData($(this))" data-id="' . $row['restaurant_material_id'] . '" data-supplier="' . implode(', ', $row['supplier_names']) . '"></i>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->make(true);

            return [$data_table_dis_selected, $data_table_selected, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_MATERIAL_POST_MAP_DATA_ASSIGN_TO_BRANCH;
        $body = [
            "restaurant_brand_id" => $request->get('restaurant_brand_id'),
            "branch_id" => $request->get('branch_id'),
            "material_insert_ids" => $request->get('material_insert'),
            "material_delete_ids" => $request->get('material_delete'),
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
}
