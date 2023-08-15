<?php

namespace App\Http\Controllers\Marketing\Gift;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class NotifyGiftMarketingController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Thông báo quà tặng';
        return view('marketing.gift.notify.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $status = Config::get('constants.type.checkbox.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $api = sprintf(API_GET_NOTIFY_GIFT_MARKETING, $status, $restaurant_brand_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collect = collect($config['data']);
            $dataNotSend = $collect->where('is_send', Config::get('constants.type.checkbox.DIS_SELECTED'))->all();
            $dataSend = $collect->where('is_send', Config::get('constants.type.checkbox.SELECTED'))->all();
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $update = TEXT_UPDATE;
            $tableNotSend = DataTables::of($dataNotSend)
                ->addColumn('logo', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['image_url'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['image_url'] . "'" . ')"/>';
                })
                ->addColumn('title', function ($row) {
                    return (mb_strlen($row['title']) > 30) ? $row['title'] = mb_substr($row['title'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['title'] . '"></i>' : $row['title'];
                })
                ->addColumn('content', function ($row) {
                    return (mb_strlen($row['content']) > 30) ? $row['content'] = mb_substr($row['content'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['content'] . '"></i>' : $row['content'];
                })
                ->addColumn('action', function ($row) use ($domain, $update) {
                    return '<div class="btn-group btn-group-sm">
                             <button class="tabledit-edit-button btn btn-warning waves-effect waves-light" data-id=" ' . $row['id'] . '" data-title=" ' . $row['title'] . '"  data-content=" ' . $row['content'] . '" data-logo=" ' . $row['image_url'] . '" data-domain-logo=" ' . $domain . $row['image_url'] . '" data-time=" ' . $row['send_notification_at'] . '" onclick="openModalUpdateNotifyGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><span class="icofont icofont-ui-edit"></span></button>
                        </div>';
                })
                ->rawColumns(['logo', 'action', 'title', 'content'])
                ->addIndexColumn()
                ->make(true);
            $tableSend = DataTables::of($dataSend)
                ->addColumn('logo', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['image_url'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['image_url'] . "'" . ')"/>';
                })
                ->addColumn('title', function ($row) {
                    return (mb_strlen($row['title']) > 30) ? $row['title'] = mb_substr($row['title'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['title'] . '"></i>' : $row['title'];
                })
                ->addColumn('content', function ($row) {
                    return (mb_strlen($row['content']) > 30) ? $row['content'] = mb_substr($row['content'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['content'] . '"></i>' : $row['content'];
                })
                ->addColumn('action', function ($row) {
                    return '';
                })
                ->rawColumns(['logo', 'title', 'content'])
                ->addIndexColumn()
                ->make(true);
            $total = [
                'total_record_not_send' => $this->numberFormat(count($dataNotSend)),
                'total_record_send' => $this->numberFormat(count($dataSend)),
            ];
            return [$tableNotSend, $tableSend, $total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $type = $request->get('type');
        $id = $request->get('id') === null ? 0 : $request->get('id');
        $title = $request->get('title');
        $content = $request->get('content');
        $logo = $request->get('logo');
        $gift = $request->get('gift');
        $time = sprintf($request->get('time'));
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_POST_CREATE_NOTIFY_GIFT_MARKETING;
        $body = [
            "customer_marketing_notification_type" => $type,
            "customer_id" => $id,
            "title" => $title,
            "content" => $content,
            "message_url" => $logo,
            "restaurant_gift_id" => $gift,
            "send_notification_at" => $time,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $title = $request->get('title');
        $content = $request->get('content');
        $logo = $request->get('logo');
        $time = sprintf($request->get('time'));
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_UPDATE_NOTIFY_GIFT_MARKETING, $id);
        $body = [
            "title" => $title,
            "content" => $content,
            "message_url" => $logo,
            "send_notification_at" => $time,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function customer(Request $request)
    {
        $phone = $request->get('phone');
        $name = Config::get('constants.type.data.NONE');
        $branch = Config::get('constants.type.data.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_BOOKING_SEARCH_CUSTOMER,$name,$phone,$branch);
        $body = [];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function gift(Request $request)
    {
        $brand = $request->get('brand');
        $isActive = Config::get('constants.type.checkbox.SELECTED');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $api = sprintf(API_GIFT_MARKETING_GET, $brand, $isActive, $limit, $page);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $gift = '<option selected value="0">' . TEXT_NONE_GIFT_OPTION . '</option>';
            foreach ($config['data']['list'] as $db) {
                $gift .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
            if (count($config['data']['list']) === 0) {
                $gift = '<option selected>' . TEXT_NULL_OPTION . '</option>';
            }

            return [$gift, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
