<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;

class CompanyDashboardController extends Controller
{
    public function index (Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'TREASURE_REPORT']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
//        $check_is_office = $this->checkOffice(1);
//        if($check_is_office[0] === false) {
//            $notify_permission = $check_is_office[1];
//            return view('errors.403_1', compact('notify_permission'));
//        }

        $active_nav = 'Hoạt động công ty';
        return view('dashboard.company.index', compact('active_nav'));
    }
     public function dataRevenueCostCashFlowReport (Request $request)
     {
         $brand = $request->get('brand');
         $branch = $request->get('branch');
         $type = $request->get('type');
         $time = $request->get('time');
         $from = '';
         $to = '';
         $project = ENUM_PROJECT_ID_JAVA_REPORT;
         $method = Config::get('constants.GATEWAY.METHOD.GET');
         $api = sprintf(API_REPORT_GET_REVENUE_COST_PROFIT_REALITY_V2, $brand, $branch, $type, $time, $from, $to);
         $body = null;
         $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);

         try {
             $revenueReality = [];
             $profitReality = [];
             $costReality = [];
             for ($i = 0; $i < count($config['data']['list']); $i++) {
                 $config['data']['list'][$i]['report_time'] = $this->covertTimeReport($config['data']['list'][$i]['report_time'], $type, $i);
                 array_push($revenueReality, [
                     'value' => [$config['data']['list'][$i]['report_time'], $config['data']['list'][$i]['total_revenue']],
                 ]);
                 array_push($profitReality, [
                     'value' => [$config['data']['list'][$i]['report_time'], $config['data']['list'][$i]['total_profit']],
                 ]);
                 array_push($costReality, [
                     'value' => [$config['data']['list'][$i]['report_time'], $config['data']['list'][$i]['total_cost']],
                     'addition_fee_amount' => $config['data']['list'][$i]['addition_fee_amount'],
//                     'total_recuring_average_cost' => $configAll[0]['data']['list'][$i]['total_recuring_average_cost'],
                 ]);
             }
             $dataChart = [
                 'timeline' => collect($config['data']['list'])->pluck('report_time'),
                 'revenue' => $revenueReality,
                 'profit' => $profitReality,
                 'cost' => $costReality,
                 'data' => $config['data']['list']
             ];
             $dataTotalPresent = [
                 // present
                 'present_revenue' => $this->numberFormat($config['data']['total_revenue']),
                 'present_cost' => $this->numberFormat($config['data']['total_cost']),
                 'present_cost_rate' => $this->numberFormat($this->rateDefaultTemplate($config['data']['total_addition_fee_amount'], $config['data']['total_cost']) * 100),

                 'present_profit' => $this->numberFormat($config['data']['total_profit']),
                 'present_profit_rate' => (int)$config['data']['rate_total_profit'],
                 'present_profit_rate_format' => $this->numberFormat($config['data']['rate_total_profit']),
                 'present_addition_fee_amount' => $this->numberFormat($config['data']['total_addition_fee_amount']),
                 'present_restaurant_debt_amount' => $this->numberFormat($config['data']['total_restaurant_debt_amount']),
                 'restaurant_debt_amount_rate' => $this->numberFormat($this->rateDefaultTemplate($config['data']['total_restaurant_debt_amount'], $config['data']['total_cost']) * 100),
             ];
             return [$dataChart, $dataTotalPresent, $config];
         }catch (Exception $e) {
             return $this->catchTemplate($config, $e);
         }
     }
}
