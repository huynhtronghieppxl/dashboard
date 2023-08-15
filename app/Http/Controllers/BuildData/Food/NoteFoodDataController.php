<?php

namespace App\Http\Controllers\BuildData\Food;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class NoteFoodDataController extends Controller
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
        $active_nav = 'Sở thích';
        return view('build_data.food.note.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_NOTE_GET_DATA, $brand);
        $body = null;
        $config = $this->callApiGatewayTemplate($project_id, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $dataEnable = $collection->where('is_hidden', Config::get('constants.type.checkbox.DIS_SELECTED'))->toArray();
            $dataDisable = $collection->where('is_hidden', Config::get('constants.type.checkbox.SELECTED'))->toArray();
            $enable = TEXT_ENABLE;
            $disable = TEXT_DISABLE_STATUS;
            $update = TEXT_UPDATE;
            $tableEnable = DataTables::of($dataEnable)
                ->addColumn('count', function ($row) {
                    return $this->numberFormat($row['number_food']);
                })
                ->addColumn('action', function ($row) use ($update, $disable) {
                    return '<div class="btn-group btn-group-sm">
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusNoteFoodData($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><i class="fi-rr-cross"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $row['id'] . '" data-name="' . $row['note'] . '" data-brand="' . $row['restaurant_brand_id'] . '" onclick="openModalUpdateNoteFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            $tableDisable = DataTables::of($dataDisable)
                ->addColumn('count', function ($row) {
                    return $this->numberFormat($row['number_food']);
                })
                ->addColumn('action', function ($row) use ($update, $enable) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $row['id'] . '" data-name="' . $row['note'] . '" data-brand="' . $row['restaurant_brand_id'] . '" onclick="openModalUpdateNoteFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusNoteFoodData($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '"><i class="fi-rr-check"></i></button>
                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            $data_total = [
                'total_record_enable' => $this->numberFormat(count($dataEnable)),
                'total_record_disable' => $this->numberFormat(count($dataDisable)),
            ];

            return [$tableEnable, $tableDisable, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_NOTE_GET_DETAIL, $id, $brand);
        $body = null;
        $config = $this->callApiGatewayTemplate($project_id, $method, $api, $body);
        try {
            $detail = TEXT_DETAIL;
            $table = DataTables::of($config['data']['food'])
                ->addColumn('action', function ($row) use ($detail) {
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
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . $detail . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['food_id'] . '" data-type="'. $row['id_type_food'] .'"  data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><span class="fi-rr-eye"></span></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            return [$table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataFood(Request $request)
    {
        $brand = $request->get('brand');
        $status = Config::get('constants.type.status.GET_ALL');
        $category = Config::get('constants.type.id.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.checkbox.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.GET_ALL');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $key = '';
        $branch_id = Config::get('constants.type.id.GET_ALL');
        $category_id = $request->get('category_id');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_count_material = Config::get('constants.type.checkbox.SELECTED');
        $is_bestseller = Config::get('constants.type.checkbox.GET_ALL');
        $is_kitchen = Config::get('constants.type.checkbox.GET_ALL');
        $is_get_food_contain_addition = Config::get('constants.type.checkbox.GET_ALL');
        $alert_original_food_id = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category, $category_id, $brand, $branch_id, $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key, $is_get_food_contain_addition, $alert_original_food_id);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $data_table = DataTables::of($data)
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>' . $row['name'] . '</label>';
                })
                ->addColumn('action', function ($row) use ($domain) {
                    return '<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-category="' . $row['category_name'] . '" data-avatar="' . $domain . $row['avatar'] . '" onclick="selectNoteFoodData($(this))"
                                >
                            <i class="fi-rr-arrow-small-right"></i>
                        </button>
                    </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['name'], $row['category_name']]);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'avatar'])
                ->make(true);

            return [$data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function category(Request $request)
    {
        $restaurant_brand_id = $request->get('brand');
        $status = Config::get('constants.type.status.GET_ACTIVE');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_CATEGORY_MANAGE, $restaurant_brand_id, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try{
        $data = $config['data'];
        $select_category = '';
        if (count($data) === 0) {
            $select_category = '<option value="-1" selected>' . TEXT_NULL_OPTION . '</option>';
        } else {
            $select_category .= '<option value="-1" selected>Tất cả danh mục</option>';
            foreach ($data as $db) {
                $select_category .= '<option data-category-type="'. $db['category_type'] .'"  value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
        }
        return [$select_category, $config];
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataFoodUpdate(Request $request)
    {
        $brand = $request->get('brand');
        $status = Config::get('constants.type.status.GET_ALL');
        $category = Config::get('constants.type.status.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.checkbox.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.GET_ALL');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $key = '';
        $branch_id = Config::get('constants.type.id.GET_ALL');
        $category_id = $request->get('category_id');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_count_material = Config::get('constants.type.checkbox.GET_ALL');
        $is_bestseller = Config::get('constants.type.checkbox.GET_ALL');
        $is_kitchen = Config::get('constants.type.checkbox.GET_ALL');
        $alert_original_food_id = ENUM_GET_ALL;
        $is_get_food_contain_addition = Config::get('constants.type.checkbox.GET_ALL');
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category, $category_id, $brand, $branch_id, $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key, $is_get_food_contain_addition, $alert_original_food_id);
        $body = null;
        $requestFoodDisSelected = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body
        ];
        $id = $request->get('id');
        $brand = $request->get('brand');
        $api = sprintf(API_FOOD_NOTE_GET_DETAIL, $id, $brand);
        $requestFoodSelected = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$requestFoodDisSelected, $requestFoodSelected]);
        try {
            $data = $this->compareTwoArrayTemplate($configAll[0]['data']['list'],$configAll[1]['data']['food'], 'id' ,'food_id');
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $data_table = DataTables::of($data)
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" style="object-fit: cover" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')"/>' . $row['name'] . '</label>';
                })
                ->addColumn('action', function ($row) use ($domain) {
                    return '<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-category="' . $row['category_name'] . '" data-type="0" data-avatar="' . $domain . $row['avatar'] . '" onclick="selectUpdateNoteFoodData($(this))"
                                >
                            <i class="fi-rr-arrow-small-right"></i>
                        </button>
                    </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['name'], $row['category_name']]);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'avatar'])
                ->make(true);
            $data_table_like = DataTables::of($configAll[1]['data']['food'])
                ->addColumn('avatar', function ($row) use ($domain) {
                    return '<label><img onerror="imageDefaultOnLoadError($(this))" src="" class="img-inline-name-data-table"  data-type="0" onclick="modalImageComponent()"/>' . $row['food_name'] . '</label>';
                })
                ->addColumn('action', function ($row) use ($domain) {
                    return '<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id="' . $row['food_id'] . '" data-name="' . $row['food_name'] . '" data-category="' . $row['category_name'] . '" data-type="1" data-avatar="" onclick="disSelectUpdateNoteFoodData($(this))"
                                >
                            <i class="fi-rr-arrow-small-left"></i>
                        </button>
                    </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['food_name'], $row['category_name']]);
                })
                ->addIndexColumn()
                ->rawColumns(['avatar', 'action'])
                ->make(true);
            return [$data_table, $data_table_like ,$configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_NOTE_GET_DETAIL, $id, $brand);
        $body = null;
        $config = $this->callApiGatewayTemplate($project_id, $method, $api, $body);
        try {
            $data = $config['data']['food'];
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);

        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $brand = $request->get('brand');
        $note = $request->get('note');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_FOOD_NOTE_POST_CREATE);
        $body = [
            "restaurant_brand_id" => $brand,
            "note" => $note,
        ];
        $config1 = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $id = $config1['status'] === 200 ? $config1['data']['id'] : '';
            $config2 = $config1;
        } catch (Exception $e) {
            return $this->catchTemplate($config1, $e);
        }


        $foodInsert = $request->get('food_insert');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api =  sprintf(API_ASSIGN_FOOD_POST_NOTE);;
        $body = [
            "restaurant_brand_id" => $brand,
            "food_note_id" => $id,
            "insert_food_json_ids" => $foodInsert,
            "delete_food_json_ids" => [],
        ];
        $config2 = $this->callApiGatewayTemplate($project, $method, $api, $body);
        return [$config1, $config2];
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $note = $request->get('note');
        $insert_food_note_json_ids = $request->get('food_insert');
        $delete_food_note_json_ids = $request->get('food_delete');
        $food_id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_FOOD_NOTE_POST_UPDATE, $id);
        $body = [
            "restaurant_brand_id" => $brand,
            "note" => $note,
        ];
        $config1 = $this->callApiGatewayTemplate($project, $method, $api, $body);
        $foodInsert = $request->get('food_insert');
        $foodDelete = $request->get('food_delete');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_ASSIGN_FOOD_POST_NOTE;
        $body = [
            "restaurant_brand_id" => $brand,
            "food_note_id" => $id,
            "insert_food_json_ids" => $foodInsert,
            "delete_food_json_ids" => $foodDelete,
        ];
        $config2 = $this->callApiGatewayTemplate($project, $method, $api, $body);
        return [$config1,$config2];
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api =sprintf(API_FOOD_NOTE_POST_CHANGE_STATUS, $id);
        $body = null;
        $config =  $this->callApiGatewayTemplate($project, $method, $api, $body);
        try{
        $enable = TEXT_ENABLE;
        $disable = TEXT_DISABLE_STATUS;
        $update = TEXT_UPDATE;
        if ($config['data'] != null) {
            if($config['data']['is_hidden'] ===  Config::get('constants.type.checkbox.DIS_SELECTED')){
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusNoteFoodData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><i class="fi-rr-cross"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['note'] . '" data-brand="' . $config['data']['restaurant_brand_id'] . '" onclick="openModalUpdateNoteFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>


                        </div>';
            }else{
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-name="' . $config['data']['note'] . '" data-brand="' . $config['data']['restaurant_brand_id'] . '" onclick="openModalUpdateNoteFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusNoteFoodData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '"><i class="fi-rr-check"></i></button>
                        </div>';
            }
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
        }
        return $config;
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
