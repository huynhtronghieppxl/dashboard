<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\DataTables;

class BenefitMembershipCardController extends Controller
{
    public function index(Request $request)
    {

        $active_nav = 'customer.benefit-membership-card';
        return view('customer.benefit_membership_card.index', compact('active_nav'));
    }

    public function membershipCard(Request $request)
    {
        $method = 'GET';
        $api = sprintf(API_MEMBERSHIP_CARD_GET);
        $body = null;
        $config = $this->callApiTemplate($request, $method, $api, $body);
        try {
            $data = $config['data'];
            $data_card = TEXT_DEFAULT_OPTION;
            for ($i = 0; $i < count($data); $i++) {
                $data_card .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
            }
            if ($data_card === TEXT_DEFAULT_OPTION) {
                $data_card = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }

            return [$data_card, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function data(Request $request)
    {
        $method = 'GET';
        $id = $request->get('id');
        $status = $request->get('status');
        $api = sprintf(API_BENEFIT_MEMBERSHIP_CARD_GET_DATA, $id, $status);
        $body = null;
        $config = $this->callApiTemplate($request, $method, $api, $body);
        try {
            $data = $config['data'];
            $collection = collect($data);
            $data_enable = $collection->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all();
            $total_record_enable = $collection->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->count();
            $data_disable = $collection->where('status', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->all();
            $total_record_disable = $collection->where('status', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->count();

            $data_table_enable = DataTables::of($data_enable)
                ->addColumn('action', function ($row) {
                    $disable = TEXT_DISABLE_STATUS;
                    $update = TEXT_UPDATE;
                    return '<div class="btn-group btn-group-sm">
                            <button class="tabledit-edit-button btn btn-danger waves-effect waves-light"  onclick="changeStatusAreaData($(this))" title="' . $disable . '"><span class="icofont icofont-ui-close"></span></button>
                            <button class="tabledit-edit-button btn btn-warning waves-effect waves-light" onclick="openModalUpdateAreaData($(this))" title="' . $update . '"><span class="icofont icofont-ui-edit"></span></button>
                            </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            $data_table_disable = DataTables::of($data_disable)
                ->addColumn('action', function ($row) {
                    $enable = TEXT_ENABLE;
                    $update = TEXT_UPDATE;
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-success waves-effect waves-light ml-1" onclick="changeStatusAreaData($(this))" title="' . $enable . '"><span class="icofont icofont-ui-check"></span></button>
                            <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" onclick="openModalUpdateAreaData($(this))" title="' . $update . '"><span class="icofont icofont-ui-edit"></span></button>
                                </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            $total_record = [
                'total_record_enable' =>  $this->numberFormat($total_record_enable),
                'total_record_disable' =>  $this->numberFormat($total_record_disable),
            ];

            return [$data_table_enable, $data_table_disable, $total_record, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }
}
