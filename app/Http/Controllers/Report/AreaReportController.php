<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class AreaReportController extends Controller
{
    public function index(Request $request)
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
        $active_nav = 'Khu vực';
        return view('report.area.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_AREA, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = collect($config['data']['list']);

            $dataChart = [
                "timeline" => $data->pluck('area_name'),
                "value" => $data->pluck('revenue'),
                'total_amount' => $this->numberFormat($config['data']['total_revenue_amount']),
                "quantity" => $data->pluck('order_count')
            ];

            $detail = TEXT_DETAIL;
            $dataTable = DataTables::of($data)
                ->addColumn('revenue', function ($row) {
                    return $this->numberFormat($row['revenue']);
                })
                ->addColumn('order_count', function ($row) {
                    return $this->numberFormat($row['order_count']);
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $type, $time, $detail, $from, $to) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-id="' . $row['area_id'] . '" data-name="' . $row['area_name'] . '" data-brand="' . $brand . '" data-branch="' . $branch . '" data-type="' . $type . '" data-time="' . $time . '" data-from="' . $from . '" data-to="' . $to . '" onclick="openModalDetailAreaReport($(this))"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total_order' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'order_count'))),
                'total_revenue' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'revenue'))),
            ];
            $dataTotalChart = [
                'Tổng tiền' => $this->numberFormat($config['data']['total_revenue_amount'])
            ];
            return [$dataChart, $dataTable, $dataTotal, $config, $dataTotalChart];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $area = $request->get('id');
        $employee = ENUM_GET_ALL;
        $customer = ENUM_GET_ALL;
        $isDiscount = ENUM_GET_ALL;
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = $request->get('limit');
        $key = $this->keySearch(($request->get('search'))['value']);
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_DETAIL_ORDER_SELL
            , $brand, $branch, $type, $time, $area, $employee, $customer, $isDiscount, $page, $limit, $key, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $detail = TEXT_DETAIL;
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                if (mb_strlen($config['data']['list'][$i]['table_name']) > 20) $config['data']['list'][$i]['table_name'] = mb_substr($config['data']['list'][$i]['table_name'], 0, 17) . '...';
                $config['data']['list'][$i]['vat_amount'] = $this->numberFormat($config['data']['list'][$i]['vat_amount']);
                $config['data']['list'][$i]['discount_amount'] = $this->numberFormat($config['data']['list'][$i]['discount_amount']);
                $config['data']['list'][$i]['point'] = $this->numberFormat($config['data']['list'][$i]['point']);
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount']);
                $config['data']['list'][$i]['payment_date'] = substr(($config['data']['list'][$i]['payment_date']), 0, 10);
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-is-print="1" data-id="' . $config['data']['list'][$i]['id'] . '" data-cancel="0" onclick="openBillDetail($(this))"><i class="fi-rr-eye"></i></button>
                            </div>';
            }
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
