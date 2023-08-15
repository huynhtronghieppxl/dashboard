<?php

namespace App\Http\Controllers\BuildData\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class TableDataController extends Controller
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
        $active_nav = 'Bàn';
        return view('build_data.business.table.index', compact('active_nav'));
    }

    public function data(Request $request)
    {

        $branch_id = $request->get('branch_id');
        $area_id = $request->get('area_id');
        $status = ENUM_STATUS_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_TABLE_GET_DATA, $branch_id, $area_id, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $dataEnable = $collection->where('is_active', ENUM_SELECTED)->all();
            $dataDisable = $collection->where('is_active', ENUM_DIS_SELECTED)->all();
            $enable = TEXT_ENABLE;
            $disable = TEXT_DISABLE_STATUS;
            $update = TEXT_UPDATE;
            $tableEnable = DataTables::of($dataEnable)
                ->addColumn('action', function ($row) use ($disable, $update) {
                    return '<div class="btn-group btn-group-sm ">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusTableBuildData($(this))" data-branch="' . $row['branch_id'] . '" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-area-id="' . $row['area_id'] . '" data-number="' . $row['slot_number'] . '" data-status="' . $row['is_active'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateTableBuildData($(this))" data-branch="' . $row['branch_id'] . '" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-area-id="' . $row['area_id'] . '" data-number="' . $row['slot_number'] . '" data-status="' . $row['is_active'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchFilterTemplate($row['name'] . $row['slot_number']);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);

            $tableDisable = DataTables::of($dataDisable)
                ->addColumn('action', function ($row) use ($enable) {
                    return '<div class="btn-group btn-group-sm ">
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusTableBuildData($(this))" data-branch="' . $row['branch_id'] . '" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-area-id="' . $row['area_id'] . '" data-number="' . $row['slot_number'] . '" data-status="' . $row['is_active'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '"><i class="fi-rr-check"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchFilterTemplate($row['name'] . $row['slot_number']);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
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
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api =sprintf(API_TABLE_POST_MANAGE);
        $body = [
            'branch_id' => $request->get('branch_id'),
            'table_id' => Config::get('constants.type.id.DEFAULT'),
            'table_name' => $request->get('table_name'),
            'area_id' => $request->get('area_id'),
            'total_slot' => $request->get('total_slot'),
            'status' => ENUM_SELECTED,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
                $disable = TEXT_DISABLE_STATUS;
                $update = TEXT_UPDATE;
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusTableBuildData($(this))" data-branch="' . $config['data']['branch_id'] . '" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-area-id="' . $config['data']['area_id'] . '" data-number="' . $config['data']['slot_number'] . '" data-status="' . $config['data']['is_active'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><i class="fi-rr-cross"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  onclick="openModalUpdateTableBuildData($(this))" data-branch="' . $config['data']['branch_id'] . '" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-area-id="' . $config['data']['area_id'] . '" data-number="' . $config['data']['slot_number'] . '" data-status="' . $config['data']['is_active'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                                         </div>';
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $area_id = $request->get('area_id');
        $name = $request->get('name');
        $number = $request->get('number');
        $id = $request->get('id');
        $status = $request->get('status');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_TABLE_POST_MANAGE);
        $body = [
            'branch_id' => $branch_id,
            'table_id' => $id,
            'table_name' => $name,
            'area_id' => $area_id,
            'total_slot' => $number,
            'status' => $status,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
                $enable = TEXT_ENABLE;
                $disable = TEXT_DISABLE_STATUS;
                $update = TEXT_UPDATE;
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                if ($config['data']['status'] === ENUM_SELECTED) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusTableBuildData($(this))" data-branch="' . $config['data']['branch_id'] . '" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-area-id="' . $config['data']['area_id'] . '" data-number="' . $config['data']['slot_number'] . '" data-status="' . $config['data']['is_active'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><i class="fi-rr-cross"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateTableBuildData($(this))" data-branch="' . $config['data']['branch_id'] . '" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-area-id="' . $config['data']['area_id'] . '" data-number="' . $config['data']['slot_number'] . '" data-status="' . $config['data']['is_active'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                                         </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusTableBuildData($(this))" data-branch="' . $config['data']['branch_id'] . '" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-area-id="' . $config['data']['area_id'] . '" data-number="' . $config['data']['slot_number'] . '" data-status="' . $config['data']['is_active'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '"><i class="fi-rr-check"></i></button>
                                          </div>';
                }
            }
            return $config;
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function area(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $status = ENUM_SELECTED;
        $is_take_away = ENUM_STATUS_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LIST_AREA_GET, $branch_id, $is_take_away, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $area = '';
            foreach ($data as $db) {
                $area .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
            return [$area, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function updateStatus(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_TABLE_POST_CHANGE_STATUS,$id);
        $body = [
            'branch_id' => $request->get('branch_id'),
            'table_id' => $request->get('id'),
            'table_name' => $request->get('name'),
            'area_id' => $request->get('area_id'),
            'total_slot' => $request->get('number'),
            'status' => $request->get('status'),
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try{
        if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
            $enable = TEXT_ENABLE;
            $disable = TEXT_DISABLE_STATUS;
            $update = TEXT_UPDATE;
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            if ($config['data']['is_active'] === ENUM_SELECTED) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusTableBuildData($(this))" data-branch="' . $config['data']['branch_id'] . '" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-area-id="' . $config['data']['area_id'] . '" data-number="' . $config['data']['slot_number'] . '" data-status="' . $config['data']['is_active'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><i class="fi-rr-cross"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  onclick="openModalUpdateTableBuildData($(this))" data-branch="' . $config['data']['branch_id'] . '" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-area-id="' . $config['data']['area_id'] . '" data-number="' . $config['data']['slot_number'] . '" data-status="' . $config['data']['is_active'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                                            </div>';
            } else {
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusTableBuildData($(this))" data-branch="' . $config['data']['branch_id'] . '" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-area-id="' . $config['data']['area_id'] . '" data-number="' . $config['data']['slot_number'] . '" data-status="' . $config['data']['is_active'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '"><i class="fi-rr-check"></i></button>
                                            </div>';
            }
        }
        return $config;
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
