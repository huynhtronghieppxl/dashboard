<?php

namespace App\Http\Controllers\Manage\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class supplierOrderController extends Controller
{
    public function index()
    {
        $active_nav = 'Mua hàng NCC';
        return view('manage.warehouse.supplier_order.index', compact('active_nav'));
    }
}
