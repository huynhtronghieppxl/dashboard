<?php

namespace App\Http\Controllers\Manage\AreaPrice;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class AreaPriceController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS']);
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
        $active_nav = 'Quản lý giá theo khu vực';
        return view('manage.area_price.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $areaID = $request->get('area_id');
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $branchID = $request->get('branch_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_AREA_PRICE_GET_LIST_FOOD, $branchID, $areaID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $detail = TEXT_DETAIL;
            $tableFoodArea = DataTables::of($config['data']['list_area_food_map'])
                ->addColumn('food_name', function ($row) use ($domain) {
                    if (mb_strlen($row['food_name']) > 30) {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>
                            <label class="name-inline-data-table">' . mb_substr($row['food_name'], 0, 27) . '...</label><br>
                            <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>'. $row['unit'] .'</label>';
                    }else{
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>
                            <label class="name-inline-data-table">' . $row['food_name'] . '<br>
                           <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>'. $row['unit'] .'</label></label>';
                    }
                })
                ->addColumn('category_name', function ($row) {
                    if (mb_strlen($row['category_name']) > 30) {
                        return mb_substr($row['category_name'], 0, 27) . '...';
                    } else {
                        return $row['category_name'];
                    }
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('price_by_area', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input
                                    class="form-control text-center border-0 w-100 quantity amount-price-by-area-data"
                                    value="' . $this->numberFormat($row['price_by_area']) . '"
                                    data-max="999999999" data-money="1" data-min="100"
                                    data-price="' . $this->numberFormat($row['price']) . '"/>
                            </div>';
                })
                ->addColumn('action', function ($row) use ($detail) {
                    $row['type_food'] = TEXT_NORMAL_FOOD;
                    $row['id_type_food'] = ENUM_TYPE_FOOD;
                    if ($row['is_combo'] === ENUM_SELECTED) {
                        $row['type_food'] = TEXT_COMBO_FOOD;
                        $row['id_type_food'] = ENUM_TYPE_FOOD_COMBO;
                    }
                    if ($row['is_addition'] === ENUM_SELECTED) {
                        $row['type_food'] = TEXT_ADDITION;
                        $row['id_type_food'] = ENUM_TYPE_FOOD_ADDITION;
                    }
                    return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))" data-category-type="' . $row['category_type'] . '" data-id="' . $row['food_id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['food_name', 'action', 'price_by_area'])
                ->addIndexColumn()
                ->make(true);
            return [$tableFoodArea, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function area(Request $request)
    {
        $branchID = $request->get('branch_id');
        $status = ENUM_SELECTED;
        $isTakeAway = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LIST_AREA_GET, $branchID, $isTakeAway, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $area = '';
            foreach ($data as $db) {
                $area .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
            if(count($data) === ENUM_DIS_SELECTED){
                $area = '<option value="">'. TEXT_NULL_OPTION .'</option>';
            }
            return [$area, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $branchID = $request->get('branch_id');
        $foodUpdate = $request->get('foods');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
         $api = sprintf(API_AREA_PRICE_POST_UPDATE);
         $body = [
            'branch_id' => $branchID,
            'foods' => $foodUpdate,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        return $config;
    }
}
