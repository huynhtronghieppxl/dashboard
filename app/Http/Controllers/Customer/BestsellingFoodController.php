<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class BestsellingFoodController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Món bán chạy';
        return view('customer.bestselling_food.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch_id = $request->get('branch');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $category_type = Config::get('constants.type.id.GET_ALL');
        $category_id = Config::get('constants.type.id.GET_ALL');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_count_material = Config::get('constants.type.checkbox.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.GET_ALL');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $is_bestseller = Config::get('constants.type.checkbox.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_kitchen = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.status.GET_ALL');
        $is_get_food_contain_addition = Config::get('constants.type.checkbox.GET_ALL');
        $key_search = '';
        $alert_original_food_id = ENUM_GET_ALL;
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category_type, $category_id, $restaurant_brand_id, $branch_id, $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key_search, $is_get_food_contain_addition, $alert_original_food_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $collection = collect($data);
            $data_un_selected = $collection->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->where('is_best_seller', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->all();
            $data_selected = $collection->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->where('is_best_seller', (int)Config::get('constants.type.checkbox.SELECTED'))->all();
            $data_table_un_selected = DataTables::of($data_un_selected)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('avatar', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                            <label class="title-name-new-table" >'.$row['name'].'</label>';
                })
                ->addColumn('action', function ($row) {
//                    return '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" onclick="checkBestsellingFoodCustomer($(this))" data-id="' . $row['id'] . '"></i>';
                    return '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkBestsellingFoodCustomer($(this))" data-id="' . $row['id'] . '"><i class="fi-rr-arrow-small-right"></i></button> </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('detail', function ($row) {
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
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))" data-type="'. $row['id_type_food'] .'" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->rawColumns(['avatar', 'action', 'detail'])
                ->addIndexColumn()
                ->make(true);

            $data_table_selected = DataTables::of($data_selected)
                ->addColumn('action', function ($row) {
//                    return '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer" onclick="unCheckBestsellingFoodCustomer($(this))" data-id="' . $row['id'] . '"></i>';
                    return '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="unCheckBestsellingFoodCustomer($(this))" data-id="' . $row['id'] . '"><i class="fi-rr-arrow-small-left"></i></button></div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('avatar', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                            <label class="title-name-new-table" >'.$row['name'].'</label>';
                })
                ->addColumn('detail', function ($row) {
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
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="'. $row['id_type_food'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['avatar', 'action', 'detail'])
                ->addIndexColumn()
                ->make(true);
            return [$data_table_un_selected, $data_table_selected, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_ASSIGN_BESTSELLING_FOOD_POST_CUSTOMER);
        $body = [
            "restaurant_brand_id" => $request->get('restaurant_brand_id'),
            "food_ids" => $request->get('food_ids'),
            "branch_id" => $request->get('branch_id')
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }
}
