<?php

namespace App\Http\Controllers\UpgradePackage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpgradePackageController extends Controller
{
    public function index()
    {
        $active_nav = 'Nâng Cấp Gói';
        return view('upgrade_package.index', compact('active_nav'));
    }
}
