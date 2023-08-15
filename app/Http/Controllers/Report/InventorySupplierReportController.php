<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class InventorySupplierReportController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'ADDITION_FEE_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Nhập kho Nhà cung cấp';
        return view('report.inventory_supplier.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $supplier = $request->get('supplier');
        $inventory = $request->get('inventory');
        $from = $request->get('from');
        $to = $request->get('to');
        $key_search = "";
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $type = ENUM_REPORT_TYPE_OPTION_DAY;
        $api =sprintf(API_REPORT_GET_INVENTORY_SUPPLIER_V2, $branch, $supplier, $inventory, $key_search, $from, $to, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table = Datatables::of($config['data'])
                ->addColumn('name', function ($row) {
//                    return $row['restaurant_material_name'] . '<br><label class="m-t-2 label label-info">'. $row['material_unit_full_name'] .'</label>';
                    return $row['restaurant_material_name'] . '<br><div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">'. $row['material_unit_full_name'] .'</label>
                                                                    </div>';
                })
                ->addColumn('accept_quantity', function ($row) {
                    return $this->numberFormat($row['accept_quantity']);
                })
                ->addColumn('small_accept_quantity', function ($row) {
                    return $this->numberFormat($row['small_accept_quantity']);
                })
                ->addColumn('total_price_reality', function ($row) {
                    return $this->numberFormat($row['total_price_reality']);
                })
                ->addColumn('inventory', function ($row) {
                    switch ($row['material_category_type_parent_id']) {
                        case Config::get('constants.type.inventory.MATERIAL'):
                            return TEXT_INVENTORY_MATERIAL;
                        case Config::get('constants.type.inventory.GOODS'):
                            return TEXT_INVENTORY_GOODS;
                        case Config::get('constants.type.inventory.INTERNAL'):
                            return TEXT_INVENTORY_INTERNAL;
                        default:
                            return TEXT_INVENTORY_OTHER;
                    }
                })
                ->addColumn('key_search', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })

                ->rawColumns(['name', 'key_search', 'action'])
                ->addIndexColumn()
                ->make(true);
            $total_amount = $this->numberFormat(array_sum(array_column($config['data'], 'total_price_reality' )));
            return [$data_table, $total_amount ,$config];

        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function supplier(Request $request)
    {
        $branch = $request->get('branch');
        $brand = $request->get('brand');
        $from = $request->get('from');
        $to = $request->get('to');
        $is_take_all = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BILL_LIABILITIES_GET_LIST, $brand, $branch, $is_take_all, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if (count($config['data']['list']) === 0) {
                $option = '<option value="' . ENUM_GET_ALL . '">' . TEXT_NULL_OPTION . '</option>';
            } else {
                $option = '<option value="' . ENUM_GET_ALL . '" selected>Tất cả nhà cung cấp</option>';
                foreach ($config['data']['list'] as $db) {
                    $option .= '<option value="' . $db['supplier_id'] . '">' . $db['supplier_name'] . '</option>';
                }
            }
            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
