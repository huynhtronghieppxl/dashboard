<?php

namespace App\Http\Controllers\BuildData\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class SupplierDataController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Tạo & gán NL NCC sổ tay';
        return view('build_data.supplier.supplier.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $isTakeMySupplier = ENUM_GET_ALL;
        $isRestaurantSupplier = ENUM_SELECTED;
        $isExcludeUnassignSystemSupplier = ENUM_SELECTED;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $status = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_GET_ALL_SUPPLIER, $isTakeMySupplier, $isRestaurantSupplier, $isExcludeUnassignSystemSupplier, $page, $limit, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $supplierUseCons = Config::get("constants.type.TypeSupplier.SUPPLIER_USE");
        $supplierNotUseCons = Config::get("constants.type.TypeSupplier.SUPPLIER_NOT_USE");
        $supplierDisableCons = Config::get("constants.type.TypeSupplier.SUPPLIER_DISABLE");
        try {
            $collection = collect($config['data']['list']);
            $supplierUse = $collection
                ->where('is_take_my_supplier', ENUM_SELECTED)
                ->where('status', ENUM_SELECTED)
                ->all();
            $supplierNotUse = $collection
                ->where('is_restaurant_supplier', ENUM_SELECTED)
                ->where('is_take_my_supplier', ENUM_DIS_SELECTED)
                ->where('status', ENUM_SELECTED)
                ->all();
            $dataDisable = $collection
                ->where('is_restaurant_supplier', ENUM_SELECTED)
                ->where('status', ENUM_DIS_SELECTED)
                ->all();
            $dataTableEnableUseSupplier = Datatables::of($supplierUse)
                ->addColumn('name', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    if ($row['is_restaurant_supplier'] === ENUM_SELECTED) {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" class="img-inline-name-data-table">
                                <label class="">' . $row['name'] . '</label>';
                    } else {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" class="img-inline-name-data-table">
                                <label class="">' . $row['name'] . '<br><label class="label label-success">' . TEXT_SYSTEM_SUPPLIER . '</label></label>';
                    }
                })
                ->addColumn('action', function ($row) use ($supplierUseCons){
                    if ($row['is_restaurant_supplier'] === ENUM_SELECTED) {
                        return '<div class="btn-group btn-group-sm float-right">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-type="' . $supplierUseCons . '" data-name="' . $row['name'] . '" data-address="' . $row['address'] . '" data-phone="' . $row['phone'] . '" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONTACT . '" onclick="openModalContactSupplierData($(this))"><i class="fi-rr-book"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-type="' . $supplierUseCons . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-name="' . $row['name'] . '" onclick="changeStatusSupplierData($(this))"><i class="fi-rr-cross"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-type="' . $supplierUseCons . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id="' . $row['id'] . '" onclick="openModalUpdateSupplierData($(this))"><i class="fi-rr-pencil"></i></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-type="' . $supplierUseCons . '" onclick="openDetailSupplierManage(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';

                    } else {
                        return '<div class="btn-group btn-group-sm float-right">
                                <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-type="' . $supplierUseCons . '" onclick="openDetailSupplierManage(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                    }
                })
                ->addColumn('type', function ($row) {
                    if ($row['is_restaurant_supplier'] === ENUM_SELECTED) {
                        return TEXT_RESTAURANT_SUPPLIER;
                    } else {
                        return TEXT_SYSTEM_SUPPLIER;
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    $role = '';
                    if ($row['is_restaurant_supplier'] === ENUM_SELECTED) {
                        $role = TEXT_RESTAURANT_SUPPLIER;
                    } else {
                        $role = TEXT_SYSTEM_SUPPLIER;
                    }
                    return $this->keySearchDatatableTemplate([$row['name'], $row['phone'], $role]);
                })
                ->rawColumns(['action', 'name'])
                ->addIndexColumn()
                ->make(true);

            $dataTableEnableNotUseSupplier = Datatables::of($supplierNotUse)
                ->addColumn('name', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    $row['is_restaurant_supplier'] === ENUM_SELECTED;
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" class="img-inline-name-data-table">
                            <label>' . $row['name'] . '</label>';
                })
                ->addColumn('action', function ($row) use ($supplierNotUseCons) {
                    $row['is_restaurant_supplier'] === ENUM_SELECTED;
                    return '<div class="btn-group btn-group-sm float-right">
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-type="' . $supplierNotUseCons . '" data-name="' . $row['name'] . '" data-address="' . $row['address'] . '" data-phone="' . $row['phone'] . '" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONTACT . '" onclick="openModalContactSupplierData($(this))"><i class="fi-rr-book"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-type="' . $supplierNotUseCons . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-name="' . $row['name'] . '" onclick="changeStatusSupplierData($(this))"><i class="fi-rr-cross"></i></button>
                                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-type="' . $supplierNotUseCons . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id="' . $row['id'] . '" onclick="openModalUpdateSupplierData($(this))  "><i class="fi-rr-pencil"></i></button>
                                    <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-type="' . $supplierNotUseCons . '" onclick="openDetailSupplierManage(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                </div>';
                })
                ->addColumn('type', function ($row) {
                    if ($row['is_restaurant_supplier'] === ENUM_SELECTED) {
                        return TEXT_RESTAURANT_SUPPLIER;
                    } else {
                        return TEXT_SYSTEM_SUPPLIER;
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'name'])
                ->addIndexColumn()
                ->make(true);

            $dataTableDisable = Datatables::of($dataDisable)
                ->addColumn('name', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    ($row['is_restaurant_supplier'] === ENUM_SELECTED);
                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')" class="img-inline-name-data-table">
                            <label>' . $row['name'] . '</label>';
                })
                ->addColumn('action', function ($row) use ($supplierDisableCons) {
                    $row['is_restaurant_supplier'] === ENUM_SELECTED;
                    return '<div class="btn-group btn-group-sm text-center">
                                     <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-type="' . $supplierDisableCons . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-name="' . $row['name'] . '" onclick="changeStatusSupplierData($(this))"><i class="fi-rr-check"></i></span></button>
                                     <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-type="' . $supplierDisableCons . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id="' . $row['id'] . '" onclick="openModalUpdateSupplierData($(this))"><i class="fi-rr-pencil"></i></button>
                                     <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" data-type="' . $supplierDisableCons . '" onclick="openDetailSupplierManage(' . $row['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                 </div>';
                })
                ->addColumn('type', function ($row) {
                    if ($row['is_restaurant_supplier'] === ENUM_SELECTED) {
                        return TEXT_RESTAURANT_SUPPLIER;
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'name'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total_record_enable' => $this->numberFormat(count($supplierUse)),
                'total_record_not_use_supplier' => $this->numberFormat((count($supplierNotUse))),
                'total_record_disable' => $this->numberFormat(count($dataDisable))
            ];

            return [$dataTableEnableUseSupplier, $dataTableEnableNotUseSupplier, $dataTableDisable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $supplierID = $request->get('supplier');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_GET_DETAIL, $supplierID);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $configs['detail_supplier'] = $config;
            $data = $config['data'];
            if ($data['status'] === ENUM_SELECTED) {
                $data['status_text'] = '<label class="label label-lg label-success">' . TEXT_STATUS_ENABLE . '</label>';
            } else {
                $data['status_text'] = '<label class="label label-lg label-inverse">' . TEXT_DISABLE_STATUS . '</label>';
            }

            $dataDetail = collect($data)->only('name', 'prefix', 'phone', 'address', 'status_text', 'website', 'description', 'email', 'tax_code')->all();

            $tableContact = Datatables::of($data['contacts'])
                ->addIndexColumn()
                ->make(true);
            $totalRecordContact = $this->numberFormat(count($data['contacts']));

            $isLiabilities = ENUM_LIABILITIES_GET_LIABILITIES; //1
            $page = ENUM_DEFAULT_PAGE; //1
            $from = '';
            $to = '';
            $branchID = ENUM_GET_ALL;

            $project = ENUM_PROJECT_ID_ORDER;
            $method = ENUM_METHOD_GET;
            $api = sprintf(API_SUPPLIER_DATA_GET_LIABILITIES_DETAIL_IN_INVENTORY, $supplierID, $branchID, $isLiabilities, $page, $from, $to);
            $body = null;
            $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
            $configs['liabilities'] = $config;
            $data = $config['data'];
            $tableLiabilities = Datatables::of($data['list'])
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="detailTable(' . $row['id'] . ',' . $row['branch']['id'] . ')" ><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            $totalRecordLiabilities = $this->numberFormat(count($data['list']));
            $totalLiabilities = ($data['sum'] === null) ? 0 : $this->numberFormat($data['sum']['total_return_amount']);

            $project = ENUM_PROJECT_ID_ORDER;
            $method = ENUM_METHOD_GET;
            $api = sprintf(API_SUPPLIER_GET_MATERIAL, $supplierID);
            $body = null;
            $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
            $data = $config['data'];
            $configs['material'] = $config;
            $dataMaterial = array_values(collect($data)->where('status', ENUM_STATUS_GET_ACTIVE)->toArray());

            $tableMaterial = DataTables::of($dataMaterial)
                ->addColumn('price', function ($row) {
                    return $this->numberFormat($row['cost_price']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm text-center">
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' . $row['id'] . ')" ><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['category', 'action'])
                ->addIndexColumn()
                ->make(true);

            $dataTotal = [
                'total_record_contact' => $totalRecordContact,
                'total_record_liabilities' => $totalRecordLiabilities,
                'total_liabilities' => $totalLiabilities,
                'total_record_material' => $this->numberFormat(count($dataMaterial)),
            ];

            return [$dataDetail, $tableContact, $tableLiabilities, $tableMaterial, $dataTotal, $configs];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_POST_CREATE, ENUM_ID_DEFAULT);
        $body = [
            "id" => ENUM_ID_DEFAULT,
            "name" => $request->get('name'),
            "phone" => $request->get('phone'),
            "adress" => $request->get('address'),
            "status" => ENUM_SELECTED,
            "tax_code" => $request->get('tax'),
            "website" => $request->get('website'),
            "description" => $request->get('des'),
            "email" => $request->get('email'),
            "avatar" => $request->get('avatar')
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                $project = ENUM_PROJECT_ID_ORDER;
                $method = ENUM_METHOD_POST;
                $api = sprintf(API_SUPPLIER_POST_ASSIGN_TO_RESTAURANT);
                $body = [
                    "supplier_ids" => [$config['data']['id']],
                    "remove_supplier_ids" => []
                ];
                $configAssign = $this->callApiGatewayTemplate2($project, $method, $api, $body);
                try {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    if ($config['data'] != null) {
                        $config['data']['action'] = '<div class="btn-group btn-group-sm text-center">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-name="' . $config['data']['name'] . '" data-address="' . $config['data']['address'] . '" data-phone="' . $config['data']['phone'] . '" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CONTACT . '" onclick="openModalContactSupplierData($(this))"><i class="fi-rr-book"></i></button>

                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-name="' . $config['data']['name'] . '" onclick="changeStatusSupplierData($(this))"><i class="fi-rr-cross"></i></button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id="' . $config['data']['id'] . '" onclick="openModalUpdateSupplierData($(this))"><i class="fi-rr-pencil"></i></button>
                                            <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailSupplierManage(' . $config['data']['id'] . ')"  data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                                        </div>';
                        $config['data']['name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['avatar'] . '" onclick="modalImageComponent(' . "'" . $domain . $config['data']['avatar'] . "'" . ')" class="img-inline-name-data-table">
                                <label class="">' . $config['data']['name'] . '</label>';
                    }
                    $config['assign'] = $configAssign;
                    $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                    return $config;
                } catch (Exception $e) {
                    return $this->catchTemplate($config, $e);
                }
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function getlistRoleSupplier(Request $request)
    {
        $id = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_GET_ROLE, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try{
        $data_role = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';
        foreach ($config['data'] as $data) {
            $data_role .= '<option value="' . $data['id'] . '">' . $data['name'] . '</option>';
        }
        return [$data_role, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function dataUpdate(Request $request)
    {
        $supplierID = $request->get('supplier');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_GET_DETAIL, $supplierID);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $config['data']['status_text'] = $config['data']['status'] === ENUM_SELECTED ?
                '<div class="d-flex status-new seemt-green seemt-border-green" style="display: inline !important; max-width: max-content;">
                                      <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                      <label class="m-0">' . TEXT_STATUS_ENABLE . '</label>
                                     </div>' :
                '<div class="d-flex status-new seemt-red seemt-border-red" style="display: inline !important; max-width: max-content;">
                                      <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                      <label class="m-0">' . TEXT_DISABLE_STATUS . '</label>
                                     </div>';
            if ($config['data']['avatar'] != '') {
                $config['data']['avatar_supplier'] = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) . $config['data']['avatar'];
            } else $config['data']['avatar_supplier'] = '/images/tms/default.jpeg';
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('supplier');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_POST_CREATE, $id);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $body = [
            "id" => $id,
            "name" => ($request->get('name')),
            "phone" => ($request->get('phone')),
            "adress" => ($request->get('address')),
            "status" => $request->get('status'),
            "tax_code" => ($request->get('tax')),
            "website" => ($request->get('website')),
            "description" => ($request->get('des')),
            "email" => ($request->get('email')),
            "contacts" => $request->get('contact'),
            "avatar" => ($request->get('avatar'))
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $config['data']['name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $config['data']['avatar'] . '" onclick="modalImageComponent(' . "'" . $domain . $config['data']['avatar'] . "'" . ')" class="img-inline-name-data-table">
                                <label class="">' . $config['data']['name'] . '</label>';
        return $config;
    }

    public function changeStatus(Request $request)
    {
        $id = ($request->get('id'));
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_POST_CHANGE_STATUS, $id);
        $body = ["id" => $id];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try{
        if ($config['status'] === 205) {
            $table_list_order_not_complete = DataTables::of($config['data'])
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                             <button type="button" class="btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $row['id'] . ')" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Xem chi tiết"><i class="fi-rr-eye"></i></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            $config['data'] = $table_list_order_not_complete;
        } else {
            $config['data'] = $config;
        }
        return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataContact(Request $request)
    {
        $id = $request->get('supplier_id');
        $status = $request->get('status');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_GET_LIST_CONTACT, $id, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $contact = DataTables::of($config['data']['list'])
                ->addColumn('action', function ($row) {
                    $disable = TEXT_DISABLE_STATUS;
                    $enable = TEXT_ENABLE;
                    $update = TEXT_UPDATE;
                    if ($row['status'] === ENUM_SELECTED) {
                        return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '" onclick="changeStatusContactSupplierData($(this))"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" onclick="openModalUpdateContactSupplier($(this))"><i class="fi-rr-pencil"></i></button>
                             </div>';
                    } else {
                        return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" onclick="changeStatusContactSupplierData($(this))"><i class="fi-rr-check"></i></span></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" onclick="openModalUpdateContactSupplier($(this))"><i class="fi-rr-pencil"></i></button>
                             </div>';
                    }
                })
                ->addColumn('email', function ($row) {
                    return $row['email'] === '' ? '---' : $row['email'];
                })
                ->addColumn('supplier_role_name', function ($row) {
                    return $row['supplier_role_name'];
                })
                ->addColumn('contact_name', function ($row) {
                    return '<label class="title-name-new-table">
                                ' . $row['contact_name'] . '<br />
                                <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $row['supplier_role_name'] . '</label>
                            </label>';
                })
                ->addColumn('status', function ($row) {
                    if ($row['status'] === 0) {
                        return '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_DISABLE_STATUS . '</label>
                                </div>';
                    } else {
                        return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_STATUS_ENABLE . '</label>
                                </div>';
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'status', 'contact_name',])
                ->addIndexColumn()
                ->make(true);
            return [$contact, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function createContact(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $role = $request->get('role');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_POST_CREATE_CONTACT);
        $body = [
            "supplier_id" => $id,
            "contact_name" => $name,
            "phone" => $phone,
            "email" => $email,
            "supplier_role_id" => $role
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === Config::get('constants.type.status.STATUS_SUCCESS')) {
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
                $disable = TEXT_DISABLE_STATUS;
                $enable = TEXT_ENABLE;
                $update = TEXT_UPDATE;
                if ($config['data']['status'] === ENUM_SELECTED) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '" onclick="changeStatusContactSupplierData($(this))"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" onclick="openModalUpdateContactSupplier($(this))"><i class="fi-rr-pencil"></i></button>
                             </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" onclick="changeStatusContactSupplierData($(this))"><i class="fi-rr-check"></i></span></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" onclick="openModalUpdateContactSupplier($(this))"><i class="fi-rr-pencil"></i></button>
                             </div>';
                }
                $config['data']['email'] = $config['data']['email'] === '' ? '---' : $config['data']['email'];
                $config['data']['contact_name'] = '<label class="title-name-new-table">
                                ' . $config['data']['contact_name'] . '<br />
                                <label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>' . $config['data']['supplier_role_name'] . '</label>
                            </label>';
                if ($config['data']['status'] === 0) {
                    $config['data']['status'] = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_DISABLE_STATUS . '</label>
                                </div>';
                } else {
                    $config['data']['status'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_STATUS_ENABLE . '</label>
                                </div>';
                }
            }
            return $config;
        }catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataUpdateContact(Request $request)
    {
        $id = $request->get('id');
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_GET_DETAIL_UPDATE_CONTACT, $id);
        $body = null;
        $requestUpdateContact = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $status = ENUM_SELECTED;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_GET_ROLE, $status);
        $body = null;
        $requestRoleSupplier = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $configAll = $this->callApiMultiGatewayTemplate2([$requestUpdateContact, $requestRoleSupplier]);
        try {
            $data_role = '';
            foreach ($configAll[1]['data'] as $data) {
                if ($configAll[0]['data']['supplier_role_id'] == $data['id']) {
                    $data_role .= '<option value="' . $data['id'] . '" selected>' . $data['name'] . '</option>';
                } else {
                    $data_role .= '<option value="' . $data['id'] . '">' . $data['name'] . '</option>';
                }
            }
            return [$configAll[0], $data_role];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function updateContact(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $role = $request->get('role');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_POST_UPDATE_CONTACT, $id);
        $body = [
            "supplier_id" => $id,
            "contact_name" => $name,
            "phone" => $phone,
            "email" => $email,
            "supplier_role_id" => $role
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        return $config;
    }

    public function changeStatusContact(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_POST_CHANGE_STATUS_CONTACT, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try{
        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
            $enable = TEXT_ENABLE;
            $disable = TEXT_DISABLE_STATUS;
            $update = TEXT_UPDATE;
            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            if ($config['data']['status'] === ENUM_SELECTED) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '" onclick="changeStatusContactSupplierData($(this))"><i class="fi-rr-cross"></i></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" onclick="openModalUpdateContactSupplier($(this))"><i class="fi-rr-pencil"></i></button>
                             </div>';
            } else {
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" onclick="changeStatusContactSupplierData($(this))"><i class="fi-rr-check"></i></span></button>
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="' . $config['data']['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '" onclick="openModalUpdateContactSupplier($(this))"><i class="fi-rr-pencil"></i></button>
                             </div>';
            }
            if ($config['data']['status'] === 0) {
                $config['data']['status'] = '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_DISABLE_STATUS . '</label>
                                </div>';
            } else {
                $config['data']['status'] = '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                <label class="m-0">' . TEXT_STATUS_ENABLE . '</label>
                                </div>';
            }
        }
        return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
