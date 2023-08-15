<?php

namespace App\Http\Controllers\BuildData\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class EmployeeDataController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if ($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(0);
        if ($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Nhân viên';
        return view('build_data.personnel.employee.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $checkLevel = Session::get('SESSION_KEY_LEVEL');
        if ($checkLevel > 1) {
            $branch_id = $request->get('branch_id');
            $restaurant_brand_id = $request->get('restaurant_brand_id');
            $is_include_restaurant_manager = Config::get('constants.type.checked.SELECTED');
            $status = Config::get('constants.type.status.GET_ACTIVE');
            $is_take_myself = Config::get('constants.type.status.GET_ALL');
            $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
            $method = Config::get('constants.GATEWAY.METHOD.GET');
            $api = sprintf(API_EMPLOYEE_GET_DATA, $branch_id, $status, $is_include_restaurant_manager, $is_take_myself, $restaurant_brand_id);
            $body = null;
            $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
            try {
                $data = $config['data']['list'];
                $data_check_in = collect($data)->where('is_bypass_checkin', 0)->where('is_working', 1)->where('status', 1)->toArray();
                $data_not_check_in = collect($data)->where('is_bypass_checkin', 0)->where('is_working', 0)->where('status', 1)->toArray();
                $data_bypass_checkin = collect($data)->where('is_bypass_checkin', 1)->where('status', 1)->toArray();
                $data_total = [
                    'total_check_in' => $this->numberFormat(count($data_check_in)),
                    'total_not_check_in' => $this->numberFormat(count($data_not_check_in)),
                    'total_bypass_check_in' => $this->numberFormat(count($data_bypass_checkin)),
                ];
                /**
                 * EMPLOYEE CHECK IN
                 */
                $data_employee_check_in = $this->drawTableEmployee($data_check_in);
                /**
                 * EMPLOYEE NOT CHECK IN
                 */

                $data_employee_not_check_in = $this->drawTableEmployee($data_not_check_in);
                /**
                 * EMPLOYEE BYPASS
                 */
                $data_employee_bypass = $this->drawTableEmployee($data_bypass_checkin);
                return [$data_employee_check_in, $data_employee_not_check_in, $data_employee_bypass, $data_total, $config];

            } catch (Exception $e) {
                return $this->catchTemplate($config, $e);
            }
        }else {
            $branch_id = $request->get('branch');
            $brand_id = $request->get('brand');
            $is_include_restaurant_manager = Config::get('constants.type.checked.SELECTED');
            $status = Config::get('constants.type.status.GET_ACTIVE');
            $is_take_myself = Config::get('constants.type.status.GET_ALL');
            $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
            $method = Config::get('constants.GATEWAY.METHOD.GET');
            $api = sprintf(API_EMPLOYEE_GET_DATA, $branch_id, $status, $is_include_restaurant_manager, $is_take_myself, $brand_id);
            $body = null;
            $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
            try {
                $table = $this->drawTableEmployee($config['data']['list']);
                return [$table, $config];
            } catch (Exception $e) {
                return $this->catchTemplate($config, $e);
            }
        }
    }

    public function drawTableEmployee($data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        return DataTables::of($data)
            ->addColumn('employee_avatar', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"><label class="title-name-new-table" >' . $row['name'] . '<br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['role_name'] . '</label></label>';
            })
            ->addColumn('working', function ($row) use ($domain) {
                return $row['working_from_beging'];
            })
            ->addColumn('gender', function ($rows) {
                if ($rows['gender'] == TEXT_FEMALE_VALUE) {
                    $message = '<div class="d-flex align-items-center"><i class="fi-rr-venus mr-1 " style="color:#ff9dae ;margin-bottom: 2px"></i><span>' . TEXT_FEMALE . '</span></div>';
                } else {
                    $message = '<div class="d-flex align-items-center"><i class="fa fa-mars mr-1 seemt-blue " style="margin-bottom: 2px"></i><span>' . TEXT_MALE . '</span></div>';
                }
                return $message;
            })
            ->addColumn('action', function ($rows) {
                return '<div class="btn-group btn-group-sm text-center">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" onclick="openModalUpdateEmployeeManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"
                            data-avatar="' . $rows['avatar'] . '" data-id="' . $rows['id'] . '" data-brand="' . $rows['restaurant_brand_id'] . '" data-branch-id="' . $rows['branch_id'] . '" data-is-quit-job="' . $rows['is_quit_job'] . '" data-status="' . $rows['status'] . '" data-name="' . $rows['name'] . '" data-username="' . $rows['username'] . '" data-gender="' . $rows['gender'] . '" data-phone="' . $rows['phone'] . '" data-branch-name="' . $rows['branch_name'] . '"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailEmployeeManage(' . $rows['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['gender', 'employee_avatar', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function role(Request $request)
    {
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $branch = $request->get('branch');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $type = Config::get('constants.type.checkbox.GET_ALL');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_ROLE_GET_DATA, $branch, $status, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data_role = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $data_role .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
            }
            if ($data_role === '') {
                $data_role = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }

            return [$data_role, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function rank(Request $request)
    {
        $brand = $request->get('brand');
        $role = $request->get('role');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_LEVEL_GET_DATA, $brand, $role);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $data_rank = '';
            for ($i = 0; $i < count($data); $i++) {
                $data_rank .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . ' (' . $data[$i]['table_number'] . ' bàn) </option>';
            }
            if ($data_rank === '') {
                $data_rank = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$data_rank, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function salary(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SALARY_LEVEL_GET_ALL);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $data_salary = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $data_salary .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['level'] . '</option>';
            }
            if ($data_salary === '') {
                $data_salary = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$data_salary, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function area(Request $request)
    {
        $branch_id = $request->get('branch');
        $is_take_away = Config::get('constants.type.status.GET_ALL');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_LIST_AREA_GET, $branch_id, $is_take_away, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $data_area = '';
            for ($i = 0; $i < count($data); $i++) {
                $data_area .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
            }
            if ($data_area === '') {
                $data_area = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$data_area, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function work(Request $request)
    {
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $brand = $request->get('brand');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_WORKING_SESSION_GET_ALL, $brand, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $data_work = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $data_work .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . ' (' . $data[$i]['time_interval_string'] . ')</option>';
            }
            if ($data_work === '') {
                $data_work = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$data_work, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $chat_token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
        $salary = $request->get('salary_level_id');
        $rank = $request->get('rank_id');
        $work = $request->get('working_session_id');
        $employ_name = $request->get('name');
        $area = $request->get('area_id');
        $role = $request->get('role_id');
        $branch = $request->get('branch_id');
        $birth_place = $request->get('birth_place');
        $address = $request->get('address');
        $areaManager = $request->get('manage_area_ids');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $gender = $request->get('gender');
        $phone = $request->get('phone');
        $passport = $request->get('passport');
        $birthDate = $request->get('birthday');
        $email = $request->get('email');
        $id = Config::get('constants.type.id.DEFAULT');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_EMPLOYEE_POST_CREATED);
        $body = ['id' => $id,
            'restaurant_brand_id' => $restaurant_brand_id,
            'name' => $employ_name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'gender' => $gender,
            'employee_role_id' => $role,
            'employee_rank_id' => $rank,
            'passport' => $passport,
            'birthday' => $birthDate,
            'birth_place' => $birth_place,
            'salary_level_id' => $salary,
            'area_id' => $area,
            'working_session_id' => $work,
            'branch_id' => $branch,
            'status' => $status,
            'manage_area_ids' => $areaManager,
            'chat_token' => $chat_token
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $url = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SALARY_GET_EMPLOYEE_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            if ($data['status'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                $status = '<label class="label label-lg label-success">' . TEXT_STATUS_ENABLE . '</label>';
            } else {
                $status = '<label class="label label-lg label-inverse">' . TEXT_DISABLE_STATUS . '</label>';
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
            $area_control = implode(',', $area_db);
            $data['avatar'] = $url . $data['avatar'];
            $data_detail = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'avatar' => $data['avatar'],
                'status' => $status,
                'gender' => $gender,
                'branch' => $data['branch_name'],
                'point' => $data['point'],
                'role' => $data['role_name'],
                'passport' => $data['passport'],
                'birth_place' => $data['birth_place'],
                'birthday' => $data['birthday'],
                'rank' => $data['employee_rank_name'],
                'salary' => $data['salary_level'],
                'work' => $data['working_session_name'] . ' (' . $data['working_session_time'] . ')',
                'area_control' => $area_control,
                'area' => $data['area_name'],
                'color' => $color,
            ];
            return [$data_detail, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
