<?php

namespace App\Http\Controllers\BuildData\Food;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class CategoryFoodDataController extends Controller
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
        $active_nav = 'Danh mục';
        return view('build_data.food.category.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $status = Config::get('constants.type.status.GET_ALL');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_CATEGORY_FOOD_GET_DATA, $restaurantBrandID, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $collect = collect($data);
            $dataEnable = $collect->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all();
            $dataDisable = $collect->where('status', (int)Config::get('constants.type.checkbox.DISABLE'))->all();
            $dataTableEnable = $this->tableDataCategory($dataEnable);
            $dataTableDisable = $this->tableDataCategory($dataDisable);

            $dataTotal = [
                'total_record_enable' => count($dataEnable),
                'total_record_disable' => count($dataDisable),
            ];
            return [$dataTableEnable, $dataTableDisable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function tableDataCategory($data)
    {
        return DataTables::of($data)
            ->addColumn('category_type_name', function ($row) {
                switch ($row['category_type']) {
                    case Config::get('constants.type.category.FOOD'):
                        return TEXT_FOOD_FOOD;
                    case Config::get('constants.type.category.DRINK'):
                        return TEXT_FOOD_DRINK;
                    case Config::get('constants.type.category.OTHER'):
                        return TEXT_OTHER;
                    case Config::get('constants.type.category.SEA_FOOD'):
                        return TEXT_SEA_FOOD;
                    default:
                        return $row['category_type_name'];
                }
            })
            ->addColumn('description', function ($row) {
                return (mb_strlen($row['description']) > 30) ? $row['description'] = mb_substr($row['description'], 0, 27) . '...' : $row['description'];
            })
            ->addColumn('action', function ($row) {
                switch ($row['status']) {
                    case Config::get('constants.type.checkbox.SELECTED'):
                        return '<div class="btn-group btn-group-sm">
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id = "' . $row['id'] . '" data-status = "' . $row['status'] . '" onclick="changeStatusCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id = "' . $row['id'] . '" data-name = "' . $row['name'] . '" data-code = "' . $row['code'] . '" data-type = "' . $row['category_type'] . '" data-description = "' . $row['description'] . '" data-status="' . $row['status'] . '" onclick="openModalUpdateCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                    </div>';
                    default:
                        return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-id = "' . $row['id'] . '" data-status = "' . $row['status'] . '" onclick="changeStatusCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id = "' . $row['id'] . '" data-name = "' . $row['name'] . '" data-code = "' . $row['code'] . '" data-type = "' . $row['category_type'] . '" data-description = "' . $row['description'] . '" data-status="' . $row['status'] . '" onclick="openModalUpdateCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                </div>';
                }
            })
            ->addColumn('name', function ($row) {
                return $row['name'];
            })
            ->rawColumns(['action', 'description', 'name'])
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function create(Request $request)
    {
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $name = $request->get('name');
        $code = $request->get('code');
        $descriptions = $request->get('description');
        $type = $request->get('type');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_CATEGORY_FOOD_POST_CREATE;
        $body = [
            "name" => $name,
            "code" => $code,
            "description" => $descriptions,
            "category_type" => $type,
            "status" => $status,
            "restaurant_brand_id" => $restaurantBrandID,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                switch ($config['data']['category_type']) {
                    case Config::get('constants.type.category.FOOD'):
                        $config['data']['category_type_name'] = TEXT_FOOD_FOOD;
                        break;
                    case Config::get('constants.type.category.DRINK'):
                        $config['data']['category_type_name'] = TEXT_FOOD_DRINK;
                        break;
                    case Config::get('constants.type.category.OTHER'):
                        $config['data']['category_type_name'] = TEXT_OTHER;
                        break;
                    case Config::get('constants.type.category.SEA_FOOD'):
                        $config['data']['category_type_name'] = TEXT_SEA_FOOD;
                        break;
                }
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-status="' . $config['data']['status'] . '" data-id = "' . $config['data']['id'] . '" onclick="changeStatusCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id = "' . $config['data']['id'] . '" data-name = "' . $config['data']['name'] . '" data-code = "' . $config['data']['code'] . '" data-type = "' . $config['data']['category_type'] . '" data-description = "' . $config['data']['description'] . '" data-status="' . $config['data']['status'] . '" onclick="openModalUpdateCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                        </div>';
                if (mb_strlen($config['data']['description']) > 30) $config['data']['description'] = mb_substr($config['data']['description'], 0, 27) . '...';

            }
            return $config;
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $brandID = $request->get('restaurant_brand_id');
        $name = $request->get('name');
        $code = $request->get('code');
        $descriptions = $request->get('description');
        $categoryType = $request->get('category_type');
        $status = $request->get('status');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_CATEGORY_FOOD_POST_UPDATE, $id);
        $body = [
            "name" => $name,
            "code" => $code,
            "description" => $descriptions,
            "category_type" => $categoryType,
            "status" => $status,
            "restaurant_brand_id" => $brandID,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                if (mb_strlen($config['data']['description']) > 30) $config['data']['description'] = mb_substr($config['data']['description'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $config['data']['description'] . '"></i>';
                switch ($config['data']['category_type']) {
                    case Config::get('constants.type.category.FOOD'):
                        $config['data']['category_type_name'] = TEXT_FOOD_FOOD;
                        break;
                    case Config::get('constants.type.category.DRINK'):
                        $config['data']['category_type_name'] = TEXT_FOOD_DRINK;
                        break;
                    case Config::get('constants.type.category.OTHER'):
                        $config['data']['category_type_name'] = TEXT_OTHER;
                        break;
                    case Config::get('constants.type.category.SEA_FOOD'):
                        $config['data']['category_type_name'] = TEXT_SEA_FOOD;
                        break;
                }
                if ($config['data']['status'] === Config::get('constants.type.checkbox.SELECTED')) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id = "' . $config['data']['id'] . '" onclick="changeStatusCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id = "' . $config['data']['id'] . '" data-name = "' . $config['data']['name'] . '" data-code = "' . $config['data']['code'] . '" data-type = "' . $config['data']['category_type'] . '" data-description = "' . $config['data']['description'] . '" data-status="' . $config['data']['status'] . '" onclick="openModalUpdateCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                            </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-id = "' . $config['data']['id'] . '" onclick="changeStatusCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id = "' . $config['data']['id'] . '" data-name = "' . $config['data']['name'] . '" data-code = "' . $config['data']['code'] . '" data-type = "' . $config['data']['category_type'] . '" data-description = "' . $config['data']['description'] . '" data-status="' . $config['data']['status'] . '" onclick="openModalUpdateCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                            </div>';
                }
            }
            return $config;
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CATEGORY_FOOD_POST_STATUS, $id);
        $body = [
            "id" => $id,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_CONFIRM_SUPPLIER) {
                $dataTable = DataTables::of($config['data'])
                    ->addColumn('name', function ($row) {
                            return $row['name'];
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
                                    <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                    })->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
                $config['data'] = $dataTable;
                return $config;
            } else if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                switch ($config['data']['category_type']) {
                    case Config::get('constants.type.category.FOOD'):
                        $config['data']['category_type_name'] = TEXT_FOOD_FOOD;
                        break;
                    case Config::get('constants.type.category.DRINK'):
                        $config['data']['category_type_name'] = TEXT_FOOD_DRINK;
                        break;
                    case Config::get('constants.type.category.OTHER'):
                        $config['data']['category_type_name'] = TEXT_OTHER;
                        break;
                    case Config::get('constants.type.category.SEA_FOOD'):
                        $config['data']['category_type_name'] = TEXT_SEA_FOOD;
                        break;
                }
                if ($config['data']['status'] === Config::get('constants.type.checkbox.SELECTED')) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id = "' . $config['data']['id'] . '" data-status = "' . $config['data']['status'] . '" onclick="changeStatusCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id = "' . $config['data']['id'] . '" data-name = "' . $config['data']['name'] . '" data-code = "' . $config['data']['code'] . '" data-type = "' . $config['data']['category_type'] . '" data-description = "' . $config['data']['description'] . '" data-status="' . $config['data']['status'] . '" onclick="openModalUpdateCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                            </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-id = "' . $config['data']['id'] . '" data-status = "' . $config['data']['status'] . '" onclick="changeStatusCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id = "' . $config['data']['id'] . '" data-name = "' . $config['data']['name'] . '" data-code = "' . $config['data']['code'] . '" data-type = "' . $config['data']['category_type'] . '" data-description = "' . $config['data']['description'] . '" data-status="' . $config['data']['status'] . '" onclick="openModalUpdateCategoryFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                            </div>';
                }
                if (mb_strlen($config['data']['description']) > 30) $config['data']['description'] = mb_substr($config['data']['description'], 0, 27) . '...';
                return $config;
            }

            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
