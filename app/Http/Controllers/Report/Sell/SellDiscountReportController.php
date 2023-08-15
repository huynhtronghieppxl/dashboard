<?php

namespace App\Http\Controllers\Report\Sell;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class SellDiscountReportController extends Controller
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
        $active_nav = 'Báo Cáo Giảm Giá';
        return view('report.sell.discount.index', compact('active_nav'));
    }

    public function dataDiscountReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $api = sprintf(API_REPORT_GET_DISCOUNT, $brand, $branch, $type, $time, $from, $to);
        $body = null;
        $dataChartDiscountReport = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];

        $area = Config::get('constants.type.id.GET_ALL');
        $employee = Config::get('constants.type.id.GET_ALL');
        $customer = Config::get('constants.type.id.GET_ALL');
        $isDiscount = Config::get('constants.type.checkbox.SELECTED');
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50;
        $key = '';
        $api = sprintf(API_REPORT_GET_DETAIL_ORDER_SELL, $brand, $branch, $type, $time, $area, $employee, $customer, $isDiscount, $page, $limit, $key, $from ,$to);
        $body = null;
        $listDiscountReport = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];

        $configAll = $this->callApiMultiGatewayTemplate2([$dataChartDiscountReport, $listDiscountReport]);
        try {
            $data = $configAll[0]['data']['list'];

                $data_chart = [
                    "timeline" => collect($data)->pluck('report_time')->map(function ($item, $key) use($type) {
                        return $this->covertTimeReport($item, $type, $key);
                    }),
                    "quantity" => collect($data)->pluck(['order_quantity']),
                    "value" => collect($data)->pluck(['total_amount'])
                ];
            $detail = TEXT_DETAIL;
            $dataTable = DataTables::of($configAll[1]['data']['list'])
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('discount_percent', function ($row) {
                    return $row['discount_percent'] . '%';
                })
                ->addColumn('discount_amount', function ($row) {
                    return $this->numberFormat($row['discount_amount']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('payment_date', function ($row) {
                    return $this->convertDateTime($row['payment_date']);
                })

                ->addColumn('action', function ($row) use ($detail) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"
                                    data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"
                                    data-id="' . $row['id'] . '" data-is-print="0" data-cancel="0" onclick="openBillDetail($(this))">
                                    <i class="fi-rr-eye"></i>
                            </button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['amount', 'discount_percent', 'discount_amount', 'discount_amount', 'total_amount', 'payment_date', 'action'])
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
}
