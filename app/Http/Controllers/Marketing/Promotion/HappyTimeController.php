<?php

namespace App\Http\Controllers\Marketing\Promotion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class HappyTimeController extends Controller
{
    public function data(Request $request)
    {
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $branch_id = $request->get('branch_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $status = Config::get('constants.type.status.GET_ALL');
        $key_search = '';
        $api = sprintf(API_PROMOTION_GET_DATA, $restaurant_brand_id, $branch_id, $status, $limit, $page, $from_date, $to_date, $key_search);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data']['list'];

            $data_pausing = collect($data)->where('status', (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.PAUSING'))->toArray();
            $data_expired = collect($data)->where('status', (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.EXPIRED'))->toArray();
            $data_pending = collect($data)->where('status', (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.PENDDING'))->toArray();
            $data_applying = collect($data)->where('status', (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.APPLYING'))->toArray();

            $data_table = [
                'pending' => $this->drawTablePromotion($data_pending)->original['data'],
                'applying' => $this->drawTablePromotion($data_applying)->original['data'],
                'pausing' => $this->drawTablePromotion($data_pausing)->original['data'],
                'expired' => $this->drawTablePromotion($data_expired)->original['data'],
            ];

            $data_total = [
                'total_record_pending' => $this->numberFormat(count($data_pending)),
                'total_record_applying' => $this->numberFormat(count($data_applying)),
                'total_record_pausing' => $this->numberFormat(count($data_pausing)),
                'total_record_expired' => $this->numberFormat(count($data_expired)),
            ];

            return [$data_table, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTablePromotion($data)
    {
        return DataTables::of($data)
            ->addColumn('time', function ($row) {
                return '<label>' . $row['from_date'] . ' - ' . $row['to_date'] . '</label>';
            })
            ->addColumn('type-text', function ($row) {
                if ($row['type'] === (int)Config::get('constants.type.RestaurantPromotionTypeEnum.UNKNOW')) {
                    return '<label>' . TEXT_OTHER . '</label>';
                } else if ($row['type'] === (int)Config::get('constants.type.RestaurantPromotionTypeEnum.PROMOTION_FOOD')) {
                    return '<label>' . TEXT_PROMOTION_FOOD . '</label>';
                } else if ($row['type'] === (int)Config::get('constants.type.RestaurantPromotionTypeEnum.PROMOTION_ORDER')) {
                    return '<label>' . TEXT_PROMOTION_ORDER . '</label>';
                } else if ($row['type'] === (int)Config::get('constants.type.RestaurantPromotionTypeEnum.PROMOTION_GOLDEN_HOUR')) {
                    return '<label>' . TEXT_PROMOTION_GOLDEN_HOUR . '</label>';
                } else {
                    return '<label>' . TEXT_PROMOTION_DONATE . '</label>';
                }
            })
            ->addColumn('action', function ($row) {
                $pause = TEXT_DISABLE_STATUS;
                if ($row['status'] === (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.EXPIRED')) {
                    $action = '<div class="btn-group btn-group-sm ml-auto">
                                   <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openModalDetailHappyTimePromotion(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><span class="icofont icofont-eye-alt"></span></button>
                               </div>';
                } else if ($row['status'] === (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.APPLYING')) {
                    $action = '<div class="btn-group btn-group-sm ml-auto">
                                   <button type="button" class="tabledit-edit-button btn btn-inverse waves-effect waves-light" onclick="pauseHappyTimePromotion(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $pause . '"><span class="fa fa-bell-slash"></span></button>
                                   <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openModalDetailHappyTimePromotion(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><span class="icofont icofont-eye-alt"></span></button>
                               </div>';
                } else if ($row['status'] === (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.PAUSING')) {
                    $action = '<div class="btn-group btn-group-sm ml-auto">
                                   <button type="button" class="tabledit-edit-button btn btn-success waves-effect waves-light" onclick="applyHappyTimePromotion(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_APPLY . '"><span class="fa fa-bell-o"></span></button>
                                   <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" onclick="openModalUpdateHappyTimePromotion(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><span class="icofont icofont-ui-edit"></span></button>
                                   <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openModalDetailHappyTimePromotion(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><span class="icofont icofont-eye-alt"></span></button>
                               </div>';
                } else if ($row['status'] === (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.PENDDING')) {
                    $action = '<div class="btn-group btn-group-sm ml-auto">
                                   <button type="button" class="tabledit-edit-button btn btn-success waves-effect waves-light" onclick="applyHappyTimePromotion(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_APPLY . '"><span class="fa fa-bell-o"></span></button>
                                   <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" onclick="openModalUpdateHappyTimePromotion(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><span class="icofont icofont-ui-edit"></span></button>
                                   <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openModalDetailHappyTimePromotion(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><span class="icofont icofont-eye-alt"></span></button>
                               </div>';
                }
                return $action;

            })
            ->rawColumns(['time', 'action', 'type-text'])
            ->addIndexColumn()
            ->make(true);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_PROMOTION_GET_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $config1 = $config;
            $data = $config['data'];
            switch ($data['type']) {
                case (int)Config::get('constants.type.RestaurantPromotionTypeEnum.UNKNOW'):
                    $data['type'] = TEXT_OTHER;
                    break;
                case (int)Config::get('constants.type.RestaurantPromotionTypeEnum.PROMOTION_FOOD'):
                    $data['type'] = TEXT_PROMOTION_FOOD;
                    break;
                case (int)Config::get('constants.type.RestaurantPromotionTypeEnum.PROMOTION_ORDER'):
                    $data['type'] = TEXT_PROMOTION_ORDER;
                    break;
                case $data['type'] === (int)Config::get('constants.type.RestaurantPromotionTypeEnum.PROMOTION_GOLDEN_HOUR'):
                    $data['type'] = TEXT_PROMOTION_GOLDEN_HOUR;
                    break;
                case (int)Config::get('constants.type.RestaurantPromotionTypeEnum.PROMOTION_DONATE'):
                    $data['type'] = TEXT_PROMOTION_DONATE;
                    break;
            }

            for ($i = 0; $i < count($data['day_of_weeks']); $i++) {
                switch ($data['day_of_weeks'][$i]) {
                    case 0:
                        $data['day_of_weeks'][$i] = 'Thứ hai';
                        break;
                    case 1:
                        $data['day_of_weeks'][$i] = 'Thứ ba';
                        break;
                    case 2:
                        $data['day_of_weeks'][$i] = 'Thứ tư';
                        break;
                    case 3:
                        $data['day_of_weeks'][$i] = 'Thứ năm';
                        break;
                    case 4:
                        $data['day_of_weeks'][$i] = 'Thứ sáu';
                        break;
                    case 5:
                        $data['day_of_weeks'][$i] = 'Thứ bảy';
                        break;
                    case 6:
                        $data['day_of_weeks'][$i] = 'Chủ nhật';
                        break;
                    case -1:
                        $data['day_of_weeks'] = 'Tất cả ngày trong tuần';
                        break;
                }
            }

            $data['day_of_weeks_text'] = implode(',', $data['day_of_weeks']);
            if ($data['day_of_weeks_text'] === Config::get('constants.type.data.NONE')) {
                $data['day_of_weeks_text'] = TEXT_NO_APPLY;
            }

            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $list_img = '';
            foreach ($data['banner_image_urls'] as $db) {
                $list_img .=   '<div class="col-lg-3 mb-4" id="image-branch-setting">
                                   <img onerror="imageDefaultOnLoadError($(this))" class="show-img showimg" src="' . $domain . $db . '"/>
                                </div>';
            }

            return [$data, $list_img, $config1];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_PROMOTION_POST_CREATE;
        $body = [
            'restaurant_brand_ids' => [(int)$request->get('restaurant_brand_ids')],
            'branch_ids' => $request->get('branch_ids'),
            'banner_image_urls' => $request->get('banner_image_urls'),
            'short_description' => sprintf($request->get('short_description')),
            'name' => $request->get('name'),
            'description' => sprintf($request->get('description')),
            'min_order_total_amount_required' => $request->get('min_order_total_amount_required'),
            'max_promotion_amount' => $request->get('max_promotion_amount'),
            'discount_percent' => $request->get('discount_percent'),
            'discount_amount' => $request->get('discount_amount'),
            'day_of_weeks' => $request->get('day_of_week'),
            'from_hour' => (int)$request->get('from_hour'),
            'to_hour' => (int)$request->get('to_hour'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'type' => $request->get('type'),
            'is_allow_use_with_other_promotion' => $request->get('is_allow_use_with_other_promotion')
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_PROMOTION_GET_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data'];
            $data['min_order_total_amount_required'] = $this->numberFormat($data['min_order_total_amount_required']);
            $data['discount_amount'] = $this->numberFormat($data['discount_amount']);
            $data['max_promotion_amount'] = $this->numberFormat($data['max_promotion_amount']);
            $data['branchs_id'] = [];
            foreach ($data['branchs'] as $b) {
                array_push($data['branchs_id'], $b['id']);
            }

            $data['banner_list'] = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            foreach ($data['banner_image_urls'] as $img) {
                $data['banner_list'] .= '<div class="dz-preview col-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 mb-4 dz-image-preview " style="cursor: pointer;">
                                            <div class="dz-image">
                                                <img onerror="imageDefaultOnLoadError($(this))" data-dz-thumbnail="" data-type="0" class="rounded w-100 " alt="" src="' . $domain . $img . '" data-url="' . $img . '" style="width: 25vh!important; height: 25vh!important;">
                                            </div>
                                            <a class="dz-remove"  href="javascript:undefined;">
                                                <button type="button" class="btn btn-danger btn-circle my-1 btn-remove"><span class="feather icon-trash-2"></span></button></a></div>';
            }

            return [$data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_PROMOTION_POST_UPDATE, $id);
        $body = [
            'restaurant_brand_ids' => [(int)$request->get('restaurant_brand_ids')],
            'branch_ids' => $request->get('branch_ids'),
            'banner_image_urls' => $request->get('banner_image_urls'),
            'short_description' => sprintf($request->get('short_description')),
            'name' => $request->get('name'),
            'description' => sprintf($request->get('description')),
            'min_order_total_amount_required' => $request->get('min_order_total_amount_required'),
            'max_promotion_amount' => $request->get('max_promotion_amount'),
            'discount_percent' => $request->get('discount_percent'),
            'discount_amount' => $request->get('discount_amount'),
            'day_of_weeks' => $request->get('day_of_week'),
            'from_hour' => (int)$request->get('from_hour'),
            'to_hour' => (int)$request->get('to_hour'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'type' => $request->get('type'),
            'is_allow_use_with_other_promotion' => $request->get('is_allow_use_with_other_promotion')
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_PROMOTION_POST_CHANGE_STATUS, $id);
        $body = [
            'status' => $status
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function cancel(Request $request)
    {
        $id = $request->get('id');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_PROMOTION_POST_CANCEL, $id);
        $body = null;
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function voucher(Request $request)
    {
        $id = $request->get('id');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_PROMOTION_GET_PROMOTION_VOUCHERS, $id);
        $body = [
            'code' => $request->get('code'),
            'branch_ids' => $request->get('branch'),
            'max_use_count' => $request->get('max_use'),
            'reusable_count' => $request->get('reusable')
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function dataFood(Request $request)
    {
        $restaurant_brands_id = $request->get('restaurant_brands_id');
        $branch = Config::get('constants.type.checkbox.GET_ALL');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $category_type = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.checkbox.GET_ALL');
        $category_id = Config::get('constants.type.id.GET_ALL');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.GET_ALL');
        $is_count_material = Config::get('constants.type.checkbox.GET_ALL');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $is_bestseller = Config::get('constants.type.checkbox.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_kitchen = Config::get('constants.type.checkbox.GET_ALL');
        $is_get_food_contain_addition = Config::get('constants.type.checkbox.GET_ALL');
        $key_search = '';
        $alert_original_food_id = ENUM_GET_ALL;
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category_type, $category_id,
            $restaurant_brands_id, $branch, $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift,
            $key_search, $is_get_food_contain_addition, $alert_original_food_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);

        try {
            $data = collect($config['data']['list']);
            if (empty($data)) {
                $is_empty = 1;
                $data_opt = '<option selected>' . TEXT_NULL_OPTION . '</option>';
            } else {
                $is_empty = 0;
                $final_data = $data->map(function ($d) {
                    return collect($d)->only(['id', 'avatar', 'name', 'price', 'is_special_gift', 'category_type_id'])->all();
                });
                $not_special_gift = collect($final_data->where('is_special_gift', Config::get('constants.type.checkbox.DIS_SELECTED'))->all());
                $other_data = $not_special_gift->where('category_type_id', Config::get('constants.type.category.OTHER'))->all();
                $food_data = $not_special_gift->where('category_type_id', Config::get('constants.type.category.FOOD'))->all();
                $drink_data = $not_special_gift->where('category_type_id', Config::get('constants.type.category.DRINK'))->all();
                $sea_food_data = $not_special_gift->where('category_type_id', Config::get('constants.type.category.SEA_FOOD'))->all();
                $data_opt = [
                    'all' => $this->convertToOptHtml($final_data->toArray(), Config::get('constants.type.checkbox.GET_ALL')),
                    'other_opt' => $this->convertToOptHtml(array_values($other_data), Config::get('constants.type.category.OTHER')),
                    'food_opt' => $this->convertToOptHtml(array_values($food_data), Config::get('constants.type.category.FOOD')),
                    'drink_opt' => $this->convertToOptHtml(array_values($drink_data), Config::get('constants.type.category.DRINK')),
                    'sea_food_opt' => $this->convertToOptHtml(array_values($sea_food_data), Config::get('constants.type.category.SEA_FOOD')),
                ];
            }

            return [$is_empty, $data_opt, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function convertToOptHtml($data, $select_type)
    {
        if (empty($data)) {
            $food_data = '<option selected>' . TEXT_NULL_OPTION . '</option>';
        } else {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $food_data = '<option selected value="">' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $food_data .= '<option value="' . $data[$i]['id'] . '" data-avatar="' . $domain . $data[$i]['avatar'] . '" data-name="' . $data[$i]['name'] . '" data-price="' . $data[$i]['price'] . '" data-price-format="' . $this->numberFormat($data[$i]['price']) . '" data-is-gift="' . $data[$i]['is_special_gift'] . '" data-select="' . $select_type . '">' . $data[$i]['name'] . '</option>';
            }
        }
        return $food_data;
    }

    public function promotionAssign(Request $request)
    {
        $restaurant_brands_id = $request->get('restaurant_brands_id');
        $branch_id = $request->get('branch_id');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $from_date = "";
        $to_date = "";
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $status = Config::get('constants.type.status.GET_ALL');
        $key_search = '';
        $api = sprintf(API_PROMOTION_GET_DATA, $restaurant_brands_id, $branch_id, $status, $limit, $page, $from_date, $to_date, $key_search);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);

        try {
            $data = collect($config['data']['list']);

            if (empty($data)) {
                $promotion_list = '<option selected>' . TEXT_NULL_OPTION . '</option>';
            } else {
                $promotion_list = '<option selected value="" disabled>' . TEXT_DEFAULT_OPTION . '</option>';
                for ($i = 0; $i < count($data); $i++) {
                    $promotion_list .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }

            return [$promotion_list, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function promotionAssignDetail(Request $request)
    {
        $id = $request->get('id');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_PROMOTION_GET_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data'];

            switch ($data['type']) {
                case (int)Config::get('constants.type.RestaurantPromotionTypeEnum.UNKNOW'):
                    $data['type'] = TEXT_OTHER;
                    break;
                case (int)Config::get('constants.type.RestaurantPromotionTypeEnum.PROMOTION_FOOD'):
                    $data['type'] = TEXT_PROMOTION_FOOD;
                    break;
                case (int)Config::get('constants.type.RestaurantPromotionTypeEnum.PROMOTION_ORDER'):
                    $data['type'] = TEXT_PROMOTION_ORDER;
                    break;
                case (int)Config::get('constants.type.RestaurantPromotionTypeEnum.PROMOTION_GOLDEN_HOUR'):
                    $data['type'] = TEXT_PROMOTION_GOLDEN_HOUR;
                    break;
                case (int)Config::get('constants.type.RestaurantPromotionTypeEnum.PROMOTION_DONATE'):
                    $data['type'] = TEXT_PROMOTION_DONATE;
                    break;
            }

            switch ($data['status']) {
                case (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.APPLYING'):
                    $data['type_status_name'] = TEXT_APPLYING;
                    break;
                case (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.PAUSING'):
                    $data['type_status_name'] = TEXT_PENDING;
                    break;
                case (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.PENDDING'):
                    $data['type_status_name'] = TEXT_MEDIA_MARKETING_NOT_RUNNING;
                    break;
                case (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.EXPIRED'):
                    $data['type_status_name'] = TEXT_EXPIRED;
                    break;
                case (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.UNKNOW'):
                    $data['type_status_name'] = TEXT_OTHER;
                    break;
            }

            for ($i = 0; $i < count($data['day_of_weeks']); $i++) {
                switch ($data['day_of_weeks'][$i]) {
                    case 0:
                        $data['day_of_weeks'][$i] = 'Thứ hai';
                        break;
                    case 1:
                        $data['day_of_weeks'][$i] = 'Thứ ba';
                        break;
                    case 2:
                        $data['day_of_weeks'][$i] = 'Thứ tư';
                        break;
                    case 3:
                        $data['day_of_weeks'][$i] = 'Thứ năm';
                        break;
                    case 4:
                        $data['day_of_weeks'][$i] = 'Thứ sáu';
                        break;
                    case 5:
                        $data['day_of_weeks'][$i] = 'Thứ bảy';
                        break;
                    case 6:
                        $data['day_of_weeks'][$i] = 'Chủ nhật';
                        break;
                    case -1:
                        $data['day_of_weeks'] = 'Tất cả ngày trong tuần';
                        break;
                }
            }

            $table = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);

            if ($data['status'] === (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.APPLYING') || $data['status'] === (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.PAUSING')) {
                $button = '';
            } else {
                $button = '<button class="tabledit-delete-button btn btn-danger waves-effect waves-light" onclick="removeFoodAssignToPromotion(this)"><span class="icofont icofont-ui-delete"></span></button>';
            }

            foreach ($data['foods'] as $food) {
                $table .= '<tr>
                <td class="text-center w-10"><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $food['avatar_thump'] . '" class="img-data-table"/></td>
                <td class="text-center w-40"><label>' . $food['name'] . '</label><input value="' . $food['id'] . '" class="d-none "/></td>
                <td class="text-center w-15"><label class="price">' . $this->numberFormat($food['price']) . '</label><input value="' . $food['price'] . '" class="d-none price-input"/></td>
                <td class="text-center w-10">
                    <div class="btn-group-sm">' . $button . '</div>
                </td>
                </tr>';
            }

            $data['day_of_weeks_text'] = implode(',', $data['day_of_weeks']);
            if ($data['day_of_weeks_text'] === Config::get('constants.type.data.NONE')) {
                $data['day_of_weeks_text'] = TEXT_NO_APPLY;
            }

            return [$data, $table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function assignFood(Request $request)
    {
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_PROMOTION_POST_ASSIGN_FOOD;
        $body = [
            'restaurant_brand_id' => $request->get('restaurant_brand_id'),
            'promotion_id' => $request->get('promotion_id'),
            'foods' => $request->get('foods'),
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }
}
