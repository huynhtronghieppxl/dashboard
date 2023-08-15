<?php

namespace App\Http\Controllers\Transport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransportReportController extends Controller
{
    public function index()
    {
        $active_nav = 'transport.report';
        return view('transport.report.index', compact('active_nav'));
    }
}
