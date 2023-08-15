<?php

namespace App\Http\Controllers\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Cookie;

use AuthenticatesUsers;
use Carbon\Exceptions\Exception;
use Jenssegers\Agent\Facades\Agent;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class notificationController extends Controller
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

    public function index(Request $request)
    {
        $deviceToken = $request->get('Token');
        $device_uid = "WebDashBoard_". $deviceToken;
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_AUTH_PUST_TOKEN_JAVA);
        $body = [
            "device_uid" => md5($device_uid),
            "push_token" => $deviceToken,
            "push_token_tms" => $deviceToken,
            "os_name" =>  "web",
            "app_type" => 4
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        dd($config);
        $minutes = 60;
        Session::put(SESSION_JAVA_TOKEN_NOTIFICATION, $deviceToken);
        Cookie::queue('KEY_TOKEN_NOTIFICATION', $deviceToken, $minutes);
        return [$config,$device_uid];
    }

    public function PushTokenLogout(Request $request)
    {
        $device_uid = "WebDashBoard_". Session::get(SESSION_JAVA_TOKEN_NOTIFICATION);
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH2');
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_AUTH_PUSh_TOKEN_LOGOUT_JAVA);
        $body = [
            'device_uid' => md5($device_uid),
            "app_type" => 4
        ];
        Cookie::queue(Cookie::forget('KEY_TOKEN_NOTIFICATION'));
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
