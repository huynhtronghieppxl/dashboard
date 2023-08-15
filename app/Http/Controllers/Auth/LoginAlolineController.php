<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Exception;

class LoginAlolineController extends Controller
{
    public function postLogin(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        return $this->getSession($username, $password);
    }

    public function getSession($username, $password)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_AUTH_GET_SESSIONS_JAVA);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project , $method, $api, $body);
        Session::put(SESSION_JAVA_KEY_SESSION, $config['data']);
        return $this->getConfig($username, $password);
    }

    public function getConfig($username, $password)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_AUTH_GET_CONFIG, '', Config::get('app.PROJECT_ID_ALOLINE'));
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            Session::put('SESSION_JAVA_KEY_TOKEN_OAUTH_ALOLINE', $config['data']['api_key']);
            return $this->doLogin($username, $password);
        } catch (Exception $e) {
            return [$config, $e->getLine(), 'getConfigs'];
        }
    }

    public function doLogin($username, $password)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH_ALOLINE');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_AUTH_POST_LOGIN_ALO_LINE;
        $body = [
            'username' => $username,
            'password' => base64_encode($password),
            "device_uid" => time(),
            "app_type" => 2
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] !== 200) {
                return [$config, 'doLogin'];
            }
            $data = Session::get(SESSION_KEY_DATA_RESTAURANT);
            $data['customer_partner_node_access_token'] = $config['data']['jwt_token'];
            Session::put(SESSION_KEY_DATA_RESTAURANT, $data);
            Session::put(SESSION_KEY_DATA_ALOLINE_CUSTOMER, $config['data']);
            return $this->assign($config['data']['id']);
        } catch (Exception $e) {
            return [$config, $e->getLine(), 'doLogin'];
        }
    }

    public function assign($id)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_AUTH_POST_LOGIN_ALOLINE_RESTAURANT;
        $body = [
            'customer_id' => $id,
            'customer_partner_node_access_token' => Session::get(SESSION_KEY_DATA_RESTAURANT)['customer_partner_node_access_token'],
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            return [$config];
        } catch (Exception $e) {
            return [$config, $e->getLine(), 'assign'];
        }
    }
}
