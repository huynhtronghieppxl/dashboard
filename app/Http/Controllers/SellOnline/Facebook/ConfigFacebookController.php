<?php

namespace App\Http\Controllers\SellOnline\Facebook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Session;

class ConfigFacebookController extends Controller
{

    public function index()
    {
        $active_nav = 'DASHBOARD FACEBOOK';
        return view('sell_online.facebook.config', compact('active_nav'));
    }
    /** Get list page facebook ***/
    public function getAllPage(Request $request)
    {
        $user_data = Session::get(SESSION_KEY_SESSION_USER_FACEBOOK);
        $token = $user_data->token;
        $fields = 'name,picture,page_token,is_owned,birthday,description,link,name_with_location_descriptor,emails,general_info,about';
        $method = 'GET';
        $api = sprintf(API_FACEBOOK_GET_LIST_PAGES, $fields, $token);
        $body = null;
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        try {
            $page = $config['data'];
            $listPage = '';
            $listPageConnect = '';
            $pageConnect = Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT);
            if ($pageConnect === null) $pageConnect = [];
            for ($i = 0; $i < count($page); $i++) {
                $connect = '<span class="status text-warning">Chưa kết nối</span>';
                $checked = '<input type="checkbox" class="checkbox-control-page-item-input"/>';
                $class = "";
                $type = 0;
                foreach ($pageConnect as $db) {
                    if ($page[$i]['id'] === $db['id']) {
                        $connect = '<span class="manage-page-body-card-item-status-connect">Đã kết nối</span>';
                        $checked = '<input type="checkbox" class="checkbox-control-page-item-input" checked/>';
                        $class = "active";
                        $type = 1;
                        $listPageConnect = '<div class="card-item-list-category-check d-flex align-items-center" data-id="' . $page[$i]['id'] . '">
                                                                <div class="img-logo-card-item-check">
                                                                    <img class="manage-page-card-item-img-right" src="' . $page[$i]['picture']['data']['url'] . '">
                                                                </div>
                                                                <div class="title-information-card-item-check">
                                                                    <div class="content-title-check-01">
                                                                        <p class="manage-page-card-item-content-title-check-01">' . $page[$i]['name'] . '</p>
                                                                    </div>
                                                                </div>
                                                                <i class="fa fa-times-circle remove-page-collect"></i>
                                                            </div>';
                    }
                }
                $listPage .= '<div class="card-item-list-category pointer d-flex align-items-center '.$class.'" data-id="' . $page[$i]['id'] . '" data-type="'.$type.'">
                                        <div class="img-logo-card-item">
                                            <img class="manage-page-card-item-img" onerror="imageDefaultOnLoadError($(this))" src="' . $page[$i]['picture']['data']['url'] . '"/>
                                        </div>
                                        <div class="title-information-card-item">
                                            <div class="content-title-01 d-flex align-items-center">
                                                <p class="manage-page-card-item-content-title">' . $page[$i]['name'] . '</p>
                                                <div class="checked-icon-box d-none">
                                                    <input type="checkbox" class="check-card-item"/>
                                                    <label for="check-card-item"></label>
                                                </div>
                                            </div>
                                            <div class="title-02-card-item">
                                                <p class="manage-page-card-item-content-title-name"><a class="pointer" style="color: #007bff; font-size: 12px !important;" href="' . $page[$i]['link'] . '" target="_blank">' . $page[$i]['link'] . '</a></p>
                                            </div>
                                            <div class="title-03-card-item">
                                                <p class="manage-page-card-item-content-title-status">' . $connect . '</p>
                                            </div>
                                        </div>
                                        <label class="checkbox-control-page-item">
                                            '.$checked.'
                                        </label>
                                    </div>';
            }
            if ($listPage === '') {
                $listPage = '<p class="manage-page-body-connect-null-text">Hiện bạn chưa sở hữu trang nào, hãy bắt đầu tạo một trang dành cho bạn <a style="color:#007bff;" href="https://www.facebook.com/pages/creation/?ref_type=launch_point">tại đây</a></p>';
            }
            return [$listPage, $user_data, count($page), $pageConnect ,$listPageConnect ,$config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
    /** Choose page to connect ***/
    public function selectPageConnect(Request $request)
    {
        $id = $request->get('id');
        $user_data = Session::get(SESSION_KEY_SESSION_USER_FACEBOOK);
        $token = $user_data->token;
        $fields = 'name,picture,access_token,page_token,is_owned,website,contact_address,phone,birthday';
        $dataPage = [];
        for ($i = 0; $i < count($id); $i++) {
            $method = 'GET';
            $api = sprintf(API_FACEBOOK_GET_INFO_PAGES, $id[$i], $fields, $token);
            $body = null;
            $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
            $dataPage[] = $config;
        }
        if(Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT) === null || Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT) === []) {
            Session::put(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT, $dataPage);
            Session::put(SESSION_KEY_PAGE_FACEBOOK_CONNECTED, $dataPage);
        } else {
            Session::put(SESSION_KEY_PAGE_FACEBOOK_CONNECTED, "");
            Session::put(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT, $dataPage);
            Session::put(SESSION_KEY_PAGE_FACEBOOK_CONNECTED, $dataPage);
        }
        Session::put(SESSION_KEY_CURRENT_PAGE_FACEBOOK_CONNECT, $dataPage[0]);
        return ['list-page-connect' => $dataPage, 'status-connect' => '1', 'status-name' => 'Kết nối thành công', 'Config' => $config];
    }
    /** Choose one page to connect ***/
    public function selectOnePageConnect(Request $request)
    {
        $id = $request->get('id');
        $pageConnectChoose = Session::get(SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT);
        $tokenPageConnect = '';
        foreach ($pageConnectChoose as $db) {
            if ($id === $db['id']) {
                $tokenPageConnect = $db['access_token'];
            }
        }
        $fields = 'name,picture,access_token,page_token,is_owned,website,contact_address,phone,birthday';
        $method = 'GET';
        $api = sprintf(API_FACEBOOK_GET_INFO_PAGES, $id, $fields, $tokenPageConnect);
        $body = null;
        $config = $this->callApiFacebookTemplate($request, $method, $api, $body);
        Session::put(SESSION_KEY_CURRENT_PAGE_FACEBOOK_CONNECT, $config);
        return $config;
    }
}
