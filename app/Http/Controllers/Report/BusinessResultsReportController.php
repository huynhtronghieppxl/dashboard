<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;

class BusinessResultsReportController extends Controller
{
    public function index(Request $request)
    {

        $active_nav = 'Kết quả kinh doanh';
        return view('report.business_results.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_REVENUE_PROFIT_BUSINESS_RESULT, $brand, $branch, $type, $time);
        $body = null;
        $config_1 = $this->callApiGatewayTemplate2($project, $method, $api, $body);

        $status = ENUM_GET_ALL;
        $is_cost = ENUM_STATUS_GET_ACTIVE;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_REASON, $status, $is_cost);
        $body = null;
        $config_2 = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $dataReasonType = [];
            $dataChartRevenue = [];
            $dataChartProfit = [];

            foreach ($config_1['data']['list'] as $key => $db) {
                $dataChartRevenue[] = [
                    "timeline" => $this->covertTimeReport($db['report_time'], $type, $key),
                    "value" => $db['total_revenue_amount']
                ];
                $dataChartProfit[] = [
                    "timeline" => $this->covertTimeReport($db['report_time'], $type, $key),
                    "value" => $db['total_profit_amount']
                ];
            }
            $dataTotal = [
                'total_revenue' => $this->numberFormat($config_1['data']['total_revenue']) . TEXT_MONEY,
                'total_profit' => $this->numberFormat($config_1['data']['total_profit']) . TEXT_MONEY
            ];

            $brand = $request->get('brand');
            $branch = $request->get('branch');
            $addition_fee_reason_id = ENUM_GET_ALL;
            $type = $request->get('type');
            $time = $request->get('time');
            $data = collect($config_2['data'])->sortByDesc('status')->toArray();
            foreach ($data as $db) {
                $api = sprintf(API_REPORT_GET_COST_BUSINESS_RESULT, $brand, $branch, $addition_fee_reason_id, $type, $time, $db['id']);
                $body = null;

                $requestCost = [
                    'project' => ENUM_PROJECT_ID_JAVA_REPORT,
                    'method' => ENUM_METHOD_GET,
                    'api' => $api,
                    'body' => $body,
                ];
                $dataReasonType[] = $requestCost;
            }
        $configAll2 = $this->callApiMultiGatewayTemplate2($dataReasonType);
        try {
            $dataChartCost = [];
            foreach ($data as $keyReason => $dbReason) {
                $db = $configAll2[$keyReason];
                $dataChartReason = [];
                $name = '';
                foreach ($db['data'] as $key => $db2) {
                    $name = $db2['addition_fee_reason_type_content'];
                    $dataChartReason[] = [
                        'timeline' => $this->covertTimeReport($db2['report_time'], $type, $key),
                        'value' => $db2['total_amount'],
                    ];
                }
                if ($dbReason['status'] === ENUM_SELECTED) {
                    $name = $name . ' <span class="label label-success">' . TEXT_STATUS_ENABLE . '</span>';
                } else {
                    $name = $name . ' <span class="label label-inverse">' . TEXT_DISABLE_STATUS . '</span>';
                }
                $dataChartCost[] = [
                    'name' => $name,
                    'data' => $dataChartReason,
//                    'amount' => $this->numberFormat($db2['total_amount']) . ' ' . TEXT_MONEY
                ];
            }
        } catch (Exception $e) {
            return $this->catchTemplate($configAll2, $e);
        }
        return [$dataChartRevenue, $dataChartProfit, $dataChartCost, $config_1, $config_2, $configAll2, $dataTotal];
    }
}
