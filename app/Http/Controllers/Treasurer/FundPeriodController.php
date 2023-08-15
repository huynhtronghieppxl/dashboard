<?php

namespace App\Http\Controllers\Treasurer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class FundPeriodController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ADDITION_FEE_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Kỳ quỹ';
        return view('treasurer.fund_period.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FUND_PERIOD_GET_LIST, $branch);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $dataWaiting = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.PENDING'))->toArray();
            $totalOpenWaiting = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.PENDING'))->sum('openning_amount');
            $totalInWaiting = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.PENDING'))->sum('in_amount');
            $totalOutWaiting = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.PENDING'))->sum('out_amount');
            $totalOrderWaiting = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.PENDING'))->sum('order_amount');
            $totalCloseWaiting = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.PENDING'))->sum('closing_amount');
            $totalChangeWaiting = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.PENDING'))->sum('changing_amount');

            $dataDone = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.COMPLETED'))->toArray();
            $totalOpenDone = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.COMPLETED'))->sum('openning_amount');
            $totalInDone = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.COMPLETED'))->sum('in_amount');
            $totalOutDone = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.COMPLETED'))->sum('out_amount');
            $totalOrderDone = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.COMPLETED'))->sum('order_amount');
            $totalCloseDone = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.COMPLETED'))->sum('closing_amount');
            $totalChangeDone = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.COMPLETED'))->sum('changing_amount');

            $dataCancel = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.CANCELED'))->toArray();
            $totalOpenCancel = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.CANCELED'))->sum('openning_amount');
            $totalInCancel = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.CANCELED'))->sum('in_amount');
            $totalOutCancel = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.CANCELED'))->sum('out_amount');
            $totalOrderCancel = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.CANCELED'))->sum('order_amount');
            $totalCloseCancel = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.CANCELED'))->sum('closing_amount');
            $totalChangeCancel = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.CANCELED'))->sum('changing_amount');

            $tableWaiting = $this->drawTableFundPeriodTreasurer($dataWaiting);
            $tableDone = $this->drawTableFundPeriodTreasurer($dataDone);
            $tableCancel = $this->drawTableFundPeriodTreasurer($dataCancel);

            $totalLastClosingAmount = $collection->where('status', Config::get('constants.type.RestaurantBudgetStatusEnum.COMPLETED'))->sum('last_closing_amount');
            $total = [
                'total_record_waiting' => $this->numberFormat(count($dataWaiting)),
                'data_total_opening_amount_waiting' => $this->numberFormat($totalOpenWaiting),
                'data_total_in_amount_waiting' => $this->numberFormat($totalInWaiting),
                'data_total_out_amount_waiting' => $this->numberFormat($totalOutWaiting),
                'data_total_order_amount_waiting' => $this->numberFormat($totalOrderWaiting),
                'data_total_closing_amount_waiting' => $this->numberFormat($totalCloseWaiting),
                'data_total_changing_amount_waiting' => $this->numberFormat($totalChangeWaiting),

                'total_record_done' => $this->numberFormat(count($dataDone)),
                'data_total_opening_amount_done' => $this->numberFormat($totalOpenDone),
                'data_total_in_amount_done' => $this->numberFormat($totalInDone),
                'data_total_out_amount_done' => $this->numberFormat($totalOutDone),
                'data_total_order_amount_done' => $this->numberFormat($totalOrderDone),
                'data_total_closing_amount_done' => $this->numberFormat($totalCloseDone),
                'data_total_changing_amount_done' => $this->numberFormat($totalChangeDone),
                'data_total_last_closing_amount_done' => $this->numberFormat($totalLastClosingAmount),
                'data_total_change_last_closing_amount_done' => $this->numberFormat($totalLastClosingAmount - $totalCloseDone),

                'total_record_cancel' => $this->numberFormat(count($dataCancel)),
                'data_total_opening_amount_cancel' => $this->numberFormat($totalOpenCancel),
                'data_total_in_amount_cancel' => $this->numberFormat($totalInCancel),
                'data_total_out_amount_cancel' => $this->numberFormat($totalOutCancel),
                'data_total_order_amount_cancel' => $this->numberFormat($totalOrderCancel),
                'data_total_closing_amount_cancel' => $this->numberFormat($totalCloseCancel),
                'data_total_changing_amount_cancel' => $this->numberFormat($totalChangeCancel),
            ];
            return [$tableWaiting, $tableDone, $tableCancel, $total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTableFundPeriodTreasurer($data)
    {
        return DataTables::of($data)
            ->addColumn('name', function ($row) {
                return $row['name'] . '<br>' . $row['from'] . '-' . $row['to'];
            })
            ->addColumn('employee_name', function ($row) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $row['employee_avatar']  . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $row['employee_name']  . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle"></i>' . $row['employee_role_name']  . '</label>
                         </label>';
            })
            ->addColumn('employee_complete_name', function ($row) {
                $row['employee_complete_avatar'] = '';
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $row['employee_complete_avatar']  . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $row['employee_complete_name']  . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle"></i>' . $row['employee_complete_role_name']  . '</label>
                         </label>';
            })
            ->addColumn('openning_amount', function ($row) {
                return $this->numberFormat($row['openning_amount']);
            })
            ->addColumn('in_amount', function ($row) {
                return $this->numberFormat($row['in_amount']);
            })
            ->addColumn('out_amount', function ($row) {
                return $this->numberFormat($row['out_amount']);
            })
            ->addColumn('order_amount', function ($row) {
                return $this->numberFormat($row['order_amount']);
            })
            ->addColumn('closing_amount', function ($row) {
                return $this->numberFormat($row['closing_amount']);
            })
            ->addColumn('changing_amount', function ($row) {
                return $this->numberFormat($row['changing_amount']);
            })
            ->addColumn('last_closing_amount', function ($row) {
                return $this->numberFormat($row['last_closing_amount']);
            })
            ->addColumn('changing_last_closing_amount', function ($row) {
                return $this->numberFormat($row['last_closing_amount'] - $row['closing_amount']);
            })
            ->addColumn('action', function ($row) {
                $detail = TEXT_DETAIL;
                $confirm = TEXT_CONFIRM;
                $cancel = TEXT_CANCEL;
                switch ($row['status']) {
                    case Config::get('constants.type.RestaurantBudgetStatusEnum.PENDING'):
                        $row['employee_complete_avatar'] = '';
                        $row['action'] = '<div class="btn-group btn-group-sm">
                                            <button type="button" class="btn seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $confirm . '" onclick="confirmFundPeriodTreasurer($(this))"  data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" data-amount="' . $this->numberFormat($row['closing_amount']) . '"><i class="fi-rr-check"></i></button></br>
                                            <button type="button" class="btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $cancel . '" onclick="cancelFundPeriodTreasurer(' . $row['id'] . ',' . $row['branch_id'] . ')"><i class="fi-rr-cross"></i></button>
                                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" onclick="openModalDetailFundPeriodTreasurer($(this))" data-img-employee="' . $row['employee_avatar'] . '" data-status="'. $row['status'] .'" data-img-employee-complete="' . $row['employee_complete_avatar'] . '" data-id="' . $row['id'] . '" data-from="' . $row['from'] . '" data-to="' . $row['to'] . '" data-name="' . $row['name'] . '" data-note="' . $row['note'] . '" data-employee="' . $row['employee_name'] . '" data-employee-complete="' . $row['employee_complete_name'] . '" data-openning="' . $this->numberFormat($row['openning_amount']) . '" data-in="' . $this->numberFormat($row['in_amount']) . '" data-out="' . $this->numberFormat($row['out_amount']) . '" data-order="' . $this->numberFormat($row['order_amount']) . '" data-closing="' . $this->numberFormat($row['closing_amount']) . '" data-changing="' . $this->numberFormat($row['changing_amount']) . '" data-status="' . $row['status'] . '" data-status-name="' . $row['status_name'] . '" data-branch="' . $row['branch_id'] . '"><i class="fi-rr-eye"></i></button>
                                        </div>';
                        break;
                    case Config::get('constants.type.RestaurantBudgetStatusEnum.COMPLETED'):
                        $row['action'] = '<div class="btn-group btn-group-sm">
                                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" onclick="openModalDetailFundPeriodTreasurer($(this))" data-img-employee="' . $row['employee_avatar'] . '" data-status="'. $row['status'] .'" data-img-employee-complete="' . $row['employee_complete_avatar'] . '" data-id="' . $row['id'] . '" data-from="' . $row['from'] . '" data-to="' . $row['to'] . '" data-name="' . $row['name'] . '" data-note="' . $row['note'] . '" data-employee="' . $row['employee_name'] . '" data-employee-complete="' . $row['employee_complete_name'] . '" data-openning="' . $this->numberFormat($row['openning_amount']) . '" data-in="' . $this->numberFormat($row['in_amount']) . '" data-out="' . $this->numberFormat($row['out_amount']) . '" data-order="' . $this->numberFormat($row['order_amount']) . '" data-closing="' . $this->numberFormat($row['closing_amount']) . '" data-changing="' . $this->numberFormat($row['changing_amount']) . '" data-status="' . $row['status'] . '" data-status-name="' . $row['status_name'] . '" data-branch="' . $row['branch_id'] . '"><i class="fi-rr-eye"></i></button>
                                        </div>';
                        break;
                    case Config::get('constants.type.RestaurantBudgetStatusEnum.CANCELED'):
                        $row['action'] = '';
                        break;
                }
                return $row['action'];
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate([$row['name'], $row['from'], $row['to'], $row['employee_name'], $row['employee_complete_name']]);
            })
            ->rawColumns(['name', 'status_text', 'action','employee_name','employee_complete_name'])
            ->addIndexColumn()
            ->make(true);
    }

    public function confirm(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $note = $request->get('note');
        $lastClosingAmount = $request->get('last_closing_amount');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_FUND_PERIOD_POST_CONFIRM, $id);
        $body = [
            'branch_id' => $branch,
            'id' => $id,
            'note' => sprintf($note),
            'last_closing_amount' => $lastClosingAmount
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function cancel(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $reason = $request->get('reason');
        $note = Config::get('constants.type.data.NONE');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_FUND_PERIOD_POST_CANCEL, $id);
        $body = [
            'branch_id' => $branch,
            'id' => $id,
            'note' => $note,
            'reason' => $reason
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = 100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $api = sprintf(API_FUND_PERIOD_GET_DETAIL, $id, $type, $page, $limit, $key);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_FUND_PERIOD_GET_TAB_DETAIL, $id, $type, $key);
        $body = null;
        $requestTab = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestList, $requestTab]);
        try {
            $config = $configAll[0];
            $detail = TEXT_DETAIL;

            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                $config['data']['list'][$i]['addition_fee_time'] = $this->convertDateTime($config['data']['list'][$i]['addition_fee_time']);
                if ($type == Config::get('constants.type.addition_fee.IN')) {
                    $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" onclick="openModalDetailReceiptsBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch_id'] . ')"><i class="fi-rr-eye"></i></button>
                           </div>';
                } else {
                    $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" onclick="openModalDetailPaymentBill(' . $config['data']['list'][$i]['id'] . ',' . $config['data']['list'][$i]['branch_id'] . ')"><i class="fi-rr-eye"></i></button>
                           </div>';
                }
            }
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_record' => $this->numberFormat($config['data']['total_record']),
                'key' => $key,
                'page' => $page,
                'config' => $configAll
            );
            $config_count = $configAll[1];
            $dataTable['in_count'] = $this->numberFormat($config_count['data']['budget_in_tab']);
            $dataTable['out_count'] = $this->numberFormat($config_count['data']['budget_out_tab']);
            $dataTable['total_amount'] = $this->numberFormat($config_count['data']['total_amount']);
            $dataTable['total_payment'] = $this->numberFormat($config_count['data']['total_payment']);
            $dataTable['total_receipt'] = $this->numberFormat($config_count['data']['total_receipt']);
            return json_encode($dataTable);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
