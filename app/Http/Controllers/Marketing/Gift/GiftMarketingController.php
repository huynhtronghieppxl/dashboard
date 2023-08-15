<?php

namespace App\Http\Controllers\Marketing\Gift;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class GiftMarketingController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'MARKETING_MANAGER', 'RESTAURANT_GIFT_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Quà tặng';
        return view('marketing.gift.gift.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $isActive = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $page = ENUM_DEFAULT_PAGE;
        $api = sprintf(API_GIFT_MARKETING_GET, $brand, $isActive, $limit, $page);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $collect = collect($data);
            $dataEnable = $collect->where('is_active', ENUM_SELECTED)->all();
            $dataDisable = $collect->where('is_active', ENUM_DIS_SELECTED)->all();
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $tableEnable = DataTables::of($dataEnable)
                ->addColumn('logo', function ($row) use ($domain) {
                    $img_src = $row['banner_url'] === '/images/tms/default.jpeg' ? $row['banner_url'] : $domain . $row['banner_url'];
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $img_src . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $img_src . "'" . ')"/>' . $row['name'];
                })
                ->addColumn('day', function ($row) {
                    return $this->numberFormat($row['expire_after_days']);
                })
                ->addColumn('type', function ($row) {
                    if ($row['gift_type'] === 0) {
                          return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">' . TEXT_FOODS . '</label>
                                  </div>';
                    } else {
                          return '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">Điểm</label>
                                  </div>';
                    }
                })
                ->addColumn('value', function ($row) {
                    if ($row['gift_type'] === 0) {
                        return implode(", ", collect($row['foods'])->pluck('name')->flatten()->toArray());
                    } else {
                        return $this->numberFormat($row['gift_object_value']);
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('action', function ($row)  {
                    return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id="' . $row['id'] . '" onclick="changeStatusGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id=" ' . $row['id'] . '" onclick="openModalUpdateGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $row['id'] . '" onclick="openModalDetailGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['action', 'logo', 'type'])
                ->addIndexColumn()
                ->make(true);
            $tableDisable = DataTables::of($dataDisable)
                ->addColumn('logo', function ($row) use ($domain) {
                    $img_src = $row['banner_url'] === '/images/tms/default.jpeg' ? $row['banner_url'] : $domain . $row['banner_url'];
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $img_src . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $img_src . "'" . ')"/>' . $row['name'];
                })
                ->addColumn('day', function ($row) {
                    return $this->numberFormat($row['expire_after_days']);
                })
                ->addColumn('type', function ($row) {
                    if ($row['gift_type'] === 0) {
                        return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">' . TEXT_FOODS . '</label>
                                </div>';
                    } else {
                        return '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                    <label class="m-0">Điểm</label>
                                </div>';
                    }
                })
                ->addColumn('value', function ($row) {
                    if ($row['gift_type'] === 0) {
                        return implode(", ", collect($row['foods'])->pluck('name')->flatten()->toArray());
                    } else {
                        return $this->numberFormat($row['gift_object_quantity']);
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('action', function ($row)  {
                    return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $row['id'] . '" onclick="changeStatusGiftMarketing($(this))"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $row['id'] . '" onclick="openModalDetailGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['action', 'logo','type'])
                ->addIndexColumn()
                ->make(true);

            $total = [
                'total_record_enable' => $this->numberFormat(count($dataEnable)),
                'total_record_disable' => $this->numberFormat(count($dataDisable))
            ];
            return [$tableEnable, $tableDisable, $total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $brand = $request->get('brand');
        $name = $request->get('name');
        $logo = $request->get('logo');
        $banner = $request->get('banner');
        $description = $request->get('description');
        $value = $request->get('value');
        $type = $request->get('type');
        $day = $request->get('day');
        $content = $request->get('content');
        $term = $request->get('term');
        $guide = $request->get('guide');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = API_GIFT_MARKETING_POST_CREATE;
        $body = [
            "restaurant_brand_id" => $brand,
            "name" => $name,
            "description" => $description,
            "gift_object_value" => $value,
            "gift_object_quantity" => ($type == ENUM_SELECTED) ? $value : ENUM_SELECTED,
            "gift_type" => $type,
            "expire_after_days" => $day,
            "image_url" => $logo,
            "banner_url" => $banner,
            "content" => $content,
            "term" => $term,
            "use_guide" => $guide,
            "branch_ids" => $request->get('branch_ids'),
            "day_of_weeks" => $request->get('day_of_weeks'),
            "from_hour" => $request->get('from_hour'),
            "to_hour" => $request->get('to_hour'),
            "foods" => $request->get('foods'),
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if($config['status'] == ENUM_HTTP_STATUS_CODE_SUCCESS){
                $config['data']['day'] = $this->numberFormat($config['data']['expire_after_days']);
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                $img_src = $config['data']['banner_url'] === '/images/tms/default.jpeg' ? $config['data']['banner_url'] : $domain . $config['data']['banner_url'];
                $config['data']['logo'] = '<img onerror="imageDefaultOnLoadError($(this))" class="img-inline-name-data-table" src="' . $img_src . '" onclick="modalImageComponent(' . "'" . $img_src . "'" . ')">' . $config['data']['name'];
                if ($config['data']['gift_type'] === 0) {
                    $config['data']['type'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">' . TEXT_FOODS . '</label>
                                               </div>';
                    $config['data']['value'] = implode(", ", collect($config['data']['foods'])->pluck('name')->flatten()->toArray());
                } else {
                    $config['data']['type'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                    <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                    <label class="m-0">Điểm</label>
                                               </div>';
                    $config['data']['value'] = $this->numberFormat($config['data']['gift_object_value']);
                }
                $config['data']['action'] =
                    '<div class="btn-group btn-group-sm">
                    <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="changeStatusGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                    <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" onclick="openModalUpdateGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                    <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" onclick="openModalDetailGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                </div>';
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                return $config;
            }else{
                return $config;
            }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GIFT_MARKETING_GET_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $config['data']['day'] = $this->numberFormat($config['data']['expire_after_days']) ;
            $config['data']['expire_after_days'] = '<h6 class="text-muted f-w-400 col-form-label-fz-15">'. $this->numberFormat($config['data']['expire_after_days']) .' ngày</h6>' ;
            $config['data']['type'] = $config['data']['gift_type'];
            $config['data']['logo'] = $config['data']['image_url'];
            $config['data']['domain'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $config['data']['branches_id'] = collect($config['data']['branches'])->pluck('id')->flatten()->toArray();
            $dataTableFood = DataTables::of($config['data']['foods'])
                ->addColumn('quantity', function ($row) {
                    return '<label>' . $this->numberFormat($row['quantity']) . '</label>';
                })
                ->addColumn('action', function ($row) {
                    $row['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');
                    if ($row['is_combo'] === ENUM_SELECTED) {
                        $row['type_food'] = TEXT_COMBO_FOOD;
                        $row['id_type_food'] = Config::get('constants.type.TypeFood.COMBO');
                    }
                    if ($row['is_addition'] === ENUM_SELECTED) {
                        $row['type_food'] = TEXT_ADDITION;
                        $row['id_type_food'] = Config::get('constants.type.TypeFood.ADDITION');
                    }
                    return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-category-type="'. $row['category_type'] .'" data-id=" ' . $row['id'] . '" data-type="' . $row['id_type_food'] . '" onclick="openModalDetailFoodBrandManage($(this))" data-toggle="tooltip" data-placement="top"><i class="fi-rr-eye" data-original-title="'. TEXT_DETAIL .'"></i></button>
                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'quantity'])
                ->addIndexColumn()
                ->make(true);
            if($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS){
                $config['data']['image_url'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['image_url'];
                $config['data']['banner_url'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['banner_url'];
                $day_of_weeks = '';
                foreach ($config['data']['day_of_weeks'] as $db){
                    switch ($db){
                        case $db === 1:
                            $day_of_weeks .= '-Thứ hai ';
                            break;
                        case $db === 0:
                            $day_of_weeks .= '-Chủ nhật ';
                            break;
                        case $db === 2:
                            $day_of_weeks .= '-Thứ ba ';
                            break;
                        case $db === 3:
                            $day_of_weeks .= '-Thứ tư ';
                            break;
                        case $db === 4:
                            $day_of_weeks .= '-Thứ năm ';
                            break;
                        case $db === 5:
                            $day_of_weeks .= '-Thứ sáu ';
                            break;
                        case $db === 6:
                            $day_of_weeks .= '-Thứ bảy';
                            break;
                    }
                };
                $config['data']['type'] = $config['data']['type'] == 0 ? 'Món ăn' : 'Điểm';
                $config['data']['day_of_weeks'] = count($config['data']['day_of_weeks']) === 0 ? 'Cả tuần' : $day_of_weeks ;
                $config['data']['time_apply'] = $config['data']['from_hour'].' giờ' .' - '. $config['data']['to_hour'].' giờ';
            }
            return [$dataTableFood , $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GIFT_MARKETING_GET_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $config['data']['day'] = $this->numberFormat($config['data']['expire_after_days']);
        $config['data']['type'] = $config['data']['gift_type'];
        $config['data']['logo'] = $config['data']['image_url'];
        $config['data']['domain'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $config['data']['branches_id'] = collect($config['data']['branches'])->pluck('id')->flatten()->toArray();
        $remove = TEXT_REMOVE;
        $config['data']['food'] = DataTables::of($config['data']['foods'])
            ->addColumn('quantity', function ($row) {
                return '<div class="input-group border-group validate-table-validate focus-validate" >
                            <input class="form-control adjustment text-right rounded border-0 w-100" data-float="1" data-max="999999999" data-type="currency-edit" data-min="1" value="' . $this->numberFormat($row['quantity']) . '"/>
                        </div>';
            })
            ->addColumn('action', function ($row) use ($remove) {
                return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id=" ' . $row['id'] . '" data-name=" ' . $row['name'] . '" onclick="removeFoodUpdateGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $remove . '"><i class="fi-rr-trash"></i></button>
                        </div>';
            })
            ->rawColumns(['action', 'quantity'])
            ->addIndexColumn()
            ->make(true);
        return $config;
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $name = $request->get('name');
        $description = $request->get('description');
        $value = $request->get('value');
        $type = $request->get('type');
        $day = $request->get('day');
        $logo = $request->get('logo');
        $banner = $request->get('banner');
        $content = $request->get('content');
        $term = $request->get('term');
        $guide = $request->get('guide');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_GIFT_MARKETING_POST_UPDATE, $id);
        $body = [
            "restaurant_brand_id" => $brand,
            "name" => $name,
            "description" => $description,
            "gift_object_value" => $value, // Điểm 1  , 0 món ăn
            "gift_object_quantity" => ($type === ENUM_SELECTED) ? $value : ENUM_SELECTED, // Số lượng
            "gift_type" => $type,
            "expire_after_days" => $day,
            "image_url" => $logo,
            "banner_url" => $banner,
            "content" => $content,
            "term" => $term,
            "use_guide" => $guide,
            "branch_ids" => $request->get('branch_ids'),
            "day_of_weeks" => $request->get('day_of_weeks'),
            "from_hour" => $request->get('from_hour'),
            "to_hour" => $request->get('to_hour'),
            "foods" => $request->get('foods'),
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if($config['status'] === 200) {
            $config['data']['day'] = $this->numberFormat($config['data']['expire_after_days']);
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $img_src = $config['data']['banner_url'] === '/images/tms/default.jpeg' ? $config['data']['banner_url'] : $domain . $config['data']['banner_url'];
            $config['data']['name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $img_src . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $img_src . "'" . ')"/>' . $config['data']['name'];
            if ($config['data']['gift_type'] === 0) {
                $config['data']['type'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                <label class="m-0">' . TEXT_FOODS . '</label>
                                          </div>';
                $config['data']['value'] = implode(", ", collect($config['data']['foods'])->pluck('name')->flatten()->toArray());
            } else {
                $config['data']['type'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                <label class="m-0">Điểm</label>
                                          </div>';
                $config['data']['value'] = $this->numberFormat($config['data']['gift_object_value']);
            }
            if ($config['data']['is_active'] === ENUM_SELECTED) {
                $config['data']['action'] = '<td class=" text-center" data-dt-row="0" data-dt-column="0">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="changeStatusGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                                    <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" onclick="openModalUpdateGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                    <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" onclick="openModalDetailGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                </div>
                                            </td>';
            } else {
                $config['data']['action'] = '<td class=" text-center" data-dt-row="0" data-dt-column="0">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="changeStatusGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                                    <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" onclick="openModalUpdateGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                    <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" onclick="openModalDetailGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                                </div>
                                            </td>';
            }
        }
            return $config;
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $confirmed = $request->get('confirmed');
        $api = sprintf(API_GIFT_MARKETING_POST_CHANGE_STATUS, $id);
        $body = [
            'confirmed' =>$confirmed
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === 200){
                $config['data']['day'] = $this->numberFormat($config['data']['expire_after_days']);
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                $img_src = $config['data']['banner_url'] === '/images/tms/default.jpeg' ? $config['data']['banner_url'] : $domain . $config['data']['banner_url'];
                $config['data']['logo'] = '<img onerror="imageDefaultOnLoadError($(this))" class="img-inline-name-data-table" style="border-radius:50%;" src="' . $img_src . '" onclick="modalImageComponent(' . "'" . $img_src . "'" . ')">'. $config['data']['name'];
                if ($config['data']['gift_type'] === 0) {
                    $config['data']['gift_type'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">' . TEXT_FOODS . '</label>
                                                    </div>';
                    $config['data']['value'] = implode(", ", collect($config['data']['foods'])->pluck('name')->flatten()->toArray());
                } else {
                    $config['data']['gift_type'] = '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                        <label class="m-0">Điểm</label>
                                                    </div>';
                    $config['data']['value'] = $this->numberFormat($config['data']['gift_object_value']);
                }
                if ($config['data']['is_active'] === ENUM_SELECTED) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="changeStatusGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                                <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" onclick="openModalUpdateGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" onclick="openModalDetailGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                            </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                 <button class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-id="' . $config['data']['id'] . '" onclick="changeStatusGiftMarketing($(this))"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                                <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-id=" ' . $config['data']['id'] . '" onclick="openModalDetailGiftMarketing($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                            </div>';
                }
            }

            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function food(Request $request)
    {
        $brand = $request->get('brand');
        $status = '';
        $category = ENUM_GET_ALL;
        $is_combo = ENUM_GET_ALL;
        $is_special_gift = ENUM_GET_ALL;
        $is_addition = ENUM_GET_ALL;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $key = ENUM_ID_NONE;
        $branch_id = ENUM_GET_ALL;
        $category_id = ENUM_GET_ALL;
        $is_take_away = ENUM_GET_ALL;
        $is_count_material = ENUM_SELECTED;
        $is_bestseller = ENUM_GET_ALL;
        $is_kitchen = ENUM_GET_ALL;
        $is_get_food_contain_addition = ENUM_GET_ALL;
        $alert_original_food_id = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api =sprintf(API_FOOD_GET_ALL_MANAGE, $status, $is_take_away, $is_addition, $category, $category_id, $brand, $branch_id,
            $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key, $is_get_food_contain_addition, $alert_original_food_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $dataFood = collect($config['data']['list'])->where('is_addition', 0)->toArray();
            $food = '<option hidden disabled selected value="">' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($dataFood as $db) {
                if($db['restaurant_kitchen_place_id'] === 0) {
                    $food .= '<option disabled="disabled" value="' . $db['id'] . '">' . $db['name'] . '</option>';
                }else{
                    $food .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                }
            }
            if (count($config['data']['list']) === 0) {
                $food = '<option selected>' . TEXT_NULL_OPTION . '</option>';
            }
            return [$food, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
