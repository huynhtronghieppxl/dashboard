<?php

namespace App\Http\Controllers\Customer\TakeAway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class TakeAwayBrandController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Thương hiệu';
        return view('customer.take_away.brand.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $key = '';
        $brand = $request->get('brand');
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $branch_id = $request->get('branch');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $category_id = $request->get('category_id');
        $is_take_away = Config::get('constants.type.is_take_away.GET_TAKE_AWAY');
        $is_count_material = Config::get('constants.type.checkbox.GET_ALL');
        $category = Config::get('constants.type.id.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.DIS_SELECTED');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $is_bestseller = Config::get('constants.type.checkbox.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_kitchen = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.status.GET_ALL');
        $is_get_food_contain_addition = Config::get('constants.type.checkbox.GET_ALL');
        $alert_original_food_id = ENUM_GET_ALL;
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category, $category_id, $brand, $branch_id, $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key, $is_get_food_contain_addition, $alert_original_food_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $data_food = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('category_type_id', (int)Config::get('constants.type.category.FOOD'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();

            $data_drink = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('category_type_id', (int)Config::get('constants.type.category.DRINK'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $data_sea_food = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('category_type_id', (int)Config::get('constants.type.category.SEA_FOOD'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $data_other = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('category_type_id', (int)Config::get('constants.type.category.OTHER'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $data_table_food = $this->drawTableFood($data_food);
            $data_table_drink = $this->drawTableFood($data_drink);
            $data_table_sea_food = $this->drawTableFood($data_sea_food);
            $data_table_other = $this->drawTableFood($data_other);
            $data_total = [
                'total_record_food' => $this->numberFormat(count($data_food)),
                'total_record_drink' => $this->numberFormat(count($data_drink)),
                'total_record_sea_food' => $this->numberFormat(count($data_sea_food)),
                'total_record_other' => $this->numberFormat(count($data_other)),
            ];

            return [$data_table_food, $data_table_drink, $data_table_sea_food, $data_table_other, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    // Draw dataTable
    public function drawTableFood($data)
    {
        return Datatables::of($data)
            ->addColumn('code', function ($row) {
                return '<label class="text-primary">' . $row['code'] . '</label>';
            })
            ->addColumn('price', function ($row) {
                return '<label>'. $this->numberFormat($row['price'])  .'</label><br>
                        <label class="number-order"><em style="color: #9d9d9de6">Gốc: </em>'. $this->numberFormat($row['original_price'])  .'</label>';
            })
            ->addColumn('avatar', function ($row) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>';
            })
            ->addColumn('vat', function ($row) {
                return $row['restaurant_vat_config_percent'] . '%';
            })
            ->addColumn('original_revenue', function ($row) {
                return '<label>' . $this->numberFormat($row['original_revenue_percent'], 1) . '%' .'</label><br>
                        <label class="number-order">'. '<em style="color: #9d9d9de6">TT: </em>' . $this->numberFormat($row['original_revenue'] ) .'</label>';
            })
            ->addColumn('action', function ($row) {
                $row['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');
                if ($row['is_combo'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    $row['type_food'] = TEXT_COMBO_FOOD;
                    $row['id_type_food'] = Config::get('constants.type.TypeFood.COMBO');
                }

                if ($row['is_addition'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    $row['type_food'] = TEXT_ADDITION;
                    $row['id_type_food'] = Config::get('constants.type.TypeFood.ADDITION');
                }
                return '<div class="btn-group btn-group-sm text-center">
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="'. $row['id_type_food'] .'"><i class="fi-rr-eye"></i></button>
                        </div>';
            })
            ->addColumn('name', function ($row) {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                            <label class="title-name-new-table" >'.$row['name'].'<br><label class="label-new-table"><i class="fa fa-cutlery mr-1"></i>'.$row['code'].'</label></label>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addIndexColumn()
            ->rawColumns(['code', 'action', 'avatar','name','price','vat','original_revenue'])
            ->make(true);
    }

    public function categoryFood(Request $request)
    {
        $restaurant_brand_id = $request->get('brand');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_CATEGORY_MANAGE, $restaurant_brand_id, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $select_category = '';
            if (count($data) === 0) {
                $select_category = '<option value="-2" selected>' . TEXT_NULL_OPTION . '</option>';
            } else {
                $select_category .= '<option value="-2" selected>Danh mục</option>';
                foreach ($data as $db) {
                    $select_category .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                }
            }
            return [$select_category, $config];
        }catch (Exception $e){
            return $this->catchTemplate($config, $e);
        }
    }

    // Danh sách món ăn thương hiệu
    public function dataUpdate(Request $request)
    {
        $key = '';
        $brand = $request->get('brand');
        $branch_id = Config::get('constants.type.id.GET_ALL');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $category_id = Config::get('constants.type.id.GET_ALL');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_count_material = Config::get('constants.type.checkbox.GET_ALL');
        $category = Config::get('constants.type.id.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.DIS_SELECTED');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $is_bestseller = Config::get('constants.type.checkbox.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_kitchen = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.status.GET_ALL');
        $is_get_food_contain_addition = Config::get('constants.type.checkbox.GET_ALL');
        $alert_original_food_id = ENUM_GET_ALL;
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category, $category_id, $brand, $branch_id, $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key, $is_get_food_contain_addition, $alert_original_food_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $collection = collect($data);
            $data_selected = $collection->where('is_take_away', (int)Config::get('constants.type.checkbox.SELECTED'))->all();
            $data_un_selected = $collection->where('is_take_away', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->all();
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $data_table_all = DataTables::of($data_un_selected)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>';
                })
                ->addColumn('action', function ($row) use ($domain) {
//                    return '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-avatar="' . $domain . $row['avatar'] . '" data-amount="' . $this->numberFormat($row['price']) . '" onclick="checkFoodTakeAway($(this))"></i>';
                    return '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-avatar="' . $domain . $row['avatar'] . '" data-amount="' . $this->numberFormat($row['price']) . '" onclick="checkFoodTakeAway($(this))"><i class="fi-rr-arrow-small-right"></i></button> </div>';
                })
                ->addColumn('name', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                            <label class="title-name-new-table" >'.$row['name'].'<br><label class="label-new-table"><i class="fa fa-cutlery mr-1"></i>'.$row['category_name'].'</label></label>';
                })
                ->rawColumns(['avatar', 'action','name'])
                ->addIndexColumn()
                ->make(true);

            $data_table_selected = DataTables::of($data_selected)
                ->addColumn('amount', function ($row) use ($domain) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/></label><input value="' . $row['id'] . '" class="d-none"/>';
                })
                ->addColumn('action', function ($row) use ($domain) {
//                    return '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-avatar="' . $domain . $row['avatar'] . '" data-amount="' . $this->numberFormat($row['price']) . '" onclick="unCheckFoodTakeAway($(this))"></i>';
                    return '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-avatar="' . $domain . $row['avatar'] . '" data-amount="' . $this->numberFormat($row['price']) . '" onclick="unCheckFoodTakeAway($(this))"><i class="fi-rr-arrow-small-left"></i></button></div>';
                })
                ->addColumn('name', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                            <label class="title-name-new-table" >'.$row['name'].'<br><label class="label-new-table"><i class="fa fa-cutlery mr-1"></i>'.$row['category_name'].'</label></label>';
                })
                ->rawColumns(['avatar', 'action','name'])
                ->addIndexColumn()
                ->make(true);

            return [$data_table_all, $data_table_selected, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    //  Cập nhật món ăn thương hiệu
    public function update(Request $request)
    {
        $brand = $request->get('brand');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_TAKE_AWAY_FOOD_POST_FOOD_BRAND);
        $body = [
            "restaurant_brand_id" => $brand,
            "food_ids" => $request->get('foods')
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    // Bật tắt setting
    public function setting(Request $request)
    {
        // Bặt tắt setting
        $brand = $request->get('brand');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_TAKE_AWAY_FOOD_POST_SETTING_BRAND, $brand);
        $body = [];
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            Session::forget(SESSION_KEY_SETTING_CURRENT_BRAND);
            Session::put(SESSION_KEY_SETTING_CURRENT_BRAND, $config['data']);
        }catch (Exception $e){
            return $this->catchTemplate($config , $e);
        }

        // Danh sách thương hiệu
        $status = Config::get('constants.type.checkbox.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SETTING_RESTAURANT_RESTAURANT_BRAND, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            Session::forget(SESSION_KEY_DATA_BRAND);
            Session::put(SESSION_KEY_DATA_BRAND, $config['data']);
            return $config;
        } catch (Exception $e) {
            $this->catchTemplate($config, $e);
        }
    }
}
