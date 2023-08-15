<?php

namespace App\Http\Controllers\report\work_history_report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkHistoryReportController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'SALE_REPORT', 'CASHIER_ACCESS', 'BUSINESS_ACTIVE_REPORT']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(0);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Chốt ca thu ngân';
        return view('report.work_history_report.index', compact('active_nav'));
    }
}
