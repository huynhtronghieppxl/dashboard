<?php

namespace App\Http\Controllers\BuildData\RevenueAndCost;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class CostDataController extends Controller
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
        $active_nav = 'Hạng mục chi';
        return view('build_data.revenue_and_cost.cost.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $status = ENUM_GET_ALL;
        $isCost = ENUM_STATUS_GET_ACTIVE;
        $isSystemAutoGenerate = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_REASON, $status, $isCost, $isSystemAutoGenerate);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $dataEnable = $collection->where('status', ENUM_SELECTED);
            $dataDisable = $collection->where('status', ENUM_DIS_SELECTED);
            $tableEnable = DataTables::of($dataEnable)
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('name', function ($row) {
                    return $row['name'];
                })
                ->addColumn('action', function ($row) {
                    if ($row['is_system_auto_generate'] === ENUM_SELECTED) {
                        return '<p class="text text-warning border-resize-datatable">' . TEXT_NOTE_REASON . '</p>';
                    } else {
                        return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusCostData($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateCostData($(this))" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
                    }
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'name'])
                ->make(true);
            $tableDisable = DataTables::of($dataDisable)
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('name', function ($row) {
                    return $row['name'];
                })
                ->addColumn('action', function ($row) {
                    if ($row['is_system_auto_generate'] === ENUM_SELECTED) {
                        return '<p class="text text-warning border-resize-datatable">' . TEXT_NOTE_REASON . '</p>';
                    } else {
                        return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn  seemt-green seemt-btn-hover-blue waves-effect waves-light" onclick="changeStatusCostData($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateCostData($(this))" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
                    }
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'name'])
                ->make(true);
            $count = [
                'recordEnable' => $this->numberFormat(count($dataEnable)),
                'recordDisable' => $this->numberFormat(count($dataDisable))
            ];
            return [$tableEnable, $tableDisable, $count, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataType(Request $request)
    {
        $isCost = ENUM_SELECTED;
        $isAuto = ENUM_DIS_SELECTED;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_ADDITION_REASON_GET_ALL_TYPE, $isCost, $isAuto);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $collection = collect($data);
            $data_revenue = $collection->where('is_cost', ENUM_SELECTED)->all();
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
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_ADDITION_FEE_REASON_POST_CHANGE_STATUS, $id);
        $body = [
            "id" => $id,
            "confirmed" => $request->get('confirmed') ?: 0
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_CONFIRM_SUPPLIER) {
                $dataTable = DataTables::of($config['data'])
                    ->addColumn('code', function ($row) {
                            return $row['code'];
                        })
                    ->addColumn('action', function ($row) {
                            return '<div class="btn-group btn-group-sm text-center">
                                    <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openModalDetailPaymentBill(' . $row['id'] . ')" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><span class="icofont icofont-eye-alt"></span></button>
                                </div>';
                        })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data'] = $dataTable;
                return $config;
            }
            else if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                try {
                    if ($config['data']['status'] === ENUM_SELECTED) {
                        $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusCostData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateCostData($(this))" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                     </div>';
                    } else {
                        $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                        <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-blue waves-effect waves-light" onclick="changeStatusCostData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateCostData($(this))" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                     </div>';
                    }
                    $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                    return $config;
                } catch (Exception $e) {
                    return $this->catchTemplate($config, $e);
                }
            } else {
                return $config;
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $name = $request->get('name');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_ADDITION_FEE_REASON_POST_RECEIPT_EXPENSES_LIST);
        $body = [
            "id" => 0,
            'name' => $name,
            'is_cost' => ENUM_SELECTED,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try{
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusCostData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateCostData($(this))" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '"   data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
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
        $type = $request->get('type');
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_ADDITION_FEE_REASON_POST_RECEIPT_EXPENSES_LIST);
        $body = [
            "id" => $id,
            "name" => $name,
            "status" => $status,
            'is_cost' => ENUM_SELECTED,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                if ($config['data']['status'] === ENUM_SELECTED) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusCostData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateCostData($(this))" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                             </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                        <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-blue waves-effect waves-light" onclick="changeStatusCostData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateCostData($(this))" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
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
