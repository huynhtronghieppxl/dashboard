<?php

namespace App\Http\Controllers\SellOnline\Facebook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LiveStreamFacebookController extends Controller
{
    //
    function index()
    {
         $active_nav = 'live-stream-facebook.index';
        return view('sell_online.facebook.livestream', compact('active_nav'));
    }
}
