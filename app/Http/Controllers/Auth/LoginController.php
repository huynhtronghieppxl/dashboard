<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Facades\Agent;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $data_env['APP_NAME'] = env('APP_NAME');
        $data_env['APP_ENV'] = env('APP_ENV');
        $data_env['IS_DEPLOY_ON_SERVER'] = env('IS_DEPLOY_ON_SERVER');
        $data_env['APP_KEY'] = env('APP_KEY');
        $data_env['APP_DEBUG'] = env('APP_DEBUG');
        $data_env['APP_URL'] = env('APP_URL');
        $data_env['HOST_API_OAUTH'] = env('HOST_API_OAUTH');
        $data_env['PROJECT_ID'] = env('PROJECT_ID');
        $data_env['PROJECT_ID_ALOLINE'] = env('PROJECT_ID_ALOLINE');
        $data_env['IMG_DEFAULT'] = env('IMG_DEFAULT');
        $data_env['IMAGE_DEFAULT'] = env('IMAGE_DEFAULT');
        $data_env['BACKGROUND_DEFAULT'] = env('BACKGROUND_DEFAULT');
        $data_env['DOMAIN_GATEWAY'] = env('DOMAIN_GATEWAY');

        Session::put('ENV', $data_env);
        return view("auth/login_ver4");
    }

    public function postLogin(Request $request)
    {
        $restaurant_name = $request->get('restaurant_name');
        $username = $request->get('username');
        $password = $request->get('password');
        $token = $request->get('token');
        $time_zone = $request->get('time_zone');
        return $this->getSession($restaurant_name, $username, $password, $token, $time_zone);
    }

    public function getSession($restaurant_name, $username, $password, $token, $time_zone)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = API_AUTH_GET_SESSIONS_JAVA;
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            Session::put(SESSION_JAVA_KEY_SESSION, $config['data']);
            return $this->getConfigs($restaurant_name, $username, $password, $token, $time_zone);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function getConfigs($restaurant_name, $username, $password, $token, $time_zone)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_AUTH_GET_CONFIG, $restaurant_name, Config::get('app.PROJECT_ID'));
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $minutes = 60;
        Session::put(SESSION_JAVA_TOKEN_NOTIFICATION, $token);
        Cookie::queue('KEY_TOKEN_NOTIFICATION', $token, $minutes);
        try {
            $data = $config['data'];
            Session::put(SESSION_KEY_CONFIG, $data);
            Session::put(SESSION_NODE_DOMAIN, $data['api_chat_tms']);
            Session::put(SESSION_JAVA_DOMAIN, $data['api_domain']);
            Session::put(SESSION_NODE_KEY_BASE_URL_ADS, $data['api_upload_v2']);
            Session::put(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA, $data['api_upload_short']);
            Session::put(SESSION_JAVA_TOKEN_OAUTH, $data['api_key']);
            return $this->doLogin($username, $password, $time_zone);
        } catch (Exception $e) {
            return [$config, $e->getLine(), 'getConfigs'];
        }
    }

    public function doLogin($username, $password, $time_zone)
    {
        preg_match('#\((.*?)\)#', $_SERVER['HTTP_USER_AGENT'], $test);
        $device_uid = "WebDashBoard_" . Session::get(SESSION_JAVA_TOKEN_NOTIFICATION);
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_AUTH_POST_LOGIN_JAVA;
        $body = [
            'username' => $username,
            'password' => base64_encode($password),
            "device_uid" => md5($device_uid),
            "app_type" => 4,
            "time_zone" => $time_zone
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] !== 200) {
                return [$config, 'doLogin'];
            }
            $data = $config['data'];
            if (!in_array('OWNER', $data['permissions']) && !in_array('DASHBOARD_WEB_ACCESS', $data['permissions']) && !in_array('VIEW_ALL', $data['permissions'])) {
                $config['web'] = 0;
                return [$config, 'doLogin'];
            }
            Session::put(SESSION_JAVA_ACCOUNT, $data);
            Session::put(SESSION_RESTAURANT, $data['restaurant_id']);
            Session::put(SESSION_KEY_BRAND_ID, $data['restaurant_brand_id']);
            Session::put(SESSION_KEY_BRAND_ID_DEFAULT, $data['restaurant_brand_id']);
            Session::put(SESSION_KEY_BRAND_ID_CURRENT, $data['restaurant_brand_id']);
            Session::put(SESSION_KEY_BRANCH_ID, $data['branch_id']);
            Session::put(SESSION_KEY_BRANCH_ID_DEFAULT, $data['branch_id']);
            Session::put(SESSION_KEY_BRANCH_ID_CURRENT, $data['branch_id']);
            /**
             * Permission
             */
            Session::put(SESSION_PERMISSION, $data['permissions']);
            if (in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('VIEW_ALL', Session::get(SESSION_PERMISSION))) {
                Session::put(SESSION_KEY_PERMISSION_TALLEST, 3);
            } else if (in_array('BRAND_MANAGER', Session::get(SESSION_PERMISSION)) || in_array('RESTAURANT_MANAGER', Session::get(SESSION_PERMISSION))) {
                Session::put(SESSION_KEY_PERMISSION_TALLEST, 2);
            } else if (in_array('BRANCH_MANAGER', Session::get(SESSION_PERMISSION))) {
                Session::put(SESSION_KEY_PERMISSION_TALLEST, 1);
            } else {
                Session::put(SESSION_KEY_PERMISSION_TALLEST, 0);
            }
            Session::put(SESSION_JAVA_TOKEN, $data['access_token']);
            Session::put(SESSION_KEY_AVATAR, $data['avatar']);
            Session::put(SESSION_KEY_AVATAR_DEFAULT, '');
            Session::put(SESSION_KEY_LENGTH_DATA_TABLE, Config::get('app.LENGTH_DATATABLE'));
            Session::put(SESSION_KEY_VERSION_DASHBOARD, Config::get('constants.version.VERSION_DASHBOARD') . '.' . Config::get('constants.version.MONTH') . '.' . Config::get('constants.version.VERSION_UPDATE'));
            Session::put(SESSION_STATUS_SERVER, 0);
            Session::put(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT, $config['data']['jwt_token']);
//            return $this->createEmployeeNode();
            return $this->getSetting();
        } catch (Exception $e) {
            Session::forget(SESSION_JAVA_ACCOUNT);
            return [$config, $e->getLine(), 'doLogin'];
        }
    }


    public function createEmployeeNode()
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH_NODE');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_AUTH_API_CREATE_EMPLOYEE;
        $body = [
            'os_name' => Config::get('app.PROJECT_NAME'),
            'user_id' => Session::get(SESSION_JAVA_ACCOUNT)['id'],
            'device_name' => '',
            'device_uid' => '',
            'ip_address' => '',
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            return $this->getSetting();
        } catch (Exception $e) {
            Session::forget(SESSION_JAVA_ACCOUNT);
            return [$config, $e->getLine(), 'doLogin'];
        }
    }

    public function getSetting()
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH2');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = API_AUTH_GET_SETTING;
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            if ($data['branch_type'] < 2) {
                Session::forget(SESSION_JAVA_ACCOUNT);
                return [0 => ['message' => 'Tài khoản của bạn không có quyền truy cập Web', "status" => 401]];
            }

            Session::put(SESSION_KEY_ACTIVE_FACEBOOK, false);
            Session::put(SESSION_KEY_PATH_ORDER, '/api/large');
            Session::put(SESSION_KEY_PATH_ORDER_VERSION, '/api/v2/large');
            Session::put(SESSION_KEY_DATA_SETTING, $data);

            Session::put(SESSION_KEY_IS_ENABLE_RESTAURANT_MEMBERSHIP_CARD, $data['is_enable_membership_card']);
            Session::put(SESSION_JAVA_BASE_URL, Session::get(SESSION_JAVA_DOMAIN) . $data['api_prefix_path_for_branch_type']);
            Session::put(SESSION_KEY_LEVEL, $data['service_restaurant_level_id']);
            Session::put(SESSION_KEY_HOUR_TO_TAKE_REPORT, $data['hour_to_take_report']);
            return $this->getSettingAll();
        } catch (Exception $e) {
            Session::forget(SESSION_JAVA_ACCOUNT);
            return [$config, $e->getLine(), 'getSetting'];
        }
    }

    public function getSettingAll()
    {
        /**
         * Setting Restaurant
         */
        $api = sprintf(API_SETTING_RESTAURANT_GET_POST, Session::get(SESSION_RESTAURANT));
        $body = null;
        $requestSettingRestaurant = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body
        ];
        /**
         * Data Restaurant
         */
        $api = sprintf(API_SETTING_RESTAURANT_GET_PROFILE, Session::get(SESSION_RESTAURANT));
        $requestDataRestaurant = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body
        ];
        /**
         * List Brand
         */
//        $status = Config::get('constants.type.checkbox.GET_ALL');
        $status = ENUM_SELECTED;
        $api = sprintf(API_BRAND_GET_DATA, $status);
        $requestListBrand = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body
        ];
        /**
         * Setting Brand
         */
        $api = sprintf(API_BRAND_GET_SETTING, Session::get(SESSION_KEY_BRAND_ID_DEFAULT));
        $requestSettingBrand = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body
        ];
        /**
         * List Branch
         */
        $status = Config::get('constants.type.status.GET_ALL');
        $is_card = Config::get('constants.type.checkbox.GET_ALL');
        $brand_id = Session::get(SESSION_KEY_BRAND_ID);
        $api = sprintf(API_SETTING_BRANCH_GET_CARD, $brand_id, $status, $is_card);
        $requestListBranch = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body
        ];
        /**
         * Setting Branch
         */
        $api = sprintf(API_SETTING_BRANCH_GET_POST, Session::get(SESSION_KEY_BRANCH_ID_DEFAULT));
        $requestSettingBranch = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestSettingRestaurant, $requestDataRestaurant, $requestListBrand, $requestSettingBrand, $requestListBranch, $requestSettingBranch]);
        try {
            Session::put(SESSION_KEY_SHOW_LOG_NAVBAR, Config::get('app.SHOW_LOG_NAVBAR'));
            $collection = collect($configAll)->where('status', Config::get('constants.type.status.STATUS_SUCCESS'))->toArray();
            if (count($collection) < 6) {
                Session::forget(SESSION_JAVA_ACCOUNT);
                return [$configAll, 'getSettingAll'];
            } else {
                Session::put(SESSION_KEY_SETTING_RESTAURANT, $configAll[0]['data']);
                Session::put(SESSION_KEY_DATA_RESTAURANT, $configAll[1]['data']);
                Session::put(SESSION_KEY_DATA_BRAND, $configAll[2]['data']);
                $data = collect($configAll[2]['data'])->where('id', Session::get(SESSION_KEY_BRAND_ID_DEFAULT))->first();
                Session::put(SESSION_KEY_DATA_CURRENT_BRAND, $data);
                Session::put(SESSION_KEY_SETTING_CURRENT_BRAND, $configAll[3]['data']);
                Session::put(SESSION_KEY_DATA_BRANCH, $configAll[4]['data']);
                $data = collect($configAll[4]['data'])->where('id', Session::get(SESSION_KEY_BRANCH_ID_DEFAULT))->first();
                Session::put(SESSION_KEY_DATA_CURRENT_BRANCH, $data);
                Session::put(SESSION_KEY_SETTING_CURRENT_BRANCH, $configAll[5]['data']);
                $configAll['current_path'] = (Session::get(SESSION_KEY_CURRENT_PATH) !== null) ? Session::get(SESSION_KEY_CURRENT_PATH) : '/';
                return [$configAll];
            }
        } catch (Exception $e) {
            Session::forget(SESSION_JAVA_ACCOUNT);
            return [$configAll, $e];
        }
    }

    public function drawDataSelect($brand, $branch)
    {
        $selectBrandAll = '<option value="-1">Tất cả</option>';
        $selectBrand = '';
        $selectBrandNotCompany = '';
        foreach ($brand as $db) {
            $selectBrandAll .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            $selectBrand .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            if ($db['is_office'] === ENUM_DIS_SELECTED) {
                $selectBrandNotCompany .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
        }
        View::share('selectBrandAllTemplate', $selectBrandAll);
        View::share('selectBrandTemplate', $selectBrand);
        View::share('selectBrandNotCompanyTemplate', $selectBrandNotCompany);
    }
}
