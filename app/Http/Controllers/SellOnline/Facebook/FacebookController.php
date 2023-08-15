<?php

namespace App\Http\Controllers\SellOnline\Facebook;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function index()
    {
        return Socialite::driver('facebook')
            ->scopes(['public_profile', 'pages_show_list', 'email'])
            ->asPopup()
            ->redirect();
    }

    public function callBack()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $img = $user->avatar . "&access_token=" . $user->token;
        $user->avatar = $img;
        Session::put(SESSION_KEY_SESSION_USER_FACEBOOK, $user);
        return redirect()->route('sell_online.facebook.facebook-auth.index');
    }

    public function managePage()
    {
        $active_nav = 'QUẢN LÝ TRANG';
        return view('sell_online.facebook.connect.manage_page', compact('active_nav'));
    }
}
