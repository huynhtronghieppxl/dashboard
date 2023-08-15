<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Exception;

class BannerController extends Controller
{
    public function index()
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'MARKETING_MANAGER']);
        if ($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if ($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $checkIsOffice = $this->checkOffice(0);
        if ($checkIsOffice[0] === false) {
            $notify_permission = $checkIsOffice[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Banner';
        return view('customer.banner.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $type = ENUM_GET_ALL;
        $status = ENUM_GET_ALL;
        $isRuning = ENUM_GET_ALL;
        $fromDate = '';
        $toDate = '';
        $key = '';
        $limit = ENUM_DEFAULT_LIMIT_100;
        $page = ENUM_DEFAULT_PAGE;
        $api = sprintf(API_GET_LIST_BANNER_ADVERTS, $type, $status, $isRuning, $fromDate, $toDate, $key, $page, $limit);
        $body = null;
        $requestList = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_GET_BANNER_ADVERTS_COUNT_TAB, $type, $status, $isRuning, $fromDate, $toDate, $key);
        $requestTab = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestList, $requestTab]);
        try {
            $collection = collect($configAll[0]['data']['list']);
            $dataDraft = $collection->where('status', 0);
            $dataPending = $collection->where('status', 1);
            $dataApproved = $collection->where('status', 2);
            $dataReject = $collection->where('status', 3);
            $tableDraftBanner = DataTables::of($dataDraft)
                ->addColumn('image_url', function ($row) use ($domain) {
                    return '<img src="' . $domain . $row['image_url'] . '" onerror="imageDefaultOnLoadError($(this))" class="img-inline-name-data-table"  onclick="openModalReviewSetBanner($(this))" data-id="' . $row['id'] . '" data-url="' . $domain . $row['image_url'] . '">';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect seemt-green waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận" onclick="changeStatusSetBanner($(this))" data-id="' . $row['id'] . '">
                                                           <i class="fi-rr-check"></i>
                                                        </button>
                                                         <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect seemt-red waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Xóa" onclick="deleteBannerAdverts($(this))" data-id="' . $row['id'] . '">
                                                            <i class="fi-rr-trash"></i>
                                                        </button>
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa" onclick="openModalUpdateBanner($(this))" data-id="' . $row['id'] . '">
                                                           <i class="fi-rr-pencil"></i>
                                                        </button>
                                                          <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailBanner($(this))" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '"  data-is-running="' . $row['is_runing'] . '" data-created-at="' . $row['created_at'] . '">
                                                          <i class="fi-rr-eye"></i>
                                                        </button>
                                                    </div>';
                })
                ->addColumn('type', function ($row) {
                    switch ($row['type']) {
                        case 0:
                            return 'KHO BEER';
                        case 1:
                            return 'QUÀ TẶNG';
                        case 2:
                            return 'WEB';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchFilterTemplate($row['name']);
                })
                ->addIndexColumn()
                ->rawColumns(['image_url', 'action',])
                ->make(true);
            $tablePendingBanner = DataTables::of($dataPending)
                ->addColumn('image_url', function ($row) use ($domain) {
                    return '<img src="' . $domain . $row['image_url'] . '" onerror="imageDefaultOnLoadError($(this))" class="img-inline-name-data-table"  onclick="openModalReviewSetBanner($(this))" data-id="' . $row['id'] . '" data-url="' . $domain . $row['image_url'] . '">';
                })
                ->addColumn('status_date_draft', function ($row) {
                    return $row['status_date']['draft_date'];
                })
                ->addColumn('type', function ($row) {
                    switch ($row['type']) {
                        case 0:
                            return 'KHO BEER';
                        case 1:
                            return 'QUÀ TẶNG';
                        case 2:
                            return 'WEB';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                                                         <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red seemt-red waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Xóa" onclick="deleteBannerAdverts($(this))" data-id="' . $row['id'] . '">
                                                             <i class="fi-rr-trash"></i>
                                                        </button>
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa" onclick="openModalUpdateBanner($(this))" data-id="' . $row['id'] . '">
                                                           <i class="fi-rr-pencil"></i>
                                                        </button>
                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailBanner($(this))" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '"  data-is-running="' . $row['is_runing'] . '" data-created-at="' . $row['created_at'] . '">
                                                          <i class="fi-rr-eye"></i>
                                                        </button>
                                                    </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchFilterTemplate($row['name']);
                })
                ->addIndexColumn()
                ->rawColumns(['image_url', 'action', 'status_date_draft'])
                ->make(true);
            $tableApprovedBanner = DataTables::of($dataApproved)
                ->addColumn('image_url', function ($row) use ($domain) {
                    return '<img src="' . $domain . $row['image_url'] . '" onerror="imageDefaultOnLoadError($(this))" class="img-inline-name-data-table"  onclick="openModalReviewSetBanner($(this))" data-id="' . $row['id'] . '" data-url="' . $domain . $row['image_url'] . '">';
                })
                ->addColumn('status_date_approved', function ($row) {
                    return $row['status_date']['approved_date'];
                })
                ->addColumn('type', function ($row) {
                    switch ($row['type']) {
                        case 0:
                            return 'KHO BEER';
                        case 1:
                            return 'QUÀ TẶNG';
                        case 2:
                            return 'WEB';
                    }
                })
                ->addColumn('is_runing', function ($row) {
                    if ($row['is_runing'] === Config::get('constants.type.checkbox.SELECTED')) {
                        return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">' . TEXT_MEDIA_MARKETING_RUNNING . '</label>
                                </div>';
                    } else {
                        return '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">' . TEXT_MEDIA_MARKETING_NOT_RUNNING . '</label>
                                </div>';
                    }
                })
                ->addColumn('action', function ($row) use ($domain) {
                    if ($row['is_runing'] === Config::get('constants.type.checkbox.SELECTED')) {
                        return '<div class="btn-group btn-group-sm">
                                    <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="changeIsRunningBanner($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Tạm ngưng"><i class="fi-rr-pause"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailBanner($(this))" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '"  data-is-running="' . $row['is_runing'] . '" data-created-at="' . $row['created_at'] . '">
                                             <i class="fi-rr-eye"></i>
                                    </button>
                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red seemt-red waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Xóa" onclick="deleteBannerAdverts($(this))" data-id="' . $row['id'] . '">
                                           <i class="fi-rr-trash"></i>
                                    </button>
                                </div>';
                    } else {
                        return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="changeIsRunningBanner($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chạy"><i class="fi-rr-play"></i></button>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa" onclick="openModalUpdateBanner($(this))" data-id="' . $row['id'] . '">
                                             <i class="fi-rr-pencil"></i>
                                     </button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailBanner($(this))" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '"  data-is-running="' . $row['is_runing'] . '" data-created-at="' . $row['created_at'] . '">
                                     <i class="fi-rr-eye"></i>
                                </button>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Xóa" onclick="deleteBannerAdverts($(this))" data-id="' . $row['id'] . '">
                                    <i class="fi-rr-trash"></i>
                                </button>
                            </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchFilterTemplate($row['name']);
                })
                ->addIndexColumn()
                ->rawColumns(['image_url', 'action', 'status_date_pendding', 'is_runing'])
                ->make(true);
            $tableRejectBanner = DataTables::of($dataReject)
                ->addColumn('image_url', function ($row) use ($domain) {
                    return '<img src="' . $domain . $row['image_url'] . '" onerror="imageDefaultOnLoadError($(this))" class="img-inline-name-data-table"  onclick="openModalReviewSetBanner($(this))" data-id="' . $row['id'] . '" data-url="' . $domain . $row['image_url'] . '">';
                })
                ->addColumn('type', function ($row) {
                    switch ($row['type']) {
                        case 0:
                            return 'KHO BEER';
                        case 1:
                            return 'QUÀ TẶNG';
                        case 2:
                            return 'WEB';
                    }
                })
                ->addColumn('status_date_rejected', function ($row) {
                    return $row['status_date']['rejected_date'];
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailBanner($(this))" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '"  data-is-running="' . $row['is_runing'] . '" data-created-at="' . $row['created_at'] . '">
                                                                                 <i class="fi-rr-eye"></i>
                                                                             </button>
                                                                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchFilterTemplate($row['name']);
                })
                ->addIndexColumn()
                ->rawColumns(['image_url', 'action', 'status_date_rejected'])
                ->make(true);
            $dataTotal = [
                'total_record_draft' => $this->numberFormat($configAll[1]['data']['total_draft']),
                'total_record_pendding' => $this->numberFormat($configAll[1]['data']['total_pending']),
                'total_record_approved' => $this->numberFormat($configAll[1]['data']['total_approved']),
                'total_record_rejected' => $this->numberFormat($configAll[1]['data']['total_rejected']),
            ];
            return [$tableDraftBanner, $tablePendingBanner, $tableApprovedBanner, $tableRejectBanner, $configAll, $dataTotal];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function create(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $name = $request->get('name');
        $imageUrl = $request->get('image_url');
        $landingPageUrl = $request->get('landing_page_url');
        $restaurantGiftID = $request->get('restaurant_gift_id');
        $type = $request->get('type');
        $api = sprintf(API_POST_CREATE_BANNER_ADVERTISEMENT);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $body = [
            'name' => $name,
            'image_url' => $imageUrl,
            'landing_page_url' => $landingPageUrl,
            'restaurant_gift_id' => $restaurantGiftID,
            'type' => $type
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
            $config['data']['image_url'] = '<img src="' . $domain . $config['data']['image_url'] . '" onerror="imageDefaultOnLoadError($(this))" class="img-inline-name-data-table"  onclick="openModalReviewSetBanner($(this))" data-id="' . $config['data']['id'] . '" data-url="' . $domain . $config['data']['image_url'] . '">';
            switch ($config['data']['type']) {
                case 0:
                    $config['data']['type'] = 'KHO BEER';
                    break;
                case 1:
                    $config['data']['type'] = 'QUÀ TẶNG';
                    break;
                case 2:
                    $config['data']['type'] = 'WEB';
                    break;
            }
            $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect seemt-green waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận" onclick="changeStatusSetBanner($(this))" data-id="' . $config['data']['id'] . '">
                                                           <i class="fi-rr-check"></i>
                                                        </button>
                                                         <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect seemt-red waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Xóa" onclick="deleteBannerAdverts($(this))" data-id="' . $config['data']['id'] . '">
                                                            <i class="fi-rr-trash"></i>
                                                        </button>
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa" onclick="openModalUpdateBanner($(this))" data-id="' . $config['data']['id'] . '">
                                                           <i class="fi-rr-pencil"></i>
                                                        </button>
                                                          <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailBanner($(this))" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '"  data-is-running="' . $config['data']['is_runing'] . '" data-created-at="' . $config['data']['created_at'] . '">
                                                          <i class="fi-rr-eye"></i>
                                                        </button>
                                                    </div>';
            $config['data']['keysearch'] = $this->keySearchFilterTemplate($config['data']['name']);
        }
        return $config;
    }

    public function update(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $id = $request->get('id');
        $name = $request->get('name');
        $imageUrl = $request->get('image_url');
        $landingPageUrl = $request->get('landing_page_url');
        $restaurantGiftID = $request->get('restaurant_gift_id');
        $type = $request->get('type');
        $api = sprintf(API_POST_UPDATE_BANNER_ADVERTISEMENT, $id);
        $body = [
            'name' => $name,
            'image_url' => $imageUrl,
            'landing_page_url' => $landingPageUrl,
            'restaurant_gift_id' => $restaurantGiftID,
            'type' => $type
        ];
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
            $config['data']['image_url'] = '<img src="' . $domain . $config['data']['image_url'] . '" onerror="imageDefaultOnLoadError($(this))" class="img-inline-name-data-table"  onclick="openModalReviewSetBanner($(this))" data-id="' . $config['data']['id'] . '" data-url="' . $domain . $config['data']['image_url'] . '">';
            switch ($config['data']['type']) {
                case 0:
                    $config['data']['type'] = 'KHO BEER';
                    break;
                case 1:
                    $config['data']['type'] = 'QUÀ TẶNG';
                    break;
                case 2:
                    $config['data']['type'] = 'WEB';
                    break;
            }
            $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect seemt-green waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Xác nhận" onclick="changeStatusSetBanner($(this))" data-id="' . $config['data']['id'] . '">
                                                           <i class="fi-rr-check"></i>
                                                        </button>
                                                         <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect seemt-red waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Xóa" onclick="deleteBannerAdverts($(this))" data-id="' . $config['data']['id'] . '">
                                                            <i class="fi-rr-trash"></i>
                                                        </button>
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa" onclick="openModalUpdateBanner($(this))" data-id="' . $config['data']['id'] . '">
                                                           <i class="fi-rr-pencil"></i>
                                                        </button>
                                                          <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailBanner($(this))" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '"  data-is-running="' . $config['data']['is_runing'] . '" data-created-at="' . $config['data']['created_at'] . '">
                                                          <i class="fi-rr-eye"></i>
                                                        </button>
                                                    </div>';
            $config['data']['keysearch'] = $this->keySearchFilterTemplate($config['data']['name']);
        }
        return $config;
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_DETAIL_BANNER_ADVERTISEMENT, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);

        $type = Config::get('constants.type.checkbox.DIS_SELECTED');
        $api = sprintf(API_GIFT_MARKETING_GET_NEW_CUSTOMER, $type);
        $config1 = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['domain'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            }
            $gift = '<option hidden disabled selected value="0">' . TEXT_DEFAULT_OPTION . '</option>';
            if (count($config1['data']['list']) === 0) {
                $gift = '<option selected>' . TEXT_NULL_OPTION . '</option>';
            }
            foreach ($config1['data']['list'] as $db) {
                $gift .= '<option value="' . $db['restaurant_gift_id'] . '">' . $db['name'] . '</option>';
            }
            return [$config, $config['data'], $gift, $config1];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_DETAIL_BANNER_ADVERTISEMENT, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $config['data']['domain'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        return $config;
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_CHANGE_STATUS_BANNER_ADVERTISEMENT, $id);
        $body = null;
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
            $config['data']['image_url'] = '<img src="' . $domain . $config['data']['image_url'] . '" onerror="imageDefaultOnLoadError($(this))" class="img-inline-name-data-table"  onclick="openModalReviewSetBanner($(this))" data-id="' . $config['data']['id'] . '" data-url="' . $domain . $config['data']['image_url'] . '">';
            $config['data']['status_date_draft'] = $config['data']['status_date']['draft_date'];
            switch ($config['data']['type']) {
                case 0:
                    $config['data']['type'] = 'KHO BEER';
                    break;
                case 1:
                    $config['data']['type'] = 'QUÀ TẶNG';
                    break;
                case 2:
                    $config['data']['type'] = 'WEB';
                    break;
            }
            $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                                         <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red seemt-red waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Xóa" onclick="deleteBannerAdverts($(this))" data-id="' . $config['data']['id'] . '">
                                                             <i class="fi-rr-trash"></i>
                                                        </button>
                                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa" onclick="openModalUpdateBanner($(this))" data-id="' . $config['data']['id'] . '">
                                                           <i class="fi-rr-pencil"></i>
                                                        </button>
                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailBanner($(this))" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '"  data-is-running="' . $config['data']['is_runing'] . '" data-created-at="' . $config['data']['created_at'] . '">
                                                          <i class="fi-rr-eye"></i>
                                                        </button>
                                                    </div>';
            $config['data']['keysearch'] = $this->keySearchFilterTemplate($config['data']['name']);
        }
        return $config;
    }

    public function deleteBannerAdverts(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_DELETE_BANNER_ADVERTISEMENT, $id);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function changeBannerIsRunning(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_CHANGE_IS_RUNNING_BANNER_ADVERTISEMENT, $id);
        $body = null;
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
        $type = Config::get('constants.type.checkbox.DIS_SELECTED');
        $api = sprintf(API_GIFT_MARKETING_GET_NEW_CUSTOMER, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $gift = '<option hidden disabled selected value="0">' . TEXT_DEFAULT_OPTION . '</option>';
            if (count($config['data']['list']) === 0) {
                $gift = '<option selected>' . TEXT_NULL_OPTION . '</option>';
            }
            foreach ($config['data']['list'] as $db) {
                $gift .= '<option value="' . $db['restaurant_gift_id'] . '">' . $db['name'] . '</option>';
            }
            return [$gift, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
