<?php

namespace App\Http\Controllers\Component;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ComponentController extends Controller
{
    public function data_table_length(Request $request)
    {
        $data_table_length = $request->get('length_table');
        Session::put(SESSION_KEY_LENGTH_DATA_TABLE, $data_table_length);
        View::share('data_table_length', $data_table_length);
        return $data_table_length;
    }
}
