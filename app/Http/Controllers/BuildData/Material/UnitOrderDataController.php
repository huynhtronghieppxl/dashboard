<?php

namespace App\Http\Controllers\BuildData\Material;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class UnitOrderDataController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Đơn vị bán hàng';
        return view('build_data.material.unit_order.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_UNIT_ORDER_GET_DATA);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $dataTable = DataTables::of($config['data']['list'])
                ->addColumn('action', function ($row) {
                    if ($row['total_material_unit_map'] > 0) {
                        return '<div class="btn-group btn-group-sm text-right">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalMaterialUnitOrderData($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Danh sách nguyên liệu sử dụng"><i class="fi-rr-interlining"></i></button>
                                </div>';
                    } else {
                        return '<div class="btn-group btn-group-sm text-right">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateUnitOrderData($(this))" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalMaterialUnitOrderData($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Danh sách nguyên liệu sử dụng"><i class="fi-rr-interlining"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="deleteUnitOrderData($(this))" data-id="' . $row['id'] . '"data-toggle="tooltip" data-placement="top" data-original-title="Xóa đơn vị"><i class="fi-rr-trash"></i></button>
                            </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            return [$dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $name = $request->get('name');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_UNIT_ORDER_POST_CREATE);
        $body = [
            "name" => $name,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm text-right">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateUnitOrderData($(this))" data-id="' .  $config['data']['id'] . '"data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalMaterialUnitOrderData($(this))" data-id="' .  $config['data']['id'] . '"data-toggle="tooltip" data-placement="top" data-original-title="Danh sách nguyên liệu sử dụng"><i class="fi-rr-interlining"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="deleteUnitOrderData($(this))" data-id="' . $config['data']['id'] . '"data-toggle="tooltip" data-placement="top" data-original-title="Xóa đơn vị"><i class="fi-rr-trash"></i></button>

                                            </div>';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function material(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_UNIT_ORDER_GET_MATERIAL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $dataTable = DataTables::of($config['data'])
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-right">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['id'] . ')" data-id="' . $row['id'] . '"data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';

                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            return [$dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_UNIT_ORDER_POST_UPDATE, $id);
        $body = [
            "name" => $name,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER_VERSION;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_UNIT_ORDER_POST_DELETE, $id);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
