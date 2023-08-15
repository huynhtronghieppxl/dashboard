<?php

namespace App\Http\Controllers\Transport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransportSettingController extends Controller
{
    public function index()
    {
        $active_nav = 'transport.setting';
        return view('transport.setting.index', compact('active_nav'));
    }
}
