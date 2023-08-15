<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Exception;

class BankController extends Controller
{
    public function index()
    {
        $active_nav = 'Thông tin tài khoản';
        return view('setting.bank.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('restaurant_brand_id');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SETTING_BANK_GET_DATA, $brand);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $collect = collect($config['data']['list']);
            $dataEnable = $collect->where('status', ENUM_SELECTED)->toArray();
            $dataDisable = $collect->where('status', ENUM_DIS_SELECTED)->toArray();
            $tableEnable = Datatables::of($dataEnable)
                ->addColumn('checkbox', function ($row) {
                    $check = ($row['is_default'] === 1) ? 'checked' : '';
                    $pointer = ($row['is_default'] === 1) ? 'pointer-none' : '';
                    return '<div class="form-group validate-group " style="margin: 0 !important;">
                        <div class="form-validate-checkbox m-0 p-0" >
                            <div class="checkbox-form-group justify-content-center">
                                <input ' . $check . ' class="m-0 ' . $pointer . ' radio" data-id="' . $row['id'] . '"  name="check" onclick="assignBank($(this))" type="checkbox">
                             </div>
                        </div>
                    </div>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusBank($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateBank($(this))" data-id="' . $row['id'] . '" data-identify="' . $row['bank_identify_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
            $tableDisable = Datatables::of($dataDisable)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusBank($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_STATUS_ENABLE . '"><i class="fi-rr-check"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateBank($(this))" data-id="' . $row['id'] . '" data-identify="' . $row['bank_identify_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['checkbox', 'action'])
                ->make(true);

            $dataTotal = [
                'total_record_enable' => count($dataEnable),
                'total_record_disable' => count($dataDisable),
            ];
            return [$tableEnable, $tableDisable, $dataTotal, $config];
        } catch (Exception $e) {
            $this->catchTemplate($config, $e);
        }
    }

    public function bank()
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = API_SETTING_BANK_GET_BANK;
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $select = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';;
            foreach ($config['data'] as $db) {
                $select .= '<option value="' . $db['bin'] . '">' . $db['name'] . ' - ' . $db['short_name'] . '</option>';
            };
            return [$select, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function searchBankNumber(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $number = $request->get('number');
        $api = API_SETTING_BANK_POST_SEARCH_BANK_NUMBER;
        $body = [
            'bin' => $request->get('bin'),
            'account_number' => $number,
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $config['data']['account_name'] = '<li class="item-search-customer" data-bank-number="' . $number . '" data-account-name="' . $config['data']['account_name'] . '" data-id="' . $number . '">
                                            <figure><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $number . '" class="avatar-search-customer" ></figure>
                                            <div class="friend-meta">
                                                <h4>' . $config['data']['account_name'] . '</h4>
                                                <p class="seemt-orange" style="font-size: 10px !important;">' . $number . '</p>
                                            </div>
                                        </li>';
        }
        return $config;
    }

    public function create(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_SETTING_BANK_POST_CREATE;
        $body = [
            'restaurant_brand_id' => $request->get('restaurant_brand_id'),
            'bank_identify_id' => $request->get('bank_identify_id'),
            'bank_name' => $request->get('bank_name'),
            'bank_number' => $request->get('bank_number'),
            'bank_account_name' => $request->get('bank_account_name'),
            'is_default' => $request->get('is_default'),
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $check = ($config['data']['is_default'] === 1) ? 'checked' : '';
            $pointer = ($config['data']['is_default'] === 1) ? 'pointer-none' : '';
            $config['data']['checkbox'] = '<div class="form-group validate-group " style="margin: 0 !important;">
                        <div class="form-validate-checkbox m-0 p-0" >
                            <div class="checkbox-form-group justify-content-center">
                                <input ' . $check . ' class="m-0 ' . $pointer . ' radio" data-id="' . $config['data']['id'] . '"  name="check" onclick="assignBank($(this))" type="checkbox">
                             </div>
                        </div>
                    </div>';
            $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusBank($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateBank($(this))" data-id="' . $config['data']['id'] . '" data-identify="' . $config['data']['bank_identify_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
        }
        return $config;
    }

    public function update(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SETTING_BANK_POST_UPDATE, $request->get('id'));
        $body = [
            'restaurant_brand_id' => $request->get('restaurant_brand_id'),
            'bank_identify_id' => $request->get('bank_identify_id'),
            'bank_name' => $request->get('bank_name'),
            'bank_number' => $request->get('bank_number'),
            'bank_account_name' => $request->get('bank_account_name'),
            'is_default' => $request->get('is_default'),
            'confirmed' => 1
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        return $config;
    }

    public function assign(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SETTING_BANK_POST_ASSIGN, $request->get('id'));
        $body = [
            'restaurant_brand_id' => $request->get('restaurant_brand_id'),
            'confirmed' => 1
        ];
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        return $config;
    }

    public function changeStatus(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SETTING_BANK_POST_CHANGE_STATUS, $request->get('id'));
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            if ($config['data']['status'] === ENUM_SELECTED) {
                $check = ($config['data']['is_default'] === 1) ? 'checked' : '';
                $pointer = ($config['data']['is_default'] === 1) ? 'pointer-none' : '';
                $config['data']['checkbox'] = '<div class="form-group validate-group " style="margin: 0 !important;">
                        <div class="form-validate-checkbox m-0 p-0" >
                            <div class="checkbox-form-group justify-content-center">
                                <input ' . $check . ' class="m-0 ' . $pointer . ' radio" data-id="' . $config['data']['id'] . '"  name="check" onclick="assignBank($(this))" type="checkbox">
                             </div>
                        </div>
                    </div>';
                $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusBank($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateBank($(this))" data-id="' . $config['data']['id'] . '" data-identify="' . $config['data']['bank_identify_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
            } else {
                $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusBank($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_STATUS_ENABLE . '"><i class="fi-rr-check"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateBank($(this))" data-id="' . $config['data']['id'] . '" data-identify="' . $config['data']['bank_identify_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
            }

            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
        }
        return $config;
    }
}
