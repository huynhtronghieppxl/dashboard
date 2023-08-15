<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use AuthenticatesUsers;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class ForgotPasswordController extends Controller
{

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            try {
                session_start();
            } catch (\ErrorException $e) {

            }
        }
        $this->middleware('guest')->except('logout');
    }

    public function getSession($restaurant_name, $username, $password, $token)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_AUTH_GET_SESSIONS_JAVA);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project , $method, $api, $body);
        Session::put(SESSION_JAVA_KEY_SESSION, $config['data']);
        return $this->getConfigs($restaurant_name, $username, $password, $token);
    }

    public function getConfigs($restaurant_name)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_AUTH_GET_CONFIG, $restaurant_name, Config::get('app.PROJECT_ID'));
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] !== (int)Config::get('constants.type.status.STATUS_SUCCESS')) {
                Session::put(SESSION_KEY_CONFIG, '');
                Session::put(SESSION_NODE_DOMAIN, '');
                Session::put(SESSION_JAVA_DOMAIN, '');
                Session::put(SESSION_NODE_KEY_BASE_URL_ADS, '');
                Session::put(SESSION_JAVA_TOKEN_OAUTH, '');
            } else {
                $data = $config['data'];
                Session::put(SESSION_KEY_CONFIG, $data);
                Session::put(SESSION_NODE_DOMAIN, $data['chat_domain']);
                Session::put(SESSION_JAVA_DOMAIN, $data['api_domain']);
                Session::put(SESSION_NODE_KEY_BASE_URL_ADS, $data['ads_domain']);
                Session::put(SESSION_JAVA_TOKEN_OAUTH, $data['api_key']);
            }
            return $config;
        } catch (Exception $e) {
            return [$config, $e, 'getConfigs'];
        }
    }

    public function forgotPassword(Request $request)
    {
        $getSession = $this->getSession($request->get('restaurant'), $request->get('username'), '', '');
        $configGet = $getSession;
        if($configGet['status'] === (int)Config::get('constants.type.status.STATUS_SUCCESS')){
            $username = $request->get('username');
            $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH');
            $method = Config::get('constants.GATEWAY.METHOD.POST');
            $api = API_AUTH_POST_FORGOT_PASSWORD;
            $body = [
                'username' => $username
            ];
            return $this->callApiGatewayTemplate2($project, $method, $api, $body);
        }else{
            return $configGet;
        }
    }

    public function verifyCode (Request $request)
    {
        $restaurant_name = $request->get('restaurant_name');
        $use_name = $request->get('use_name');
        $code = $request->get('code');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_POST_VERIFY_CODE;
        $body = [
            "restaurant_name" => $restaurant_name,
            "user_name" => $use_name,
            "verify_code" => $code,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function changePassword(Request $request)
    {
        $username = $request->get('username');
        $verify_code = $request->get('code');
        $password = $request->get('password');
        $node_access_token = $request->get('access_token');
        $device_uid = "WebDashBoard_". Session::get(SESSION_JAVA_TOKEN_NOTIFICATION);
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_AUTH_POST_VERIFY_CHANGE_PASSWORD;
        $body = [
            "username" => $username,
            "verify_code" => $verify_code,
            "new_password" =>base64_encode($password),
            "node_access_token" => $node_access_token,
            "device_uid" => md5($device_uid),
            "app_type" => 4,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
