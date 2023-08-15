<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\Datatables\Datatables;

class NewCustomerReportController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'MARKETING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Danh sách khách hàng mới ';
        return view('customer.report.new_customer.index_v2', compact('active_nav'));
    }

//    public function data(Request $request)
//    {
//        $type_client = $request->get('type');
//        $date = date('d/m/Y');
//        switch ($type_client) {
//            case Config::get('constants.type.date.TODAY'):
//                $type = Config::get('constants.type.date.TODAY');
//                $date = $request->get('time');
//                break;
//            case Config::get('constants.type.date.WEEK'):
//                $type = Config::get('constants.type.date.WEEK');
//                break;
//            case Config::get('constants.type.date.MONTH'):
//                $type = Config::get('constants.type.date.MONTH');
//                $time = $request->get('time');
//                $date = '1/' . $time;
//                break;
//            case Config::get('constants.type.date.THREE_MONTH'):
//                $type = Config::get('constants.type.date.THREE_MONTH');
//                break;
//            case Config::get('constants.type.date.YEAR'):
//                $type = Config::get('constants.type.date.YEAR');
//                $time = $request->get('time');
//                $date = date('1/m/') . $time;
//                break;
//            case Config::get('constants.type.date.THREE_YEAR'):
//                $type = Config::get('constants.type.date.THREE_YEAR');
//                break;
//            case Config::get('constants.type.date.ALL_YEAR'):
//                $type = Config::get('constants.type.date.ALL_YEAR');
//                break;
//            default:
//                $type = Config::get('constants.type.date.TODAY');
//                $date = date('d/m/Y');
//        };
//        $convert_api = $this->convertApiTemplate(sprintf(API_REPORT_GET_CHART_NEW_CUSTOMER, $date, $type));
//        $api = $convert_api[0];
//        $params = $convert_api[1];
//        $body = null;
//        $requestChartNewCustomer = [
//            'project' => ENUM_PROJECT_ID_REPORT_NODE,
//            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
//            'api' => $api,
//            'params' => $params,
//            'body' => $body,
//        ];
//
//        $page = Config::get('constants.type.default.PAGE_DEFAULT');
//        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
//        $convert_api = $this->convertApiTemplate(sprintf(API_REPORT_GET_NEW_CUSTOMER, $page, $limit, $date, $type));
//        $api = $convert_api[0];
//        $params = $convert_api[1];
//        $body = null;
//        $requestGetNewCustomer = [
//            'project' => ENUM_PROJECT_ID_REPORT_NODE,
//            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
//            'api' => $api,
//            'params' => $params,
//            'body' => $body,
//        ];
//
//        $configAll = $this->callApiMultiGatewayTemplate([$requestChartNewCustomer,$requestGetNewCustomer]);
//        try {
//            $config = $configAll[0];
//            $config1 = $config;
//            $data_chart = [];
//            $data = $config['data'];
//            if (count($data) != 0) {
//                foreach ($data as $i => $data_mix) {
//                    $data_chart[$i] = array(
//                        "timeline" => $data_mix['index'],
//                        "value" => $data_mix['number_customer']);
//                }
//            } else {
//                $data_chart = null;
//            }
//
//            $config = $configAll[1];
//            $data_table = DataTables::of($config['data']['list'])
//                ->addColumn('name', function ($row) {
//                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
//                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"><label class="title-name-new-table" >'.$row['name'].'</label>';
//                })
//                ->editColumn('gender', function ($rows) {
//                    if ($rows['gender'] === (int)TEXT_FEMALE_VALUE) {
//                        $message = '<i class="ion-female mr-1 "></i>'.TEXT_FEMALE;
//                    } else {
//                        $message = '<i class="ion-male mr-1 text-primary"></i>'.TEXT_MALE;
//                    }
//                    return $message;
//                })
//                ->addColumn('point', function ($row) {
//                    return $this->numberFormat($row['point']);
//                })
//                ->addColumn('created_at', function ($row) {
//                    return date('d/m/Y',strtotime($row['created_at']));
//                })
//                ->addColumn('keysearch', function ($row) {
//                    return $this->keySearchDatatableTemplate($row);
//                })
//                ->rawColumns(['action', 'avatar','name', 'gender'])
//                ->addIndexColumn()
//                ->make(true);
//            $data_total = [
//                'total_point_new_customer' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'point'))),
//            ];
//            return [$data_chart, $data_table, $config1, $config, $data_total];
//        } catch (Exception $e) {
//            return $this->catchTemplate($config, $e);
//        }
//
//    }
    function getReportCustomerNew(Request $request)
    {
        $reportType = $request->get('report_type');
        $stringDate = $request->get('string_date');
        $fromDate =  $request->get('from_date');
        $toDate =  $request->get('to_date');
        $page = 1;
        $limit = 100;
        $project = ENUM_PROJECT_ID_REPORT_NODE_V2;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_CHART_NEW_CUSTOMER, $reportType, $stringDate, $fromDate, $toDate, $page, $limit);
        $body = null;
        $config =  $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $orderReport = [];
            $time = [];
            foreach ($config['data'] as $index => $db){
//                array_push($time , $this->covertTimeReportNewCustomer($db['report_time'], $reportType, $index));
                $orderReport[$index] = array(
                    'timeline' => $this->covertTimeReportNewCustomer($db['report_time'], $reportType, $index),
                    'value' => $db['total_customer']
                );
            }
            return [$config['data'], $orderReport, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
    function detail(Request $request)
    {
        $reportType = $request->get('report_type');
        $stringDate = $request->get('string_date');
        $fromDate =  $request->get('from_date');
        $toDate =  $request->get('to_date');
        $page = 1;
        $limit = 100;
        $project = ENUM_PROJECT_ID_REPORT_NODE_V2;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_DETAIL_CHART_NEW_CUSTOMER, $reportType, $stringDate, $fromDate, $toDate, $page, $limit);
        $body = null;
        $config =  $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table = DataTables::of($config['data']['list'])
//                ->addColumn('name', function ($row) {
//                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
//                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"><label class="title-name-new-table" >' . $row['name'] . '</label>';
//                })
                ->addColumn('name', function ($row) {
                    return $this->numberFormat($row['name']);
                })
                ->editColumn('gender', function ($rows) {
                    if ($rows['gender'] === (int)TEXT_FEMALE_VALUE) {
                        $message = '<i class="ion-female mr-1 "></i>' . TEXT_FEMALE;
                    } else {
                        $message = '<i class="ion-male mr-1 text-primary"></i>' . TEXT_MALE;
                    }
                    return $message;
                })
                ->addColumn('card_type', function ($row) {
                    return $this->numberFormat($row['card_type']);
                }) ->addColumn('used_accumulate_point', function ($row) {
                    return $this->numberFormat($row['used_accumulate_point']);
                })
                ->addColumn('register_at', function ($row) {
                    return date('d/m/Y', strtotime($row['register_at']));
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action',  'name', 'gender', 'card_type', 'used_accumulate_point', 'register_at'])
                ->addIndexColumn()
                ->make(true);
            $data_total = [
                'total_accumulate_point' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_accumulate_point'))),
            ];
            return [$data_table, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
