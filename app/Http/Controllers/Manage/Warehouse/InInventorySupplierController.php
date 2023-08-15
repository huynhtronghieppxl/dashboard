<?php

namespace App\Http\Controllers\Manage\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class InInventorySupplierController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Nhâp kho từ NCC';
        return view('manage.inventory.in_inventory_supplier.index', compact('active_nav'));
    }
    public function data(Request $request)
    {
        $inventory = $request->get('type');
        $branch = $request->get('branch_id');
        $supplier = Config::get('constants.type.id.NONE');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $type = Config::get('constants.type.WarehouseTypeEnum.IN');
        $status = ENUM_GET_ALL;
        $is_take_canceled = ENUM_GET_ALL;
        $from = $request->get('from');
        $to = $request->get('to');
        $is_liabilities = ENUM_GET_ALL;
        $is_all_debt_amount = ENUM_DIS_SELECTED;
        $key = $this->keySearch(($request->get('search'))['value']);
        $target = Config::get('constants.type.WarehouseSessionTargetTypeEnum.NOT_BRANCH');
        $target_branch_id = Config::get('constants.type.id.GET_ALL');
        $inventoryStatus = Config::get('constants.type.WarehouseSessionStatusEnum.GET_ALL');
        $api = sprintf(API_INVENTORY_GET_LIST, $page, $branch, $type, $status, $is_take_canceled, $supplier, $from, $to, $is_liabilities, $limit, $is_all_debt_amount, $inventory, $target_branch_id, $target, $key, $inventoryStatus);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $api = sprintf(API_INVENTORY_GET_COUNT, $branch, $inventory, $type, $from, $to, $key, $target, $target_branch_id);
        $requestTab = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTab]);
        try {
            $config = $configAll[0];
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                $config['data']['list'][$i]['discount'] = $this->numberFormat($config['data']['list'][$i]['discount_amount']);
                $config['data']['list'][$i]['vat'] = $this->numberFormat($config['data']['list'][$i]['vat_amount']);
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount']);
                $config['data']['list'][$i]['paid_status_name'] = $this->paidStatusDataInInventorySupplier($config['data']['list'][$i]['paid_status']);
                $config['data']['list'][$i]['restaurant_supplier']['name'] = '<img onclick="modalImageComponent(' . "'" .  Session::get(SESSION_NODE_KEY_BASE_URL_ADS). "'". ')" onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . '" class="img-inline-name-data-table">
                                                           <label class="title-name-new-table" >' . $config['data']['list'][$i]['restaurant_supplier']['name'] . ' </label>';
                $config['data']['list'][$i]['employee'] = '<img onclick="modalImageComponent(' . "'" .  Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee']['avatar'] . "'". ')" onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee']['avatar'] . '" class="img-inline-name-data-table">
                                                           <label class="title-name-new-table" >' . $config['data']['list'][$i]['employee']['name'] . '<br>
                                                               <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee']['role_name'] . '</label>
                                                           </label>';
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openDetailInInventorySupplier($(this))" data-id="' . $config['data']['list'][$i]['id'] . '" data-branch="' . $config['data']['list'][$i]['branch']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                        </div>';

            }

            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'key' => $key,
                'page' => $page,
                'config' => $configAll
            );

            $config = $configAll[1];
            $data_table['count_material'] = $this->numberFormat($config['data']['count_material']);
            $data_table['amount_material'] = $this->numberFormat($config['data']['amount_material']);
            $data_table['vat_amount_material'] = $this->numberFormat($config['data']['vat_amount_material']);
            $data_table['discount_amount_material'] = $this->numberFormat($config['data']['discount_amount_material']);
            $data_table['total_amount_material'] = $this->numberFormat($config['data']['total_amount_material']);
            $data_table['count_goods'] = $this->numberFormat($config['data']['count_goods']);
            $data_table['amount_goods'] = $this->numberFormat($config['data']['amount_goods']);
            $data_table['vat_amount_goods'] = $this->numberFormat($config['data']['vat_amount_goods']);
            $data_table['discount_amount_goods'] = $this->numberFormat($config['data']['discount_amount_goods']);
            $data_table['total_amount_goods'] = $this->numberFormat($config['data']['total_amount_goods']);
            $data_table['count_internal'] = $this->numberFormat($config['data']['count_internal']);
            $data_table['amount_internal'] = $this->numberFormat($config['data']['amount_internal']);
            $data_table['vat_amount_internal'] = $this->numberFormat($config['data']['vat_amount_internal']);
            $data_table['discount_amount_internal'] = $this->numberFormat($config['data']['discount_amount_internal']);
            $data_table['total_amount_internal'] = $this->numberFormat($config['data']['total_amount_internal']);
            $data_table['count_other'] = $this->numberFormat($config['data']['count_other']);
            $data_table['amount_other'] = $this->numberFormat($config['data']['amount_other']);
            $data_table['vat_amount_other'] = $this->numberFormat($config['data']['vat_amount_other']);
            $data_table['discount_amount_other'] = $this->numberFormat($config['data']['discount_amount_other']);
            $data_table['total_amount_other'] = $this->numberFormat($config['data']['total_amount_other']);

            return json_encode($data_table);

        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function paidStatusDataInInventorySupplier($status)
    {
        switch ($status) {
            case Config::get('constants.type.WarehouseSessionPaidStatusEnum.WAITING_PAYMENT'):
                return '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                            <label class="m-0">' . TEXT_UNPAID . '</label>
                        </div>';
            case Config::get('constants.type.WarehouseSessionPaidStatusEnum.PAID'):
                return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                            <label class="m-0">' . TEXT_PAID_PAYMENT . '</label>
                        </div>';
            default:
                return '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                            <label class="m-0">' . TEXT_PAID_PAYMENT . '</label>
                        </div>';
        }
    }

    public function detail(Request $request)
    {
        $branch_id = $request->get('branch');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_INVENTORY_GET_DETAIL, $id, $branch_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table = Datatables::of($config['data']['details'])
                ->addColumn('restaurant_material_name', function ($row) {
                    $unit = ($row['material_unit_type'] === (int)Config::get('constants.type.UnitMaterialTypeEnum.SMALL')) ? $row['unit_specification_exchange_name'] : $row['unit_full_name'];
                    return $row['restaurant_material_name'] . '<br><label class="m-t-2 label label-info">' . $unit . '</label>';
                })
                ->addColumn('user_input_quantity', function ($row) {
                    $quantity = ($row['material_unit_type'] === (int)Config::get('constants.type.UnitMaterialTypeEnum.SMALL')) ? $row['small_quantity'] : $row['quantity'];
                    return $this->numberFormat($quantity);
                })
                ->addColumn('user_input_price', function ($row) {
                    return $this->numberFormat($row['unit_price']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_price']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" title="' . TEXT_DETAIL . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['restaurant_material_name', 'action'])
                ->addIndexColumn()
                ->make(true);
            switch ($config['data']['paid_status']) {
                case Config::get('constants.type.WarehouseSessionPaidStatusEnum.WAITING_PAYMENT'):
                    $paid_status = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">' . $config['data']['paid_status_name'] . '</label>
                                    </div>';
                    break;
                case Config::get('constants.type.WarehouseSessionPaidStatusEnum.PAID'):
                    $paid_status = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">' . $config['data']['paid_status_name'] . '</label>
                                    </div>';
                    break;
                default:
                    $paid_status = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">' . $config['data']['paid_status_name'] . '</label>
                                    </div>';
            }

            switch ($config['data']['material_category_type_parent_id']) {
                case (int)Config::get('constants.type.inventory.MATERIAL'):
                    $inventory = TEXT_INVENTORY_MATERIAL;
                    break;
                case (int)Config::get('constants.type.inventory.GOODS'):
                    $inventory = TEXT_INVENTORY_GOODS;
                    break;
                case (int)Config::get('constants.type.inventory.INTERNAL'):
                    $inventory = TEXT_INVENTORY_INTERNAL;
                    break;
                case (int)Config::get('constants.type.inventory.OTHER'):
                    $inventory = TEXT_INVENTORY_OTHER;
                    break;
                default:
                    $inventory = '---';
            }

            $data_detail = [
                'paid_status' => $paid_status,
                'code' => $config['data']['code'],
                'create' => $config['data']['created_at'],
                'delivery' => $config['data']['delivery_date'],
                'employee' => $config['data']['employee']['name'],
                'employee_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee']['avatar'],
                'supplier_avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['restaurant_supplier']['avatar'],
                'supplier' => $config['data']['restaurant_supplier']['name'],
                'discount' => $this->numberFormat($config['data']['discount_amount']),
                'inventory' => $inventory,
                'vat' => $this->numberFormat($config['data']['vat_amount']),
                'total' => $this->numberFormat($config['data']['amount']),
                'total_final' => $this->numberFormat($config['data']['total_amount']),
                'total_material' => $this->numberFormat($config['data']['total_material']),
                'branch' => $config['data']['branch']['name'],
                'id' => $config['data']['id'],
                'type' => $config['data']['type'],
                'note' => $config['data']['note'],
                'total_record_material' => $this->numberFormat(count($config['data']['details'])),
            ];

            return [$data_table, $data_detail, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

}
