<?php

namespace App\Http\Controllers\BuildData\Material;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class UnitDataController extends Controller
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
        $active_nav = 'Đơn vị nhập hàng';
        return view('build_data.material.unit.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $status = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_UNIT_GET_DATA, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data_enable = [];
            $data_disable = [];
            $a = 0;
            $b = 0;
            for ($i = 0; $i < count($data); $i++) {
                $collection = [];
//                $collection = collect($data[$i]['specifications'])->pluck('name')->toArray();
                for ($j = 0; $j < count($data[$i]['specifications']); $j++) {
                    array_push($collection, $data[$i]['specifications'][$j]['name'] . ' (' . $this->numberFormat($data[$i]['specifications'][$j]['exchange_value']) . ' ' . $data[$i]['specifications'][$j]['material_unit_specification_exchange_name'] . ')');
                }
                $data[$i]['specifications'] = implode(', ', $collection);
                if ($data[$i]['status'] === ENUM_SELECTED) {
                    $data_enable[$a] = $data[$i];
                    $a++;
                } else {
                    $data_disable[$b] = $data[$i];
                    $b++;
                }
            }
            $data_table_enable = DataTables::of($data_enable)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-right">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusUnitData($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateUnitData($(this))" data-id="' . $row['id'] . '" data-demo="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailUnitData($(this))" data-id="' . $row['id'] . '" data-demo="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('specifications', function ($row) {
                    return (mb_strlen($row['specifications']) > 60) ? mb_substr($row['specifications'], 0, 57) . '...' : $row['specifications'];
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['name'], $row['specifications']]);
                })
                ->rawColumns(['specifications', 'action'])
                ->addIndexColumn()
                ->make(true);
            $data_table_disable = DataTables::of($data_disable)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-right">
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green btn-success waves-effect waves-light" onclick="changeStatusUnitData($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                <button type="button" class="tabledit-edit-button seemt-btn-hover-blue btn btn-warning waves-effect waves-light" onclick="openModalDetailUnitData($(this))" data-id="' . $row['id'] . '" data-demo="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('specifications', function ($row) {
                    return (mb_strlen($row['specifications']) > 30) ? mb_substr($row['specifications'], 0, 27) . '...' : $row['specifications'];
                })
                ->addColumn('description', function ($row) {
                    return (mb_strlen($row['description']) > 30) ? mb_substr($row['description'], 0, 27) . '...' : $row['description'];
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['specifications', 'description', 'action'])
                ->addIndexColumn()
                ->make(true);

            $data_total = [
                'total_record_enable' => $this->numberFormat($a),
                'total_record_disable' => $this->numberFormat($b)
            ];
            return [$data_table_enable, $data_table_disable, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function confirmUnit(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $code = $request->get('code');
        $material_unit_id = $request->get('material_unit_id');
        $material_category_type_id = $request->get('material_category_type_id');
        $material_category_id = $request->get('material_category_id');
        $material_unit_specification_id = $request->get('material_unit_specification_id');
        $out_stock_alert_quantity = $request->get('out_stock_alert_quantity');
        $wastage_rate = $request->get('wastage_rate');
        $description = $request->get('description');
        $status = $request->get('status');
        $price = $request->get('price');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_POST_DATA, $id);
        $body = [
            'price' => $price,
            'name' => $name,
            'code' => $code,
            'material_unit_id' => $material_unit_id,
            'material_category_id' => $material_category_id,
            'material_unit_specification_id' => $material_unit_specification_id,
            'out_stock_alert_quantity' => $out_stock_alert_quantity,
            'wastage_rate' => $wastage_rate,
            'description' => sprintf($description),
            'material_category_type_id' => $material_category_type_id,
            'status' => $status,
            'exchange_current_value' => $request->get('exchange_current_value'),
            'material_unit_specification_current_id' => $request->get('material_unit_specification_current_id')
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function specifications(Request $request)
    {
        $status = ENUM_SELECTED;
        $material_unit_id = $request->get('unit');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_SPECIFICATIONS_GET_DATA, $status, $material_unit_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $collection = new Collection($config['data']);
        $data = $collection->mapToGroups(function ($item, $key) {
            return [$item['material_unit_specification_exchange_name_id'] => $item];
        });
        try {
            $data_option = '';
            $data_specifications = [];
            foreach ($data as $item) {
                foreach ($item as $select) {
                    array_push($data_specifications, $select);
                    $data_option .= '<option value="' . $select['id'] . '" data-unit-id="' . $select['material_unit_specification_exchange_name_id'] . '">' . $select['name'] . ' ' . '(' . $select['exchange_value'] . ' ' . $select['material_unit_specification_exchange_name'] . ')' . '</option>';
                }
                if ($data_option === '') {
                    $data_option = '<option value="-1" disabled hidden>' . TEXT_NULL_OPTION . '</option>';
                }
            }
            $table_specifications = DataTables::of($data_specifications)
                ->addColumn('name', function ($row) {
                    return '<label>' . $row['name'] . ' ' . '(' . $row['exchange_value'] . ' ' . $row['material_unit_specification_exchange_name'] . ')' . ' </label>';
                })
                ->addColumn('check-box', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkSpecifications($(this))" data-id="' . $row['id'] . '" data-unit-id="' . $row['material_unit_specification_exchange_name_id'] . '"><i class="fi-rr-arrow-small-right"></i></button></div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['check-box', 'name'])
                ->make(true);
            return [$data_option, $table_specifications, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function specificationsOfexchange(Request $request)
    {
        $status = ENUM_SELECTED;
        $material_unit_id = $request->get('unit');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_SPECIFICATIONS_GET_DATA, $status, $material_unit_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = collect($config['data'])->where('is_selected', ENUM_SELECTED)->all();
            $data_option = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($data as $select) {
                $data_option .= '<option value="' . $select['id'] . '" data-unit-id="' . $select['material_unit_specification_exchange_name_id'] . '" data-exchange-value="' . $select['exchange_value'] . '">' . $select['name'] . ' ' . '(' . $select['exchange_value'] . ' ' . $select['material_unit_specification_exchange_name'] . ')' . '</option>';
            }
            if ($data_option === '') {
                $data_option = '<option value="-1" disabled hidden>' . TEXT_NULL_OPTION . '</option>';
            }
            return [$data_option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }


    public function create(Request $request)
    {
        $id = ENUM_DIS_SELECTED;
        $name = $request->get('name');
        $code = $request->get('code');
        $specifications = $request->get('specifications');
        $descriptions = $request->get('description');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_UNIT_POST_CREATE, $id);
        $body = [
            "id" => $id,
            "name" => $name,
            "code" => $code,
            "specification_ids" => $specifications,
            "description" => $descriptions,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $data = $config['data']['specifications'];
                $collection = [];
                for ($j = 0; $j < count($data); $j++) {
                    array_push($collection, $data[$j]['name'] . ' (' . $this->numberFormat($data[$j]['exchange_value']) . ' ' . $data[$j]['material_unit_specification_exchange_name'] . ')');
                }
                $data_specs = implode(', ', $collection);
                $config['data']['specifications'] = (mb_strlen($data_specs) > 60) ? mb_substr($data_specs, 0, 57) . '...' : $data_specs;
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-status="' . $config['data']['status'] . '"   onclick="changeStatusUnitData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateUnitData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailUnitData($(this))" data-id="' . $config['data']['id'] . '" data-demo="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                        </div>';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_UNIT_POST_CREATE, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $config1 = $config;
        $data = $config['data'];
        $status = ENUM_SELECTED;
        $material_unit_id = $data['id'];
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_SPECIFICATIONS_GET_DATA, $status, $material_unit_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $specifications = collect($config1['data']['specifications'])->pluck('id')->toArray();
            $result = collect($config['data'])->whereIn('id', $specifications)->all();
            $resultSpecifications = [];
            foreach ($result as $value) {
                $resultSpecifications[] = $value['name'] . ' (' . $this->numberFormat($value['exchange_value']) . ' ' . $value['material_unit_specification_exchange_name'] . ')';
            }
            $config1['data']['specifications'] = implode(', ', $resultSpecifications);
            return [$config, $config1];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_UNIT_POST_CREATE, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $config1 = $config;
        $data = $config['data'];
        $status = ENUM_SELECTED;
        $material_unit_id = $data['id'];
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_SPECIFICATIONS_GET_DATA, $status, $material_unit_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_option = '';
            foreach ($config['data'] as $value) {
                if ($value['is_selected'] === ENUM_SELECTED) {
                    $data_option .= '<option selected value="' . $value['id'] . '" data-unit-id="' . $value['material_unit_specification_exchange_name_id'] . '">' . $value['name'] . ' ' . '(' . $value['exchange_value'] . ' ' . $value['material_unit_specification_exchange_name'] . ')' . '</option>';
                } else {
                    $data_option .= '<option value="' . $value['id'] . '" data-unit-id="' . $value['material_unit_specification_exchange_name_id'] . '">' . $value['name'] . ' ' . '(' . $value['exchange_value'] . ' ' . $value['material_unit_specification_exchange_name'] . ')' . '</option>';
                }
            }
            $table_specifications = DataTables::of($config['data'])
                ->addColumn('name', function ($row) {
                    return '<label>' . $row['name'] . ' ' . '(' . $row['exchange_value'] . ' ' . $row['material_unit_specification_exchange_name'] . ')' . ' </label>';
                })
                ->addColumn('check-box', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkSpecificationsUpdate($(this))" data-id="' . $row['id'] . '" data-unit-id="' . $row['material_unit_specification_exchange_name_id'] . '"><i class="fi-rr-arrow-small-right"></i></button></div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['check-box', 'name'])
                ->make(true);
            $table_specifications_selected = DataTables::of($config1['data']['specifications'])
                ->addColumn('name', function ($row) {
                    return '<label>' . $row['name'] . ' ' . '(' . $row['exchange_value'] . ' ' . $row['material_unit_specification_exchange_name'] . ')' . ' </label>';
                })
                ->addColumn('check-box', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="unCheckSpecificationsUpdate($(this))" data-id="' . $row['id'] . '" data-unit-id="' . $row['material_unit_specification_exchange_name_id'] . '"><i class="fi-rr-arrow-small-left"></i></button></div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['check-box', 'name'])
                ->make(true);
            return [$data, $data_option, $table_specifications, $table_specifications_selected, $config1, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $status = ENUM_SELECTED;
        $code = $request->get('code');
        $specifications = $request->get('specifications');
        $descriptions = $request->get('description');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_UNIT_POST_CREATE, $id);
        $body = [
            "id" => $id,
            "name" => $name,
            "code" => $code,
            "status" => $status,
            "specification_ids" => $specifications,
            "description" => $descriptions,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] == ENUM_HTTP_STATUS_CODE_UPDATE) {
                $dataTable = DataTables::of($config['data'])
                    ->addColumn('action', function ($row) {
                        return '<div class="btn-group btn-group-sm text-center">
                                 <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light d-none btn-check-change-unit " onclick="confirmUnitSpecifications($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONFIRM . '"><i class="fi-rr-check" style="font-size: 14px!important;"></i></button>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['action', 'keysearch'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data'] = $dataTable;
                return $config;
            }
            if ($config['status'] == ENUM_HTTP_STATUS_CODE_SUCCESS) {
                if ($config['data'] != null) {
                    $data_specifications = [];
                    foreach ($config['data']['specifications'] as $specifications) {
                        array_push($data_specifications,$specifications['name'] . ' (' . $this->numberFormat($specifications['exchange_value']) . ' ' .$specifications['material_unit_specification_exchange_name'] . ')');
                    }
                    $config['data']['specifications'] = implode(',', $data_specifications);
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-status="' . $config['data']['status'] . '"   onclick="changeStatusUnitData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateUnitData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailUnitData($(this))" data-id="' . $config['data']['id'] . '" data-demo="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
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
        $api = sprintf(API_MATERIAL_UNIT_POST_STATUS, $id);
        $body = null;
        $requestChangeStatus = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body,
        ];
        $status = ENUM_GET_ALL;
        $api = sprintf(API_MATERIAL_UNIT_GET_DATA, $status);
        $requestUnit = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestChangeStatus, $requestUnit]);
        try {
            if ($configAll[0]['status'] === ENUM_HTTP_STATUS_CODE_UPDATE) {
                $data_unit = $configAll[1]['data'];
                $data_table = DataTables::of($configAll[0]['data'])
                    ->addColumn('action', function ($row) {
                        return '<div class="btn-group btn-group-sm text-center">
                                     <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light d-none"
                                     onclick="confirmUnitSpecifications($(this))" data-unit="' . $row['unit_id'] . '"  data-id="' . $row['id'] . '" data-status="' . $row['status'] . '"
                                      data-category="' . $row['category_type_id'] . '" data-material-category="' . $row['material_category']['id'] . '"
                                      data-out-stock="' . $row['out_stock_alert_quantity'] . '" data-name="' . $row['name'] . '" data-code="' . $row['code'] . '"
                                      data-des="' . $row['description'] . '"  data-wastage-rate="' . $row['wastage_rate'] . '" data-price="' . $row['price'] . '"
                                      data-specification="' . $row['unit_specification_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONFIRM . '">
                                      <i class="fi-rr-check" style="font-size: 14px!important;"></i></button>
                                     <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['id'] . ')"
                                     data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                    })
                    ->addColumn('list_unit', function ($row) use ($id) {
                        $data_unit_select = '';
                        foreach ($row['material_units'] as $dataSelect) {
                            if ($dataSelect['id'] === $id) {
                                $data_unit_select .= '<option selected value="' . $dataSelect['id'] . '">' . $dataSelect['name'] . '</option>';
                            } else {
                                $data_unit_select .= '<option value="' . $dataSelect['id'] . '">' . $dataSelect['name'] . '</option>';
                            }
                        }
                        if ($data_unit_select === '') {
                            $data_unit_select = '<option value="">' . TEXT_NULL_OPTION . '</option>';
                        }
                        return '<select class="js-example-basic-single select-unit-change-status col-sm-12" data-select="1">
                                    ' . $data_unit_select . '
                                </select>';
                    })
                    ->addColumn('list_specification', function ($row) use ($data_unit, $id) {
                        $data_unit = collect($data_unit)->where('id', $id)->first();
                        $data_specifications_select = '<option selected value="' . $row['unit_specification_id'] . '" data-unit-id="' . $row['unit_id'] . '">' . $row['unit_specification_name'] . ' ' . '(' . $row['unit_specification_exchange_value'] . ' ' . $row['unit_specification_exchange_name'] . ')' . '</option>';;
                        foreach ($data_unit['specifications'] as $dataSpec) {
                            if ($row['unit_specification_id'] !== $dataSpec['id']) {
                                $data_specifications_select .= '<option value="' . $dataSpec['id'] . '" data-unit-id="' . $dataSpec['material_unit_specification_exchange_name_id'] . '" data-exchange-value="' . $dataSpec['exchange_value'] . '">' . $dataSpec['name'] . ' ' . '(' . $dataSpec['exchange_value'] . ' ' . $dataSpec['material_unit_specification_exchange_name'] . ')' . '</option>';
                            }
                        }
                        if ($data_specifications_select === '') {
                            $data_specifications_select = '<option value="">' . TEXT_NULL_OPTION . '</option>';
                        }
                        return '<select class="js-example-basic-single select-specifications-change-status col-sm-12" data-select="1">
                                    <option value="" disabled="" selected="">' . $data_specifications_select . '</option>
                                </select>';
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['action', 'name', 'list_unit', 'list_specification'])
                    ->addIndexColumn()
                    ->make(true);
//                array_push($configAll, $config);
                return [$data_table, $configAll[0]];
            }
            else if($configAll[0]['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $configAll[0]['data']['keysearch'] = $this->keySearchDatatableTemplate([$configAll[0]['data']]);
                $specifications = collect($configAll[1]['data'])->where('id', $configAll[0]['data']['id'])->first();
                if(isset($specifications)) {
                    $collection = [];
                    for ($j = 0; $j < count($specifications['specifications']); $j++) {
                        array_push($collection, $specifications['specifications'][$j]['name'] . ' (' . $this->numberFormat($specifications['specifications'][$j]['exchange_value']) . ' ' . $specifications['specifications'][$j]['material_unit_specification_exchange_name'] . ')');
                    }
                    $configAll[0]['data']['specifications'] = implode(', ', $collection);
                }
                if ($configAll[0]['data']['status'] === ENUM_SELECTED) {

                    $configAll[0]['data']['action'] = '<div class="btn-group btn-group-sm">
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-status="' . $configAll[0]['data']['status'] . '"  onclick="changeStatusUnitData($(this))" data-id="' . $configAll[0]['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateUnitData($(this))" data-id="' . $configAll[0]['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                        <button type="button" class="tabledit-edit-button seemt-btn-hover-blue btn btn-warning waves-effect waves-light" onclick="openModalDetailUnitData($(this))" data-id="' . $configAll[0]['data']['id'] . '" data-demo="' . $configAll[0]['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                </div>';
                } else {
                    $configAll[0]['data']['action'] = '<div class="btn-group btn-group-sm">
                                                        <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusUnitData($(this))" data-id="' . $configAll[0]['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                                        <button type="button" class="tabledit-edit-button seemt-btn-hover-blue btn btn-warning waves-effect waves-light" onclick="openModalDetailUnitData($(this))" data-id="' . $configAll[0]['data']['id'] . '" data-demo="' . $configAll[0]['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                       </div>';
                }
                return ['', $configAll[0]];
            }
            return $configAll[0];

        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }
}
