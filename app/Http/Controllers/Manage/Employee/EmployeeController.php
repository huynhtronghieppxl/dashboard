<?php

namespace App\Http\Controllers\Manage\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'EMPLOYEE_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(0);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Nhân viên';
        return view('manage.employee.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $checkLevel = Session::get('SESSION_KEY_LEVEL');
        if ($checkLevel > 1) {
            $branchID = $request->get('branch');
            $brandID = $request->get('restaurant_brand_id');
            $isIncludeRestaurantManager = ENUM_SELECTED;
            $status = ENUM_STATUS_GET_ALL;
            $isTakeMyself = ENUM_STATUS_GET_ALL;
            $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
            $method = ENUM_METHOD_GET;
            $api = sprintf(API_EMPLOYEE_GET_DATA, $branchID, $status, $isIncludeRestaurantManager, $isTakeMyself, $brandID);
            $body = null;
            $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
            try {
                $data = $config['data']['list'];
                $collection = collect($data);
                $dataOff = $collection->where('is_quit_job', 0)->where('status', 0)->all();
                $dataCheckIn = $collection->where('is_bypass_checkin', 0)->where('is_working', 1)->where('status', 1)->all();
                $dataNotCheckIn = $collection->where('is_bypass_checkin', 0)->where('is_working', 0)->where('status', 1)->all();
                $dataQuitJob = $collection->where('is_quit_job', 1)->where('status', 0)->all();
                $dataBypassCheckin = $collection->where('is_bypass_checkin', 1)->where('status', 1)->all();
                $dataTotal = [
                    'total_check_in' => $this->numberFormat(count($dataCheckIn)),
                    'total_not_check_in' => $this->numberFormat(count($dataNotCheckIn)),
                    'total_off' => $this->numberFormat(count($dataOff)),
                    'total_quit_job' => $this->numberFormat(count($dataQuitJob)),
                    'total_bypass_checkin' => $this->numberFormat(count($dataBypassCheckin)),
                ];
                /**
                 * EMPLOYEE OFF
                 */
                $dataEmployeeOff = $this->drawTableEmployeeTMS($dataOff);
                /**
                 * EMPLOYEE CHECK IN
                 */
                $dataEmployeeCheckIn = $this->drawTableEmployeeTMS($dataCheckIn);
                /**
                 * EMPLOYEE NOT CHECK IN
                 */

                $dataEmployeeNotCheckIn = $this->drawTableEmployeeTMS($dataNotCheckIn);
                /**
                 * EMPLOYEE BYPASS
                 */
                $dataEmployeeBypass = $this->drawTableEmployeeTMS($dataBypassCheckin);
                /**
                 * EMPLOYEE NEVER CHECK IN
                 */
                $dataEmployeeNeverCheckIn = [];
                /**
                 * EMPLOYEE QUIT JOB
                 */
                $dataEmployeeQuitJob = $this->drawTableEmployeeTMS($dataQuitJob);
                return [$dataEmployeeCheckIn, $dataEmployeeBypass, $dataEmployeeNotCheckIn, $dataEmployeeNeverCheckIn, $dataEmployeeOff, $dataEmployeeQuitJob, $dataTotal, $config];
            } catch (Exception $e) {
                return $this->catchTemplate($config, $e);
            }
        } else {
            $branchID = $request->get('branch');
            $brandID = $request->get('restaurant_brand_id');
            $isIncludeRestaurantManager = ENUM_SELECTED;
            $status = ENUM_STATUS_GET_ALL;
            $isTakeMyself = ENUM_STATUS_GET_ALL;
            $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
            $method = ENUM_METHOD_GET;
            $api = sprintf(API_EMPLOYEE_GET_DATA, $branchID, $status, $isIncludeRestaurantManager, $isTakeMyself, $brandID);
            $body = null;
            $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
            try {
                $data = $config['data']['list'];
                $collection = collect($data);
                $dataEnable = array_values($collection->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->toArray());
                $dataDisable = array_values($collection->where('status', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->toArray());
                $dataTotal = [
                    'enable' => $this->numberFormat(count($dataEnable)),
                    'disable' => $this->numberFormat(count($dataDisable)),
                ];
                $enable = $this->drawTableEmployee($dataEnable)->original['data'];
                $disable = $this->drawTableEmployee($dataDisable)->original['data'];
                return [$enable, $disable, $dataTotal, $config];
            } catch (Exception $e) {
                return $this->catchTemplate($config, $e);
            }
        }
    }

    public function drawTableEmployeeTMS($data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        return DataTables::of($data)
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('employee_avatar', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>' . $row['name'];
            })
            ->addColumn('working', function ($row) use ($domain) {
                return $row['working_from_beging'];
            })
            ->addColumn('name', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"><label class="title-name-new-table" >' . $row['name'] . '<br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['role_name'] . '</label></label>';
            })
            ->editColumn('gender', function ($rows) {
                if ($rows['gender'] == TEXT_FEMALE_VALUE) {
                    $message = '<i class="ion-female mr-1 "></i>' . TEXT_FEMALE;
                } else {
                    $message = '<i class="ion-male mr-1 text-primary"></i>' . TEXT_MALE;
                }
                return $message;
            })
            ->addColumn('action', function ($rows) {
                $status = Config::get('constants.type.checkbox.SELECTED');
                $keySessionAccount = e(Session::get(SESSION_JAVA_ACCOUNT)['id']);
                if ($keySessionAccount == $rows['id']) {
                    return '<div class="btn-group btn-group-sm text-center d-flex">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateEmployeeManage($(this))" data-id="' . $rows['id'] . '" data-brand="' . $rows['restaurant_brand_id'] . '" data-branch-id="' . $rows['branch_id'] . '" data-is-quit-job="' . $rows['is_quit_job'] . '" data-status="' . $rows['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeManage(' . $rows['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                }
                if ($rows['is_quit_job'] === (int)Config::get('constants.type.checkbox.SELECTED') && $rows['status'] === (int)Config::get('constants.type.status.OPENING')) {
                    return '<div class="btn-group btn-group-sm text-center d-flex">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light sweet-1" onclick="openModalUpdateEmployeeManage($(this))" data-id="' . $rows['id'] . '" data-brand="' . $rows['restaurant_brand_id'] . '" data-branch-id="' . $rows['branch_id'] . '" data-is-quit-job="' . $rows['is_quit_job'] . '" data-status="' . $rows['status'] . '" data-toggle="tooltip" data-placement="top" data-original-data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeManage(' . $rows['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                } else if ($rows['status'] === (int)Config::get('constants.type.status.OPENING')) {
                    return '<div class="btn-group btn-group-sm text-center d-flex">
                            <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" id="btn-status-working-employee-manage" onclick="changeStatusEmployeeManage(' . $rows['id'] . ',' . $rows['branch_id'] . ', ' . $status . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" id="btn-status-working-employee-manage" onclick="changeStatusWorkingEmployeeManage(' . $rows['id'] . ',' . $rows['branch_id'] . ',' . $rows['is_quit_job'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_QUIT_JOB . '"><i class="fi-rr-lock"></i></button><br>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateEmployeeManage($(this))" data-toggle="tooltip" data-placement="top" data-id="' . $rows['id'] . '" data-brand="' . $rows['restaurant_brand_id'] . '" data-branch-id="' . $rows['branch_id'] . '" data-is-quit-job="' . $rows['is_quit_job'] . '" data-status="' . $rows['status'] . '" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeManage(' . $rows['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                } else {
                    return '<div class="btn-group btn-group-sm text-center d-flex">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" id="btn-status-working-employee-manage" onclick="changeStatusEmployeeManage(' . $rows['id'] . ',' . $rows['branch_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_TEMPORARY_LOCKED . '"><i class="fi-rr-minus"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="resetPassword($(this))" data-id="' . $rows['id'] . '"  data-name="' . $rows['name'] . '" data-user="' . $rows['username'] . '" data-restaurant-normalize-name="' . $rows['restaurant_normalize_name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_RESET_PASS . '"><i class="fi-rr-refresh"></i></button><br>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateEmployeeManage($(this))" data-toggle="tooltip" data-id="' . $rows['id'] . '" data-brand="' . $rows['restaurant_brand_id'] . '" data-branch-id="' . $rows['branch_id'] . '" data-is-quit-job="' . $rows['is_quit_job'] . '" data-status="' . $rows['status'] . '" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeManage(' . $rows['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                }
            })
            ->rawColumns(['gender', 'employee_avatar', 'name', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function drawTableEmployee($data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        return DataTables::of($data)
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('employee_avatar', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>';
            })
            ->addColumn('name', function ($row) {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                if (mb_strlen($row['name']) > 30) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"><label class="title-name-new-table" >' . mb_substr($row['name'], 0, 50) . '<br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['role_name'] . '</label></label>';
                } else {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"><label class="title-name-new-table" >' . $row['name'] . '<br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['role_name'] . '</label></label>';
                }
            })
            ->editColumn('gender', function ($rows) {
                if ($rows['gender'] == TEXT_FEMALE_VALUE) {
                    $message = '<div class="d-flex justify-content-center align-items-center mt-10"><i class="ion-female mr-1 "></i>' . TEXT_FEMALE . '</div>';
                } else {
                    $message = '<div class="d-flex justify-content-center align-items-center mt-10"><i class="ion-male mr-1 text-primary"></i>' . TEXT_MALE . '</div>';
                }
                return $message;
            })
            ->addColumn('action', function ($rows) {
                $keySessionAccount = e(Session::get(SESSION_JAVA_ACCOUNT)['id']);
                if ($keySessionAccount == $rows['id']) {
                    return '<div class="btn-group btn-group-sm text-center d-flex">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateEmployeeManage($(this))" data-toggle="tooltip" data-id="' . $rows['id'] . '" data-brand="' . $rows['restaurant_brand_id'] . '" data-branch-id="' . $rows['branch_id'] . '" data-is-quit-job="' . $rows['is_quit_job'] . '" data-status="' . $rows['status'] . '" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeManage(' . $rows['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                }
                if ($rows['status'] === (int)Config::get('constants.type.status.OPENING')) {
                    return '<div class="btn-group btn-group-sm text-center d-flex">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateEmployeeManage($(this))" data-id="' . $rows['id'] . '" data-brand="' . $rows['restaurant_brand_id'] . '" data-branch-id="' . $rows['branch_id'] . '" data-is-quit-job="' . $rows['is_quit_job'] . '" data-status="' . $rows['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeManage(' . $rows['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" id="btn-status-working-employee-manage" onclick="changeStatusEmployeeManageNotTms(' . $rows['id'] . ',' . $rows['branch_id'] . ',' . $rows['status'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                               <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="resetPassword($(this))" data-id="' . $rows['id'] . '"  data-name="' . $rows['name'] . '" data-user="' . $rows['username'] . '" data-restaurant-normalize-name="' . $rows['restaurant_normalize_name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_RESET_PASS . '"><i class="fi-rr-refresh"></i></button>
                            </div>';
                } else {
                    return '<div class="btn-group btn-group-sm text-center d-flex">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateEmployeeManage($(this))" data-id="' . $rows['id'] . '" data-brand="' . $rows['restaurant_brand_id'] . '" data-branch-id="' . $rows['branch_id'] . '" data-is-quit-job="' . $rows['is_quit_job'] . '" data-status="' . $rows['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeManage(' . $rows['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" id="btn-status-working-employee-manage" onclick="changeStatusEmployeeManageNotTms(' . $rows['id'] . ',' . $rows['branch_id'] . ',' . $rows['status'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="resetPassword($(this))" data-id="' . $rows['id'] . '"  data-name="' . $rows['name'] . '" data-user="' . $rows['username'] . '" data-restaurant-normalize-name="' . $rows['restaurant_normalize_name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_RESET_PASS . '"><i class="fi-rr-refresh"></i></button>
                            </div>';
                }
            })
            ->rawColumns(['gender', 'employee_avatar', 'name', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function rank(Request $request)
    {
        $role = $request->get('role');
        $restaurantBrandID = $request->get('brand');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LEVEL_GET_DATA, $restaurantBrandID, $role);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $dataRank = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $dataRank .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . ' (' . $data[$i]['table_number'] . ' bàn) </option>';
            }
            if ($dataRank === '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>') {
                $dataRank = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            if ($dataRank === '') {
                $dataRank = '<option value="" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            }
            return [$dataRank, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function role(Request $request)
    {
        $branchID = $request->get('branch');
        $type = $request->get('type');
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_ROLE_GET_DATA_EMPLOYEE_ROLE, $branchID, $status, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $dataRole = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $flag = 0;
                if ($data[$i]['role_leader_id'] == 0) {
                    $flag = 1;
                }
                $dataRole .= '<option value="' . $data[$i]['id'] . '"  data-pre="' . $flag . '" data-role-owner="' . $data[$i]['role_leader_id'] . '">' . $data[$i]['name'] . ' </option>';
            }
            if ($dataRole === '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>') {
                $dataRole = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            if ($dataRole === '') {
                $dataRole = '<option value="" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            }
            return [$dataRole, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function getBranch(Request $request)
    {
        $restaurantBrandID = $request->get('brand_id');
        $status = $request->get('status');
        $isOffice = $request->get('is_office');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_EMPLOYEE_MANAGER_BRANCH_GET, $restaurantBrandID, $status, $isOffice);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            if (count($data) > 0) {
                $dataBranch = '';
                foreach ($data as $db) {
                    $dataBranch .= '<option data-is-office="' . $db['is_office'] . '" value="' . $db['id'] . '">' . $db['name'] . '</option>';
                }
            } else {
                $dataBranch = '<option value="">Dữ liệu rỗng</option>';
            }
            return [$dataBranch, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function work(Request $request)
    {
        $brandID = $request->get('brand');
        $status = ENUM_STATUS_GET_ACTIVE;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_WORKING_SESSION_GET_ALL, $brandID, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if (count($config['data']['list']) === 0) {
                $dataWork = '<option value="0" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            } else {
                $dataWork = '';
                foreach ($config['data']['list'] as $db) {
                    $dataWork .= '<option value="' . $db['id'] . '">' . $db['name'] . ' (' . $db['time_interval_string'] . ')</option>';
                }
            }
            return [$dataWork, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function salary(Request $request)
    {
        $brandID = $request->get('brand');
        $status = ENUM_STATUS_GET_ACTIVE;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SALARY_LEVEL_GET_ALL, $brandID, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if (count($config['data']['list']) === 0) {
                $dataSalary = '<option value="0" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            } else {
                $dataSalary = '';
                foreach ($config['data']['list'] as $db) {
                    if ($db['status'] == ENUM_SELECTED && $db['type'] == ENUM_DIS_SELECTED) {
                        $dataSalary .= '<option value="' . $db['id'] . '">' . $db['level'] . ' - ' . $this->numberFormat($db['basic_salary']) . '</option>';
                    }
                }
            }
            return [$dataSalary, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function area(Request $request)
    {
        $branchID = $request->get('branch');
        $status = ENUM_STATUS_GET_ACTIVE;
        $isTakeAway = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LIST_AREA_GET, $branchID, $isTakeAway, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if (count($config['data']['list']) === 0) {
                $dataArea = '<option value="0" disabled selected>' . TEXT_NULL_OPTION . '</option>';
                $dataAreaControl = '<option value="0" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            } else {
                $dataArea = '<option value="0" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
                $dataAreaControl = '';
                foreach ($config['data']['list'] as $db) {
                    $dataArea .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                    $dataAreaControl .= '<option value="' . $db['id'] . '" data-employee-id="' . $db['employee_id'] . '">' . $db['name'] . ' (' . $db['employee_manager_full_name'] . ')</option>';
                }
            }
            return [$dataArea, $dataAreaControl, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }


    public function employeeToBranch(Request $request)
    {
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $employeeID = $request->get('employee_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_BRANCH_OF_EMPLOYEE_DATA, $restaurantBrandID, $employeeID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $listIds = collect($config['data'])->pluck('id')->toArray();
            $idPermissionEmployeeToBranch = [];
            array_push($idPermissionEmployeeToBranch, $listIds);
            return [$idPermissionEmployeeToBranch, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $type = ENUM_ROLE_TYPE_BUSINESS;
        $checkLevel = true;
        $chatToken = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
        $salary = $request->get('salary_level_id');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $rank = $request->get('rank_id');
        $isOwner = $request->get('is_owner');
        $work = $request->get('working_session_id');
        $employName = $request->get('name');
        $area = $request->get('area_id');
        $role = $request->get('role_id');
        $branch = $request->get('branch_id');
        $birthPlace = $request->get('birth_place');
        $address = $request->get('address');
        $areaManager = ($checkLevel === true) ? $request->get('manage_area_ids') : [];
        $status = ENUM_STATUS_GET_ACTIVE;
        $gender = $request->get('gender');
        $phone = $request->get('phone');
        $passport = $request->get('passport');
        $birthDate = $request->get('birthday');
        $email = $request->get('email');
        $wardID = $request->get('ward_id');
        $districtID = $request->get('district_id');
        $cityID = $request->get('city_id');
        $id = ENUM_ID_DEFAULT;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_EMPLOYEE_POST_CREATED);
        $body = [
            'type' => $type,
            'id' => $id,
            'name' => $employName,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'gender' => $gender,
            'employee_role_id' => $role,
            'employee_rank_id' => $rank,
            'identity_card' => $passport,
            'passport' => "",
            'birthday' => $birthDate,
            'birth_place' => $birthPlace,
            'salary_level_id' => $salary,
            'area_id' => $area,
            'working_session_id' => $work,
            'branch_id' => $branch,
            'status' => $status,
            'manage_area_ids' => $areaManager,
            'node_access_token' => $chatToken,
            'restaurant_brand_id' => $restaurantBrandID,
            'working_from' => date("d/m/Y"),
            'ward_id' => $wardID,
            'district_id' => $districtID,
            'city_id' => $cityID,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                /**
                 * Assign Employee To Branch
                 */
                $configAssignEmployeeToBranch = [];
                if ($isOwner == ENUM_DIS_SELECTED) {
                    $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
                    $branchIDs = $request->get('branch_ids');
                    $api = sprintf(API_ASSIGN_EMPLOYEE_TO_BRANCH);
                    $body = [
                        'branch_ids' => $branchIDs,
                        'employee_id' => $config['data']['id']
                    ];
                    $configAssignEmployeeToBranch = $this->callApiGatewayTemplate($project, $method, $api, $body);
                }
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);

                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $config['data']['employee_avatar'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $config['data']['avatar'] . "'" . ')"><label class="title-name-new-table" >' . $config['data']['name'] . '<br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['role_name'] . '</label></label>';
                $config['data']['account'] = $config['data']['username'];
                if ($config['data']['gender'] == TEXT_FEMALE_VALUE) {
                    $config['data']['gender'] = '<i class="ion-female mr-1 "></i>' . TEXT_FEMALE;;
                } else {
                    $config['data']['gender'] = '<i class="ion-male mr-1 text-primary"></i>' . TEXT_MALE;
                }
                $url = $request->get('url');
                if ($url === '/employee-manage') {
                    if ($checkLevel === true) {
                        if ($config['data']['is_owner'] === ENUM_SELECTED) {
                            $config['data']['type'] = 3;
                        } else if ($config['data']['is_working'] === ENUM_SELECTED) {
                            $config['data']['type'] = 1;
                        } else {
                            $config['data']['type'] = 2;
                        }
                        $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" id="btn-status-working-employee-manage" onclick="changeStatusEmployeeManage(' . $config['data']['id'] . ',' . $config['data']['branch_id'] . ', ' . $config['data']['status'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_TEMPORARY_LOCKED . '"><i class="fi-rr-minus"></i></button>
                                                    <button type="button" class="tabledit-edit-button btn btn seemt-btn-hover-green waves-effect waves-light" onclick="resetPassword($(this))" data-id="' . $config['data']['id'] . '"  data-name="' . $config['data']['name'] . '" data-user="' . $config['data']['account'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_RESET_PASS . '"><i class="fi-rr-refresh"></i></button>
                                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateEmployeeManage($(this))" data-id="' . $config['data']['id'] . '" data-branch-id="' . $config['data']['branch_id'] . '" data-is-quit-job="' . $config['data']['is_quit_job'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeManage(' . $config['data']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                </div>';
                    } else {
                        if ($config['data']['status'] === ENUM_SELECTED) {
                            $config['data']['type'] = 4;
                        } else {
                            $config['data']['type'] = 5;
                        }
                        $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                                    <button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" id="btn-status-working-employee-manage" onclick="changeStatusEmployeeManageNotTms(' . $config['data']['id'] . ',' . $config['data']['branch_id'] . ',' . $config['data']['status'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateEmployeeManage($(this))" data-id="' . $config['data']['id'] . '" data-branch-id="' . $config['data']['branch_id'] . '" data-is-quit-job="' . $config['data']['is_quit_job'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeManage(' . $config['data']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                 </div>';
                    }
                } else {
                    if ($config['data']['is_owner'] === ENUM_SELECTED) {
                        $config['data']['type'] = 3;
                    } else {
                        $config['data']['type'] = 2;
                    }
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateEmployeeManage($(this))" data-id="' . $config['data']['id'] . '" data-branch-id="' . $config['data']['branch_id'] . '" data-is-quit-job="' . $config['data']['is_quit_job'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeManage(' . $config['data']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL
                        . '"><i class="fi-rr-eye"></i></button>
                                             </div>';
                }

                return [$config, $configAssignEmployeeToBranch];
            } else {
                return [$config];
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataUpdate(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SALARY_GET_EMPLOYEE_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data['manage_area'] = collect($data['manage_areas'])->pluck('id');
            $data['url_avatar'] = $data['avatar'];
            $data['avatar'] = $domain . $data['avatar'];
            return [$data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $avatar = $request->get('avatar');
        $gender = $request->get('gender');
        $chatToken = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
        $phone = $request->get('phone');
        $passport = $request->get('passport');
        $birthDate = $request->get('birthday');
        $email = $request->get('email');
        $id = $request->get('id');
        $name = $request->get('name');
        $address = $request->get('address');
        $status = $request->get('status');
        $birthPlace = $request->get('birth_place');
        $branchID = $request->get('branch');
        $currentMonth = $request->get('current_month');
        $rank = $request->get('rank');
        $salary = $request->get('salary');
        $work = $request->get('work');
        $role = $request->get('role');
        $workingFrom = $request->get('working_from');
        $areaControlID = $request->get('area_control_id');
        $area = $request->get('area');
        $confirmed = $request->get('is_confirmed');
        $isOwner = $request->get('is_owner');
        $wardID = $request->get('ward_id');
        $districtID = $request->get('district_id');
        $cityID = $request->get('city_id');
        $api = sprintf(API_EMPLOYEE_POST_UPDATE, $id);
        $body = [
            'branch_id' => $branchID,
            "confirmed" => $confirmed,
            "id" => $id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            "employee_role_id" => $role,
            "employee_rank_id" => $rank,
            'gender' => $gender,
            'avatar' => $avatar,
            'identity_card' => $passport,
            'passport' => "",
            'birthday' => $birthDate,
            'birth_place' => $birthPlace,
            "salary_level_id" => $salary,
            "main_finger_prints" => "",
            "second_finger_prints" => "",
            "id_in_timekeeper" => 5,
            "area_id" => $area,
            "working_session_id" => $work,
            "status" => $status,
            'node_access_token' => $chatToken,
            'working_from' => $workingFrom,
            "manage_area_ids" => $areaControlID,
            'ward_id' => $wardID,
            'district_id' => $districtID,
            'city_id' => $cityID,
        ];
        $requestChangeDetailEmployee = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body
        ];
        /**
         * Assign Employee To Branch
         */
        try {
            if ($isOwner != ENUM_DIS_SELECTED) {
                $branchIDs = $request->get('branch_ids');
                $api = API_ASSIGN_EMPLOYEE_TO_BRANCH;
                $body = [
                    'branch_ids' => $branchIDs,
                    'employee_id' => $id,
                ];
                $configAssignEmployeeToBranch = [
                    'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
                    'method' => ENUM_METHOD_POST,
                    'api' => $api,
                    'body' => $body,
                ];
                $configAll = $this->callApiMultiGatewayTemplate([$requestChangeDetailEmployee, $configAssignEmployeeToBranch]);
            } else {
                $configAll = $this->callApiMultiGatewayTemplate([$requestChangeDetailEmployee]);
            }
            if ($configAll[0]['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                $configAll[0]['data']['employee_avatar'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $configAll[0]['data']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $configAll[0]['data']['avatar'] . "'" . ')"><label class="title-name-new-table" >' . $configAll[0]['data']['name'] . '<br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $configAll[0]['data']['role_name'] . '</label></label>';
                $configAll[0]['data']['username'] = $configAll[0]['data']['username'];
                if ($configAll[0]['data']['gender'] == TEXT_FEMALE_VALUE) {
                    $message = '<i class="ion-female mr-1 "></i>' . TEXT_FEMALE;
                } else {
                    $message = '<i class="ion-male mr-1 text-primary"></i>' . TEXT_MALE;
                }
                $configAll[0]['data']['gender'] = $message;
                $configAll[0]['data']['phone'] = $configAll[0]['data']['phone'];
                $configAll[0]['data']['branch_name'] = $configAll[0]['data']['branch_name'];
            }
            return [$configAll];
        } catch (Exception $e){
            return $this->catchTemplate($configAll, $e);
        }

    }

    public function dataOff(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_EMPLOYEE_OFF_GET_DATA, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $dataDetail = [
                'used_monthly_off_day' => $this->numberFormat($data['used_monthly_off_day']),
                'total_monthly_off_day_available' => $this->numberFormat($data['total_monthly_off_day_available']),
                'total_monthly_off_day' => $this->numberFormat($data['total_monthly_off_day']),
                'used_yearly_off_day' => $this->numberFormat($data['used_yearly_off_day']),
                'total_yearly_off_day_available' => $this->numberFormat($data['total_yearly_off_day_available']),
                'total_yearly_off_day' => $this->numberFormat($data['total_yearly_off_day']),
            ];
            return $data_res = [$dataDetail, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function updateOff(Request $request)
    {
        $usedMonthlyOffDay = $request->get('used_monthly_off_day');
        $totalMonthlyOffDayAvailable = $request->get('total_monthly_off_day_available');
        $totalMonthlyOffDay = $request->get('total_monthly_off_day');
        $usedYearlyOffDay = $request->get('used_yearly_off_day');
        $totalYearlyOffDayAvailable = $request->get('total_yearly_off_day_available');
        $totalYearlyOffDay = $request->get('total_yearly_off_day');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_EMPLOYEE_POST_UPDATE, $id);
        $body = [
            'id' => $id,
            'used_monthly_off_day' => $usedMonthlyOffDay,
            'total_monthly_off_day_available' => $totalMonthlyOffDayAvailable,
            'total_monthly_off_day' => $totalMonthlyOffDay,
            'used_yearly_off_day' => $usedYearlyOffDay,
            'total_yearly_off_day_available' => $totalYearlyOffDayAvailable,
            'total_yearly_off_day' => $totalYearlyOffDay,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function detail(Request $request)
    {
        $brand = $request->get('brand');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SALARY_GET_EMPLOYEE_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $config1 = $config;
            $data = $config['data'];
            $dateStatus = '';
            if ($data['status'] === (int)ENUM_SELECTED) {
                $status = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_STATUS_ENABLE . '</label>
                            </div>';
            } else {
                if ($data['is_quit_job'] == (int)ENUM_SELECTED) {
                    $status = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">Thôi việc</label>
                                </div>
                                ';
                    $dateStatus = '<div  class="seemt-red seemt-fz-14">Ngày thôi việc: ' . date('d/m/Y', strtotime($data['quit_job_at'])) . '</div>';
                } else {
                    $status = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">Tạm khóa</label>
                            </div>';
                    $dateStatus = ' <div class="seemt-blue seemt-fz-14">Ngày tạm khóa : ' . date('d/m/Y', strtotime($data['lock_at'])) . '</div>';
                }

            }
            if ($data['gender'] === (int)TEXT_FEMALE_VALUE) {
                $gender = TEXT_FEMALE;
                $color = 'bg-c-pink';
            } else {
                $gender = TEXT_MALE;
                $color = 'bg-c-lite-green';
            }
            $area_db = [];
            foreach ($data['manage_areas'] as $db) {
                array_push($area_db, $db['name']);
            }
            $areaControl = implode(',', $area_db);
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $groupRole = '';
            //            Xử lí khối bộ phận
            switch ($data['employee_role_type']) {
                case 1:
                    $groupRole = TEXT_OFFICE;
                    break;
                case 2:
                    $groupRole = TEXT_BUSINESS;
                    break;
                case 3:
                    $groupRole = TEXT_PRODUCTION;
                    break;
                case 4:
                    $groupRole = TEXT_MARKETING;
                    break;
            };

            $dataDetail = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'avatar' => $domain . $data['avatar'],
                'status' => $status,
                'gender' => $gender,
                'branch' => $data['branch_name'],
                'branch_id' => $data['branch_id'],
                'point' => $data['point'],
                'employee_role_type' => $groupRole,
                'role' => $data['role_name'],
                'passport' => $data['identity_card'],
                'birth_place' => $data['birth_place'],
                'birthday' => $data['birthday'],
                'rank' => $data['employee_rank_name'],
                'salary' => $data['salary_level'],
                'date_work' => $data['working_from'],
                'work' => $data['working_session_name'] . ' (' . $data['working_session_time'] . ')',
                'area_control' => $areaControl,
                'area' => $data['area_name'],
                'color' => $color,
                'date_status' => $dateStatus
            ];
            // Sửa vì nhân viên có thể nhiều thương hiệu
            $branch = $request->get('branch');
            $time = $request->get('time');
            $type = "";
            $status = Config::get('constants.type.EmployeeBonusPunishStatusTypeEnum.APPROVED');
            $isPunish = ENUM_GET_ALL;
            $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
            $method = ENUM_METHOD_GET;
            $api = sprintf(API_LIST_EMPLOYEE_SALARY_ADDITION_GET_LIST_EMPLOYEE_SALARY_ADDITION, $branch, $time, $type, $id, $isPunish, $status);
            $body = null;
            $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
            $config2 = $config;
            $dataTotal['total_bonus'] = $this->numberFormat($config['data']['bonus_amount']);
            $dataTotal['total_punish'] = $this->numberFormat($config['data']['punish_amount']);
            $dataTotal['total_record_bonus_punish'] = $this->numberFormat(count($config['data']['list']));
            $dataTableBonusPunish = DataTables::of($config['data']['list'])
                ->addColumn('bonus', function ($row) {
                    if ($row['amount'] > 0) {
                        return $this->numberFormat($row['amount']);
                    } else {
                        return '0';
                    }
                })
//                PUNISH_WRONG_BILL
                ->addColumn('bonusrole', function ($row) {
                    switch ($row['type']) {
                        case Config::get('constants.type.SalaryAdditionTypeEnum.OTHER_REWARD_PUNISH');
                            return $row['amount'] > 0 ? $row['type_name'] = TEXT_REWARD : $row['type_name'] = TEXT_PUNISH;
                            break;
                        case Config::get('constants.type.SalaryAdditionTypeEnum.SUPPORT');
                            return TEXT_SUPPORT;
                            break;
                        case Config::get('constants.type.SalaryAdditionTypeEnum.UNIFORM');
                            return TEXT_UNIFORM;
                            break;
                        case Config::get('constants.type.SalaryAdditionTypeEnum.PUNISH_WRONG_BILL');
                            return TEXT_PUNISH_WRONG_BILL;
                            break;
                        default:
                            $row['status_label'] = '<label class="label label-lg label-danger">' . TEXT_CANCELED . '</label>';
                            return TEXT_PUNISH;
                            break;
                    }
                })
                ->addColumn('punish', function ($row) {
                    if ($row['amount'] < 0) {
                        return $this->numberFormat(abs($row['amount']));
                    } else {
                        return '0';
                    }
                })
                ->addColumn('action', function ($rows) {
                    return '<div class="btn-group btn-group-sm text-center d-flex">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeBonusPunish(' . $rows['id'] . ', ' . $rows['branch']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

//            $time = date('d/m/Y');
            $time = $request->get('time');
            $type = $request->get('type');
            $reportType = ENUM_REPORT_TYPE_ALL_YEAR;
            $limit = ENUM_DEFAULT_LIMIT_50000;
            $page = ENUM_DEFAULT_PAGE;
            $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
            $method = ENUM_METHOD_GET;
            $branch = '';
            $api = sprintf(API_EMPLOYEE_GET_BILL_EMPLOYEE_DETAIL, $id, $type, $time, $brand, $branch, $limit, $page);
            $body = null;
            $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
            $data_table_bill = DataTables::of($config['data']['list'])
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('created_at', function ($row) {
                    return $row['created_at'];
                })
                ->addColumn('action', function ($rows) {
                    return '<div class="btn-group btn-group-sm text-center d-flex">
                           <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-is-print="1" data-id="' . $rows['id'] . '" data-cancel="0"  onclick="openBillDetail($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                })
                ->rawColumns(['action', 'created_at'])
                ->addIndexColumn()
                ->make(true);

            $dataTotal['total_record_bill'] = $this->numberFormat(count($config['data']['list']));
            $dataTotal['total_bill'] = $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_amount')));
            return [$dataDetail, $dataTableBonusPunish, $data_table_bill, $dataTotal, $config1, $config2, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function info(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SALARY_GET_EMPLOYEE_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $config1 = $config;
            $data = $config['data'];
            $dateStatus = '';
            if ($data['status'] === (int)ENUM_SELECTED) {
                $status = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_STATUS_ENABLE . '</label>
                            </div>';
            } else {
                if ($data['is_quit_job'] == (int)ENUM_SELECTED) {
                    $status = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">Thôi việc</label>
                            </div>';
                    $dateStatus = '<div  class="seemt-red seemt-fz-14">Ngày thôi việc: ' . date('d/m/Y', strtotime($data['quit_job_at'])) . '</div>';
                } else {
                    $status = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">Tạm khóa</label>
                            </div>';
                    $dateStatus = ' <div class="seemt-blue seemt-fz-14">Ngày tạm khóa : ' . date('d/m/Y', strtotime($data['lock_at'])) . '</div>';

                }

            }
            if ($data['gender'] === (int)TEXT_FEMALE_VALUE) {
                $gender = TEXT_FEMALE;
                $color = 'bg-c-pink';
            } else {
                $gender = TEXT_MALE;
                $color = 'bg-c-lite-green';
            }
            $area_db = [];
            foreach ($data['manage_areas'] as $db) {
                array_push($area_db, $db['name']);
            }
            $areaControl = implode(',', $area_db);
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $groupRole = '';
            //            Xử lí khối bộ phận
            switch ($data['employee_role_type']) {
                case 1:
                    $groupRole = TEXT_OFFICE;
                    break;
                case 2:
                    $groupRole = TEXT_BUSINESS;
                    break;
                case 3:
                    $groupRole = TEXT_PRODUCTION;
                    break;
                case 4:
                    $groupRole = TEXT_MARKETING;
                    break;
            };
            $dataDetail = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'avatar' => $domain . $data['avatar'],
                'status' => $status,
                'gender' => $gender,
                'branch' => $data['branch_name'],
                'branch_id' => $data['branch_id'],
                'point' => $data['point'],
                'employee_role_type' => $groupRole,
                'role' => $data['role_name'],
                'passport' => $data['identity_card'],
                'birth_place' => $data['birth_place'],
                'birthday' => $data['birthday'],
                'rank' => $data['employee_rank_name'],
                'salary' => $data['salary_level'],
                'date_work' => $data['working_from'],
                'work' => $data['working_session_name'] . ' (' . $data['working_session_time'] . ')',
                'area_control' => $areaControl,
                'area' => $data['area_name'],
                'color' => $color,
                'address_full_text' => $data['employee_profile']['address_full_text'],
                'employee_role_type' => $data['employee_role_type'],
                'date_status' => $dateStatus
            ];


            return [$dataDetail, $config1];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function changeStatusWorking(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $chatToken = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
        $api = sprintf(API_EMPLOYEE_POST_QUIT_JOB, $id);
        $body = [
            'node_access_token' => $chatToken
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        return [$config];
    }

    public function changeStatus(Request $request)
    {
        $chatToken = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_EMPLOYEE_POST_CHANGE_STATUS, $id);
        $body = [
            'node_access_token' => $chatToken
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function resetPassWord(Request $request)
    {
        $id = $request->get('id');
        $token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_EMPLOYEE_POST_RESET_PASSWORD, $id);
        $body = [
            'node_access_token' => $token
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function dataSelectRole(Request $request)
    {
        $branchID = $request->get('branch');
        $status = ENUM_STATUS_GET_ACTIVE;
        $type = ENUM_ROLE_TYPE_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_ROLE_GET_DATA, $branchID, $status, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $select = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';;
            foreach ($config['data'] as $db) {
                $select .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            };

            if ($config['data'] === []) {
                $select = '<option value="-3" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            }
            return [$select, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataSelectCity(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SETTING_BRANCH_GET_LIST_CITIES, (int)Config::get('constants.type.checkbox.SELECTED'));
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $select = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';;
            foreach ($config['data'] as $db) {
                $select .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            };
            return [$select, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataSelectDistrict(Request $request)
    {
        $cityID = $request->get('city_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SETTING_BRANCH_GET_LIST_DISTRICTS, $cityID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $select = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';;
            foreach ($config['data'] as $db) {
                $select .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            };
            return [$select, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataSelectWard(Request $request)
    {
        $districtID = $request->get('district_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SETTING_BRANCH_GET_LIST_WARDS, $districtID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $select = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';;
            foreach ($config['data'] as $db) {
                $select .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            };
            return [$select, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function getAllDataEmployee(Request $request)
    {
        $branchID = $request->get('branch');
        $brand = $request->get('brand');
        $status = ENUM_STATUS_GET_ACTIVE;
        /**
         * List Salary
         * */
        $api = sprintf(API_SALARY_LEVEL_GET_ALL);
        $body = null;
        $requestSettingSalary = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];
        /**
         * List area
         * */
        $isTakeAway = ENUM_STATUS_GET_ALL;
        $api = sprintf(API_LIST_AREA_GET, $branchID, $isTakeAway, $status);
        $body = null;
        $requestSettingArea = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];

        /**
         * List work
         * */
        $api = sprintf(API_WORKING_SESSION_GET_ALL, $brand, $status);
        $body = null;
        $requestSettingWork = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];

        $configAll = $this->callApiMultiGatewayTemplate([$requestSettingSalary, $requestSettingArea, $requestSettingWork]);
        try {
            /* Salary */
            $config = $configAll[0];
            if ($config['status'] !== (int)ENUM_HTTP_STATUS_CODE_SUCCESS) {
                return [$config, 'getListSalary'];
            } else {
                $data = $config['data']['list'];
                $dataSalary = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
                for ($i = 0; $i < count($data); $i++) {
                    if ($data[$i]['status'] == ENUM_SELECTED && $data[$i]['type'] == ENUM_DIS_SELECTED) {
                        $dataSalary .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['level'] . " - " . $this->numberFormat($data[$i]['basic_salary'], 0, '', ',') . '</option>';
                    }
                }
                if ($dataSalary === '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>') {
                    $dataSalary = '<option value="-3">' . TEXT_NULL_OPTION . '</option>';
                }
                if ($dataSalary === '') {
                    $dataSalary = '<option value="-3" disabled selected>' . TEXT_NULL_OPTION . '</option>';
                }
            }

            /* Area */
            $config = $configAll[1];
            if ($config['status'] !== (int)ENUM_HTTP_STATUS_CODE_SUCCESS) {
                return [$config, 'getListArea'];
            } else {
                $data = $config['data']['list'];
                $dataArea = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
                $dataManageArea = '';
                for ($i = 0; $i < count($data); $i++) {
                    $dataArea .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                    $dataManageArea .= '<option data-employee-id="' . $data[$i]['employee_id'] . '" value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . ' (' . $data[$i]['employee_manager_full_name'] . ')</option>';
                }
                if ($dataArea === '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>') {
                    $dataArea = '<option value="-3" disabled selected>' . TEXT_NULL_OPTION . '</option>';
                }
            }

            /* work */
            $config = $configAll[2];
            if ($config['status'] !== (int)ENUM_HTTP_STATUS_CODE_SUCCESS) {
                return [$config, 'getListWork'];
            } else {
                $data = $config['data']['list'];
                $dataWork = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
                for ($i = 0; $i < count($data); $i++) {
                    $dataWork .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . ' (' . $data[$i]['time_interval_string'] . ')</option>';
                }
                if ($dataWork === '') {
                    $dataWork = '<option value="-3" disabled selected>' . TEXT_NULL_OPTION . '</option>';
                }
            }

            return [$dataSalary, $dataArea, $dataWork, $dataManageArea, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataSelectLoadUpdate(Request $request)
    {
        // Ca làm việc
        $brand = $request->get('brand');
        $status = ENUM_STATUS_GET_ACTIVE;
        $isTakeAway = ENUM_STATUS_GET_ALL;
        $api = sprintf(API_WORKING_SESSION_GET_ALL, $brand, $status);
        $body = [];
        $requestWorkingSessction = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];

        // Khu vực
        $branchID = $request->get('branch');
        $api = sprintf(API_LIST_AREA_GET, $branchID, $isTakeAway, $status);
        $body = [];
        $requestArea = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestArea, $requestWorkingSessction]);
        try {
            $selectArea = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';;
            foreach ($configAll[0]['data']['list'] as $db) {
                $selectArea .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            };
            if ($configAll[0]['data']['list'] === []) {
                $selectArea = '<option value="-3" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            }
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }

        // Ca làm việc
        try {
            $selectWorkingSesstion = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';;
            foreach ($configAll[1]['data']['list'] as $db) {
                $selectWorkingSesstion .= '<option value="' . $db['id'] . '"> ' . $db['name'] . ' (' . $db['time_interval_string'] . ') </option>';
            };
            if ($configAll[1]['data']['list'] === []) {
                $selectWorkingSesstion = '<option value="-3" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            }
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
        return [$selectArea, $selectWorkingSesstion, $configAll];
    }
}
