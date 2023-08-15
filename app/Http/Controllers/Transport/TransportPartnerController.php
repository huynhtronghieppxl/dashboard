<?php

namespace App\Http\Controllers\Transport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransportPartnerController extends Controller
{
    public function index()
    {
        $active_nav = 'transport.partner';
        return view('transport.partner.index', compact('active_nav'));
    }
}
