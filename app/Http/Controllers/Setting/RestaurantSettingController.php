<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class RestaurantSettingController extends Controller
{
    public function index()
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(0);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Công ty/Nhà hàng';
        return view('setting.restaurant.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $data = Session::get(SESSION_KEY_DATA_RESTAURANT);
        $dataLevel = Session::get(SESSION_KEY_DATA_SETTING);
        $logo = ($data['logo'] == '' || $data['logo'] == null) ? '../images/banner_default.jpg' : $domain . $data['logo'];
        $banner = ($data['banner'] == '' || $data['banner'] == null) ? '../images/banner_default.jpg' : $domain . $data['banner'];
        $data_profile = [
            'data' => $data,
            'logo' => $logo,
            'banner' => $banner,
        ];
        $data = Session::get(SESSION_KEY_SETTING_RESTAURANT);
        return [$data_profile, $data, $dataLevel];
    }

    public function update(Request $request)
    {
        $chat_token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
        $name = $request->get('name') ? $request->get('name') : Session::get('SESSION_KEY_DATA_RESTAURANT')['name'];
        $address = $request->get('address') ? $request->get('address') : Session::get('SESSION_KEY_DATA_RESTAURANT')['address'];
        $email = $request->get('email') ? $request->get('email') : Session::get('SESSION_KEY_DATA_RESTAURANT')['email'];
        $info = $request->get('info') ? $request->get('info') : Session::get('SESSION_KEY_DATA_RESTAURANT')['info'];
        $logo = $request->get('logo');
        $phone = $request->get('phone') ? $request->get('phone') : Session::get('SESSION_KEY_DATA_RESTAURANT')['phone'];
        $domain = $request->get('domain') ? $request->get('domain') : Session::get('SESSION_KEY_DATA_RESTAURANT')['domain'];
        $banner = $request->get('banner') ? $request->get('banner') : Session::get('SESSION_KEY_DATA_RESTAURANT')['banner'];
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_SETTING_RESTAURANT_POST_INFO_SETTING_UPDATE, $name, $email, $info, $logo, $domain);
        $body = [
            'name' => $name,
            'email' => $email,
            'info' => $info,
            'logo' => $logo,
            'domain' => $domain,
            'address' => $address,
            'banner' => $banner,
            'phone' => $phone,
            'node_access_token' => $chat_token
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS){
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            if($config['data'] != null)
                $config['data']['url_banner'] = $domain . $config['data']['banner'];
            $config['data']['url_logo'] = $domain . $config['data']['logo'];
            Session::put(SESSION_KEY_DATA_RESTAURANT, $config['data']);
        }
        return $config;
    }

    public function updateSetting(Request $request)
    {
        try {
            $min_check_in = $request->get('min_distance_checkin');
            $is_enable_kai_zen_bonus_level = $request->get('is_enable_kai_zen_bonus_level');
            $restaurant = Session::get(SESSION_RESTAURANT);
            $number_minute_allow_booking_before_open_order = $request->get('number_minute_allow_booking_before_open_order');
            $minute_after_register_member_ship_card_allow_to_use_promotion_point = $request->get('minute_after_register_member_ship_card_allow_to_use_promotion_point');
            $username_prefix = $request->get('username_prefix');
            $number_day_not_checkin = $request->get('number_day_not_checkin');
            $number_day_quit_job = $request->get('number_day_quit_job');
            $number_month_leave_day = $request->get('number_month_leave_day');
            $point_invite_customer = $request->get('point_invite_customer');
            $is_enable_membership_card = ($request->get('is_enable_membership_card'));
            $is_share_customer_on_app_party = $request->get('is_share_customer_on_app_party');
            $one_point_invite_customer_register_membership_to_money_amount = $request->get('one_point_invite_customer_register_membership_to_money_amount');
            if ($point_invite_customer === null) $point_invite_customer = 0;
            $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
            $method = Config::get('constants.GATEWAY.METHOD.POST');
            $api = sprintf(API_SETTING_RESTAURANT_GET_POST, $restaurant);
            $body = [
                "username_prefix" => $username_prefix,
                "number_day_not_checkin_to_lock_account" => $number_day_not_checkin,
                "number_day_not_checkin_to_quit_job" => $number_day_quit_job,
                "number_month_after_start_working_for_bonus_leave_day" => $number_month_leave_day,
                "point_bonus_for_employee_when_invite_customer_register_membership" => $point_invite_customer, // Nhỏ nhất là 1
                "is_enable_membership_card" => $is_enable_membership_card, // Thẻ thành viên
                "is_share_customer_on_app_party" => $is_share_customer_on_app_party,
                "number_minute_allow_booking_before_open_order" => $number_minute_allow_booking_before_open_order,
                "minute_atfer_register_membershipcard_allow_to_use_promotion_point" => $minute_after_register_member_ship_card_allow_to_use_promotion_point,
                "one_point_invite_customer_register_membership_to_money_amount" => $one_point_invite_customer_register_membership_to_money_amount,
                "min_distance_checkin" => $min_check_in,
                "is_enable_kaizen_bonus_level" => $is_enable_kai_zen_bonus_level, // Chưa có
//                "is_enable_tms" =>  1, // Mới thêm
//                "minimum_order_amount_to_claim_bonus_from_booking" => 1 // mới thêm
            ];
            $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
            if($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS){
                Session::put(SESSION_KEY_SETTING_RESTAURANT, $config['data']);
                $is_enable_membership_card_new =  Session::get(SESSION_KEY_DATA_BRAND);
                foreach ($is_enable_membership_card_new as $key => $db) {
                    $is_enable_membership_card_new[$key]['setting']['is_enable_membership_card'] = $is_enable_membership_card;
                }
                Session::put(SESSION_KEY_DATA_BRAND,$is_enable_membership_card_new);
            }
            return $config;
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function settingMemberShipCard(Request $request)
    {
        $condition = $request->get('condition');
        $policy = $request->get('policy');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MEMBERSHIP_CARD_POST_DATA_SETTING);
        $body = [
            'use_guide' => $condition,
            'policy' => $policy,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
