<?php

namespace App\Http\Controllers\BuildData\Personnel;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class   KaizenBonusDataController extends Controller
{
    public function index(Request $request)
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
        $active_nav = 'Thưởng kaizen';
        return view('build_data.personnel.kaizen_bonus.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_KAI_ZEN_BONUS_DATA);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $table = DataTables::of($config['data'])
                ->addColumn('amount', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                    <input class="form-control d-none edit-kaizen-bonus-data text-center border-0 w-100" data-type="currency-edit" data-min="100" data-max="999999999" data-money="1"  value="' . $this->numberFormat($row['amount']) . '"/><label class="not-edit-kaizen-bonus-data">' . $this->numberFormat($row['amount']) . '</label>
                    </div>';
                })
                ->addColumn('level', function ($row) {
                    return 'Cấp ' . $row['level'];
                })
                ->addColumn('keysearch', function ($row) {
                    $row['level'] = 'Cấp ' . $row['level'];
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['amount'])
                ->addIndexColumn()
                ->make(true);
            $dataCreate = [1, 2, 3, 4];
            $tableCreate = DataTables::of($dataCreate)
                ->addColumn('level', function ($row) {
                    return 'Cấp ' . $row;
                })
                ->addColumn('amount', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                    <input class="form-control text-right border-0 w-100" data-type="currency-edit" data-min="100" data-money="1" value="100" />
                    </div>';
                })
                ->rawColumns(['level', 'amount'])
                ->addIndexColumn()
                ->make(true);

            return [$table, $tableCreate, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
//        $name = $request->get('name');
        $bonus = $request->get('bonus');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api =sprintf(API_POST_CREATE_KAI_ZEN_BONUS_DATA);
        $body = [
            'insert_json_amount' => $bonus,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        return $config;
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $level = $request->get('level');
        $amount = $request->get('amount');
        $bonus = $request->get('bonus');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_POST_UPDATE_KAI_ZEN_BONUS_DATA);
        $body = [
            'insert_json_amount' => $bonus,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $config['time'] = date('d/m/y H:i:s');
        return $config;
    }
}
