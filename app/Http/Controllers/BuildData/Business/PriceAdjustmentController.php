<?php

namespace App\Http\Controllers\BuildData\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class PriceAdjustmentController extends Controller
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
        $active_nav = 'Điều chỉnh giá món';
        return view('build_data.business.price_adjustment.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $statuses = '';
        $page = ENUM_DEFAULT_PAGE;
        $limit = Config::get('constants.type.default.LIMIT_1000');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_PRICE_ADJUSTMENT_GET_LIST, $restaurantBrandID, $statuses, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $collection = collect($data);
            $dataWaiting = $collection->where('status', (int)Config::get('constants.type.FoodPriceAdjustmentStatusEnum.WAITING_APPLY'))->all();
            $dataApply = $collection->where('status', (int)Config::get('constants.type.FoodPriceAdjustmentStatusEnum.APPLIED'))->all();
            $dataCancel = $collection->where('status', (int)Config::get('constants.type.FoodPriceAdjustmentStatusEnum.CANCEL'))->all();
            $dataTableWaiting = $this->drawTablePriceAdjustment($dataWaiting);
            $dataTableApply = $this->drawTablePriceAdjustment($dataApply);
            $dataTableCancel = $this->drawTablePriceAdjustment($dataCancel);
            $dataTotal = [
                'total_record_waiting' => $this->numberFormat($collection->where('status', (int)Config::get('constants.type.FoodPriceAdjustmentStatusEnum.WAITING_APPLY'))->count()),
                'total_record_apply' => $this->numberFormat($collection->where('status', (int)Config::get('constants.type.FoodPriceAdjustmentStatusEnum.APPLIED'))->count()),
                'total_record_cancel' => $this->numberFormat($collection->where('status', (int)Config::get('constants.type.FoodPriceAdjustmentStatusEnum.CANCEL'))->count()),
            ];
            return [$dataTableWaiting, $dataTableApply, $dataTableCancel, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTablePriceAdjustment($data)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        return DataTables::of($data)
            ->addColumn('number_food', function ($row) {
                return $this->numberFormat($row['number_food']);
            })
            ->addColumn('code', function ($uses) {
                return '<span style="font-size: 14px !important;" class="">' . $uses['code'] . '</span>';
            })
            ->addColumn('employee_create_name', function ($row) use ($domain) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['employee_create']['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $row['employee_create']['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_create']['role_name'] . '</label>
                         </label>';
            })
            ->addColumn('action', function ($row) {
                if ($row['status'] === (int)Config::get('constants.type.FoodPriceAdjustmentStatusEnum.WAITING_APPLY')) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" onclick="applyPriceAdjustment($(this))"  data-id="' . $row['id'] . '"  data-brand="' . $row['restaurant_brand']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_APPLY . '"><i class="fi-rr-check"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdatePriceAdjustment($(this))" data-id="' . $row['id'] . '"  data-restaurant="' . $row['restaurant_brand']['id'] . '"   data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailPriceAdjustment($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye" ></i></button>
                            </div>';
                } else {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailPriceAdjustment($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                }
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['action', 'code', 'employee_create_name'])
            ->addIndexColumn()
            ->make(true);
    }

    public function food(Request $request)
    {
        $branchID = ENUM_ID_NONE;
        $restaurantBrandID = (int)$request->get('restaurant_brand_id');
        $status = Config::get('constants.type.status.GET_ACTIVE');
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
        $key = '';
        $isGetFoodContainAddition = ENUM_GET_ALL;
        $alertOriginalFoodID = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $isTakeAway, $isAddition, $categoryType, $categoryID, $restaurantBrandID, $branchID, $isCountMaterial, $page, $limit, $isBestseller, $isCombo, $isKitchen, $isSpecialGift, $key, $isGetFoodContainAddition, $alertOriginalFoodID);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $dataFood = '<option value="">' . TEXT_SELECT_FOOD . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $key = $data[$i]['name'];
                $dataFood .= '<option value="' . $data[$i]['id'] . '" data-keysearch="' . $this->keySearchDatatableTemplate([$key]) . '"  data-name="' . $this->removeSpecialCharacterAttr($data[$i]['name']) . '" data-price="' . $data[$i]['price'] . '">' . $data[$i]['name'] . '</option>';
            }
            if ($dataFood === '<option value="">' . TEXT_DEFAULT_OPTION . '</option>') {
                $dataFood = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$dataFood, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $id = Config::get('constants.type.id.DEFAULT');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $note = sprintf($request->get('note'));
        $details = $request->get('details');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $api = sprintf(API_PRICE_ADJUSTMENT_GET_DETAIL, $id);
        $body = [
            'restaurant_brand_id' => $restaurantBrandID,
            'id' => $id,
            'note' => $note,
            'details' => $details,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
                $config['data']['employee_create_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['employee_create']['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $config['data']['employee_create']['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['employee_create']['role_name'] . '</label>
                         </label>';
                $config['data']['action'] = '
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" onclick="applyPriceAdjustment($(this))"  data-id="' . $config['data']['id'] . '"  data-brand="' . $config['data']['restaurant_brand']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_APPLY . '"><i class="fi-rr-check"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdatePriceAdjustment($(this))" data-id="' . $config['data']['id'] . '"  data-restaurant="' . $config['data']['restaurant_brand']['id'] . '"   data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailPriceAdjustment($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye" ></i></button>
                        </div>
                ';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $api = sprintf(API_PRICE_ADJUSTMENT_GET_DETAIL, $id);
        $body = null;
        $requestDetail = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $branchID = ENUM_ID_NONE;
        $restaurantBrandID = $request->get('restaurant_brand');
        $status = ENUM_SELECTED;
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
        $isSpecialGift = ENUM_GET_ALL;
        $alertOriginalFoodID = ENUM_GET_ALL;
        $key = '';
        $isGetFoodContainAddition = ENUM_GET_ALL;
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $isTakeAway, $isAddition, $categoryType, $categoryID, $restaurantBrandID, $branchID, $isCountMaterial, $page, $limit, $isBestseller, $isCombo, $isKitchen, $isSpecialGift, $key, $isGetFoodContainAddition, $alertOriginalFoodID);
        $body = null;
        $requestFood = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestDetail, $requestFood]);
        try {
            $remove = TEXT_REMOVE;
            $listIds = collect($configAll[0]['data']['details'])->pluck('food.id')->all();
            $dataTable = DataTables::of($configAll[0]['data']['details'])
                ->addColumn('name', function ($row) {
                    return $row['food']['name'];
                })
                ->addColumn('original_price', function ($row) {
                    return $this->numberFormat($row['old_price']);
                })
                ->addColumn('difference', function ($row) {
                    return '<label data-value="' . $row['price_difference'] . '">' . $this->numberFormat($row['price_difference']) . '</label>';
                })
                ->addColumn('price', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input style="font-size: 14px !important;" class="form-control adjustment text-center border-radius-6-px border-0 w-100" data-max="999999999" data-money="1" data-value="' . $row['new_price'] . '" value="' . $this->numberFormat($row['new_price']) . '" >
                            </div>';
                })
                ->addColumn('action', function ($row) use ($remove) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="btn seemt-red seemt-btn-hover-red waves-effect waves-light" data-id="' . $row['food']['id'] . '" data-name="' . $row['food']['name'] . '" data-price="' . $row['old_price'] . '" onclick="deleteRowUpdate($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $remove . '"><i class="fi-rr-trash"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['price', 'action', 'difference'])
                ->addIndexColumn()
                ->make();
            $configAll[0]['data']['employee_create_name'] = $configAll[0]['data']['employee_create']['name'];
            switch ($configAll[0]['data']['status']) {
                case (int)Config::get('constants.type.FoodPriceAdjustmentStatusEnum.WAITING_APPLY'):
                    $configAll[0]['data']['status'] = '<label class="label label-lg label-warning">' . TEXT_WAITING_APPLY . '</label>';
                    break;
                case (int)Config::get('constants.type.FoodPriceAdjustmentStatusEnum.APPLIED'):
                    $configAll[0]['data']['status'] = '<label class="label label-lg label-success">' . TEXT_APPLIED . '</label>';
                    break;
                case (int)Config::get('constants.type.FoodPriceAdjustmentStatusEnum.CANCEL'):
                    $configAll[0]['data']['status'] = '<label class="label label-lg label-danger">' . TEXT_CANCELED_TEXT . '</label>';
                    break;
            }
            if (count($configAll[1]['data']['list']) === 0) {
                $dataSelectFood = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            } else {
                $dataSelectFood = '<option value="" disabled selected>' . TEXT_SELECT_FOOD . '</option>';
                foreach ($configAll[1]['data']['list'] as $db) {
                    if (!in_array($db['id'], $listIds)) {
                        $dataSelectFood .= '<option value="' . $db['id'] . '"     data-name="' . $db['name'] . '" data-price="' . $db['price'] . '"  data-keysearch="' . $this->keySearchDatatableTemplate([$db['name']]) . '">' . $db['name'] . '</option>';
                    }
                }
            }

            return [$configAll[0]['data'], $dataTable, $dataSelectFood, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $note = $request->get('note');
        $details = $request->get('details');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_PRICE_ADJUSTMENT_GET_DETAIL, $id);
        $body = [
            'restaurant_brand_id' => $restaurantBrandID,
            'id' => $id,
            'note' => $note,
            'details' => $details,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
                $config['data']['employee_create_name'] = $config['data']['employee_create']['name'];
                $config['data']['action'] = '
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" onclick="applyPriceAdjustment($(this))" data-id="' . $config['data']['id'] . '"  data-brand="' . $config['data']['restaurant_brand']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_APPLY . '"><i class="fi-rr-check"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdatePriceAdjustment(' . $config['data']['id'] . ', ' . $config['data']['restaurant_brand']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailPriceAdjustment(' . $config['data']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye" ></i></button>
                        </div>
                ';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_PRICE_ADJUSTMENT_GET_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            switch ($data['status']) {
                case (int)Config::get('constants.type.FoodPriceAdjustmentStatusEnum.WAITING_APPLY'):
                    $data['status_name'] = '<label class="label label-lg label-warning">' . TEXT_WAITING_APPLY . '</label>';
                    break;
                case (int)Config::get('constants.type.FoodPriceAdjustmentStatusEnum.APPLIED'):
                    $data['status_name'] = '<label class="label label-lg label-success">' . TEXT_APPLIED . '</label>';
                    break;
                case (int)Config::get('constants.type.FoodPriceAdjustmentStatusEnum.CANCEL'):
                    $data['status_name'] = '<label class="label label-lg label-danger">' . TEXT_CANCELED . '</label>';
                    break;
            }
            $data_table = DataTables::of($data['details'])
                ->addColumn('old_price', function ($row) {
                    return $this->numberFormat($row['old_price']);
                })
                ->addColumn('new_price', function ($row) {
                    return $this->numberFormat($row['new_price']);
                })
                ->addColumn('price_difference', function ($row) {
                    return $this->numberFormat($row['price_difference']);
                })
                ->addColumn('action', function ($row) {
                    $row['food']['type_food'] = TEXT_NORMAL_FOOD;
                    $row['food']['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');

                    if ($row['food']['is_combo'] === ENUM_SELECTED) {
                        $row['food']['type_food'] = TEXT_COMBO_FOOD;
                        $row['food']['id_type_food'] = Config::get('constants.type.TypeFood.COMBO');
                    }

                    if ($row['food']['is_addition'] === ENUM_SELECTED) {
                        $row['food']['type_food'] = TEXT_ADDITION;
                        $row['food']['id_type_food'] = Config::get('constants.type.TypeFood.ADDITION');
                    }
                    $detail = TEXT_DETAIL;
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['food']['id'] . '" data-type="' . $row['food']['id_type_food'] . '"  title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            return [$data, $data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function cancel(Request $request)
    {
        $restaurantBranchID = $request->get('restaurant_branch');
        $cancel_reason = $request->get('cancel_reason');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_PRICE_ADJUSTMENT_CANCEL_PRICE, $id);
        $body = [
            'restaurant_brand_id' => $restaurantBranchID,
            'cancel_reason' => $cancel_reason,
        ];
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);

        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
                $config['data']['employee_create_name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['employee_create']['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $config['data']['employee_create']['name'] . '<br>
                              <label class="department-inline-name-data-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['employee_create']['role_name'] . '</label>
                         </label>';
                $config['data']['action'] = '
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailPriceAdjustment($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye" ></i></button>
                        </div>
                ';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
        return $config;
    }

    public function apply(Request $request)
    {
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_PRICE_ADJUSTMENT_APPLY, $id);
        $body = [
            'restaurant_brand_id' => $restaurantBrandID,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $detail = TEXT_DETAIL;
        try {
            if ($config['data'] != null) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailPriceAdjustment(' . $config['data']['id'] . ')" title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                        </div>';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
        return $config;
    }
}
