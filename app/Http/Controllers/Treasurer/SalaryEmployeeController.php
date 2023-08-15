<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SalaryEmployeeController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ADDITION_FEE_MANAGER', 'ACCOUNTANT_ACCESS']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(2);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Lương nhân viên';
        return view('treasurer.salary_employee.index', compact('active_nav'));
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
            $dataOption = '<option value="" selected>'.TEXT_ALL_ROLE_EMPLOYEE.'</option>';
            for ($i = 0; $i < count($data); $i++) {
                $dataOption = $dataOption . '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
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
            $totalCountConfirmSalary=0;
            for($i = 0 ; $i < count($config['data']['list']) ; $i++){
                if ($config['data']['list'][$i]['status'] == Config::get('constants.type.payroll.APPROVED')) {
                    $totalCountConfirmSalary+=1;
                 }
            }
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $dataTable = Datatables::of($config['data']['list'])
                ->addColumn('name', function ($row) use ($domain) {
                    return '
                    <img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee']['avatar'] . '" data-status = "'. $row['status'] . '" data-reason = "'. $row['reason'] . '" data-value = "'. $row['employee']['id'] . '" class="img-inline-name-data-table">
                            <label class="name-inline-data-table"><p style="font-size: 14px !important;">' . $row['employee']['name'] . '</p>
                                <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle"></i>' . $row['employee']['role_name'] . '</label>
                            </label>';
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
                ->addColumn('basic_salary', function ($row) {
                    return $this->numberFormat($row['basic_salary']);
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
                ->addColumn('total_punish_amount', function ($row) {
                    return $this->numberFormat($row['total_punish_amount']);
                })
                ->addColumn('total_salary_reduce', function ($row) {
                    return $this->numberFormat($row['total_salary_reduce']);
                })
                ->addColumn('total_punish', function ($row) {
                    return $this->numberFormat($row['total_punish']);
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
                            return '<div class="status-new seemt-green seemt-border-green " style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to   " style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0" data-id="' . $row['status'] . '">' . TEXT_PAID . '</label>
                                    </div>';
                    }
                })
                ->addColumn('action', function ($row)  {
                    $updateSalary = '';
                    $comment = $row['count'] === 0 ? '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="notifyPayroll($(this))" data-id="' . $row['employee']['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NOTIFY . '">
                                                                            <i class="fi-rr-comment-alt"></i>
                                                                        </button>' :
                    '<button type="button" class="tabledit-edit-button btn seemt-red seemt-bg-red seemt-btn-hover-orange waves-effect waves-light" onclick="notifyPayroll($(this))" data-id="' . $row['employee']['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NOTIFY . '">
                        <i class="fi-rr-comment-alt"></i>
                    </button>';
                    if ($row['status'] < Config::get('constants.type.payroll.APPROVED')) {
                        $updateSalary = '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" id="update-salary-basic-employee" onclick="openModalUpdateBasicSalary(' . $row['employeeId'] . ',' . $row['branch_id'] . ',$(this))" data-toggle="tooltip" data-placement="top" data-original-title="Đổi lương cơ bản"><i class="fi-rr-pencil"></i></button>';
                    }
                    switch ($row['status']) {
                        case Config::get('constants.type.payroll.APPROVED'):
                            return  '<div class="checkbox-form-group d-none checkbox-salary-treasure "  >
                            <input type="checkbox" id="check-salary" class="m-0">
                             </div>
                            <div class="btn-group btn-group-sm float-right">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="confirmSalaryEmployee(' . $row['employee']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_SALARY_VERIFY . '" data-status="' . $row['status'] . '"><i class="fi-rr-check"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="deniedSalaryEmployee(' . $row['employee']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DENIED . '"><i class="fi-rr-cross"></i></button><br>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="detailPayroll(' . $row['employee']['id'] . ',this)" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            '. $comment .'
                            </div>';
                        case Config::get('constants.type.payroll.PAID'):
                        case Config::get('constants.type.payroll.DENIED'):
                            return '<div class="checkbox-form-group d-none checkbox-salary-treasure "  >
                            <input type="checkbox" id="check-salary" class="disabled m-0" disabled style="cursor: no-drop;">
                             </div>
                            <div class="btn-group btn-group-sm float-right">
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" id="detail-click-payroll" onclick="detailPayroll(' . $row['employee']['id'] . ',this)" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                        case Config::get('constants.type.payroll.WAITING_EMPLOYEE_CONFIRM'):
                            return '<div class="checkbox-form-group d-none checkbox-salary-treasure ">
                            <input type="checkbox" id="check-salary" class="disabled m-0" disabled style="cursor: no-drop;">
                             </div>
                             <div class="btn-group btn-group-sm float-right">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" id="confirm-treasurer-salary-employee" onclick="confirmTreasurerSalaryEmployee(' . $row['employee']['id'] . ', $(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONFIRM_TREASURER . '"><i class="fi-rr-makeup-brush"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" id="send-salary-employee" onclick="sendSalaryEmployee(' . $row['employee']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_SALARY_SEND . '"><i class="fi-rr-document-signed"></i></button><br>
                            ' . $updateSalary . '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="detailPayroll(' . $row['employee']['id'] . ',this)" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            '. $comment .'
                            </div>';
                            case Config::get('constants.type.payroll.WAITING_MANAGER_CONFIRM'):
                            return '<div class="checkbox-form-group d-none checkbox-salary-treasure "   >
                            <input type="checkbox" id="check-salary" class="disabled m-0" disabled style="cursor: no-drop;">
                             </div>
                             <div class="btn-group btn-group-sm float-right">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" id="confirm-treasurer-salary-employee" onclick="confirmTreasurerSalaryEmployee(' . $row['employee']['id'] . ' , $(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONFIRM_TREASURER . '"><i class="fi-rr-makeup-brush"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" id="send-salary-employee" onclick="sendSalaryEmployee(' . $row['employee']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_SALARY_SEND . '"><i class="fi-rr-document-signed"></i></button><br>
                            ' . $updateSalary . '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="detailPayroll(' . $row['employee']['id'] . ',this)" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-green seemt-bg-green seemt-btn-hover-orange waves-effect waves-light" onclick="notifyPayroll($(this))" data-id="' . $row['employee']['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NOTIFY . '"> <i class="fi-rr-comment-alt"></i></button>
                            </div>';
                        default:
                            return '<div class="checkbox-form-group d-none checkbox-salary-treasure "    >
                            <input type="checkbox" id="check-salary" class="disabled m-0" disabled style="cursor: no-drop;">
                             </div><div class="btn-group btn-group-sm float-right">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light send-message-salary-treasurer" onclick="sendSalaryEmployee(' . $row['employee']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_SALARY_SEND . '"><i class="fi-rr-document-signed"></i></button>
                            ' . $updateSalary . '<br><button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="detailPayroll(' . $row['employee']['id'] . ',this)" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            '. $comment .'
                            </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['status_name_id', 'action', 'name'])
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
                'total_count_confirm_salary'=> $totalCountConfirmSalary
            ];
            $checkMessage = 0;
            if ((count($config['data']['status_list']) === 1) && ($config['data']['status_list'][0] === (int)Config::get('constants.type.payroll.PENDING'))) {
                $checkMessage = 1;
            }
            $checkActive = 0;
            if (in_array(Config::get('constants.type.payroll.APPROVED'), $config['data']['status_list'])) {
                $checkActive = 1;
            }
            $checkSend = 0;
            if ((count($config['data']['status_list']) === 0)) {
                $checkSend = 1;
            } else {
                for ($i = 0; $i < count($config['data']['status_list']); $i++) {
                    if ($config['data']['status_list'][$i] > (int)Config::get('constants.type.payroll.WAITING_APPROVE')) {
                        $checkSend = 1;
                    }
                }
            }
            return [$dataTable, $dataTotal, $checkMessage, $checkActive, $checkSend, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function salaryConfirm(Request $request)
    {
        $branchID = $request->get('branch');
        $id = $request->get('employee_id');
        $time = date('d/') . $request->get('time');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SALARY_POST_PAID_SALARY_TABLE);
        $body = [
            'branch_id' => $branchID,
            'employee_ids' => $id,
            'time' => $time,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function sendSalary(Request $request)
    {
        $branchID = $request->get('branch');
        $id = $request->get('employee_id');
        if ($id === null) $id = [];
        $time = date('d/') . $request->get('time');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SALARY_POST_SEND);
        $body = [
            'branch_id' => $branchID,
            'employee_ids' => $id,
            'time' => $time,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function confirmTreasurer(Request $request)
    {
        $branchID = $request->get('branch');
        $id = $request->get('employee_id');
        $time = date('d/') . $request->get('time');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SALARY_EMPLOYEE_POST_CONFIRM);
        $body = [
            'branch_id' => $branchID,
            'employee_ids' => $id,
            'time' => $time,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function deniedSalary(Request $request)
    {
        $branchID = $request->get('branch');
        $id = $request->get('employee_id');
        $reason = $request->get('reason');
        $time = date('d/') . $request->get('time');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SALARY_EMPLOYEE_POST_DENIED);
        $body = [
            'branch_id' => $branchID,
            'employee_ids' => $id,
            'time' => $time,
            'reason' => $reason
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
}
