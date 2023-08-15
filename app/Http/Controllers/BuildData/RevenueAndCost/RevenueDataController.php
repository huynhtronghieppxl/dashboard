<?php

namespace App\Http\Controllers\BuildData\RevenueAndCost;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class RevenueDataController extends Controller
{
    public function index()
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
        $active_nav = 'Hạng mục thu';
        return view('build_data.revenue_and_cost.revenue.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $status = ENUM_GET_ALL;
        $is_cost = ENUM_STATUS_OPENING;
        $is_system_auto_generate = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_REASON, $status, $is_cost, $is_system_auto_generate);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $dataEnable = $collection->where('status', ENUM_SELECTED)->all();
            $dataDisable = $collection->where('status', ENUM_DIS_SELECTED)->all();
            $tableEnable = DataTables::of($dataEnable)
                ->addColumn('name', function ($row) {
                    return $row['name'];
                })
                ->addColumn('action', function ($row) {
                    if ($row['is_system_auto_generate'] === ENUM_SELECTED) {
                        return '<p class="text text-warning border-resize-datatable">' . TEXT_NOTE_REASON . '</p>';
                    } else {
                        return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusRevenueData($(this)) " data-status="' . $row['status'] . '" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateRevenueData($(this))" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '">
                            <i class="fi-rr-pencil" ></i></button>
                       </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'name'])
                ->make(true);
            $tableDisable = DataTables::of($dataDisable)
                ->addColumn('name', function ($row) {
                    return $row['name'];
                })
                ->addColumn('action', function ($row) {
                    if ($row['is_system_auto_generate'] === ENUM_SELECTED) {
                        return '<p class="text text-warning border-resize-datatable">' . TEXT_NOTE_REASON . '</p>';
                    } else {
                        return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-blue waves-effect waves-light" onclick="changeStatusRevenueData($(this))" data-status="' . $row['status'] . '" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateRevenueData($(this))" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '">
                                    <i class="fi-rr-pencil"></i></button>
                       </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'name'])
                ->make(true);
            $count = [
                'recordEnable' => $this->numberFormat($collection->where('status', ENUM_SELECTED)->count()),
                'recordDisable' => $this->numberFormat($collection->where('status', ENUM_DIS_SELECTED)->count())
            ];
            return [$tableEnable, $tableDisable, $count, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataType(Request $request)
    {
        $isCost = ENUM_DIS_SELECTED;
        $isAuto = ENUM_DIS_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_ADDITION_REASON_GET_ALL_TYPE, $isCost, $isAuto);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $collection = collect($data);
            $data_revenue = $collection->where('is_cost', ENUM_DIS_SELECTED)->all();
            $data_option = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($data_revenue as $data) {
                $data_option .= '<option value="' . $data['id'] . '" data-is_cost="' . $data['is_cost'] . '">' . $data['name'] . '</option>';
            }
            return [$data_option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_ADDITION_FEE_REASON_POST_CHANGE_STATUS, $id);
        $body = [
            "id" => $id,
            'name' => ""
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                if ($config['data']['status'] === ENUM_SELECTED) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusRevenueData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateRevenueData($(this))" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil" ></i></button>
                                            </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-blue waves-effect waves-light" onclick="changeStatusRevenueData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateRevenueData($(this))" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                             </div>';
                }
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $name = $request->get('name');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_ADDITION_FEE_REASON_POST_RECEIPT_EXPENSES_LIST);
        $body = [
            "id" => ENUM_DIS_SELECTED,
            'name' => $name,
            "is_cost" => ENUM_DIS_SELECTED,
            "status" => 0,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusRevenueData($(this)) " data-status="' . $config['data']['status'] . '" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateRevenueData($(this))" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-toggle="tooltip" data-placement="bottom" data-original-title="' . TEXT_UPDATE . '">
                                            <i class="fi-rr-pencil" ></i></button>
                                       </div>';
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_ADDITION_FEE_REASON_POST_RECEIPT_EXPENSES_LIST);
        $body = [
            "id" => $id,
            "name" => $name,
            "status" => $status,
            "is_cost" => ENUM_DIS_SELECTED,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                if ($config['data']['status'] === ENUM_SELECTED) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusRevenueData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateRevenueData($(this))" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button> </button>
                                     </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                        <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-blue waves-effect waves-light" onclick="changeStatusRevenueData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateRevenueData($(this))" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil" ></i></button></button>
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
