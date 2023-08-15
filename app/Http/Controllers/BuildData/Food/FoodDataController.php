<?php

namespace App\Http\Controllers\BuildData\Food;

use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class FoodDataController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            return view('errors.403');
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
        $active_nav = 'Món ăn';
        return view('build_data.food.food.index', compact('active_nav'));
    }

    //  Danh sách món ăn
    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $status = Config::get('constants.type.status.DIS_SELECTED');
        $category = Config::get('constants.type.id.GET_ALL');
        $isCombo = Config::get('constants.type.checkbox.GET_ALL');
        $isSpecialGift = Config::get('constants.type.checkbox.GET_ALL');
        $isAddition = Config::get('constants.type.checkbox.GET_ALL');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $key = '';
        $branchID = Config::get('constants.type.id.GET_ALL');
        $categoryID = $request->get('category_id');
        $isTakeAway = Config::get('constants.type.is_take_away.GET_ALL');
        $isCountMaterial = Config::get('constants.type.checkbox.SELECTED');
        $isBestseller = Config::get('constants.type.checkbox.GET_ALL');
        $isKitchen = Config::get('constants.type.checkbox.GET_ALL');
        $isGetFoodContainAddition = Config::get('constants.type.checkbox.GET_ALL');
        $alertOriginalFoodID = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api =sprintf(API_FOOD_GET_ALL_MANAGE, $status, $isTakeAway, $isAddition, $category, $categoryID, $brand, $branchID, $isCountMaterial, $page, $limit, $isBestseller, $isCombo, $isKitchen, $isSpecialGift, $key, $isGetFoodContainAddition, $alertOriginalFoodID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $config1 = $config;
           try {
            $collection = collect($config['data']['list']);
            $dataFoodCombo = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('food_addition_ids', [])
                ->all();
            $dataFood = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('category_type_id', (int)Config::get('constants.type.category.FOOD'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $dataDrink = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('category_type_id', (int)Config::get('constants.type.category.DRINK'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $dataSeaFood = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('category_type_id', (int)Config::get('constants.type.category.SEA_FOOD'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $dataOther = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('category_type_id', (int)Config::get('constants.type.category.OTHER'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $dataCombo = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $dataGift = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $dataAddition = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->where('is_combo', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_special_gift', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->where('is_addition', (int)Config::get('constants.type.checkbox.SELECTED'))
                ->all();

            $dataDisabled = $collection
                ->where('status', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))
                ->all();
            $domain = Session::get(SESSION_JAVA_BASE_URL);
            $dataCode = [];
            foreach ($config['data']['list'] as $key => $data) {
                $dataCode[$key] = [
                    'code' => $data['code'],
                    'avatar' => $domain . $data['avatar'],
                    'name' => $data['name'],
                    'category_type' => $data['category_type'],
                    'status' => $data['status'],
                    'is_combo' => $data['is_combo'],
                    'is_addition' => $data['is_addition'],
                    'is_special_gift' => $data['is_special_gift'],
                ];
            }
            $dataOption = '';
            if (count($dataFoodCombo) === 0) {
                $dataOption = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            } else {
                $dataOption = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
                foreach ($dataFoodCombo as $db) {
//                    if($db['is_addition']){
                        $dataOption .= '<option value="' . $db['id'] . '" data-weight="' . $db['is_sell_by_weight'] . '" data-original-price="' . $this->numberFormat($db['original_price']) . '">' . $db['name'] . '</option>';
//                    }
                }
            }

            $dataTableFood = $this->drawTableFoodData($dataFood)->original['data'];
            $dataTableDrink = $this->drawTableFoodData($dataDrink)->original['data'];
            $dataTableSeaFood = $this->drawTableFoodData($dataSeaFood)->original['data'];
            $dataTableOther = $this->drawTableFoodData($dataOther)->original['data'];
            $dataTableCombo = $this->drawTableComboFoodData($dataCombo)->original['data'];
            $dataTableGift = $this->drawTableFoodData($dataGift)->original['data'];
            $dataTableAddition = $this->drawTableFoodData($dataAddition)->original['data'];
            $dataTotal = array(
                'total_record_food' => count($dataFood),
                'total_record_drink' => count($dataDrink),
                'total_record_seafood' => count($dataSeaFood),
                'total_record_other' =>  count($dataOther),
                'total_record_combo' =>  count($dataCombo),
                'total_record_gift' =>  count($dataGift),
                'total_record_addition' =>  count($dataAddition),
                'total_record_disable' =>  count($dataDisabled),
            );

            return [$dataTableFood, $dataTableDrink, $dataTableSeaFood, $dataTableOther, $dataTableCombo, $dataTableGift, $dataTableAddition, $dataTotal, $dataCode, $dataOption ,$config1, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }


    public function dataCreateFoodManage(Request $request)
    {
        $brand  = $request->get('brand');
        // Đơn vị
        $api = API_FOOD_GET_UNIT_MANAGE;
        $body = null;

        $requestUnitFoodManage = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        // Danh mục
        $categoryType = ENUM_GET_ALL;
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $api = sprintf(API_FOOD_GET_CATEGORY_MANAGE, $brand, $status, $categoryType);
        $body = null;
        $requestCategoryFoodManage = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];


        // Vat
        $api = sprintf(API_FOOD_GET_VAT_BRAND_MANAGE, $status);
        $body = null;
        $requestVatFoodData = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];

        $configAll = $this->callApiMultiGatewayTemplate([$requestUnitFoodManage, $requestCategoryFoodManage , $requestVatFoodData]);
        try {
            $dataUnit = $configAll[0]['data'];
            $dataOptionUnit = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            if (count($dataUnit) === 0) {
                $dataOptionUnit = '<option value="" data-category-type="">' . TEXT_NULL_OPTION . '</option>';
            } else {
                foreach ($dataUnit as $db) {
                    $dataOptionUnit .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                }
            }
            $dataSortCategory = $configAll[1]['data'];
            $dataCategorySortFoodDataFood = '<option value="-1" selected>Tất cả danh mục</option>';
            $dataCategorySortFoodDataDrink = '<option value="-1" selected>Tất cả danh mục</option>';
            $dataCategorySortFoodDataOther = '<option value="-1" selected>Tất cả danh mục</option>';

            if (count($dataSortCategory) === 0) {
                $dataCategorySortFoodDataFood = '<option value="" data-category-type="" selected disabled>' . TEXT_NULL_OPTION . '</option>';
                $dataCategorySortFoodDataDrink = '<option value="" data-category-type="" selected disabled>' . TEXT_NULL_OPTION . '</option>';
                $dataCategorySortFoodDataOther = '<option value="" data-category-type="" selected disabled>' . TEXT_NULL_OPTION . '</option>';
            } else {
                foreach ($dataSortCategory as $db) {
                    switch ($db['category_type']){
                        case 1:
                            $dataCategorySortFoodDataFood .= '<option value="' . $db['id'] . '" data-category-type="'. $db['category_type'] .'">' . $db['name'] . '</option>';
                            break;
                        case 2:
                            $dataCategorySortFoodDataDrink .= '<option value="' . $db['id'] . '" data-category-type="'. $db['category_type'] .'">' . $db['name'] . '</option>';
                            break;
                        case 3:
                            $dataCategorySortFoodDataOther .= '<option value="' . $db['id'] . '" data-category-type="'. $db['category_type'] .'">' . $db['name'] . '</option>';
                            break;
                    }
                }
            }
            $dataCategoryFood = $configAll[1]['data'];
            $dataOptionCategory = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            if (count($dataCategoryFood) === 0) {
                $dataOptionCategory = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            } else {
                foreach ($dataCategoryFood as $db) {
                    $dataOptionCategory .= '<option value="' . $db['id'] . '" data-id-category="' . $db['category_type'] . '">' . $db['name'] . '</option>';
                }
            }

            $collection = collect($dataCategoryFood);
            $dataCategoryNormalFood = array_values($collection->where('category_type', (int)Config::get('constants.type.category.FOOD'))->toArray());
            $dataCategorySeafood = array_values($collection->where('category_type', (int)Config::get('constants.type.category.SEA_FOOD'))->toArray());
            $dataCategoryFoodNotDrinkOther = array_merge($dataCategoryNormalFood, $dataCategorySeafood);
            $dataFoodNotDrinkOther = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            if (count($dataCategoryFoodNotDrinkOther) === 0) {
                $dataFoodNotDrinkOther = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            } else {
                foreach ($dataCategoryFoodNotDrinkOther as $data) {
                    $dataFoodNotDrinkOther .= '<option value="' . $data['id'] . '" data-id-category="' . $data['category_type'] . '">' . $data['name'] . '</option>';
                }
            }

            $dataVat = $configAll[2]['data'];
            $dataOptionVat = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            if (count($dataVat) === 0) {
                $dataOptionVat = '<option value="">' . TEXT_DEFAULT_OPTION . '</option>';
            }else{
                foreach ($dataVat as $db) {
                    $dataOptionVat .= '<option value="' . $db['id'] . '">' . $db['vat_config_name'] . '</option>';
                }
            }

            return [$dataOptionUnit , $dataOptionCategory , $dataOptionVat ,$configAll, $dataFoodNotDrinkOther, $dataCategorySortFoodDataFood, $dataCategorySortFoodDataDrink, $dataCategorySortFoodDataOther, $configAll[1]];
        }catch (Exception $e) {
            $this->catchTemplate($configAll, $e);
        }
    }

    public function drawTableFoodData($data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        return DataTables::of($data)
            ->addColumn('temporary_price', function ($row) {
                if ($row['is_temporary_percent'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    return $this->numberFormat($row['temporary_percent'], 1) . '%';
                } else {
                    return $this->numberFormat($row['temporary_price']);
                }
            })
            ->addColumn('name_avatar', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table">
                     <label class="name-inline-data-table">' .$row['name'] . '<br>
                          <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' . $row['unit_type'] . '</label>
                     </label>';
            })
            ->addColumn('price', function ($row) {
                return '<label class="font-weight-bold">'. $this->numberFormat($row['price'])  .'</label><br>
                        <label class="number-order">Vốn: '. $this->numberFormat($row['original_price'])  .'</label>';
            })
            ->addColumn('point_to_purchase', function ($row) {
                if(Session::get(SESSION_KEY_LEVEL) === (int)Config::get('constants.is_check.level.TWO')){
                    return '<lable class="disabled">0</lable>';
                }else{
                    return $this->numberFormat($row['point_to_purchase']);
                }
            })
            ->addColumn('original_price', function ($row) {
                return $this->numberFormat($row['original_price']);
            })
            ->addColumn('profit_rate_by_original_price', function ($row) {
                return $this->numberFormat($row['profit_rate_by_original_price']) . '%';
            })
            ->addColumn('profit_rate_by_price', function ($row) {
                return $this->numberFormat($row['profit_rate_by_price']) . '%';
            })
            ->addColumn('original_revenue', function ($row) {
                return $this->numberFormat($row['original_revenue']) ;
            })
            ->addColumn('material_count', function ($row) {
                if ($row['material_count'] > 0) {
                    return '<div class="btn-group btn-group-sm pointer"><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_QUANTITATIVE . '"></i></div>';
                } else {
                    return '<div class="btn-group btn-group-sm pointer"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NOT_QUANTITATIVE . '"></i></div>';
                }
            })
            ->addColumn('action', function ($row) {
                $type_food = Config::get('constants.type.TypeFood.FOOD');
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
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" title="' . TEXT_UPDATE . '" onclick="openModalUpdateFoodManage($(this))" data-id="' . $row['id'] . '" data-type-food="' . $row['id_type_food'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-brand><i class="fi-rr-pencil"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-category-type="'. $row['category_type_id'] .'" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                         </div>';
            })
            ->addColumn('vat', function ($row) {
                return $row['restaurant_vat_config_percent'] . '%';
            })

            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['avatar', 'material_count', 'action', 'name_avatar', 'point_to_purchase','price','original_revenue','vat'])
            ->addIndexColumn()
            ->make(true);
    }

    public function drawTableComboFoodData($data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        return DataTables::of($data)
            ->addColumn('temporary_price', function ($row) {
                if ($row['is_temporary_percent'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    return $this->numberFormat($row['temporary_percent']) . '%';
                } else {
                    return $this->numberFormat($row['temporary_price']);
                }
            })
            ->addColumn('name_avatar', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' .  $row['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' . $row['unit_type'] . '</label>
                         </label>';
            })
            ->addColumn('price', function ($row) {
                return '<label class="font-weight-bold">'. $this->numberFormat($row['price'])  .'</label><br>
                        <label class="number-order">Vốn: '. $this->numberFormat($row['original_price'])  .'</label>';
            })
            ->addColumn('point_to_purchase', function ($row) {
                if(Session::get(SESSION_KEY_LEVEL) === (int)Config::get('constants.is_check.level.TWO')){
                    return '<lable class="disabled">0</lable>';
                }else{
                    return $this->numberFormat($row['point_to_purchase']);
                }
            })
            ->addColumn('original_price', function ($row) {
                return $this->numberFormat($row['original_price']);
            })
            ->addColumn('original_revenue', function ($row) {
                return $this->numberFormat($row['original_revenue'] );
            })
            ->addColumn('profit_rate_by_original_price', function ($row) {
                return $this->numberFormat($row['profit_rate_by_original_price']) . '%';
            })
            ->addColumn('profit_rate_by_price', function ($row) {
                return $this->numberFormat($row['profit_rate_by_price']) . '%';
            })
            ->addColumn('action', function ($row) {
                $type_food = Config::get('constants.type.TypeFood.COMBO');
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
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" title="' . TEXT_UPDATE . '" onclick="openModalUpdateFoodManage($(this))" data-id="' . $row['id'] . '" data-type-food="' . $type_food . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-brand><i class="fi-rr-pencil"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
            })

            ->addColumn('vat', function ($row) {
                return $row['restaurant_vat_config_percent'] . '%';
            })

            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['name_avatar', 'material_count', 'action', 'point_to_purchase','vat','price','original_revenue'])
            ->addIndexColumn()
            ->make(true);
    }

    public function dataCodeFood(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $brand = $request->get('brand');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $category = Config::get('constants.type.id.GET_ALL');
        $isCombo = Config::get('constants.type.checkbox.GET_ALL');
        $isSpecialGift = Config::get('constants.type.checkbox.GET_ALL');
        $isAddition = Config::get('constants.type.checkbox.GET_ALL');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $key = '';
        $branchID = Config::get('constants.type.id.GET_ALL');
        $categoryID = Config::get('constants.type.id.GET_ALL');
        $isTakeAway = Config::get('constants.type.is_take_away.GET_ALL');
        $isCountMaterial = Config::get('constants.type.checkbox.SELECTED');
        $isBestseller = Config::get('constants.type.checkbox.GET_ALL');
        $isKitchen = Config::get('constants.type.checkbox.GET_ALL');
        $isGetFoodContainAddition = Config::get('constants.type.checkbox.GET_ALL');
        $alertOriginalFoodID = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $isTakeAway, $isAddition, $category, $categoryID, $brand, $branchID, $isCountMaterial, $page, $limit, $isBestseller, $isCombo, $isKitchen, $isSpecialGift, $key, $isGetFoodContainAddition, $alertOriginalFoodID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $option_error = '';
            $option_success = '';
            foreach ($config['data']['list'] as $dataCode) {
                if (!@file_get_contents($domain . $dataCode['avatar'])) {
                    $option_error .= '<option value="' . $dataCode['code'] . '" avatar="' . $domain . $dataCode['avatar'] . '" data-type="1">' . $dataCode['name'] . '</option>';
                } else {
                    $option_success .= '<option value="' . $dataCode['code'] . '" avatar="' . $domain . $dataCode['avatar'] . '" data-type="2">' . $dataCode['name'] . '</option>';
                }
            }
            $group_error = '<optgroup label="Món ăn không có ảnh" class="h3 text-left" id="group-error">' . $option_error . '</optgroup>';
            $group_sucesss = '<optgroup label="Món ăn có ảnh" class="h3 text-left" id="group-sucess"> ' . $option_success . ' </optgroup>';
            $group = '<option selected disabled>Vui lòng chọn</option>' . $group_error . $group_sucesss;
            return [$group, $config];
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
