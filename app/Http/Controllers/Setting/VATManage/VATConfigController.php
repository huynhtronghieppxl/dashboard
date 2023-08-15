<?php

namespace App\Http\Controllers\Setting\VATManage;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class VATConfigController extends Controller
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
            $active_nav = 'Cấu hình VAT';
            return view('setting.vat_manage.vat_config.index', compact('active_nav'));
        }

        public function data()
        {
            $status = ENUM_SELECTED;
            $project = ENUM_PROJECT_ID_ORDER;
            $method = ENUM_METHOD_GET;
            $api = sprintf(API_FOOD_GET_VAT_BRAND_MANAGE, $status);
            $body = null;
            $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
            $dataNotUpdate = count($config['data']);
            try {
                $tableNotVatUpdate = Datatables::of($config['data'])
                    ->addColumn('percent', function ($row) {
                        return $row['percent'] . '%';
                    })
                    ->addColumn('admin_percent', function ($row) {
                        return $row['admin_percent'] . '%';
                    })
                    ->addColumn('detail_food', function ($row){
                        return '<div class="btn-group btn-group-sm text-center">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $row['id'] . '" onclick="openModalUpdateVATConfig($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Danh sách món ăn áp dụng" onclick="openModalDetailVatSetting($(this))" data-id="' . $row['id'] . '"><i class="fi-rr-eye"></i></button>
                               </div>';
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate([$row['vat_config_name']]).$this->keySearchDatatableTemplate([$row['percent']. '%']);
                    })
                    ->addIndexColumn()
                    ->rawColumns(['detail_food'])
                    ->make(true);

                $dataTotal = [
                    'total_not_update' => ($dataNotUpdate),
                ];
                return [$tableNotVatUpdate, $dataTotal, $config];
            } catch (Exception $e) {
                $this->catchTemplate($config, $e);
            }
        }

        public function detail(Request $request)
        {
            $branchID = ENUM_GET_ALL;
            $restaurantBrandID = $request->get('restaurant_brand_id');
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
            $isSpecialGift = ENUM_DIS_SELECTED;
            $keySearch = '';
            $restaurantVatConfigID = $request->get('restaurant_vat_config_id');
            $project = ENUM_PROJECT_ID_ORDER;
            $method = ENUM_METHOD_GET;
            $api = sprintf(API_FOOD_GET_ALL_VAT_MANAGE, $status, $isTakeAway, $isAddition, $categoryType, $categoryID, $restaurantBrandID, $branchID, $isCountMaterial, $page, $limit, $isBestseller, $isCombo, $isKitchen, $isSpecialGift, $keySearch, $restaurantVatConfigID);
            $body = null;
            $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
            try {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                $dataTableSelected = DataTables::of($config['data']['list'])
                    ->addColumn('avatar', function ($row) use ($domain) {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table">
                                                                 <label class="name-inline-data-table">' . $row['name'] . '<br>
                                                                      <label class="department-inline-name-data-table">
                                                                        <i class="fa fa-cutlery"></i>' . $row['code'] . '
                    </label>';
                    })
                    ->addColumn('name', function ($row) {
                        if (mb_strlen($row['name']) > 30) {
                            return mb_substr($row['name'], 0, 25) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['name'] . '"></i>';
                        } else {
                            return $row['name'];
                        }
                    })
                    ->addColumn('action', function ($row){
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
                        return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="'. TEXT_DETAIL .'"><i class="fi-rr-eye"></i></button>
                                </div>';
                    })
                    ->addColumn('keysearch', function ($row) {
                        return $this->keySearchDatatableTemplate($row);
                    })
                    ->rawColumns(['avatar', 'name', 'action'])
                    ->addIndexColumn()
                    ->make(true);

                return [$dataTableSelected, $config];
            } catch (Exception $e) {
                $this->catchTemplate($config, $e);
            }
        }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $name = $request->get('name');
        $percent = $request->get('percent');
        $api = sprintf(API_VAT_SETTING_UPDATE, $id);
        $body = [
            "vat_config_id" => $id,
            "vat_config_name" => $name,
            "vat_percent" => $percent
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
            $config['data']['percent'] = $percent . '%';
            $config['data']['vat_config_name'] = $name;
            $config['data']['admin_percent'] = $percent . '%';
            $config['data']['detail_food'] = '<div class="btn-group btn-group-sm text-center">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $id . '" onclick="openModalUpdateVATConfig($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Danh sách món ăn áp dụng" onclick="openModalDetailVatSetting($(this))" data-id="' . $id . '"><i class="fi-rr-eye"></i></button>
                               </div>';
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate([$name]).$this->keySearchDatatableTemplate([$percent. '%']);
        }
        return $config;
    }
}
