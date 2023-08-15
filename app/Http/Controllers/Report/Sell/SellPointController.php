<?php

namespace App\Http\Controllers\Report\Sell;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class SellPointController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'MARKETING_MANAGER', 'BUSINESS_ACTIVE_REPORT', 'SALE_REPORT', 'CASHIER_ACCESS', 'CHEF_COOK_ACCESS', 'BAR_ACCESS']);
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
        $active_nav = 'Báo Cáo Điểm';
        return view('report.sell.point.index', compact('active_nav'));
    }

    public function dataPointReport(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type_point = (int)$request->get('pointType');
        $type_sort = (int)$request->get('pointSort');
        $type = $request->get('type');
        $time = $request->get('time');
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $key_search = '';
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_PROMOTION_POINT, $type_point, $type_sort, $type,
            $time, $key_search, $from, $to, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_chart = [];
            $data = $config['data']['list'];
            foreach ($data as $key => $db) {
                if ($type_point === 0) {
                    $data_chart[$key] = array(
                        "timeline" => $db['name'],
                        "value" => $db['accumulate_point_used'],
                    );
                }else {
                    $data_chart[$key] = array(
                        "timeline" => $db['name'],
                        "value" => $db['promotion_point_used'],
                    );
                }
            }
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $dataTable = DataTables::of($data)
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>';
                })
                ->addColumn('total_point_receive', function ($row) use ($type_point) {
                    if ($type_point === 0) {
                        return $this->numberFormat($row['total_accumulate_point']);
                    }else {
                        return $this->numberFormat($row['total_promotion_point']);
                    }
                })
                ->addColumn('point_receive', function ($row) use ($type_point)  {
                    if ($type_point === 0) {
                        return $this->numberFormat($row['accumulate_point']);
                    }else {
                        return $this->numberFormat($row['promotion_point']);
                    }
                })
                ->addColumn('total_point_use', function ($row) use ($type_point)  {
                    if ($type_point === 0) {
                        return $this->numberFormat($row['total_accumulate_point_used']);
                    }else {
                        return $this->numberFormat($row['total_promotion_point_used']);
                    }
                })
                ->addColumn('point_use', function ($row) use ($type_point)  {
                    if ($type_point === 0) {
                        return $this->numberFormat($row['accumulate_point_used']);
                    }else {
                        return $this->numberFormat($row['promotion_point_used']);
                    }
                })
                ->addColumn('total_point_remaining', function ($row) use ($type_point)  {
                    if ($type_point === 0) {
                        return $this->numberFormat($row['total_accumulate_point_remaining']);
                    }else {
                        return $this->numberFormat($row['total_promotion_point_remaining']);
                    }
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $type, $time, $from, $to) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" data-id="'.$row['customer_id'].'" onclick="openDetailCustomers($(this))"><i class="fi-rr-eye"></i></button>
                             </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['avatar', 'total_point_receive', 'point_receive', 'total_point_use', 'point_use', 'total_point_remaining', 'action'])
                ->addIndexColumn()
                ->make(true);

            if ($type_point === 0) {
                $totalRemaining = $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_accumulate_point_remaining')));
                $totalReceive = $this->numberFormat(array_sum(array_column($config['data']['list'], 'accumulate_point')));
                $totalNumberReceive = $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_accumulate_point')));
                $totalUsed = $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_accumulate_point_used')));
                $totalNumberUsed = $this->numberFormat(array_sum(array_column($config['data']['list'], 'accumulate_point_used')));
            }else {
                $totalRemaining = $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_promotion_point_remaining')));
                $totalReceive = $this->numberFormat(array_sum(array_column($config['data']['list'], 'promotion_point')));
                $totalNumberReceive = $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_promotion_point')));
                $totalUsed = $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_promotion_point_used')));
                $totalNumberUsed = $this->numberFormat(array_sum(array_column($config['data']['list'], 'promotion_point_used')));
            }
                $dataTotal = [
                    'totalRemaining' => $totalRemaining,
                    'totalReceive' => $totalReceive,
                    'totalNumberReceive' => $totalNumberReceive,
                    'totalUsed' => $totalUsed,
                    'totalNumberUsed' => $totalNumberUsed
                ];

            return [$data_chart, $dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
