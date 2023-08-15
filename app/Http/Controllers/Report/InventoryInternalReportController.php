<?php

namespace App\Http\Controllers\Report;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class InventoryInternalReportController extends Controller
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
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Kiểm kê kho bộ phận';
        return view('report.inventory_internal.index', compact('active_nav'));
    }

    public function inventory(Request $request)
    {
        $branch = $request->get('branch');
        $type = 2;
        $inventory = ENUM_GET_ALL;
        $status = 2;
        $creator = ENUM_GET_ALL;
        $from = $request->get('from');
        $to = $request->get('to');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_5000');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_LIST_CHECKLIST_GOODS_INTERNAL_WAREHOUSE, $branch, $type, $inventory, $creator, $status, $from, $to, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $kitchen = $collection->where('branch_inner_inventory_type', Config::get('constants.type.BranchInventoryTypeEnum.KITCHEN'))->toArray();
            $bar = $collection->where('branch_inner_inventory_type', Config::get('constants.type.BranchInventoryTypeEnum.BAR'))->toArray();
            $data_kitchen = $this->listInventory($kitchen);
            $data_bar = $this->listInventory($bar);
            return [$data_kitchen, $data_bar, $config];
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
                $data_list .= '<option data-time="' . $db['time'] . '" value="' . $db['id'] . '">Phiếu ' . $db['code'] . '  (' . $db['time'] . ')</option>';
            }
        }
        return $data_list;
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $inventory = $request->get('inventory');
        $from = $request->get('from');
        $to = $request->get('to');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_INVENTORY_INTERNAL_V2, $brand, $branch, $inventory, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table = Datatables::of($config['data'])
                ->addColumn('name', function ($row) {
                    $unit = ($row['material_category_type_parent_id'] !== ENUM_MATERIAL_CATEGORY_PARENT_GOODS) ? $row['material_unit_full_name'] : $row['material_unit_specification_exchange_name'];
                    return (mb_strlen($row['name']) > 30) ?
                        mb_substr($row['name'], 0, 27) . '...' . '<br>
                        <div class="tag seemt-blue seemt-border-blue d-flex">
                        <i class="fi-rr-hastag"></i>
                        <label class="m-0">
                        ' .$unit . '
                        </label>
                        </div>' :
                        ($row['name'] .'<br>
                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                        <i class="fi-rr-hastag"></i>
                        <label class="m-0">' .   $unit . '</label>
                    </div>');
                })
                ->addColumn('material_category_name', function ($row) {
                    return (mb_strlen($row['material_category_name']) > 14) ? $row['material_category_name'] = mb_substr($row['material_category_name'], 0, 12) . '...' : $row['material_category_name'];
                })
                ->addColumn('opening_quantity', function ($row) {
                    return $this->numberFormat($row['opening_quantity']);
                })
                ->addColumn('receive_quantity', function ($row) {
                    return $this->numberFormat($row['receive_quantity']);
                })
                ->addColumn('cancel_quantity', function ($row) {
                    return $this->numberFormat($row['cancel_quantity']);
                })
                ->addColumn('food_recipe_quantity', function ($row) {
                    return $this->numberFormat($row['food_recipe_quantity']);
                })
                ->addColumn('wastage_allow_quantity', function ($row) {
                    return $this->numberFormat($row['wastage_allow_quantity']);
                })
                ->addColumn('system_last_quantity', function ($row) {
                    return $this->numberFormat($row['system_last_quantity']);
                })
                ->addColumn('confirm_quantity', function ($row) {
                    return $this->numberFormat($row['confirm_quantity']);
                })
                ->addColumn('difference_quantity', function ($row) {
                    return $this->numberFormat($row['difference_quantity']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['name'])
                ->addIndexColumn()
                ->make(true);
            $data_total = [
                'record' => $this->numberFormat(count($config['data'])),
                'total_opening_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'opening_quantity'))),
                'total_receive_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'receive_quantity'))),
                'total_food_recipe_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'food_recipe_quantity'))),
                'total_cancel_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'cancel_quantity'))),
                'total_wastage_allow_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'wastage_allow_quantity'))),
                'total_system_last_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'system_last_quantity'))),
                'total_confirm_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'confirm_quantity'))),
                'total_difference_quantity' => $this->numberFormat(array_sum(array_column($config['data'], 'difference_quantity'))),
            ];
            return [$data_table, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
