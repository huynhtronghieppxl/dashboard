<?php

namespace App\Http\Controllers\Marketing\Campaign;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

use phpDocumentor\Reflection\Types\Collection;


class OneGetOneController extends Controller
{
    public function data(Request $request)
    {
        $brand_id = $request->get('brand_id');
        $key = ENUM_ID_NONE;
        $form = $request->get('form');;
        $to = $request->get('to');
        $is_running = ENUM_GET_ALL;
        $is_active = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_ONE_GET_ONE_MARKETING_GET_DATA, $brand_id, $key, $form, $to, $is_running, $is_active);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collect = collect($config['data']['list']);
            $dataNotActive = $collect->where('is_actived', ENUM_DIS_SELECTED)->all();
            $dataActive = $collect->where('is_actived', ENUM_SELECTED)->all();

            $tableNotActive = $this->drawTableNotActiveOneGetOneMarketing($dataNotActive);
            $tableActive = $this->drawTableOneGetOneMarketing($dataActive);
            $total = [
                'total_not_active' => count($dataNotActive),
                'total_running' => count($dataActive),
            ];
            return [$tableActive, $tableNotActive, $total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTableOneGetOneMarketing($data)
    {
        return DataTables::of($data)
            ->addColumn('hour', function ($row) {
                return $row['from_hour'] . ':00 - ' . $row['to_hour'] . ':00';
            })
            ->addColumn('name', function ($row) {
                if (mb_strlen($row['name']) > 30) {
                    return mb_substr($row['name'], 0, 27) . '...';
                } else {
                    return $row['name'];
                }
            })
            ->addColumn('keySearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('time', function ($row) {
                $time = [];
                if (in_array('0', $row['day_of_weeks'])) {
                    array_push($time, 'Chủ nhật');
                }
                if (in_array('1', $row['day_of_weeks'])) {
                    array_push($time, 'Thứ 2');
                }
                if (in_array('2', $row['day_of_weeks'])) {
                    array_push($time, 'Thứ 3');
                }
                if (in_array('3', $row['day_of_weeks'])) {
                    array_push($time, 'Thứ 4');
                }
                if (in_array('4', $row['day_of_weeks'])) {
                    array_push($time, 'Thứ 5');
                }
                if (in_array('5', $row['day_of_weeks'])) {
                    array_push($time, 'Thứ 6');
                }
                if (in_array('6', $row['day_of_weeks'])) {
                    array_push($time, 'Thứ 7');
                }
                return implode(',', $time);
            })
            ->addColumn('date', function ($row) {
                return $row['from_date'] . ' - ' . $row['to_date'];
            })
            ->addColumn('status_text', function ($row) {
                if($row['is_running']){
                    return '<div class="seemt-orange seemt-border-orange status-new">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">'. TEXT_MEDIA_MARKETING_RUNNING .'</label>
                            </div>';
                }else{
                    return '<div class="seemt-orange seemt-border-orange status-new">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">'. TEXT_MEDIA_MARKETING_NOT_RUNNING .'</label>
                            </div>';
                }
            })
            ->addColumn('action', function ($row) {
                if($row['is_running']){
                    return '<div class="btn-group btn-group-sm text-center">
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeRunningOneGetOneCampaign($(this))"  data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Tạm ngưng"><i class="fi-rr-pause"></i></button>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailOneGetOneCampaign($(this))" data-id="' . $row['id'] . '"><i class="fi-rr-eye"></i></button>
                                 <button type="button" class="btn seemt-btn-hover-red seemt-red waves-effect waves-light" onclick="changeStatusOneGetOneCampaign($(this))" data-status="' . $row['is_actived'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '" data-id="' . $row['id'] . '"><i class="fi-rr-trash"></i></button>
                            </div>';
                }else{
                    return '<div class="btn-group btn-group-sm text-center">
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="changeRunningOneGetOneCampaign($(this))"  data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chạy"><i class="fi-rr-play"></i></button>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light"  onclick="openModalUpdateFoodOneGetOneCampaign($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ADD_FOOD . '"><i class="fi-rr-plus"></i></button>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateOneGetOneCampaign($(this))"  data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailOneGetOneCampaign($(this))" data-id="' . $row['id'] . '"><i class="fi-rr-eye"></i></button>
                                 <button type="button" class="btn seemt-btn-hover-red seemt-red waves-effect waves-light" onclick="changeStatusOneGetOneCampaign($(this))" data-status="' . $row['is_actived'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CANCEL . '" data-id="' . $row['id'] . '"><i class="fi-rr-trash"></i></button>
                            </div>';
                }
            })
            ->rawColumns(['action', 'name', 'status_text'])
            ->addIndexColumn()
            ->make(true);
    }

    public function drawTableNotActiveOneGetOneMarketing($data)
    {
        return DataTables::of($data)
            ->addColumn('hour', function ($row) {
                return $row['from_hour'] . ':00 - ' . $row['to_hour'] . ':00';
            })
            ->addColumn('name', function ($row) {
                if (mb_strlen($row['name']) > 30) {
                    return mb_substr($row['name'], 0, 27) . '...';
                } else {
                    return $row['name'];
                }
            })
            ->addColumn('time', function ($row) {
                $time = [];
                if (in_array('0', $row['day_of_weeks'])) {
                    array_push($time, 'Chủ nhật');
                }
                if (in_array('1', $row['day_of_weeks'])) {
                    array_push($time, 'Thứ 2');
                }
                if (in_array('2', $row['day_of_weeks'])) {
                    array_push($time, 'Thứ 3');
                }
                if (in_array('3', $row['day_of_weeks'])) {
                    array_push($time, 'Thứ 4');

                }
                if (in_array('4', $row['day_of_weeks'])) {
                    array_push($time, 'Thứ 5');

                }
                if (in_array('5', $row['day_of_weeks'])) {
                    array_push($time, 'Thứ 6');

                }
                if (in_array('6', $row['day_of_weeks'])) {
                    array_push($time, 'Thứ 7');
                }
                return implode(',', $time);
            })
            ->addColumn('date', function ($row) {
                return $row['from_date'] . ' - ' . $row['to_date'];
            })
            ->addColumn('keySearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
//            ->addColumn('action', function ($row) {
//                return '<div class="btn-group btn-group-sm text-center">
//                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '" onclick="changeStatusOneGetOneCampaign($(this))" data-status="' . $row['is_actived'] . '" data-id="' . $row['id'] . '"><i class="fi-rr-check"></i></button>
//                        </div>';
//            })
            ->rawColumns(['action', 'keySearch', 'name'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create(Request $request)
    {
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = API_ONE_GET_ONE_MARKETING_POST_CREATE;
        $body = [
            "restaurant_brand_id" => $request->get('restaurant_brand_id'),
            "branch_ids" => $request->get('branch'),
            "name" => $request->get('name'),
            "information" => $request->get('detail'),
            "banner_image_url" => $request->get('banner_image_url'),
            "day_of_weeks" => $request->get('day_of_week'),
            "from_date" => $request->get('form_date'),
            "to_date" => $request->get('to_date'),
            "from_hour" => $request->get('form_hour'),
            "to_hour" => $request->get('to_hour'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }


    public function listFood(Request $request)
    {
        $brand = $request->get('brand');
        $id = $request->get('id');
        $status = ENUM_SELECTED;
        $category = ENUM_GET_ALL;
        $is_combo = ENUM_DIS_SELECTED;
        $is_special_gift = ENUM_DIS_SELECTED;
        $is_addition = ENUM_DIS_SELECTED;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $key = ENUM_ID_NONE;
        $branch_id = ENUM_GET_ALL;
        $category_id = ENUM_GET_ALL;
        $is_take_away = ENUM_DIS_SELECTED;
        $is_count_material = ENUM_SELECTED;
        $is_bestseller = ENUM_GET_ALL;
        $is_kitchen = ENUM_GET_ALL;
        $is_get_food_contain_addition = ENUM_GET_ALL;
        $alert_original_food_id = ENUM_GET_ALL;
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category, $category_id, $brand, $branch_id,
            $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key, $is_get_food_contain_addition, $alert_original_food_id);
        $body = null;
        $requestFoodOneGetOne = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $api = sprintf(API_ONE_GET_ONE_MARKETING_POST_FOOD_DETAIL_FOOD, $id);
        $body = null;
        $requestFoodDetailOneGetOne = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $configAll = $this->callApiMultiGatewayTemplate2([$requestFoodOneGetOne, $requestFoodDetailOneGetOne]);
        $config = $configAll[0];
        $detail = $configAll[1];
        try {
            $option = '';
            $listIdFood = collect($detail['data'])->pluck('id')->all();
            $dataTableAll = [];
            foreach ($config['data']['list'] as $key => $data) {
                $option .= '<option value="' . $data['id'] . '" data-unit-type="'. $data['unit_type'] .'">' . $data['name'] . '</option>';
                if (!in_array($data['id'], $listIdFood) && $data['is_addition'] === 0 && $data['is_combo'] === 0) {
                    array_push($dataTableAll, $data);
                }
            }

            $dataTableAll = DataTables::of($dataTableAll)
                ->addColumn('avatar', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>' . $row['name'] . '</label>';
                })
                ->addColumn('action', function ($row) {
                    if($row['restaurant_kitchen_place_id'] === 0) {
                        return '<span class="text-danger" style="font-weight: 500">Món ăn chưa gán bếp</span>';
                    }
                    return '<div class="btn-group btn-group-sm text-center">
                                <button class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="checkFoodOneGetOne($(this))"
                                 data-type="0" data-id="' . $row['id'] . '" data-cate-type="'. $row['category_type_id'] .'" data-sell-by-weight="'. $row['is_sell_by_weight'] .'">
                                    <i class="fi-rr-arrow-small-right"></i>
                                </button>
                            </div>';

                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'avatar'])
                ->addIndexColumn()
                ->make(true);
            $dataTableSelect = DataTables::of($detail['data'])
                ->addColumn('avatar', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>' . $row['name'] . '</label>';
                })
                ->addColumn('food', function ($row) {
                    $listIds = collect($row['gift_foods'])->pluck('id')->all();
                    return '<select class="select-list-food-one-get-one js-example-basic-single" data-ids="' . implode(',', $listIds) . '" multiple data-validate="select" ></select>';
                })
                ->addColumn('action', function ($row) {
                      return '<div class="btn-group btn-group-sm text-center">
                                <button class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" data-id="' . $row['id'] . '"  data-type="1" onclick="unCheckFoodOneGetOne($(this)) ">
                                    <i class="fi-rr-arrow-small-left"></i>
                                </button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                      return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'avatar', 'food'])
                ->addIndexColumn()
                ->make(true);
            return [$dataTableAll, $config, $dataTableSelect, $option,  $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_ONE_GET_ONE_MARKETING_POST_CHANGE_STATUS, $id);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function assignFood(Request $request)
    {
        $id = $request->get('id');
        $listFood = $request->get('list_food');
        $listRemove = $request->get('list_remove');
        $api = API_ONE_GET_ONE_MARKETING_POST_ASSiGN_FOOD;
        $body = [
            'restaurant_pc_buy_one_get_one_id' => $id,
            'foods' => $listFood
        ];
        $requestFoodOneGetOne = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body,
        ];

        if ($listRemove != []) {
            $api = API_ONE_GET_ONE_MARKETING_POST_REMOVE_FOOD_DETAIL_FOOD;
            $body = [
                'restaurant_pc_buy_one_get_one_id' => $id,
                'food_ids' => $listRemove
            ];
            $requestRemoveFoodOneGetOne = [
                'project' => ENUM_PROJECT_ID_ORDER,
                'method' => ENUM_METHOD_POST,
                'api' => $api,
                'body' => $body,
            ];
            $configAll = $this->callApiMultiGatewayTemplate2([$requestFoodOneGetOne, $requestRemoveFoodOneGetOne]);
        } else {
            $configAll = $this->callApiMultiGatewayTemplate2([$requestFoodOneGetOne]);
        }
        return $configAll;
    }


    public function detail(Request $request)
    {
        $id = $request->get('id');
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_ONE_GET_ONE_MARKETING_GET_DETAIL_FOOD, $id);
        $body = [];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $config['data']['banner_image_src'] = $domain . $config['data']['banner_image_url'];
            $config['data']['branches_id'] = collect($config['data']['branches'])->pluck('id');
            $config['data']['branches_text'] = implode(',',collect($config['data']['branches'])->pluck('name')->toArray());
            $time = [];
            if (in_array('0', $config['data']['day_of_weeks'])) {
                array_push($time, 'Chủ nhật');
            }
            if (in_array('1', $config['data']['day_of_weeks'])) {
                array_push($time, 'Thứ 2');
            }
            if (in_array('2', $config['data']['day_of_weeks'])) {
                array_push($time, 'Thứ 3');
            }
            if (in_array('3', $config['data']['day_of_weeks'])) {
                array_push($time, 'Thứ 4');
            }
            if (in_array('4', $config['data']['day_of_weeks'])) {
                array_push($time, 'Thứ 5');
            }
            if (in_array('5', $config['data']['day_of_weeks'])) {
                array_push($time, 'Thứ 6');
            }
            if (in_array('6', $config['data']['day_of_weeks'])) {
                array_push($time, 'Thứ 7');
            }
            $config['data']['day_apply'] =  implode(',', $time);
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function changeRunning(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_ONE_GET_ONE_MARKETING_POST_CHANGE_RUNNING, $id);
        $body = [];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_ONE_GET_ONE_MARKETING_POST_UPDATE_FOOD, $id);
        $body = [
            "restaurant_brand_id" => $request->get('restaurant_brand_id'),
            "branch_ids" => $request->get('branch'),
            "name" => $request->get('name'),
            "information" => $request->get('detail'),
            "banner_image_url" => $request->get('image'),
            "day_of_weeks" => $request->get('day_of_week'),
            "from_date" => $request->get('form_date'),
            "to_date" => $request->get('to_date'),
            "from_hour" => $request->get('form_hour'),
            "to_hour" => $request->get('to_hour'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
