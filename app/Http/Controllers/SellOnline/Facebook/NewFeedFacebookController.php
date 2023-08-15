<?php

namespace App\Http\Controllers\SellOnline\Facebook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class NewFeedFacebookController extends Controller
{
    public function index()
    {
        $active_nav = 'sell_online.facebook.feed';
        return view('sell_online.facebook.new_feed', compact('active_nav'));
    }

    public function getFeedPageSelected(Request $request)
    {
        $page_data = Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT);
        $id_page = $page_data['id'];
        $token_page = $page_data['access_token'];
        $data_feed_page = [
            'cover' => $page_data['cover'],
            'avatar' => $page_data['avatar'],
            'name' => $page_data['name'],
            'category' => $page_data['category']
        ];
        $filter = 'fields=icon,message,attachments,from,media,full_picture';
        $method = 'GET';
        $api = sprintf(API_FACEBOOK_GET_FEED_PAGE, $id_page, $filter, $token_page);
        $body = null;
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        $data_feed = $config['data'];
        $feed_data = '';
        for ($i = 0; $i < count($data_feed); $i++) {
            $media_feed = '';

            if (isset($data_feed[$i]['attachments']['data'][0]['media']['image']['src'])) {
                $media_feed = $data_feed[$i]['attachments']['data'][0]['media']['image']['src'];
            }
            $message_feed = '';
            if (isset($data_feed[$i]['message'])) {
                $message_feed = $data_feed[$i]['message'];
            }

            $filter = '';
            $method = 'GET';
            $api = sprintf(API_FACEBOOK_MESSAGE_GET_COMMENT_PAGE, $data_feed[$i]['id'], $filter, $token_page);
            $body = null;
            $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
            $comment = '';
            if($config['data'] !== 0){
                for($i = 0 ; $i < count($config['data']); $i++){
                    $comment = '<div class="col-lg-12" style="font-size:17px !important">
                                    <div class="d-flex align-items-center">
                                        <div class="col-lg-1 p-0">
                                            <img onerror="imageDefaultOnLoadError($(this))" src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/11-6-2021/image/original/1623389809419631.jpeg" alt="Avatar" class="avatar">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="chat-msg-text">hfdsjkhfjshfjkshjkshdjkhfjkdhshfdshjkfhjdshjfhkdhjk</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 sub-box-comment">
                                        <div class="col-lg-12 pb-3 pt-3 pl-5" style="font-size:17px !important">
                                            <div class="d-flex align-items-center">
                                                <div class="col-lg-1 mr-4 p-0 img_cont">
                                                    <img onerror="imageDefaultOnLoadError($(this))" src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/11-6-2021/image/original/1623389809419631.jpeg" alt="Avatar" class="avatar">
                                                </div>
                                                <div class="col-lg-11 border border-dark" style="border-radius: 18px;">
                                                    <input type="text" class="border-0 w-100 bg-transparent" style="font-size: 30px !important">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                }
            }

            $feed_data .= '<div class="card">
                                <div class="col-lg-12 ">
                                    <div class="d-flex mt-3 bd-highlight">
                                        <div class="img-user">
                                            <img onerror="imageDefaultOnLoadError($(this))" src="'. $data_feed_page['avatar'] .'" class="avatar avatar-xs rounded-circle">
                                        </div>
                                        <div class="image-avatar-news ml-3 mt-1">
                                            <span class="h4">'. $data_feed_page['name'] .'</span>
                                            <p>'. $data_feed_page['category'] .'</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 pb-3" style="font-size:17px !important">
                                    <p class="mt-2" style="font-size: 14px !important">'. $message_feed .'</p>
                                </div>
                                <div class="col-lg-12 pb-3" style="font-size:17px !important">
                                    <img onerror="imageDefaultOnLoadError($(this))" src="'. $media_feed  .'" class="img-fluid w-100" alt="Responsive image">
                                </div>
                                <div class="col-lg-12 pb-3" style="font-size:17px !important">
                                    <div class="d-flex">
                                        <div class="col-lg-4 ">
                                            <div class="h3">4.99302</div>
                                            <div>So nguoi tiep can duojc </div>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <div class="h3">4.99302</div>
                                            <div>So nguoi tiep can duojc </div>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <div class="h3">4.99302</div>
                                            <div>So nguoi tiep can duojc </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 border-bottom pb-3 pt-3" style="font-size:17px !important">
                                    <div class="d-flex">
                                        <div class="col-lg-6">
                                            <div>
                                                <i class="text-primary fa fa-american-sign-language-interpreting"></i>
                                                Ban va 20 nguoi khac
                                            </div>
                                        </div>
                                        <div class="col-lg-6 row">
                                            <div class="col-lg-6 ">
                                                <a href="">111 nguoi binh luan</a>
                                            </div>
                                            <div class="col-lg-6">
                                                <a href="">88 luot chia se</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 border-bottom pb-3 pt-3" style="font-size:17px !important">
                                    <div class="d-flex text-center">
                                        <div class="col-lg-4">
                                            <button type="button" class="btn btn-secondary w-100">Thich</button>
                                        </div>
                                        <div class="col-lg-4">
                                            <button type="button" class="btn btn-secondary w-100" onclick="showComment($(this))" >Binh luan</button>
                                        </div>
                                        <div class="col-lg-4">
                                            <button type="button" class="btn btn-secondary w-100">Chia se</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 border-bottom pb-3 pt-3" style="font-size:17px !important">
                                    <div class="f-right text-center">
                                        <div class="col-lg-12">
                                            <a href="">asdsadsad</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 border-bottom pb-3 pt-3" style="font-size:17px !important">
                                    <div class="d-flex align-items-center">
                                        <div class="col-lg-1 mr-4 img_cont">
                                            <img onerror="imageDefaultOnLoadError($(this))" src="http://beta.api.upload.techres.vn/public/resource/TMS/KAIZEN/1/29/1/2021/6/11-6-2021/image/original/1623389809419631.jpeg" alt="Avatar" class="avatar">
                                        </div>
                                        <div class="col-lg-10 border border-dark" style="border-radius: 18px;">
                                            <input type="text" class="border-0 w-100 bg-transparent" style="font-size: 30px !important">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 border-bottom pb-3 pt-3 box-list-comment">

                                </div>
                            </div>';
        }



        // API_GET_COMMENT_FANPAGE
        return [$data_feed_page, $feed_data, $config];
    }

    public function getTargetSenderPage(Request $request)
    {
        try {

            $user_data = Session::get(SESSION_KEY_SESSION_USER_FACEBOOK);
            $token = $user_data->token;
            $method = 'GET';
            $api = sprintf(API_FACEBOOK_GET_LIST_PAGES, $token);
            $body = null;
            $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
            return $data_user = [
                'name' => $config['first_name'] . ' ' . $config['last_name'],
                'avatar' => $config['profile_pic'],
                'id' => $config['id']
            ];
        } catch (\Exception $e) {
            return $data_user = [
                'name' => $user['name'],
                'avatar' => 'https://i1.sndcdn.com/avatars-000437232558-yuo0mv-t500x500.jpg',
                'id' => $user['id']];
        }
    }

    public function getSenderPage(Request $request)
    {
        $page_data = Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT);
        $id = $page_data['id'];
        $token_page = $page_data['access_token'];
        $client = $this->getClientFacebook();
        $fields = 'id%2Csenders%2Cunread_count%2Csnippet%2Cmessages%7Bfrom%2Cto%2Cmessage%2Ccreated_time%7D';
        $method = 'GET';
        $api = sprintf(API_FACEBOOK_MESSAGE_GET_CONVERSATIONS, $id, $fields, $token_page);
        $body = null;
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        $data_sender = $config['data'];
        for ($i = 0; $i < count($data_sender); $i++) {
            $id_conversation = $data_sender[$i]['id'];
            $user_sender = $data_sender[$i]['senders']['data'][0];
            $data = $this->getTargetSenderPage();
            $data_unread = '';
            if ($data_sender[$i]['unread_count'] > 0) {
                $data_unread = '<span class="badge bg-c-pink" style="margin-left: 10px;">' . $data_sender[$i]['unread_count'] . '</span>';
            }
            $arr[$i] = [
                'user' => $data,
                'id_conversation' => $id_conversation,
                'unread' => $data_unread,
                'last_messenger' => $data_sender[$i]['snippet'],
            ];
        }
        $data_sender_page = '';
        for ($i = 0; $i < count($arr); $i++) {
            $data_sender_page .= '<div class="media m-b-10 cursor-pointer sender-hover p-10" onclick="openChatPopupNewFeedFacebook(' . "'" . $arr[$i]['id_conversation'] . "'" . ',' . "'" . $arr[$i]['user']['name'] . "'" . ',' . "'" . $arr[$i]['user']['avatar'] . "'" . ')">
                                      <a class="media-left" href="#!">
                                           <img onerror="imageDefaultOnLoadError($(this))" class="media-object img-radius" src="' . $arr[$i]['user']['avatar'] . '" alt="Picture" data-toggle="tooltip" data-placement="top">
                                      </a>
                                      <div class="media-body">
                                           <div class="chat-header">' . $arr[$i]['user']['name'] . $arr[$i]['unread'] . '</div>
                                                <div class="text-muted social-designation">' . $arr[$i]['last_messenger'] . '</div>
                                           </div>
                                      </div>';
        }
        return [$data_sender_page, $config];
    }

    public function getMessengerPage(Request $request)
    {
        $page_data = Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT);
        $token_page = $page_data['access_token'];
        $id_conversation = $request->get('id');
        $avatar = $request->get('avatar');
        if (!isset($avatar)) {
            $avatar = 'https://i1.sndcdn.com/avatars-000437232558-yuo0mv-t500x500.jpg';
        }
        $fields = 'senders,messages{message,from,to,created_time}';
        $method = 'GET';
        $api = sprintf(API_MESSAGE_SUPPORT_GET_MESSAGE, $id_conversation, $fields, $token_page);
        $body = null;
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        $data = $config;
        $data_messenger_conversation = '';
        $array = array_reverse($data['messages']['data']);
        $check_from = '';
        $check_avatar = '';
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i]['from']['id'] === $page_data['id']) {
                if ($check_from === $array[$i]['from']['id']) {
                    $data_messenger_conversation .= '<div class="media">
                                                    <div class="media-body text-right" style="background: #90b1bc;padding: 5px;border-radius: 5px;min-height: 40px;">
                                                        <p style="font-size: 13px !important;">' . $array[$i]['message'] . '</p>
                                                    </div>
                                                    <div class="media-right friend-box">
                                                        <a href="#">
                                                            <img onerror="imageDefaultOnLoadError($(this))" class="media-object img-circle img-hidden" src="" alt="" >
                                                        </a>
                                                    </div>
                                                </div>';
                } else {
                    $data_messenger_conversation .= '<div class="media">
                                                    <div class="media-body text-right" style="background: #90b1bc;padding: 5px;border-radius: 5px;min-height: 40px;">
                                                        <p style="font-size: 13px !important;">' . $array[$i]['message'] . '</p>
                                                    </div>
                                                    <div class="media-right friend-box">
                                                        <a href="#">
                                                            <img onerror="imageDefaultOnLoadError($(this))" class="media-object img-circle" src="' . $page_data['avatar'] . '" alt="" >
                                                        </a>
                                                    </div>
                                                </div>';
                }
            } else {
                if ($check_avatar === $array[$i]['from']['id']) {
                    $data_messenger_conversation .= '<div class="media">
                                                    <div class="media-left friend-box po-left ">
                                                        <a href="#">
                                                         <img onerror="imageDefaultOnLoadError($(this))" class="media-object img-circle img-hidden" src="" alt="" >
                                                        </a>
                                                    </div>
                                                    <div class="media-body" style="background: #f2f2f2;padding: 5px;text-align: left;border-radius: 5px;min-height: 40px;">
                                                        <p style="font-size: 13px !important;">' . $array[$i]['message'] . '</p>
                                                    </div>
                                                </div>';
                } else {
                    $data_messenger_conversation .= '<div class="media">
                                                    <div class="media-left friend-box po-left">
                                                        <a href="#">
                                                            <img onerror="imageDefaultOnLoadError($(this))" class="media-object img-circle" src="' . $avatar . '" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="media-body" style="background: #f2f2f2;padding: 5px;text-align: left;border-radius: 5px;min-height: 40px;">
                                                        <p style="font-size: 13px !important;">' . $array[$i]['message'] . '</p>
                                                    </div>
                                                </div>';
                }
            }
            $check_from = $array[$i]['from']['id'];
            $check_avatar = $array[$i]['from']['id'];
        }
        return [$data_messenger_conversation, $config];
    }

    public function getMediaPage(Request $request)
    {
        $page_data = Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT);
        $token_page = $page_data['access_token'];
        $id = $page_data['id'];
        $fields = 'photos{images}';
        $method = 'GET';
        $api = sprintf(API_FACEBOOK_MESSAGE_GET_PHOTOS_PAGE, $id, $fields, $token_page);
        $body = null;
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        $data = $config['data'];
        $data_render = '';
        for ($i = 0; $i < count($data); $i++) {
            $photo = $data[$i]['photos']['data'];
            for ($j = 0; $j < count($photo); $j++) {
//            $data_render .= '<li class="col-md-4 col-lg-2 col-sm-6 col-xs-12">
//                                 <a href="' . $data[$i]['picture'] . '" data-toggle="lightbox" data-title="A random title"
//                                          data-footer="Text">
//                                     <img onerror="imageDefaultOnLoadError($(this))" src="' . $data[$i]['picture'] . '"  class="img-fluid" alt="">
//                                 </a>
//                             </li>';
                $data_render .= '<div class="col-sm-3 default-grid-item">
                                   <div class="masonry-media">
                                        <a class="media-middle" href="' . $photo[$j]['images'][0]['source'] . '" target="_blank">
                                             <img onerror="imageDefaultOnLoadError($(this))" class="img-fluid w-100" src="' . $photo[$j]['images'][count($photo[$j]['images']) - 1]['source'] . '" alt="masonary">
                                        </a>
                                   </div>
                              </div>';
            }

        }
        return [$data_render, $config];
    }
}
