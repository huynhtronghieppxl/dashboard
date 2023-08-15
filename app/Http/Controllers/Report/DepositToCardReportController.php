<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class DepositToCardReportController extends Controller
{
    public function index (Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'SALE_REPORT', 'CASHIER_ACCESS', 'BUSINESS_ACTIVE_REPORT']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Báo cáo nạp thẻ';
        return view('report.deposit_to_card.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $type = $request->get('type');
        $time = $request->get('time');
        $type_sort = ENUM_GET_ALL;
        $key_search = '';
        $page = ENUM_SELECTED;
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $limit = Config::get('constants.type.default.LIMIT_100');
        $typePoint = 0;
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_TOP_UP_POINT, $type_sort, $type, $time, $typePoint, $from, $to, $limit, $page, $key_search);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
                $dataChart = [
                    "timeline" => collect($config['data']['list'])->pluck('name'),
                    "value" => collect($config['data']['list'])->pluck('top_up_point_used'),
                ];
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $detail = TEXT_DETAIL;
            $dataTable = DataTables::of($config['data']['list'])
                ->addColumn('card', function ($row) {
                    return '<div class="waves-effect waves-light w-75 h-1rem m-auto" style="background-color: ' . $row['color_hex_code'] . '">' . $row['restaurant_membership_card_name'] . '</div>';
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>';
                })
                ->addColumn('top_up_point', function ($row) {
                    return $this->numberFormat($row['top_up_point']);
                })
                ->addColumn('total_top_up_point', function ($row) {
                    return $this->numberFormat($row['total_top_up_point']);
                })
                ->addColumn('total_top_up_point_used', function ($row) {
                    return $this->numberFormat($row['total_top_up_point_used']);
                })
                ->addColumn('top_up_point_used', function ($row) {
                    return $this->numberFormat($row['top_up_point_used']);
                })
                ->addColumn('total_top_up_point_remaining', function ($row) {
                    return $this->numberFormat($row['total_top_up_point_remaining']);
                })
                ->addColumn('action', function ($row) use ($detail, $from, $to) {
                    return '<div class="btn-group btn-group-sm text-center">
                               <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openDetailCustomers($(this))" data-id="' . $row['customer_id'] . '" data-phone="' . $row['phone'] . '" data-from="' . $from . '" data-to="' . $to . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                           </div>';
                })
                ->addIndexColumn()
                ->rawColumns(['card', 'avatar', 'address', 'action'])
                ->make(true);
            return [$dataChart, $dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
