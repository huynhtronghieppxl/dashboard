<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class BranchDashboardController extends Controller
{
    public function index(Request $request)
    {
        $permission = ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'MARKETING_MANAGER', 'BUSINESS_ACTIVE_REPORT', 'SALE_REPORT'];
        if ($this->checkServiceRestaurantLevel()) {
            return redirect('/dashboard-sale-solution');
        }
        $checkPermission = $this->checkPermission($permission);
        if ($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if ($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if ($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Hoạt động Kinh doanh';
        return view('dashboard.branch.index', compact('active_nav', 'permission'));
    }

    public function updateDatatableLength(Request $request)
    {
        $change_length = $request->get('length');
        Session::put(SESSION_KEY_LENGTH_DATA_TABLE, $change_length);
        return $change_length;
    }

    public function dataFood(Request $request)
    {
        $branch_id = Session::get(SESSION_KEY_BRANCH_ID);
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $category_type = Config::get('constants.type.status.GET_ALL');
        $category_id = Config::get('constants.type.status.GET_ALL');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_addition = Config::get('constants.type.addition_fee.GET_ALL');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $branch_id, $status, $category_type, $category_id, $is_take_away, $is_addition);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $data = $config['data']['list'];
        $data_food_select = [];
        $data_first_food = '';
        if ($data != null) {
            for ($x = 0; $x < count($data); $x++) {
                $data_food_select[$x] = '<option value="' . ((object)$data[$x])->id . '">' . ((object)$data[$x])->name . '</option>';
                $data_first_food = ((object)$data[0])->id;
            }
        }
        return [$data_food_select, $data_first_food, $config];
    }

    public function dataCategory(Request $request)
    {
        $status = Config::get('constants.type.status.GET_ALL');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_CATEGORY_MANAGE, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $data = $config['data'];
        $data_category = '<option value="' . Config::get('constants.type.id.GET_ALL') . '">' . TEXT_ALL_OPTION . '</option>';
        if ($config['status'] == Config::get('constants.type.status.STATUS_SUCCESS')) {
            for ($i = 0; $i < count($data); $i++) {
                $data_category = $data_category . '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
            }
        } else {
            $data_category = null;
        }

        return [$data_category, $config];
    }

    public function dataPeriodic(Request $request)
    {
        $branch_id = Session::get(SESSION_KEY_BRANCH_ID);
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_INVENTORY_GET_HISTORY, $branch_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $data = $config['data'];
        $data_period_select = [];
        for ($i = 0; $i < count($data); $i++) {
            $data_period_select[$i] = '<option class="text-center" data-from="' . ((object)$data[$i])->from_inventory_id . '" data-to="' . ((object)$data[$i])->to_inventory_id . '">' . ((object)$data[$i])->value . '</option>';
        }
        return $data_period_select;
    }

    public function dataCurrentDayReport(Request $request)
    {
        $brand = $request->get('brand');
        $all_branch = ENUM_GET_ALL;
        $branch = $request->get('branch');
        $type = $request->get('type');
        $date_string = $request->get('date_string');

        // Báo cáo hoạt động ngày thương hiệu
        $api = sprintf(API_REPORT_GET_CURRENT_DAY_BRAND_V2, $brand, $all_branch, $type, $date_string);
        $body = null;
        $requestCurrentDayBrand = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        // Báo cáo hoạt động ngày chi nhánh
        $branch_id = $request->get('branch');
        $api = sprintf(API_REPORT_GET_CURRENT_DAY_BRANCH_V2, $brand, $branch_id, $type, $date_string);
        $body = null;
        $requestCurrentDayBranch = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        // Báo cáo các khoản thiền thu tiền chi doanh thu bán hàng khách hàng
        $api = sprintf(API_REPORT_GET_CURRENT_DAY_ORDER_V2, $brand, $branch, $type, $date_string);
        $body = null;
        $requestCurrentDayOrder = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestCurrentDayBrand, $requestCurrentDayBranch, $requestCurrentDayOrder]);
        try {
            $dataChartBranch = [];
            $data_brand = $configAll[0]['data'];
            $data_branch = $configAll[1]['data'];
            $data_order = $configAll[2]['data'];
            $data_brand['branch_name'] = $data_brand['restaurant_brand_name'];
            $dataX[0] = $data_brand;
            $data = array_merge($dataX, $data_branch);
            for ($i = 0; $i < count($data); $i++) {
                $dataChartBranch[$i] = [
                    "name" => $data[$i]['branch_name'],
                    'id' => $data[$i]['branch_id'],
                    'title1' => TEXT_REVENUE_PAID,
                    'title2' => TEXT_REVENUE_WAITING,
                    'title3' => TEXT_ESTIMATE_REVENUE,
                    'title4' => 'Khách hàng đã phục vụ',
                    'value1' => $data[$i]['total_revenue_paid'],
                    'value2' => $data[$i]['total_revenue_in_service'],
                    'value3' => $data[$i]['total_revenue_estimated'],
                    'value4' => $data[$i]['total_customer_slot_number'],
                ];
            }
            $dataValue = [
                'total_in_amount' => $this->numberFormat($data_order['total_revenue_amount_sell'] + $data_order['total_revenue_amount_debt'] + $data_order['total_revenue_amount_deposit']),
                'completed_order_amount' => $this->numberFormat($data_order['total_revenue_amount_sell']),
                'receive_customer_debt_amount' => $this->numberFormat($data_order['total_revenue_amount_debt']),
                'deposit_amount' => $this->numberFormat($data_order['total_revenue_amount_deposit']),

                'total_out_amount' => $this->numberFormat($data_order['total_cost_amount_confirm'] + $data_order['total_cost_amount_not_confirm']),
                'out_amount_by_addition_fee_confirmed' => $this->numberFormat($data_order['total_cost_amount_confirm']),
                'out_amount_by_addition_fee_waiting_confirm' => $this->numberFormat($data_order['total_cost_amount_not_confirm']),

                'total_order_amount' => $this->numberFormat($data_order['total_revenue_amount_paided'] + $data_order['total_revenue_amount_waiting']),
                'total_revenue_amount_paided' => $this->numberFormat($data_order['total_revenue_amount_paided']),
                'serving_order_amount' => $this->numberFormat($data_order['total_revenue_amount_waiting']),

                'total_customer' => $this->numberFormat($data_order['total_customer_slot_number_complete'] + $data_order['total_customer_slot_number_not_complete']),
                'number_served_customer' => $this->numberFormat($data_order['total_customer_slot_number_complete']),
                'number_serving_customer' => $this->numberFormat($data_order['total_customer_slot_number_not_complete']),
            ];
            return [$dataChartBranch, $dataValue, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    } //done

    public function dataRevenueCostProfitReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');

        // Báo cáo doanh thu ước tính
        $api = sprintf(API_REPORT_GET_REVENUE_COST_PROFIT_ESTIMATE_V2, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $requestRevenueCostProfit = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        // Báo cáo doanh thu thực tế
        $api = sprintf(API_REPORT_GET_REVENUE_COST_PROFIT_REALITY_V2, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $requestRevenueCost = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        // Báo cáo doanh thu lợi nhuận tổng
        $api = sprintf(API_REPORT_GET_REVENUE_COST_PROFIT_ALL_V2, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $requestRevenueCostProfitAll = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $configAll = $this->callApiMultiGatewayTemplate2([$requestRevenueCostProfit, $requestRevenueCost, $requestRevenueCostProfitAll]);
        try {
            $revenueEstimate = [];
            $profitEstimate = [];
            $costEstimate = [];
            $revenueReality = [];
            $profitReality = [];
            $costReality = [];
            $revenueAll = [];
            $profitAll = [];
            $costAll = [];
            for ($i = 0; $i < count($configAll[0]['data']['list']); $i++) {
                $configAll[0]['data']['list'][$i]['report_time'] = $this->covertTimeReport($configAll[0]['data']['list'][$i]['report_time'], $type, $i);
                array_push($revenueEstimate, [
                    'value' => [$configAll[0]['data']['list'][$i]['report_time'], $configAll[0]['data']['list'][$i]['total_revenue']],
                ]);
                array_push($profitEstimate, [
                    'value' => [$configAll[0]['data']['list'][$i]['report_time'], $configAll[0]['data']['list'][$i]['total_profit']],
                ]);
                array_push($costEstimate, [
                    'value' => [$configAll[0]['data']['list'][$i]['report_time'], $configAll[0]['data']['list'][$i]['total_cost']],
                    'total_salary_cost' => $configAll[0]['data']['list'][$i]['total_salary_cost'],
                    'addition_fee_amount' => $configAll[0]['data']['list'][$i]['addition_fee_amount'],
                    'total_recuring_average_cost' => $configAll[0]['data']['list'][$i]['total_recuring_average_cost'],
                    'restaurant_debt_amount' => $configAll[0]['data']['list'][$i]['restaurant_debt_amount'],
                ]);
            }
            for ($i = 0; $i < count($configAll[1]['data']['list']); $i++) {
                $configAll[1]['data']['list'][$i]['report_time'] = $this->covertTimeReport($configAll[1]['data']['list'][$i]['report_time'], $type, $i);
                array_push($revenueReality, [
                    'value' => [$configAll[1]['data']['list'][$i]['report_time'], $configAll[1]['data']['list'][$i]['total_revenue']],
                ]);
                array_push($profitReality, [
                    'value' => [$configAll[1]['data']['list'][$i]['report_time'], $configAll[1]['data']['list'][$i]['total_profit']],
                ]);
                array_push($costReality, [
                    'value' => [$configAll[1]['data']['list'][$i]['report_time'], $configAll[1]['data']['list'][$i]['total_cost']],
                    'addition_fee_amount' => $configAll[1]['data']['list'][$i]['addition_fee_amount'],
                    'total_recuring_average_cost' => $configAll[0]['data']['list'][$i]['total_recuring_average_cost'],
                ]);
            }

            for ($i = 0; $i < count($configAll[2]['data']['list']); $i++) {
                $configAll[2]['data']['list'][$i]['report_time'] = $this->covertTimeReport($configAll[2]['data']['list'][$i]['report_time'], $type, $i);
                array_push($revenueAll, [
                    'value' => [$configAll[2]['data']['list'][$i]['report_time'], $configAll[2]['data']['list'][$i]['total_revenue']],
                ]);
                array_push($profitAll, [
                    'value' => [$configAll[2]['data']['list'][$i]['report_time'], $configAll[2]['data']['list'][$i]['total_profit']],
                ]);
                array_push($costAll, [
                    'value' => [$configAll[2]['data']['list'][$i]['report_time'], $configAll[2]['data']['list'][$i]['total_cost']],
                    'total_salary_cost' => $configAll[0]['data']['list'][$i]['total_salary_cost'],
                    'addition_fee_amount' => $configAll[0]['data']['list'][$i]['addition_fee_amount'],
                    'total_recuring_average_cost' => $configAll[0]['data']['list'][$i]['total_recuring_average_cost'],
                    'restaurant_debt_amount' => $configAll[0]['data']['list'][$i]['restaurant_debt_amount'],
                ]);
            }

            $dataChart1 = [
                'timeline' => collect($configAll[0]['data']['list'])->pluck('report_time'),
                'revenue' => $revenueEstimate,
                'profit' => $profitEstimate,
                'cost' => $costEstimate,
                'data' => $configAll[0]['data']['list']
            ];

            $dataChart2 = [
                'timeline' => collect($configAll[1]['data']['list'])->pluck('report_time'),
                'revenue' => $revenueReality,
                'profit' => $profitReality,
                'cost' => $costReality,
                'data' => $configAll[1]['data']['list']
            ];

            $dataChart3 = [
                'timeline' => collect($configAll[2]['data']['list'])->pluck('report_time'),
                'revenue' => $revenueAll,
                'profit' => $profitAll,
                'cost' => $costAll,
                'data' => $configAll[2]['data']['list']
            ];

            $dataTotalEstimate = [
                // Ước tính
                'total_revenue' => $this->numberFormat($configAll[0]['data']['total_revenue']),
                'total_cost' => $this->numberFormat($configAll[0]['data']['total_cost']),
                'total_profit' => $this->numberFormat($configAll[0]['data']['total_profit']),
                'rate_total_profit' => (int)$configAll[0]['data']['rate_total_profit'],

                'profit_rate_format' => $this->numberFormat($configAll[0]['data']['rate_total_profit']),
                'total_vat_amount' => $this->numberFormat($configAll[0]['data']['total_vat_amount']),
                'total_addition_fee_amount' => $this->numberFormat($configAll[0]['data']['total_addition_fee_amount']),
                'rate_total_addition_amount' => $this->numberFormat($this->rateDefaultTemplate($configAll[0]['data']['total_addition_fee_amount'], $configAll[0]['data']['total_cost']) * 100),

                'total_cost_restaurant_debt_amount' => $this->numberFormat($configAll[0]['data']['total_restaurant_debt_amount']),
                'rate_cost_restaurant_debt_amount' => $this->numberFormat($this->rateDefaultTemplate($configAll[0]['data']['total_restaurant_debt_amount'], $configAll[0]['data']['total_cost']) * 100),


                'total_basic_salary_estimate' => $this->numberFormat($configAll[0]['data']['total_basic_salary_estimate']),
                'rate_total_basic_salary_estimate' => $this->numberFormat($this->rateDefaultTemplate($configAll[0]['data']['total_basic_salary_estimate'], $configAll[0]['data']['total_cost']) * 100),

                'total_amount_salary' => $this->numberFormat($configAll[0]['data']['total_amount_salary']),
                'rate_total_amount_salary' => $this->numberFormat($this->rateDefaultTemplate($configAll[0]['data']['total_amount_salary'], $configAll[0]['data']['total_cost']) * 100),


                'total_salary_cost_amount' => $this->numberFormat($configAll[0]['data']['total_salary_cost_amount']),
                'rate_total_salary_cost_amount' => $this->numberFormat($this->rateDefaultTemplate($configAll[0]['data']['total_salary_cost_amount'], $configAll[0]['data']['total_cost']) * 100),

            ];
            $dataTotalPresent = [
                // present
                'present_revenue' => $this->numberFormat($configAll[1]['data']['total_revenue']),
                'present_cost' => $this->numberFormat($configAll[1]['data']['total_cost']),
                'present_cost_rate' => $this->numberFormat($this->rateDefaultTemplate($configAll[1]['data']['total_addition_fee_amount'], $configAll[1]['data']['total_cost']) * 100),

                'present_profit' => $this->numberFormat($configAll[1]['data']['total_profit']),
                'present_profit_rate' => (int)$configAll[1]['data']['rate_total_profit'],
                'present_profit_rate_format' => $this->numberFormat($configAll[1]['data']['rate_total_profit']),
                'present_addition_fee_amount' => $this->numberFormat($configAll[1]['data']['total_addition_fee_amount']),
                'present_restaurant_debt_amount' => $this->numberFormat($configAll[1]['data']['total_restaurant_debt_amount']),
                'restaurant_debt_amount_rate' => $this->numberFormat($this->rateDefaultTemplate($configAll[1]['data']['total_restaurant_debt_amount'], $configAll[1]['data']['total_cost']) * 100),
            ];
            $dataTotalTotalPresent = [
                // total present
                'total_revenue' => $this->numberFormat($configAll[2]['data']['total_revenue']),
                'total_cost' => $this->numberFormat($configAll[2]['data']['total_cost']),
                'total_profit' => $this->numberFormat($configAll[2]['data']['total_profit']),
                'total_profit_rate' => (int)$configAll[2]['data']['rate_total_profit'],
                'total_profit_rate_format' => $this->numberFormat($configAll[2]['data']['rate_total_profit']),
                'present_addition_fee_amount_other' => $this->numberFormat($configAll[2]['data']['total_addition_fee_amount_other']),
                'present_basic_salary_estimate' => $this->numberFormat($configAll[2]['data']['total_basic_salary_estimate']),
                'present_salary_cost_amount' => $this->numberFormat($configAll[2]['data']['total_salary_cost_amount']),
                'present_amount_salary' => $this->numberFormat($configAll[2]['data']['total_amount_salary']),
                'present_debt_amount' => $this->numberFormat($configAll[2]['data']['total_debt_amount']),
                'present_restaurant_debt_amount' => $this->numberFormat($configAll[2]['data']['total_restaurant_debt_amount']),
            ];
            $data_prop = [
                'present_original' => $configAll[2]['data']['total_funds'],
                'present_revenue' => $configAll[0]['data']['total_revenue'],
                'revenue' => $configAll[2]['data']['total_revenue'],
                'profit' => $configAll[2]['data']['total_profit'],
                'color1' => ['#0ac282', '#ffa233'],
                'color2' => ['#0ac282', '#fe5d70'],
            ];
            $profit_order = $configAll[0]['data']['total_revenue'] - $configAll[2]['data']['total_funds'];
            if ($configAll[0]['data']['total_revenue'] > $configAll[2]['data']['total_funds']) {
                $class1 = 'bg-c-green';
                $class2 = 'label-success';
                $class3 = 'icon-arrow-up';
                $class4 = 100;
                $class5 = $this->numberFormat($this->rateDefaultTemplate($configAll[2]['data']['total_funds'], $configAll[0]['data']['total_revenue']) * 100);
            } elseif ($configAll[0]['data']['total_revenue'] < $configAll[2]['data']['total_funds']) {
                $class1 = 'bg-c-pink';
                $class2 = 'label-danger';
                $class3 = 'icon-arrow-down';
                $class4 = $this->numberFormat($this->rateDefaultTemplate($configAll[0]['data']['total_revenue'], $configAll[2]['data']['total_funds']) * 100);
                $class5 = 100;
            } else {
                $class1 = 'bg-c-green';
                $class2 = 'label-success';
                $class3 = 'icon-arrow-up';
                $class4 = 100;
                $class5 = 100;
            }
            $rate_original_revenue = $configAll[0]['data']['rate_total_profit'];
            $rateMaterial = $this->rateDefaultTemplate($configAll[2]['data']['total_amount_material'], $configAll[0]['data']['total_revenue']) * 100;
            $rateGoods = $this->rateDefaultTemplate($configAll[2]['data']['total_amount_goods'], $configAll[0]['data']['total_revenue']) * 100;
            $rateInternal = $this->rateDefaultTemplate($configAll[2]['data']['total_amount_internal'], $configAll[0]['data']['total_revenue']) * 100;
            $rateOther = $this->rateDefaultTemplate($configAll[2]['data']['total_amount_orther'], $configAll[0]['data']['total_revenue']) * 100;
            $ratedebt = $this->rateDefaultTemplate($configAll[2]['data']['total_amount_inventory'], $configAll[0]['data']['total_revenue']) * 100;
            $rateMaterialDebt = $this->rateDefaultTemplate($configAll[2]['data']['total_material_inventory_amount'], $configAll[0]['data']['total_revenue']) * 100;
            $rateGoodDebt = $this->rateDefaultTemplate($configAll[2]['data']['total_good_inventory_amount'], $configAll[0]['data']['total_revenue']) * 100;
            $rateInternalDebt = $this->rateDefaultTemplate($configAll[2]['data']['total_internal_inventory_amount'], $configAll[0]['data']['total_revenue']) * 100;
            $rateOtherDebt = $this->rateDefaultTemplate($configAll[2]['data']['total_another_material_inventory_amount'], $configAll[0]['data']['total_revenue']) * 100;
            $rateKitchen = $this->rateDefaultTemplate($configAll[2]['data']['total_kitchen_inventory_amount'], $configAll[0]['data']['total_revenue']) * 100;
            $rateBar = $this->rateDefaultTemplate($configAll[2]['data']['total_bar_inventory_amount'], $configAll[0]['data']['total_revenue']) * 100;
            $rateEmployeeSale = $this->rateDefaultTemplate($configAll[2]['data']['total_employee_sale_inventory_amount'], $configAll[0]['data']['total_revenue']) * 100;
            $rateEmployeeFood = $this->rateDefaultTemplate($configAll[2]['data']['total_employee_food_inventory_amount'], $configAll[0]['data']['total_revenue']) * 100;
            $data_rate1 = '<div class="progress-box d-flex justify-content-lg-between align-items-center flex-lg-wrap">
                                <p class="m-r-20 f-w-400 "><strong>Lợi nhuận đơn hàng:</strong> ' . $this->numberFormat($configAll[2]['data']['total_gross_profit']) . '</p>
                                <label class="label label-lg ' . $class2 . '" style="position: absolute; top: -50px; right: 0">
                                            ' . $this->numberFormat($rate_original_revenue) . '% <i class="m-l-10 feather ' . $class3 . '"></i>
                                </label>
                                <div class="progress d-inline-block" style="width: 100%">
                                    <div class="progress-bar ' . $class1 . '" style="width:' . abs($rate_original_revenue) . '% "></div>
                                </div>
                            </div>
                            <div class="progress-box">
                                <p class="m-r-20 f-w-400 "><strong>Doanh thu đơn hàng:</strong> ' . $this->numberFormat($configAll[0]['data']['total_revenue']) . '</p>
                                <div class="progress d-inline-block" style="width: 100%">
                                    <div class="progress-bar bg-c-blue" style="width:' . $class4 . '% "><label>' . $this->numberFormat($class4) . '%</label></div>
                                </div>
                            </div>
                            <div class="progress-box">
                                <p class="m-r-20 f-w-400 "><strong>Chi phí nguyên liệu:</strong> ' . $this->numberFormat($configAll[2]['data']['total_funds']) . '</p>
                                <div class="progress d-inline-block" style="width: 100%">
                                    <div class="progress-bar bg-c-yellow" style="width:' . $class5 . '% "><label>' . $this->numberFormat($class5) . '%</label></div>
                                </div>
                            </div>
                            <div class="progress-box" style="margin-left: 10px">
                                <p class="m-r-20 f-w-400 ">Kho nguyên liệu (CN): ' . $this->numberFormat($configAll[2]['data']['total_amount_material']) . '</p>
                                <div class="progress d-inline-block" style="width: 100%">
                                    <div class="progress-bar bg-success" style="width:' . $rateMaterial . '% "><label>' . $this->numberFormat($rateMaterial) . '%</label></div>
                                </div>
                            </div>

                            <div class="progress-box" style="margin-left: 10px">
                                <p class="m-r-20 f-w-400 ">Kho hàng hoá (CN): ' . $this->numberFormat($configAll[2]['data']['total_amount_goods']) . '</p>
                                <div class="progress d-inline-block" style="width: 100%">
                                    <div class="progress-bar bg-facebook" style="width:' . $rateGoods . '% "><label>' . $this->numberFormat($rateGoods) . '%</label></div>
                                </div>
                            </div>
                            <div class="progress-box" style="margin-left: 10px">
                                <p class="m-r-20 f-w-400  d-flex">Kho nội bộ <i class="fi-rr-exclamation ml-1 mr-1" data-toggle="tooltip" data-placement="top" data-original-title="Không tính vào Tiền vốn" style="font-size: 13.5px !important;"></i> : ' . $this->numberFormat($configAll[2]['data']['total_amount_internal']) . '</p>
                                <div class="progress d-inline-block" style="width: 100%">
                                    <div class="progress-bar bg-googleplus" style="width:' . $rateInternal . '% "><label>' . $this->numberFormat($rateInternal) . '%</label></div>
                                </div>
                            </div>
                            <div class="progress-box" style="margin-left: 10px">
                                <p class="m-r-20 f-w-400 ">Kho khác (CN): ' . $this->numberFormat($configAll[2]['data']['total_amount_orther']) . '</p>
                                <div class="progress d-inline-block" style="width: 100%">
                                    <div class="progress-bar bg-instagram" style="width:' . $rateOther . '% "><label>' . $this->numberFormat($rateOther) . '%</label></div>
                                </div>
                            </div>
                            <div class="progress-box pointer" style="font-weight: 500;margin-left: 10px" id="warehouse-inventory">
                                <p class="m-r-20 f-w-400 "><strong>Tồn đầu (CN/BP):<i class="fi-rr-caret-down"></i></strong> ' . $this->numberFormat($configAll[2]['data']['total_amount_inventory']) . '</p>
                                <div class="progress d-inline-block" style="width: 100%">
                                    <div class="progress-bar bg-instagram" style="width:' . $ratedebt . '% "><label>' . $this->numberFormat($ratedebt) . '%</label></div>
                                </div>
                            </div>
                            <div class="list-warehouse-inventory d-none">
                                <div class="progress-box" style="margin-left: 15px">
                                    <p class="m-r-20 f-w-400 ">Kho nguyên liệu (CN): ' . $this->numberFormat($configAll[2]['data']['total_material_inventory_amount']) . '</p>
                                    <div class="progress d-inline-block" style="width: 100%">
                                        <div class="progress-bar bg-instagram" style="width:' . $rateMaterialDebt . '% "><label>' . $this->numberFormat($rateMaterialDebt) . '%</label></div>
                                    </div>
                                </div>
                                <div class="progress-box" style="margin-left: 15px">
                                    <p class="m-r-20 f-w-400 ">Kho hàng hoá (CN): ' . $this->numberFormat($configAll[2]['data']['total_good_inventory_amount']) . '</p>
                                    <div class="progress d-inline-block" style="width: 100%">
                                        <div class="progress-bar bg-instagram" style="width:' . $rateGoodDebt . '% "><label>' . $this->numberFormat($rateGoodDebt) . '%</label></div>
                                    </div>
                                </div><div class="progress-box" style="margin-left: 15px">
                                    <p class="m-r-20 f-w-400 ">Kho nội bộ (CN): ' . $this->numberFormat($configAll[2]['data']['total_internal_inventory_amount']) . '</p>
                                    <div class="progress d-inline-block" style="width: 100%">
                                        <div class="progress-bar bg-instagram" style="width:' . $rateInternalDebt . '% "><label>' . $this->numberFormat($rateInternalDebt) . '%</label></div>
                                    </div>
                                </div>
                                <div class="progress-box" style="margin-left: 15px">
                                    <p class="m-r-20 f-w-400 ">Kho khác (CN): ' . $this->numberFormat($configAll[2]['data']['total_another_material_inventory_amount']) . '</p>
                                    <div class="progress d-inline-block" style="width: 100%">
                                        <div class="progress-bar bg-instagram" style="width:' . $rateOtherDebt . '% "><label>' . $this->numberFormat($rateOtherDebt) . '%</label></div>
                                    </div>
                                </div>
                                <div class="progress-box" style="margin-left: 15px">
                                    <p class="m-r-20 f-w-400 ">Kho bếp (BP): ' . $this->numberFormat($configAll[2]['data']['total_kitchen_inventory_amount']) . '</p>
                                    <div class="progress d-inline-block" style="width: 100%">
                                        <div class="progress-bar bg-instagram" style="width:' . $rateKitchen . '% "><label>' . $this->numberFormat($rateKitchen) . '%</label></div>
                                    </div>
                                </div>
                                <div class="progress-box" style="margin-left: 15px">
                                    <p class="m-r-20 f-w-400 ">Kho bia (BP): ' . $this->numberFormat($configAll[2]['data']['total_bar_inventory_amount']) . '</p>
                                    <div class="progress d-inline-block" style="width: 100%">
                                        <div class="progress-bar bg-instagram" style="width:' . $rateBar . '% "><label>' . $this->numberFormat($rateBar) . '%</label></div>
                                    </div>
                                </div><div class="progress-box" style="margin-left: 15px">
                                    <p class="m-r-20 f-w-400 ">Kho NVKD (BP): ' . $this->numberFormat($configAll[2]['data']['total_employee_sale_inventory_amount']) . '</p>
                                    <div class="progress d-inline-block" style="width: 100%">
                                        <div class="progress-bar bg-instagram" style="width:' . $rateEmployeeSale . '% "><label>' . $this->numberFormat($rateEmployeeSale) . '%</label></div>
                                    </div>
                                </div>
                                <div class="progress-box" style="margin-left: 15px">
                                    <p class="m-r-20 f-w-400 ">Kho thức ăn NV (BP): ' . $this->numberFormat($configAll[2]['data']['total_employee_food_inventory_amount']) . '</p>
                                    <div class="progress d-inline-block" style="width: 100%">
                                        <div class="progress-bar bg-instagram" style="width:' . $rateEmployeeFood . '% "><label>' . $this->numberFormat($rateEmployeeFood) . '%</label></div>
                                    </div>
                                </div>
                            </div>';

            $cost_estimate = $configAll[2]['data']['total_revenue'] - $configAll[2]['data']['total_profit'];
            if ($configAll[2]['data']['total_revenue'] > $cost_estimate) {
                $class1 = 'bg-c-green';
                $class2 = 'label-success';
                $class3 = 'icon-arrow-up';
                $class4 = 100;
                $class5 = $this->numberFormat($this->rateDefaultTemplate($cost_estimate, $configAll[2]['data']['total_revenue']) * 100);
            } elseif ($configAll[2]['data']['total_revenue'] < $cost_estimate) {
                $class1 = 'bg-c-pink';
                $class2 = 'label-danger';
                $class3 = 'icon-arrow-down';
                $class4 = $this->numberFormat($this->rateDefaultTemplate($configAll[2]['data']['total_revenue'], $cost_estimate) * 100);
                $class5 = 100;
            } else {
                $class1 = 'bg-c-green';
                $class2 = 'label-success';
                $class3 = 'icon-arrow-up';
                $class4 = 100;
                $class5 = 100;
            }
            $rate_cost_revenue = $configAll[2]['data']['rate_total_profit'];
            $data_rate2 = '<div class="progress-box d-flex justify-content-lg-between align-items-center flex-lg-wrap">
                                <p class="m-r-20 f-w-400"><strong>Lợi nhuận tổng:</strong> ' . $this->numberFormat($configAll[2]['data']['total_profit']) . '</p>
                                <label class="label label-lg  ' . $class2 . '" style="position: absolute; top: -50px; right: 0">
                                            ' . $this->numberFormat($rate_cost_revenue) . '% <i class="m-l-10 feather ' . $class3 . '"></i>
                                </label>
                                <div class="progress d-inline-block" style="width: 100%">
                                    <div class="progress-bar ' . $class1 . '" style="width:' . abs($rate_cost_revenue) . '% "></div>
                                </div>
                            </div>
                            <div class="progress-box">
                                <p class="m-r-20 f-w-400 "><strong>Doanh thu tổng:</strong> ' . $this->numberFormat($configAll[2]['data']['total_revenue']) . '</p>
                                <div class="progress d-inline-block" style="width: 100%">
                                    <div class="progress-bar bg-c-blue" style="width:' . $class4 . '% "><label>' . $this->numberFormat($class4) . '%</label></div>
                                </div>
                            </div>
                            <div class="progress-box">
                                <p class="m-r-20 f-w-400 "><strong>Chi phí tổng:</strong> ' . $this->numberFormat($cost_estimate) . '</p>
                                <div class="progress d-inline-block" style="width: 100%">
                                    <div class="progress-bar bg-c-yellow" style="width:' . $class5 . '% "><label>' . $this->numberFormat($class5) . '%</label></div>
                                </div>
                            </div>';
            return [$dataChart1, $dataChart2, $dataChart3, $dataTotalEstimate, $dataTotalPresent, $dataTotalTotalPresent, $data_prop, $data_rate1, $data_rate2, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    } //done


    public function dataDetailRevenueReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');
        // Báo cáo chi tiết doanh thu bán hàng tổng quan
        $api = sprintf(API_REPORT_DETAIL_REVENUE, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $total_rate_increase = $config['data']['total_amount_order_report_food'] + $config['data']['total_amount_order_restaurant_revenue_by_food'] + $config['data']['total_amount_order_report_food_take_away'] + $config['data']['total_amount_order_restaurant_order_extra_charge'] + $config['data']['total_amount_order_report_data_vat'];
            $rate_increase = '<div class="progress-box">
                                            <p class="m-r-20 f-w-400">Tổng: ' . $this->numberFormat($total_rate_increase) . '</p>
                                            <div class="progress d-inline-block" style="width: 100%">
                                                <div class="progress-bar bg-c-blue"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box" style="margin-left: 50px">
                                            <p class="m-r-20 f-w-400">Món ăn/Danh mục: ' . $this->numberFormat($config['data']['total_amount_order_report_food']) . '</p>
                                            <div class="progress d-inline-block" style="width: 100%">
                                                <div class="progress-bar bg-success" style="width: ' . round($this->rateDefaultTemplate($config['data']['total_amount_order_report_food'], $total_rate_increase) * 100, 2) . '% ">
                                                    <label>' . round($this->rateDefaultTemplate($config['data']['total_amount_order_report_food'], $total_rate_increase) * 100, 2) . '%</label></div>
                                            </div>
                                        </div>
                                        <div class="progress-box" style="margin-left: 50px">
                                            <p class="m-r-20 f-w-400">Ngoài menu :' . $this->numberFormat($config['data']['total_amount_order_restaurant_revenue_by_food']) . '</p>
                                            <div class="progress d-inline-block" style="width: 100%">
                                                <div class="progress-bar bg-instagram" style="width:' . round($this->rateDefaultTemplate($config['data']['total_amount_order_restaurant_revenue_by_food'], $total_rate_increase) * 100, 2) . '% ">
                                                    <label>' . round($this->rateDefaultTemplate($config['data']['total_amount_order_restaurant_revenue_by_food'], $total_rate_increase) * 100, 2) . '%</label></div>
                                            </div>
                                        </div>
                                        <div class="progress-box" style="margin-left: 50px">
                                            <p class="m-r-20 f-w-400">Mang về : ' . $this->numberFormat($config['data']['total_amount_order_report_food_take_away']) . '</p>
                                            <div class="progress d-inline-block" style="width: 100%">
                                                <div class="progress-bar btn-grd-danger" style="width:' . round($this->rateDefaultTemplate($config['data']['total_amount_order_report_food_take_away'], $total_rate_increase) * 100, 2) . '% ">
                                                    <label>' . round($this->rateDefaultTemplate($config['data']['total_amount_order_report_food_take_away'], $total_rate_increase) * 100, 2) . '%</label></div>
                                            </div>
                                        </div>
                                        <div class="progress-box" style="margin-left: 50px">
                                            <p class="m-r-20 f-w-400">Phụ thu :' . $this->numberFormat($config['data']['total_amount_order_restaurant_order_extra_charge']) . '</p>
                                            <div class="progress d-inline-block" style="width: 100%">
                                                <div class="progress-bar bg-googleplus" style="width:' . round($this->rateDefaultTemplate($config['data']['total_amount_order_restaurant_order_extra_charge'], $total_rate_increase) * 100, 2) . '%">
                                                    <label>' . round($this->rateDefaultTemplate($config['data']['total_amount_order_restaurant_order_extra_charge'], $total_rate_increase) * 100, 2) . '%</label></div>
                                            </div>
                                        </div>
                                         <div class="progress-box" style="margin-left: 50px">
                                            <p class="m-r-20 f-w-400">Vat :' . $this->numberFormat($config['data']['total_amount_order_report_data_vat']) . '</p>
                                            <div class="progress d-inline-block" style="width: 100%">
                                                <div class="progress-bar bg-c-orenge" style="width:' . round($this->rateDefaultTemplate($config['data']['total_amount_order_report_data_vat'], $total_rate_increase) * 100, 2) . '% ">
                                                    <label>' . round($this->rateDefaultTemplate($config['data']['total_amount_order_report_data_vat'], $total_rate_increase) * 100, 2) . '%</label></div>
                                            </div>
                                        </div>';
            $total_rate_decrease = $config['data']['total_amount_order_restaurant_discount_from_order'] + $config['data']['total_amount_order_customer_accumulate_promotion_point'] + $config['data']['total_amount_order_report_food_gift'] + $config['data']['total_amount_order_report_food_cancel'];
            $rate_decrease = '<div class="progress-box">
                                            <p class="m-r-20 f-w-400">Tổng: ' . $this->numberFormat($total_rate_decrease) . '</p>
                                            <div class="progress d-inline-block" style="width: 100%">
                                                <div class="progress-bar bg-c-orenge""></div>
                                            </div>
                                        </div>
                                        <div class="progress-box" style="margin-left: 50px">
                                            <p class="m-r-20 f-w-400">Giảm giá: ' . $this->numberFormat($config['data']['total_amount_order_restaurant_discount_from_order']) . '</p>
                                            <div class="progress d-inline-block" style="width: 100%">
                                                <div class="progress-bar bg-success" style="width: ' . round($this->rateDefaultTemplate($config['data']['total_amount_order_restaurant_discount_from_order'], $total_rate_decrease) * 100, 2) . '% ">
                                                    <label>' . round($this->rateDefaultTemplate($config['data']['total_amount_order_restaurant_discount_from_order'], $total_rate_decrease) * 100, 2) . '%</label></div>
                                            </div>
                                        </div>
                                        <div class="progress-box" style="margin-left: 50px">
                                            <p class="m-r-20 f-w-400">Sử dụng điểm  :' . $this->numberFormat($config['data']['total_amount_order_customer_accumulate_promotion_point']) . '</p>
                                            <div class="progress d-inline-block" style="width: 100%">
                                                <div class="progress-bar bg-instagram" style="width:' . round($this->rateDefaultTemplate($config['data']['total_amount_order_customer_accumulate_promotion_point'], $total_rate_decrease) * 100, 2) . '% ">
                                                    <label>' . round($this->rateDefaultTemplate($config['data']['total_amount_order_customer_accumulate_promotion_point'], $total_rate_decrease) * 100, 2) . '%</label></div>
                                            </div>
                                        </div>
                                        <div class="progress-box" style="margin-left: 50px">
                                            <p class="m-r-20 f-w-400">Món tặng : ' . $this->numberFormat($config['data']['total_amount_order_report_food_gift']) . '</p>
                                            <div class="progress d-inline-block" style="width: 100%">
                                                <div class="progress-bar btn-grd-danger" style="width:' . round($this->rateDefaultTemplate($config['data']['total_amount_order_report_food_gift'], $total_rate_decrease) * 100, 2) . '% ">
                                                    <label>' . round($this->rateDefaultTemplate($config['data']['total_amount_order_report_food_gift'], $total_rate_decrease) * 100, 2) . '%</label></div>
                                            </div>
                                        </div>
                                        <div class="progress-box" style="margin-left: 50px">
                                            <p class="m-r-20 f-w-400">Món hủy :' . $this->numberFormat($config['data']['total_amount_order_report_food_cancel']) . '</p>
                                            <div class="progress d-inline-block" style="width: 100%">
                                                <div class="progress-bar bg-googleplus" style="width:' . round($this->rateDefaultTemplate($config['data']['total_amount_order_report_food_cancel'], $total_rate_decrease) * 100, 2) . '%">
                                                    <label>' . round($this->rateDefaultTemplate($config['data']['total_amount_order_report_food_cancel'], $total_rate_decrease) * 100, 2) . '%</label></div>
                                            </div>
                                        </div>';
            $totalRevenueSell = $this->numberFormat($total_rate_increase - $total_rate_decrease);
            return [$rate_increase, $rate_decrease, $totalRevenueSell, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    } //done

    public function dataBusinessGrowthReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_BUSINESS_GROWTH, $brand, $branch, $type, $time);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $dataTime = [];
            $dataRevenue = [];
            $dataCost = [];
            $dataProfit = [];
            foreach ($data as $key => $db) {
                array_push($dataTime, $this->covertTimeReport($db['report_time'], $type, $key));
                array_push($dataRevenue, $db['total_revenue_incremental']);
                array_push($dataCost, $db['total_cost_final']);
                array_push($dataProfit, $db['total_revenue_incremental'] - $db['total_cost_final']);
            }
            $dataTotal = [
                'revenue' => $this->numberFormat($config['data'][count($config['data']) - 1]['total_revenue_incremental']),
                'cost' => $this->numberFormat($config['data'][count($config['data']) - 1]['total_cost_final']),
                'profit' => $this->numberFormat($config['data'][count($config['data']) - 1]['total_revenue_incremental'] - $config['data'][count($config['data']) - 1]['total_cost_final']),
            ];

            return [$dataTime, $dataRevenue, $dataCost, $dataProfit, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

//    public function dataBusinessGrowthReport(Request $request)
//    {
//        $brand = $request->get('brand');
//        $branch = $request->get('branch');
//        $type = $request->get('type');
//        $time = $request->get('time');
//        $project = ENUM_PROJECT_ID_JAVA_REPORT;
//        $method = Config::get('constants.GATEWAY.METHOD.GET');
//        $convert_api = $this->convertApiTemplate(sprintf(API_REPORT_GET_BUSINESS_GROWTH, $brand, $branch, $type, $time));
//        $api = $convert_api[0];
//        $params = $convert_api[1];
//        $body = null;
//        $config = $this->callApiGatewayTemplate($project, $method, $api, $params, $body);
//        try {
//            $data = $config['data'];
//            $dataChart1 = [];
//            $dataChart2 = [];
//            $dataChart3 = [];
//            $dataChart4 = [];
//            foreach ($data as $key => $db) {
//                $db['report_time'] = $this->covertTimeReport($db['report_time'], $type, $key);
//
//                array_push($dataChart1, [
//                    'value' => [$db['report_time'] , $db['one_ago_total_revenue']],
//                    'timeline' => $db['report_time'],
//                    'revenue' => $db['one_ago_total_revenue'],
//                    'cost' => $db['one_ago_total_cost'],
//                    'profit' => $db['one_ago_total_revenue'] - $db['one_ago_total_cost'],
////                    'growth_revenue_label' => '',
////                    'growth_cost_label' => $this->labelBusinessGrowth($db['one_ago_total_cost'], $db['cost'], $db['cost_before'], $db['time_after'], $db['time_before'], $db['growth_cost_chart_one'], 'Chi phí'),
////                    'growth_profit_label' => $this->labelBusinessProfitGrowth($db['profit_chart_one'], $db['profit'], $db['time_after'], $db['growth_profit_chart_one'], $db['growth_profit2_chart_one'], 'Lợi nhuận'),
//                ]);
//                array_push($dataChart2, [
//                    'value' => [$db['report_time'] , $db['two_ago_total_cost']],
//                    'timeline' => $db['report_time'],
//                    'revenue' => $db['two_ago_total_revenue'],
//                    'cost' => $db['two_ago_total_cost'],
//                    'profit' => $db['two_ago_total_revenue'] - $db['two_ago_total_cost'],
////                    'growth_revenue_label' => $this->labelBusinessGrowth($db['two_ago_total_revenue'], $db['total_revenue'], $db['total_revenue_incremental'], $db['time_after'], $db['time_before'], $db['growth_revenue_chart_two'], 'Doanh thu'),
////                    'growth_cost_label' => $this->labelBusinessGrowth($db['two_ago_total_cost'], $db['cost'], $db['cost_before'], $db['time_after'], $db['time_before'], $db['growth_cost_chart_two'], 'Chi phí'),
////                    'growth_profit_label' => $this->labelBusinessProfitGrowth($db['profit_chart_two'], $db['profit'], $db['time_after'], $db['growth_profit_chart_two'], $db['growth_profit2_chart_two'], 'Lợi nhuận'),
//                ]);
//                array_push($dataChart3, [
//                    'value' => [$db['report_time'] , $db['three_ago_total_revenue'] - $db['three_ago_total_cost']],
//                    'timeline' => $db['report_time'],
//                    'revenue' => $db['three_ago_total_revenue'],
//                    'cost' => $db['three_ago_total_cost'],
//                    'profit' => $db['three_ago_total_revenue'] - $db['three_ago_total_cost'],
//
////                    'growth_revenue_label' => $this->labelBusinessGrowth($db['three_ago_total_revenue'], $db['total_revenue'], $db['total_revenue_incremental'], $db['time_after'], $db['time_before'], $db['growth_revenue_chart_three'], 'Doanh thu'),
////                    'growth_cost_label' => $this->labelBusinessGrowth($db['three_ago_total_cost'], $db['cost'], $db['cost_before'], $db['time_after'], $db['time_before'], $db['growth_cost_chart_three'], 'Chi phí'),
////                    'growth_profit_label' => $this->labelBusinessProfitGrowth($db['profit_chart_three'], $db['profit'], $db['time_after'], $db['growth_profit_chart_three'], $db['growth_profit2_chart_three'], 'Lợi nhuận'),
//                ]);
//                array_push($dataChart4, [
//                    'timeline' => $db['report_time'],
//                    'revenue' => $db['four_ago_total_revenue'],
//                    'cost' => $db['four_ago_total_cost'],
//                    'profit' => $db['four_ago_total_revenue'] - $db['four_ago_total_cost'],
////                    'growth_revenue_label' => $this->labelBusinessGrowth($db['four_ago_total_revenue'], $db['revenue_four'], $db['total_revenue_incremental'], $db['time_after'], $db['time_before'], $db['growth_revenue_chart_four'], 'Doanh thu'),
////                    'growth_cost_label' => $this->labelBusinessGrowth($db['four_ago_total_cost'], $db['cost_four'], $db['cost_before'], $db['time_after'], $db['time_before'], $db['growth_cost_chart_four'], 'Chi phí'),
////                    'growth_profit_label' => $this->labelBusinessProfitGrowth($db['profit_chart_four'], $db['profit_four'], $db['time_after'], $db['growth_profit_chart_four'], $db['growth_profit2_chart_four'], 'Lợi nhuận'),
//                ]);
//            }
//            $revenue = $config['data'][count($config['data']) - 1]['total_revenue_incremental'];
//            $cost = $config['data'][count($config['data']) - 1]['total_cost_final'];
//            $profit = $revenue - $cost;
////            $rate_revenue = array_sum(array_column($config['data']['chart'], 'one_ago_total_revenue')) - $config['data']['chart'][0]['one_ago_total_revenue'];
////            $rate_cost = array_sum(array_column($config['data']['chart'], 'one_ago_total_cost')) - $config['data']['chart'][0]['one_ago_total_cost'];
////            $rate_profit = $rate_revenue - $rate_cost;
////            $estimate_revenue = $dataChart1[count($dataChart1) - 1]['revenue'];
////            $estimate_cost = $dataChart1[count($dataChart1) - 1]['cost'];
////            $estimate_revenue = 0;
////            $estimate_cost = 0;
////            $label_time = ($config['data']['type'] === 3) ? TEXT_DAY : TEXT_MONTH;
//            $dataTotal = [
//                'revenue' => $this->numberFormat($revenue),
//                'cost' => $this->numberFormat($cost),
//                'profit' => $this->numberFormat($profit),
////                'rate_profit' => $this->numberFormat(($this->rateDefaultTemplate($profit, $revenue)) * 100) . '%',
////                'average_revenue' => $this->numberFormat(($this->rateDefaultTemplate($rate_revenue, $config['data']['lastTime'] - 2))) . '%/' . $label_time,
////                'average_cost' => $this->numberFormat(($this->rateDefaultTemplate($rate_cost, $config['data']['lastTime'] - 2))) . '%/' . $label_time,
////                'average_profit' => $this->numberFormat(($this->rateDefaultTemplate($rate_profit, $config['data']['lastTime'] - 2))) . '%/' . $label_time,
////                'estimate_revenue' => $this->numberFormat($estimate_revenue),
////                'estimate_cost' => $this->numberFormat($estimate_cost),
////                'estimate_profit' => $this->numberFormat($estimate_revenue - $estimate_cost),
////                'index' => $config['data']['lastTime'],
////
////                'total_1' => $this->numberFormat($config['data']['chart'][count($config['data']['chart']) - 1]['revenue_chart_three']),
////                'total_2' => $this->numberFormat($config['data']['chart'][count($config['data']['chart']) - 1]['cost_chart_three']),
////                'total_3' => $this->numberFormat($config['data']['chart'][count($config['data']['chart']) - 1]['profit_chart_three']),
////
////                'total2_1' => $this->numberFormat($config['data']['chart'][count($config['data']['chart']) - 1]['revenue_chart_four']),
////                'total2_2' => $this->numberFormat($config['data']['chart'][count($config['data']['chart']) - 1]['cost_chart_four']),
////                'total2_3' => $this->numberFormat($config['data']['chart'][count($config['data']['chart']) - 1]['profit_chart_four']),
//            ];
//
//            return [$dataChart1, $dataChart2, $dataTotal, $dataChart3, $dataChart4, $config];
//        } catch (Exception $e) {
//            return $this->catchTemplate($config, $e);
//        }
//    }

    public function labelBusinessGrowth($total, $amount, $amountBefore, $date, $dateBefore, $rate, $text)
    {
        if ($rate > 0) {
            $rate = '<i class="fa fa-arrow-up text-success"> ' . number_format($rate, 1) . '%</i>';
        } elseif ($rate === 0) {
            $rate = '<i class="fa fa-dot-circle-o text-warning"> ' . number_format($rate, 1) . '%</i>';
        } else {
            $rate = '<i class="fa fa-arrow-down text-danger"> ' . number_format($rate, 1) . '%</i>';
        }
        return '<b>' . $text . ' tổng: </b> ' . $this->numberFormat($total) . '</br>
                <b>' . $text . ' ' . $date . ': </b> ' . $this->numberFormat($amount) . '</br>
                <b>Tăng trưởng: </b> ' . $rate . '</br>';
    }

    public function labelBusinessProfitGrowth($total, $amount, $date, $rate, $rate2, $text)
    {
        if ($rate > 0) {
            $rate = '<i class="fa fa-arrow-up text-success"> ' . number_format($rate, 1) . '%</i>';
        } elseif ($rate === 0) {
            $rate = '<i class="fa fa-dot-circle-o text-warning"> ' . number_format($rate, 1) . '%</i>';
        } else {
            $rate = '<i class="fa fa-arrow-down text-danger"> ' . number_format($rate, 1) . '%</i>';
        }
        if ($rate2 > 0) {
            $rate2 = '<i class="fa fa-arrow-up text-success"> ' . number_format($rate2, 1) . '%</i>';
        } elseif ($rate2 === 0) {
            $rate2 = '<i class="fa fa-dot-circle-o text-warning"> ' . number_format($rate2, 1) . '%</i>';
        } else {
            $rate2 = '<i class="fa fa-arrow-down text-danger"> ' . number_format($rate2, 1) . '%</i>';
        }
        return '<b>' . $text . ' tổng: </b> ' . $this->numberFormat($total) . '</br>
                <b>' . $text . ' ' . $date . ': </b> ' . $this->numberFormat($amount) . '</br>
                <b>Tăng trưởng: </b> ' . $rate . '(' . $rate2 . ')';
    }

    public function dataAnalysisCost(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');
        $isReal = Config::get('constants.type.checkbox.GET_ALL');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_ANALYSIS_COST_V2, $brand, $branch, $type, $time, $from, $to, $isReal);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $dataChart = [];
            $data = $config['data'];
            foreach ($data as $db) {
                array_push($dataChart, [
                    "name" => $db['addition_fee_reason_content'],
                    "value" => $db['amount'],
                    "color" => '#' . substr(md5(mt_rand()), 0, 6)
                ]);
            }
            $collection = collect($dataChart)->where('value', 0)->all();
            if (count($collection) == count($data)) {
                $dataChart = [];
            }
            $dataTotal = $this->numberFormat(array_sum(array_column($config['data'], 'amount')));

            return [$dataChart, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    } //done

    /**
     * BÁO CÁO DOANH THU BÁN HÀNG
     * @param Request $request
     * @return array
     */
    public function dataRevenueReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');
        $api = sprintf(API_REPORT_GET_REVENUE_CURRENT, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $requestRevenueCurrent = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_REPORT_GET_REVENUE_ADJACENT, $brand, $branch, $type, $time, $from, $to);
        $requestRevenueAdjacent = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_REPORT_GET_REVENUE_SAME_PERIOD, $brand, $branch, $type, $time, $from, $to);
        $requestRevenueSamePeriod = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestRevenueCurrent, $requestRevenueAdjacent, $requestRevenueSamePeriod]);
        try {
            $dataChart2 = [];
            $dataChart3 = [];
            $dataRevenueCurrent = $configAll[0]['data'];
            $dataRevenueAdjacent = $configAll[1]['data'];
            $dataRevenueSamePeriod = $configAll[2]['data'];
            $dataChart1 = [
                "timeline" => collect($dataRevenueCurrent['list'])->pluck('report_time')->map(function ($item, $key) use ($type) {
                    return $this->covertTimeReport($item, $type, $key);
                }),
                "value" => collect($dataRevenueCurrent['list'])->pluck('total_revenue'),
                "quantity" => collect($dataRevenueCurrent['list'])->pluck('total_order'),
                "total_amount" => $this->numberFormat($dataRevenueCurrent['total_revenue'])
            ];
            foreach ($dataRevenueAdjacent['list'] as $key => $value) {
                array_push($dataChart2, [
                    "timeline" => $this->covertTimeReport($value['report_time'], $type, $key),
                    "label" => $this->numberFormat($value['rate_revenue_adjacent']) . '%',
                    "label_text" => 'Doanh thu liền kề (' . $value['report_time'] . '):' . $this->numberFormat($value['total_revenue']) . '<br>Doanh thu hiện tại (' . $value['report_current_time'] . '):' . $this->numberFormat($value['total_current_revenue']) . '<br> Tỷ lệ tăng trưởng:' . $this->numberFormat($value['rate_revenue_adjacent']),
                    "value" => $value['rate_revenue_adjacent']
                ]);
            }
            foreach ($dataRevenueSamePeriod['list'] as $key => $value) {
                array_push($dataChart3, [
                    "timeline" => $this->covertTimeReport($value['report_time'], $type, $key),
                    "label" => $this->numberFormat($value['rate_revenue_same_period']) . '%',
                    "label_text" => 'Doanh thu cùng kỳ (' . $value['report_time'] . '):' . $this->numberFormat($value['total_revenue']) . '<br>Doanh thu hiện tại (' . $value['report_current_time'] . '):' . $this->numberFormat($value['total_current_revenue']) . '<br> Tỷ lệ tăng trưởng:' . $this->numberFormat($value['rate_revenue_same_period']),
                    "value" => $value['rate_revenue_same_period']
                ]);
            }

            ($dataRevenueSamePeriod['total_rate_revenue_same_period'] > 0) ? $rate_same_period = '<i class="fa fa-arrow-up text-success"></i>' . $this->numberFormat($dataRevenueSamePeriod['total_rate_revenue_same_period']) . '%' : $rate_same_period = '<i class="fa fa-arrow-down text-danger"></i>' . $this->numberFormat($dataRevenueSamePeriod['total_rate_revenue_same_period']) . '%';
            $dataTotal = [
                'amount' => $this->numberFormat($configAll[0]['data']['total_revenue']),
                'adjacent' => $this->numberFormat($configAll[1]['data']['total_revenue_adjacent']),
                'same_period' => $this->numberFormat($configAll[2]['data']['total_revenue_same_period']),
                'rate_same_period' => $rate_same_period,
            ];
            return [$dataChart1, $dataChart2, $dataChart3, $dataTotal, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    } //done

    public function dataCostReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');
        $api = sprintf(API_REPORT_GET_COST_CURRENT, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $requestCostCurrent = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_REPORT_GET_COST_ADJACENT, $brand, $branch, $type, $time, $from, $to);
        $requestCostAdjacent = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_REPORT_GET_COST_SAME_PERIOD, $brand, $branch, $type, $time, $from, $to);
        $requestCostSamePeriod = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestCostCurrent, $requestCostAdjacent, $requestCostSamePeriod]);
        try {
            $dataCostCurrent = $configAll[0]['data'];
            $dataCostAdjacent = $configAll[1]['data'];
            $dataCostSamePeriod = $configAll[2]['data'];
            $dataChart1 = [];
            $dataChart2 = [];
            $dataChart3 = [];
            $dataChart1 = [
                "timeline" => collect($dataCostCurrent['list'])->pluck('report_time')->map(function ($item, $key) use ($type) {
                    return $this->covertTimeReport($item, $type, $key);
                }),
                "value" => collect($dataCostCurrent['list'])->pluck('total_cost')
            ];
            foreach ($dataCostAdjacent['list'] as $key => $db) {
                $dataChart2[] = [
                    "timeline" => $this->covertTimeReport($db['report_current_time'], $type, $key),
                    "label" => $this->numberFormat($db['rate_cost_adjacent']) . '%',
                    "label_text" => 'Chi phí liền kề (' . $db['report_time'] . '): ' . $this->numberFormat($db['total_cost']) . '<br>Chi phí hiện tại (' . $db['report_current_time'] . '): ' . $this->numberFormat($db['total_current_cost']) . '<br> Tỷ lệ tăng trưởng: ' . $this->numberFormat($db['rate_cost_adjacent']),
                    "value" => $db['rate_cost_adjacent']
                ];
            }
            foreach ($dataCostSamePeriod['list'] as $key => $db) {
                $dataChart3[] = [
                    "timeline" => $this->covertTimeReport($db['report_time'], $type, $key),
                    "label" => $this->numberFormat($db['rate_cost_same_period']) . '%',
                    "label_text" => 'Chi phí cùng kỳ (' . $db['report_time'] . '):' . $this->numberFormat($db['total_cost']) . '<br>Chi phí hiện tại (' . $db['report_current_time'] . '):' . $this->numberFormat($db['total_current_cost']) . '<br> Tỷ lệ tăng trưởng:' . $this->numberFormat($db['rate_cost_same_period']),
                    "value" => $db['rate_cost_same_period']
                ];
            }
            ($configAll[2]['data']['total_rate_cost_same_period'] > 0) ? $rate_same_period = '<i class="fa fa-arrow-up text-success"></i>' . $this->numberFormat($configAll[2]['data']['total_rate_cost_same_period']) . '%' : $rate_same_period = '<i class="fa fa-arrow-down text-danger"></i>' . $this->numberFormat($configAll[2]['data']['total_rate_cost_same_period']) . '%';
            $dataTotal = [
                'amount' => $this->numberFormat($configAll[0]['data']['total_cost']),
                'adjacent' => $this->numberFormat($configAll[1]['data']['total_cost_adjacent']),
                'same_period' => $this->numberFormat($configAll[2]['data']['total_cost_same_period']),
                'rate_same_period' => $rate_same_period,
            ];
            return [$dataChart1, $dataChart2, $dataChart3, $dataTotal, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    } //done

    public function dataProfitReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');
        $api = sprintf(API_REPORT_GET_PROFIT_CURRENT, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $requestProfitCurrent = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_REPORT_GET_PROFIT_ADJACENT, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $requestProfitAdjacent = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_REPORT_GET_PROFIT_SAME_PERIOD, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $requestProfitSamePeriod = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestProfitCurrent, $requestProfitAdjacent, $requestProfitSamePeriod]);
        try {
            $dataProfitCurrent = $configAll[0]['data'];
            $dataProfitAdjacent = $configAll[1]['data'];
            $dataProfitSamePeriod = $configAll[2]['data'];
            $dataChart2 = [];
            $dataChart3 = [];
            $dataChart1 = [
                "timeline" => collect($dataProfitCurrent['list'])->map(function ($item, $key) use ($type) {
                    return $this->covertTimeReport($item['report_time'], $type, $key);
                }),
                "value" => collect($configAll[0]['data']['list'])->pluck('total_profit_amount')
            ];
            foreach ($dataProfitAdjacent['list'] as $key => $db) {
                array_push($dataChart2, [
                    "timeline" => $this->covertTimeReport($db['report_current_time'], $type, $key),
                    "label" => $this->numberFormat($db['rate_business_and_profit_adjacent']) . '%',
                    "label_text" => 'Lợi nhuận liền kề (' . $this->covertTimeReport($db['report_time'], $type, $key) . '):' . $this->numberFormat($db['total_profit_amount']) . '<br>Lợi nhuận hiện tại (' . $this->covertTimeReport($db['report_current_time'], $type, $key) . '):' . $this->numberFormat($db['total_current_profit_amount']) . '<br> Tỷ lệ tăng trưởng:' . $this->numberFormat($db['rate_business_and_profit_adjacent']),
                    "value" => $db['rate_business_and_profit_adjacent']
                ]);
            }
            foreach ($dataProfitSamePeriod['list'] as $key => $db) {
                array_push($dataChart3, [
                    "timeline" => $this->covertTimeReport($db['report_current_time'], $type, $key),
                    "label" => $this->numberFormat($db['rate_profit_same_period']) . '%',
                    "label_text" => 'Lợi nhuận cùng kỳ (' . $this->covertTimeReport($db['report_time'], $type, $key) . '):' . $this->numberFormat($db['total_profit_amount']) . '<br>Lợi nhuận hiện tại (' . $this->covertTimeReport($db['report_current_time'], $type, $key) . '):' . $this->numberFormat($db['total_current_profit_amount']) . '<br> Tỷ lệ tăng trưởng:' . $this->numberFormat($db['rate_profit_same_period']),
                    "value" => $db['rate_profit_same_period']
                ]);
            }
            ($dataProfitSamePeriod['total_rate_profit_same_period'] > 0) ? $rate_same_period = '<i class="fa fa-arrow-up text-success"></i>' . $this->numberFormat($dataProfitSamePeriod['total_rate_profit_same_period']) . '%' : $rate_same_period = '<i class="fa fa-arrow-down text-danger"></i>' . $this->numberFormat($dataProfitSamePeriod['total_rate_profit_same_period']) . '%';
            $dataTotal = [
                'amount' => $this->numberFormat($dataProfitCurrent['total_profit']),
                'adjacent' => $this->numberFormat($dataProfitAdjacent['total_profit_adjacent']),
                'same_period' => $this->numberFormat($dataProfitSamePeriod['total_profit_same_period']),
                'rate_same_period' => $rate_same_period,
            ];

            return [$dataChart1, $dataChart2, $dataChart3, $dataTotal, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    } //done

    public function dataDebtReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_DEBT, $brand, $branch, $type, $time);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $dataTotal = [
                'paid_count' => $this->numberFormat($config['data']['paid_count']),
                'paid_amount' => $this->numberFormat($config['data']['paid_amount']),
                'number_return_session' => $this->numberFormat($config['data']['return_count']),
                'total_return_amount' => $this->numberFormat(abs($config['data']['total_return_amount'])),
                'waiting_payment_count' => $this->numberFormat($config['data']['waiting_payment_count']),
                'waiting_payment_amount' => $this->numberFormat($config['data']['waiting_payment_amount']),
                'number_session' => $this->numberFormat($config['data']['count']),
                'total_amount' => $this->numberFormat($config['data']['total_amount']),
                'debt_count' => $this->numberFormat($config['data']['debt_count']),
                'debt_amount' => $this->numberFormat($config['data']['debt_amount'])
            ];
            return [$dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    } //done

    /**
     * BÁO CÁO CÔNG NỢ
     */
    public function dataSupplierDebtReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = ENUM_ID_NONE;
        $to = ENUM_ID_NONE;
        $supplier = ENUM_ID_NONE;
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_SUPPLIER_DEBT, $brand, $branch, $type, $time, $from, $to, $supplier);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $dataTable = DataTables::of($data)
                ->addColumn('debt_amount', function ($row) {
                    return $this->numberFormat($row['debt_amount']);
                })
                ->addColumn('watting_payment', function ($row) {
                    return $this->numberFormat($row['watting_payment']);
                })
                ->addColumn('paid_amount', function ($row) {
                    return $this->numberFormat($row['paid_amount']);
                })
                ->addColumn('owed_amount', function ($row) {
                    return $this->numberFormat($row['owed_amount']);
                })
                ->addColumn('action', function ($row) use ($type) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" data-id="' . $row['supplier_id'] . '" data-type="' . $type . '" onclick="openModalDetailSupplierDebtReport($(this))"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'debt_amount', 'watting_payment', 'paid_amount', 'owed_amount', 'keysearch'])
                ->addIndexColumn()
                ->make(true);
            return [$dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataDetailSupplierDebtReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $supplier = $request->get('id');
        $type = $request->get('type');
        $date_string = $request->get('date_string');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_DETAIL_SUPPLIER_DEBT, $brand, $branch, $supplier, $type, $date_string);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $dataTable = DataTables::of($data)
                ->addColumn('debt_amount', function ($row) {
                    return $this->numberFormat($row['debt_amount']);
                })
                ->addColumn('paid_amount', function ($row) {
                    return $this->numberFormat($row['paid_amount']);
                })
                ->addColumn('owed_amount', function ($row) {
                    return $this->numberFormat($row['owed_amount']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            return [$dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataInventoryReport(Request $request)
    {
        $time = $request->get('time');
        $branch = $request->get('branch');
        $brand = $request->get('brand');
        $from = $request->get('from');
        $to = $request->get('to');
        $type = $request->get('type');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_WAREHOUSE_SESSION, $brand, $branch, $from, $to, $type, $time);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $data_material = [];
            $data_goods = [];
            $data_other = [];
            $data_internal = [];
            $data_detail = array_values(collect($data)->where('material_category_parent_id', 0)->all());
            foreach ($data as $db) {
                switch ($db['material_category_parent_id']) {
                    case (int)Config::get('constants.type.inventory.MATERIAL'):
                        array_push($data_material, [
                            'name' => $db['name'],
                            'total_price' => $this->numberFormat($db['total_price']),
                        ]);
                        break;
                    case (int)Config::get('constants.type.inventory.GOODS'):
                        array_push($data_goods, [
                            'name' => $db['name'],
                            'total_price' => $this->numberFormat($db['total_price']),
                        ]);
                        break;
                    case (int)Config::get('constants.type.inventory.INTERNAL'):
                        array_push($data_internal, [
                            'name' => $db['name'],
                            'total_price' => $this->numberFormat($db['total_price']),
                        ]);
                        break;
                    case (int)Config::get('constants.type.inventory.OTHER'):
                        array_push($data_other, [
                            'name' => $db['name'],
                            'total_price' => $this->numberFormat($db['total_price']),
                        ]);
                        break;
                }
            }
            $data_total = [
                'total_in_internal' => collect($data)->where('material_category_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_INTERNAL)->pluck('total_price')->sum(),
                'total_in_goods' => collect($data)->where('material_category_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_GOODS)->pluck('total_price')->sum(),
                'total_in_other' => collect($data)->where('material_category_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_OTHER)->pluck('total_price')->sum(),
                'total_in_material' => collect($data)->where('material_category_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_MATERIAL)->pluck('total_price')->sum(),
            ];
            return [$data_material, $data_goods, $data_other, $data_internal, $config['data'], $data_detail, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function dataFoodReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $category = '1';
        $categoryID = Config::get('constants.type.id.GET_ALL');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');;
        $to = $request->get('to');
        $type_sort = $request->get('type_sort');
        $isGift = Config::get('constants.type.checkbox.DIS_SELECTED');
        $isCombo = Config::get('constants.type.checkbox.GET_ALL');
        $isCancel = Config::get('constants.type.checkbox.DIS_SELECTED');
        $isTakeAway = Config::get('constants.type.checkbox.GET_ALL');
        $isGoods = Config::get('constants.type.checkbox.DIS_SELECTED');
        $api = sprintf(API_REPORT_GET_PROFIT_FOOD_2, $brand, $branch, $category, $categoryID, $type, $time, $from, $to, $isGift, $isCombo, $isCancel, $isTakeAway, $isGoods, $type_sort);
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $body = null;

        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);

        try {
            $data_chart = [];
            $data_mix = $config['data']['list'];
            $i = 0;
            foreach ($data_mix as $db) {
                $data_chart[$i] = array(
                    'timeline' => $db['food_name'],
                    'revenue' => $db['total_amount'],
                    'total_original_amount' => $db['total_original_amount'],
                    'quantity' => $db['quantity']
                );
                $i++;
            }

            $dataTotalChart = [
                "Giá bán" => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_amount'))),
                "Giá vốn" => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_original_amount'))),
            ];
            return [$data_chart, $dataTotalChart, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    } //done

    public function dataDrinkReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $categoryID = Config::get('constants.type.id.GET_ALL');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');;
        $to = $request->get('to');
        $isGift = Config::get('constants.type.checkbox.DIS_SELECTED');
        $isCombo = Config::get('constants.type.checkbox.GET_ALL');
        $isCancel = Config::get('constants.type.checkbox.DIS_SELECTED');
        $isTakeAway = Config::get('constants.type.checkbox.GET_ALL');
        $category = '2,3';
        $isGoods = Config::get('constants.type.checkbox.SELECTED');
        $type_sort = $request->get('sortSelect');
        $api = sprintf(API_REPORT_GET_PROFIT_FOOD_2, $brand, $branch, $category, $categoryID, $type, $time, $from, $to, $isGift, $isCombo, $isCancel, $isTakeAway, $isGoods, $type_sort);
        $body = null;
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');

        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);

        try {
            $chart_drink = [];
            $data_chart_drink = $config['data']['list'];
            $i = 0;
            foreach ($data_chart_drink as $db) {
                $chart_drink[$i] = array(
                    'timeline' => $db['food_name'],
                    'total_amount' => $db['total_amount'],
                    'original_amount' => $db['total_original_amount'],
                    'quantity' => $db['quantity'],
                );
                $i++;
            }
            $dataTotal = [
                'Giá bán' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_amount'))),
                'Giá vốn' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_original_amount')))
            ];
            return [$chart_drink, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    } //done

    public function dataAreaReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $form = $request->get('from');
        $to = $request->get('to');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_AREA, $brand, $branch, $type, $time, $form, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $dataChart_pie = [];
//            if ($branch == '-1') {
//                $name = collect($data)->pluck('area_name') . '-' . collect($data)->pluck('branch_name');
//            } else {
//                $name = collect($data)->pluck('area_name');
//            }
            $dataChart = [
//                "timeline" => $name,
                "timeline" => collect($data)->pluck('area_name'),
                "quantity" => collect($data)->pluck('order_count'),
                "value" => collect($data)->pluck('revenue')
            ];
            $collection = collect($data)->where('revenue', 0)->all();
            if (count($collection) !== count($dataChart['value'])) {
                foreach ($data as $db) {
                    $dataChart_pie[] = [
                        "timeline" => $db['area_name'],
                        "name" => $db['area_name'],
                        "value" => $db['revenue'],
                    ];
                }
            }
            $total = [
                'total' => $this->numberFormat($config['data']['total_revenue_amount']),
                'length' => count($data)
            ];
            return [$dataChart, $dataChart_pie, $total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    } //done

    public function dataEmployeeReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $form = $request->get('form');
        $to = $request->get('to');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_EMPLOYEE_V2, $brand, $branch, $type, $time, $form, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $total = $this->numberFormat(array_sum(array_column($config['data']['list'], 'revenue')));
            $dataChart = [
                "timeline" => collect($config['data']['list'])->pluck('employee_name'),
                "value" => collect($config['data']['list'])->pluck('revenue'),
                "quantity" => collect($config['data']['list'])->pluck('order_count'),
                "total_amount" => $total
            ];
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $dataTable = DataTables::of($config['data']['list'])
                ->addColumn('revenue', function ($row) {
                    return $this->numberFormat($row['revenue']);
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>';
                })
                ->rawColumns(['avatar'])
                ->addIndexColumn()
                ->make(true);

            return [$dataChart, $dataTable, $total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataCustomerReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_CUSTOMER, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            foreach ($data as $key => $db) {
                $data[$key]['report_time'] = $this->covertTimeReport($db['report_time'], $type, $key);
            }
            $dataChart = [
                'customer' => [
                    'timeline' => collect($data)->pluck('report_time'),
                    'restaurant' => [
                        'order_count' => $this->numberFormat($config['data']['total_orders']),
                        'value' => collect($data)->pluck('total_customer_go_to_restaurant')
                    ],
                    'receiving_gifts' => [
                        'order_count' => $this->numberFormat($config['data']['total_orders']),
                        'value' => collect($data)->pluck('total_customer_receiving_gifts')
                    ],
                    'register' => [
                        'order_count' => $this->numberFormat($config['data']['total_orders']),
                        'value' => collect($data)->pluck('total_customer_register')
                    ],
                    'use_point' => [
                        'order_count' => $this->numberFormat($config['data']['total_orders']),
                        'value' => collect($data)->pluck('total_customer_use_point')
                    ],
                    'save_point' => [
                        'order_count' => $this->numberFormat($config['data']['total_orders']),
                        'value' => collect($data)->pluck('total_customer_save_point')
                    ],

                ]
            ];
            $dataTotal = [
                'total_customer_come_to_restaurant' => $this->numberFormat($config['data']['total_customer_go_to_restaurant']),
                'total_customer_used_aloline' => $this->numberFormat($config['data']['total_customer_register']),
                'total_customer_used_point' => $this->numberFormat($config['data']['total_customer_use_point']),
                'total_customer_point_added' => $this->numberFormat($config['data']['total_customer_save_point']),
                'total_customer_receive_gifts' => $this->numberFormat($config['data']['total_customer_receiving_gifts']),
                'total_orders' => $this->numberFormat($config['data']['total_orders']),
            ];
            return [$dataChart, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    } //done

    public function dataGiftFoodReport(Request $request) //done
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = ENUM_SELECTED; /* 1 - Món tặng, 2- Món hủy (bao gồm hủy hao hụt), 3 - chỉ lấy món hủy hao hụt */
        $report_type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');
        $selectSort = $request->get('selectSort');
        $isGroup = ENUM_SELECTED;
        $api = sprintf(API_REPORT_GET_GIFT_FOOD, $brand, $branch, $type, $report_type, $time, $from, $to, $selectSort, $isGroup);
        $body = null;
        $chartGiftReport = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];

        $isGroup = ENUM_DEFAULT;
        $api = sprintf(API_REPORT_GET_GIFT_FOOD, $brand, $branch, $type, $report_type, $time, $from, $to, $selectSort, $isGroup);
        $tableGiftReport = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$chartGiftReport, $tableGiftReport]);
        try {
            $data_chart = [];
            $dataChart = $configAll[0]['data']['list'];
            $i = 0;
            foreach ($dataChart as $db) {
                $data_chart[$i] = array(
                    'timeline' => $db['food_name'],
                    'total_amount' => $db['total_amount'],
                    'original_amount' => $db['original_price'],
                    'quantity' => $db['quantity']
                );
                $i++;
            }

            $detail = TEXT_DETAIL;
            $dataTable = DataTables::of($configAll[1]['data']['list'])
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('action', function ($row) use ($detail) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" data-is-print="1" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-id="' . $row['order_id'] . '" data-cancel="0" onclick="openBillDetail($(this))"><i class="fi-rr-eye"></i></button>
                             </div>';
                })
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'quantity' => $this->numberFormat(collect($configAll[1]['data']['list'])->sum('quantity')),
                'total' => $this->numberFormat($configAll[1]['data']['total_amount']),
                'total_price_foods' => $this->numberFormat(collect($configAll[1]['data'])->sum('price')),
            ];

            $dataTotalChart = [
                'Giá bán' => $this->numberFormat($configAll[1]['data']['total_amount']),
                'Giá vốn' => $this->numberFormat($configAll[1]['data']['total_original_amount']),
            ];
            return [$data_chart, $dataTable, $dataTotal, $dataTotalChart, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataDiscountReport(Request $request) //done
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $form = $request->get('from');
        $to = $request->get('to');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_DISCOUNT, $brand, $branch, $type, $time, $form, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $dataChart = [];
            foreach ($data as $key => $db) {
                $config['data']['list'][$key]['report_time'] = $this->convertTimeReport($db['report_time'], $type, '');
            }
            $dataChart = [
                "timeline" => collect($data)->pluck('report_time')->map(function ($item, $key) use ($type) {
                    return $this->covertTimeReport($item, $type, $key);
                }),
                "value" => collect($data)->pluck('total_amount'),
                "quantity" => collect($data)->pluck('order_quantity'),
                "total_amount" => $this->numberFormat($config['data']['total_amount'])
            ];
            $total = $this->numberFormat($config['data']['total_amount']);
            return [$dataChart, $total, collect($data)->pluck('total_amount')->sum(), $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataSurchargeReport(Request $request) //done
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_SURCHARGE, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $dataChart = [
                "timeline" => collect($data)->pluck('report_time')->map(function ($item, $key) use ($type) {
                    return $this->covertTimeReport($item, $type, $key);
                }),
                "value" => collect($data)->pluck('total_amount'),
                "quantity" => collect($data)->pluck('total_order'),
                "total_amount" => $this->numberFormat(collect($data)->sum('total_amount')),
            ];

            return [$dataChart, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataProfitFoodReport(Request $request) //done
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $category = Config::get('constants.type.id.GET_ALL');
        $categoryID = Config::get('constants.type.id.GET_ALL');
        $type = $request->get('type');
        $time = $request->get('time');
        $isGift = Config::get('constants.type.checkbox.DIS_SELECTED');
        $isCombo = Config::get('constants.type.checkbox.GET_ALL');
        $isCancel = Config::get('constants.type.checkbox.SELECTED');
        $isTakeAway = Config::get('constants.type.checkbox.GET_ALL');
        $isGoods = Config::get('constants.type.checkbox.DIS_SELECTED');
        $api = sprintf(API_REPORT_GET_PROFIT_FOOD, $brand, $branch, $category, $categoryID, $type, $time, $isGift, $isCombo, $isCancel, $isTakeAway, $isGoods);
        $body = null;
        $requestFood = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $isGoods = Config::get('constants.type.checkbox.SELECTED');
        $api = sprintf(API_REPORT_GET_PROFIT_FOOD, $brand, $branch, $category, $categoryID, $type, $time, $isGift, $isCombo, $isCancel, $isTakeAway, $isGoods);
        $body = null;
        $requestDrink = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestFood, $requestDrink]);
        try {
            $dataChartFood = [];
            $dataChartDrink = [];
            foreach ($configAll[0]['data']['list'] as $db) {
                array_push($dataChartFood, [
                    "timeline" => $db['food_name'],
                    "value" => $db['profit']
                ]);
            }
            foreach ($configAll[1]['data']['list'] as $db) {
                array_push($dataChartDrink, [
                    "timeline" => $db['food_name'],
                    "value" => $db['profit']
                ]);
            }
            $total = [
                "total_food" => $this->numberFormat($configAll[0]['data']['profit']),
                "total_drink" => $this->numberFormat($configAll[1]['data']['profit']),
            ];
            return [$dataChartFood, $dataChartDrink, $total, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataOrderReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_REVENUE_ORDER, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            foreach ($data as $key => $db) {
                $data[$key]['report_time'] = $this->covertTimeReport($db['report_time'], $type, $key);
            }

            $dataTable = DataTables::of($data)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['total_revenue']);
                })
                ->addColumn('order', function ($row) {
                    return $this->numberFormat($row['total_order']);
                })
                ->make(true);
            $dataTotal = [
                'revenue' => $this->numberFormat(collect($data)->sum('total_revenue')),
                'order' => $this->numberFormat(collect($data)->sum('total_order')),
            ];
            $dataChart = [
                "timeline" => collect($data)->pluck('report_time'),
                "value" => collect($data)->pluck('total_revenue'),
                'total_amount' => $this->numberFormat(collect($data)->sum('total_revenue'))
            ];
            return [$dataChart, $dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataCategoryReport(Request $request) //done
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');
        $category = -2;
        $type_sort = $request->get('sortSelect');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_CATEGORY_FOOD_2, $brand, $branch, $type, $time, $from, $to, $category, ENUM_GET_ALL, $type_sort);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $dataChart = [];
            $dataChart_pie = [];
            $collection = collect($config['data']['list']);
            $data = $collection->SortByDesc('total_amount');
            foreach ($data as $key => $db) {
                array_push($dataChart_pie, [
                    "name" => $db['category_name'],
                    "value" => $db['total_amount'],
                    "type" => $key
                ]);
            }

            $data_chart = $config['data']['list'];
            $i = 0;
            foreach ($data_chart as $db) {
                $dataChart[$i] = array(
                    'timeline' => $db['category_name'],
                    'total_amount' => $db['total_amount'],
                    'original_amount' => $db['total_original_amount'],
                    'quantity' => $db['order_quantity']
                );
                $i++;
            }
//            $dataChart = [
//                "timeline" => $collection->pluck('category_name'),
//                "value" => $collection->pluck('total_amount'),
//                "quantity" => $collection->pluck('order_quantity'),
//                "total_amount" => $this->numberFormat($config['data']['total_amount'])
//            ];
            $collection = collect($dataChart_pie)->where('value', 0)->all();
            if (count($collection) == count($data)) {
                $dataChart_pie = [];
            }
            $total = $this->numberFormat($config['data']['total_amount']);

            $dataTotal = [
                'Giá bán' => $this->numberFormat($config['data']['total_amount']),
                'Giá vốn' => $this->numberFormat($config['data']['total_original_amount'])
            ];
            return [$dataChart, $dataChart_pie, $total, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataCustomerAccumulatePoint(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $limit = Config::get('constants.type.default.LIMIT_100');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_CUSTOMER_ACCUMULATE_POINT, $brand, $branch, $type, $time, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $dataChart = [];
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $data = collect($config['data']['list'])->sortByDesc('accumulate_point')->slice(0, 5)->toArray();
            foreach ($data as $db) {
                array_push($dataChart, [
                    "name" => $db['name'],
                    "points" => $db['accumulate_point'],
                    "color" => TEXT_INVENTORY_REPORT_COLORS_CHART[count($dataChart)],
                    "bullet" => $domain . $db['avatar'],
                ]);
            }
            $detail = TEXT_DETAIL;
            $dataTable = DataTables::of($config['data']['list'])
                ->addColumn('card', function ($row) {
                    return '<div class="waves-effect waves-light w-75 h-1rem m-auto" style="background-color: ' . $row['color_hex_code'] . '">' . $row['restaurant_membership_card_name'] . '</div>';
//                            return '<div class="waves-effect waves-light w-75 h-1rem m-auto" style="background-color: ' . $row['color_hex_code'] . '"></div>';
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>';
                })
                ->addColumn('accumulate_point', function ($row) {
                    return $this->numberFormat($row['accumulate_point']);
                })
                ->addColumn('total_accumulate_point', function ($row) {
                    return $this->numberFormat($row['total_accumulate_point']);
                })
                ->addColumn('action', function ($row) use ($detail) {
                    return '<div class="btn-group btn-group-sm text-center">
                               <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openDetailCustomers($(this))" data-id="' . $row['customer_id'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                           </div>';
                })
                ->addIndexColumn()
                ->rawColumns(['card', 'avatar', 'address', 'action'])
                ->make(true);

            return [$dataChart, $dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataCustomerUsePoint(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $keySearch = '';
        $page = ENUM_SELECTED;
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');
        $typePoint = $request->get('type_point');
        $typeSort = $request->get('type_sort');
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_CUSTOMER_USE_POINT, $brand, $branch, $type, $time, $typePoint, $from, $to, $limit, $page, $keySearch);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $dataChart = [];
            $dataTable = [];
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $detail = TEXT_DETAIL;
            $dataTotal = [];
//            $point_remaining = collect($config['data'])->reduce(function ($carry, $item) {
//                return $carry + $item["point_remaining"] + $item["accumulate_point_remaining"] + $item["promotion_point_remaining"] + $item["alo_point_remaining"];
//            }, 0);
//            $point_receive = collect($config['data'])->reduce(function ($carry, $item) {
//                return $carry + $item["accumulate_point_received"] + $item["point_received"] + $item["promotion_point_received"] + $item["alo_point_received"];
//            }, 0);
//            $total_point_receice = collect($config['data'])->reduce(function ($carry, $item) {
//                return $carry + $item["total_point_received"] + $item["total_accumulate_point_received"] + $item["total_promotion_point_received"] + $item["total_alo_point_received"];
//            }, 0);
//            $point_used = collect($config['data'])->reduce(function ($carry, $item) {
//                return $carry + $item["point_used"] + $item["accumulate_point_used"] + $item["promotion_point_used"] + $item["alo_point_used"];
//            }, 0);
//            $total_point_used = collect($config['data'])->reduce(function ($carry, $item) {
//                return $carry + $item["total_point_used"] + $item["total_accumulate_point_used"] + $item["total_promotion_point_used"] + $item["total_alo_point_used"];
//            }, 0);
            switch ((int)$typePoint) {
                case 1: // Điểm tích luỹ
                    $data = collect($config['data'])->sortByDesc('point')->slice(0, 20)->toArray();
                    foreach ($data as $key => $db) {
                        $dataChart[] = [
                            "name" => $db['name'],
                            "value" => $db['accumulate_point_used']
                        ];
                    }
                    $dataTotal = [
                        'point_remaining' => $this->numberFormat(array_sum(array_column($config['data'], 'accumulate_point_remaining'))),
                        'point_receive' => $this->numberFormat(array_sum(array_column($config['data'], 'accumulate_point_received'))),
                        'total_point_receive' => $this->numberFormat(array_sum(array_column($config['data'], 'total_accumulate_point_received'))),
                        'point_use' => $this->numberFormat(array_sum(array_column($config['data'], 'accumulate_point_used'))),
                        'total_point_use' => $this->numberFormat(array_sum(array_column($config['data'], 'total_accumulate_point_used'))),
                    ];
                    $dataTable = DataTables::of($config['data'])
                        ->addColumn('card', function ($row) {
                            return '<div class="waves-effect waves-light w-75 h-1rem m-auto" style="background-color: ' . $row['color_hex_code'] . '">' . $row['restaurant_membership_card_name'] . '</div>';
                        })
                        ->addColumn('avatar', function ($row) use ($domain) {
                            return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>';
                        })
//                        ->addColumn('point', function ($row) {
//                            return $this->numberFormat($row['accumulate_point']);
//                        })
//                        ->addColumn('total_point', function ($row) {
//                            return $this->numberFormat($row['total_accumulate_point']);
//                        })
                        ->addColumn('point_receive', function ($row) {
                            return $this->numberFormat($row['accumulate_point_received']);
                        })
                        ->addColumn('total_point_receive', function ($row) {
                            return $this->numberFormat($row['total_accumulate_point_received']);
                        })
                        ->addColumn('point_use', function ($row) {
                            return $this->numberFormat($row['accumulate_point_used']);
                        })
                        ->addColumn('total_point_use', function ($row) {
                            return $this->numberFormat($row['total_accumulate_point_used']);
                        })
                        ->addColumn('total_point_remaining', function ($row) {
                            return $this->numberFormat($row['accumulate_point_remaining']);
                        })
                        ->addColumn('action', function ($row) use ($detail) {
                            return '<div class="btn-group btn-group-sm text-center">
                               <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openDetailCustomers($(this))" data-id="' . $row['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                           </div>';
                        })
                        ->addIndexColumn()
                        ->rawColumns(['card', 'avatar', 'address', 'action'])
                        ->make(true);
                    break;
                case 2: // Điểm khuyến mãi
                    $data = collect($config['data'])->sortByDesc('point')->slice(0, 20)->toArray();
                    foreach ($data as $db) {
                        $dataChart[] = [
                            "name" => $db['name'],
                            "value" => $db['promotion_point_used'],
                        ];
                    }
                    $dataTotal = [
                        'point_remaining' => $this->numberFormat(collect($config['data'])->sum('promotion_point_remaining')),
                        'point_receive' => $this->numberFormat(collect($config['data'])->sum('promotion_point_received')),
                        'total_point_receive' => $this->numberFormat(collect($config['data'])->sum('total_promotion_point_received')),
                        'point_use' => $this->numberFormat(collect($config['data'])->sum('promotion_point_used')),
                        'total_point_use' => $this->numberFormat(collect($config['data'])->sum('total_promotion_point_used')),
                    ];
                    $dataTable = DataTables::of($config['data'])
                        ->addColumn('card', function ($row) {
                            return '<div class="waves-effect waves-light w-75 h-1rem m-auto" style="background-color: ' . $row['color_hex_code'] . '">' . $row['restaurant_membership_card_name'] . '</div>';
                        })
                        ->addColumn('avatar', function ($row) use ($domain) {
                            return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>';
                        })
                        ->addColumn('point_receive', function ($row) {
                            return $this->numberFormat($row['promotion_point']);
                        })
                        ->addColumn('total_point_receive', function ($row) {
                            return $this->numberFormat($row['total_promotion_point_received']);
                        })
                        ->addColumn('point_use', function ($row) {
                            return $this->numberFormat($row['promotion_point_used']);
                        })
                        ->addColumn('total_point_use', function ($row) {
                            return $this->numberFormat($row['total_promotion_point']);
                        })
                        ->addColumn('total_point_remaining', function ($row) {
                            return $this->numberFormat($row['promotion_point_remaining']);
                        })
                        ->addColumn('action', function ($row) use ($detail) {
                            return '<div class="btn-group btn-group-sm text-center">
                               <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openDetailCustomers($(this))" data-id="' . $row['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                           </div>';
                        })
                        ->addIndexColumn()
                        ->rawColumns(['card', 'avatar', 'address', 'action'])
                        ->make(true);
                    break;
            }
            return [$dataChart, $dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataPoint(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type_point = (int)$request->get('type_point');
        $type_sort = (int)$request->get('type_sort');
        $type = $request->get('type');
        $time = $request->get('time');
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_1000;
        $key_search = '';
        $from = $request->get('from');
        $to = $request->get('to');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_PROMOTION_POINT, $type_point, $type_sort, $type,
            $time, $key_search, $from, $to, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $data = $type_point === 0 ? $collection->SortByDesc('accumulate_point_used') : $collection->SortByDesc('promotion_point_used');
            if ($type_point === 0) {
                $data_chart = [
                    "timeline" => $data->pluck('name'),
                    "value" => $data->pluck('accumulate_point_used'),
                ];
            } else {
                $data_chart = [
                    "timeline" => $data->pluck('name'),
                    "value" => $data->pluck('promotion_point_used'),
                ];
            }

            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $detail = TEXT_DETAIL;
            $dataTable = \Yajra\DataTables\DataTables::of($data)
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>';
                })
                ->addColumn('total_point_receive', function ($row) use ($type_point) {
                    if ($type_point === 0) {
                        return $this->numberFormat($row['total_accumulate_point']);
                    } else {
                        return $this->numberFormat($row['total_promotion_point']);
                    }
                })
                ->addColumn('point_receive', function ($row) use ($type_point) {
                    if ($type_point === 0) {
                        return $this->numberFormat($row['accumulate_point']);
                    } else {
                        return $this->numberFormat($row['promotion_point']);
                    }
                })
                ->addColumn('total_point_use', function ($row) use ($type_point) {
                    if ($type_point === 0) {
                        return $this->numberFormat($row['total_accumulate_point_used']);
                    } else {
                        return $this->numberFormat($row['total_promotion_point_used']);
                    }
                })
                ->addColumn('point_use', function ($row) use ($type_point) {
                    if ($type_point === 0) {
                        return $this->numberFormat($row['accumulate_point_used']);
                    } else {
                        return $this->numberFormat($row['promotion_point_used']);
                    }
                })
                ->addColumn('total_point_remaining', function ($row) use ($type_point) {
                    if ($type_point === 0) {
                        return $this->numberFormat($row['total_accumulate_point_remaining']);
                    } else {
                        return $this->numberFormat($row['total_promotion_point_remaining']);
                    }
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $type, $time, $detail, $from, $to) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" data-id="' . $row['customer_id'] . '" onclick="openDetailCustomers($(this))"><i class="fi-rr-eye"></i></button>
                             </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['avatar', 'total_point_receive', 'point_receive', 'total_point_use', 'point_use', 'total_point_remaining', 'action'])
                ->addIndexColumn()
                ->make(true);

            if ($type_point === 0) {
                $totalRemaining = $this->numberFormat($config['data']['total_accumulate_point_remaining']);
                $totalReceive = $this->numberFormat($config['data']['total_accumulate_point']);
                $totalNumberReceive = $this->numberFormat($config['data']['accumulate_point']);
                $totalUsed = $this->numberFormat($config['data']['total_accumulate_point_used']);
                $totalNumberUsed = $this->numberFormat($config['data']['accumulate_point_used']);
            } else {
                $totalRemaining = $this->numberFormat($config['data']['total_promotion_point_remaining']);
                $totalReceive = $this->numberFormat($config['data']['total_promotion_point']);
                $totalNumberReceive = $this->numberFormat($config['data']['promotion_point']);
                $totalUsed = $this->numberFormat($config['data']['total_promotion_point_used']);
                $totalNumberUsed = $this->numberFormat($config['data']['promotion_point_used']);
            }
            $dataTotal = [
                'totalRemaining' => $totalRemaining,
                'totalReceive' => $totalReceive,
                'totalNumberReceive' => $totalNumberReceive,
                'totalUsed' => $totalUsed,
                'totalNumberUsed' => $totalNumberUsed
            ];

            return [$data_chart, $dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }


    public function dataOffDishedMenuReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $category = '1';
        $categoryID = Config::get('constants.type.id.GET_ALL');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = '';
        $to = '';
        $food_id = ENUM_DIS_SELECTED;
        $type_sort = $request->get('sortSelect');
        $isGift = Config::get('constants.type.checkbox.DIS_SELECTED');
        $isCombo = Config::get('constants.type.checkbox.GET_ALL');
        $isCancel = Config::get('constants.type.checkbox.DIS_SELECTED');
        $isTakeAway = Config::get('constants.type.checkbox.GET_ALL');
        $isGoods = Config::get('constants.type.checkbox.DIS_SELECTED');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_OFF_DISHED_MENU_2, $brand, $branch, $category, $categoryID, $food_id, $type, $time, $from, $to, $isGift, $isCombo, $isCancel, $isTakeAway, $isGoods, $type_sort);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data_chart = [];
            $data = collect($config['data']['list'])->toArray();
//            $dataChart = [
//                "timeline" => collect($data)->pluck('food_name'),
//                "value" => collect($data)->pluck('total_amount'),
//                "quantity" => collect($data)->pluck('quantity'),
//                "total_amount" => $this->numberFormat($config['data']['total_amount'])
//            ];

            $i = 0;
            foreach ($data as $db) {
                $data_chart[$i] = array(
                    'timeline' => $db['food_name'],
                    'total_amount' => $db['total_amount'],
                    'original_amount' => $db['total_original_amount'],
                    'quantity' => $db['quantity']
                );
                $i++;
            }
            $total = [
                "total_food" => $this->numberFormat($config['data']['total_amount']),
            ];
            $dataTotal = [
                'Giá bán' => $this->numberFormat($config['data']['total_amount']),
                'Giá vốn' => $this->numberFormat($config['data']['total_original_amount']),
            ];
            return [$data_chart, $total, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    } //done

    public function dataFoodCancelReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type_sort = $request->get('selectSort');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = '';
        $to = '';
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_FOOD_CANCEL, $brand, $branch, $type_sort, $type, $time, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data_chart = [];
            $data = collect($config['data']['list'])->toArray();
//            $dataChart = [
//                "timeline" => collect($data)->pluck('food_name'),
//                "value" => collect($data)->pluck('total_amount'),
//                "quantity" => collect($data)->pluck('quantity'),
//                "total_amount" => $this->numberFormat($config['data']['total_amount'])
//            ];

            $i = 0;
            foreach ($data as $db) {
                $data_chart[$i] = array(
                    "timeline" => $db['food_name'],
                    "total_amount" => $db['total_amount'],
                    "original_amount" => $db['original_price'],
                    "quantity" => $db['quantity'],
                );
                $i++;
            }

            $total = [
                "total_food" => $this->numberFormat($config['data']['total_amount']),
            ];

            $dataTotal = [
                'Giá bán' => $this->numberFormat($config['data']['total_amount']),
                'Giá vốn' => $this->numberFormat($config['data']['total_original_amount']),
            ];
            return [$data_chart, $total, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    } //done

    public function dataTakeAwayReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $is_take_away_food = ENUM_SELECTED;
        $from = '';
        $to = '';
        $type_sort = $request->get('sortSelect');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_TAKE_AWAY_FOOD_DASHBOARD, $brand, $branch, $is_take_away_food, $type, $time, $from, $to, $type_sort);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data_chart = [];
            $data = collect($config['data']['list'])->toArray();
//            $dataChart = [
//                "timeline" => collect($data)->pluck('food_name'),
//                "value" => collect($data)->pluck('total_amount'),
//                "quantity" => collect($data)->pluck('quantity'),
//                "total_amount" => $this->numberFormat($config['data']['total_amount'])
//            ];

            $i = 0;
            foreach ($data as $db) {
                $data_chart[$i] = array(
                    'timeline' => $db['food_name'],
                    'total_amount' => $db['total_amount'],
                    'original_amount' => $db['total_original_amount'],
                    'quantity' => $db['quantity']
                );
                $i++;
            }
            $total = [
                "total_food" => $this->numberFormat($config['data']['total_amount']),
            ];

            $dataTotal = [
                'Giá bán' => $this->numberFormat($config['data']['total_amount']),
                'Giá vốn' => $this->numberFormat($config['data']['total_original_amount']),
            ];
            return [$data_chart, $total, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    } //done

    public function dataVatFoodReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = '';
        $to = '';
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_VAT, $brand, $branch, $time, $from, $to, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = collect($config['data']['list'])->toArray();
            $dataChart = [
                "timeline" => collect($data)->pluck('report_time')->map(function ($item, $key) use ($type) {
                    return $this->covertTimeReport($item, $type, $key);
                }),
                "value" => collect($data)->pluck('vat_amount'),
                "quantity" => collect($data)->pluck('order_quantity'),
                "total_amount" => $this->numberFormat($config['data']['vat_amount'])
            ];
            return [$dataChart, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    } //done

    public function detailRevenue(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $objectType = $request->get('object_type');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $key = $this->keySearch(($request->get('search'))['value']);
        $limit = Config::get('constants.type.default.LIMIT_100');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_DETAIL_REVENUE, $brand, $branch, $type, $time, $objectType, $page, $limit, $key);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $detail = TEXT_DETAIL;;
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount']);
                if (mb_strlen($config['data']['list'][$i]['object_name']) > 30) $config['data']['list'][$i]['object_name'] = mb_substr($config['data']['list'][$i]['object_name'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $config['data']['list'][$i]['object_name'] . '"></i>';
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" onclick="openModalDetailReceiptsBill(' . $config['data']['list'][$i]['id'] . ')"><i class="fi-rr-eye"></i></button>
                        </div>';
                switch ($config['data']['list'][$i]['status']) {
                    case Config::get('constants.type.AdditionFeeStatusEnum.WAITING_PAYMENT'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-warning">' . TEXT_PAYMENT_APPROVED . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRMED'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-success">' . TEXT_SALARY_CONFIRMED . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-danger">' . TEXT_CANCELED_ENUM . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.PAID'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-success">' . TEXT_WAITING . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL_PAYMENT'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-danger">' . TEXT_CANCEL_PAYMENT . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL_PAYMENT_REFUNDED'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-success">' . Config::get('constants.TEXT_CANCEL_PAYMENT_REFUNDED') . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRM_PAYMENT'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-warning">' . TEXT_CONFIRMED_PAYMENT . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.ORDER_PAYMENT'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-success">' . TEXT_SUPPLIER_PAID . '</label>';
                        break;
                    default:
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-inverse">' . TEXT_OTHER . '</label>';
                }
            }
            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_record' => $this->numberFormat($config['data']['total_record']),
                'total_amount' => $this->numberFormat($config['data']['total_amount']),
                'key' => $key,
                'page' => $page,
                'config' => $config
            );
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detailRevenueOrder(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $limit = 100;
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $order_status = Config::get('constants.type.order_status.ORDER_STATUS_REPORT'); //2,5
        $area_id = Config::get('constants.type.data.NONE');
        $order_id = Config::get('constants.type.data.NONE');
        $table_ids = Config::get('constants.type.data.NONE');
        $from = $request->get('from');
        $to = $request->get('to');
        $key = $this->keySearch(($request->get('search'))['value']);
        $api = sprintf(API_LIST_ORDER_GET, $branch_id, $limit, $page, $order_status, $area_id, $order_id, $table_ids, $from, $to, $key, $restaurant_brand_id);
        $body = null;
        $requestList = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_LIST_ORDER_GET_TOTAL, $branch_id, $order_status, $area_id, $order_id, $table_ids, $from, $to, $key);
        $body = null;
        $requestTotal = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTotal]);
        try {

            $config = $configAll[0];
            $detail = TEXT_DETAIL;
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                if (mb_strlen($config['data']['list'][$i]['employee']['name']) > 20) {
                    $config['data']['list'][$i]['employee_full_name'] = mb_substr($config['data']['list'][$i]['employee']['name'], 0, 20) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $config['data']['list'][$i]['employee']['name'] . '"></i>';
                } else {
                    $config['data']['list'][$i]['employee_full_name'] = $config['data']['list'][$i]['employee']['name'];
                }
                $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount'] - $config['data']['list'][$i]['vat_amount']);
                switch ($config['data']['list'][$i]['order_status']) {
                    case (int)Config::get('constants.type.order_status.OPENING'):
                        $config['data']['list'][$i]['order_status_name'] = '<span class="text-info">' . $config['data']['list'][$i]['order_status_name'] . '</span>';
                        break;
                    case (int)Config::get('constants.type.order_status.WAITING_PAYMENT'):
                    case (int)Config::get('constants.type.order_status.WAITING_COMPLETE'):
                    case (int)Config::get('constants.type.order_status.DELIVERING'):
                        $config['data']['list'][$i]['order_status_name'] = '<span class="text-primary">' . $config['data']['list'][$i]['order_status_name'] . '</span>';
                        break;
                    case (int)Config::get('constants.type.order_status.DONE'):
                        $config['data']['list'][$i]['order_status_name'] = '<span class="text-success">' . $config['data']['list'][$i]['order_status_name'] . '</span>';
                        break;
                    case (int)Config::get('constants.type.order_status.MERGED'):
                        $config['data']['list'][$i]['order_status_name'] = '<span class="text-inverse">' . $config['data']['list'][$i]['order_status_name'] . '</span>';
                        break;
                    case (int)Config::get('constants.type.order_status.PENDING'):
                        $config['data']['list'][$i]['order_status_name'] = '<span class="text-warning">' . $config['data']['list'][$i]['order_status_name'] . '</span>';
                        break;
                    default:
                        $config['data']['list'][$i]['order_status_name'] = '<span class="text-danger">' . $config['data']['list'][$i]['order_status_name'] . '</span>';
                }
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-is-print="1" data-id="' . $config['data']['list'][$i]['id'] . '" data-cancel="0" onclick="openBillDetail($(this))"><i class="fi-rr-eye"></i></button>
                            </div>';
            }
            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],

                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_record' => $this->numberFormat($config['data']['total_record']),
                'key' => $key,
                'page' => $page,
                'config' => $configAll
            );
            $config = $configAll[1];
            $data_table['total_amount'] = $this->numberFormat($config['data']['total_amount'] - $config['data']['vat_amount']);
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function detailCost(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $isCurrent = $request->get('is_current');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $key = $this->keySearch(($request->get('search'))['value']);
        $limit = Config::get('constants.type.default.LIMIT_100');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_DETAIL_COST, $brand, $branch, $type, $time, $isCurrent, $page, $limit, $key);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $detail = TEXT_DETAIL;;
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount']);
                if (mb_strlen($config['data']['list'][$i]['object_name']) > 30) $config['data']['list'][$i]['object_name'] = mb_substr($config['data']['list'][$i]['object_name'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $config['data']['list'][$i]['object_name'] . '"></i>';
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" onclick="openModalDetailReceiptsBill(' . $config['data']['list'][$i]['id'] . ')"><i class="fi-rr-eye"></i></button>
                        </div>';
                switch ($config['data']['list'][$i]['status']) {
                    case Config::get('constants.type.AdditionFeeStatusEnum.WAITING_PAYMENT'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-warning">' . TEXT_PAYMENT_APPROVED . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRMED'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-success">' . TEXT_SALARY_CONFIRMED . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-danger">' . TEXT_CANCELED_ENUM . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.PAID'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-success">' . TEXT_WAITING . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL_PAYMENT'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-danger">' . TEXT_CANCEL_PAYMENT . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CANCEL_PAYMENT_REFUNDED'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-success">' . Config::get('constants.TEXT_CANCEL_PAYMENT_REFUNDED') . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.CONFIRM_PAYMENT'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-warning">' . TEXT_CONFIRMED_PAYMENT . '</label>';
                        break;
                    case Config::get('constants.type.AdditionFeeStatusEnum.ORDER_PAYMENT'):
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-success">' . TEXT_SUPPLIER_PAID . '</label>';
                        break;
                    default:
                        $config['data']['list'][$i]['status_text'] = '<label class="text text-inverse">' . TEXT_OTHER . '</label>';
                }
            }
            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_record' => $this->numberFormat($config['data']['total_record']),
                'total_amount' => $this->numberFormat($config['data']['total_amount']),
                'key' => $key,
                'page' => $page,
                'config' => $config
            );
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detailAdditionReasonDetail(Request $request)
    {
        $brand = $request->get('restaurant_brand_id');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_DETAIL_RESTAURANT_ADDITION_REASON_COST, $brand, $branch, $type, $time);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $table = DataTables::of($config['data'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
            $total_amount = $this->numberFormat(collect($config['data'])->sum('amount'));
            return [$table, $total_amount, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataProfitLossReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');

        $api = sprintf(API_REPORT_GET_PROFIT_LOSS, $brand, $branch, $type, $time, $from, $to);
        $body = null;

        $requestProfitLoss = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $api = sprintf(API_REPORT_GET_PROFIT_LOSS, $brand, $branch, $type, $time, $from, $to);
        $requestProfitLossTable = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestProfitLoss, $requestProfitLossTable]);

        try {
            $collect = collect($configAll[0]['data']['list']);
//            $dataRevenue = $collect->where('type', 0)->all();
            $dataCost = $collect->whereIn('type', [1, 2])->all();
            $dataCostFilter = collect($dataCost)->where('amount', '>', 0)->all();
            $dataChartCost = [];

            $totalDataRevenue = $this->numberFormat($configAll[0]['data']['total_revenue']);
            $totalDataCost = $this->numberFormat($configAll[0]['data']['total_cost']);
            $totalDataProfit = $this->numberFormat($configAll[0]['data']['total_profit']);

            foreach ($dataCostFilter as $db) {
                $dataChartCost[] = [
                    "timeline" => $db['name'],
                    "name" => $db['name'],
                    "value" => $db['amount'],
                ];
            };

            $total = collect($configAll[0]['data']['list'])->sum('amount');

            return [$totalDataRevenue, $total, $totalDataCost, $dataChartCost, $totalDataProfit, $configAll[0]['data'], $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataCostFreightReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_COST_FREIGHT, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $dataChartPie = [];
        foreach ($config['data']['list'] as $db) {
            $dataChartPie[] = [
                "timeline" => $db['name'],
                "name" => $db['name'],
                "value" => $db['amount'],
            ];
        };
        $total = collect($config['data']['list'])->sum('amount');
        return [$dataChartPie, $total, $config['data'], $config];
    }

    public function dataRechargePointReport(Request $request)
    {
        $type = $request->get('type');
        $time = $request->get('time');
        $type_sort = ENUM_GET_ALL;
        $key_search = '';
        $page = ENUM_SELECTED;
        $from = $request->get('from');
        $to = $request->get('to');
        $limit = Config::get('constants.type.default.LIMIT_100');
        $typePoint = $request->get('type_point');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_TOP_UP_POINT, $type_sort, $type, $time, $typePoint, $from, $to, $limit, $page, $key_search);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $dataChart = [];
            $data = collect($config['data']['list'])->sortByDesc('point')->slice(0, 5)->toArray();
            foreach ($data as $db) {
                array_push($dataChart, [
                    "name" => $db['name'],
                    "value" => $db['top_up_point_used'],
                ]);
            }
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $detail = TEXT_DETAIL;
            $dataTable = DataTables::of($config['data']['list'])
                ->addColumn('card', function ($row) {
                    return '<div class="waves-effect waves-light w-75 h-1rem m-auto" style="background-color: ' . $row['color_hex_code'] . '">' . $row['restaurant_membership_card_name'] . '</div>';
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>';
                })
                ->addColumn('top_up_point', function ($row) {
                    return $this->numberFormat($row['top_up_point']);
                })
                ->addColumn('total_top_up_point', function ($row) {
                    return $this->numberFormat($row['total_top_up_point']);
                })
                ->addColumn('total_top_up_point_used', function ($row) {
                    return $this->numberFormat($row['total_top_up_point_used']);
                })
                ->addColumn('top_up_point_used', function ($row) {
                    return $this->numberFormat($row['top_up_point_used']);
                })
                ->addColumn('total_top_up_point_remaining', function ($row) {
                    return $this->numberFormat($row['total_top_up_point_remaining']);
                })
                ->addColumn('action', function ($row) use ($detail, $from, $to) {
                    return '<div class="btn-group btn-group-sm text-center">
                               <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openDetailCustomers($(this))" data-id="' . $row['customer_id'] . '" data-phone="' . $row['phone'] . '" data-from="' . $from . '" data-to="' . $to . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                           </div>';
                })
                ->addIndexColumn()
                ->rawColumns(['card', 'avatar', 'address', 'action'])
                ->make(true);
            return [$dataChart, $dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
