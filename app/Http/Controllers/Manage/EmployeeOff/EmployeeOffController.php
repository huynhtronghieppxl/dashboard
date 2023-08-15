<?php

namespace App\Http\Controllers\Manage\EmployeeOff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class EmployeeOffController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'EMPLOYEE_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(2);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Hoạt động';
        return view('manage.employee_off.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');
        $branch = $request->get('branch');
        $status = $request->get('status');
        $diligence = $request->get('diligence');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_EMPLOYEE_GET_LIST_ACTIVITIES, $month , $year, $branch, $status, $diligence);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $dataTableMonth = DataTables::of($data)
                ->addColumn('avatar', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                   return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                         <label class="name-inline-data-table">' . $row['full_name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['role'] . '</label>
                         </label>';
                })
                ->addColumn('working_from_begin', function ($rows) {
                    $day = $this->convertDayToDayMonthYear($rows['working_from_begin']);
                    return $day;
                })
                ->addColumn('total_month_diligence', function ($rows) {
                    if ($rows['total_month_diligence'] > ENUM_DIS_SELECTED) {
                        return '<div class="btn-group btn-group-sm"><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="Chuyên cần"></i></div>';
                    } else {
                        return '<div class="btn-group btn-group-sm"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="Không chuyên cần"></i></div>';
                    }
                })
                ->addColumn('status', function ($row) {
                    if ($row['status'] === ENUM_DIS_SELECTED) {
                        return '<div class="seemt-gray-w400 seemt-border-gray status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_DISABLE_STATUS . '</label>
                                </div>';
                    } else {
                        return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_STATUS_ENABLE . '</label>
                                </div>';
                    }
                })
                ->addColumn('action', function ($rows) {
                    return '<div class="btn-group btn-group-sm text-center">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeManage(' . $rows['employee_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title=" '. TEXT_DETAIL .' "><i class="fi-rr-eye"></i></button>
                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['avatar', 'working_from_begin', 'action', 'total_month_diligence', 'status'])
                ->addIndexColumn()
                ->make(true);

            $dataTableYear = DataTables::of($data)
                ->addColumn('avatar', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                         <label class="name-inline-data-table">' . $row['full_name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['role'] . '</label>
                         </label>';
                })
                ->addColumn('working_from_begin', function ($rows) {
                    return $this->convertDayToDayMonthYear($rows['working_from_begin']);
                })
                ->addColumn('diligence_months', function ($rows) {
                    if ($rows['diligence_months'] != []) {
                        return '<a class="class-link underline cursor-pointer" data-name="'. $rows['full_name'] .'" data-diligence="'. implode( ',', $rows['diligence_months']) .'" onclick="openModalDiligenceEmployeeManage($(this))">' . count(($rows['diligence_months'])) . ' Tháng' . '</a>';
                    } else {
                        return '<label class="text-danger">0</label>';
                    }
                })
                ->addColumn('status', function ($row) {
                    if ($row['status'] === ENUM_DIS_SELECTED) {
                        return '<div class="seemt-gray-w400 seemt-border-gray status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_DISABLE_STATUS . '</label>
                                </div>';
                    } else {
                        return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_STATUS_ENABLE . '</label>
                                </div>';
                    }
                })
                ->addColumn('action', function ($rows) {
                    return '<div class="btn-group btn-group-sm text-center">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeManage(' . $rows['employee_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title=" '. TEXT_DETAIL .' "><i class="fi-rr-eye"></i></button>
                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['avatar', 'working_from_begin', 'action', 'status', 'diligence_months'])
                ->addIndexColumn()
                ->make(true);
            return [$dataTableMonth, $dataTableYear, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTableDiligenceMonths(Request $request) {
        $dataDiligence = explode(',',$request->get('diligence'));
        $dataMonths = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $tableDiligence = DataTables::of($dataMonths)
            ->addColumn('months', function ($row) {
                return 'Tháng ' . $row;
            })
            ->addColumn('is_diligence', function ($row) use ($dataDiligence) {
                if ( $dataDiligence !== []) {
                    return (in_array($row , $dataDiligence))
                        ? '<div class="btn-group btn-group-sm"><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="Chuyên cần"></i></div>'
                        : '<div class="btn-group btn-group-sm"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="Không chuyên cần"></i></div>';
                }
            })
            ->rawColumns(['months', 'is_diligence'])
            ->addIndexColumn()
            ->make(true);
        return [$tableDiligence];
    }
}


