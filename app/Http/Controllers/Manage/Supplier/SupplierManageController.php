<?php

namespace App\Http\Controllers\Manage\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class SupplierManageController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }

        $active_nav = 'Quản lý nhà cung cấp';
        return view('manage.supplier.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $brand = $request->get('brand');
        $from = '';
        $to = '';
        $isTakeAll = ENUM_SELECTED;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BILL_LIABILITIES_GET_LIST, $brand, $branch, $isTakeAll, $from, $to);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $dataTable = DataTables::of($config['data']['list'])
                ->addColumn('total_order_amount', function ($row) {
                    $class = ($row['number_order'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="'. $class .'">'. $this->numberFormat($row['total_order_amount']) .'</label><br>
                            <label class="number-order '. $class .'">'. $this->numberFormat($row['number_order']. '<em> đơn hàng</em></label>');
                })
                ->addColumn('number_order', function ($row) {
                    return $this->numberFormat($row['number_order']);
                })
                ->addColumn('total_order_amount_return', function ($row) {
                    $class = ($row['number_order_return'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="'. $class .'">'. $this->numberFormat($row['total_order_amount_return']) .'</label><br>
                            <label class="number-order '. $class .'">'. $this->numberFormat($row['number_order_return']. '<em> đơn hàng</em></label>');
                })
                ->addColumn('number_order_return', function ($row) {
                    return $this->numberFormat($row['number_order_return']);
                })
                ->addColumn('total_order_amount_paid', function ($row) {
                    $class = ($row['number_order_paid'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="'. $class .'">'. $this->numberFormat($row['total_order_amount_paid']) .'</label><br>
                            <label class="number-order '. $class .'">'. $this->numberFormat($row['number_order_paid']. '<em> đơn hàng</em></label>');
                })
                ->addColumn('number_order_paid', function ($row) {
                    return $this->numberFormat($row['number_order_paid']);
                })
                ->addColumn('total_order_amount_waiting_payment', function ($row) {
                    $class = ($row['number_order_waiting_payment'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="'. $class .'">'. $this->numberFormat($row['total_order_amount_waiting_payment']) .'</label><br>
                            <label class="number-order '. $class .'">'. $this->numberFormat($row['number_order_waiting_payment']. '<em> đơn hàng</em></label>');
                })
                ->addColumn('number_order_waiting_payment', function ($row) {
                    return $this->numberFormat($row['number_order_waiting_payment']);
                })
                ->addColumn('total_order_amount_debt', function ($row) {
                    $class = ($row['number_debt'] === 0) ? 'number-order-hidden' : '';
                    return '<label class="'. $class .'">'. $this->numberFormat($row['total_order_amount_debt']) .'</label><br>
                            <label class="number-order '. $class .'">'. $this->numberFormat($row['number_debt']. '<em> đơn hàng</em></label>');
                })
                ->addColumn('number_debt', function ($row) {
                    return $this->numberFormat($row['number_debt']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['supplier_name'], $row['total_order_amount'], $row['number_order'], $row['total_order_amount_return'],
                        $row['number_order_return'], $row['total_order_amount_paid'], $row['number_order_paid'], $row['total_order_amount_waiting_payment'], $row['total_order_amount_debt'], $row['number_debt']]);
                })
                ->addColumn('supplier_name', function ($row) {
                    if ($row['is_handbook_supplier'] === ENUM_DIS_SELECTED) {
                        if ($row['status'] === ENUM_DIS_SELECTED) {
                            return
                                '<label>'. $row['supplier_name'] .'<br>
                                    <div class="d-flex">
                                        <div class="tag seemt-blue seemt-bg-blue d-flex">
                                             <i class="fi-rr-hastag"></i>
                                             <label class="m-0">' . TEXT_SYSTEM_SUPPLIER . '</label>
                                        </div>
                                        <div class="tag seemt-red seemt-bg-red d-flex">
                                             <i class="fi-rr-hastag"></i>
                                             <label class="m-0">Tạm ngưng</label>
                                        </div>
                                    </div>
                            </label>';
                        } else {
                            return
                                '<label>'. $row['supplier_name'] .'<br>
                                    <div class="tag seemt-green seemt-bg-green d-flex">
                                         <i class="fi-rr-hastag"></i>
                                         <label class="m-0">' . TEXT_SYSTEM_SUPPLIER . '</label>
                                    </div>
                                </label>';
                        }

                    } else {
                        if ($row['status'] === ENUM_DIS_SELECTED) {
                            return
                                '<label>'. $row['supplier_name'] .'<br>
                                    <div class="d-flex">
                                        <div class="tag seemt-blue seemt-bg-blue d-flex">
                                             <i class="fi-rr-hastag"></i>
                                             <label class="m-0">NCC Sổ Tay</label>
                                        </div>
                                        <div class="tag seemt-red seemt-bg-red d-flex">
                                             <i class="fi-rr-hastag"></i>
                                             <label class="m-0">Tạm ngưng</label>
                                        </div>
                                    </div>
                            </label>';
                        } else {
                            return
                                '<label>'. $row['supplier_name'] .' <br>
                                    <div class="tag seemt-blue seemt-bg-blue d-flex">
                                         <i class="fi-rr-hastag"></i>
                                         <label class="m-0">NCC Sổ Tay</label>
                                    </div>
                                </label>';
                        }

                    }
                })
                ->addColumn('action', function ($row){
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailSupplierManage(' . $row['supplier_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                            </div>';
                })
                ->rawColumns(['action', 'supplier_name', 'total_order_amount','total_order_amount_return','total_order_amount_paid','total_order_amount_waiting_payment','total_order_amount_debt'])
                ->addIndexColumn()
                ->make();
            $dataTotal = [
                'total_record_done' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'number_order_paid'))),
                'total_amount_done' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_order_amount_paid'))),
                'total_record_return' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'number_order_return'))),
                'total_amount_return' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_order_amount_return'))),
                'total_record_confirm' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'number_order_waiting_payment'))),
                'total_amount_confirm' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_order_amount_waiting_payment'))),
                'total_record_session' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'number_order'))),
                'total_amount_session' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_order_amount'))),
                'total_record_payment' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'number_debt'))),
                'total_amount_payment' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'total_order_amount_debt')))
            ];
            return [$dataTable, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $supplier = $request->get('supplier');
        $brand = $request->get('brand');
        $branch = (int)$request->get('branch');
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_GET_DETAIL_ALL, $supplier, $brand, $branch);
        $body = null;
        $requestDetail = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_GET_MATERIAL_ALL, $supplier, $brand, $branch);
        $requestMaterial = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $page = ENUM_DEFAULT_PAGE;
        $from = '';
        $to = '';
        $is_get_debt_amount = ENUM_GET_ALL;
        $key = '';
        $status = ENUM_GET_ALL;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $api =sprintf(API_REASON_ADDITION_FEE_GET_SUPPLIER_ORDER, $branch, $supplier, $is_get_debt_amount, $from, $to, $page, $limit, $key);
        $requestOrder = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_GET_LIST_CONTACT, $supplier,$status);
        $requestContact = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];

        $configAll = $this->callApiMultiGatewayTemplate([$requestDetail, $requestMaterial, $requestOrder, $requestContact]);
            try {
            $config = $configAll[0];
            $dataDetail = [
                'name' => $config['data']['name'],
                'avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) .  $config['data']['avatar'],
                'type' => ($config['data']['restaurant_id'] === ENUM_DIS_SELECTED) ? TEXT_SYSTEM_SUPPLIER : TEXT_RESTAURANT_SUPPLIER,
                'created_at' => $config['data']['created_at'],
                'phone' => $config['data']['phone'],
                'address' => $config['data']['address'],
                'website' => $config['data']['website'],
                'description' => $config['data']['description'],
                'email' => $config['data']['email'],
                'tax_code' => $config['data']['tax_code'],
                'count_total_order' => $this->numberFormat($config['data']['count_total_order']),
                'total_order_amount' => $this->numberFormat($config['data']['total_order_amount']),
                'count_total_order_complete' => $this->numberFormat($config['data']['count_total_order_complete']),
                'total_order_amount_complete' => $this->numberFormat($config['data']['total_order_amount_complete']),
                'count_total_order_return' => $this->numberFormat($config['data']['count_total_order_return']),
                'total_order_amount_return' => $this->numberFormat($config['data']['total_order_amount_return']),
                'count_total_order_processing' => $this->numberFormat($config['data']['count_total_order_processing']),
                'total_order_amount_processing' => $this->numberFormat($config['data']['total_order_amount_processing']),
                'count_total_order_debt' => $this->numberFormat($config['data']['count_total_order_debt']),
                'total_order_amount_debt' => $this->numberFormat($config['data']['total_order_amount_debt']),
                'id' => $supplier,
                'branch' => $branch,
            ];

            $config = $configAll[1];
            $collection = collect($config['data']['list']);
            $dataMaterialUsing = $collection->where('is_selected', ENUM_SELECTED)->all();
            $dataAllMaterial = $collection->where('status', ENUM_SELECTED)->all();
            $dataTableMaterialUsing = $this->drawTableMaterialSupplier($dataMaterialUsing);
            $dataTableAllMaterial = $this->drawTableMaterialSupplier($dataAllMaterial);
            $totalMaterialUsing = count($dataMaterialUsing);
            $totalAllMaterial = count($dataAllMaterial);

            $config = $configAll[2];
            $collection = collect($config['data']['list']);
            $dataOrderWaiting = $collection->where('is_debt', ENUM_DIS_SELECTED)->toArray();
            $dataOrderDebt = $collection->where('is_debt', ENUM_SELECTED)->toArray();
            $tableOrderWaiting = $this->drawTableOrderSupplier($dataOrderWaiting);
            $tableOrderDeb = $this->drawTableOrderSupplier($dataOrderDebt);
            $config = $configAll[3];
            $dataContact = collect($config['data']['list'])->where('status',ENUM_SELECTED );
            $contact = DataTables::of($dataContact)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" data-id="' . $row['id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" onclick="openModalUpdateContactSupplier($(this))"><span class="icofont icofont-ui-edit"></span></button>
                            </div>';
                })
                ->addColumn('email', function ($row) {
                    return $row['email'] === '' ? '---' : $row['email'];
                })
                ->addColumn('contact_name', function ($row) {
                    return '<label class="title-name-new-table" >' . $row['contact_name'] . '<br><label class="label-new-table"><i class="zmdi zmdi-account-circle mr-1"></i>'.$row['supplier_role_name'].'</label></label>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate([$row['contact_name'], $row['phone'], $row['email'], $row['supplier_role_name']]);
                })
                ->rawColumns(['contact_name'])
                ->addIndexColumn()
                ->make(true);
            $dataTotal = [
                'total_contact' => $this->numberFormat(count($dataContact)),
                'total_material_using' => $this->numberFormat($totalMaterialUsing),
                'total_all_material' => $this->numberFormat($totalAllMaterial),
                'total_waiting' => $this->numberFormat(count($dataOrderWaiting)),
                'total_debt' => $this->numberFormat(count($dataOrderDebt)),
            ];
            $dataTotalWaiting = [
                'total_amount_in_waiting' => $this->numberFormat(array_sum(array_column($dataOrderWaiting, 'amount'))),
                'total_amount_out_waiting' => $this->numberFormat((array_sum(array_column($dataOrderWaiting, 'total_amount_of_return_material_reality')))),
                'total_amount_payment_waiting' => $this->numberFormat(array_sum(array_column($dataOrderWaiting, 'total_amount_reality'))),
            ];
            $dataTotalDebt = [
                'total_amount_in_debt' => $this->numberFormat(array_sum(array_column($dataOrderDebt, 'amount'))),
                'total_amount_out_debt' => $this->numberFormat((array_sum(array_column($dataOrderDebt, 'total_amount_reality')) - array_sum(array_column($dataOrderDebt, 'restaurant_debt_amount')))),
                'total_amount_payment_debt' => $this->numberFormat(array_sum(array_column($dataOrderDebt, 'restaurant_debt_amount'))),
            ];
            return [$dataDetail, $dataTableMaterialUsing, $dataTableAllMaterial, $tableOrderWaiting, $tableOrderDeb, $contact, $dataTotal, $configAll, $dataTotalWaiting, $dataTotalDebt];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function info(Request $request)
    {
        $supplier = $request->get('supplier');
        $brand = $request->get('brand');
        $branch = (int)$request->get('branch');
        $api = sprintf(API_SUPPLIER_DATA_OF_RESTAURANT_GET_DETAIL_ALL, $supplier, $brand, $branch);
        $body = null;
        $requestDetail = [
            'project' => ENUM_PROJECT_ID_JAVA_DASHBOARD,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];


        $configAll = $this->callApiMultiGatewayTemplate2([$requestDetail]);
        try {
            $config = $configAll[0];
            $dataDetail = [
                'name' => $config['data']['name'],
                'avatar' => Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA) .  $config['data']['avatar'],
                'type' => ($config['data']['restaurant_id'] === ENUM_DIS_SELECTED) ? TEXT_SYSTEM_SUPPLIER : TEXT_RESTAURANT_SUPPLIER,
                'created_at' => $config['data']['created_at'],
                'phone' => $config['data']['phone'],
                'address' => $config['data']['address'],
                'website' => $config['data']['website'],
                'description' => $config['data']['description'],
                'email' => $config['data']['email'],
                'tax_code' => $config['data']['tax_code'],
                'count_total_order' => $this->numberFormat($config['data']['count_total_order']),
                'total_order_amount' => $this->numberFormat($config['data']['total_order_amount']),
                'count_total_order_complete' => $this->numberFormat($config['data']['count_total_order_complete']),
                'total_order_amount_complete' => $this->numberFormat($config['data']['total_order_amount_complete']),
                'count_total_order_return' => $this->numberFormat($config['data']['count_total_order_return']),
                'total_order_amount_return' => $this->numberFormat($config['data']['total_order_amount_return']),
                'count_total_order_processing' => $this->numberFormat($config['data']['count_total_order_processing']),
                'total_order_amount_processing' => $this->numberFormat($config['data']['total_order_amount_processing']),
                'count_total_order_debt' => $this->numberFormat($config['data']['count_total_order_debt']),
                'total_order_amount_debt' => $this->numberFormat($config['data']['total_order_amount_debt']),
                'id' => $supplier,
                'branch' => $branch,
            ];

            return [$dataDetail, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }


    public function drawTableMaterialSupplier($data)
    {
        return DataTables::of($data)
            ->addColumn('supplier_cost_price', function ($row) {
                return $this->numberFormat($row['supplier_cost_price']);
            })
            ->addColumn('supplier_wholesale_price', function ($row) {
                return $this->numberFormat($row['supplier_wholesale_price']);
            })
            ->addColumn('supplier_retail_price', function ($row) {
                return $this->numberFormat($row['supplier_retail_price']);
            })
            ->addColumn('supplier_wholesale_price_quantity', function ($row) {
                return $this->numberFormat($row['supplier_wholesale_price_quantity']);
            })
            ->addColumn('supplier_material_name', function ($row) {
                $unit_name = '<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                         <i class="fi-rr-hastag"></i>
                                                                         <label class="m-0">' . $row['supplier_material_unit_full_name'] . '</label>
                                                                    </div>';
                if (mb_strlen($row['supplier_material_name']) > 30) {
                    return mb_substr($row['supplier_material_name'], 0, 27) . '...'. '<br>'. $unit_name;
                } else {
                    return $row['supplier_material_name']. '<br>'. $unit_name;
                }
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate([$row['supplier_material_name'], $row['supplier_material_unit_full_name'], $row['material_unit_conversion_rate'], $row['restaurant_material_name'], $row['supplier_material_category_name'], $row['supplier_cost_price']]);
            })
            ->rawColumns(['supplier_material_name'])
            ->addIndexColumn()
            ->make(true);
    }

    public function drawTableOrderSupplier($data)
    {
        return DataTables::of($data)
            ->addColumn('return_amount', function ($row) {
                return $this->numberFormat($row['total_amount_of_return_material_reality']);
            })
            ->addColumn('employee_created_full_name', function ($row) {
                return '<img onerror="imageDefaultOnLoadError($(this))" src="' . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_created_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . $row['employee_created_avatar'] . "'" . ')"/>
                        <label class="title-name-new-table">' . $row['employee_created_full_name'] . '<br>
                        <label class="label-new-table">
                        <i class="zmdi zmdi-account-circle mr-1"></i>' . $row['employee_created_role_name'] . '</label></label>';
            })
            ->addColumn('total_amount', function ($row) {
                return $this->numberFormat($row['amount']);
            })
            ->addColumn('total_amount_reality', function ($row) {
                return $this->numberFormat($row['total_amount_reality']);
            })
            ->addColumn('created_at', function ($row) {
                return '<span class="d-inline-block">'. $this->convertDateTime($row['created_at']) .'</span>';
            })
            ->addColumn('action', function ($row){
                return '<div class="btn-group btn-group-sm">
                              <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $row['id'] . ' ,' . $row['branch_id'] . ', ' . $row['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '"><i class="fi-rr-eye"></i></button>
                         </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate([$row['code'], $row['employee_created_full_name'], $row['total_material'], $row['total_amount_reality'], $row['restaurant_debt_amount'], $row['created_at'],]);
            })
            ->rawColumns(['action','employee_created_full_name','return_amount', 'created_at'])
            ->addIndexColumn()
            ->make(true);
    }
}

