<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index()
    {
        if ($this->checkServiceRestaurantLevel()) {
            return redirect('/dashboard-sale-solution');
        }
        $active_nav = 'Giới thiệu';
        return view('index', compact('active_nav'));
    }

    public function infoPhp()
    {
        phpinfo();
    }

    public function data(Request $request)
    {
        /**
         * Báo cáo thông tin Công ty/Nhà hàng
         */
        $api = sprintf(API_REPORT_GET_PROFILE);
        $body = null;
        $requestRestaurantProfile = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        /**
         * Báo cáo cơ cấu hạng thẻ thành viên
         */
        $api = sprintf(API_REPORT_GET_MEMBERSHIP_CARD);
        $body = null;
        $requestRestaurantMembershipCard = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $configAll = $this->callApiMultiGatewayTemplate2([$requestRestaurantProfile, $requestRestaurantMembershipCard]);
        try {
            $dataProfile = $configAll[0]['data'];
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $dataProfile['logo'] = $domain . $dataProfile['logo'];
            $dataProfile['banner'] = $domain . $dataProfile['banner'];
            $dataChart = [];
            foreach ($configAll[1]['data'] as $db) {
                array_push($dataChart, [
                    "name" => $db['name'],
                    "value" => $db['total_customer_member'],
//                    "color" => $db['color_hex_code'],
                ]);
            }
            return [$dataProfile, $dataChart, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function searchCustomer(Request $request)
    {
        $phone = $request->get('phone');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = 20;
        $project = ENUM_PROJECT_ID_ALOLINE_USER;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_REPORT_GET_SEARCH_CUSTOMER,$page, $limit);
        $body = [
            'phone'  => $phone
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $customer = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            foreach ($config['data']['list'] as $db) {
                $customer .= ' <div class="col-lg-6 job-cards">
                            <div class="media">
                                <a class="media-left media-middle">
                                    <img onerror="imageDefaultOnLoadError($(this))" class="media-object m-r-10 m-l-10" style="height: 60px;border-radius: 100%;border: 1px solid #dfdfdf; cursor: default;"
                                         src="' . $domain . $db['avatar'] . '" alt="Avatar">
                                </a>
                                <div class="media-body">
                                    <div class="company-name">
                                        <p>' . $db['full_name'] . '</p>
                                        <i class="text-muted f-14">' . $db['phone'] . '</i></div>
                                </div>
                                <div class="media-right">
                                    <div class="label-main">
                                        <label class="label bg-primary item-customer-dashboard-introduce" style="cursor: pointer">Chọn</label>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
            return [$customer, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function logoutAloline(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_AUTH_POST_LOGOUT_ALOLINE_RESTAURANT);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = Session::get(SESSION_KEY_DATA_RESTAURANT);
            $data['customer_partner_id'] = 0;
            $data['customer_partner_node_access_token'] = '';
            Session::put(SESSION_KEY_DATA_RESTAURANT, $data);
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function review(Request $request)
    {
        $id = Session::get(SESSION_KEY_DATA_RESTAURANT)['customer_partner_id'];
        $page = $request->get('page');
        $limit = $request->get('limit');
        $rate = $request->get('rate');
        $isReply = $request->get('reply');
        $from = sprintf($request->get('from'));
        $to = sprintf($request->get('to'));
        $branch = '';
        $project = Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_REPORT_GET_REVIEW, $page, $limit, $isReply, $rate, $from, $to, $branch, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $review = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            foreach ($config['data']['list'] as $db) {
                $rate = ['', '', '', '', ''];
                switch ((int)$db['rate']) {
                    case 1:
                        $rate = ['rated', '', '', '', ''];
                        break;
                    case 2:
                        $rate = ['rated', 'rated', '', '', ''];
                        break;
                    case 3:
                        $rate = ['rated', 'rated', 'rated', '', ''];
                        break;
                    case 4:
                        $rate = ['rated', 'rated', 'rated', 'rated', ''];
                        break;
                    case 5:
                        $rate = ['rated', 'rated', 'rated', 'rated', 'rated'];
                        break;
                }
                $comment = '';
                $classReply = 'd-none';
                foreach ($db['comments'] as $cm) {
                    $comment .= '<div class="media item-comment-review-restaurant-dashboard-introduce" style="margin-bottom: 5px;">
                                    <div class="media-body" style="background-color: #f2f2f2;border-radius: 10px;padding: 5px;">
                                        <h6 class="media-heading">' . $cm['customer_name'] . ' <span class="f-12 text-muted m-l-5">' . $cm['updated_at'] . '</span></h6>
                                        <p class="m-b-0">' . $cm['content'] . '</p>
                                    </div>
                                </div>';
                }
                if ($comment !== '') {
                    $comment = '<hr style="margin: 0">
                                <div class="list-comment-review">' . $comment . '</div>';
                    $classReply = '';
                }
                $db['content'] = nl2br($db['content']);
                $review .= ' <li class="media item-review-restaurant-dashboard-introduce p-2" data-id="' . $db['_id'] . '"
                                            style="padding-bottom: 10px; margin-top: 5px; border-bottom: 2px solid #f2f2f2">
                                            <div class="media-left">
                                                <a href="javascript:void(0)">
                                                    <img onerror="imageDefaultOnLoadError($(this))" class="media-object img-radius comment-img"
                                                         src="' . $domain . $db['customer']['avatar']['thumb'] . '"
                                                         alt="Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading m-b-0">
                                                    ' . $db['customer']['full_name'] . '
                                                    <span class="f-12 text-muted m-l-5">(' . $db['branch']['name'] . ')</span>
                                                    <i class="fa fa-check-circle-o text-success icon-check-reply-review-restaurant-dashboard-introduce ' . $classReply . '" style="font-size: 15px;" data-toggle="tooltip" data-placement="top" data-original-title="Đã phản hồi"></i>
                                                    <br>
                                                    <span class="f-12 text-muted">' . $db['updated_at'] . '</span>
                                                    <i class="fa fa-send redirect-review-dashboard-introduce" data-toggle="tooltip" data-placement="top" data-original-title="Đi đến Aloline"></i>
                                                </h6>
                                                <div class="stars-example-css review-star text-center">
                                                    <i class="fa fa-star ' . $rate[0] . '" style="color: #01a9ac"></i>
                                                    <i class="fa fa-star ' . $rate[1] . '" style="color: #01a9ac"></i>
                                                    <i class="fa fa-star ' . $rate[2] . '" style="color: #01a9ac"></i>
                                                    <i class="fa fa-star ' . $rate[3] . '" style="color: #01a9ac"></i>
                                                    <i class="fa fa-star ' . $rate[4] . '" style="color: #01a9ac"></i>
                                                </div>
                                                <p class="m-b-0 title-review-dashboard-introduce">' . $db['title'] . '</p>
                                                <p class="m-b-0">' . $db['content'] . '</p>
                                                <div><span><a href="javascript:void(0)"
                                                             class="m-r-10 f-12 edit-text-introduce">Trả lời</a></span>
                                                </div>
                                                ' . $comment . '
                                            </div>
                                        </li>';
            }
            return [$review, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function replyReview(Request $request)
    {
        $id = $request->get('id');
        $content = $request->get('content');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ALOLINE_NODE');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_REPORT_POST_REPLY_REVIEW);
        $body = [
            'content' => $content,
            'image_urls' => [],
            'sticker' => '',
            'branch_review_id' => $id,
            'customer_tags' => [],
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
