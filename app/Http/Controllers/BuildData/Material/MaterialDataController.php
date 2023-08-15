<?php

namespace App\Http\Controllers\BuildData\Material;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class MaterialDataController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            return view('errors.403');
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = TEXT_MATERIAL;
        return view('build_data.material.material.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $status = ENUM_GET_ALL;
        $category = ENUM_GET_ALL;
        $typeParentID = '';
        $typeID = $request->get('type_id');

        $isSupplier = ENUM_GET_ALL;
        $supplierID = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_GET_LIST_RESTAURANT_2, $supplierID, $category, $status, $typeParentID, $typeID, $isSupplier);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $dataEnable = collect($config['data'])->where('status', ENUM_SELECTED);

            $dataDisable = array_values(collect($config['data'])->where('status', ENUM_DIS_SELECTED)->toArray());

            $dataMaterial = array_values($dataEnable->where('category_type_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_MATERIAL)->toArray());
            $dataGoods = array_values($dataEnable->where('category_type_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_GOODS)->toArray());
            $dataMaterialInternal = array_values($dataEnable->where('category_type_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_INTERNAL)->toArray());
            $dataOther = array_values($dataEnable->where('category_type_parent_id', ENUM_MATERIAL_CATEGORY_PARENT_OTHER)->toArray());


            $dataTableMaterial = $this->drawTableMaterial($dataMaterial);
            $dataTableGoods = $this->drawTableMaterial($dataGoods);
            $dataTableMaterialInternal = $this->drawTableMaterial($dataMaterialInternal);
            $dataTableOther = $this->drawTableMaterial($dataOther);
            $dataTableOff = $this->drawTableMaterial($dataDisable);

            $dataTotal = [
                'total_material' => $this->numberFormat(count($dataMaterial)),
                'total_goods' => $this->numberFormat(count($dataGoods)),
                'total_material_internal' => $this->numberFormat(count($dataMaterialInternal)),
                'total_other' => $this->numberFormat(count($dataOther)),
                'total_off' => $this->numberFormat(count($dataDisable)),
            ];
            return [$dataTableMaterial, $dataTableGoods, $dataTableMaterialInternal, $dataTableOther, $dataTableOff, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTableMaterial($data)
    {
        return DataTables::of($data)
            ->addColumn('price', function ($row) {
                return $this->numberFormat($row['price']);
            })
            ->addColumn('material_category.name', function ($row) {
                return mb_strlen($row['material_category']['name']) > 30 ? mb_substr($row['material_category']['name'], 0, 27) . '...' : $row['material_category']['name'];
            })
            ->addColumn('name', function ($row) {
                $unitName = '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">' . $row['unit_full_name'] . '</label>
                            </div>';
                if (mb_strlen($row['name']) > 30) {
                    return mb_substr($row['name'], 0, 27) . '...' . '<br>' . $unitName;
                } else {
                    return $row['name'] . '<br>' . $unitName;
                }
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate([$row['name'], $row['material_category']['name'], $row['price'], $row['category_type_name'], $row['unit_full_name']]);
            })
            ->addColumn('is_office_material', function ($row) {
                if ($row['is_office_material'] == 1) {
                    return '<div class="btn-group btn-group-sm  "><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title=""   ></i></div>';
                } else {
                    return '<div class="btn-group btn-group-sm  "><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title=""      ></i></div>';
                }
            })
            ->addColumn('action', function ($row) {
                if ($row['status'] === ENUM_SELECTED) {
                    return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusMaterialData($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-inventory="' . $row['category_type_parent_name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateMaterialData($(this))" data-id="' . $row['id'] . '" data-unit="' . $row['material_unit_current_id'] . '" data-specification-exchang-id="' . $row['unit_specification_exchange_id'] . '"  data-specification="' . $row['unit_specification_name'] . '" data-name="' . $row['material_unit_current_name'] . '" data-type="' . $row['category_type_parent_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                } else {
                    return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusMaterialData($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-inventory="' . $row['category_type_parent_name'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateMaterialData($(this))" data-id="' . $row['id'] . '" data-unit="' . $row['material_unit_current_id'] . '" data-specification-exchang-id="' . $row['unit_specification_exchange_id'] . '" data-specification="' . $row['unit_full_name'] . '" data-name="' . $row['material_unit_current_name'] . '" data-type="' . $row['category_type_parent_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                }
            })
            ->rawColumns(['status', 'name', 'action', 'is_office_material'])
            ->addIndexColumn()
            ->make(true);
    }

    public function category(Request $request)
    {
        $status = ENUM_SELECTED;
        $inventory = $request->get('inventory');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_GET_CATEGORY, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $dataCategory = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['material_category_type_parent_id'] === (int)$inventory) {
                    $dataCategory .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
            if ($dataCategory === '') {
                $dataCategory = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$dataCategory, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function unit(Request $request)
    {
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_UNIT_GET_DATA, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $dataUnit = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $dataUnit .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
            }
            if ($dataUnit === '') {
                $dataUnit = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$dataUnit, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function unitOrder(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_UNIT_ORDER_GET_DATA);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $dataUnitOrder = '<option value="-1" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $dataUnitOrder .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
            }
            if ($dataUnitOrder === '') {
                $dataUnitOrder = '<option value="-1">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$dataUnitOrder, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function specifications(Request $request)
    {
        $unit = $request->get('unit');
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_SPECIFICATIONS_GET_DATA, $status, $unit);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $dataSpecifications = '';
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['is_selected'] === ENUM_SELECTED) {
                    $dataSpecifications .= '<option value="' . $data[$i]['id'] . '" data-unit-exchange-name="' . $data[$i]['material_unit_specification_exchange_name'] . '" data-unit-exchange-id="' . $data[$i]['material_unit_specification_exchange_name_id'] . '"  data-unit-value="' . $data[$i]['exchange_value'] . '" data-unit-id="' . $data[$i]['material_unit_specification_exchange_name_id'] . '">' . $data[$i]['name'] . ' ( ' . $data[$i]['exchange_value'] . ' ' . $data[$i]['material_unit_specification_exchange_name'] . ')</option>';
                }
            }
            if ($dataSpecifications === '') {
                $dataSpecifications = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$dataSpecifications, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function unitFoodMap(Request $request)
    {
        $restaurantMaterialID = $request->get('restaurant_material_id');
        $restaurantBrandID = ENUM_GET_ALL;
        $materialUnitID = ENUM_GET_ALL;
        $materialUnitSpecificationExchangeNameID = ENUM_GET_ALL;
        $projectID = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_INVENTORY_GET_MATERIAL_UNIT_FOOD_MAPS2, $restaurantBrandID, $materialUnitID, $restaurantMaterialID, $materialUnitSpecificationExchangeNameID);
        $body = null;
        $config = $this->callApiGatewayTemplate($projectID, $method, $api, $body);
        try {
            $dataTable = DataTables::of($config['data'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('rate', function ($row) {
                    return API_MATERIAL_NOT_FOUND;
                })
                ->rawColumns([])
                ->addIndexColumn()
                ->make();
            return [$dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function supplier(Request $request)
    {
        $isTakeMySupplier = ENUM_SELECTED;
        $isRestaurantSupplier = ENUM_GET_ALL;
        $isExcludeUnassignSystemSupplier = ENUM_GET_ALL;
        $status = ENUM_SELECTED;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $projectID = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_GET_ALL_SUPPLIER, $isTakeMySupplier, $isRestaurantSupplier, $isExcludeUnassignSystemSupplier, $page, $limit, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($projectID, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $option = '<option disabled selected value="">' . TEXT_NULL_OPTION . '</option>';
            if (!empty($data)) {
                $option = '<option disabled selected value="" >' . TEXT_DEFAULT_OPTION . '</option>';
                foreach ($data as $db) {
                    $option .= '<option value="' . $db['id'] . '" >' . $db['name'] . '</option>';
                }
            }
            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function materialSupplier(Request $request)
    {
        $supplierID = $request->get('supplier');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_GET_SUPPLIER_MAP_IN_RESTAURANT, $supplierID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = collect($config['data']);
            $dataDisSelected = $data->where('restaurant_material_id', ENUM_DIS_SELECTED)->all();
            $option = '<option disabled selected value="">' . TEXT_NULL_OPTION . '</option>';
            if (!empty($dataDisSelected)) {
                $option = '<option disabled selected value="">' . TEXT_DEFAULT_OPTION . '</option>';
                foreach ($dataDisSelected as $db) {
                    $option .= '<option value="' . $db['supplier_material_id'] . '" data-unit="' . $db['supplier_material_unit_full_name'] . '" data-unit-specification="' . $db['supplier_material_unit_specification_name'] . '">' . $db['supplier_material_name'] . '</option>';
                }
            }
            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $supplier = $request->get('supplier');
        $id = ENUM_DIS_SELECTED;
        $name = $request->get('name');
        $code = $request->get('code');
        $price = $request->get('price');
        $materialUnitID = $request->get('material_unit_id');
        $materialCategoryTypeID = $request->get('material_category_type_id');
        $materialUnitSpecificationID = $request->get('material_unit_specification_id');
        $materialCategoryID = $request->get('material_category_id');
        $outStockAlertQuantity = $request->get('out_stock_alert_quantity');
        $wastageRate = $request->get('wastage_rate');
        $description = $request->get('description');
        $status = $request->get('status');
        $isOfficeMaterial = $request->get('is_office_material');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_POST_DATA, $id);
        $body = [
            'price' => $price,
            'name' => $name,
            'code' => $code,
            'material_unit_id' => $materialUnitID,
            'material_unit_specification_id' => $materialUnitSpecificationID,
            'material_category_id' => $materialCategoryID,
            'out_stock_alert_quantity' => $outStockAlertQuantity,
            'wastage_rate' => $wastageRate,
            'description' => $description,
            'material_category_type_id' => $materialCategoryTypeID,
            'status' => $status,
            'is_office_material' => $isOfficeMaterial
        ];

        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusMaterialData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-inventory="' . $config['data']['category_type_parent_name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateMaterialData($(this))" data-unit="' . $config['data']['material_unit_current_id'] . '" data-specification-exchang-id="' . $config['data']['unit_specification_exchange_id'] . '" data-specification="' . $config['data']['unit_specification_name'] . '" data-name="' . $config['data']['material_unit_current_name'] . '"  data-id="' . $config['data']['id'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' . $config['data']['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                        </div>';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $config['data']['price'] = $this->numberFormat($config['data']['price']);
                $config['data']['material_category']['name'] =  mb_strlen($config['data']['material_category']['name']) > 30 ? mb_substr($config['data']['material_category']['name'], 0, 27) . '...' : $config['data']['material_category']['name'];

                if ($config['data']['is_office_material'] == 1) {
                    $config['data']['is_office_material'] = '<div class="btn-group btn-group-sm  "><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title=""   ></i></div>';
                } else {
                    $config['data']['is_office_material'] = '<div class="btn-group btn-group-sm  "><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title=""      ></i></div>';
                }

                $unitName = '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                            <i class="fi-rr-hastag"></i>
                            <label class="m-0">' . $config['data']['unit_full_name'] . '</label>
                        </div>';
                if (mb_strlen($config['data']['name']) > 30) {
                    $config['data']['name'] = mb_substr($config['data']['name'], 0, 27) . '...' . '<br>' . $unitName;
                } else {
                    $config['data']['name'] = $config['data']['name'] . '<br>' . $unitName;
                }

                $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
                $method = ENUM_METHOD_POST;
                $api = sprintf(API_MATERIAL_POST_MATERIAL_UNIT_ORDER_FOOD);
                $data = $request->get('data_unit');
                $body = [
                    'restaurant_material_id' => $config['data']['id'],
                    'material_unit_quantifications' => $data,
                ];
                $config4 = $this->callApiGatewayTemplate($project, $method, $api, $body);
            }
            if ($supplier !== null && $config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $config2 = '';
                $config3 = [];
                try {
                    $supplierMaterial = $request->get('supplier_material');
                    $rate = $request->get('rate');
                    $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
                    $method = ENUM_METHOD_POST;
                    $api = sprintf(API_SUPPLIER_POST_MAP_MATERIAL_RESTAURANT_MANAGE);
                    $body = [
                        "supplier_id" => $supplier,
                        "material_insert_json" => [[
                            'supplier_material_id' => $supplierMaterial,
                            'restaurant_material_id' => $config['data']['id'],
                            'material_unit_conversion_rate' => $rate
                        ]],
                        "material_update_json" => [],
                        "material_delete_json" => []
                    ];
                    $config2 = $this->callApiGatewayTemplate($project, $method, $api, $body);
                    $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
                    $method = ENUM_METHOD_POST;
                    $api = sprintf(API_MATERIAL_POST_MAP_DATA_ASSIGN_TO_BRAND);
                    $body = [
                        "material_insert_ids" => [$config['data']['id']],
                        "material_delete_ids" => [],
                    ];
                    array_push($config3, $this->callApiGatewayTemplate($project, $method, $api, $body));
                    return [$config, $config2, $config3, $config4];
                } catch (Exception $e) {
                    return $this->catchTemplate([$config, $config2, $config3, $config4], $e);
                }
            } else {
                return [$config];
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $status = ENUM_SELECTED;
        $api = sprintf(API_MATERIAL_POST_DATA, $id);
        $body = null;
        $requestdataMaterial = [
            'project' => $project,
            'method' => $method,
            'api' => $api,
            'body' => $body
        ];
        $api = sprintf(API_INVENTORY_GET_MATERIAL_UNIT_ORDER_FOOD, $id);
        $requestListUnit = [
            'project' => $project,
            'method' => $method,
            'api' => $api,
            'body' => $body
        ];
        $api = sprintf(API_MATERIAL_GET_CATEGORY, $status);
        $requestListCategory = [
            'project' => $project,
            'method' => $method,
            'api' => $api,
            'body' => $body
        ];
        $api = sprintf(API_MATERIAL_UNIT_GET_DATA, $status);
        $requestMaterialUnitGet = [
            'project' => $project,
            'method' => $method,
            'api' => $api,
            'body' => $body
        ];
        $api = sprintf(API_MATERIAL_UNIT_ORDER_GET_DATA);
        $requestMaterialUnitOrder = [
            'project' => $project,
            'method' => $method,
            'api' => $api,
            'body' => $body
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestdataMaterial, $requestListUnit, $requestListCategory, $requestMaterialUnitGet, $requestMaterialUnitOrder]);
        try {
            $config1 = $configAll[0];
            $dataDetail = [
                'code' => $config1['data']['code'],
                'name' => $config1['data']['name'],
                'category_id' => $config1['data']['material_category']['id'],
                'unit' => $config1['data']['unit_id'],
                'unit_current_id' => $config1['data']['material_unit_current_id'],
                'unit_specification_current_id' => $config1['data']['material_unit_specification_current_id'],
                'specifications' => $config1['data']['unit_specification_id'],
                'price' => $this->numberFormat($config1['data']['price']),
                'status' => $config1['data']['status'],
                'out_stock' => $this->numberFormat($config1['data']['out_stock_alert_quantity']),
                'wastage_rate' => $config1['data']['wastage_rate'],
                'description' => $config1['data']['description'],
                'category_type_id' => $config1['data']['category_type_id'],
                'category_type_parent_id' => $config1['data']['category_type_parent_id'],
                'unit_specification_exchange_id' => $config1['data']['unit_specification_exchange_id'],
                'is_updated' => $config1['data']['is_updated'],
                'exchange_current_value' => $this->numberFormat($config1['data']['exchange_current_value']),
                'unit_specification_exchange_value' => $this->numberFormat($config1['data']['unit_specification_exchange_value']),
                'is_office_material' => $config1['data']['is_office_material'],
            ];
            $config2 = $configAll[2];
            $data = $configAll[2]['data'];
            $dataCategory = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                if ($dataDetail['category_type_parent_id'] === $data[$i]['material_category_type_parent_id']) {
                    if ($data[$i]['id'] === $dataDetail['category_id']) {
                        $dataCategory .= '<option value="' . $data[$i]['id'] . '" selected>' . $data[$i]['name'] . '</option>';
                    } else {
                        $dataCategory .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                    }
                }
            }
            if ($dataCategory === '') {
                $dataCategory = '<option value="" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            }
            $config3 = $configAll[3];
            $data = $configAll[3]['data'];
            $dataUnit = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            if ($dataDetail['is_updated']) {
                foreach ($data as $db) {
                    $listSpec = collect($db['specifications'])->pluck('material_unit_specification_exchange_name_id')->toArray();
                    if (in_array($dataDetail['unit_specification_exchange_id'], $listSpec)) {
                        if ($db['id'] === $dataDetail['unit']) {
                            $dataUnit .= '<option value="' . $db['id'] . '" selected>' . $db['name'] . '</option>';
                        } else {
                            $dataUnit .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                        }
                    }
                }
            } else {
                foreach ($data as $db) {
                    if ($db['id'] === $dataDetail['unit']) {
                        $dataUnit .= '<option value="' . $db['id'] . '" selected>' . $db['name'] . '</option>';
                    } else {
                        $dataUnit .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                    }
                }
            }
            if ($dataUnit === '') {
                $dataUnit = '<option value="" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            }
            $dataUnitQuantity = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($data as $db) {
                $dataUnitQuantity .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }

            if ($dataUnit === '') {
                $dataUnitQuantity = '<option value="" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            }
            $unit = $dataDetail['unit'];
            $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
            $method = ENUM_METHOD_GET;
            $api = sprintf(API_MATERIAL_SPECIFICATIONS_GET_DATA, $status, $unit);
            $body = null;
            $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
            $config4 = $config;
            $data = $config['data'];
            $dataSpecifications = '';
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['id'] === $dataDetail['specifications']) {
                    $dataSpecifications .= '<option value="' . $data[$i]['id'] . '" selected>' . $data[$i]['name'] . '</option>';
                } else {
                    $dataSpecifications .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
            if ($dataSpecifications === '') {
                $dataSpecifications = '<option value="" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            }
            $dataTable = DataTables::of($configAll[1]['data'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('exchange_value', function ($row) {
                    return $this->numberFormat($row['exchange_value']);
                })
                ->addColumn('price', function ($row) use ($config1) {
                    $price = $this->numberFormat(round($this->removeNumberFormat($config1['data']['price']) / $this->removeNumberFormat($config1['data']['unit_specification_exchange_value']) * $this->removeNumberFormat($row['exchange_value'])));
                    return $price;
                })
                ->addColumn('rate', function ($row) use ($config1) {
                    return '1 ' . $row['name'] . ' = ' . $this->numberFormat($row['exchange_value']) . ' ' . $config1['data']['unit_specification_exchange_name'];
                })
                ->addColumn('action', function ($row) use ($config1) {
                    $rate = '1 ' . $row['name'] . ' = ' . $this->numberFormat($row['exchange_value']) . ' ' . $config1['data']['unit_specification_exchange_name'];
                    return '<div class="btn-group btn-group-sm float-right">
                                    <button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light custom-button-not-update" onclick="deleteMaterialUnitFoodData($(this))" data-id="' . $row['id'] . '"  data-unit="' . $row['material_unit_quantification_material_map_id'] . ' " data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_REMOVE . '" data-is-save="1"><i class="fi-rr-trash"></i></button>
                                    <button type="button" id="btn-update-unit-order" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light custom-button-not-update" onclick="updateStatusMaterialUnitFoodData($(this))" data-id="' . $row['id'] . '" data-unit="' . $row['material_unit_quantification_material_map_id'] . ' " data-exchange="' . $row['exchange_value'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                    <button type="button"   class="d-none tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light custom-button-update" onclick="removeStatusMaterialUnitFoodData($(this))" data-id="' . $row['id'] . '" data-unit="' . $row['material_unit_quantification_material_map_id'] . '" data-exchange="' . $row['exchange_value'] . '" data-rate="' . $rate . '"  data-toggle="tooltip" data-placement="top" data-original-title="Huỷ"><i class="fi-rr-cross"></i></button>
                                    <button type="button"   class="d-none tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light custom-button-update btn-confirm-status-update-material-unit-sale" id="" onclick="confirmStatusMaterialUnitFoodData($(this))" data-id="' . $row['id'] . '" data-unit="' . $row['material_unit_quantification_material_map_id'] . '"   data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONFIRM . '"><i class="fi-rr-check"></i></button>
                                </div>';
                })
                ->rawColumns([])
                ->addIndexColumn()
                ->make();
            $data = $configAll[4]['data']['list'];
            $dataUnitOrder = '<option value="-1" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            $data = $this->compareTwoArrayTemplate($data, $configAll[1]['data'], 'id', 'id');
            for ($i = 0; $i < count($data); $i++) {
                $dataUnitOrder .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
            }
            if ($dataUnitOrder === '') {
                $dataUnitOrder = '<option value="-1">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$dataDetail, $dataCategory, $dataUnit, $dataSpecifications, $dataTable, $dataUnitQuantity, $dataUnitOrder, $config1, $config2, $config3, $config4];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function unitFoodUpdate(Request $request)
    {
        $id = $request->get('id');
        $materialUnitID = $request->get('unit');
        $exchangeValue = $request->get('exchange');
        $isConfirmed = $request->get('is_confirmed');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_UPDATE_UNIT_ORDER_FOOD_MAPS, $id);
        $body = [
            "id" => $materialUnitID,
            "exchange_value" => $exchangeValue,
            "is_confirmed" => $isConfirmed
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $code = $request->get('code');
        $materialUnitID = $request->get('material_unit_id');
        $materialCategoryTypeID = $request->get('material_category_type_id');
        $materialCategoryID = $request->get('material_category_id');
        $materialUnitSpecificationID = $request->get('material_unit_specification_id');
        $outStockAlertQuantity = $request->get('out_stock_alert_quantity');
        $wastageRate = $request->get('wastage_rate');
        $description = $request->get('description');
        $status = $request->get('status');
        $price = $request->get('price');
        $materialUnitSpecificationCurrentID = $request->get('material_unit_specification_current_id');
        $exchangeCurrentValue = $request->get('exchange_current_value');
        $isOfficeMaterial = $request->get('is_office_material');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_POST_DATA, $id);
        $body = [
            'price' => $price,
            'name' => $name,
            'code' => $code,
            'material_unit_id' => $materialUnitID,
            'material_category_id' => $materialCategoryID,
            'material_unit_specification_id' => $materialUnitSpecificationID,
            'out_stock_alert_quantity' => $outStockAlertQuantity,
            'wastage_rate' => $wastageRate,
            'description' => $description,
            'material_category_type_id' => $materialCategoryTypeID,
            'status' => $status,
            'material_unit_specification_current_id' => $materialUnitSpecificationCurrentID,
            'exchange_current_value' => $this->removeNumberFormat($exchangeCurrentValue),
            'is_office_material' => $isOfficeMaterial
        ];

        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] !== ENUM_HTTP_STATUS_CODE_SUCCESS) {
                return $config;
            }
            $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusMaterialData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-inventory="' . $config['data']['category_type_parent_name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateMaterialData($(this))" data-id="' . $config['data']['id'] . '" data-unit="' . $config['data']['material_unit_current_id'] . '" data-specification-exchang-id="' . $config['data']['material_unit_specification_current_id'] . '"  data-specification="' . $config['data']['unit_full_name'] . '" data-name="' . $config['data']['material_unit_current_name'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' . $config['data']['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_UPDATE) {
                $dataTable = DataTables::of($config['data'])
                    ->addColumn('supplier_name', function ($row) {
                        return $row['supplier_name'];
                    })
                    ->addColumn('action', function ($row) {
                        if ($row['is_supplier_order'] === ENUM_SELECTED) {
                            return '<div class="btn-group btn-group-sm text-center">
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
                        } else {
                            return '<div class="btn-group btn-group-sm text-center">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRestaurantSupplierOrder(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
                        }
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['action', 'supplier_name'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data'] = $dataTable;
                return $config;
            }

            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $unitName = '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                 <i class="fi-rr-hastag"></i>
                                <label class="m-0">' . $config['data']['unit_full_name'] . '</label>
                            </div>';
                if (mb_strlen($config['data']['name']) > 30) {
                    $config['data']['name'] = mb_substr($config['data']['name'], 0, 27) . '...' . '<br>' . $unitName;
                } else {
                    $config['data']['name'] = $config['data']['name'] . '<br>' . $unitName;
                }
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $config['data']['price'] = $this->numberFormat($config['data']['price']);
                if ($config['data']['is_office_material'] == 1) {
                    $config['data']['is_office_material'] = '<div class="btn-group btn-group-sm  "><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title=""   ></i></div>';
                } else {
                    $config['data']['is_office_material'] = '<div class="btn-group btn-group-sm  "><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title=""      ></i></div>';
                }
                if (mb_strlen($config['data']['material_category']['name']) > 30) {
                    $config['data']['material_category']['name'] = mb_substr($config['data']['material_category']['name'], 0, 27);
                }
                if ($config['data']['status'] === ENUM_SELECTED) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusMaterialData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-inventory="' . $config['data']['category_type_parent_name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateMaterialData($(this))" data-id="' . $config['data']['id'] . '" data-unit="' . $config['data']['material_unit_current_id'] . '" data-specification-exchang-id="' . $config['data']['unit_specification_exchange_id'] . '"  data-specification="' . $config['data']['unit_specification_name'] . '" data-name="' . $config['data']['material_unit_current_name'] . '" data-type="' . $config['data']['category_type_parent_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' . $config['data']['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusMaterialData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-inventory="' . $config['data']['category_type_parent_name'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateMaterialData($(this))" data-id="' . $config['data']['id'] . '" data-unit="' . $config['data']['material_unit_current_id'] . '" data-specification-exchang-id="' . $config['data']['unit_specification_exchange_id'] . '" data-specification="' . $config['data']['unit_full_name'] . '" data-name="' . $config['data']['material_unit_current_name'] . '" data-type="' . $config['data']['category_type_parent_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' . $config['data']['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                }
                $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
                $method = ENUM_METHOD_POST;
                $api = sprintf(API_MATERIAL_POST_MATERIAL_UNIT_ORDER_FOOD);
                $data = $request->get('data_unit');
                $body = [
                    'restaurant_material_id' => $config['data']['id'],
                    'material_unit_quantifications' => $data,
                ];
                array_push($config, $this->callApiGatewayTemplate($project, $method, $api, $body));
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->post('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_POST_DATA, $id);
        $body = null;
        $requestInfoMaterial = [
            'project' => $project,
            'method' => $method,
            'api' => $api,
            'body' => $body
        ];
        $api = sprintf(API_INVENTORY_GET_MATERIAL_UNIT_ORDER_FOOD, $id);
        $requestMaterialUnitOrderGet = [
            'project' => $project,
            'method' => $method,
            'api' => $api,
            'body' => $body
        ];
        $api = sprintf(API_INVENTORY_GET_MATERIAL_UNIT_ORDER_FOOD, $id);
        $requestListUnit = [
            'project' => $project,
            'method' => $method,
            'api' => $api,
            'body' => $body
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestInfoMaterial, $requestMaterialUnitOrderGet, $requestListUnit]);
        try {
            if ($configAll[0]['data']['status'] === 0) {
                $status = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_DISABLE_STATUS . '</label>
                            </div>';
            } else {
                $status = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_STATUS_ENABLE . '</label>
                            </div>';
            }
            $config1 = $configAll[0];
            $dataTable = DataTables::of($configAll[2]['data'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('exchange_value', function ($row) {
                    return $this->numberFormat($row['exchange_value']);
                })
                ->addColumn('price', function ($row) use ($config1) {
                    $price = $this->numberFormat(round($this->removeNumberFormat($config1['data']['price']) / $this->removeNumberFormat($config1['data']['unit_specification_exchange_value']) * $this->removeNumberFormat($row['exchange_value'])));
                    return $price;
                })
                ->addColumn('rate', function ($row) use ($config1) {
                    return '1 ' . $row['name'] . ' = ' . $this->numberFormat($row['exchange_value']) . ' ' . $config1['data']['unit_specification_exchange_name'];
                })
                ->rawColumns([])
                ->addIndexColumn()
                ->make();
            $data = [
                'code' => $configAll[0]['data']['code'],
                'name' => $configAll[0]['data']['name'],
                'category_name' => $configAll[0]['data']['material_category']['name'] ,
                'category_id' => $configAll[0]['data']['material_category']['id'],
                'unit' => $configAll[0]['data']['unit_name'],
                'specifications' => $configAll[0]['data']['unit_full_name'],
                'price' => $this->numberFormat($configAll[0]['data']['price']),
                'status_text' => $configAll[0],
                'status' => $configAll[0]['data']['status'],
                'out_stock' => $this->numberFormat($configAll[0]['data']['out_stock_alert_quantity']),
                'wastage_rate' => $configAll[0]['data']['wastage_rate'],
                'description' => $configAll[0]['data']['description'],
                'category_type_name' => $configAll[0]['data']['category_type_name'],
            ];

            return [$data, $dataTable, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $isConfirmed = $request->get('is_confirmed');
        if ($request->get('status') === ENUM_DIS_SELECTED) {
            $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
            $method = ENUM_METHOD_POST;
            $api = sprintf(API_MATERIAL_POST_CHECK_MATERIAL_RESTAURANT, $id);
            $body = null;
            $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $unitName = '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;" >
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">' . $config['data']['unit_full_name'] . '</label>
                            </div>';
                if (mb_strlen($config['data']['name']) > 30) {
                    $config['data']['name'] = mb_substr($config['data']['name'], 0, 27) . '...' . '<br>' . $unitName;
                } else {
                    $config['data']['name'] = $config['data']['name'] . '<br>' . $unitName;
                }
                if ($config['data']['status'] === ENUM_SELECTED) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusMaterialData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-inventory="' . $config['data']['category_type_parent_name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateMaterialData($(this))" data-specification-exchang-id="' . $config['data']['unit_specification_exchange_id'] . '"  data-specification="' . $config['data']['unit_specification_name'] . '"  data-unit="' . $config['data']['material_unit_current_id'] . '" data-name="' . $config['data']['material_unit_current_name'] . '"  data-id="' . $config['data']['id'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' . $config['data']['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusMaterialData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-inventory="' . $config['data']['category_type_parent_name'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateMaterialData($(this))" data-unit="' . $config['data']['material_unit_current_id'] . '" data-specification-exchang-id="' . $config['data']['unit_specification_exchange_id'] . '" data-specification="' . $config['data']['unit_specification_name'] . '" data-name="' . $config['data']['material_unit_current_name'] . '" data-id="' . $config['data']['id'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' . $config['data']['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                }
                if ($config['data']['is_office_material'] === ENUM_SELECTED) {
                    $config['data']['is_office_material'] = '<div class="btn-group btn-group-sm  "><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title=""   ></i></div>';
                } else {
                    $config['data']['is_office_material'] = '<div class="btn-group btn-group-sm  "><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title=""   ></i></div>';
                }
            }
            return $config;
        } else {
            $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
            $method = ENUM_METHOD_POST;
            $api = sprintf(API_MATERIAL_POST_CHANGE_STATUS_RESTAURANT, $id, $isConfirmed);
            $body = null;
            $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_CONFIRM_SUPPLIER) {
                $dataTable = DataTables::of($config['data'])
                    ->addColumn('name', function ($row) {
                        return $row['name'];
                    })
                    ->addColumn('quantity', function ($row) {
                        return $this->numberFormat($row['quantity']) . ' ' . $row['exchange_unit_name'];
                    })
                    ->addColumn('action', function ($row) {
                        $typeID=0;
                        $row['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');
                        if($row['is_combo']==(int)Config::get('constants.type.checkbox.SELECTED') )
                        $typeID=1;
                        else if ($row['is_addition']==(int)Config::get('constants.type.checkbox.SELECTED')) {
                            $typeID=2;
                        }
                        return '<div class="btn-group btn-group-sm text-center">
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))" data-category-type="' . $row['category_type'] . '" data-type="' . $typeID . '" data-id="' . $row['id'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['action', 'name', 'quantity'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data'] = $dataTable;
                return $config;
            }
            else if ($config['status'] === ENUM_HTTP_STATUS_CODE_UPDATE) {
                $dataTable = DataTables::of($config['data'])
                    ->addColumn('supplier_name', function ($row) {
                        return $row['supplier_name'];
                    })
                    ->addColumn('action', function ($row) {
                        switch ($row['is_supplier_order']) {
                            case ENUM_SELECTED:
                                return '<div class="btn-group btn-group-sm text-center">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                            </div>';
                            case ENUM_DIS_SELECTED :
                                return '<div class="btn-group btn-group-sm text-center">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRestaurantSupplierOrder(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
                            default:
                                return '<div class="btn-group btn-group-sm text-center">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRequestSupplierOrder(' . $row['id'] . ' , ' . $row['branch_id'] . ', ' . $row['restaurant_brand_id'] . ' )"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
                        }

                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['action', 'supplier_name'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data'] = $dataTable;
                return $config;
            }
            else if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $unitName = '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">' . $config['data']['unit_full_name'] . '</label>
                            </div>';
                if (mb_strlen($config['data']['name']) > 30) {
                    $config['data']['name'] = mb_substr($config['data']['name'], 0, 27) . '...' . '<br>' . $unitName;
                } else {
                    $config['data']['name'] = $config['data']['name'] . '<br>' . $unitName;
                }
                if ($config['data']['status'] === ENUM_SELECTED) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusMaterialData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-inventory="' . $config['data']['category_type_parent_name'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateMaterialData($(this))" data-specification-exchang-id="' . $config['data']['unit_specification_exchange_id'] . '"  data-specification="' . $config['data']['unit_specification_name'] . '"  data-unit="' . $config['data']['material_unit_current_id'] . '" data-name="' . $config['data']['material_unit_current_name'] . '"  data-id="' . $config['data']['id'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' . $config['data']['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusMaterialData($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-inventory="' . $config['data']['category_type_parent_name'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateMaterialData($(this))" data-unit="' . $config['data']['material_unit_current_id'] . '" data-specification-exchang-id="' . $config['data']['unit_specification_exchange_id'] . '" data-specification="' . $config['data']['unit_specification_name'] . '" data-name="' . $config['data']['material_unit_current_name'] . '" data-id="' . $config['data']['id'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' . $config['data']['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                }
                if ($config['data']['is_office_material'] === ENUM_SELECTED) {
                    $config['data']['is_office_material'] = '<div class="btn-group btn-group-sm  "><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title=""   ></i></div>';
                } else {
                    $config['data']['is_office_material'] = '<div class="btn-group btn-group-sm  "><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title=""   ></i></div>';
                }
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                return $config;
            }
            return $config;
        }
    }

    public function createSpecifications(Request $request)
    {
        $id = ENUM_DIS_SELECTED;
        $name = $request->get('name');
        $nameEx = $request->get('name_ex');
        $valueEx = $request->get('value_ex');
        $unit = $request->get('unit');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_SPECIFICATIONS_POST_CREATE, $id);
        $body = [
            "name" => $name,
            "exchange_value" => $valueEx,
            "material_unit_specification_exchange_name_id" => $nameEx,
            "assign_to_unit_id" => $unit,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function deleteUnitOrder(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_MATERIAL_DELETE_UNIT_ORDER_FOOD_MAPS, $id);
        $body = [
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
}
