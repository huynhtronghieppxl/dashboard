<?php

namespace App\Http\Controllers\Help;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index()
    {
        $active_nav = 'Hỗ trợ';
        return view('help.index', compact('active_nav'));
    }
    public function level1()
    {
        $active_nav = 'Hỗ trợ';
        return view('help.level1_detail', compact('active_nav'));
    }
    public function level2()
    {
        $active_nav = 'Hỗ trợ';
        return view('help.level2_detail', compact('active_nav'));
    }
    public function level3()
    {
        $active_nav = 'Hỗ trợ';
        return view('help.level3_detail', compact('active_nav'));
    }
    public function question()
    {
        $active_nav = 'Hỗ trợ';
        return view('help.question_more', compact('active_nav'));
    }
    public function manipulation()
    {
        $active_nav = 'Hỗ trợ';
        return view('help.manipulation_more', compact('active_nav'));
    }
}
