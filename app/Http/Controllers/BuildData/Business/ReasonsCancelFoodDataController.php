<?php

namespace App\Http\Controllers\BuildData\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class ReasonsCancelFoodDataController extends Controller
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
        $active_nav = 'Lý do hủy món';
        return view('build_data.business.reasons_cancel_food.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('restaurant_brand_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_CANCEL_FOOD_GET_REASONS, $brand);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $remove = TEXT_REMOVE;
            $update = TEXT_UPDATE;
            $data_table = Datatables::of($config['data'])
                ->addColumn('action', function ($rows) use ($remove, $update) {
                    return '<div class="btn-group btn-group-sm">
                             <button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeReasonsCancelFoodData($(this))" data-id="' . $rows['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $remove . '"><i class="fi-rr-trash"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateReasonsCancelFoodData($(this))" data-id="' . $rows['id'] . '" data-content="' . $rows['content'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                        </div>';
                })
                ->addColumn('content', function ($row) {
                    if (mb_strlen($row['content']) > 70) {
                        return mb_substr($row['content'], 0, 65) . '...';
                    } else {
                        return $row['content'];
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'content'])
                ->make(true);
            return [$data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $id = Config::get('constants.type.id.DEFAULT');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $content = $request->get('content');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CANCEL_FOOD_POST_CREATE_REASONS);
        $body = [
            'restaurant_brand_id' => $restaurantBrandID,
            'id' => $id,
            'content' => $content,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $restaurantBrandID = $request->get('restaurant_brand_id');
        $content = $request->get('content');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CANCEL_FOOD_POST_UPDATE_REASONS, $id);
        $body = [
            'restaurant_brand_id' => $restaurantBrandID,
            'id' => $id,
            'content' => $content,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function remove(Request $request)
    {
        $id = $request->get('id');
        $restaurant_brand_id= $request->get('restaurant_brand_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api =sprintf(API_REMOVE_REASONS_POST_CANCEL_FOOD, $id);
        $body = [
            'restaurant_brand_id' => $restaurant_brand_id,
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
}
