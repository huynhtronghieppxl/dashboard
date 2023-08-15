<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class CardsController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'TOPUP_CUSTOMER_CARD', 'ACCOUNTANT_ACCESS', 'ADDITION_FEE_MANAGER', 'CASHIER_ACCESS']);
        if ($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if ($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if ($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Nạp thẻ';
        return view('customer.cards.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $page = ENUM_SELECTED;
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $branch_id = $request->get('branch');
        $is_used = $request->get('is_used');
        $restaurant_id = Session::get(SESSION_RESTAURANT);
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_CUSTOMERS_GET_CARD, $restaurant_id, (int)$branch_id, $page, $limit, $is_used, $from_date, $to_date);
        $body = null;
        $config = $this->callApiGatewayTemplate($project_id, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $data_waiting_confirm = $collection->where('request_status', ENUM_SELECTED)->all();
            $data_confirm = $collection->where('request_status', 2)->all();
            $data_cancel = $collection->where('request_status', 3)->all();
            $data_table_waiting_confirm = DataTables::of($data_waiting_confirm)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('bonus_amount', function ($row) {
                    return $this->numberFormat($row['bonus_amount']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['bonus_amount'] + $row['amount']);
                })
                ->addColumn('created_at', function ($row) {
                    return '<label>' . $this->convertDateTime($row['created_at']) . '</label>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Duyệt thẻ" data-id="' . $row['id'] . '" data-cancel="0" onclick="confirmCardMemberShipTopUp($(this))"><i class="fi-rr-check"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Hủy thẻ" data-id="' . $row['id'] . '" data-cancel="0" onclick="cancelCardMemberShipTopUp($(this))"><i class="fi-rr-cross"></i></button>
                                <button class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $row['id'] . '" onclick="openModalUpdateCard($(this))" data-toggle="tooltip" data-placement="top" data-customer-id="' . $row['customer_id'] . '" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                        <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $row['id'] . '" onclick="openModalDetailCard($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                 </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'created_at'])
                ->addIndexColumn()
                ->make(true);
            $data_table_confirm = DataTables::of($data_confirm)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('bonus_amount', function ($row) {
                    return $this->numberFormat($row['bonus_amount']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['bonus_amount'] + $row['amount']);
                })
                ->addColumn('created_at', function ($row) {
                    return '<label>' . $this->convertDateTime($row['created_at']) . '</label>';
                })
                ->addColumn('status_card', function ($row) {
                    return $row['is_used'] == ENUM_DIS_SELECTED ? '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                        <label class="m-0">Chưa nạp
                                                                    </div>' : '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                                    <label class="m-0">Đã nạp</label>
                                                                                </div>';
                })
                ->addColumn('action', function ($row) {
                    if ($row['is_used'] == ENUM_DIS_SELECTED) {
                        return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Mã thẻ" data-id="' . $row['id'] . '" data-code="' . $row['top_up_code'] . '" data-qr-code="' . $row['qr_code'] . '" onclick="openModalQrCodeCardMembership($(this))"><span class="fa fa-qrcode"></span></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Hủy thẻ" data-id="' . $row['id'] . '" data-cancel="0" onclick="cancelCardMemberShipTopUp($(this))"><i class="fi-rr-cross"></i></button>
                                    <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $row['id'] . '" onclick="openModalDetailCard($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                    } else {
                        return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light d-none" data-toggle="tooltip" data-placement="top" data-original-title="Mã thẻ" data-id="' . $row['id'] . '" data-code="' . $row['top_up_code'] . '" data-qr-code="' . $row['qr_code'] . '" onclick="openModalQrCodeCardMembership($(this))"><span class="fa fa-qrcode"></span></button>
                                    <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $row['id'] . '" onclick="openModalDetailCard($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                    }

                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['status_card', 'action', 'created_at'])
                ->addIndexColumn()
                ->make(true);
            $data_table_cancel = DataTables::of($data_cancel)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('bonus_amount', function ($row) {
                    return $this->numberFormat($row['bonus_amount']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['bonus_amount'] + $row['amount']);
                })
                ->addColumn('created_at', function ($row) {
                    return '<label>' . $this->convertDateTime($row['created_at']) . '</label>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $row['id'] . '" onclick="openModalDetailCard($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'created_at'])
                ->addIndexColumn()
                ->make(true);

            $total = [
                'total_waiting_confirm' => $this->numberFormat(count($data_waiting_confirm)),
                'total_confirm' => $this->numberFormat(count($data_confirm)),
                'total_cancel' => $this->numberFormat(count($data_cancel))
            ];
            return [$data_table_waiting_confirm, $data_table_confirm, $data_table_cancel, $total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataCreate(Request $request)
    {
        $status = ENUM_STATUS_GET_ALL;
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_CARD_GET_VALUE, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project_id, $method, $api, $body);
        try {
            $data = array_values(collect($config['data'])->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->toArray());
            $data_cards = '';
            for ($i = 0; $i < count($data); $i++) {
                $class = ($i === 0) ? 'custom-card-value-focus' : '';
                $data_cards .= '<div class="custom-padding-card col-lg-3 custom-card-value ' . $class . '" data-id="' . $data[$i]['id'] . '">
                                    <a class="">' . $this->numberFormat($data[$i]['amount']) . '</a></br>
                                    <span class="">KM: <b>' . $this->numberFormat($data[$i]['bonus_amount']) . '</b></span>
                                </div>';
            }
            return [$data_cards, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function searchCustomer(Request $request)
    {
        $key_search = $request->get('phone');
        $branch_id = $request->get('branch');
        $limit = ENUM_DEFAULT_LIMIT_50;
        $is_only_aloline_customer = Config::get('constants.type.checkbox.GET_ALL');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BOOKING_SEARCH_CUSTOMER_ALOLINE, $limit, $key_search, $branch_id, $is_only_aloline_customer);
        $body = [];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $itemCustomerArray = [];
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        foreach ($config['data'] as $db) {
            array_push($itemCustomerArray, [
                'id' => $db['id'],
                'text' => $db['name'],
                'avatar' => $domain . $db['avatar'],
                'phone' => $db['phone'],
            ]);
        }
        return [$itemCustomerArray, $config];
    }

    public function detail(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_CUSTOMERS_DETAIL_CARD, $request->get('id'));
        $body = [];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            if ($data['request_status'] === 1) {
                $status = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_WAITING_CONFIRM . '</label>
                                </div>';
            } else if ($data['request_status'] === 2 && $data['top_up_at'] === '') {
                $status = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_UNCHARGED . '</label>
                                </div>';
            } else if ($data['request_status'] === 2 && $data['top_up_at'] !== '') {
                $status = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_CONFIRMED_CHARGED . '</label>
                                </div>';
            } else {
                $status = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_CANCELED . '</label>
                                </div>';
            }
            return [$data, $status];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_CUSTOMERS_DATA_UPDATE_CARD, $id);
        $body = [];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CUSTOMERS_UPDATE_CARD, (int)$request->get('id'));
        $body = [
            'customer_phone' => $request->get('phone')
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $config['data']['amount'] = $this->numberFormat($config['data']['amount']);
            $config['data']['bonus_amount'] = $this->numberFormat($config['data']['bonus_amount']);
            $config['data']['total_amount'] = $this->numberFormat($config['data']['total_amount']);
            $config['data']['created_at'] = '<label>' . $this->convertDateTime($config['data']['created_at']) . '</label>';
            $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Duyệt thẻ" data-id="' . $config['data']['id'] . '" data-cancel="0" onclick="confirmCardMemberShipTopUp($(this))"><i class="fi-rr-check"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Hủy thẻ" data-id="' . $config['data']['id'] . '" data-cancel="0" onclick="cancelCardMemberShipTopUp($(this))"><i class="fi-rr-cross"></i></button>
                                <button class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="openModalUpdateCard($(this))" data-toggle="tooltip" data-placement="top" data-customer-id="' . $config['data']['customer_id'] . '" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                        <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="openModalDetailCard($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                 </div>';
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
        }

        return $config;
    }

    public function confirm(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CUSTOMERS_CONFIRM_CARD, $id);
        $body = [];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $config['data']['amount'] = $this->numberFormat($config['data']['amount']);
            $config['data']['bonus_amount'] = $this->numberFormat($config['data']['bonus_amount']);
            $config['data']['total_amount'] = $this->numberFormat($config['data']['total_amount']);
            $config['data']['created_at'] = '<label>' . $this->convertDateTime($config['data']['created_at']) . '</label>';
            $config['data']['status_card'] = $config['data']['is_used'] == ENUM_DIS_SELECTED ? '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                        <label class="m-0">Chưa nạp
                                                                    </div>' : '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                                    <label class="m-0">Đã nạp</label>
                                                                                </div>';
            $config['data']['action'] = $config['data']['is_used'] == ENUM_DIS_SELECTED ?
                '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Mã thẻ" data-id="' . $config['data']['id'] . '" data-code="' . $config['data']['top_up_code'] . '" data-qr-code="' . $config['data']['qr_code'] . '" onclick="openModalQrCodeCardMembership($(this))"><span class="fa fa-qrcode"></span></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Hủy thẻ" data-id="' . $config['data']['id'] . '" data-cancel="0" onclick="cancelCardMemberShipTopUp($(this))"><i class="fi-rr-cross"></i></button>
                                    <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" onclick="openModalDetailCard($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>'
                : '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light d-none" data-toggle="tooltip" data-placement="top" data-original-title="Mã thẻ" data-id="' . $config['data']['id'] . '" data-code="' . $config['data']['top_up_code'] . '" data-qr-code="' . $config['data']['qr_code'] . '" onclick="openModalQrCodeCardMembership($(this))"><span class="fa fa-qrcode"></span></button>
                                    <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" onclick="openModalDetailCard($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
        }
        return $config;
    }

    public function cancel(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CUSTOMERS_CANCEL_CARD, $id);
        $body = [
            'cancel_reason' => $request->get('cancel_reason')
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function create(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CREATE_CARDS_POST, $request->get('customer'));
        $body = [
            'restaurant_top_up_card_id' => $request->get('restaurant_top_up_card_id'),
            'branch_id' => $request->get('branch_id'),
            'top_up_amount' => sprintf($request->get('top_up_amount')),
            'payment_method' => $request->get('payment_method'),
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            if ($request->get('payment_method') != ENUM_SELECTED) {
                $config['data']['amount'] = $this->numberFormat($config['data']['amount']);
                $config['data']['bonus_amount'] = $this->numberFormat($config['data']['bonus_amount']);
                $config['data']['total_amount'] = $this->numberFormat($config['data']['total_amount']);
                $config['data']['created_at'] = '<label>' . $this->convertDateTime($config['data']['created_at']) . '</label>';
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Duyệt thẻ" data-id="' . $config['data']['id'] . '" data-cancel="0" onclick="confirmCardMemberShipTopUp($(this))"><i class="fi-rr-check"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Hủy thẻ" data-id="' . $config['data']['id'] . '" data-cancel="0" onclick="cancelCardMemberShipTopUp($(this))"><i class="fi-rr-cross"></i></button>
                                <button class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="openModalUpdateCard($(this))" data-toggle="tooltip" data-placement="top" data-customer-id="' . $config['data']['customer_id'] . '" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                        <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="openModalDetailCard($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                 </div>';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);

                return $config;
            } else {
                $config['data']['amount'] = $this->numberFormat($config['data']['amount']);
                $config['data']['bonus_amount'] = $this->numberFormat($config['data']['bonus_amount']);
                $config['data']['total_amount'] = $this->numberFormat($config['data']['total_amount']);
                $config['data']['created_at'] = '<label>' . $this->convertDateTime($config['data']['created_at']) . '</label>';
                $config['data']['status_card'] = $config['data']['is_used'] == ENUM_DIS_SELECTED ? '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                        <label class="m-0">Chưa nạp
                                                                    </div>' : '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                                    <label class="m-0">Đã nạp</label>
                                                                                </div>';
                $config['data']['action'] = $config['data']['is_used'] == ENUM_DIS_SELECTED ?
                    '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Mã thẻ" data-id="' . $config['data']['id'] . '" data-code="' . $config['data']['top_up_code'] . '" data-qr-code="' . $config['data']['qr_code'] . '" onclick="openModalQrCodeCardMembership($(this))"><span class="fa fa-qrcode"></span></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Hủy thẻ" data-id="' . $config['data']['id'] . '" data-cancel="0" onclick="cancelCardMemberShipTopUp($(this))"><i class="fi-rr-cross"></i></button>
                                    <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" onclick="openModalDetailCard($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>'
                    : '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light d-none" data-toggle="tooltip" data-placement="top" data-original-title="Mã thẻ" data-id="' . $config['data']['id'] . '" data-code="' . $config['data']['top_up_code'] . '" data-qr-code="' . $config['data']['qr_code'] . '" onclick="openModalQrCodeCardMembership($(this))"><span class="fa fa-qrcode"></span></button>
                                    <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" onclick="openModalDetailCard($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
        }
        return $config;
    }
}
