<?php

namespace App\Http\Controllers\SellOnline\Facebook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class MessageFacebookController extends Controller
{
    public function index()
    {
        $active_nav = 'DASHBOARD FACEBOOK';
        return view('sell_online.facebook.connect.dashboard_facebook', compact('active_nav'));
    }

    public function page()
    {
        $page = Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT);
        $pageSelected = '<div class="list-avatars">
                              <div class="page-avatar"><img onerror="imageDefaultOnLoadError($(this))" src="' . $page[0]['picture']['data']['url'] . '" alt="avatar"></div>
                         </div>
                         <div class="info-page-selected text-ellipsis" data-id="' . $page[0]['id'] . '">' . $page[0]['name'] . '</div>';
        $pageData = '';
        foreach ($page as $db) {
            $pageData .= ' <div class="page-connected-item page-connected">
                                 <div class="page-avatar"><img onerror="imageDefaultOnLoadError($(this))" src="' . $db['picture']['data']['url'] . '" alt="avatar"></div>
                                 <div class="page-name"><span data-id="' . $db['id'] . '">' . $db['name'] . '</span></div>
                                 <div class="page-noti-new-interaction">
                                 <span>0</span></div>
                           </div>';
        }
        return [$pageSelected, $pageData, $page];
    }
    /** Get conversations facebook chat **/
    public function user(Request $request)
    {
        $id = $request->get('id');
        $token = Session::get(SESSION_KEY_CURRENT_PAGE_FACEBOOK_CONNECT)['access_token'];
        $fields = 'senders,can_reply,former_participants,id,is_subscribed,link,message_count,participants,scoped_thread_key,snippet,unread_count,updated_time,messages.limit(10){created_time,from,id,message,sticker,story,is_unsupported,tags,thread_id,to}';
        $method = 'GET';
        $api = sprintf(API_FACEBOOK_MESSAGE_GET_CONVERSATIONS, $id, $fields, $token);
        $body = null;
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        $collection = collect($config['data']);
        $message = $collection->pluck('messages')->all();
        try {
            $dataSenderPage = '';
            $notifyNumber = '';
            foreach ($config['data'] as $db) {
                if($db['unread_count'] === 0){
                    $notifyNumber = '<div class="notifycation pl-0 pr-0 d-none"><span>'.$db['unread_count'].'</span></div>';
                } else {
                    $notifyNumber = '<div class="notifycation pl-0 pr-0"><span>'.$db['unread_count'].'</span></div>';
                }
                if ($db['unread_count'] === 0){ $db['unread_count'] = ''; }
                $dataSenderPage .= '<li class="dashboard-facebook-conversation-filter-item" data-id="' . $db['id'] . '">
                                        <div class="border-checkbox-section border-checkbox-section-custom border-checkbox-section-custom-hide d-none">
                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                <input class="border-checkbox border-checkbox-input-member-facebook" type="checkbox" required="" />
                                                <label class="border-checkbox-label border-checkbox-label-member-facebook"></label>
                                            </div>
                                        </div>
                                        <div class="dashboard-facebook-conversation-filter-avatar">
                                            <img src="/images/tms/default.jpeg" alt="" class="dashboard-facebook-conversation-filter-main-img"/>
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/be/Facebook_Messenger_logo_2020.svg/1200px-Facebook_Messenger_logo_2020.svg.png" alt="" class="dashboard-facebook-conversation-filter-sub-img" />
                                        </div>
                                        <div class="dashboard-facebook-conversation-filter-time">'. $this->formatFromTimeTemplate($db['updated_time']) .'</div>
                                        <div class="dashboard-facebook-conversation-filter-info">
                                            <div class="dashboard-facebook-conversation-filter-name">
                                                <div class="dashboard-facebook-conversation-filter-name-text">' . $db['senders']['data'][0]['name'] . '</div>
                                            </div>
                                            <div class="dashboard-facebook-conversation-filter-message">
                                                <i class="fa fa-mail-reply"></i>
                                                <div class="dashboard-facebook-conversation-filter-message-main">
                                                    <span class="d-none">Techres:</span>
                                                    <p class="dashboard-facebook-conversation-message-snippet">'. $db['snippet'] .'</p>
                                                </div>
                                            </div>
                                            <div class="dashboard-facebook-conversation-filter-label d-none">
                                                <label for="">Trả lời tự động</label>
                                            </div>
                                            <div class="option">
                                                <div>
                                                    '.$notifyNumber.'
                                                </div>
                                            </div>
                                        </div>
                                    </li>';
            }
            return [$dataSenderPage, $message ,$config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function getPageSelected()
    {
        $page_data = Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT);
        $data_message_page = [
            'avatar' => $page_data['avatar'],
            'name' => $page_data['name']
        ];
        return [$data_message_page, $page_data];
    }

    public function getAllPageReturn(Request $request)
    {
        $user_data = Session::get(SESSION_KEY_SESSION_USER_FACEBOOK);
        $token = $user_data->token;
        $method = 'GET';
        $api = sprintf(API_FACEBOOK_GET_LIST_PAGES, $token);
        $body = null;
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        $page = $config['data'];
        $data_server_side = '';
        for ($i = 0; $i < count($page); $i++) {
            $id = $page[$i]['id'];
            $fields = 'picture.type(large)';
            $api = sprintf(API_FACEBOOK_GET_IMG_PAGE, $id, $fields, $token);
            $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
            $img[$i] = $config;
            $data_server_side .= '<div class="row p-3">
                    <div id="avatar-pages" class="col-sm-2">
                        <img onerror="imageDefaultOnLoadError($(this))" class="media-object img-radius img-60" src="' . $img[$i]['picture']['data']['url'] . '">
                    </div>
                    <div class="col-sm-7">
                        <div id="name-page" class="row"><a class="float-left font-weight-bold font-18">' . $page[$i]['name'] . ' </a></div>
                        <div id="category-page" class="row"><span class="float-left">' . $page[$i]['category'] . '</span>
                    </div></div>
                    <div class="col-sm-3 m-auto">
                        <button class="btn btn-primary m-auto" onclick="selectPageConnect(' . $page[$i]['id'] . ')">Kết Nối</button>
                    </div></div>';
        }
        return [$data_server_side, $config];
    }

    /** Push token page  **/
    public function selectPageConnect(Request $request)
    {
        $id = $request->get('id');
        $user_data = Session::get(SESSION_KEY_SESSION_USER_FACEBOOK);
        $token = $user_data->token;
        $method = 'GET';
        $api = sprintf(API_FACEBOOK_GET_LIST_PAGES, $token);
        $body = null;
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        $page = $config['data'];
        for ($i = 0; $i < count($page); $i++) {
            if ($page[$i]['id'] == $id) {
                $page2 = $page[$i];
                $id = $page[$i]['id'];
                $fields = 'picture.type(large)';
                $api = sprintf(API_FACEBOOK_GET_IMG_PAGE, $id, $fields, $token);
                $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
                $img = $config;
                $page2['avatar'] = $img['picture']['data']['url'];
                Session::put(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT, $page2);
            }
        }
        return [$page2, $config];
    }

    /** Get message page **/
    public function getSenderPage(Request $request)
    {
        $page_data = Session::get(SESSION_KEY_CURRENT_PAGE_FACEBOOK_CONNECT);
        $id = $page_data['id'];
        $token_page = $page_data['access_token'];
        $fields = 'can_reply,senders,unread_count,updated_time,snippet,message_count';
        $method = 'GET';
        $api = sprintf(API_FACEBOOK_MESSAGE_GET_CONVERSATIONS, $id, $fields, $token_page);
        $body = null;
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        try {
            $data_sender = $config['data'];
            $dataSenderPage = '';
            $data_profile = '';
            for ($i = 0; $i < count($data_sender); $i++) {
                $isMessageCount = ($data_sender[$i]['unread_count'] != '0') ? 'd-flex conversation-item conversation-unread ' : "d-flex conversation-item ";
                $isCountMessage = ($data_sender[$i]['unread_count'] != '0') ? '<span class="position-absolute unread-count">' . $data_sender[$i]['unread_count'] . '</span>' : '';
                $isTypeUnRead = ($data_sender[$i]['unread_count'] != '0') ? 'data-type-unread="1"' : 'data-type-unread="0"';
                // $date = new DateTime($data_sender[$i]['updated_time'], new DateTimeZone('Asia/Ho_Chi_Minh'));
                // $update_time = date
                // $url_image = $this->getTargetSenderPage($request,$token_page,$data_sender[$i]['senders']['data']['0']['id']);
                $dataSenderPage .= '<div class="' . $isMessageCount . '" onclick="" data-id="' . $data_sender[$i]['senders']['data'][0]['id'] . '"  data-name-user="' . $data_sender[$i]['senders']['data'][0]['name'] . '" ' . $isTypeUnRead . ' data-can-reply="' . (int)$data_sender[$i]['can_reply'] . '">
                                        <input type="text" class="d-none" value="' . $data_sender[$i]['id'] . '" >
                                        <div class="position-relative conversation-item-avatar">
                                            <img onerror="imageDefaultOnLoadError($(this))" src="https://graph.facebook.com/5201141863236625/picture?access_token=EAAZAZALTbNShQBAAZBdO6gBWge4h7ZAZC4qCtwEM7RjgBLKxzWZCbWs1bE80le3mqLN4PuFauKvYXsRwo19Qgd7waE0EnGr6hYuIvClHS1bCHYKZCKHnKCJo1nDl8x67mkwv8IhpkNIQcRtbQtMwrPorZCjQLYfbmd2571CthZCMVbkZArEIHYGbbmjwXLOexUoggYecAYsOVZC3QZDZD" class="img-uploaded" style="animation: 0s ease-in-out 0s 0 normal none running bounceIn;">
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <ellipse cx="9.49996" cy="9.77172" rx="7.32857" ry="5.97143" fill="white"></ellipse>
                                                <path d="M9.52107 0C4.15702 0 0 3.92048 0 9.21585C0 11.9856 1.13808 14.3791 2.99058 16.0325C3.31044 16.3201 3.24456 16.4868 3.29895 18.2631C3.30323 18.3876 3.33789 18.5091 3.39991 18.617C3.46192 18.725 3.54941 18.8161 3.65473 18.8825C3.76005 18.9489 3.88002 18.9885 4.00416 18.9978C4.1283 19.0072 4.25285 18.9861 4.36694 18.9362C6.39373 18.0436 6.41978 17.9732 6.76339 18.0666C12.6354 19.6829 19 15.9248 19 9.21585C19 3.92048 14.8855 0 9.52107 0ZM15.2379 7.09204L12.4416 11.5193C12.336 11.6858 12.1971 11.8287 12.0337 11.939C11.8703 12.0493 11.6859 12.1247 11.492 12.1604C11.2982 12.1961 11.099 12.1914 10.907 12.1465C10.7151 12.1017 10.5344 12.0177 10.3765 11.8997L8.15161 10.2345C8.05215 10.1599 7.93118 10.1195 7.80686 10.1195C7.68253 10.1195 7.56156 10.1599 7.4621 10.2345L4.46002 12.5115C4.05933 12.8153 3.53454 12.3353 3.8046 11.9112L6.60097 7.48393C6.70653 7.31741 6.84535 7.17449 7.00874 7.06414C7.17213 6.9538 7.35655 6.8784 7.55044 6.84269C7.74434 6.80697 7.94352 6.8117 8.1355 6.85659C8.32747 6.90147 8.50811 6.98555 8.66607 7.10353L10.8901 8.76841C10.9896 8.84301 11.1106 8.88334 11.2349 8.88334C11.3592 8.88334 11.4802 8.84301 11.5797 8.76841L14.5833 6.49366C14.9832 6.18796 15.508 6.66758 15.2379 7.09204Z" fill="#1877F2"></path>
                                            </svg>
                                            ' . $isCountMessage . '
                                        </div>
                                        <div class="d-flex item-wrapper">
                                            <div class="conversation-item-content">
                                                <div class="d-flex"><span class="sender">' . $data_sender[$i]['senders']['data'][0]['name'] . '</span></div>
                                                <div class="conversation-content"><span><span>' . $data_sender[$i]['snippet'] . '</span></span></div>
                                            </div>
                                        <div class="conversation-item-meta">
                                            <div class="d-flex conversation-meta-first-row"><span class="conversation-time-stamp"></span><span></span></div>
                                            <div class="d-flex justify-content-end conversation-item-second-row"></div>
                                        </div>
                                        <div class="flex-wrap item-info"></div>
                                        </div>
                                    </div>';
            }
            return [$dataSenderPage, $data_profile];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function getMessengerPage(Request $request)
    {
        $message_page_data = Session::get(SESSION_KEY_CURRENT_PAGE_FACEBOOK_CONNECT);
        $token_page = $message_page_data['access_token'];
        $id_conversation = $request->get('id');
        $avatar = $request->get('avatar');
        if (!isset($avatar)) {
            $avatar = 'https://i1.sndcdn.com/avatars-000437232558-yuo0mv-t500x500.jpg';
        }
        $fields = 'senders{name},messages{message,from,to,created_time}';
        $method = 'GET';
        $api = sprintf(API_MESSAGE_SUPPORT_GET_MESSAGE, $id_conversation, $fields, $token_page);
        $body = null;
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        $senders = $config['senders']['data'];
        $data_message = $config;
        try {
            $array = $data_message['messages']['data'];
            $check_avatar = '';
            $data_messenger_conversation = '';
            for ($i = 0; $i < count($array); $i++) {
                if ($array[$i]['from']['id'] === $message_page_data['id']) {

                    $data_messenger_conversation .= '<div class="chat-body-message-element message-right">
                                                        <div class="chat-body-message">
                                                            <div class="chat-body-message-text">' . $array[$i]['message'] . '</div>
                                                            <div class="chat-body-message-footer">
                                                                <ul class="chat-body-message-item-action-list d-none">
                                                                    <li class="chat-body-message-item-action-item item-action-revoke">
                                                                        <i class="chat-body-message-item-action-icon ion-refresh"></i>
                                                                    </li>
                                                                    <li class="chat-body-message-item-action-item item-action-reply">
                                                                        <i class="chat-body-message-item-action-icon ion-quote"></i>
                                                                    </li>
                                                                    <li class="chat-body-message-item-action-item item-action-pin">
                                                                        <i class="chat-body-message-item-action-icon ion-pin"></i>
                                                                    </li>
                                                                </ul>
                                                                <div class="chat-body-message-status-send d-none">
                                                                    <i class="chat-body-message-sending-icon fa fa-check-circle-o"></i>
                                                                    <i class="chat-body-message-send-icon fa fa-check-circle d-none"></i>
                                                                </div>
                                                                <div class="reacts-list-content">
                                                                    <div class="reacts-list d-none">
                                                                        <div class="react-icon-list" data-love="0" data-smile="0" data-like="0" data-angry="0" data-sad="0" data-wow="0"></div>
                                                                        <div class="total-reacts">0</div>
                                                                    </div>
                                                                </div>
                                                                <span class="time-message-ago">' .  date_format(date_create($array[$i]['created_time']), 'H:i') . '</span>
                                                            </div>
                                                        </div>
                                                    </div>';
                } else {
                    $data_messenger_conversation .= '<div class="chat-body-message-element message-left">
                                                        <div class="chat-body-message">
                                                            <div class="chat-body-message-text">' . $array[$i]['message'] . '</div>
                                                            <div class="chat-body-message-footer">
                                                                <ul class="chat-body-message-item-action-list d-none">
                                                                    <li class="chat-body-message-item-action-item item-action-revoke">
                                                                        <i class="chat-body-message-item-action-icon ion-refresh"></i>
                                                                    </li>
                                                                    <li class="chat-body-message-item-action-item item-action-reply">
                                                                        <i class="chat-body-message-item-action-icon ion-quote"></i>
                                                                    </li>
                                                                    <li class="chat-body-message-item-action-item item-action-pin">
                                                                        <i class="chat-body-message-item-action-icon ion-pin"></i>
                                                                    </li>
                                                                </ul>
                                                                <div class="chat-body-message-status-send d-none">
                                                                    <i class="chat-body-message-sending-icon fa fa-check-circle-o"></i>
                                                                    <i class="chat-body-message-send-icon fa fa-check-circle d-none"></i>
                                                                </div>
                                                                <div class="reacts-list-content">
                                                                    <div class="reacts-list d-none">
                                                                        <div class="react-icon-list" data-love="0" data-smile="0" data-like="0" data-angry="0" data-sad="0" data-wow="0"></div>
                                                                        <div class="total-reacts">0</div>
                                                                    </div>
                                                                </div>
                                                                <span class="time-message-ago">' .  date_format(date_create($array[$i]['created_time']), 'H:i') . '</span>
                                                            </div>
                                                        </div>
                                                    </div>';
                }
            }
            $data_messenger_conversation .= '   <div class="message-time align-items-center justify-content-center text-center">16/7/2021</div>
                                                <div class="d-flex align-items-center justify-content-center load-more">
                                                    <div class="btn-load-more-facebook">
                                                        <span>
                                                            <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6.73412 12.4631L10.0066 15.7355L13.279 12.4631" stroke="#0089FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M10.0066 8.37253V15.7355" stroke="#0089FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M17.2714 13.3548C17.9826 12.8547 18.516 12.1409 18.7941 11.317C19.0722 10.4932 19.0806 9.60216 18.8179 8.77326C18.5553 7.94436 18.0354 7.2207 17.3336 6.70732C16.6318 6.19393 15.7847 5.91752 14.9152 5.9182H13.8844C13.6383 4.95927 13.178 4.06865 12.5379 3.3134C11.8978 2.55814 11.0948 1.95794 10.1892 1.55796C9.28357 1.15798 8.29903 0.968649 7.30967 1.00423C6.32032 1.03981 5.35192 1.29937 4.4774 1.76336C3.60287 2.22736 2.845 2.8837 2.26083 3.68298C1.67667 4.48226 1.28144 5.40364 1.1049 6.37777C0.928363 7.3519 0.97511 8.35338 1.24163 9.30683C1.50814 10.2603 1.98748 11.1408 2.64356 11.8822" stroke="#0089FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                            Tải thêm tin nhắn từ Facebook
                                                    </div>
                                                </div>';
            return [$data_messenger_conversation, $senders, $config];
        } catch (Exception $e) {
            return [$e, $config];
        }
    }

    public function getPostPage(Request $request){
        $message_page_data = Session::get(SESSION_KEY_CURRENT_PAGE_FACEBOOK_CONNECT);
        $token_page = $message_page_data['access_token'];
        $id_conversation = $request->get('id');
        $avatar = $request->get('avatar');
        if (!isset($avatar)) {
            $avatar = 'https://i1.sndcdn.com/avatars-000437232558-yuo0mv-t500x500.jpg';
        }
        $fields = 'posts{comments,message}';
        $method = 'GET';
        $api = sprintf(API_MESSAGE_SUPPORT_GET_MESSAGE, $id_conversation, $fields, $token_page);
        $body = null;
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        try {
            $data_sender = $config['posts']['data'];
            $dataSenderPage = '';
            for ($i = 0; $i < count($data_sender); $i++) {
                $dataSenderPage .= '<li class="dashboard-facebook-conversation-filter-item" onclick="selectPostDetailConnect($(this))">
<div class="d-flex conversation-item-posts" onclick="selectPostDetailConnect($(this))"  data-type-unread="0" data-can-reply="">
                                        <input type="text" class="d-none" value="" >
                                        <div class="position-relative conversation-item-avatar">
                                            <img src="https://graph.facebook.com/5201141863236625/picture?access_token=EAAZAZALTbNShQBAAZBdO6gBWge4h7ZAZC4qCtwEM7RjgBLKxzWZCbWs1bE80le3mqLN4PuFauKvYXsRwo19Qgd7waE0EnGr6hYuIvClHS1bCHYKZCKHnKCJo1nDl8x67mkwv8IhpkNIQcRtbQtMwrPorZCjQLYfbmd2571CthZCMVbkZArEIHYGbbmjwXLOexUoggYecAYsOVZC3QZDZD" class="img-uploaded" style="animation: 0s ease-in-out 0s 0 normal none running bounceIn;">
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <ellipse cx="9.49996" cy="9.77172" rx="7.32857" ry="5.97143" fill="white"></ellipse>
                                                <path d="M9.52107 0C4.15702 0 0 3.92048 0 9.21585C0 11.9856 1.13808 14.3791 2.99058 16.0325C3.31044 16.3201 3.24456 16.4868 3.29895 18.2631C3.30323 18.3876 3.33789 18.5091 3.39991 18.617C3.46192 18.725 3.54941 18.8161 3.65473 18.8825C3.76005 18.9489 3.88002 18.9885 4.00416 18.9978C4.1283 19.0072 4.25285 18.9861 4.36694 18.9362C6.39373 18.0436 6.41978 17.9732 6.76339 18.0666C12.6354 19.6829 19 15.9248 19 9.21585C19 3.92048 14.8855 0 9.52107 0ZM15.2379 7.09204L12.4416 11.5193C12.336 11.6858 12.1971 11.8287 12.0337 11.939C11.8703 12.0493 11.6859 12.1247 11.492 12.1604C11.2982 12.1961 11.099 12.1914 10.907 12.1465C10.7151 12.1017 10.5344 12.0177 10.3765 11.8997L8.15161 10.2345C8.05215 10.1599 7.93118 10.1195 7.80686 10.1195C7.68253 10.1195 7.56156 10.1599 7.4621 10.2345L4.46002 12.5115C4.05933 12.8153 3.53454 12.3353 3.8046 11.9112L6.60097 7.48393C6.70653 7.31741 6.84535 7.17449 7.00874 7.06414C7.17213 6.9538 7.35655 6.8784 7.55044 6.84269C7.74434 6.80697 7.94352 6.8117 8.1355 6.85659C8.32747 6.90147 8.50811 6.98555 8.66607 7.10353L10.8901 8.76841C10.9896 8.84301 11.1106 8.88334 11.2349 8.88334C11.3592 8.88334 11.4802 8.84301 11.5797 8.76841L14.5833 6.49366C14.9832 6.18796 15.508 6.66758 15.2379 7.09204Z" fill="#1877F2"></path>
                                            </svg>
                                        </div>
                                        <div class="d-flex item-wrapper" style="width: 213px;">
                                            <div class="conversation-item-content">
                                                <div class="d-flex facebook-body-chat-list-comment-user"><span class="sender">Người dùng Facebook</span></div>
                                                <div class="conversation-content"><span id="conversation-content-id">' . $data_sender[$i]['message'] . '</span></div>
                                            </div>
                                        <div class="conversation-item-meta">
                                            <div class="d-flex conversation-meta-first-row"><span class="conversation-time-stamp"></span><span></span></div>
                                            <div class="d-flex justify-content-end conversation-item-second-row"></div>
                                        </div>
                                        <div class="flex-wrap item-info"></div>
                                        </div>
                                    </div>
                                    </li>';
            }
            return [$dataSenderPage, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function getTargetSenderPage($request, $token, $id)
    {
        try {
            $method = 'GET';
            $api = sprintf(API_FACEBOOK_GET_IMG_PAGE, $id, $token);
            $body = null;
            $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
            return $config['id'];
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function sendMessage(Request $request)
    {
        $id = $request->get('id');
        $message = $request->get('message');
        $user_data = Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT);
        $token = $user_data[0]['access_token'];
        $method = 'POST';
        $api = sprintf(API_FACEBOOK_MESSAGE_POST_SEND_MESSAGE, $token);
        $body = [
            "messaging_type" => "RESPONSE",
            "recipient" => [
                "id" => $id
            ],
            "message" => [
                "text" => $message
            ],
        ];
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        return $config;
    }

    public function typingOn(Request $request)
    {
        $id = $request->get('id');
        $user_data = Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT);
        $token = $user_data[0]['access_token'];
        $method = 'POST';
        $api = sprintf(API_FACEBOOK_MESSAGE_POST_SEND_MESSAGE, $token);
        $body = [
            "recipient" => [
                "id" => $id
            ],
            "sender_action" => "typing_on"
        ];
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        return $config;
    }

    public function getListBooking(Request $request) {
        $branch = $request->get('branch');
        $phone = $request->get('phone');
        $type = $request->get('type');
        $from = $request->get('from');
        $to = $request->get('to');
        $month = $request->get('month');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $is_just_take_having_deposit = (int)Config::get('constants.type.checkbox.GET_ALL');
        $is_just_take_waiting_confirm_deposit = (int)Config::get('constants.type.checkbox.GET_ALL');
        $is_get_all = Config::get('constants.type.checkbox.SELECTED');
        switch ($type) {
            case '1':
                $from = date('d/m/Y');
                $to = date('d/m/Y');
                break;
            case '2':
                $from = date("d/m/Y", strtotime('last Monday'));
                $to = date("d/m/Y", strtotime('next Sunday'));
                break;
            case '3':
                $from = '01/' . $month;
                $cd = date("d/m/Y", strtotime($from));
                $to = date("t/m/Y", strtotime($cd));
                break;
            case '4':
                break;
        }
        $status = Config::get('constants.type.BookingStatusEnum.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_BOOKING_GET_LIST_TABLE, $branch, $from, $to, $status, $is_just_take_having_deposit, $is_just_take_waiting_confirm_deposit, $limit, $page, $is_get_all);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $waiting = $collection->where('customer_phone', $phone)
            ->where('booking_status', Config::get('constants.type.BookingStatusEnum.WAITING_CONFIRM'))->all();
            $preparing = $collection->where('customer_phone', $phone)
            ->where('booking_status', Config::get('constants.type.BookingStatusEnum.PREPARING'))->all();
            $waitingComplete = $collection->where('customer_phone', $phone)
            ->where('booking_status', Config::get('constants.type.BookingStatusEnum.WAITING_COMPLETE'))->all();
            $confirm = $collection->where('customer_phone', $phone)
            ->where('booking_status', Config::get('constants.type.BookingStatusEnum.CONFIMED'))->all();
            $setup = $collection->where('customer_phone', $phone)
            ->where('booking_status', Config::get('constants.type.BookingStatusEnum.SET_UP'))->all();
            $completeData = $collection->where('customer_phone', $phone)
            ->where('booking_status', Config::get('constants.type.BookingStatusEnum.COMPLETED'))->all();
            $cancel = $collection->where('customer_phone', $phone)
            ->where('booking_status', Config::get('constants.type.BookingStatusEnum.CANCEL'))->all();
            $expired = $collection->where('customer_phone', $phone)
            ->where('booking_status', Config::get('constants.type.BookingStatusEnum.EXPIRED'))->all();
            $waitingData = array_merge($waiting, $preparing, $waitingComplete, $confirm, $setup);
            $cancelData = array_merge($cancel, $expired);
            $cardBooking = $this->filterDataStatus($waitingData);
            $completeBooking = $this->filterDataStatus($completeData);
            $cancelBooking = $this->filterDataStatus($cancelData);
            return [$cardBooking, $completeBooking, $cancelBooking];
        } catch (Exception $e) {
            $this->catchTemplate($config, $e);
        }
    }

    public function textStatusBooking($value) {
        switch ($value['booking_status']){
            case (int)Config::get('constants.type.BookingStatusEnum.COMPLETED'):
                $textBooking = TEXT_DONE;
                $classLabelStatusBooking = 'label-success';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.CANCEL'):
                $textBooking = TEXT_CANCELED;
                $classLabelStatusBooking = 'label-danger';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.EXPIRED'):
                $textBooking = TEXT_EXPIRED;
                $classLabelStatusBooking = 'label-inverse';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.WAITING_CONFIRM'):
                if ($value['deposit_amount'] != Config::get('constants.type.checkbox.DIS_SELECTED') && $value['is_deposit_confirmed'] != Config::get('constants.type.checkbox.SELECTED')) {
                    $textBooking = TEXT_WAITING_SCHEDULE;
                    $classLabelStatusBooking = 'label-danger';
                } else {
                    $textBooking = TEXT_WAITING;
                    $classLabelStatusBooking = 'label-warning';
                }
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.PREPARING'):
                $textBooking = TEXT_PREPARING;
                $classLabelStatusBooking = 'label-primary';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.WAITING_COMPLETE'):
                $textBooking = TEXT_WAITING_COMPLETE;
                $classLabelStatusBooking = 'label-success';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.CONFIMED'):
                $textBooking = TEXT_CONFINED;
                $classLabelStatusBooking = 'label-info';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.SET_UP'):
                $textBooking = TEXT_WAITING_SET_UP;
                $classLabelStatusBooking = 'label-primary';
                break;
            case (int)Config::get('constants.type.BookingStatusEnum.CANCEL'):
                $textBooking = TEXT_CANCELED_TEXT;
                $classLabelStatusBooking = 'label-primary';
                break;
            default:
                $textBooking = TEXT_UNKNOWN;
                $classLabelStatusBooking = 'label-inverse';
                break;
        }
        return '<label class="label '.$classLabelStatusBooking.'">'.$textBooking.'</label>';
    }

    public function getOrderMessageFacebook(Request $request) {
        $phone = $request->get('phone');
        $fromdate=  date('d/m/Y');
        $todate = date('d/m/Y');
        $branch = (int)Config::get('constants.type.checkbox.GET_ALL');
        $is_just_take_having_deposit = (int)Config::get('constants.type.checkbox.GET_ALL');
        $is_just_take_waiting_confirm_deposit = (int)Config::get('constants.type.checkbox.GET_ALL');
        $is_get_all = Config::get('constants.type.checkbox.SELECTED');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $status = Config::get('constants.type.BookingStatusEnum.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_BOOKING_GET_LIST_TABLE_MES, $branch, $fromdate, $todate, $status, $is_just_take_having_deposit, $is_just_take_waiting_confirm_deposit, $is_get_all, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $customer_phone = $collection->where('customer_phone', $phone)->first();
            $cardBookingss = $this->filterDataStatusMes($collection->where('customer_phone', $phone));
            return [$cardBookingss];
        } catch (Exception $e) {
            $this->catchTemplate($config, $e);
        }
    }
    public function filterDataStatusMes($values) {
        $cardBookingss = '';
        foreach ($values as $key => $value) {
            $cardBookingss .= '<div class="cart-booking-item-about">
                                    <div class="cart-booking-item-about-contain pointer" onclick="openModalDetailBookingTableManage('.$value['id'].')">
                                        <div class="cart-booking-item-about-header d-flex justify-content-between align-items-center">
                                            <div class="cart-booking-item-about-header-name">'.$value['customer_name'].'</div>
                                            <div class="cart-booking-item-about-header-status waiting-confirm">
                                                '.$this->textStatusBooking($value).'
                                            </div>
                                        </div>

                                        <div class="cart-booking-item-about-body">
                                            <div class="cart-booking-item-about-info d-flex justify-content-between align-items-center">
                                                <div class="cart-booking-item-about-phone">'.$value['customer_phone'].'</div>
                                                <div class="cart-booking-item-about-date">'.$value['booking_time'].'</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="cart-booking-item-create-title">Người tạo:</span>
                                                <span class="cart-booking-item-title">'.$value['employee_create']['name'].'</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="cart-booking-item-create-title">Tiền cọc:</span>
                                                <span class="cart-booking-item-title">'.$this->numberFormat($value['deposit_amount']).'</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="cart-booking-item-create-title">Số người:</span>
                                                <span class="cart-booking-item-title">'.$value['number_slot'].'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
        }
        return $cardBookingss;
    }

    public function filterDataStatus($values) {
        $cardBooking = '';
        foreach ($values as $key => $value) {
            $cardBooking .= '<div class="cart-booking-item-about">
                                    <div class="cart-booking-item-about-contain pointer" onclick="openModalDetailBookingTableManage('.$value['id'].')">
                                        <div class="cart-booking-item-about-header d-flex justify-content-between align-items-center">
                                            <div class="cart-booking-item-about-header-name">'.$value['customer_name'].'</div>
                                            <div class="cart-booking-item-about-header-status waiting-confirm">
                                                '.$this->textStatusBooking($value).'
                                            </div>
                                        </div>
                                        <div class="cart-booking-item-about-body">
                                            <div class="cart-booking-item-about-info d-flex justify-content-between align-items-center">
                                                <div class="cart-booking-item-about-phone">'.$value['customer_phone'].'</div>
                                                <div class="cart-booking-item-about-date">'.$value['booking_time'].'</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="cart-booking-item-create-title">Người tạo:</span>
                                                <span class="cart-booking-item-title">'.$value['employee_create']['name'].'</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="cart-booking-item-create-title">Tiền cọc:</span>
                                                <span class="cart-booking-item-title">'.$this->numberFormat($value['deposit_amount']).'</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="cart-booking-item-create-title">Số người:</span>
                                                <span class="cart-booking-item-title">'.$value['number_slot'].'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
        }
        return $cardBooking;
    }

}
