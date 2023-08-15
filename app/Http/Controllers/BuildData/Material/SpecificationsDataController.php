<?php

namespace App\Http\Controllers\BuildData\Material;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class SpecificationsDataController extends Controller
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
        $active_nav = 'Quy cách nhập hàng';
        return view('build_data.material.specifications.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $status = ENUM_GET_ALL;
        $material_unit_id = '';
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_SPECIFICATIONS_GET_DATA, $status, $material_unit_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data_enable = [];
            $data_disable = [];
            $a = 0;
            $b = 0;
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['status'] === ENUM_SELECTED) {
                    $data[$i]['exchange_value'] = $this->numberFormat($data[$i]['exchange_value']);
                    $data_enable[$a] = $data[$i];
                    $a++;
                } else {
                    $data[$i]['exchange_value'] = $this->numberFormat($data[$i]['exchange_value']);
                    $data_disable[$b] = $data[$i];
                    $b++;
                }
            }
            $data_table_enable = DataTables::of($data_enable)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusSpecificationsData($(this)) " data-status="' . $row['status'] . '" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateSpecificationsData($(this))" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                             </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['name'], $row['exchange_value'], $row['material_unit_specification_exchange_name']]);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            $data_table_disable = DataTables::of($data_disable)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" style="float: none;margin: 5px;" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" onclick="changeStatusSpecificationsData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['name'], $row['exchange_value'], $row['material_unit_specification_exchange_name']]);
                })
                ->rawColumns(['status', 'action'])
                ->addIndexColumn()
                ->make(true);
            $data_total = [
                'total_record_enable' => $this->numberFormat($a),
                'total_record_disable' => $this->numberFormat($b),
            ];

            return [$data_table_enable, $data_table_disable, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataServer(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = API_MATERIAL_SPECIFICATIONS_GET_DATA_SERVER;
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data_specifications = '<option value="" disabled selected hidden>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $data_specifications .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
            }
            if ($data_specifications === '') {
                $data_specifications = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$data_specifications, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function create(Request $request)
    {
        $id = ENUM_DIS_SELECTED;
        $name = $request->get('name');
        $nameEx = $request->get('name_ex');
        $valueEx = $request->get('value_ex');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_SPECIFICATIONS_POST_CREATE, $id);
        $body = [
            "name" => $name,
            "exchange_value" => $valueEx,
            "material_unit_specification_exchange_name_id" => $nameEx,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['data'] != null) {
                $config['data']['exchange_value'] = $this->numberFormat($config['data']['exchange_value']);
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusSpecificationsData($(this)) " data-status="' . $config['data']['status'] . '" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  onclick="openModalUpdateSpecificationsData($(this))" data-name="' . $config['data']['name'] . '" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                          </div>';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $api = sprintf(API_MATERIAL_SPECIFICATIONS_POST_CREATE, $id);
        $body = null;
        $requestMaterialSpecification = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $api = API_MATERIAL_SPECIFICATIONS_GET_DATA_SERVER;
        $body = null;
        $requestDataSpecification = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestMaterialSpecification, $requestDataSpecification]);
        try {
            $data_detail = $configAll[0]['data'];
            $data = $configAll[1]['data'];
            $data_specifications = '<option value="" disabled selected >' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                if ($data_detail['material_unit_specification_exchange_name_id'] === $data[$i]['id']) {
                    $data_specifications .= '<option value="' . $data[$i]['id'] . '" selected>' . $data[$i]['name'] . '</option>';
                } else {
                    $data_specifications .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
            if ($data_specifications === '') {
                $data_specifications = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }

            $data_detail['specifications'] = $data_specifications;

            return [$data_detail, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $status = $request->get('status');
        $name_ex = $request->get('name_ex');
        $value_ex = $request->get('value_ex');

        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_SPECIFICATIONS_POST_CREATE, $id);
        $body = [
            "name" => $name,
            "exchange_value" => $value_ex,
            "material_unit_specification_exchange_name_id" => $name_ex,
            "status" => $status,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['data'] != null) {
                $config['data']['exchange_value'] = $this->numberFormat($config['data']['exchange_value']);
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusSpecificationsData($(this)) " data-status="' . $config['data']['status'] . '" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  onclick="openModalUpdateSpecificationsData($(this))" data-name="' . $config['data']['name'] . '" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                          </div>';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function changeStatus(Request $request)
    {
        $id = (int)$request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_SPECIFICATIONS_POST_STATUS, $id);
        $body = [
            "id" => $id,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] == ENUM_HTTP_STATUS_CODE_UPDATE) {
                $dataUnit = collect($config['data'])->where('name', '')->toArray();
                $dataMaterial = collect($config['data'])->where('name', '!=', '')->toArray();
                $tableMaterial = $this->drawDatatableDisabledSpe($dataMaterial);
                $tableUnit = $this->drawDatatableDisabledSpe($dataUnit);
                $config['data']['table_material'] = $tableMaterial;
                $config['data']['total_material'] = $this->numberFormat(count($dataMaterial));
                $config['data']['total_unit'] = $this->numberFormat(count($dataUnit));
                $config['data']['table_unit'] = $tableUnit;
                return $config;
            } else {
                if ($config['data']['status'] === 0) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" style="float: none;margin: 5px;" data-name="' . $config['data']['name'] . '" data-id="' . $config['data']['id'] . '" onclick="changeStatusSpecificationsData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                            </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusSpecificationsData($(this)) " data-status="' . $config['data']['status'] . '" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  onclick="openModalUpdateSpecificationsData($(this))" data-name="' . $config['data']['name'] . '" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                          </div>';
                }
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                return $config;
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawDatatableDisabledSpe($data)
    {
        return DataTables::of($data)
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['name'])
            ->addIndexColumn()
            ->make(true);
    }

}
