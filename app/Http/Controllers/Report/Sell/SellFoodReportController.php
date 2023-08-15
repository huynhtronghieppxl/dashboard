<?php

namespace App\Http\Controllers\Report\Sell;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SellFoodReportController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'MARKETING_MANAGER', 'BUSINESS_ACTIVE_REPORT', 'SALE_REPORT', 'CASHIER_ACCESS', 'CHEF_COOK_ACCESS', 'BAR_ACCESS']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(0);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Báo Cáo Món Ăn';
        return view('report.sell.food.index', compact('active_nav'));
    }

    public function dataFoodRevenue(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $food_id = $request->get('food_id');
        $type = $request->get('type');
        $date_string = $request->get('time');
        $is_cancelled_food = ENUM_DIS_SELECTED;
        $is_gift = ENUM_GET_ALL;
        $isGoods = $request->get('inventory');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $select_sort = $request->get('selectSort');
        $api = sprintf(API_REPORT_GET_FOOD_V2, $brand, $branch, $food_id, $type, $date_string, $isGoods, $is_cancelled_food, $is_gift, $from, $to);
        $body = null;

        $requestList = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $api = sprintf(API_REPORT_GET_TOTAL_FOOD_V2, $brand, $branch, $type, $date_string, $from, $to);
        $body = null;

        $requestTotal = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTotal]);
        try {
            $data_chart = [];
            $collection = collect($configAll[0]['data']['list']);
            switch ($select_sort) {
                case 1:
                    $data = $collection->SortByDesc('total_original_amount');
                    break;
                case 2:
                    $data = $collection->SortByDesc('total_profit');
                    break;
                case 3:
                    $data = $collection->SortByDesc('profit_ratio');
                    break;
                default:
                    $data = $collection->SortByDesc('total_amount');
                    break;
            }
            $data_mix = $data->all();
            $i=0;
            foreach ($data_mix as $key => $db) {
                $data_chart[$i] = array(
                    "timeline" => $db['food_name'],
                    "valueTotal" => $db['total_amount'],
                    "valueOriginalTotal" => $db['total_original_amount'],
                    "valueProfit" => $db['total_profit'],
                    "quantity" => $db['quantity']
                );
                $i++;
            }

            $data_chart_ratio = [
                "timeline" => collect($data_mix)->pluck('food_name'),
                'value' => collect($data_mix)->pluck('profit_ratio'),
            ];

            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $detail = TEXT_DETAIL;
            $isGift = ENUM_DIS_SELECTED;
            $isCancel = ENUM_DIS_SELECTED;
            $dataTable = DataTables::of($data)
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('total_original_amount', function ($row) {
                    return $this->numberFormat($row['total_original_amount']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('profit', function ($row) {
                    return $this->numberFormat($row['total_profit']);
                })
                ->addColumn('profit_ratio', function ($row) {
                    return $this->numberFormat($row['profit_ratio']) . '%';
                })
                ->addColumn('type', function ($row) {
                    switch ($row['category_type']) {
                        case (int)Config::get('constants.type.category.FOOD'):
                            return TEXT_FOOD_FOOD;
                        case (int)Config::get('constants.type.category.DRINK'):
                            return TEXT_FOOD_DRINK;
                        case (int)Config::get('constants.type.category.OTHER'):
                            return TEXT_OTHER;
                        case (int)Config::get('constants.type.category.SEA_FOOD'):
                            return TEXT_SEA_FOOD;
                        default:
                            return '---';
                    }
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    if (mb_strlen($row['food_name']) > 30) {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . mb_substr($row['food_name'], 0, 27) . '...' . '<br>
                             <label class="department-inline-name-data-table"></label><div class="tag seemt-blue seemt-bg-blue d-flex mr-2" style="width: max-content">
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">' . ($row['unit_name'] !== '' ? $row['unit_name'] : '---') . '</label>
                            </div>
                         </label>';
                    } else {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . $row['food_name'] . '<br>
                             <label class="department-inline-name-data-table"></label><div class="tag seemt-blue seemt-bg-blue d-flex mr-2" style="width: max-content">
                                                                                                                    <i class="fi-rr-hastag"></i>
                                                                                                                    <label class="m-0">' . ($row['unit_name'] !== '' ? $row['unit_name'] : '---') . '</label>
                                                                                                                </div>
                         </label>';
                    }
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $type, $date_string, $detail, $isGift, $isCancel, $from, $to) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-id="' . $row['food_id'] . '" data-name="' . $row['food_name'] . '" data-gift="' . $isGift . '" data-cancel="' . $isCancel . '" data-brand="' . $brand . '" data-branch="' . $branch . '" data-type="' . $type . '" data-time="' . $date_string . '" data-from="' . $from . '" data-to="' . $to . '" data-title="Chi tiết món ăn" onclick="openDetailFoodSellReport($(this))"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'avatar', 'profit_ratio'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'sum_quantity' => $this->numberFormat(array_sum(array_column($configAll[0]['data']['list'], 'quantity'))),
                'sum_total_original' => $this->numberFormat(array_sum(array_column($configAll[0]['data']['list'], 'total_original_amount'))),
                'total' => $this->numberFormat(array_sum(array_column($configAll[0]['data']['list'], 'total_amount'))),
                'sum_profit' => $this->numberFormat(array_sum(array_column($configAll[0]['data']['list'], 'total_profit'))),
            ];

            $dataTotalChart = [
                'Giá vốn' => $this->numberFormat(array_sum(array_column($configAll[0]['data']['list'], 'total_original_amount'))),
                'Doanh thu' => $this->numberFormat(array_sum(array_column($configAll[0]['data']['list'], 'total_amount'))),
                'Lợi nhuận' => $this->numberFormat(array_sum(array_column($configAll[0]['data']['list'], 'total_profit'))),
            ];

            return [$data_chart, $dataTable, $dataTotal, $configAll, $dataTotalChart, $data_chart_ratio];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataDetailFoodRevenue(Request $request)
    {
        $branch_id = $request->get('branch');
        $type_client = $request->get('type');
        $date = date('d/m/Y');
        $food_id = $request->get('id');
        switch ($type_client) {
            case Config::get('constants.type.date.TODAY'):
                $type = Config::get('constants.type.date.TODAY');
                $date = $request->get('time');
                break;
            case Config::get('constants.type.date.WEEK'):
                $type = Config::get('constants.type.date.WEEK');
                break;
            case Config::get('constants.type.date.MONTH'):
                $type = Config::get('constants.type.date.MONTH');
                $time = $request->get('time');
                $date = date('d/') . $time;
                break;
            case Config::get('constants.type.date.THREE_MONTH'):
                $type = Config::get('constants.type.date.THREE_MONTH');
                break;
            case Config::get('constants.type.date.YEAR'):
                $type = Config::get('constants.type.date.YEAR');
                $time = $request->get('time');
                $date = date('d/m/') . $time;
                break;
            case Config::get('constants.type.date.THREE_YEAR'):
                $type = Config::get('constants.type.date.THREE_YEAR');
                break;
            case Config::get('constants.type.date.ALL_YEAR'):
                $type = Config::get('constants.type.date.ALL_YEAR');
                break;
            default:
                $type = Config::get('constants.type.date.TODAY');
                $date = date('d/m/Y');
        };
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_DETAIL, $branch_id, $type, $date, $food_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_chart = [];
            $data = $config['data'];
            $quantity = 0;
            $total_amount = 0;
            $dataTable_mix = [];
            if (count($data) != 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $quantity = $quantity + $data[$i]['quantity'];
                    $total_amount = $total_amount + $data[$i]['total_amount'];
                    switch ($type_client) {
                        case Config::get('constants.type.date.TODAY'):
                            $dataTable_mix[$i] = array(
                                'date' => $data[$i]['index'] . ' ' . TEXT_HOURS,
                                'quantity' => $data[$i]['quantity'],
                                'total_amount' => $data[$i]['total_amount'],
                            );
                            break;
                        case Config::get('constants.type.date.WEEK'):
                            if ($data[$i]['index'] !== '1') {
                                $dataTable_mix[$i] = array(
                                    'date' => TEXT_DAY_OF_WEEK . ' ' . $data[$i]['index'],
                                    'quantity' => $data[$i]['quantity'],
                                    'total_amount' => $data[$i]['total_amount'],
                                );
                            } else {
                                $dataTable_mix[$i] = array(
                                    'date' => TEXT_SUNDAY_OF_WEEK,
                                    'quantity' => $data[$i]['quantity'],
                                    'total_amount' => $data[$i]['total_amount'],
                                );
                            }
                            break;
                        case Config::get('constants.type.date.MONTH'):
                            $dataTable_mix[$i] = array(
                                'date' => $data[$i]['index'] . '/' . $time,
                                'quantity' => $data[$i]['quantity'],
                                'total_amount' => $data[$i]['total_amount'],
                            );
                            break;
                        case Config::get('constants.type.date.THREE_MONTH'):
                            $dataTable_mix[$i] = array(
                                'date' => TEXT_MONTH . ' ' . $data[$i]['index'],
                                'quantity' => $data[$i]['quantity'],
                                'total_amount' => $data[$i]['total_amount'],
                            );
                            break;
                        case Config::get('constants.type.date.YEAR'):
                            $dataTable_mix[$i] = array(
                                'date' => TEXT_MONTH . ' ' . $data[$i]['index'],
                                'quantity' => $data[$i]['quantity'],
                                'total_amount' => $data[$i]['total_amount'],
                            );
                            break;
                        case Config::get('constants.type.date.THREE_YEAR'):
                            $dataTable_mix[$i] = array(
                                'date' => TEXT_MONTH . ' ' . $data[$i]['index'],
                                'quantity' => $data[$i]['quantity'],
                                'total_amount' => $data[$i]['total_amount'],
                            );
                            break;
                        case Config::get('constants.type.date.ALL_YEAR'):
                            $dataTable_mix[$i] = array(
                                'date' => TEXT_YEAR . ' ' . $data[$i]['index'],
                                'quantity' => $data[$i]['quantity'],
                                'total_amount' => $data[$i]['total_amount'],
                            );
                            break;
                        default:
                            $dataTable_mix[$i] = array(
                                'date' => $data[$i]['index'] . ' ' . TEXT_HOURS,
                                'quantity' => $data[$i]['quantity'],
                                'total_amount' => $data[$i]['total_amount'],
                            );
                    }
                    $data_chart[$i] = array(
                        "timeline" => $dataTable_mix[$i]['date'],
                        "value" => $dataTable_mix[$i]['total_amount']);
                }
            } else {
                $data_chart = null;
            }
            // data table
            $dataTable = DataTables::of($dataTable_mix)
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'quantity' => $this->numberFormat($quantity),
                'total_amount' => $this->numberFormat($total_amount)
            ];
            return $data_response = [$data_chart, $dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detailFood(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $id = $request->get('id');
        $isGift = $request->get('gift');
        $isCancel = $request->get('cancel');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key_search = $this->keySearch(($request->get('search'))['value']);
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_DETAIL_FOOD, $brand, $branch, $type,
            $time, $id, $isGift, $isCancel, $key_search, $from, $to, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['quantity'] = $this->numberFormat($config['data']['list'][$i]['quantity']);
                $config['data']['list'][$i]['total_amount_by_food_id'] = $this->numberFormat($config['data']['list'][$i]['total_amount_by_food_id']);
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount']);
                $config['data']['list'][$i]['customer_slot_number'] = $this->numberFormat($config['data']['list'][$i]['customer_slot_number']);
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['action'] = '';
                $config['data']['list'][$i]['created_at'] = '<label>' . $this->convertDateTime($config['data']['list'][$i]['created_at']) . '</label>';
                $config['data']['list'][$i]['name'] = '<label>' . $config['data']['list'][$i]['employee_full_name'] . '</label>';
            }
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_quantity' => $this->numberFormat($config['data']['total_record']),
                'total_original' => $this->numberFormat($config['data']['total_original_price']),
                'total_price' => $this->numberFormat($config['data']['total_price']),
                'total_profit' => $this->numberFormat($config['data']['total_profit']),
                'total_rate' => $this->numberFormat($config['data']['total_rate_profit']),
                'total_amount' => $this->numberFormat($config['data']['total_amount']),
                'key' => $key_search,
                'page' => $page,
                'config' => $config
            );
            return json_encode($dataTable);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function food(Request $request)
    {
        $branch_id = ENUM_ID_NONE;
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $category_type = ENUM_GET_ALL;
        $category_id = ENUM_GET_ALL;
        $is_take_away = ENUM_GET_ALL;
        $is_count_material = ENUM_GET_ALL;
        $is_addition = ENUM_GET_ALL;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $is_bestseller = ENUM_GET_ALL;
        $is_combo = ENUM_GET_ALL;
        $is_kitchen = ENUM_GET_ALL;
        $is_special_gift = ENUM_DIS_SELECTED;
        $key = '';
        $is_get_food_contain_addition = ENUM_GET_ALL;
        $alert_original_food_id = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category_type, $category_id, $restaurant_brand_id, $branch_id, $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key, $is_get_food_contain_addition, $alert_original_food_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $data_food = '';
            if (count($data) === 0) {
                $data_food = '<option value="-1" selected>' . TEXT_SELECT_FOOD . '</option>';
            } else {
                $data_food .= '<option value="-1" selected>' . TEXT_SELECT_FOOD . '</option>';
                foreach ($data as $db) {
                    $data_food .= '<option value="' . $db['id'] . '" data-keysearch="' . $this->keySearchDatatableTemplate([$key]) . '"  data-name="' . $this->removeSpecialCharacterAttr($db['name']) . '" data-price="' . $db['price'] . '">' . $db['name'] . '</option>';
                }
            }
            return [$data_food, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

}
