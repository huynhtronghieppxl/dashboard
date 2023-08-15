<?php

namespace App\Http\Controllers\Manage\Food;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class FoodBranchManageController extends Controller
{

    public function index(Request $request)
    {
        $active_nav = 'Chi nhánh';
        return view('manage.food.branch.index', compact('active_nav'));
    }

    //  Danh sách món ăn
    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $branch_id = $request->get('branch');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $category = Config::get('constants.type.id.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.checkbox.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.GET_ALL');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $key = '';
        $category_id = $request->get('category_id');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_allow_purchase_by_point = Config::get('constants.type.is_take_away.GET_ALL');
        $is_temporary_percent = Config::get('constants.type.is_take_away.GET_ALL');
        $is_promotion_percent = Config::get('constants.type.is_take_away.GET_ALL');
        $is_count_material = Config::get('constants.type.checkbox.SELECTED');
        $is_bestseller = Config::get('constants.type.checkbox.GET_ALL');
        $is_kitchen = Config::get('constants.type.checkbox.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_BRANCH_MANAGE, $status, $is_take_away, $is_addition, $category, $category_id, $brand, $branch_id, $is_count_material, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $page, $key, $is_allow_purchase_by_point, $is_temporary_percent, $is_promotion_percent);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $config1 = $config;
            $collection = collect($config['data']['list']);
            $data_food = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('category_type_id', (int)Config::get('constants.type.category.FOOD'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $data_drink = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('category_type_id', (int)Config::get('constants.type.category.DRINK'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $data_sea_food = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('category_type_id', (int)Config::get('constants.type.category.SEA_FOOD'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $data_other = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('category_type_id', (int)Config::get('constants.type.category.OTHER'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $data_combo = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $data_gift = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $data_addition = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->all();

            $data_table_food = $this->drawTableFoodBranchManage($data_food)->original['data'];
            $data_table_drink = $this->drawTableFoodBranchManage($data_drink)->original['data'];
            $data_table_sea_food = $this->drawTableFoodBranchManage($data_sea_food)->original['data'];
            $data_table_other = $this->drawTableFoodBranchManage($data_other)->original['data'];
            $data_table_combo = $this->drawTableComboFoodBranchManage($data_combo)->original['data'];
            $data_table_gift = $this->drawTableFoodBranchManage($data_gift)->original['data'];
            $data_table_addition = $this->drawTableFoodBranchManage($data_addition)->original['data'];
            $data_total = array(
                'total_record_food' => count($data_food),
                'total_record_drink' => count($data_drink),
                'total_record_seafood' => count($data_sea_food),
                'total_record_other' => count($data_other),
                'total_record_combo' => count($data_combo),
                'total_record_gift' => count($data_gift),
                'total_record_addition' => count($data_addition),
            );
            $food = '';
            foreach ($config1['data']['list'] as $db) {
                $food .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
            return [$data_table_food, $data_table_drink, $data_table_sea_food, $data_table_other, $data_table_combo, $data_table_gift, $data_table_addition, $data_total, $food, $config1];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function category(Request $request)
    {
        /**
         * Category
         */
        $brand = $request->get('brand');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_CATEGORY_MANAGE, $brand, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $data = $config['data'];
        $data_category = '<option selected value="" data-category-type="">Danh mục</option>';
        if (count($data) === 0) {
            $data_category = '<option value="" disabled selected>' . TEXT_NULL_OPTION . '</option>';
        } else {
            foreach ($data as $db) {
                $data_category .= '<option value="' . $db['id'] . '" data-category-type="' . $db['category_type'] . '">' . $db['name'] . '</option>';
            }
        }

        return [$data_category, $config['config']];
    }


    public function drawTableFoodBranchManage($data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $detail = TEXT_DETAIL;
        $disable = TEXT_DISABLE_STATUS;
        $update = TEXT_UPDATE;
        $quantity = TEXT_QUANTITATIVE;
        $not_quantity = TEXT_NOT_QUANTITATIVE;
        return DataTables::of($data)
            ->addColumn('name', function ($row) use ($domain) {
                if (mb_strlen($row['name']) > 30) {
                    return mb_substr($row['name'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['name'] . '"></i>';
                } else {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $row['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' . $row['code'] . '</label>
                         </label>';
                }
            })
            ->addColumn('avatar', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '"  class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>';
            })
            ->addColumn('vat', function ($row) {
                return $row['restaurant_vat_config_name'] . ' (' . $row['restaurant_vat_config_percent'] . '%)';
            })
            ->addColumn('price', function ($row) {
                return '<label class="font-weight-bold">' . $this->numberFormat($row['price']) . '</label></br>
                                        <label class="number-order"> Vốn: ' . $this->numberFormat($row['original_price']) . '</label>';
            })
            ->addColumn('point_to_purchase', function ($row) {
                return $this->numberFormat($row['point_to_purchase']);
            })
            ->addColumn('original_price', function ($row) {
                return $this->numberFormat($row['original_price']);
            })
            ->addColumn('original_revenue', function ($row) {
                return '<label class="font-weight-bold">' . $this->numberFormat($row['original_revenue_percent']) . '%</label></br>
                                                        <label class="number-order">TT: ' . $this->numberFormat($row['original_revenue']) . '</label>';
            })
            ->addColumn('material_count', function ($row) use ($quantity, $not_quantity) {
                if (Session::get(SESSION_KEY_LEVEL) > (int)Config::get('constants.is_check.level.THREE')) {
                    if ($row['material_count'] > 0) {
                        return '<div class="btn-group btn-group-sm"><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . $quantity . '"></i></div>';
                    } else {
                        return '<div class="btn-group btn-group-sm"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . $not_quantity . '"></i></div>';
                    }
                } else {
                    return '<div class="btn-group btn-group-sm pointer"><i class="text-default fa fa-circle-o" onclick="showNotifyLevel($(this))" ></i></div>';
                }
            })
            ->addColumn('total_temporary_price', function ($row) {
                return $this->numberFormat($row['total_temporary_price']);

            })
            ->addColumn('original_percent', function ($row) {
                if ($row['original_percent'] > 40){
                    $icon = '<i class="fa fa-exclamation-triangle text-danger" data-toggle="tooltip" data-placement="top" data-original-title="Nguy hiểm"></i>';
                } else if ($row['original_percent'] > 35){
                    $icon = '<i class="fa fa-exclamation-triangle text-warning" data-toggle="tooltip" data-placement="top" data-original-title="Cảnh báo"></i>';
                } else if($row['original_percent'] > 25){
                    $icon = '<i class="fa fa-exclamation-triangle text-primary" data-toggle="tooltip" data-placement="top" data-original-title="Tạm ổn"></i>';
                } else {
                    $icon = '<i class="fa fa-exclamation-triangle text-success" data-toggle="tooltip" data-placement="top" data-original-title="An toàn"></i>';
                }
                return $this->numberFormat($row['original_percent']) . '% ' . $icon;

            })
            ->addColumn('restaurant_kitchen_place_name', function ($row) {
                if ($row['restaurant_kitchen_place_id'] != '-1') {
                    return $row['restaurant_kitchen_place_name'] = '<label class="label label-primary">' . $row['restaurant_kitchen_place_name'] . '</label>';
                } else {
                    return $row['restaurant_kitchen_place_name'] = '<label class="label label-danger">Chưa có bếp</label>';;
                }
            })
            ->addColumn('action', function ($row) use ($detail, $disable, $update) {
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
                            <button type="button" class="tabledit-edit-button btn btn-info waves-effect waves-light" onclick="openModalUpdateFoodAreaBranchManage($(this))" data-price="' . $this->numberFormat($row['price']) . '" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa giá khu vực"><span class="fa fa-shirtsinbulk"></span></button>
                            <button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light btn_enable_all_branch" title="' . $disable . '" onclick="changeStatusFoodBranchManage(' . $row['id'] . ', ' . $row['status'] . ', ' . $row['restaurant_brand']['id'] . ', ' . $row['branch_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="Tạm ngưng"><span class="icofont icofont-ui-close"></span></button></br>
                            <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" onclick="openModalUpdateFoodBranchManage($(this))" data-id="' . $row['id'] . '" data-gift="' . $row['is_special_gift'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa"><span class="icofont icofont-ui-edit"></span></button>
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" title="' . $detail . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><span class="icofont icofont-eye-alt"></span></button>
                        </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['name', 'original_revenue', 'price', 'material_count', 'action', 'restaurant_kitchen_place_name', 'original_percent'])
            ->addIndexColumn()
            ->make(true);
    }

    public function drawTableComboFoodBranchManage($data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $detail = TEXT_DETAIL;
        $disable = TEXT_DISABLE_STATUS;
        return DataTables::of($data)
            ->addColumn('name', function ($row) use ($domain) {
                if (mb_strlen($row['name']) > 30) {
                    return mb_substr($row['name'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['name'] . '"></i>';
                } else {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $row['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' . $row['code'] . '</label>
                         </label>';
                }
            })
            ->addColumn('avatar', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '"  class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>';
            })
            ->addColumn('price', function ($row) {
                return '<label class="font-weight-bold">' . $this->numberFormat($row['price']) . '</label></br>
                                        <label class="number-order"> Vốn: ' . $this->numberFormat($row['original_price']) . '</label>';
            })
            ->addColumn('point_to_purchase', function ($row) {
                return $this->numberFormat($row['point_to_purchase']);
            })
            ->addColumn('original_price', function ($row) {
                return $this->numberFormat($row['original_price']);
            })
            ->addColumn('original_revenue', function ($row) {
                return '<label class="font-weight-bold">' . $this->numberFormat($row['original_revenue_percent']) . '%</label></br>
                                                        <label class="number-order">TT: ' . $this->numberFormat($row['original_revenue']) . '</label>';
            })
            ->addColumn('total_temporary_price', function ($row) {
                return $this->numberFormat($row['total_temporary_price']);

            })
            ->addColumn('action', function ($row) use ($detail, $disable) {
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
                            <button type="button" class="tabledit-edit-button btn btn-info waves-effect waves-light" onclick="openModalUpdateFoodAreaBranchManage($(this))" data-price="' . $this->numberFormat($row['price']) . '" data-id="' . $row['id'] . '" data-branch="' . $row['branch_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa giá khu vực"><span class="fa fa-shirtsinbulk"></span></button></br>
                            <button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light btn_enable_all_branch" title="' . $disable . '" onclick="changeStatusFoodBranchManage(' . $row['id'] . ', ' . $row['status'] . ', ' . $row['restaurant_brand']['id'] . ', ' . $row['branch_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="Tạm ngưng"><span class="icofont icofont-ui-close"></span></button>
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" title="' . $detail . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><span class="icofont icofont-eye-alt"></span></button>
                        </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['name', 'avatar', 'material_count', 'action', 'original_revenue', 'price'])
            ->addIndexColumn()
            ->make(true);
    }

    public function dataDisable(Request $request)
    {
        $brand = $request->get('brand');
        $branch_id = $request->get('branch');
        $status = Config::get('constants.type.checkbox.DIS_SELECTED');
        $category = Config::get('constants.type.id.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.checkbox.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.GET_ALL');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $key = '';
        $category_id = Config::get('constants.type.id.GET_ALL');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_count_material = Config::get('constants.type.checkbox.SELECTED');
        $is_bestseller = Config::get('constants.type.checkbox.GET_ALL');
        $is_kitchen = Config::get('constants.type.checkbox.GET_ALL');
        $is_allow_purchase_by_point = Config::get('constants.type.is_take_away.GET_ALL');
        $is_temporary_percent = Config::get('constants.type.is_take_away.GET_ALL');
        $is_promotion_percent = Config::get('constants.type.is_take_away.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_BRANCH_MANAGE, $status, $is_take_away, $is_addition, $category, $category_id, $brand, $branch_id, $is_count_material, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $page, $key, $is_allow_purchase_by_point, $is_temporary_percent, $is_promotion_percent);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $data = $config['data']['list'];
        $data_table_disable = $this->drawTableDisableFoodBranchManage($data)->original['data'];
        $total_disabled = count($data);
        return [$data_table_disable, $total_disabled, $config];
    }


    public function drawTableDisableFoodBranchManage($data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $detail = TEXT_DETAIL;
        $enable = TEXT_ENABLE;
        $quantity = TEXT_QUANTITATIVE;
        $not_quantity = TEXT_NOT_QUANTITATIVE;
        return DataTables::of($data)
            ->addColumn('name', function ($row) use ($domain) {
                if (mb_strlen($row['name']) > 30) {
                    return mb_substr($row['name'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['name'] . '"></i>';
                } else {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $row['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' . $row['code'] . '</label>
                         </label>';
                }
            })
            ->addColumn('avatar', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar_thump'] . '"  class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>';
            })
            ->addColumn('type', function ($row) {
                if ($row['is_special_gift'] === Config::get('constants.type.checkbox.SELECTED')) {
                    return 'Món tặng';
                } else if ($row['is_addition'] === Config::get('constants.type.checkbox.SELECTED')) {
                    return 'Món bán kèm';
                } else if ($row['is_combo'] === Config::get('constants.type.checkbox.SELECTED')) {
                    return 'Combo';
                } else {
                    return 'Món ăn';
                }
            })
            ->addColumn('total_temporary_price', function ($row) {
                return $this->numberFormat($row['total_temporary_price']);

            })
            ->addColumn('vat', function ($row) {
                if ($row['is_special_gift'] === Config::get('constants.type.checkbox.SELECTED') || $row['is_addition'] === Config::get('constants.type.checkbox.SELECTED') || $row['is_combo'] === Config::get('constants.type.checkbox.SELECTED')) {
                    return '---';
                } else {
                    return $row['restaurant_vat_config_name'] . ' (' . $row['restaurant_vat_config_percent'] . '%)';
                }
            })
            ->addColumn('price', function ($row) {
                return '<label class="font-weight-bold">' . $this->numberFormat($row['price']) . '</label></br>
                                        <label class="number-order"> Vốn: ' . $this->numberFormat($row['original_price']) . '</label>';
            })
            ->addColumn('point_to_purchase', function ($row) {
                return $this->numberFormat($row['point_to_purchase']);
            })
            ->addColumn('original_price', function ($row) {
                return $this->numberFormat($row['original_price']);
            })
            ->addColumn('original_revenue', function ($row) {
                return '<label class="font-weight-bold">' . $this->numberFormat($row['original_revenue_percent']) . '%</label></br>
                                                        <label class="number-order">TT: ' . $this->numberFormat($row['original_revenue']) . '</label>';
            })
            ->addColumn('material_count', function ($row) use ($quantity, $not_quantity) {
                if (Session::get(SESSION_KEY_LEVEL) > (int)Config::get('constants.is_check.level.TWO')) {
                    if ($row['material_count'] > 0) {
                        return '<div class="btn-group btn-group-sm "><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . $quantity . '"></i></div>';
                    } else {
                        return '<div class="btn-group btn-group-sm "><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . $not_quantity . '"></i></div>';
                    }
                } else {
                    return '<div class="btn-group btn-group-sm pointer"><i class="text-default fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . $not_quantity . '" onclick="showNotifyLevel($(this))"></i></div>';
                }
            })
            ->addColumn('restaurant_kitchen_place_name', function ($row) {
                if ($row['restaurant_kitchen_place_id'] != -1) {
                    return $row['restaurant_kitchen_place_name'] = '<label class="label label-primary">' . $row['restaurant_kitchen_place_name'] . '</label>';
                } else {
                    return $row['restaurant_kitchen_place_name'] = '<label class="label label-danger">Chưa có bếp</label>';;
                }
            })
            ->addColumn('action', function ($row) use ($enable, $detail) {
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
                             <button type="button" class="tabledit-edit-button btn btn-success waves-effect waves-light btn_enable_all_branch" title="' . $enable . '" onclick="changeStatusFoodBranchManage(' . $row['id'] . ', ' . $row['status'] . ', ' . $row['restaurant_brand']['id'] . ', ' . $row['branch_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="Hoạt động"><span class="icofont icofont-ui-check"></span></button>
                             <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" title="' . $detail . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết   "><span class="icofont icofont-eye-alt"></span></button>
                         </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['name', 'price', 'material_count', 'original_revenue', 'action', 'restaurant_kitchen_place_name'])
            ->addIndexColumn()
            ->make(true);
    }

    public function dataPriceByArea(Request $request)
    {
        $branch = $request->get('branch');
        $food = $request->get('food');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_PRICE_BY_AREA_GET_LIST_FOOD, $food, $branch, -1);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $data = $config['data'];
        $data_table_price_by_area = $this->drawTablePriceByAreaFoodBranchManage($data)->original['data'];
        return [$data_table_price_by_area, $config];
    }

    public function drawTablePriceByAreaFoodBranchManage($data)
    {
        return DataTables::of($data)
            ->addColumn('price', function ($row) {
                return $this->numberFormat($row['price']);
            })
            ->addColumn('action', function ($row) {
                return '<div class="btn-group btn-group-sm text-center">
                             <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light btn_enable_all_branch"
                              data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa"><span class="icofont icofont-ui-edit"></span></button>
                             <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))"
                              data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết   "><span class="icofont icofont-eye-alt"></span></button>
                         </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    // Thay đổi trạng thái món ăn
    public function changeStatus(Request $request)
    {
        $food_id = $request->get('food_id');
        $brand_id = $request->get('brand_id');
        $branch_id = $request->get('branch_id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_FOOD_POST_CHANGE_STATUS_BRANCH_MANAGE, $food_id);
        $body = [
            "restaurant_brand_id" => $brand_id,
            "branch_id" => $branch_id
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    // chi tiết món ăn theo id
    public function dataFoodDetail(Request $request)
    {
        $id = $request->get('id');
        $branch = Config::get('constants.type.id.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_DETAIL_MANAGE_BY_ID, $id, $branch);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data['status_text'] = '<span class="label label-md label-danger">' . TEXT_DISABLE_STATUS . '</span>';
            if ($data['status'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                $data['status_text'] = '<span class="label label-md label-success">' . TEXT_STATUS_ENABLE . '</span>';
            }
            $data['type_food'] = TEXT_NORMAL_FOOD;
            $data['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');
            if ($data['is_combo'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                $data['type_food'] = TEXT_COMBO_FOOD;
                $data['id_type_food'] = Config::get('constants.type.TypeFood.COMBO');
            }
            if ($data['is_addition'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                $data['type_food'] = TEXT_ADDITION;
                $data['id_type_food'] = Config::get('constants.type.TypeFood.ADDITION');
            }

            ($data['is_bbq'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_bbq'] = TEXT_NO_PROCESSING : $data['is_bbq'] = TEXT_PROCESSING;
            ($data['is_special_claim_point'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_special_claim_point'] = TEXT_FOR_BILL : $data['is_special_claim_point'] = TEXT_FOR_ORDER;
            ($data['is_sell_by_weight'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_sell_by_weight'] = TEXT_SELL_BY_WEIGHT : $data['is_sell_by_weight'] = TEXT_NOT_SELL_BY_WEIGHT;
            ($data['is_allow_review'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_allow_review'] = TEXT_ALLOW

                : $data['is_allow_review'] = TEXT_NOT_ALLOW;
            ($data['is_allow_print'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_allow_print'] = TEXT_SEND : $data['is_allow_print'] = TEXT_NOT_SEND;
            ($data['is_allow_purchase_by_point'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_allow_purchase_by_point'] = TEXT_ALLOW_USE_POINT : $data['is_allow_purchase_by_point'] = TEXT_NOT_ALLOW_USE_POINT;
            ($data['is_take_away'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_take_away'] = TEXT_TAKE_AWAY : $data['is_take_away'] = TEXT_NOT_TAKE_AWAY;
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $data['avatar'] = $domain . $data['avatar'];
            $data_table_additon = DataTables::of($data['addition_foods'])
                ->addColumn('action', function ($row) {
                    $row['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');
                    if ($row['is_combo'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                        $row['type_food'] = TEXT_COMBO_FOOD;
                        $row['id_type_food'] = Config::get('constants.type.TypeFood.COMBO');
                    }

                    if ($row['is_addition'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                        $row['type_food'] = TEXT_ADDITION;
                        $row['id_type_food'] = Config::get('constants.type.TypeFood.ADDITION');
                    }
                    $detail = TEXT_DETAIL;
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" title="' . $detail . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '"><span class="icofont icofont-eye-alt"></span></button>
                            </div>';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);

            $data_table_food_combo = DataTables::of($data['food_in_combo'])
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('action', function ($row) {
                    $row['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');
                    if ($row['is_combo'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                        $row['type_food'] = TEXT_COMBO_FOOD;
                        $row['id_type_food'] = Config::get('constants.type.TypeFood.COMBO');
                    }

                    if ($row['is_addition'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                        $row['type_food'] = TEXT_ADDITION;
                        $row['id_type_food'] = Config::get('constants.type.TypeFood.ADDITION');
                    }
                    $detail = TEXT_DETAIL;
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" title="' . $detail . '"  onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '"><span class="icofont icofont-eye-alt"></span></button>
                        </div>';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
            return [$data, $data_table_additon, $data_table_food_combo, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    // Danh sách bếp
    public function dataKitchen(Request $request)
    {
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $branch_id = $request->get('branch_id');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $is_have_printer = Config::get('constants.type.status.GET_ALL');
        $is_bar_kitchen = Config::get('constants.type.checkbox.SELECTED');
        $type = ENUM_GET_ALL;
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_KITCHEN_DATA_GET_DATA_UP, $restaurant_brand_id, $branch_id, $status, $is_have_printer, $is_bar_kitchen, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data'])->whereIn('type', [0, 1]);
            $data = $collection;
            $data_kitchen_assign = '';
            $data_kitchen = '';
            if (empty($data)) {
                $data_kitchen = '<option selected>' . TEXT_NULL_OPTION . '</option>';
                $data_kitchen_assign = '';
            } else {
                $data_kitchen = '<option value="0" selected>Chưa có bếp</option>';
                foreach ($data as $db) {
                    $data_kitchen .= '<option value="' . $db['id'] . '" data-type="' . $db['type'] . '">' . $db['name'] . '</option>';
                    $data_kitchen_assign .= '<option value="' . $db['id'] . '" data-type="' . $db['type'] . '">' . $db['name'] . '</option>';
                }
            }
            return [$data_kitchen, $data_kitchen_assign, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    // Danh sách món bếp
    public function dataFoodKitchen(Request $request)
    {
        $key = '';
        $branch_id = $request->get('branch');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $is_kitchen = ($request->get('kitchen') == '' ?  ENUM_GET_ALL : $request->get('kitchen'));
        $is_get_food_by_kitchen_id = ($is_kitchen == ENUM_GET_ALL ?  ENUM_DIS_SELECTED : ENUM_SELECTED);
        $is_deleted = Config::get('constants.type.checkbox.DIS_SELECTED');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_KITCHEN_DATA_GET_FOOD, $restaurant_brand_id, $branch_id, $is_kitchen, $status,
            $is_deleted, $is_get_food_by_kitchen_id, $key, $limit, $page);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            /* Lọc món ăn theo bếp đến
             *   $data = collect($config['data']['list'])->whereIn('category_type', [1]);
             *   if(!$request->get('type_kitchen')){
             *      $data = collect($config['data']['list'])->whereIn('category_type', [2.3]);
             *   }
             */
            $data = $config['data']['list'];
            $data_table = DataTables::of($data)
                ->addColumn('checkbox', function ($row) {
//                    return '<div class="checkbox-fade fade-in-primary">
//                             <label><input type="checkbox" value="' . $row['id'] . '" onclick="checkChangeKitchenFoodManage()"/><span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span></label>
//                        </div>';
                    return '<div class="form-validate-checkbox p-0 m-0">
                                                <div class="checkbox-form-group">
                                                    <input type="checkbox" value="' . $row['id'] . '" onclick="checkChangeKitchenFoodManage()" name="check-food-assign-kitchen">
                                                </div>
                                            </div>';
                })
                ->addColumn('category_name', function ($row) {
                    return '<lable>' . $row['category_name'] . '</lable>';
                })
                ->addColumn('name', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>
                            <label class="name-inline-data-table">'. $row['name'] .'<br>
                                <label class="department-inline-name-data-table">
                                    <i class="fa fa-cutlery"></i>' . $row['code'] . '
                                </label>
                            </label>';
                })
                ->addIndexColumn()
                ->rawColumns(['checkbox', 'name', 'category_name'])
                ->make(true);

            return [$data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    // Chuyển bếp
    public function changeKitchen(Request $request)
    {
        $branch = $request->get('branch');
        $is_move_urgently = $request->get('is_move_urgently');
        $kitchen_place_id = $request->get('kitchen_place_id');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $food_ids = $request->get('food_ids');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_FOOD_POST_CHANGE_KITCHEN_MANAGE;
        $body = [
            "restaurant_brand_id" => $restaurant_brand_id,
            'branch_id' => $branch,
            'is_move_urgently' => $is_move_urgently,
            'kitchen_place_id' => $kitchen_place_id,
            'food_ids' => $food_ids,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);

        if ($config['status'] === 205){
            $table_list_order_not_complete = DataTables::of($config['data'])
                ->addColumn('name', function ($row) {
                    return (mb_strlen($row['name']) > 30) ? $row['name'] = mb_substr($row['name'], 0, 27) . '...' : $row['name'];
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['name'], $row['category_name']]);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            $config['data'] = $table_list_order_not_complete;
        }
        else{
            $config['data'] = $config;
        }

        return $config;
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_DETAIL_MANAGE_BY_ID, $id, $branch);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            ($data['is_bbq'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_bbq'] = TEXT_NO_PROCESSING : $data['is_bbq'] = TEXT_PROCESSING;
            ($data['is_special_claim_point'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_special_claim_point'] = TEXT_FOR_BILL : $data['is_special_claim_point'] = TEXT_FOR_ORDER;
            ($data['is_sell_by_weight'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_sell_by_weight'] = TEXT_SELL_BY_WEIGHT : $data['is_sell_by_weight'] = TEXT_NOT_SELL_BY_WEIGHT;
            ($data['is_allow_review'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_allow_review'] = TEXT_ALLOW : $data['is_allow_review'] = TEXT_NOT_ALLOW;
            ($data['is_allow_print'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_allow_print'] = TEXT_SEND : $data['is_allow_print'] = TEXT_NOT_SEND;
            ($data['is_allow_purchase_by_point'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_allow_purchase_by_point'] = TEXT_ALLOW_USE_POINT : $data['is_allow_purchase_by_point'] = TEXT_NOT_ALLOW_USE_POINT;
            ($data['is_take_away'] === (int)Config::get('constants.type.checkbox.SELECTED')) ? $data['is_take_away'] = TEXT_TAKE_AWAY : $data['is_take_away'] = TEXT_NOT_TAKE_AWAY;
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            $data['avatar'] = $domain . $data['avatar'];
            return [$data, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $branch_id = $request->get('branch_id');
        $price = $request->get('price');
        $name = $request->get('name');
        $point_to_purchase = $request->get('point_to_purchase');
        $original_price = $request->get('original_price');
        $sale_online_status = $request->get('sale_online_status');
        $is_bbq = $request->get('is_bbq');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_FOOD_POST_UPDATE_BRANCH, $id);
        $body = [
            "branch_id" => $branch_id,
            "original_price" => $original_price,
            "price" => $price,
            "point_to_purchase" => $point_to_purchase,
            "sale_online_status" => $sale_online_status,
            "name" => $name,
            'is_bbq' => $is_bbq
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function dataUpdateFoodArea(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch');
        $area = Config::get('constants.type.id.GET_ALL');
        $api = sprintf(API_PRICE_BY_AREA_GET_LIST_FOOD, $id, $branch, $area);
        $body = null;
        $requestFoodArea = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $status = Config::get('constants.type.checkbox.SELECTED');
        $api = sprintf(API_GET_ALL_AREA, $status, $branch);
        $body = null;
        $requestArea = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestFoodArea, $requestArea]);
        try {
            $area = DataTables::of($this->compareTwoArrayTemplate($configAll[1]['data']['list'], $configAll[0]['data'], 'id', 'area_id'))
                ->addColumn('checkbox', function ($row) {
                    return '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" onclick="checkAreaFood($(this))" data-id="' . $row['id'] . '" data-type="0"></i>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['checkbox'])
                ->addIndexColumn()
                ->make(true);
            $foodArea = DataTables::of($configAll[0]['data'])
                ->addColumn('name', function ($row) {
                    return $row['area_name'];
                })
                ->addColumn('checkbox', function ($row) {
                    return '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer" onclick="unCheckAreaFood($(this))" data-price="' . $this->numberFormat($row['price']) . '" data-applied="' . $row['is_applied'] . '" data-id="' . $row['area_id'] . '" data-type="1"></i>';
                })
                ->addColumn('price', function ($row) {
                    return '<div class="input-group border-group"><input value="' . $this->numberFormat($row['price']) . '" class="form-control quantity text-right border-0 w-100" data-max="999999999" data-money="1"/></div>';
                })
                ->addColumn('apply', function ($row) {
                    $checked = ($row['is_applied'] === Config::get('constants.type.checkbox.SELECTED')) ? 'checked' : '';
                    return '<div class="form-validate-checkbox mt-2">
                            <div class="checkbox-form-group">
                                <input id="accounting-create-payment-bill" class="tooltip" ' . $checked . '" name="print-kitchen-create-food-brand-manage" type="checkbox">
                                <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">
                                </label>
                            </div>
                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['checkbox', 'price', 'apply'])
                ->addIndexColumn()
                ->make(true);
            return [$area, $foodArea, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function updateFoodArea(Request $request)
    {
        $branch = $request->get('branch');
        $areaInsert = $request->get('area_insert');
        $areaDelete = $request->get('area_delete');
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_PRICE_BY_AREA_POST_UPDATE_PRICE;
        $body = [
            'branch_id' => $branch,
            'food_id' => $id,
            'list_area_ids_add' => $areaInsert,
            'list_area_ids_delete' => $areaDelete,
        ];
        $configAssign = $this->callApiGatewayTemplate2($project, $method, $api, $body);

        $foodUpdate = $request->get('food_update');
        $api = API_PRICE_BY_AREA_POST_UPDATE;
        $body = [
            'branch_id' => $branch,
            'foods' => $foodUpdate,
        ];

        $configUpdate = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        return [$configAssign, $configUpdate];
    }
}
