<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class EmployeeBonusPunishController extends Controller
{
    public function index()
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ADDITION_FEE_MANAGER', 'ACCOUNTANT_ACCESS']);
        if ($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(2);
        if ($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Thưởng phạt nhân viên';
        return view('treasurer.employee_bonus_punish.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branchID = $request->get('branch');
        $time = date('d/') . $request->get('time');
        $type = $request->get('type');
        $punish = $request->get('punish');
        $status = "";
        $employeeID = ENUM_ROLE_TYPE_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LIST_EMPLOYEE_SALARY_ADDITION_GET_LIST_EMPLOYEE_SALARY_ADDITION, $branchID, $time, $type, $employeeID, $punish, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $PendingData = $collection->where('status', (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.PENDING'));
            $ConfirmData = $collection->where('status', (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.CONFIRMED'));
            $confirm = $PendingData->merge($ConfirmData);
            $dataConfirm = $confirm->toArray();
            $totalRecordConfirm = $confirm->count();
            $totalBonusConfirm = $confirm->where('amount', '>', 0)->sum('amount');
            $totalPunishConfirm = $confirm->where('amount', '<', 0)->sum('amount');
            $approved = $collection->where('status', (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.APPROVED'));
            $dataApproved = $approved->toArray();
            $totalRecordApproved = $approved->count();
            $totalBonusApproved = $approved->where('amount', '>', 0)->sum('amount');
            $totalPunishApproved = $approved->where('amount', '<', 0)->sum('amount');
            $cancel = $collection->where('status', (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.CANCEL'));
            $dataCancel = $cancel->toArray();
            $totalRecordCancel = $cancel->count();
            $totalBonusCancel = $cancel->where('amount', '>', 0)->sum('amount');
            $totalPunishCancel = $cancel->where('amount', '<', 0)->sum('amount');
            $isPermission = [true, true, true];
            $dataTableConfirm = $this->drawTable($dataConfirm);
            $dataTableApproved = $this->drawTable($dataApproved);
            $dataTableCancel = $this->drawTable($dataCancel);
            $dataTotal = [
                'total_bonus_confimed' => $this->numberFormat($totalBonusConfirm),
                'total_punish_confimed' => $this->numberFormat($totalPunishConfirm),
                'total_bonus_approved' => $this->numberFormat($totalBonusApproved),
                'total_punish_approved' => $this->numberFormat($totalPunishApproved),
                'total_bonus_cancel' => $this->numberFormat($totalBonusCancel),
                'total_punish_cancel' => $this->numberFormat($totalPunishCancel),
                'total_record_confimed' => $this->numberFormat($totalRecordConfirm),
                'total_record_approved' => $this->numberFormat($totalRecordApproved),
                'total_record_cancel' => $this->numberFormat($totalRecordCancel),
            ];
            return [$dataTableConfirm, $dataTableApproved, $dataTableCancel, $dataTotal, $isPermission, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTable($data)
    {
        $checkPermission = $this->checkPermission( ['OWNER']);

        return Datatables::of($data)
            ->addColumn('name', function ($row) {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee']['avatar'] . "'" . ')">
                         <label class="name-inline-data-table">' . $row['employee']['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee']['role_name'] . '</label>
                         </label>';
            })
            ->addColumn('bonus', function ($row) {
                return ($row['amount'] > 0) ? $this->numberFormat($row['amount']) : '0';
            })
            ->addColumn('punish', function ($row) {
                return ($row['amount'] < 0) ? $this->numberFormat($row['amount']) : '0';
            })
            ->addColumn('type_name', function ($row) {
                switch ($row['type']) {
                    case (int)Config::get('constants.type.SalaryAdditionTypeEnum.SUPPORT'):
                        return TEXT_SUPPORT;
                    case (int)Config::get('constants.type.SalaryAdditionTypeEnum.UNIFORM'):
                        return TEXT_UNIFORM;
                    case (int)Config::get('constants.type.SalaryAdditionTypeEnum.PUNISH_WRONG_BILL'):
                        return TEXT_PUNISH_WRONG_BILL;
                    case (int)Config::get('constants.type.SalaryAdditionTypeEnum.SALARY_PAYMENT'):
                        return TEXT_SALARY_PAYMENT;
                    case (int)Config::get('constants.type.SalaryAdditionTypeEnum.LATE'):
                        return TEXT_LATE;
                    case (int)Config::get('constants.type.SalaryAdditionTypeEnum.WITHOUT_CHECKOUT'):
                        return TEXT_WITHOUT_CHECKOUT;
                    default:
                        return ($row['amount'] >= 0) ? TEXT_REWARD : TEXT_PUNISH;
                }
            })
            ->addColumn('status_text', function ($row) {
                switch ($row['status']) {
                    case (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.PENDING'):
                        return '<div class="status-new seemt-orange seemt-border-orange">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . TEXT_WAITING . '</label>
                                                                            </div>';
                    case (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.CONFIRMED'):
                        return '<div class="status-new seemt-blue seemt-border-blue">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . TEXT_WAITING_APPROVE_PAYMENT . '</label>
                                                                            </div>';
                    case (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.APPROVED'):
                        return '<div class="status-new seemt-green seemt-border-green">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . TEXT_APPROVED . '</label>
                                                                            </div>';
                    case (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.CANCEL'):
                        return '<div class="status-new seemt-red seemt-border-red">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . TEXT_CANCELED . '</label>
                                                                            </div>';
                    default:
                        return '<div class="status-new seemt-blue seemt-border-blue">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . TEXT_OTHER . '</label>
                                                                            </div>';
                }
            })
            ->addColumn('note', function ($row) {
                return $row['note'] === '' ? '---' : ((mb_strlen($row['note']) > 30) ? $row['note'] = mb_substr($row['note'], 0, 27) . '...' : $row['note']);
            })
            ->addColumn('time', function ($row) {
                return substr($row['time'], 3, 10);
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('action', function ($row) use ($checkPermission){
                $detail = TEXT_DETAIL;
                $update = TEXT_UPDATE;
                $ownerConfirm = TEXT_OWNER_CONFIRM_TREASURER;
                $cancel = TEXT_CANCEL;
                if ($row['status'] === (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.PENDING') || $row['status'] === (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.CONFIRMED')) {
                    if($checkPermission[0]){
                        if($row['status'] === (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.PENDING')){
                            return '<div class="btn-group btn-group-sm float-center">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light btn-approve-employee-bonus-punish" onclick="approveEmployeeBonusPunish(' . $row['id'] . ',' . $row['branch']['id'] . ', $(this))" data-toggle="tooltip" data-placement="top" data-original-title="Duyệt phiếu"><i class="fi-rr-check"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light btn-manage-employee-bonus-punish" onclick="cancelEmployeeBonusPunish(' . $row['id'] . ',' . $row['branch']['id'] . ', $(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $cancel . '"><i class="fi-rr-cross"></i></button></br>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light btn-manage-employee-bonus-punish" onclick="openModalUpdateEmployeeBonusPunish(' . $row['id'] . ',' . $row['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeBonusPunish(' . $row['id'] . ',' . $row['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                        }
                        else{
                            return '<div class="btn-group btn-group-sm float-center">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light btn-approve-employee-bonus-punish" onclick="approveEmployeeBonusPunish(' . $row['id'] . ',' . $row['branch']['id'] . ', $(this))" data-toggle="tooltip" data-placement="top" data-original-title="Duyệt phiếu"><i class="fi-rr-check"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light btn-manage-employee-bonus-punish" onclick="cancelEmployeeBonusPunish(' . $row['id'] . ',' . $row['branch']['id'] . ', $(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $cancel . '"><i class="fi-rr-cross"></i></button></br>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeBonusPunish(' . $row['id'] . ',' . $row['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                        }

                    }
                    else{
                        if($row['status'] === (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.PENDING')){
                            return '<div class="btn-group btn-group-sm float-center">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light btn-manage-employee-bonus-punish" onclick="openModalUpdateEmployeeBonusPunish(' . $row['id'] . ',' . $row['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeBonusPunish(' . $row['id'] . ',' . $row['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                        }
                        else{
                            return '<div class="btn-group btn-group-sm float-center">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeBonusPunish(' . $row['id'] . ',' . $row['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                        }
                    }
                }
                else {
                    return '<div class="btn-group btn-group-sm float-center">
                           <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openModalDetailEmployeeBonusPunish(' . $row['id'] . ',' . $row['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                }
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addIndexColumn()
            ->rawColumns(['name', 'action', 'status_text', 'note'])
            ->make(true);
    }

    public function role(Request $request)
    {
        $branchID = $request->get('branch');
        $status = ENUM_STATUS_GET_ACTIVE;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $type = ENUM_GET_ALL;
        $api = sprintf(API_ROLE_GET_DATA, $branchID, $status, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $dataOption = '<option value="" selected>' . TEXT_ALL_OPTION . '</option>';
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

    public function employee(Request $request)
    {
        $user = Session::get(SESSION_JAVA_ACCOUNT);
        $branchID = $request->get('branch');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $isIncludeRestaurantManager = ENUM_DIS_SELECTED;
        $time = $request->get('time');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_EMPLOYEE_TIME_KEEPING, $branchID, $status, $isIncludeRestaurantManager, $time);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $dataEmployee = '<option value="-1" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($config['data']['list'] as $db) {
                $dataEmployee .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
            return [$dataEmployee, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function employeeWorking(Request $request)
    {
        $branch = ENUM_GET_ALL;
        $status = Config::get('constants.type.checkbox.SELECTED');
        $api = sprintf(API_GET_EMPLOYEE_V2, $branch, $status);
        $body = null;
        $requestEmployeeProposer = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body
        ];
        $branch = $request->get('branch');
        $api = sprintf(API_GET_EMPLOYEE_CHECKIN, $branch, $status);
        $requestEmployeeApplied = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestEmployeeProposer, $requestEmployeeApplied]);
        try {
            $dataEmployeeAll = $configAll[0];
            $dataEmployeeBranch = $configAll[1];
            $dataEmployeeProposer = '<option value="-1" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            $dataEmployeeApplied = '<option value="-1" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($dataEmployeeAll['data']['list'] as $db) {
                $dataEmployeeProposer .= '<option value="' . $db['id'] . '">' . $db['name'] . ' (' . $db['branch_name'] . ')</option>';
            }
            foreach ($dataEmployeeBranch['data']['list'] as $db) {
                $dataEmployeeApplied .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
            $data = $configAll[1]['data']['list'];
            $dataTable = DataTables::of($data)
                ->addColumn('checkbox', function ($row) {
                    return '<div class="checkbox-fade fade-in-primary">
                                    <label>
                                    <input type="checkbox" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '"   data-phone="' . $row['phone'] . '"  data-role="' . $row['role_name'] . '"  data-avatar="' . $row['avatar'] . '" />
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    </label>
                                </div>';
                })
                ->addColumn('name', function ($row) {
                    return '<img data-id="' . $row['id'] . '" onerror="imageDefaultOnLoadError($(this))" src="' . $row['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $row['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle"></i>' . $row['role_name'] . '</label>
                         </label>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light cursor-pointer" onclick="selectEmployeeBonusPunish($(this))" data-id="' . $row['id'] . '">
                            <i class="fi-rr-arrow-small-right"></i>
                        </button>
                    </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchFilterTemplate($row['name'] . $row['role_name'] . $row['phone']);
                })
                ->rawColumns(['checkbox', 'name', 'action'])
                ->addIndexColumn()
                ->make(true);
            return [$dataEmployeeProposer, $dataEmployeeApplied, $dataTable, $dataEmployeeAll, $dataEmployeeBranch];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataEmployee(Request $request)
    {
        $user = Session::get(SESSION_JAVA_ACCOUNT);
        $branchID = $request->get('branch');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $isIncludeRestaurantManager = ENUM_DIS_SELECTED;
        $time = $request->get('time');
        $api = sprintf(API_GET_EMPLOYEE_TIME_KEEPING, $branchID, $status, $isIncludeRestaurantManager, $time);
        $body = null;
        $requestEmployeeTimeKeeping = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $branch = $request->get('branch');
        $brandID = $request->get('restaurant_brand_id');
        $status = 1;
        $isTakeMyself = 1;
        $isIncludeRestaurantManager2 = 0;
        $api = sprintf(API_EMPLOYEE_GET_DATA, $branch, $status, $isIncludeRestaurantManager2, $isTakeMyself, $brandID);
        $body = null;
        $requestAllEmployee = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestEmployeeTimeKeeping, $requestAllEmployee]);
        try {
            $data = $configAll[0]['data']['list'];
            $dataEmployee = [];
            $dataEmployee['proposer'] = '';
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['id'] == $user['id']) {
                    $dataEmployee['proposer'] .= '<option value="' . $data[$i]['id'] . '" selected>' . $data[$i]['name'] . '</option>';
                } else {
                    $dataEmployee['proposer'] .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
            if ($dataEmployee['proposer'] === '') {
                $dataEmployee['proposer'] = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            $data = $configAll[1]['data']['list'];
            $dataTable = DataTables::of($data)
                ->addColumn('checkbox', function ($row) {
                    return '<div class="checkbox-fade fade-in-primary">
                                    <label>
                                    <input type="checkbox" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '"   data-phone="' . $row['phone'] . '"  data-role="' . $row['role_name'] . '"  data-avatar="' . $row['avatar'] . '" />
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    </label>
                                </div>';
                })
                ->addColumn('name', function ($row) {
                    return '<img data-id="' . $row['id'] . '" onerror="imageDefaultOnLoadError($(this))" src="' . $row['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $row['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle"></i>' . $row['role_name'] . '</label>
                         </label>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light cursor-pointer" onclick="selectEmployeeBonusPunish($(this))" data-id="' . $row['id'] . '" >
                            <i class="fi-rr-arrow-small-left"></i>
                        </button>
                    </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['checkbox', 'name', 'action'])
                ->addIndexColumn()
                ->make(true);
            return [$dataTable, $dataEmployee, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function create(Request $request)
    {
        $branchID = $request->get('branch');
        $id = Config::get('constants.type.id.DEFAULT');
        $employeeID = $request->get('employee');
        $proposerID = $request->get('proposer');
        $time = $request->get('time');
        $amount = $request->get('amount');
        $note = $request->get('note');
        $type = $request->get('type');
        $isPunish = $request->get('punish');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_LIST_EMPLOYEE_SALARY_ADDITION_POST_EMPLOYEE_BONUS_PUNISH, $id);
        $body = [
            'branch_id' => $branchID,
            'id' => $id,
            'employee_id' => $employeeID,
            'time' => $time,
            'amount' => $amount,
            'note' => $note,
            'type' => $type,
            'proposer_id' => $proposerID,
            'is_punish' => $isPunish,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function confirm(Request $request)
    {
        $branchID = $request->get('branch_id');
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_LIST_EMPLOYEE_SALARY_ADDITION_POST_CONFIRM_EMPLOYEE_BONUS_PUNISH, $id);
        $body = [
            'branch_id' => $branchID,
            'id' => $id,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function approve(Request $request)
    {
        $branchID = $request->get('branch_id');
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_LIST_EMPLOYEE_SALARY_ADDITION_POST_APPROVE_EMPLOYEE_BONUS_PUNISH, $id);
        $body = [
            'branch_id' => $branchID,
            'id' => $id,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $config['data']['name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['employee']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $config['data']['employee']['avatar'] . "'" . ')">
                         <label class="name-inline-data-table">' . $config['data']['employee']['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['employee']['role_name'] . '</label>
                         </label>';
            $config['data']['bonus'] = ($config['data']['amount'] > 0) ? $this->numberFormat($config['data']['amount']) : '0';
            $config['data']['punish'] = ($config['data']['amount'] < 0) ? $this->numberFormat($config['data']['amount']) : '0';
            switch ($config['data']['type']) {
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.SUPPORT'):
                    $config['data']['type_name'] = TEXT_SUPPORT;
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.UNIFORM'):
                    $config['data']['type_name'] = TEXT_UNIFORM;
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.PUNISH_WRONG_BILL'):
                    $config['data']['type_name'] = TEXT_PUNISH_WRONG_BILL;
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.SALARY_PAYMENT'):
                    $config['data']['type_name'] = TEXT_SALARY_PAYMENT;
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.LATE'):
                    $config['data']['type_name'] = TEXT_LATE;
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.WITHOUT_CHECKOUT'):
                    $config['data']['type_name'] = TEXT_WITHOUT_CHECKOUT;
                default:
                    $config['data']['type_name'] = ($config['data']['amount'] >= 0) ? TEXT_REWARD : TEXT_PUNISH;
            }
            $config['data']['status_text'] = '<div class="status-new seemt-green seemt-border-green">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . TEXT_APPROVED . '</label>
                                                                            </div>';
            $config['data']['note'] = $config['data']['note'] === '' ? '---' : ((mb_strlen($config['data']['note']) > 30) ? $config['data']['note'] = mb_substr($config['data']['note'], 0, 27) . '...' : $config['data']['note']);
            $config['data']['time'] = substr($config['data']['time'], 3, 10);
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            $config['data']['action'] = '<div class="btn-group btn-group-sm float-center">
                           <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openModalDetailEmployeeBonusPunish(' . $config['data']['id'] . ',' . $config['data']['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
        }
        return $config;
    }

    public function cancel(Request $request)
    {
        $branchID = $request->get('branch_id');
        $id = $request->get('id');
        $reason = $request->get('reason');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_LIST_EMPLOYEE_SALARY_ADDITION_POST_CANCEL_EMPLOYEE_BONUS_PUNISH, $id);
        $body = [
            'branch_id' => $branchID,
            'id' => $id,
            'reason' => $reason,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $config['data']['name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['employee']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $config['data']['employee']['avatar'] . "'" . ')">
                         <label class="name-inline-data-table">' . $config['data']['employee']['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['employee']['role_name'] . '</label>
                         </label>';
            $config['data']['bonus'] = ($config['data']['amount'] > 0) ? $this->numberFormat($config['data']['amount']) : '0';
            $config['data']['punish'] = ($config['data']['amount'] < 0) ? $this->numberFormat($config['data']['amount']) : '0';
            switch ($config['data']['type']) {
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.SUPPORT'):
                    $config['data']['type_name'] = TEXT_SUPPORT;
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.UNIFORM'):
                    $config['data']['type_name'] = TEXT_UNIFORM;
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.PUNISH_WRONG_BILL'):
                    $config['data']['type_name'] = TEXT_PUNISH_WRONG_BILL;
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.SALARY_PAYMENT'):
                    $config['data']['type_name'] = TEXT_SALARY_PAYMENT;
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.LATE'):
                    $config['data']['type_name'] = TEXT_LATE;
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.WITHOUT_CHECKOUT'):
                    $config['data']['type_name'] = TEXT_WITHOUT_CHECKOUT;
                default:
                    $config['data']['type_name'] = ($config['data']['amount'] >= 0) ? TEXT_REWARD : TEXT_PUNISH;
            }
            $config['data']['status_text'] = '<div class="status-new seemt-red seemt-border-red">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . TEXT_CANCELED . '</label>
                                                                            </div>';
            $config['data']['note'] = $config['data']['note'] === '' ? '---' : ((mb_strlen($config['data']['note']) > 30) ? $config['data']['note'] = mb_substr($config['data']['note'], 0, 27) . '...' : $config['data']['note']);
            $config['data']['time'] = substr($config['data']['time'], 3, 10);
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            $config['data']['action'] = '<div class="btn-group btn-group-sm float-center">
                           <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openModalDetailEmployeeBonusPunish(' . $config['data']['id'] . ',' . $config['data']['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
        }
        return $config;
    }

    public function dataUpdate(Request $request)
    {
        $employeeID = $request->get('id');
        $branch = $request->get('branch');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_LIST_EMPLOYEE_SALARY_ADDITION_DETAIL_EMPLOYEE_BONUS_PUNISH, $employeeID, $branch);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            switch ($config['data']['type']) {
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.OTHER_REWARD_PUNISH'):
                    if ($config['data']['amount'] > 0) {
                        $config['data']['type'] = Config::get('constants.type.SalaryAdditionTypeEnum.OTHER_REWARD');
                        $type = Config::get('constants.type.SalaryAdditionTypeEnum.REWARD');
                    } else {
                        $config['data']['type'] = Config::get('constants.type.SalaryAdditionTypeEnum.OTHER_PUNISH');
                        $type = Config::get('constants.type.SalaryAdditionTypeEnum.PUNISH');
                    }
                    break;
                case (int)Config::get('constants.type.SalaryAdditionTypeEnum.SUPPORT'):
                    $type = Config::get('constants.type.SalaryAdditionTypeEnum.REWARD');
                    break;
                default:
                    $type = Config::get('constants.type.SalaryAdditionTypeEnum.PUNISH');
                    break;
            }

            $config['data']['amount'] = $this->numberFormat(abs($config['data']['amount']));
            $config['type_select'] = $type;
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $branchID = $request->get('branch');
        $id = $request->get('id');
        $employeeID = $request->get('employee');
        $proposerID = $request->get('proposer');
        $time = $request->get('time');
        $amount = $request->get('amount');
        $note = sprintf($request->get('note'));
        $type = $request->get('type');
        $isPunish = sprintf($request->get('punish'));
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_LIST_EMPLOYEE_SALARY_ADDITION_POST_EMPLOYEE_BONUS_PUNISH, $id);
        $body = [
            'branch_id' => $branchID,
            'id' => $id,
            'employee_id' => $employeeID,
            'time' => $time,
            'amount' => $amount,
            'note' => $note,
            'type' => $type,
            'proposer_id' => $proposerID,
            'is_punish' => $isPunish,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function detail(Request $request)
    {
        $employeeID = $request->get('id');
        $branch = $request->get('branch');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LIST_EMPLOYEE_SALARY_ADDITION_DETAIL_EMPLOYEE_BONUS_PUNISH, $employeeID, $branch);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['data']['status'] === (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.PENDING')) {
                $config['data']['status_name'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_WAITING . '</label>
                                                </div>';
            } else if ($config['data']['status'] === (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.CONFIRMED')) {
                $config['data']['status_name'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_WAITING_APPROVE_PAYMENT . '</label>
                                                </div>';
            } else if ($config['data']['status'] === (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.APPROVED')) {
                $config['data']['status_name'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_APPROVED . '</label>
                                                </div>';
            } else if ($config['data']['status'] === (int)Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.CANCEL')) {
                $config['data']['status_name'] = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_DENIED . '</label>
                                                </div>';
            } else {
                $config['data']['status_name'] = '<div class="seemt-gray-400 seemt-border-gray status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_WAITING . '</label>
                                                </div>';
            }
            if ($config['data']['type'] === (int)Config::get('constants.type.SalaryAdditionTypeEnum.OTHER_REWARD_PUNISH')) {
                if ($config['data']['amount'] < 0) {
                    $config['data']['type_name'] = TEXT_PUNISH;
                } else {
                    $config['data']['type_name'] = TEXT_REWARD;
                }
            }
            $config['data']['time'] = date('m/Y');
            $config['data']['amount'] = $this->numberFormat(abs($config['data']['amount']));
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function createHoliday(Request $request)
    {
        $branchID = $request->get('branch_id');
        $employeIDs = $request->get('employee_ids');
        $time = $request->get('time');
        $amount = $request->get('amount');
        $quantity = $request->get('quantity');
        $note = $request->get('note');
        $proposerID = $request->get('proposer_id');
        $type = $request->get('type');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_LIST_EMPLOYEE_SALARY_ADDITION_CREATE_REWARD_BONUS);
        $body = [
            'branch_id' => $branchID,
            'employee_ids' => $employeIDs,
            'time' => $time,
            'amount' => $amount,
            'quantity' => $quantity,
            'note' => $note,
            'proposer_id' => $proposerID,
            'type' => $type
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_UPDATE) {
                $tableEmployee = DataTables::of($config['data'])
                    ->addColumn('action', function ($row) {
                        return '<div class="btn-group btn-group-sm">
                             <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalInfoEmployeeManage(' . $row['id'] . ')" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Xem chi tiết"><i class="fi-rr-eye"></i></button>
                         </div>';
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate(array($row['name'], $row['phone']));
                    })
                    ->rawColumns(['action', 'keysearch'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data'] = $tableEmployee;
            } else {
                $config['data'] = $config;
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
