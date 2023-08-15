<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class BranchSettingController extends Controller
{
    public function index()
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Chi nhánh';
        return view('setting.branch.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $status = Config::get('constants.type.status.GET_ALL'); // Lấy tất cả trạng thái
        $is_card = Config::get('constants.type.checkbox.GET_ALL');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SETTING_BRANCH_GET_CARD, $restaurant_brand_id, $status, $is_card);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $list_brand = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $data = collect($data)->sortByDesc('status')->all();
            foreach ($data as $key => $db) {
                $logo = ($db['image_logo'] == '' || $db['image_logo'] == null) ? $domain . Config::get('app.IMG_DEFAULT') : $domain . $db['image_logo'];
                $banner = ($db['banner'] == '' || $db['banner'] == null) ? $domain . Config::get('app.IMG_DEFAULT') : $domain . $db['banner'];
                if ($db['status'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    $active = '';
                    $ul_detail = '<ul class="profile-controls">
                                        <li data-toggle="tooltip" data-original-title="' . TEXT_STATUS_ENABLE . '" data-placement="top">
                                            <div class="pointer   btn-radius-50" style=" background: #2F9672; color: #ffffff">
                                                    <i class="fi-rr-check"></i>
                                            </div>
                                        </li>
                                        <li data-toggle="tooltip" data-original-title="' . TEXT_DETAIL . '" data-placement="top">
                                            <div class="pointer branch-setting-detail btn-radius-50 seemt-btn-hover-blue" data-type="'.$key.'" data-status="' . $db['status'] . '" data-id="' . $db['id'] . '" data-name="' . $db['name'] . '"
                                            data-logo="' . $logo . '" data-banner="' . $banner . '" data-phone="' . $db['phone'] . '" data-business="' . $db['phone'] . '" data-code-check-in="' . $db['qr_code_checkin'] . '" onclick="dataProfileBranch($(this))">
                                                <i class="fi-rr-eye"></i>
                                            </div>
                                        </li>
                                    </ul>';
                } else {
                    $active = '';
                    $ul_detail = '<ul class="profile-controls">
                                        <li data-toggle="tooltip" data-original-title="' . TEXT_DISABLE_STATUS . '" data-placement="top">
                                            <div class="pointer bg-danger btn-radius-50">
                                                    <i class="fa fa-times"></i>
                                            </div>
                                        </li>
                                    </ul>';
                }
                $list_brand .= '<div class="col-xl-6 col-lg-12 edit-flex-auto-fill">
                                    <div class="box-image" style="height: max-content">
                                        <figure class="box-image-banner">
                                            <img onerror="imageDefaultOnLoadError($(this))" src="' . $banner . '" alt="" class="thumbnail-banner-branch">
                                            ' . $ul_detail . '
                                        </figure>
                                        <div class="col-lg-12" style="position: absolute; bottom: 20px">
                                            <div class="row">
                                                <div class="col-lg-3 col-sm-3">
                                                    <div class="profile-branch">
                                                        <div class="profile-branch-thumb">
                                                            <img onerror="imageDefaultOnLoadError($(this))" alt="author" class="thumbnail-branch-logo-booking" src="' . $logo . '">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9 col-lg-9">
                                                    <div class="author-content" style="width: 67%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap">
                                                       <a class="custom-name ' . $active . '" style="word-break: break-word;">' . $db['name'] . '</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
            }
            if (count($config['data']) == 1) {
                $config['data'][0]['image_logo'] = $domain . $config['data'][0]['image_logo'];
            }
            return [$list_brand, count($data), $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataServe(Request $request)
    {
        $branch = $request->get('branch');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SETTING_BRANCH_GET_POST, $branch);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataProfile(Request $request)
    {
        $id = $request->get('id');
        $api = sprintf(API_SETTING_BRANCH_GET_FULL_IN_FOR, $id);
        $body = null;
        $requestInforBranch = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api =sprintf(API_SETTING_BRANCH_GET_LIST_BRANCH_BUSINESS_TYPE);
        $body = null;
        $requestListBranchBusiness = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_SETTING_BRANCH_GET_LIST_CITIES, (int)Config::get('constants.type.checkbox.SELECTED'));
        $body = null;
        $requestListCities = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $configAll = $this->callApiMultiGatewayTemplate2([$requestInforBranch, $requestListBranchBusiness, $requestListCities]);
        try {
            $config = $configAll[0];
            $branch_config = $config;
            $branch_detail = $config['data'];
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $logo = ($branch_detail['image_logo'] == '' || $branch_detail['image_logo'] == null) ? $domain . Config::get('app.IMG_DEFAULT') : $domain . $branch_detail['image_logo'];
            $banner = ($branch_detail['banner_image_url'] == '' || $branch_detail['banner_image_url'] == null) ? '../images/banner_default.jpg' : $domain . $branch_detail['banner_image_url'];
            $list_images_url = '';
            for ($i = 0; $i < count($branch_detail['image_urls']); $i++) {
                $list_images_url .= '<div class="group-image">
                                                <div style="position: relative;" class="image-preview">
                                                    <div class="btn-move-image more" onclick="removeImage($(this))">
                                                        <div class="more-option-image">
                                                            <i class="fa fa-trash"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="position: relative;color: #fff !important;" class="is_check_all_image d-none">
                                                    <div class="checkbox-fade fade-in-info checkbox_image_all_branch">
                                                        <label>
                                                            <input type="checkbox" value="" name="check-all-image">
                                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <a class="gallery-item" style="padding: 5px;" data-url="' . $branch_detail['image_urls'][$i] . '" data-src="' . $domain . $branch_detail['image_urls'][$i] . '" data-sub-html="">
                                                    <img onerror="imageDefaultOnLoadError($(this))" alt="" class="img-responsive m-0 p-0" src="' . $domain . $branch_detail['image_urls'][$i] . '" />
                                                </a>
                                            </div>';
            };
            // List business types id
            if ($branch_detail['branch_business_types'] == []) {
                $business_types_id = [];
            } else {
                for ($i = 0; $i < count($branch_detail['branch_business_types']); $i++) {
                    $business_types_id[] = $branch_detail['branch_business_types'][$i]['id'];
                }
            }
            $config = $configAll[1];
            $collection = collect($config['data']);
            $business_data = $collection->where('status', 1);
            $business_type = '';
            foreach ($business_data as $c) {
                $business_type .= '<option value="' . $c['id'] . '">' . $c['name'] . '</option>';
            }
            $date = [
                ['value' => '1', 'name' => 'Chủ nhật'],
                ['value' => '2', 'name' => 'Thứ hai'],
                ['value' => '3', 'name' => 'Thứ ba'],
                ['value' => '4', 'name' => 'Thứ tư'],
                ['value' => '5', 'name' => 'Thứ năm'],
                ['value' => '6', 'name' => 'Thứ sáu'],
                ['value' => '7', 'name' => 'Thứ bảy']
            ];
            $data_select = '';
            foreach ($date as $day) {
                $data_select .= '<div class="row form-group parent-node">
                                <div class="col-lg-3">
                                    <div class="checkbox-fade fade-in-info">
                                        <label>
                                            <input type="checkbox" value="' . $day['value'] . '">
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                            <span>' . $day['name'] . '</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-7 input-group">
                                            <input class="form-control start-time-date-time-picker time-open-of-day" placeholder="Giờ bắt đầu">
                                            <span class="input-group-addon">Đến</span>
                                            <input class="form-control time-out-date-time-picker time-close-of-day" placeholder="Giờ kết thúc">
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }

            $select_city = '<option disabled selected hidden>' . TEXT_DEFAULT_OPTION . '</option>';
            $config = $configAll[2];
            foreach ($config['data'] as $c) {
                $select_city .= '<option value="' . $c['id'] . '">' . $c['name'] . '</option>';
            }
            $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
            $method = Config::get('constants.GATEWAY.METHOD.GET');
            $api = sprintf(API_SETTING_BRANCH_GET_LIST_DISTRICTS, $branch_detail['city_id']);
            $body = null;
            $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
            $select_district = '<option disabled selected hidden>' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($config['data'] as $c) {
                $select_district .= '<option value="' . $c['id'] . '">' . $c['name'] . '</option>';
            }

            $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
            $method = Config::get('constants.GATEWAY.METHOD.GET');
            $api = sprintf(API_SETTING_BRANCH_GET_LIST_WARDS, $branch_detail['district_id']);
            $body = null;
            $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);


            $select_ward = '<option disabled selected hidden>' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($config['data'] as $c) {
                $select_ward .= '<option value="' . $c['id'] . '">' . $c['name'] . '</option>';
            }
            $branch_detail['branch_business_types'] = $business_type;
            $branch_detail['select_date'] = $data_select;
            $branch_detail['select_city'] = $select_city;
            $branch_detail['select_district'] = $select_district;
            $branch_detail['select_ward'] = $select_ward;
            return [$branch_detail, $branch_config, $data_select, $list_images_url, $logo, $banner, $business_types_id, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function searchAddressMap4D(Request $request)
    {
        $client = new Client([
            'verify' => false,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => '',
                'Content-Type' => 'application/json',
            ],
        ]);
        $response = $client->request('GET', sprintf(API_SETTING_BRANCH_GET_SEARCH_ADDRESS_FULL, $request->get('text')),[
            'http_errors' => false,
            'timeout' => 15,
            'connect_timeout' => 15,
        ]);
        $data = json_decode($response->getBody(), true);
        $html = '';
        foreach($data['result'] as $db){
            $html .= '<div class="pointer" onclick="loadSelectListSaleCreatClient($(this))"
                            data-lat="' . $db['location']['lat'] . '"
                            data-lng="' . $db['location']['lng'] . '"
                            style="display: flex;
                            padding: 10px;
                            border-bottom: 1px solid grey;
                            font-weight: 500;
                            align-items: center;
                            cursor: pointer;
                            padding-bottom:4px"
                        ><i class="fa fa-map-marker"></i>
                        <p class="ml-3" style="font-size: 13px !important;
                        line-height: 1.7;font-weight:500;">' . $db['address'] . '   </p>
                     </div>';
        }
        return [$html, $data];
    }

    public function countryData(Request $request)
    {
        $country_id = $request->get('country_id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SETTING_BRANCH_GET_LIST_CITIES, (int)Config::get('constants.type.checkbox.SELECTED'));
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $country = '';
        foreach ($config['data'] as $c) {
            $country .= '<option value="' . $c['id'] . '" selected>' . $c['name'] . '</option>';
        }
        return $country;
    }

    public function citiesData(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SETTING_BRANCH_GET_LIST_CITIES, (int)Config::get('constants.type.checkbox.SELECTED'));
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function districtsData(Request $request)
    {
        $city_id = $request->get('city_id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SETTING_BRANCH_GET_LIST_DISTRICTS, $city_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['data'] == null) {
                $select_district = '<option value="" disabled selected>-- Không Có Quận/Huyện --</option>';
            } else {
                $select_district = '';
                for ($i = 0; $i < count($config['data']); $i++) {
                    if ($i == 0) {
                        $select_district .= '<option value="' . $config['data'][$i]['id'] . '" selected>' . $config['data'][$i]['name'] . '</option>';
                    } else {
                        $select_district .= '<option value="' . $config['data'][$i]['id'] . '">' . $config['data'][$i]['name'] . '</option>';
                    }
                }
            }
            return $select_district;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function wardsData(Request $request)
    {
        $district_id = $request->get('district_id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SETTING_BRANCH_GET_LIST_WARDS, $district_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['data'] == null) {
                $select_ward = '<option value="" disabled selected>-- Không Có Phường/Xã --</option>';
            } else {
                $select_ward = '';
                for ($i = 0; $i < count($config['data']); $i++) {
                    if ($i == 0) {
                        $select_ward .= '<option value="' . $config['data'][$i]['id'] . '" selected>' . $config['data'][$i]['name'] . '</option>';
                    } else {
                        $select_ward .= '<option value="' . $config['data'][$i]['id'] . '">' . $config['data'][$i]['name'] . '</option>';
                    }
                }
            }
            return $select_ward;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $banners = $request->get('banner_image_url');
        $image_logo = $request->get('image_logo');
        $id = $request->get('id');
        $api = sprintf(API_SETTING_BRANCH_POST_UPDATE, $id);
        $body = [
            "id" => $id,
            "name" => $request->get('name'),
            "phone" => $request->get('phone'),
            "lat" => $request->get('lat'),
            "lng" => $request->get('lng'),
            "country_id" => (int)Config::get('constants.type.checkbox.SELECTED'),
            "country_name" => 'Việt nam',
            "city_id" => $request->get('city_id'),
            "city_name" => $request->get('city_name'),
            "district_id" => $request->get('district_id'),
            "district_name" => $request->get('district_name'),
            "ward_id" => $request->get('ward_id'),
            "ward_name" => $request->get('ward_name'),
            "street_name" => $request->get('street_name'),
            "address_full_text" => $request->get('address_full_text'),
            "address_note" => "",
            "serve_time" => $request->get('serve_time'),
            "average_amount_per_customer" => $request->get('average_amount_per_customer'),
            "is_have_card_payment" => $request->get('is_have_card_payment'),
            "is_have_booking_online" => $request->get('is_have_booking_online'),
            "is_have_order_food_online" => $request->get('is_have_order_food_online'),
            "is_have_shipping" => $request->get('is_have_shipping'),
            "is_free_parking" => $request->get('is_free_parking'),
            "is_have_car_parking" => $request->get('is_have_car_parking'),
            "is_have_air_conditioner" => $request->get('is_have_air_conditioner'),
            "is_have_wifi" => $request->get('is_have_wifi'),
            "wifi_name" => $request->get('wifi_name'),
            "wifi_password" => ($request->get('wifi_password')),
            "is_have_private_room" => $request->get('is_have_private_room'),
            "is_have_outdoor" => $request->get('is_have_outdoor'),
            "is_have_child_corner" => $request->get('is_have_child_corner'),
            "is_have_live_music" => $request->get('is_have_live_music'),
            "is_have_karaoke" => $request->get('is_have_karaoke'),
            "is_have_invoice" => $request->get('is_have_invoice'),
            "image_logo" => $image_logo,
            "banner_image_url" => $banners,
            "image_urls" => [],
        ];
        $requestUpdate1 = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body,
        ];
        $branch = $request->get('id');
        $api = sprintf(API_SETTING_BRANCH_POST_UPDATE_SETTING, $branch);
        $body = [
            "branch_id" => $branch,
            "is_working_offline" => (int)$request->get('is_working_offline'),
            "is_allow_advert" => (int)$request->get('is_allow_advert'),
            "is_enable_booking" => (int)$request->get('is_enable_booking'),
            "is_have_take_away" => (int)$request->get('is_take_away'),
            "is_enable_fish_bowl" => (int)$request->get('is_enable_fish_bowl'),
            "is_enable_stamp" => (int)$request->get('is_enable_stamp'),
        ];
        $requestUpdate2 = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestUpdate1, $requestUpdate2]);
        try {
            if($configAll[1]['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS){
                $dataBranch = Session::get(SESSION_KEY_DATA_BRANCH);
                foreach ($dataBranch as $key => $db) {
                    if ($db['id'] === (int)$branch) {
                        $dataBranch[$key]['is_working_offline'] = $configAll[1]['data']['is_working_offline'];
                        $dataBranch[$key]['is_allow_advert'] = $configAll[1]['data']['is_allow_advert'];
                        $dataBranch[$key]['is_enable_booking'] = $configAll[1]['data']['is_enable_booking'];
                        $dataBranch[$key]['is_have_take_away'] = $configAll[1]['data']['is_have_take_away'];
                        Session::put(SESSION_KEY_DATA_BRANCH, $dataBranch);
                    }
                }
                if (Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['id'] === (int)$branch) {
                    $dataCurrentBranch = Session::get(SESSION_KEY_DATA_CURRENT_BRANCH);
                    $dataCurrentBranch['is_working_offline'] = $configAll[1]['data']['is_working_offline'];
                    $dataCurrentBranch['is_allow_advert'] = $configAll[1]['data']['is_allow_advert'];
                    $dataCurrentBranch['is_enable_booking'] = $configAll[1]['data']['is_enable_booking'];
                    $dataCurrentBranch['is_have_take_away'] = $configAll[1]['data']['is_have_take_away'];
                    Session::put(SESSION_KEY_DATA_CURRENT_BRANCH, $dataCurrentBranch);
                    $settingCurrentBranch = Session::get(SESSION_KEY_SETTING_CURRENT_BRANCH);
                    $settingCurrentBranch['is_working_offline'] = $configAll[1]['data']['is_working_offline'];
                    $settingCurrentBranch['is_allow_advert'] = $configAll[1]['data']['is_allow_advert'];
                    $settingCurrentBranch['is_enable_booking'] = $configAll[1]['data']['is_enable_booking'];
                    $settingCurrentBranch['is_have_take_away'] = $configAll[1]['data']['is_have_take_away'];
                    Session::put(SESSION_KEY_SETTING_CURRENT_BRANCH, $settingCurrentBranch);
                }
            }
            return $configAll;
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }

    }

    public function updateSetting(Request $request)
    {
        $branch = $request->get('branch');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_SETTING_BRANCH_POST_UPDATE_SETTING, $branch);
        $body = [
            "branch_id" => $branch,
            "is_working_offline" => (int)$request->get('is_working_offline'),
            "is_allow_advert" => (int)$request->get('is_allow_advert'),
            "is_enable_booking" => (int)$request->get('is_enable_booking'),
            "is_have_take_away" => (int)$request->get('is_take_away'),
            "is_enable_fish_bowl" => (int)$request->get('is_enable_fish_bowl'),
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $dataBranch = Session::get(SESSION_KEY_DATA_BRANCH);
            foreach ($dataBranch as $key => $db) {
                if ($db['id'] === (int)$branch) {
                    $dataBranch[$key]['is_working_offline'] = $config['data']['is_working_offline'];
                    $dataBranch[$key]['is_allow_advert'] = $config['data']['is_allow_advert'];
                    $dataBranch[$key]['is_enable_booking'] = $config['data']['is_enable_booking'];
                    $dataBranch[$key]['is_have_take_away'] = $config['data']['is_have_take_away'];
                    Session::put(SESSION_KEY_DATA_BRANCH, $dataBranch);
                }
            }
            if (Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['id'] === (int)$branch) {
                $dataCurrentBranch = Session::get(SESSION_KEY_DATA_CURRENT_BRANCH);
                $dataCurrentBranch['is_working_offline'] = $config['data']['is_working_offline'];
                $dataCurrentBranch['is_allow_advert'] = $config['data']['is_allow_advert'];
                $dataCurrentBranch['is_enable_booking'] = $config['data']['is_enable_booking'];
                $dataCurrentBranch['is_have_take_away'] = $config['data']['is_have_take_away'];
                Session::put(SESSION_KEY_DATA_CURRENT_BRANCH, $dataCurrentBranch);
                $settingCurrentBranch = Session::get(SESSION_KEY_SETTING_CURRENT_BRANCH);
                $settingCurrentBranch['is_working_offline'] = $config['data']['is_working_offline'];
                $settingCurrentBranch['is_allow_advert'] = $config['data']['is_allow_advert'];
                $settingCurrentBranch['is_enable_booking'] = $config['data']['is_enable_booking'];
                $settingCurrentBranch['is_have_take_away'] = $config['data']['is_have_take_away'];
                Session::put(SESSION_KEY_SETTING_CURRENT_BRANCH, $settingCurrentBranch);
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function updateBanner(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA); // Domain ads để mở media
        $branch_ids = $request->get('branch_ids');
        $img_link = $request->get('img_link');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_SETTING_BRANCH_POST_UPDATE_BANNER, $branch_ids);
        $body = ["img_link" => $img_link, "branch_ids" => $branch_ids,];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        return [
            'status' => $config['status'],
            'message' => $config['message'],
            'banner' => $img_link,
            'url_banner' => $domain . $img_link,
            'config' => $config
        ];
    }

    public function updateLogo(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA); // Domain ads để mở media
        $branch_id = $request->get('branch_id');
        $image_logo_url = $request->get('image_logo_url');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_SETTING_BRANCH_POST_UPDATE_LOGO, $branch_id);
        $body = [
            "image_logo_url" => $image_logo_url,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS){
            $url_logo = $config['data']['image_logo'];
            return [
                'status' => $config['status'],
                'message' => $config['message'],
                'logo' => $url_logo,
                'url_logo' => $domain . $url_logo,
                'config' => $config,
            ];
        }
    }

    public function updateListImage(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $image_urls = $request->get('image_urls');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_SETTING_BRANCH_POST_UPDATE_LIST_IMAGE, $branch_id);
        $body = [
            "image_urls" => $image_urls,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }


    /**
     * Media
     */

    public function createFolder(Request $request)
    {
        $restaurant = Session::get(SESSION_RESTAURANT);
        $branch = $request->get('branch');
        $name = 'Thư mục';
        $project = Config::get('constants.GATEWAY.PROJECT_ID.UPLOAD');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_SETTING_POST_CREATE_FOLDER_MEDIA_BRANCH);
        $body = [
            'folder_name' => $name,
            'restaurant_id' => $restaurant,
            'branch_id' => $branch,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function removeFolder(Request $request)
    {
        $category_id = $request->get('category_id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.UPLOAD');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_SETTING_POST_REMOVE_FOLDER_MEDIA_BRANCH, $category_id);
        $body = [
            "category_id" => $request->get('category_id'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function updateNameFolder(Request $request)
    {
        $restaurant = Session::get(SESSION_RESTAURANT);
        $branch = $request->get('branch');
        $id = $request->get('id');
        $name = $request->get('name');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.UPLOAD');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_SETTING_POST_UPDATE_NAME_FOLDER_MEDIA_BRANCH);
        $body = [
            'category_id' => $id,
            'category_name' => $name,
            'restaurant_id' => $restaurant,
            'branch_id' => $branch,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataFolder(Request $request)
    {
        $restaurant = Session::get(SESSION_RESTAURANT);
        $branch = $request->get('branch');
        $page = $request->get('page');
        $limit = $request->get('limit');
        $key = $request->get('key');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $is_public = Config::get('constants.type.status.GET_ACTIVE');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.UPLOAD');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SETTING_GET_FOLDER_MEDIA_BRANCH, $restaurant, $branch, $page, $limit, $key, $status, $is_public);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $folder = '';
            foreach ($config['data']['list'] as $db) {
                $folder .= '<div class="col-4 item-folder-setting-branch" data-id="' . $db['_id'] . '">
                <div class="card-block2 card card-border-default">
                    <div class="job-cards">
                        <div class="media" style="padding-top: 10px;">
                            <a class="media-left media-middle" href="javascript:void(0)">
                                <img onerror="imageDefaultOnLoadError($(this))" src="images/folder-icon.webp" style="width: auto; height: 60px">
                            </a>
                            <div class="media-body">
                                <div class="company-name m-b-10">
                                <div class="row">
                                <input
                                           class="name-folder-setting-branch col-9" data-validate="empty" data-name="' . $db['folder_name'] . '" value="' . $db['folder_name'] . '" readonly/>
                                           <span class="update-name-folder" data-bs-toggle="tooltip" title="Sửa tên thư mục"><i class="ti-pencil"></i></span>
                                           <span class="save-name-folder d-none" data-bs-toggle="tooltip" title="Xác nhận"><i class="ion-ios-checkmark icon-check-update-name"></i></span>

                                    <i class="text-muted f-14">' . $db['created_at'] . '</i>
                            </div>
                                    </div>
                            </div>
                            <div class="media-right remove-foder" id="remove-focus-folder-branch-setting" data-id="' . $db['_id'] . '" data-bs-toggle="tooltip" title="Xoá thư mục">
                                <i class="ti-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            }
            return [$folder, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function removeMedia(Request $request)
    {
        $media_id = $request->get('media_id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.UPLOAD');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_REMOVE_MEDIA_BRANCH);
        $body = [
            'media_id' => $media_id,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function updateNameMedia(Request $request)
    {
        $category_id = $request->get('category_id');
        $media_id = $request->get('media_id');
        $media_name = $request->get('media_name');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.UPLOAD');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_UPDATE_MEDIA_BRANCH);
        $body = [
            'category_id' => $category_id,
            'media_id' => $media_id,
            'media_name' => $media_name
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }


    public function dataMedia(Request $request)
    {
        $folder = $request->get('folder');
        $page = $request->get('page');
        $limit = $request->get('limit');
        $key = $request->get('key');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.UPLOAD');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SETTING_GET_MEDIA_BRANCH, $folder, $page, $limit, $key, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $media = '';
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            foreach ($config['data']['list'] as $db) {
                if ($db['type'] === 0) {
                    $media .= ' <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 item-media-setting-branch" >
                    <div class="item-box">
                        <div class="over-photo" style="width: fit-content;top: 8px;right: 0;left: unset;bottom: unset;padding-right: 6px">
                              <a href="javascript:void(0)" class="float-right d-none save-name-media" style="margin-right: 3px" onclick="updateNameMediaBranch($(this))"  data-id="' . $db['_id'] . '"><i class="icofont icofont-check save-item-upload-media-setting-branch" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa"></i></a>
                              <a href="javascript:void(0)" class="float-right update-name-media" style="margin-right: 3px" data-id="' . $db['_id'] . '"><i class="fa fa-pencil-square-o  update-item-upload-media-setting-branch" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa"></i></a>
                              <a href="javascript:void(0)" class="float-right" onclick="removeMediaBranch($(this))"  data-id="' . $db['_id'] . '"><i  class="fa fa-times remove-item-upload-media-setting-branch" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_REMOVE . '"></i></a>
                        </div>
                        <input value="' . $db['file_name'] . '" readonly data-name="' . $db['file_name'] . '" class="input-name-media" style="width: 80%; padding: 6px 10px; font-size: 12px!important;">
                        <a class="strip" href="javascript:void(0)" title="" data-strip-group="mygroup"
                           data-strip-group-options="loop: false">
                            <img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $db['link'] . '" alt="" onclick="modalImageComponent(' . "'" . $domain . $db['link'] . "'" . ')"></a>
                        <div class="over-photo">
                            <a href="javascript:void(0)" title=""><i class="fa fa-heart"></i></a>
                            <span>' . $db['created_at'] . '</span>
                        </div>
                    </div>
                </div>';
                } else {
                    $media .= '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 item-media-setting-branch">
                    <div class="item-box">
                        <div class="over-photo">
                              <a href="javascript:void(0)" class="float-right"><i class="fa fa-times remove-item-upload-media-setting-branch" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_REMOVE . '"></i></a>
                        </div>
                        <input value="' . $db['file_name'] . '" class="input-name-media">
                        <a href="' . $domain . $db['link'] . '" title="" data-strip-group="mygroup" class="strip" data-strip-options="width: 700,height: 450,youtube: { autoplay: 1 }"><img onerror="imageDefaultOnLoadError($(this))" src="images/tms/default.jpeg" alt="">
                            <i>
                                <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" height="50px" width="50px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
									<path class="stroke-solid" fill="none" stroke="" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7C97.3,23.7,75.7,2.3,49.9,2.5"></path>
                                    <path class="icon" fill="" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"></path>
								</svg>
                            </i>
                        </a>
                        <div class="over-photo">
                            <a href="javascript:void(0)" title=""><i class="fa fa-heart"></i></a>
                            <span>' . $db['created_at'] . '</span>
                        </div>
                    </div>
                </div>';
                }
            }
            return [$media, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
