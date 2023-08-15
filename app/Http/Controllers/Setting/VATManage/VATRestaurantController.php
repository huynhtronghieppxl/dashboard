<?php

namespace App\Http\Controllers\Setting\VATManage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VATRestaurantController extends Controller
{
    //
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
        $active_nav = 'Chọn VAT hệ thống';
        return view('setting.vat_manage.vat_restaurant.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $api = sprintf(API_VAT_ADMIN_GET_DATA);
        $body = null;
        $requestAdmin = [
            'project' => ENUM_PROJECT_ID_ORDER_VERSION,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $is_active = ENUM_SELECTED;
        $api = sprintf(API_VAT_RESTAURANT_GET_DATA, $is_active);
        $body = null;
        $requestRestaurant = [
            'project' => ENUM_PROJECT_ID_ORDER_VERSION,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestAdmin, $requestRestaurant]);
        try {
            $datatable_admin = DataTables::of($configAll[0]['data'])
                ->addColumn('action', function ($row) {
//                    return '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" data-action="'. ENUM_DIS_SELECTED .'" onclick="checkVATRestaurantSetting($(this))" data-id="' . $row['id'] . '"></i>';
                    return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" data-action="'. ENUM_DIS_SELECTED .'" onclick="checkVATRestaurantSetting($(this))" data-id="' . $row['id'] . '"><i class="fi-rr-arrow-small-right"></i></button>
                                </div>';
                })
                ->addColumn('percent', function ($row) {
                    return $row['percent'] . '%';
                })
                ->rawColumns(['action'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['percent'] . '%']).$this->keySearchDatatableTemplate([$row['name']] );
                })
                ->make(true);
            $datatable_restaurant = DataTables::of($configAll[1]['data'])
                ->addColumn('action', function ($row) {
//                    return '<i class="fa fa-2x fa-arrow-circle-left btn-convert-right-to-left pointer" data-action="'. ENUM_SELECTED .'" onclick="unCheckVATRestaurantSetting($(this))" data-id="' . $row['id'] . '"></i>';
                    return '<div class="btn-group btn-group-sm">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" data-action="'. ENUM_SELECTED .'" onclick="unCheckVATRestaurantSetting($(this))" data-id="' . $row['id'] . '"><i class="fi-rr-arrow-small-left"></i></button>
                                </div>';
                })
                ->addColumn('vat_percent', function ($row) {
                    return $row['percent'] . '%';
                })
                ->rawColumns(['action'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['percent'] . '%']).$this->keySearchDatatableTemplate([$row['vat_config_name']] );
                })
                ->make(true);
            return [$datatable_admin, $datatable_restaurant, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function assign(Request $request)
    {
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_VAT_RESTAURANT_ASSIGN);
        $body = [
            "list_insert_ids" => $request->get('list_insert_ids'),
            "list_delete_ids" => $request->get('list_delete_ids')
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
