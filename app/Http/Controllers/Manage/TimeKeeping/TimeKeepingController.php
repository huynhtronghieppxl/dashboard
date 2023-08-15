<?php

namespace App\Http\Controllers\Manage\TimeKeeping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class TimeKeepingController extends Controller
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
        $active_nav = 'Chấm công';
        return view('manage.time_keeping.index', compact('active_nav'));
    }

    public function employee(Request $request)
    {
        $branchID = $request->get('branch');
        $status = ENUM_GET_ALL;
        $isIncludeRestaurantManager = ENUM_DIS_SELECTED;
        $time = date('d/') . $request->get('time');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_EMPLOYEE_TIME_KEEPING, $branchID, $status, $isIncludeRestaurantManager, $time);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $dataEmployee = '';
            for ($i = 0; $i < count($data); $i++) {
                $dataEmployee .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
            }
            return [$dataEmployee, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataDate(Request $request)
    {
        $branchID = $request->get('branch');
        $type = Config::get('constants.type.date.TODAY');
        $employeeID = ENUM_GET_ALL;
        $date = $request->get('time');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_TIME_KEEPING, $employeeID, $branchID, $date, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $dateCurrent = str_replace('/', '', date('Y/m/d'));
            $dataTable = DataTables::of($config['data']['list'])
                ->addColumn('shift', function ($row) {
                    if ($row['branch_working_session_time'] !== '') {
                        return $row['branch_working_session_time'];
                    } else {
                        return $row['branch_working_session_from'] . ' - ' . $row['branch_working_session_to'];
                    }
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee']['avatar'] . "'" . ')">
                         <label class="name-inline-data-table">' . $row['employee']['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee']['role_name'] . '</label>
                         </label>';
                })
                ->addColumn('checkin', function ($row) {
                    if ($row['checkin_time'] === '') {
                        return '---';
                    } else {
                        return substr($row['checkin_time'], 11, 5);
                    }
                })
                ->addColumn('checkout', function ($row) {
                    if ($row['checkout_time'] === '') {
                        return '---';
                    } else {
                        return substr($row['checkout_time'], 11, 5);
                    }
                })
                ->addColumn('status', function ($row) use ($dateCurrent) {
                    if ($row['is_leave_day'] === 1) {
                        if ($row['is_leave_day_without_salary'] === 1) {
                            return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">Nghỉ phép có lương</label>
                                </div>';
                        } else {
                            return '<div class="seemt-gray-w400 seemt-border-gray status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">Nghỉ phép không lương</label>
                                </div>';
                        }
                    } else {
                        $date = str_replace('/', '', $row['date']);
                        $dateCompare = substr($date, 4, 4) . substr($date, 2, 2) . substr($date, 0, 2);
                        if ($row['checkin_time'] === '' && $dateCompare < $dateCurrent) {
                            return '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">Nghỉ không phép</label>
                                </div>';
                        } else {
                            return '';
                        }
                    }
                })
                ->addColumn('address', function ($row) {
                    if ($row['address'] === '') {
                        return '---';
                    } else {
                        return (mb_strlen($row['address']) > 30) ? $row['address'] = mb_substr($row['address'], 0, 27) . '...' : $row['address'];
                    }
                })
                ->addColumn('late_minutes_time', function ($row) {
                    if ($row['late_minutes'] > 0) {
                        return '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . $row['late_minutes'] . '</label>
                                </div>';
                    } else {
                        return '<div class="seemt-gray-w400 seemt-border-gray status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . $row['late_minutes'] . '</label>
                                </div>';
                    }
                })
                ->rawColumns(['avatar', 'checkin', 'checkout', 'late_minutes_time', 'status', 'address'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = $this->numberFormat(count($config['data']['list']));
            return [$dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataMonth(Request $request)
    {
        $branchID = $request->get('branch');
        $type = Config::get('constants.type.date.MONTH');
        $employeeID = $request->get('employee');
        $date = '1/'. $request->get('time');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_TIME_KEEPING, $employeeID, $branchID, $date, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $dateCurrent = str_replace('/', '', date('Y/m/d'));
            $dataTable = DataTables::of($config['data']['list'])
                ->addColumn('shift', function ($row) {
                    if ($row['branch_working_session_time'] !== '') {
                        return $row['branch_working_session_time'];
                    } else {
                        return $row['branch_working_session_from'] . ' - ' . $row['branch_working_session_to'];
                    }
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee']['avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . $row['employee']['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee']['role_name'] . '</label>
                         </label>';
                })
                ->addColumn('checkin', function ($row) {
                    if ($row['checkin_time'] === '') {
                        return '---';
                    } else {
                        return substr($row['checkin_time'], 11, 5);
                    }
                })
                ->addColumn('address', function ($row) {
                    if ($row['address'] === '') {
                        return '---';
                    } else {
                        return (mb_strlen($row['address']) > 30) ? $row['address'] = mb_substr($row['address'], 0, 27) . '...' : $row['address'];
                    }
                })
                ->addColumn('checkout', function ($row) {
                    if ($row['checkout_time'] === '') {
                        return '---';
                    } else {
                        return substr($row['checkout_time'], 11, 5);
                    }
                })
                ->addColumn('late_minutes_time', function ($row) {
                    if ($row['late_minutes'] > 0) {
                        return '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . $row['late_minutes'] . '</label>
                                </div>';
                    } else {
                        return '<div class="seemt-gray-w400 seemt-border-gray status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . $row['late_minutes'] . '</label>
                                </div>';
                    }
                })
                ->addColumn('status', function ($row) use ($dateCurrent) {
                    $date = str_replace('/', '', $row['date']);
                    $dateCompare = substr($date, 4, 4) . substr($date, 2, 2) . substr($date, 0, 2);
                    $start = str_replace('/', '', $row['employee']['working_from']);
                    $startCompare = substr($start, 4, 4) . substr($start, 2, 2) . substr($start, 0, 2);
                    if ($row['is_leave_day'] === 1) {
                        if ($row['is_leave_day_without_salary'] === 1) {
                            return '<div class="seemt-gray-w400 seemt-border-gray status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">Nghỉ phép không lương</label>
                                    </div>';
                        } else {
                            return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">Nghỉ phép có lương</label>
                                </div>';
                        }
                    }
                    else if ($row['is_leave_day'] === 0 && $row['is_leave_day_without_salary'] === 0 && substr($row['checkin_time'], 11, 5) === '00:00') {
                        return '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">Nghỉ không phép</label>
                                </div>';
                    } else if ($dateCompare < $startCompare) {
                        return '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">Chưa chấm công</label>
                                </div>';
                    } else {
                        if ($row['checkin_time'] === '' && $dateCompare < $dateCurrent) {
                            return '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">Nghỉ không phép</label>
                                </div>';
                        } else if ($row['checkin_time'] !== '' && $dateCompare < $dateCurrent) {
                            return '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">Đã chấm công</label>
                                </div>';
                        } else {
                            return '---';
                        }
                    }
                })
                ->addColumn('action', function ($row) use ($dateCurrent) {
                    $date = str_replace('/', '', $row['date']);
                    $dateCompare = substr($date, 4, 4) . substr($date, 2, 2) . substr($date, 0, 2);
                    $start = str_replace('/', '', $row['employee']['working_from']);
                    $startCompare = substr($start, 4, 4) . substr($start, 2, 2) . substr($start, 0, 2);
                    if ($row['is_leave_day_without_salary'] === ENUM_SELECTED) {
                        return '<div class="btn-group btn-group-sm">
                                <button type="button" data-session-time="' . $row['branch_working_session_time'] . '" data-address="' . $row['address'] . '"
                                    data-id="' . $row['id'] . '" data-branch="' . $row['branch']['id'] . '" data-employee="' . $row['employee']['id'] . '"
                                    data-check-out="' . $row['checkout_time'] . '"  data-check-in="' . substr($row['checkin_time'], 11, 5) . '"
                                    data-date="' . $row['date'] . '" data-leave ="' . $row['is_leave_day'] . '" data-leave-salary ="' . $row['is_leave_day_without_salary'] . '"
                                    data-late-minutes ="' . $row['late_minutes'] . '" data-work-name ="' . $row['branch_working_session_name'] . '"
                                    data-work-open ="' . date_format(date_create($row['branch_working_session_from']), 'H:i') . '" data-work-close ="' . date_format(date_create($row['branch_working_session_to']), 'H:i') . '"
                                    data-note ="' . $row['note'] . '" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"
                                    onclick="openModalUpdateTimeKeepingManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '">
                                        <i class="fi-rr-pencil"></i>
                                </button>
                            </div>';
                    } else if ($dateCompare < $startCompare) {
                        return '';
                    } else {
                        if ($dateCompare < $dateCurrent) {
                            return '<div class="btn-group btn-group-sm">
                                <button type="button" data-session-time="' . $row['branch_working_session_time'] . '" data-address="' . $row['address'] . '"
                                    data-id="' . $row['id'] . '" data-branch="' . $row['branch']['id'] . '" data-employee="' . $row['employee']['id'] . '"
                                    data-check-out="' . $row['checkout_time'] . '"  data-check-in="' . substr($row['checkin_time'], 11, 5) . '"
                                    data-date="' . $row['date'] . '" data-leave ="' . $row['is_leave_day'] . '" data-leave-salary ="' . $row['is_leave_day_without_salary'] . '"
                                    data-late-minutes ="' . $row['late_minutes'] . '" data-work-name ="' . $row['branch_working_session_name'] . '"
                                    data-work-open ="' . date_format(date_create($row['branch_working_session_from']), 'H:i') . '" data-work-close ="' . date_format(date_create($row['branch_working_session_to']), 'H:i') . '"
                                    data-note ="' . $row['note'] . '" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"
                                    onclick="openModalUpdateTimeKeepingManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '">
                                        <i class="fi-rr-pencil"></i>
                                </button>
                            </div>';
                        } else {
                            return '';
                        }
                    }
                })
                ->rawColumns(['avatar', 'checkin', 'checkout', 'address', 'late_minutes_time', 'status', 'action'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = $this->numberFormat(count($config['data']['list']));
            return [$dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function getEmployeeLeaveDay(Request $request)
    {
        $employeeID = $request->get('employee_id');
        $branchID = $request->get('branch_id');
        $time = $request->get('time');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_EMPLOYEE_LEAVE_DAY, $employeeID, $branchID, $time);
        $body = null;
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $employeeID = $request->get('employee_id');
        $checkinTime = $request->get('checkin_time');
        $checkoutTime = $request->get('checkout_time');
        $checkinDay = $request->get('checkin_day');
        $isLeaveDay = $request->get('is_leave_day');
        $isLeaveDayWithoutSalary = $request->get('is_leave_day_without_salary');
        $note = $request->get('note');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        if ($id == ENUM_ID_DEFAULT) {
            $api = sprintf(API_WORK_HISTORY_CREATE_TIME_KEEPING, $branch);
        } else {
            $api = sprintf(API_WORK_HISTORY_UPDATE_TIME_KEEPING, $id, $branch);
        }
        $body = [
            'employee_id' => $employeeID,
            'checkin_time' => $checkinTime,
            'checkout_time' => $checkoutTime,
            'checkin_day' => $checkinDay,
            'is_leave_day' => $isLeaveDay,
            'is_leave_day_without_salary' => $isLeaveDayWithoutSalary,
            'note' => $note,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
}
