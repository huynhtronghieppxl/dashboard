<?php

namespace App\Http\Controllers\BuildData\AssignSupplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class AssignRestaurantSupplierDataController extends Controller
{
    public function index()
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
        $active_nav = 'Chọn NCC cần sử dụng';
        return view('build_data.assign_supplier.restaurant.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $is_take_my_supplier = ENUM_GET_ALL;
        $is_restaurant_supplier = $request->get('is_restaurant_supplier');
        $is_exclude_unassign_system_supplier = ENUM_GET_ALL;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_GET_ALL_SUPPLIER, $is_take_my_supplier, $is_restaurant_supplier, $is_exclude_unassign_system_supplier, $page, $limit, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $data_selected = $collection->where('is_take_my_supplier',  ENUM_SELECTED)->all();
            $data_unselected = $collection->where('is_take_my_supplier', ENUM_DIS_SELECTED)->all();
            $data_table_selected = DataTables::of($data_selected)
                ->addColumn('name', function ($row) {
                    $type_supplier = $row['is_restaurant_supplier'] == ENUM_DIS_SELECTED ? '<div class="tag seemt-green seemt-bg-green d-flex" style="width: fit-content !important;">
                                                                                                <i class="fi-rr-hastag"></i>
                                                                                                <label class="m-0">' . TEXT_SYSTEM_SUPPLIER . '</label>
                                                                                              </div>' : '';
                    return '<label> ' . $row['name'] . '</label><br>'. $type_supplier .'<input class="d-none" value="' . $row['id'] . '"/>';
                })
                ->addColumn('supplier-type', function ($row) {
                    if ($row['is_restaurant_supplier'] == ENUM_SELECTED) {
                        return TEXT_RESTAURANT_SUPPLIER;
                    } else {
                        return TEXT_SYSTEM_SUPPLIER;
                    }
                })
                ->addColumn('address', function ($row) {
                    return($row['address'] === null) ? '' : $row['address'];
                })
                ->addColumn('action', function ($row) {
//                    return '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer" onclick="unCheckSystemSupplierData($(this))" data-id="' . $row['id'] . '" data-type="1"></i>';
                return '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="unCheckSystemSupplierData($(this))" data-id="' . $row['id'] . '" data-type="1"><i class="fi-rr-arrow-small-left"></i></button></div>';
                })
                ->addColumn('keysearch', function ($row) {
                    $type_supplier = $row['is_restaurant_supplier'] == ENUM_DIS_SELECTED ? '<div class="tag seemt-green seemt-bg-green d-flex" style="width: fit-content !important;">
                                                                                                <i class="fi-rr-hastag"></i>
                                                                                                <label class="m-0">' . TEXT_SYSTEM_SUPPLIER . '</label>
                                                                                              </div>' : '';
                    $keysearch = [$type_supplier, $row['name'], $row['phone']];
                    return $this->keySearchDatatableTemplate($keysearch);
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
            $data_table_unselected = DataTables::of($data_unselected)
                ->addColumn('name', function ($row) {
                    $type_supplier = $row['is_restaurant_supplier']  == ENUM_DIS_SELECTED ? '<div class="tag seemt-green seemt-bg-green d-flex" style="width: fit-content !important;">
                                                                                                 <i class="fi-rr-hastag"></i>
                                                                                                <label class="m-0">' . TEXT_SYSTEM_SUPPLIER . '</label>
                                                                                              </div>' : '';
                    return '<label> ' . $row['name'] . '</label><br>'. $type_supplier .'<input class="d-none" value="' . $row['id'] . '"/>';
                })
                ->addColumn('supplier-type', function ($row) {
                    if ($row['is_restaurant_supplier'] == ENUM_SELECTED) {
                        return TEXT_RESTAURANT_SUPPLIER;
                    } else {
                        return TEXT_SYSTEM_SUPPLIER;
                    }
                })
                ->addColumn('address', function ($row) {
                    return ($row['address'] === null) ? '' : $row['address'];
                })
                ->addColumn('action', function ($row) {
//                    return '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" onclick="checkSystemSupplierData($(this))" data-id="' . $row['id'] . '" data-type="0"></i>';
                    return '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkSystemSupplierData($(this))" data-id="' . $row['id'] . '" data-type="0"><i class="fi-rr-arrow-small-right"></i></button></div>';

                })
                ->addColumn('keysearch', function ($row) {
                    $type_supplier = $row['is_restaurant_supplier']  == ENUM_DIS_SELECTED ? '<div class="tag seemt-green seemt-bg-green d-flex" style="width: fit-content !important;">
                                                                                                 <i class="fi-rr-hastag"></i>
                                                                                                <label class="m-0">' . TEXT_SYSTEM_SUPPLIER . '</label>
                                                                                              </div>' : '';
                    $keysearch = [$type_supplier, $row['name'], $row['phone']];
                    return $this->keySearchDatatableTemplate($keysearch);
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
            return [$data_table_selected, $data_table_unselected, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_SUPPLIER_POST_ASSIGN_TO_RESTAURANT;
        $body = [
            "supplier_ids" => $request->get('supplier_ids'),
            "remove_supplier_ids" => $request->get('remove_supplier_ids')
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function unAssign(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_SUPPLIER_POST_UN_ASSIGN_TO_RESTAURANT;
        $body = [
            "supplier_id" => $request->get('supplier_id'),
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] == ENUM_HTTP_STATUS_CODE_UPDATE) {
                $data_table = DataTables::of($config['data'])
                    ->addColumn('action', function ($row) {
                        if ($row['is_supplier_order'] == 1) {
                            return '<div class="btn-group btn-group-sm text-center">
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
                        } else {
                            return '<div class="btn-group btn-group-sm text-center">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailRestaurantSupplierOrder(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
                        }
                    })
                    ->addColumn('code', function ($row) {
                        return $row['code'];
                    })
                    ->addColumn('name', function ($row) {
                        return $row['supplier_name'];
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate([$row['supplier_name'], $row['code']]);
                    })
                    ->rawColumns(['code', 'action', 'name'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data'] = $data_table;
                return $config;
            } else {
                return $config;
            }
        } catch(Exception $e){
            return $this->catchTemplate($config, $e);
        }
    }
}
