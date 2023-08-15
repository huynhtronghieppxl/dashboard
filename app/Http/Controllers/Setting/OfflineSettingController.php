<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\DataTables;

class OfflineSettingController extends Controller
{
    //
    public function index()
    {
        $active_nav = 'Offline';
        return view('setting.offline.index', compact('active_nav'));
    }

    public function listBranch(Request $request)
    {
        $status = Config::get('constants.type.status.checkbox.SELECTED');
        $is_card = Config::get('constants.type.checkbox.GET_ALL');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_SETTING_BRANCH_GET_CARD, $restaurant_brand_id, $status, $is_card);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $collect = collect($config['data']);
        $dataBranchOffline = $collect->where('is_working_offline', (int)Config::get('constants.type.checkbox.SELECTED'))->all();
        $dataBranchNotOffline = $collect->where('is_working_offline', (int)Config::get('constants.type.checkbox.DIS_SELECTED'))->all();
        $tableBranchOffline = Datatables::of($dataBranchOffline)
            ->addColumn('action', function ($row) {
                return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '" onclick="changeStatusOfflineBranch(' . $row['id'] . ', ' . $row['is_working_offline'] . ')">
                                     <span class="fi-rr-cross"></span>
                                </button>
                            </div>';

            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        $tableBranchNotOffline = Datatables::of($dataBranchNotOffline)
            ->addColumn('action', function ($row) {
                return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '" onclick="changeStatusOfflineBranch(' . $row['id'] . ', ' . $row['is_working_offline'] . ')">
                                    <span class="fi-rr-check"></span>
                                </button>
                            </div>';

            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        $totalOffline = count($dataBranchOffline);
        $totalNotOffline = count($dataBranchNotOffline);
        return [$tableBranchOffline, $tableBranchNotOffline, $totalOffline, $totalNotOffline, $config];
    }

    public function changeOfflineBranch(Request $request)
    {
        $branch_id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_SETTING_BRANCH_UPDATE_OFFLINE, $branch_id);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
