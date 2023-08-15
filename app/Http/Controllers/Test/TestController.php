<?php

namespace App\Http\Controllers\Test;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
//        $time_before1 = microtime(true);
//        $client = new Client([
//            'headers' => [
//                'Accept' => 'application/json',
//                'Authorization' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0eXBlX3VzZXIiOjIsInVzZXJuYW1lIjoidHIwMDAwMTYiLCJwYXNzd29yZCI6IjAwMDAiLCJ1c2VyX2lkIjoxOTE1LCJyZXN0YXVyYW50X2lkIjo3MSwiaWF0IjoxNjU3MTU0NzQ2fQ.EfF_rc1oV-RjyYynMi6jbnEsyBKtl0CX-UkWvBcoM5A',
//                'Content-Type' => 'application/json',
//            ],
//        ]);
//        $request = $client->request('post', 'http://172.16.2.243:8092/api/queues', [
//            'json' => [
//                "request_url" => "/api/report/order/material-branch",
//                "project_id" => 1486,
//                "http_method" => 0,
//                "is_production_mode" => "0",
//                "os_name"=>"dashboard_tms",
//                "params" => [
//                    "branch_id" => "468",
//                    "from" => "01\/07\/2022",
//                    "to"=> "06\/07\/2022",
//                    "type"=> "1",
//                    "is_force_online"=> 1
//                ]
//            ]
//        ]);
//
//        $time_after= microtime(true);
//        $time_before2 = microtime(true);
//        Http::withOptions([
//            'base_uri1' => 'http://techres.ddns.net:8092/api/queues Body:{"request_url":"\/api\/report\/order\/material-branch","project_id":1486,"http_method":0,"is_production_mode":"0","os_name":"dashboard_tms","params":{"branch_id":"468","from":"01\/07\/2022","to":"06\/07\/2022","type":"1","is_force_online":1}}',
//            'base_uri2' => 'https://thongtindoanhnghiep.co/api/company?r=5',
//            'base_uri3' => 'https://thongtindoanhnghiep.co/api/company?r=5',
//            'base_uri4' => 'https://thongtindoanhnghiep.co/api/company?r=5',
//
//        ]);
//        dd($time_after - $time_before1, microtime(true) - $time_before2);

        $active_nav = '';
        return view('test.index', compact('active_nav'));
    }

    public function callApi()
    {

    }
}
