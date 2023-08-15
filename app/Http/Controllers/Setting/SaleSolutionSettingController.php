<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class SaleSolutionSettingController extends Controller
{
    public function index()
    {
        $active_nav = 'Công ty/Nhà hàng';
        return view('setting.sale_solution.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $method = ENUM_METHOD_GET;
        $project = ENUM_PROJECT_ID_ORDER;
        $api = sprintf(API_SALE_SOLUTION_SETTING_RESTAURANT);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function dataRestaurant(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $data = Session::get(SESSION_KEY_DATA_RESTAURANT);
        $dataLevel = Session::get(SESSION_KEY_DATA_SETTING);
        $data_setting = Session::get(SESSION_KEY_SETTING_RESTAURANT);
        $logo = ($data['logo'] == '' || $data['logo'] == null) ? '../images/banner_default.jpg' : $domain . $data['logo'];
        $banner = ($data['banner'] == '' || $data['banner'] == null) ? '../images/banner_default.jpg' : $domain . $data['banner'];
        $data_profile = [
            'data' => $data,
            'logo' => $logo,
            'banner' => $banner,
        ];
        return [$data_profile, $data_setting, $dataLevel];
    }


    public function updateSetting(Request $request)
    {
        try {
            $username_prefix = $request->get('username_prefix');
            $number_minute_allow_booking_before_open_order = $request->get('number_minute_allow_booking_before_open_order');
            $hour_to_take_report = $request->get('hour_to_take_report');
            $is_allow_print_temporary_bill = $request->get('is_allow_print_temporary_bill');
            $is_enable_booking = $request->get('is_enable_booking');
            $is_print_bill_logo = $request->get('is_print_bill_logo');
            $is_enable_fish_bowl = $request->get('is_enable_fish_bowl');
            $is_enable_STAMP = $request->get('is_enable_STAMP');
            $is_have_wifi = $request->get('is_have_wifi');
            $wifi_name = $request->get('wifi_name');
            $wifi_password = $request->get('wifi_password');
            $is_hide_total_amount_before_complete_bill = $request->get('is_hide_total_amount_before_complete_bill');
            $project = ENUM_PROJECT_ID_ORDER;
            $method = ENUM_METHOD_POST;
            $api = API_SALE_SOLUTION_SETTING_RESTAURANT_UPDATE;
            $body = [
                "username_prefix" => $username_prefix,
                "number_minute_allow_booking_before_open_order" => $number_minute_allow_booking_before_open_order,
                "hour_to_take_report" => $hour_to_take_report,
                "is_allow_print_temporary_bill" => $is_allow_print_temporary_bill,
                "is_enable_booking" => $is_enable_booking,
                "is_print_bill_logo" => $is_print_bill_logo,
                "is_enable_STAMP" => $is_enable_STAMP,
                "is_hide_total_amount_before_complete_bill" => $is_hide_total_amount_before_complete_bill,
                "is_enable_fish_bowl" => $is_enable_fish_bowl,
                "serve_time" => $request->get('serve_time'),
                "is_have_wifi" => $is_have_wifi,
                "wifi_name" => $wifi_name,
                "wifi_password" => $wifi_password
            ];
            $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
            Session::put(SESSION_KEY_SETTING_RESTAURANT, $config['data']);
            return $config;
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $chat_token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
        $name = $request->get('name') ? $request->get('name') : Session::get('SESSION_KEY_DATA_RESTAURANT')['name'] ;
        $email = $request->get('email') ? $request->get('email') : Session::get('SESSION_KEY_DATA_RESTAURANT')['email'];
        $info = $request->get('info') ? $request->get('info') : Session::get('SESSION_KEY_DATA_RESTAURANT')['info'];
        $address = $request->get('address') ? $request->get('address') : Session::get('SESSION_KEY_DATA_RESTAURANT')['address'];
        $phone = $request->get('phone') ? $request->get('phone') : Session::get('SESSION_KEY_DATA_RESTAURANT')['phone'];
        $logo = $request->get('logo') ? $request->get('logo') : Session::get('SESSION_KEY_DATA_RESTAURANT')['logo'];
        $domain = $request->get('domain') ? $request->get('domain') : Session::get('SESSION_KEY_DATA_RESTAURANT')['domain'];
        $banner = $request->get('banner') ? $request->get('banner') : Session::get('SESSION_KEY_DATA_RESTAURANT')['banner'];
        $project = ENUM_PROJECT_ID_ORDER_VERSION;
        $method = ENUM_METHOD_POST;
        $api = API_SETTING_RESTAURANT_POST_UPDATE_LOGO_SALE_SOLUTION;
        $body = [
            'name' => $name,
            'email' => $email,
            'info' => $info,
            'logo' => $logo,
            'address' => $address,
            'domain' => $domain,
            'phone' => $phone,
            'banner' => $banner,
            'node_access_token' => $chat_token
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $config['data']['url_banner'] = $domain . $config['data']['banner'];
            $config['data']['url_logo'] = $domain . $config['data']['logo'];
            Session::put(SESSION_KEY_DATA_RESTAURANT, $config['data']);
        }
        return $config;
    }
}
