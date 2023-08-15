<?php

namespace App\Http\Controllers\Manage\Food;

use Akaunting\Money\Money;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\Double;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CoursesTemplateExport;
use Yajra\DataTables\Html\Editor\Fields\Number;
use function GuzzleHttp\json_decode;

class FoodBrandManageController extends Controller
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
        $active_nav = 'Quản lý món ăn';
        return view('manage.food.brand.index', compact('active_nav'));
    }

    //  Danh sách món ăn
    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $status = ENUM_SELECTED;
        $category = ENUM_GET_ALL;
        $isCombo = ENUM_GET_ALL;
        $isSpecialGift = ENUM_GET_ALL;
        $isAddition = ENUM_GET_ALL;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $key = '';
        $branchID = ENUM_GET_ALL;
        $categoryID = $request->get('category_id');
        $isTakeAway = ENUM_GET_ALL;
        $isCountMaterial = ENUM_SELECTED;
        $isBestseller = ENUM_GET_ALL;
        $isKitchen = ENUM_GET_ALL;
        $isGetFoodContainAddition = ENUM_GET_ALL;
        $alertOriginalFoodID = $request->get('alert_original_price');
        $body = null;
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $isTakeAway, $isAddition, $category, $categoryID, $brand, $branchID, $isCountMaterial, $page, $limit, $isBestseller, $isCombo, $isKitchen, $isSpecialGift, $key, $isGetFoodContainAddition, $alertOriginalFoodID);
        $projectID = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;

        $config = $this->callApiGatewayTemplate($projectID, $method, $api, $body);

        try {
            $collection = collect($config['data']['list']);
            $dataFood = $collection
                ->where('category_type_id', ENUM_FOOD_CATEGORY_FOOD)
                ->where('is_combo', ENUM_DIS_SELECTED)
                ->where('is_special_gift', ENUM_DIS_SELECTED)
                ->where('is_addition', ENUM_DIS_SELECTED)
                ->where('status', ENUM_SELECTED)
                ->all();
            $dataDrink = $collection
                ->where('category_type_id', ENUM_FOOD_CATEGORY_DRINK)
                ->where('is_combo', ENUM_DIS_SELECTED)
                ->where('is_special_gift', ENUM_DIS_SELECTED)
                ->where('is_addition', ENUM_DIS_SELECTED)
                ->where('status', ENUM_SELECTED)
                ->all();
            $dataOther = $collection
                ->where('category_type_id', ENUM_FOOD_CATEGORY_OTHER)
                ->where('is_combo', ENUM_DIS_SELECTED)
                ->where('is_special_gift', ENUM_DIS_SELECTED)
                ->where('is_addition', ENUM_DIS_SELECTED)
                ->where('status', ENUM_SELECTED)
                ->all();
            $dataCombo = $collection
                ->where('is_combo', ENUM_SELECTED)
                ->where('is_special_gift', ENUM_DIS_SELECTED)
                ->where('is_addition', ENUM_DIS_SELECTED)
                ->where('status', ENUM_SELECTED)
                ->all();
            $dataAddition = $collection
                ->where('is_combo', ENUM_DIS_SELECTED)
                ->where('is_special_gift', ENUM_DIS_SELECTED)
                ->where('is_addition', ENUM_SELECTED)
                ->where('status', ENUM_SELECTED)
                ->all();

            $dataTableFood = $this->drawTableFoodBrandManage($dataFood)->original['data'];
            $dataTableDrink = $this->drawTableFoodBrandManage($dataDrink)->original['data'];
            $dataTableOther = $this->drawTableFoodBrandManage($dataOther)->original['data'];
            $dataTableCombo = $this->drawTableComboFoodBrandManage($dataCombo)->original['data'];
            $dataTableAddition = $this->drawTableFoodBrandManage($dataAddition)->original['data'];
            $dataConfigVat = array_merge($dataTableFood, $dataTableDrink, $dataTableOther, $dataTableCombo, $dataTableAddition);
            return [$dataTableFood, $dataTableDrink, $dataTableOther, $dataTableCombo, $dataTableAddition, $dataConfigVat, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataCountTab(Request $request) {
        $branchID = ENUM_GET_ALL;
        $brand = $request->get('brand');
        $body = null;
        $api = sprintf(API_FOOD_GET_TOTAL, $brand, $branchID);
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method =  ENUM_METHOD_GET;
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function dataFoodVat(Request $request)
    {
        $brand = $request->get('brand');
        $status = ENUM_SELECTED;
        $category = ENUM_ID_GET_ALL;
        $isCombo = ENUM_GET_ALL;
        $isSpecialGift = ENUM_GET_ALL;
        $isAddition = ENUM_GET_ALL;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $key = '';
        $branchID = ENUM_ID_GET_ALL;
        $categoryID = ENUM_ID_GET_ALL;
        $isTakeAway = ENUM_GET_ALL;
        $isCountMaterial = ENUM_GET_ALL;
        $isBestSeller = ENUM_GET_ALL;
        $isKitchen = ENUM_GET_ALL;
        $isGetFoodContainAddition = ENUM_GET_ALL;
        $alertOriginalFoodID = ENUM_GET_ALL;
        $body = null;
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $isTakeAway, $isAddition, $category, $categoryID, $brand, $branchID, $isCountMaterial, $page, $limit, $isBestSeller, $isCombo, $isKitchen, $isSpecialGift, $key, $isGetFoodContainAddition, $alertOriginalFoodID);
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data_table_food = $this->drawTableFoodBrandManage($config['data']['list']);
            return [$data_table_food, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataDisable(Request $request)
    {
        $brand = $request->get('brand');
        $status = ENUM_DIS_SELECTED;
        $category = ENUM_GET_ALL;
        $isCombo = ENUM_ID_GET_ALL;
        $isSpecialGift = ENUM_GET_ALL;
        $isAddition = ENUM_GET_ALL;
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $branchID = ENUM_ID_GET_ALL;
        $categoryID = $request->get('category_id');
        $isTakeAway = ENUM_GET_ALL;
        $isCountMaterial = ENUM_SELECTED;
        $isBestseller = ENUM_GET_ALL;
        $isKitchen = ENUM_GET_ALL;
        $isGetFoodContainAddition = ENUM_GET_ALL;
        $alertOriginalFoodID = $request->get('alert-original-price');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $isTakeAway, $isAddition, $category, $categoryID, $brand, $branchID, $isCountMaterial, $page, $limit, $isBestseller, $isCombo, $isKitchen, $isSpecialGift, $key, $isGetFoodContainAddition, $alertOriginalFoodID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $data = $config['data']['list'];
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['type_food'] = TEXT_NORMAL_FOOD;
            $data[$i]['id_type_food'] = ENUM_TYPE_FOOD;
            if ($data[$i]['is_combo'] === ENUM_SELECTED) {
                $data[$i]['type_food'] = TEXT_COMBO_FOOD;
                $data[$i]['id_type_food'] = ENUM_TYPE_FOOD_COMBO;
            }

            if ($data[$i]['is_addition'] === ENUM_SELECTED) {
                $data[$i]['type_food'] = TEXT_ADDITION;
                $data[$i]['id_type_food'] = ENUM_TYPE_FOOD_ADDITION;
            }
            $data[$i]['index'] = ($page - 1) * $limit + $i + 1;
            if ($data[$i]['is_temporary_percent'] === ENUM_SELECTED) {
                $data[$i]['temporary_percent'] = $this->numberFormat($data[$i]['temporary_percent'], 1) . '%';
            }
            if (Session::get(SESSION_KEY_LEVEL) > (int)Config::get('constants.is_check.level.THREE')) {
                if ($data[$i]['material_count'] > 0) {
                    $data[$i]['material_count'] = '<div class="btn-group btn-group-sm"><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_QUANTITATIVE . '" data-name="' . $data[$i]['name'] . '" data-id="' . $data[$i]['id'] . '"></i></div>';
                } else {
                    $data[$i]['material_count'] = '<div class="btn-group btn-group-sm"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NOT_QUANTITATIVE . '" data-name="' . $data[$i]['name'] . '" data-id="' . $data[$i]['id'] . '"></i></div>';
                }
            } else {
                $data[$i]['material_count'] = '<div class="btn-group btn-group-sm pointer"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NOT_QUANTITATIVE . '" onclick="showNotifyLevel($(this))"  data-name="' . $data[$i]['name'] . '" data-id="' . $data[$i]['id'] . '""></i></div>';
            }
            if (mb_strlen($data[$i]['code']) > 20) {
                $data[$i]['code'] = mb_substr($data[$i]['code'], 0, 17) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $data[$i]['code'] . '"></i></label>';
            }
            if (mb_strlen($data[$i]['name']) > 30) {
                $data[$i]['food_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $data[$i]['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table" data-name="' . $data[$i]['name'] . '">' . mb_substr($data[$i]['name'], 0, 27) . ' ...<br>
                              <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' . $data[$i]['unit_type'] . '</label>
                         </label>';
            } else {
                $data[$i]['food_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $data[$i]['avatar'] . '" class="img-inline-name-data-table">
                                                             <label class="name-inline-data-table"  data-name="' . $data[$i]['name'] . '">' . $data[$i]['name'] . '<br>
                                                                  <label class="department-inline-name-data-table">
                                                                    <i class="fa fa-cutlery"></i>' . $data[$i]['unit_type'] . '
                                                                  </label>
                                                             </label>';
            }
            if ($data[$i]['percentage_alert_original_food'] == ENUM_WARNING_ORIGINAL_PRICE_DANGER) {
                $icon = '<i class="fa fa-exclamation-triangle text-danger pl-1 mb-1" data-toggle="tooltip" data-placement="top" data-original-title="' . ENUM_WARNING_ORIGINAL_PRICE_DANGER . '"></i>';
            } else if ($data[$i]['percentage_alert_original_food'] == ENUM_WARNING_ORIGINAL_PRICE_WARNING) {
                $icon = '<i class="fa fa-exclamation-triangle text-warning pl-1 mb-1" data-toggle="tooltip" data-placement="top" data-original-title="' . ENUM_WARNING_ORIGINAL_PRICE_WARNING . '"></i>';
            } else if ($data[$i]['percentage_alert_original_food'] == ENUM_WARNING_ORIGINAL_PRICE_PRIMARY) {
                $icon = '<i class="fa fa-exclamation-triangle text-primary pl-1 mb-1" data-toggle="tooltip" data-placement="top" data-original-title="' . ENUM_WARNING_ORIGINAL_PRICE_PRIMARY . '"></i>';
            } else {
                $icon = '<i class="fa fa-exclamation-triangle text-success pl-1 mb-1" data-toggle="tooltip" data-placement="top" data-original-title="' . ENUM_WARNING_ORIGINAL_PRICE_SAFE . '"></i>';
            }
            if (Session::get(SESSION_KEY_LEVEL) > (int)Config::get('constants.is_check.level.FIVE')) {
                $data[$i]['original_percent'] = '<div class="d-flex align-items-center justify-content-center">' . $this->numberFormat($data[$i]['original_percent']) . '% ' . $icon . '</div>';
            } else {
                $data[$i]['original_percent'] = $this->numberFormat($data[$i]['original_percent']) . '% ';
            }
            $data[$i]['avatar'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $data[$i]['avatar_thump'] . '"  class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $data[$i]['avatar'] . "'" . ')" style="object-fit:cover;"/>';
            if (Session::get(SESSION_KEY_LEVEL) === (int)Config::get('constants.is_check.level.TWO')) {
                $data[$i]['point_to_purchase'] = '<lable class="disabled">0</lable>';
            }
            $data[$i]['original_revenue'] = $this->numberFormat($data[$i]['original_revenue']);
            // thêm data vào 2 cột tỷ suất lợi nhuận
            $data[$i]['profit_rate_by_original_price'] = $this->numberFormat($data[$i]['profit_rate_by_original_price']) . '%';
            $data[$i]['profit_rate_by_price'] = $this->numberFormat($data[$i]['profit_rate_by_price']) . '%';
            $data[$i]['action'] = '<div class="btn-group btn-group-sm text-center d-flex">
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green seemt-green waves-effect waves-light btn_enable_all_branch" title="' . TEXT_ENABLE . '" onclick="changeStatusFoodBrandManage($(this))" data-id="' . $data[$i]['id'] . '" data-status="' . $data[$i]['status'] . '" data-restaurant="' . $data[$i]['restaurant_brand']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $data[$i]['id'] . '" data-type="' . $data[$i]['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="'. TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                         </div>';
            $data[$i]['original_price'] = $this->numberFormat($data[$i]['original_price']);
            $data[$i]['price'] = '<label class="font-weight-bold">' . $this->numberFormat($data[$i]['price']) . '</label></br>
                                        <label class="number-order"> Vốn: ' . $this->numberFormat($data[$i]['original_price']) . '</label>';
            if ($data[$i]['restaurant_vat_config_id'] === 0) {
                $data[$i]['vat'] = '<label>' . $data[$i]['restaurant_vat_config_percent'] . '%</label>';
            } else {
                $data[$i]['vat'] = '<label>' . $data[$i]['restaurant_vat_config_percent'] . '%</label>';
            }
            $data[$i]['keysearch'] = '';
        }
        $data_table = array(
            'draw' => $request->get('draw'),
            'recordsTotal' => $config['data']['total_record'],
            'recordsFiltered' => $config['data']['total_record'],
            'data' => $data,
            'total_record_disable' => $this->numberFormat($config['data']['total_record']),
            'key' => $key,
            'page' => $page,
            'config' => $config
        );
        return json_encode($data_table);
    }

    public function drawTableFoodBrandManage($data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                return '<div class="form-validate-checkbox mt-2">
                            <div class="checkbox-form-group">
                                <input value="' . $row['id'] . '" name="check-vat-food-brand-manage" type="checkbox">
                                <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">
                                </label>
                            </div>
                        </div>';
            })
            ->addColumn('vat', function ($row) {
                if ($row['restaurant_vat_config_id'] === 0) {
                    return $row['restaurant_vat_config_name'] . ' ' . $row['restaurant_vat_config_percent'] . '%';
                } else {
                    return $row['vat'] = '<label>' . $row['restaurant_vat_config_percent'] . '%</label>';
                }
            })
            ->addColumn('original_percent', function ($row) {
                if ($row['percentage_alert_original_food'] == ENUM_WARNING_ORIGINAL_PRICE_DANGER) {
                    $icon = '<i class="fa fa-exclamation-triangle text-danger pl-1 mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Nguy hiểm"></i>';
                } else if ($row['percentage_alert_original_food'] == ENUM_WARNING_ORIGINAL_PRICE_WARNING) {
                    $icon = '<i class="fa fa-exclamation-triangle text-warning pl-1 mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Cảnh báo"></i>';
                } else if ($row['percentage_alert_original_food'] == ENUM_WARNING_ORIGINAL_PRICE_SAFE) {
                    $icon = '<i class="fa fa-exclamation-triangle text-success pl-1 mb-1" data-toggle="tooltip" data-placement="top" data-original-title="An toàn"></i>';
                } else if ($row['percentage_alert_original_food'] == ENUM_WARNING_ORIGINAL_PRICE_PRIMARY) {
                    $icon = '<i class="fa fa-exclamation-triangle text-primary pl-1 mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Tạm ổn"></i>';
                } else {
                    $icon = '';
                }
                if (Session::get(SESSION_KEY_LEVEL) > (int)Config::get('constants.is_check.level.FIVE')) {
                    return '<div class="d-flex align-items-center justify-content-center">' . round($this->numberFormat($row['original_percent']), 2) . '% ' . $icon . '</div>';
                } else {
                    return round($this->numberFormat($row['original_percent']), 2) . '% ';
                }
            })
            ->addColumn('vat_setup', function ($row) {
                return $row['restaurant_vat_config_name'] . ' (' . $row['restaurant_vat_config_percent'] . '%)';
            })
            ->addColumn('temporary_price', function ($row) {
                if ($row['is_temporary_percent'] === (int)ENUM_SELECTED) {
                    return $this->numberFormat($row['temporary_percent']) . '%';
                } else {
                    return $this->numberFormat($row['temporary_price']);
                }
            })
            ->addColumn('food_name', function ($row) use ($domain) {
                if (mb_strlen($row['name']) > 20) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table"  data-name="' . $row['name'] . '">' . mb_substr($row['name'], 0, 17) . ' ...<br>
                              <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' . $row['unit_type'] . '</label>
                         </label>';
                } else {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table" data-name="' . $row['name'] . '">' . $row['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' . $row['unit_type'] . '</label>
                         </label>';
                }
            })->addColumn('full_food_name', function ($row) use ($domain) {
                return   $row['name']  ;
            })
            ->addColumn('avatar', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '"  class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>';
            })
            ->addColumn('price', function ($row) {
                return $row['price'] = '<label class="font-weight-bold">' . $this->numberFormat($row['price']) . '</label></br>
                                        <label class="number-order"> Vốn: ' . $this->numberFormat($row['original_price']) . '</label>';
            })
            ->addColumn('point_to_purchase', function ($row) {
                if (Session::get(SESSION_KEY_LEVEL) === (int)Config::get('constants.is_check.level.TWO')) {
                    return '<lable class="disabled">0</lable>';
                } else {
                    return $this->numberFormat($row['point_to_purchase']);
                }
            })
            ->addColumn('original_price', function ($row) {
                return $this->numberFormat($row['original_price']);
            })
            ->addColumn('original_revenue', function ($row) {
                return $this->numberFormat($row['original_revenue']);
            })
            // thêm 2 cột tỷ suất lợi nhuận
            ->addColumn('profit_rate_by_original_price', function ($row) {
                return $this->numberFormat($row['profit_rate_by_original_price']) . '%';
            })
            ->addColumn('profit_rate_by_price', function ($row) {
                return $this->numberFormat($row['profit_rate_by_price']) . '%';
            })
            ->addColumn('material_count', function ($row) {
                if (Session::get(SESSION_KEY_LEVEL) > (int)Config::get('constants.is_check.level.THREE')) {
                    switch ((int)$row['material_food_map_type']) {
                        case 0 :
                            return '<div class="btn-group btn-group-sm"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NOT_QUANTITATIVE . '"></i></div>';
                        case 1 :
                            return '<div class="btn-group btn-group-sm"><i class="text-danger fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="Thay đổi định lượng"></i></div>';
                        case 2 :
                            return '<div class="btn-group btn-group-sm"><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_QUANTITATIVE . '"></i></div>';
                    }
                } else {
                    return '<div class="btn-group btn-group-sm"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NOT_QUANTITATIVE . '" onclick="showNotifyLevel($(this))"   data-name="' . $row['name'] . '" data-id="' . $row['id'] . '""></i></div>';
                }
            })
            ->addColumn('action', function ($row) {
                $type_food = ENUM_TYPE_FOOD;
                $row['type_food'] = Config::get('constants.response_text.TypeFood.FOOD');
                $row['id_type_food'] = ENUM_TYPE_FOOD;

                if ($row['is_combo'] === (int)ENUM_SELECTED) {
                    $row['type_food'] = TEXT_COMBO_FOOD;
                    $row['id_type_food'] = ENUM_TYPE_FOOD_COMBO;
                }

                if ($row['is_addition'] === (int)ENUM_SELECTED) {
                    $row['type_food'] = TEXT_ADDITION;
                    $row['id_type_food'] = ENUM_TYPE_FOOD_ADDITION;
                    $type_food = ENUM_TYPE_FOOD_ADDITION;
                }
                if (Session::get(SESSION_KEY_LEVEL) > (int)Config::get('constants.is_check.level.THREE')) {
                    return '<div class="btn-group btn-group-sm text-center d-flex">
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" title="' . TEXT_DISABLE_STATUS . '" onclick="changeStatusFoodBrandManage($(this))" data-restaurant="' . $row['restaurant_brand']['id'] . '" data-status="' . $row['status'] . '" data-id="' . $row['id'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="openModalCreateQuantityFoodManage($(this))" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-price="' . $row['price'] . '"  data-quantity="' . $row['unit_type'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_QUANTITATIVE_BUTTON . '"><span class="icofont icofont-law-alt-1"></span></button></br>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" title="' . TEXT_UPDATE . '" onclick="openModalUpdateFoodManage($(this))" data-from="' . $row['temporary_price_from_date'] . '" data-to="' . $row['temporary_price_to_date'] . '" data-id="' . $row['id'] . '" data-type-food="' . $type_food . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-brand><i class="fi-rr-pencil"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-category-type="' . $row['category_type_id'] . '" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                         </div>';
                } else {
                    return '<div class="btn-group btn-group-sm text-center d-flex">
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" title="' . TEXT_DISABLE_STATUS . '" onclick="changeStatusFoodBrandManage($(this))" data-restaurant="' . $row['restaurant_brand']['id'] . '" data-status="' . $row['status'] . '" data-id="' . $row['id'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" title="' . TEXT_UPDATE . '" onclick="openModalUpdateFoodManage($(this))" data-from="' . $row['temporary_price_from_date'] . '" data-to="' . $row['temporary_price_to_date'] . '" data-id="' . $row['id'] . '" data-type-food="' . $type_food . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-brand><i class="fi-rr-pencil"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-category-type="' . $row['category_type_id'] . '" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                         </div>';
                }

            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['original_percent', 'food_name','full_food_name', 'original_revenue', 'material_count', 'action', 'checkbox', 'point_to_purchase', 'vat', 'price'])
            ->addIndexColumn()
            ->make(true);
    }

    public function drawTableComboFoodBrandManage($data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        return DataTables::of($data)
            ->addColumn('temporary_price', function ($row) {
                if ($row['is_temporary_percent'] === (int)ENUM_SELECTED) {
                    return $this->numberFormat($row['temporary_percent'], 1) . '%';
                } else {
                    return $this->numberFormat($row['temporary_price']);
                }
            })
            ->addColumn('checkbox', function ($row) {
                return '<div class="form-validate-checkbox mt-2">
                            <div class="checkbox-form-group">
                                <input class="checkbox-vat-config-food-brand-manage" value="' . $row['id'] . '" name="print-kitchen-create-food-brand-manage" type="checkbox">
                                <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">
                                </label>
                            </div>
                        </div>';
            })
            ->addColumn('vat_setup', function ($row) {
                return $row['restaurant_vat_config_name'] . ' (' . $row['restaurant_vat_config_percent'] . '%)';
            })
            ->addColumn('vat', function ($row) {
                if ($row['restaurant_vat_config_id'] === 0) {
                    return $row['restaurant_vat_config_name'] . ' (' . $row['restaurant_vat_config_percent'] . '%)';
                } else {
                    return $row['vat'] = '<label>' . $row['restaurant_vat_config_percent'] . '%</label>';
                }
            })
            ->addColumn('food_name', function ($row) use ($domain) {
                if (mb_strlen($row['name']) > 20) {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . mb_substr($row['name'], 0, 17) . ' ...<br>
                              <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' . $row['unit_type'] . '
                         </label>';
                } else {
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $row['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' . $row['unit_type'] . '</label>
                         </label>';
                }
            })
            ->addColumn('full_food_name', function ($row)   {

                    return   $row['name']  ;
            })
            ->addColumn('avatar', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '"  class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>';
            })
            ->addColumn('price', function ($row) {
                return $row['price'] = '<label class="font-weight-bold">' . $this->numberFormat($row['price']) . '</label></br>
                                        <label class="number-order"> Vốn: ' . $this->numberFormat($row['original_price']) . '</label>';
            })
            ->addColumn('point_to_purchase', function ($row) {
                if (Session::get(SESSION_KEY_LEVEL) === (int)Config::get('constants.is_check.level.TWO')) {
                    return '<lable class="disabled">0</lable>';
                } else {
                    return $this->numberFormat($row['point_to_purchase']);
                }
            })
            ->addColumn('original_price', function ($row) {
                return $this->numberFormat($row['original_price']);
            })
            ->addColumn('original_revenue', function ($row) {
                return $row['original_revenue'] = '<label class="font-weight-bold">' . $this->numberFormat($row['original_revenue_percent']) . '%</label></br>
                                                        <label class="number-order">TT: ' . $this->numberFormat($row['original_revenue']) . '</label>';
            })
            // thêm 2 cột tỷ suất lợi nhuận
            ->addColumn('profit_rate_by_original_price', function ($row) {
                return $this->numberFormat($row['profit_rate_by_original_price']) . '%';
            })
            ->addColumn('profit_rate_by_price', function ($row) {
                return $this->numberFormat($row['profit_rate_by_price']) . '%';
            })
            ->addColumn('action', function ($row) {
                $type_food = ENUM_TYPE_FOOD_COMBO;
                $row['type_food'] = TEXT_COMBO_FOOD;
                $row['id_type_food'] = ENUM_TYPE_FOOD_COMBO;

                return '<div class="btn-group btn-group-sm text-center d-flex">
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" title="' . TEXT_DISABLE_STATUS . '" onclick="changeStatusFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-restaurant="' . $row['restaurant_brand']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button></br>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" title="' . TEXT_UPDATE . '" onclick="openModalUpdateFoodManage($(this))" data-from="' . $row['temporary_price_from_date'] . '" data-to="' . $row['temporary_price_to_date'] . '" data-type-food="' . $type_food . '" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                        </div>';
            })
            ->addColumn('original_percent', function ($row) {
                if ($row['percentage_alert_original_food'] == ENUM_WARNING_ORIGINAL_PRICE_DANGER) {
                    $icon = '<i class="fa fa-exclamation-triangle text-danger pl-1 mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Nguy hiểm"></i>';
                } else if ($row['percentage_alert_original_food'] == ENUM_WARNING_ORIGINAL_PRICE_WARNING) {
                    $icon = '<i class="fa fa-exclamation-triangle text-warning pl-1 mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Cảnh báo"></i>';
                } else if ($row['percentage_alert_original_food'] == ENUM_WARNING_ORIGINAL_PRICE_PRIMARY) {
                    $icon = '<i class="fa fa-exclamation-triangle text-primary pl-1 mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Tạm ổn"></i>';
                } else {
                    $icon = '<i class="fa fa-exclamation-triangle text-success pl-1 mb-1" data-toggle="tooltip" data-placement="top" data-original-title="An toàn"></i>';
                }
                if (Session::get(SESSION_KEY_LEVEL) > (int)Config::get('constants.is_check.level.FIVE')) {
                    return '<div class="d-flex align-items-center justify-content-center">' . $this->numberFormat($row['original_percent']) . '% ' . $icon . '</div>';
                } else {
                    return $this->numberFormat($row['original_percent']) . '% ';
                }
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['original_percent', 'food_name','full_food_name', 'original_revenue', 'material_count', 'action', 'price', 'checkbox', 'vat'])
            ->addIndexColumn()
            ->make(true);
    }

    public function drawTableFoodAssign($data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        return DataTables::of($data)
            ->addColumn('avatar', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar_thump'] . '"  class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" style="object-fit:cover;"/>';
            })
            ->addColumn('action', function ($row) {
                $type = ENUM_TYPE_FOOD;
                return '<div class="form-validate-checkbox mt-2">
                            <div class="checkbox-form-group">
                                <input value="' . $row['id'] . '" onclick="checkChangeFoodBrandManage()" name="print-kitchen-create-food-brand-manage food" type="checkbox">
                                <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">
                                </label>
                            </div>
                        </div>';
            })
            ->rawColumns(['avatar', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function dataCreate(Request $request)
    {
        /**
         * Food and addition
         */
        $brand = $request->get('brand');
        $status = ENUM_SELECTED;
        $category = ENUM_GET_ALL;
        $isCombo = ENUM_ID_GET_ALL;
        $isSpecialGift = ENUM_GET_ALL;
        $isAddition = ENUM_GET_ALL;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $key = '';
        $branchID = ENUM_ID_GET_ALL;
        $categoryID = ENUM_ID_GET_ALL;
        $isTakeAway = ENUM_GET_ALL;
        $isCountMaterial = ENUM_SELECTED;
        $isBestseller = ENUM_GET_ALL;
        $isKitchen = ENUM_GET_ALL;
        $isGetFoodContainAddition = ENUM_GET_ALL;
        $alertOriginalFoodID = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $isTakeAway, $isAddition, $category, $categoryID, $brand, $branchID, $isCountMaterial, $page, $limit, $isBestseller, $isCombo, $isKitchen, $isSpecialGift, $key, $isGetFoodContainAddition, $alertOriginalFoodID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']['list']);
            $food = $collection
                ->where('status', (int)ENUM_SELECTED)
                ->where('is_combo', (int)ENUM_DIS_SELECTED)
                ->where('is_special_gift', (int)ENUM_DIS_SELECTED)
                ->where('food_addition_ids', [])
                ->all();
            if (count($food) === 0) {
                $dataFood = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            } else {
                $dataFood = '<option value="" disabled selected>' . TEXT_FOOD_IN_COMBO_DEFAULT_OPTION . '</option>';
                foreach ($food as $db) {
                    if ($db['is_addition'] == 0) {
                        $dataFood .= '<option value="' . $db['id'] . '" data-weight="' . $db['is_sell_by_weight'] . '" data-original-price="' . $this->numberFormat($db['original_price']) . '" data_category_type_name="' . $db['category_type_name'] . '" data_category_type_id="' . $db['category_type_id'] . '" data-unit-type="' . $db['unit_type'] . '">' . $db['name'] . '</option>';
                    }
                }
            }
            return [$dataFood, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function unit(Request $request)
    {
        /**
         * Unit
         */
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = API_FOOD_GET_UNIT_MANAGE;
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $data = $config['data'];
        if (count($data) === 0) {
            $dataUnit = '<option disabled selected value="">' . TEXT_NULL_OPTION . '</option>';
        } else {
            $dataUnit = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($data as $db) {
                $dataUnit .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
        }
        return [$dataUnit, $config['config']];
    }

    public function category(Request $request)
    {
        /**
         * Category
         */
        $brand = $request->get('brand');
        $status = ENUM_STATUS_GET_ACTIVE;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_CATEGORY_MANAGE, $brand, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $dataSortCategory = $config['data'];
        $dataCategorySortFoodDataFood = '<option value="-1" selected>' . TEXT_ALL . '</option>';
        $dataCategorySortFoodDataDrink = '<option value="-1" selected>' . TEXT_ALL . '</option>';
        $dataCategorySortFoodDataOther = '<option value="-1" selected>' . TEXT_ALL . '</option>';

        if (count($dataSortCategory) === 0) {
            $dataCategorySortFoodDataFood = '<option value="" data-category-type="">' . TEXT_NULL_OPTION . '</option>';
            $dataCategorySortFoodDataDrink = '<option value="" data-category-type="">' . TEXT_NULL_OPTION . '</option>';
            $dataCategorySortFoodDataOther = '<option value="" data-category-type="">' . TEXT_NULL_OPTION . '</option>';
        } else {
            foreach ($dataSortCategory as $db) {
                switch ($db['category_type']) {
                    case 1:
                        $dataCategorySortFoodDataFood .= '<option value="' . $db['id'] . '" data-category-type="' . $db['category_type'] . '">' . $db['name'] . '</option>';
                        break;
                    case 2:
                        $dataCategorySortFoodDataDrink .= '<option value="' . $db['id'] . '" data-category-type="' . $db['category_type'] . '">' . $db['name'] . '</option>';
                        break;
                    case 3:
                        $dataCategorySortFoodDataOther .= '<option value="' . $db['id'] . '" data-category-type="' . $db['category_type'] . '">' . $db['name'] . '</option>';
                        break;
                }
            }
        }
        return [$dataCategorySortFoodDataFood, $dataCategorySortFoodDataDrink, $dataCategorySortFoodDataOther, $config];
    }


    public function create(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_FOOD_POST_CREATE_MANAGE);
        $body = [
            "id" => Config::get('constants.type.id.DEFAULT'),
            "restaurant_brand_id" => $request->get('brand'),
            "list_branch_kitchen" => [],
            "category_id" => $request->get('category_id'),
            "avatar" => $request->get('avatar') ? $request->get('avatar') : '',
            "avatar_thump" => $request->get('avatar_thumb'),
            "description" => $request->get('description'),
            "name" => $request->get('name'),
            "price" => $request->get('price'),
            "point_to_purchase" => ($request->get('point_to_purchase') === null) ? 0 : $request->get('point_to_purchase'),
            "time_to_completed" => $request->get('time_to_completed'),
            "unit" => $request->get('unit'),
            "is_allow_print" => $request->get('is_allow_print'),
            "is_allow_print_fishbowl" => $request->get('is_allow_print_fishbowl') ? $request->get('is_allow_print_fishbowl') : 0,
            "code" => $request->get('code'),
            "is_special_claim_point" => $request->get('is_special_claim_point'),
            "is_sell_by_weight" => $request->get('is_sell_by_weight'),
            "is_allow_review" => $request->get('is_allow_review'),
            "is_allow_purchase_by_point" => $request->get('is_allow_purchase_by_point'),
            "sale_online_status" => $request->get('is_take_away'),
            "is_addition" => $request->get('is_addition'),
            "food_addition_ids" => $request->get('food_addition_ids'),
            "is_combo" => $request->get('is_combo'),
            "is_special_gift" => $request->get('is_special_gift'),
            "is_allow_print_stamp" => $request->get('is_allow_print_stamp'),
            "list_combo" => $request->get('food_in_combo'),
            "original_price" => $request->get('original_price'),
            'restaurant_vat_config_id' => $request->get('restaurant_vat_config_id'),
            'is_allow_employee_gift' => 0,
            'is_addition_like_food' => $request->get('is_like_addtion_food_brand_manage')

        ];

        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['data'] != null) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                $type = ENUM_TYPE_FOOD;
                $is_combo = $config['data']['is_combo'];
                if (mb_strlen($config['data']['name']) > 30) {
                    $config['data']['name'] = mb_substr($config['data']['name'], 0, 25) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $config['data']['name'] . '"></i>';
                }
                $config['data']['avatar'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['avatar_thump'] . '"  class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $config['data']['avatar'] . "'" . ')" style="object-fit:cover;"/>';
                $config['data']['price'] = $this->numberFormat($config['data']['price']);
                $config['data']['point_to_purchase'] = $this->numberFormat($config['data']['point_to_purchase']);
                $config['data']['original_price'] = $this->numberFormat($config['data']['original_price']);
                $config['data']['original_revenue'] = $this->numberFormat($config['data']['original_revenue']);
                $config['data']['name_avatar'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $config['data']['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' . $config['data']['unit_type'] . '</label>
                         </label>';
                $config['data']['profit_rate_by_original_price'] = $this->numberFormat($config['data']['profit_rate_by_original_price']) . '%';
                $config['data']['profit_rate_by_price'] = $this->numberFormat($config['data']['profit_rate_by_price']) . '%';

                // Giá thời vụ
                if ($config['data']['is_temporary_percent'] === (int)ENUM_SELECTED) {
                    $config['data']['temporary_price'] = $this->numberFormat($config['data']['temporary_percent']) . '%';
                } else {
                    $config['data']['temporary_price'] = $this->numberFormat($config['data']['temporary_price']);
                }
                $config['data']['type_food'] = TEXT_NORMAL_FOOD;
                $config['data']['id_type_food'] = ENUM_TYPE_FOOD;

                if ($config['data']['is_combo'] === (int)ENUM_SELECTED) {
                    $config['data']['type_food'] = TEXT_COMBO_FOOD;
                    $config['data']['id_type_food'] = ENUM_TYPE_FOOD_COMBO;
                }

                if ($config['data']['is_addition'] === (int)ENUM_SELECTED) {
                    $config['data']['type_food'] = TEXT_ADDITION;
                    $config['data']['id_type_food'] = ENUM_TYPE_FOOD_ADDITION;
                    $type = ENUM_TYPE_FOOD_ADDITION;
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center d-flex">
                                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" title="' . TEXT_UPDATE . '" onclick="openModalUpdateFoodManage($(this))"  data-id="' . $config['data']['id'] . '" data-type-food="' . $config['data']['id_type_food'] . '" data-type="' . $config['data']['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-brand><i class="fi-rr-pencil"></i></button>
                                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $config['data']['id'] . '" data-type="' . $type . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                </div>';
                    $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                }


                if ($config['data']['is_combo'] === ENUM_SELECTED) {
                    $config['data']['type_food'] = TEXT_COMBO_FOOD;
                    $config['data']['id_type_food'] = ENUM_TYPE_FOOD_COMBO;
                    $type = ENUM_TYPE_FOOD_COMBO;
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center d-flex">
                                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" title="' . TEXT_UPDATE . '" onclick="openModalUpdateFoodManage($(this))"  data-id="' . $config['data']['id'] . '" data-type-food="' . $config['data']['id_type_food'] . '" data-type="' . $config['data']['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-brand><i class="fi-rr-pencil"></i></button>
                                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $config['data']['id'] . '" data-type="' . $config['data']['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                </div>';
                    $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);

                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm text-center d-flex">
                                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" title="' . TEXT_UPDATE . '" onclick="openModalUpdateFoodManage($(this))"  data-id="' . $config['data']['id'] . '" data-type-food="' . $config['data']['id_type_food'] . '" data-type="' . $config['data']['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-brand><i class="fi-rr-pencil"></i></button>
                                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $config['data']['id'] . '" data-type="' . $config['data']['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                  </div>';
                }
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
        if ($config['status'] === 200) {
            /* Gán sở thích món ăn*/
            try {
                if (count($request->get('note_food')) != 0 || $request->get('note_food') != null) {
                    $id = $config['data']['id'];
                    $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
                    $method = ENUM_METHOD_POST;
                    $api = sprintf(API_FOOD_ASSIGN_NOTE_BRAND_MANAGE);
                    $body = [
                        "restaurant_brand_id" => $request->get('brand'),
                        "food_id" => $config['data']['id'],
                        "insert_food_note_json_ids" => $request->get('note_food'),
                        "delete_food_note_json_ids" => []
                    ];
                    $config['config_note_food'] = $this->callApiGatewayTemplate($project, $method, $api, $body);
                }
            } catch (Exception $e) {
                return $this->catchTemplate($config, $e);
            }

            /* Định lượng món ăn */
            try {
                if ($request->get('is_quantitative') == ENUM_SELECTED && $config['status'] == 200) {
                    $id = $config['data']['id'];
                    $materials = $request->get('material');
                    $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
                    $method = Config::get('constants.GATEWAY.METHOD.POST');
                    $api = sprintf(API_MATERIALS_OF_FOOD_POST_ASSIGN, $id);
                    $body = [
                        'restaurant_brand_id' => $request->get('brand'),
                        'materials' => $materials,
                    ];
                    $config['config_quantity'] = $this->callApiGatewayTemplate($project, $method, $api, $body);
                }
            } catch (Exception $e) {
                return $this->catchTemplate($config, $e);
            }
        }

        return $config;
    }

    public function unitFoodMap(Request $request)
    {
        $restaurantMaterialID = $request->get('restaurant_material_id');
        $projectID = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_INVENTORY_GET_MATERIAL_UNIT_ORDER_FOOD, $restaurantMaterialID);
        $body = null;
        $config = $this->callApiGatewayTemplate($projectID, $method, $api, $body);
        try {
            $data = $config['data'];
            $option = '<option disabled selected value="">' . TEXT_DEFAULT_OPTION . '</option>';
            if (count($data) === 0) {
                $option = '<option disabled selected value="">' . TEXT_NULL_OPTION . '</option>';
            }
            foreach ($data as $item) {
                $option .= '<option data-exchange-value="' . $item['exchange_value'] . '" value="' . $item['id'] . '">' . $item['name'] . '</option>';
            }
            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function foodNote(Request $request)
    {
        $restaurantBrandID = $request->get('brand');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_NOTE_BRAND_MANAGE, $restaurantBrandID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $collection = collect($config['data']);
        $data = $collection->where('is_hidden', 0)->all();
        $option = '';
        foreach ($data as $item) {
            $option .= '<option   value="' . $item['id'] . '">' . $item['note'] . '</option>';
        }
        return [$option, $config['config']];
    }

    /**
     * @param Request $request
     * @return array|false|string
     * Danh sách món ăn trên thương hiệu chưa được assgin chi nhánh
     */
    public function getFoodUnExistCategory(Request $request)
    {
        $limit = ENUM_DEFAULT_LIMIT_50;
        $branchID = $request->get('branch_id');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $categoryID = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_UN_EXIST, $restaurantBrandID, $branchID, $categoryID, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $dataFood = $collection
                ->where('status', (int)ENUM_SELECTED)
                ->where('category_type_id', (int)Config::get('constants.type.category.FOOD'))
                ->all();
            $dataDrink = $collection
                ->where('status', (int)ENUM_SELECTED)
                ->where('category_type_id', (int)Config::get('constants.type.category.DRINK'))
                ->all();
            $dataOther = $collection
                ->where('status', (int)ENUM_SELECTED)
                ->where('category_type_id', (int)Config::get('constants.type.category.OTHER'))
                ->all();
            $dataSeaFood = $collection
                ->where('status', (int)ENUM_SELECTED)
                ->where('category_type_id', (int)Config::get('constants.type.category.SEA_FOOD'))
                ->all();

            $dataTableFood = $this->drawTableFoodAssign($dataFood)->original['data'];
            $dataTableDrink = $this->drawTableFoodAssign($dataDrink)->original['data'];
            $dataTableSeaFood = $this->drawTableFoodAssign($dataSeaFood)->original['data'];
            $dataTableOther = $this->drawTableFoodAssign($dataOther)->original['data'];

            $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
            $method = ENUM_METHOD_GET;
            $api = sprintf(API_FOOD_GET_COUNT_UN_EXIST, $restaurantBrandID, $branchID);
            $body = null;
            $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
            $data_total = array(
                'total_record_food' => $this->numberFormat($config['data']['total_record_food']),
                'total_record_drink' => $this->numberFormat($config['data']['total_record_drink']),
                'total_record_seafood' => $this->numberFormat($config['data']['total_record_seafood']),
                'total_record_other' => $this->numberFormat($config['data']['total_record_other'])
            );
            $data_table['total_record_food'] = $this->numberFormat($config['data']['total_record_food']);
            $data_table['total_record_drink'] = $this->numberFormat($config['data']['total_record_drink']);
            $data_table['total_record_seafood'] = $this->numberFormat($config['data']['total_record_seafood']);
            $data_table['total_record_other'] = $this->numberFormat($config['data']['total_record_other']);

            return [$dataTableFood, $dataTableDrink, $dataTableOther, $dataTableSeaFood, $data_total, $config];

        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * Gán món xuống cho chi nhánh
     */
    public function AssignFood(Request $request)
    {
        $branchID = $request->get('branch_id');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $restaurant_kitchen_place_id = $request->get('restaurant_kitchen_place_id');
        $foodIds = $request->get('foodIds');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_FOOD_POST_ASSIGN);
        $body = [
            "restaurant_brand_id" => $restaurantBrandID,
            "restaurant_kitchen_place_id" => $restaurant_kitchen_place_id,
            "branch_id" => $branchID,
            "food_ids" => $foodIds,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    /**
     * @param Request $request
     * @return array
     * Lấy thông tin món ăn
     */
    public function dataFoodDetail(Request $request)
    {
        $id = $request->get('id');
        $branch = $request->get('branch_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_DETAIL_MANAGE_BY_ID, $id, $branch);
        $body = null;
        $requestFoodDetail = [
            'project' => $project,
            'method' => $method,
            'api' => $api,
            'body' => $body,
        ];

        // danh sách giá theo khu vực
        $area = ENUM_ID_GET_ALL;
        $api = sprintf(API_PRICE_BY_AREA_GET_LIST_FOOD, $id, $branch, $area);
        $body = null;
        $requestFoodArea = [
            'project' => $project,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestFoodArea, $requestFoodDetail]);
        try {

            $foodArea = DataTables::of($configAll[0]['data'])
                ->addColumn('name', function ($row) {
                    return $row['area_name'];
                })
                ->addColumn('left-none', function ($row) {
                    return "<div></div>";
                })
                ->addColumn('right-none', function ($row) {
                    return "<div></div>";
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['price','left-none','right-none'])
                ->addIndexColumn()
                ->make(true);

            $data = $configAll[1]['data'];
            $data['status_text'] = '<span class="label label-lg label-danger">' . TEXT_DISABLE_STATUS . '</span>';
            $data['type_food'] = TEXT_NORMAL_FOOD;
            $data['id_type_food'] = ENUM_TYPE_FOOD;
            if ($data['status'] === (int)ENUM_SELECTED) {
                $data['status_text'] = '<span class="label label-lg label-success">' . TEXT_STATUS_ENABLE . '</span>';
            }
            if ($data['is_combo'] === (int)ENUM_SELECTED) {
                $data['type_food'] = TEXT_COMBO_FOOD;
                $data['id_type_food'] = ENUM_TYPE_FOOD_COMBO;
            }
            if ($data['is_addition'] === (int)ENUM_SELECTED) {
                $data['type_food'] = TEXT_ADDITION;
                $data['id_type_food'] = ENUM_TYPE_FOOD_ADDITION;
            }
            if ($data['category_type_id'] === (int)Config::get('constants.type.category.DRINK') ||
                $data['category_type_id'] === (int)Config::get('constants.type.category.OTHER')) {
                $data['category_type_name'] = TEXT_NO_PROCESSING;
            } else {
                $data['category_type_name'] = TEXT_PROCESSING;
            }
            ($data['is_special_claim_point'] === (int)ENUM_SELECTED) ? $data['is_special_claim_point'] = TEXT_FOR_BILL : $data['is_special_claim_point'] = TEXT_FOR_ORDER;
            ($data['is_sell_by_weight'] === (int)ENUM_SELECTED) ? $data['is_sell_by_weight_name'] = TEXT_SELL_BY_WEIGHT : $data['is_sell_by_weight_name'] = TEXT_NOT_SELL_BY_WEIGHT;
            ($data['is_allow_review'] === (int)ENUM_SELECTED) ? $data['is_allow_review'] = TEXT_ALLOW : $data['is_allow_review'] = TEXT_NOT_ALLOW;
            ($data['is_allow_print'] === (int)ENUM_SELECTED) ? $data['is_allow_print'] = TEXT_SEND : $data['is_allow_print'] = TEXT_NOT_SEND;
            ($data['is_allow_purchase_by_point'] === (int)ENUM_SELECTED) ? $data['is_allow_purchase_by_point'] = TEXT_ALLOW_USE_POINT : $data['is_allow_purchase_by_point'] = TEXT_NOT_ALLOW_USE_POINT;
            switch ($data['sale_online_status']) {
                case Config::get('constants.response_text.type.takeAwayFoodTypeEnum.UseInPlace'):
                    $data['sale_online_status'] = TEXT_USE_IN_PLACE;
                    break;
                case Config::get('constants.type.takeAwayFoodTypeEnum.Buy_Take_Away'):
                    $data['sale_online_status'] = TEXT_BUY_TAKE_AWAY;
                    break;
                case Config::get('constants.type.takeAwayFoodTypeEnum.Both'):
                    $data['sale_online_status'] = TEXT_BOTH;
                    break;
            }
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $data['avatar'] = $domain . $data['avatar'];
            $data['vat'] = $configAll[1]['data']['restaurant_vat_config_name'] . ' (' . $configAll[1]['data']['restaurant_vat_config_percent'] . '%)';
            $data['original_revenue'] = $this->numberFormat($data['original_revenue']);
            $data['profit_rate_by_original_price'] = $data['profit_rate_by_original_price'] . '%';
            $data['profit_rate_by_price'] = $data['profit_rate_by_price'] . '%';

            // Table món bán kèm
            $dataTableAddition = DataTables::of($data['addition_foods'])
                ->addColumn('action', function ($row) {
                    $row['type_food'] = TEXT_NORMAL_FOOD;
                    $row['id_type_food'] = ENUM_TYPE_FOOD;

                    if ($row['is_combo'] === (int)ENUM_SELECTED) {
                        $row['type_food'] = TEXT_COMBO_FOOD;
                        $row['id_type_food'] = ENUM_TYPE_FOOD_COMBO;
                    }

                    if ($row['is_addition'] === (int)ENUM_SELECTED) {
                        $row['type_food'] = TEXT_ADDITION;
                        $row['id_type_food'] = ENUM_TYPE_FOOD_ADDITION;
                    }
                    $detail = TEXT_DETAIL;
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))"  data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" data-type="' . $row['id_type_food'] . '" data-id="' . $row['id'] . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('price', function ($row) {
                    return '<label class="font-weight-bold">' . $this->numberFormat($row['price']) . '</label><br>
                            <label class="number-order">Vốn: ' . $this->numberFormat($row['original_price']) . '</label>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'price'])
                ->make(true);
            // Table món combo
            $dataTableFoodCombo = DataTables::of($data['food_in_combo'])
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('none', function ($row) {
                    return '<div></div>';
                })
                ->addColumn('action', function ($row) {
                    $row['type_food'] = TEXT_NORMAL_FOOD;
                    $row['id_type_food'] = ENUM_TYPE_FOOD;
                    $detail = TEXT_DETAIL;
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))"  data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['action','none'])
                ->make(true);

            // Table món món ăn nguyên liệu định lượng
            $dataTableFoodMaterialFood = DataTables::of($data['material_food'])
                ->addColumn('name', function ($row) {
                    $unit_name = '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                    <i class="fi-rr-hastag"></i>
                                    <label class="m-0">' . $row['unit_full_name'] . '</label>
                                    </div>';
                    return $row['name'] . '<br>' . $unit_name;
                })
                ->addColumn('total_price', function ($row) {
                    $value_unit_selected = 0;
                    foreach ($row['material_unit_quantifications'] as $data) {
                        if ($data['is_selected']) {
                            $value_unit_selected = $data['value'];
                            break;
                        }
                    }
                    $price = round($row['price'] * $value_unit_selected / $row['material_unit_specification_exchange_value']);
                    return $this->numberFormat(($row['quantity'] * ($price)));
                })
                ->addColumn('price', function ($row) {
                    $value_unit_selected = 0;
                    foreach ($row['material_unit_quantifications'] as $data) {
                        if ($data['is_selected']) {
                            $value_unit_selected = $data['value'];
                            break;
                        }
                    }
                    $price = round($row['price'] * $value_unit_selected / $row['material_unit_specification_exchange_value']);
                    return $this->numberFormat($price);
                })
                ->addColumn('price_quantitative', function ($row) {
                    $value_unit_selected = 0;
                    foreach ($row['material_unit_quantifications'] as $data) {
                        if ($data['is_selected']) {
                            $value_unit_selected = $data['value'];
                            break;
                        }
                    }
                    return $this->numberFormat(round((($row['price'] / $row['material_unit_specification_exchange_value']) * $value_unit_selected) / (1 - ($row['wastage_rate'] / 100)) * $row['quantity']));
                })
                ->addColumn('unit_order', function ($row) {
                    $unit_order_name = '';
                    foreach ($row['material_unit_quantifications'] as $data) {
                        if ($data['is_selected']) {
                            $unit_order_name = $data['name'];
                            break;
                        }
                    }
                    return $unit_order_name;
                })
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('wastage_rate', function ($row) {
                    return $row['wastage_rate'] . '%';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailMaterialData(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'price', 'name', 'keysearch', 'unit_order', 'total_price'])
                ->make(true);

            // Tổng số nguyên liệu định lượng , Tổng cộng số món bán kèm
            $total = [
                'total_quantity' => count($data['material_food']),
                'total_addition' => count($data['addition_foods']),
                'total_combo' => count($data['food_in_combo']),
                'total_price_by_area' => count($foodArea->original['data']),
            ];
            return [$data, $dataTableAddition, $dataTableFoodCombo, $dataTableFoodMaterialFood, $total, $configAll, $foodArea];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $avatar = $request->get('avatar');
        $avatarThumb = $request->get('avatar_thumb');
        $code = $request->get('code');
        $categoryID = $request->get('category_id');
        $combo = $request->get('is_combo');
        $listBranchKitchenUpdate = $request->get('list_branch_kitchen_update');
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $originalPrice = $request->get('original_price');
        $saleOnlineStatus = $request->get('sale_online_status');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_FOOD_POST_UPDATE_MANAGE;
        $body = [
            "id" => $id,
            "restaurant_brand_id" => $request->get('restaurant_brand_id'),
            "category_id" => $categoryID,
            "category_type_id" => $request->get('category_type_id'),
            "list_branch_kitchen" => $listBranchKitchenUpdate,
            "avatar" => $avatar,
            "avatar_thump" => $avatarThumb,
            "description" => $request->get('description'),
            "name" => $request->get('name'),
            "status" => $request->get('status'),
            "price" => $request->get('price'),
            "point_to_purchase" => $request->get('point_to_purchase'),
            "is_bbq" => $request->get('is_bbq'),
            "unit" => $request->get('unit'),
            "code" => $code,
            "is_take_away" => $request->get('is_take_away'),
            "is_addition" => $request->get('is_addition'),
            "is_combo" => $combo,
            "list_combo" => $request->get('food_in_combo'),
            "time_to_completed" => $request->get('time_to_completed'),
            "is_allow_print" => $request->get('is_allow_print'),
            "is_allow_print_fishbowl" => $request->get('is_allow_print_fishbowl'),
            "is_special_claim_point" => $request->get('is_special_claim_point'),
            "is_sell_by_weight" => $request->get('is_sell_by_weight'),
            "is_allow_review" => $request->get('is_allow_review'),
            "is_allow_purchase_by_point" => $request->get('is_allow_purchase_by_point'),
            "food_addition_ids" => $request->get('food_addition_ids'),
            "is_special_gift" => $request->get('is_special_gift'),
            "note_food" => $request->get('note_food'),
            'restaurant_vat_config_id' => $request->get('restaurant_vat_config_id'),
            "original_price" => $originalPrice,
            "sale_online_status" => $saleOnlineStatus,
            "is_addition_like_food" => $request->get('is_addition_like_food'),
            "temporary_price_from_date" => $request->get('temporary_price_from_date'),
            "temporary_price_to_date" => $request->get('temporary_price_to_date'),
            "is_allow_print_stamp" => $request->get('is_allow_print_stamp'),
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        if ($config['data'] != null && $config['status'] === 200) {
            $config['data']['avatar'] = $domain . $config['data']['avatar'];
            $config['data']['original_revenue'] = $this->numberFormat($config['data']['original_revenue']) . ' (' . $this->numberFormat($config['data']['original_revenue_percent']) . '%)';
            $config['data']['price'] = $this->numberFormat($config['data']['price']);
            $config['data']['original_price'] = $this->numberFormat($config['data']['original_price']);
            if (Session::get(SESSION_KEY_LEVEL) > (int)Config::get('constants.is_check.level.THREE')) {
                if ($config['data']['material_count'] > 0) {
                    $config['data']['material_count'] = '<div class="btn-group btn-group-sm pointer"><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_QUANTITATIVE . '" onclick="openModalCreateQuantityFoodManage($(this))" data-name="' . $config['data']['name'] . '" data-quantity="' . $config['data']['unit_type'] . '" data-id="' . $config['data']['id'] . '"></i></div>';
                } else {
                    $config['data']['material_count'] = '<div class="btn-group btn-group-sm pointer"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NOT_QUANTITATIVE . '" onclick="openModalCreateQuantityFoodManage($(this))"  data-name="' . $config['data']['name'] . '" data-quantity="' . $config['data']['unit_type'] . '" data-id="' . $config['data']['id'] . '"></i></div>';
                }
            } else {
                $config['data']['material_count'] = '<div class="btn-group btn-group-sm pointer"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NOT_QUANTITATIVE . '" onclick="showNotifyLevel($(this))"  data-name="' . $config['data']['name'] . '" data-id="' . $config['data']['id'] . '"></i></div>';
            }
            if ($config['data']['restaurant_vat_config_id'] === 0) {
                $config['data']['vat'] = $config['data']['restaurant_vat_config_name'] . ' (' . $config['data']['restaurant_vat_config_percent'] . '%)';
            } else {
                $config['data']['vat'] = '<a href="javascript:void(0)" class="text text-primary" onclick="removeVatFoodBrandManage($(this))" data-id="' . $config['data']['id'] . '">' . $config['data']['restaurant_vat_config_name'] . ' (' . $config['data']['restaurant_vat_config_percent'] . '%)' . '</a>';
            }
        }
        /* Gán sở thích món ăn*/
        try {
            if ($config['status'] === 200) {
                $id = $config['data']['id'];
                $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
                $method = ENUM_METHOD_POST;
                $api = sprintf(API_FOOD_ASSIGN_NOTE_BRAND_MANAGE);
                $body = [
                    "restaurant_brand_id" => $request->get('restaurant_brand_id'),
                    "food_id" => $id,
                    "insert_food_note_json_ids" => $request->get('note_food'),
                    "delete_food_note_json_ids" => $request->get('delete_Foods')
                ];
                $config['config_note_food'] = $this->callApiGatewayTemplate($project, $method, $api, $body);
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
        return $config;

    }

    /**
     * @param Request $request
     * @return mixed
     * Dữ liệu cập nhật
     */
    public function dataFoodUpdate(Request $request)
    {
        $arrConfig = [];
        $dataAddition = '';
        $dataTableListCombo = [];
        $optionKitchen = [];
        $dataFood = '';
        $branchID = $request->get('branch_id');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $id = $request->get('id');
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $type = $request->get('type_load');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_DETAIL_MANAGE_BY_ID, $id, $branchID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data['avatar_link'] = $domain . $data['avatar'];
            $data['avatar_thumb_link'] = $domain . $data['avatar_thump'];
            $data['type_food'] = TEXT_NORMAL_FOOD;
            $data['id_type_food'] = ENUM_TYPE_FOOD;
            $data['is_sell_by_weight'] === (int)ENUM_SELECTED ? $data['is_sell_by_weight_name'] = TEXT_SELL_BY_WEIGHT : $data['is_sell_by_weight_name'] = TEXT_NOT_SELL_BY_WEIGHT;
            $data['price'] = $this->numberFormat($data['price']);
            $data['point_to_purchase'] = $this->numberFormat($data['point_to_purchase']);
            $data['list_addtion'] = collect($data['addition_foods'])->pluck('id');
            $data['foods_id'] = collect($data['food_notes'])->pluck('food_note_id');
            $list_id_addition_food = [];
            for ($i = 0; $i < count($data['addition_foods']); $i++) {
                $list_id_addition_food[$i] = [
                    'id' => $data['addition_foods'][$i]['id'],
                    'name' => $data['addition_foods'][$i]['name']
                ];
            };
            $food_detail = $data;
            switch ($type) {
                case 4:
                    if ($data['is_combo'] === (int)ENUM_SELECTED) {
                        $data['type_food'] = TEXT_COMBO_FOOD;
                        $data['id_type_food'] = ENUM_TYPE_FOOD_COMBO;
                    }
                    // Danh sách món combo
                    $dataTableListCombo = DataTables::of($data['food_in_combo'])
                        ->addColumn('name', function ($row) {
                            return '<label>' . $row['name'] . '</label><input value="' . $row['id'] . '" class="d-none"/>';
                        })
                        ->addColumn('total_price', function ($row) {
                            return $this->numberFormat($row['original_price'] * $row['quantity']);
                        })
                        ->addColumn('quantity', function ($row) {
                            $is_by_weight = $row['is_sell_by_weight'] === 1 ? 'data-float="1"' : 'data-number="1"';
                            return '<div class="input-group border-group validate-table-validate">
                                         <input data-value="' . $row['quantity'] . '" ' . $is_by_weight . ' value="' . $row['quantity'] . '" data-float="1" data-max="50" data-min="1" class="form-control text-center d-flex quantity-food-combo-update border-0 w-100"/>
                                         </div>';
                        })
                        ->addColumn('original_price', function ($row) {
                            return '<label>' . $this->numberFormat($row['original_price']) . '</label>';
                        })
                        ->addColumn('action', function ($row) {
                            return '<div class="btn-group-sm">
                                        <button class="tabledit-delete-button btn seemt-btn-hover-red waves-effect waves-light" onclick="removeFoodDetailComboUpdateFoodManage($(this))">
                                            <i class="fi-rr-trash"></i>
                                        </button>
                                    </div>';
                        })
                        ->addColumn('keysearch', function ($row) {
                            return $this->keySearchDatatableTemplate($row);
                        })
                        ->addIndexColumn()
                        ->rawColumns(['action', 'quantity', 'name', 'original_price'])
                        ->make(true);

                    // Danh sách món ăn combo
                    $status = ENUM_STATUS_GET_ACTIVE;
                    $category = ENUM_ID_GET_ALL;
                    $categoryID = ENUM_ID_GET_ALL;
                    $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
                    $is_count_material = ENUM_GET_ALL;
                    $is_addition = ENUM_GET_ALL;
                    $page = Config::get('constants.type.default.PAGE_DEFAULT');
                    $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
                    $is_bestseller = ENUM_GET_ALL;
                    $is_combo = ENUM_GET_ALL;
                    $is_kitchen = ENUM_GET_ALL;
                    $is_special_gift = ENUM_STATUS_GET_ALL;
                    $is_get_food_contain_addition = ENUM_GET_ALL;
                    $key = '';
                    $alert_original_food_id = ENUM_GET_ALL;
                    $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
                    $method = ENUM_METHOD_GET;
                    $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category, $categoryID, $restaurantBrandID, $branchID, $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key, $is_get_food_contain_addition, $alert_original_food_id);
                    $body = null;
                    $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
                    $collection = collect($config['data']['list']);
                    $food = $collection
                        ->where('is_combo', (int)ENUM_DIS_SELECTED)
                        ->where('is_addition', (int)ENUM_DIS_SELECTED)
                        ->where('is_special_gift', (int)ENUM_DIS_SELECTED)
                        ->where('food_addition_ids', [])
                        ->all();
                    $arrayDiffFood = [];
                    foreach ($food as $db) {
                        $dataIdFood = collect($data['food_in_combo'])->pluck('id')->toArray();
                        if (!in_array($db['id'], $dataIdFood)) {
                            array_push($arrayDiffFood, $db);
                        }
                    }
                    if (count($arrayDiffFood) === 0) {
                        $dataFood = '<option disabled selected value="">' . TEXT_NULL_OPTION . '</option>';
                    } else {
                        $dataFood = '<option disabled selected value="">' . TEXT_FOOD_IN_COMBO_DEFAULT_OPTION . '</option>';
                        foreach ($arrayDiffFood as $db) {
                            $dataFood .= '<option value="' . $db['id'] . '" data-weight="' . $db['is_sell_by_weight'] . '" data-original-price="' . $this->numberFormat($db['original_price']) . '">' . $db['name'] . '</option>';
                        }
                    }
                    break;
                default:
                    if ($data['is_addition'] === (int)ENUM_SELECTED) {
                        $data['type_food'] = TEXT_ADDITION;
                        $data['id_type_food'] = ENUM_TYPE_FOOD_ADDITION;
                    }
            }
            return [$food_detail, $dataAddition, $optionKitchen, $dataTableListCombo, $dataFood, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

//     Danh sách option món bán kèm
    public function foodOptionAdditon(Request $request)
    {
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $branchID = ENUM_ID_GET_ALL;
        $status = ENUM_STATUS_GET_ACTIVE;
        $category = ENUM_ID_GET_ALL;
        $categoryID = ENUM_ID_GET_ALL;
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_count_material = ENUM_GET_ALL;
        $is_addition = ENUM_SELECTED;
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $is_bestseller = ENUM_GET_ALL;
        $is_combo = ENUM_DIS_SELECTED;
        $is_kitchen = ENUM_GET_ALL;
        $is_special_gift = ENUM_STATUS_GET_ALL;
        $is_get_food_contain_addition = ENUM_GET_ALL;
        $key = '';
        $alert_original_food_id = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category, $categoryID, $restaurantBrandID, $branchID, $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key, $is_get_food_contain_addition, $alert_original_food_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $data_option = '';
        foreach ($config['data']['list'] as $data) {
            $data_option .= '<option value="' . $data['id'] . '">' . $data['name'] . '</option>';
        }
        return [$data_option, $config['config']];
    }

    // Danh sách combo
    public function dataCombo(Request $request)
    {
        $id = $request->get('id');
        $restaurantBrandID = $request->get('brand');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_COMBO_DETAIL_MANAGE, $id, $restaurantBrandID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $collection = collect($data);
            $data_selected = $collection->where('is_selected', (int)ENUM_SELECTED)->where('is_addition', (int)ENUM_DIS_SELECTED)->all();
            $data_table_selected = DataTables::of($data_selected)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['original_price']);
                })
                ->addColumn('avatar', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/></label><input value="' . $row['id'] . '" class="d-none"/>';
                })
                ->addColumn('quantity', function ($row) {
                    return '<input data-value="1" value="1" data-type="currency-edit" class="text-center d-flex">';
                })
                ->addColumn('action', function ($row) {
                    return '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer" data-action="0" onclick="unSelectCombolData($(this))" data-id="' . $row['id'] . '"></i>';
                })
                ->rawColumns(['avatar', 'quantity', 'action'])
                ->addIndexColumn()
                ->make(true);

            $data = $collection->where('is_addition', (int)ENUM_DIS_SELECTED)->all();
            $data_table_all = DataTables::of($data)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['original_price']);
                })
                ->addColumn('avatar', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/></label>';
                })
                ->addColumn('quantity', function ($row) {
                    return 'kkkkkkkkk';
                })
                ->addColumn('action', function ($row) {
                    return '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" data-action="0" onclick="checkSelectCombolData($(this))" data-id="' . $row['id'] . '" ></i>';
                })
                ->rawColumns(['avatar', 'quantity', 'action'])
                ->addIndexColumn()
                ->make(true);
            return [$data_table_all, $data_table_selected, $config];
        } catch (Exception $e) {
            $status = Config::get('constants.type.status.STATUS_ERROR');
            return [$status, $config];
        }

    }

    // Thêm món cho combo
    public function combo(Request $request)
    {
        $id = $request->get('id');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $foods = $request->get('foods');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_FOOD_POST_UPDATE_COMBO_MANAGE;
        $body = [
            'restaurant_brand_id' => $restaurantBrandID,
            'food_id' => $id,
            'list' => $foods,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function updateImages(Request $request)
    {
        $restaurantBrandID = $request->get('brand');
        $list_image = $request->get('image');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_FOOD_UPLOAD_BY_CODE);
        $body = [
            "restaurant_brand_id" => $restaurantBrandID,
            "list" => $list_image
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function changeStatus(Request $request)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $id = $request->get('id');
        $is_confirm = $request->get('is_confirm');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_FOOD_POST_CHANGE_STATUS_MANAGE, $id);
        $type = ENUM_TYPE_FOOD;
        $body = [
            "restaurant_brand_id" => $restaurantBrandID,
            'is_confirm' => $is_confirm,
        ];
        $data = '';
        $list_food = '';
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] == '300') {
                $data = $config['data'];
                $food_in_dish_combo_list = DataTables::of($data['food_in_dish_combo_list'])
                    ->addColumn('action', function ($row) {
                        $type = ENUM_TYPE_FOOD;
                        if ($row['is_combo'] === (int)ENUM_SELECTED) {
                            $row['type_food'] = TEXT_COMBO_FOOD;
                            $type = ENUM_TYPE_FOOD_COMBO;
                        }
                        if ($row['is_addtion'] === (int)ENUM_SELECTED) {
                            $row['type_food'] = TEXT_ADDITION;
                            $type = ENUM_TYPE_FOOD_ADDITION;
                        }
                        return ' <div class="btn-group btn-group-sm text-center d-flex">
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $type . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                             </div>';
                    })
                    ->rawColumns(['avatar', 'quantity', 'action'])
                    ->addIndexColumn()
                    ->make(true);
                $food_in_booking_list = DataTables::of($data['food_in_booking_list'])
                    ->addColumn('action', function ($row) {
                        return ' <div class="btn-group btn-group-sm text-center d-flex">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $row['id'] . '" onclick="openModalUpdateBookingTableManage($(this))" data-customer="' . $row['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailBookingTableManage($(this))" data-id="' . $row['id'] . '" data-customer="' . $row['customer_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                    })
                    ->rawColumns(['avatar', 'action'])
                    ->addIndexColumn()
                    ->make(true);

                $food_in_addition_list = DataTables::of($data['food_in_addition_list'])
                    ->addColumn('action', function ($row) {
                        $type = ENUM_TYPE_FOOD;
                        if ($row['is_combo'] === (int)ENUM_SELECTED) {
                            $row['type_food'] = TEXT_COMBO_FOOD;
                            $type = ENUM_TYPE_FOOD_COMBO;
                        }
                        if ($row['is_addtion'] === (int)ENUM_SELECTED) {
                            $row['type_food'] = TEXT_ADDITION;
                            $type = ENUM_TYPE_FOOD_ADDITION;
                        }
                        return ' <div class="btn-group btn-group-sm text-center d-flex">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $type . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                    })
                    ->rawColumns(['avatar', 'quantity', 'action'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data']['booking'] = $food_in_booking_list;
                $config['data']['addition'] = $food_in_addition_list;
                $config['data']['combo'] = $food_in_dish_combo_list;
                $config['data']['total_booking'] = count($data['food_in_booking_list']);
                $config['data']['total_addition'] = count($data['food_in_addition_list']);
                $config['data']['total_combo'] = count($data['food_in_dish_combo_list']);
            } else {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                if ($config['status'] === 200) {
                    $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                    $config['data']['profit_rate_by_original_price'] = $this->numberFormat($config['data']['profit_rate_by_original_price']) . '%';
                    $config['data']['profit_rate_by_price'] = $this->numberFormat($config['data']['profit_rate_by_price']) . '%';
                    $config['data']['food_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $config['data']['name'] .
                        '<br><label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' . $config['data']['unit_type'] . '
                         </label>';
//                    Giá ban
                    $config['data']['price'] = '<label class="font-weight-bold">' . $this->numberFormat($config['data']['price']) . '</label></br>
                                        <label class="number-order"> Vốn: ' . $this->numberFormat($config['data']['original_price']) . '</label>';
//                    % gia von
                    if ($config['data']['percentage_alert_original_food'] == ENUM_WARNING_ORIGINAL_PRICE_DANGER) {
                        $icon = '<i class="fa fa-exclamation-triangle text-danger" data-toggle="tooltip" data-placement="top" data-original-title="Nguy hiểm"></i>';
                    } else if ($config['data']['percentage_alert_original_food'] == ENUM_WARNING_ORIGINAL_PRICE_WARNING) {
                        $icon = '<i class="fa fa-exclamation-triangle text-warning" data-toggle="tooltip" data-placement="top" data-original-title="Cảnh báo"></i>';
                    } else if ($config['data']['percentage_alert_original_food'] == ENUM_WARNING_ORIGINAL_PRICE_SAFE) {
                        $icon = '<i class="fa fa-exclamation-triangle text-success" data-toggle="tooltip" data-placement="top" data-original-title="An toàn"></i>';
                    } else {
                        $icon = '';
                    }
                    if (Session::get(SESSION_KEY_LEVEL) > (int)Config::get('constants.is_check.level.FIVE')) {
                        $config['data']['original_percent'] = $this->numberFormat($config['data']['original_percent']) . '% ' . $icon;
                    } else {
                        $config['data']['original_percent'] = $this->numberFormat($config['data']['original_percent']) . '% ';
                    }
                    if ($config['data']['restaurant_vat_config_id'] === 0) {
                        $config['data']['vat'] = $config['data']['restaurant_vat_config_name'];
                    } else {
                        $config['data']['vat'] = '<label>' . $config['data']['restaurant_vat_config_percent'] . '%</label>';;
                    }
                    $config['data']['id_type_food'] = ENUM_TYPE_FOOD;
                    if ($config['data']['is_combo'] === (int)ENUM_SELECTED) {
                        $config['data']['type_food'] = TEXT_COMBO_FOOD;
                        $config['data']['id_type_food'] = ENUM_TYPE_FOOD_COMBO;
                    }
                    if ($config['data']['is_addition'] === (int)ENUM_SELECTED) {
                        $config['data']['type_food'] = TEXT_ADDITION;
                        $config['data']['id_type_food'] = ENUM_TYPE_FOOD_ADDITION;
                    }
                    if (Session::get(SESSION_KEY_LEVEL) === (int)Config::get('constants.is_check.level.THREE')) {
                        if ($config['data']['material_count'] > 0) {
                            $config['data']['material_count'] = '<div class="btn-group btn-group-sm pointer"><i class="text-success fa fa-dot-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_QUANTITATIVE . '" onclick="openModalCreateQuantityFoodManage($(this))" data-quantity="' . $config['data']['unit_type'] . '" data-id="' . $config['data']['id'] . '"></i></div>';
                        } else {
                            $config['data']['material_count'] = '<div class="btn-group btn-group-sm pointer"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NOT_QUANTITATIVE . '" onclick="openModalCreateQuantityFoodManage($(this))" data-quantity="' . $config['data']['unit_type'] . '"  data-id="' . $config['data']['id'] . '"></i></div>';
                        }
                    } else {
                        $config['data']['material_count'] = '<div class="btn-group btn-group-sm pointer"><i class="text-warning fa fa-circle-o" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NOT_QUANTITATIVE . '" onclick="showNotifyLevel($(this))"   data-id="' . $config['data']['id'] . '"></i></div>';
                    }
                    if ($config['data']['status'] === (int)ENUM_DIS_SELECTED) {
                        $config['data']['original_revenue'] = $this->numberFormat($config['data']['original_revenue']) . ' (' . $this->numberFormat($config['data']['original_revenue_percent']) . '%)';
                        $config['data']['original_price'] = $this->numberFormat($config['data']['original_price']);
                        $config['data']['action'] = '<div class="btn-group btn-group-sm text-center d-flex">
                                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light btn_enable_all_branch" title="' . TEXT_ENABLE . '" onclick="changeStatusFoodBrandManage($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-restaurant="' . $config['data']['restaurant_brand']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Hoạt động"><i class="fi-rr-check"></i></button>
                                                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $config['data']['id'] . '" data-type="' . $config['data']['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                     </div>';
                    } else {
                        if ($config['data']['is_special_gift']) {
                            $config['data']['action'] = '<div class="btn-group btn-group-sm text-center d-flex">
                                                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" title="' . TEXT_DISABLE_STATUS . '" onclick="changeStatusFoodBrandManage($(this))" data-restaurant="' . $config['data']['restaurant_brand']['id'] . '" data-status="' . $config['data']['status'] . '" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Tạm ngưng"><i class="fi-rr-cross"></i></button>
                                                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $config['data']['id'] . '" data-type="' . $config['data']['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                         </div>';
                        } else {
                            $config['data']['original_revenue'] = $this->numberFormat($config['data']['original_revenue']);
                            $config['data']['original_price'] = $this->numberFormat($config['data']['original_price']);
                            if (Session::get(SESSION_KEY_LEVEL) > (int)Config::get('constants.is_check.level.THREE')) {
                                $config['data']['action'] =
                                    '<div class="btn-group btn-group-sm text-center d-flex">
                                         <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" title="' . TEXT_DISABLE_STATUS . '" onclick="changeStatusFoodBrandManage($(this))" data-restaurant="' . $config['data']['restaurant_brand']['id'] . '" data-status="' . $config['data']['status'] . '" data-id="' . $config['data']['id'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                         <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="openModalCreateQuantityFoodManage($(this))" data-quantity="' . $config['data']['unit_type'] . '" data-price="' . $config['data']['price'] . '" data-name="' . $config['data']['name'] . '" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_QUANTITATIVE_BUTTON . '"><span class="icofont icofont-law-alt-1"></span></button></br>
                                         <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" title="' . TEXT_UPDATE . '" onclick="openModalUpdateFoodManage($(this))" data-from="' . $config['data']['temporary_price_from_date'] . '" data-to="' . $config['data']['temporary_price_to_date'] . '" data-id="' . $config['data']['id'] . '"  data-type="' . $config['data']['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-brand><i class="fi-rr-pencil"></i></button>
                                         <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-category-type="' . $config['data']['category_type_id'] . '" data-id="' . $config['data']['id'] . '" data-type="' . $config['data']['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                    </div>';
                            } else {
                                $config['data']['action'] =
                                    '<div class="btn-group btn-group-sm text-center d-flex">
                                         <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" title="' . TEXT_DISABLE_STATUS . '" onclick="changeStatusFoodBrandManage($(this))" data-restaurant="' . $config['data']['restaurant_brand']['id'] . '" data-status="' . $config['data']['status'] . '" data-id="' . $config['data']['id'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                         <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" title="' . TEXT_UPDATE . '" onclick="openModalUpdateFoodManage($(this))" data-from="' . $config['data']['temporary_price_from_date'] . '" data-to="' . $config['data']['temporary_price_to_date'] . '" data-id="' . $config['data']['id'] . '"  data-type="' . $config['data']['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-brand><i class="fi-rr-pencil"></i></button>
                                         <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-category-type="' . $config['data']['category_type_id'] . '" data-id="' . $config['data']['id'] . '" data-type="' . $config['data']['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                     </div>';
                            }
                        }
                    }
                }
            }
            return [$list_food, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    function downloadTemplate(Request $request)
    {
        $restaurantBrandID = Session::get(SESSION_KEY_BRAND_ID);
        $status = ENUM_STATUS_GET_ACTIVE;
        $body = null;

        //kitchen
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $apiKitchen = sprintf(API_KITCHEN_DATA_GET_DATA, $restaurantBrandID, '-1', $status);
        $configKitchen = $this->callApiGatewayTemplate($project, $method, $apiKitchen, $body);
        $dataKitchen = $configKitchen['data'];

        // Category
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_CATEGORY_MANAGE, 1, $status);
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);

        // Đơn vị
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = API_FOOD_GET_UNIT_MANAGE;
        $config_unit = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $data_unit = $config_unit['data'];
        return Excel::download(new CoursesTemplateExport($config['data'], $dataKitchen, $data_unit), 'Template.xlsx');
    }

    public function material(Request $request)
    {
        $food_id = $request->get('food_id');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_MATERIAL_OF_FOOD_GET_DATA, $food_id, $restaurantBrandID);
        $body = null;
        $requestFoodDetail = [
            'project' => $project,
            'method' => $method,
            'api' => $api,
            'body' => $body,
        ];

        // danh sách giá theo khu vực
        $area = ENUM_ID_GET_ALL;
        $api = sprintf(API_PRICE_BY_AREA_GET_LIST_FOOD, $food_id, $restaurantBrandID, $area);
        $body = null;
        $requestFoodArea = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestFoodArea, $requestFoodDetail]);


//        try {
        $data = array_merge($config['data']['selected_material'], $config['data']['un_select_material']);
        $unit_data = '<option value="" disabled hidden selected>' . TEXT_DEFAULT_OPTION . '</option>';
        for ($i = 0; $i < count($data); $i++) {
            $unit_data .= '<option value="' . $data[$i]['id'] . '" data-exchange-value="' . $data[$i]['exchange_value'] . '"  data-unit-id="' . $data[$i]['material_unit_id'] . '" data-unit-name="' . $data[$i]['material_unit_name'] . '" data-material="' . $data[$i]['restaurant_material_id'] . '">' . $data[$i]['material_unit_name'] . '</option>';
        }
        $selected_material = $config['data']['selected_material'];
        $un_select_material = $config['data']['un_select_material'];
        $table_select_material = DataTables::of($selected_material)
            ->addColumn('name', function ($row) {
                return '<lable>' . $row['name'] . '<input class="d-none" value="' . $row['id'] . '" /></lable>';
            })
            ->addColumn('unit-name', function ($row) {
                return $row['unit']['value_name'];
            })
            ->addColumn('price', function ($row) {
                return '<label data-price="' . $row['price'] . '" data-value="' . $row['unit']['value'] . '">
                                <div style="font-size: 14px">' . $this->numberFormat($row['price'] / $row['unit']['value']) . '</div>
                                <div style="font-size: 10px">' . $this->numberFormat($row['price']) . '/' . $row['unit']['name'] . '</div>
                            </label>';
            })
            ->addColumn('quantity', function ($row) {
                return '<div class="input-group border-group validate-table-validate">
                                <input class="form-control text-center border-0 w-100 quantity quantitative-food-update" value="' . $this->numberFormat($row['quantity']) . '" data-max="999999" data-min="1">
                                </div>';
            })
            ->addColumn('total', function ($row) {
                return $this->numberFormat($row['quantity'] * ($row['price'] / $row['unit']['value']));
            })
            ->addColumn('wastage_rate', function ($row) {
                return $this->numberFormat($row['wastage_rate']) . '%';
            })
            ->addColumn('total_wastage_rate', function ($row) {
                return $this->numberFormat(((1 / $row['unit']['value']) * $row['price']) / (1 - $row['wastage_rate'] / 100) * $row['quantity']);
            })
            ->addColumn('action', function ($row) {
                return '<div class="btn-group btn-group-sm ">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalDetailQuantitativeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Công thức"><span class="fa fa-exclamation"></span></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  onclick="removeMaterial($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><span class="icofont icofont-ui-delete"></span></button>
                            </div>';
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'quantity', 'name', 'price'])
            ->make(true);
        if (!empty($un_select_material)) {
            $option = '<option value="" disabled selected>' . TEXT_MATERIAL_DEFAULT_OPTION . '</option>';
            foreach ($un_select_material as $value) {
                $option .= '<option value="' . $value['id'] . '" data-rate="' . $value['wastage_rate'] . '"  data-total-rate="' . $this->numberFormat(((1 / $value['unit']['value']) * $value['price']) / (1 - $value['wastage_rate'] / 100) * 1) . '"   data-quantity="' . $value['quantity'] . '" data-unit-price="' . $this->numberFormat($value['price']) . '/' . $value['unit']['name'] . '" data-value="' . $value['unit']['value'] . '" data-large-unit-price="' . $this->numberFormat($value['price']) . '" data-price="' . $this->numberFormat(ENUM_SELECTED * round((1 / $value['unit']['value']) * $value['price'], 0)) . '" data-unit="1" data-unit_name="' . $value['unit']['value_name'] . '">' . $value['name'] . '</option>';
            }
        } else {
            $option = '<option value="" disabled selected>' . TEXT_MATERIAL_DEFAULT_OPTION . '</option>';
        }
        return [$table_select_material, $option, $config];
//        } catch (Exception $e) {
//            $status = Config::get('constants.type.status.STATUS_ERROR');
//            return [$status, $config, $e];
//        }
    }

    public function materialQuantitative(Request $request)
    {
        $status = ENUM_STATUS_GET_ACTIVE;
        $category = ENUM_STATUS_GET_ALL;
        $type_parent_id = ENUM_ID_NONE;
        $type_id = ENUM_ID_NONE;
        $brand = $request->get('brand');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $is_just_take_assigned = ENUM_STATUS_GET_ALL;
        $api = sprintf(API_FOOD_GET_MATERIAL_BRAND_BRAND_MANAGE, $brand, $is_just_take_assigned);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $config['data'] = collect($config['data'])->where('is_selected', ENUM_SELECTED);
        try {
            $option = '';
            if (count($config['data']) === 0) {
                $option = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            } else {
                $option = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
                foreach ($config['data'] as $db) {
                    $option .= '<option data-material-unit-specification-exchange-value="' . $db['restaurant_material_unit_specification_exchange_value'] . '" value="' . $db['restaurant_material_id'] . '" data-unit="' . $db['restaurant_material_unit_specification_exchange_name'] . '" data-price="' . $db['restaurant_material_price'] . '">' . $db['restaurant_material_name'] . '</option>';
                }
            }

            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function createMaterial(Request $request)
    {
        $id = $request->get('id');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $materials = $request->get('material');
        $method = 'POST';
        $api = sprintf(API_MATERIALS_OF_FOOD_POST_ASSIGN, $id);
        $body = [
            'restaurant_brand_id' => $restaurantBrandID,
            'materials' => $materials,
        ];
        return $this->callApiGatewayTemplate($request, $method, $api, $body);
    }

    public function dataKitchen(Request $request)
    {
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $branchID = $request->get('branch_id');
        $status = ENUM_STATUS_GET_ACTIVE;
        $isHavePrinter = ENUM_STATUS_GET_ALL;
        $isBarKitchen = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_KITCHEN_DATA_GET_DATA, $restaurantBrandID, $branchID, $status, $isHavePrinter, $isBarKitchen);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $dataKitchen = '<option disabled selected>' . TEXT_NULL_OPTION . '</option>';
            if (count($data) > 0) {
                $dataKitchen = '';
                foreach ($data as $db) {
                    $dataKitchen .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                }
            }
            return [$dataKitchen, $config];
        } catch (Exception $e) {
            $this->catchTemplate($config, $e);
        }
    }

    public function dataUpdateFoodManage(Request $request)
    {

        $brand = $request->get('brand');
        $status = ENUM_SELECTED;
        // Đơn vị
        $api = API_FOOD_GET_UNIT_MANAGE;
        $body = null;
        $requestUnitFoodManage = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        // Danh mục
        $status = ENUM_STATUS_GET_ACTIVE;
        $api = sprintf(API_FOOD_GET_CATEGORY_MANAGE, $brand, $status);
        $body = null;
        $requestCategoryFoodManage = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        // Vat
        $api = sprintf(API_FOOD_GET_VAT_BRAND_MANAGE, $status);
        $body = null;
        $requestVatFoodData = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $restaurantBrandID = $request->get('brand');
        $api = sprintf(API_FOOD_NOTE_BRAND_MANAGE, $restaurantBrandID);
        $body = null;
        $requestFoodNoteFoodData = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestUnitFoodManage, $requestCategoryFoodManage, $requestVatFoodData, $requestFoodNoteFoodData]);
        try {
            $dataCategoryFood = $configAll[0]['data'];
            $dataOptionCategory = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            if (count($dataCategoryFood) === 0) {
                $dataOptionCategory = '<option disabled selected value="" >' . TEXT_NULL_OPTION . '</option>';
            } else {
                foreach ($dataCategoryFood as $db) {
                    $dataOptionCategory .= '<option value="' . $db['name'] . '">' . $db['name'] . '</option>';
                }
            }

            $dataUnit = $configAll[1]['data'];
            $dataOptionUnit = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            if (count($dataUnit) === 0) {
                $dataOptionUnit = '<option disabled selected value="">' . TEXT_NULL_OPTION . '</option>';
            } else {
                foreach ($dataUnit as $db) {
                    $dataOptionUnit .= '<option value="' . $db['id'] . '" data-id-category="' . $db['category_type'] . '">' . $db['name'] . '</option>';
                }
            }

            $dataVat = $configAll[2]['data'];
            $dataOptionVat = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            if (count($dataVat) === 0) {
                $dataOptionVat = '<option disabled selected value="">' . TEXT_NULL_OPTION . '</option>';
            } else {
                foreach ($dataVat as $db) {
                    $dataOptionVat .= '<option value="' . $db['id'] . '">' . $db['vat_config_name'] . '</option>';
                }
            }

            $dataCategoryComboFood = collect($configAll[1]['data'])
                ->whereNotIn('category_type', [2, 3])
                ->all();
            $dataOptionCategoryComboFood = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
            if (count($dataCategoryComboFood) === 0) {
                $dataOptionCategoryComboFood = '<option disabled selected value="">' . TEXT_NULL_OPTION . '</option>';
            } else {
                foreach ($dataCategoryComboFood as $db) {
                    $dataOptionCategoryComboFood .= '<option value="' . $db['id'] . '" data-id-category="' . $db['category_type'] . '">' . $db['name'] . '</option>';
                }
            }

            $collection = collect($configAll[3]['data']);
            $data = $collection->where('is_hidden', 0)->all();
            $dataOptionFoodNote = '';
            if (count($data) === 0) {
                $dataOptionFoodNote = '<option  disabled selected value="">' . TEXT_NULL_OPTION . '</option>';
            } else {
                foreach ($data as $item) {
                    $dataOptionFoodNote .= '<option value="' . $item['id'] . '">' . $item['note'] . '</option>';
                }
            }
            return [$dataOptionCategory, $dataOptionUnit, $dataOptionVat, $dataOptionFoodNote, $configAll, $dataOptionCategoryComboFood];
        } catch (Exception $e) {
            $this->catchTemplate($configAll, $e);
        }
    }


    public function vat(Request $request)
    {
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_VAT_BRAND_MANAGE, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $dataVat = '<option value="0"  disabled selected>' . TEXT_NULL_OPTION . '</option>';
            $dataSetUpVat = '<option value="0" disabled selected>' . TEXT_NULL_OPTION . '</option>';
            if (count($data) > 0) {
                $dataVat = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
                $dataSetUpVat = '<option value="0" disabled selected>' . TEXT_SETUP_VAT_FOOD_DEFAULT . '</option>';
                foreach ($data as $db) {
                    $dataVat .= '<option value="' . $db['id'] . '">' . $db['vat_config_name'] . ' (' . $db['percent'] . '%)</option>';
                    $dataSetUpVat .= '<option value="' . $db['id'] . '">' . $db['vat_config_name'] . ' (' . $db['percent'] . '%)</option>';
                }
            }
            return [$dataVat, $config, $dataSetUpVat];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function setupVat(Request $request)
    {
        $brand_id = $request->get('brand_id');
        $id = $request->get('id');
        $food = $request->get('food');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_FOOD_POST_SETUP_VAT_BRAND_MANAGE;
        $body = [
            'food_ids' => $food,
            'restaurant_vat_config_id' => $id,
            'restaurant_brand_id' => $brand_id,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }


    public function cancelVat(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_FOOD_POST_REMOVE_VAT_BRAND_MANAGE;
        $body = [
            'food_id' => $id
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function dataAlertOriginalPrice(Request $request)
    {
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $category_type = $request->get('category_type');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_WARNING_PRICE_FOOD_GET_FOOD_DATA, $restaurantBrandID, $category_type);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $option = '<option value="-1" selected hidden>Tất cả mức độ</option>';
            foreach ($config['data'] as $db) {
                $option .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
            return [$option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
