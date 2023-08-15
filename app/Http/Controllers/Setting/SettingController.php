<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function history(Request $request)
    {
        $page = $request->get('page');
        $limit = ENUM_DEFAULT_LIMIT_1000;
        $object_id = '';
        $type = 2;
        $user_id = Session::get(SESSION_JAVA_ACCOUNT)['id'];
        $branch = $request->get('branch');
        $object_type = $request->get('type_object');
        $key_search = $request->get('key_search');
        $from = $request->get('from');
        $to = $request->get('to');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.LOGS');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_HISTORY_LOG_GET_DATA, $object_id, $type, $user_id, $branch, $key_search, $object_type, $from, $to, $limit, $page);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['data']['total_record'] === 0) {
                $data = '<div id="div-empty-conversation" style="height: 295px; width: 100%; margin-top: 20%">
                                <div class="text-center">
                                    <img src="/images/message/search_empty.png" style="width: 160px;">
                                    <div class="text-center">
                                       <div>Không tìm thấy kết quả</div>
                                    </div>
                                </div>
                          </div>';
            } else {
                $data = '';
                foreach ($config['data']['list'] as $db) {
                    switch ($db['action_type']) {
                        case (int)Config::get('constants.type.LogTypeEnum.ORDER'):
                            $icon = 'fa fa-file-text bg-info';
                            break;
                        case (int)Config::get('constants.type.LogTypeEnum.ACCOUNT'):
                            $icon = 'fa fa-gear bg-warning';
                            break;
                        case (int)Config::get('constants.type.LogTypeEnum.BOOKING'):
                            $icon = 'fa fa-th-large bg-instagram';
                            break;
                        case (int)Config::get('constants.type.LogTypeEnum.EMPLOYEE'):
                            $icon = 'fa fa-user bg-primary';
                            break;
                        case (int)Config::get('constants.type.LogTypeEnum.EMPLOYEE_ROLE'):
                            $icon = 'fa fa-share-alt-square bg-danger';
                            break;
                        case (int)Config::get('constants.type.LogTypeEnum.KITCHENPLACE'):
                            $icon = 'fa fa-exchange bg-c-pink';
                            break;
                        case (int)Config::get('constants.type.LogTypeEnum.BRANCH'):
                            $icon = 'fa fa-bullhorn bg-c-green';
                            break;
                        case (int)Config::get('constants.type.LogTypeEnum.FOOD'):
                            $icon = 'fa fa-cutlery bg-c-blue';
                            break;
                        case (int)Config::get('constants.type.LogTypeEnum.WAREHOUSE'):
                            $icon = 'fa fa-bank bg-c-green';
                            break;
                        default:
                            $icon = 'fa fa-star bg-danger';
                            break;
                    }
                    $data .= '<div class="row">
                           <div class="col-4 text-right update-meta">
                                <p class="d-inline text-left font-weight-bold m-b-0">' . substr($db['created_at'], 0, 10) . '</p>
                                <i class="' . $icon . ' update-icon"></i>
                                <p class="text-center text-muted m-b-0">' . substr($db['created_at'], 10, 10) . '</p>
                           </div>
                           <div class="col-8 div-design-history-log">
                            <h6 class="p-l-20 font-weight-bold">' . $db['user_name'] . '</h6>
                            <div class="design-history-log">
                                <p class="text-muted m-b-0">' . $db['content'] . '</p>
                            </div>
                           </div>
                       </div>';
                }
            }
            return [$data, count($config['data']['list']), $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }
    public function updateSessionBrand(Request $request)
    {
        try {
            $id = (int)$request->get('brand');
            $has_option_all_branch = $request->get('hasAllBranch');
            Session::put(SESSION_KEY_BRAND_ID_CURRENT, $id);
            $configAll = [];
            $option = '';
            if ($id != Config::get('constants.type.id.GET_ALL')) {
                Session::put(SESSION_KEY_BRAND_ID, $id);
                /**
                 * Trans: Cập nhật info brand
                 */
                $data = collect(Session::get(SESSION_KEY_DATA_BRAND))->where('id', (int)$id)->first();
                if ($data) {
                    Session::put(SESSION_KEY_DATA_CURRENT_BRAND, $data);
                    /**
                     * Trans: Cập nhật setting brand
                     */
                    $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
                    $method = Config::get('constants.GATEWAY.METHOD.GET');
                    $api = sprintf(API_BRAND_GET_SETTING, $id);
                    $body = null;
                    $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
                    array_push($configAll, $config);
                    Session::put(SESSION_KEY_SETTING_CURRENT_BRAND, $config['data']);
                    /**
                     * Trans: Gọi lại ds branch của brand vừa chọn
                     */
                    $status = Config::get('constants.type.status.GET_ALL');
                    $is_card = Config::get('constants.type.checkbox.GET_ALL');
                    $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
                    $method = Config::get('constants.GATEWAY.METHOD.GET');
                    $api = sprintf(API_SETTING_BRANCH_GET_CARD, $id, $status, $is_card);
                    $body = null;
                    $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
                    if ($has_option_all_branch == 1) {
                        $option = '<option value="-1">Toàn chi nhánh</option>';
                    }
                    foreach ($config['data'] as $data){
                        $option .= '<option value="'. $data['id'] .'">'. $data['name'] .'</option>';
                    }
                    array_push($configAll, $config);
                    Session::put(SESSION_KEY_DATA_BRANCH, $config['data']);
                    /**
                     * Trans: Cập nhật info branch, lấy branch đầu tiên trong danh sách branch của brand vừa chọn
                     */
                    $data = collect($config['data'])->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->first();
                    if ($data) {
                        Session::put(SESSION_KEY_DATA_CURRENT_BRANCH, $data);
                        Session::put(SESSION_KEY_BRANCH_ID, $data['id']);
                        Session::put(SESSION_KEY_BRANCH_ID_CURRENT, $data['id']);
                    };
                    /**
                     * Trans: Cập nhật setting của branch ở trên
                     */
                    $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
                    $method = Config::get('constants.GATEWAY.METHOD.GET');
                    $api = sprintf(API_SETTING_BRANCH_GET_POST, $data['id']);
                    $body = null;
                    $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
                    array_push($configAll, $config);
                    Session::put(SESSION_KEY_SETTING_CURRENT_BRANCH, $config['data']);
                }
                return [true, $option ,$configAll];
            } else {
                /**
                 * Trans: Gọi lại ds branch của brand vừa chọn
                 */
//                $status = Config::get('constants.type.status.GET_ALL');
//                $is_card = Config::get('constants.type.checkbox.GET_ALL');
//                $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
//                $method = Config::get('constants.GATEWAY.METHOD.GET');
//                $api = sprintf(API_SETTING_BRANCH_GET_CARD, $id, $status, $is_card);
//                $body = null;
//                $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
//                $option = '';
//                foreach ($config['data'] as $data){
//                    $option .= '<option value="'. $data['id'] .'">'. $data['name'] .'</option>';
//                }
                $option .= '<option value="-1">Toàn chi nhánh</option>';
//                array_push($configAll, $config);
                Session::put(SESSION_KEY_BRAND_ID_CURRENT, $id);
                return [true, $option ,$configAll];
            }
//            return [true, $id];
        } catch (Exception $e) {
            return [false, $e];
        }
    }

    public function updateSessionBranch(Request $request)
    {
        $branch = $request->get('branch');
        if ($branch != Config::get('constants.type.id.GET_ALL')) {
            Session::put(SESSION_KEY_BRANCH_ID, $branch);
//            Session::put(SESSION_KEY_BRANCH_ID_DEFAULT, $branch);
            Session::put(SESSION_KEY_BRANCH_ID_CURRENT, $branch);
            $listDataBranch = Session::get(SESSION_KEY_DATA_BRANCH);
            $dataBranch = collect($listDataBranch)->where('id', $branch)->first();
            Session::put(SESSION_KEY_DATA_CURRENT_BRANCH, $dataBranch);
            Session::put(SESSION_KEY_SETTING_CURRENT_BRANCH, [
                'is_allow_advert' => $dataBranch['is_allow_advert'],
                'is_working_offline' => $dataBranch['is_working_offline'],
                'is_enable_booking' => $dataBranch['is_enable_booking'],
            ]);
        }else{
            Session::put(SESSION_KEY_BRANCH_ID_CURRENT, $branch);
        }
        return [true, $branch];
    }

    public function getBranch(Request $request){
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $status = ENUM_SELECTED;
        $is_enable_membership_card = ENUM_GET_ALL;
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SETTING_BRANCH_GET_CARD, $restaurant_brand_id, $status, $is_enable_membership_card );
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $option = '';
        foreach ($config['data'] as $data){
            $option .= '<option value="'. $data['id'] .'">'. $data['name'] .'</option>';
        }

        return [$option, $config];
    }
}
