<?php

namespace App\Http\Controllers\Report;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class MaterialInternalReportController extends Controller
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
        $active_nav = 'Kho bộ phận';
        return view('report.material_internal.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $from = $request->get('from');
        $to = $request->get('to');
        $type = ENUM_REPORT_TYPE_OPTION_DAY;
        $material_category_type_parent_id =  Config::get('constants.type.MaterialCategoryParentId.MATERIAL');
        $api = sprintf(API_REPORT_GET_MATERIAL_INTERNAL_V2, $brand, $branch, $from, $to, $material_category_type_parent_id, $type);
        $body = null;
        $requestKitchen = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $material_category_type_parent_id =  Config::get('constants.type.MaterialCategoryParentId.GOODS');
        $api = sprintf(API_REPORT_GET_MATERIAL_INTERNAL_V2, $brand, $branch, $from, $to, $material_category_type_parent_id, $type);
        $body = null;
        $requestBar = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestKitchen, $requestBar]);
        try {
            $data_kitchen = $this->drawTableMaterialReport($configAll[0]['data']);
            $data_bar = $this->drawTableMaterialReport($configAll[1]['data']);
            $data_total_record_kitchen = count($configAll[0]['data']);
            $data_total_record_bar = count($configAll[1]['data']);
            $data_total = $this->totalDataMaterialReport($configAll);
            return [$data_kitchen, $data_bar, $data_total_record_kitchen, $data_total_record_bar, $data_total, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function drawTableMaterialReport($data)
    {
        return Datatables::of($data)
            ->addColumn('unit', function ($row) {
                return (mb_strlen($row['name']) > 50) ? mb_substr($row['name'], 0, 47) . '...' : $row['name'];
            })
            ->addColumn('material_category_name', function ($row) {
                return (mb_strlen($row['material_category_name']) > 30) ? $row['material_category_name'] = mb_substr($row['material_category_name'], 0, 27) . '...' : $row['material_category_name'];
            })
            ->addColumn('confirm_system_quantity', function ($row) {
                $class = ($row['confirm_system_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['confirm_system_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['confirm_system_quantity']) . '</label>';
            })
            ->addColumn('wastage_rate', function ($row) {
                $class = ($row['wastage_rate'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['wastage_rate']) . '</label>';
            })
            ->addColumn('import_quantity', function ($row) {
                $class = ($row['import_quantity'] == 0) ? 'number-order-hidden' : '';
//                if ($row['material_category_type_parent_id'] == Config::get('constants.type.inventory.GOODS')) {
                return '<label class="' . $class . '">' . $this->numberFormat($row['import_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['import_quantity']) . '</label>';
//                }else{
//                    return ($row['material_category_type_parent_id'] === Config::get('constants.type.inventory.GOODS')) ? $this->numberFormat($row['small_import_quantity']) : $this->numberFormat($row['import_quantity']);
//                }
            })
            ->addColumn('export_quantity', function ($row) {
                $class = ($row['export_quantity'] == 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['export_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['export_quantity']) . '</label>';

//                if ($row['material_category_type_parent_id'] == Config::get('constants.type.inventory.GOODS')) {
//                    return '<label class="' . $class . '">' . $this->numberFormat($row['export_quantity']) . '<em>' .$row['material_unit_name']. '</em>' . '</label><br>
//                       <label class="number-order ' . $class . '"> ' . $this->numberFormat($row['small_export_quantity']) . '<em>' .$row['material_unit_specification_exchange_name']. '</em></label>';
//                }else{
//                    return ($row['material_category_type_parent_id'] === Config::get('constants.type.inventory.GOODS')) ? $this->numberFormat($row['small_export_quantity']) : $this->numberFormat($row['export_quantity']);
//                }
            })
            ->addColumn('cancel_quantity', function ($row) {
                $class = ($row['cancel_quantity'] == 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['cancel_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['cancel_quantity']) . '</label>';

//                if ($row['material_category_type_parent_id'] == Config::get('constants.type.inventory.GOODS')) {
//                    return '<label class="' . $class . '">' . $this->numberFormat($row['cancel_quantity']) . '<em>' .$row['material_unit_name']. '</em>' . '</label><br>
//                       <label class="number-order ' . $class . '"> ' . $this->numberFormat($row['small_cancel_quantity']) . '<em>' .$row['material_unit_specification_exchange_name']. '</em></label>';
//                }else{
//                    return ($row['material_category_type_parent_id'] === Config::get('constants.type.inventory.GOODS')) ? $this->numberFormat($row['small_cancel_quantity']) : $this->numberFormat($row['cancel_quantity']);
//                }
            })
            ->addColumn('return_quantity', function ($row) {
                $class = ($row['return_quantity'] == 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['return_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['return_quantity']) . '</label>';

//                if ($row['material_category_type_parent_id'] == Config::get('constants.type.inventory.GOODS')) {
//                    return '<label class="' . $class . '">' . $this->numberFormat($row['return_quantity']) . '<em>' .$row['material_unit_name']. '</em>' . '</label><br>
//                       <label class="number-order ' . $class . '"> ' . $this->numberFormat($row['small_return_quantity']) . '<em>' .$row['material_unit_specification_exchange_name']. '</em></label>';
//                }else{
//                    return ($row['material_category_type_parent_id'] === Config::get('constants.type.inventory.GOODS')) ? $this->numberFormat($row['small_return_quantity']) : $this->numberFormat($row['return_quantity']);
//                }
            })
            ->addColumn('wastage_allow_quantity', function ($row) {
                $class = ($row['wastage_allow_quantity'] === 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['wastage_allow_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['wastage_allow_quantity']) . '</label>';

//                if ($row['material_category_type_parent_id'] == Config::get('constants.type.inventory.GOODS')) {
//                    return '<label class="' . $class . '">' . $this->numberFormat($row['wastage_allow_quantity']) . '<em>' .$row['material_unit_name']. '</em>' . '</label><br>
//                       <label class="number-order ' . $class . '"> ' . $this->numberFormat($row['small_wastage_allow_quantity']) . '<em>' .$row['material_unit_specification_exchange_name']. '</em></label>';
//                } else {
//                    return ($row['material_category_type_parent_id'] === Config::get('constants.type.inventory.GOODS')) ? $this->numberFormat($row['small_wastage_allow_quantity']) : $this->numberFormat($row['wastage_allow_quantity']);
//                }
            })
            ->addColumn('system_last_quantity', function ($row) {
//                    return ($row['material_category_type_parent_id'] === Config::get('constants.type.inventory.GOODS')) ? $this->numberFormat($row['small_system_last_quantity']) : $this->numberFormat($row['system_last_quantity']);
                $class = ($row['system_last_quantity'] == 0) ? 'number-order-hidden' : '';
                return '<label class="' . $class . '">' . $this->numberFormat($row['system_last_amount']) . '</label><br>
                       <label class="number-order ' . $class . '"><em style="color: #9d9d9de6">SL: </em>' . $this->numberFormat($row['system_last_quantity']) . '</label>';
            })
            ->addColumn('name', function ($row) {
                if ($row['material_category_type_parent_id'] == Config::get('constants.type.inventory.GOODS')) {
                    return (mb_strlen($row['name']) > 30) ? mb_substr($row['name'], 0, 27) . '...' : $row['name'] .
                        '<br><div class="tag seemt-blue seemt-bg-blue d-flex" style="width: max-content;">
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">' . $row['material_unit_specification_exchange_name'] . '</label>
                            </div>';
                } else {
                    return (mb_strlen($row['name']) > 30) ? mb_substr($row['name'], 0, 27) . '...' : $row['name'] .
                        '<br><div class="tag seemt-blue seemt-bg-blue d-flex" style="width: max-content;">
                                <i class="fi-rr-hastag"></i>
                                <label class="m-0">' . $row['material_unit_full_name'] . '</label>
                            </div>';
                }
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('action', function ($row) {
                return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['id'] . ')" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                         </div>';
            })
            ->rawColumns(['action', 'return_quantity', 'wastage_rate', 'cancel_quantity', 'name', 'wastage_allow_quantity', 'confirm_system_quantity', 'system_last_quantity', 'export_quantity', 'import_quantity'])
            ->addIndexColumn()
            ->make(true);
    }

    public function totalDataMaterialReport($data)
    {
        if($data[0]['data'] != []){
            return [
                'kitchen' => [
                    'record' => $this->numberFormat(count($data[0]['data'])),
                    'total_confirm_system_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'confirm_system_amount'))),
                    'total_import_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'import_amount'))),
                    'total_export_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'export_amount'))),
                    'total_cancel_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'cancel_amount'))),
                    'total_return_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'return_amount'))),
                    'total_wastage_allow_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'wastage_allow_amount'))),
                    'total_system_last_amount' => $this->numberFormat(array_sum(array_column($data[0]['data'], 'system_last_amount'))),
                ],
                'bar' => [
                    'record' => $this->numberFormat(count($data[1]['data'])),
                    'total_confirm_system_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'], 'confirm_system_amount'))),
                    'total_import_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'], 'import_amount'))),
                    'total_export_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'], 'export_amount'))),
                    'total_cancel_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'], 'cancel_amount'))),
                    'total_return_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'], 'return_amount'))),
                    'total_wastage_allow_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'], 'wastage_allow_amount'))),
                    'total_system_last_amount' => $this->numberFormat(array_sum(array_column($data[1]['data'], 'system_last_amount'))),
                ],
            ];
        }
    }
}
