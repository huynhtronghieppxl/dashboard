<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class AdvanceSalaryEmployeeController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ADDITION_FEE_MANAGER', 'ACCOUNTANT_ACCESS', 'CASHIER_ACCESS']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(2);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Chi ứng lương';
        return view('treasurer.advance_salary_employee.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $month = Carbon::createFromFormat('m/Y', $request ->get('month'));
        if($month->isCurrentMonth()) {
            $from_date = $month->startOfMonth()->format('d/m/Y');
            $to_date = Carbon::now()->format('d/m/Y');
        }else{
            $from_date = '01/'.$request ->get('month');
            $to_date = $month->endOfMonth()->format('d/m/Y');
        }
        $status = "";
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
//        $api = sprintf(API_SALARY_EMPLOYEE_GET_ADVANCE, $branch, $status);
        $api = sprintf('/employee-salary-additions/addvanced-salary?branch_id=%s&status=%s&from_date=%s&to_date=%s', $branch, $status, $from_date, $to_date);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $dataWaiting = $collection->where('status', Config::get('constants.type.StatusAdvanceSalaryTypeEnum.APPROVED'))->all();
            $amountWaiting = $collection->where('status', Config::get('constants.type.StatusAdvanceSalaryTypeEnum.APPROVED'))->sum('amount');
            $dataReject = $collection->where('status', Config::get('constants.type.StatusAdvanceSalaryTypeEnum.REJECTED'))->all();
            $amountReject = $collection->where('status', Config::get('constants.type.StatusAdvanceSalaryTypeEnum.REJECTED'))->sum('amount');
            $dataDone = $collection->where('status', Config::get('constants.type.StatusAdvanceSalaryTypeEnum.PAID'))->all();
            $amountDone = $collection->where('status', Config::get('constants.type.StatusAdvanceSalaryTypeEnum.PAID'))->sum('amount');
            $payment = TEXT_ADDITION_FEE;
            $reject = TEXT_DENIED;
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $dataTableWaiting = DataTables::of($dataWaiting)
                ->addColumn('employee_name', function ($row) use ($domain) {
                    if (mb_strlen($row['employee']['name']) > 30) {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee']['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . mb_substr($row['employee']['name'], 0, 27) . '...' . '<br>
                        <label class="label-new-table">
                        <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee']['role_name'] . '</label></label>';
                    } else {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee']['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . $row['employee']['name'] . '<br>
                        <label class="label-new-table">
                        <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee']['role_name'] . '</label></label>';
                        }
                    })
                ->addColumn('employee_approved', function ($row) use ($domain) {
                    if (mb_strlen($row['employee_approved']['name']) > 30) {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee_approved']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee_approved']['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . mb_substr($row['employee_approved']['name'], 0, 27) . '...' . '<br>
                        <label class="label-new-table">
                        <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_approved']['role_name'] . '</label></label>';
                    } else {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee_approved']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee_approved']['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . $row['employee_approved']['name'] . '<br>
                        <label class="label-new-table">
                        <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_approved']['role_name'] . '</label></label>';
                    }
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('approved_at', function ($row) {
                    return mb_substr($row['approved_at'], 0, 11);
                })
                ->addColumn('reason', function ($row) {

                    if (mb_strlen($row['reason']) > 30) {
                        return mb_substr($row['reason'], 0, 27) . '...';
                    } else {
                        return $row['reason'];
                    }
                })
                ->addColumn('action', function ($row) use ($payment, $reject) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $payment . '" onclick="paymentAdvanceSalaryEmployeeTreasurer(' . $row['id'] . ',' . $row['branch_id'] . ',' . $row['employee']['id'] . ')" ><i class="fi-rr-sack-dollar"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $reject . '" onclick="rejectAdvanceSalaryEmployeeTreasurer(' . $row['id'] . ',' . $row['branch_id'] . ',' . $row['employee']['id'] . ')" ><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="'. TEXT_DETAIL .'" onclick="openModalDetailAdvanceSalaryEmployee($(this))" data-id="'. $row['id'] .'" ><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'reason','employee_name','employee_approved'])
                ->addIndexColumn()
                ->make();
            $dataTableDone = DataTables::of($dataDone)
                ->addColumn('employee_name', function ($row) use ($domain) {
                    if (mb_strlen($row['employee']['name']) > 30) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee']['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . mb_substr($row['employee']['name'], 0, 27) . '...' . '<br>
                        <label class="label-new-table">
                        <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee']['role_name'] . '</label></label>';
                } else {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee']['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . $row['employee']['name'] . '<br>
                        <label class="label-new-table">
                        <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee']['role_name'] . '</label></label>';
                }
                })
                ->addColumn('employee_paid', function ($row) use ($domain) {
                    if (mb_strlen($row['employee_paid']['name']) > 30) {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee_paid']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee_paid']['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . mb_substr($row['employee_paid']['name'], 0, 27) . '...' . '<br>
                        <label class="label-new-table">
                        <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_paid']['role_name'] . '</label></label>';
                    } else {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee_approved']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee_paid']['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . $row['employee_paid']['name'] . '<br>
                        <label class="label-new-table">
                        <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_paid']['role_name'] . '</label></label>';
                    }
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('paid_at', function ($row) {
                    return mb_substr($row['paid_at'], 0, 11);
                })
                ->addColumn('reason', function ($row) {
                    if (mb_strlen($row['reason']) > 30) {
                        return mb_substr($row['reason'], 0, 27) . '...';
                    } else {
                        return $row['reason'];
                    }
                })
                ->addColumn('action', function ($row) use ($payment, $reject) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="'. TEXT_DETAIL .'" onclick="openModalDetailAdvanceSalaryEmployee($(this))" data-id="'. $row['id'] .'" ><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'reason','employee_name','employee_paid','paid_at'])
                ->addIndexColumn()
                ->make();

            $dataTableReject = DataTables::of($dataReject)
                ->addColumn('employee_name', function ($row) use ($domain) {
                    if (mb_strlen($row['employee']['name']) > 30) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee']['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . mb_substr($row['employee']['name'], 0, 27) . '...' . '<br>
                        <label class="label-new-table">
                        <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee']['role_name'] . '</label></label>';
                } else {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee']['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . $row['employee']['name'] . '<br>
                        <label class="label-new-table">
                        <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee']['role_name'] . '</label></label>';
                }
                })
                ->addColumn('employee_cancel', function ($row) use ($domain) {
                    if (mb_strlen($row['employee_cancel']['name']) > 30) {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee_cancel']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee_cancel']['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . mb_substr($row['employee_cancel']['name'], 0, 27) . '...' . '<br>
                        <label class="label-new-table">
                        <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_cancel']['role_name'] . '</label></label>';
                    } else {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee_cancel']['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee_cancel']['avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . $row['employee_cancel']['name'] . '<br>
                        <label class="label-new-table">
                        <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_cancel']['role_name'] . '</label></label>';
                }
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('canceled_at', function ($row) {
                    return mb_substr($row['canceled_at'], 0, 11);
                })
                ->addColumn('reason', function ($row) {
                    if (mb_strlen($row['reason']) > 30) {
                        return mb_substr($row['reason'], 0, 27) . '...';
                    } else {
                        return $row['reason'];
                    }
                })
                ->addColumn('action', function ($row) use ($payment, $reject) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="'. TEXT_DETAIL .'" onclick="openModalDetailAdvanceSalaryEmployee($(this))" data-id="'. $row['id'] .'" ><span class="fi-rr-eye"></span></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'reason','employee_name','employee_cancel'])
                ->addIndexColumn()
                ->make();
            $dataTotal = [
                'total_record_waiting' => $this->numberFormat(count($dataWaiting)),
                'total_amount_waiting' => $this->numberFormat($amountWaiting),
                'total_record_reject' => $this->numberFormat(count($dataReject)),
                'total_amount_reject' => $this->numberFormat($amountReject),
                'total_record_done' => $this->numberFormat(count($dataDone)),
                'total_amount_done' => $this->numberFormat($amountDone),
            ];
            return [$dataTableWaiting, $dataTableDone, $dataTableReject, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function confirm(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $employee = $request->get('employee');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_SALARY_EMPLOYEE_POST_CONFIRM_ADVANCE, $id);
        $body = [
            'branch_id' => $branch,
            'employee_id' => $employee,
            'id' => $id,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function reject(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $employee = $request->get('employee');
        $reason = $request->get('reason');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_SALARY_EMPLOYEE_POST_REJECT_ADVANCE, $id);
        $body = [
            'branch_id' => $branch,
            'employee_id' => $employee,
            'id' => $id,
            'cancel_reason' => $reason
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api , $body);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');;
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_DETAIL_ADVANCE_SALARY_EMPLOYEE, $id);
        $body = null;;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['data']['status'] === 2) {
                $config['data']['status_name'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">Đã duyệt</label>
                                                  </div>';
            } else if ($config['data']['status'] === 4) {
                $config['data']['status_name'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">Đã chi tiền</label>
                                                  </div>';
            } else if ($config['data']['status'] === 3) {
                $config['data']['status_name'] = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">Từ chối</label>
                                                  </div>';
            }
            $config['data']['employee_approved']['avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee_approved']['avatar'];
            $config['data']['employee']['avatar'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['employee']['avatar'];

        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
        return $config;
    }
}
