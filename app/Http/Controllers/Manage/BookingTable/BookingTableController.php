<?php

namespace App\Http\Controllers\Manage\BookingTable;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class BookingTableController extends Controller
{
    public function index(Request $request)
    {
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
        $active_nav = 'Quản lý Booking';
        return view('manage.booking_table.index', compact('active_nav'));
    }
    public function data(Request $request)
    {
        $dataBranch = collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->where('is_office', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->toArray();
        $dataSetting = Session::get(SESSION_KEY_DATA_SETTING);
        $restaurantBrandId = $request->get('restaurant_brand_id');
        $branch = Config::get('constants.type.id.GET_ALL');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BOOKING_TOTAL_LIST_BOOKING, $restaurantBrandId, $branch);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $data = $config['data'];
            $merged = collect($dataBranch)->map(function ($value) use ($data) {
                $value['booking'] = 0;
                foreach ($data as $array) {
                    if ($value['id'] === $array['branch_id']) {
                        $value['booking'] = $array['total'];
                    }
                }
                return $value;
            });
            $list_branch = '';
            foreach ($merged as $db) {
                $data_banner = $domain . $db['banner'];
                $data_image = $domain . $db['image_logo'];
                $active = '';
                $action = '<li data-toggle="tooltip" data-original-title="Bật booking cho chi nhánh">
                                <input type="checkbox" id="enable_booking"  checked="" data-switchery="true">
                            </li>';
                $db['is_enable_booking'] = 1;
                if ($db['is_enable_booking'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    $active = 'active';
                    $action = '<li data-toggle="tooltip" data-original-title="Số đơn booking đang xử lý">
                                        <a><i class="fi-rr-calendar"></i></a>
                                    <label class="pointer">' . $db['booking'] . '</label>
                                    </li>
                                    <li>
                                        <label  class="pointer btn-detail-branch-booking" onclick="detailBranch($(this))" data-id="' . $db['id'] . '" data-booking="' . $dataSetting['is_enable_booking'] . '" data-name="' . $db['name'] . '"  data-status="' . $db['status'] . '">
                                            <i class="fi-rr-eye"></i>
                                        </label>
                                    </li>';
                }
                $list_branch .= '<div class="col-6 edit-flex-auto-fill">
                                    <div class="box-image" style="height: max-content">
                                        <figure class="box-image-banner">
                                            <img onerror="imageDefaultOnLoadError($(this))" src="' . $data_banner . '" alt="">
                                            <ul class="profile-controls">' . $action . '</ul>
                                        </figure>
                                        <div style="position: absolute; top: 18vh">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="profile-branch">
                                                        <div class="profile-branch-thumb">
                                                            <img onerror="imageDefaultOnLoadError($(this))" alt="author" class="thumbnail-branch-logo-booking" src="' . $data_image . '">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="author-content" style="margin-top: 0">
                                                       <a class="custom-name ' . $active . '">' . $db['name'] . '</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-content">
                                            <ul class="frnd-info">
                                                <li><i class="text-info fa fa-2x fa-user pr-2"></i> ' . $db['employee_manager_full_name'] . '</li>
                                                <li><i class="text-warning fa fa-2x fa-phone pr-2"></i> ' . $db['phone'] . ' </li>
                                                <li><i class="text-success fa fa-2x fa-map-marker pr-2"></i> ' . $db['address'] . ' </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>';
            }
            return [$list_branch, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataBooking(Request $request)
    {
        $branch = $request->get('branch');
        $from = $request->get('from');
        $to = $request->get('to');
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $is_just_take_having_deposit = (int)Config::get('constants.type.checkbox.GET_ALL');
        $is_just_take_waiting_confirm_deposit = (int)Config::get('constants.type.checkbox.GET_ALL');
        $is_get_all = Config::get('constants.type.checkbox.SELECTED');
        $status = Config::get('constants.type.BookingStatusEnum.GET_ALL');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BOOKING_GET_LIST_TABLE, $branch, $from, $to, $status, $is_just_take_having_deposit, $is_just_take_waiting_confirm_deposit, $limit, $page, $is_get_all);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            if (!empty($data)) {
                foreach ($data as $c => $key) {
                    $dateTime[] = $this->convertDateUsingSort($key['booking_time']);
                }
                array_multisort($dateTime, SORT_DESC, SORT_STRING, $data);
            }
            $table_done = [];
            $table_cancel = [];
            $table_processing = [];
            $a = 0;
            $b = 0;
            $c = 0;
            for ($i = 0; $i < count($data); $i++) {
                switch ($data[$i]['booking_status']) {
                    case (int)Config::get('constants.type.BookingStatusEnum.COMPLETED'):
                        $data[$i]['status_text'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_DONE . '</label>
                                                    </div>';
                        $table_done[$a] = $data[$i];
                        $a++;
                        break;
                    case (int)Config::get('constants.type.BookingStatusEnum.CANCEL'):
                        $data[$i]['status_text'] = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_CANCELED . '</label>
                                                    </div>';
                        $table_cancel[$b] = $data[$i];
                        $b++;
                        break;
                    case (int)Config::get('constants.type.BookingStatusEnum.EXPIRED'):
                        $data[$i]['status_text'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_EXPIRED . '</label>
                                                    </div>';
                        $table_cancel[$b] = $data[$i];
                        $b++;
                        break;
                    case (int)Config::get('constants.type.BookingStatusEnum.WAITING_CONFIRM'):
                        if ($data[$i]['deposit_amount'] != Config::get('constants.type.checkbox.DIS_SELECTED') && $data[$i]['is_deposit_confirmed'] != Config::get('constants.type.checkbox.SELECTED')) {
                            $data[$i]['status_text'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_WAITING_SCHEDULE . '</label>
                                                    </div>';
                        } else {
                            $data[$i]['status_text'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_WAITING . '</label>
                                                    </div>';
                        }
                        $table_processing[$c] = $data[$i];
                        $c++;
                        break;
                    case (int)Config::get('constants.type.BookingStatusEnum.PREPARING'):
                        $data[$i]['status_text'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_PREPARING . '</label>
                                                    </div>';
                        $table_processing[$c] = $data[$i];
                        $c++;
                        break;
                    case (int)Config::get('constants.type.BookingStatusEnum.WAITING_COMPLETE'):
                        $data[$i]['status_text'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_WAITING_COMPLETE . '</label>
                                                    </div>';
                        $table_processing[$c] = $data[$i];
                        $c++;
                        break;
                    case (int)Config::get('constants.type.BookingStatusEnum.CONFIMED'):
                        $data[$i]['status_text'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_CONFINED . '</label>
                                                    </div>';
                        $table_processing[$c] = $data[$i];
                        $c++;
                        break;
                    case (int)Config::get('constants.type.BookingStatusEnum.SET_UP'):
                        $data[$i]['status_text'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_WAITING_SET_UP . '</label>
                                                    </div>';
                        $table_processing[$c] = $data[$i];
                        $c++;
                        break;
                    case (int)Config::get('constants.type.BookingStatusEnum.CANCEL'):
                        $data[$i]['status_text'] = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_CANCELED_TEXT . '</label>
                                                    </div>';
                        $table_processing[$c] = $data[$i];
                        $c++;
                        break;
                    default:
                        $data[$i]['status_text'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_UNKNOWN . '</label>
                                                    </div>';
                        $table_processing[$c] = $data[$i];
                        $c++;
                        break;
                }
            }
            $data_table_processing = $this->drawTableBookingManage($table_processing);
            $data_table_done = $this->drawTableBookingManage($table_done);
            $data_table_cancel = $this->drawTableBookingManage($table_cancel);
            $data_total = [
                'total_record_processing' => $this->numberFormat(count($table_processing)),
                'total_record_done' => $this->numberFormat(count($table_done)),
                'total_record_cancel' => $this->numberFormat(count($table_cancel)),
                'total_customer_table_done' => $this->numberFormat(array_sum(array_column($table_done, 'number_slot'))),
                'total_customer_table_cancel' => $this->numberFormat(array_sum(array_column($table_cancel, 'number_slot'))),
                'total_customer_table_processing' => $this->numberFormat(array_sum(array_column($table_processing, 'number_slot'))),
                'total_deposit_amount_table_done' => $this->numberFormat(array_sum(array_column($table_done, 'deposit_amount'))),
                'total_deposit_amount_table_cancel' => $this->numberFormat(array_sum(array_column($table_cancel, 'deposit_amount'))),
                'total_deposit_amount_table_processing' => $this->numberFormat(array_sum(array_column($table_processing, 'deposit_amount'))),
                'total_return_deposit_amount_table_done' => $this->numberFormat(array_sum(array_column($table_done, 'return_deposit_amount'))),
                'total_return_deposit_amount_table_cancel' => $this->numberFormat(array_sum(array_column($table_cancel, 'return_deposit_amount'))),
                'total_return_deposit_amount_table_processing' => $this->numberFormat(array_sum(array_column($table_processing, 'return_deposit_amount')))
            ];

            return [$data_table_processing, $data_table_done, $data_table_cancel, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataListbranch() {
        $list_branch = '';
        $allbranch = collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', Config::get('constants.type.checkbox.SELECTED'))->where('is_office', Config::get('constants.type.checkbox.DIS_SELECTED'));
        foreach ($allbranch as $key => $item) {
            $data_disable = 0;
            if (Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['setting']['is_enable_booking'] == 1) $data_disable = 1;
            if ($item['is_enable_booking'] === 1 && $data_disable == 1) {
                $input_is_enable_booking = '<input type="checkbox"  class="js-switch" data-disabled-brand="' . $data_disable . '" style="display: none;" data-switchery="true"   data-id="' . $item['id'] . '" checked onchange="changeStatusSettingBookingManage($(this))" />';
            } else {
                $input_is_enable_booking = '<input type="checkbox"   class="js-switch" data-disabled-brand="' . $data_disable . '" data-switchery="true"   data-id="' . $item['id'] . '" onchange="changeStatusSettingBookingManage($(this))" /> ';
            }
            $list_branch .= '<div class="col-6 edit-flex-auto-fill branch-booking-table-box">
                                <div class="box-image">
                                    <figure class="box-image-banner" style="background-image:url(' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $item['banner'] . ');background-position: center;background-size: cover">
                                        <ul >
                                            <li data-toggle="tooltip" data-original-title="Bật tắt đặt bàn" data-placement="left">
                                                ' . $input_is_enable_booking . '
                                            </li>
                                        </ul>
                                        <div class="row align-items-end w-100 h-100 mx-0 ">
                                            <div class="profile-branch-thumb ml-1 mb-2">
                                                <img alt="author"  onerror="imageDefaultOnLoadError($(this))" class="thumbnail-branch-logo-booking" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $item['image_logo'] . ' " />
                                            </div>
                                            <div class="author-content col-lg-5 mt-0 mb-2 ml-1 ">
                                                <a class="custom-name"  id="branch-setting-name" style="">' . $item['name'] . '</a>
                                                <i class="fa fa-ban text-danger pr-1 d-none" id="branch-setting-status-off"></i>
                                            </div>
                                            <ul class="profile-controls profile-controls-2 ml-auto" id="type-branch-detail">
                                                <li data-toggle="tooltip" data-original-title="Số đơn booking đang xử lý">
                                                    <a><i class="fi-rr-calendar"></i></a>
                                                    <label id="number-booking-prosesing-' . $item['id'] . '" class="pointer col-form-label-fz-15 f-w-600">0 </label>
                                                </li>
                                                <li>
                                                    <label
                                                        class="pointer btn-detail-branch-booking seemt-btn-hover-blue waves-effect waves-light btn-radius-50"
                                                        data-toggle="tooltip"
                                                        data-type="{{$key}}"
                                                        data-enable-booking="' . $item['is_enable_booking'] . '"
                                                        data-original-title="Chi tiết đặt bàn"
                                                        onclick="detailBranch($(this))"
                                                        value="' . $item['id'] . '"
                                                        data-name="' . $item['name'] . '"
                                                        data-id="' . $item['id'] . '"
                                                        data-status="' . $item['status'] . '"
                                                    >
                                                        <i class="fi-rr-eye mt-0" style="margin-top: 2px !important; display: inline-block !important;"></i>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </figure>
                                </div>
                            </div>';
        }
        return $list_branch;
    }

    public function drawTableBookingManage($data)
    {
        return DataTables::of($data)
            ->addColumn('customer_name', function ($row) {
                $customer_name = $row['customer_name'] === '' ? '---' : (mb_strlen($row['customer_name']) > 30 ? '<label>' . mb_substr($row['customer_name'], 0, 27) . '...' : $row['customer_name']);
                return $customer_name;
            })
            ->addColumn('total_amount', function ($rows) {
                return $this->numberFormat($rows['total_amount']);
            })
            ->addColumn('employee_create_name', function ($rows) {
                return $this->numberFormat($rows['employee_create']['name']);
            })
            ->addColumn('return_deposit_amount', function ($rows) {
                return $this->numberFormat($rows['return_deposit_amount']);
            })
            ->addColumn('deposit_amount', function ($rows) {
                return '<label id="deposit-amount-' . $rows['id'] . '">' . $this->numberFormat($rows['deposit_amount']) . '</label>';

            })
            ->addColumn('action', function ($rows) {
                switch ($rows['booking_status']) {
                    case (int)Config::get('constants.type.BookingStatusEnum.WAITING_CONFIRM'):
                        $button = '<button type="button" class="tabledit-edit-button btn seemt-green seemt-bg-green seemt-btn-hover-green waves-effect waves-light" data-id="' . $rows['id'] . '" onclick="confirmBookingTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONFIRM . '"><i class="fi-rr-check"></i></button>';
                        if ($rows['deposit_amount'] != Config::get('constants.type.checkbox.DIS_SELECTED') && $rows['is_deposit_confirmed'] != Config::get('constants.type.checkbox.SELECTED')) {
                            $button = '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $rows['id'] . '" onclick="confirmDepositBookingDataTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận cọc"><span class="fa fa-money"></span></button>';
                        }
                        return '<div class="btn-group btn-group-sm float-right">
                                    ' . $button . '
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $rows['id'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-status="' . $rows['booking_status'] . '" data-customer="' . $rows['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $rows['id'] . '" data-customer="' . $rows['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                    case (int)Config::get('constants.type.BookingStatusEnum.CONFIMED'):
                        $button = ' <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $rows['id'] . '" data-branch="' . $rows['branch']['id'] . '" onclick="openModalTableBookingTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xếp bàn"><span class="icofont icofont-fork-and-knife"></span></button>';
                        if ($rows['deposit_amount'] != Config::get('constants.type.checkbox.DIS_SELECTED') && $rows['is_deposit_confirmed'] != Config::get('constants.type.checkbox.SELECTED')) {
                            $button = '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $rows['id'] . '" onclick="confirmDepositBookingDataTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận cọc"><span class="fa fa-money"></span></button>';
                        }
                        return '<div class="btn-group btn-group-sm float-right">
                                ' . $button . '
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $rows['id'] . '" data-status="' . $rows['booking_status'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-customer="' . $rows['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $rows['id'] . '" data-customer="' . $rows['customer_id'] . '"data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                    case $rows['booking_status'] === (int)Config::get('constants.type.BookingStatusEnum.COMPLETED'):
                    case $rows['booking_status'] === (int)Config::get('constants.type.BookingStatusEnum.WAITING_COMPLETE'):
                    case $rows['booking_status'] === (int)TEXT_CANCELED:
                    case $rows['booking_status'] === (int)Config::get('constants.type.BookingStatusEnum.EXPIRED'):
                        return '<div class="btn-group btn-group-sm float-right">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $rows['id'] . '" data-customer="' . $rows['customer_id'] . '"data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                    case (int)Config::get('constants.type.BookingStatusEnum.SET_UP'):
                        $button = '';
                        if ($rows['deposit_amount'] != Config::get('constants.type.checkbox.DIS_SELECTED') && $rows['is_deposit_confirmed'] != Config::get('constants.type.checkbox.SELECTED')) {
                            $button = '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $rows['id'] . '" onclick="confirmDepositBookingDataTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận cọc"><span class="fa fa-money"></span></button>';
                        }
                        return '<div class="btn-group btn-group-sm float-right">
                                  ' . $button . '
                                      <button type="button" class="tabledit-edit-button btn seemt-green seemt-bg-green seemt-btn-hover-green waves-effect waves-light"  data-id="' . $rows['id'] . '" data-branch="' . $rows['branch']['id'] . '" onclick="acceptSetUpTableBookingTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận Setup bàn"><i class="fi-rr-check"></i></button>
                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $rows['id'] . '" data-status="' . $rows['booking_status'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-customer="' . $rows['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $rows['id'] . '" data-customer="' . $rows['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                    case (int)Config::get('constants.type.BookingStatusEnum.PREPARING'):
                        return '<div class="btn-group btn-group-sm float-right">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $rows['id'] . '" data-branch="' . $rows['branch']['id'] . '" onclick="acceptCustomerBookingTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Nhận khách"><i class="fi-rr-user"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $rows['id'] . '" data-customer="' . $rows['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                        break;
                    default :
                        ////                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $rows['id'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-customer='. $config['data ]['customer_id.' data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                        return '<div class="btn-group btn-group-sm float-right">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $rows['id'] . '" data-customer="' . $rows['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';

                }
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addIndexColumn()
            ->rawColumns(['status_text', 'action', 'deposit_amount', 'customer_name'])
            ->make(true);
    }

    public function getBranchDetail(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SETTING_BRANCH_GET_FULL_IN_FOR, $id);
        $body = null;
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BOOKING_GET_DETAIL_TABLE_MANAGE, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);

        $status = 0;
        $api = sprintf(API_CARD_TAG_GET, $status);
        $body = null;
        $requestDataListTags = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $customer_id = $request->get('customer_id');
        $api = sprintf(API_CARD_TAG_GET_TAGS_OF_CUSTOMER, $customer_id);
        $body = null;
        $requestCustomerTags = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestDataListTags, $requestCustomerTags]);
        try {
            $data = $config['data'];
            switch ($data['booking_status']) {
                case (int)Config::get('constants.type.BookingStatusEnum.WAITING_CONFIRM'):
                    $data['status'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_WAITING_SCHEDULE . '</label>
                                                    </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.PREPARING'):
                    $data['status'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_PREPARING . '</label>
                                                    </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.CONFIMED'):
                    $data['status'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_CONFINED . '</label>
                                                    </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.WAITING_COMPLETE'):
                    $data['status'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_WAITING_COMPLETE . '</label>
                                                    </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.COMPLETED'):
                    $data['status'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_DONE . '</label>
                                                    </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.CANCEL'):
                    $data['status'] = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_CANCELED . '</label>
                                                    </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.EXPIRED'):
                    $data['status'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_EXPIRED . '</label>
                                                    </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.SET_UP'):
                    $data['status'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_WAITING_SET_UP . '</label>
                                                    </div>';
                    break;
                default:
                    $data['status'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_UNKNOWN . '</label>
                                                    </div>';
            }

            $data['deposit_amount'] = $this->numberFormat($data['deposit_amount']);
            $data['return_deposit_amount'] = $this->numberFormat($data['return_deposit_amount']);
            $data['number_slot'] = $this->numberFormat($data['number_slot']);
            $data['total_amount'] = $this->numberFormat($data['total_amount']);
            $data['area'] = '';
            $db_table = [];
            if ($data['tables'] !== null) {
                foreach ($data['tables'] as $db) {
                    array_push($db_table, $db['name']);
                    $data['area'] = $db['area'];
                }
                $data['tables'] = implode(',', $db_table);
            } else {
                $data['tables'] = '';
            }
            $data_food = DataTables::of($data['foods'])
                ->addColumn('avatar', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $row['avatar'] . "'" . ')"/></label>';
                })
                ->addColumn('quantity', function ($rows) {
                    return $this->numberFormat($rows['quantity']);
                })
                ->addColumn('price', function ($rows) {
                    return $this->numberFormat($rows['price']);
                })
                ->addColumn('total_amount', function ($rows) {
                    $gift_symbol = ($rows['is_gift'] == 1) ? '<i class="fa fa-2x fa-gift text-warning mr-2"></i>' : '';
                    $total_money = ($rows['is_gift'] == 1) ? 0 : $this->numberFormat($rows['total_amount']);
                    return '<label>' . $gift_symbol . ' <span></span>' . $total_money . '</span></label>';
                })
                ->addColumn('action', function ($rows) {
                    $rows['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');
                    if ($rows['is_combo'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                        $rows['type_food'] = TEXT_COMBO_FOOD;
                        $rows['id_type_food'] = Config::get('constants.type.TypeFood.COMBO');
                    }

                    if ($rows['is_addition'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                        $rows['type_food'] = TEXT_ADDITION;
                        $rows['id_type_food'] = Config::get('constants.type.TypeFood.ADDITION');
                    }
                    return '<div class="btn-group btn-group-sm float-right">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $rows['id'] . '" data-type="' . $rows['id_type_food'] . '"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('name', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                            <label class="title-name-new-table" >' . $row['name'] . '</label>';
                })
                ->addIndexColumn()
                ->rawColumns(['avatar', 'action', 'total_amount', 'name'])
                ->make(true);
            $dataGift = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            foreach ($config['data']['customer_gifts'] as $db) {
                $dataGift .=
                    '<div class="item" data-id="' . $db['id'] . '">
                                    <div class="gift-img-container">
                                        <img src="' . $domain . $db['image_url'] . '" onerror="imageDefaultOnLoadError($(this))" alt="" style="width: 100%" class="item-gift-create-booking-table-manage">
                                    </div>
                                    <div class="sugtd-frnd-meta">
                                        <a href="#" title="">' . $db['name'] . ' </a>
                                        <ul class="add-remove-frnd">
                                             <li class="remove-frnd"  data-id="' . $db['id'] . '" onclick="openModalDetailGiftMarketing($(this))"><a href="#" class="bg-primary" style="padding: 2px 4px" title="detail friend"><i
                                                            class="icofont icofont-eye-alt"></i></a></li>
                                        </ul>
                                    </div>
                                </div>';
            }

            $dataTagsAssign = collect($configAll[1]['data'])->where('is_assign', 1)->pluck('name')->toArray();
            $option_tags = '';
            for ($i = 0; $i < count($configAll[0]['data']['list']); $i++) {
                $option_tags .= '<option value="' . $configAll[0]['data']['list'][$i]['id'] . '">' . $configAll[0]['data']['list'][$i]['name'] . '</option>';
            }
            return [$data, $data_food, $config, $dataGift, $option_tags, $dataTagsAssign];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataConfirm(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BOOKING_GET_DETAIL_TABLE_MANAGE, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $config1 = $config;
            $data = $config['data'];
            switch ($data['booking_status']) {
                case (int)Config::get('constants.type.BookingStatusEnum.WAITING_CONFIRM'):
                    $data['status'] = '<label class="text-warning">' . TEXT_WAITING . '</label>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.PREPARING'):
                    $data['status'] = '<label class="text-warning">' . TEXT_PREPARING . '</label>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.WAITING_COMPLETE'):
                    $data['status'] = '<label class="text-warning">' . TEXT_WAITING_COMPLETE . '</label>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.COMPLETED'):
                    $data['status'] = '<label class="text-success">' . TEXT_DONE . '</label>';
                    break;
                case (int)TEXT_CANCELED:
                    $data['status'] = '<label class="text-danger">' . TEXT_CANCELED . '</label>';
                    break;
                default:
                    $data['status'] = '<label class="text-inverse">' . TEXT_UNKNOWN . '</label>';
            }

            $data['deposit_amount'] = $this->numberFormat($data['deposit_amount']);
            $data['return_deposit_amount'] = $this->numberFormat($data['return_deposit_amount']);
            $data['number_slot'] = $this->numberFormat($data['number_slot']);
            $data['total_amount'] = $this->numberFormat($data['total_amount']);
            $data_detail = $data;
            $branch = $data['branch']['id'];
            $data_food = DataTables::of($data['foods'])
                ->addColumn('avatar', function ($row) {
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $row['avatar'] . "'" . ')"/><input type="text" class="d-none" value="' . $row['id'] . '"></label>';
                })
                ->addColumn('quantity', function ($rows) {
                    return $this->numberFormat($rows['quantity']);
                })
                ->addColumn('price', function ($rows) {
                    return $this->numberFormat($rows['price']);
                })
                ->addColumn('total_amount', function ($rows) {
                    $gift_symbol = ($rows['is_gift'] == 1) ? '<i class="fa fa-2x fa-gift text-warning mr-2"></i>' : '';
                    $total_money = ($rows['is_gift'] == 1) ? 0 : $this->numberFormat($rows['total_amount']);
                    return '<label>' . $gift_symbol . ' <span></span>' . $total_money . '</span></label>';
                })
                ->addColumn('action', function ($rows) {
                    $rows['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');
                    if ($rows['is_combo'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                        $rows['type_food'] = TEXT_COMBO_FOOD;
                        $rows['id_type_food'] = Config::get('constants.type.TypeFood.COMBO');
                    }

                    if ($rows['is_addition'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                        $rows['type_food'] = TEXT_ADDITION;
                        $rows['id_type_food'] = Config::get('constants.type.TypeFood.ADDITION');
                    }
                    return '<div class="btn-group btn-group-sm float-right">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $rows['id'] . '" data-type="' . $rows['id_type_food'] . '"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['avatar', 'action', 'total_amount'])
                ->make(true);

            $is_take_away = Config::get('constants.type.id.GET_ALL');
            $status = Config::get('constants.type.status.GET_ACTIVE');
            $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
            $method = ENUM_METHOD_GET;
            $api = sprintf(API_LIST_AREA_GET, $branch, $is_take_away, $status);
            $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
            try {
                $data = $config['data']['list'];
                $area_data = '<option disabled hidden selected>' . TEXT_DEFAULT_OPTION . '</option>';
                for ($i = 0; $i < count($data); $i++) {
                    $area_data .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
                if ($area_data === '<option disabled hidden selected>' . TEXT_DEFAULT_OPTION . '</option>') {
                    $area_data = '<option>' . TEXT_NULL_OPTION . '</option>';
                }

                return [$data_detail, $data_food, $area_data, $config1, $config];
            } catch (Exception $e) {
                return $this->catchTemplate($config, $e);
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function table(Request $request)
    {
        $area = $request->get('area');
        $branch = $request->get('branch');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BOOKING_GET_TABLE_MANAGE, $area, $branch, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $table_data = '<option disabled>' . TEXT_DEFAULT_OPTION . '</option>';
            if (count($data)) {
                foreach ($data as $value) {
                    $table_data .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
                }
            }
            return [$table_data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function confirm(Request $request)
    {
        $booking_id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_POST_CONFIRM_BOOKING_LIST, $booking_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['data'] != null) {
                $config['data']['status_text'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_CONFINED . '</label>
                                                    </div>';
                $config['data']['action'] = '<div class="btn-group btn-group-sm float-right">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-branch="' . $config['data']['branch']['id'] . '" onclick="openModalTableBookingTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xếp bàn"><span class="icofont icofont-fork-and-knife"></span></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-branch="' . $config['data']['branch']['id'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                            </div>';
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
        return $config;
    }

    public function acceptCustomer(Request $request)
    {
        $booking_id = $request->get('id');
        $branch = $request->get('branch');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_POST_ACCEPT_CUSTOMER, $booking_id);
        $body = [
            'branch_id' => $branch
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['data'] != null) {
                $config['data']['status_text'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">Đang phục vụ</label>
                                                    </div>';
                $config['data']['action'] = '<div class="btn-group btn-group-sm float-right">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                            </div>';
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
        return $config;
    }

    public function confirmTable(Request $request)
    {
        $booking_id = $request->get('id');
        $branch_id = $request->get('branch');
        $area_id = $request->get('area');
        $tables_ids = $request->get('table');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_POST_CONFIRM_TABLE_BOOKING_LIST, $booking_id);
        $body = [
            'area_id' => $area_id,
            'branch_id' => $branch_id,
            'tables_ids' => $tables_ids
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['data'] != null) {
                $config['data']['status_text'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                            <label class="m-0">' . TEXT_WAITING_SET_UP . '</label>
                                        </div>';
                $config['data']['action'] = '<div class="btn-group btn-group-sm float-right">
                                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-bg-green seemt-btn-hover-green waves-effect waves-light"  data-id="' . $config['data']['id'] . '" data-branch="' . $config['data']['branch']['id'] . '" onclick="acceptSetUpTableBookingTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận Setup bàn"><i class="fi-rr-check"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-status="' . $config['data']['booking_status'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                            </div>';
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
        return $config;
    }


    public function food(Request $request)
    {
        $branch = $request->get('branch');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $category_type = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.checkbox.GET_ALL');
        $category_id = Config::get('constants.type.id.GET_ALL');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.GET_ALL');
        $is_allow_booking = Config::get('constants.type.checkbox.SELECTED');
        $kitchen_id=Config::get('constants.type.checkbox.DIS_SELECTED');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_sell_by_weight= Config::get('constants.type.checkbox.DIS_SELECTED');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_ALL_BRANCH_MANAGE,$category_type , $branch, $category_id, $is_take_away, $is_combo, $is_sell_by_weight, $is_special_gift, $status, $is_allow_booking,$kitchen_id, $is_addition);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = collect($config['data']['list']);
            $data_all_opt = '<option value="" disabled selected>' . TEXT_SELECT_FOOD . '</option>';
            $data_food_opt = '<option value="" disabled  selected>' . TEXT_SELECT_FOOD . '</option>';
            $data_drink_opt = '<option value="" disabled  selected>' . TEXT_SELECT_FOOD . '</option>';
            $data_sea_opt = '<option value="" disabled  selected>' . TEXT_SELECT_FOOD . '</option>';
            $data_other_opt = '<option value="" disabled  selected>' . TEXT_SELECT_FOOD . '</option>';
            $data_special_opt = '<option value="" disabled  selected>' . TEXT_SELECT_FOOD . '</option>';
            $data_combo_opt = '<option value="" disabled  selected>' . TEXT_SELECT_FOOD . '</option>';
            if (empty($data)) {
                $data_all_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
                $data_food_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
                $data_drink_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
                $data_sea_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
                $data_other_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
                $data_special_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
                $data_combo_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
            }
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            foreach ($data as $value) {
                if(count($value['food_addition_ids'])==0) {
                    $data_all_opt .= '<option value="' . $value['id'] . '" data-category="' . $value['category_type_id'] . '" data-weight="' . $value['is_sell_by_weight'] . '" data-avatar="' . $domain . $value['avatar'] . '" data-name="' . $value['name'] . '" data-category="' . $value['category_type_id'] . '" data-price="' . $value['price'] . '" data-price-format="' . $this->numberFormat($value['price']) . '" data-is-gift="' . $value['is_special_gift'] . '" data-select="' . Config::get('constants.type.id.GET_ALL') . '">' . $value['name'] . '</option>';
                    if ($value['is_special_gift'] != Config::get('constants.type.checkbox.SELECTED') && $value['is_combo'] != Config::get('constants.type.checkbox.SELECTED')) {
                        switch ($value['category_type_id']) {
                            case (int)Config::get('constants.type.category.OTHER'):
                                $data_other_opt .= '<option value="' . $value['id'] . '" data-category="3" data-weight="' . $value['is_sell_by_weight'] . '" data-avatar="' . $domain . $value['avatar'] . '" data-name="' . $value['name'] . '" data-price="' . $value['price'] . '" data-price-format="' . $this->numberFormat($value['price']) . '" data-is-gift="' . $value['is_special_gift'] . '" data-select="' . Config::get('constants.type.category.OTHER') . '">' . $value['name'] . '</option>';
                                break;
                            case (int)Config::get('constants.type.category.FOOD'):
                                $data_food_opt .= '<option value="' . $value['id'] . '" data-category="1"  data-weight="' . $value['is_sell_by_weight'] . '" data-avatar="' . $domain . $value['avatar'] . '" data-name="' . $value['name'] . '" data-price="' . $value['price'] . '" data-price-format="' . $this->numberFormat($value['price']) . '" data-is-gift="' . $value['is_special_gift'] . '" data-select="' . Config::get('constants.type.category.FOOD') . '">' . $value['name'] . '</option>';
                                break;
                            case (int)Config::get('constants.type.category.DRINK'):
                                $data_drink_opt .= '<option value="' . $value['id'] . '" data-category="2" data-weight="' . $value['is_sell_by_weight'] . '" data-avatar="' . $domain . $value['avatar'] . '" data-name="' . $value['name'] . '" data-price="' . $value['price'] . '" data-price-format="' . $this->numberFormat($value['price']) . '" data-is-gift="' . $value['is_special_gift'] . '" data-select="' . Config::get('constants.type.category.DRINK') . '">' . $value['name'] . '</option>';
                                break;
                        }
                    }
                    if ($value['is_allow_employee_gift'] == Config::get('constants.type.checkbox.SELECTED')) {
                        $data_special_opt .= '<option value="' . $value['id'] . '" data-avatar="' . $domain . $value['avatar'] . '" data-name="' . $value['name'] . '" data-price="' . $value['price'] . '" data-price-format="' . $this->numberFormat($value['price']) . '" data-is-gift="' . $value['is_special_gift'] . '" data-select="' . Config::get('constants.type.category.OTHER') . '">' . $value['name'] . '</option>';
                    }
                    if ($value['is_combo'] == Config::get('constants.type.checkbox.SELECTED')) {
                        $data_combo_opt .= '<option value="' . $value['id'] . '" data-category="6" data-avatar="' . $domain . $value['avatar'] . '" data-name="' . $value['name'] . '" data-price="' . $value['price'] . '" data-price-format="' . $this->numberFormat($value['price']) . '" data-is-gift="' . $value['is_special_gift'] . '" data-select="' . Config::get('constants.type.category.COMBO') . '">' . $value['name'] . '</option>';

                    }
                }
            }
            $data_opt = [
                'all' => $data_all_opt,
                'other_opt' => $data_other_opt,
                'food_opt' => $data_food_opt,
                'drink_opt' => $data_drink_opt,
                'sea_food_opt' => $data_sea_opt,
                'gift_opt' => $data_special_opt,
                'combo_opt' => $data_combo_opt,
            ];
            return [0, $data_opt, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataUpdate(Request $request)
    {

        $branch = $request->get('branch');
        $customer_id = $request->get('customer_id');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $category_type = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.checkbox.GET_ALL');
        $category_id = Config::get('constants.type.id.GET_ALL');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_sell_by_weight= Config::get('constants.type.checkbox.DIS_SELECTED');
        $is_allow_booking = Config::get('constants.type.checkbox.SELECTED');
        $kitchen_id=Config::get('constants.type.checkbox.DIS_SELECTED');
        $api = sprintf(API_FOOD_GET_ALL_BRANCH_MANAGE,$category_type , $branch, $category_id, $is_take_away, $is_combo, $is_sell_by_weight, $is_special_gift, $status, $is_allow_booking,$kitchen_id, $is_addition);
        $body = null;
        $requestDataFood = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $id = $request->get('id');
        $api = sprintf(API_BOOKING_GET_DETAIL_TABLE_MANAGE, $id);
        $body = null;
        $requestDataFoodBooking = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $status = 0;
        $api = sprintf(API_CARD_TAG_GET, $status);
        $body = null;
        $requestDataListTags = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_CARD_TAG_GET_TAGS_OF_CUSTOMER, $customer_id);
        $body = null;
        $requesCustomerTags = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_LIST_AREA_GET, $branch, $is_take_away, $status);
        $body = null;
        $requesGetListTable = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestDataFood, $requestDataFoodBooking, $requestDataListTags, $requesCustomerTags, $requesGetListTable]);
        try {
            $dataTagsAssign = collect($configAll[3]['data'])->where('is_assign', 1)->pluck('id')->toArray();
            $data = $this->compareTwoArrayTemplate($configAll[0]['data']['list'], $configAll[1]['data']['foods'], 'id', 'id');
            $data_all_opt = '<option value="" disabled selected>' . TEXT_SELECT_FOOD . '</option>';
            $data_food_opt = '<option value=""disabled  selected>' . TEXT_SELECT_FOOD . '</option>';
            $data_drink_opt = '<option value=""disabled  selected>' . TEXT_SELECT_FOOD . '</option>';
            $data_sea_opt = '<option value=""disabled  selected>' . TEXT_SELECT_FOOD . '</option>';
            $data_other_opt = '<option value=""disabled  selected>' . TEXT_SELECT_FOOD . '</option>';
            $data_special_opt = '<option value=""disabled  selected>' . TEXT_SELECT_FOOD . '</option>';
            $data_combo_opt = '<option value=""disabled  selected>' . TEXT_SELECT_FOOD . '</option>';
            if (empty($data)) {
                $data_all_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
                $data_food_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
                $data_drink_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
                $data_sea_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
                $data_other_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
                $data_special_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
                $data_combo_opt = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
            }
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            for ($i = 0; $i < count($data); $i++) {
                if(count($data[$i]['food_addition_ids'])==0) {
                    $data_all_opt .= '<option data-category="' . $data[$i]['category_type_id'] . '" value="' . $data[$i]['id'] . '" data-weight="' . $data[$i]['is_sell_by_weight'] . '" data-avatar="' . $domain . $data[$i]['avatar'] . '" data-name="' . $data[$i]['name'] . '" data-price="' . $data[$i]['price'] . '" data-price-format="' . $this->numberFormat($data[$i]['price']) . '" data-is-gift="' . $data[$i]['is_special_gift'] . '" data-select="' . Config::get('constants.type.id.GET_ALL') . '">' . $data[$i]['name'] . '</option>';
                    if ($data[$i]['is_special_gift'] != Config::get('constants.type.checkbox.SELECTED') && $data[$i]['is_combo'] != Config::get('constants.type.checkbox.SELECTED')) {
                        switch ($data[$i]['category_type_id']) {
                            case (int)Config::get('constants.type.category.OTHER'):
                                $data_other_opt .= '<option  value="' . $data[$i]['id'] . '" data-category="3" data-weight="' . $data[$i]['is_sell_by_weight'] . '" data-avatar="' . $domain . $data[$i]['avatar'] . '" data-name="' . $data[$i]['name'] . '" data-price="' . $data[$i]['price'] . '" data-price-format="' . $this->numberFormat($data[$i]['price']) . '" data-is-gift="' . $data[$i]['is_special_gift'] . '" data-select="' . Config::get('constants.type.category.OTHER') . '">' . $data[$i]['name'] . '</option>';
                                break;
                            case (int)Config::get('constants.type.category.FOOD'):
                                $data_food_opt .= '<option value="' . $data[$i]['id'] . '" data-category="1" data-weight="' . $data[$i]['is_sell_by_weight'] . '" data-avatar="' . $domain . $data[$i]['avatar'] . '" data-name="' . $data[$i]['name'] . '" data-price="' . $data[$i]['price'] . '" data-price-format="' . $this->numberFormat($data[$i]['price']) . '" data-is-gift="' . $data[$i]['is_special_gift'] . '" data-select="' . Config::get('constants.type.category.FOOD') . '">' . $data[$i]['name'] . '</option>';
                                break;
                            case (int)Config::get('constants.type.category.DRINK'):
                                $data_drink_opt .= '<option value="' . $data[$i]['id'] . '" data-category="2" data-weight="' . $data[$i]['is_sell_by_weight'] . '" data-avatar="' . $domain . $data[$i]['avatar'] . '" data-name="' . $data[$i]['name'] . '" data-price="' . $data[$i]['price'] . '" data-price-format="' . $this->numberFormat($data[$i]['price']) . '" data-is-gift="' . $data[$i]['is_special_gift'] . '" data-select="' . Config::get('constants.type.category.DRINK') . '">' . $data[$i]['name'] . '</option>';
                                break;
                            case (int)Config::get('constants.type.category.SEA_FOOD'):
                                $data_sea_opt .= '<option value="' . $data[$i]['id'] . '"  data-weight="' . $data[$i]['is_sell_by_weight'] . '" data-avatar="' . $domain . $data[$i]['avatar'] . '" data-name="' . $data[$i]['name'] . '" data-price="' . $data[$i]['price'] . '" data-price-format="' . $this->numberFormat($data[$i]['price']) . '" data-is-gift="' . $data[$i]['is_special_gift'] . '" data-select="' . Config::get('constants.type.category.SEA_FOOD') . '">' . $data[$i]['name'] . '</option>';
                                break;
                        }
                    }
                    if ($data[$i]['is_allow_employee_gift'] == Config::get('constants.type.checkbox.SELECTED')) {
                        $data_special_opt .= '<option value="' . $data[$i]['id'] . '" data-avatar="' . $domain . $data[$i]['avatar'] . '" data-name="' . $data[$i]['name'] . '" data-price="' . $data[$i]['price'] . '" data-price-format="' . $this->numberFormat($data[$i]['price']) . '" data-is-gift="' . $data[$i]['is_special_gift'] . '" data-select="' . Config::get('constants.type.category.OTHER') . '">' . $data[$i]['name'] . '</option>';
                    }

                    if ($data[$i]['is_combo'] == Config::get('constants.type.checkbox.SELECTED')) {
                        $data_combo_opt .= '<option value="' . $data[$i]['id'] . '" data-category="6" data-avatar="' . $domain . $data[$i]['avatar'] . '" data-name="' . $data[$i]['name'] . '" data-price="' . $data[$i]['price'] . '" data-price-format="' . $this->numberFormat($data[$i]['price']) . '" data-is-gift="' . $data[$i]['is_special_gift'] . '" data-select="' . Config::get('constants.type.category.COMBO') . '">' . $data[$i]['name'] . '</option>';
                    }
                }
            }
            $data_opt = [
                'all' => $data_all_opt,
                'other_opt' => $data_other_opt,
                'food_opt' => $data_food_opt,
                'drink_opt' => $data_drink_opt,
                'sea_food_opt' => $data_sea_opt,
                'gift_opt' => $data_special_opt,
                'combo_opt' => $data_combo_opt,
            ];

            $data = ($configAll[1]['data']);
            // Trạng thái đặt bàn
            switch ($data['booking_status']) {
                case (int)Config::get('constants.type.BookingStatusEnum.WAITING_CONFIRM'):
                    $data['status'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                            <label class="m-0">' . TEXT_WAITING . '</label>
                                        </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.PREPARING'):
                    $data['status'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                            <label class="m-0">' . TEXT_PREPARING . '</label>
                                        </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.CONFIMED'):
                    $data['status'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                            <label class="m-0">' . TEXT_CONFINED . '</label>
                                        </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.WAITING_COMPLETE'):
                    $data['status'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                            <label class="m-0">' . TEXT_WAITING_COMPLETE . '</label>
                                        </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.COMPLETED'):
                    $data['status'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                            <label class="m-0">' . TEXT_DONE . '</label>
                                        </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.CANCEL'):
                    $data['status'] = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                            <label class="m-0">' . TEXT_CANCELED . '</label>
                                        </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.EXPIRED'):
                    $data['status'] = '<div class="seemt-gray seemt-border-gray-w200 status-new" style="display: inline !important; max-width: max-content;">
                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                            <label class="m-0">' . TEXT_EXPIRED . '</label>
                                        </div>';
                    break;
                case (int)Config::get('constants.type.BookingStatusEnum.SET_UP'):
                    $data['status'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                            <label class="m-0">' . TEXT_WAITING_SET_UP . '</label>
                                        </div>';
                    break;
                default:
                    $data['status'] = '<div class="seemt-gray seemt-border-gray-w200 status-new" style="display: inline !important; max-width: max-content;">
                                            <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                            <label class="m-0">' . TEXT_UNKNOWN . '</label>
                                        </div>';
            }
            if ($data['deposit_amount'] > 0 && $data['return_deposit_amount'] <= 0) {
                if ($data['is_deposit_confirmed'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    $data['deposit_status'] = '<div class="seemt-green seemt-border-green status-new mr-2" data-text="' . TEXT_WAITING_SCHEDULE . '" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_BOOKING_CONFIRMED . '</label>
                                                    </div>';
                } else {
                    $data['deposit_status'] = '<div class="seemt-orange seemt-border-orange status-new mr-2" data-text="' . TEXT_BOOKING_CONFIRMED . '" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_WAITING_SCHEDULE . '</label>
                                                    </div>';
                }
            } else {
                $data['deposit_status'] = '';
            }

            $data['deposit_amount'] = $this->numberFormat($data['deposit_amount']);
            $data['return_deposit_amount'] = $this->numberFormat($data['return_deposit_amount']);
            $data['number_slot'] = $this->numberFormat($data['number_slot']);
            $data['total_amount'] = $this->numberFormat($data['total_amount']);
            $data['area'] = '';
            $db_table = [];
            $db_table_id = [];
            if ($data['tables'] !== null) {
                foreach ($data['tables'] as $db) {
                    array_push($db_table, $db['name']);
                    array_push($db_table_id, ['id' => $db['id'], 'name' => $db['name']]);
                    $data['area'] = $db['area'];
                }
                $data['tables'] = implode(',', $db_table);
                $data['tables_id'] = $db_table_id;
            } else {
                $data['tables'] = '';
                $data['tables_id'] = $db_table_id;
            }

            $option_tags = '';
            for ($i = 0; $i < count($configAll[2]['data']['list']); $i++) {
                $option_tags .= '<option value="' . $configAll[2]['data']['list'][$i]['id'] . '">' . $configAll[2]['data']['list'][$i]['name'] . '</option>';
            }
            $dataTableFoodBooking = $this->drawDataTable($configAll[1]['data']['foods']);
            $list_branch = Session::get('SESSION_KEY_DATA_BRANCH');
            $branch_option = '';
            foreach ($list_branch as $key => $value) {
                $branch_option .= '<option value="'. $value['id'] .'">'. $value['name'] .'</option>';
            }
            return [0, $data_opt, $data, $dataTableFoodBooking, $option_tags, $dataTagsAssign, $configAll, $branch_option];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function drawDataTable($data)
    {
        return DataTables::of($data)
            ->addColumn('avatar', function ($rows) {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $rows['avatar'] . '" class="img-data-table">';
            })
            ->addColumn('name', function ($rows) {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $rows['avatar'] . '" class="img-inline-name-data-table">
                            <label class="title-name-new-table" >' . $rows['name'] . '<br><input type="text" class="d-none" value="' . $rows['id'] . '" data-select="' . $rows['category_type'] . '"></label>';
            })
            ->addColumn('total_amount', function ($rows) {
                if ($rows['is_gift'] == Config::get('constants.type.checkbox.SELECTED')) {
                    return '<label class="d-none">0</label><i class="fa fa-2x fa-gift text-warning"></i>';
                }
                return '<label  class="total-price text-center"><span class="seemt-fz-14" >' . $this->numberFormat($rows['total_amount']) . '</span></label>';
            })
            ->addColumn('quantity', function ($rows) {
                $sell_method = $rows['is_sell_by_weight'] === 1 ? 'data-float="1"' : 'data-number="1"';
                return '<div class="input-group border-group validate-table-validate">
                          <input style="font-size: 14px !important;" class="form-control quantity text-right rounded text-center border-0 w-100" ' . $sell_method . ' data-min="1" data-max="999" value="' . $this->numberFormat($rows['quantity']) . '">
                          <label class="d-none quantity-label">' . $rows['quantity'] . '</label>
                        </div>';
            })
            ->addColumn('price', function ($rows) {
                if ($rows['is_gift'] == Config::get('constants.type.checkbox.SELECTED'))
                    return '<div class="text-center"><i class="fa fa-2x fa-gift text-warning"></i></div>';
                return $this->numberFormat($rows['price']);
            })
            ->addColumn('action', function ($rows) {
                return '<div class="btn-group-sm">
                            <button class="tabledit-delete-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-value="'.$rows['id'].'" data-category="'.$rows['category_type'].'" data-placement="top" data-original-title="' . TEXT_REMOVE . '" onclick="removeFoodUpdateBookingTableManage($(this))"><span class="fi-rr-trash"></span></button>
                        </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addIndexColumn()
            ->rawColumns(['name', 'price', 'action', 'gift', 'quantity', 'avatar', 'total_amount'])
            ->make(true);
    }

    public function getAreaTableUpdate(Request $request)
    {
        $area_id = $request->get('area_id');
        $table_id = $request->get('table_id');
        $branch_id = $request->get('branch_id');
        $booking_id = $request->get('booking_id');
        $is_take_away = Config::get('constants.type.id.GET_ALL');
        $status = Config::get('constants.type.status.GET_ACTIVE');

        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LIST_AREA_GET, $branch_id, $is_take_away, $status);
        $body = null;
        $config_area = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $data = $config_area['data']['list'];
        if (!empty($data)) {
            $area_data = '<option disabled hidden>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                if ($area_id == $data[$i]['id']) {
                    $area_data .= '<option value="' . $data[$i]['id'] . '" selected>' . $data[$i]['name'] . '</option>';
                } else {
                    $area_data .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
        } else {
            $area_data = '<option>' . TEXT_NULL_OPTION . '</option>';
        }

        if (!empty($table_id)) {
            for ($i = 0; $i < count($table_id); $i++) {
                $table_id[$i] = json_decode($table_id[$i], true);
            }
        }

        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BOOKING_GET_TABLE_MANAGE, $area_id, $branch_id, $booking_id);
        $body = null;
        $config_table = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $data_table = $config_table['data'];
        if (!empty($data_table)) {
            $table_data = '<option disabled hidden>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data_table); $i++) {
                if (!empty($table_id)) {
                    $count_table = count($table_id);
                    for ($a = 0; $a < $count_table; $a++) {
                        if ($table_id[$a]['id'] == $data_table[$i]['id']) {
                            $data_table[$i]['selected'] = 1;
                            unset($table_id[$a]);
                            $table_id = array_values($table_id);
                        } else {
                            $data_table[$i]['selected'] = 0;
                        }
                        break;
                    }
                } else {
                    $data_table[$i]['selected'] = 0;
                }
            }
            for ($i = 0; $i < count($data_table); $i++) {
                if ($data_table[$i]['selected'] == 1) {
                    $table_data .= '<option value="' . $data_table[$i]['id'] . '" selected>' . $data_table[$i]['name'] . '</option>';
                } else {
                    if ($data_table[$i]['table_status'] === ENUM_DIS_SELECTED) {
                        $table_data .= '<option value="' . $data_table[$i]['id'] . '">' . $data_table[$i]['name'] . '</option>';
                    }
                }
            }
        } else {
            $table_data = '<option>' . TEXT_NULL_OPTION . '</option>';
        }


        $config = [
            'config_area' => $config_area['config'],
            'config_table' => $config_table['config']
        ];
        return [$area_data, $table_data, $config];

    }

    public function getAreaUpdate(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $is_take_away = Config::get('constants.type.id.GET_ALL');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LIST_AREA_GET, $branch_id, $is_take_away, $status);
        $body = null;
        $config_area = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $data = $config_area['data']['list'];
        if (!empty($data)) {
            $area_data = '<option disabled hidden>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $area_data .= '<option value="' . $data[$i]['id'] . '" selected>' . $data[$i]['name'] . '</option>';
            }
        } else {
            $area_data = '<option>' . TEXT_NULL_OPTION . '</option>';
        }
        return [$area_data, $config_area];
    }
    public function getTableUpdate(Request $request)
    {
        $area_id = $request->get('area_id');
        $branch_id = $request->get('branch_id');
        $booking_id = $request->get('booking_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BOOKING_GET_TABLE_MANAGE, $area_id, $branch_id, $booking_id);
        $body = null;
        $config_table = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $data_table = $config_table['data'];
        $table_data = '<option disabled hidden>' . TEXT_DEFAULT_OPTION . '</option>';
        for ($i = 0; $i < count($data_table); $i++) {
            $table_data .= '<option value="' . $data_table[$i]['id'] . '">' . $data_table[$i]['name'] . '</option>';
        }
        return [$table_data, $config_table];
    }
    public function update(Request $request)
    {
        $id = $request->get('id');
        $customerID = $request->get('customer_id');
        $branch = $request->get('branch');
        $otherRequirements = $request->get('orther_requirements');
        $note = $request->get('note');
        $numberSlot = $request->get('number_slot');
        $table = $request->get('table');
        $bookingTime = $request->get('booking_time');
        $depositAmount = $request->get('deposit_amount');
        $depositPaymentMethod = $request->get('deposit_payment_method');
        $customerFirstName = $request->get('customer_first_name');
        $customerLastName = $request->get('customer_last_name');
        $customerPhone = $request->get('customer_phone');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_POST_UPDATE_BOOKING_LIST, $id);
        $body = [
            "booking_id" => $id,
            "branch_id" => $branch,
            "customer_first_name" => $customerFirstName,
            "customer_last_name" => $customerLastName,
            "customer_phone" => $customerPhone,
            "orther_requirements" => $otherRequirements,
            "note" => $note,
            "number_slot" => $numberSlot,
            "food_request" => $table,
            "booking_time" => $bookingTime,
            "deposit_amount" => $depositAmount,
            "payment_method" => $depositPaymentMethod,
            "restaurant_gift_ids" => $request->get('restaurant_customer_gifts')
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $listTags = $request->get('list');
            $project = ENUM_PROJECT_ID_ORDER;
            $method = ENUM_METHOD_POST;
            $api = sprintf(API_CUSTOMER_TAGS_POST_ASSIGN);
            $body = [
                'customer_id' => $customerID == ENUM_DIS_SELECTED ? $config['data']['customer_id'] : $customerID,
                'tag_insert_ids' => $listTags,
                'tag_delete_ids' => []
            ];
            $config['assgin-tags'] = $this->callApiGatewayTemplate($project, $method, $api, $body);
            if ($request->get('change_table') == 1) {
                $project = ENUM_PROJECT_ID_ORDER;
                $method = ENUM_METHOD_POST;
                $api = sprintf(API_BOOKING_POST_CONFIRM_TABLE_BOOKING_LIST, $id);
                $body = [
                    'area_id' => $request->get('area_id'),
                    'branch_id' => $branch,
                    'tables_ids' => $request->get('tables_ids')
                ];
                $config2 = $this->callApiGatewayTemplate($project, $method, $api, $body);
                $config = $this->drawRowTableBooking($config);
                return [$config, $config2];
            }
            $config = $this->drawRowTableBooking($config);
            return $config;
        } else {
            return $config;
        }
    }

    function drawRowTableBooking($config) {
        $config['customer_name'] = $config['data']['customer_name'] === '' ? '---' : (mb_strlen($config['data']['customer_name']) > 30 ? '<label>' . mb_substr($config['data']['customer_name'], 0, 27) . '...' : $config['data']['customer_name']);
        $config['total_amount'] = $this->numberFormat($config['data']['total_amount']);
        $config['employee_create_name'] = $this->numberFormat($config['data']['employee_create']['name']);
        $config['return_deposit_amount'] = $this->numberFormat($config['data']['return_deposit_amount']);
        $config['deposit_amount'] = '<label id="deposit-amount-' . $config['data']['id'] . '">' . $this->numberFormat($config['data']['deposit_amount']) . '</label>';
        $config['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
        switch ($config['data']['booking_status']) {
            case (int)Config::get('constants.type.BookingStatusEnum.WAITING_CONFIRM'):
                $button = '<button type="button" class="tabledit-edit-button btn seemt-green seemt-bg-green seemt-btn-hover-green waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="confirmBookingTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONFIRM . '"><i class="fi-rr-check"></i></button>';
                if ($config['data']['deposit_amount'] != Config::get('constants.type.checkbox.DIS_SELECTED') && $config['data']['is_deposit_confirmed'] != Config::get('constants.type.checkbox.SELECTED')) {
                    $button = '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="confirmDepositBookingDataTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận cọc"><span class="fa fa-money"></span></button>';
                    $config['status_text'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_WAITING_SCHEDULE . '</label>
                                                    </div>';
                } else {
                    $config['status_text'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_WAITING . '</label>
                                                    </div>';
                }
                $config['action'] = '<div class="btn-group btn-group-sm float-right">
                                    ' . $button . '
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-status="' . $config['data']['booking_status'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.CONFIMED'):
                $button = ' <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-branch="' . $config['data']['branch']['id'] . '" onclick="openModalTableBookingTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xếp bàn"><span class="icofont icofont-fork-and-knife"></span></button>';
                if ($config['data']['deposit_amount'] != Config::get('constants.type.checkbox.DIS_SELECTED') && $config['data']['is_deposit_confirmed'] != Config::get('constants.type.checkbox.SELECTED')) {
                    $button = '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="confirmDepositBookingDataTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận cọc"><span class="fa fa-money"></span></button>';
                }
                $config['action'] = '<div class="btn-group btn-group-sm float-right">
                                ' . $button . '
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['booking_status'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                $config['status_text'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_CONFINED . '</label>
                                                    </div>';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.COMPLETED'):
                $config['action'] = '<div class="btn-group btn-group-sm float-right">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                $config['status_text'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_DONE . '</label>
                                                    </div>';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.WAITING_COMPLETE'):
                $config['action'] = '<div class="btn-group btn-group-sm float-right">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                $config['status_text'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_WAITING_COMPLETE . '</label>
                                                    </div>';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.CANCEL'):
                $config['action'] = '<div class="btn-group btn-group-sm float-right">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                $config['status_text'] = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_CANCELED . '</label>
                                                    </div>';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.EXPIRED'):
                $config['action'] = '<div class="btn-group btn-group-sm float-right">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                $config['status_text'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_EXPIRED . '</label>
                                                    </div>';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.SET_UP'):
                $button = '';
                if ($config['data']['deposit_amount'] != Config::get('constants.type.checkbox.DIS_SELECTED') && $config['data']['is_deposit_confirmed'] != Config::get('constants.type.checkbox.SELECTED')) {
                    $button = '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="confirmDepositBookingDataTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận cọc"><span class="fa fa-money"></span></button>';
                }
                $config['action'] = '<div class="btn-group btn-group-sm float-right">
                                  ' . $button . '
                                      <button type="button" class="tabledit-edit-button btn seemt-green seemt-bg-green seemt-btn-hover-green waves-effect waves-light"  data-id="' . $config['data']['id'] . '" data-branch="' . $config['data']['branch']['id'] . '" onclick="acceptSetUpTableBookingTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận Setup bàn"><i class="fi-rr-check"></i></button>
                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['booking_status'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                $config['status_text'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_WAITING_SET_UP . '</label>
                                                    </div>';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.PREPARING'):
                $config['action'] = '<div class="btn-group btn-group-sm float-right">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-branch="' . $config['data']['branch']['id'] . '" onclick="acceptCustomerBookingTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Nhận khách"><i class="fi-rr-user"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                $config['status_text'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_PREPARING . '</label>
                                                    </div>';
                break;
            default :
                $config['action'] = '<div class="btn-group btn-group-sm float-right">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                $config['status_text'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_UNKNOWN . '</label>
                                                    </div>';
                break;
        }
        return $config;
    }

    public function dataGift(Request $request)
    {
        $brand = $request->get('brand');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $page = ENUM_DEFAULT_PAGE;
        $api = sprintf(API_GIFT_MARKETING_GET, $brand, $status, $limit, $page);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $dataTableGift = DataTables::of($config['data']['list'])
                ->addColumn('key_search', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('checkbox', function ($row) use ($domain) {
                    return '<div class="checkbox-fade fade-in-primary m-auto">
                                <label>
                                <input type="checkbox" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '"  data-img="' . $domain . $row['image_url'] . '" class="checkbox"/>
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                </label>
                            </div>';
                })
                ->addColumn('logo', function ($row) use ($domain) {
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['image_url'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['image_url'] . "'" . ')"/>' . $row['name'] . '</label>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $row['id'] . '" onclick="openModalDetailGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'checkbox', 'logo'])
                ->make(true);
            return [$dataTableGift, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function tag(Request $request)
    {
        $is_delete = $request->get('is_delete');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_CARD_TAG_GET, $is_delete);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $data = collect($config['data']);
        $li = '';
        foreach ($data as $item) {
            $li .= '<li data-color="' . $item['color_hex_code'] . '" class="item-search-customer text-white"   value="' . $item['id'] . '">' . $item['name'] . '</li>';
        }
        return [$li, $config];
    }

    public function create(Request $request)
    {
        $branch = $request->get('branch');
        $customerID = $request->get('customer_id');
        $customerFullName = $request->get('customer_full_name');
        $customerPhone = $request->get('customer_phone');
        $depositAmount = $request->get('deposit_amount');
        $depositPaymentMethod = $request->get('deposit_payment_method');
        $otherRequirements = $request->get('orther_requirements');
        $note = $request->get('note');
        $numberSlot = $request->get('number_slot');
        $bookingTime = $request->get('booking_time');
        $bookingType = $request->get('booking_type');
        $gift = $request->get('gift');
        $tableData = $request->get('TableData');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_CREATE_TABLE_MANAGE);
        $body = [
            'branch_id' => $branch,
            'customer_id' => $customerID,
            "full_name" => $customerFullName,
            'customer_phone' => $customerPhone,
            'orther_requirements' => $otherRequirements,
            'note' => $note,
            'number_slot' => $numberSlot,
            'booking_time' => $bookingTime,
            'booking_type' => $bookingType,
            'employee_id' => Session::get(SESSION_JAVA_ACCOUNT)['id'],
            'food_request' => $tableData,
            "deposit_amount" => $depositAmount,
            "payment_method" => $depositPaymentMethod,
            "restaurant_gift_ids" => $gift,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
            $listTags = $request->get('list');
            $api = sprintf(API_CUSTOMER_TAGS_POST_ASSIGN);
            $body = [
                'customer_id' => $customerID == ENUM_DIS_SELECTED ? $config['data']['customer_id'] : $customerID,
                'tag_insert_ids' => $listTags,
                'tag_delete_ids' => []
            ];
            $config['assgin-tags'] = $this->callApiGatewayTemplate($project, $method, $api, $body);
            $config = $this->drawRowTableBooking($config);
        }
        return $config;
    }

    public function searchCustomer(Request $request)
    {
        $key_search = $request->get('phone');
        $branch = $request->get('branch_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $is_only_aloline_customer = Config::get('constants.type.checkbox.GET_ALL');
        $limit= ENUM_DEFAULT_LIMIT_50;
        $api = sprintf(API_BOOKING_SEARCH_CUSTOMER_ALOLINE,$limit, $key_search, (int)$branch, $is_only_aloline_customer);
        $body = [];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $itemCustomer = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            foreach ($config['data'] as $db) {
                $itemCustomer .= '<li class="item-search-customer" data-phone="' . $db['phone'] . '" data-name="' . $db['name'] . '" data-id="' . $db['id'] . '">
                                            <figure><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $db['avatar'] . '" class="avatar-search-customer" ></figure>
                                            <div class="friend-meta">
                                                <h4>' . $db['name'] . '</h4>
                                                <p class="seemt-orange" style="font-size: 10px !important;">' . $db['phone'] . '</p>
                                            </div>
                                        </li>';
            }
            return [$itemCustomer, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function employee(Request $request)
    {
        $branch_id = $request->get('branch');
        $brand_id = $request->get('restaurant_brand_id');
        $is_include_restaurant_manager = Config::get('constants.type.checked.SELECTED');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $is_take_myself = Config::get('constants.type.status.GET_ALL');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_EMPLOYEE_GET_DATA, $branch_id, $status, $is_include_restaurant_manager, $is_take_myself, $brand_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $food_data = '<option hidden disabled selected value="0">' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $food_data .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
            }
            if ($food_data === '<option selected>' . TEXT_DEFAULT_OPTION . '</option>') {
                $food_data = '<option selected>' . TEXT_NULL_OPTION . '</option>';
            }

            return [$food_data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function setting(Request $request)
    {
        $branch = $request->get('branch');
        $isBooking = (int)$request->get('booking');
        $api = sprintf(API_BOOKING_POST_SETTING_TABLE_MANAGE, $branch);
        $body = null;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $dataBranch = Session::get(SESSION_KEY_DATA_BRANCH);
            foreach ($dataBranch as $key => $db) {
                if ($db['id'] === (int)$branch) $dataBranch[$key]['is_enable_booking'] = $isBooking;
                Session::put(SESSION_KEY_DATA_BRANCH, $dataBranch);
            }
            if (Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['id'] === (int)$branch) {
                $dataCurrentBranch = Session::get(SESSION_KEY_DATA_CURRENT_BRANCH);
                $dataCurrentBranch['is_enable_booking'] = $isBooking;
                Session::put(SESSION_KEY_DATA_CURRENT_BRANCH, $dataCurrentBranch);
                $settingCurrentBranch = Session::get(SESSION_KEY_SETTING_CURRENT_BRANCH);
                $settingCurrentBranch['is_enable_booking'] = $isBooking;
                Session::put(SESSION_KEY_SETTING_CURRENT_BRANCH, $settingCurrentBranch);
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function returnDeposit(Request $request)
    {
        $id = $request->get('id');
        $branch_id = $request->get('branch_id');
        $payment_method = $request->get('payment_method');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_POST_RETURN_DEPOSIT_TABLE_MANAGE, $id);
        $body = [
            "branch_id" => $branch_id,
            "payment_method" => $payment_method,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function cancel(Request $request)
    {
        $id = $request->get('id');
        $branch_id = $request->get('branch_id');
        $cancel_reason = $request->get('cancel_reason');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_POST_CANCEL_TABLE_MANAGE, $id);
        $body = [
            "branch_id" => $branch_id,
            "cancel_reason" => $cancel_reason,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function setup(Request $request)
    {
        $booking_id = $request->get('booking_id');
        $branch_id = $request->get('branch_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_POST_SETUP_TABLE_MANAGE, $booking_id);
        $body = [
            "booking_id" => $booking_id,
            "branch_id" => $branch_id
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['data'] != null) {
                $config['data']['status_text'] = '<label class="label label-warning">' . TEXT_PREPARING . '</label>';
                $config['data']['action'] = '<div class="btn-group btn-group-sm float-right">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-branch="' . $config['data']['branch']['id'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                            </div>';
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function acceptSetupTable(Request $request)
    {
        $booking_id = $request->get('id');
        $branch_id = $request->get('branch_id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_POST_ACCEPT_SETUP_TABLE, $booking_id);
        $body = [
            "branch_id" => $branch_id
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['data'] != null) {
                $config['data']['status_text'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_PREPARING . '</label>
                                                    </div>';

                $config['data']['action'] = '<div class="btn-group btn-group-sm float-right">
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-branch="' . $config['data']['branch']['id'] . '" onclick="acceptCustomerBookingTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Nhận khách"><i class="fi-rr-user"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                            </div>';
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function updateDeposit(Request $request)
    {
        $id = $request->get('id');
        $branch_id = $request->get('branch_id');
        $deposit_amount = $request->get('deposit_amount');
        $payment_method = $request->get('payment_method');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_RECEIVE_DEPOSIT_TABLE_MANAGE, $id);
        $body = [
            "branch_id" => $branch_id,
            "amount" => $deposit_amount,
            "payment_method" => $payment_method,
            "paymentMethodEnum" => "CASH",
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function confirmDeposit(Request $request)
    {
        $booking_id = $request->get('booking_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_CONFIRM_DEPOSIT_BOOKING_TABLE_MANAGE, $booking_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['data'] != null) {
                switch ($config['data']['booking_status']) {
                    case (int)Config::get('constants.type.BookingStatusEnum.WAITING_CONFIRM'):
                        $config['data']['status_text'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                <label class="m-0">' . TEXT_WAITING . '</label>
                                                            </div>';
                        $config['data']['action'] = '<div class="btn-group btn-group-sm float-right">
                                                        <button type="button" class="tabledit-edit-button btn seemt-green seemt-bg-green seemt-btn-hover-green waves-effect waves-light" data-id="' . $config['data']['id'] . '"  onclick="confirmBookingTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONFIRM . '"><i class="fi-rr-check"></i></button>
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-status="' . $config['data']['booking_status'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                    </div>';
                        break;
                    case (int)Config::get('constants.type.BookingStatusEnum.CONFIMED'):
                        $config['data']['status_text'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                <label class="m-0">' . TEXT_CONFINED . '</label>
                                                            </div>';
                        $config['data']['action'] = '<div class="btn-group btn-group-sm float-right">
                                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $config['data']['id'] . '"  onclick="openModalTableBookingTableManage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xếp bàn"><span class="icofont icofont-fork-and-knife"></span></button>
                                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                </div>';
                        break;
                    case (int)Config::get('constants.type.BookingStatusEnum.SET_UP'):
                        $config['data']['status_text'] = '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                <label class="m-0">' . TEXT_WAITING_SET_UP . '</label>
                                                            </div>';
                        $config['data']['action'] = '<div class="btn-group btn-group-sm float-right">
                                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailBookingTableManage($(this))" data-id="' . $config['data']['id'] . '" data-customer="' . $config['data']['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                        </div>';
                        break;
                    default:
                        $config['data']['status'] = '<label class="label label-inverse">' . TEXT_UNKNOWN . '</label>';
                        $config['data']['status_text'] = '<div class="seemt-gray seemt-border-gray-w200 status-new" style="display: inline !important; max-width: max-content;">
                                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                <label class="m-0">' . TEXT_UNKNOWN . '</label>
                                                            </div>';
                }
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function totalBookingProsesing(Request $request)
    {
        $restaurantBrandId = $request->get('restaurant_brand_id');
        $branch = Config::get('constants.type.id.GET_ALL');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BOOKING_TOTAL_LIST_BOOKING, $restaurantBrandId, $branch);
        $body = null;
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }


    public function dataTags(Request $request)
    {
        $status = 0;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_CARD_TAG_GET, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $option_tags = '';
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $option_tags .= '<option value="' . $config['data']['list'][$i]['id'] . '">' . $config['data']['list'][$i]['name'] . '</option>';
            }
            return [$option_tags, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }
}
