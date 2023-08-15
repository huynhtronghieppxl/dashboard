<?php

namespace App\Http\Controllers\BuildData\AssignSupplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class AssignBrandSupplierDataController extends Controller
{
    public function index()
    {
        $active_nav = 'Gán nhà cung cấp về thương hiệu';
        return view('build_data.assign_supplier.brand.index', compact('active_nav'));
    }

    public function data(Request $request){
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $is_restaurant_supplier = $request->get('is_restaurant_supplier');
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api =sprintf(API_SUPPLIER_GET_ASSIGNED_TO_RESTAURANT_BRAND, $restaurant_brand_id, $is_restaurant_supplier, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $data_enable = $collection->where('status' ,ENUM_SELECTED);
            $data_selected = $data_enable->where('is_take_my_supplier', ENUM_SELECTED)->all();
            $data_unselected = $data_enable->where('is_take_my_supplier', ENUM_DIS_SELECTED)->all();
            $data_table_selected = DataTables::of($data_selected)
                ->addColumn('name', function ($row) {
                    $type_supplier = ($row['is_restaurant_supplier']  == 0 ) ? '<label class="label label-success">'. TEXT_SYSTEM_SUPPLIER .'</label>' : '';
                    return '<label> ' . $row['name'] . '</label><br>'. $type_supplier .'<input class="d-none" value="' . $row['id'] . '"/>';
                })
                ->addColumn('supplier-type', function ($row) {
                    if ($row['is_restaurant_supplier'] == ENUM_SELECTED) {
                        return TEXT_RESTAURANT_SUPPLIER;
                    } else {
                        return TEXT_SYSTEM_SUPPLIER;
                    }
                })
                ->addColumn('address', function ($row) {
                    return ($row['address'] === null) ? '' : $row['address'];
                })
                ->addColumn('action', function ($row) {
                    return '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer" onclick="unCheckBrandSupplierData($(this))" data-id="' . $row['id'] . '" data-type="1"></i>';
                })
                ->addColumn('keysearch', function ($row) {
                    $type_supplier = ($row['is_restaurant_supplier']  == 0 ) ? '<label class="label label-success">'. TEXT_SYSTEM_SUPPLIER .'</label>' : '';
                    $keysearch = [$row['name'], $type_supplier, $row['phone']];
                    return $this->keySearchDatatableTemplate($keysearch);
                })
                ->rawColumns(['action','name'])
                ->make(true);

            $data_table_unselected = DataTables::of($data_unselected)
                ->addColumn('name', function ($row) {
                    $type_supplier = ($row['is_restaurant_supplier']  == 0 ) ?  '<label class="label label-success">'. TEXT_SYSTEM_SUPPLIER .'</label>' : '';
                    return '<label> ' . $row['name'] . '</label><br>'. $type_supplier .'<input class="d-none" value="' . $row['id'] . '"/>';
                })
                ->addColumn('supplier-type', function ($row) {
                    if ($row['is_restaurant_supplier'] == ENUM_SELECTED) {
                        return TEXT_RESTAURANT_SUPPLIER;
                    } else {
                        return TEXT_SYSTEM_SUPPLIER;
                    }
                })
                ->addColumn('address', function ($row) {
                    return ($row['address'] === null) ? '' : $row['address'];
                })
                ->addColumn('action', function ($row) {
                    return '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" onclick="checkBrandSupplierData($(this))" data-id="' . $row['id'] . '" data-type="0"></i>';
                })
                ->addColumn('keysearch', function ($row) {
                    $type_supplier = ($row['is_restaurant_supplier']  == 0 ) ?  '<label class="label label-success">'. TEXT_SYSTEM_SUPPLIER .'</label>' : '';
                    $keysearch = [$row['name'], $type_supplier, $row['phone']];
                    return $this->keySearchDatatableTemplate($keysearch);
                })
                ->rawColumns(['action','name'])
                ->make(true);
            return [$data_table_selected, $data_table_unselected,$config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request){
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_SUPPLIER_POST_ASSIGN_TO_RESTAURANT_BRAND;
        $body = [
            "supplier_ids" => $request->get('supplier_ids'),
            "restaurant_brand_id" => $request->get('restaurant_brand_id'),
            "is_restaurant_supplier" => ENUM_SELECTED,
            "remove_supplier_ids" => $request->get('remove_supplier_ids')
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function unAssign(Request $request)
    {
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $supplier_id = $request->get('supplier_id');
        $is_restaurant_supplier = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_SUPPLIER_POST_UN_ASSIGN_TO_RESTAURANT_BRAND;
        $body = [
            "supplier_id" => $supplier_id,
            "restaurant_brand_id" => $restaurant_brand_id,
            "is_restaurant_supplier" => $is_restaurant_supplier,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] == ENUM_HTTP_STATUS_CODE_UPDATE) {
                $data_table = DataTables::of($config['data'])
                    ->addColumn('action', function ($row) {
                        if ($row['is_supplier_order'] == 1) {
                            return '<div class="btn-group btn-group-sm text-center">
                                        <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><span class="icofont icofont-eye-alt"></span></button>
                                    </div>';
                        } else {
                            return '<div class="btn-group btn-group-sm text-center">
                                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openDetailRestaurantSupplierOrder(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><span class="icofont icofont-eye-alt"></span></button>
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
        } catch (Exception $e){
            return $this->catchTemplate($config, $e);
        }
    }
}
