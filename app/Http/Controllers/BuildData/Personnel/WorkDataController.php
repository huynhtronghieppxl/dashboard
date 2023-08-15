<?php

namespace App\Http\Controllers\BuildData\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class WorkDataController extends Controller
{
    public function index()
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Công việc';
        return view('build_data.personnel.work.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $category = ENUM_GET_ALL;
        $is_deleted = ENUM_GET_ALL;
        $employee_role_id = $request->get('role');
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_WORK_DATA_GET, $brand, $category, $employee_role_id, $is_deleted, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = collect($config['data']['list'])->where('employee_job_category_id', '!==', 0)->toArray();
            $work_data = '';
            $work_index = 1;
            $category_filter = 0;
            $category = [];
            $x = 0;
            foreach ($data as $db) {
                if ($category_filter === 0) {
                    $work_index = 1;
                    $work_data .= '<div class="card-block pb-0 w-100"><h5 class="sub-title">' . $db['employee_job_category_name'] . '</h5></div>
                                            <div class="card-block pb-0 pt-0">
                                                <div class="row m-0">
                                                    <div class="col-md-12 row" id="draggableMultiple' . $db['employee_job_category_id'] . '">';
                    array_push($category, 'draggableMultiple' . $db['employee_job_category_id']);
                } else if ($category_filter !== $db['employee_job_category_id'] && $x <= count($data)) {
                    $work_data .= '</div></div></div>';
                    $work_data .= '<div class="card-block pb-0 w-100"><h5 class="sub-title">' . $db['employee_job_category_name'] . '</h5></div>
                                            <div class="card-block pb-0 pt-0">
                                                <div class="row m-0">
                                                    <div class="col-md-12 row" id="draggableMultiple' . $db['employee_job_category_id'] . '">';
                    array_push($category, 'draggableMultiple' . $db['employee_job_category_id']);
                }
                $class = 'work-active';
                $status = '<i class="fa fa-2x fa-check-square class-check-open-save" data-toggle="tooltip" data-placement="top" data-original-title="Đang hoạt động" data-check="fa-check-square"></i>';
                if ($db['status'] === ENUM_DIS_SELECTED) {
                    $class = 'work-not-active';
                    $status = '<i class="fa fa-2x fa-square class-check-open-save" data-toggle="tooltip" data-placement="top" data-original-title="Không hoạt động" data-check="fa-square"></i>';
                }
                $detail = "";
                if ($db['description'] !== "") {
                    $detail = '<i class="fa fa-2x fa-info-circle text-primary" data-toggle="tooltip" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailWorkData($(this))"></i>';
                }
                $work_data .= '<div class="col-4 card-block2 edit-flex-auto-fill"><div class="sortable-moves flex-sub ' . $class . '">
                                   <h5 class="class-point-work-data">Trọng số: ' . $this->numberFormat($db['base_point']) . '</h5>
                                   <div class="btn-group btn-group-sm"><button type="button" class="btn btn-inverse waves-effect waves-light btn-index-work">' . $work_index . '</button></div>
                                   <p class="content-work-data" data-limit-text="100">' . $db['content'] . '</p>
                                   <span>
                                       <label class="d-none">' . $db['description'] . '</label>
                                       <i class="fa fa-2x fa-pencil-square" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" onclick="openModalUpdateWorkData($(this))"
                                       data-id="' . $db['id'] . '" data-role="' . $db['role_id'] . '" data-role-name="' . $db['role_name'] . '" data-category="' . $db['employee_job_category_id'] . '"
                                       data-category-name="' . $db['employee_job_category_name'] . '" data-kpi="' . $this->numberFormat($db['base_point']) . '"></i>
                                       ' . $status . '
                                       ' . $detail . '
                                   </span>
                               </div></div>';
                if ($x === count($data)) {
                    $work_data .= '</div></div></div>';
                }
                $work_index++;
                $x++;
                $category_filter = $db['employee_job_category_id'];
            }
            return [$work_data, $category, $config['data']['list'] , $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataRole(Request $request)
    {
        $branch = ENUM_GET_ALL;
        $status = ENUM_STATUS_GET_ACTIVE;
        $project = ENUM_PROJECT_ID_ORDER;
        $type = ENUM_GET_ALL;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_ROLE_GET_DATA, $branch, $status, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data_role = '';
            $selected = 'selected';
            for ($i = 0; $i < count($data); $i++) {
                $data_role .= '<option value="' . $data[$i]['id'] . '" ' . $selected . '>' . $data[$i]['name'] . '</option>';
                $selected = '';
            }
            if ($data_role === '') {
                $data_role = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$data_role, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataCategory(Request $request)
    {
        $brand = $request->get('brand');
        $employee_role_id = $request->get('role');
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api =sprintf(API_CATEGORY_WORK_GET_DATA, $employee_role_id, $brand, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data_role = '';
            $selected = 'selected';
            for ($i = 0; $i < count($data); $i++) {
                $data_role .= '<option data-employee-role-id="' . $data[$i]['employee_role']['id'] . '" data-employee_job_category_id = "' . $data[$i]['id'] . '" value="' . $data[$i]['id'] . '" ' . $selected . '>' . $data[$i]['name'] . '</option>';
                $selected = '';
            }
            if ($data_role === '') {
                $data_role = '<option value="" selected>' . TEXT_NULL_OPTION . '</option>';
            }
            return [$data_role, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $name = $request->get('name');
        $description = $request->get('description');
        $role = $request->get('role');
        $brand = $request->get('brand_id');
        $base_point = $request->get('base_point');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $employee_job_category_id = $request->get('category');
        $api = sprintf(API_WORK_DATA_POST_MANAGE);
        $body = [
            'employee_role_id' => $role,
            'restaurant_brand_id' => $brand,
            'employee_job_category_id' => $employee_job_category_id,
            'content' => $name,
            'description' => $description,
            'base_point' => $base_point,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $description = $request->get('description');
        $role = $request->get('role');
        $category = $request->get('category');
        $base_point = $request->get('base_point');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_WORK_DATA_POST_MANAGE_UPDATE, $id);
        $body = [
            'id' => $id,
            'employee_role_id' => $role,
            'employee_job_category_id' => $category,
            'content' => $name,
            'description' => $description,
            'base_point' => $base_point,
            'restaurant_brand_id' => $request->get('restaurant_brand_id'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function sort(Request $request)
    {
        $sort = $request->get('sort');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_WORK_DATA_POST_SORT);
        $body = [
            "list_sort" => $sort
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
