<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class VisibleMessageController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Tin nhắn';
        return view('message.visible_ver2.index', compact('active_nav'));
    }

    public function dataConversation(Request $request)
    {
        $type = ($request->get('type'));
        $page = $request->get('page');
        $limit = Config::get('constants.type.default.LIMIT_20');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MESSAGE_TMS_GET_CONVERSATION, $page, $limit, $type);
        $body = null;
        $config = $this->callApiGatewayTemplateChat($project, $method, $api, $body);
        try {
            if ((int)$page === 1 && count($config['data']) === 0) {
                $conversation = '<div id="div-empty-conversation" style="height: 295px; width: 100%; margin-top: 20%">
                                    <div class="text-center">
                                        <img src="/images/message/conversation_empty.png" style="width: 160px;">
                                        <div class="text-center">
                                           <div>Chưa có cuộc trò chuyện</div>
                                        </div>
                                        <button class="btn btn-grd-primary" id="open-form-new-conversation" style="margin-top: 10px;">Thêm trò chuyện</button>
                                    </div>
                                 </div>';
            } else {
                $conversation = '';
                $numberMessageNotSeen = 0;
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                foreach ($config['data'] as $db) {
                    $user = Session::get(SESSION_JAVA_ACCOUNT);
                    // dd($user);
                    // if ($user['id'] == $db['last_message']['user_id']) {
                    //     $sender = "Bạn";
                    // } else {
                    //     $sender = $db['last_message']['user_name'];
                    // }
                    $sender = "Hoà";
                    $time = $this->formatFromTimeTemplateChat($db['last_activity']);
                    $notify = ($db['is_notify'] === 1) ? '<i class="fa fa-bell-slash bell-icon" style="display: inline-block"></i>' : '';
                    $pinned = ($db['is_pinned'] === 1) ? '<i class="fi-rr-thumbtack bell-icon" style="display: inline-block"></i>' : '';
                    // if ($db['no_of_not_seen'] === 0) {
                    //     $countMessageNotSeen = '<div class="notifycation d-none pl-0 pr-0"></div>';
                    // } else if ($db['no_of_not_seen']  < 100) {
                    //     $countMessageNotSeen = '<div class="notifycation pl-0 pr-0"> <span>' . $db['no_of_not_seen'] . '</span> </div>';
                    //     $numberMessageNotSeen++;
                    // } else {
                    //     $countMessageNotSeen = '<div class="notifycation pl-0 pr-0"> <span>99</span> </div>';
                    //     $numberMessageNotSeen++;
                    // }
                    $avatar = $db['avatar']['original']['url'];
                    if ($db['name'] == '') $name = "hardcode";
                    else $name = $db['name'];
                    switch ($db['object_type']) {
                        case Config::get('constants.type.ConversationTMSTypeEnum.PERSONAL'):
                            $tag = '<i class="zmdi zmdi-label-alt tag-greens"></i>';
                            break;
                        case Config::get('constants.type.ConversationTMSTypeEnum.GROUP'):
                            $tag = '<i class="zmdi zmdi-label-alt tag-friend"></i>';
                            break;
                        case Config::get('constants.type.ConversationTMSTypeEnum.WORK'):
                            $tag = '<i class="zmdi zmdi-label-alt tag-orange"></i>';
                            break;
                        default:
                            $tag = '';
                    }
                    if ($db['last_message']['user_id'] != 0) {
                        $last_message = ' <div class="sender-last-message"><span>' . $sender . '</span>: ' . $this->getTypeLastMessage($db) . '</div>';
                    } else {
                        $last_message = ' <div class="sender-last-message"><span></span> ' . $this->getTypeLastMessage($db) . '</div>';
                    }

                    //                    foreach ($db['list_tag_name'] as $tagName) {
                    //                        $db['last_message'] = str_replace($tagName['key_tag_name'], '<span class="tag-name">@' . $tagName['full_name'] . '</span>', $db['last_message']);
                    //                    }
                    $conversation .= '<li class="item-conversation-visible-message box-user" data-id="' . $db['conversation_id'] . '" data-type="' . $db['object_type'] . '" data-no-of-member="' . $db['no_of_member'] . '">
                                        <div class="user_chat">
                                            <div class="user_chat_avatar">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $domain . $avatar . '" data-src="' . $domain . $avatar . '" alt="" class="img_userchat">
                                            </div>
                                            <div class="content">
                                                <h9 class="name pl-0 pr-0">' . $name . '</h9>
                                                <div class="Message-preview-and-category-tags">
                                                    ' . $tag . '
                                                    ' . $last_message . '
                                                </div>
                                            </div>
                                            <div class="option">
                                                <span class="time-last-message-conversation set-interval-message" data-time="' . $db['last_activity'] . '">' . $time . '</span>
                                                <div>
                                                    ' . $notify . $pinned . '
                                                </div>
                                            </div>
                                        </div>
                                    </li> ';
                }
            }
            // if ($numberMessageNotSeen === 0) {
            //     $countNumberMessageNotSeen = '<div class="notifycation-nav d-none"></div>';
            // } else if ($numberMessageNotSeen < 100) {
            //     $countNumberMessageNotSeen = '<div class="notifycation-nav"><span>' . $numberMessageNotSeen . '</span></div>';
            // } else {
            //     $countNumberMessageNotSeen = '<div class="notifycation-nav"><span>99</span></div>';
            // }
            return [$conversation, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($e, $config);
        }
    }

    public function listMember(Request $request)
    {
        $id = ($request->get('id'));
        $page = $request->get('page');
        $limit = Config::get('constants.type.default.LIMIT_20');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MESSAGE_TMS_GET_LIST_MEMBER, $id, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplateChat($project, $method, $api, $body);
        try {
            $dataEmployee = "";
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            foreach ($config['data'] as $db) {
                $dataEmployee .= '<div class="col-3 owl-item" data-id="' . $db['user_id'] . '" data-role="' . $db['role']['role_id'] . '">
                                    <div>
                                        <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $domain . $db['avatar'] . '" alt="" loading="lazy">
                                        <div class="sugtd-frnd-meta">
                                            <a href="javascript:void(0)">' . $db['name'] . '</a>
                                            <span>' . $db['role']['role_id'] . '</span>
                                            <ul class="add-remove-frnd">
                                                <li class="add-tofrndlist">
                                                    <a class="send-mesg create-two-personal-conversations" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="Nhắn tin" data-member-id="' . $db['user_id'] . '" data-avatar="' . $db['avatar'] . '" data-name="' . $db['name'] . '" data-role="' . $db['role']['role_id'] . '" data-role-name="' . $db['role']['name'] . '">
                                                        <i class="fa fa-commenting"></i>
                                                    </a>
                                                </li>
                                                <li class="remove-frnd">
                                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailEmployeeManage(' . $db['user_id'] . ')">
                                                       <i class="icofont icofont-eye-alt"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>';
            }
            return [$dataEmployee];
        } catch (Exception $e) {
            return $this->catchTemplate($e, $config);
        }
    }

    public function dataMessageOfConversation(Request $request)
    {
        $timeX = microtime(true);
        $id = $request->get('id');
        $page = $request->get('page');
        $type = $request->get('type');
        $idReply = $request->get('id_reply');
        $from = $request->get('from');
        $to = $request->get('to');
        /**
         * Limit cố định, không thay đổi
         */
        $limit = Config::get('constants.type.default.LIMIT_20');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = ((int)$type === 3) ? sprintf(API_MESSAGE_SUPPLIER_GET_MESSAGE, $id, $page, $limit) : sprintf(API_MESSAGE_TMS_GET_MESSAGE_PAGINATION, $id, $limit, $idReply, $from, $to, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $dataMessage = "";
        return [$dataMessage, $config];
        try {
            $pin = '';
            if ((int)$type !== 2) {
                $pin = '<li class="chat-body-message-item-action-item item-action-pin">
                            <i class="chat-body-message-item-action-icon ion-pin"></i>
                       </li>';
            }
            $dataMessage = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $user = Session::get(SESSION_JAVA_ACCOUNT);
            foreach ($config['data']['list'] as $key => $db) {
                if ((int)$page === 1 && $key === 0 && $db['sender']['member_id'] === $user['id'] && (int)$type !== 2) {
                    $dataMessage .= '<div class="user-seen-message">
                                <div class="users-thumb-list">';
                    foreach ($db['message_viewed'] as $vw) {
                        $dataMessage .= '<a data-toggle="tooltip" data-original-title="' . $vw['full_name'] . '">
                                      <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" alt="" src="' . $domain . $vw['avatar'] . '">
                                  </a>';
                    }
                    $dataMessage .= '</div></div>';
                }
                try {
                    switch ($db['message_type']) {
                        case Config::get('constants.type.MessageTypeEnum.TEXT'):
                            $db['message'] = nl2br($db['message']);
                            foreach ($db['list_tag_name'] as $tag) {
                                $db['message'] = str_replace($tag['key_tag_name'], '<span data-id="' . $tag['member_id'] . '" data-role="" data-role-name="" onclick="createConversationFromTagVisibleMessage($(this))">@' . $tag['full_name'] . '</span>', $db['message']);
                            }
                            $db['message'] = $this->convertMessageLink($db['message'], $db['message_link']);
                            $bodyMessage = '<div class="chat-body-message-text">' . $db['message'] . '</div>';
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.IMAGE'):
                            $bodyMessage = $this->countImage($db, $domain);
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.FILE'):
                            $iconFile = $this->convertImageFile($db['files'][0]['name_file']);
                            $sizeFile = $this->formatSizeUnits($db['files'][0]['size']);
                            $bodyMessage = '<div class="chat-body-message-file">
                                            <a href="' . $domain . $db['files'][0]['link_original'] . '" download>
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" class="chat-message-file-icon-image" src="' . $iconFile . '" loading="lazy" data-link_original="${data.files[0].link_original}"/>
                                            </a>
                                            <div class="chat-message-file-content">
                                             <div class="chat-message-file-action">
                                                <span class="chat-message-file-name">' . $db['files'][0]['name_file'] . '</span>
                                                 <span class="chat-message-file-size-body">' . $sizeFile . '</span>
                                              </div>
                                               <div class="see-item-image-video-grid-download btn-download-file-upload d-flex">
                                                  <i class="fa fa-download" data-download="' . $domain . $db['files'][0]['link_original'] . '" data-name-file="' . $db['files'][0]['name_file'] . '"></i>
                                               </div>
                                            </div>
                                        </div>';
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.STICKER'):
                            $bodyMessage = '<div class="chat-body-message-sticker">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $domain . $db['message'] . '" alt="Sticker">
                                        </div>';
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.VIDEO'):
                            $image = ($db['files'][0]['link_thumb'] === "") ? '/images/message/default.png' : $domain . $db['files'][0]['link_thumb'];
                            $bodyMessage = '<div class="chat-body-message-video">
                                            <div class="chat-message-video-content">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $image . '" data-video="' . $domain . $db['files'][0]['link_original'] . '" loading="lazy">
                                                <video class="video-after-img d-none" controls>
                                                    <source src="' . $domain . $db['files'][0]['link_original'] . '"/>
                                                </video>
                                                <i class="play-video-to-link-btn" onclick="viewVideo($(this))">
                                                    <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" height="50px" width="50px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" fill="#000" xml:space="preserve">
                                                        <path class="stroke-solid" fill="none" stroke=""
                                                                d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                                                                                        C97.3,23.7,75.7,2.3,49.9,2.5"/>
                                                        <path class="icon" fill="#fff" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z" />
                                                    </svg>
                                                </i>
                                            </div>
                                        </div>';
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.AUDIO'):
                            $secondSize = ((int)($db['files'][0]['size']) + 1000) / 1000;
                            $minute = floor($secondSize / 60);
                            $second = floor($secondSize - $minute * 60);
                            if ($minute < 10) $minute = '0' . $minute;
                            if ($second < 10) $second = '0' . $second;
                            $bodyMessage = '<div class="chat-body-message-audio">
                                                <div class="chat-audio-header d-flex align-items-center">
                                                    <a title="Play" class="sound-container-play" data-audio="' . $domain . $db['files'][0]['link_original'] . '">
                                                        <i class="fa fa-play-circle play-audio-btn"></i>
                                                        <i class="fa fa-pause stop-audio-btn d-none"></i>
                                                    </a>
                                                    <div class="chat-audio-name" data-duration="' . ($db['files'][0]['size']) . '">' . $db['files'][0]['name_file'] . '</div>
                                                    <div class="see-item-image-video-grid-download audio btn-download-file-upload">
                                                        <i class="fa fa-download" data-download="' . $domain . $db['files'][0]['link_original'] . '" data-name-file="' . $db['files'][0]['name_file'] . '"></i>
                                                    </div>
                                                </div>
                                                <div class="play-audio-body-message">
                                                    <div class="sound-container-time sound-duration-time">00:00</div>
                                                    <div class="progress">
                                                        <div class="currentValue" style="width: 0%;">
                                                            <div class="media-fixed-progress-bar-dot"></div>
                                                        </div>
                                                        <input type="range" min="0" max="100" value="0" id="progress" class="progress-bar-audio"/>
                                                    </div>
                                                    <div class="sound-resutl-time">' . $minute . ':' . $second . '</div>
                                                </div>
                                            </div>';
                            //                            <i class="icon-dowload-about-visible-message fa fa-download download-audio" data-toggle="tooltip" data-placement="top" data-original-title="Tải xuống">
                            //                                                    <a href="' . $domain . $db['files'][0]['link_original'] . '}" download>
                            //                                                </i>
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.REPLY'):
                            foreach ($db['list_tag_name'] as $tag) {
                                $db['message'] = str_replace($tag['key_tag_name'], '<span data-id="' . $tag['member_id'] . '" data-role="" data-role-name="" onclick="createConversationFromTagVisibleMessage($(this))">@' . $tag['full_name'] . '</span>', $db['message']);
                            }
                            $db['message'] = $this->convertMessageLink($db['message'], $db['message_link']);
                            switch ($db['message_reply']['message_type']) {
                                case Config::get('constants.type.MessageTypeEnum.IMAGE'):
                                    $class = '';
                                    $img = $domain . $db['message_reply']['files'][0]['link_thumb'];
                                    $text = '[Đã gửi ' . count($db['message_reply']['files']) . ' hình ảnh]';
                                    $bodyMessage = $this->replyMessageLayout($db, $text, $img, $class);
                                    break;
                                case Config::get('constants.type.MessageTypeEnum.VIDEO'):
                                    $class = '';
                                    $img = $domain . $db['message_reply']['files'][0]['link_thumb'];
                                    $text = '[Đã gửi Video]';
                                    $bodyMessage = $this->replyMessageLayout($db, $text, $img, $class);
                                    break;
                                case Config::get('constants.type.MessageTypeEnum.FILE'):
                                    $class = '';
                                    $img = $this->convertImageFile($db['message_reply']['files'][0]['name_file']);
                                    $text = '[Đã gửi File]';
                                    $bodyMessage = $this->replyMessageLayout($db, $text, $img, $class);
                                    break;
                                case Config::get('constants.type.MessageTypeEnum.STICKER'):
                                    $class = '';
                                    $img = $domain . $db['message_reply']['message'];
                                    $text = '[Đã gửi Sticker]';
                                    $bodyMessage = $this->replyMessageLayout($db, $text, $img, $class);
                                    break;
                                case Config::get('constants.type.MessageTypeEnum.AUDIO'):
                                    $class = '';
                                    $img = '/images/tms/audio.png';
                                    $text = '[Đã gửi Ghi âm]';
                                    $bodyMessage = $this->replyMessageLayout($db, $text, $img, $class);
                                    break;
                                case Config::get('constants.type.MessageTypeEnum.LINK'):
                                    $class = '';
                                    $img = $db['message_reply']['message_link']['media_thumb'];
                                    $text = '<div class="reply-body-message-link">' . $db['message_reply']['message'] . '</div>';
                                    $bodyMessage = $this->replyMessageLayout($db, $text, $img, $class);
                                    break;
                                default:
                                    $text = $db['message_reply']['message'];
                                    foreach ($db['message_reply']['list_tag_name'] as $tag) {
                                        $text = str_replace($tag['key_tag_name'], '<span data-id="' . $tag['member_id'] . '" data-role="" data-role-name="" onclick="createConversationFromTagVisibleMessage($(this))">@' . $tag['full_name'] . '</span>', $db['message_reply']['message']);
                                    }
                                    $class = 'd-none';
                                    $img = '';
                                    $bodyMessage = $this->replyMessageLayout($db, $text, $img, $class);
                                    break;
                            }
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.LINK'):
                            foreach ($db['list_tag_name'] as $tag) {
                                $db['message'] = str_replace($tag['key_tag_name'], '<span data-id="' . $tag['member_id'] . '" data-role="" data-role-name="" onclick="createConversationFromTagVisibleMessage($(this))">@' . $tag['full_name'] . '</span>', $db['message']);
                            }
                            $db['message'] = $this->convertMessageLink($db['message'], $db['list_link']);
                            if ($db['message_link']['title'] === "") {
                                $bodyMessage = '<div class="chat-body-message-text">' . $db['message'] . '</div>';
                            } else {
                                if (strpos($db['message_link']['cannonical_url'], 'youtube.com') || strpos($db['message_link']['cannonical_url'], 'youtu.be')) {
                                    $convertedURL = str_replace("watch?v=", "embed/", $db['message_link']['cannonical_url']);
                                    $convertedURL = str_replace("youtu.be", "www.youtube.com/embed/", $convertedURL);
                                    $link = explode('=', $convertedURL);
                                    $link = str_replace("&list", "", $link[0]);
                                    $bodyMessage = '<div class="chat-body-message-text-link">' . $db['message'] . '</div>
                                            <div class="chat-message-link-thumbnail">
                                                <iframe type="text/html" width="100%" loading="lazy" height="100%" src="' . $link . '" frameborder="0" allowfullscreen> </iframe>
                                            </div>';
                                } else {
                                    $linkPreview = str_replace('https://', '', $db['message_link']['cannonical_url']);
                                    $linkPreview = str_replace('http://', '', $linkPreview);
                                    $domainLinkPreview = explode('/', $linkPreview)[0];
                                    $bodyMessage = '<div class="chat-body-message-text link-title">' . $db['message'] . '</div>
                                                <div class="chat-message-link-text">
                                                    <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="img-preview-body-chat" src="' . $db['message_link']['media_thumb'] . '" loading="lazy"/>
                                                    <div class="">
                                                        <div class="preview-lin-visible-message">
                                                            <a class="chat-message-link-info-title-link" style="font-size: 15px !important;" target="_blank" href="' . $db['message_link']['cannonical_url'] . '"> ' . $db['message_link']['title'] . ' </a>
                                                            <a target="_blank" href="' . $db['message_link']['cannonical_url'] . '" class="chat-message-link-info-title-link-preview"> ' . $domainLinkPreview . ' </a>
                                                        </div>
                                                    </div>
                                                </div>
                                          ';
                                }
                            }
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.REVOKE'):
                            $bodyMessage = '<div class="chat-body-message-revoke">Tin nhắn đã thu hồi</div>';
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.REVOKE_PINNED'):
                            $userLastMessage = ($db['sender']['member_id'] === $user['id']) ? '<span class="event-message-content-name showmore underline">Bạn</span>' : '<span class="text-report-body-visible-message showmore-you underline-you"> ' . $db['sender']['full_name'] . '</span>';
                            $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="chat-body-message-item-pin-img" src="' . $domain . $db['sender']['avatar'] . '" alt="" />
                                        <div class="notify-message-block">
                                            <span class="notify-message-username">' . $userLastMessage . '</span>
                                            <span class="notify-message-text">đã bỏ ghim tin nhắn</span>
                                            <i class="event-message-content-info-icon icofont icofont-ban"></i>
                                        </div>';
                            $dataMessage .= $this->notificationLayoutMessage($bodyMessage, $db);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.PINNED'):
                            $userLastMessage = ($db['sender']['member_id'] === $user['id']) ? '<span class="event-message-content-name showmore underline">Bạn</span>' : '<span class="text-report-body-visible-message showmore-you underline-you"> ' . $db['sender']['full_name'] . '</span>';
                            $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="chat-body-message-item-pin-img" src="' . $domain . $db['sender']['avatar'] . '" alt="" />
                                        <div class="notify-message-block">
                                           <span class="notify-message-username showmore underline">' . $userLastMessage . '</span>
                                           <span class="notify-message-text">đã ghim tin nhắn</span>
                                           <i class="event-message-content-info-icon typcn typcn-pin"></i>
                                        </div>';
                            $dataMessage .= $this->notificationLayoutMessage($bodyMessage, $db);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.UPDATE_NAME'):
                            $userLastMessage = ($db['sender']['member_id'] === $user['id']) ? '<span class="event-message-content-name showmore underline">Bạn</span>' : '<span class="text-report-body-visible-message showmore-you underline-you"> ' . $db['sender']['full_name'] . '</span>';
                            $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="chat-body-message-item-pin-img" src="' . $domain . $db['sender']['avatar'] . '" alt="" />
                                        <div class="notify-message-block"">
                                            <span class=""> ' . $userLastMessage . '  đã đổi tên nhóm thành</span>
                                            <span class="event-vote-message-content-name "> ' . $db['name'] . '</span>
                                        </div>';
                            $dataMessage .= $this->notificationLayoutMessage($bodyMessage, $db);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.UPDATE_AVATAR'):
                            $userLastMessage = ($db['sender']['member_id'] === $user['id']) ? '<span class="event-message-content-name showmore underline">Bạn</span>' : '<span class="text-report-body-visible-message showmore-you underline-you"> ' . $db['sender']['full_name'] . '</span>';
                            $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="chat-body-message-item-pin-img" src="' . $domain . $db['sender']['avatar'] . '" alt="" />
                                        <div class="notify-message-block"">
                                            <span class=""> ' . $userLastMessage . '  đã đổi ảnh đại diện nhóm </span>
                                            <i class="event-message-content-info-icon fa fa-image"></i>
                                        </div>';
                            $dataMessage .= $this->notificationLayoutMessage($bodyMessage, $db);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.ADD_USER'):
                            $addUser = ($db['list_member'][0]['member_id'] === $user['id']) ? 'Bạn' : $db['list_member'][0]['full_name'];
                            $reviewUserAdd = (count($db['list_member']) === 1) ? ('<span class="event-message-content-name-show showmore-you underline-you text-report-body-visible-message">' . $addUser . '</span>') : ('<span class="event-message-content-name-show showmore-you underline-you text-report-body-visible-message">' . $addUser . '</span> <span> và ' . count($db['list_member']) . ' người nữa </span>');
                            $userLastMessage = ($db['sender']['member_id'] === $user['id']) ? '<span class="event-message-content-name showmore underline d-flex">Bạn</span>' : '<span class="text-report-body-visible-message showmore-you underline-you d-flex"> ' . $db['sender']['full_name'] . '</span>';
                            $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="" src="' . $domain . $db['list_member'][0]['avatar'] . '" alt="" loading="lazy">
                                        <div class="notify-message-block">
                                        <span class="notify-message-username">' . $reviewUserAdd . '</span>
                                        <span class="notify-message-text">được</span>
                                        <span class="notify-message-username ">' . $userLastMessage . '</span>
                                        <span class="notify-message-text"> thêm vào nhóm</span></div>';
                            $dataMessage .= $this->notificationLayoutMessage($bodyMessage, $db);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.REMOVE_USER'):
                            $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="" src="' . $domain . $db['list_member'][0]['avatar'] . '" alt="" loading="lazy">
                                        <div class="notify-message-block">
                                        <span class="notify-message-username "><span class="event-message-content-name-show text-report-body-visible-message showmore-you underline-you">' . $db['list_member'][0]['full_name'] . '</span></span>
                                        <span class="notify-message-text">đã bị mời rời khỏi nhóm</span></div>';
                            $dataMessage .= $this->notificationLayoutMessage($bodyMessage, $db);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.LEAVE_GROUP'):
                            $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="" src="' . $domain . $db['sender']['avatar'] . '" alt="" loading="lazy">
                                        <span class="notify-message-username text-report-body-visible-message showmore-you underline-you">' . $db['list_member'][0]['full_name'] . '</span>
                                        <span class="notify-message-text">đã rời khỏi nhóm</span>';
                            $dataMessage .= $this->notificationLayoutMessage($bodyMessage, $db);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.MESSAGE_VOTE'):
                            if (mb_strlen($db['message_vote']['title']) > 50) $db['message_vote']['title'] = mb_substr($db['message_vote']['title'], 0, 47) . '...<i class="f-16 fa fa-comment-o text-inverse"></i>';
                            $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="" src="' . $domain . $db['sender']['avatar'] . '" alt="" loading="lazy">
                                        <span class="notify-message-username text-report-body-visible-message showmore-you underline-you">' . $db['sender']['full_name'] . '</span>
                                        <span class="notify-message-text">' . $db['message'] . '</span>
                                        <span class="event-vote-message-content-name" onclick="openModalDetailVoteVisibleMessage(' . $db['random_key_message_vote'] . ')">' . $db['message_vote']['title'] . '</span>';
                            $dataMessage .= $this->notificationLayoutMessage($bodyMessage, $db);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.AUTHORIZE_MEMBER'):
                            $bodyMessage = '<span class="notify-message-text">' . $db['message'] . '</span></div>';
                            $dataMessage .= $this->notificationLayoutMessage($bodyMessage, $db);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.VOTE'):
                            $classTextVote = 'd-none';
                            $textVote = '';
                            if (count($db['message_vote']['list_option']) > 3) {
                                $classTextVote = '';
                                $textVote = '* Còn ' . (count($db['message_vote']['list_option']) - 3) . ' lựa chọn khác';
                            }
                            $db['message_vote']['list_option'] = collect($db['message_vote']['list_option'])->where('id', '!==', -1)->values()->toArray();
                            $bodyMessage = '<div class="title-message-vote">' . $db['message_vote']['title'] . '</div>
                                        <div class="member-message-vote"><span>Đã có ' . $db['message_vote']['number_user_vote'] . ' người bình chọn<i class="ion-arrow-right-b"></i></span></div>
                                        <div style="position: relative;">
                                             <div class="item-vote">
                                                  <div class="div-vote" style="width: ' . ($this->rateDefaultTemplate(count($db['message_vote']['list_option'][0]['list_user']), count($db['message_vote']['list_option'][0]['list_user'])) * 100) . '%;"></div>
                                                  <div class="content-vote"><span>' . $db['message_vote']['list_option'][0]['content'] . '</span></div>
                                                  <div class="count-vote">' . count($db['message_vote']['list_option'][0]['list_user']) . '</div>
                                             </div>
                                             <div class="item-vote">
                                                  <div class="div-vote" style="width: ' . ($this->rateDefaultTemplate(count($db['message_vote']['list_option'][1]['list_user']), count($db['message_vote']['list_option'][0]['list_user'])) * 100) . '%;"></div>
                                                  <div class="content-vote"><span>' . $db['message_vote']['list_option'][1]['content'] . '</span></div>
                                                  <div class="count-vote">' . count($db['message_vote']['list_option'][1]['list_user']) . '</div>
                                             </div>
                                        </div>
                                        <span class="other-vote-message-vote ' . $classTextVote . '">' . $textVote . '</span>
                                        <div class="pin-details-content-item-bottom">
                                              <button class="button-message-vote" onclick="openModalDetailVoteVisibleMessage(' . $db['random_key'] . ')">Xem bình chọn</button>
                                        </div>';
                            $dataMessage .= $this->voteLayoutMessage($bodyMessage, $db);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.ORDER'):
                            $bodyMessage = '<div class="card-information-order-restaurant-supplier-message" style="width: 300px;margin: 0;">
                                                    <div class="left-information-order">
                                                        <i class="feather icon-shopping-cart" style="font-size: 33px;"></i>
                                                        <label class="label label-success" style="padding: 5px;margin: 0;position: absolute;width: max-content;bottom: 12px;left: 15px;"> Hoàn tất</label>
                                                    </div>
                                                    <div class="line-up-one"></div>
                                                    <div class="right-information-order">
                                                        <div class="content-infor">
                                                            <div class="detail-cart-message">
                                                                <i class="fa fa-eye"></i>
                                                            </div>
                                                            <div class="d-flex detail-information-card">
                                                                <i>MÃ: </i><p class="">' . $db['message_order']['code'] . '</p>
                                                            </div>
                                                            <div class="d-flex detail-information-card">
                                                                <i>GIÁ: </i><p class="">' . $this->numberFormat($db['message_order']['total']) . 'đ</p>
                                                            </div>
                                                            <div class="d-flex detail-information-card">
                                                                <i>NGÀY: </i><p class="">' . $db['message_order']['order_time_delivery'] . '</p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>';
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.VIDEO_CALL'):
                            $bodyMessage = '<div class="chat-body-message-text" data-type="' . $db['message_type'] . '"><i class="fa fa-video-camera"></i> Cuộc gọi video</div>
                                        <button class="recall-message-button">Gọi lại</button>';
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                            break;
                        case Config::get('constants.type.MessageTypeEnum.PHONE_CALL'):
                            $bodyMessage = '<div class="chat-body-message-text" data-type="' . $db['message_type'] . '"><i class="fa fa-phone"></i> Cuộc gọi thoại</div>
                                        <button class="recall-message-button">Gọi lại</button>';
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                            break;
                        default:
                            $bodyMessage = '<div class="chat-body-message-text text-danger">Tin nhắn không xác định (Type-' . $db['message_type'] . ')</div>';
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                            break;
                    };
                } catch (Exception $e) {
                    $bodyMessage = '<div class="chat-body-message-text text-danger error-message">Tin nhắn bị lỗi</div>';
                    $pin = 'fall-mess';
                    $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key, $pin);
                    $pin = '';
                    if ((int)$type !== 2) {
                        $pin = '<li class="chat-body-message-item-action-item item-action-pin">
                            <i class="chat-body-message-item-action-icon ion-pin"></i>
                       </li>';
                    }
                }

                if ($db['today'] === 1) {
                    $dataMessage .= '<div class="notify-message-container">
                                        <div class="line"></div>
                                        <div class="notify-message-content" style="padding: 0 10px; background-color: #39393966;color: #fff;">
                                            <span class="notify-message-text-date">' . date_format(date_create($db['created_at']), 'H:i d/m/Y') . '</span>
                                        </div>
                                        <div class="line"></div>
                                    </div>';
                }
            }
            $config['time_X'] = microtime(true) - $timeX;
            return [$dataMessage, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function convertMessageLink($message, $link)
    {
        foreach ($link as $l) {
            $message = str_replace($l, '<a class="body-message-link" href="' . $l . '" target="_blank">' . $l . '</a>', $message);
        }
        return $message;
    }

    public function generalLayoutMessage($bodyMessage, $data, $list, $index, $pin)
    {
        $user = Session::get(SESSION_JAVA_ACCOUNT);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $header = '';
        $notify = '';
        $marginItem = '';
        $marginBody = '';
        if ($data['sender']['member_id'] === $user['id']) {
            $class = 'message-right';
            $action = '<li class="chat-body-message-item-action-item item-action-revoke">
                           <i class="chat-body-message-item-action-icon ion-refresh"></i>
                       </li>
                       <li class="chat-body-message-item-action-item item-action-reply">
                            <i class="chat-body-message-item-action-icon ion-quote"></i>
                       </li>' . $pin;
            if ($index + 1 < count($list)) {
                if (($user['id'] === $list[$index + 1]['sender']['member_id']) && in_array($list[$index + 1]['message_type'], [
                    Config::get('constants.type.MessageTypeEnum.TEXT'),
                    Config::get('constants.type.MessageTypeEnum.IMAGE'),
                    Config::get('constants.type.MessageTypeEnum.FILE'),
                    Config::get('constants.type.MessageTypeEnum.STICKER'),
                    Config::get('constants.type.MessageTypeEnum.VIDEO'),
                    Config::get('constants.type.MessageTypeEnum.AUDIO'),
                    Config::get('constants.type.MessageTypeEnum.LINK'),
                    Config::get('constants.type.MessageTypeEnum.REPLY'),
                ])) {
                    $marginItem = 'margin-item';
                }
            }
        } else {
            $class = 'message-left';
            $action = '<li class="chat-body-message-item-action-item item-action-reply">
                            <i class="chat-body-message-item-action-icon ion-quote"></i>
                       </li>' . $pin;
            if ($index + 1 < count($list)) {
                if (($data['sender']['member_id'] !== $list[$index + 1]['sender']['member_id']) || $data['today'] === 1 || !in_array($list[$index + 1]['message_type'], [
                    Config::get('constants.type.MessageTypeEnum.TEXT'),
                    Config::get('constants.type.MessageTypeEnum.IMAGE'),
                    Config::get('constants.type.MessageTypeEnum.FILE'),
                    Config::get('constants.type.MessageTypeEnum.STICKER'),
                    Config::get('constants.type.MessageTypeEnum.VIDEO'),
                    Config::get('constants.type.MessageTypeEnum.AUDIO'),
                    Config::get('constants.type.MessageTypeEnum.LINK'),
                    Config::get('constants.type.MessageTypeEnum.REPLY'),
                    Config::get('constants.type.MessageTypeEnum.REVOKE'),
                ])) {
                    $header = '<span class="chat-body-message-element-name-text">' . $data['sender']['full_name'] . '</span>
                                <div class="">
                                    <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" data-name="' . $data['sender']['full_name'] . '" class="chat-body-message-element-avatar profile-user" src="' . $domain . $data['sender']['avatar'] . '"/>
                                </div>';
                } else {
                    $marginBody = 'margin-right-50px';
                    $marginItem = 'margin-item';
                }
            } else {
                $header = '<span class="chat-body-message-element-name-text">' . $data['sender']['full_name'] . '</span>
                           <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" class="chat-body-message-element-avatar" src="' . $domain . $data['sender']['avatar'] . '"/>';
            }
        }
        $footer = '';
        if (!in_array($data['message_type'], [Config::get('constants.type.MessageTypeEnum.REVOKE'), Config::get('constants.type.MessageTypeEnum.VIDEO_CALL'), Config::get('constants.type.MessageTypeEnum.PHONE_CALL')])) {
            if ($pin !== 'fall-mess') {
                $time = $this->returnHourMinuteFromTimeTemplate($data['created_at']);
                $cancelReaction = '';
                $iconReaction = '<i class="chat-body-message-item-reactions-icon fa fa-thumbs-o-up"></i>';
                $myReaction = $data['reactions']['my_reaction'];
                switch ($data['reactions']['my_reaction']) {
                    case 0:
                        $myReaction = 3;
                        $cancelReaction = 'd-none';
                        break;
                    case 1:
                        $iconReaction = '<img class="react-icon m-auto" src="/images/message/love.gif" loading="lazy"/>';
                        break;
                    case 2:
                        $iconReaction = '<img class="react-icon m-auto" src="/images/message/haha.gif" loading="lazy"/>';
                        break;
                    case 3:
                        $iconReaction = '<img class="react-icon m-auto" src="/images/message/like.gif" loading="lazy"/>';
                        break;
                    case 4:
                        $iconReaction = '<img class="react-icon m-auto" src="/images/message/sad.gif" loading="lazy"/>';
                        break;
                    case 5:
                        $iconReaction = '<img class="react-icon m-auto" src="/images/message/angry.gif" loading="lazy"/>';
                        break;
                    case 6:
                        $iconReaction = '<img class="react-icon m-auto" src="/images/message/wow.gif" loading="lazy"/>';
                        break;
                }
                if ($data['reactions']['reactions_count'] > 0) {
                    $dataReaction = [
                        ['item' => $data['reactions']['love'], 'html' => '<img class="react-icon m-auto" src="/images/message/love.gif" loading="lazy"/>'],
                        ['item' => $data['reactions']['smile'], 'html' => '<img class="react-icon m-auto" src="/images/message/haha.gif" loading="lazy"/>'],
                        ['item' => $data['reactions']['like'], 'html' => '<img class="react-icon m-auto" src="/images/message/like.gif" loading="lazy"/>'],
                        ['item' => $data['reactions']['sad'], 'html' => '<img class="react-icon m-auto" src="/images/message/sad.gif" loading="lazy"/>'],
                        ['item' => $data['reactions']['angry'], 'html' => '<img class="react-icon m-auto" src="/images/message/angry.gif" loading="lazy"/>'],
                        ['item' => $data['reactions']['wow'], 'html' => '<img class="react-icon m-auto" src="/images/message/wow.gif" loading="lazy"/>'],
                    ];
                    $dataReaction = collect($dataReaction)->sortByDesc('item')->slice(0, 3)->where('item', '!==', 0)->toArray();
                    $item = '';
                    foreach ($dataReaction as $db) {
                        $item .= $db['html'];
                    }
                    $countReaction = ($data['reactions']['reactions_count'] > 99) ? '99' : $data['reactions']['reactions_count'];
                    $reaction = '<div class="reacts-list">
                               <div class="react-icon-list" data-love="' . $data['reactions']['love'] . '" data-smile="' . $data['reactions']['smile'] . '" data-like="' . $data['reactions']['like'] . '" data-angry="' . $data['reactions']['angry'] . '" data-sad="' . $data['reactions']['sad'] . '" data-wow="' . $data['reactions']['wow'] . '">' . $item . '</div>
                               <div class="total-reacts">' . $countReaction . '</div>
                         </div>';
                } else {
                    $reaction = '<div class="reacts-list d-none">
                               <div class="react-icon-list" data-love="' . $data['reactions']['love'] . '" data-smile="' . $data['reactions']['smile'] . '" data-like="' . $data['reactions']['like'] . '" data-angry="' . $data['reactions']['angry'] . '" data-sad="' . $data['reactions']['sad'] . '" data-wow="' . $data['reactions']['wow'] . '"></div>
                               <div class="total-reacts">0</div>
                         </div>';
                }
                $footer = '<div class="chat-body-message-footer">
                            <ul class="chat-body-message-item-action-list d-none">' . $action . '</ul>
                            <div class="chat-body-message-item-reactions">
                                <div class="chat-body-message-item-reactions-group reactions-group-icon" data-id="' . $myReaction . '">' . $iconReaction . '</div>
                                <div class="emoji-container">
                                    <div class="reactionss-emoji-boder">
                                        <div class="reactionss-emoji-img circle like" data-id="3"></div>
                                    </div>
                                    <div class="reactionss-emoji-boder">
                                        <div class="reactionss-emoji-img circle love" data-id="1"></div>
                                    </div>
                                    <div class="reactionss-emoji-boder">
                                        <div class="reactionss-emoji-img circle haha" data-id="2"></div>
                                    </div>
                                    <div class="reactionss-emoji-boder">
                                        <div class="reactionss-emoji-img circle wow" data-id="6"></div>
                                    </div>
                                    <div class="reactionss-emoji-boder">
                                        <div class="reactionss-emoji-img circle sad" data-id="4"></div>
                                    </div>
                                    <div class="reactionss-emoji-boder">
                                        <div class="reactionss-emoji-img circle angry" data-id="5"></div>
                                    </div>
                                    <i class="reactions-close icofont icofont-close ' . $cancelReaction . '"></i>
                                </div>
                            </div>
                            <div class="chat-body-message-status-send d-none">
                                <i class="chat-body-message-sending-icon fa fa-check-circle-o"></i>
                                <i class="chat-body-message-send-icon fa fa-check-circle d-none"></i>
                            </div>
                            <div class="reacts-list-content">' . $reaction . '</div>
                            <span class="time-message-ago" data-time="' . $data['created_at'] . '">' . $time . '</span>
                        </div>';
            }
        }
        //        if ($data['is_important'] === 1) {
        //            $notify = '<div class="content-notify">
        //                            <i class="fa fa-exclamation"></i> Quan trọng
        //                       </div>';
        //        }
        return '<div class="chat-body-message-element ' . $class . ' ' . $marginItem . '" id="' . $data['random_key'] . '" data-position="1" data-id="' . $data['_id'] . '" data-random-key="' . $data['random_key'] . '" data-type="' . $data['message_type'] . '" data-name="' . $data['sender']['full_name'] . '" data-sender="' . $data['sender']['member_id'] . '" data-avatar="' . $domain . $data['sender']['avatar'] . '" data-time="' . $this->formatFromTimeTemplate($data['created_at']) . '">
                    ' . $header . '
                    <div class="chat-body-message ' . $marginBody . '">
                        ' . $bodyMessage . '
                        ' . $footer . '
                    </div>
                </div>';
    }

    public function countImage($data, $domain)
    {
        try {
            foreach ($data['files'] as $key => $db) {
                if ($db['type'] === 0) $data['files'][$key]['link_original'] = $domain . $db['link_original'];
            }
            switch (count($data['files'])) {
                case 1:
                    return '<div class="chat-body-message-image" data-number-img="' . count($data['files']) . '">
                                <div class="wrapper one-image">
                                    <div class="gallery">
                                        <div class="gallery__item gallery__item--1">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  data-name="" src="' . $data['files'][0]['link_original'] . '" alt="Hình ảnh" class="gallery__image" onerror="this.src=.https://dvdn247.net/wp-content/uploads/2020/07/avatar-mac-dinh-1.png." loading="lazy"/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                           </div>';
                case 2:
                    return '<div class="chat-body-message-image" data-number-img="' . count($data['files']) . '">
                                <div class="wrapper two-image">
                                    <div class="gallery">
                                        <div class="gallery__item gallery__item--1">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][0]['link_original'] . '" class="gallery__image" loading="lazy"/>
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--2">
                                            <a href="javascript:void(0)" class="gallery__link">
                                               <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][1]['link_original'] . '" class="gallery__image" loading="lazy"/>
                                              </a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                case 3:
                    return '<div class="chat-body-message-image" data-number-img="' . count($data['files']) . '">
                                <div class="wrapper three-image">
                                    <div class="gallery">
                                        <div class="gallery__item gallery__item--1">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][0]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--2">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][1]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--3">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][2]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                case 4:
                    return '<div class="chat-body-message-image" data-number-img="' . count($data['files']) . '">
                                <div class="wrapper four-image">
                                    <div class="gallery">
                                        <div class="gallery__item gallery__item--1">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][0]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--2">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][1]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--3">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][2]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--4">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][3]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                case 5:
                    return '<div class="chat-body-message-image" data-number-img="' . count($data['files']) . '">
                                <div class="wrapper five-image">
                                    <div class="gallery">
                                        <div class="gallery__item gallery__item--1">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][0]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--2">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][1]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--3">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][2]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--4">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][3]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--5">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][4]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                default:
                    $item = '';
                    foreach (($data['files']) as $db) {
                        $item .= '<div data-src="' . $db['link_original'] . '"></div>';
                    }
                    return '<div class="chat-body-message-image" data-number-img="' . count($data['files']) . '">
                                <div class="wrapper five-image">
                                    <div class="gallery">
                                        <div class="gallery__item gallery__item--1">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][0]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--2">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][1]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--3">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][2]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--4">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][3]['link_original'] . '" class="gallery__image" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="gallery__item gallery__item--5">
                                            <a href="javascript:void(0)" class="gallery__link">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $data['files'][4]['link_original'] . '" class="gallery__image" loading="lazy" />
                                                <div class="more-photos"><span>+' . (count($data['files']) - 5) . '<span></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-item-image d-none">
                                    ' . $item . '
                                </div>
                            </div>';
            }
        } catch (Exception $e) {
            dd($data, $e);
        }
    }

    function convertImageFile($name)
    {
        if (!$name) return '/images/message/file.png';
        $name = explode('.', $name);
        switch ($name[count($name) - 1]) {
            case 'ai':
                return '/images/message/adobe-illustrator.png';
            case 'apk':
                return '/images/message/apk.png';
            case 'css':
                return '/images/message/css.png';
            case 'disc':
                return '/images/message/disc.png';
            case 'doc':
                return '/images/message/doc.png';
            case 'xls':
            case 'xlsx':
                return '/images/message/excel.png';
            case 'jpeg':
            case 'jpg':
            case 'gif':
            case 'png':
                return '/images/message/image.png';
            case 'iso':
                return '/images/message/iso.png';
            case 'js':
                return '/images/message/js-file.png';
            case 'mp3':
                return '/images/message/music.png';
            case 'pdf':
                return '/images/message/pdf.png';
            case 'php':
                return '/images/message/php.png';
            case 'ppt':
            case 'pptx':
                return '/images/message/ppt.png';
            case 'psd':
                return '/images/message/psd.png';
            case 'sql':
                return '/images/message/sql.png';
            case 'svg':
                return '/images/message/svg.png';
            case 'txt':
                return '/images/message/txt.png';
            case 'mp4':
                return '/images/message/video.png';
            case 'zip':
            case 'rar':
                return '/images/message/zip.png';
            default:
                return '/images/message/file.png';
        }
    }

    function formatSizeUnits($bytes)
    {
        $size = array('B', 'kB', 'MB', 'GB', 'TB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.2f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    public function notificationLayoutMessage($bodyMessage, $data)
    {
        return '<div class="chat-body-message-element notify-message-container" id="' . $data['random_key'] . '" data-position="1" data-id="' . $data['_id'] . '" data-random-key="' . $data['random_key'] . '" data-type="' . $data['message_type'] . '" data-name="' . $data['sender']['full_name'] . '" data-sender="' . $data['sender']['member_id'] . '">
                    <div class="notify-message-content">
                         ' . $bodyMessage . '
                    </div>
                </div>';
    }

    public function voteLayoutMessage($bodyMessage, $data)
    {
        return '<div class="chat-body-message-element notify-message-container" id="' . $data['random_key'] . '" data-position="1" data-id="' . $data['_id'] . '" data-random-key="' . $data['random_key'] . '" data-type="' . $data['message_type'] . '" data-name="' . $data['sender']['full_name'] . '" data-sender="' . $data['sender']['member_id'] . '">
                    <div class="body-message-vote">
                        <div class="div-body-message-vote">
                            ' . $bodyMessage . '
                        </div>
                    </div>
                </div>';
    }

    public function replyMessageLayout($data, $text, $img, $class)
    {
        $imageClass = '';
        foreach ($data['list_tag_name'] as $tag) {
            $data['message'] = str_replace($tag['key_tag_name'], '<span data-id="' . $tag['member_id'] . '" data-role="" data-role-name="" onclick="createConversationFromTagVisibleMessage($(this))">@' . $tag['full_name'] . '</span>', $data['message']);
        }
        if (!$img) {
            $imageClass = 'reply-message-image';
        }
        return '<a class="transition-reply" data-id="' . $data['message_reply']['random_key'] . '">
                        <div class="chat-body-message-item-reply">
                            <div class="chat-body-message-item-reply-image ' . $class . '">
                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="chat-body-message-item-reply-img" src="' . $img . '" alt="" />
                            </div>
                            <div class="chat-body-message-item-reply-info ' . $imageClass . '">
                                <div class="chat-body-message-item-reply-name">
                                ' . $data['message_reply']['sender']['full_name'] . '
                                </div>
                                <div class="chat-body-message-item-reply-type">' . $text . '</div>
                            </div>
                        </div>
                    </a>
                    <div class="chat-body-message-item-reply-text">' . $data['message'] . '</div>';
    }

    // permission
    public function detailConversation(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $type = $request->get('type');
        $api = ((int)$type === 3) ? sprintf(API_MESSAGE_SUPPLIER_GET_DETAIL, $id) : sprintf(API_MESSAGE_TMS_GET_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $optionMe = '<div class="dropdown dropdown-action-user-about">
                                 <button class="dropdown-toggle action-user-member" type="button" data-toggle="dropdown">
                                      <i class="fa fa-ellipsis-h"></i>
                                 </button>
                                 <div class="dropdown-menu-custom">
                                      <a class="dropdown-item remove-group-chat dropdown-item-custom" href="javascript:void(0)">Giải tán nhóm</a>
                                 </div>
                             </div>';
        $dataMember = '<div class="row-member">
                               <div class="img-members-about online">
                                     <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  loading="lazy" class="img-avt-member" src="https://beta.api.gateway.overate-vntech.com/short/LQWU1euHkkxmdtBOpZqgK" alt="">
                                     <img class="img-avt-member-online" src="../images/message/khungtop1.png" alt="" data-toggle="tooltip" data-placement="left" data-original-title="Trưởng nhóm">
                                     <div class="status-member-message online"></div>
                               </div>
                               <div class="info-member-about">
                                     <div class="info-name-member-about" style="color: #fa6342;font-weight: 550;">Bạn</div>
                                     <p class="part-group" style="font-size: 12px !important; font-weight: 500;"><b>Bộ phận:</b> Kế toán</p>
                               </div>
                               ' . $optionMe . '
                           </div>';
        $dataMember .= '<div class="row-member create-two-personal-conversation" data-group-id="1"  data-member-id = "1" data-name="Bùi Ngọc Lâm" data-role="1" data-avatar="https://beta.api.gateway.overate-vntech.com/short/LQWU1euHkkxmdtBOpZqgK" data-role-name="Phục vụ">
                                   <div class="img-members-about online">
                                         <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  loading="lazy" class="img-avt-member" src="https://beta.api.gateway.overate-vntech.com/short/LQWU1euHkkxmdtBOpZqgK" alt="">
                                         <img class="img-avt-member-online" src="../images/message/khungtop1.png" alt="" data-toggle="tooltip" data-placement="left" data-original-title="Trưởng nhóm">
                                         <div class="status-member-message online"></div>
                                   </div>
                                   <div class="info-member-about">
                                         <div class="info-name-member-about">Bùi Ngọc Lâm</div>
                                          <p class="part-group" style="font-size: 12px !important; font-weight: 500;"><b>Bộ phận:</b> Phục vụ</p>
                                   </div>
                               </div>';
        $optionYou = '<div class="dropdown dropdown-action-user-about">
                                 <button class="dropdown-toggle action-user-member" type="button" data-toggle="dropdown">
                                      <i class="fa fa-ellipsis-h"></i>
                                 </button>
                                 <div class="dropdown-menu-custom">
                                      <a class="dropdown-item remove-member dropdown-item-custom" href="javascript:void(0)">Mời khỏi nhóm</a>
                                      <a class="dropdown-item promote-member dropdown-item-custom" href="javascript:void(0)">Thêm làm phó nhóm</a>
                                 </div>
                             </div>';
        $dataMember .= '<div class="row-member create-two-personal-conversation" data-group-id="2"  data-member-id = "2"  data-name="Ngọc Lâm" data-role="1" data-avatar="https://beta.api.gateway.overate-vntech.com/short/LQWU1euHkkxmdtBOpZqgK" data-role-name="Thu ngân">
                                   <div class="img-members-about online">
                                        <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  loading="lazy" class="img-avt-member" src="https://beta.api.gateway.overate-vntech.com/short/LQWU1euHkkxmdtBOpZqgK" alt="">
                                        <div class="status-member-message online"></div>
                                   </div>
                                   <div class="info-member-about">
                                         <div class="info-name-member-about">Ngọc Lâm</div>
                                         <p class="part-group" style="font-size: 12px !important; font-weight: 500;"><b>Bộ phận:</b> Thu ngân</p>
                                   </div>
                                   ' . $optionYou . '
                               </div>';
        $dataFile = '<div class="hover-link-file" data-link-original="file" data-name="file">
                                        <div class="file-group-items">
                                            <div class="media-item-file">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="file-thumb-img" src="https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n">
                                                <div class="info-file">
                                                    <div class="info-file-title" title="file">
                                                        file
                                                    </div>
                                                    <div class="group-subtitle-file">
                                                        <div class="info-file-subtitle">' . $this->formatSizeUnits(1024) . '</div>
                                                        <span class="info-file-date set-interval-message" data-time="27/07/2023 16:57:00">vừa xong</span>
                                                    </div>
                                                </div>
                                                 <div class="see-item-image-video-grid-download file-about btn-download-file-upload">
                                                    <i class="fa fa-download" data-download="file" data-name-file="file"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
        $dataImage = '<div class="see-item-image-video-grid item-image-about-visible-messages">
                                   <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="see-item-image-video-grid-img" src="https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n" data-link-original="/images/tms/default.jpeg" data-name = "ảnh" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                   <div class="see-item-image-video-grid-download btn-download-file-upload">
                                      <i class="fa fa-download" data-download="https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n" data-name-file="ảnh"></i>
                                   </div>
                                </div>';
        $dataVideo = '<div class="see-item-image-video-grid video-about" data-link="https://beta.api.gateway.overate-vntech.com/short/8z3dEZUwhZXsqILd7ve-3" data-sender="Handcode" data-avatar-sender="https://zpsocial-f46-org.zadn.vn/b2b8682af0a61ff846b7.jpg" data-time="14:21" data-thumb="https://zpsocial-f46-org.zadn.vn/b2b8682af0a61ff846b7.jpg">
                                   <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="see-item-image-video-grid-img" src="https://beta.api.gateway.overate-vntech.com/short/8z3dEZUwhZXsqILd7ve-3" alt="">
                                   <div class="see-item-image-video-grid-download btn-download-file-upload">
                                      <i class="fa fa-download" data-download="https://beta.api.gateway.overate-vntech.com/short/8z3dEZUwhZXsqILd7ve-3" data-name-file="video"></i>
                                   </div>
                                   <i onclick="viewVideoAbout($(this))" class="play-video-to-link-btn">
                                                        <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="30px" width="30px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                                                            <path class="stroke-solid" fill="none" stroke="" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                                                        C97.3,23.7,75.7,2.3,49.9,2.5"></path>
                                                            <path class="icon" fill="" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"></path>
                                                        </svg>
                                                    </i>
                                </div>';
        $dataLink = '<div class="hover-link-file" data-url="https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n">
                                   <div class="link-group-items">
                                       <div class="media-item">
                                           <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="link-thumb-img" src=" https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n" alt="">
                                           <div class="info-link">
                                               <div class="info-link-title">
                                                  Link
                                               </div>
                                               <div class="group-subtitle">
                                                   <div class="info-link-subtitle" >Link</div>
                                                   <span class="info-link-date set-interval-message" data-time="27/07/2023 16:57:00">vừa xong</span>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>';
        return [$config, $dataMember, $dataImage, $dataVideo, $dataFile, $dataLink];
        try {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $user = Session::get(SESSION_JAVA_ACCOUNT);
            $collection = collect($config['data']['members']);
            $memberMeAdmin = $collection->where('member_id', $user['id'])->where('permissions', 1)->count();
            $memberYouAdmin = $collection->where('member_id', '!==', $user['id'])->where('permissions', 1)->toArray();
            $memberYou = $collection->where('member_id', '!==', $user['id'])->where('permissions', '!==', 1)->toArray();
            $optionMe = '';
            $optionYou = '';
            $imgMe = '';
            $keyMe = '';
            $status = 'offline';
            foreach ($config['data']['members'] as $member) {
                if ($member['status'] == 1) {
                    $status = 'online';
                } else {
                    $status = 'offline';
                }
            }
            if ($config['data']['conversation_type'] === 0 && $memberMeAdmin === 0) {
                $optionMe = '<div class="dropdown dropdown-action-user-about">
                                 <button class="dropdown-toggle action-user-member" type="button" data-toggle="dropdown">
                                      <i class="fa fa-ellipsis-h"></i>
                                 </button>
                                 <div class="dropdown-menu-custom">
                                      <a onclick="leaveGroupUser($(this))" class="dropdown-item dropdown-item-custom" href="javascript:void(0)">Rời nhóm</a>
                                 </div>
                             </div>';
            } else if ($memberMeAdmin === 1) {
                $imgMe = '<img class="img-avt-member-online" src="../images/message/khungtop1.png" alt="" data-toggle="tooltip" data-placement="left" data-original-title="Trưởng nhóm">';
                $optionYou = '<div class="dropdown dropdown-action-user-about">
                                 <button class="dropdown-toggle action-user-member" type="button" data-toggle="dropdown">
                                      <i class="fa fa-ellipsis-h"></i>
                                 </button>
                                 <div class="dropdown-menu-custom">
                                      <a class="dropdown-item remove-member dropdown-item-custom" href="javascript:void(0)">Mời khỏi nhóm</a>
                                      <a class="dropdown-item promote-member dropdown-item-custom" href="javascript:void(0)">Thêm làm phó nhóm</a>
                                 </div>
                             </div>';
                $keyMe = '<i class="fa fa-key key-member-detail-visible-message"></i>';
                $optionMe = '<div class="dropdown dropdown-action-user-about">
                                 <button class="dropdown-toggle action-user-member" type="button" data-toggle="dropdown">
                                      <i class="fa fa-ellipsis-h"></i>
                                 </button>
                                 <div class="dropdown-menu-custom">
                                      <a class="dropdown-item remove-group-chat dropdown-item-custom" href="javascript:void(0)">Giải tán nhóm</a>
                                 </div>
                             </div>';
            }
            $dataMember = '<div class="row-member">
                               <div class="img-members-about ' . $status . '">
                                     <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  loading="lazy" class="img-avt-member" src="' . $domain . $user['avatar'] . '" alt="">
                                     ' . $imgMe . '
                                     <div class="status-member-message ' . $status . '"></div>
                               </div>
                               <div class="info-member-about">
                                     <div class="info-name-member-about" style="color: #fa6342;font-weight: 550;">Bạn</div>
                                     <p class="part-group" style="font-size: 12px !important; font-weight: 500;"><b>Bộ phận:</b> ' . $user['employee_role_name'] . '</p>
                               </div>
                               ' . $optionMe . '
                           </div>';

            foreach ($memberYouAdmin as $mYA) {
                $dataMember .= '<div class="row-member create-two-personal-conversation" data-group-id="' . $config['data']['_id'] . '"  data-member-id = "' . $mYA['member_id'] . '" data-name="' . $mYA['full_name'] . '" data-role="' . $mYA['role_id'] . '" data-avatar="' . $mYA['avatar'] . '" data-role-name="' . $mYA['role_name'] . '">
                                   <div class="img-members-about ' . $status . '">
                                         <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  loading="lazy" class="img-avt-member" src="' . $domain . $mYA['avatar'] . '" alt="">
                                         <img class="img-avt-member-online" src="../images/message/khungtop1.png" alt="" data-toggle="tooltip" data-placement="left" data-original-title="Trưởng nhóm">
                                         <div class="status-member-message ' . $status . '"></div>
                                   </div>
                                   <div class="info-member-about">
                                         <div class="info-name-member-about">' . $mYA['full_name'] . '</div>
                                          <p class="part-group" style="font-size: 12px !important; font-weight: 500;"><b>Bộ phận:</b> ' . $mYA['role_name'] . '</p>
                                   </div>
                               </div>';
            }
            foreach ($memberYou as $mY) {
                $dataMember .= '<div class="row-member create-two-personal-conversation" data-group-id="' . $config['data']['_id'] . '"  data-member-id = "' . $mY['member_id'] . '"  data-name="' . $mY['full_name'] . '" data-role="' . $mY['role_id'] . '" data-avatar="' . $mY['avatar'] . '" data-role-name="' . $mY['role_name'] . '">
                                   <div class="img-members-about ' . $status . '">
                                        <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  loading="lazy" class="img-avt-member" src="' . $domain . $mY['avatar'] . '" alt="">
                                        <div class="status-member-message ' . $status . '"></div>
                                   </div>
                                   <div class="info-member-about">
                                         <div class="info-name-member-about">' . $mY['full_name'] . '</div>
                                         <p class="part-group" style="font-size: 12px !important; font-weight: 500;"><b>Bộ phận:</b> ' . $mY['role_name'] . '</p>
                                   </div>
                                   ' . $optionYou . '
                               </div>';
            }

            $dataFile = '';
            foreach ($config['data']['list_file'] as $db) {
                $dataFile .= '<div class="hover-link-file" data-link-original="' . $domain . $db['link_original'] . '" data-name="' . $db['name_file'] . '">
                                        <div class="file-group-items">
                                            <div class="media-item-file">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="file-thumb-img" src="' . $domain . $db['link_original'] . '">
                                                <div class="info-file">
                                                    <div class="info-file-title" title="' . $db['name_file'] . '">
                                                        ' . $db['name_file'] . '
                                                    </div>
                                                    <div class="group-subtitle-file">
                                                        <div class="info-file-subtitle">' . $this->formatSizeUnits($db['size']) . '</div>
                                                        <span class="info-file-date set-interval-message" data-time="' . $db['created_at'] . '">' . $this->formatFromTimeTemplate($db['created_at']) . '</span>
                                                    </div>
                                                </div>
                                                 <div class="see-item-image-video-grid-download file-about btn-download-file-upload">
                                                    <i class="fa fa-download" data-download="' . $domain . $db['link_original'] . '" data-name-file="' . $db['name_file'] . '"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
            }
            $dataImage = '';
            foreach ($config['data']['list_image'] as $db) {
                $dataImage .= '<div class="see-item-image-video-grid item-image-about-visible-messages">
                                   <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="see-item-image-video-grid-img" src="' . $domain . $db['link_original'] . '" data-link-original="/images/tms/default.jpeg" data-name = "' . $db['name_file'] . '" data-sender="Handcode" data-time="11:11" data-avatar="https://cover-talk.zadn.vn/0/e/4/7/8/ea4b0e5b69552a4dea28035bb614f866.jpg">
                                   <div class="see-item-image-video-grid-download btn-download-file-upload">
                                      <i class="fa fa-download" data-download="' . $domain . $db['link_original'] . '" data-name-file="' . $db['name_file'] . '"></i>
                                   </div>
                                </div>';
            }
            $dataVideo = '';
            foreach ($config['data']['list_video'] as $db) {
                $dataVideo .= '<div class="see-item-image-video-grid video-about" data-link="' . $domain . $db['link_original'] . '" data-sender="Handcode" data-avatar-sender="https://zpsocial-f46-org.zadn.vn/b2b8682af0a61ff846b7.jpg" data-time="14:21" data-thumb="https://zpsocial-f46-org.zadn.vn/b2b8682af0a61ff846b7.jpg">
                                   <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="see-item-image-video-grid-img" src="' . $domain . $db['link_original'] . '" alt="">
                                   <div class="see-item-image-video-grid-download btn-download-file-upload">
                                      <i class="fa fa-download" data-download="' . $domain . $db['link_original'] . '" data-name-file="' . $db['name_file'] . '"></i>
                                   </div>
                                   <i onclick="viewVideoAbout($(this))" class="play-video-to-link-btn">
                                                        <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="30px" width="30px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                                                            <path class="stroke-solid" fill="none" stroke="" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                                                        C97.3,23.7,75.7,2.3,49.9,2.5"></path>
                                                            <path class="icon" fill="" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"></path>
                                                        </svg>
                                                    </i>
                                </div>';
            }
            $dataLink = '';
            if ((int)$type === 3) {
                foreach ($config['data']['list_link'] as $db) {
                    $dataLink .= '<div class="hover-link-file" data-url="' . $db['message_link']['cannonical_url'] . '">
                                   <div class="link-group-items">
                                       <div class="media-item">
                                           <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="link-thumb-img" src=" ' . $db['message_link']['media_thumb'] . '" alt="">
                                           <div class="info-link">
                                               <div class="info-link-title">
                                                   ' . $db['message_link']['title'] . '
                                               </div>
                                               <div class="group-subtitle">
                                                   <div class="info-link-subtitle" >' . $db['message_link']['cannonical_url'] . '</div>
                                                   <span class="info-link-date set-interval-message" data-time="' . $db['created_at'] . '">' . $this->formatFromTimeTemplate($db['created_at']) . '</span>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>';
                }
            } else {
                foreach ($config['data']['list_link'] as $db) {
                    $dataLink .= '<div class="hover-link-file" data-url="' . $db['message_link']['cannonical_url'] . '">
                                   <div class="link-group-items">
                                       <div class="media-item">
                                           <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="link-thumb-img" src=" ' . $db['message_link']['media_thumb'] . '" alt="">
                                           <div class="info-link">
                                               <div class="info-link-title">
                                                   ' . $db['message_link']['title'] . '
                                               </div>
                                               <div class="group-subtitle">
                                                   <div class="info-link-subtitle" >' . $db['message_link']['cannonical_url'] . '</div>
                                                   <span class="info-link-date set-interval-message" data-time="' . $db['created_at'] . '">' . $this->formatFromTimeTemplate($db['created_at']) . '</span>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>';
                }
            }
            return [$config, $dataMember, $dataImage, $dataVideo, $dataFile, $dataLink];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataFileDetailConversation(Request $request)
    {
        $page = $request->get('page');
        $limit = Config::get('constants.type.default.LIMIT_5');
        $type = $request->get('type');
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MESSAGE_TMS_GET_FILE, $page, $limit, $type, $id);
        $params = null;
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $data = '<div class="zoneQA">
                                        <div class="ques about-list-image">
                                            <div class="ques-title">05/08/2023</div>
                                            <div class="hidden-general-info">
                                                <i class="fa fa-sort-down"></i>
                                            </div>
                                        </div>
                                        <div class="ans" style="display: block;">
                                            <div class="slide-to-top-max-width-custom" style="width: 100%;">
                                                <div class="see-list-image-video-grid pb-0"> <div class="see-item-image-video-grid item-image-about-visible-messages">
                                                    <img class="see-item-image-video-grid-img" onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n " loading="lazy" alt="" data-link-original="https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n" data-sender="handcode" data-avatar="https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n" data-time="22:22"/>
                                                    <div class="see-item-image-video-grid-download btn-download-file-upload">
                                                        <i class="fa fa-download"  data-download="https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n" data-name-file="file"></i>
                                                    </div>
                                                </div> </div></div></div></div>';
        return [$data, ''];
        try {
            if ((int)$page === 1 && count($config['data']['list']) === 0) {
                switch ((int)$type) {
                    case Config::get('constants.type.MessageTypeEnum.FILE'):
                        $data = '<div id="div-empty-detail-file" style="height: 295px; width: 100%; margin-top: 20%">
                                    <div class="text-center">
                                        <img src="/images/message/file-empty.png" style="width: 300px;">
                                    </div>
                                 </div>';
                        break;
                    case Config::get('constants.type.MessageTypeEnum.IMAGE'):
                        $data = '<div id="div-empty-detail-image" style="height: 295px; width: 100%; margin-top: 20%">
                                    <div class="text-center">
                                        <img src="/images/message/img-empty.png" style="width: 300px;">
                                    </div>
                                 </div>';
                        break;
                    case Config::get('constants.type.MessageTypeEnum.VIDEO'):
                        $data = '<div id="div-empty-detail-video" style="height: 295px; width: 100%; margin-top: 20%">
                                    <div class="text-center">
                                        <img src="/images/message/video-empty.png" style="width: 300px;">
                                    </div>
                                 </div>';
                        break;
                    case Config::get('constants.type.MessageTypeEnum.LINK'):
                        $data = '<div id="div-empty-detail-link" style="height: 295px; width: 100%; margin-top: 20%">
                                    <div class="text-center">
                                        <img src="/images/message/link-empty.png" style="width: 300px;">
                                    </div>
                                 </div>';
                        break;
                }
            } else {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                $data = '';
                switch ((int)$type) {
                    case Config::get('constants.type.MessageTypeEnum.FILE'):
                        foreach ($config['data']['list'] as $item) {
                            $data .= '<div class="zoneQA">
                                        <div class="ques about-list-image">
                                            <div class="ques-title">' . date_format(date_create($item['time']), "d/m/Y") . '</div>
                                            <div class="hidden-general-info">
                                                <i class="fa fa-sort-down"></i>
                                            </div>
                                        </div>
                                        <div class="ans" style="display: block;">
                                            <div class="slide-to-top-max-width-custom" style="width: 100%;">
                                                <div class="see-list-image-video-grid p-0 w-100">';
                            foreach ($item['list'] as $db) {
                                $sizeFile = (isset($db['size'])) ? $this->formatSizeUnits($db['size']) : '---kb';
                                $iconFile = $this->convertImageFile($db['name_file']);
                                $data .= '<div class="hover-link-file all-file-detail w-100">
                                            <div class="file-group-items">
                                                <div class="media-item-file" data-link-original="' . $domain . $db['link_original'] . '" data-name="' . $db['name_file'] . '">
                                                    <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" class="file-thumb-img" src="' . $iconFile . '">
                                                    <div class="info-file">
                                                        <div class="info-file-title" title="">' . $db['name_file'] . '</div>
                                                        <div class="group-subtitle-file">
                                                        ' . $sizeFile . '
                                                        </div>
                                                    </div>
                                                    <div class="see-item-image-video-grid-download file-about btn-download-file-upload">
                                                        <i class="fa fa-download" data-download="' . $domain . $db['link_original'] . '" data-name-file="' . $db['name_file'] . '"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                            }
                            $data .= '</div></div></div></div>';
                        }
                        break;
                    case Config::get('constants.type.MessageTypeEnum.IMAGE'):
                        foreach ($config['data']['list'] as $item) {
                            $data .= '<div class="zoneQA">
                                        <div class="ques about-list-image">
                                            <div class="ques-title">' . date_format(date_create($item['time']), "d/m/Y") . '</div>
                                            <div class="hidden-general-info">
                                                <i class="fa fa-sort-down"></i>
                                            </div>
                                        </div>
                                        <div class="ans" style="display: block;">
                                            <div class="slide-to-top-max-width-custom" style="width: 100%;">
                                                <div class="see-list-image-video-grid pb-0">';
                            foreach ($item['list'] as $db) {
                                $data .= '<div class="see-item-image-video-grid item-image-about-visible-messages">
                                                    <img class="see-item-image-video-grid-img" onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $domain . $db['link_original'] . '" loading="lazy" alt="" data-link-original="' . $domain . $db['link_original'] . '" data-sender="handcode" data-avatar="https://f29-zpc.zdn.vn/4342575224264307696/a60746b0542c9072c93d.jpg" data-time="22:22"/>
                                                    <div class="see-item-image-video-grid-download btn-download-file-upload">
                                                        <i class="fa fa-download"  data-download="' . $domain . $db['link_original'] . '" data-name-file="' . $db['name_file'] . '"></i>
                                                    </div>
                                                </div>';
                            }
                            $data .= '</div></div></div></div>';
                        }
                        break;
                    case Config::get('constants.type.MessageTypeEnum.VIDEO'):
                        foreach ($config['data']['list'] as $item) {
                            $data .= '<div class="zoneQA">
                                        <div class="ques about-list-image">
                                            <div class="ques-title">' . date_format(date_create($item['time']), "d/m/Y") . '</div>
                                            <div class="hidden-general-info">
                                                <i class="fa fa-sort-down"></i>
                                            </div>
                                        </div>
                                        <div class="ans" style="display: block;">
                                            <div class="slide-to-top-max-width-custom" style="width: 100%;">
                                                <div class="see-list-image-video-grid pb-0">';
                            foreach ($item['list'] as $db) {
                                $data .= '<div class="see-item-image-video-grid video-about-all all-video" data-link="' . $domain . $db['link_original'] . '" data-thumb="' . $domain . $db['link_thumb'] . '" data-sender="Handcode" data-avatar-sender="https://zpsocial-f46-org.zadn.vn/b2b8682af0a61ff846b7.jpg" data-time="14:21">
                                                <img class="see-item-image-video-grid-img" onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $domain . $db['link_thumb'] . '" alt=""/>
                                                <div class="see-item-image-video-grid-download btn-download-file-upload">
                                                    <i class="fa fa-download" data-download="' . $domain . $db['link_original'] . '" data-name-file="' . $db['name_file'] . '"></i>
                                                </div>
                                                <i onclick="viewVideoAbout($(this))" class="play-video-to-link-btn">
                                                    <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="30px" width="30px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                                                        <path
                                                            class="stroke-solid"
                                                            fill="none"
                                                            stroke=""
                                                            d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                                                                                                    C97.3,23.7,75.7,2.3,49.9,2.5"
                                                        ></path>
                                                        <path class="icon" fill="" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"></path>
                                                    </svg>
                                                </i>
                                            </div>';
                            }
                            $data .= '</div></div></div></div>';
                        }
                        break;
                    case Config::get('constants.type.MessageTypeEnum.LINK'):
                        foreach ($config['data']['list'] as $item) {
                            $data .= '<div class="zoneQA">
                                        <div class="ques about-list-image">
                                            <div class="ques-title">' . date_format(date_create($item['time']), "d/m/Y") . '</div>
                                            <div class="hidden-general-info">
                                                <i class="fa fa-sort-down"></i>
                                            </div>
                                        </div>
                                        <div class="ans" style="display: block;">
                                            <div class="slide-to-top-max-width-custom" style="width: 100%;">
                                                <div class="see-list-image-video-grid p-0 w-100">';
                            foreach ($item['list'] as $db) {
                                $data .= '<div class="hover-link-file all-link-detail w-100"  data-url="' . $db['cannonical_url'] . '">
                                            <div class="file-group-items">
                                                <div class="media-item-file" data-link-original="' . $domain . $db['cannonical_url'] . '">
                                                    <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" class="file-thumb-img" src="' . $db['media_thumb'] . '">
                                                    <div class="info-file">
                                                         <div class="info-file-title" title="">' . $db['description'] . '</div>
                                                        <div class="group-subtitle-file">
                                                            <div class="info-link-subtitle">' . $db['cannonical_url'] . '</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>';
                            }
                            $data .= '</div></div></div></div>';
                        }
                        break;
                }
            }
            return [$data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataPinnedDetailConversation(Request $request)
    {
        $checkOne = 1;
        $page = $request->get('page');
        $limit = $request->get('limit');
        $type = $request->get('type');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = ((int)$type === 3) ? sprintf(API_MESSAGE_TMS_SUPPLIER_GET_PINNED, $status, $id) : sprintf(API_MESSAGE_TMS_GET_PINNED, $page, $limit, $status, $id);
        $params = null;
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $listPinned = '
                    <div class="pin-details-content-item-visible-message position-relative" data-id=" " data-random-key=" ">
                        <div class="pin-details-content-item-header">
                            <img class="pin-details-content-image-header" onerror="imageDefaultOnLoadError($(this))" loading="lazy" src="https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n" />
                            <span class="name-user-pined-content">
                                Ngọc Lâm
                                <span class="d-flex">
                                <i class="ion-chatboxes icon-type-pinned"></i>
                                Tin ghim
                                </span>
                            </span>
                        </div>
                        <div class="full-message-pinned body-visible-message">
                            <div class="image-pin-contain">
                                <div class="pin-details-content-item-body">
                                    <img class="pin-details-content-image-body " onerror="imageDefaultOnLoadError($(this))" loading="lazy" src="https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n" />
                                    <div class="name-content-pinned-body">
                                        <span class="name-user-pined-body-content">
                                           Hihihi
                                        </span>
                                        <div class="content-pined-visible-message">
                                           Đã gởi 1 hình ảnh
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        return [$listPinned, '', ''];
        try {
            if ((int)$page === 1 && count($config['data']) === 0) {
                $listPinned = '<div id="div-empty-pinned" style="height: 295px; width: 100%; margin-top: 20%">
                                    <div class="text-center">
                                        <img src="/images/message/conversation_empty.png" style="width: 160px;">
                                        <div class="text-center">
                                           <div>Chưa có tin ghim</div>
                                        </div>
                                    </div>
                                 </div>';
                $currentPinned = $listPinned;
            } else {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                $listPinned = '';
                $currentPinned = '';
                $arrayConfig = ((int)$type === 3) ? $config['data']['list'] : $config['data'];
                foreach ($arrayConfig as $db) {
                    $class = '';
                    $image = '';
                    switch ($db['message_pinned']['message_type']) {
                        case Config::get('constants.type.MessageTypeEnum.IMAGE'):
                            $message = 'Đã gửi ' . count($db['message_pinned']['files']) . ' hình ảnh';
                            $image = $domain . $db['message_pinned']['files'][0]['link_thumb'];
                            break;
                        case Config::get('constants.type.MessageTypeEnum.FILE'):
                            $message = 'Đã gửi ' . count($db['message_pinned']['files']) . ' file';
                            $image = $db['message_pinned']['files'][0]['link_thumb'];
                            break;
                        case Config::get('constants.type.MessageTypeEnum.STICKER'):
                            $message = 'Đã gửi sticker';
                            $image = $domain . $db['message_pinned']['message'];
                            break;
                        case Config::get('constants.type.MessageTypeEnum.VIDEO'):
                            $message = 'Đã gửi video';
                            $image = '/images/message/video.png';
                            break;
                        case Config::get('constants.type.MessageTypeEnum.AUDIO'):
                            $message = 'Đã gửi đoạn ghi âm';
                            $image = '/images/message/record.png';
                            break;
                        case Config::get('constants.type.MessageTypeEnum.ORDER'):
                            $message = 'Đã gửi đơn hàng';
                            $image = '/images/message/excel.png';
                            break;
                        default:
                            $class = 'd-none';
                            $message = $db['message_pinned']['message'];
                            break;
                    }
                    $listPinned .= '
                    <div class="pin-details-content-item-visible-message position-relative" data-id="' . $db['receiver_id'] . '" data-random-key="' . $db['message_pinned']['random_key'] . '">
                        <div class="pin-details-content-item-header">
                            <img class="pin-details-content-image-header" onerror="imageDefaultOnLoadError($(this))" loading="lazy" src="' . $domain . $db['sender']['avatar'] . '" />
                            <span class="name-user-pined-content">
                                ' . $db['sender']['full_name'] . '
                                <i class="ion-chatboxes icon-type-pinned">Tin ghim</i>
                            </span>
                        </div>
                        <div class="full-message-pinned body-visible-message">
                            <div class="image-pin-contain">
                                <div class="pin-details-content-item-body">
                                    <img class="pin-details-content-image-body ' . $class . '" onerror="imageDefaultOnLoadError($(this))" loading="lazy" src="' . $image . '" />
                                    <div class="name-content-pinned-body">
                                        <span class="name-user-pined-body-content">
                                            ---
                                        </span>
                                        <div class="content-pined-visible-message">
                                            ' . $message . '
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                    if ($checkOne == 1) {
                        $currentPinned = $listPinned;
                    }
                    $checkOne = 0;
                }
            }
            return [$listPinned, $config, $currentPinned];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataPinnedCurrentDetailConversation(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MESSAGE_TMS_GET_PINNED_CURRENT, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            return $config['data'];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataVoteDetailConversation(Request $request)
    {
        $page = $request->get('page');
        $limit = $request->get('limit');
        $type = $request->get('type');
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MESSAGE_TMS_GET_VOTE, $page, $limit, $type, $id);
        $params = null;
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        //hardcode
        $listVote = '<div class="pin-details-content-item-visible-message">
                        <div class="pin-details-content-item-header">
                            <img class="pin-details-content-image-header"
                                 src="https://beta.api.gateway.overate-vntech.com/short/90zOh5sifviKyFgXnci2n"
                                 alt="">
                            <span class="name-user-pined-content">
                                Bùi Ngọc Lâm
                                <span class="d-flex">
                                <i class="ion-stats-bars icon-type-pinned"></i>
                                Bình chọn
                                </span>
                            </span>
                        </div>
                        <div style="position: relative;">
                            <div class="item-vote">
                                <div class="div-vote" style="width:  50%;"></div>
                                <div class="content-vote"><span>Code</span></div>
                                <div class="count-vote">10</div>
                            </div>
                            <div class="item-vote">
                                <div class="div-vote" style="width:25%;"></div>
                                <div class="content-vote"><span>Không code</span></div>
                                <div class="count-vote">5</div>
                            </div>
                        </div>
                        <span class="other-vote-message-vote ">Còn 3 lựa chọn khác</span>
                        <div class="pin-details-content-item-bottom">
                            <span class="seen-message-old" onclick="openModalDetailVoteVisibleMessage(123)">Xem bình chọn</span>
                        </div>
                    </div>';
        return [$listVote, $config];
        try {
            if ((int)$page === 1 && count($config['data']['list']) === 0) {
                $listVote = '<div id="div-empty-vote" style="height: 295px; width: 100%; margin-top: 20%">
                                    <div class="text-center">
                                        <img src="/images/message/conversation_empty.png" style="width: 160px;">
                                        <div class="text-center">
                                           <div>Chưa có bình chọn</div>
                                        </div>
                                    </div>
                                 </div>';
            } else {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                $listVote = '';
                foreach ($config['data']['list'] as $db) {
                    $classTextVote = 'd-none';
                    $textVote = '';
                    if (count($db['message_vote']['list_option']) > 3) {
                        $classTextVote = '';
                        $textVote = '* Còn ' . (count($db['message_vote']['list_option']) - 3) . ' lựa chọn khác';
                    }
                    $db['message_vote']['list_option'] = collect($db['message_vote']['list_option'])->where('id', '!==', -1)->values()->toArray();
                    $listVote .= '<div class="pin-details-content-item-visible-message">
                        <div class="pin-details-content-item-header">
                            <img class="pin-details-content-image-header"
                                 src="' . $domain . $db['sender']['avatar'] . '"
                                 alt="">
                            <span class="name-user-pined-content">
                                ' . $db['sender']['full_name'] . '
                                <span class="d-flex">
                                <i class="ion-stats-bars icon-type-pinned"></i>
                                Bình chọn
                                </span>
                            </span>
                        </div>
                        <div style="position: relative;">
                            <div class="item-vote">
                                <div class="div-vote" style="width: ' . ($this->rateDefaultTemplate(count($db['message_vote']['list_option'][0]['list_user']), count($db['message_vote']['list_option'][0]['list_user'])) * 100) . '%;"></div>
                                <div class="content-vote"><span>' . $db['message_vote']['list_option'][0]['content'] . '</span></div>
                                <div class="count-vote">' . count($db['message_vote']['list_option'][0]['list_user']) . '</div>
                            </div>
                            <div class="item-vote">
                                <div class="div-vote" style="width: ' . ($this->rateDefaultTemplate(count($db['message_vote']['list_option'][1]['list_user']), count($db['message_vote']['list_option'][0]['list_user'])) * 100) . '%;"></div>
                                <div class="content-vote"><span>' . $db['message_vote']['list_option'][1]['content'] . '</span></div>
                                <div class="count-vote">' . count($db['message_vote']['list_option'][1]['list_user']) . '</div>
                            </div>
                        </div>
                        <span class="other-vote-message-vote ' . $classTextVote . '">' . $textVote . '</span>
                        <div class="pin-details-content-item-bottom">
                            <span class="date-pinned-message">' . date_format(date_create($db['created_at']), 'H:i d/m/Y') . '</span>
                            <span class="seen-message-old" onclick="openModalDetailVoteVisibleMessage(' . $db['random_key'] . ')">Xem bình chọn</span>
                        </div>
                    </div>';
                }
            }
            return [$listVote, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataCategorySticker(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MESSAGE_GET_CATEGORY_STICKER);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $dataCategorySticker = '';
        foreach ($config['data'] as $db) {
            $dataCategorySticker .= '<li class="item-category-sticker-visible-message" data-id="' . $db['id_category'] . '"><img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $domain . $db['link_original'] . '" loading="lazy" alt=""></li>';
        }

        $api = sprintf(API_MESSAGE_GET_STICKER, $config['data'][0]['id_category']);
        $body = null;
        $configSticker = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $dataSticker = '';
        foreach ($configSticker['data'] as $db) {
            $dataSticker .= '<div class="item-sticker-visible-message" data-id="' . $db['_id'] . '"><img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $domain . $db['link_original'] . '" data-src="' . $db['link_original'] . '" loading="lazy" alt=""></div>';
        }
        return [$dataCategorySticker, $dataSticker, $config, $configSticker];
    }

    public function dataSticker(Request $request)
    {
        $idCategory = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MESSAGE_GET_STICKER, $idCategory);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $dataSticker = '';
        foreach ($config['data'] as $db) {
            $dataSticker .= '<div class="item-sticker-visible-message" data-id="' . $db['_id'] . '"><img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $domain . $db['link_original'] . '"  data-src="' . $db['link_original'] . '" loading="lazy" alt=""></div>';
        }
        return [$dataSticker, $config];
    }

    public function dataRole(Request $request)
    {
        $brand = $request->get('brand');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $type = Config::get('constants.type.checkbox.GET_ALL');
        $api = sprintf(API_ROLE_GET_DATA, $brand, $status, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $dataRole = '';
        foreach ($config['data'] as $db) {
            //            $dataRole .= '<div class="checkbox-fade fade-in-primary">
            //                               <label class="check-task-left m-0">
            //                                     <input type="checkbox" data-id="' . $db['id'] . '" data-name="' . $db['name'] . '" data-number="' . $db['number_employees'] . '">
            //                                          <span class="cr cr-item-list-user">
            //                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
            //                                          </span>
            //                                          <span class="name-user-popup-create-group name-user-popup-create-group-left">' . $db['name'] . '</span>
            //                                </label>
            //                           </div>';
            $dataRole .= '<div class="create-group__list-check" data-id="' . $db['id'] . '" data-name="' . $db['name'] . '" data-number="' . $db['number_employees'] . '"  >
                                <div class="to-do-list-popup-create-group">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label class="check-task check-task-left">
                                            <input type="checkbox" data-id="' . $db['id'] . '" data-avatar="' . Config::get('app.IMAGE_DEFAULT') . '" data-name="' . $db['name'] . '"  data-type="0"   />
                                            <span class="cr cr-item-list-user">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <img class="img-user-popup-create-group img-user-popup-create-group-right" onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . Config::get('app.IMAGE_DEFAULT') . '" loading="lazy" alt=""/>
                                              <span class="name-user-popup-create-group name-user-popup-create-group-left">Bộ phận ' . $db['name'] . '
                                            </span>
                                </label>
                                    </div>
                                </div>
                            </div>';
        }
        return [$dataRole, $config];
    }

    public function dataEmployee(Request $request)
    {
        $branch = $request->get('branch');
        $restaurant_brand = -1;
        $is_include_restaurant_manager = Config::get('constants.type.checkbox.SELECTED');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $is_take_myself = Config::get('constants.type.status.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_EMPLOYEE_GET_DATA, $branch, $status, $is_include_restaurant_manager, $is_take_myself, $restaurant_brand);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        //        dd($config);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $data = collect($config['data']['list'])->where('id', '!==', Session::get(SESSION_JAVA_ACCOUNT)['id'])->toArray();
        $dataEmployee = '';
        $dataEmployeeGroup = '';
        foreach ($data as $db) {
            $dataEmployee .= '<div class="col-3 owl-item" data-id="' . $db['id'] . '" data-role="' . $db['employee_role_id'] . '">
                                <div>
                                    <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $domain . $db['avatar'] . '" alt="" loading="lazy">
                                    <div class="sugtd-frnd-meta">
                                        <a href="javascript:void(0)">' . $db['name'] . '</a>
                                        <span>' . $db['role_name'] . '</span>
                                        <ul class="add-remove-frnd">
                                            <li class="add-tofrndlist">
                                                <a class="send-mesg create-two-personal-conversations" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="Nhắn tin" data-member-id="' . $db['id'] . '" data-avatar="' . $db['avatar'] . '" data-name="' . $db['name'] . '" data-role="' . $db['employee_role_id'] . '" data-role-name="' . $db['role_name'] . '">
                                                    <i class="fa fa-commenting"></i>
                                                </a>
                                            </li>
                                            <li class="remove-frnd">
                                                <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailEmployeeManage(' . $db['id'] . ')">
                                                   <i class="icofont icofont-eye-alt"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>';
            $dataEmployeeGroup .= '<div class="create-group__list-check" data-id="' . $db['id'] . '" data-role="' . $db['employee_role_id'] . '">
                                <div class="to-do-list-popup-create-group">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label class="check-task check-task-left">
                                            <input type="checkbox" data-id="' . $db['id'] . '" data-avatar="' . $db['avatar'] . '" data-name="' . $db['name'] . '" data-role="' . $db['employee_role_id'] . '" data-role-name="' . $db['role_name'] . '" data-type="1"/>
                                            <span class="cr cr-item-list-user">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <img class="img-user-popup-create-group img-user-popup-create-group-right" onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $domain . $db['avatar'] . '" loading="lazy" alt=""/>
                                            <span class="name-user-popup-create-group name-user-popup-create-group-left">' . $db['name'] . ' <br>
                                                <p class="part-group" data-role="' . $db['employee_role_id'] . '"><b>Bộ phận:</b> ' . $db['role_name'] . '</p>
                                            </span>

                                </label>
                                    </div>
                                </div>
                            </div>';
        }
        return [$dataEmployee, $dataEmployeeGroup, $config];
    }

    public function createConversationGroup(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MESSAGE_POST_CREATE_GROUP, $request->get('type'));
        $body = [
            'members' => $request->get('members'),
            'name' => $request->get('name'),
            'object_type' => $request->get('object_type'),
            'avatar' => $request->get('avatar'),
            'roles' => $request->get('roles'),
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
    public function createConversationPersonal(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MESSAGE_POST_CREATE_PERSONAL);
        $body = [
            'user_id' => $request->get('user_id'),
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    // update permision
    public function updateConversation(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MESSAGE_TMS_POST_UPDATE, $request->get('id'));
        $body = [
            'avatar' => $request->get('avatar'),
            'name' => $request->get('name'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function removeUserGroup(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $id = $request->get('id_group');
        $api = sprintf(API_MESSAGE_TMS_POST_REMOVE_MEMBER, $id);
        $body = [
            'member_id' => $request->get('member_id')
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function addPermisionUserGroup(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $id = $request->get('id');
        $api = sprintf(API_MESSAGE_SUPPLIER_POST_GROUPS_AUTHORIZATION, $id);
        $body = [
            'member_id' => $request->get('member_id'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function addUserGroup(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $id = $request->get('id');
        $api = sprintf(API_MESSAGE_TMS_POST_ADD_MEMBER, $id);
        $body = [
            'id' => $request->get('id'),
            'members' => $request->get('member'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function leaveUserGroup(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $id = $request->get('id');
        $api = sprintf(API_MESSAGE_POST_REMOVE_GROUP, $id);
        $body = [
            'id' => $request->get('id'),
            'member_id' => $request->get('member_id')
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function disbandGroup(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $id = $request->get('id');
        $api = sprintf(API_MESSAGE_POST_DISBAND_GROUP, $id);
        $body = [
            'id' => $request->get('id'),
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function getMessageTagName(Request $request)
    {
        $limit = 20;
        $page = 1;
        $group_id = $request->get('group_id');
        $conversation_type = $request->get('conversation_type');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MESSAGE_GET_TAG_NAME, $page, $limit, $group_id, $conversation_type);
        $body = [];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        try {
            $optionTagName = "";
            foreach ($config['data']['list'] as $db) {
                $time = $this->formatFromTimeTemplate($db['created_at']);
                $optionTagName .= '<div class="message-tag-name-item">
                        <div class="info-message-tag-name">
                            <img src="' . $domain . $db['sender']['avatar'] . '" alt="" class="info-message-tag-name-avatar">
                            <div class="container-tag-name-message">
                                <div class="info-message-tag-name-item d-flex">
                                    <div class="name-message-tag-name">' . $db['sender']['full_name'] . '</div>
                                    <div class="time-message-tag-name">' . $time . '</div>
                                </div>
                                <div class="content-message-tag-name">
                                    <p class="info-mess">' . $db['message'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            return [$optionTagName, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function getTypeLastMessage($data)
    {
        switch ($data['last_message']['message_type']) {
            case 0:
                return '<p class="info-mess">Cuộc trò chuyện vừa được tạo</p>';
            case 1:
                return '<p class="info-mess">' . $data['last_message']['message'] . '</p>';
            case 2:
                return '<p class="info-mess"><i class="fa fa-image"></i>Hình ảnh</p>';
            case 3:
                return '<p class="info-mess"><i class="fa fa-file"></i>Tệp đính kèm</p>';
            case 4:
                return '<p class="info-mess"><i class="ti-themify-favicon"></i>Sticker</p>';
            case 5:
                return '<p class="info-mess"><i class="fa fa-video-camera"></i>Video</p>';
            case 6:
                return '<p class="info-mess"><i class="fa fa-microphone"></i>Âm thanh</p>';
            case 9:
                return '<p class="info-mess"></i>Đã thu hồi tin nhắn</p>';
            case 10:
                return '<p class="info-mess"></i>Type 10</p>';
            case 11:
                return '<p class="info-mess"></i>Type 11</p>';
            case 13:
                return '<p class="info-mess"><i class="icofont icofont-tack-pin"></i>Đã ghim tin nhắn</p>';
            case 14:
                return '<p class="info-mess">Đã đổi tên nhóm</p>';
            case 15:
                return '<p class="info-mess">Đã đổi ảnh nhóm</p>';
            case 17:
                return '<p class="info-mess">' . $data['last_message']['message'] . '</p>';
            case 27:
                return '<p class="info-mess"><i class="fa fa-signal"></i>Tạo bình chọn mới</p>';
            case 28:
                return '<p class="info-mess"><i class="fa fa-signal"></i>' . $data['last_message'] . '</p>';
            default:
                return '<p class="info-mess">' . $data['last_message']['message'] . '</p>';
        }
    }
}
