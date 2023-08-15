<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use function Symfony\Component\String\s;

class ServiceCostHistoryController extends Controller
{
    public function index()
    {
        $active_nav = 'Lịch sử chi phí dịch vụ';
        return view('setting.service_cost_history.index', compact('active_nav'));
    }

    public function dataBalance(Request $request){
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = API_SERVICE_COST_HISTORY_DATA;
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataAdd(Request $request)
    {
        $report_type = (int)$request->get('report_type');
        $date_string = $request->get('date_string');
        $from_date = $request->get('from_date');
        $to_date =  $request->get('to_date');
        $key_search = $this->keySearch(($request->get('search'))['value']);
        $limit = ENUM_DEFAULT_LIMIT_1000;
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $api = sprintf(API_SERVICE_COST_HISTORY_DATA_ADD, $report_type, $date_string, $from_date, $to_date, $key_search,$page, $limit);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $branch_id = $request->get('branch_id');
        $api = sprintf(API_SERVICE_COST_HISTORY_COUNT_TAB, $report_type, $date_string, $from_date, $to_date, $restaurant_brand_id, $branch_id);
        $body = null;
        $requestCountTab = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestCountTab]);
        try {
            for ($i = 0; $i < count($configAll[0]['data']['data']); $i++) {
                $configAll[0]['data']['data'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $configAll[0]['data']['data'][$i]['amount_transfer'] = $this->numberFormat($configAll[0]['data']['data'][$i]['amount_transfer']);
                $old_date = Date_create($configAll[0]['data']['data'][$i]['created_at']);
                $new_date = Date_format($old_date, "d/m/Y H:i:s");
                $configAll[0]['data']['data'][$i]['created_at'] = '<label>' . $this->convertDateTime($new_date) . '</label>';
            }
            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $configAll[1]['data']['total_record_in'],
                'recordsFiltered' => $configAll[1]['data']['total_record_in'],
                'data' => $configAll[0]['data']['data'],
                'key' => $configAll,
                'page' => $page,
                'config' => $configAll,
            );
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataMinus(Request $request)
    {
        $report_type = $request->get('report_type');
        $date_string = $request->get('date_string');
        $from_date = $request->get('from_date');
        $to_date =  $request->get('to_date');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $branch_id = $request->get('branch_id');
        $key_search = $this->keySearch(($request->get('search'))['value']);
        $limit = ENUM_DEFAULT_LIMIT_1000;
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $api = sprintf(API_SERVICE_COST_HISTORY_DATA_MINUS, $report_type, $date_string, $from_date, $to_date, $key_search, $page, $limit, $restaurant_brand_id, $branch_id);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $api =sprintf(API_SERVICE_COST_HISTORY_COUNT_TAB, $report_type, $date_string, $from_date, $to_date, $restaurant_brand_id, $branch_id);
        $body = null;
        $requestTab = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTab]);
        try {
            for ($i = 0; $i < count($configAll[0]['data']['data']); $i++) {
                $configAll[0]['data']['data'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $configAll[0]['data']['data'][$i]['restaurant_brand_name'] = $configAll[0]['data']['data'][$i]['restaurant_brand_name'];
                $configAll[0]['data']['data'][$i]['branch_name'] = $configAll[0]['data']['data'][$i]['branch_name'];
                $configAll[0]['data']['data'][$i]['code'] = '<label class="class-link" onclick="openBillDetail($(this))" data-is-print="1" data-id="'. $configAll[0]['data']['data'][$i]['order_id'] .'">'. '#' . $configAll[0]['data']['data'][$i]['order_id'] .'</label>';
                $configAll[0]['data']['data'][$i]['service_total_amount'] = $this->numberFormat($configAll[0]['data']['data'][$i]['service_total_amount']);
                $configAll[0]['data']['data'][$i]['service_restaurant_level_id'] = $configAll[0]['data']['data'][$i]['service_restaurant_level_id'] . '/ ' . $configAll[0]['data']['data'][$i]['scale'];
                $old_date = Date_create($configAll[0]['data']['data'][$i]['order_payment_date']);
                $new_date = Date_format($old_date, "d/m/Y H:i:s");
                $configAll[0]['data']['data'][$i]['order_payment_date'] = '<label>' . $this->convertDateTime($new_date) . '</label>';
            }
            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $configAll[1]['data']['total_record_out'],
                'recordsFiltered' => $configAll[1]['data']['total_record_out'],
                'total_record' => $configAll[1]['data']['total_record_out'],
                'data' => $configAll[0]['data']['data'],
                'key' => $configAll,
                'page' => $page,
                'config' => $configAll,
            );

            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }
}
