<?php

namespace App\Http\Controllers\Manage\InventoryInternal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class InInventoryInternalController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'BRANCH_INVENTORY_MANAGEMENT']);
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
        $active_nav = 'Nhập từ kho chi nhánh';
        return view('manage.inventory_internal.in_inventory.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $inventory = $request->get('type');
        $branch = $request->get('branch_id');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = Config::get('constants.type.default.LIMIT_100');;
        $type = Config::get('constants.type.WarehouseTypeEnum.IN');
        $from = $request->get('from');
        $to = $request->get('to');
        $key = $this->keySearch(($request->get('search'))['value']);
        $api =sprintf(API_INVENTORY_INTERNAL_GET_LIST, $branch, $inventory, $type, $from, $to, $key, $limit, $page);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $api = sprintf(API_INVENTORY_MANAGE_GET_COUNT_TAB, $branch, $inventory, $from, $to, $type, $key);
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
                $config['data']['list'][$i]['employee'] = '<img onerror="imageDefaultOnLoadError($(this))" onclick="modalImageComponent(' . "'" . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_avatar'] . "'" . ')" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['list'][$i]['employee_avatar'] . '" class="img-inline-name-data-table">
                                                           <label class="title-name-new-table" >' . $config['data']['list'][$i]['employee_full_name'] . '<br>
                                                               <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['list'][$i]['employee_role_name'] . '</label>
                                                           </label>';
                $config['data']['list'][$i]['created_at']='<label>' . $this->convertDateTime($config['data']['list'][$i]['created_at']) . '</label>';
                $config['data']['list'][$i]['total_material'] = $this->numberFormat($config['data']['list'][$i]['total_material']);
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount']);
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm float-right">
                                                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailInInventoryInventoryManage(' . $config['data']['list'][$i]['id'] . ')" data-toggle="tooltip" data-placement="bottom" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                          </div>';
            }
            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'key' => $key,
                'page' => $page,
                'config' => $configAll,
            );
            $config_count = $configAll[1];
            $data_table['warehouse_inner_session_another'] = $this->numberFormat($config_count['data']['warehouse_inner_session_another']);
            $data_table['warehouse_inner_session_kitchen'] = $this->numberFormat($config_count['data']['warehouse_inner_session_kitchen']);
            $data_table['warehouse_inner_session_bar'] = $this->numberFormat($config_count['data']['warehouse_inner_session_bar']);
            $data_table['warehouse_inner_session_employee_sale'] = $this->numberFormat($config_count['data']['warehouse_inner_session_employee_sale']);
            $data_table['warehouse_inner_session_food'] = $this->numberFormat($config_count['data']['warehouse_inner_session_food']);
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_RETURN_INVENTORY_MANAGER_GET_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $config['data']['employee_avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) .  $config['data']['employee_avatar'];
            switch ($config['data']['branch_inner_inventory_type']) {
                case Config::get('constants.type.ExportInventoryTypeEnum.BAR'):
                    $config['data']['inventory'] = TEXT_INVENTORY_BAR;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.KITCHEN'):
                    $config['data']['inventory'] = TEXT_INVENTORY_KITCHEN;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.BUSINESS_EMPLOYEE'):
                    $config['data']['inventory'] = TEXT_BUSINESS_EMPLOYEE;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.INTERNAL'):
                    $config['data']['inventory'] = TEXT_USE_INTERNAL;
                    break;
                case Config::get('constants.type.ExportInventoryTypeEnum.OTHER'):
                    $config['data']['inventory'] = TEXT_OTHER;
                    break;
                default :
                    $config['data']['inventory'] = TEXT_UNKNOWN;
            }

            for ($i = 0 ; $i < count($config['data']['details']); $i++){
                $config['data']['details'][$i]['total_amount'] = $config['data']['details'][$i]['unit_price'] * $config['data']['details'][$i]['quantity'];
            }
            $data_table = Datatables::of($config['data']['details'])
                ->addColumn('restaurant_material_name', function ($row) {
                    $unit = ($row['material_unit_type'] === Config::get('constants.type.ExportInventoryTypeEnum.BAR')) ? $row['unit_specification_exchange_name'] : $row['unit_full_name'];
                    return $row['restaurant_material_name'] . '<br>
                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                    <i class="fi-rr-hastag"></i>
                    <label class="m-0">' .  $unit . '</label>
                    </div>';
                })
                ->addColumn('user_input_quantity', function ($row) {
                    return ($row['material_unit_type'] === 2) ? $this->numberFormat($row['small_quantity']) : $this->numberFormat($row['quantity']);
                })
                ->addColumn('user_input_price', function ($row) {
                    return ($row['material_unit_type'] === 2) ? $this->numberFormat($row['unit_price']/$row['unit_specification_exchange_value']) : $this->numberFormat($row['unit_price']);
                })
                ->addColumn('total_price', function ($row) {
                    return $this->numberFormat($row['total_price']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['restaurant_material_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['restaurant_material_name', 'action', 'total_price'])
                ->addIndexColumn()
                ->make(true);
            return [$data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
