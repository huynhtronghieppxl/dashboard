<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class MediaRestaurantMarketingController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'MARKETING_MANAGER']);
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
        $active_nav = 'Banner/Video';
        return view('marketing.media_restaurant.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $type = Config::get('constants.type.MediaContentTypeEnum.GET_ALL');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $brand = $request->get('brand');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_MARKETING_GET_LIST_MEDIA_ADVERT_BRANCH, $brand, $status, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $dataImage = $collection->where('media_type', Config::get('constants.type.MediaContentTypeEnum.IMAGE'))->all();
            $dataVideo = $collection->where('media_type', Config::get('constants.type.MediaContentTypeEnum.VIDEO'))->all();
            $countBannerAdvert = collect($dataImage)->where('is_aloline_advert', ENUM_SELECTED)->count();
            $tableImage = DataTables::of($dataImage)
                ->addColumn('is_running', function ($row) {
                    if ($row['is_running'] === Config::get('constants.type.checkbox.SELECTED')) {
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
                ->addColumn('media_url', function ($row) use ($domain) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" class="img-data-table rounded-circle" onclick="modalImageComponent(' . "'" . $domain . $row['media_url'] . "'" . ')" style="object-fit:cover;" src="' . $domain . $row['media_url'] . '">';
                })
                ->addColumn('action', function ($row) use ($domain) {
                    if ($row['is_running'] === Config::get('constants.type.checkbox.SELECTED')) {
                        return '<div class="btn-group btn-group-sm">
                                    <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="changeIsRunningMedia($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Ngưng"><i class="fi-rr-pause"></i></button>
                                </div>';
                    } else {
                        return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="changeIsRunningMedia($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chạy"><i class="fi-rr-play"></i></button>
                                <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="cancelMedia($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Huỷ"><i class="fi-rr-cross"></i></button>
                            </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['is_running', 'action', 'media_url', 'checkbox'])
                ->addIndexColumn()
                ->make(true);
            $tableVideo = DataTables::of($dataVideo)
                ->addColumn('is_running', function ($row) {
                    if ($row['is_running'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
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
                ->addColumn('media_url', function ($row) use ($domain) {
                    return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="viewVideoMedia(' . "'" . $domain . $row['media_url'] . "'" . ')" data-toggle="tooltip" data-placement="top" data-original-title="Xem"><i class="fi-rr-film"></i></button>
                            </div>';
                })
                ->addColumn('action', function ($row) use ($domain) {
                    if ($row['is_running'] === Config::get('constants.type.checkbox.SELECTED')) {
                        return '<div class="btn-group btn-group-sm">
                                    <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="changeIsRunningMedia($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Ngưng"><i class="fi-rr-pause"></i></button>
                                </div>';
                    } else {
                        return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="changeIsRunningMedia($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chạy"><i class="fi-rr-play"></i></button>
                                <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="cancelMedia($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Huỷ"><i class="fi-rr-cross"></i></button>
                            </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['is_running', 'action', 'media_url'])
                ->addIndexColumn()
                ->make(true);

            $totalMedia = [
                'total_banner_adv' => $this->numberFormat(count($dataImage)),
                'total_video_adv' => $this->numberFormat(count($dataVideo))
            ];

            return [$tableImage, $tableVideo, $totalMedia, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function changeVideoIsRunning(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MARKETING_POST_CHANGE_IS_RUNNING, $id);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function sendBanner(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MARKETING_POST_BANNER_TO_ALOLINE, $id);
        $body = [
            'name' => $request->get('name'),
            'media_url' => $request->get('url'),
            'media_length_by_second' => $request->get('length'),
            'media_type' => $request->get('type'),
            'is_sub_monitor' => $request->get('monitor'),
            'is_aloline_advert' => $request->get('is_aloline_advert')
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function create(Request $request)
    {
        $type = $request->get('type');
        $media = $request->get('media');
        $brand = $request->get('brand');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_UPLOAD_POST_ADV_MARKETING;
        $body = [
            "restaurant_brand_id" => $brand,
            "media_type" => $type,
            "restaurant_private_advert_request" => $media
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function cancel(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MARKETING_POST_CANCEL, $id);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
