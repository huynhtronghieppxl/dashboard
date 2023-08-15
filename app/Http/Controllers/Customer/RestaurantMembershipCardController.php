<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class RestaurantMembershipCardController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Thẻ thành viên';
        return view('customer.restaurant_membership_card.index', compact('active_nav'));
    }

    public function dataBranch(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS); // Domain ads để mở media
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_BRAND_GET_DATA, $status);
        $body = null;
        $config1 = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $data = $config1['data'];
        if ($data !== null || !empty($data)) {
            $listBranch = '';
            for ($i = 0; $i < count($data); $i++) {
                $number_status = $data[$i]['status'];
                if ($data[$i]['status'] === (int)Config::get('constants.type.status.GET_ACTIVE')) {
                    $status = '<span class="text-white" value="' . $number_status . '" id="branch-setting-status">Đang hoạt động<i class="fa fa-check-circle text-success pl-1"></i> </span>';
                } else {
                    $status = '<span class="text-white" value="' . $number_status . '" id="branch-setting-status">Không hoạt động <i class="fa fa-ban text-danger"></i></span>';
                }
                $dataBanner = $domain . $data[$i]['banner'];
                $dataImage = $domain . $data[$i]['logo_url'];
                $button = '';
                $action = '<ul class="profile-controls" style="bottom: 91px !important;">
                                    <li data-toggle="tooltip" data-original-title="" data-placement="top">
                                        <input type="checkbox"  id="enable_membershipcard" class="js-single" data-id="' . $data[$i]['id'] . '" checked onchange="changeStatusBranchMemberShipCard($(this))">
                                    </li>
                                </ul>';


                $ulDetail = '<ul class="profile-controls">
                                        <li data-toggle="tooltip" data-original-title="" data-placement="top">
                                            <div class="pointer btn-radius-50" style="background: #2F9672; color: #ffffff">
                                                    <i class="fa fa-check"></i>
                                            </div>
                                        </li>
                                        <li data-toggle="tooltip" data-original-title="" data-placement="top">
                                            <div class="pointer branch-setting-detail  btn-radius-50 seemt-btn-hover-blue" data-status="' . $data[$i]['status'] . '" data-id="' . $data[$i]['id'] . '" data-name="' . $data[$i]['name'] . '"
                                            data-logo="' . $dataImage . '" data-banner="' . $dataBanner . '" onclick="dataProfileBranch($(this))">
                                                <i class="fi-rr-eye"></i>
                                            </div>
                                        </li>
                                    </ul>';
                $listBranch .= '<div class="col-xl-6 col-lg-12 edit-flex-auto-fill">
                                    <div class="box-image" style="height: max-content">
                                        <figure class="box-image-banner">
                                            <img onerror="imageDefaultOnLoadError($(this))" src="' . $dataBanner . '" alt="" class="thumbnail-banner">
                                                      ' . $ulDetail . '
                                                      ' . $action . '
                                        </figure>
                                        <div class="col-12" style="position: absolute; bottom: 20px">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="profile-branch">
                                                        <div class="profile-branch-thumb">
                                                            <img onerror="imageDefaultOnLoadError($(this))" alt="author" class="thumbnail-branch-logo-booking" src="' . $dataImage . '">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div class="author-content">
                                                       <a class="custom-name ' . $data[$i]['name'] . '">' . $data[$i]['name'] . '</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
            }
        }
        return [
            'list-branch-membership' => $listBranch,
            'config' => $config1
        ];
    }

    public function data(Request $request)
    {
        $api = sprintf(API_MEMBERSHIP_CARD_GET);
        $body = null;
        $requestMembershipCard = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $isCard = Config::get('constants.type.checkbox.GET_ALL');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $api = sprintf(API_SETTING_BRANCH_GET_CARD, $restaurantBrandID, $status, $isCard);
        $body = null;
        $requestBranch = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestMembershipCard, $requestBranch]);
        try {
            $config = $configAll[0];
            $data = $config['data'];
            $recordCard = $this->numberFormat(count($data));
            $dataTableList = DataTables::of($data)
                ->addColumn('color', function ($row) {
                    return '<div class="waves-effect waves-light w-75 h-1rem m-auto" style="background-color: ' . $row['color_hex_code'] . '"></div>';
                })
                ->addColumn('total_amount_to_level_up', function ($row) {
                    return $this->numberFormat($row['total_amount_to_level_up']);
                })
                ->addColumn('month_to_expire_promotion_point', function ($row) {
                    $month = TEXT_MONTH;
                    if($row['month_to_expire_promotion_point'] != TEXT_NONE_MONTH) {
                    return  '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0" style="margin-left: -12px !important;">' . $row['month_to_expire_promotion_point'] . ' ' . $month . '</label>
                                </div>';
                    } else {
                        return  '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0" style="margin-left: -12px !important;">' . TEXT_FOREVER_MONTH . '</label>
                                </div>';
                    }
                })
                ->addColumn('cashback_to_point_percent', function ($row) {
                    return $this->numberFormat($row['cashback_to_point_percent']) . '%';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-color="' . $row['color_hex_code'] . '" data-point="' . $this->numberFormat($row['total_amount_to_level_up']) . '" data-discount="' . $row['cashback_to_point_percent'] . '" data-month="' . $this->numberFormat($row['month_to_expire_promotion_point']) . '" data-create="' . $row['created_at'] . '" onclick="openModalUpdateMemberShipCard($(this))"><i class="fi-rr-pencil" style="display: contents"></i></button></div>';
                })
                ->rawColumns(['color', 'action', 'month_to_expire_promotion_point'])
                ->addIndexColumn()
                ->make(true);

            $config = $configAll[1];
            $data = $config['data'];
            $collection = collect($data);
            $dataEnable = $collection->where('is_enable_membership_card', 1)->all();
            $dataDisable = $collection->where('is_enable_membership_card', 0)->all();
            $dataTableBranchEnable = DataTables::of($dataEnable)
                ->addColumn('maximum', function ($row) {
                    return '<label onclick="chageInputBranchValueRestaurantMembershipCard($(this))" class="label-maximum" title="Nhấn vào để đổi số điểm tối đa được đổi trong mỗi hóa đơn !">' . $this->numberFormat($row['maximum_promotion_point_allow_use_in_each_bill']) . '</label><input class="form-control d-none text-right w-75 m-auto input-maximum" data-type="currency-edit" value="' . $this->numberFormat($row['maximum_promotion_point_allow_use_in_each_bill']) . '"/>';
                })
                ->addColumn('action', function ($row) {
                    $update = TEXT_UPDATE;
                    $disable = TEXT_DISABLE_STATUS;
                    return '<div class="btn-group btn-group-sm">
                    <button type="button" class="tabledit-edit-button btn btn-success waves-effect waves-light d-none btn-save" data-id="' . $row['id'] . '" onclick="saveBranchMemberShipCard($(this))" title="' . $update . '"><span class="icofont icofont-ui-check"></span></button>
                    <button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" data-status="0" data-maximum="' . $row['maximum_promotion_point_allow_use_in_each_bill'] . '" onclick="changeStatusBranchMemberShipCard($(this))" title="' . $disable . '"><span class="icofont icofont-ui-close"></span></button></div>';
                })
                ->rawColumns(['maximum', 'action'])
                ->addIndexColumn()
                ->make(true);

            $dataTableBranchDisable = DataTables::of($dataDisable)
                ->addColumn('maximum', function ($row) {
                    return $this->numberFormat($row['maximum_promotion_point_allow_use_in_each_bill']);
                })
                ->addColumn('action', function ($row) {
                    $enable = TEXT_ENABLE;
                    return '<div class="btn-group btn-group-sm">
                    <button type="button" class="tabledit-edit-button btn btn-success waves-effect waves-light" data-id="' . $row['id'] . '" data-status="1" data-maximum="' . $row['maximum_promotion_point_allow_use_in_each_bill'] . '" onclick="changeStatusBranchMemberShipCard($(this))" title="' . $enable . '"><span class="icofont icofont-ui-check"></span></button></div>';
                })
                ->rawColumns(['maximum', 'action'])
                ->addIndexColumn()
                ->make(true);

            $dataTotal = [
                'total_record_list' => $recordCard,
                'total_record_branch_enable' => $this->numberFormat(count($dataEnable)),
                'total_record_branch_disable' => $this->numberFormat(count($dataDisable)),
            ];

            return [$dataTableList, $dataTableBranchEnable, $dataTableBranchDisable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $projectID = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MEMBERSHIP_CARD_GET_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($projectID, $method, $api, $body);
        try {
            $data = $config['data'];
            $data['month_to_expire_promotion_point'] = $data['month_to_expire_promotion_point'] . ' ' . TEXT_MONTH;;
            return [$data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataTemplate(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MEMBERSHIP_CARD_POST_DATA);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        return [$config['data'], $config];
    }

    public function create(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MEMBERSHIP_CARD_POST);
        $body = [
            'membership_card_id' => $request->get('id'),
            'name' => $request->get('name'),
            'color_hex_code' => $request->get('color_hex_code'),
            'total_amount_to_level_up' => $request->get('total_amount_to_level_up'),
            'cashback_to_point_percent' => $request->get('cashback_to_point_percent'),
            'month_to_expire_promotion_point' => $request->get('month_to_expire_promotion_point'),
            'point_to_level_up' => Config::get('constants.type.data.NONE'),
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        return $config;
    }

    public function update(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MEMBERSHIP_CARD_POST_UPDATE, $request->get('id'));
        $body = [
            'membership_card_id' => $request->get('id'),
            'name' => $request->get('name'),
            'color_hex_code' => $request->get('color_hex_code'),
            'total_amount_to_level_up' => $request->get('total_amount_to_level_up'),
            'cashback_to_point_percent' => $request->get('cashback_to_point_percent'),
            'month_to_expire_promotion_point' => $request->get('month_to_expire_promotion_point'),
            'point_to_level_up' => Config::get('constants.type.data.NONE'),
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        return $config;
    }

    public function changeStatusRestaurant(Request $request)
    {
        $id = Session::get(SESSION_RESTAURANT);
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MEMBERSHIP_CARD_POST_CHANGE_ENABLE_RESTAURANT, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === (int)Config::get('constants.type.status.STATUS_SUCCESS')) {
            Session::put(SESSION_KEY_SETTING_RESTAURANT, $config['data']);
        }
        return $config;
    }

    public function updateBranch(Request $request)
    {
        $id = $request->get('id');
        $maximum = $request->get('maximum');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $method = 'POST';
        $api = sprintf(Config::get('constants.api.r'), $id);
        $body = [
            "maximum_promotion_point_allow_use_in_each_bill" => $maximum,
            "status" => $status
        ];
        $config = $this->callApiTemplate($request, $method, $api, $body);
        return $config;
    }

    public function updateStatusBranch(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MEMBERSHIP_CARD_POST_CHANGE_STATUS_BRAND, $request->get('id'));
        $body = [
            "maximum_promotion_point_allow_use_in_each_bill" => $request->get('maximum'),
            "is_enable_membership_card" => $request->get('status')
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $dataSessionBrand = Session::get(SESSION_KEY_DATA_BRAND);
        for ($i = 0; $i < count($dataSessionBrand); $i++) {
            if ($dataSessionBrand[$i]['id'] == $request->get('id')) {
                $dataSessionBrand[$i]['setting'] = $config['data'];
                $dataSessionCurrentBrand = Session::get(SESSION_KEY_DATA_CURRENT_BRAND);
                $setting = Session::get((SESSION_KEY_SETTING_CURRENT_BRAND));
                $setting['is_enable_membership_card'] = $config['data']['is_enable_membership_card'];
                Session::forget(SESSION_KEY_SETTING_CURRENT_BRAND);
                Session::put(SESSION_KEY_SETTING_CURRENT_BRAND, $setting);
                Session::put(SESSION_KEY_DATA_CURRENT_BRAND, $dataSessionCurrentBrand);
            }
        }
        Session::put(SESSION_KEY_DATA_BRAND, $dataSessionBrand);
        return $config;
    }

    public function changeStatusMemberShipRestaurant(Request $request)
    {
        $restaurantID = Session::get(SESSION_RESTAURANT);
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MEMBERSHIP_CARD_POST_CHANGE_ENABLE_RESTAURANT, $restaurantID);
        $body = [
            'status' => 0
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        return  $config;
    }

    public function setting(Request $request)
    {
        $useGuide = $request->get('use_guide');
        $policy = $request->get('policy');
        $api = sprintf(API_MEMBERSHIP_CARD_POST_DATA_SETTING);
        $body = [
            'use_guide' => $useGuide,
            'policy' => $policy,
        ];
        $requestSettingMemberShipCard = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.POST'),
            'api' => $api,
            'body' => $body,
        ];
        $restaurant = Session::get(SESSION_RESTAURANT);
        $api = sprintf(API_MEMBERSHIP_CARD_POST_DATA_CONFIG, $restaurant);
        $body = [
            'maximum_percent_order_amount_to_promotion_point_allow_use_in_each_bill' => $request->get('amount'),
            'maximum_percent_order_amount_to_alo_point_allow_use_in_each_bill' => $request->get('amount_alo_point'),
            'maximum_money_by_alo_point_allow_use_in_each_bill' => $request->get('alo_point'),
        ];
        $requestSettingRestaurnatMemberShipCard = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.POST'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_POST_SETTING_MEMBER_SHIP_CARD, $restaurant);
        $body = null;
        $requestSettingRestaurantMemberShipCard = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.POST'),
            'api' => $api,
            'body' => $body,
        ];

        if($request->get('status') === 1){
            $configAll = $this->callApiMultiGatewayTemplate2([$requestSettingRestaurantMemberShipCard]);
        }else{
            $configAll = $this->callApiMultiGatewayTemplate2([$requestSettingRestaurantMemberShipCard,$requestSettingMemberShipCard, $requestSettingRestaurnatMemberShipCard]);
        }
        if ($configAll[0]['status'] === (int)Config::get('constants.type.status.STATUS_SUCCESS')) {
                Session::put(SESSION_KEY_SETTING_RESTAURANT, $configAll[0]['data']);
        }
        return $configAll;
    }


    public function Updatesetting(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MEMBERSHIP_CARD_POST_DATA_SETTING);
        $body = [
            'membership_card_condition_policy' => $request->get('condition'),
            'membership_card_point_policy' => $request->get('point'),
            'membership_card_benefit_policy' => $request->get('benefit'),
            'membership_card_level_policy' => $request->get('level'),
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $config1 = $config;
        $api = sprintf(API_MEMBERSHIP_CARD_POST_DATA_CONFIG);
        $body = [
            'maximum_percent_order_amount_to_promotion_point_allow_use_in_each_bill' => $request->get('amount'),
            'maximum_percent_order_amount_to_alo_point_allow_use_in_each_bill' => $request->get('amount_alo_point'),
            'maximum_money_by_alo_point_allow_use_in_each_bill' => $request->get('alo_point'),
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $config2 = $config;
        if ($config['status'] === (int)Config::get('constants.type.status.STATUS_SUCCESS')) {
            Session::put(SESSION_KEY_DATA_RESTAURANT, $config['data']);
        }
        $config['config1'] = $config1;
        $config['config2'] = $config2;
        return $config;
    }

    public function dataSetting(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $restaurant = Session::get(SESSION_KEY_BRAND_ID_CURRENT);
        $api = sprintf(API_MEMBERSHIP_CARD_GET_DETAIL, $restaurant);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function detailPolicy(Request $request)
    {
        $id = Session::get(SESSION_RESTAURANT);
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_DETAIL_SETTING_MEMBER_SHIP_CARD);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);

        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MEMBERSHIP_CARD_POST_CHANGE_ENABLE_RESTAURANT ,$id);
        $body = null;
        $config_post = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        return [$config, $config_post];

    }

    public function updateMemberShipCard(Request $request)
    {
        $api = sprintf(API_MEMBERSHIP_CARD_POST_DATA_SETTING);
        $body = [
            'use_guide' => $request->get('use_guide'),
            'policy' => $request->get('policy'),
        ];
        $settingUpdatePolicy = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.POST'),
            'api' => $api,
            'body' => $body
        ];
        $restaurant = Session::get(SESSION_RESTAURANT);
        $api = sprintf(API_MEMBERSHIP_CARD_GET_DATA_CONFIG, $restaurant);
        $body = [
            'maximum_percent_order_amount_to_promotion_point_allow_use_in_each_bill' => $request->get('amount'),
            'maximum_percent_order_amount_to_alo_point_allow_use_in_each_bill' => $request->get('amount_alo_point'),
            'maximum_money_by_alo_point_allow_use_in_each_bill' => $request->get('alo_point'),
        ];
        $settingUpdatePointPolicy = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.POST'),
            'api' => $api,
            'body' => $body
        ];
        $config = $this->callApiMultiGatewayTemplate2([$settingUpdatePolicy]);
        return $config;
    }
}



