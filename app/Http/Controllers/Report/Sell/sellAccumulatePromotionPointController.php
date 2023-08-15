<?php

namespace App\Http\Controllers\Report\Sell;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class sellAccumulatePromotionPointController extends Controller
{
    public function index (Request $request)
    {
        $active_nav = 'Báo Cáo Điểm Tích luỹ';
        return view('report.sell.promotion_point.index', compact('active_nav'));
    }

    public function dataSurchargeReport (Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_PROMOTION_POINT, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
