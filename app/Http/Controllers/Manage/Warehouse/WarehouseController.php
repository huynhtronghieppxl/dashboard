<?php

namespace App\Http\Controllers\Manage\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(){
        $active_nav = 'Gán kho chi nhánh';
        return view('manage.warehouse.assign.index', compact('active_nav'));
    }
}
