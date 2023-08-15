<?php

namespace App\Http\Controllers\BuildData\Kitchen;

use Akaunting\Money\Money;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class QuantitativeDataController extends Controller
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
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Định lượng món';
        return view('build_data.kitchen.quantitative.index', compact('active_nav'));
    }

    public function food(Request $request)
    {
        $branch_id = Config::get('constants.type.checkbox.GET_ALL');;
        $restaurant_brands_id = $request->get('restaurant_brand_id');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $category_type = Config::get('constants.type.id.GET_ALL');
        $category_id = Config::get('constants.type.id.GET_ALL');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_count_material = Config::get('constants.type.checkbox.SELECTED');
        $is_addition = Config::get('constants.type.checkbox.GET_ALL');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $is_bestseller = Config::get('constants.type.checkbox.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.DIS_SELECTED');
        $is_kitchen = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.status.GET_ALL');
        $is_get_food_contain_addition = Config::get('constants.type.checkbox.GET_ALL');
        $key = '';
        $alert_original_food_id = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category_type, $category_id, $restaurant_brands_id, $branch_id, $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key, $is_get_food_contain_addition, $alert_original_food_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $dataList = $config['data']['list'];
            if ($dataList === '') {
                $data_food = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            } else {
                $data_food = '<option value="" disabled selected>' . TEXT_SELECT_FOOD . '</option>';
                foreach ($dataList as $data) {
                    switch ($data['category_type']) {
                        case 1:
                            $data['category_type'] = TEXT_FOOD_FOOD;
                            break;
                        case 2:
                            $data['category_type'] = TEXT_FOOD_DRINK;
                            break;
                        case 3:
                            $data['category_type'] = TEXT_OTHER;
                            break;
                        case 4:
                            $data['category_type'] = TEXT_SEA_FOOD;
                            break;
                        default:
                    }
                    $data_food .= '<option value="' . $data['id'] . '" data-code="' . $data['code'] . '" data-price="' . $this->numberFormat($data['price']) . '"  data-original-price="' . $this->numberFormat($data['original_price']) . '" data-avatar="' . $domain . $data['avatar'] . '" data-unit="' . $data['unit_type'] . '" data-type="' . $data['category_type'] . '" data-category="' . $data['category_type_name'] . '">' . $data['name'] . '</option>';
                }
            }
            return [$data_food, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function material(Request $request)
    {
        $id = $request->get('id_food');
        $restaurant_brands_id = $request->get('restaurant_brand_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_OF_FOOD_GET_DATA, $id, $restaurant_brands_id);
        $body = null;
        $requestListMaterial = [
            'project' => $project,
            'method' => $method,
            'api' => $api,
            'body' => $body
        ];

        $material_unit_id = $request->get('material_unit_id');
        $material_unit_specification_exchange_name_id = -1;
        $api = sprintf(API_INVENTORY_GET_MATERIAL_UNIT_FOOD_MAPS2, $restaurant_brands_id , -1 , $material_unit_id, $material_unit_specification_exchange_name_id );
        $requestListUnit = [
            'project' => $project,
            'method' => $method,
            'api' => $api,
            'body' => $body
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestListMaterial]);
        try {
            $unit_data = '';
            $selected_material = $configAll[0]['data']['selected_material'];
            $un_select_material = $configAll[0]['data']['un_select_material'];
            $table_select_material = DataTables::of($selected_material)
                ->addColumn('name', function ($row) {
                    return '<label>' . $row['name'] . '<input class="d-none"  value="' . $row['id'] . '"   /></label>';
                })
                ->addColumn('unit-name', function ($row) {
                    $unit_data = '';
                    foreach ($row['material_unit_quantifications'] as $data) {
                        $unit_data .= '<option value="' . $data['id'] . '" data-exchange-value="' . $data['value'] . '"  data-selected="' . $data['is_selected'] . '"   >' . $data['name'] . ' </option>';
                    }
                    return '<div class="pr-0">
                                    <select class="js-example-basic-single select-material-unit-food">' .
                        $unit_data . '
                                    </select>
                                </div>';
                })
                ->addColumn('price', function ($row) {
                    $value_unit_selected = 0;
                    foreach ($row['material_unit_quantifications'] as $data) {
                        if ($data['is_selected']) {
                            $value_unit_selected = $data['value'];
                            break;
                        }
                    }
                    $price = round($row['price'] * $value_unit_selected / $row['material_unit_specification_exchange_value']);
                    return '<label data-price="' . $row['price'] . '" data-material-unit-specification-exchange-value="' . $row['material_unit_specification_exchange_value'] . '" data-wastage-rate="' . $row['wastage_rate'] . '">
                                <div style="font-size: 14px">' . $this->numberFormat($price) . '</div>
                            </label>';
                })
                ->addColumn('quantity', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input
                                    class="form-control text-center border-0 w-100 " style="font-size: 14px !important;"
                                    name="quantity"
                                    value="' . $this->numberFormat($row['quantity']) . '"
                                     data-max="999999999" data-float="1" data-type="currency-edit-number" data-number-currency="6" data-value-min-value-of="0"
                                />
                            </div>';
                })
                ->addColumn('total', function ($row) {
                    $value_unit_selected = 0;
                    foreach ($row['material_unit_quantifications'] as $data) {
                        if ($data['is_selected']) {
                            $value_unit_selected = $data['value'];
                            break;
                        }
                    }
                    $price = round($row['price'] * $value_unit_selected / $row['material_unit_specification_exchange_value']);
                    return $this->numberFormat(($row['quantity'] * ($price)));
                })
                ->addColumn('wastage_rate', function ($row) {
                    return ' <div class="input-group border-group validate-table-validate">
                                <input class="form-control text-center border-0 w-100  " style="font-size: 14px !important;" name="wastage-rate" value="' . $this->numberFormat($row['wastage_rate']) . '" data-max="99.9" data-float="1"     />
                            </div> ';
                })
                ->addColumn('total_wastage_rate', function ($row) {
                    $value_unit_selected = 0;
                    foreach ($row['material_unit_quantifications'] as $data) {
                        if ($data['is_selected']) {
                            $value_unit_selected = $data['value'];
                            break;
                        }
                    }
                    return $this->numberFormat(round((($row['price'] / $row['material_unit_specification_exchange_value']) * $value_unit_selected) / (1 - ($row['wastage_rate'] / 100)) * $row['quantity']));
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('action', function () {
                    return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalDetailQuantitativeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Công thức"><span class="fi-rr-exclamation"></span></button>
                                <button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" title="Xóa nguyên liệu" onclick="removeMaterial($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>
                            </div>';
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'quantity', 'name', 'price', 'unit-name', 'wastage_rate'])
                ->make(true);
            if (!empty($un_select_material)) {
                $option = '<option value="" disabled selected>' . TEXT_MATERIAL_DEFAULT_OPTION . '</option>';
                foreach ($un_select_material as $key => $value) {
                    $option .= '<option data-material-unit-specification-exchange-value=" ' . $un_select_material[$key]['material_unit_specification_exchange_value'] . '" value="' . $un_select_material[$key]['id'] . '" data-price="' . $un_select_material[$key]['price'] . '" data-wastage-rate="' . $un_select_material[$key]['wastage_rate'] . '">' . $un_select_material[$key]['name'] . '</option>';
                }
            } else {
                $option = '<option value="" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            }
            return [$table_select_material, $option, $unit_data, $configAll, $un_select_material, $selected_material];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function create(Request $request)
    {
        $id = $request->get('id');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $materials = $request->get('material');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MATERIALS_OF_FOOD_POST_ASSIGN, $id);
        $body = [
            'restaurant_brand_id' => $restaurant_brand_id,
            'materials' => $materials,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function checkImportExcel(Request $request)
    {
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $excel = $request->file('file');
        $filename = $excel->getClientOriginalName();
        $filePath = $excel->move(public_path('images'), $filename);
        $data = Excel::toArray(new excel, $filePath);
        unlink($filePath);
        $array_list = $data[0];
        $temp = 0;
        $obj = array();
        if (count($array_list) >= 5) {
            for ($i = 5; $i < count($array_list); $i++) {
                $obj[$temp] = $this->mapping($array_list[$i]);
                $temp++;
            }
        }
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_QUANTITATIVE_FOOD_POST_CHECK_IMPORT_FOOD_MATERIALS;
        $body = [
            'restaurant_brand_id' => $restaurant_brand_id,
            "foods" => $obj
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        return [$config, $config];
    }

    public function mapping(array $col)
    {
        return array(
            'food_code' => strtoupper(str_replace(' ', '', $col[0])),
            'material_code' => strtoupper(str_replace(' ', '', $col[1])),
            'quantity' => strtoupper(str_replace(' ', '', $col[2])),
        );
    }

    public function import(Request $request)
    {
        $client = $this->getClient();
        $obj = $request->get('foods');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $response = $client->request('POST', $this->getBaseUrl(sprintf(API_QUANTITATIVE_FOOD_POST_IMPORT_EXCEL_MATERIALS)),
            [
                'http_errors' => false,
                'json' => [
                    "restaurant_brand_id" => $restaurant_brand_id,
                    "foods" => $obj,
                ],
            ]);
        $data = $response->getBody();
        $config = json_decode($data, true);
        $config['url'] = $this->getBaseUrl(sprintf(API_QUANTITATIVE_FOOD_POST_IMPORT_EXCEL_MATERIALS));
        return $config;
    }
}
