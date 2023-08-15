<?php

namespace App\Http\Controllers\Report\Sell;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class SellSurchargeReportController extends Controller
{
    public function index (Request $request)
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
        $active_nav = 'Báo Cáo Phụ Thu';
        return view('report.sell.surcharge.index', compact('active_nav'));
    }

    public function dataSurchargeReport (Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $api = sprintf(API_REPORT_GET_SURCHARGE, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $chartSurcharge = [
            'project' => ENUM_PROJECT_ID_REPORT_NODE_V2,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_100;
        $api = sprintf(API_REPORT_GET_TABLE_SURCHARGE, $brand, $branch, $type, $time, $from, $to, $page, $limit);
        $body = null;
        $tableSurcharge = [
            'project' => ENUM_PROJECT_ID_REPORT_NODE_V2,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$chartSurcharge, $tableSurcharge]);
        try {
            $data = $configAll[0]['data']['list'];

            $data_chart = [
                "timeline" => collect($data)->pluck('report_time')->map(function ($item, $key) use($type) {
                    return $this->covertTimeReport($item, $type, $key);
                }),
                "value" => collect($data)->pluck('total_amount'),
                "quantity" => collect($data)->pluck('order_quantity')
            ];

            $dataTable = DataTables::of($configAll[1]['data']['list'])
                ->addColumn('name', function ($row) use ($type, $data) {
                    return $row['order_name'];
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['extra_charge_amount']);
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $type, $time, $data, $from, $to) {
                    $detail = TEXT_DETAIL;
//                    switch ($type) {
//                        case 1 :
//                            $data_type = 17;
//                            $date = $row['report_time'].':00:00';
//                            $data_date = date('d/m/Y H:i:s', strtotime($date));
//                            break;
//                        case 2 :
//                        case 3 :
//                            $data_type = ENUM_SELECTED;
//                            $data_date = date_format(date_create($row['report_time']), 'd/m/Y');
//                            break;
//                        case 4 :
//                            $data_type = ENUM_SELECTED;
//                            $data_date = date_format(date_create($row['report_time']), 'd/m/Y');
//                            break;
//                        case 5 :
//                            $data_type = 3;
//                            $data_date = date_format(date_create($row['report_time']), 'm/Y');
//                            break;
//                        case 6 :
//                            $data_type = 3;
//                            $data_date = date_format(date_create($row['report_time']), 'm/Y');
//                            break;
//                        case 13:
//                            $data_type = ENUM_SELECTED;
//                            $data_date = date_format(date_create($row['report_time']), 'd/m/Y');
//                            break;
//                        case 15 :
//                            $data_type = 3;
//                            $data_date = date_format(date_create($row['report_time']), 'm/Y');
//                            break;
//                        default :
//                            $data_type = 5;
//                            $data_date = $this->covertTimeReport($row['report_time'], $type, '');
//                    }
//                    $time_detail = $data_type == ENUM_DIS_SELECTED ? date('d/m/Y H:i:s', strtotime($row['report_time'])) : $time;
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-type="' . $type . '"
                            data-time="' . $time . '" data-from="' . $from . '" data-to="' . $to . '"  data-placement="top" data-original-title="' . $detail . '" data-brand="' . $brand . '"
                             data-branch="' . $branch . '" data-id="'. $row['restaurant_extra_charge_id'] .'"
                             onclick="openModalDetailSurchargeSellReport($(this))"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns([ 'name', 'amount', 'action'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total' => $this->numberFormat($configAll[0]['data']['total_amount']),
            ];
            return [$data_chart, $dataTable, $dataTotal, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    function detail(Request $request)
    {
        $id = $request->get('id');
        $restaurant_brand_id = $request->get('brand');
        $branch_id = $request->get('branch');
        $report_type = $request->get('type');
        $date_string = $request->get('time');
        $from_date = $request->get('form');
        $to_date = $request->get('to');
        $restaurant_extra_charge_id = -1;
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_DETAIL_SURCHARGE, $id, $restaurant_brand_id, $branch_id, $report_type, $date_string, $from_date, $to_date, $restaurant_extra_charge_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $dataTable = DataTables::of($config['data'])
                ->addColumn('employee_name', function ($row) {
                    return $row['employee_name'];
                })
                ->addColumn('code', function ($row) {
                    return $row['id'];
                })
                ->addColumn('table_name', function ($row) {
                    return $row['table_name'];
                })
               ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
               ->addColumn('note', function ($row) {
                    return $row['note'];
                })
                ->addColumn('payment_date', function ($row) {
                    return '<label>' . $this->convertDateTime($row['payment_date']) . '</label>';
                })
                ->addColumn('action', function ($row) {
                    return '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" data-id="'. $row['id'] .'"  data-title="Chi tiết" onclick="openBillDetail($(this))"><i class="fi-rr-eye"></i></button>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['code', 'employee_name', 'table_name', 'total_amount', 'note', 'payment_date', 'action'])
                ->addIndexColumn()
                ->make(true);
            return [$dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
