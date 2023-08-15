<?php

namespace App\Http\Controllers\Marketing\Promotion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Chương trình khuyến mãi';
        return view('marketing.promotion.index', compact('active_nav'));
    }
}
