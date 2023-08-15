<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeSalaryReportController extends Controller
{
    public function index(){
        $active_nav = '';
        return view('report.employee_salary.index', compact('active_nav'));
    }
}
