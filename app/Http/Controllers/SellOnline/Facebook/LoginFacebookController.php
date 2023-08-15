<?php

namespace App\Http\Controllers\SellOnline\Facebook;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LoginFacebookController extends Controller
{
    function index()
    {
        $active_nav = 'DASHBOARD FACEBOOK';
        if (Session::get(SESSION_KEY_SESSION_USER_FACEBOOK)) {
            return view('sell_online.facebook.connect.manage_page', compact('active_nav'));
        } else {
            return view('sell_online.facebook.auth.login', compact('active_nav'));
        }
    }
}
