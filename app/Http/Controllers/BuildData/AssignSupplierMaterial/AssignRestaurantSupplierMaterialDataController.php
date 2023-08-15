<?php

namespace App\Http\Controllers\BuildData\AssignSupplierMaterial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class AssignRestaurantSupplierMaterialDataController extends Controller
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
        $active_nav = 'Gán NL NCC với NL Công ty';
        return view('build_data.assign_supplier_material.restaurant.index', compact('active_nav'));
    }

    public function supplier(Request $request)
    {
        $is_take_my_supplier = ENUM_SELECTED;
        $is_restaurant_supplier = ENUM_GET_ALL;
        $is_exclude_unassign_system_supplier = ENUM_GET_ALL;
        $status = ENUM_SELECTED;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_GET_ALL_SUPPLIER, $is_take_my_supplier, $is_restaurant_supplier, $is_exclude_unassign_system_supplier, $page, $limit, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project_id, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $option = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            if (!empty($data)) {
                $option = '';
                foreach ($data as $db) {
                    $option .= '<option value="' . $db['id'] . '" >' . $db['name'] . '</option>';
                }
            }
            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function data(Request $request)
    {
        $supplier_id = $request->get('supplier_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_GET_SUPPLIER_MAP_IN_RESTAURANT, $supplier_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = collect($config['data']);
            $data_dis_selected = $data->where('restaurant_material_id', ENUM_DIS_SELECTED)->where('supplier_material_status', ENUM_SELECTED)->all();
            $data_selected = $data->where('restaurant_material_id', '!==', ENUM_DIS_SELECTED)->where('supplier_material_status', ENUM_SELECTED)->all();
            $material_selected = $data->where('restaurant_material_id', '!==', ENUM_DIS_SELECTED)->toArray();
            $data_table_dis_selected = DataTables::of($data_dis_selected)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="checkRestaurantSupplierMaterialData($(this))" data-id="' . $row['supplier_material_id'] . '" data-unit-full="' . $row['supplier_material_unit_full_name'] . '" data-unit="' . $row['supplier_material_unit_specification_exchange_name'] . '" data-type="0" data-restaurant-id="" data-rate=""><i class="fi-rr-arrow-small-right"></i></button>
                                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    $keysearch = [$row['supplier_material_name'], $row['supplier_material_unit_full_name'],];
                    return $this->keySearchDatatableTemplate($keysearch);
                })
                ->rawColumns(['supplier_material_name', 'action'])
                ->make(true);

            $data_table_selected = DataTables::of($data_selected)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="unCheckRestaurantSupplierMaterialData($(this))" data-id="' . $row['supplier_material_id'] . '" data-unit-full="' . $row['supplier_material_unit_full_name'] . '" data-unit="' . $row['supplier_material_unit_specification_exchange_name'] . '" data-type="1" data-restaurant-id="' . $row['restaurant_material_id'] . '" data-rate="' . $row['material_unit_conversion_rate'] . '"><i class="fi-rr-arrow-small-left"></i></button>
                                            </div>';
                })
                ->addColumn('rate', function () {
                    return '<label>'. ENUM_SELECTED .'</label>';
                })
                ->addColumn('supplier_material_unit_full_name', function ($row) {
//                    return ($row['material_category_type_parent_id'] == ENUM_MATERIAL_CATEGORY_PARENT_GOODS) ? $row['supplier_material_unit_full_name'] : $row['supplier_material_unit_specification_exchange_name'];
                    return  $row['supplier_material_unit_full_name']  ;
                })
                ->addColumn('restaurant_material_unit_full_name', function ($row) {
//                    return ($row['material_category_type_parent_id'] == ENUM_MATERIAL_CATEGORY_PARENT_GOODS) ? $row['restaurant_material_unit_full_name'] : $row['restaurant_material_unit_specification_exchange_name'];
                    return   $row['restaurant_material_unit_full_name'] ;

                })
                ->addColumn('material_select', function ($row) {
//                    $unit = ($row['material_category_type_parent_id'] !== ENUM_MATERIAL_CATEGORY_PARENT_GOODS) ? $row['restaurant_material_unit_full_name'] : $row['restaurant_material_unit_specification_exchange_name'];
                    $unit =  $row['restaurant_material_unit_full_name'];
                    return '<select class="select-data-restaurant-material-map-to-supplier js-example-basic-single mx-2" data-select="1">
                                <option class="check" value="' . $row['restaurant_material_id'] . '" data-unit="' . $unit . '" selected>' . $row['restaurant_material_name'] . '</option>
                            </select>';
                })
                ->rawColumns(['action', 'supplier_material_name', 'rate', 'material_select'])
                ->addColumn('keysearch', function ($row) {
                    $keysearch = [];
                    if ($row['material_category_type_parent_id'] !== ENUM_MATERIAL_CATEGORY_PARENT_GOODS){
                        $keysearch = [$row['supplier_material_name'], $row['supplier_material_unit_full_name'], $row['restaurant_material_unit_full_name']];
                    }
                    else{
                        $keysearch = [$row['supplier_material_name'], $row['supplier_material_unit_specification_exchange_name'], $row['restaurant_material_unit_specification_exchange_name']];
                    }
                    return $this->keySearchDatatableTemplate($keysearch);
                })
                ->make(true);
            return [$data_table_dis_selected, $data_table_selected, $material_selected, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function materialRestaurant(Request $request)
    {
        $status = ENUM_SELECTED;
//        $supplier_id = ENUM_GET_ALL;
        $supplier_id=$request->get('supplier_id');
        $category = ENUM_GET_ALL;
        $type_parent_id = '';
        $type_id = '';
        $is_assign_to_supplier = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_GET_LIST_RESTAURANT_2, $supplier_id, $status );
        $body = null;
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_SUPPLIER_POST_MAP_MATERIAL_RESTAURANT_MANAGE;
        $body = [
            "supplier_id" => $request->get('supplier_id'),
            "material_insert_json" => $request->get('materials_insert'),
            "material_update_json" => $request->get('materials_update'),
            "material_delete_json" => $request->get('materials_delete')
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] == ENUM_HTTP_STATUS_CODE_UPDATE) {
                $data_table = DataTables::of($config['data'])
                    ->addColumn('action', function ($row) {
                        if ($row['is_supplier_order'] == ENUM_SELECTED) {
                            return '<div class="btn-group btn-group-sm text-center">
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
                        } else {
                            return '<div class="btn-group btn-group-sm text-center">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRestaurantSupplierOrder(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
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
                        return $this->keySearchDatatableTemplate([$row['supplier_name'], $row['code']]);
                    })
                    ->rawColumns(['code', 'action', 'name'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data'] = $data_table;
                return $config;
            } else {
                return $config;
            }
        }
        catch (Exception $e){
            return $this->catchTemplate($config, $e);
        }
    }

    public function unAssign(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SUPPLIER_POST_MAP_MATERIAL_UN_ASSIGN_RESTAURANT_MANAGE);
        $body = [
            "supplier_id" => $request->get('supplier_id'),
            "restaurant_material_json" => [
                "supplier_material_id" => $request->get('supplier_material_id'),
                "restaurant_material_id" => $request->get('restaurant_material_id'),
                "material_unit_conversion_rate" => $request->get('material_unit_conversion_rate')
            ]
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] == ENUM_HTTP_STATUS_CODE_UPDATE) {
                $data_table = DataTables::of($config['data'])
                    ->addColumn('action', function ($row) {
                        if ($row['is_supplier_order'] == ENUM_SELECTED) {
                            return '<div class="btn-group btn-group-sm text-center">
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
                        } else {
                            return '<div class="btn-group btn-group-sm text-center">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRestaurantSupplierOrder(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
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
                        return $this->keySearchDatatableTemplate([$row['supplier_name'], $row['code']]);
                    })
                    ->rawColumns(['code', 'action', 'name'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data'] = $data_table;
                return $config;
            } else {
                return $config;
            }
        }
        catch (Exception $e){
            return $this->catchTemplate($config, $e);
        }
    }
}
