<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PriceChangeHistoriesReportController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'ADDITION_FEE_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Biến động giá';
        return view('report.price_change_histories.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $inventory = $request->get('inventory');
        $from = $request->get('from');
        $to = $request->get('to');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $supplier_id = $request->get('supplier_id');
        $key_search = $request->get('key_search');
        $type = ENUM_REPORT_TYPE_OPTION_DAY;
        $page = $request->get('page');
        $limit = $request->get('limit');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_PRICE_CHANGE_HISTORIES, $restaurant_brand_id, $branch, $supplier_id, $from, $to, $page, $limit, $type, $key_search, $inventory);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            return [$data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function supplier(Request $request)
    {
        $is_take_my_supplier = ENUM_SELECTED;
        $is_restaurant_supplier = ENUM_GET_ALL;
        $is_exclude_unassign_system_supplier = ENUM_GET_ALL;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_GET_ALL_SUPPLIER, $is_take_my_supplier, $is_restaurant_supplier, $is_exclude_unassign_system_supplier, $page, $limit, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $option = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            if (!empty($data)) {
                $option = '<option value="-1">Tất cả NCC</option>';
                foreach ($data as $db) {
                    $option .= '<option value="' . $db['id'] . '" >' . $db['name'] . '</option>';
                }
            }
            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
