<?php

namespace App\Http\Controllers\BuildData\Food;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class WarningPriceFoodController extends Controller
{
    //
    function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
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
        $active_nav = 'Cảnh báo giá vốn';
        return view('build_data.food.warning_price.index', compact('active_nav'));
    }
    public function data(Request $request)
    {
        $restaurant_brand_id  = $request->get('restaurant_brand_id');
        $category_type = $request->get('category_type');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api =sprintf(API_WARNING_PRICE_FOOD_GET_FOOD_DATA, $restaurant_brand_id, $category_type);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $remove = TEXT_CANCEL;
            $update = TEXT_UPDATE;
            $index = 0;
            $config['data'][0]['name_icon']='<div class="d-flex align-items-center justify-content-center">'
                                               . $config['data'][0]['name']. ' ' .'
                                                <i class="fa fa-exclamation-triangle text-success pl-1" data-toggle="tooltip" data-placement="top" data-original-title="'. $config['data'][0]['name'] .'"></i>
                                              </div>';
            $config['data'][1]['name_icon']='<div class="d-flex align-items-center justify-content-center">'
                                                . $config['data'][1]['name']. ' ' .'
                                                <i class="fa fa-exclamation-triangle text-primary pl-1" data-toggle="tooltip" data-placement="top" data-original-title="'. $config['data'][1]['name'] .'"></i>
                                              </div>';
            $config['data'][2]['name_icon']='<div class="d-flex align-items-center justify-content-center">'
                                                . $config['data'][2]['name']. ' ' .'
                                                <i class="fa fa-exclamation-triangle text-warning pl-1" data-toggle="tooltip" data-placement="top" data-original-title="'. $config['data'][2]['name'] .'"></i>
                                              </div>';
            $config['data'][3]['name_icon']='<div class="d-flex align-items-center justify-content-center">'
                                                . $config['data'][3]['name'] . ' ' .'
                                                <i class="fa fa-exclamation-triangle text-danger pl-1" data-toggle="tooltip" data-placement="top" data-original-title="'. $config['data'][3]['name'] .'"></i>
                                              </div>';
            $config['data'][0]['status'] = 0;
            $config['data'][1]['status'] = 1;
            $config['data'][2]['status'] = 2;
            $config['data'][3]['status'] = 3;
            $data_table = DataTables::of($config['data'])
                ->addColumn('action', function ($row) use ($remove, $update) {
                    if($row['status'] === 0){
                        return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button   seemt-btn-hover-orange waves-effect waves-light" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-from="0" data-to="'.  $row['percent_to'] .'" onclick="openModalUpdateWarningPriceFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-status="'. $row['status'] .'"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button   seemt-btn-hover-red waves-effect waves-light d-none" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-from="0" data-to="'.  $row['percent_to'] .'" onclick="closeWarningPriceFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $remove . '" data-status="'. $row['status'] .'"><i class="fi-rr-cross"></i></button>
                            <button type="button" class="tabledit-edit-button   seemt-green seemt-btn-hover-green waves-effect waves-light d-none" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-from="0" data-to="'.  $row['percent_to'] .'" onclick="saveWarningPriceFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Lưu lại " data-status="'. $row['status'] .'"><i class="fi-rr-check"></i></button>
                        </div>';
                    }
                    else if ($row['status'] === 1){
                        return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button   seemt-btn-hover-orange waves-effect waves-light" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-from="'.  $row['percent_from'] .'" data-to="'.  $row['percent_to'] .'" onclick="openModalUpdateWarningPriceFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-status="'. $row['status'] .'"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button   seemt-btn-hover-red waves-effect waves-light d-none" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-from="'.  $row['percent_from'] .'" data-to="'.  $row['percent_to'] .'" onclick="closeWarningPriceFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $remove . '" data-status="'. $row['status'] .'"><i class="fi-rr-cross"></i></button>
                            <button type="button" class="tabledit-edit-button   seemt-green seemt-btn-hover-green waves-effect waves-light d-none" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-from="'.  $row['percent_from'] .'" data-to="'.  $row['percent_to'] .'" onclick="saveWarningPriceFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Lưu lại " data-status="'. $row['status'] .'"><i class="fi-rr-check"></i></button>
                        </div>';
                    }
                    else if ($row['status'] === 2){
                        return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button   seemt-btn-hover-orange waves-effect waves-light" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-from="'.  $row['percent_from'] .'" data-to="'.  $row['percent_to'] .'" onclick="openModalUpdateWarningPriceFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-status="'. $row['status'] .'"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button   seemt-btn-hover-red waves-effect waves-light d-none" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-from="'.  $row['percent_from'] .'" data-to="'.  $row['percent_to'] .'" onclick="closeWarningPriceFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $remove . '" data-status="'. $row['status'] .'"><i class="fi-rr-cross"></i></button>
                            <button type="button" class="tabledit-edit-button   seemt-green seemt-btn-hover-green waves-effect waves-light d-none" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-from="'.  $row['percent_from'] .'" data-to="'.  $row['percent_to'] .'" onclick="saveWarningPriceFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Lưu lại " data-status="'. $row['status'] .'"><i class="fi-rr-check"></i></button>
                        </div>';
                    }
                    else{
                        return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button   seemt-btn-hover-orange waves-effect waves-light" style="visibility: hidden" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-from="'.  $row['percent_from'] .'" data-to="'.  $row['percent_to'] .'" onclick="openModalUpdateWarningPriceFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-status="'. $row['status'] .'"><i class="fi-rr-pencil"></i></button>
                            <button type="button" class="tabledit-edit-button   seemt-btn-hover-red waves-effect waves-light d-none" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-from="'.  $row['percent_from'] .'" data-to="'.  $row['percent_to'] .'" onclick="closeWarningPriceFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $remove . '" data-status="'. $row['status'] .'"><i class="fi-rr-cross"></i></button>
                            <button type="button" class="tabledit-edit-button    seemt-green seemt-btn-hover-green waves-effect waves-light d-none" data-name="' . $row['name'] . '" data-id="' . $row['id'] . '" data-from="'.  $row['percent_from'] .'" data-to="'.  $row['percent_to'] .'" onclick="saveWarningPriceFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Lưu lại " data-status="'. $row['status'] .'"><i class="fi-rr-check"></i></button>
                        </div>';
                    }
                })
                ->addColumn('name', function ($row){
                    return $row['name_icon'];
                })
                ->addColumn('percent', function ($row) use ($remove, $update) {
                    if($row['status'] == 0){
                        return '<label>Dưới </label>
                                    <div class="d-inline-block box-group">
                                        <span id="safe-warning-price-food-label">'. $row['percent_to'] .'%</span>
                                        <div class="border-group validate-table-validate d-none">
                                            <input type="text" style="padding: 5px 10px !important;" class=" form-control border-0 text-center" value="'. $row['percent_to'] .'" id="safe-warning-price-food-input" data-max="100" data-type="currency-edit" data-min="" data-check="0" data-float="1">
                                            <div class="line"></div>
                                        </div>
                                    </div>';
                    }
                    else if($row['status'] == 1){
                        return '<label>Từ</label>
                            <div class="box-group d-inline-block">
                                <span id="warning-warning-price-food-from-label">'. $row['percent_from'] .'%</span>
                                <div class="border-group validate-table-validate d-none">
                                    <input type="text" style="padding: 5px 10px !important;" class="form-control border-0 text-center" value="'. $row['percent_from'] .'" id="warning-warning-price-food-from-input" data-max="100" data-type="currency-edit" data-min="0" data-check="0" data-float="1">
                                    <div class="line"></div>
                                </div>
                            </div>
                            <label>Đến</label>
                            <div class="d-inline-block box-group">
                                <span id="warning-warning-price-food-to-label">'. $row['percent_to'] .'%</span>
                                <div class="border-group validate-table-validate d-none">
                                    <input type="text" style="padding: 5px 10px !important;" class=" form-control border-0 text-center" value="'. $row['percent_to'] .'" id="warning-warning-price-food-to-input" data-max="100" data-type="currency-edit" data-min="0" data-check="0" data-float="1">
                                    <div class="line"></div>
                                </div>
                            </div>';
                    }
                    else if($row['status'] == 2){
                        return '<label>Từ</label>
                            <div class="box-group d-inline-block">
                                <span id="warning-warning-price-food-from-label">'. $row['percent_from'] .'%</span>
                                <div class="border-group validate-table-validate d-none">
                                    <input type="text" style="padding: 5px 10px !important;" class="form-control border-0 text-center" value="'. $row['percent_from'] .'" id="warning-warning-price-food-from-input" data-max="100" data-type="currency-edit" data-min="0" data-check="0" data-float="1">
                                    <div class="line"></div>
                                </div>
                            </div>
                            <label>Đến</label>
                            <div class="d-inline-block box-group">
                                <span id="warning-warning-price-food-to-label">'. $row['percent_to'] .'%</span>
                                <div class="border-group validate-table-validate d-none">
                                    <input type="text" style="padding: 5px 10px !important;" class=" form-control border-0 text-center" value="'. $row['percent_to'] .'" id="warning-warning-price-food-to-input" data-max="100" data-type="currency-edit" data-min="0" data-check="0" data-float="1">
                                    <div class="line"></div>
                                </div>
                            </div>';
                    }
                    else{
                        return '<label>Trên </label>
                            <div class="d-inline-block box-group">
                                <span id="danger-warning-price-food-label">'. $row['percent_from'] .'%</span>
                                <div class="border-group validate-table-validate d-none">
                                    <input type="text" style="padding: 5px 10px !important;" class=" form-control border-0 text-center" value="'. $row['percent_from'] .'" id="danger-warning-price-food-input" data-max="100" data-type="currency-edit" data-min="0" data-check="0" data-float="1">
                                    <div class="line"></div>
                                </div>
                            </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['name'] ,$row['name'] , $row['percent_to'] , $row['percent_from']  , '']);
                })
                ->rawColumns(['action', 'percent', 'name'])
                ->addIndexColumn()
                ->make(true);
            $option = '';
            foreach ($config['data'] as $db) {
                $option .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
            return [$data_table, $option, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $category_type = $request->get('category_type');
        $to = $request->get('to');
        $from = $request->get('from');
        $name = $request->get('name');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_WARNING_PRICE_FOOD_POST_UPDATE_FOOD_DATA, $id);
        $body = [
            "percent_from" => $from,
            "percent_to" => $to,
            "name" => $name,
            "description" => "",
            "category_type" => $category_type
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

}
