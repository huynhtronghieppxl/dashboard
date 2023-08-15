<?php

namespace App\Http\Controllers\BuildData\AssignSupplierMaterial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class AssignBrandSupplierMaterialDataController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Chọn NL cho Thương hiệu';
        return view('build_data.assign_supplier_material.brand.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $is_just_take_assigned = ENUM_GET_ALL;
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api =sprintf(API_MATERIAL_GET_SUPPLIER_MAP_IN_BRAND, $brand, $is_just_take_assigned);
        $body = null;
        $config = $this->callApiGatewayTemplate($project_id, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $data_dis_selected = $collection->where('is_selected', ENUM_DIS_SELECTED)->where('supplier_names', '!=' , [])->all();
            $data_selected = $collection->where('is_selected', ENUM_SELECTED)->all();
            $data_table_dis_selected = DataTables::of($data_dis_selected)
                ->addColumn('supplier_names', function ($row) {
                    if (mb_strlen(implode(', ', $row['supplier_names'])) > 50) {
                        return '<span class="seemt-fz-16" data-toggle="tooltip" data-placement="top" data-original-title="'. implode(', ', $row['supplier_names']) .'">'. (mb_substr(implode(', ', $row['supplier_names']), 0, 50) . '...'). '</span>';
                    } else {
                        return '<span class="seemt-fz-16" >'. implode(', ', $row['supplier_names']) .' </span>';
                    }
                })
                ->addColumn('material_category_name', function ($row) {
                        return  $row['material_category_name'];
                })
                ->addColumn('action', function ($row) {

                    return '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" data-action="0" onclick="checkSystemSupplierMaterialData($(this))" data-id="' . $row['restaurant_material_id'] . '" data-unit="' . $row['restaurant_material_unit_full_name'] . '" data-category="' . $row['material_category_name'] . '" data-material="' . $row['restaurant_material_name'] . '" data-supplier="' . implode(', ', $row['supplier_names']) . '"><i class="fi-rr-arrow-small-right"></i></button>
                                            </div>';
                })
                ->rawColumns(['action', 'supplier_names'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['restaurant_material_name'],$row['supplier_names']]);
                })
                ->make(true);
            $data_table_selected = DataTables::of($data_selected)
                ->addColumn('action', function ($row) {
                    return ' <div class="btn-group btn-group-sm">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" data-action="1" onclick="unCheckSystemSupplierMaterialData($(this))" data-id="' . $row['restaurant_material_id'] . '" data-unit="' . $row['restaurant_material_unit_full_name'] . '" data-category="' . $row['material_category_name'] . '" data-material="' . $row['restaurant_material_name'] . '" data-supplier="' . implode(', ', $row['supplier_names']) . '"><i class="fi-rr-arrow-small-left"></i></button>
                                        </div>';
                })
                ->addColumn('supplier_names', function ($row) {
                    if (mb_strlen(implode(', ', $row['supplier_names'])) > 50) {
                        return '<span class="seemt-fz-16" data-toggle="tooltip" data-placement="top" data-original-title="'. implode(', ', $row['supplier_names']) .'">'. (mb_substr(implode(', ', $row['supplier_names']), 0, 50) . '...'). '</span>';
                    } else {
                        return '<span class="seemt-fz-16" >'. implode(', ', $row['supplier_names']) .' </span>';
                    }
                })
                ->rawColumns(['action', 'material_category_name','supplier_names'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['material_category_name'],$row['supplier_names'], $row['restaurant_material_name'], $row['restaurant_material_unit_full_name'], $row['material_category_name']]);
                })
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
        $api = API_MATERIAL_POST_MAP_DATA_ASSIGN_TO_BRAND;
        $body = [
            "restaurant_brand_id" => $request->get('restaurant_brand_id'),
            "material_insert_ids" => $request->get('material_insert'),
            "material_delete_ids" => $request->get('material_delete'),
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function unAssign(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api =API_MATERIAL_POST_MAP_DATA_UN_ASSIGN_TO_BRAND;
        $body = [
            "restaurant_brand_id" => $request->get('restaurant_brand_id'),
            "restaurant_material_id" => $request->get('restaurant_material_id'),
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try{
        if($config['status'] == ENUM_HTTP_STATUS_CODE_UPDATE){
            $data_table = DataTables::of($config['data'])
                ->addColumn('action', function ($row) {
                    if($row['is_supplier_order'] == ENUM_SELECTED){
                        return '<div class="btn-group btn-group-sm text-center">
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder('.$row['id'] .')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
                    }else{
                        return '<div class="btn-group btn-group-sm text-center">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRestaurantSupplierOrder('.$row['id'] .')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
                    }
                })
                ->addColumn('code', function ($row) {
                    return $row['code'];
                })
                ->addColumn('name', function ($row) {
                    return $row['supplier_name'];
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['supplier_name'],$row['code']]);
                })
                ->rawColumns(['code', 'action', 'name'])
                ->addIndexColumn()
                ->make(true);
            $config['data'] =  $data_table;
            return $config;
        }else{
            return $config;
        }}
        catch (Exception $e){
            return $this->catchTemplate($config, $e);
        }
    }
}
