<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class GameMarketingController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'marketing.game';
        return view('marketing.game.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $data = [
            [
                'name' => 'Game Mèo',
                'description' => 'Là game Mèo đó trời !',
                'avatar' => 'http://ads.api.techres.vn:3002/public/resource/TMS/MEDIA_TECHRES/undefined/undefined/undefined/2021/5/21-5-2021/image/original/media_Techres-21-5-2021-1621592534695-1609865185_720_Chia-se-100-hinh-nen-game-Full-HD-dep-sieu.jpg',
            ],
            [
                'name' => 'Game Chó',
                'description' => 'Là game Chó đó trời !',
                'avatar' => 'http://ads.api.techres.vn:3002/public/resource/TMS/MEDIA_TECHRES/undefined/undefined/undefined/2021/5/21-5-2021/image/original/media_Techres-21-5-2021-1621592542456--15858268775371005038247.jpg',
            ],
            [
                'name' => 'Game Bò',
                'description' => 'Là game Bò đó trời !',
                'avatar' => 'http://ads.api.techres.vn:3002/public/resource/TMS/MEDIA_TECHRES/undefined/undefined/undefined/2021/5/21-5-2021/image/original/media_Techres-21-5-2021-1621592549742-uxeic7j4zcpjAF2kg3JgNU-970-80.jpg',
            ],
        ];
        $data_table = DataTables::of($data)
            ->addColumn('avatar', function ($row) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $row['avatar'] . '" style="width:300px;height:180px" onclick="modalImageComponent(' . "'" . $row['avatar'] . "'" . ')"/>';
            })
            ->addColumn('action', function () {
                return '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary waves-effect waves-light" title="" onclick=""><span class="icofont icofont-eye-alt"></span></button>
                            </div>';
            })
            ->rawColumns(['avatar','action'])
            ->addIndexColumn()
            ->make(true);
        $data_total = [
            'total_tab1' => count($data),
            'total_tab2' => count($data),
        ];
        return [$data_table, $data_table, $data_total];
    }
}
