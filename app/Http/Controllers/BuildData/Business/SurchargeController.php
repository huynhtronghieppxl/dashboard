<?php

namespace App\Http\Controllers\BuildData\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class SurchargeController extends Controller
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
        $active_nav = 'Phụ thu';
        return view('build_data.business.surcharge.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $status = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api =sprintf(API_SURCHARGE_GET_DATA, $brand, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if($config['status'] === 403) {
                return $config;
            }
            $collection = collect($config['data']['result']);
            $dataEnable = $collection->where('status', Config::get('constants.type.checkbox.SELECTED'))->toArray();
            $dataDisable = $collection->where('status', Config::get('constants.type.checkbox.DIS_SELECTED'))->toArray();
            $tableEnable = DataTables::of($dataEnable)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id=" ' . $row['id'] . '" data-brand=" ' . $row['restaurant_brand_id'] . '" onclick="changeStatusSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id=" ' . $row['id'] . '" data-name="' . $row['name'] . '" data-description="' . $row['description'] . '" data-price="' . $this->numberFormat($row['price']) . '" data-brand="' . $row['restaurant_brand_id'] . '" data-status="' . $row['status'] . '" data-restaurant-vat-config-id="'. $row['restaurant_vat_config_id'] .'" onclick="openModalUpdateSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailSurchargeData($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('description', function ($row) {
                    if (mb_strlen($row['description']) > 30) {
                        return mb_substr($row['description'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse"  data-toggle="tooltip" data-placement="top" data-original-title="' . $this->removeSpecialCharacterAttr($row['description']) . '"></i>';
                    } else {
                        return $row['description'];
                    }
                })
                ->addColumn('created_at', function ($row) {
                    return substr($row['created_at'], 0, 10);
                })
                ->addColumn('vat', function ($row) {
                    return $row['vat_percent'] . ' %';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'description'])
                ->addIndexColumn()
                ->make(true);
            $tableDisable = DataTables::of($dataDisable)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-id=" ' . $row['id'] . '" data-brand=" ' . $row['restaurant_brand_id'] . '" onclick="changeStatusSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $row['id'] . '" data-name="' . $row['name'] . '" data-description="' . $row['description'] . '" data-price="' . $this->numberFormat($row['price']) . '" data-brand="' . $row['restaurant_brand_id'] . '" data-restaurant-vat-config-id="'. $row['restaurant_vat_config_id'] .'"  data-status="' . $row['status'] . '" onclick="openModalUpdateSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailSurchargeData($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('vat', function ($row) {
                    return $row['vat_percent'] . ' %';
                })
                ->addColumn('created_at', function ($row) {
                    return substr($row['created_at'], 0, 10);
                })
                ->addColumn('description', function ($row) {
                    if (mb_strlen($row['description']) > 30) {
                        return mb_substr($row['description'], 0, 27) . '...<i class="f-16 fa fa-comment-o text-inverse"  data-toggle="tooltip" data-placement="top" data-original-title="' . $this->removeSpecialCharacterAttr($row['description']) . '"></i>';
                    } else {
                        return $row['description'];
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action','description'])
                ->addIndexColumn()
                ->make(true);
            $data_total = [
                'total_record_enable' => $this->numberFormat(count($dataEnable)),
                'total_record_disable' => $this->numberFormat(count($dataDisable))
            ];
            return [$tableEnable, $tableDisable, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $vat = $request->get('vat');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_SURCHARGE_POST_CREATE;
        $body = [
            "restaurant_brand_id" => $request->get('brand'),
            "name" => $request->get('name'),
            "description" => $request->get('description'),
            "price" => $request->get('price'),
            "status" => ENUM_SELECTED,
            "restaurant_vat_config_id" => $vat,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $config['data']['price'] = $this->numberFormat($config['data']['price']);
                $config['data']['created_at'] = substr($config['data']['created_at'], 0, 10);
                $config['data']['vat'] = $config['data']['vat_percent'] . '%';
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                            <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '"  data-brand=" ' . $config['data']['restaurant_brand_id'] . '" data-restaurant-vat-config-id="' . $config['data']['restaurant_vat_config_id'] . '" onclick="changeStatusSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                            <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-description="' . $config['data']['description'] . '" data-price="' . $this->numberFormat($config['data']['price']) . '" data-brand="' . $config['data']['restaurant_brand_id'] . '" data-status="' . $config['data']['status'] . '" data-restaurant-vat-config-id="' . $config['data']['restaurant_vat_config_id'] . '"  onclick="openModalUpdateSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                            <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailSurchargeData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                                         </div>';
            }
            return $config;
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function getVat(Request $request)
    {
        $status = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_VAT_RESTAURANT_GET_DATA, $status);
        $body = null;;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === 403) {
                return $config;
            }
            $data = $config['data'];
            $data_vat = '<option value=""selected>' . TEXT_DEFAULT_OPTION . '</option>';
            for ($i = 0; $i < count($data); $i++) {
                $data_vat .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['vat_config_name'] . ' </option>';
            }
            return [$data_vat, $config];
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SURCHARGE_GET_DETAIL, $id);
        $body = null;;
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api =sprintf(API_SURCHARGE_POST_UPDATE, $id);
        $body = [
            "restaurant_brand_id" => $request->get('brand'),
            "name" => $request->get('name'),
            "description" => $request->get('description'),
            "restaurant_vat_config_id" => $request->get('vat'),
            "price" => $request->get('price'),
            "status" => $request->get('status'),
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $config['data']['price'] = $this->numberFormat($config['data']['price']);
                $config['data']['created_at'] = substr($config['data']['created_at'], 0, 10);
                $config['data']['vat'] = $config['data']['vat_percent'] . '%';
                if ($config['data']['status'] === Config::get('constants.type.checkbox.SELECTED')) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '"  data-brand=" ' . $config['data']['restaurant_brand_id'] . '" onclick="changeStatusSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                                <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-description="' . $config['data']['description'] . '" data-price="' . $this->numberFormat($config['data']['price']) . '" data-brand="' . $config['data']['restaurant_brand_id'] . '" data-status="' . $config['data']['status'] . '" data-restaurant-vat-config-id="' . $config['data']['restaurant_vat_config_id'] . '" onclick="openModalUpdateSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailSurchargeData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                                            </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-brand=" ' . $config['data']['restaurant_brand_id'] . '" onclick="changeStatusSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                                <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-description="' . $config['data']['description'] . '" data-price="' . $this->numberFormat($config['data']['price']) . '" data-brand="' . $config['data']['restaurant_brand_id'] . '" data-status="' . $config['data']['status'] . '" data-restaurant-vat-config-id="' . $config['data']['restaurant_vat_config_id'] . '" onclick="openModalUpdateSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailSurchargeData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
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
        $api = sprintf(API_SURCHARGE_POST_CHANGE_STATUS, $id);
        $body = [
            "restaurant_brand_id" => $request->get('brand'),
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $config['data']['price'] = $this->numberFormat($config['data']['price']);
                $config['data']['created_at'] = substr($config['data']['created_at'], 0, 10);
                $config['data']['vat'] = $config['data']['vat_percent'] . '%';
                if ($config['data']['status'] === Config::get('constants.type.checkbox.SELECTED')) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-brand=" ' . $config['data']['restaurant_brand_id'] . '" onclick="changeStatusSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                                <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-description="' . $config['data']['description'] . '" data-price="' . $this->numberFormat($config['data']['price']) . '" data-restaurant-vat-config-id="' . $config['data']['restaurant_vat_config_id'] . '" data-brand="' . $config['data']['restaurant_brand_id'] . '" data-status="' . $config['data']['status'] . '" onclick="openModalUpdateSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailSurchargeData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                                            </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button class="tabledit-edit-button btn btn-success waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-brand=" ' . $config['data']['restaurant_brand_id'] . '" onclick="changeStatusSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                                <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-description="' . $config['data']['description'] . '" data-price="' . $this->numberFormat($config['data']['price']) . '" data-restaurant-vat-config-id="' . $config['data']['restaurant_vat_config_id'] . '" data-brand="' . $config['data']['restaurant_brand_id'] . '" data-status="' . $config['data']['status'] . '" onclick="openModalUpdateSurchargeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                                <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailSurchargeData($(this))" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                                            </div>';
                }
            }
            return $config;
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
