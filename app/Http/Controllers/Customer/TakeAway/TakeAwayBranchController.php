<?php

namespace App\Http\Controllers\Customer\TakeAway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class TakeAwayBranchController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Chi nhánh';
        return view('customer.take_away.branch.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $key = '';
        $brand = $request->get('brand');
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $branch_id = $request->get('branch');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $category_type = Config::get('constants.type.id.GET_ALL');
        $category_id =  $request->get('category_id');
        $is_take_away = Config::get('constants.type.is_take_away.GET_TAKE_AWAY');
        $is_allow_purchase_by_point = Config::get('constants.type.is_take_away.GET_ALL');
        $is_count_material = Config::get('constants.type.checkbox.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.DIS_SELECTED');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $is_bestseller = Config::get('constants.type.checkbox.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_kitchen = Config::get('constants.type.checkbox.GET_ALL');
        $is_temporary_percent = Config::get('constants.type.is_take_away.GET_ALL');
        $is_promotion_percent = Config::get('constants.type.is_take_away.GET_ALL');
        $is_special_gift = Config::get('constants.type.status.GET_ALL');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_BRANCH_MANAGE, $status, $is_take_away, $is_addition, $category_type, $category_id, $brand, $branch_id, $is_count_material, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $page, $key, $is_allow_purchase_by_point, $is_temporary_percent, $is_promotion_percent);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $data_food = [];
            $data_drink = [];
            $data_sea_food = [];
            $data_other = [];
            $a = 0;
            $b = 0;
            $c = 0;
            $d = 0;
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['avatar'] = $domain . $data[$i]['avatar'];
                switch ($data[$i]['category_type_id']) {
                    case (int)Config::get('constants.type.category.FOOD'):
                        $data_food[$a] = $data[$i];
                        $a++;
                        break;
                    case (int)Config::get('constants.type.category.DRINK'):
                        $data_drink[$b] = $data[$i];
                        $b++;
                        break;
                    case (int)Config::get('constants.type.category.SEA_FOOD'):
                        $data_sea_food[$c] = $data[$i];
                        $c++;
                        break;
                    case (int)Config::get('constants.type.category.OTHER'):
                        $data_other[$d] = $data[$i];
                        $d++;
                }
            }
            $data_table_food = $this->drawTableFood($data_food);
            $data_table_drink = $this->drawTableFood($data_drink);
            $data_table_sea_food = $this->drawTableFood($data_sea_food);
            $data_table_other = $this->drawTableFood($data_other);

            $data_total = [
                'total_record_food' => $this->numberFormat($a),
                'total_record_drink' => $this->numberFormat($b),
                'total_record_sea_food' => $this->numberFormat($c),
                'total_record_other' => $this->numberFormat($d),
            ];

            return [$data_table_food, $data_table_drink, $data_table_sea_food, $data_table_other, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function categoryFood(Request $request)
    {
        $restaurant_brand_id = $request->get('brand');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_CATEGORY_MANAGE, $restaurant_brand_id, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $select_category = '';
            if (count($data) === 0) {
                $select_category = '<option value="-2" selected>' . TEXT_NULL_OPTION . '</option>';
            } else {
                $select_category .= '<option value="-2" selected>Danh mục</option>';
                foreach ($data as $db) {
                    $select_category .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                }
            }
            return [$select_category, $config];
        }catch (Exception $e){
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataBranch(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS); // Domain ads để mở media
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $is_office = Config::get('constants.type.branch.GET_NOT_OFFICE');
        $is_card = Config::get('constants.type.checkbox.GET_ALL');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_BOOKING_GET_BRANCH_BOOKING, $restaurant_brand_id, $status, $is_card, $is_office);
        $body = null;
        $config1 = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config1['data'];
            if ($data !== null || !empty($data)) {
                $list_branch = '';
                for ($i = 0; $i < count($data); $i++) {
                    $number_status = $data[$i]['status'];
                    if ($data[$i]['status'] === (int)Config::get('constants.type.status.GET_ACTIVE')) {
                        $status = '<span class="text-white" value="' . $number_status . '" id="branch-setting-status">Đang hoạt động<i class="fa fa-check-circle text-success pl-1"></i> </span>';
                    } else {
                        $status = '<span class="text-white" value="' . $number_status . '" id="branch-setting-status">Không hoạt động <i class="fa fa-ban text-danger"></i></span>';
                    }
                    $data_banner = $domain . $data[$i]['banner'];
                    $data_image = $domain . $data[$i]['image_logo'];
                    $button = '';
                    if(Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['is_have_take_away'] == Config::get('constants.type.checkbox.SELECTED')){
                        $button = '<ul class="profile-controls">
                                    <li>
                                        <lable  title="" class="pointer btn-detail-branch-booking" data-toggle="tooltip" data-take-away="'.$data[$i]['is_have_take_away'].'" data-original-title="Chi tiết món mang về" onclick="detailBranch($(this))"  value="'. $data[$i]['id'] .'" data-id="' . $data[$i]['id'] . '" data-booking="' . $data[$i]['is_enable_booking'] . '" data-status="'. $data[$i]['status'] .'" onclick="detailMemberShipCard($(this))">
                                            <i class="fa fa-eye"></i>
                                        </lable>
                                    </li>
                                </ul>';
                    }
                    $list_branch .= '<div class=" col-6 edit-flex-auto-fill">
                                    <div class="box-image">
                                        <figure class="box-image-banner">
                                            <img onerror="imageDefaultOnLoadError($(this))" src="' . $data_banner . '" alt="">
                                            '. $button .'
                                        </figure>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <div class="profile-branch">
                                                        <div class="profile-branch-thumb">
                                                            <img onerror="imageDefaultOnLoadError($(this))" alt="author" class="thumbnail-branch-logo-booking" src="'. $data_image .'">
                                                        </div>
                                                        <div class="author-content">
                                                            <a class="custom-name" id="branch-setting-name" style="">' . $data[$i]['name'] . '</a>
                                                            <i class="fa fa-check-circle text-success pr-1" id="branch-setting-status-on"></i>
                                                            <i class="fa fa-ban text-danger pr-1 d-none" id="branch-setting-status-off"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-content">
                                            <ul class="frnd-info">
                                                <li><span><i class="fa fa-user pr-2"></i></span> ' . $data[$i]['employee_manager_full_name'] . '</li>
                                                <li><span><i class="fa fa-phone pr-2"></i></span> ' . $data[$i]['phone'] . ' </li>
                                                <li><span><i class="fa fa-map-marker pr-2"></i></span> ' . $data[$i]['address'] . ' </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>';
                }
            }
            return [$list_branch, $config1];
        }catch (Exception $e){
            return $this->catchTemplate($config1, $e);
        }

    }

    public function drawTableFood($data)
    {
        return Datatables::of($data)
            ->addColumn('code', function ($row) {
                return '<label class="text-primary">' . $row['code'] . '</label>';
            })
            ->addColumn('price', function ($row) {
                return '<label>'. $this->numberFormat($row['price'])  .'</label><br>
                        <label class="number-order"><em style="color: #9d9d9de6">Gốc: </em>'. $this->numberFormat($row['original_price'])  .'</label>';
            })
            ->addColumn('avatar', function ($row) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>';
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
                return '<div class="btn-group btn-group-sm text-center">
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="'. $row['id_type_food'] .'"><i class="fi-rr-eye"></i></button>
                        </div>';
            })
            ->addColumn('name', function ($row) {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                            <label class="title-name-new-table"  >'.$row['name'].'<br><label class="label-new-table"><i class="fa fa-cutlery mr-1"></i>'.$row['code'].'</label></label>';
            })
            ->addColumn('vat', function ($row) {
                return $row['restaurant_vat_config_percent'] . '%';
            })
            ->addColumn('original_revenue', function ($row) {
                return '<label>' . $this->numberFormat($row['original_revenue_percent'], 1) . '%' .'</label><br>
                        <label class="number-order">'. '<em style="color: #9d9d9de6">TT: </em>' . $this->numberFormat($row['original_revenue'] ) .'</label>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addIndexColumn()
            ->rawColumns(['code', 'action','price', 'avatar','name','vat','original_revenue'])
            ->make(true);
    }

    public function dataUpdate(Request $request)
    {
        $key = '';
        $brand = $request->get('brand');
        $is_temporary_percent = Config::get('constants.type.is_take_away.GET_ALL');
        $is_promotion_percent = Config::get('constants.type.is_take_away.GET_ALL');
        $branch_id = $request->get('branch');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $category_type = Config::get('constants.type.id.GET_ALL');
        $category_id = Config::get('constants.type.id.GET_ALL');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_count_material = Config::get('constants.type.checkbox.GET_ALL');
        $is_allow_purchase_by_point = Config::get('constants.type.is_take_away.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.GET_ALL');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $is_bestseller = Config::get('constants.type.checkbox.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_kitchen = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.status.GET_ALL');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_BRANCH_MANAGE, $status, $is_take_away, $is_addition, $category_type, $category_id, $brand, $branch_id, $is_count_material, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $page, $key, $is_allow_purchase_by_point, $is_temporary_percent, $is_promotion_percent);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $collection = collect($data);
            $data_selected = $collection->where('is_take_away', (int)Config::get('constants.type.checkbox.SELECTED'))->all();
            $data_un_selected = $collection->where('is_take_away', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->all();
            $data_table_all = DataTables::of($data_un_selected)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('avatar', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>';
                })
                ->addColumn('action', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
//                    return '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-avatar="' . $domain . $row['avatar'] . '" data-amount="' . $this->numberFormat($row['price']) . '" onclick="checkFoodTakeAway($(this))"></i>';
                    return '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-avatar="' . $domain . $row['avatar'] . '" data-amount="' . $this->numberFormat($row['price']) . '" onclick="checkFoodTakeAway($(this))"><i class="fi-rr-arrow-small-right"></i></button> </div>';

                })
                ->addColumn('name', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                            <label class="title-name-new-table" >'.$row['name'].'<br><label class="label-new-table"><i class="fa fa-cutlery mr-1"></i>'.$row['category_name'].'</label></label>';
                })
                ->rawColumns(['avatar', 'action','name'])
                ->addIndexColumn()
                ->make(true);

            $data_table_selected = DataTables::of($data_selected)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('avatar', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/></label><input value="' . $row['id'] . '" class="d-none"/>';
                })
                ->addColumn('action', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
//                    return '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-avatar="' . $domain . $row['avatar'] . '" data-amount="' . $this->numberFormat($row['price']) . '" onclick="unCheckFoodTakeAway($(this))"></i>';
                    return '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-avatar="' . $domain . $row['avatar'] . '" data-amount="' . $this->numberFormat($row['price']) . '" onclick="unCheckFoodTakeAway($(this))"><i class="fi-rr-arrow-small-left"></i></button></div>';
                })
                ->addColumn('name', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
                    return '<img onerror="imageDefaultOnLoadError($(this))"  src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                            <label class="title-name-new-table" >'.$row['name'].'<br><label class="label-new-table"><i class="fa fa-cutlery mr-1"></i>'.$row['category_name'].'</label></label>';
                })
                ->rawColumns(['avatar', 'action','name'])
                ->addIndexColumn()
                ->make(true);

            return [$data_table_all, $data_table_selected, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function update(Request $request)
    {
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_TAKE_AWAY_BRANCH_POST_ASSIGN_FOOD);
        $body = [
            "branch_id" => $request->get('branch'),
            "food_ids" => $request->get('foods')
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function setting(Request $request)
    {
        // Bặt tắt setting
        $data = Session::get(SESSION_KEY_SETTING_CURRENT_BRANCH);
        $data['is_have_take_away'] = $request->get('is_have_take_away');
        $branch = $request->get('branch');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_TAKE_AWAY_FOOD_POST_SETTING, $branch);
        $body = $data;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            if ($config['status'] === (int)Config::get('constants.type.status.STATUS_SUCCESS')){
                Session::put(SESSION_KEY_SETTING_CURRENT_BRANCH, $config['data']);
            }else{
                return $config;
            }
        }catch (Exception $e){
            return $this->catchTemplate($config , $e);
        }

        //  Danh sách chi nhánh
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $is_office = Config::get('constants.type.branch.GET_NOT_OFFICE');
        $is_card = Config::get('constants.type.checkbox.GET_ALL');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_BOOKING_GET_BRANCH_BOOKING, $restaurant_brand_id, $status, $is_card, $is_office);
        $body = null;
        $config1 = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            Session::put(SESSION_KEY_DATA_BRANCH, $config1['data']);
            return $config;
        }catch (Exception $e){
            return $this->catchTemplate($config1 , $e);
        }
    }
}
