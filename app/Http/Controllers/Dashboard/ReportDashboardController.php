<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportDashboardController extends Controller
{
    public function index()
    {
        $active_nav = 'Báo cáo';
        return view('dashboard.report.index', compact('active_nav'));
    }
}
