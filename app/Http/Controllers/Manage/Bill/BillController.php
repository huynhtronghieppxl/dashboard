<?php

namespace App\Http\Controllers\Manage\Bill;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use PhpParser\Node\Stmt\DeclareDeclare;
use Yajra\DataTables\Facades\DataTables;

class BillController extends Controller
{
    public function index()
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS']);
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
        $active_nav = 'Quản lý hoá đơn';
        return view('manage.bill.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $order_status = $request->get('status');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $is_force_online = ENUM_GET_ALL;
        $area_id = ENUM_ID_NONE;
        $order_id = ENUM_ID_NONE;
        $table_ids = ENUM_ID_NONE;
        $is_apply_vat = -1;
        $is_service_restaurant_charge = $request->get('filter_status_order');
        $from = $request->get('from');
        $to = $request->get('to');
        $key_search = $this->keySearch(($request->get('search'))['value']);
        $api = sprintf(API_LIST_ORDER_GET, $restaurant_brand_id, $branch_id, $limit, $page, $order_status, $area_id, $order_id, $table_ids, $is_apply_vat, $is_service_restaurant_charge, $from, $to, $key_search);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_LIST_ORDER_GET_TOTAL, $branch_id, $order_status, $area_id, $order_id, $table_ids, $from, $to, $is_force_online,$key_search);
        $body = null;
        $requestTotal = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestList, $requestTotal]);
        try {
            $config = $configAll[0];
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                $config['data']['list'][$i]['amount'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                $config['data']['list'][$i]['vat_amount'] = $this->numberFormat($config['data']['list'][$i]['vat_amount']);
                $config['data']['list'][$i]['discount_amount'] = $this->numberFormat($config['data']['list'][$i]['discount_amount']);
                $config['data']['list'][$i]['membership_accumulate_point_used_amount'] = $this->numberFormat($config['data']['list'][$i]['membership_accumulate_point_used_amount']);
                $config['data']['list'][$i]['membership_total_point_used_amount'] = $this->numberFormat($config['data']['list'][$i]['membership_total_point_used_amount']);
                $config['data']['list'][$i]['total_amount'] = $this->numberFormat($config['data']['list'][$i]['total_amount']);
                $config['data']['list'][$i]['original_price'] = $this->numberFormat($config['data']['list'][$i]['original_price']);
                $config['data']['list'][$i]['rate_profit'] = $this->numberFormat($config['data']['list'][$i]['rate_profit']);
                $config['data']['list'][$i]['customer_name'] = $config['data']['list'][$i]['customer']['name'] === '' ? '---' : $config['data']['list'][$i]['customer']['name'];
                $config['data']['list'][$i]['membership_point_added'] = $this->numberFormat($config['data']['list'][$i]['membership_point_added']);
                if ($config['data']['list'][$i]['payment_date'] === '') {
                    $config['data']['list'][$i]['payment_date'] = '<div class="status-new seemt-blue seemt-border-blue">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">Chưa thanh toán</label>
                                                                            </div>';
                } else {
                    $config['data']['list'][$i]['payment_date'] = '<label>' . $this->convertDateTime($config['data']['list'][$i]['payment_date']) . '</label>';
                }

                switch ($config['data']['list'][$i]['order_status']) {
                    case (int)Config::get('constants.type.order_status.OPENING'):
                        $config['data']['list'][$i]['order_status_name'] = '<div class="status-new seemt-green seemt-border-green">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . $config['data']['list'][$i]['order_status_name'] . '</label>
                                                                            </div>';

                    break;
                    case (int)Config::get('constants.type.order_status.WAITING_PAYMENT'):
                    case (int)Config::get('constants.type.order_status.DELIVERING'):
                        $config['data']['list'][$i]['order_status_name'] = '<div class="status-new seemt-blue seemt-border-blue">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . $config['data']['list'][$i]['order_status_name'] . '</label>
                                                                            </div>';
                        break;
                    case (int)Config::get('constants.type.order_status.DONE'):
                        $config['data']['list'][$i]['order_status_name'] = '<div class="status-new seemt-green seemt-border-green">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . $config['data']['list'][$i]['order_status_name'] . '</label>
                                                                            </div>';
                        break;
                    case (int)Config::get('constants.type.order_status.MERGED'):
                        $config['data']['list'][$i]['order_status_name'] = '<div class="status-new seemt-green seemt-border-green">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . $config['data']['list'][$i]['order_status_name'] . '</label>
                                                                            </div>';
                        break;
                    case (int)Config::get('constants.type.order_status.PENDING'):
                    $config['data']['list'][$i]['order_status_name'] = '<div class="status-new seemt-orange seemt-border-orange">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . $config['data']['list'][$i]['order_status_name'] . '</label>
                                                                            </div>';
                        break;
                    case (int)Config::get('constants.type.order_status.WAITING_COMPLETE'):
                    $config['data']['list'][$i]['order_status_name'] = '<div class="status-new seemt-red seemt-border-red">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . $config['data']['list'][$i]['order_status_name'] . '</label>
                                                                            </div>';
                        break;
                    default:
                        $config['data']['list'][$i]['order_status_name'] = '<div class="status-new seemt-orange seemt-border-orange">
                                                                                <i class="fi-rr-time-quarter-to"></i>
                                                                                <label class="m-0">' . $config['data']['list'][$i]['order_status_name'] . '</label>
                                                                            </div>';
                }
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" data-id="' . $config['data']['list'][$i]['id'] . '" data-is-print="1" data-cancel="1" onclick="openBillDetail($(this))"><i class="fi-rr-eye"></i></button></div>';

                if ($config['data']['list'][$i]['is_service_restaurant_charge'] == 1) {
                    $config['data']['list'][$i]['is_service_restaurant_charge'] = '<div class="btn-group btn-group-sm"><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="Có tính chi phí dịch vụ"></i></div>';
                } else {
                    $config['data']['list'][$i]['is_service_restaurant_charge'] = '<div class="btn-group btn-group-sm"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="Không tính chi phí dịch vụ"></i></div>';
                }
            }

            $data_table = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_record' => $this->numberFormat($config['data']['total_record']),
                'key' => $key_search,
                'page' => $page,
                'config' => $configAll
            );
            $config = $configAll[1];
            $data_table['amount'] = $this->numberFormat($config['data']['amount']);
            $data_table['vat_amount'] = $this->numberFormat($config['data']['vat_amount']);
            $data_table['discount_amount'] = $this->numberFormat($config['data']['discount_amount']);
            $data_table['total_amount'] = $this->numberFormat($config['data']['total_amount']);
            $data_table['total_original_price'] = $this->numberFormat($config['data']['total_original_price']);
            $data_table['membership_accumulate_point_used_amount'] = $this->numberFormat($config['data']['membership_accumulate_point_used_amount']);
            $data_table['membership_point_added'] = $this->numberFormat($config['data']['membership_point_added']);
            $data_table['membership_total_point_used_amount'] = $this->numberFormat($config['data']['membership_total_point_used_amount']);
            $data_table['total_customer_slot_number'] = $this->numberFormat($config['data']['total_customer_slot_number']);
            $data_table['average_rate_profit'] = $this->numberFormat($config['data']['average_rate_profit']);
            return json_encode($data_table);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $is_cancel = ENUM_SELECTED;
        $is_print = $request->get('is_print'); //  1 : GỘP MÓN, 0: KHÔNG GỘP ( gộp món khi xem tại quản lý hóa đơn, ko gộp món khi xem tại danh sách hóa đơn )
        $api = sprintf(API_LIST_ORDER_GET_DETAIL, $id, $is_cancel, $is_print);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        // XUẤT EXCEL NÊN BUỘC GỘP MÓN ( is_print_bill = 1 )
        $is_print = ENUM_SELECTED;
        $api = sprintf(API_LIST_ORDER_GET_DETAIL, $id, $is_cancel, $is_print);
        $body = null;
        $requestExport = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        // $configAll[0]['data']['branch_id'] => $branch
        $branch_id = $branch;
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $object_id = $id;
        $type = ENUM_GET_ALL;
        $from = '';
        $to = '';
        $is_count_to_revenue = $request->get('accounting');
        $order_session_id = ENUM_STATUS_GET_ALL;
        $addition_fee_reason_id = '';
        $addition_fee_reason_type_id = '';
        $is_take_auto_generated = ENUM_STATUS_GET_ALL;
        $status = 2;
        $page = ENUM_DEFAULT_PAGE;
        $restaurant_budget_id = Config::get('constants.type.default.RESTAURANT_PERIOD');
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $employee_id = ENUM_STATUS_GET_ALL;
        $report_type = ENUM_STATUS_GET_ALL;
        $auto_generated_type = ENUM_STATUS_GET_ALL;
        $key = '';
        $payment_method_id = ENUM_GET_ALL;
        $object_type = ENUM_STATUS_GET_ALL;
        $debt = ENUM_GET_ALL;
        $is_restaurant_budget_closed = Config::get('constants.type.checkbox.GET_ALL');
        $api = sprintf(API_REASON_ADDITION_FEE_GET_DATA, $restaurant_brand_id, $branch_id, $page, $restaurant_budget_id, $from, $to, $type, $is_take_auto_generated, $order_session_id, $employee_id, $limit, $report_type, $auto_generated_type, $object_type, $addition_fee_reason_id, $addition_fee_reason_type_id, $status, $is_count_to_revenue, $key, $payment_method_id, $object_id, $debt, $is_restaurant_budget_closed);
        $body = null;
        $requestAdditionFee = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestList, $requestExport, $requestAdditionFee]);
        try {
            // Danh sách hoá đơn
            $collection = collect($configAll[0]['data']['foods']);
            $data_gift = $collection->where('is_gift', ENUM_DIS_SELECTED)->where('is_order_customer_beer_inventories', ENUM_DIS_SELECTED)->toArray();
            $data_table = $this->drawDatatableDetailBill($configAll[0], $collection);
            $data_export = $this->drawDatatableDetailBill($configAll[1], $collection);
            $discount = $this->numberFormat($configAll[0]['data']['discount_amount']);
            $discount = $this->numberFormat($configAll[0]['data']['discount_amount']) . "(" . $configAll[0]['data']['discount_percent'] . "%)";
            $data_detail = [
                'code' => $configAll[0]['data']['id'],
                'table_name' => $configAll[0]['data']['table_name'],
                'customer_slot_number' => $configAll[0]['data']['customer_slot_number'],
                'cashier_name' => $configAll[0]['data']['cashier_name'],
                'cashier_id' => $configAll[0]['data']['cashier_id'],
                'employee_name' => $configAll[0]['data']['employee_name'],
                'employee_id' => $configAll[0]['data']['employee_id'],
                'employee_debt_id' => $configAll[0]['data']['employee_debt_id'],
                'employee_debt_name' => $configAll[0]['data']['employee_debt_name'],
                'branch_phone' => $configAll[0]['data']['branch_phone'],
                'branch_address' => $configAll[0]['data']['branch_address'],
                'branch_name' => $configAll[0]['data']['branch_name'],
                'created_at' => $configAll[0]['data']['created_at'],
                'updated_at' => $configAll[0]['data']['updated_at'],
                'note' => $configAll[0]['data']['note'] === '' ? '---' : $configAll[0]['data']['note'] ,
                'payment_date' => $configAll[0]['data']['payment_date'],
                'cash_amount' => $this->numberFormat($configAll[0]['data']['amount']),
                'membership_total_point_used_amount' => $this->numberFormat($configAll[0]['data']['membership_total_point_used_amount']),
                'discount' => $discount,
                'vat' => $configAll[0]['data']['vat'] . '%',
                'vat_amount' => $this->numberFormat($configAll[0]['data']['vat_amount']),
                'original_price' => $this->numberFormat($configAll[0]['data']['original_price']),
                'rate_profit' => $this->numberFormat($configAll[0]['data']['rate_profit']) . '%',
                'total_amount' => $this->numberFormat($configAll[0]['data']['total_amount']),
                'total_final_amount' => $this->numberFormat($configAll[0]['data']['total_final_amount']),
                'discount_type' => $configAll[0]['data']['discount_type'],
                'config' => $configAll[0],
                'total_record_food' => $this->numberFormat(count($configAll[0]['data']['foods'])),
                'membership_accumulate_point_used' => $this->numberFormat($configAll[0]['data']['membership_accumulate_point_used']),
                'membership_accumulate_point_used_amount' => $this->numberFormat($configAll[0]['data']['membership_accumulate_point_used_amount']),
                'membership_alo_point_used' => $this->numberFormat($configAll[0]['data']['membership_alo_point_used']),
                'membership_alo_point_used_amount' => $this->numberFormat($configAll[0]['data']['membership_alo_point_used_amount']),
                'membership_point_used' => $this->numberFormat($configAll[0]['data']['membership_point_used']),
                'membership_point_used_amount' => $this->numberFormat($configAll[0]['data']['membership_point_used_amount']),
                'membership_promotion_point_used' => $this->numberFormat($configAll[0]['data']['membership_promotion_point_used']),
                'membership_promotion_point_used_amount' => $this->numberFormat($configAll[0]['data']['membership_promotion_point_used_amount']),
            ];
            $data_total = [
              'total_amount' => $this->numberFormat(array_sum(array_column($data_gift, 'total_price_inlcude_addition_foods')))
            ];

            // Thu chi
            $collection = collect($configAll[2]['data']['list']);
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
                        return '<label class="name-inline-data-table text-left">' . $row['code'] . ' <br><div class="tag seemt-green seemt-bg-green d-flex" style="width: fit-content">
                                                                                                            <i class="fi-rr-hastag"></i>
                                                                                                            <label class="m-0">Hạch toán</label>
                                                                                                    </div>';
                    }else{
                        return '<label class="name-inline-data-table text-left">' . $row['code'] . ' </label>';
                    }
                })

                ->addColumn('is_count_to_revenue_name', function ($row) {
                    return '' ;
                })
                ->addColumn('fee_month', function ($row) {
                    return $this->convertDateTime($row['fee_month']) ;
                })
                ->addColumn('action', function ($row){
                    return '<div class="btn-group btn-group-sm">
                             <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailReceiptsBill(' . $row['id'] . ',' . $row['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'note','code', 'is_count_to_revenue', 'fee_month'])
                ->make(true);

            $tablePayment = Datatables::of($payment)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('is_count_to_revenue_name', function ($row) {
                    return ($row['is_count_to_revenue'] === ENUM_SELECTED) ? '<div class="btn-group btn-group-sm"><i class="text-success fa fa-dot-circle-o"></i></div>' : '<div class="btn-group btn-group-sm"><i class="text-warning fa fa-circle-o"></i></div>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                             <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailPaymentBill(' . $row['id'] . ',' . $row['branch']['id'] . ')"><i class="fi-rr-eye"></i></button>
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
            $data_detail['config_addition_fee'] = $configAll;
            return [$data_table, $data_export, $tableReceipt, $tablePayment, $data_detail , $data_total, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }

    }

    public function drawDatatableDetailBill($data, $collection){
        return Datatables::of($data['data']['foods'])
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
                    return '<label><i class="fa fa-2x fa-gift text-warning" data-toggle="tooltip" data-placement="top" data-original-title="' . $this->numberFormat($row['total_price']) . '" ></i><p class="d-none">(Tặng)</p></label>';
                }
                else if ($row['is_order_customer_beer_inventories'] === 1) {
                    return '<label><i class="fa fa-2x fa-gift text-warning" data-toggle="tooltip" data-placement="top" data-original-title="' . $this->numberFormat($row['total_price']) . '" ></i><p class="d-none">(Tặng)</p></label>';
                }
                else {
                    return $this->numberFormat($row['total_price_inlcude_addition_foods']);
                }
            })
            ->addColumn('original_price', function ($row) {
                return $this->numberFormat($row['original_price']);
            })
            ->addColumn('status', function ($row) {
                switch ($row['order_detail_status']) {
                    case Config::get('constants.type.OrderFoodStatusEnum.CONFIRM'):
                        return'<div class="status-new seemt-orange seemt-border-orange" data-status="'. $row['order_detail_status'] .'">
                                                                        <i class="fi-rr-time-quarter-to"></i>
                                                                        <label class="m-0">' . TEXT_WAITING . '</label>
                                                                    </div>';
                    case Config::get('constants.type.OrderFoodStatusEnum.PENDING'):
                        return'<div class="status-new seemt-blue seemt-border-blue" data-status="'. $row['order_detail_status'] .'">
                                    <i class="fi-rr-time-quarter-to"></i>
                                    <label class="m-0">' . TEXT_WAITING_COOKING . '</label>
                                </div>';
                    case Config::get('constants.type.OrderFoodStatusEnum.COOKING'):
                        return'<div class="status-new seemt-blue seemt-border-blue" data-status="'. $row['order_detail_status'] .'">
                                                                        <i class="fi-rr-time-quarter-to"></i>
                                                                        <label class="m-0">' . TEXT_COOKING . '</label>
                                                                    </div>';
                    case Config::get('constants.type.OrderFoodStatusEnum.DONE'):
                        return'<div class="status-new seemt-green seemt-border-green" data-status="'. $row['order_detail_status'] .'">
                                                                        <i class="fi-rr-time-quarter-to"></i>
                                                                        <label class="m-0">' . TEXT_DONE . '</label>
                                                                    </div>';
                    case Config::get('constants.type.OrderFoodStatusEnum.SOLD_OUT'):
                        return'<div class="status-new seemt-blue seemt-border-blue" data-status="'. $row['order_detail_status'] .'">
                                                                        <i class="fi-rr-time-quarter-to"></i>
                                                                        <label class="m-0">' . TEXT_SOLD_OUT . '</label>
                                                                    </div>';
                    case Config::get('constants.type.OrderFoodStatusEnum.CANCEL'):
                        return'<div class="status-new seemt-red seemt-border-red" data-status="'. $row['order_detail_status'] .'">
                                                                        <i class="fi-rr-time-quarter-to"></i>
                                                                        <label class="m-0">' . TEXT_CANCEL . '</label>
                                                                    </div>';
                    case Config::get('constants.type.OrderFoodStatusEnum.WAITING_ONLINE'):
                        return'<div class="status-new seemt-orange seemt-border-orange" data-status="'. $row['order_detail_status'] .'">
                                                                        <i class="fi-rr-time-quarter-to"></i>
                                                                        <label class="m-0">' . TEXT_WAITING_ONLINE . '</label>
                                                                    </div>';
                    default:
                        return '---';
                }
            })
            ->addColumn('note', function ($row) {
                return (mb_strlen($row['note']) > 30) ? $row['note'] = mb_substr($row['note'], 0, 27) . '...' : $row['note'];
            })
            ->addColumn('food_name', function ($row) use ($collection) {
                if ($row['order_detail_additions'] !== []) {
                    $foods = '';
                    foreach ($row['order_detail_additions'] as $value) {
                        $quantity = $value['quantity'];
                        $price = $value['total_price'];
                        $food = $value['food_name'];
                        $original_price = $value['original_price'];
                        $foods .= '<em><em>+ </em>' . $food . ' <label class="text-warning">x' . $quantity . '</label>' . ' <div> Giá vốn: <label>' . $this->numberFormat($original_price) . '</label> đ </div><div> Giá bán: <label>' . $this->numberFormat($price) . '</label> đ </div><div> Vat: <label>' . $this->numberFormat($value['vat_amount']) . 'đ (' . $value['vat_percent'] . '%)' . '</label> </div>' . '</em>';
                    }
                    return '<label>' . $row['food_name'] . '</label><br>
                                        <label class="number-order"><label class="text-warning pointer" id="side-dish">[Món bán kèm]  <i class="fi-rr-caret-down seemt-gray-w700"></i></label>
                                            <ul class="dropdown-side-dish d-none">
                                                <li>'. $foods . '</li>
                                            </ul>
                                        </label>';
                }else if ($row['order_detail_combo'] !== []) {
                    $combo = '';
                    foreach ($row['order_detail_combo'] as $value) {
                        $quantity = $value['quantity'];
                        $food = $value['food_name'];
                        $combo .= '<em><em>+ </em>' . $food . ' <label class="text-warning">x' . $quantity . '</label>' . ' Phần </em> <br>';
                    }
                    return '<label>' . $row['food_name'] . '</label><br>
                                        <label class="number-order"><label class="text-warning pointer" id="side-dish">[Món Combo]  <i class="fi-rr-caret-down seemt-gray-w700"></i></label>
                                            <ul class="dropdown-side-dish d-none">
                                                <li>'. $combo . '</li>
                                            </ul>
                                        </label>';
                } else {
                    return $row['food_name'];
                }
            })
            ->addColumn('action', function ($row) {
                if ($row['is_extra_charge'] == ENUM_DIS_SELECTED) {
                    if ($row['food_id'] == ENUM_DIS_SELECTED) {
                        if ($row['is_order_customer_beer_inventories'] == ENUM_DIS_SELECTED) {
                            return '<span class="text-secondary">' . TEXT_NOT_BELONG_MENU . '</span>';
                        } else {
                            return '<span class="text-warning">Bia tặng</span>';
                        }
                    } else {
                        if ($row['order_detail_combo'] !== []) {
                            $row['id_type_food'] = Config::get('constants.type.TypeFood.COMBO');
                            return '<div class="btn-group btn-group-sm">
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" style="float: none;margin: 5px;" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['food_id'] . '" data-type="' . $row['id_type_food'] . '">
                                           <i class="fi-rr-eye"></i>
                                        </button>
                                    </div>';
                        } else {
                            $row['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');
                            return '<div class="btn-group btn-group-sm"  >
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" style="float: none;margin: 5px;" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['food_id'] . '" data-type="' . $row['id_type_food'] . '">
                                           <i class="fi-rr-eye"></i>
                                        </button>
                                    </div>';
                        }
                    }
                } else {
                    return '<span class="text-warning">' . TEXT_RESTAURANT_EXTRA_CHARGE . '</span>';
                }
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addIndexColumn()
            ->rawColumns(['status', 'action', 'total_price', 'note', 'food_name'])
            ->make(true);
    }

    public function history(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_NEST_LOGS;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LIST_ORDER_GET_HISTORY_BILL_TREASURER, $id, 2 , 1, 5000 , '');
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $table = DataTables::of($config['data']['list'])
                ->addColumn('created_at', function ($row) {
                    return '<label>' . $this->convertDateTime($row['created_at']) . '</label>';
                })
                ->addColumn('employee', function ($row) {
                    return  '<div class="col-form-label-fz-15">'. $row['full_name'] .'</div>
                            <span class=" text-muted f-w-400">'. $row['user_name'] .'</span>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['employee', 'created_at'])
                ->addIndexColumn()
                ->make(true);
            return [$table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataExcel(Request $request){
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $branch_id = $request->get('branch_id');
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $page = 1;
        $order_status = $request->get('status');
        $area_id = ENUM_ID_NONE;
        $order_id = ENUM_ID_NONE;
        $table_ids = ENUM_ID_NONE;
        $from = $request->get('from');
        $to = $request->get('to');
        $key = '';
        $is_apply_vat = -1;
        $is_service_charge = $request->get('filter_status_order');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LIST_ORDER_GET, $restaurant_brand_id, $branch_id, $limit, $page, $order_status, $area_id, $order_id, $table_ids, $is_apply_vat, $is_service_charge, $from, $to, $key);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $config['data']['amount'] = $this->numberFormat(array_sum(array_column($config['data']['list'], 'amount')));
            $config['data']['vat_amount'] = $this->numberFormat(array_sum(array_column($config['data']['list'], 'vat_amount')));
            $config['data']['discount_amount'] = $this->numberFormat(array_sum(array_column($config['data']['list'], 'discount_amount')));
            $config['data']['membership_total_point_used_amount'] = $this->numberFormat(array_sum(array_column($config['data']['list'], 'membership_total_point_used_amount')));
            $config['data']['total_amount'] = $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_amount')));
            $config['data']['membership_promotion_point_used'] = $this->numberFormat(array_sum(array_column($config['data']['list'], 'membership_point_added')));
            $config['data']['original_price'] = $this->numberFormat(array_sum(array_column($config['data']['list'], 'original_price')));
            $config['data']['total_customer_slot_number'] = $this->numberFormat(array_sum(array_column($config['data']['list'], 'using_slot')));
            $total_profit = array_sum(array_column($config['data']['list'], 'rate_profit'));
            if((int)$total_profit > 0) {
                $config['data']['average_rate_profit'] = $this->numberFormat($total_profit / count($config['data']['list']));
            }else{
                $config['data']['average_rate_profit'] = 0;
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
