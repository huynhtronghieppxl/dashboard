<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use GuzzleHttp\Promise\Utils;

class MaterialReportController extends Controller
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
        $active_nav = 'Kho chi nhánh';
        return view('report.material.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $from = $request->get('from');
        $to = $request->get('to');
        $type = ENUM_REPORT_TYPE_OPTION_DAY;
        $material_category_type_parent_id =  Config::get('constants.type.MaterialCategoryParentId.MATERIAL');
        $api = sprintf(API_REPORT_GET_MATERIAL_BRANCH_V2, $branch, $from, $to, $material_category_type_parent_id, $type);
        $body = null;
        $requestMaterial = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $material_category_type_parent_id =  Config::get('constants.type.MaterialCategoryParentId.GOODS');
        $api = sprintf(API_REPORT_GET_MATERIAL_BRANCH_V2, $branch, $from, $to, $material_category_type_parent_id, $type);
        $body = null;
        $requestGoods = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $material_category_type_parent_id =  Config::get('constants.type.MaterialCategoryParentId.INTERNAL');
        $api = sprintf(API_REPORT_GET_MATERIAL_BRANCH_V2, $branch, $from, $to, $material_category_type_parent_id, $type);
        $body = null;
        $requestInternal = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $material_category_type_parent_id =  Config::get('constants.type.MaterialCategoryParentId.OTHER');
        $api = sprintf(API_REPORT_GET_MATERIAL_BRANCH_V2, $branch, $from, $to, 12,8);
        $body = null;
        $requestOther = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $configAll = $this->callApiMultiGatewayTemplate2([$requestMaterial, $requestGoods, $requestInternal, $requestOther]);
        try {
            $dataTableMaterial = $this->drawTableMaterialReport($configAll[0]['data']);
            $dataTableGoods = $this->drawTableGoodsReport($configAll[1]['data']);
            $dataTableInternal = $this->drawTableMaterialReport($configAll[2]['data']);
            $dataTableOther = $this->drawTableMaterialReport($configAll[3]['data']);
            $dataTotal = $this->totalDataMaterialReport($configAll);
            return [$dataTableMaterial, $dataTableGoods, $dataTableInternal, $dataTableOther, $dataTotal, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function drawTableMaterialReport($data)
    {
        return Datatables::of($data)
            ->addColumn('name', function ($row) {
                return (mb_strlen($row['name']) > 20) ? (mb_substr($row['name'], 0, 17) . '...' . '<br>
                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                    <i class="fi-rr-hastag"></i>
                    <label class="m-0">' .  $row['material_unit_full_name'] . '</label>
                    </div>') : ($row['name'] .
                    '<br>
                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                    <i class="fi-rr-hastag"></i>
                    <label class="m-0">' .  $row['material_unit_full_name']  . '</label>
                    </div>');
            })
            ->addColumn('material_category_name', function ($row) {
                return (mb_strlen($row['material_category_name']) > 20) ? $row['material_category_name'] = mb_substr($row['material_category_name'], 0, 17) . '...' : $row['material_category_name'];
            })
            ->addColumn('opening_amount', function ($row) {
                $class = ($row['opening_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_opening_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['opening_quantity']) . '</label>';
            })
            ->addColumn('receive_from_supplier_amount', function ($row) {
                $class = ($row['receive_from_supplier_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_receive_from_supplier_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['receive_from_supplier_quantity']) . '</label>';
            })
            ->addColumn('receive_from_branch_amount', function ($row) {
                $class = ($row['receive_from_branch_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_receive_from_branch_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['receive_from_branch_quantity']) . '</label>';
            })
            ->addColumn('export_bar_amount', function ($row) {
                $class = ($row['export_bar_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_bar_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['export_bar_quantity']) . '</label>';
            })
            ->addColumn('export_kitchen_amount', function ($row) {
                $class = ($row['export_kitchen_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_kitchen_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['export_kitchen_quantity']) . '</label>';
            })
            ->addColumn('export_employee_amount', function ($row) {
                $class = ($row['export_employee_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_employee_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['export_employee_quantity']) . '</label>';
            })
            ->addColumn('export_outer_branch_amount', function ($row) {
                $class = ($row['export_outer_branch_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_outer_branch_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['export_outer_branch_quantity']) . '</label>';
            })
            ->addColumn('export_inner_amount', function ($row) {
                $class = ($row['export_inner_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_inner_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['export_inner_quantity']) . '</label>';
            })
            ->addColumn('export_other_amount', function ($row) {
                $class = ($row['export_other_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_other_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['export_other_quantity']) . '</label>';
            })
            ->addColumn('return_amount', function ($row) {
                $class = ($row['return_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_return_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['return_quantity']) . '</label>';
            })
            ->addColumn('cancel_amount', function ($row) {
                $class = ($row['cancel_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_cancel_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['cancel_quantity']) . '</label>';
            })
            ->addColumn('return_amount', function ($row) {
                $class = ($row['return_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_return_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['return_quantity']) . '</label>';
            })
            ->addColumn('wastage_rate', function ($row) {
                $class = ($row['wastage_rate'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">'. $this->numberFormat($row['wastage_rate']) . '</label>';
            })
            ->addColumn('wastage_allow_amount', function ($row) {
                $class = ($row['wastage_allow_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_wastage_allow_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['wastage_allow_quantity']) . '</label>';
            })
            ->addColumn('system_last_amount', function ($row) {
                $class = ($row['system_last_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_system_last_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['system_last_quantity']) . '</label>';
            })
            ->addColumn('total_receive_from_kitchen_return_amount', function ($row) {
                $class = ($row['receive_from_kitchen_return_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_receive_from_kitchen_return_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['receive_from_kitchen_return_quantity']) . '</label>';
            })
            ->addColumn('total_receive_from_bar_return_amount', function ($row) {
                $class = ($row['receive_from_bar_return_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_receive_from_bar_return_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['receive_from_bar_return_quantity']) . '</label>';
            })
            ->addColumn('action', function ($row) {
//                return '<div class="btn-group btn-group-sm">
//                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['id'] . ')" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
//                         </div>';
                return '';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['name',
                'opening_amount',
                'receive_from_supplier_amount',
                'receive_from_branch_amount',
                'export_bar_amount',
                'export_kitchen_amount',
                'export_employee_amount',
                'export_outer_branch_amount',
                'export_inner_amount',
                'export_other_amount',
                'return_amount',
                'cancel_amount',
                'wastage_allow_amount',
                'system_last_amount',
                'total_receive_from_kitchen_return_amount',
                'total_receive_from_bar_return_amount',
                'material_category_name',
                'wastage_rate',
                'action'
            ])
            ->addIndexColumn()
            ->make(true);
    }

    public function drawTableGoodsReport($data)
    {
        return Datatables::of($data)
            ->addColumn('name', function ($row) {
                return (mb_strlen($row['name']) > 30) ? mb_substr($row['name'], 0, 27) . '...' . '<br>
                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                    <i class="fi-rr-hastag"></i>
                    <label class="m-0">' . $row['material_unit_specification_exchange_name']  . '</label>
                    </div>': $row['name'] .
                    '<br>
                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                    <i class="fi-rr-hastag"></i>
                    <label class="m-0">' .$row['material_unit_specification_exchange_name']  . '</label>
                    </div>';
            })
            ->addColumn('material_category_name', function ($row) {
                return (mb_strlen($row['material_category_name']) > 30) ? $row['material_category_name'] = mb_substr($row['material_category_name'], 0, 27) . '...' : $row['material_category_name'];
            })
            ->addColumn('opening_amount', function ($row) {
                $class = ($row['opening_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_opening_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['opening_quantity']) . '</label>';
            })
            ->addColumn('receive_from_supplier_amount', function ($row) {
                $class = ($row['receive_from_supplier_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_receive_from_supplier_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['receive_from_supplier_quantity']) . '</label>';
            })
            ->addColumn('receive_from_branch_amount', function ($row) {
                $class = ($row['receive_from_branch_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_receive_from_branch_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['receive_from_branch_quantity']) . '</label>';
            })
            ->addColumn('export_bar_amount', function ($row) {
                $class = ($row['export_bar_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_bar_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['export_bar_quantity']) . '</label>';
            })
            ->addColumn('export_kitchen_amount', function ($row) {
                $class = ($row['export_kitchen_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_kitchen_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['export_kitchen_quantity']) . '</label>';
            })
            ->addColumn('export_employee_amount', function ($row) {
                $class = ($row['export_employee_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_employee_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['export_employee_quantity']) . '</label>';
            })
            ->addColumn('export_outer_branch_amount', function ($row) {
                $class = ($row['export_outer_branch_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_outer_branch_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['export_outer_branch_quantity']) . '</label>';
            })
            ->addColumn('export_inner_amount', function ($row) {
                $class = ($row['export_inner_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_inner_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['export_inner_quantity']) . '</label>';
            })
            ->addColumn('export_other_amount', function ($row) {
                $class = ($row['export_other_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_export_other_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['export_other_quantity']) . '</label>';
            })
            ->addColumn('return_amount', function ($row) {
                $class = ($row['return_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_return_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['return_quantity']) . '</label>';
            })
            ->addColumn('cancel_amount', function ($row) {
                $class = ($row['cancel_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_cancel_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['cancel_quantity']) . '</label>';
            })
            ->addColumn('wastage_rate', function ($row) {
                $class = ($row['wastage_rate'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['wastage_rate']) . '</label>';
            })
            ->addColumn('wastage_allow_amount', function ($row) {
                $class = ($row['wastage_allow_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_wastage_allow_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['wastage_allow_quantity']) . '</label>';
            })
            ->addColumn('system_last_amount', function ($row) {
                $class = ($row['system_last_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_system_last_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['system_last_quantity']) . '</label>';
            })
            ->addColumn('total_receive_from_kitchen_return_amount', function ($row) {
                $class = ($row['receive_from_kitchen_return_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_receive_from_kitchen_return_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['receive_from_kitchen_return_quantity']) . '</label>';
            })
            ->addColumn('total_receive_from_bar_return_amount', function ($row) {
                $class = ($row['receive_from_bar_return_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['total_receive_from_bar_return_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['receive_from_bar_return_quantity']) . '</label>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('action', function ($row) {
//                return '<div class="btn-group btn-group-sm">
//                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['id'] . ')" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
//                         </div>';
                return '';
            })
            ->rawColumns(['name',
                'opening_amount',
                'receive_from_supplier_amount',
                'receive_from_branch_amount',
                'export_bar_amount',
                'export_kitchen_amount',
                'export_employee_amount',
                'export_outer_branch_amount',
                'export_inner_amount',
                'export_other_amount',
                'return_amount',
                'cancel_amount',
                'wastage_allow_amount',
                'system_last_amount',
                'total_receive_from_kitchen_return_amount',
                'total_receive_from_bar_return_amount',
                'material_category_name',
                'wastage_rate',
                'action'
            ])
            ->addIndexColumn()
            ->make(true);
    }

    public function totalDataMaterialReport($data)
    {
        return [
            'material' => [
                'record' => $this->numberFormat(count($data[0]['data'])),
                'before_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'],'opening_quantity'))),
                'before_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'],'total_opening_amount'))),
                'import_branch_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'receive_from_branch_quantity'))),
                'import_branch_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'total_receive_from_branch_amount'))),
                'import_supplier_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'receive_from_supplier_quantity'))),
                'import_supplier_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'total_receive_from_supplier_amount'))),

                'import_kitchen_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'receive_from_kitchen_quantity'))),
                'import_kitchen_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'total_receive_from_kitchen_amount'))),
                'import_bar_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'receive_from_bar_quantity'))),
                'import_bar_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'total_receive_from_bar_amount'))),
                'export_branch_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'],'export_outer_branch_quantity'))),
                'export_branch_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'total_export_outer_branch_amount'))),

                'export_kitchen_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'],'export_kitchen_quantity'))),
                'export_kitchen_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'],'total_export_kitchen_amount'))),
                'export_bar_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'],'export_bar_quantity'))),
                'export_bar_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'],'total_export_bar_amount'))),
                'export_employee_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'],'export_employee_quantity'))),
                'export_employee_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'],'total_export_employee_amount'))),
                'export_inner_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'],'export_inner_quantity'))),
                'export_inner_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'],'total_export_inner_amount'))),
                'export_other_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'],'export_other_quantity'))),
                'export_other_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'],'total_export_other_amount'))),
                'return_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'],'return_quantity'))),
                'return_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'],'total_return_amount'))),
                'cancel_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'],'cancel_quantity'))),
                'cancel_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'],'total_cancel_amount'))),
                'wastage_allow_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'],'wastage_allow_quantity'))),
                'wastage_allow_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'],'total_wastage_allow_amount'))),
                'after_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'],'system_last_quantity'))),
                'after_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'],'total_system_last_amount'))),
                'receive_from_bar_return_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'],'total_receive_from_bar_return_amount'))),
                'receive_from_bar_return_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'],'receive_from_bar_return_quantity'))),
                'receive_from_kitchen_return_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'],'total_receive_from_kitchen_return_amount'))),
                'receive_from_kitchen_return_quantity' => $this->numberFormat(array_sum(array_column($data[0]['data'],'receive_from_kitchen_return_quantity'))),
            ],
            'goods' => [
                'record' => $this->numberFormat(count($data[1]['data'])),
                'before_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'opening_quantity'))),
                'before_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_opening_amount'))),
                'import_branch_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'receive_from_branch_quantity'))),
                'import_branch_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_receive_from_branch_amount'))),
                'import_supplier_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'receive_from_supplier_quantity'))),
                'import_supplier_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_receive_from_supplier_amount'))),
                'import_kitchen_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'], 'receive_from_kitchen_quantity'))),
                'import_kitchen_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'], 'total_receive_from_kitchen_amount'))),
                'import_bar_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'], 'receive_from_bar_quantity'))),
                'import_bar_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'], 'total_receive_from_bar_amount'))),
                'export_branch_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'export_outer_branch_quantity'))),
                'export_branch_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_export_outer_branch_amount'))),
                'export_kitchen_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'export_kitchen_quantity'))),
                'export_kitchen_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_export_kitchen_amount'))),
                'export_bar_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'export_bar_quantity'))),
                'export_bar_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_export_bar_amount'))),
                'export_employee_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'export_employee_quantity'))),
                'export_employee_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_export_employee_amount'))),
                'export_inner_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'export_inner_quantity'))),
                'export_inner_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_export_inner_amount'))),
                'export_other_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'export_other_quantity'))),
                'export_other_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_export_other_amount'))),
                'return_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'return_quantity'))),
                'return_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_return_amount'))),
                'cancel_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'cancel_quantity'))),
                'cancel_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_cancel_amount'))),
                'wastage_allow_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'wastage_allow_quantity'))),
                'wastage_allow_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_wastage_allow_amount'))),
                'after_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'system_last_quantity'))),
                'after_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_system_last_amount'))),
                'receive_from_bar_return_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_receive_from_bar_return_amount'))),
                'receive_from_bar_return_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'receive_from_bar_return_quantity'))),
                'receive_from_kitchen_return_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'],'total_receive_from_kitchen_return_amount'))),
                'receive_from_kitchen_return_quantity' => $this->numberFormat(array_sum(array_column($data[1]['data'],'receive_from_kitchen_return_quantity'))),
            ],
            'internal' => [
                'record' => $this->numberFormat(count($data[2]['data'])),
                'before_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'opening_quantity'))),
                'before_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_opening_amount'))),
                'import_branch_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'receive_from_branch_quantity'))),
                'import_branch_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_receive_from_branch_amount'))),
                'import_supplier_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'receive_from_supplier_quantity'))),
                'import_supplier_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_receive_from_supplier_amount'))),
                'import_kitchen_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'], 'receive_from_kitchen_quantity'))),
                'import_kitchen_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'], 'total_receive_from_kitchen_amount'))),
                'import_bar_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'], 'receive_from_bar_quantity'))),
                'import_bar_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'], 'total_receive_from_bar_amount'))),
                'export_branch_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'export_outer_branch_quantity'))),
                'export_branch_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_export_outer_branch_amount'))),
                'export_kitchen_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'export_kitchen_quantity'))),
                'export_kitchen_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_export_kitchen_amount'))),
                'export_bar_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'export_bar_quantity'))),
                'export_bar_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_export_bar_amount'))),
                'export_employee_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'export_employee_quantity'))),
                'export_employee_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_export_employee_amount'))),
                'export_inner_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'export_inner_quantity'))),
                'export_inner_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_export_inner_amount'))),
                'export_other_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'export_other_quantity'))),
                'export_other_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_export_other_amount'))),
                'return_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'return_quantity'))),
                'return_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_return_amount'))),
                'cancel_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'cancel_quantity'))),
                'cancel_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_cancel_amount'))),
                'wastage_allow_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'wastage_allow_quantity'))),
                'wastage_allow_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_wastage_allow_amount'))),
                'after_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'system_last_quantity'))),
                'after_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_system_last_amount'))),
                'receive_from_bar_return_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_receive_from_bar_return_amount'))),
                'receive_from_bar_return_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'receive_from_bar_return_quantity'))),
                'receive_from_kitchen_return_amount' => $this->numberFormat(array_sum(array_column($data[2]['data'],'total_receive_from_kitchen_return_amount'))),
                'receive_from_kitchen_return_quantity' => $this->numberFormat(array_sum(array_column($data[2]['data'],'receive_from_kitchen_return_quantity'))),
            ],
            'other' => [
                'record' => $this->numberFormat(count($data[3]['data'])),
                'before_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'opening_quantity'))),
                'before_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_opening_amount'))),
                'import_branch_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'receive_from_branch_quantity'))),
                'import_branch_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_receive_from_branch_amount'))),
                'import_supplier_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'receive_from_supplier_quantity'))),
                'import_supplier_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_receive_from_supplier_amount'))),
                'import_kitchen_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'], 'receive_from_kitchen_quantity'))),
                'import_kitchen_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'], 'total_receive_from_kitchen_amount'))),
                'import_bar_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'], 'receive_from_bar_quantity'))),
                'import_bar_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'], 'total_receive_from_bar_amount'))),
                'export_branch_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'export_outer_branch_quantity'))),
                'export_branch_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_export_outer_branch_amount'))),
                'export_kitchen_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'export_kitchen_quantity'))),
                'export_kitchen_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_export_kitchen_amount'))),
                'export_bar_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'export_bar_quantity'))),
                'export_bar_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_export_bar_amount'))),
                'export_employee_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'export_employee_quantity'))),
                'export_employee_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_export_employee_amount'))),
                'export_inner_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'export_inner_quantity'))),
                'export_inner_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_export_inner_amount'))),
                'export_other_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'export_other_quantity'))),
                'export_other_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_export_other_amount'))),
                'return_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'return_quantity'))),
                'return_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_return_amount'))),
                'cancel_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'cancel_quantity'))),
                'cancel_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_cancel_amount'))),
                'wastage_allow_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'wastage_allow_quantity'))),
                'wastage_allow_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_wastage_allow_amount'))),
                'after_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'system_last_quantity'))),
                'after_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_system_last_amount'))),
                'receive_from_bar_return_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_receive_from_bar_return_amount'))),
                'receive_from_bar_return_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'receive_from_bar_return_quantity'))),
                'receive_from_kitchen_return_amount' => $this->numberFormat(array_sum(array_column($data[3]['data'],'total_receive_from_kitchen_return_amount'))),
                'receive_from_kitchen_return_quantity' => $this->numberFormat(array_sum(array_column($data[3]['data'],'receive_from_kitchen_return_quantity'))),
            ],
        ];
    }

    public function data2(Request $request)
    {
        $branch = $request->get('branch');
        $from = $request->get('from');
        $to = $request->get('to');
        $api = sprintf(API_REPORT_GET_MATERIAL_BRANCH_V2, $branch, $from, $to, 1,8);
        $body = null;
        $requestMaterial = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_REPORT_GET_MATERIAL_BRANCH_V2, $branch, $from, $to, 2,8);
        $body = null;
        $requestGoods = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $api = sprintf(API_REPORT_GET_MATERIAL_BRANCH_V2, $branch, $from, $to, 3,8);
        $body = null;
        $requestInternal = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $api = sprintf(API_REPORT_GET_MATERIAL_BRANCH_V2, $branch, $from, $to, 12,8);
        $body = null;
        $requestOther = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $configAll = $this->callApiMultiGatewayTemplate2([$requestMaterial, $requestGoods, $requestInternal, $requestOther]);
        try {

            $dataTableMaterial = $this->drawTableMaterialReport2($configAll[0]['data']);
            $dataTableGoods = $this->drawTableMaterialReport2($configAll[1]['data']);
            $dataTableInternal = $this->drawTableMaterialReport2($configAll[2]['data']);
            $dataTableOther = $this->drawTableMaterialReport2($configAll[3]['data']);
            $dataTotal = $this->totalDataMaterialReport($configAll);
            return [$dataTableMaterial, $dataTableGoods, $dataTableInternal, $dataTableOther, $dataTotal, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function drawTableMaterialReport2($data)
    {
        $body = '';
        $i = 1;
        foreach ($data as $db) {
            $body .= '<tr>
                      <td class="text-center fixed-column-table">' . $i . '</td>
                      <td class="text-center fixed-column-table">' . $db['name'] . '</td>
                      <td class="text-center">' . $db['material_category_name'] . '</td>
                      <td class="text-center">' . $db['material_unit_full_name'] . '</td>
                      <td class="text-center">' . $this->numberFormat($db['opening_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_opening_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['receive_from_branch_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_receive_from_branch_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['receive_from_supplier_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_receive_from_supplier_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['export_outer_branch_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_export_outer_branch_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['export_kitchen_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_export_kitchen_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['export_bar_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_export_bar_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['export_employee_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_export_employee_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['export_inner_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_export_inner_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['export_other_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_export_other_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['return_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_return_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['cancel_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_cancel_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['wastage_allow_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_wastage_allow_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['system_last_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_system_last_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['receive_from_kitchen_return_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_receive_from_kitchen_return_amount']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['receive_from_bar_return_quantity']) . '</td>
                      <td class="text-center">' . $this->numberFormat($db['total_receive_from_bar_return_amount']) . '</td>
                  </tr>';
            $i++;
        }
        return $body;
    }
}
