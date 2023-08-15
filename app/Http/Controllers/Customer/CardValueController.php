<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\DataTables;

class CardValueController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Mệnh giá thẻ';
        return view('customer.card_value.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $status = Config::get('constants.type.status.GET_ALL');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_CARD_GET_VALUE, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data'];
            $collection = collect($data);
            $data_enable = $collection->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all();
            $data_disable = $collection->where('status', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->all();

            $data_table_enable = DataTables::of($data_enable)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('bonus_amount', function ($row) {
                    return $this->numberFormat($row['bonus_amount']);
                })
                ->addColumn('action', function ($row) {
                    $disable = TEXT_DISABLE_STATUS;
                    $update = TEXT_UPDATE;
                    return '<div class="btn-group btn-group-sm">
                             <button type="button" class="tabledit-edit-button seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusCardValue($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><i class="fi-rr-cross"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" onclick="openModalUpdateCardValue($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-amount="' . $this->numberFormat($row['amount']) . '" data-status="' . $row['status'] . '" data-bonus="' . $this->numberFormat($row['bonus_amount']) . '"><i class="fi-rr-pencil"></i></button>
                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            $data_table_disable = DataTables::of($data_disable)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('bonus_amount', function ($row) {
                    return $this->numberFormat($row['bonus_amount']);
                })
                ->addColumn('action', function ($row) {
                    $enable = TEXT_ENABLE;
                    $update = TEXT_UPDATE;
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusCardValue($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '"><i class="fi-rr-check"></i></button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" onclick="openModalUpdateCardValue($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-amount="' . $this->numberFormat($row['amount']) . '" data-status="' . $row['status'] . '" data-bonus="' . $this->numberFormat($row['bonus_amount']) . '"><i class="fi-rr-pencil"></i></button>
                        </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            $data_total = [
                'total_record_enable' => $this->numberFormat($collection->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->count()),
                'total_record_disable' => $this->numberFormat($collection->where('status', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->count()),
            ];

            return [$data_table_enable, $data_table_disable, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $project = ENUM_PROJECT_ID_ORDER_VERSION;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_CREATE_CARD_VALUE_POST);
        $body = [
            'name' => $request->get('name'),
            'amount' => $request->get('amount'),
            'bonus_amount' => $request->get('bonus')
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS){
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
        }
        return $config;
    }

    public function update(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_UPDATE_CARD_VALUE_POST, $request->get('id'));
        $body = [
            'name' => $request->get('name'),
            'amount' => $request->get('amount'),
            'bonus_amount' => $request->get('bonus'),
            'status' => $request->get('status'),
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        return $config;
    }

    public function changeStatus(Request $request)
    {
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_CHANGE_STATUS_CARD_VALUE_POST, sprintf($request->get('id')));
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
