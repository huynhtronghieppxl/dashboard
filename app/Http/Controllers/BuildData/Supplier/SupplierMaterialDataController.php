<?php

namespace App\Http\Controllers\BuildData\Supplier;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class SupplierMaterialDataController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Nguyên liệu NCC Sổ tay';
        return view('build_data.supplier.material.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $supplier_id = $request->get('supplier_id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_GET_MATERIAL, $supplier_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $enable_data = array_values(collect($config['data']['list'])->where('status', ENUM_SELECTED)->toArray());
            $disable_data = array_values(collect($config['data']['list'])->where('status', ENUM_DIS_SELECTED)->toArray());
            $enable_table = $this->drawnSupplierMaterialTable($enable_data)->original['data'];
            $disable_table = $this->drawnSupplierMaterialTable($disable_data)->original['data'];
            $total_record = [
                'enable' => $this->numberFormat(count($enable_data)),
                'disable' => $this->numberFormat(count($disable_data))
            ];
            return [$enable_table, $disable_table, $total_record, $config];
        }catch (Exception $e){
            return $this->catchTemplate($config , $e);
        }
    }

    public function drawnSupplierMaterialTable($data)
    {
        return DataTables::of($data)
            ->addColumn('action', function ($row){
                if ($row['status'] === ENUM_SELECTED) {
                    return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '" onclick="changeSupplierMaterialStatus($(this))" data-status="' . $row['status'] . '" data-material-id="' . $row['id'] . '"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' .TEXT_UPDATE . '" onclick="openModalUpdateSupplierMaterial($(this))" data-id="' . $row['id'] . '" ><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailSupplierMaterial(' . $row['id'] . ')" ><i class="fi-rr-eye"></i></button>
                            </div>';
                } else {
                    return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '" onclick="changeSupplierMaterialStatus($(this))" data-status="' . $row['status'] . '" data-material-id="' . $row['id'] . '" ><i class="fi-rr-check"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailSupplierMaterial(' . $row['id'] . ')" ><i class="fi-rr-eye"></i></button>
                            </div>';
                }
            })
            ->editColumn('cost_price', function ($row) {
                return $this->numberFormat($row['cost_price']);
            })
            ->addColumn('name', function ($row) {
                return  '<label>' . $row['name'] . '</label><br><label class="label label-info">'. $row['material_unit_full_name'] .'</label>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate([$row['name'], $row['material_unit_full_name'], $row['material_category_name'], $row['cost_price']]);
            })
            ->rawColumns(['action','name'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getHandBookSupplier(Request $request)
    {
        $is_take_my_supplier = ENUM_SELECTED;
        $is_restaurant_supplier = ENUM_SELECTED;
        $is_exclude_unassign_system_supplier = ENUM_GET_ALL;
        $status = ENUM_SELECTED;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $project_id = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_GET_ALL_SUPPLIER, $is_take_my_supplier, $is_restaurant_supplier, $is_exclude_unassign_system_supplier, $page, $limit, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            if (!empty($data)) {
                $option = '';
                for ($i = 0; $i < count($data); $i++) {
                    $option .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            } else {
                $option = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function getDataCreate(Request $request)
    {
        $api = sprintf(API_SUPPLIER_GET_MATERIAL_CATEGORIES);
        $body = null;
        $requestMaterialCategories = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $status = ENUM_SELECTED;
        $api =sprintf(API_MATERIAL_UNIT_GET_DATA, $status);
        $body = null;
        $requestMaterialUnit = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestMaterialCategories, $requestMaterialUnit]);
        try{
        $configs['material_categories'] = $configAll[0];
        $opt_categories = $this->renderDataOptHTML($configAll[0]['data'], 1, 0, null);
        $configs['material_unit'] = $configAll[1];
        $opt_unit = $this->renderDataOptHTML($configAll[1]['data'], 1, 0, null);
        return [$opt_categories, $opt_unit, $configs];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function renderDataOptHTML($data, $default_opt, $check_selected, $id_check)
    {
        if (!empty($data)) {
            $option = ($default_opt === 0) ? '' : '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                if ($check_selected == 1) {
                    if ($data[$i]['id'] == $id_check) {
                        $option .= '<option value="' . $data[$i]['id'] . '" selected>' . $data[$i]['name'] . '</option>';
                    } else {
                        $option .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                    }
                } else {
                    $option .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
        } else {
            $option = '<option value="">' . TEXT_NULL_OPTION . '</option>';
        }
        return $option;
    }

    public function getSpecificationsByUnit(Request $request)
    {
        $material_unit_id = $request->get('material_unit_id');
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api =sprintf(API_MATERIAL_SPECIFICATIONS_GET_DATA, $status, $material_unit_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $opt = $this->renderDataOptHTML(array_values(collect($config['data'])->where('is_selected', 1)->toArray()), 1, 0, null);
        return [$opt, $config];
    }

    public function createSupplierMaterial(Request $request)
    {
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_POST_CREATE_SUPPLIER_MATERIAL);
        $body = [
            'supplier_id' => $request->get('supplier_id'),
            'code' => $request->get('code'),
            'name' => $request->get('name'),
            'material_category_id' => $request->get('material_category_id'),
            'cost_price' => $request->get('cost_price'),
            'wholesale_price' => $request->get('wholesale_price'),
            'retail_price' => $request->get('retail_price'),
            'wastage_rate' => $request->get('wastage_rate'),
            'wholesale_price_quantity' => $request->get('wholesale_price_quantity'),
            'out_stock_alert_quantity' => $request->get('out_stock_alert_quantity'),
            'material_unit_id' => $request->get('material_unit_id'),
            'material_unit_specification_id' => $request->get('material_unit_specification_id'),
            'status' => ENUM_SELECTED,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['data'] != null) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '" onclick="changeSupplierMaterialStatus($(this))"  data-status="' . $config['data']['status'] . '" data-material-id="' . $config['data']['id'] . '"><i class="fi-rr-cross"></span></button>
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" onclick="openModalUpdateSupplierMaterial($(this))" data-id="' . $config['data']['id'] . '" ><i class="fi-rr-pencil"></i></button>
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailSupplierMaterial(' . $config['data']['id'] . ')" ><i class="fi-rr-eye"></i></button>
                                    </div>';
                $config['data']['cost_price'] = $this->numberFormat($config['data']['cost_price']);
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function changeSupplierMaterialStatus(Request $request)
    {
        $id = $request->get('material_id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SUPPLIER_POST_CHANGE_MATERIAL_STATUS, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try{
        if ($config['status'] === 205){
            $table_list_order_not_complete = DataTables::of($config['data'])
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                             <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder('. $row['id'] .')" data-id="'. $row['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="Xem chi tiết"><span class="icofont icofont-eye-alt"></span></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['code']]);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            $config['data'] = $table_list_order_not_complete;
        }
        else{
            if ($config['data'] != null) {
                if ($config['data']['status'] === ENUM_SELECTED) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '" onclick="changeSupplierMaterialStatus($(this))" data-status="' . $config['data']['status'] . '" data-material-id="' . $config['data']['id'] . '" ><i class="fi-rr-cross"></span></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' .TEXT_UPDATE . '" onclick="openModalUpdateSupplierMaterial($(this))" data-id="' . $config['data']['id'] . '" ><i class="fi-rr-pencil"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailSupplierMaterial(' . $config['data']['id'] . ')" ><i class="fi-rr-eye"></i></button>
                                            </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '" onclick="changeSupplierMaterialStatus($(this))" data-status="' . $config['data']['status'] . '" data-material-id="' . $config['data']['id'] . '" ><i class="fi-rr-check"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailSupplierMaterial(' . $config['data']['id'] . ')" ><i class="fi-rr-eye"></i></button>
                                            </div>';
                }
                $config['data']['cost_price'] = $this->numberFormat($config['data']['cost_price']);
                $config['data']['name'] = '<label>' .  $config['data']['name'] . '</label><br><label class="label label-info">'.  $config['data']['material_unit_full_name'] .'</label>';
            }
        }

        return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->get('material_id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_GET_MATERIAL_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['data']['status'] === 0) {
                $status = '<label class="label label-md label-inverse mb-0">' . TEXT_DISABLE_STATUS . '</label>';
            } else {
                $status = '<label class="label label-md label-success mb-0">' . TEXT_STATUS_ENABLE . '</label>';
            }
            $data = [
                'code' => $config['data']['code'],
                'name' => $config['data']['name'],
                'category_name' => $config['data']['material_category_name'],
                'category_id' => $config['data']['material_category_id'],
                'unit' => $config['data']['material_unit_name'],
                'specifications' => $config['data']['material_unit_specification_name'],
                'status_text' => $status,
                'status' => $config['data']['status'],
                'cost_price' => $config['data']['cost_price'],
                'retail_price' => $config['data']['retail_price'],
                'wholesale_price' => $config['data']['wholesale_price'],
                'wholesale_price_quantity' => $config['data']['wholesale_price_quantity'],
                'out_stock_alert_quantity' => $config['data']['out_stock_alert_quantity']
            ];
            return [$data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function getDataUpdate(Request $request)
    {
        $id = $request->get('material_id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_GET_MATERIAL_DETAIL, $id);
        $body = null;
        $config_material = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $configs['material_detail'] = $config_material['config'];
        $api = sprintf(API_SUPPLIER_GET_MATERIAL_CATEGORIES);
        $body = null;
        $requestMaterialCategories = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $status = ENUM_SELECTED;
        $api = sprintf(API_MATERIAL_UNIT_GET_DATA, $status);
        $body = null;
        $requestMaterialUnit = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestMaterialCategories, $requestMaterialUnit]);
        try {
            $configs['material_categories'] = $configAll[0];
            $opt['categories'] = $this->renderDataOptHTML($configAll[0]['data'], 1, 1, $config_material['data']['material_category_id']);
            $configs['material_unit'] = $configAll[1];
            $opt['unit'] = $this->renderDataOptHTML($configAll[1]['data'], 1, 1, $config_material['data']['material_unit_id']);
            $data_pecifications = $this->getSpecificationsByUnitUpdate($request, $config_material['data']['material_unit_id'], $config_material['data']['material_unit_specification_id']);
            $configs['material_pecifications'] = $data_pecifications[1];
            $opt['pecifications'] = $data_pecifications[0];
            return [$config_material['data'], $opt, $configs];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function getSpecificationsByUnitUpdate($request, $material_unit_id, $selected_speci_id)
    {
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_SPECIFICATIONS_GET_DATA, $status, $material_unit_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $opt = $this->renderDataOptHTML(array_values(collect($config['data'])->where('is_selected', 1)->toArray()), 1, 1, $selected_speci_id);
        return [$opt, $config];
    }

    public function updateSupplierMaterial(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SUPPLIER_POST_MATERIAL_UPDATE, $id);
        $body = [
            'supplier_id' => $request->get('supplier_id'),
            'code' => ($request->get('code')),
            'name' => ($request->get('name')),
            'material_category_id' => $request->get('material_category_id'),
            'cost_price' => $request->get('cost_price'),
            'wholesale_price' => $request->get('wholesale_price'),
            'retail_price' => $request->get('retail_price'),
            'wastage_rate' => $request->get('wastage_rate'),
            'wholesale_price_quantity' => $request->get('wholesale_price_quantity'),
            'out_stock_alert_quantity' => $request->get('out_stock_alert_quantity'),
            'material_unit_id' => $request->get('material_unit_id'),
            'material_unit_specification_id' => $request->get('material_unit_specification_id'),
            'status' => $request->get('status')
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    /**
     * @param Request $request
     * @return array
     * Nhớ đọc 2 F ở dưới nha
     */

    public function getRestaurantMaterialBySupplier(Request $request)
    {
        $supplier_id = $request->get('supplier_id');
//        $type_parent_id = ENUM_GET_ALL;
//        $type_id = ENUM_GET_ALL;
//        $category_id = ENUM_GET_ALL;
//        $status = 1;
//        $is_assign_to_supplier = 0;
//        $api = sprintf(API_MATERIAL_GET_LIST_RESTAURANT_2, ENUM_GET_ALL , $status);
//        $body = null;
//        $requestNotAssign = [
//            'project' => ENUM_PROJECT_ID_ORDER,
//            'method' => ENUM_METHOD_GET,
//            'api' => $api,
//            'body' => $body,
//        ];
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $status = ENUM_GET_ALL;
        $api = sprintf(API_MATERIAL_GET_LIST_RESTAURANT, $supplier_id, $status);
        $body = null;
//        $requestIsAssign = [
//            'project' => ENUM_PROJECT_ID_ORDER,
//            'method' => ENUM_METHOD_GET,
//            'api' => $api,
//            'body' => $body,
//        ];
//        $configAll = $this->callApiMultiGatewayTemplate2([$requestNotAssign, $requestIsAssign]);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
//            $data_tableNotAssign = DataTables::of($configAll[0]['data'])
//                ->addColumn('checkbox', function ($row) {
//                    return '<div class="btn-group btn-group-sm">
//                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="checkRestaurantMaterialBySupplier($(this))" data-type="0" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '"  data-unit-id="' . $row['unit_id'] . '" data-unit-full-name="' . $row['unit_full_name'] . '" data-unit-specification ="' . $row['unit_specification_id'] . '" data-category ="' . $row['material_category']['id'] . '"   data-price="' . $this->numberFormat($row['price']) . '" >
//                                <i class="fi-rr-arrow-small-right"  ></i>
//                            </button>
//                            </div>';
//                 })
//                ->addColumn('keysearch', function ($row) {
//                    return $this->keySearchDatatableTemplate($row);
//                })
//                ->rawColumns(['checkbox'])
//                ->make(true);
            $data_tableIsAssign = DataTables::of($config['data']['list'])
                ->addColumn('checkbox', function ($row) {
                    return '<div class="btn-group btn-group-sm d-none">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="unCheckRestaurantMaterialBySupplier($(this))" data-type="1" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '"  data-unit-id="' . $row['material_unit_id'] . '" data-unit-full-name="' . $row['material_unit_full_name'] . '" data-unit-specification ="' . $row['material_unit_specification_id'] . '" data-category ="' . $row['material_category_id'] . '"   data-price="' . $this->numberFormat($row['cost_price']) . '" >
                                <i class="fi-rr-arrow-small-left"  ></i>
                            </button>
                            </div>';
                })
                ->addColumn('price', function ($row) {
//                    return '<div class="input-group border-group validate-table-validate">
//                            <input class="form-control rounded text-center border-0 w-100 seemt-fz-14" data-money="1" data-max="100000000" data-type="currency-edit" value="'.$row['price'].'">
//                            </div>';
                    return '<label>'.$this->numberFormat($row['cost_price']).'</label>';
                })
                ->addColumn('name', function ($row) {
                    return '<label>'.$row['name'].'</label>';
                })
                ->addColumn('retail_price', function ($row) {
//                    return '<div class="input-group border-group validate-table-validate">
//                            <input class="form-control rounded text-center border-0 w-100 seemt-fz-14" data-money="1" data-max="100000000" data-type="currency-edit" value="'.$row['price'].'">
//                            </div>';
                    return '<label>'.$this->numberFormat($row['retail_price']).'</label>';
                })
                ->addColumn('out_stock', function ($row) {
//                    return '<div class="input-group border-group validate-table-validate">
//                            <input class="form-control rounded text-center border-0 w-100 seemt-fz-14"  data-min="1" data-number="1" data-type="currency-edit"  data-max="100000000"   value="'.$row['out_stock_alert_quantity'].'">
//                            </div>';
                    return '<label>'.$this->numberFormat($row['out_stock_alert_quantity']).'</label>';
                })
                ->addColumn('action', function ($row) {
                    if($row['status'] === 1) {
                        return '<button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusMaterialSupplierOrder($(this), 0)" data-id="'. $row['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="Tạm ngưng"><i class="fi-rr-cross"></i></button>';
                    }else {
                        return '<button class="tabledit-edit-button seemt-green btn seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusMaterialSupplierOrder($(this), 1)" data-id="'. $row['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="Bật hoạt động"><i class="fi-rr-check"></i></button>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['checkbox','out_stock', 'price','retail_price', 'name', 'action' ])
                ->make(true);
//            return [$data_tableNotAssign, $data_tableIsAssign,$configAll];
            return [$data_tableIsAssign,$config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function getMaterialRestaurants (Request $request)
    {
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $supplier_id = ENUM_GET_ALL;
        $status = ENUM_SELECTED;
        $api = sprintf(API_MATERIAL_GET_LIST_RESTAURANT_2, $supplier_id , $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $table_all_material = DataTables::of($config['data'])
                ->addColumn('checkbox', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="checkRestaurantMaterialBySupplier($(this))" data-type="0" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '"  data-unit-id="' . $row['unit_id'] . '" data-unit-full-name="' . $row['unit_full_name'] . '" data-unit-specification ="' . $row['unit_specification_id'] . '" data-category ="' . $row['material_category']['id'] . '"   data-price="' . $this->numberFormat($row['price']) . '" >
                                <i class="fi-rr-arrow-small-right"  ></i>
                            </button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['checkbox'])
                ->make(true);
            return [$table_all_material, $config];
        }catch(Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function assignRestaurantMaterial(Request $request)
    {
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = API_SUPPLIER_POST_CREATE_MULTI;
        $body = [
            'materials' => $request->get('list_material'),
            'supplier_id' => $request->get('supplier_id')
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function changeStatusMaterialBookSupplier (Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');
        $project = ENUM_PROJECT_ID_ORDER2;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SUPPLIER_POST_MATERIAL_BOOK_SUPPLIER_DELETE, $id);
        $body = [
            "status" => $status,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    /**
     * Auth: CỦA VY
     * @param Request $request
     * @return array
     */


    /**
     * Hết
     */
}




