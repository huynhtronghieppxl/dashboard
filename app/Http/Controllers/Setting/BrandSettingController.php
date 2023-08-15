<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;

class BrandSettingController extends Controller
{
    public function index()
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if ($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if ($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Thương hiệu';
        return view('setting.brand.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $status = ENUM_STATUS_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BRAND_GET_DATA, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $listBrand = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $data = collect($data)->sortByDesc('status')->all();
            foreach ($data as $key => $db) {
                $logo = ($db['logo_url'] == '' || $db['logo_url'] == null) ? $domain . Config::get('app.IMG_DEFAULT') : $domain . $db['logo_url'];
                $logoSrc = ($db['logo_url'] == '' || $db['logo_url'] == null) ?Config::get('app.IMG_DEFAULT') : $db['logo_url'];
                $banner = ($db['banner'] == '' || $db['banner'] == null) ? $domain . '../images/banner_default.jpg' : $domain . $db['banner'];
                $bannerSrc = ($db['banner'] == '' || $db['banner'] == null) ? '../images/banner_default.jpg' : $db['banner'];
                if ($db['status'] === ENUM_SELECTED) {
                    $active = 'active';
                    $ulDetail = '<ul class="profile-controls">
                                        <li data-toggle="tooltip" data-original-title="' . TEXT_STATUS_ENABLE . '" data-placement="top">
                                            <div class="pointer btn-radius-50" style=" background: #2F9672; color: #ffffff">
                                                    <i class="fi-rr-check"></i>
                                            </div>
                                        </li>
                                        <li data-toggle="tooltip" data-original-title="' . TEXT_DETAIL . '" data-placement="top">
                                            <div class="pointer brand-setting-detail seemt-btn-hover-blue btn-radius-50" data-status="' . $db['status'] . '" data-id="' . $db['id'] . '" data-name="' . $db['name'] . '"
                                            data-logo="' . $logo . '" data-banner="' . $banner . '" data-description="' . $db['description'] . '" data-logo-src="'. $logoSrc .'" data-banner-src="'. $bannerSrc .'"
                                            data-branch-type="' . $db['setting']['branch_type'] . '"
                                            data-type="' . $key . '" data-phone="' . $db['phone'] . '"
                                            data-branch-type-option ="' . $db['setting']['branch_type_option'] . '"
                                            data-service-restaurant-level-id="' . $db['service_restaurant_level_id'] . '"
                                            data-service-restaurant-level-type="' . $db['service_restaurant_level_type'] . '"
                                            data-service-restaurant-level-price="' . $db['service_restaurant_level_price'] . '"
                                            data-website="' . $db['website'] . '"
                                            data-facebook-page="' . $db['facebook_page'] . '"
                                            onclick="dataProfileBrand($(this))">
                                                <i class="fi-rr-eye"></i>
                                            </lable>
                                        </li>
                                   </ul>';
                    $action = '<i data-toggle="tooltip" data-original-title="' . TEXT_STATUS_ENABLE . '" data-placement="right" class="fa fa-2x fa-check-square" style="padding: 2px 5px;color: #24a959;"></i>';
                } else {
                    $active = '';
                    $ulDetail = '<ul class="profile-controls">
                                        <li data-toggle="tooltip" data-original-title="' . TEXT_DISABLE_STATUS . '" data-placement="top">
                                            <div class="pointer btn-radius-50" style=" background: #E8002E; color: #ffffff">
                                                    <i class="fi-rr-cross"></i>
                                            </div>
                                        </li>
                                        <li data-toggle="tooltip" data-original-title="' . TEXT_DETAIL . '" data-placement="top">
                                            <div class="pointer brand-setting-detail seemt-btn-hover-blue btn-radius-50" data-status="' . $db['status'] . '" data-id="' . $db['id'] . '" data-name="' . $db['name'] . '"
                                            data-logo="' . $logo . '" data-banner="' . $banner . '" data-description="' . $db['description'] . '" data-logo-src="'. $logoSrc .'" data-banner-src="'. $bannerSrc .'"
                                            data-branch-type="' . $db['setting']['branch_type'] . '"
                                            data-type="' . $key . '" data-phone="' . $db['phone'] . '"
                                            data-branch-type-option ="' . $db['setting']['branch_type_option'] . '"
                                            data-service-restaurant-level-id="' . $db['service_restaurant_level_id'] . '"
                                            data-service-restaurant-level-type="' . $db['service_restaurant_level_type'] . '"
                                            data-service-restaurant-level-price="' . $db['service_restaurant_level_price'] . '"
                                            data-website="' . $db['website'] . '"
                                            data-facebook-page="' . $db['facebook_page'] . '"
                                            onclick="dataProfileBrand($(this))">
                                                <i class="fi-rr-eye"></i>
                                            </lable>
                                        </li>
                                   </ul>';
                    $action = '<i data-toggle="tooltip" data-original-title="' . TEXT_DISABLE_STATUS . '" data-placement="right" class="fa fa-2x fa-square" style="padding: 2px 5px;color: #FF5370;"></i>';
                }

                $listBrand .= '<div class="col-xl-6 col-lg-12 edit-flex-auto-fill">
                                    <div class="box-image" style="height: max-content">
                                        <figure class="box-image-banner">
                                            <img onerror="imageDefaultOnLoadError($(this))" src="' . $banner . '" alt="" class="thumbnail-banner">
                                            ' . $ulDetail . '
                                        </figure>
                                        <div class="col-12" style="position: absolute; bottom: 20px">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="profile-branch">
                                                        <div class="profile-branch-thumb">
                                                            <img onerror="imageDefaultOnLoadError($(this))" alt="author" class="thumbnail-branch-logo-booking" src="' . $logo . '">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div class="author-content" style="text-overflow: ellipsis;width:70%;overflow: hidden;white-space: nowrap ">
                                                       <a class="custom-name ' . $active . '">' . $db['name'] . '</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
            }
            if (count($config['data']) == 1) {
                $config['data'][0]['logo'] = $config['data'][0]['logo_url'];
                $config['data'][0]['logo_url'] = $domain . $config['data'][0]['logo_url'];
                $config['data'][0]['banner_url'] = $domain . $config['data'][0]['banner'];
            }
            return [$listBrand, count($data), $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataSetting(Request $request)
    {
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BRAND_GET_SETTING, $restaurantBrandID);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function updateLogo(Request $request)
    {
        $logo = $request->get('logo_url');
        $banner = $request->get('banner') ? $request->get('banner') : Session::get('SESSION_KEY_DATA_CURRENT_BRAND')['banner'];
        $id = $request->get('id');
        $description = $request->get('des') ? $request->get('des') : Session::get('SESSION_KEY_DATA_CURRENT_BRAND')['description'];
        $phone = $request->get('phone') ? $request->get('phone') : Session::get('SESSION_KEY_DATA_CURRENT_BRAND')['phone'];
        $website = $request->get('website') ? $request->get('website') : Session::get('SESSION_KEY_DATA_CURRENT_BRAND')['website'];
        $facebookPage = $request->get('facebook_page') ? $request->get('facebook_page') : Session::get('SESSION_KEY_DATA_CURRENT_BRAND')['facebook_page'];
        $name = $request->get('name') ? $request->get('name') : Session::get('SESSION_KEY_DATA_CURRENT_BRAND')['name'];
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BRAND_POST_UPDATE, $id);
        $body = [
            'name' => $name,
            'description' => $description,
            'logo_url' => $logo,
            'banner' => $banner,
            'phone' => $phone,
            'website' => $website,
            'facebook_page' => $facebookPage,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $config['data']['logo_url'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['logo_url'];
            $config['data']['phone'] = $phone;
            $dataBrand = Session::get(SESSION_KEY_DATA_BRAND);
            foreach ($dataBrand as $key => $db) {
                if ($db['id'] === (int)$id) {
                    $dataBrand[$key] = $config['data'];
                    Session::put(SESSION_KEY_DATA_BRAND, $dataBrand);
                }
            }
            if (Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['id'] === (int)$id) {
                Session::put(SESSION_KEY_DATA_CURRENT_BRAND, $config['data']);
                Session::put(SESSION_KEY_SETTING_CURRENT_BRAND, $config['data']['setting']);
            }
        }
        return $config;
    }

    public function updateBanner(Request $request)
    {
        $restaurantBrandID = $request->get('restaurant_id');
        $banner = $this->removeDomainMediaTemplate($request->get('banner'));
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BRAND_POST_UPDATE_BANNER, $restaurantBrandID);
        $body = [
            'name' => $request->get('name') ? $request->get('name') : Session::get('SESSION_KEY_DATA_CURRENT_BRAND')['name'],
            'banner' => $banner,
            'phone' => $request->get('phone') ? $request->get('phone') : Session::get('SESSION_KEY_DATA_CURRENT_BRAND')['phone'],
            'logo_url' => $request->get('logo_url') ? $request->get('logo_url') : Session::get('SESSION_KEY_DATA_CURRENT_BRAND')['logo_url'],
            'description' => $request->get('des') ? $request->get('des') : Session::get('SESSION_KEY_DATA_CURRENT_BRAND')['description']
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $config['data']['banner'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['banner'];
        try {
            $dataBrand = Session::get(SESSION_KEY_DATA_BRAND);
            foreach ($dataBrand as $key => $db) {
                if ($db['id'] === (int)$restaurantBrandID) {
                    $dataBrand[$key] = $config['data'];
                    Session::put(SESSION_KEY_DATA_BRAND, $dataBrand);
                }
            }
            if (Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['id'] === (int)$restaurantBrandID) {
                Session::put(SESSION_KEY_DATA_CURRENT_BRAND, $config['data']);
                Session::put(SESSION_KEY_SETTING_CURRENT_BRAND, $config['data']['setting']);
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataPriceService(Request $request)
    {
        $project_id = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BRAND_GET_CREATE_SERVICE_LEVELS_RESTAURANT);
        $body = null;
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $brand = $request->get('restaurant_brand_id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_GET_BRAND_POST_SETTING, $brand);
        $body = [
            "late_minute_allow_in_month" => $request->get('late_minute_allow_in_month'),
            "total_monthly_off_day" => $request->get('total_monthly_off_day'),
            "total_yearly_off_day" => $request->get('total_yearly_off_day'),
            "punish_working_day_in_minute" => $request->get('punish_working_day_in_minute'),
            "punish_not_checkout" => $request->get('punish_not_checkout'),
            "maximum_advance_salary_percent" => $request->get('maximum_advance_salary_percent'),
            "is_require_update_customer_slot_in_order" => $request->get('is_require_update_customer_slot_in_order'),
            "hour_to_take_report" => $request->get('hour_to_take_report'),
            "is_allow_print_temporary_bill" => $request->get('is_allow_print_temporary_bill'),
            "is_hide_total_amount_before_complete_bill" => $request->get('is_hide_total_amount_before_complete_bill'),
            "is_print_bill_logo" => $request->get('is_print_bill_logo'),
            "is_enable_membership_card" => $request->get('is_enable_membership_card'),
            "is_enable_booking" => $request->get('is_enable_booking'),
            "maximum_promotion_point_allow_use_in_each_bill" => $request->get('maximum_promotion_point_allow_use_in_each_bill'),
            "maximum_percent_order_amount_to_accumulate_point_allow_use_in_each_bill" => $request->get('percent_amount_to_accumulate_allow_use_in_each_bill'),
            "maximum_accumulate_point_allow_use_in_each_bill" => $request->get('maximum_accumulate_point_allow_use_in_each_bill'),
            "maximum_percent_order_amount_to_promotion_point_allow_use_in_each_bill" => $request->get('percent_amount_to_promotion_membership_card'),
            "maximum_percent_order_amount_to_alo_point_allow_use_in_each_bill" => $request->get('percent_amount_brand_alo_point'),
            "maximum_money_by_alo_point_allow_use_in_each_bill" => $request->get('alo_point_brand'),
            "zalo_oaid" => $request->get('zalo_oaid'),
            "sub_monitor_acknowledgements" => '',
//            "bank_name" => $request->get('bank_name'),
//            "bank_number" => $request->get('bank_number'),
//            "bin" => $request->get('bin'),
//            "account_name" => $request->get('account_name'),
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] == ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $dataBrand = Session::get(SESSION_KEY_DATA_BRAND);
            foreach ($dataBrand as $key => $db) {
                if ($db['id'] === $brand) {
                    $dataBrand[$key]['setting'] = $config['data'];
                    Session::put(SESSION_KEY_DATA_BRAND, $dataBrand);
                }
            }
            if (Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['id'] === (int)$brand) {
                $dataCurrentBrand = Session::get(SESSION_KEY_DATA_CURRENT_BRAND);
                $dataCurrentBrand['setting'] = $config['data'];
                Session::put(SESSION_KEY_DATA_CURRENT_BRAND, $dataCurrentBrand);
                Session::put(SESSION_KEY_SETTING_CURRENT_BRAND, $config['data']);
            }
        }
        return $config;
    }
}
