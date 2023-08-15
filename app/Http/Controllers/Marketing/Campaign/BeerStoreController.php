<?php

namespace App\Http\Controllers\Marketing\Campaign;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class BeerStoreController extends Controller
{
    public function getFood(Request $request){
        $brand = $request->get('brand');
        $status = ENUM_SELECTED;
        $category = ENUM_FOOD_CATEGORY_DRINK;
        $is_combo = ENUM_DIS_SELECTED;
        $is_special_gift = ENUM_DIS_SELECTED;
        $is_addition = ENUM_DIS_SELECTED;
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $key = '';
        $branch_id = ENUM_GET_ALL;
        $category_id = ENUM_GET_ALL;
        $is_take_away = ENUM_DIS_SELECTED;
        $is_count_material = ENUM_SELECTED;
        $is_bestseller = ENUM_DIS_SELECTED;
        $is_kitchen = ENUM_SELECTED;
        $is_get_food_contain_addition = ENUM_DIS_SELECTED;
        $alert_original_food_id = $request->get('alert_original_price');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category, $category_id, $brand, $branch_id, $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key, $is_get_food_contain_addition, $alert_original_food_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);

        try {
            $data = $config['data']['list'];
            $data_food = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($data as $value) {
                $data_food .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
            }
            if (count($data) === ENUM_DIS_SELECTED) {
                $data_food = '<option value="" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            }
            return [$data_food, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }


    public function getDetailConfig(Request $request)
    {
        $brand_id = $request->get('brand_id');
        $api = sprintf(API_MARKETING_BEER_GET_CONFIG, $brand_id);
        $body = [];
        $requestGetConfig = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_MARKETING_BEER_GET_DETAIL, $brand_id);
        $requestGetDetail = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestGetConfig, $requestGetDetail]);
        try {
            $data = $configAll[0]['data']['configs'];
            $tableDetailConfig = DataTables::of($data)
                ->addColumn('time', function ($row) {
                    switch ($row['day_of_week']){
                        case ENUM_MONDAY_BEER_STORE:
                            return 'Thứ 2';
                        case ENUM_TUESDAY_BEER_STORE:
                            return 'Thứ 3';
                        case ENUM_WEDNESDAY_BEER_STORE:
                            return 'Thứ 4';
                        case ENUM_THURSDAY_BEER_STORE:
                            return 'Thứ 5';
                        case ENUM_FRIDAY_BEER_STORE:
                            return 'Thứ 6';
                        case ENUM_SATURDAY_BEER_STORE:
                            return 'Thứ 7';
                        case ENUM_SUNDAY_BEER_STORE:
                            return 'Chủ nhật';
                    }
                })
                ->addColumn('quantity-one', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input
                                    class="form-control text-center border-0 w-100 quantity"
                                    value="' . $this->numberFormat($row['config'][0]['maximum_use_quantity']) . '"
                                    data-max="9999" data-money="1" data-min="1000"
                                    data-price="' . $this->numberFormat($row['config'][0]['maximum_use_quantity']) . '"/>
                            </div>';
                })
                ->addColumn('quantity-two', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input
                                    class="form-control text-center border-0 w-100 quantity"
                                    value="' . $this->numberFormat($row['config'][1]['maximum_use_quantity']) . '"
                                    data-max="9999" data-money="1" data-min="1000"
                                    data-price="' . $this->numberFormat($row['config'][1]['maximum_use_quantity']) . '"/>
                            </div>';
                })
                ->addColumn('quantity-three', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input
                                    class="form-control text-center border-0 w-100 quantity"
                                    value="' . $this->numberFormat($row['config'][2]['maximum_use_quantity']) . '"
                                    data-max="9999" data-money="1" data-min="1000"
                                    data-price="' . $this->numberFormat($row['config'][2]['maximum_use_quantity']) . '"/>
                            </div>';
                })
                ->addColumn('quantity-four', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input
                                    class="form-control text-center border-0 w-100 quantity"
                                    value="' . $this->numberFormat($row['config'][3]['maximum_use_quantity']) . '"
                                    data-max="9999" data-money="1" data-min="1000"
                                    data-price="' . $this->numberFormat($row['config'][3]['maximum_use_quantity']) . '"/>
                            </div>';

                })
                ->addColumn('quantity-five', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input
                                    class="form-control text-center border-0 w-100 quantity"
                                    value="' . $this->numberFormat($row['config'][4]['maximum_use_quantity']) . '"
                                    data-max="9999" data-money="1" data-min="1000"
                                    data-price="' . $this->numberFormat($row['config'][4]['maximum_use_quantity']) . '"/>
                            </div>';
                })
                ->addColumn('quantity-six', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input
                                    class="form-control text-center border-0 w-100 quantity"
                                    value="' . $this->numberFormat($row['config'][5]['maximum_use_quantity']) . '"
                                    data-max="9999" data-money="1" data-min="1000"
                                    data-price="' . $this->numberFormat($row['config'][5]['maximum_use_quantity']) . '"/>
                            </div>';
                })
                ->addColumn('quantity-seven', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input
                                    class="form-control text-center border-0 w-100 quantity"
                                    value="' . $this->numberFormat($row['config'][6]['maximum_use_quantity']) . '"
                                    data-max="9999" data-money="1" data-min="1000"
                                    data-price="' . $this->numberFormat($row['config'][6]['maximum_use_quantity']) . '"/>
                            </div>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="form-validate-checkbox">
                                <div class="checkbox-form-group">
                                    <input type="checkbox" id="check-apply-beer-store" '. ($row['is_apply'] !== ENUM_SELECTED ? '' : 'checked') .'/>
                                </div>
                            </div>';
                })
                ->rawColumns(['quantity-one', 'quantity-two', 'quantity-three', 'quantity-four', 'quantity-five', 'quantity-six', 'quantity-seven' ,'action'])
                ->addIndexColumn()
                ->make(true);
            $collect = collect($data)->first();
            $data_amount = [
                'first_amount' => $collect['config'][0]['total_order_amount'],
                'second_amount' => $collect['config'][1]['total_order_amount'],
                'third_amount' => $collect['config'][2]['total_order_amount'],
                'fourth_amount' => $collect['config'][3]['total_order_amount'],
                'fifth_amount' => $collect['config'][4]['total_order_amount'],
                'six_amount' => $collect['config'][5]['total_order_amount'],
                'seven_amount' => $collect['config'][6]['total_order_amount'],
            ];


            return [$tableDetailConfig, $data_amount , $configAll[1]['data']  ,$configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function updateConfig(Request $request)
    {
        $brand = $request->get('brand_id');
        $food_id = $request->get('food_id');
        $reset_day = $request->get('reset_day');
        $monday = $request->get('monday');
        $tuesday = $request->get('tuesday');
        $wednesday = $request->get('wednesday');
        $thursday = $request->get('thursday');
        $friday = $request->get('friday');
        $saturday = $request->get('saturday');
        $sunday = $request->get('sunday');
        $api = sprintf(API_MARKETING_BEER_POST_UPDATE_CONFIG, $brand);
        $body = (object)['configs' => [$monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday]];
        $requesUpdateConfig = [
            'project' => ENUM_PROJECT_ID_ORDER_VERSION,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_MARKETING_BEER_POST_UPDATE_DETAIL_MATERIAL , $brand);
        $body = [
            "banner_image_url" => $request -> get('banner_image_url'),
            "notify_content_daily" => $request -> get('notify_content_daily'),
            "notify_content_reset" => $request -> get('notify_content_reset'),
            "information" => $request -> get('information'),
            "hour_send_notify" => $request -> get('hour_send_notify'),
            "use_guide" => $request->get('use_guide'),
            "term" => $request->get('term'),
            "food_id" => $food_id,
        ];
        $requesUpdate = [
            'project' => ENUM_PROJECT_ID_ORDER_VERSION,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body,
        ];
        return $this->callApiMultiGatewayTemplate2([$requesUpdateConfig, $requesUpdate]);
    }


    public function getDetail(Request $request){
        $brand = $request->get('brand_id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MARKETING_BEER_GET_DETAIL, $brand);
        $body = null;
        $config =  $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === 200) {
            $config['data']['banner_url'] =  $config['data']['banner_image_url'];
            $config['data']['banner_image_url'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['banner_image_url'];
        }
        return $config;
    }

    public function changeStatus(Request $request){
        $brand = $request->get('brand_id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MARKETING_BEER_POST_RUNNING, $brand);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if($config['status'] === 200) {
                $brand_setting = Session::get('SESSION_KEY_SETTING_CURRENT_BRAND');
                if ($config['data']['running_status'] === 1) {
                    $brand_setting['is_running_pc_beer_gift'] = 1;
                }else{
                    $brand_setting['is_running_pc_beer_gift'] = 0;
                }
                Session::put('SESSION_KEY_SETTING_CURRENT_BRAND', $brand_setting);
             }
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
        return $config;
    }

    public function updatePolicy (Request $request)
    {
        $brand = $request->get('brand_id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf('/restaurant-pc-beer-gift/%s/update', $brand);
        $body = [
            "banner_image_url" => $request -> get('banner_image_url'),
            "notify_content_daily" => $request -> get('notify_content_daily'),
            "notify_content_reset" => $request -> get('notify_content_reset'),
            "information" => $request -> get('information'),
            "hour_send_notify" => $request -> get('hour_send_notify'),
            "use_guide" => $request->get('use_guide'),
            "term" => $request->get('term'),
            "food_id" => $request->get('food_id'),
//            "reset_at" => $request->get('reset_at'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
