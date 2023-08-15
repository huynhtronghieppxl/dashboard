<?php

namespace App\Http\Controllers\TestChat;

use App\Http\Controllers\Controller;

class TestChatController extends Controller
{
    public function  index(){
        $active_nav = '';
        return view('test_chat.index', compact('active_nav'));
    }
    public function  search(){
        $active_nav = '';
        return view('test_chat.search', compact('active_nav'));
    }
    public function data()
    {
        $data = array([
            [
               'id' => 1,
               'name' => 'Nhóm',
                'category'=> 1,
                'image' => 'https://upload.wikimedia.org/wikipedia/en/9/90/Pb_bagwell.png'
            ],
            [
                'id' => 5674,
                'name' => 'Nhóm',
                'category'=> 1,
                'image' => 'https://upload.wikimedia.org/wikipedia/en/9/90/Pb_bagwell.png'
            ],
            [
                'id' => 3,
                'name' => 'Nhóm',
                'category'=> 1,
                'image' => 'https://upload.wikimedia.org/wikipedia/en/9/90/Pb_bagwell.png'
            ],
            [
                'id' => 4,
                'name' => 'Cá nhân',
                'category'=> 2,
                'image' => 'https://upload.wikimedia.org/wikipedia/en/9/90/Pb_bagwell.png'
            ],
            [
                'id' => 5,
                'name' => 'Cá nhân',
                'category'=> 2,
                'image' => 'https://upload.wikimedia.org/wikipedia/en/9/90/Pb_bagwell.png'
            ],
            [
                'id' => 789,
                'name' => 'Cá nhân',
                'category'=> 2,
                'image' => 'https://upload.wikimedia.org/wikipedia/en/9/90/Pb_bagwell.png'
            ],
            [
                'id' => 56657,
                'name' => 'Nhà cung cấp',
                'category'=> 3,
                'image' => 'https://upload.wikimedia.org/wikipedia/en/9/90/Pb_bagwell.png'
            ],
            [
                'id' => 567,
                'name' => 'Nhà cung cấp',
                'category'=> 3,
                'image' => 'https://upload.wikimedia.org/wikipedia/en/9/90/Pb_bagwell.png'
            ],
            [
                'id' => 567,
                'name' => 'Nhà cung cấp',
                'category'=> 3,
                'image' => 'https://upload.wikimedia.org/wikipedia/en/9/90/Pb_bagwell.png'
            ],
            [
                'id' => 5674,
                'name' => 'Nhóm',
                'category'=> 1,
                'image' => 'https://upload.wikimedia.org/wikipedia/en/9/90/Pb_bagwell.png'
            ],
            [
                'id' => 56745,
                'name' => 'Cá nhân',
                'category'=> 2,
                'image' => 'https://upload.wikimedia.org/wikipedia/en/9/90/Pb_bagwell.png'
            ],

        ]);
        try{
            $collect = collect($data[0]);
            $data_group = array_values($collect->where('category', 1)->toArray());
            $data_suplier = array_values($collect->where('category', 2)->toArray());
            $data_persion = array_values($collect->where('category', 3)->toArray());
            return [$data_group, $data_suplier, $data_persion];
        }catch(Exception $e){
            return $e;
        }
    }
}
