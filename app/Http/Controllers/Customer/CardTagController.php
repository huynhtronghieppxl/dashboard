<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\DataTables;

class CardTagController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'MARKETING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }

        $active_nav = 'Thẻ tag';
        return view('customer.card_tag.index', compact('active_nav'));
    }

    public function data(Request $request){
        $isDelete = $request->get('is_delete');
        $projectID = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_CARD_TAG_GET, $isDelete);
        $body = null;
        $config = $this->callApiGatewayTemplate2($projectID, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $collection = collect($data);
            $enableData = $collection->where('is_delete', Config::get('constants.type.checkbox.DIS_SELECTED'));
            $disableData = $collection->where('is_delete', Config::get('constants.type.checkbox.SELECTED'));
            $enable = $this->drawTableEnableCardTag($enableData);
            $disable = $this->drawTableDisableCardTag($disableData);
            $dataTotal = array(
                'total_record_tag_enable' => count($enableData),
                'total_record_tag_disable' => count($disableData),
            );
            return [$enable, $config, $disable, $dataTotal];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawTableEnableCardTag($enableData)
    {
        return DataTables::of($enableData)
            ->addColumn('name', function ($row) {
                return $row['name'];
            })
            ->addColumn('color', function ($row) {
                return '<div class="waves-effect waves-light w-75 h-1rem m-auto" style="background-color: ' . $row['color_hex_code'] . '"></div>';
            })
            ->addColumn('quantity', function ($row) {
                return $row['total_customer'];
            })
            ->addColumn('action', function ($row) {
                $update = TEXT_UPDATE;
                $disable = TEXT_DISABLE_STATUS;
                $detail = TEXT_DETAIL;
                return '<div class="btn-group btn-group-sm">
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusCardTag($(this))" data-id="'. $row['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><i class="fi-rr-cross"></i></button>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light"  onclick="openModalUpdateCardTag($(this))" data-id="'. $row['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                                 <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailCardTag($(this))" data-id="'. $row['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                             </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['name', 'color', 'quantity', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function drawTableDisableCardTag($disableData){
        return DataTables::of($disableData)
            ->addColumn('name', function ($row) {
                return $row['name'];
            })
            ->addColumn('color', function ($row) {
                return '<div class="waves-effect waves-light w-75 h-1rem m-auto" style="background-color: ' . $row['color_hex_code'] . '"></div>';
            })
            ->addColumn('quantity', function ($row) {
                return $row['total_customer'];
            })
            ->addColumn('action', function ($row) {
                $enable = TEXT_ENABLE;
                $detail = TEXT_DETAIL;
                return '<div class="btn-group btn-group-sm">
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusCardTag($(this))" data-id="'. $row['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '"><i class="fi-rr-check"></i></button>
                                 <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailCardTag($(this))" data-id="'. $row['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                             </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['name', 'color', 'quantity', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create(Request $request){
        $name = $request->get('name');
        $colorHexCode = $request->get('color_hex_code');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_CARD_TAG_POST_CREATE);
        $body = [
            'name' => $name,
            'color_hex_code' => $colorHexCode
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
            $update = TEXT_UPDATE;
            $disable = TEXT_DISABLE_STATUS;
            $detail = TEXT_DETAIL;
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            $config['data']['color_hex_code'] = '<div class="waves-effect waves-light w-75 h-1rem m-auto" style="background-color: ' . $config['data']['color_hex_code'] . '"></div>';
            $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusCardTag($(this))" data-id="'. $config['data']['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><i class="fi-rr-cross"></i></button></br>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light"  onclick="openModalUpdateCardTag($(this))" data-id="'. $config['data']['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                                 <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailCardTag($(this))" data-id="'. $config['data']['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                             </div>';
        }
        return $config;
    }

    public function dataUpdate(Request $request){
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_CARD_TAG_GET_DETAIL, $id);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function update(Request $request){
        $id = $request->get('id');
        $name = $request->get('name');
        $color = $request->get('color_hex_code');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_CARD_TAG_POST_UPDATE, $id);
        $body = [
            "name" => $name,
            "color_hex_code" => $color,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
            $update = TEXT_UPDATE;
            $disable = TEXT_DISABLE_STATUS;
            $detail = TEXT_DETAIL;
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            $config['data']['color_hex_code'] = '<div class="waves-effect waves-light w-75 h-1rem m-auto" style="background-color: ' . $config['data']['color_hex_code'] . '"></div>';
            $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusCardTag($(this))" data-id="'. $config['data']['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><i class="fi-rr-cross"></i></button></br>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light"  onclick="openModalUpdateCardTag($(this))" data-id="'. $config['data']['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                                 <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailCardTag($(this))" data-id="'. $config['data']['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                             </div>';
        }
        return $config;
    }

    public function detail(Request $request){
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_CARD_TAG_GET_DETAIL, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $config['data']['color_hex_code'] = '<span class="position-absolute" style="background-color: '. $config['data']['color_hex_code'] .';height: 14px;width: 70px;top: 0;left: 0"></span>';
        $dataTableCustomer = $config['data']['customers'];
        $tableCustomer = $this->drawTableCustomerDetailCardTag($dataTableCustomer);
        return [$config, $tableCustomer];
    }

    public function drawTableCustomerDetailCardTag($dataTableCustomer)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        return DataTables::of($dataTableCustomer)
            ->addColumn('name', function ($row) use ($domain){
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table">
                         <label class="name-inline-data-table">' . $row['name'] . '</label>';
            })
            ->addColumn('phone', function ($row) {
                return $row['phone'];
            })
            ->addColumn('gender', function ($row) {
                if ($row['gender'] == TEXT_FEMALE_VALUE) {
                    $message = '<i class="ion-female mr-1 "></i>'.TEXT_FEMALE;
                } else {
                    $message = '<i class="ion-male mr-1 text-primary"></i>'.TEXT_MALE;
                }
                return $message;
            })

            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['name','gender','phone'])
            ->addIndexColumn()
            ->make(true);
    }

    public function changeStatus(Request $request){
        $id = $request->get('id');
        $isConfirm = $request->get('is_confirm');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_CARD_TAG_POST_CHANGE_STATUS, $id);
        $body = [
            "id" => $id,
            "is_confirm" => $isConfirm,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')){
            $enable = TEXT_ENABLE;
            $disable = TEXT_DISABLE_STATUS;
            $update = TEXT_UPDATE;
            $detail = TEXT_DETAIL;
            if ($config['data']['is_delete'] === Config::get('constants.type.checkbox.DIS_SELECTED')) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $config['data']['color_hex_code'] = '<div class="waves-effect waves-light w-75 h-1rem m-auto" style="background-color: ' . $config['data']['color_hex_code'] . '"></div>';
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusCardTag($(this))" data-id="'. $config['data']['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><i class="fi-rr-cross"></i></button></br>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light"  onclick="openModalUpdateCardTag($(this))" data-id="'. $config['data']['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '"><i class="fi-rr-pencil"></i></button>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailCardTag($(this))" data-id="'. $config['data']['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                             </div>';
            } else {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $config['data']['color_hex_code'] = '<div class="waves-effect waves-light w-75 h-1rem m-auto" style="background-color: ' . $config['data']['color_hex_code'] . '"></div>';
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusCardTag($(this))" data-id="'. $config['data']['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '"><i class="fi-rr-check"></i></button>
                                 <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailCardTag($(this))" data-id="'. $config['data']['id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><i class="fi-rr-eye"></i></button>
                             </div>';
            }
        }
        return $config;
    }

    public function listCustomer(Request $request){
        $type = $request->get('type');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = 100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $api = sprintf(API_CUSTOMERS_GET, $type, $page, $limit, $key);
        $body = null;
        $dataListCustomer = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $id = $request->get('id');
        $api = sprintf(API_CARD_TAG_GET_DETAIL, $id);
        $body = null;
        $listCustomerCardTag = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate([$dataListCustomer, $listCustomerCardTag]);
        $cardTagMember = collect($configAll[0]['data']['list'])->pluck('id')->toArray();
        $data = $configAll[0]['data']['list'];
        $detail = TEXT_DETAIL;
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain .$data[$i]['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $data[$i]['avatar'] . "'" . ')">
                                                        <label class="title-name-new-table" >'.$data[$i]['name'].'</label>';
            if ($data[$i]['gender'] === TEXT_FEMALE_VALUE){
                $data[$i]['gender'] = '<i class="ion-female mr-1 "></i>'.TEXT_FEMALE;
            } else {
                $data[$i]['gender'] = '<i class="ion-male mr-1 text-primary"></i>'.TEXT_MALE;
            }
            $data[$i]['point'] = $this->numberFormat($data[$i]['point']);
            $data[$i]['alo_point'] = $this->numberFormat($data[$i]['alo_point']);
            $data[$i]['accumulate_point'] = $this->numberFormat($data[$i]['accumulate_point']);
            $data[$i]['total_point_use'] = $this->numberFormat($data[$i]['total_point_use']);
            $data[$i]['detail'] = '<div class="btn-group btn-group-sm">
                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-id="' . $data[$i]['id'] . '" onclick="openDetailCustomers($(this))"><i class="fi-rr-eye"></i></button>
                                                             </div>';
            $data[$i]['keysearch'] = $this->keySearchDatatableTemplate($data[$i]);
        }
        $dataTable = array(
            'draw' => $request->get('draw'),
            'recordsTotal' =>$configAll[0]['data']['total_record'],
            'recordsFiltered' => $configAll[0]['data']['total_record'],
            'data' => $data,
            'total_record' => $this->numberFormat($configAll[0]['data']['total_record']),
            'key' => $key,
            'page' => $page,
            'config' => $configAll[0]
        );
        return json_encode($dataTable);
    }
}
