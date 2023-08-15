<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use MyCLabs\Enum\Enum;
use Yajra\DataTables\Facades\DataTables;

class DisplaySecondaryPosController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Màn hình phụ';
        return view('marketing.display_secondary.index', compact('active_nav'));
    }


    public function data(Request $request)
    {
        $restaurant_brand_id = $request->get('brand');
        $status = ENUM_SELECTED;
        $media_type = ENUM_MEDIA_IMAGE;
        $is_sub_monitor = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER_VERSION;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_GET_LIST_ADVERTS, $restaurant_brand_id, $status, $media_type, $is_sub_monitor);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $tableImage = DataTables::of($config['data'])
            ->addColumn('is_running', function ($row) {
                if ($row['is_running'] === Config::get('constants.type.checkbox.SELECTED')) {
                    return '<div class="d-flex status-new seemt-green seemt-border-green" style="display: inline !important; max-width: max-content;">
                                 <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                 <label class="m-0">' . TEXT_MEDIA_MARKETING_RUNNING . ' </label>
                            </div>';
                } else {
                    return '<div class="d-flex status-new seemt-blue seemt-border-blue" style="display: inline !important; max-width: max-content;">
                                 <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                 <label class="m-0">' . TEXT_MEDIA_MARKETING_NOT_RUNNING . '</label>
                            </div>';
//                    return '<label class="label label-inverse">' . TEXT_MEDIA_MARKETING_NOT_RUNNING . '</label>';
                }
            })
            ->addColumn('media_url', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" class="img-data-table rounded-circle" onclick="modalImageComponent(' . "'" . $domain . $row['media_url'] . "'" . ')" style="object-fit:cover;" src="' . $domain . $row['media_url'] . '">';
            })
            ->addColumn('action', function ($row) use ($domain) {
                return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="cancelMediaDisplay($(this))" data-id="' . $row['id'] . '" title="Huỷ"><i class="fi-rr-cross"></i></button>
                            </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['is_running', 'action', 'media_url'])
            ->addIndexColumn()
            ->make(true);
        return [$tableImage, $config];
    }

    public function dataContent(Request $request)
    {
        $brand_id = $request->get('brand_id');
        $project = ENUM_PROJECT_ID_ORDER_VERSION;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BRAND_GET_SETTING, $brand_id);
        $body = [];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function createContent(Request $request)
    {
        $content = $request->get('content');
        $brand_id = $request->get('brand_id');
        $project = ENUM_PROJECT_ID_ORDER_VERSION;
        $method = ENUM_METHOD_POST;
        $convert_api = $this->convertApiTemplate(sprintf(API_POST_CONTENT_CREATE, $brand_id));
        $api = $convert_api[0];
        $params = $convert_api[1];
        $body = [
            "sub_monitor_acknowledgements" => $content,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function create(Request $request)
    {
        $media = $request->get('media');
        $brand = $request->get('brand');
        $project = ENUM_PROJECT_ID_ORDER_VERSION;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_UPLOAD_POST_ADV_MARKETING;
        $body = [
            "restaurant_brand_id" => $brand,
            "media_type" => ENUM_MEDIA_IMAGE,
            "restaurant_private_advert_request" => $media,
            "is_sub_monitor" => ENUM_SELECTED
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER_VERSION;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MARKETING_POST_CANCEL, $id);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }


    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER_VERSION;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_MARKETING_GET_LIST_MEDIA_ADVERT_CHANGE_STATUS, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_session_brand = Session::get(SESSION_KEY_DATA_BRAND);
            for ($i = 0; $i < count($data_session_brand); $i++) {
                if ($data_session_brand[$i]['id'] == $request->get('id')) {
                    $data_session_brand[$i]['setting'] = $config['data'];
                    $data_sesstion_current_brand = Session::get(SESSION_KEY_DATA_CURRENT_BRAND);
                    $setting = Session::get((SESSION_KEY_SETTING_CURRENT_BRAND));
                    $setting['is_enable_sub_monitor'] = $config['data']['is_enable_sub_monitor'];
                    Session::forget(SESSION_KEY_SETTING_CURRENT_BRAND);
                    Session::put(SESSION_KEY_SETTING_CURRENT_BRAND, $setting);
                    Session::put(SESSION_KEY_DATA_CURRENT_BRAND, $data_sesstion_current_brand);
                }
            }
            Session::put(SESSION_KEY_DATA_BRAND, $data_session_brand);
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
