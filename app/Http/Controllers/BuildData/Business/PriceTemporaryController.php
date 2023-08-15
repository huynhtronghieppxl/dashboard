<?php

namespace App\Http\Controllers\BuildData\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables as DataTablesDataTables;

use function GuzzleHttp\json_decode;

class PriceTemporaryController extends Controller
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
        $active_nav = 'Giá thời vụ';
        return view('build_data.business.price_temporary.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branchID = '';
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $status = ENUM_STATUS_GET_ALL;
        $categoryType = ENUM_GET_ALL;
        $categoryID = ENUM_GET_ALL;
        $isTakeAway = ENUM_GET_ALL;
        $isCountMaterial = ENUM_GET_ALL;
        $isAddition = ENUM_GET_ALL;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $isBestseller = ENUM_GET_ALL;
        $isCombo = ENUM_GET_ALL;
        $isKitchen = ENUM_GET_ALL;
        $isSpecialGift = ENUM_DIS_SELECTED;
        $keySearch = '';
        $isGetFoodContainAddition = ENUM_GET_ALL;
        $alertOriginalFoodID = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api =sprintf(API_FOOD_GET_ALL_MANAGE, $status, $isTakeAway, $isAddition, $categoryType, $categoryID, $restaurantBrandID, $branchID, $isCountMaterial, $page, $limit, $isBestseller, $isCombo, $isKitchen, $isSpecialGift, $keySearch, $isGetFoodContainAddition, $alertOriginalFoodID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $collection = collect($data);
            $dataSelected = array_values($collection->where('is_temporary_percent', ENUM_SELECTED)->toArray());
            $dataTableSelected = DataTables::of($dataSelected)
                ->addColumn('original_price', function ($row) {
                    return $this->numberFormat($row['original_price']);
                })
                ->addColumn('price_not_temporary', function ($row) {
                    return $this->numberFormat($row['price_not_temporary']);
                })
                ->addColumn('temporary_price', function ($row) {
                        return $this->numberFormat($row['total_temporary_price']);
                })
                ->addColumn('name', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                            <label class="title-name-new-table" >'.$row['name'].'<br><label class="label-new-table"><i class="fa fa-cutlery mr-1"></i>'.$row['code'].'</label></label>';
                })
                ->addColumn('temporary_price_from_date', function ($row) {
                    return '<label>' . $this->convertDateTime($row['temporary_price_from_date'] ) . '</label>';
                })
                ->addColumn('temporary_price_to_date', function ($row) {
                    return '<label>' . $this->convertDateTime($row['temporary_price_to_date'] ) . '</label>';
                })
                ->addColumn('status', function ($row) {
                    if($row['status'] === ENUM_SELECTED){
                        return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                <label class="m-0">' . TEXT_STATUS_ENABLE . '</label>
                                </div>';
                    } else {
                        return '<div class="status-new seemt-gray seemt-border-gray d-flex" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to d-flex align-center justify-content-center" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_CLOSED . ' </label>
                                 </div>';
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
                    };
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red  waves-effect waves-light" onclick="cancelByOnePriceTemporary($(this))" data-name="'. $row['name'] .'" data-type="' . $row['category_type_id'] . '" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CANCEL . '"> <i class="fi-rr-cross"></i></button>
                           <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue  waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '" data-category-type="' . $row['category_type_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"> <i class="fi-rr-eye"></i></button>
                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['avatar', 'status','price_not_temporary','name','action', 'temporary_price_from_date', 'temporary_price_to_date'])
                ->addIndexColumn()
                ->make(true);

            if ($dataSelected !== []) {
                if ($dataSelected[0]['temporary_price_from_date'] !== '' && $dataSelected[0]['temporary_price_to_date'] !== '') {
                    $dateIn = $dataSelected[0]['temporary_price_from_date'] . ' ' . $dataSelected[0]['promotion_from_hour'];
                    $dateOut =$dataSelected[0]['temporary_price_to_date'] . ' ' . $dataSelected[0]['promotion_to_hour'];
                    $percent = $dataSelected[0]['temporary_percent'];
                } else {

                    $dateOut = date("d/m/Y");
                    $percent = 0;
                }
                if ($dataSelected[0]['temporary_price'] !== 0) {
                    $priceAssign = $this->numberFormat($dataSelected[0]['original_revenue'] - $dataSelected[0]['temporary_price']);
                } else {
                    $priceAssign = 0;
                }
            } else {
                $dateIn = date("d/m/Y");
                $dateOut = date("d/m/Y");
                $priceAssign = 0;
                $percent = 0;
            }
            if (empty($collection)) {
                $isEmpty = 1;
                $dataOpt = '<option selected disabled>' . TEXT_NULL_OPTION . '</option>';
            } else {
                $isEmpty = 0;
                $finalData = $collection->map(function ($d) {
                    return collect($d)->only(['id', 'avatar', 'name', 'original_price', 'category_type_id', 'price', 'status'])->all();
                });
                $notSpecialGift = collect($finalData->where('is_special_gift', ENUM_DIS_SELECTED)->all());
                $otherData = $notSpecialGift->where('category_type_id', Config::get('constants.type.category.OTHER'))->all();
                $foodData = $notSpecialGift->where('category_type_id', Config::get('constants.type.category.FOOD'))->all();
                $drinkData = $notSpecialGift->where('category_type_id', Config::get('constants.type.category.DRINK'))->all();
                $seaFoodData = $notSpecialGift->where('category_type_id', Config::get('constants.type.category.SEA_FOOD'))->all();
                $dataOpt = [
                    'all' => $this->convertToOptHtml($finalData->toArray(), ENUM_GET_ALL),
                    'other_opt' => $this->convertToOptHtml(array_values($otherData), Config::get('constants.type.category.OTHER')),
                    'food_opt' => $this->convertToOptHtml(array_values($foodData), Config::get('constants.type.category.FOOD')),
                    'drink_opt' => $this->convertToOptHtml(array_values($drinkData), Config::get('constants.type.category.DRINK')),
                    'sea_food_opt' => $this->convertToOptHtml(array_values($seaFoodData), Config::get('constants.type.category.SEA_FOOD')),
                ];
            }
            return [$data, $dataTableSelected, $config, $percent, $dateIn, $dateOut, $priceAssign, $isEmpty, $dataOpt];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function convertToOptHtml($data, $select_type)
    {
        $collection = collect($data)->where('status', ENUM_SELECTED)->toArray();
        if (empty($collection)) {
            $foodData = '<option selected>' . TEXT_NULL_OPTION . '</option>';
        } else {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $foodData = '<option selected value="">'. TEXT_SELECT_FOOD .'</option>';
            foreach ($collection as $item) {
                $foodData .= '<option value="' . $item['id'] . '" data-status="' . $item['status'] . '" data-avatar="' . $domain . $item['avatar'] . '" data-name="' . $item['name'] . '" data-price="' . $item['price'] . '" data-price-format="' . $this->numberFormat($item['price']) . '" data-select="' . $select_type . '">' . $item['name'] . '</option>';
            }
        }
        return $foodData;
    }

    public function update(Request $request)
    {
        $branch = $request->get('branch');
        $food = $request->get('food');
        $status = $request->get('status');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_TEMPORARY_FOOD_ASSIGN;
        $body = [
            "restaurant_brand_id" => (int)$request->get('restaurant_brand_id'),
            "branch_id" => $branch,
            "foods" => $food,
            "temporary_price_from_date" => $request->get('date_in'),
            "temporary_price_to_date" => $request->get('date_out'),
            "is_temporary" => $status,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
}
