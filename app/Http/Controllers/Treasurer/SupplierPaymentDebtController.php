<?php

namespace App\Http\Controllers\Treasurer;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SupplierPaymentDebtController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ADDITION_FEE_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }

        $active_nav = 'NCC nhắc nợ';
        return view('treasurer.supplier_payment_debt.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $supplierID = ENUM_GET_ALL;
        $restaurantBrandID =  $request->get('restaurant') ;
        $branchID= $request->get('branch');
        $status = Config::get('constants.type.paymentDebtEnumStatus.ALL_ENABLE');
        $fromDate= $request->get('dateForm');
        $toDate= $request->get('dateTo');;
        $isDelete = ENUM_DIS_SELECTED;
        $keySearch = ENUM_ID_NONE;
        $limit = ENUM_DEFAULT_LIMIT_100;
        $page = ENUM_DEFAULT_PAGE;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_PAYMENT_GET_DEBT, $supplierID, $restaurantBrandID, $branchID, $status , $fromDate, $toDate, $isDelete, $keySearch, $limit , $page);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try{
            $collect = collect($config['data']['list']);
            $dataWaiting = $collect->where('status',  (int)Config::get('constants.type.paymentDebtEnumStatus.SENT'))->all();
            $dataComplete = $collect->where('status',  (int)Config::get('constants.type.paymentDebtEnumStatus.PROCESSED'))->all();
            $dataTableWaiting = $this-> dataTablePaymentDebt($dataWaiting);
            $dataTableComplete = $this-> dataTablePaymentDebt($dataComplete);

            $dataTotal = [
                'total_waiting' => count($dataWaiting),
                'total_complete' => count($dataComplete),
            ];
            return  [$dataTableWaiting , $dataTableComplete , $dataTotal ,$config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataTablePaymentDebt($data)
    {
        return DataTables::of($data)
            ->addColumn('total_amount', function ($row) {
                return  $this->numberFormat($row['total_amount']);
            })
            ->addColumn('number_order', function ($row) {
                return count($row['supplier_order_ids']);
            })
            ->addColumn('date', function ($row) {
                return $row['from_date'] . ' - ' . $row['to_date'];
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('action', function ($row) {
                $detail = TEXT_DETAIL;
                $confirm = TEXT_CONFIRM;
                switch ((int)$row['status']){
                    case (int)Config::get('constants.type.paymentDebtEnumStatus.SENT'):
                        return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light pointer" data-toggle="tooltip" data-placement="top" data-original-title="'. $confirm .'" onclick="changeStatusPaymentDebt($(this))" data-id="'. $row['id'] .'"><i class="fi-rr-check"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="'. $detail .'" onclick="openModalDetailPaymentDebtTreasurer($(this))" data-supplier="'. $row['supplier_id'] .'"  data-id="'. $row['id'] .'"><i class="fi-rr-eye"></i></button>
                                </div>';
                    case (int)Config::get('constants.type.paymentDebtEnumStatus.PROCESSED'):
                        return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="'. $detail .'" onclick="openModalDetailPaymentDebtTreasurer($(this))" data-supplier="'. $row['supplier_id'] .'" data-id="'. $row['id'] .'" ><i class="fi-rr-eye"></i></button>
                                </div>';
                }
            })
            ->rawColumns(['action', 'date'])
            ->addIndexColumn()
            ->make();
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SUPPLIER_PAYMENT_POST_CHANGE_STATUS_DEBT, $id);
        $body = null;
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $supplierID = $request->get('supplier');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_PAYMENT_GET_DETAIL_DEBT, $id , $supplierID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $configDetail = $config;
        $list_id = implode(',',$config['data']['supplier_order_ids']);
        $dataDetail = $config['data'];

        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_PAYMENT_GET_LIST_ORDER_BY_LIST_ID_DEBT, $list_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $dataTablePaymentDebt = DataTables::of($config['data'])
                ->addColumn('total_amount_reality', function ($row) {
                    return $this->numberFormat($row['total_amount_reality']);
                })
                ->addColumn('date', function ($row){
                    return mb_strlen($row['received_at']) > 10 ? mb_substr($row['received_at'], 0, 10) : $row['received_at'];
                })
                ->addColumn('status_text', function ($row){
                    return '<div class="seemt-green seemt-border-green status-new">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">'. TEXT_DONE .'</label>
                            </div>';
                })
                ->addColumn('action', function ($row) {
                    $detail = TEXT_DETAIL;
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $row['id'] . ', ' . $row['branch_id'] . ', ' . $row['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['action', 'status_text'])
                ->addIndexColumn()
                ->make();
            return [$dataTablePaymentDebt , $dataDetail , $configDetail ,$config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
