<?php

namespace App\Http\Controllers\BuildData\Personnel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class WageDataController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(2);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Bậc lương';
        return view('build_data.personnel.wage.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_LEVEL_SALARY_GET_DATA);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data'])->where('type',Config::get('constants.type.checkbox.DIS_SELECTED')); // type=0 bậc lương cơ bản
            $dataEnable = $collection->where('status', Config::get('constants.type.checkbox.SELECTED'))->toArray();
            $dataDisable = $collection->where('status', Config::get('constants.type.checkbox.DIS_SELECTED'))->toArray();
            $tableEnable = Datatables::of($dataEnable)
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['level'],$row['basic_salary']]);
                })
                ->addColumn('level', function ($row) {
                    return '<label>' . $row['level'] . '</label><input class="form-control d-none w-75 m-auto input-maximum" value="' . $row['level'] . '"/>';
                })
                ->addColumn('basic_salary', function ($row) {
                    return '<label>' . $this->numberFormat($row['basic_salary']) . '</label><input class="form-control d-none text-right w-75 m-auto input-maximum" data-type="currency-edit" value="' . $this->numberFormat($row['basic_salary']) . '"/>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS. '" data- data-id=" ' . $row['id'] . '" data-keysearch="'.$this->keySearchDatatableTemplate([$row['level'],$row['basic_salary']]).'" data-level=" ' . $row['level'] . '"  data-status=" ' . $row['status'] . '" data-basic-salary="' . $this->numberFormat($row['basic_salary']) . '"  data-action="1" onclick="changeStatusWage($(this))"><i class="fi-rr-cross"></i></button>
                            <button type="button" class="btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id=" ' . $row['id'] . '" data-level=" ' . $row['level'] . '" data-basic-salary="' . $this->numberFormat($row['basic_salary']) . '" data-action="1" onclick="openUpdateWageData($(this))"><i class="fi-rr-pencil"></i></button>
                        </div>';
                })
                ->addIndexColumn()
                ->rawColumns(['level', 'basic_salary', 'action'])
                ->make();
            $tableDisable = Datatables::of($dataDisable)
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['level'],$row['basic_salary']]);
                })
                ->addColumn('level', function ($row) {
                    return '<label>' . $row['level'] . '</label><input class="form-control d-none w-75 m-auto input-maximum" value="' . $row['level'] . '"/>';
                })
                ->addColumn('basic_salary', function ($row) {
                    return '<label>' . $this->numberFormat($row['basic_salary']) . '</label><input class="form-control d-none text-right w-75 m-auto input-maximum" data-type="currency-edit" value="' . $this->numberFormat($row['basic_salary']) . '"/>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn seemt-btn-hover-green seemt-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE. '" data-status=" ' . $row['status'] . '" data-id=" ' . $row['id'] . '" data-level=" ' . $row['level'] . '" data-basic-salary="' . $this->numberFormat($row['basic_salary']) . '" data-action="1" onclick="changeStatusWage($(this))"><i class="fi-rr-check"></i></button>
                        </div>';
                })
                ->addIndexColumn()
                ->rawColumns(['level', 'basic_salary', 'action'])
                ->make();
            return [$tableEnable,$tableDisable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $id = ENUM_DIS_SELECTED;
        $level = $request->get('level');
        $basic_salary = $request->get('basic_salary');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_LEVEL_SALARY_CREATE);
        $body = [
            "id" => $id,
            "level" => $level,
            "basic_salary" => $basic_salary,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                        <button type="button" class="btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS. '" data- data-id=" ' .  $config['data']['id'] . '" data-level=" ' . $config['data']['level'] . '" data-basic-salary="' . $this->numberFormat($config['data']['basic_salary']) . '" onclick="changeStatusWage($(this))"><i class="fi-rr-cross"></i></button>
                        <button type="button" class="btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id=" ' . $config['data']['id'] . '" data-level=" ' . $config['data']['level'] . '" data-basic-salary="' . $this->numberFormat($config['data']['basic_salary']) . '" onclick="openUpdateWageData($(this))"><i class="fi-rr-pencil"></i></button>
                        </div>';
                $config['data']['basic_salary'] = $this->numberFormat($config['data']['basic_salary']);
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
            return $config;
        }catch (Exception $e){
            return $this->catchTemplate($config , $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $level = $request->get('level');
        $basic_salary = $request->get('basic_salary');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_LEVEL_SALARY_CREATE);
        $body = [
            "id" => $id,
            "level" => $level,
            "basic_salary" => $basic_salary,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $config['data']['action'] = '<div class="btn-group btn-group-sm">
                        <button type="button" class="btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS. '" data- data-id=" ' .  $config['data']['id'] . '" data-level=" ' . $config['data']['level'] . '" data-basic-salary="' . $this->numberFormat($config['data']['basic_salary']) . '" onclick="changeStatusWage($(this))"><i class="fi-rr-cross"></i></button>
                        <button type="button" class="btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id=" ' . $config['data']['id'] . '" data-level=" ' . $config['data']['level'] . '" data-basic-salary="' . $this->numberFormat($config['data']['basic_salary']) . '" onclick="openUpdateWageData($(this))"><i class="fi-rr-pencil"></i></button>
                        </div>';
            $config['data']['basic_salary'] = $this->numberFormat($config['data']['basic_salary']);
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
        }
        return $config;
    }
    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SALARY_LEVEL_CHANGE_STATUS, $id);
        $body=[];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try{
            if($config['status'] === 400 && count($config['data']) > 0) {
                $config['table_employee']=$this->drawDatatableEmployee( $config['data']);
            }
            return $config;
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }
    public function drawDatatableEmployee($data)
    {
        return DataTables::of($data)
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('action', function ($row) {
                return '<div class="btn-group btn-group-sm">
                        <button type="button" class="btn seemt-btn-hover-blue  waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL. '"   data-id=" ' . $row['id'] . '"  data-brand-id=" ' . $row['restaurant_brand_id'] . '"  onclick="openModalInfoEmployeeManage(' . $row['id'] . ')"><i class="fi-rr-eye"></i></button>
                        </div>';
            })
            ->addIndexColumn()
            ->make(true);
    }
}
