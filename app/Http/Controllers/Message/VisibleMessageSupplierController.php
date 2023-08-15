<?php

namespace App\Http\Controllers\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class VisibleMessageSupplierController extends Controller
{
    public function dataConversation(Request $request)
    {
        $keyword = $request->get('keyword');
        $page = $request->get('page');
        $limit = Config::get('constants.type.default.LIMIT_20');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MESSAGE_SUPPLIER_GET_CONVERSATION, $page, $limit, $keyword);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $conversation = '';
            if($config['data']['total_records'] ===0){
                $conversation = '<img class="conversation-supplier-empty" src="\images\message\empty-message.png">';
            }
            $timeX = microtime(true);
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $numberMessage = 0;
            $countNumberMessageNotSeen = 0;
            foreach ($config['data']['list'] as $db) {
                $numberMessage += $db['member']['number'];
                $time = $this->formatFromTimeTemplate($db['create_time_mess_no_send']);
                if ($db['member']['number'] === 0) {
                    $countMessageNotSeen = '<div class="notifycation d-none pl-0 pr-0"></div>';
                } else if ($db['member']['number'] < 100) {
                    $countMessageNotSeen = '<div class="notifycation pl-0 pr-0"> <span>' . $db['member']['number'] . '</span> </div>';
                } else {
                    $countMessageNotSeen = '<div class="notifycation pl-0 pr-0"> <span>99</span> </div>';
                }
                if ($db['last_message'] !== '') {
//                    foreach ($db['list_tag_name'] as $tagName) {
//                        $db['last_message'] = str_replace($tagName['key_tag_name'], '<span class="tag-name">@' . $tagName['full_name'] . '</span>', $db['last_message']);
//                    }
                } else {
                    $db['last_message'] = 'Chưa có tin nhắn nào';
                }
                $conversation .= '<li class="item-conversation-visible-message box-user" data-id="' . $db['_id'] . '" data-type="' . $db['conversation_type'] . '" data-role-name = "' . $db['member']['role_name'] . '" data-supplier="' . $db['supplier_id'] . '">
                                        <div class="user_chat">
                                           <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $domain . $db['avatar_supplier'] . '" data-src="' . $db['avatar_supplier'] . '"  alt="" class="img_userchat">
                                            <div class="content">
                                                   <h9 class="name pl-0 pr-0">' . $db['supplier_name'] . '</h9>
                                                   <div class="Message-preview-and-category-tags">
                                                   ' . $this->getTypeLastMessage($db) . '
                                            </div>
                                        </div>
                                        <div class="option">
                                            <span class="time-last-message-conversation set-interval-message" data-time="'. $time .'">' . $time . '</span>
                                            <div>
                                                 ' . $countMessageNotSeen . '
                                            </div>
                                        </div>
                                    </div>
                                </li>';
            }
            if($numberMessage == 0) {
                $countNumberMessageNotSeen = '<div class="notifycation-nav d-none"></div>';
            } else if($numberMessage < 100) {
                $countNumberMessageNotSeen = '<div class="notifycation-nav"> <span>' . $numberMessage . '</span> </div>';
            } else {
                $countNumberMessageNotSeen = '<div class="notifycation-nav"> <span>99</span> </div>';
            }
            $config['time_X'] = microtime(true) - $timeX;
            return [$conversation, $config, $countNumberMessageNotSeen];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataOrder(Request $request)
    {
        $is_return_all_total_material = Config::get('constants.type.checkbox.DIS_SELECTED');
        $branch = $request->get('branch');
        $supplier = $request->get('id');
        $time = Config::get('constants.type.data.NONE');
        $page = $request->get('page');
        $limit = $request->get('limit');
        $key = $request->get('key');
        $status = '1,2,3,4,6,7';
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_LIST_ORDER_SUPPLIER, $branch, $supplier, $status, $time, $page, $limit, $is_return_all_total_material, $key);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if((int)$page === 1 && count($config['data']['list']) === 0) {
            $dataOrder = '<div id="div-empty-conversation" style="height: 100%; width: 100%; margin-top: 20%">
                                    <div class="text-center">
                                        <img src="/images/message/search_empty.png" style="width: 160px;">
                                        <div class="text-center">
                                           <div>Không tìm thấy kết quả</div>
                                           <div>Vui lòng thử lại từ khóa khác!</div>
                                        </div>
                                    </div>
                                 </div>';
        }
        else {
            $dataOrder = '';
            foreach ($config['data']['list'] as $db) {
                switch ($db['status']) {
                    case Config::get('constants.type.OrderSupplierStatusEnum.WAITING_RESTAURANT_CONFIRM'):
                        $status = '<label class="label label-warning" style="padding: 5px;margin: 0;position: absolute;width: max-content;bottom: 19px;left: 22px;">' . TEXT_WAITING_RESTAURANT_CONFIRM . '</label>';
                        break;
                    case Config::get('constants.type.OrderSupplierStatusEnum.WAITING_DELIVERY'):
                        $status = '<label class="label label-warning" style="padding: 5px;margin: 0;position: absolute;width: max-content;bottom: 19px;left: 22px;">' . TEXT_WAITING_DELIVERY . '</label>';
                        break;
                    case Config::get('constants.type.OrderSupplierStatusEnum.DELIVERING'):
                        $status = '<label class="label label-primary" style="padding: 5px;margin: 0;position: absolute;width: max-content;bottom: 19px;left: 18px;">' . TEXT_DELIVERY . '</label>';
                        break;
                    case Config::get('constants.type.OrderSupplierStatusEnum.COMPLETED'):
                        $status = '<label class="label label-success" style="padding: 5px;margin: 0;position: absolute;width: max-content;bottom: 19px;left: 22px;">' . TEXT_DONE . '</label>';
                        break;
                    case Config::get('constants.type.OrderSupplierStatusEnum.CANCELED'):
                        $status = '<label class="label label-danger" style="padding: 5px;margin: 0;position: absolute;width: max-content;bottom: 19px;left: 27px;">' . TEXT_CANCELED . '</label>';
                        break;
                    case Config::get('constants.type.OrderSupplierStatusEnum.RETURN_TO_SUPPLIER'):
                        $status = '<label class="label label-warning" style="padding: 5px;margin: 0;position: absolute;width: max-content;bottom: 19px;left: 22px;">' . TEXT_RETURN_TO_SUPPLIER . '</label>';
                        break;
                    case Config::get('constants.type.OrderSupplierStatusEnum.CONFIRM_RETURN'):
                        $status = '<label class="label label-inverse" style="padding: 5px;margin: 0;position: absolute;width: max-content;bottom: 19px;left: 22px;">' . TEXT_CONFIRM_RETURN . '</label>';
                        break;
                    default:
                        $status = '';
                }
                $dataOrder .= '<div class="card-information-order-restaurant-supplier-message">
                                <div class="css-translateX-card-order"></div>
                                <div class="left-information-order">
                                    <i class="feather icon-shopping-cart" style="font-size: 33px;"></i>
                                    ' . $status . '
                                </div>
                                <div class="line-up-one"></div>
                                <div class="right-information-order">
                                    <div class="content-infor">
                                        <div class="d-flex detail-information-card">
                                            <i>MÃ: </i><p class="">' . $db['code'] . '</p>
                                        </div>
                                        <div class="d-flex detail-information-card">
                                            <i>GIÁ: </i><p class="">' . $this->numberFormat($db['total_amount_reality']) . 'đ</p>
                                        </div>
                                        <div class="d-flex detail-information-card">
                                            <i>NGÀY: </i><p class="">' . $db['created_at'] . '</p>
                                        </div>
                                    </div>
                                    <div class="line-card-order-footer">
                                        <button class="buttun-action-card-order action-send-card-order-message btn btn-grd-success waves-effect waves-light" data-id="' . $db['id'] . '" data-code="' . $db['code'] . '" data-time="' . $db['created_at'] . '" data-amount="' . $db['total_amount_reality'] . '" data-status="' . $db['status'] . '">Gửi đơn</button>
                                        <button class="buttun-action-card-order btn btn-grd-primary waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $db['id'] . ')">Chi tiết</button>
                                    </div>
                                </div>
                            </div>';
            }
        };
        return [$dataOrder, $config];
    }

    public function getTypeLastMessage($data)
    {
        $user = Session::get(SESSION_JAVA_ACCOUNT);
        $sender = "";
        if($user['id'] == $data['user_last_message_id']) {
            $sender = '<div class="">Bạn</div>';
        } else {
            $sender = '<div class="">'.$data['user_name_last_message'].'</div>';
        }
        switch ($data['last_message_type']) {
            case 1:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess">' . $data['last_message'] . '</p></div>';
            case 2:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess"><i class="fa fa-image"></i>Hình ảnh</p></div>';
            case 3:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess"><i class="fa fa-file"></i>Tệp đính kèm</p></div>';
            case 4:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess"><i class="ti-themify-favicon"></i>Sticker</p></div>';
            case 5:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess"><i class="fa fa-video-camera"></i>Video</p></div>';
            case 6:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess"><i class="fa fa-microphone"></i>Âm thanh</p></div>';
            case 9:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess"></i>Đã thu hồi tin nhắn</p></div>';
            case 10:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess"></i>Type 10</p></div>';
            case 11:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess"></i>Type 11</p></div>';
            case 13:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess"><i class="icofont icofont-tack-pin"></i>Đã ghim tin nhắn</p></div>';
            case 14:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess">Đã đổi tên nhóm</p></div>';
            case 15:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess">Đã đổi ảnh nhóm</p></div>';
            case 17:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess">' . $data['last_message'] . '</p></div>';
            case 27:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess"><i class="fa fa-signal"></i>Tạo bình chọn mới</p></div>';
            case 28:
                return '<div class="sender-last-message"><span>' . $sender . '</span>: <p class="info-mess"><i class="fa fa-signal"></i>' . $data['last_message'] . '</p></div>';
            default:
                return '<p class="info-mess">' . $data['last_message'] . '</p>';
        }
    }
}
