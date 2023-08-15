<?php

namespace App\Http\Controllers\Manage\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OutInventoryController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Xuất kho';
        return view('manage.inventory.in_inventory.index', compact('active_nav'));
    }
}
