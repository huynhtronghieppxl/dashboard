<?php

namespace App\Http\Controllers\Transport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class TransportDashboardController extends Controller
{
    public function index()
    {
        $active_nav = 'transport.dashboard';
        return view('transport.dashboard.index', compact('active_nav'));
    }

    public function dataOrderComplete(Request $request)
    {
        $data_chart = [];
        for ($i = 0; $i < 31; $i++) {
            array_push($data_chart, [
                'timeline' => $i,
                'data1' => rand(1, 100),
                'data2' => rand(1, 100),
                'data3' => rand(1, 100),
            ]);
        }
        return [$data_chart];
//        $brand = $request->get('brand');
//        $branch = $request->get('branch');
//        $type = $request->get('type');
//        $time = $request->get('time');
//        $project = Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE');
//        $method = Config::get('constants.GATEWAY.METHOD.GET');
//        $convert_api = $this->convertApiTemplate(sprintf(Config::get('constants.api_node.API_GET_REVENUE_COST_PROFIT_REPORT'), $brand, $branch, $type, $time));
//        $api = $convert_api[0];
//        $params = $convert_api[1];
//        $body = null;
//        $config = $this->callApiGatewayTemplate($project, $method, $api, $params, $body);
//        try {
//        $data_chart = [];
//        foreach ($config['data']['list'] as $db) {
//            array_push($data_chart1, [
//                'timeline' => $db['index'],
//                'data1' => $db['estimate_revenue'],
//                'data2' => $db['estimate_profit'],
//                'data3' => $db['estimate_cost']
//            ]);
//        }
//        return [$data_chart, $config];
//        } catch (Exception $e) {
//            return $this->catchTemplate($config, $e);
//        }
    }
}
