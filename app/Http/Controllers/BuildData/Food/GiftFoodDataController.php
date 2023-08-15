<?php

namespace App\Http\Controllers\BuildData\Food;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class GiftFoodDataController extends Controller
{
    public function index()
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(0);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Món tặng';
        return view('build_data.food.gift.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $category = Config::get('constants.type.id.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.checkbox.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.GET_ALL');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $key = '';
        $branch_id = Config::get('constants.type.id.GET_ALL');
        $category_id = $request->get('category');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_count_material = Config::get('constants.type.checkbox.SELECTED');
        $is_bestseller = Config::get('constants.type.checkbox.GET_ALL');
        $is_kitchen = Config::get('constants.type.checkbox.GET_ALL');
        $is_get_food_contain_addition = Config::get('constants.type.checkbox.GET_ALL');
        $alert_original_food_id = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category, $category_id, $brand, $branch_id, $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key, $is_get_food_contain_addition, $alert_original_food_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try{
        $collection = collect($config['data']['list']);
        $dataAddition = $collection->where('is_addition', ENUM_SELECTED)->where('is_addition_like_food', ENUM_SELECTED)->toArray();
        $dataFood = $collection->where('is_addition', '!=' ,ENUM_SELECTED)->toArray();
        $data = collect(array_merge($dataAddition,$dataFood));
        $dataFood = $data->where('is_allow_employee_gift', Config::get('constants.type.checkbox.DIS_SELECTED'))->all();
        $dataFoodGift = $data->where('is_allow_employee_gift' , Config::get('constants.type.checkbox.SELECTED'))->all();
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $detail = TEXT_DETAIL;
        $dataTableFood = DataTables::of($dataFood)
            ->addColumn('name', function ($row) {
                if (mb_strlen($row['name']) > 30) {
                    return mb_substr($row['name'], 0, 25) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['name'] . '"></i>';
                } else {
                    return $row['name'];
                }
            })
            ->addColumn('name_avatar', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '"  class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>
                        <label class="align-middle">'. $row['name'] .'<br><label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i> '. $row['unit_type'] .'</label></label>';
            })
            ->addColumn('keysearch', function ($row) use ($domain) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('action', function ($row) {
//                return '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" onclick="checkFoodGiftData($(this))" data-id="' . $row['id'] . '" data-type="0"></i>';
                                    return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" data-action="'. ENUM_DIS_SELECTED .'" onclick="checkFoodGiftData($(this))" data-id="' . $row['id'] . '" data-type="0"><i class="fi-rr-arrow-small-right"></i></button>
                                </div>';
            })
            ->addColumn('detail', function ($row) use ($detail) {
                $row['type_food'] = TEXT_NORMAL_FOOD;
                $row['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');

                if ($row['is_combo'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    $row['type_food'] = TEXT_COMBO_FOOD;
                    $row['id_type_food'] = Config::get('constants.type.TypeFood.COMBO');
                }

                if ($row['is_addition'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    $row['type_food'] = TEXT_ADDITION;
                    $row['id_type_food'] = Config::get('constants.type.TypeFood.ADDITION');
                }
                return '<div class="btn-group btn-group-sm text-center">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="'. $row['id_type_food'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                        </div>';
            })
            ->rawColumns(['action', 'name', 'name_avatar', 'detail'])
            ->make(true);

        $dataTableFoodGift = DataTables::of($dataFoodGift)
            ->addColumn('name', function ($row) {
                if (mb_strlen($row['name']) > 30) {
                    return mb_substr($row['name'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['name'] . '" ></i>';
                } else {
                    return $row['name'];
                }
            })
            ->addColumn('keysearch', function ($row) use ($domain) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('name_avatar', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '"  class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>
                        <label class="align-middle">'. $row['name'] .'<br><label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i> '. $row['unit_type'] .'</label></label>';
            })
            ->addColumn('action', function ($row) {
//                return '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer " onclick="unCheckFoodGiftData($(this))" data-id="' . $row['id'] . '" data-type="1"></i>';
                                    return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="unCheckFoodGiftData($(this))" data-id="' . $row['id'] . '" data-type="1"><i class="fi-rr-arrow-small-left"></i></button>
                                </div>';
            })
            ->addColumn('detail', function ($row) use ($detail) {
                $row['type_food'] = TEXT_NORMAL_FOOD;
                $row['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');

                if ($row['is_combo'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    $row['type_food'] = TEXT_COMBO_FOOD;
                    $row['id_type_food'] = Config::get('constants.type.TypeFood.COMBO');
                }

                if ($row['is_addition'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    $row['type_food'] = TEXT_ADDITION;
                    $row['id_type_food'] = Config::get('constants.type.TypeFood.ADDITION');
                }
                return '<div class="btn-group btn-group-sm text-center">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="'. $row['id_type_food'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                        </div>';
            })
            ->rawColumns(['action', 'name', 'name_avatar', 'detail'])
            ->make(true);

        return [$dataTableFood, $dataTableFoodGift, $config];
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function assignGiftFood(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_GIFT_FOOD_POST_ASSIGN_DATA);
        $body = [
            "restaurant_brand_id" => $request->get('restaurant_brand_id'),
            "food_insert_ids" => $request->get('food_ids'),
            "food_delete_ids" => $request->get('food_gift_ids')
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }


    public function category(Request $request)
    {
        /**
         * Category
         */
        $brand = $request->get('brand');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_CATEGORY_MANAGE, $brand, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try{
        $data = $config['data'];
        if (count($data) === 0) {
            $data_category = '<option disabled selected value="" data-category-type="">' . TEXT_NULL_OPTION . '</option>';
        } else {
            $data_category = '<option value="-1" selected>Tất cả danh mục</option>';
            foreach ($data as $db) {
                $data_category .= '<option value="' . $db['id'] . '" data-category-type="' . $db['category_type'] . '">' . $db['name'] . '</option>';
            }
        }
        return [$data_category, $config['config']];
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
