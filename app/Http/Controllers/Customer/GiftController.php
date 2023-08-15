<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\DataTables;

class GiftController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Quà tặng';
        return view('customer.gift.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $status = Config::get('constants.type.status.GET_ALL');

        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GIFT_GET_BIRTHDAY_ITEM, $branch, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data'];
            $collection = collect($data);
            $data_enable = $collection->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all();
            $data_disable = $collection->where('status', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->all();

            $data_table_enable = DataTables::of($data_enable)
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('action', function ($row) {
                    $disable = TEXT_DISABLE_STATUS;
                    $update = TEXT_UPDATE;
                    return '<div class="btn-group btn-group-sm">
                             <button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light" onclick="changeStatusGift($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '"><span class="icofont icofont-ui-close"></span></button>
                            <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" onclick="openModalUpdateGift($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-price="' . $this->numberFormat($row['price']) . '" data-status="' . $row['status'] . '" data-branch="' . $row['branch_id'] . '"  data-description="' . $row['description'] . '"><span class="icofont icofont-ui-edit"></span></button>
                        </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            $data_table_disable = DataTables::of($data_disable)
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['price']);
                })
                ->addColumn('action', function ($row) {
                    $enable = TEXT_ENABLE;
                    $update = TEXT_UPDATE;
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-success waves-effect waves-light" onclick="changeStatusGift($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '"><span class="icofont icofont-ui-check"></span></button>
                            <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" onclick="openModalUpdateGift($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-price="' . $this->numberFormat($row['price']) . '" data-status="' . $row['status'] . '" data-branch="' . $row['branch_id'] . '"  data-description="' . $row['description'] . '"><span class="icofont icofont-ui-edit"></span></button>
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
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_GIFT_POST_CREATE);
        $body = [
            'branch_ids' => $request->get('branch'),
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'description' => sprintf($request->get('description'))
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_GIFT_POST_UPDATE, $request->get('id'));
        $body = [
            'branch_id' => $request->get('branch'),
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'description' => sprintf($request->get('description')),
            'status' => $request->get('status'),
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function changeStatus(Request $request)
    {
        $id = ($request->get('id'));
        $branch = $request->get('branch');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_GIFT_POST_CHANGE_STATUS, $id, $branch);
        $body = null;
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }
}
