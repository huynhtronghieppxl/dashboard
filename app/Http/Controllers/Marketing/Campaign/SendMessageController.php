<?php

namespace App\Http\Controllers\Marketing\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Treasurer\FundPeriodController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class SendMessageController extends Controller
{
    public function data(Request $request)
    {
        $status = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $api = sprintf(API_GET_NOTIFY_GIFT_MARKETING, $status, $restaurant_brand_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collect = collect($config['data']);
            $dataWaitingAllow = $collect->where('status', ENUM_SELECTED)->all();
            $dataNotSend = $collect->where('status', 2)->where('is_send', 0)->all();
            $dataSend = $collect->where('status', 2)->where('is_send', 1)->all();
            $dataCancel = $collect->where('status', 3)->all();
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $tableWaiting = DataTables::of($dataWaitingAllow)
                ->addColumn('logo', function ($row) use ($domain) {
                    if($row['name']){
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['restaurant_gift']['image_url'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['restaurant_gift']['image_url'] . "'" . ')"/><label style="cursor:pointer" class="seemt-blue f-w-600" data-id="'. $row['restaurant_gift']['id'] .'" onclick="openModalDetailGiftMarketing($(this))">'. $row['name'] .'</label>' ;
                    } elseif ($row['link_url']){
                        return '<label>Link URL</label>';
                    }else{
                        return '<label>Không có quà </label>';
                    }
                })
                ->addColumn('title', function ($row) {
                    return (mb_strlen($row['title']) > 30) ? $row['title'] = mb_substr($row['title'], 0, 27) . '...' : $row['title'];
                })
                ->addColumn('send_notification_at', function ($row) {
                    return ($row['send_notification_at'] !== '' ? $row['send_notification_at'] : '');
                })
                ->addColumn('content', function ($row) {
                    return (mb_strlen($row['content']) > 30) ? $row['content'] = mb_substr($row['content'], 0, 27) . '...' : $row['content'];
                })
                ->addColumn('action', function ($row) use ($domain) {
                    return '<div class="btn-group btn-group-sm">
                             <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id="' . $row['id'] . '" onclick="cancelNotifyGiftMarketing($(this))" data-toggle="tooltip"
                             data-placement="top" data-original-title="Hủy duyệt tin nhắn" data-send="'. $row['is_send'] .'"><i class="fi-rr-trash"></i></button>
                             <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $row['id'] . '" onclick="openModalUpdateSendMessageCampaign($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                             <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailSendMessage($(this))" data-id="'. $row['id'] .'" data-send="'. $row['is_send'] .'"  data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết tin nhắn"><i class="fi-rr-eye"></i></button>
                        </div>';
                })
                ->addColumn('customer', function ($row) {
                    switch ($row['customer_marketing_notification_type']) {
                        case 1:
                            return '<label>'. $row['customer']['name'] .'</label><br>
                                <div class="d-flex">
                                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                    <i class="fi-rr-hastag"></i>
                                    <label class="m-0">Cá nhân</label>
                                    </div>
                                </div>';
                        case 2:
                            return '<label class="label seemt-blue" style="color: #1462B0 !important;">Tất cả</label>';
                        case 3:
                            return '<label class="label seemt-blue" style="color: #1462B0 !important;">Khách hàng đến cửa hàng trong tháng này</label>';
                        case 4:
                            return '<label class="label seemt-blue" style="color: #1462B0 !important;">Khách Hàng Nam</label>';
                        case 5:
                            return '<label class="label seemt-blue" style="color: #1462B0 !important;">Khách hàng có số điểm tích lũy lớn hơn hoặc bằng</label>';
                        case 6:
                            return '<label class="label seemt-blue" style="color: #1462B0 !important;">Khách hàng có thẻ thành viên level</label>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['logo', 'action', 'title', 'content','customer'])
                ->addIndexColumn()
                ->make(true);
            $tableNotSend = DataTables::of($dataNotSend)
                ->addColumn('logo', function ($row) use ($domain) {
                    if($row['name']){
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['restaurant_gift']['image_url'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['restaurant_gift']['image_url'] . "'" . ')"/><label style="cursor:pointer" class="seemt-blue f-w-600" data-id="'. $row['restaurant_gift']['id'] .'" onclick="openModalDetailGiftMarketing($(this))">'. $row['name'] .'</label>' ;
                    } elseif ($row['link_url']){
                        return '<label>Link URL</label>';
                    }else{
                        return '<label>Không có quà </label>';
                    }
                })
                ->addColumn('title', function ($row) {
                    return (mb_strlen($row['title']) > 30) ? $row['title'] = mb_substr($row['title'], 0, 27) . '...' : $row['title'];
                })
                ->addColumn('send_notification_at', function ($row) {
                    return ($row['send_notification_at'] !== '' ? $row['send_notification_at'] : '');
                })
                ->addColumn('content', function ($row) {
                    return (mb_strlen($row['content']) > 30) ? $row['content'] = mb_substr($row['content'], 0, 27) . '...' : $row['content'];
                })
                ->addColumn('action', function ($row) use ($domain) {
                    return '<div class="btn-group btn-group-sm">
                             <button class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $row['id'] . '" onclick="sendNotifyGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Gửi tin nhắn" data-send="'. $row['is_send'] .'"
                             data-gift-id="'. $row['restaurant_gift']['id'] .'" data-link="'. $row['link_url'] .'" data-customer_marketing_notification_type = "'. $row['customer_marketing_notification_type'] .'"
                             data-customer_id="'. $row['customer']['id'] .'" data-title="'. $row['title'] .'" data-content="'. $row['content'] .'" data-message_url="'. $row['message_url'] .'" data-send_notification_at="'. $row['send_notification_at'] .'"
                             ><i class="fi-rr-paper-plane"></i></button>
                             <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailSendMessage($(this))" data-id="'. $row['id'] .'" data-send="'. $row['is_send'] .'"  data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết tin nhắn"><i class="fi-rr-eye"></i></button>
                        </div>';
                })
                ->addColumn('customer', function ($row) {
                    switch ($row['customer_marketing_notification_type']) {
                        case 1:
                            return '<label>'. $row['customer']['name'] .'</label><br>
                                <div class="d-flex">
                                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                    <i class="fi-rr-hastag"></i>
                                    <label class="m-0">Cá nhân</label>
                                    </div>
                                </div>';
                        case 2:
                            return '<label class="label seemt-blue" style="color: #1462B0 !important;">Tất cả</label>';
                        case 3:
                            return '<label class="label seemt-blue" style="color: #1462B0 !important;">Khách hàng đến cửa hàng trong tháng này</label>';
                        case 4:
                            return '<label class="label seemt-blue" style="color: #1462B0 !important;">Khách Hàng Nam</label>';
                        case 5:
                            return '<label class="label seemt-blue" style="color: #1462B0 !important;">Khách hàng có số điểm tích lũy lớn hơn hoặc bằng</label>';
                        case 6:
                            return '<label class="label seemt-blue" style="color: #1462B0 !important;">Khách hàng có thẻ thành viên level</label>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['logo', 'action', 'title', 'content','customer'])
                ->addIndexColumn()
                ->make(true);
            $tableSend = $this->drawTableSendMessageCampaign($dataSend);
            $tableCancel = $this->drawTableSendMessageCampaign($dataCancel);
            $total = [
                'total_record_waiting_allow' => $this->numberFormat(count($dataWaitingAllow)),
                'total_record_not_send' => $this->numberFormat(count($dataNotSend)),
                'total_record_send' => $this->numberFormat(count($dataSend)),
                'total_record_cancel' => $this->numberFormat(count($dataCancel)),
            ];
            return [$tableWaiting, $tableNotSend, $tableSend, $total, $config, $tableCancel];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTableSendMessageCampaign ($data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        return DataTables::of($data)
            ->addColumn('logo', function ($row) use ($domain) {
                if($row['name'] === ''){
                    return '<label>Không có quà </label>';
                } elseif ($row['link_url']){
                    return '<label>Link URL</label>';
                }else{
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['message_url'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['message_url'] . "'" . ')"/><label class="text-primary f-w-600" style="cursor:pointer" data-id="'. $row['restaurant_gift']['id'] .'" onclick="openModalDetailGiftMarketing($(this))">'. $row['name'] .'</label>' ;
                }
            })
            ->addColumn('title', function ($row) {
                return (mb_strlen($row['title']) > 30) ? $row['title'] = mb_substr($row['title'], 0, 27) . '...' : $row['title'];
            })
            ->addColumn('content', function ($row) {
                return (mb_strlen($row['content']) > 30) ? $row['content'] = mb_substr($row['content'], 0, 27) . '...' : $row['content'];
            })
            ->addColumn('customer', function ($row) {
                if($row['customer_marketing_notification_type'] === 2){
                    return '<label class="label seemt-blue" style="color: #1462B0 !important;">Tất cả</label>';
                }
                else{
                    return '<label>'. $row['customer']['name'] .'</label><br>
                                 <div class="d-flex">
                                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                    <i class="fi-rr-hastag"></i>
                                    <label class="m-0">Cá nhân</label>
                                    </div>
                                </div>';
                }
            })
            ->addColumn('reason_cancel', function ($row) {
                return (mb_strlen($row['reason']) > 50) ? $row['reason'] = mb_substr($row['reason'], 0, 47) . '...' : $row['reason'];
            })
            ->addColumn('action', function ($row) use ($domain) {
                return '<div class="btn-group btn-group-sm">
                             <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailSendMessage($(this))" data-id="'. $row['id'] .'" data-send="'. $row['is_send'] .'"><i class="fi-rr-eye"></i></button>
                        </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['logo', 'title', 'content', 'action', 'customer', 'reason_cancel'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create(Request $request)
    {
        $logo = $request->get('logo');
        $title = $request->get('title');
        $content = $request->get('content');
        $type = $request->get('type');
        $id = $request->get('id');
        $gift = $request->get('gift');
        $time = $request->get('time');
        $branchID = $request->get('branch_id');
        $linkUrl = $request->get('link_url');
        $gender = $request->get('gender');
        $point = $request->get('point');
        $lastUsed = $request->get('lastUsed');
        $membershipCardID = $request->get('restaurantMembershipCardId');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_POST_CREATE_NOTIFY_GIFT_MARKETING;
        $body = [
            "customer_marketing_notification_type" => $type,
            "link_url" => $linkUrl,
            "customer_id" => $id,
            "title" => $title,
            "content" => $content,
            "message_url" => $logo,
            "restaurant_gift_id" => $gift,
            "send_notification_at" => $time,
            "restaurant_brand_id" => $branchID,
            "period_customer_offline" => $lastUsed,
            "customer_gender" => $gender,
            "customer_aculate_point" => $point,
            "restaurant_membership_card_id" => $membershipCardID
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        if($config['data']['status'] === 200) {
            $api = sprintf(API_POST_SEND_TO_ADMIN_NOTIFY_MARKETING, $config['data']['data']['id']);
            $body = null;
            $this->callApiGatewayTemplate($project, $method, $api, $body);
        }

        if ($config['data']['data']['customer']['name']) {
            $logo = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['data']['restaurant_gift']['image_url'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $config['data']['data']['restaurant_gift']['image_url'] . "'" . ')"/><label style="cursor:pointer" class="seemt-blue f-w-600" data-id="' . $config['data']['data']['restaurant_gift']['id'] . '" onclick="openModalDetailGiftMarketing($(this))">' . $config['data']['data']['customer']['name'] . '</label>';
        } elseif ($config['data']['data']['link_url']) {
            $logo = '<label>Link URL</label>';
        } else {
            $logo = '<label>Không có quà</label>';
        }

        switch ($config['data']['data']['customer_marketing_notification_type']) {
            case 1:
                $customer_name = '<label>'. $config['data']['data']['customer']['name'] .'</label><br>
                                <div class="d-flex">
                                    <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                    <i class="fi-rr-hastag"></i>
                                    <label class="m-0">Cá nhân</label>
                                    </div>
                                </div>';
                break;
            case 2:
                $customer_name = '<label class="label seemt-blue" style="color: #1462B0 !important;">Tất cả</label>';
                break;
            case 3:
                $customer_name = '<label class="label seemt-blue" style="color: #1462B0 !important;">Khách hàng đến cửa hàng trong tháng này</label>';
                break;
            case 4:
                $customer_name = '<label class="label seemt-blue" style="color: #1462B0 !important;">Khách Hàng Nam</label>';
                break;
            case 5:
                $customer_name = '<label class="label seemt-blue" style="color: #1462B0 !important;">Khách hàng có số điểm tích lũy lớn hơn hoặc bằng</label>';
                break;
            case 6:
                $customer_name = '<label class="label seemt-blue" style="color: #1462B0 !important;">Khách hàng có thẻ thành viên level</label>';
                break;
        }

        $config['data']['data']['logo'] = $logo;
        $config['data']['data']['title'] = mb_strlen($config['data']['data']['title']) > 30 ? mb_substr($config['data']['data']['title'], 0, 27) . '...' : $config['data']['data']['title'];
        $config['data']['data']['send_notification_at'] = $config['data']['data']['send_notification_at'] !== '' ? $config['data']['data']['send_notification_at'] : '';
        $config['data']['data']['content'] = mb_strlen($config['data']['data']['content']) > 30 ? $config['data']['data']['content'] = mb_substr($config['data']['data']['content'], 0, 27) . '...' : $config['data']['data']['content'];
        $config['data']['data']['action'] = '<div class="btn-group btn-group-sm">
                             <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id="' . $config['data']['data']['id'] . '" onclick="cancelNotifyGiftMarketing($(this))" data-toggle="tooltip"
                             data-placement="top" data-original-title="Hủy duyệt tin nhắn" data-send="'. $config['data']['data']['is_send'] .'"><i class="fi-rr-trash"></i></button>
                             <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $config['data']['data']['id'] . '" onclick="openModalUpdateSendMessageCampaign($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                             <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailSendMessage($(this))" data-id="'. $config['data']['data']['id'] .'" data-send="'. $config['data']['data']['is_send'] .'"  data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết tin nhắn"><i class="fi-rr-eye"></i></button>
                        </div>';
        $config['data']['data']['customer'] = $customer_name;
        $config['data']['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']['data']);
        return $config;
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $customer_id = $request->get('customer_id');
        $brand_id = $request->get('brand_id');
        $linkUrl = $request->get('link_url');
        $type = $request->get('type');
        $title = $request->get('title');
        $content = $request->get('content');
        $gift = $request->get('gift');
        $logo = $request->get('logo');
        $time = $request->get('time');
        $gender = $request->get('gender');
        $point = $request->get('point');
        $lastUsed = $request->get('lastUsed');
        $membershipCardID = $request->get('restaurantMembershipCardId');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_POST_UPDATE_NOTIFY_GIFT_MARKETING, $id);
        $body = [
            "restaurant_brand_id"=> $brand_id,
            "customer_marketing_notification_type" => $type,
            "customer_id" => $customer_id,
            "link_url" => $linkUrl,
            "title" => $title,
            "content" => $content,
            "restaurant_gift_id" => $gift,
            "message_url" => $logo,
            "send_notification_at" => $time,
            "period_customer_offline" => $lastUsed,
            "customer_gender" => $gender,
            "customer_aculate_point" => $point,
            "restaurant_membership_card_id" => $membershipCardID
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function customer(Request $request)
    {
        $phone = $request->get('phone');
        $name = Config::get('constants.type.data.NONE');
        $branch = Config::get('constants.type.data.GET_ALL');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BOOKING_SEARCH_CUSTOMER, $name, $phone, $branch);
        $body = [];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function dataUpdate(Request $request){
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_DETAIL_NOTIFY_SEND_MESSAGE, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        if($config['status'] === (int)Config::get('constants.type.status.STATUS_SUCCESS')){
            $config['data']['message_url_media'] =  Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['message_url'];
        }
        return $config;
    }

    public function detail(Request $request){
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_DETAIL_NOTIFY_SEND_MESSAGE, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $config['data']['message_url'] = '<img onerror="imageDefaultOnLoadError($(this))" style="border-radius:50%;width:100%;height:100%;object-fit:cover;" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['message_url'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['message_url'] . "'" . ')"/>';
        return $config;
    }

    public function gift(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $page = ENUM_DEFAULT_PAGE;
        $type = Config::get('constants.type.checkbox.DIS_SELECTED');
        $api = sprintf(API_GIFT_MARKETING_GET_NEW_CUSTOMER, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $gift = '';
            foreach ($config['data']['list'] as $db) {
                $gift .= '<option value="' . $db['restaurant_gift_id'] . '">' . $db['name'] . '</option>';
            }
            if (count($config['data']['list']) === 0) {
                $gift = '<option selected value="0">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$gift, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
    public function send(Request $request ){
        $id = $request->get('id');
        $message_url = $request->get('message_url');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS_POST_SEND, $id);
        $body = [
            "message_url" => $message_url
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function cancel(Request $request ){
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CANCEL_SUBMIT_ADMIN_SEND_MESSAGE, $id);
        $body = null;
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function changeStatus(Request $request ){
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS_CHANGE_STATUS, $id);
        $body = null;
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function dataMemberShip(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = '/restaurant-membership-cards';
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $list_member = '';
            foreach ($config['data'] as $db) {
                $list_member .= '<option value="'. $db['id'] .'">'. $db['name'] .'</option>';
            }
            return [$list_member, $config];
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
