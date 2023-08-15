<?php

namespace App\Http\Controllers\BuildData\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class PriceByAreaController extends Controller
{
    public function index(Request $request)
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
        $active_nav = 'Giá theo khu vực';
        return view('build_data.business.price_by_area.index', compact('active_nav'));
    }

    public function getFood(Request $request)
    {
        $area_id = $request->get('area_id');
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $branch_id = $request->get('branch_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_PRICE_BY_AREA_GET_LIST_ALL_FOOD, $branch_id, $area_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $detail = TEXT_DETAIL;
            $tableFoodBranch = DataTables::of($config['data']['list_branch_food_map'])
                ->addColumn('food_name', function ($row) use ($domain) {
                    return '<div class="d-flex"><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>
                            <label class="name-inline-data-table" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . ((mb_strlen($row['food_name']) > 30) ? mb_substr($row['food_name'], 0, 27) . '...' : $row['food_name']) . '<br>
                                <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>'. $row['unit'] .'</label>
                            </label></div>';
                })
                ->addColumn('category_name', function ($row) {
                    if (mb_strlen($row['category_name']) > 30) {
                        return mb_substr($row['category_name'], 0, 27) . '...';
                    } else {
                        return $row['category_name'];
                    }
                })
                ->addColumn('action', function ($row) {
                    $detail = TEXT_DETAIL;
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
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))" data-category-type="'.$row['category_type'].'" data-id="' . $row['food_id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkBranchFoodData($(this))" data-id="' . $row['food_id'] . '" data-type="0"><i class="fi-rr-arrow-small-right"></i></button>
                            </div>';
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['category_name'],$row['food_name'],$row['price']]);
                })
                ->rawColumns(['food_name', 'action'])
                ->addIndexColumn()
                ->make(true);
            $tableFoodArea = DataTables::of($config['data']['list_area_food_map'])
                ->addColumn('food_name', function ($row) use ($domain) {
                    if (mb_strlen($row['food_name']) > 20) {
                        return '<div class="d-flex"><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>
                                <label style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"  class="name-inline-data-table">' . mb_substr($row['food_name'], 0, 17) . '...<br>
                                    <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>'. $row['unit'] .'</label>
                                </label></div>';
                    }else{
                        return '<div class="d-flex"><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>
                                <label style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" class="name-inline-data-table">' . $row['food_name'] . '<br>
                                    <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>'. $row['unit'] .'</label>
                                </label></div>';
                    }
                })
                ->addColumn('category_name', function ($row) {
                    if (mb_strlen($row['category_name']) > 30) {
                        return mb_substr($row['category_name'], 0, 27) . '...';
                    } else {
                        return $row['category_name'];
                    }
                })
                ->addColumn('action', function ($row) {
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
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="unCheckBranchFoodData($(this))" data-price="' . $row['price_by_area'] . '" data-category-type="'.$row['category_type'].'" data-id="' . $row['food_id'] . '" data-type="1"><i class="fi-rr-arrow-small-left"></i></button>
                            </div>';
                })
                ->addColumn('action_detail', function ($row) {
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
                    return '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['food_id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>';
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('price_by_area', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input
                                    class="form-control text-center border-0 w-100 quantity amount-price-by-area-data"
                                    value="' . $this->numberFormat($row['price_by_area']) . '"
                                    data-max="999999999" data-money="1" data-min="0"
                                    data-price="' . $this->numberFormat($row['price']) . '"/>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['category_name'],$row['food_name'],$row['price']]);
                })
                ->rawColumns(['food_name', 'action', 'price_by_area', 'action_detail'])
                ->addIndexColumn()
                ->make(true);
            return [$tableFoodBranch, $tableFoodArea, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function area(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $status = ENUM_SELECTED;
        $is_take_away = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LIST_AREA_GET, $branch_id, $is_take_away, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $area = '';
            foreach ($data as $db) {
                $area .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
            return [$area, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function assignFood(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $area_id = $request->get('area_id');
        $foods = $request->get('foods');
        $unFoods = $request->get('un_foods');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_PRICE_BY_AREA_POST_ASSIGN;
        $body = [
            'branch_id' => $branch_id,
            'area_id' => $area_id,
            'foods_assign' => $foods,
            'food_ids_un_assign_area_food_map' => $unFoods,
        ];
        $configAssign = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $foodUpdate = $request->get('food_update');
        $api = API_PRICE_BY_AREA_POST_UPDATE;
        $body = [
            'branch_id' => $branch_id,
            'foods' => $foodUpdate,
        ];
        $configUpdate = $this->callApiGatewayTemplate($project, $method, $api, $body);
        return [$configAssign, $configUpdate];
    }
}



