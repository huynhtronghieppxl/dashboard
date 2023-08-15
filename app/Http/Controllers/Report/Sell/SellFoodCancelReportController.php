<?php

namespace App\Http\Controllers\Report\Sell;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SellFoodCancelReportController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'MARKETING_MANAGER', 'BUSINESS_ACTIVE_REPORT', 'SALE_REPORT', 'CASHIER_ACCESS', 'CHEF_COOK_ACCESS', 'BAR_ACCESS']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(0);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Báo Cáo Món Hủy';
        return view('report.sell.food_cancel.index', compact('active_nav'));
    }
    public function dataFoodCancelReport(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $report_type = $request->get('report_type');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $type = ENUM_STATUS_CONFIRM;
        $sort_type = $request->get('sortSelect');
        $time = $request->get('time');
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_FOOD_CANCEL, $brand, $branch, $sort_type, $report_type, $time, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $detail = TEXT_DETAIL;
            $isGift = ENUM_DIS_SELECTED;
            $isCancel = ENUM_SELECTED;
            $dataTable = DataTables::of($data)
                ->addColumn('name', function ($row) use ($domain){
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain .$row['employee_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['employee_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table" data-role-name="'.$row['employee_role_name'].'" data-name="' . ($row['employee_name']) . '">' . ($row['employee_name']) . '<br>
                             <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>'.$row['employee_role_name'].'</label>
                         </label>';
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('customer_slot_number', function ($row) {
                    return $this->numberFormat($row['customer_slot_number']);
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('table_name', function ($row) {
                    return $this->numberFormat($row['table_name'] === null ? '---' : $row['table_name']);
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $type, $time, $detail, $isGift, $isCancel) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-id="'. $row['order_id'] .'" data-food="' . $row['food_id'] . '" data-name="' . $row['food_name'] . '" data-gift="' . $isGift . '" data-cancel="' . $isCancel . '" data-brand="' . $brand . '" data-branch="' . $branch . '" data-is-print="1" data-type="' . $type . '" data-time="' . $time . '" data-title="Chi tiết món hủy" onclick="openBillDetail($(this))"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('day', function ($row) {
                    return date("d/m/Y", strtotime($row['day']));
                })
                ->rawColumns(['action', 'name'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total_amount' => $this->numberFormat(array_sum(array_column($data, 'total_amount'))),
                'total_quantity' => $this->numberFormat(array_sum(array_column($data, 'quantity'))),
            ];
            return [$dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }


    public function detail(Request $request)
    {
        $id = $request->get('id');
        $is_cancel = $request->get('is_cancel');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LIST_ORDER_GET_DETAIL, $id, $is_cancel);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table = Datatables::of($config['data']['foods'])
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('unit_price', function ($row) {
                    return $this->numberFormat($row['unit_price']);
                })
                ->addColumn('vat_amount', function ($row) {
                    return $this->numberFormat($row['vat_amount']) . ' (' . $row['vat_percent'] . '%)';
                })
                ->addColumn('category_food', function ($row) {
                    switch ($row['category_type']) {
                        case 1:
                            return TEXT_FOOD_FOOD;
                        case 2:
                            return TEXT_FOOD_DRINK;
                        case 3:
                            return TEXT_OTHER;
                        case 4:
                            return TEXT_SEA_FOOD;
                        default:
                    }
                })
                ->addColumn('total_price', function ($row) {
                    if ($row['is_gift'] === ENUM_SELECTED) {
                        return '<label><i class="fa fa-2x fa-gift seemt-orange" data-toggle="tooltip" data-placement="top" data-original-title="' . $this->numberFormat($row['total_price']) . '" ></i><p class="d-none">(Tặng)</p></label>';
                    } else {
                        return $this->numberFormat($row['total_price']);
                    }
                })
                ->addColumn('original_price', function ($row) {
                    return $this->numberFormat($row['original_price']);
                })
                ->addColumn('status', function ($row) {
                    switch ($row['order_detail_status']) {
                        case Config::get('constants.type.OrderFoodStatusEnum.CONFIRM'):
                            return '<div class="d-flex status-new seemt-orange seemt-border-orange" style="display: inline !important; max-width: max-content;">
                                       <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                       <label class="m-0">' . TEXT_WAITING . '</label>
                                     </div>';
                        case Config::get('constants.type.OrderFoodStatusEnum.PENDING'):
                            return '<div class="d-flex status-new seemt-blue seemt-border-blue" style="display: inline !important; max-width: max-content;">
                                       <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                       <label class="m-0">' . TEXT_WAITING_COOKING . '</label>
                                     </div>';
                        case Config::get('constants.type.OrderFoodStatusEnum.COOKING'):
                            return '<div class="d-flex status-new seemt-blue seemt-border-blue" style="display: inline !important; max-width: max-content;">
                                       <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                       <label class="m-0">' . TEXT_COOKING . '</label>
                                     </div>';
                        case Config::get('constants.type.OrderFoodStatusEnum.DONE'):
                            return '<div class="d-flex status-new seemt-green seemt-border-green" style="display: inline !important; max-width: max-content;">
                                       <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                       <label class="m-0">' . TEXT_DONE . '</label>
                                     </div>';
                        case Config::get('constants.type.OrderFoodStatusEnum.SOLD_OUT'):
                            return '<div class="d-flex status-new seemt-blue seemt-border-blue" style="display: inline !important; max-width: max-content;">
                                       <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                       <label class="m-0">' . TEXT_SOLD_OUT . '</label>
                                     </div>';
                        case Config::get('constants.type.OrderFoodStatusEnum.CANCEL'):
                            return '<div class="d-flex status-new seemt-red seemt-border-red" style="display: inline !important; max-width: max-content;">
                                       <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                       <label class="m-0">' . TEXT_SOLD_OUT . '</label>
                                     </div>';
                        case Config::get('constants.type.OrderFoodStatusEnum.WAITING_ONLINE'):
                            return '<div class="d-flex status-new seemt-orange seemt-border-orange" style="display: inline !important; max-width: max-content;">
                                       <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                       <label class="m-0">' . TEXT_WAITING_ONLINE . '</label>
                                     </div>';
                        default:
                            return '---';
                    }
                })
                ->addColumn('note', function ($row) {
                    return (mb_strlen($row['note']) > 30) ? $row['note'] = mb_substr($row['note'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['note'] . '"></i>' : $row['note'];
                })
                ->addColumn('action', function ($row) {
                    if ($row['restaurant_extra_charge_id'] == ENUM_DIS_SELECTED) {
                        if ($row['food_id'] == ENUM_DIS_SELECTED) {
                            return '<span class="text-secondary">' . Config::get('constants.reponse_text.TypeFood.NOT_BELONG_MENU') . '</span>';
                        } else {
                            $row['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');
                            return '<div class="btn-group btn-group-sm">
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" style="float: none;margin: 5px;" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['food_id'] . '" data-type="' . $row['id_type_food'] . '">
                                            <i class="fi-rr-eye"></i>
                                        </button>
                                    </div>';
                        }
                    } else {
                        return '<span class="text-secondary">' . TEXT_RESTAURANT_EXTRA_CHARGE . '</span>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['status', 'action', 'total_price', 'note'])
                ->make(true);
            $discount = $this->numberFormat($config['data']['discount_amount']);
            if ($config['data']['discount_type'] == Config::get('constants.type.discount.PERCENT')) {
                $discount = $this->numberFormat($config['data']['discount_percent']) . ' %';
            }
            $data_detail = [
                'code' => $config['data']['id'],
                'table_name' => $config['data']['table_name'],
                'customer_slot_number' => $config['data']['customer_slot_number'],
                'cashier_name' => $config['data']['cashier_name'],
                'cashier_id' => $config['data']['cashier_id'],
                'employee_name' => $config['data']['employee_name'],
                'employee_id' => $config['data']['employee_id'],
                'employee_debt_id' => $config['data']['employee_debt_id'],
                'employee_debt_name' => $config['data']['employee_debt_name'] ? $config['data']['employee_debt_name'] : 'Không có',
                'branch_phone' => $config['data']['branch_phone'],
                'branch_address' => $config['data']['branch_address'],
                'branch_name' => $config['data']['branch_name'],
                'created_at' => $config['data']['created_at'],
                'updated_at' => $config['data']['updated_at'],
                'note' => $config['data']['note'] === '' ? '---' : $config['data']['note'] ,
                'date' => $config['data']['payment_date'],
                'cash_amount' => $this->numberFormat($config['data']['amount']),
                'membership_total_point_used_amount' => $this->numberFormat($config['data']['membership_total_point_used_amount']),
                'discount' => $discount,
                'vat' => $config['data']['vat'] . '%',
                'vat_amount' => $this->numberFormat($config['data']['vat_amount']),
                'original_price' => $this->numberFormat($config['data']['original_price']),
                'rate_profit' => $this->numberFormat($config['data']['rate_profit']) . '%',
                'total_amount' => $this->numberFormat($config['data']['total_amount']),
                'total_final_amount' => $this->numberFormat($config['data']['total_final_amount']),
                'config' => $config,
                'total_record_food' => $this->numberFormat(count($config['data']['foods'])),
                'membership_accumulate_point_used' => $this->numberFormat($config['data']['membership_accumulate_point_used']),
                'membership_accumulate_point_used_amount' => $this->numberFormat($config['data']['membership_accumulate_point_used_amount']),
                'membership_alo_point_used' => $this->numberFormat($config['data']['membership_alo_point_used']),
                'membership_alo_point_used_amount' => $this->numberFormat($config['data']['membership_alo_point_used_amount']),
                'membership_point_used' => $this->numberFormat($config['data']['membership_point_used']),
                'membership_point_used_amount' => $this->numberFormat($config['data']['membership_point_used_amount']),
                'membership_promotion_point_used' => $this->numberFormat($config['data']['membership_promotion_point_used']),
                'membership_promotion_point_used_amount' => $this->numberFormat($config['data']['membership_promotion_point_used_amount']),
            ];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

        $branch_id = $data_detail['config']['data']['branch_id'];
        $object_id = $id;
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $type = Config::get('constants.type.addition_fee.GET_ALL');
        $from = '';
        $to = '';
        $is_count_to_revenue = $request->get('accounting');
        $order_session_id = ENUM_STATUS_GET_ALL;
        $addition_fee_reason_id = '';
        $addition_fee_reason_type_id = '';
        $is_take_auto_generated = ENUM_STATUS_GET_ALL;
        $status = '';
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $restaurant_budget_id = Config::get('constants.type.default.RESTAURANT_PERIOD');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $employee_id = ENUM_STATUS_GET_ALL;
        $report_type = ENUM_STATUS_GET_ALL;
        $auto_generated_type = ENUM_STATUS_GET_ALL;
        $key = '';
        $payment_method_id = ENUM_GET_ALL;
        $object_type = ENUM_STATUS_GET_ALL;
        $debt = Config::get('constants.type.checkbox.GET_ALL');
        $is_restaurant_budget_closed = Config::get('constants.type.checkbox.GET_ALL');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REASON_ADDITION_FEE_GET_DATA, $restaurant_brand_id, $branch_id, $page, $restaurant_budget_id, $from, $to, $type, $is_take_auto_generated, $order_session_id, $employee_id, $limit, $report_type, $auto_generated_type, $object_type, $addition_fee_reason_id, $addition_fee_reason_type_id, $status, $is_count_to_revenue, $key, $payment_method_id, $object_id, $debt, $is_restaurant_budget_closed);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $receipt = $collection->where('type', Config::get('constants.type.addition_fee.IN'))->toArray();
            $payment = $collection->where('type', Config::get('constants.type.addition_fee.OUT'))->toArray();
            $totalReceipt = $collection->where('type', Config::get('constants.type.addition_fee.IN'))->sum('amount');
            $totalPayment = $collection->where('type', Config::get('constants.type.addition_fee.OUT'))->sum('amount');
            $tableReceipt = Datatables::of($receipt)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('code', function ($row) {
                    if($row['is_count_to_revenue'] === ENUM_SELECTED) {
                        return '<label class="name-inline-data-table text-left">' . $row['code'] . ' <br><label class="label label-success"> Hạch toán </label></label>';
                    }else{
                        return '<label class="name-inline-data-table text-left">' . $row['code'] . ' <br><label class="label label-success"></label></label>';
                    }
                })
                ->addColumn('is_count_to_revenue_name', function ($row) {
                    return '' ;
                })
                ->addColumn('action', function ($row){
                    return '<div class="btn-group btn-group-sm">
                             <button type="button" class=" tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailReceiptsBill(' . $row['id'] . ',' . $row['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns([ 'action', 'note','code', 'is_count_to_revenue'])
                ->make(true);

            $tablePayment = Datatables::of($payment)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('is_count_to_revenue_name', function ($row) {
                    return ($row['is_count_to_revenue'] === ENUM_SELECTED) ? '<div class="btn-group btn-group-sm"><i class="seemt-green fa fa-dot-circle-o"></i></div>' : '<div class="btn-group btn-group-sm"><i class="seemt-orange fa fa-circle-o"></i></div>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                             <button type="button" class=" tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailPaymentBill(' . $row['id'] . ',' . $row['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['is_count_to_revenue_name', 'action', 'note'])
                ->make(true);

            $data_detail['total_record_receipt'] = $this->numberFormat(count($receipt));
            $data_detail['total_record_payment'] = $this->numberFormat(count($payment));
            $data_detail['total_receipt'] = $this->numberFormat($totalReceipt);
            $data_detail['total_payment'] = $this->numberFormat($totalPayment);
            $data_detail['config_addition_fee'] = $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
        return [$data_table, $tableReceipt, $tablePayment, $data_detail , $config];
    }

}
