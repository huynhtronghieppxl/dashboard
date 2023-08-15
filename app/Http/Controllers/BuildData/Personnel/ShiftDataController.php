<?php

namespace App\Http\Controllers\BuildData\Personnel;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\WorkingSessions\StoreRequest;
use Illuminate\Support\Facades\Config;
use Akaunting\Money\Currency;
use Illuminate\Support\Collection;

class ShiftDataController extends Controller
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
        $active_nav = 'Ca làm việc';
        return view('build_data.personnel.shift.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand_id = $request->get('brand_id');
        $status = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_WORKING_SESSION_GET_ALL, $brand_id, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $collect = collect($data);
            $data_enable = $collect->where('status', ENUM_SELECTED)->all();
            $data_disable = $collect->where('status', ENUM_DIS_SELECTED)->all();
            $data_table_enable = DataTables::of($data_enable)
                ->addColumn('action', function ($row) {
                    $button='';
                    if($row['type'] !=1){
                        $button='<div class="btn-group btn-group-sm">
                            <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"  data-id=" ' . $row['id'] . '" data-name="' . $row['name'] . '" data-status="' . $row['status'] . '"  data-from-hour="' . $row['from_hour'] . '"  data-to-hour="' . $row['to_hour'] . '" onclick="changeStatusShiftData($(this))" title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                            <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"  data-id=" ' . $row['id'] . '" data-name="' . $row['name'] . '" data-from-hour="' . $row['from_hour'] . '"  data-to-hour="' . $row['to_hour'] . '" onclick="openModalUpdateShiftData($(this))" title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
                    }
                    return $button;
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            $data_table_disable = DataTables::of($data_disable)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button class="tabledit-edit-button btn seemt-green seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-status="' . $row['status'] . '"  data-id=" ' . $row['id'] . '" data-name="' . $row['name'] . '" data-from-hour="' . $row['from_hour'] . '"  data-to-hour="' . $row['to_hour'] . '" onclick="changeStatusShiftData($(this))" title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            $data_total = [
                'total_record_enable' => $this->numberFormat(count($data_enable)),
                'total_record_disable' => $this->numberFormat(count($data_disable))
            ];
            return [$data_table_enable, $data_table_disable, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $brand_id = $request->get('brand_id');
        $name = $request->get('name');
        $to_hour = $request->get('to_hour');
        $form_hour = $request->get('form_hour');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_WORKING_SESSION_POST_CREATE);
        $body = [
            "restaurant_brand_id" => $brand_id,
            "name" => $name,
            "from_hour" => $form_hour,
            "to_hour" => $to_hour,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                        <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-status="' . $config['data']['status'] . '"  data-from-hour="' . $config['data']['from_hour'] . '"  data-to-hour="' . $config['data']['to_hour'] . '" onclick="changeStatusShiftData($(this))" title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                        <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-from-hour="' . $config['data']['from_hour'] . '"  data-to-hour="' . $config['data']['to_hour'] . '" onclick="openModalUpdateShiftData($(this))" title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                    </div>';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
            return $config;
        }catch (Exception $e){
            return $this->catchTemplate($config , $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $to_hour = $request->get('to_hour');
        $from_hour = $request->get('from_hour');
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_WORKING_SESSION_UPDATE);
        $body = [
            "id" => $id,
            "name" => $name,
            "status" => $status,
            "from_hour" => $from_hour,
            "to_hour" => $to_hour,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                            <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-status="' . $config['data']['status'] . '"  data-from-hour="' . $config['data']['from_hour'] . '"  data-to-hour="' . $config['data']['to_hour'] . '" onclick="changeStatusShiftData($(this))" title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                            <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-from-hour="' . $config['data']['from_hour'] . '"  data-to-hour="' . $config['data']['to_hour'] . '" onclick="openModalUpdateShiftData($(this))" title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
            return $config;
        }catch (Exception $e){
            return $this->catchTemplate($config , $e);
        }
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CHANGE_STATUS_GET_WORKING_SESSION ,$id);
        $body = [
            "id" => $id,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try{
        if($config['status'] === ENUM_HTTP_STATUS_CODE_UPDATE){
            $data_table = DataTables::of($config['data'])
                ->addColumn('name', function ($row) {
                    return $row['name'];
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                                    <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openModalInfoEmployeeManage(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate(array($row['name']));
                })
                ->rawColumns(['action', 'name', 'keysearch'])
                ->addIndexColumn()
                ->make(true);
            $config['data'] = $data_table;
            return $config;
        }
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            if ($config['data']['status'] === ENUM_SELECTED) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                            <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-status="' . $config['data']['status'] . '"  data-from-hour="' . $config['data']['from_hour'] . '"  data-to-hour="' . $config['data']['to_hour'] . '" onclick="changeStatusShiftData($(this))" title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                            <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-from-hour="' . $config['data']['from_hour'] . '"  data-to-hour="' . $config['data']['to_hour'] . '" onclick="openModalUpdateShiftData($(this))" title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
            } else {
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                        <button class="tabledit-edit-button btn seemt-green seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-status="' . $config['data']['status'] . '"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-from-hour="' . $config['data']['from_hour'] . '"  data-to-hour="' . $config['data']['to_hour'] . '" onclick="changeStatusShiftData($(this))" title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                            </div>';
            }
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
        }
        return $config;
        }catch (Exception $e){
            return $this->catchTemplate($config , $e);
        }
    }

}
