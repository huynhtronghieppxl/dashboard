<?php

namespace App\Http\Controllers\Customer;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\DataTables;

class DiscountController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Mã giảm giá';
        return view('customer.discount.index', compact('active_nav'));
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
                    return '100,000 - 1,000,000';
                })
                ->addColumn('gift', function ($row) {
                    return 'Bò xào sống nhăn';
                })
                ->addColumn('value', function ($row) {
                    return '20,000';
                })
                ->addColumn('action', function ($row) {
                    $disable = TEXT_DISABLE_STATUS;
                    $update = TEXT_UPDATE;
                    return '<div class="btn-group btn-group-sm">
                             <button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light" onclick="changeStatusCardValue($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><span class="icofont icofont-ui-close"></span></button>
                             <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" onclick="openModalUpdateCardValue($(this))" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-amount="' . $this->numberFormat($row['amount']) . '" data-status="' . $row['status'] . '" data-bonus="' . $this->numberFormat($row['bonus_amount']) . '"><span class="icofont icofont-ui-edit"></span></button>
                        </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            $data_table_disable = DataTables::of($data_disable)
                ->addColumn('amount', function ($row) {
                    return '100,000 - 1,000,000';
                })
                ->addColumn('gift', function ($row) {
                    return 'Bò xào sống nhăn';
                })
                ->addColumn('value', function ($row) {
                    return '20,000';
                })
                ->addColumn('action', function ($row) {
                    $enable = TEXT_ENABLE;
                    $update = TEXT_UPDATE;
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-success waves-effect waves-light" onclick="changeStatusCardValue($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '"><span class="icofont icofont-ui-check"></span></button>
                            <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" onclick="openModalUpdateCardValue($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-amount="' . $this->numberFormat($row['amount']) . '" data-status="' . $row['status'] . '" data-bonus="' . $this->numberFormat($row['bonus_amount']) . '"><span class="icofont icofont-ui-edit"></span></button>
                        </div>';
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
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_CREATE_CARD_VALUE_POST);
        $body = [
            'name' => $request->get('name'),
            'amount' => $request->get('amount'),
            'bonus_amount' => sprintf($request->get('bonus'))
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ADMIN');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_UPDATE_CARD_VALUE_POST, $id);
        $body = [
            'name' => $request->get('name'),
            'amount' => $request->get('amount'),
            'bonus_amount' => $request->get('bonus'),
            'status' => $request->get('status'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_CHANGE_STATUS_CARD_VALUE_POST,$id);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
    public function detail(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_DETAIL_CARD_VALUE_POST, $id);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
