<?php

namespace App\Http\Controllers\Sell_Online\Zalo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Zalo\Zalo;

class ZaloController extends Controller
{
    public function index(Request $request)
    {
        $config = array(
            'app_id' => '1234567890987654321',
            'app_secret' => 'AbC123456XyZ',
            'callback_url' => 'https://www.callback.com'
        );
        $zalo = new Zalo($config);
        $helper = $zalo -> getRedirectLoginHelper();
        $callbackUrl = "https://www.callbackack.com";
        $loginUrl = $helper->getLoginUrl($callBackUrl);


        $config = array(
            'app_id' => env('APP_ID_ZALO'),
            'app_secret' => env('APP_SECRET_ZALO'),
            'callback_url' => 'https://www.callback.com'
        );
        $zalo = new Zalo($config);
        $helper = $zalo->getRedirectLoginHelper();
        $callbackUrl = "http://beta.dashboard.techres.vn/zalo/callback";
        $loginUrl = $helper->getLoginUrl($callbackUrl);
        $accessToken = $helper->getAccessToken($callbackUrl);
        return $loginUrl;
    }
}
