<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SellReportController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Bán hàng';
        return view('report.sell.index', compact('active_nav'));
    }

//    public function dataCategoryRevenue(Request $request)
//    {
//        $brand = $request->get('brand');
//        $branch = $request->get('branch');
//        $type = $request->get('type');
//        $time = $request->get('time');
//        $from = '';
//        $to = '';
//        $project = Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE');
//        $method = Config::get('constants.GATEWAY.METHOD.GET');
//        $convert_api = $this->convertApiTemplate(sprintf(API_REPORT_GET_CATEGORY_FOOD, $brand, $branch, $type, $time, $from, $to));
//        $api = $convert_api[0];
//        $params = $convert_api[1];
//        $body = null;
//        $config = $this->callApiGatewayTemplate($project, $method, $api, $params, $body);
//        try {
//            $data_chart = [];
//            $data_chart_old = [];
//            $collection = collect($config['data']['list']);
//            $data = $collection->SortByDesc('total_amount');
//            $i = 0;
//            if (count($data) != 0) {
//                foreach ($data as $data_mix) {
//                    $data_chart[$i] = array(
//                        "timeline" => $data_mix['category_name'],
//                        "valueTotal" => $data_mix['total_amount'],
//                        "valueOriginalTotal" => $data_mix['total_original_amount'],
//                        "valueProfit" => $data_mix['profit'],
//                        "valueProfitRatio" => $data_mix['profit_ratio']);
//                    $i++;
//                }
//            } else {
//                $data_chart = null;
//            }if (count($data) != 0) {
//                foreach ($data as $data_mix) {
//                    $data_chart_old[$i] = array(
//                        "timeline" => $data_mix['category_name'],
//                        "value" => $data_mix['total_amount']);
//                    $i++;
//                }
//            } else {
//                $data_chart_old = null;
//            }
//            $detail = TEXT_DETAIL;
//            $dataTable = DataTables::of($data)
//                ->addColumn('category_name', function ($row) {
//                    return (mb_strlen($row['category_name']) > 30) ? mb_substr($row['category_name'], 0, 27) . '...' : $row['category_name'];
//                })
//                ->addColumn('total_amount', function ($row) {
//                    return $this->numberFormat($row['total_amount']);
//                })
//                ->addColumn('total_original_amount', function ($row) {
//                    return $this->numberFormat($row['total_original_amount']);
//                })
//                ->addColumn('profit', function ($row) {
//                    return $this->numberFormat($row['profit']);
//                })
//                ->addColumn('profit_ratio', function ($row) {
//                    return $this->numberFormat($row['profit_ratio']);
//                })
//                ->addColumn('action', function ($row) use ($detail, $brand, $branch, $type, $time) {
//                    return '<div class="btn-group btn-group-sm">
//                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" data-name="' . $row['category_name'] . '" data-brand="' . $brand . '" data-branch="' . $branch . '" data-type="' . $type . '" data-time="' . $time . '" data-id="' . $row['category_id'] . '" onclick="openDetailCategorySellReport($(this))" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $detail . '"><span class="icofont icofont-eye-alt"></span></button>
//                         </div>';
//                })
//                ->addColumn('keysearch', function ($row) {
//                    return $this->keySearchDatatableTemplate($row);
//                })
//                ->rawColumns(['action'])
//                ->addIndexColumn()
//                ->make(true);
//            $dataTotal = [
//                'total' => $this->numberFormat($config['data']['total_amount']),
//                'sum_total_original' => $this->numberFormat($config['data']['total_original_amount']),
//                'sum_profit' => $this->numberFormat($config['data']['profit']),
//            ];
//            return [$data_chart, $dataTable, $dataTotal, $config, $data_chart_old];
//        } catch (Exception $e) {
//            return $this->catchTemplate($config, $e);
//        }
//    }

    public function dataFoodRevenue(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $isGoods = $request->get('inventory');
        $api = sprintf(API_REPORT_GET_FOOD, $brand, $branch, $type, $time, $isGoods);
        $body = null;
        $requestList = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_REPORT_GET_TOTAL_FOOD, $brand, $branch, $type, $time);
        $body = null;
        $requestTotal = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTotal]);
        try {
            $data_chart = [];
            $collection = collect($configAll[0]['data']['list']);
            $data = $collection->SortByDesc('total_amount');
            if (count($data) === 0) {
                $data_chart = null;
            } else {
                $data_mix = $data->slice(0, 20)->all();
                $i = 0;
                foreach ($data_mix as $db) {
                    $data_chart[$i] = array(
                        "timeline" => $db['food_name'],
                        "valueTotal" => $db['total_amount'],
                        "valueOriginalTotal" => $db['total_original_amount'],
                        "valueProfit" => $db['profit']);
                    $i++;
                }
            }
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $detail = TEXT_DETAIL;
            $isGift = Config::get('constants.type.checkbox.DIS_SELECTED');
            $isCancel = Config::get('constants.type.checkbox.DIS_SELECTED');
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
                    return $this->numberFormat($row['profit']);
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
                    if(mb_strlen($row['food_name']) > 20){
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . mb_substr($row['food_name'], 0, 20)  . '...' . '<br>
                             <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i></label>
                         </label>';
                    } else {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . $row['food_name'] . '<br>
                             <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i></label>
                         </label>';
                    }
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $type, $time, $detail, $isGift, $isCancel) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-id="' . $row['food_id'] . '" data-name="' . $row['food_name'] . '" data-gift="' . $isGift . '" data-cancel="' . $isCancel . '" data-brand="' . $brand . '" data-branch="' . $branch . '" data-type="' . $type . '" data-time="' . $time . '" data-title="Chi tiết món ăn" onclick="openDetailFoodSellReport($(this))"><span class="icofont icofont-eye-alt"></span></button>
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
                'sum_profit' => $this->numberFormat(array_sum(array_column($configAll[0]['data']['list'], 'profit'))),
                'sum_total' => $this->numberFormat($configAll[1]['data']['list']['total_amount']),
                'sum_total_material' => $this->numberFormat($configAll[1]['data']['list']['total_food_material_inventory_amount']),
                'sum_total_goods' => $this->numberFormat($configAll[1]['data']['list']['total_food_goods_inventory_amount']),
            ];

            return [$data_chart, $dataTable, $dataTotal, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataDetailFoodRevenue(Request $request)
    {
        $branch_id = $request->get('branch');
        $type_client = $request->get('type');
        $date = date('d/m/Y');
        $food_id = $request->get('food_id');
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
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_DETAIL, $branch_id, $type, $date, $food_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            // data chart
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

    public function dataGiftFoodReport(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $report_type = $request->get('type');
        $from = '';
        $to = '';
        $type = ENUM_SELECTED; /* 1 - Món tặng, 2- Món hủy (bao gồm hủy hao hụt), 3 - chỉ lấy món hủy hao hụt */
        $time = $request->get('time');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $selectSort = $request->get('selectSort');
        $isGroup = ENUM_DEFAULT;
        $api = sprintf(API_REPORT_GET_GIFT_FOOD, $brand, $branch, $type, $report_type, $time, $from, $to, $selectSort,$isGroup);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $detail = TEXT_DETAIL;
            $isGift = Config::get('constants.type.checkbox.SELECTED');
            $isCancel = Config::get('constants.type.checkbox.DIS_SELECTED');
            $dataTable = DataTables::of($data)
                ->addColumn('name', function ($row) use ($domain){
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain .$row['employee_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . mb_substr($row['employee_name'], 0, 20)  . '...' . '<br>
                             <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>'.$row['employee_role_name'].'</label>
                         </label>';
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('customer_slot_number', function ($row) {
                    return $this->numberFormat($row['customer_slot_number']);
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $type, $time, $detail, $isGift, $isCancel) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-id="' . $row['food_id'] . '" data-name="' . $row['food_name'] . '" data-gift="' . $isGift . '" data-cancel="' . $isCancel . '" data-brand="' . $brand . '" data-branch="' . $branch . '" data-type="' . $type . '" data-time="' . $time . '" data-title="Chi tiết món tặng" onclick="openDetailGiftFoodSellReport($(this))"><span class="icofont icofont-eye-alt"></span></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'name'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_amount'))),
                'quantity' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'quantity'))),
            ];
            return [$dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataDiscountReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_DISCOUNT, $brand, $branch, $type, $time);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_chart = [];
            $data = $config['data']['list'];
            if (count($data) != 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $data_chart[$i] = array(
                        "timeline" => $this->covertTimeReport($data[$i]['report_time'], $type, $i),
                        "value" => $data[$i]['total_amount']);
                }
            } else {
                $data_chart = null;
            }
            $detail = TEXT_DETAIL;
            $dataTable = DataTables::of($data)
                ->addColumn('index', function ($row) use ($type, $data) {
                    return $this->covertTimeReport($row['report_time'], $type, array_search($row['report_time'], array_column($data, 'report_time')));
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('action', function ($row) use ($detail, $brand, $branch, $type, $time, $data) {
                    $convertTime = $this->covertTimeDetailReport($row['report_time'], $type, $time, array_search($row['report_time'], array_column($data, 'report_time')));
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-brand="' . $brand . '" data-branch="' . $branch . '" data-type="' . $convertTime[0] . '" data-time="' . $convertTime[1] . '" onclick="openModalDetailDiscountSellReport($(this))"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total' => $this->numberFormat($config['data']['total_amount']),
            ];
            return [$data_chart, $dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataFoodTakeAwayReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_TAKE_AWAY_FOOD, $brand, $branch, $type, $time);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_chart = [];
            $collection = collect($config['data']['list']);
            $data_all = $collection->SortByDesc('total_amount');
            $data = $data_all->slice(0, 50)->all();
            $i = 0;
            if (count($data) != 0) {
                foreach ($data as $data_mix) {
                    $data_chart[$i] = array(
                        "timeline" => $data_mix['food_name'],
                        "value" => $data_mix['total_amount']);
                    $i++;
                }
            } else {
                $data_chart = null;
            }
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $detail = TEXT_DETAIL;
            $dataTable = DataTables::of($data_all)
                ->addColumn('avatar', function ($row) use ($domain) {
                    if(mb_strlen($row['food_name']) > 20){
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . mb_substr($row['food_name'], 0, 20)  . '...' . '<br>
                             <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i></label>
                         </label>';
                    } else {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . $row['food_name'] . '<br>
                             <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i></label>
                         </label>';
                    }
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('total_original_amount', function ($row) {
                    return $this->numberFormat($row['total_original_amount']);
                })
                ->addColumn('profit', function ($row) {
                    return $this->numberFormat($row['profit']);
                })
                ->addColumn('profit_ratio', function ($row) {
                    return $this->numberFormat($row['profit_ratio']);
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $type, $time, $detail) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-id="' . $row['food_id'] . '" data-name="' . $row['food_name'] . '" data-gift="-1" data-cancel="-1" data-brand="' . $brand . '" data-branch="' . $branch . '" data-type="' . $type . '" data-time="' . $time . '" data-title="Chi tiết món mang về" onclick="openDetailFoodSellReport($(this))"><span class="icofont icofont-eye-alt"></span></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'avatar'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total' => $this->numberFormat($config['data']['total_amount']),
                'sum_quantity' => $this->numberFormat($config['data']['quantity']),
                'sum_total_original' => $this->numberFormat($config['data']['total_original_amount']),
                'sum_profit' => $this->numberFormat($config['data']['profit']),
            ];
            return [$data_chart, $dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataFoodCancelReport(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_CANCEL_FOOD, $brand, $branch, $type, $time);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $detail = TEXT_DETAIL;
            $isGift = Config::get('constants.type.checkbox.DIS_SELECTED');
            $isCancel = Config::get('constants.type.checkbox.SELECTED');
            $dataTable = DataTables::of($data)
                ->addColumn('name', function ($row) use ($domain){
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain .$row['employee_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . mb_substr($row['employee_name'], 0, 20)  . '...' . '<br>
                             <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>'.$row['employee_role_name'].'</label>
                         </label>';
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('customer_slot_number', function ($row) {
                    return $this->numberFormat($row['customer_slot_number']);
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $type, $time, $detail, $isGift, $isCancel) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-is-print="1" data-id="' . $row['food_id'] . '" data-name="' . $row['food_name'] . '" data-gift="' . $isGift . '" data-cancel="' . $isCancel . '" data-brand="' . $brand . '" data-branch="' . $branch . '" data-type="' . $type . '" data-time="' . $time . '" data-title="Chi tiết món hủy"  onclick="openBillDetail($(this))"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'name'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total' => $this->numberFormat($config['data']['total_amount']),
                'quantity' => $this->numberFormat($config['data']['quantity']),
            ];
            return [$dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataOrderReport(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = $request->get('limit');
        $key = $this->keySearch(($request->get('search'))['value']);
        $project = Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_ORDER, $brand, $branch, $type, $time, $page, $limit, $key);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
             $detail = TEXT_DETAIL;
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['customer_slot_number'] = $this->numberFormat($data[$i]['customer_slot_number']);
                if (mb_strlen($data[$i]['employee_full_name']) > 30) {
                    $data[$i]['employee_full_name'] = mb_substr($data[$i]['employee_full_name'], 0, 27) . '...';
                } else {
                    $data[$i]['employee_full_name'] = $data[$i]['employee_full_name'];
                }
                $data[$i]['name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain .$data[$i]['employee_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $data[$i]['employee_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . mb_substr($data[$i]['employee_full_name'], 0, 20)  . '...' . '<br>
                             <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>'.$data[$i]['employee_role_name'].'</label>
                         </label>';
                if (mb_strlen($data[$i]['table_name']) > 30) {
                    $data[$i]['table_name'] = mb_substr($data[$i]['table_name'], 0, 27) . '...';
                } else {
                    $data[$i]['table_name'] = $data[$i]['table_name'];
                }
                if (mb_strlen($data[$i]['table_merging_names']) > 30) {
                    $data[$i]['table_merging_names'] = mb_substr($data[$i]['table_merging_names'], 0, 27) . '...';
                } else {
                    $data[$i]['table_merging_names'] = $data[$i]['table_merging_names'];
                }
                $data[$i]['vat_amount'] = $this->numberFormat($data[$i]['vat_amount']);
                $data[$i]['cash_amount'] = $this->numberFormat($data[$i]['cash_amount']);
                $data[$i]['transfer_amount'] = $this->numberFormat($data[$i]['transfer_amount']);
                $data[$i]['bank_amount'] = $this->numberFormat($data[$i]['bank_amount']);
                $data[$i]['total_amount'] = $this->numberFormat($data[$i]['total_amount']);
                $data[$i]['index'] = ($page - 1) * $limit + $i + 1;
                $data[$i]['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-id="' . $data[$i]['id'] . '" data-is-print="1" data-cancel="0" onclick="openBillDetail($(this))"><span class="icofont icofont-eye-alt"></span></button>
                            </div>';
            }
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'vat_amount' => $this->numberFormat($config['data']['vat_amount']),
                'cash_amount' => $this->numberFormat($config['data']['cash_amount']),
                'transfer_amount' => $this->numberFormat($config['data']['transfer_amount']),
                'bank_amount' => $this->numberFormat($config['data']['bank_amount']),
                'discount_amount' => $this->numberFormat($config['data']['discount_amount']),
                'total_amount' => $this->numberFormat($config['data']['total_amount']),
                'total_customer' => $this->numberFormat($config['data']['total_customer']),
                'data' => $data,
                'key' => $key,
                'page' => $page,
                'config' => $config
            );
            return json_encode($dataTable);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataListFood(Request $request)
    {
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $branch_id = $request->get('branch');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $category_type = Config::get('constants.type.status.GET_ALL');
        $category_id = Config::get('constants.type.status.GET_ALL');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_addition = Config::get('constants.type.addition_fee.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $restaurant_brand_id, $branch_id, $status, $category_type, $category_id, $is_take_away, $is_addition);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $data_food = '<option value="' . Config::get('constants.type.id.GET_ALL') . '">' . TEXT_DEFAULT_OPTION . '</option>';
            if (count($data) !== 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $data_food = $data_food . '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
            return [$data_food, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detailFood(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $id = $request->get('id');
        $from = $request->get('from');
        $to = $request->get('to');;
        $isGift = $request->get('gift');
        $isCancel = $request->get('cancel');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = 100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_DETAIL_FOOD, $brand, $branch, $type, $time, $id, $isGift, $isCancel, $page, $limit, $key, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $detail = TEXT_DETAIL;
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['employee_avatar'] = '';
                $config['data']['list'][$i]['employee_role_name'] = '';
                $config['data']['list'][$i]['quantity'] = $this->numberFormat($config['data']['list'][$i]['quantity']);
                $config['data']['list'][$i]['total_amount_by_food_id'] = $this->numberFormat($config['data']['list'][$i]['total_amount_by_food_id']);
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount']);
                $config['data']['list'][$i]['customer_slot_number'] = $this->numberFormat($config['data']['list'][$i]['customer_slot_number']);
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['action'] = '';
                $config['data']['list'][$i]['name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['list'][$i]['employee_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $config['data']['list'][$i]['employee_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . mb_substr($config['data']['list'][$i]['employee_full_name'], 0, 20)  . '<br>
                             <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>'.$config['data']['list'][$i]['employee_role_name'].'</label>
                         </label>';
            }
            $config['data']['total_original_food'] = 'API CHƯA CÓ';
            $config['data']['total_price_food'] = 'API CHƯA CÓ';
            $config['data']['total_profit_food'] = 'API CHƯA CÓ';
            $config['data']['total_rate_profit_food'] = 'API CHƯA CÓ';
            $config['data']['from_report'] = 'API CHƯA CÓ';
            $config['data']['to_report'] = 'API CHƯA CÓ';
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_quantity' => $this->numberFormat($config['data']['total_record']),
                'total_original' => $this->numberFormat($config['data']['total_original_food']),
                'total_price' => $this->numberFormat($config['data']['total_price_food']),
                'total_profit' => $this->numberFormat($config['data']['total_profit_food']),
                'total_rate' => $this->numberFormat($config['data']['total_rate_profit_food']),
                'time' => $config['data']['from_report'] . ' - ' . $config['data']['to_report'],
                'key' => $key,
                'page' => $page,
                'config' => $config
            );
            return json_encode($dataTable);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detailDiscount(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from');
        $to = $request->get('to');
        $area = Config::get('constants.type.id.GET_ALL');
        $employee = Config::get('constants.type.id.GET_ALL');
        $customer = Config::get('constants.type.id.GET_ALL');
        $isDiscount = Config::get('constants.type.checkbox.SELECTED');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = $request->get('limit');
        $key = $this->keySearch(($request->get('search'))['value']);
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_DETAIL_ORDER_SELL, $brand, $branch, $type, $time, $area, $employee, $customer, $isDiscount, $page, $limit, $key, $from ,$to);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $detail = TEXT_DETAIL;
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                $config['data']['list'][$i]['vat_amount'] = $this->numberFormat($config['data']['list'][$i]['vat_amount']);
                $config['data']['list'][$i]['discount_amount'] = $this->numberFormat($config['data']['list'][$i]['discount_amount']);
                $config['data']['list'][$i]['point'] = $this->numberFormat($config['data']['list'][$i]['point']);
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount']);
                $config['data']['list'][$i]['payment_date'] = '<label>' . $this->convertDateTime($config['data']['list'][$i]['payment_date']) . '</label>';
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['action'] = '';
            }
//            $config['data']['from_report']  = 'API CHƯA CÓ';
//            $config['data']['to_report']  = 'API CHƯA CÓ';
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_original' => $this->numberFormat($config['data']['total_original_amount']),
                'total_point' => $this->numberFormat($config['data']['total_point_amount']),
                'total_vat' => $this->numberFormat($config['data']['total_vat_amount']),
                'total_discount' => $this->numberFormat($config['data']['total_discount_amount']),
                'total_amount' => $this->numberFormat($config['data']['total_amount']),
//                'time' => $config['data']['from_report'] . ' - ' . $config['data']['to_report'],
                'key' => $key,
                'page' => $page,
                'config' => $config
            );
            return json_encode($dataTable);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
