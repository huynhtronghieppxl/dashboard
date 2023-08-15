<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\Datatables\Datatables;

class HistoryPointReportController extends Controller
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
        $active_nav = 'Lịch sử tích điểm';
        return view('customer.report.history_point.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $typeClient = $request->get('type');
        $date = date('d/m/Y');
        switch ($typeClient) {
            case Config::get('constants.type.date.TODAY'):
                $type = Config::get('constants.type.date.TODAY');
                $date = $request->get('time');
                break;
            case Config::get('constants.type.date.WEEK'):
                $type = Config::get('constants.type.date.WEEK');
                break;
            case Config::get('constants.type.date.MONTH'):
                $type = Config::get('constants.type.date.MONTH');
                $time = $request->get('time');
                $date = '1/' . $time;
                break;
            case Config::get('constants.type.date.THREE_MONTH'):
                $type = Config::get('constants.type.date.THREE_MONTH');
                break;
            case Config::get('constants.type.date.YEAR'):
                $type = Config::get('constants.type.date.YEAR');
                $time = $request->get('time');
                $date = date('1/m/') . $time;
                break;
            case Config::get('constants.type.date.THREE_YEAR'):
                $type = Config::get('constants.type.date.THREE_YEAR');
                break;
            case Config::get('constants.type.date.ALL_YEAR'):
                $type = Config::get('constants.type.date.ALL_YEAR');
                break;
            default:
                $type = Config::get('constants.type.date.TODAY');
                $date = date('d/m/Y');
        };
        $projectID = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_HISTORY_POINT_CUSTOMER, $type, $date);
        $body = null;
        $config = $this->callApiGatewayTemplate2($projectID, $method, $api, $body);
        try {
            $dataTable = DataTables::of($config['data'])
                ->addColumn('name', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"><label class="title-name-new-table" >'.$row['name'].'</label>';
                })
                ->editColumn('gender', function ($rows) {
                    if ($rows['gender'] == TEXT_FEMALE_VALUE) {
                        return '<i class="ion-female mr-1 "></i>'.TEXT_FEMALE;
                    } else {
                        return '<i class="ion-male mr-1 text-primary"></i>'.TEXT_MALE;
                    }
                })
                ->addColumn('added_point_count', function ($row) {
                    return $this->numberFormat($row['added_point_count']);
                })
                ->addColumn('subtracted_point_count', function ($row) {
                    return $this->numberFormat($row['subtracted_point_count']);
                })
                ->addColumn('added_point', function ($row) {
                    return $this->numberFormat($row['added_point']);
                })
                ->addColumn('subtracted_point', function ($row) {
                    return $this->numberFormat($row['subtracted_point']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'avatar','name','gender'])
                ->addIndexColumn()
                ->make(true);

            return [$dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
