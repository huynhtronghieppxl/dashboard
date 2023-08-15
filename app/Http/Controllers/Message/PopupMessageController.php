<?php

namespace App\Http\Controllers\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class PopupMessageController extends Controller
{
    public function messageNotSeen()
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MESSAGE_TMS_GET_MESSAGE_NOT_SEEN);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataConversation(Request $request)
    {
        $type = Config::get('constants.type.ConversationTMSTypeEnum.GET_ALL');
        $page = $request->get('page');
        $text = ($request->get('is_supplier') === 1) ? '-supplier-' : '-tms-';
        $id = Session::get(SESSION_JAVA_ACCOUNT)['id'];
        $keyword = $request->get('keyword');
        if (!$request->get('page')) {
            $keyword = '';
            $page = Config::get('constants.type.default.PAGE_DEFAULT');
            $type = Config::get('constants.type.ConversationTMSTypeEnum.GET_ALL');
        }
        $limit = Config::get('constants.type.default.LIMIT_20');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MESSAGE_TMS_GET_CONVERSATION, $page, $limit, $keyword, $type);
        if ((int)$request->get('is_supplier') === 1) $api = sprintf(API_MESSAGE_SUPPLIER_GET_CONVERSATION, $page, $limit, $keyword);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $collection = collect($config['data']);
        $chunks = $collection->chunk(5);
        try {
            $conversation = '';
            if($config['data'] == []){
                $conversation = '<img class="conversation-supplier-empty" style="width: 350px;" src="\images\message\empty-message.png">';
            }
            $timeX = microtime(true);
            $conversationRightSidebar = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            foreach ($config['data'] as $db) {
                $time = $this->formatFromTimeTemplate($db['create_time_mess_no_send']);
                $conversationRightSidebar .= $this->dataConversationRightSidebar($db, $domain, $time);
            }
            foreach ($chunks[0] as $chunk) {
                $time = $this->formatFromTimeTemplate($chunk['create_time_mess_no_send']);
                $conversation .= $this->dataConversationHeader($chunk, $domain, $time);
            }

            $config['time_X'] = microtime(true) - $timeX;
            return [$conversation, $config, $conversationRightSidebar];
        } catch (Exception $e) {
            $conversation = '<li class="item-conversation-visible-message box-user not-hover">
                                <img src="\images\message\list_error.png" alt="" class="image-list-error">
                            </li>';
            return [$conversation, $config];
        }
    }

    public function dataConversationHeader($data, $domain, $time)
    {
        if ($data['member']['number'] === 0) {
            $countMessageNotSeen = '<p id="number-count-message-not-seen-' . $data['_id'] . '" class="badge text-center mr-2 d-none">0</p>';
        } else if ($data['member']['number'] < 100) {
            $countMessageNotSeen = '<p id="number-count-message-not-seen-' . $data['_id'] . '" class="badge text-center mr-2">' . $data['member']['number'] . '</p>';
        } else {
            $countMessageNotSeen = '<p id="number-count-message-not-seen-' . $data['_id'] . '" class="badge text-center mr-2">99+</p>';
        }
        $tagType = '';
        switch ($data['conversation_type']) {
            case Config::get('constants.type.ConversationTMSTypeEnum.PERSONAL'):
                $tag = '' . $data['member']['role_name'] . '';
                $tagType = '<i class="zmdi zmdi-label-alt tag-greens"></i>';
                break;
            case  Config::get('constants.type.ConversationTMSTypeEnum.GROUP'):
                $tag = 'Nhóm';
                $tagType = '<i class="zmdi zmdi-label-alt tag-friend"></i>';
                break;
            case  Config::get('constants.type.ConversationTMSTypeEnum.WORK'):
                $tag = 'Công việc';
                $tagType = '<i class="zmdi zmdi-label-alt tag-orange"></i>';
                break;
            default:
                $tagType = '';
        }

        return '<li class="message-header-item popup-message" data-type-name="' . $tag . '" data-type="' . $data['conversation_type'] . '" data-id="' . $data['_id'] . '">
                    <div class="message-header-item-img">
                        <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $domain . $data['avatar'] . '" alt="">
                    </div>
                    <div class="message-header-item-info">
                        <div class="message-header-item-name">
                            <span>' . $data['name'] . '</span>
                            ' . $countMessageNotSeen . '
                        </div>
                        <div class="message-header-item-message">
                            ' . $tagType . '
                            '.$this->getTypeLastMessage($data).'
                        </div>
                        <div class="message-header-item-time-ago">' . $time . '</div>
                    </div>
                </li>';
    }

    public function dataConversationRightSidebar($dt, $domain)
    {

        if ($dt['member']['number'] === 0) {
            $countMessageNotSeenSidebar = '';
        } else if ($dt['member']['number'] < 5) {
            $countMessageNotSeenSidebar = '<span class="chat-item-sidebar-number-label">' . $dt['member']['number'] . '</span>';
        } else {
            $countMessageNotSeenSidebar = '<span class="chat-item-sidebar-number-label">5+</span>';
        }
        switch ($dt['conversation_type']) {
            case Config::get('constants.type.ConversationTMSTypeEnum.PERSONAL'):
                $tag = 'Cá nhân';
                $color = '#15a85f';
                break;
            case  Config::get('constants.type.ConversationTMSTypeEnum.GROUP'):
                $tag = 'Nhóm';
                $color = '#7562d8';
                break;
            case  Config::get('constants.type.ConversationTMSTypeEnum.WORK'):
                $tag = 'Công việc';
                $color = '#f5832f';
                break;
            default:
                $color = '';
        }
        return '<li class="chat-item-sidebar" data-id="' . $dt['_id'] . '" data-image="' . $domain . $dt['avatar'] . '" data-name="' . $dt['name'] . '" data-type-name=" ' . $tag . ' " data-type="' . $dt['conversation_type'] . '" >
                                    <span data-toggle="tooltip" data-placement="left" title="' . $dt['name'] . '" class="chat-item-sidebar-avatar-wrapper">
                                        <img style="border: 2px solid ' . $color . '" onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $domain . $dt['avatar'] . '" alt="" class="chat-item-sidebar-avatar category-individual-popup-visible-message">
                                        ' . $countMessageNotSeenSidebar . '
                                    </span>
                                </li>';

    }

    public function dataMessageOfConversationPopup(Request $request)
    {
        $timeX = microtime(true);
        $id = $request->get('id');
        $page = $request->get('page');
        $type = $request->get('type');
        $limit = $request->get('limit');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = ((int)$type === 3) ? sprintf(API_MESSAGE_SUPPLIER_GET_MESSAGE, $id, $page, $limit) : sprintf(API_MESSAGE_TMS_GET_MESSAGE, $id, $page, $limit, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $dataMessage = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
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
                switch ($db['message_type']) {
                    case Config::get('constants.type.MessageTypeEnum.TEXT'):
                        $bodyMessage = '<div class="chat-body-message-text">' . $db['message'] . '</div>';
                        $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.IMAGE'):
                        $bodyMessage = $this->countImage($db, $domain);
                        $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.FILE'):
                        $countFiles = (count($db['files']));
                        $bodyMessage = '';
                        $iconFile = $this->convertImageFile($db['files'][0]['link_thumb']);
                        $sizeFile = $this->formatSizeUnits($db['files'][0]['size']);
                        if ($countFiles > 3) {
                            for ($i = 0; $i <= 2; $i++) {
                                $iconFile = $this->convertImageFile($db['files'][$i]['link_thumb']);
                                $sizeFile = $this->formatSizeUnits($db['files'][$i]['size']);
                                $bodyMessage .= '<div class="chat-body-message-file bdrd-4">
                                                    <a href="' . $domain . $db['files'][$i]['link_original'] . '" download>
                                                        <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" class="chat-message-file-icon-image" src="' . $iconFile . '" loading="lazy"/>
                                                    </a>
                                                    <div class="chat-message-file-content">
                                                        <div class="chat-message-file-action">
                                                            <span class="chat-message-file-name">' . $db['files'][$i]['name_file'] . '</span>
                                                            <span class="chat-message-file-size-body">' . $sizeFile . '</span>
                                                        </div>
                                                        <div class="see-item-image-video-grid-download btn-download-file-upload d-flex">
                                                            <i class="fa fa-download" data-download="' . $domain . $db['files'][$i]['link_original'] . '" data-name-file="' . $db['files'][$i]['name_file'] . '"></i>
                                                        </div>
                                                    </div>
                                                </div>';
                            }
                            $fileList = '<span class="amount-files-rest">và ' . ($countFiles - 3) . ' files khác</span>';
                            $bodyMessage .= $fileList;
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key);
                        } else {
                            $bodyMessage = '<div class="chat-body-message-file">
                                                <a href="' . $domain . $db['files'][0]['link_original'] . '" download>
                                                    <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" class="chat-message-file-icon-image" src="' . $iconFile . '" loading="lazy"/>
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
                            $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key);

                        }
                        break;
                    case Config::get('constants.type.MessageTypeEnum.STICKER'):
                        $bodyMessage = '<div class="chat-body-message-sticker">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  src="' . $domain . $db['message'] . '" alt="Sticker">
                                        </div>';
                        $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.VIDEO'):
                        $image = ($db['files'][0]['link_thumb'] === "") ? '/images/message/default.png' : $domain . $db['files'][0]['link_thumb'];
                        $bodyMessage = '<div class="chat-body-message-video">
                                            <div class="chat-message-video-content">
                                                <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $image . '" data-video="' . $domain . $db['files'][0]['link_original'] . '" loading="lazy">
                                                <video class="video-after-img d-none" controls>
                                                    <source src="' . $domain . $db['files'][0]['link_original'] . '"/>
                                                </video>
                                                <i class="play-video-to-link-btn" onClick="viewVideoPopup($(this))">
                                                    <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" height="50px" width="50px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" fill="#000" xml:space="preserve">
                                                        <path class="stroke-solid" fill="none" stroke=""
                                                                d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                                                                                        C97.3,23.7,75.7,2.3,49.9,2.5"/>
                                                        <path class="icon" fill="#fff" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z" />
                                                    </svg>
                                                </i>
                                            </div>
                                        </div>';
                        $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key);
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
                                                    <div class="chat-audio-name" data-duration="'. ($db['files'][0]['size']) .'">' . $db['files'][0]['name_file'] . '</div>
                                                    <div class="see-item-image-video-grid-download audio btn-download-file-upload d-flex">
                                                        <i class="fa fa-download" data-download="' . $domain . $db['files'][0]['link_original'] . '" data-name-file="' . $db['files'][0]['name_file'] . '"></i>
                                                    </div>
                                                </div>
                                                <div class="play-audio-body-message w-100">
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
                        $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.REPLY'):
                        switch ($db['message_reply']['message_type']) {
                            case Config::get('constants.type.MessageTypeEnum.IMAGE'):
                                $class = '';
                                $img = $domain . $db['message_reply']['files'][0]['link_thumb'];
                                $text = '[Đã gửi ' . count($db['message_reply']['files']) . ' hình ảnh]';
                                $bodyMessage = $this->replyMessageLayoutPopup($db, $text, $img, $class);
                                break;
                            case Config::get('constants.type.MessageTypeEnum.VIDEO'):
                                $class = '';
                                $img = $domain . $db['message_reply']['files'][0]['link_thumb'];
                                $text = '[Đã gửi Video]';
                                $bodyMessage = $this->replyMessageLayoutPopup($db, $text, $img, $class);
                                break;
                            case Config::get('constants.type.MessageTypeEnum.FILE'):
                                $class = '';
                                $img = $this->convertImageFile($db['message_reply']['files'][0]['name_file']);
                                $text = '[Đã gửi File]';
                                $bodyMessage = $this->replyMessageLayoutPopup($db, $text, $img, $class);
                                break;
                            case Config::get('constants.type.MessageTypeEnum.STICKER'):
                                $class = '';
                                $img = $domain . $db['message_reply']['message'];
                                $text = '[Đã gửi Sticker]';
                                $bodyMessage = $this->replyMessageLayoutPopup($db, $text, $img, $class);
                                break;
                            case Config::get('constants.type.MessageTypeEnum.AUDIO'):
                                $class = '';
                                $img = '/images/tms/audio.png';
                                $text = '[Đã gửi Ghi âm]';
                                $bodyMessage = $this->replyMessageLayoutPopup($db, $text, $img, $class);
                                break;
                            case Config::get('constants.type.MessageTypeEnum.LINK'):
                                $class = '';
                                $img = $db['message_reply']['message_link']['media_thumb'];
                                $text = '<div class="reply-body-message-link">'.$db['message_reply']['message'].'</div>';
                                $bodyMessage = $this->replyMessageLayoutPopup($db, $text, $img, $class);
                                break;
                            default:
                                $text = $db['message_reply']['message'];
                                $class = 'd-none';
                                $img = '';
                                $bodyMessage = $this->replyMessageLayoutPopup($db, $text, $img, $class);
                                break;
                        }
                        $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.LINK'):
                        foreach ($db['list_tag_name'] as $tag) {
                            $db['message'] = str_replace($tag['key_tag_name'], '<span data-id="' . $tag['member_id'] . '" data-role="" data-role-name="" onclick="createConversationFromTagVisibleMessage($(this))">@' . $tag['full_name'] . '</span>', $db['message']);
                        }
                        $db['message'] = $this->convertMessageLinkPopup($db['message'], $db['message_link']);
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
                                $bodyMessage = '<div class="chat-body-message-text">' . $db['message'] . '</div>
                                                <div class="chat-message-link-text">
                                                    <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="img-preview-body-chat" src="' . $db['message_link']['media_thumb'] . '" loading="lazy"/>
                                                    <div class="chat-message-link-info-title-link">
                                                        <div class="preview-lin-visible-message">
                                                            <a class="chat-message-link-info-title-link" target="_blank" href="' . $db['message_link']['cannonical_url'] . '"> ' . $db['message_link']['title'] . ' </a>
                                                            <a target="_blank" href="' . $db['message_link']['cannonical_url'] . '" class="chat-message-link-info-title-link-preview"> ' . $domainLinkPreview . ' </a>
                                                        </div>
                                                    </div>
                                                </div>
                                          ';
                            }
                        }
                        $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.REVOKE'):
                        $bodyMessage = '<div class="chat-body-message-revoke">Tin nhắn đã thu hồi</div>';
                        $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.REVOKE_PINNED'):
                        $userLastMessage = ($db['sender']['member_id'] === $user['id']) ? '<span class="event-message-content-name showmore underline">Bạn</span>' : '<span class="text-primary showmore-you underline-you"> ' . $db['sender']['full_name'] . '</span>';
                        $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="chat-body-message-item-pin-img" src="' . $domain . $db['sender']['avatar'] . '" alt="" />
                                        <div class="notify-message-block">
                                            <span class="notify-message-username">' . $userLastMessage . '</span>
                                            <span class="notify-message-text">đã bỏ ghim tin nhắn</span>
                                            <i class="event-message-content-info-icon icofont icofont-ban"></i>
                                        </div>';
                        $dataMessage .= $this->notificationLayoutMessage($bodyMessage);
                        break;
                    // case Config::get('constants.type.MessageTypeEnum.SHARE'):
                    //     $bodyMessage = 'Share chưa xử lý';
                    //     break;
                    case Config::get('constants.type.MessageTypeEnum.PINNED'):
                        $userLastMessage = ($db['sender']['member_id'] === $user['id']) ? '<span class="event-message-content-name showmore underline">Bạn</span>' : '<span class="text-primary showmore-you underline-you"> ' . $db['sender']['full_name'] . '</span>';
                        $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="chat-body-message-item-pin-img" src="' . $domain . $db['sender']['avatar'] . '" alt="" />
                                            <div class="notify-message-block">
                                                <span class="notify-message-username showmore underline">' . $userLastMessage . '</span>
                                                <span class="notify-message-text">đã ghim tin nhắn</span>
                                                <i class="event-message-content-info-icon typcn typcn-pin"></i>
                                            </div>';
                        $dataMessage .= $this->notificationLayoutMessage($bodyMessage);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.UPDATE_NAME'):
                        $userLastMessage = ($db['sender']['member_id'] === $user['id']) ? '<span class="event-message-content-name showmore underline">Bạn</span>' : '<span class="text-primary showmore-you underline-you"> ' . $db['sender']['full_name'] . '</span>';
                        $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="" src="' . $domain . $db['sender']['avatar'] . '" alt="" loading="lazy">
                                        <span class="notify-message-username text-report-body-visible-message showmore-you underline-you">' . $userLastMessage . '</span>
                                        <span class="notify-message-text">đã đổi tên nhóm</span>
                                        <span class="event-vote-message-content-name "> ' . $db['name'] . '</span>';
                        $dataMessage .= $this->notificationLayoutMessage($bodyMessage);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.UPDATE_AVATAR'):
                        $userLastMessage = ($db['sender']['member_id'] === $user['id']) ? '<span class="event-message-content-name showmore underline">Bạn</span>' : '<span class="text-primary showmore-you underline-you"> ' . $db['sender']['full_name'] . '</span>';
                        $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="" src="' . $domain . $db['sender']['avatar'] . '" alt="" loading="lazy">
                                        <span class="notify-message-username text-report-body-visible-message showmore-you underline-you">' . $userLastMessage . '</span>
                                        <span class="notify-message-text">đã đổi ảnh đại diện nhóm</span>
                                        <i class="event-message-content-info-icon fa fa-image"></i>';
                        $dataMessage .= $this->notificationLayoutMessage($bodyMessage);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.AUTHORIZE_MEMBER'):
//                        $userLastMessage = ($db['sender']['member_id'] === $user['id']) ? '<span class="event-message-content-name showmore underline">Bạn</span>' : '<span class="text-primary showmore-you underline-you"> ' . $db['sender']['full_name'] . '</span>';
                        $bodyMessage = '<span class="notify-message-text">' . $db['message'] . '</span></div>';
                        $dataMessage .= $this->notificationLayoutMessage($bodyMessage);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.ADD_USER'):
                        $addUser = ($db['list_member'][0]['member_id'] === $user['id']) ? 'Bạn' : $db['list_member'][0]['full_name'];
                        $reviewUserAdd = (count($db['list_member']) === 0) ? ('<span class="event-message-content-name-show showmore-you underline-you d-flex">' . $addUser . '</span>') : ('<span class="event-message-content-name-show showmore-you underline-you text-primary">' . $addUser . '</span> <span> và ' . count($db['list_member']) . ' người khác </span>');
                        $userLastMessage = ($db['sender']['member_id'] === $user['id']) ? '<span class="event-message-content-name showmore underline d-flex">Bạn</span>' : '<span class="text-primary showmore-you underline-you d-flex"> ' . $db['sender']['full_name'] . '</span>';
                        $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="" src="' . $domain . $db['sender']['avatar'] . '" alt="" loading="lazy">
                                        <div class="notify-message-block">
                                        <span class="notify-message-username">' . $userLastMessage . '</span>
                                        <span class="notify-message-text">đã thêm</span>
                                        <span class="notify-message-username ">' . $reviewUserAdd . '</span>
                                        <span class="notify-message-text">vào nhóm</span></div>';
                        $dataMessage .= $this->notificationLayoutMessage($bodyMessage);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.REMOVE_USER'):
                        $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="" src="' . $domain . $db['sender']['avatar'] . '" alt="" loading="lazy">
                                        <div class="notify-message-block">
                                        <span class="notify-message-username "><span class="text-primary showmore-you underline-you">' . $db['list_member'][0]['full_name'] . '</span></span>
                                        <span class="notify-message-text">đã bị mời rời khỏi nhóm</span></div>';
                        $dataMessage .= $this->notificationLayoutMessage($bodyMessage);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.LEAVE_GROUP'):
                        $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="" src="' . $domain . $db['sender']['avatar'] . '" alt="" loading="lazy">
                                        <span class="notify-message-username text-primary showmore-you underline-you">' . $db['list_member'][0]['full_name'] . '</span>
                                        <span class="notify-message-text">đã rời khỏi nhóm</span>';
                        $dataMessage .= $this->notificationLayoutMessage($bodyMessage);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.ORDER'):
                        $bodyMessage = '<div class="card-information-order-restaurant-supplier-message" style="width: 223px;height: 135px;margin: 0;">
                                                    <div class="css-translateX-card-order"></div>
                                                    <div class="left-information-order">
                                                        <i class="feather icon-shopping-cart" style="font-size: 33px;"></i>
                                                        <label class="label label-success" style="padding: 5px;margin: 0;position: absolute;width: max-content;bottom: 19px;left: 2px;"> Hoàn tất</label>
                                                    </div>
                                                    <div class="line-up-one"></div>
                                                    <div class="right-information-order">
                                                        <div class="content-infor">
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
                                                        <div class="line-card-order-footer pl-2">
                                                            <button class="buttun-action-card-order btn btn-grd-primary waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $db['message_order']['order_id'] . ')">Chi tiết</button>
                                                        </div>
                                                    </div>
                                                </div>';
                        $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.PHONE_CALL'):
                        $bodyMessage = '<div class="chat-body-message-text"><i class="fa fa-phone"></i> Cuộc gọi thoại</div>
                                        <button class="recall-message-button">Gọi lại</button>';
                        $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key);
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
                                                  <div class="div-vote" style="width: ' . ($this->rateDefaultTemplate(count($db['message_vote']['list_option'][0]['list_user']), count($db['message_vote']['list_option'][0]['list_user'])) * 100) . '%;">
                                                      <div class="content-vote"><span>' . $db['message_vote']['list_option'][0]['content'] . '</span></div>
                                                      <div class="count-vote">' . count($db['message_vote']['list_option'][0]['list_user']) . '</div>
                                                  </div>
                                             </div>
                                             <div class="item-vote">
                                                  <div class="div-vote" style="width: ' . ($this->rateDefaultTemplate(count($db['message_vote']['list_option'][1]['list_user']), count($db['message_vote']['list_option'][0]['list_user'])) * 100) . '%;">
                                                      <div class="content-vote"><span>' . $db['message_vote']['list_option'][1]['content'] . '</span></div>
                                                      <div class="count-vote">' . count($db['message_vote']['list_option'][1]['list_user']) . '</div>
                                                  </div>
                                             </div>
                                        </div>
                                        <span class="other-vote-message-vote ' . $classTextVote . '">' . $textVote . '</span>
                                        <div class="pin-details-content-item-bottom">
                                              <button class="button-message-vote" onclick="openModalDetailVoteVisibleMessage(' . $db['random_key'] . ')">Xem bình chọn</button>
                                        </div>';
                        $dataMessage .= $this->voteLayoutMessage($bodyMessage, $db);
                        break;
                    case Config::get('constants.type.MessageTypeEnum.MESSAGE_VOTE'):
                        if (mb_strlen($db['message_vote']['title']) > 50) $db['message_vote']['title'] = mb_substr($db['message_vote']['title'], 0, 47) . '...<i class="f-16 fa fa-comment-o text-inverse"></i>';
                        $bodyMessage = '<img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '"  class="" src="' . $domain . $db['sender']['avatar'] . '" alt="" loading="lazy">
                                        <span class="notify-message-username text-report-body-visible-message showmore-you underline-you">' . $db['sender']['full_name'] . '</span>
                                        <span class="notify-message-text">' . $db['message'] . '</span>
                                        <span class="event-vote-message-content-name" onclick="openModalDetailVoteVisibleMessage(' . $db['random_key_message_vote'] . ')">' . $db['message_vote']['title'] . '</span>';
                        $dataMessage .= $this->notificationLayoutMessage($bodyMessage, $db);
                        break;
                    default:
                        $bodyMessage = '<span data-type="'.$db['message_type'].'">Tin nhắn không xác định</span>';
                        $dataMessage .= $this->generalLayoutMessage($bodyMessage, $db, $config['data']['list'], $key);
                        break;
                };
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
            $dataMessage .= '<div class="chat-bubble d-none" id="typing-data-message-popup-message">
                                    <div class="typing">
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                    </div>
                                </div>';
            $config['time_X'] = microtime(true) - $timeX;
            return [$dataMessage, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function generalLayoutMessage($bodyMessage, $data, $list, $index)
    {
        $viewer = "";
        $user = Session::get(SESSION_JAVA_ACCOUNT);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $header = '';
        $marginItem = '';
        $marginBody = '';
        if ($data['sender']['member_id'] === $user['id']) {
            $class = 'message-right';
            $action = '<li class="chat-body-message-item-action-item item-action-revoke">
                           <i class="chat-body-message-item-action-icon ion-refresh"></i>
                       </li>
                       <li class="chat-body-message-item-action-item item-action-reply">
                            <i class="chat-body-message-item-action-icon ion-quote"></i>
                       </li>
                       <li class="chat-body-message-item-action-item item-action-pin">
                            <i class="chat-body-message-item-action-icon ion-pin"></i>
                       </li>';
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
                       </li>
                       <li class="chat-body-message-item-action-item item-action-pin">
                            <i class="chat-body-message-item-action-icon ion-pin"></i>
                       </li>';
            if ($index + 1 < count($list)) {
                if (($data['sender']['member_id'] !== $list[$index + 1]['sender']['member_id']) || !in_array($list[$index + 1]['message_type'], [
                        Config::get('constants.type.MessageTypeEnum.TEXT'),
                        Config::get('constants.type.MessageTypeEnum.IMAGE'),
                        Config::get('constants.type.MessageTypeEnum.FILE'),
                        Config::get('constants.type.MessageTypeEnum.STICKER'),
                        Config::get('constants.type.MessageTypeEnum.VIDEO'),
                        Config::get('constants.type.MessageTypeEnum.AUDIO'),
                        Config::get('constants.type.MessageTypeEnum.LINK'),
                        Config::get('constants.type.MessageTypeEnum.REPLY'),
                    ])) {
                    $header = '<span class="chat-body-message-element-name-text">' . $data['sender']['full_name'] . '</span>
                           <img onerror="imageDefaultOnLoadError($(this))" class="chat-body-message-element-avatar" src="' . $domain . $data['sender']['avatar'] . '"/>';
                } else {
                    $marginBody = 'margin-right-50px';
                    $marginItem = 'margin-item';
                }
            } else {
                $header = '<span class="chat-body-message-element-name-text">' . $data['sender']['full_name'] . '</span>
                           <img onerror="imageDefaultOnLoadError($(this))" class="chat-body-message-element-avatar" src="' . $domain . $data['sender']['avatar'] . '"/>';
            }
        }
        $time = $this->returnHourMinuteFromTimeTemplate($data['created_at']);
        $cancelReaction = '';
        $iconReaction = '<i class="chat-body-message-item-reactions-icon fa fa-thumbs-o-up"></i>';
        switch ($data['reactions']['my_reaction']) {
            case 0:
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
                ['item' => $data['reactions']['angry'], 'html' => '<img class="react-icon m-auto" src="/images/message/angry.gif" loading="lazy"/>'],
                ['item' => $data['reactions']['sad'], 'html' => '<img class="react-icon m-auto" src="/images/message/sad.gif" loading="lazy"/>'],
                ['item' => $data['reactions']['wow'], 'html' => '<img class="react-icon m-auto" src="/images/message/wow.gif" loading="lazy"/>'],
            ];
            $dataReaction = collect($dataReaction)->sortByDesc('item')->slice(0, 3)->where('item', '!==', 0)->toArray();
            $item = '';
            foreach ($dataReaction as $db) {
                $item .= $db['html'];
            }
            $countReaction = ($data['reactions']['reactions_count'] > 99) ? '99+' : $data['reactions']['reactions_count'];
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
        $footer = '';
        if (!in_array($data['message_type'], [Config::get('constants.type.MessageTypeEnum.REVOKE'), Config::get('constants.type.MessageTypeEnum.VIDEO_CALL'), Config::get('constants.type.MessageTypeEnum.PHONE_CALL')])) {
            $footer = '<div class="chat-body-message-footer">
                            <ul class="chat-body-message-item-action-list d-none">' . $action . '</ul>
                            <div class="chat-body-message-item-reactions">
                                <div class="chat-body-message-item-reactions-group reactions-group-icon">' . $iconReaction . '</div>
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
                            ' . $viewer . '
                            <div class="reacts-list-content">' . $reaction . '</div>
                            <span class="time-message-ago">' . $time . '</span>
                        </div>';
        }
        $backgroundColorIconLike = '';
        if(count($data['files']) == 1){
            if($data['files'][0]['name_file'] == 'icon_like') {
                $backgroundColorIconLike = 'background-color: #e2f1fa !important;';
            }
        }
        return '<div class="chat-body-message-element ' . $class . ' ' . $marginItem . '" id="' . $data['random_key'] . '" data-id="' . $data['_id'] . '" data-random-key="' . $data['random_key'] . '" data-type="' . $data['message_type'] . '" data-name="' . $data['sender']['full_name'] . '">
                    ' . $header . '
                    <div class="chat-body-message ' . $marginBody . '" style="'. $backgroundColorIconLike .'">
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
                    return '<div class="chat-body-message-image" data-number-img="'.count($data['files']).'">
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
                    return '<div class="chat-body-message-image" data-number-img="'.count($data['files']).'">
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
                    return '<div class="chat-body-message-image" data-number-img="'.count($data['files']).'">
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
                    return '<div class="chat-body-message-image" data-number-img="'.count($data['files']).'">
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
                    return '<div class="chat-body-message-image" data-number-img="'.count($data['files']).'">
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
                    return '<div class="chat-body-message-image" data-number-img="'.count($data['files']).'">
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

    public function notificationLayoutMessage($bodyMessage)
    {
        return '<div class="notify-message-container">
                    <div class="notify-message-content">
                        ' . $bodyMessage . '
                    </div>
                </div>';
    }

    public function replyMessageLayoutPopup($data, $text, $img, $class)
    {
        $imageClass = "";
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
                            <div class="chat-body-message-item-reply-info '.$imageClass.'">
                                <div class="chat-body-message-item-reply-name">
                                ' . $data['message_reply']['sender']['full_name'] . '
                                </div>
                                <div class="chat-body-message-item-reply-type">' . $text . '</div>
                            </div>
                        </div>
                    </a>
                    <div class="chat-body-message-item-reply-text">' . $data['message'] . '</div>';
    }

    public function convertMessageLinkPopup($message, $link){
        $message = '<a class="body-message-link" href="' . $message . '" target="_blank">' . $message . '</a>';
//        foreach ($link as $l) {
//            $message = str_replace($l, '<a class="body-message-link" href="' . $l . '" target="_blank">' . $l . '</a>', $message);
//        }
        return $message;
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

    public function dataConversationSupplierPopup(Request $request)
    {
        $keyword = $request->get('keyword');
        $page = $request->get('page');
        $limit = Config::get('constants.type.default.LIMIT_5');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.CHAT');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $convert_api = $this->convertApiTemplate(sprintf(API_MESSAGE_SUPPLIER_GET_CONVERSATION, $page, $limit, $keyword));
        $api = $convert_api[0];
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $conversation = '';
            if($config['data']['total_records'] ===0){
                $conversation = '<img class="conversation-supplier-empty" style="width: 350px;" src="\images\message\empty-message.png">';
            }
            $timeX = microtime(true);
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            foreach ($config['data']['list'] as $db) {
                $time = $this->formatFromTimeTemplate($db['create_time_mess_no_send']);
                if ($db['member']['number'] === 0) {
                    $countMessageNotSeen = '<p id="number-count-message-not-seen-' . $db['_id'] . '" class="badge text-center mr-2 d-none">0</p>';
                } else if ($db['member']['number'] < 100) {
                    $countMessageNotSeen = '<p id="number-count-message-not-seen-' . $db['_id'] . '" class="badge text-center mr-2">' . $db['member']['number'] . '</p>';
                } else {
                    $countMessageNotSeen = '<p id="number-count-message-not-seen-' . $db['_id'] . '" class="badge text-center mr-2">99+</p>';
                }
                if ($db['last_message'] !== '') {
//                    foreach ($db['list_tag_name'] as $tagName) {
//                        $db['last_message'] = str_replace($tagName['key_tag_name'], '<span class="tag-name">@' . $tagName['full_name'] . '</span>', $db['last_message']);
//                    }
                } else {
                    $db['last_message'] = 'Chưa có tin nhắn';
                }

                $conversation .= '
                <li class="message-header-item popup-message" data-type="' . $db['conversation_type'] . '" data-id="' . $db['_id'] . '" data-supplier="' . $db['supplier_id'] . '">
                    <div class="message-header-item-img">
                        <img onerror="this.onerror=null; this.src=' . "'" . Config::get('app.IMAGE_DEFAULT') . "'" . '" src="' . $domain . $db['avatar_supplier'] . '" data-src="' . $db['avatar_supplier'] . '" alt="">
                    </div>
                    <div class="message-header-item-info">
                        <div class="message-header-item-name">
                            <span>' . $db['supplier_name'] . '</span>
                            ' . $countMessageNotSeen . '
                        </div>
                        <div class="message-header-item-message">
                           '.$this->getTypeLastMessage($db).'
                        </div>
                        <div class="message-header-item-time-ago">' . $time . '</div>
                    </div>
                </li>';
            }
            $config['time_X'] = microtime(true) - $timeX;
            return [$conversation, $config];
        } catch (Exception $e) {
            $conversation = '<li class="item-conversation-visible-message box-user not-hover">
                                <img src="\images\message\list_error.png" alt="" class="image-list-error">
                            </li>';
            return [$conversation, $config];
        }
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
