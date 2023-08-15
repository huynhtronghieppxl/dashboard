<?php

namespace App\Http\Controllers\BuildData\Personnel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class CategoryWorkDataController extends Controller
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
        $active_nav = 'Danh mục công việc';
        return view('build_data.personnel.category_work.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $employee_role_id = $request->get('role');
        $brand = $request->get('brand');
        $status = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_CATEGORY_WORK_GET_DATA, $employee_role_id, $brand, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $category_work_data = '';
            $category_work_index = 1;
            foreach ($data as $db) {
                $class = 'work-active';
                $status = '<i class="fa fa-2x fa-check-square" data-toggle="tooltip" data-placement="top" data-original-title="Đang hoạt động"></i>';
                if ($db['status'] === ENUM_DIS_SELECTED) {
                    $class = 'work-not-active';
                    $status = '<i class="fa fa-2x fa-square" data-toggle="tooltip" data-placement="top" data-original-title="Không hoạt động"></i>';
                }
                $category_work_data .= '<div class="col-lg-4 card-block2 edit-flex-auto-fill"><div class="sortable-moves flex-sub ' . $class . '">
                                   <h5 class="class-point-work-data">Số công việc: ' . $this->numberFormat($db['total_employee_job']) . '</h5>
                                   <div class="btn-group btn-group-sm"><button type="button" class="btn btn-inverse waves-effect waves-light btn-index-work">' . $category_work_index . '</button></div>
                                   <p>' . $db['name'] . '</p>
                                   <span>
                                       <i class="fa fa-2x fa-pencil-square" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id="' . $db['id'] . '" data-name="' . $db['name'] . '" onclick="openModalUpdateCategoryWorkData($(this))"></i>
                                       ' . $status . '
                                   </span>
                               </div></div>';
                $category_work_index++;
            }
            return [$category_work_data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $brand = $request->get('brand');
        $employee_role_id = $request->get('role');
        $name = $request->get('name');
        $description = $request->get('description');
        $count = $request->get('count');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CATEGORY_WORK_POST_CREATE);
        $body = [
            "employee_role_id" => $employee_role_id,
            "restaurant_brand_id" => $brand,
            "name" => $name,
            "description" => '',
            "sort" => 1,
            "status" => 0
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
                $category_work_data = '<div class="col-lg-4 card-block2 edit-flex-auto-fill">
                                        <div class="sortable-moves flex-sub work-active">
                                           <h5 class="class-point-work-data">Số công việc: 0</h5>
                                           <div class="btn-group btn-group-sm"><button type="button" class="btn btn-inverse waves-effect waves-light btn-index-work">' . ($count + 1) . '</button></div>
                                           <p>' . $config['data']['name'] . '</p>
                                           <span>
                                               <i class="fa fa-2x fa-pencil-square" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" onclick="openModalUpdateCategoryWorkData($(this))"></i>
                                               <i class="fa fa-2x fa-check-square" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"></i>
                                           </span>
                                        </div>
                                    </div>';
            } else {
                $category_work_data = '';
            }
            return [$category_work_data, $config];
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $brand = $request->get('brand');
        $employee_role_id = $request->get('role');
        $id = $request->get('id');
        $name = $request->get('name');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CATEGORY_WORK_POST_UPDATE, $id);
        $body = [
            "employee_role_id" => $employee_role_id,
            "restaurant_brand_id" => $brand,
            "name" => $name,
            "description" => $name,
            "sort" => 0,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function sort(Request $request)
    {
        $sort = $request->get('sort');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CATEGORY_WORK_POST_SORT);
        $body = [
            "list_sort" => $sort
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
