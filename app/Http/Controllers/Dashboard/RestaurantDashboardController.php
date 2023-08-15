<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class
RestaurantDashboardController extends Controller
{
    public function index()
    {
        $active_nav = 'dashboard.restaurant';
        return view('dashboard.restaurant.index', compact('active_nav'));
    }

    public function dataRealProfitReport(Request $request)
    {
        $brand = $request->get('brand');
        $type = $request->get('type');
        $time = $request->get('time');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_COMPANY_PROFIT_V2, $brand, $type, $time);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = [
                'list' => $config['data']['list'],
                'total_profit' => $this->numberFormat($config['data']['total_profit']),
            ];
            return [$data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    } //done

    public function dataSupplierReport(Request $request)
    {
        $brand = 71;
        $branch = 468;
        $type = $request->get('type');
        $time = $request->get('time');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_AREA, $brand, $branch, $type, $time);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $data_chart = [];
            foreach ($data as $db) {
                array_push($data_chart, [
                    "timeline" => $db['area_name'],
                    "label" => $db['area_name'],
                    "value" => $db['revenue']
                ]);
            }
            $total = [
                'total' => $this->numberFormat(array_sum(array_column($data, 'revenue'))),
                'length' => count($data)
            ];
            return [$data_chart, $total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
