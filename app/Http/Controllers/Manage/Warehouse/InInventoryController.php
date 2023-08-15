<?php

namespace App\Http\Controllers\Manage\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InInventoryController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Nhập kho';
        return view('manage.inventory.in_inventory.index', compact('active_nav'));
    }
}
