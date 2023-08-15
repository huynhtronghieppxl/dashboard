<?php

namespace App\Http\Controllers\report\warehouse_report\inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class WareHouseInventoryController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'ADDITION_FEE_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(1);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Kiểm kê kho tổng';
        return view('report.warehouse_report.inventory.index', compact('active_nav'));
    }

    public function inventory(Request $request)
    {
        $from = Config::get('constants.type.data.NONE');
        $to = Config::get('constants.type.data.NONE');
        $branch = $request->get('branch');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $status = Config::get('constants.type.InventoryReportStatusEnum.CONFIRMED');
        $material_category_type_parent_id = Config::get('constants.type.id.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $body = null;
        $api = sprintf(API_GET_LIST_CHECKLIST_GOODS, $page, $limit, $branch, $material_category_type_parent_id, $from, $to, $status);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $material = $collection->where('material_category_type_parent_id', Config::get('constants.type.MaterialCategoryParentId.MATERIAL'))->toArray();
            $goods = $collection->where('material_category_type_parent_id', Config::get('constants.type.MaterialCategoryParentId.GOODS'))->toArray();
            $internal = $collection->where('material_category_type_parent_id', Config::get('constants.type.MaterialCategoryParentId.INTERNAL'))->toArray();
            $other = $collection->where('material_category_type_parent_id', Config::get('constants.type.MaterialCategoryParentId.OTHER'))->toArray();
            $data_material = $this->listInventory($material);
            $data_goods = $this->listInventory($goods);
            $data_internal = $this->listInventory($internal);
            $data_other = $this->listInventory($other);
            return [$data_material, $data_goods, $data_internal, $data_other, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function listInventory($data)
    {
        $data = array_reverse($data);
        $data_list = '';
        if (count($data) === 0) {
            $data_list = '<option value="">' . TEXT_NOT_INVENTORY_CHECKLIST_GOOD . '</option>';
        } else {
            foreach ($data as $db) {
                if($db['status'] == 2){
                    $data_list .= '<option value="'. $db['id'] . '">Phiếu '. $db['code'] . ' (' . $db['time'] . ')</option>';
                }else{
                    $data_list = '<option value="">' . TEXT_NOT_INVENTORY_CHECKLIST_GOOD . '</option>';
                }
            }
        }
        return $data_list;
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $inventory = $request->get('inventory');
        $from = $request->get('from');
        $to = $request->get('to');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_INVENTORY_BRANCH_V2, $branch, $inventory, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table = Datatables::of($config['data'])
                ->addColumn('name', function ($row) {
                    return (mb_strlen($row['name']) > 30) ? (mb_substr($row['name'], 0, 27) . '...' . '<br>
                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                        <i class="fi-rr-hastag"></i>
                        <label class="m-0">' .   $row['material_unit_full_name'] . '</label>
                    </div>') : ($row['name'] .'<br>
                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                        <i class="fi-rr-hastag"></i>
                        <label class="m-0">' .   $row['material_unit_full_name'] . '</label>
                    </div>');
                })
                ->addColumn('opening_quantity', function ($row) {
                    return '<label class="f-w-700">' . $this->numberFormat($row['opening_quantity']) . '</label>';
                })
                ->addColumn('opening_amount', function ($row) {
                    $class = ($row['opening_amount'] === 0) ? 'number-order-hidden' : '';
                    return  '<label class="' . $class . '">' . $this->numberFormat($row['opening_amount']) . '</label><br>
                            <label class="number-order ' . $class . '"><em>SL: </em>'. $this->numberFormat($row['opening_quantity']) .' </label> ';
                })
                ->addColumn('total_receive_quantity', function ($row) {
                    $class = ($row['total_receive_quantity'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['total_receive_quantity']) . '</label>';
                })
                ->addColumn('total_receive_amount', function ($row) {
                    $class = ($row['total_receive_amount'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['total_receive_amount']). '</label><br>
                            <label class="number-order ' . $class . '"><em>SL: </em>'. $this->numberFormat($row['total_receive_quantity']) .'</label>';
                })
                ->addColumn('total_export_quantity', function ($row) {
                    $class = ($row['total_export_quantity'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_quantity']) . '</label>';
                })
                ->addColumn('total_export_amount', function ($row) {
                    $class = ($row['total_export_amount'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_amount']). '</label><br>
                            <label class="number-order ' . $class . '"><em>SL: </em>'. $this->numberFormat($row['total_export_quantity']) .'</label>';
                })
                ->addColumn('total_return_quantity', function ($row) {
                    $class = ($row['total_return_quantity'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['total_return_quantity']) . '</label>';
                })
                ->addColumn('total_return_amount', function ($row) {
                    $class = ($row['total_return_amount'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['total_return_amount']). '</label><br>
                            <label class="number-order ' . $class . '"><em>SL: </em>'. $this->numberFormat($row['total_return_quantity']) .'</label>';
                })
                ->addColumn('total_cancel_quantity', function ($row) {
                    $class = ($row['total_cancel_quantity'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['total_cancel_quantity']) . '</label>';
                })
                ->addColumn('total_cancel_amount', function ($row) {
                    $class = ($row['total_cancel_amount'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['total_cancel_amount']). '</label><br>
                            <label class="number-order ' . $class . '"><em>SL: </em>'. $this->numberFormat($row['total_cancel_quantity']) .'</label>';
                })
                ->addColumn('wastage_allow_quantity', function ($row) {
                    $class = ($row['wastage_allow_quantity'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['wastage_allow_quantity']) . '</label>';
                })
                ->addColumn('wastage_allow_amount', function ($row) {
                    $class = ($row['wastage_allow_amount'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['wastage_allow_amount']). '</label><br>
                            <label class="number-order ' . $class . '"><em>SL: </em>'. $this->numberFormat($row['wastage_allow_quantity']) .'</label>';
                })
                ->addColumn('system_last_quantity', function ($row) {
                    $class = ($row['system_last_quantity'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['system_last_quantity']) . '</label>';
                })
                ->addColumn('system_last_amount', function ($row) {
                    $class = ($row['system_last_amount'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['system_last_amount']). '</label><br>
                            <label class="number-order ' . $class . '"><em>SL: </em>'. $this->numberFormat($row['system_last_quantity']) .'</label>';
                })
                ->addColumn('confirm_quantity', function ($row) {
                    $class = ($row['confirm_quantity'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['confirm_quantity']) . '</label>';
                })
                ->addColumn('confirm_last_amount', function ($row) {
                    $class = ($row['confirm_last_amount'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['confirm_last_amount']). '</label><br>
                            <label class="number-order ' . $class . '"><em>SL: </em>'. $this->numberFormat($row['confirm_quantity']) .'</label>';
                })
                ->addColumn('difference_quantity', function ($row) {
                    return '<label>' . $this->numberFormat($row['difference_quantity']) . '</label>';
                })
                ->addColumn('difference_amount', function ($row) {
                    $class = ($row['difference_amount'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="' . $class . '">' . $this->numberFormat($row['difference_amount']). '</label><br>
                            <label class="number-order ' . $class . '"><em>SL: </em>'. $this->numberFormat($row['difference_quantity']) .'</label>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['name','opening_amount', 'total_export_amount', 'total_receive_amount', 'total_return_amount' ,'total_cancel_amount', 'wastage_allow_amount', 'system_last_amount' ,'confirm_last_amount', 'difference_amount' ])
                ->addIndexColumn()
                ->make(true);

            $data_total = [
                'record' => $this->numberFormat(count($config['data'])),
                'opening_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'opening_quantity'))),
                'opening_amount' => $this->numberFormat(array_sum(array_column($config['data'], 'opening_amount'))),
                'total_receive_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'total_receive_quantity'))),
                'total_receive_amount' => $this->numberFormat(array_sum(array_column($config['data'], 'total_receive_amount'))),
                'total_export_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'total_export_quantity'))),
                'total_export_amount' => $this->numberFormat(array_sum(array_column($config['data'], 'total_export_amount'))),
                'total_return_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'total_return_quantity'))),
                'total_return_amount' => $this->numberFormat(array_sum(array_column($config['data'], 'total_return_amount'))),
                'total_cancel_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'total_cancel_quantity'))),
                'total_cancel_amount' => $this->numberFormat(array_sum(array_column($config['data'], 'total_cancel_amount'))),
                'wastage_allow_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'wastage_allow_quantity'))),
                'wastage_allow_amount' => $this->numberFormat(array_sum(array_column($config['data'], 'wastage_allow_amount'))),
                'system_last_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'system_last_quantity'))),
                'system_last_amount' => $this->numberFormat(array_sum(array_column($config['data'], 'system_last_amount'))),
                'confirm_last_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'confirm_quantity'))),
                'confirm_last_amount' => $this->numberFormat(array_sum(array_column($config['data'], 'confirm_last_amount'))),
                'difference_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'difference_quantity'))),
                'difference_amount' => $this->numberFormat(array_sum(array_column($config['data'], 'difference_amount'))),
            ];
            return [$data_table, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
