<?php

namespace App\Http\Controllers\BuildData\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class AreaDataController extends Controller
{

    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(0);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Khu vực';
        return view('build_data.business.area.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $status = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_ALL_AREA, $status, $branch_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $dataEnable = $collection->where('status', Config::get('constants.type.checkbox.SELECTED'))->toArray();
            $dataDisable = $collection->where('status', Config::get('constants.type.checkbox.DIS_SELECTED'))->toArray();
            $tableEnable = DataTables::of($dataEnable)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-id=" ' . $row['id'] . '" data-name="' . $row['name'] . '" data-branch="' . $row['branch_id'] . '" data-status="' . $row['status'] . '" onclick="changeStatusAreaData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></span></button>
                                <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $row['id'] . '" data-name="' . $row['name'] . '" data-branch="' . $row['branch_id'] . '" data-status="' . $row['status'] . '" onclick="openModalUpdateAreaData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['name']]);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            $tableDisable = DataTables::of($dataDisable)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-id=" ' . $row['id'] . '" data-name="' . $row['name'] . '" data-branch="' . $row['branch_id'] . '" data-status="' . $row['status'] . '" onclick="changeStatusAreaData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['name']]);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            $data_total = [
                'total_record_enable' => $this->numberFormat(count($dataEnable)),
                'total_record_disable' => $this->numberFormat(count($dataDisable))
            ];

            return [$tableEnable, $tableDisable, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $id = Config::get('constants.type.manage.CREATE');
        $employeeManagerID = Config::get('constants.type.manage.MANAGER_NONE');
        $brandID = $request->get('branch_id');
        $name = $request->get('name');
        $status = $request->get('status');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MANGE_AREA, $id);
        $body = [
            "id" => $id,
            "name" => $name,
            "employee_manager_id" => $employeeManagerID,
            "branch_id" => $brandID,
            "status" => $status,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                            <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-branch="' . $config['data']['branch_id'] . '" data-status="' . $config['data']['status'] . '" onclick="changeStatusAreaData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></span></button>
                                            <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-branch="' . $config['data']['branch_id'] . '" data-status="' . $config['data']['status'] . '" onclick="openModalUpdateAreaData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                        </div>';
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataUpdate(Request $request)
    {
        $branchID = $request->get('branch_id');
        $status = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LIST_AREA_GET, $branchID, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            return $data;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $status = $request->get('status');

        $branchID = $request->get('branch_id');
        $employeeManagerID = Config::get('constants.type.manage.MANAGER_NONE');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MANGE_AREA, $id);
        $body = [
            "id" => $id,
            "name" => $name,
            "employee_manager_id" => $employeeManagerID,
            "branch_id" => $branchID,
            "status" => $status,

        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                if ($config['data']['status'] === Config::get('constants.type.checkbox.SELECTED')) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-branch="' . $config['data']['branch_id'] . '" data-status="' . $config['data']['status'] . '" onclick="changeStatusAreaData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></span></button>
                                                <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-branch="' . $config['data']['branch_id'] . '" data-status="' . $config['data']['status'] . '" onclick="openModalUpdateAreaData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                            </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-branch="' . $config['data']['branch_id'] . '" data-status="' . $config['data']['status'] . '" onclick="changeStatusAreaData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                         </div>';
                }
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $status = $request->get('status');
        $branch_id = $request->get('branch_id');
        $employee_manager_id = Config::get('constants.type.manage.MANAGER_NONE');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $is_confirmed = $request->get('is_confirmed');
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MANGE_AREA_CHANGE_STATUS, $id);
        $body = [
            "id" => $id,
            "name" => $name,
            "employee_manager_id" => $employee_manager_id,
            "branch_id" => $branch_id,
            "status" => $status,
            'is_confirmed' => $is_confirmed
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                if ($config['data']['status'] === ENUM_SELECTED) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                    <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-branch="' . $config['data']['branch_id'] . '" data-status="' . $config['data']['status'] . '" onclick="changeStatusAreaData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></span></button>
                                                    <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-branch="' . $config['data']['branch_id'] . '" data-status="' . $config['data']['status'] . '" onclick="openModalUpdateAreaData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                    <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-branch="' . $config['data']['branch_id'] . '" data-status="' . $config['data']['status'] . '" onclick="changeStatusAreaData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                             </div>';
                }
            } else if ($config['status'] === ENUM_HTTP_STATUS_CODE_CONFIRM_SUPPLIER) {
                $enable_data = collect($config['data'])->where('status', ENUM_SELECTED)->toArray();
                $data_table = DataTables::of($enable_data)
                    ->addColumn('name', function ($row) {
                        return (mb_strlen($row['name']) > 30) ? $row['name'] = mb_substr($row['name'], 0, 27) . '...' : $row['name'];
                    })
                    ->addColumn('slot_number', function ($row) {
                        return $this->numberFormat($row['slot_number']);
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['action', 'name'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data'] = $data_table;
            } else if ($config['status'] === ENUM_HTTP_STATUS_CODE_UPDATE) {
                $data_table = DataTables::of($config['data'])
                    ->addColumn('name', function ($row) {
                        return (mb_strlen($row['name']) > 30) ? $row['name'] = mb_substr($row['name'], 0, 27) . '...' : $row['name'];
                    })
                    ->addColumn('slot_number', function ($row) {
                        return $this->numberFormat($row['slot_number']);
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['action', 'name'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data'] = $data_table;
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
