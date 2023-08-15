<?php

namespace App\Http\Controllers\Layout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class NotifyHeaderController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = '';
        return view('notify.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $page = $request->get('page');
        $limit = $request->get('limit');
        $type = $request->get('type');
        $from = $request->get('from');
        $to = $request->get('to');
        $isRead = $request->get('status');
        $key = $request->get('keysearch');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.LOGS');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_NOTIFY_GET_LIST_VIEW, $page, $limit, $type, $from, $to, $isRead, $key);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $view = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            foreach ($config['data']['list'] as $db) {
                if ($db['is_read'] === Config::get('constants.type.checkbox.SELECTED')) {
                    $isRead = '';
                    $classRead = '';
                } else {
                    $isRead = '<div class="label-main"><label class="label bg-success">Mới</label></div>';
                    $classRead = 'style="background-color: #f2f2f2"';
                }
                switch ($db['type']) {
                    case Config::get('constants.type.NotificationTypeEnum.ACCOUNT'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-user"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.TASK'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-wpforms"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.NEWS'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-newspaper-o"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.CHAT'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-commenting-o"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.GROUP_CHAT'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-comments-o"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.LEAVE_FORM'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-mail-reply"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.BIRTHDAY'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-birthday-cake"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.ANNOUNCEMENT'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-bell"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.KAIZEN'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-certificate"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.CUSTOMER_POINT'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-venus-double"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.SALARY_TABLE'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-credit-card"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.SALARY_ADDITION'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-retweet"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.ADVANCED_SALARY_REQUEST'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-money"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.BOOKING'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-info-circle"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.ORDER'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-plus-square"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.ADVERT'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-television"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.SUPPLIER_ORDER_REQUEST'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-location-arrow"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.SUPPLIER_RESTAURANT_DEBT_PAYMENT_REQUEST'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-bell-o"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.SUPPLIER_ORDER'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-cart-plus"></i>';
                        break;
                    case Config::get('constants.type.NotificationTypeEnum.TARGET'):
                        $icon = '<i style="color: #0c5460; margin-right: 10px" class="fa fa-2x fa-bar-chart-o"></i>';
                        break;
                    default:
                        $icon = '';
                }
                $view .= ' <div class="job-cards" ' . $classRead . '>
                                    <div class="media">
                                        <a class="media-left media-middle" href="javascript:void(0)">
                                            <img onerror="imageDefaultOnLoadError($(this))" class="media-object m-r-10 m-l-10"
                                                 src="' . $domain . $db['avatar'] . '"
                                                 alt="Avatar">
                                        </a>
                                        <div class="media-body">
                                            <div class="company-name m-b-10">
                                                <p>' . $icon . $db['title'] . '</p>
                                                <i class="text-muted f-14 time-notify" data-time="' . $db['created_at'] . '">' . $db['created_at'] . '</i></div>
                                            <p class="text-muted">' . $db['content'] . '</p>
                                        </div>
                                        <div class="media-right">' . $isRead . '</div>
                                    </div>
                                </div>';
            }
            return [$view, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function notify(Request $request)
    {
        $position = $request->get('position');
        $limit = $request->get('limit');
        $type = Config::get('constants.type.data.GET_ALL');
        $isView = Config::get('constants.type.checkbox.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.LOGS');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_NOTIFY_GET_LIST, $limit, $type, $position, $isView);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            if (count($config['data']['list']) === 0) {
                $list = '<li class="message-header-item popup-message">
                            <div class="message-header-item-img">
                                <img src="/images/tms/logo2.png" alt="">
                            </div>
                            <div class="message-header-item-info">
                                <div class="message-header-item-name">
                                    <span>HỆ THỐNG</span>
                                </div>
                                <div class="message-header-item-message">
                                    <span>Bạn hiện chưa có thông báo mới</span>
                                    <div class="message-header-item-time-ago">Vài giây</div>
                                </div>
                            </div>
                        </li>';
            } else {
                $list = '';
                foreach ($config['data']['list'] as $db) {
                    $view = ($db['is_viewed'] === Config::get('constants.type.checkbox.SELECTED')) ? 'style="background-color: #d2d2d2"' : '';
                    switch ($db['type']) {
                        case Config::get('constants.type.NotificationTypeEnum.ACCOUNT'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-user"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.TASK'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-wpforms"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.NEWS'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-newspaper-o"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.CHAT'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-commenting-o"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.GROUP_CHAT'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-comments-o"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.LEAVE_FORM'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-mail-reply"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.BIRTHDAY'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-birthday-cake"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.ANNOUNCEMENT'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-bell"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.KAIZEN'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-certificate"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.CUSTOMER_POINT'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-venus-double"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.SALARY_TABLE'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-credit-card"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.SALARY_ADDITION'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-retweet"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.ADVANCED_SALARY_REQUEST'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-money"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.BOOKING'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-info-circle"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.ORDER'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-plus-square"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.ADVERT'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-television"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.SUPPLIER_ORDER_REQUEST'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-location-arrow"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.SUPPLIER_RESTAURANT_DEBT_PAYMENT_REQUEST'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-bell-o"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.SUPPLIER_ORDER'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-cart-plus"></i>';
                            break;
                        case Config::get('constants.type.NotificationTypeEnum.TARGET'):
                            $icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-bar-chart-o"></i>';
                            break;
                        default:
                            $icon = '';
                    }
                    $list .= '<li class="message-header-item popup-message" ' . $view . '>
                                <div class="message-header-item-img">
                                    <img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $db['avatar'] . '" alt="">
                                </div>
                                <div class="message-header-item-info">
                                    <div class="message-header-item-name">
                                        <span>' . $db['name'] . '</span>
                                    </div>
                                    <div class="message-header-item-message">
                                        ' . $icon . '
                                        <span>' . $db['title'] . '</span>
                                        <div class="message-header-item-time-ago">' . $db['created_at'] . '</div>
                                    </div>
                                </div>
                            </li>';
                }
            }
            return [$list, count($config['data']['list']), $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function countNotifyNotSeen(Request $request)
    {
        $api = sprintf(API_NOTIFY_GET_COUNT_NOT_SEEN);
        $body = null;
        $requestCountNotify = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.LOGS'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body
        ];
        $api = sprintf(API_NOTIFY_CHAT_GET_COUNT_NOT_SEEN);
        $requestCountChat = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.CHAT'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestCountNotify, $requestCountChat]);
        try {
            $countNotify = $this->numberFormat($configAll[0]['data']);
            $countChat = $configAll[1]['data'];
            return [$countNotify, $countChat, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }
}
