<?php

namespace App\Http\Controllers\Customer;

use App\Http\Resources\timekeeping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Tin nhắn marketing';
        return view('customer.notification.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $is_sent = Config::get('constants.type.id.GET_ALL');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS_GET_DATA, $is_sent);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data_table = DataTables::of($config['data'])
                ->addColumn('action', function ($row) {
                    $update = TEXT_UPDATE;
                    return '<div class="btn-group btn-group-sm">
                               <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" style="float: none;margin: 5px;" data-id="' . $row['id'] . '" data-title="' . $row['title'] . '" data-content="' . $row['content'] . '" onclick="openModalUpdateNotificationCustomer($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '">
                                   <span class="icofont icofont-ui-edit"></span>
                               </button>
                               <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;" data-id="' . $row['id'] . '" data-title="' . $row['title'] . '" data-content="' . $row['content'] . '" onclick="openModalSendNotificationCustomer($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Gửi">
                                   <span class="fa fa-send"></span>
                               </button>
                            </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            return [$data_table, $config];
        } catch (ErrorException $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function create(Request $request)
    {
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS_POST_CREATE);
        $body = [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $id = sprintf($request->get('id'));
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS_POST_UPDATE, $id);
        $body = [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function getAllRestaurantMembershipCard(Request $request)
    {
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MEMBERSHIP_CARD_GET);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data'];
            $option = '';
            if (empty($data)) {
                $option = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            } else {
                foreach ($data as $db) {
                    $option .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                }
            }

            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function sendNotify(Request $request)
    {
        $id = sprintf($request->get('id'));
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS_POST_SEND, $id);
        $body = [
            'image_url' => sprintf($request->get('image_url')),
            'object_id' => $request->get('object_id'),
            'restaurant_membership_card_id' => $request->get('restaurant_membership_card_id'),
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }
}
