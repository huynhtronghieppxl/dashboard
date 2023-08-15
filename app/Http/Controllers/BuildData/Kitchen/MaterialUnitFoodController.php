<?php

namespace App\Http\Controllers\BuildData\Kitchen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class MaterialUnitFoodController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Đơn vị định lượng';
        return view('build_data.kitchen.material_unit_food.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $material_unit_id = ENUM_GET_ALL;
        $material_unit_specification_exchange_name_id = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_KITCHEN_DATA_GET_MATERIAL_UNIT_FOOD_DATA, $restaurant_brand_id, $material_unit_id, $material_unit_specification_exchange_name_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data_table = DataTables::of(collect($config['data']))
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm float-right">
                <button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light" onclick="changeStatusMaterialUnitFoodData($(this))" data-id="' . $row['id'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><span class="icofont icofont-ui-close"></span></button></div>';
                })
                ->addColumn('value_exchange', function ($row) {
                    return $this->numberFormat($row['exchange_value']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['unit_exchange', 'action'])
                ->addIndexColumn()
                ->make(true);
            return [$data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }


    public function unit(Request $request)
    {
        $status = ENUM_SELECTED;
        $api = sprintf(API_MATERIAL_UNIT_GET_DATA, $status);
        $body = null;
        $requestUnit = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $api = API_MATERIAL_SPECIFICATIONS_GET_DATA_SERVER;
        $body = null;
        $requestUnitExchange = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestUnit, $requestUnitExchange]);
        try {
            $data = $configAll[0]['data'];
            $data_unit = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $data_unit .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
            }
            if ($data_unit === '') {
                $data_unit = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }

            $data_exchange = $configAll[1]['data'];
            $data_unit_exchange = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data_exchange); $i++) {
                $data_unit_exchange .= '<option value="' . $data_exchange[$i]['id'] . '">' . $data_exchange[$i]['name'] . '</option>';
            }
            if ($data_unit_exchange === '') {
                $data_unit_exchange = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$data_unit, $data_unit_exchange, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_MATERIAL_POST_MATERIAL_UNIT_FOOD;
        $body = [
            'restaurant_material_id' => $request->get('id_material'),
            'restaurant_brand_id' => $request->get('brand'),
            'material_unit_id' => $request->get('unit'),
            'material_unit_specification_exchange_name_id' => $request->get('unit_exchange'),
            'exchange_value' => $request->get('value_exchange'),
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function changeStatus(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $id = $request->get('id');
        $api = sprintf(API_MATERIAL_CHANGE_STATUS_MATERIAL_UNIT_FOOD, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_UPDATE) {
                $data_table = DataTables::of(collect($config['data']))
                    ->addColumn('name', function ($row) {
                        return $row['name'];
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['name', 'action'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data'] = $data_table;
                return $config;
            } else {
                return $config;
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}

