<?php

namespace App\Http\Controllers\Report\Sell;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\DataTables;

class SellVATReportController extends Controller
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
        $active_nav = 'BÁO CÁO VAT';
        return view('report.sell.vat.index', compact('active_nav'));
    }

    public function dataVATReport (Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $date_string = $request->get('time');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_VAT, $brand, $branch, $date_string, $from, $to, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_chart = [];
            $data = $config['data']['list'];
                $i = 0;
                foreach ($data as $key => $db) {
                    $data_chart[$i] = array(
                        "timeline" => $this->covertTimeReport($db['report_time'], $type, $key),
                        "valueVat" => $db['vat_amount'],
                        "quantity" => $db['order_quantity']
                    );
                    $i++;
                }
            $dataTable = DataTables::of($data)
                ->addColumn('vat_amount', function ($row) {
                    return $this->numberFormat($row['vat_amount']);
                })
                ->addColumn('report_time', function ($row) use ($type, $data) {
                    return $this->covertTimeReport($row['report_time'], $type, array_search($row['report_time'], array_column((array)$data, 'report_time')));
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $type, $date_string, $data, $from, $to) {
                    switch ($type) {
                        case 1 :
                            $data_type = 17;
                            $date=$row['report_time'].':00:00';
                            $data_date = date('d/m/Y H:i:s', strtotime($date));
                            break;
                        case 2 :
                        case 3 :
                            $data_type = ENUM_SELECTED;
                            $data_date = date_format(date_create($row['report_time']), 'd/m/Y');
                            break;
                        case 4 :
                            $data_type = ENUM_SELECTED;
                            $data_date = date_format(date_create($row['report_time']), 'd/m/Y');
                            break;
                        case 5 :
                            $data_type = 3;
                            $data_date = date_format(date_create($row['report_time']), 'm/Y');
                            break;
                        case 6 :
                            $data_type = 3;
                            $data_date = date_format(date_create($row['report_time']), 'm/Y');
                            break;
                        case 13:
                            $data_type = ENUM_SELECTED;
                            $data_date = date_format(date_create($row['report_time']), 'd/m/Y');
                            break;
                        case 15 :
                            $data_type = 3;
                            $data_date = date_format(date_create($row['report_time']), 'm/Y');
                            break;
                        default :
                            $data_type = 5;
                            $data_date = $this->covertTimeReport($row['report_time'], $type, '');
                    }
                    $time_detail = $data_type == ENUM_DIS_SELECTED ? date('d/m/Y H:i:s', strtotime($row['report_time'])) : $date_string;
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-type="' . $type . '"
                            data-time="' . $date_string . '" data-from="' . $from . '" data-to="' . $to . '"  data-placement="top" data-brand="' . $brand . '"
                             data-branch="' . $branch . '" data-date="' . $data_date . '" data-type-date="' . $data_type . '" data-time-detail="' . $time_detail . '"
                             onclick="openModalDetailVATSellReport($(this))"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->rawColumns(['vat_amount', 'report_time', 'action', 'keysearch'] )
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'vat_amount')))
            ];
            return [$data_chart, $dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    function detail(Request $request)
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
        $isVat = 1;
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = $request->get('limit');
        $key = $this->keySearch(($request->get('search'))['value']);
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_DETAIL_VAT_SELL, $brand, $branch, $type, $time, $area, $employee, $customer, $isVat, $page, $limit, $key, $from ,$to);
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
