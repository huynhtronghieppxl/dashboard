<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index()
    {
        $checkPermission = $this->checkPermission(['OWNER' , 'VIEW_ALL' , 'ACCOUNTING_MANAGER' , 'MARKETING_MANAGER' , 'BUSINESS_ACTIVE_REPORT' ,'SALE_REPORT' ,'CASHIER_ACCESS' , 'CHEF_COOK_ACCESS', 'BAR_ACCESS' ]);
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
        $active_nav = 'theo thời gian';
        return view('report.order.index', compact('active_nav'));
    }
    public function data(Request $request)
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
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            foreach ($data as $key => $db) {
                $data[$key]['report_time'] = $this->covertTimeReport($db['report_time'], $type, $key);
            }

            $dataTable = DataTables::of($data)
                ->addColumn('revenue_amount', function ($row) {
                    return $this->numberFormat($row['total_revenue']);
                })
                ->addColumn('revenue_without_vat_amount', function ($row) {
                    return $this->numberFormat($row['total_revenue_without_vat']);
                })
                ->addColumn('vat_amount', function ($row) {
                    return $this->numberFormat($row['total_vat_amount']);
                })
                ->addColumn('order', function ($row) {
                    return $this->numberFormat($row['total_order']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'revenue' => $this->numberFormat(collect($data)->sum('total_revenue')),
                'order' => $this->numberFormat(collect($data)->sum('total_order')),
            ];
            $dataChart = [
                "timeline" => collect($data)->pluck('report_time'),
                "value" => collect($data)->pluck('total_order'),
                'revenue' => collect($data)->pluck('total_revenue')
            ];
            return [$dataChart, $dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
