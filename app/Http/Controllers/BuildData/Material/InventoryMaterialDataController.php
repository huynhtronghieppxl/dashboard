<?php

namespace App\Http\Controllers\BuildData\Material;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class InventoryMaterialDataController extends Controller
{
    public function index()
    {
        $active_nav = 'Chọn nguyên liệu kiểm kê';
        return view('build_data.material.inventory_material.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MATERIAL_CHECK_LIST_GOOD_GET_MATERIAL_BRAND_MATERIAL_ONLY_FOR_CHECK, $brand, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $detail = TEXT_DETAIL;
            $dataTable = DataTables::of($config['data']['list'])
                ->addColumn('inventory', function ($row) {
                    switch ($row['material_category_type_parent_id']) {
                        case 1:
                            return 'Kho nguyên liệu';
                        case 2:
                            return 'Kho hàng hoá';
                        case 3:
                            return 'Kho nội bộ';
                        case 12:
                            return 'Kho khác';
                    }
                })
                ->addColumn('branch', function ($row) {
                    $check = ($row['is_allow_inventory_check'] === 1) ? 'checked' : '';
                    return '<div class="checkbox-fade fade-in-primary m-auto">
                                <label>
                                    <input type="checkbox" ' . $check . ' class="item-branch-inventory-material-data"/>
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                </label>
                            </div>';
                })
                ->addColumn('internal_period', function ($row) {
                    $check = ($row['is_allow_check'] === 1) ? 'checked' : '';
                    return '<div class="checkbox-fade fade-in-primary m-auto">
                                <label>
                                    <input type="checkbox" ' . $check . ' class="item-internal-period-inventory-material-data"/>
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                </label>
                            </div>';
                })
                ->addColumn('internal_day', function ($row) {
                    $check = ($row['is_allow_daily_check'] === 1) ? 'checked' : '';
                    return '<div class="checkbox-fade fade-in-primary m-auto">
                                <label>
                                    <input type="checkbox" ' . $check . ' class="item-internal-day-inventory-material-data"/>
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                </label>
                            </div>';
                })
                ->addColumn('action', function ($row) use ($detail) {
                    return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light"  data-id="' . $row['restaurant_material_id'] . '" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><span class="icofont icofont-eye-alt"></span></button>
                            </div>';
                })
                ->addColumn('name', function ($row) {
                    return $row['name']. '<br><label class="number-order"><i class="fa fa-cutlery"></i> '. $row['code'] .'</label>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['branch', 'internal_period', 'internal_day', 'action', 'name'])
                ->make(true);
            $dataTotal = [
                'total' => count($config['data']['list']),
                'total_branch' => collect($config['data']['list'])->where('is_allow_inventory_check', Config::get('constants.type.checkbox.SELECTED'))->count(),
                'total_internal_period' => collect($config['data']['list'])->where('is_allow_check', Config::get('constants.type.checkbox.SELECTED'))->count(),
                'total_internal_day' => collect($config['data']['list'])->where('is_allow_daily_check', Config::get('constants.type.checkbox.SELECTED'))->count(),
            ];
            return [$dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_MATERIAL_CHECK_LIST_GOOD_POST_ONLY_FOR_CHECK;
        $body = [
            "restaurant_brand_id" => $request->get('brand'),
            "restaurant_materials" => $request->get('material'),
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
}
