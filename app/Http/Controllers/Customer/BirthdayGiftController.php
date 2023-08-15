<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\DataTables;

class BirthdayGiftController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Quà sinh nhật';
        return view('customer.birthday_gift.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $status = Config::get('constants.type.status.GET_ALL');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_BIRTHDAY_GIFT_GET, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data'];
            return DataTables::of($data)
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['image_url'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['image_url'] . "'" . ')" style="object-fit: cover"/></label>';
                })
                ->addColumn('icon', function ($row) use ($domain) {
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['icon_image_url'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['icon_image_url'] . "'" . ')" style="object-fit: cover"/></label>';
                })
                ->addColumn('status', function ($row) {
                    if ($row['status'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                        $status = '<label class="text-success">' . TEXT_STATUS_ENABLE . '</label>';
                    } else {
                        $status = '<label class="text-inverse">' . TEXT_DISABLE_STATUS . '</label>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $disable = TEXT_DISABLE_STATUS;
                    $enable = TEXT_ENABLE;
                    $update = TEXT_UPDATE;
                    if ($row['status'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                        return '<div class="btn-group btn-group-sm">
                             <button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light" onclick="changeStatusBirthdayGift($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><span class="icofont icofont-ui-close"></span></button>
                            <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" onclick="openModalUpdateBirthdayGift(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><span class="icofont icofont-ui-edit"></span></button>
                            </div>';
                    } else {
                        return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-success waves-effect waves-light" onclick="changeStatusBirthdayGift($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '"><span class="icofont icofont-ui-check"></span></button>
                            <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" onclick="openModalUpdateBirthdayGift(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><span class="icofont icofont-ui-edit"></span></button>
                                </div>';
                    }
                })
                ->rawColumns(['avatar', 'icon', 'status', 'action'])
                ->addIndexColumn()
                ->make(true);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function dataGiftItem(Request $request)
    {

//        $branch = $request->get('branch');
//        $branch = Config::get('constants.type.status.GET_ALL');


        $status = Config::get('constants.type.status.GET_ACTIVE');
        $api = sprintf(API_GIFT_GET_BIRTHDAY_ITEM, $status);
        $body = null;
        $requestBirthdayGiftItem = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $api = sprintf(API_BIRTHDAY_GIFT_GET_BIRTHDAY_GIFT_ICON);
        $body = null;
        $requestBirthdayGiftIcon = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.UPLOAD'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestBirthdayGiftItem,$requestBirthdayGiftIcon]);
        try {
            $config = $configAll[0];
            $data = $config['data'];
            $data_item = '';
            if (!empty($data)){
                for ($i = 0; $i < count($data); $i++) {
                    $data_item .= '<option value="' . $data[$i]['name'] . '">' . $data[$i]['name'] . '</option>';
                }
            };
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

        try {


            $config_icon = $configAll[1];
            $data = $config_icon['data'];
            $data_icon = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            if (!empty($data)){
                for ($i = 0; $i < count($data); $i++) {
                    $data_icon .= '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain.$data[$i]['link_original'] . '" original-link="' . $data[$i]['link_original'] . '" class="img-radius w-img-icon-group p-5-px cursor-pointer" alt="icon" id="img-icon-birthday-gift-' . $data[$i]['_id'] . '" data-id="' . $data[$i]['_id'] . '" onclick="selectIconBirthdayGift($(this))">';
                }
            }

            return [$data_icon, $data_item, $config , $config_icon];
        }catch (Exception $e){
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_BIRTHDAY_GIFT_POST_CREATE);
        $body = [
            'image_url' => $request->get('img'),
            'icon_image_url' => $request->get('icon'),
            'title' => $request->get('title'),
            'message' => $request->get('message'),
            'content' => $request->get('content'),
            'gift' => $request->get('item'),
//            'branchIds' => $request->get('branch'),
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function dataGiftForUpdate(Request $request){
        $id = $request->get('id');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_BIRTHDAY_GIFT_GET_FOR_UPDATE, $id);
        $body = [
            'image_url' => $request->get('img'),
            'icon_image_url' => $request->get('icon'),
            'title' => $request->get('title'),
            'message' => $request->get('message'),
            'content' => $request->get('content'),
            'gift' => $request->get('item'),
            'branchIds' => $request->get('branch'),
        ];
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        $config['data']['icon_image_url'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['icon_image_url'];
        $config['data']['image_url'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $config['data']['image_url'];
        return $config;
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_BIRTHDAY_GIFT_POST_UPDATE, $id);
        $body = [
            'image_url' => $request->get('img'),
            'icon_image_url' => $request->get('icon'),
            'title' => $request->get('title'),
            'message' => $request->get('message'),
            'content' => $request->get('content'),
            'gift' => $request->get('item'),
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function changeStatus(Request $request){
        $id = $request->get('id');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_BIRTHDAY_GIFT_POST_CHANGE_STATUS, $id);
        $body = null;
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }
}
