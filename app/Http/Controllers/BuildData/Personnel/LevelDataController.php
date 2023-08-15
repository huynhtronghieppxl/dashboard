<?php

namespace App\Http\Controllers\BuildData\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;


class LevelDataController extends Controller
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
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Thứ hạng';
        return view('build_data.personnel.level.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $role = $request->get('role');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LEVEL_GET_DATA, $brand, $role);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $data_table = Datatables::of($data)
                ->editColumn('amount', function ($rows) {
                    return  $this->numberFormat($rows['amount']);
                })
                ->addColumn('action', function ($rows) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateLevelData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id="' . $rows['id'] . '" data-name="' . $rows['name'] . '" data-role="' . $rows['role_id'] . '" data-table="' . $rows['table_number'] . '" data-value="' .  $this->numberFormat($rows['amount']) . '" data-description="' . $rows['note'] . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    $keysearch = [$row['name'], $row['table_number'], $row['amount']];
                    return $this->keySearchDatatableTemplate($keysearch);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
            return [$data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function role(Request $request)
    {
        $branch = ENUM_GET_ALL;
        $status = ENUM_STATUS_GET_ACTIVE;
        $type = Config::get('constants.type.EmployeeRoleTypeEnum.BUSINESS');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_ROLE_GET_DATA_ROLE, $branch, $status, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $data_table = Datatables::of($data)
                ->addColumn('name', function ($row) {
                    return '<label>' . $row['name'] . '</label><input class="d-none" value="' . $row['id'] . '"/>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['name'])
                ->make(true);

            $data_role = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            if (count($data) > 0) {
                $data_role = '';
                foreach ($data as $db) {
                    $data_role .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
                }
            }
            return [$data_table, $data_role, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $id = ENUM_ID_DEFAULT;
        $roleId = $request->get('role');
        $brand = $request->get('brand');
        $table = $request->get('table');
        $name = $request->get('name');
        $note = $request->get('description');
        $amount = $request->get('value');
        $bonusPoint = Config::get('constants.type.data.MIN_VALUE');
        $totalPoint = Config::get('constants.type.data.MIN_VALUE');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_LEVEL_POST_DATA);
        $body = [
            'id' => $id,
            'role_id' => $roleId,
            'table_number' => $table,
            'name' => $name,
            'note' => $note,
            'amount' => $amount,
            'restaurant_brand_id' => $brand,
            'bonus_point' => $bonusPoint,
            'total_point' => $totalPoint
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        return $config;
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $roleId = $request->get('role');
        $table = $request->get('table');
        $brand = $request->get('brand');
        $name = $request->get('name');
        $note = $request->get('description');
        $amount = $request->get('value');
        $bonusPoint = Config::get('constants.type.data.MIN_VALUE');
        $totalPoint = Config::get('constants.type.data.MIN_VALUE');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_LEVEL_POST_DATA);
        $body = [
            'id' => $id,
            'role_id' => $roleId,
            'table_number' => $table,
            'name' => $name,
            'note' => $note,
            'restaurant_brand_id' => $brand,
            'amount' => $amount,
            'bonus_point' => $bonusPoint,
            'total_point' => $totalPoint
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        return $config;
    }

}
