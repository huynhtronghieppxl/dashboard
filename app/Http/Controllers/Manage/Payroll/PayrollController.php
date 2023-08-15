<?php

namespace App\Http\Controllers\Manage\Payroll;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PayrollController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(2);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Quản lý bảng lương';
        return view('manage.payroll.index', compact('active_nav'));
    }

    public function role(Request $request)
    {
        $branchID = $request->get('branch');
        $type = ENUM_GET_ALL;
        $status = ENUM_STATUS_GET_ACTIVE;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_ROLE_GET_DATA, $branchID, $status, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $dataOption = '<option value="" selected>' . TEXT_ALL_ROLE_EMPLOYEE . '</option>';
            if (count($data) != 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $dataOption = $dataOption . '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
            return [$dataOption, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function data(Request $request)
    {
        $branchID = $request->get('branch');
        $time = date('d/') . $request->get('time');
        $status = $request->get('status');
        $employeeRoleIDs = $request->get('role');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SALARY_SALARY_TABLE_GET_DATA, $branchID, $time, $status, $employeeRoleIDs);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $total_count_confirm_salary = 0;
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                if (in_array($config['data']['list'][$i]['status'], Config::get('constants.type.payroll.OWNER_CONFIRM'))) {
                    $total_count_confirm_salary += 1;
                }
            }
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $dataTable = Datatables::of($config['data']['list'])
                ->addColumn('name', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee']['avatar'] . '" data-status="'. $row['status'] .'" data-reason="'. $row['reason'] .'" data-value="'. $row['employee']['id'] .'" class="img-inline-name-data-table">
                            <label class="name-inline-data-table"><p style="font-size: 14px !important;">'. $row['employee']['name'] . '</p>
                                <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle"></i>' . $row['employee']['role_name'] . '</label>
                            </label>';
                })
                ->addColumn('department', function ($row) {
                    return $row['employee']['role_name'];
                })
                ->addColumn('total_leave_day_with_salary', function ($row) {
                    return $this->numberFormat($row['total_leave_day_with_salary']);
                })
                ->addColumn('total_leave_day_without_salary', function ($row) {
                    return $this->numberFormat($row['total_leave_day_without_salary']);
                })
                ->addColumn('total_leave_day_not_allow', function ($row) {
                    return $this->numberFormat($row['total_leave_day_not_allow']);
                })
                ->addColumn('kpi_score', function ($row) {
                    return $this->numberFormat($row['kpi_score'], 1) . '/' . $this->numberFormat($row['review_score']);
                })
                ->addColumn('basic_salary_in_term', function ($row) {
                    return $this->numberFormat($row['basic_salary_in_term']);
                })
                ->addColumn('total_working_day', function ($row) {
                    return $row['total_working_day'] . '/' . $row['total_day_in_month'];
                })
                ->addColumn('salary_by_working_day', function ($row) {
                    return $this->numberFormat($row['salary_by_working_day']);
                })
                ->addColumn('target_point_bonus_salary_in_branch', function ($row) {
                    return $this->numberFormat($row['target_point_bonus_salary_in_branch']);
                })
                ->addColumn('bonus_booking', function ($row) {
                    return $this->numberFormat($row['bonus_booking']);
                })
                ->addColumn('bonus_kaizen', function ($row) {
                    return $this->numberFormat($row['bonus_kaizen']);
                })
                ->addColumn('total_customer_invited', function ($row) {
                    return $this->numberFormat($row['total_customer_invited']);
                })
                ->addColumn('customer_invited_bonus', function ($row) {
                    return $this->numberFormat($row['customer_invited_bonus_amount']);
                })
                ->addColumn('other_bonus', function ($row) {
                    return $this->numberFormat($row['other_bonus']);
                })
                ->addColumn('chef_bonus_amount', function ($row) {
                    return $this->numberFormat($row['chef_bonus_amount']);
                })
                ->addColumn('master_chef_bonus_amount', function ($row) {
                    return $this->numberFormat($row['master_chef_bonus_amount']);
                })
                ->addColumn('bonus_support_overtime_amount', function ($row) {
                    return $this->numberFormat($row['bonus_support_overtime_amount']);
                })
                ->addColumn('total_bonus', function ($row) {
                    return $this->numberFormat($row['total_bonus']);
                })
                ->addColumn('late_minutes', function ($row) {
                    return $this->numberFormat($row['late_minutes']);
                })
                ->addColumn('not_checkout_day', function ($row) {
                    return $this->numberFormat($row['not_checkout_day']);
                })
                ->addColumn('punish_late_minute_amount', function ($row) {
                    return $this->numberFormat($row['punish_late_minute_amount']);
                })
                ->addColumn('punish_not_checkout_amount', function ($row) {
                    return $this->numberFormat($row['punish_not_checkout_amount']);
                })
                ->addColumn('uniform_amount', function ($row) {
                    return $this->numberFormat($row['uniform_amount']);
                })
                ->addColumn('pre_paid_amount', function ($row) {
                    return $this->numberFormat($row['pre_paid_amount']);
                })
                ->addColumn('debt_amount', function ($row) {
                    return $this->numberFormat($row['debt_amount']);
                })
                ->addColumn('other_punish', function ($row) {
                    return $this->numberFormat($row['other_punish']);
                })
                ->addColumn('total_punish', function ($row) {
                    return $this->numberFormat($row['total_punish']);
                })
                ->addColumn('total_punish_amount', function ($row) {
                    return $this->numberFormat($row['total_punish_amount']);
                })
                ->addColumn('total_salary_reduce', function ($row) {
                    return $this->numberFormat($row['total_salary_reduce']);
                })
                ->addColumn('total_temporary_salary', function ($row) {
                    return $this->numberFormat($row['total_temporary_salary']);
                })
                ->addColumn('total_salary', function ($row) {
                    return $this->numberFormat($row['total_salary']);
                })
                ->addColumn('total_not_checkin_day', function ($row) {
                    return $this->numberFormat($row['total_not_checkin_day']);
                })
                ->addColumn('status_name_id', function ($row) {
                    switch ($row['status']) {
                        case Config::get('constants.type.payroll.PENDING'):
                            return '<div class="status-new seemt-gray-w700 seemt-border-gray-w700" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0" data-id="' . $row['status'] . '">' . TEXT_TEMPORARY . '</label>
                                    </div>';
                        case Config::get('constants.type.payroll.WAITING_EMPLOYEE_CONFIRM'):
                            return '<div class="status-new seemt-orange seemt-border-orange " style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to " style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0" data-id="' . $row['status'] . '">' . TEXT_WAITING_EMPLOYEE_CONFIRM . '</label>
                                    </div>';
                        case Config::get('constants.type.payroll.WAITING_MANAGER_CONFIRM'):
                            return '<div class="status-new seemt-green-w600 seemt-border-green-w600 " style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to " style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0" data-id="' . $row['status'] . '">' . TEXT_WAITING_MANAGER_CONFIRM . '</label>
                                    </div>';
                        case Config::get('constants.type.payroll.WAITING_GENERAL_MANAGER_CONFIRM'):
                            return '<div class="status-new seemt-brown seemt-border-brown " style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to " style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0" data-id="' . $row['status'] . '">' . TEXT_WAITING_GENERAL_MANAGER_CONFIRM . '</label>
                                    </div>';
                        case Config::get('constants.type.payroll.WAITING_APPROVE'):
                            return '<div class="status-new seemt-blue-w400 seemt-border-blue-w400 " style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to " style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0" data-id="' . $row['status'] . '">' . TEXT_WAITING_APPROVE . '</label>
                                    </div>';
                        case Config::get('constants.type.payroll.APPROVED'):
                            return '<div class="status-new seemt-blue seemt-border-blue " style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to " style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0" data-id="' . $row['status'] . '">' . TEXT_APPROVE . '</label>
                                    </div>';
                        case Config::get('constants.type.payroll.DENIED'):
                            return '<div class="status-new seemt-red seemt-border-red " style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to " style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0" data-id="' . $row['status'] . '">' . TEXT_DENIED . '</label>
                                    </div>';
                        default:
                            return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0" data-id="' . $row['status'] . '">' . TEXT_PAID . '</label>
                                    </div>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $updateSalary = '';
                    if ($row['status'] < Config::get('constants.type.payroll.APPROVED')) {
                        $updateSalary = '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateBasicSalary(' . $row['employeeId'] . ',' . $row['branch_id'] . ',$(this))" data-toggle="tooltip" data-placement="top" data-original-title="Đổi lương cơ bản"><i class="fi-rr-pencil"></i></button>';
                    }
                    if (in_array($row['status'], Config::get('constants.type.payroll.OWNER_CONFIRM'))) {
                        return '<div class="checkbox-form-group d-none checkbox-salary-treasure">
                                    <input type="checkbox" id="check-salary" class="m-0">
                                </div>
                                <div class="btn-group btn-group-sm float-right">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green seemt-green waves-effect waves-light" onclick="verifyPayroll(' . $row['employee']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_OWNER_CONFIRM_TREASURER . '"><i class="fi-rr-check"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="deniedSalaryEmployee(' . $row['employee']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DENIED . '"><i class="fi-rr-cross"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateBasicSalary(' . $row['employeeId'] . ',' . $row['branch_id'] . ',$(this))" data-toggle="tooltip" data-placement="top" data-original-title="Đổi lương cơ bản"><i class="fi-rr-pencil"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="detailPayroll(' . $row['employee']['id'] . ',this)" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="notifyPayroll($(this))" data-id="' . $row['employee']['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NOTIFY . '"><i class="fi-rr-edit"></i></button>
                                </div>';
                    } else {
                        return '<div class="checkbox-form-group d-none checkbox-salary-treasure "  >
                                    <input type="checkbox" id="check-salary" class="disabled m-0" disabled style="cursor: no-drop;">
                                </div>
                                <div class="btn-group btn-group-sm float-right">
                                    ' . $updateSalary . '
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="detailPayroll(' . $row['employee']['id'] . ',this)" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['status_name_id', 'action', 'name', 'avatar'])
                ->make(true);
            $dataTotal = [
                'leave_allowed' => $this->numberFormat($config['data']['total_leave_day_with_salary']),
                'leave_of_absence' => $this->numberFormat($config['data']['total_leave_day_without_salary']),
                'leave_not_allow' => $this->numberFormat($config['data']['total_leave_day_not_allow']),
                'kpi_point' => $this->numberFormat($config['data']['kpi_score'], 1),
                'base_salary_after_increase' => $this->numberFormat($config['data']['basic_salary']),
                'work_day' => $this->numberFormat($config['data']['total_working_day']),
                'salary_based_on_workday' => $this->numberFormat($config['data']['salary_by_working_day']),
                'sale_point_bonus' => $this->numberFormat($config['data']['target_point_bonus_salary_in_branch']),
                'bonus_booking' => $this->numberFormat($config['data']['bonus_booking']),
                'bonus_kaizen' => $this->numberFormat($config['data']['bonus_kaizen']),
                'customer_new' => $this->numberFormat($config['data']['total_customer_invited']),
                'customer_bonus' => $this->numberFormat($config['data']['customer_invited_bonus_amount']),
                'other_bonus' => $this->numberFormat($config['data']['other_bonus']),
                'kitchen_staff_evaluate_food' => $this->numberFormat($config['data']['chef_bonus_amount']),
                'chef_evaluate_food' => $this->numberFormat($config['data']['master_chef_bonus_amount']),
                'support' => $this->numberFormat($config['data']['bonus_support_overtime_amount']),
                'total_bonus' => $this->numberFormat($config['data']['total_bonus']),
                'minute_late_total' => $this->numberFormat($config['data']['late_minutes']),
                'total_day_without_check_out' => $this->numberFormat($config['data']['not_checkout_day']),
                'excessive_late_fines' => $this->numberFormat($config['data']['punish_late_minute_amount']),
                'excessive_fines_without_check_out' => $this->numberFormat($config['data']['punish_not_checkout_amount']),
                'other_punish' => $this->numberFormat($config['data']['other_punish']),
                'total_punish_amount' => $this->numberFormat($config['data']['total_punish_amount']),
                'uniform_money' => $this->numberFormat($config['data']['uniform_amount']),
                'pre_paid_amount' => $this->numberFormat($config['data']['pre_paid_amount']),
                'debt_wrong_bill' => $this->numberFormat($config['data']['debt_amount']),
                'total_salary_reduce' => $this->numberFormat($config['data']['total_salary_reduce']),
                'total_punish' => $this->numberFormat($config['data']['total_punish']),
                'total_salary' => $this->numberFormat($config['data']['total_salary']),
                'total_temporary_salary' => $this->numberFormat($config['data']['total_temporary_salary']),
                'total_not_checkin_day' => $this->numberFormat($config['data']['total_not_checkin_day']),
                'total_count_confirm_salary' => $total_count_confirm_salary
            ];
            $checkActive = 0;
            if ($config['data']['status_list'] !== []) {
                if ((count($config['data']['status_list']) === 1) && ($config['data']['status_list'][0] === (int)Config::get('constants.type.payroll.PENDING'))) {
                    $checkActive = 0;
                } else {
                    $checkActive = 1;
                }
            }
            return [$dataTable, $dataTotal, $checkActive, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function ownerConfirm(Request $request)
    {
        $branchID = $request->get('branch');
        $id = $request->get('employee_id');
        if ($id == null) {
            $id = Config::get('constants.type.id.GET_ALL');
        }
        $time = date('d/') . $request->get('time');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SALARY_POST_OWNER_CONFIRM_SALARY_TABLE);
        $body = [
            'branch_id' => $branchID,
            'employee_ids' => $id,
            'time' => $time,
        ];

        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $month = $request->get('month');
        $branchID = $request->get('branch');
        $api = sprintf(API_EMPLOYEE_MONTHLY_INFORMATION_GET_UPDATE, $id, $month, $branchID);
        $body = null;
        $requestMonthly = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_SALARY_LEVEL_GET_ALL);
        $body = null;
        $requestSalary = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestMonthly, $requestSalary]);
        try {
            $config = $configAll[0];
            $config['data']['basic_salary'] = $this->numberFormat($config['data']['basic_salary']);
            $configSalary = $configAll[1];
            $data = $configSalary['data']['list'];
            $dataSalary = '<option disabled selected value="-1">'. TEXT_DEFAULT_OPTION .'</option>';
            for ($i = 0; $i < count($data); $i++) {
                $dataSalary .= '<option title="' . $data[$i]['basic_salary'] . '" value="' . $data[$i]['id'] . '">' . $data[$i]['level'] . " - " . $this->numberFormat($data[$i]['basic_salary']) . '</option>';
            }
            if ($dataSalary === '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>') {
                $dataSalary = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            if ($dataSalary === '') {
                $dataSalary = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$config['data'], $dataSalary, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $brandID = $request->get('brand');
        $branchID = $request->get('branch');
        $time = $request->get('time');
        $date = date('d/') . $time;
        $employeeID = $request->get('employee_id');
        $page = ENUM_DEFAULT_PAGE;
        $type = Config::get('constants.type.date.MONTH');
        $api = sprintf(API_SALARY_GET_PUNISH_DETAIL, $branchID,$employeeID, $date);
        $body = null;
        $requestPunishDetail = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $api = sprintf(API_SALARY_GET_POINT_DETAIL, $branchID, $employeeID, $page, $limit, $date);
        $body = null;
        $requestPointDetail = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_SALARY_GET_CHECK_IN_DETAILS, $date, $branchID, $employeeID, $type);
        $body = null;
        $requestCheckInDetail = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $from = '1/' . $time;
        $lastDay = date('t', strtotime($from));
        $to = $lastDay . '/' . $time;
        $api = sprintf(API_SALARY_GET_DEBIT_HISTORY, $page, $brandID, $branchID, $employeeID, $from, $to);
        $body = null;
        $requestDebitHistory = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestPunishDetail, $requestPointDetail, $requestCheckInDetail, $requestDebitHistory]);
        try {
            $dataTotal['total_record_punish'] = $this->numberFormat(count($configAll[0]['data']));
            $dataTotal['total_punish'] = $this->numberFormat(abs(array_sum(array_column($configAll[0]['data'], 'amount'))));
            $dataTable1 = DataTables::of($configAll[0]['data'])
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->make(true);
            $data = $configAll[1]['data']['list'];
            for ($i = 0; $i < count($data); $i++) {
                $configAll[1]['data']['list'][$i]['point'] =intval(  $configAll[1]['data']['list'][$i]['point']);
            }
            $dataTotal['total_record_point'] = $this->numberFormat(count($configAll[1]['data']['list']));
            $dataTotal['total_point'] = $this->numberFormat(array_sum(array_column($configAll[1]['data']['list'], 'point')), 2);
            $dataTotal['total_amount'] = $this->numberFormat(array_sum(array_column($configAll[1]['data']['list'], 'amount')), 1);
            $dataTotal['total_rank'] = $this->numberFormat(array_sum(array_column($configAll[1]['data']['list'], 'rank_amount')), 1);
            $dataTable2 = DataTables::of($configAll[1]['data']['list'])
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('rank_amount', function ($row) {
                    return $this->numberFormat($row['rank_amount']);
                })
                ->addColumn('order_id', function ($row) {
                    return '<label class="text-primary cursor-pointer class-link"  data-id="' . $row['order_id'] . '" data-cancel="0" data-is-print="1" onclick="openBillDetail($(this))">#' . $row['order_id'] . '</label>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['order_id'])
                ->make(true);
            $collection = collect($configAll[2]['data']['list']);
            $workingData = $collection->where('checkin_time', '!=', '' && 'checkout_time', '!=', '')->where('is_leave_day_without_salary', '!=', '1');
            $dataTotal['total_record_check_in'] = $this->numberFormat(count($workingData));
            $dataTotal['total_check_in'] = $this->numberFormat(array_sum(array_column($configAll[2]['data']['list'], 'late_minutes')));
            $dataTable3 = DataTables::of($workingData)
                ->addColumn('branch_working_session', function ($row) {
                    return $row['branch_working_session_from'] . ' - ' . $row['branch_working_session_to'];
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('checkin_time', function ($row) {
                    return substr($row['checkin_time'], 10,15);
                })
                ->addColumn('checkout_time', function ($row) {
                    return $row['checkout_time'] == '' ? '---' : substr($row['checkout_time'], 10,15);
                })
                ->addIndexColumn()
                ->make(true);
            $dataTotal['total_record_debit'] = $this->numberFormat(count($configAll[3]['data']['list']));
            $dataTotal['total_debit'] = $this->numberFormat(array_sum(array_column($configAll[3]['data']['list'], 'debt_amount')));
            $dataTable4 = DataTables::of($configAll[3]['data']['list'])
                ->addColumn('order_id', function ($row) {
                    return '<label class="text-primary cursor-pointer class-link" data-id="' . $row['order_id'] . '" data-is-print="1" data-cancel="0" onclick="openBillDetail($(this))">#' . $row['order_id'] . '</label>';
                })
                ->addColumn('debt_amount', function ($row) {
                    return $this->numberFormat($row['debt_amount']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['order_id'])
                ->make(true);

            return [$dataTable1, $dataTable2, $dataTable3, $dataTable4, $dataTotal, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataNotify(Request $request)
    {
        $time = $request->get('time');
        $date = date('d/') . $time;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $employeeID = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SALARY_GET_COMMENT_SALARY_MANAGE, $employeeID, $date, $limit, $page);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        try {
            $data = $config['data'];
            $dataReturn = '';
            $idCurrent = $request->session()->get(SESSION_JAVA_ACCOUNT);
            for ($i = 0; $i < count(array_filter($data)); $i++) {
                if ($data[$i]['employee_id'] === $idCurrent['id']) {
                    $dataReturn = $dataReturn . '
                                        <div class="message-box-wrapper-right">
                                           <div class="message-box-card-right">
                                               <div class="message-box-user-text-right">
                                                   ' . $data[$i]['employee_name'] . '
                                               </div>
                                               <div class="message-box-content-text">
                                                   ' . $data[$i]['content'] . '
                                               </div>
                                               <div class="d-flex">
                                                   <div class="message-box-time-sent-left mr-2">
                                                       ' . $data[$i]['created_at'] . '
                                                   </div>
                                                   <div class="message-box-time-sent-right">
                                                       Đã nhận
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="message-box-avatar">
                                               <img onerror="imageDefaultOnLoadError($(this))" class="" src="' . $domain . $data[$i]['employee_avatar'] . '" alt="Image" onclick="modalImageComponent(' . "'" . $data[$i]['employee_avatar'] . "'" . ')">
                                           </div>
                                       </div>';
                } else {
                    $dataReturn = $dataReturn . '
                                        <div class="message-box-wrapper-left">
                                            <div class="message-box-avatar">
                                               <img onerror="imageDefaultOnLoadError($(this))" class="" src="' . $domain . $data[$i]['employee_avatar'] . '" alt="Image" onclick="modalImageComponent(' . "'" . $data[$i]['employee_avatar'] . "'" . ')">
                                            </div>
                                           <div class="message-box-card-left">
                                               <div class="message-box-user-text-left">
                                                   ' . $data[$i]['employee_name'] . '
                                               </div>
                                               <div class="message-box-content-text">
                                                   ' . $data[$i]['content'] . '
                                               </div>
                                               <div class="message-box-time-sent-right">
                                                   ' . $data[$i]['created_at'] . '
                                               </div>
                                           </div>

                                       </div>';
                }
            }
            return [$dataReturn, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function replyNotify(Request $request)
    {
        $time = $request->get('time');
        $date = date('d/') . $time;
        $id = $request->get('id');
        $message = $request->get('message');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SALARY_POST_REPLY_COMMENT_SALARY_MANAGE);
        $body = [
            'employee_id_in_salary_table' => $id,
            'salary_month' => $date,
            'content' => $message,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $basicSalary = $request->get('basic_salary');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_EMPLOYEE_MONTHLY_INFORMATION_POST_UPDATE, $id);
        $body = [
            'basic_salary' => $basicSalary,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
}
