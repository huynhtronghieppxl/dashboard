<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;

class ProfileController extends Controller
{
    public function index()
    {
        $active_nav = 'Thông tin tài khoản';
        return view('setting.profile.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $id = Session::get(SESSION_JAVA_ACCOUNT)['id'];
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_LIST_EMPLOYEE_SALARY_ADDITION_GET_PROFILE_BY_ID, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $config['data']['url_avatar'] = $config['data']['avatar'];
            $config['data']['avatar'] = $domain . $config['data']['avatar'];
            return $config['data'];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function changeProfile(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $phone_number = $request->get('phone_number');
        $gender = $request->get('gender');
        $place_birth = $request->get('place_birth');
        $birthday = sprintf($request->get('birthday'));
        $avatar = $request->get('avatar');
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $id = Session::get(SESSION_JAVA_ACCOUNT)['id'];
        $chat_token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
        $ward_id = $request->get('ward_id');
        $district_id = $request->get('district_id');
        $city_id = $request->get('city_id');
        $address = $request->get('address');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_PROFILE_POST_UPDATE, $id);
        $body = [
            "full_name" => $name,
            "birthday" => $birthday,
            "birth_place" => sprintf($place_birth),
            "gender" => $gender,
            "phone" => sprintf($phone_number),
            "address" => sprintf($address),
            "avatar" => sprintf($avatar),
            'email' => sprintf($email),
            'ward_id' => $ward_id,
            'city_id' => $city_id,
            'district_id' => $district_id,
            'node_access_token' => $chat_token
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if($config['status'] ===  (int)Config::get('constants.type.status.STATUS_SUCCESS')){
            $dataSesstion = Session::get(SESSION_JAVA_ACCOUNT);
            $dataSesstion['avatar'] = $avatar;
            $dataSesstion['name'] = $name;
            $dataSesstion['gender'] = $gender;
            $dataSesstion['birthplace'] = $place_birth;
            $dataSesstion['phone'] = $phone_number;
            $dataSesstion['address'] = $address;
            $dataSesstion['email'] = $email;
            $dataSesstion['avatar'] = $avatar;
            Session::put(SESSION_JAVA_ACCOUNT,$dataSesstion);
            $config['data']['avatar'] = $domain . $config['data']['avatar'];
            return $config;
        }else{
            return $config;
        }
    }

    public function updatePassword(Request $request)
    {
        $old_password = base64_encode($request->get('old_password'));
        $new_password = base64_encode($request->get('new_password'));
        $chat_token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
        $id = Session::get(SESSION_JAVA_ACCOUNT)['id'];
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_AUTH_POST_CHANGE_PASSWORD, $id);
        $body = [
            "old_password" => $old_password,
            "new_password" => $new_password,
            'node_access_token' => $chat_token
        ] ;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
