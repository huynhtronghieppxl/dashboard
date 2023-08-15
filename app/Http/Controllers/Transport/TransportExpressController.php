<?php

namespace App\Http\Controllers\Transport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransportExpressController extends Controller
{
    public function index()
    {
        $active_nav = 'transport.express';
        return view('transport.express.index', compact('active_nav'));
    }
}
