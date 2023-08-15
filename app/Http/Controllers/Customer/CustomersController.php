<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\DataTables;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'MARKETING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Danh sách khách hàng';
        return view('customer.customers.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $is_using_point = ENUM_DIS_SELECTED;
        $type = $request->get('type');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $api = sprintf(API_CUSTOMERS_GET, $type,  $is_using_point, $page, $limit, $key);
        $body = null;
        $requestCustomers = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $typeTab = ENUM_SELECTED;
        $api = sprintf(API_CUSTOMERS_GET_TAB, $typeTab, $type, $key);
        $body = null;
        $requestTabCustomers = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestCustomers, $requestTabCustomers]);
        try {
            $config = $configAll[0];
            $detail = TEXT_DETAIL;
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['avatar'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain .$config['data']['list'][$i]['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $config['data']['list'][$i]['avatar'] . "'" . ')">
                                                        <label class="title-name-new-table" >'.$config['data']['list'][$i]['name'].'</label>';
                $config['data']['list'][$i]['point'] = $this->numberFormat($config['data']['list'][$i]['point']);
                $config['data']['list'][$i]['alo_point'] = $this->numberFormat($config['data']['list'][$i]['alo_point']);
                $config['data']['list'][$i]['accumulate_point'] = $this->numberFormat($config['data']['list'][$i]['accumulate_point']);
                $config['data']['list'][$i]['promotion_point'] = $this->numberFormat($config['data']['list'][$i]['promotion_point']);
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-phone="' . $config['data']['list'][$i]['phone'] . '" data-id="' . $config['data']['list'][$i]['id'] . '" onclick="openDetailCustomers($(this))"><i class="fi-rr-eye"></i></button>
                                                         </div>';
            }
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_record' => $this->numberFormat($config['data']['total_record']),
                'key' => $key,
                'page' => $page,
                'config' => $config
            );
            $config = $configAll[1];
            $dataTable['customer'] = $this->numberFormat($config['data']['number_customer']);
            $dataTable['customer_use_point'] = $this->numberFormat($config['data']['number_customer_use_point']);
            $dataTable['total_point'] = $this->numberFormat($config['data']['total_point']);
            $dataTable['total_alo_point'] = $this->numberFormat($config['data']['total_alo_point']);
            $dataTable['total_promotion_point'] = $this->numberFormat($config['data']['total_promotion_point']);
            $dataTable['total_accumulate_point'] = $this->numberFormat($config['data']['total_accumulate_point']);
            $dataTable['total_debt_point'] = $this->numberFormat($config['data']['total_debt_point']);
            $dataTable['total_point_use'] = $this->numberFormat($config['data']['total_point_use']);
            $dataTable['config_count'] = $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
        return json_encode($dataTable);
    }
    public function dataUsePointCustomer(Request $request)
    {
        $is_using_point = ENUM_SELECTED;
        $type = $request->get('type');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $api = sprintf(API_CUSTOMERS_GET, $type,  $is_using_point, $page, $limit, $key);
        $body = null;
        $requestCustomers = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $typeTab = ENUM_TYPE_TAG;
        $api = sprintf(API_CUSTOMERS_GET_TAB, $typeTab, $type, $key);
        $body = null;
        $requestTabCustomers = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestCustomers, $requestTabCustomers]);
        try {
            $config = $configAll[0];
            $detail = TEXT_DETAIL;
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['avatar'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain .$config['data']['list'][$i]['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $config['data']['list'][$i]['avatar'] . "'" . ')">
                                                        <label class="title-name-new-table" >'.$config['data']['list'][$i]['name'].'</label>';
                $config['data']['list'][$i]['point_use'] = $this->numberFormat($config['data']['list'][$i]['point_use']);
                $config['data']['list'][$i]['accumulate_point_use'] = $this->numberFormat($config['data']['list'][$i]['accumulate_point_use']);
                $config['data']['list'][$i]['promotion_point_use'] = $this->numberFormat($config['data']['list'][$i]['promotion_point_use']);
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-phone="' . $config['data']['list'][$i]['phone'] . '" data-id="' . $config['data']['list'][$i]['id'] . '" onclick="openDetailCustomers($(this))"><i class="fi-rr-eye"></i></button>
                                                         </div>';
            }
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'total_record' => $this->numberFormat($config['data']['total_record']),
                'key' => $key,
                'page' => $page,
                'config' => $config
            );
            $config = $configAll[1];
            $dataTable['customer'] = $this->numberFormat($config['data']['number_customer']);
            $dataTable['customer_use_point'] = $this->numberFormat($config['data']['number_customer_use_point']);
            $dataTable['total_point'] = $this->numberFormat($config['data']['total_point']);
            $dataTable['total_alo_point'] = $this->numberFormat($config['data']['total_alo_point']);
            $dataTable['total_promotion_point_use'] = $this->numberFormat($config['data']['total_promotion_point_use']);
            $dataTable['total_accumulate_point_use'] = $this->numberFormat($config['data']['total_accumulate_point_use']);
            $dataTable['total_debt_point'] = $this->numberFormat($config['data']['total_debt_point']);
            $dataTable['total_point_use'] = $this->numberFormat($config['data']['total_point_use']);
            $dataTable['config_count'] = $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
        return json_encode($dataTable);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $urlImg = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
        $api = sprintf(API_CUSTOMERS_GET_DETAIL, $id);
        $body = null;
        $requestDetailCustomers = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_CUSTOMERS_GET_ORDER, $id);
        $requestOrderCustomers = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $branch = Config::get('constants.type.id.GET_ALL');
        $pointType = ENUM_TYPE_TAG;
        $type = ENUM_DIS_SELECTED;
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $api = sprintf(API_CUSTOMERS_GET_HISTORY_POINT, $id, $branch, $pointType, $type, $page, $limit);
        $body = null;
        $requestHistoryPointCustomers = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $branchID = $request->get('branch_id') == 0 ? -1 : $request->get('branch_id');
        $requestStatus = '';
        $isUsed = ENUM_SELECTED;
        $keySearch = $request->get('phone');
        $from = $request->get('from');
        $to = $request->get('to');
        $api = sprintf(API_CUSTOMERS_GET_RECHARGE_CARDS, (int)$branchID, $requestStatus, $isUsed, $keySearch, $from, $to, $limit, $page);
        $body = null;
        $requestRechargeCardsCustomers = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestDetailCustomers, $requestOrderCustomers, $requestHistoryPointCustomers, $requestRechargeCardsCustomers]);
        try {
            $dataDetail = $configAll[0]['data'];
            $dataDetail['avatar'] = $urlImg . $dataDetail['avatar'];
            if ($dataDetail['gender'] === (int)TEXT_FEMALE_VALUE) {
                $dataDetail['gender'] = TEXT_FEMALE;
                $dataDetail['color'] = 'bg-c-pink';
            } else {
                $dataDetail['gender'] = TEXT_MALE;
                $dataDetail['color'] = 'bg-c-lite-green';
            }
            if ($dataDetail['status'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                $dataDetail['status'] = '<label class="label label-lg label-success">' . TEXT_STATUS_ENABLE . '</label>';
            } else {
                $dataDetail['status'] = '<label class="label label-lg label-inverse">' . TEXT_DISABLE_STATUS . '</label>';
            }
            $dataDetail['point'] = $this->numberFormat($dataDetail['point']);
            $dataDetail['alo_point'] = $this->numberFormat($dataDetail['alo_point']);
            $dataDetail['accumulate_point'] = $this->numberFormat($dataDetail['accumulate_point']);
            $dataDetail['promotion_point'] = $this->numberFormat($dataDetail['promotion_point']);
            $dataDetail['used_amount'] = $this->numberFormat($dataDetail['promotion_point']);
            $data = $configAll[1]['data']['list'];
            $dataTotal['total_price'] = $this->numberFormat(array_sum(array_column($data, 'total_amount')));
            $dataCount['total_record_bill'] = $this->numberFormat(count($data));
            $dataTableOrder = DataTables::of($data)
                ->addColumn('vat', function ($row) {
                    return $this->numberFormat($row['vat']);
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('discount_amount', function ($row) {
                    return $this->numberFormat($row['discount_amount']);
                })
                ->addColumn('order_status_name', function ($row) {
                    switch ($row['order_status']) {
                        case (int)Config::get('constants.type.order_status.OPENING'):
                        case (int)Config::get('constants.type.order_status.WAITING_PAYMENT'):
                        case (int)Config::get('constants.type.order_status.PENDING'):
                            return '<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">' . $row['order_status_name'] . '</label>
                                     </div>';
                        case (int)Config::get('constants.type.order_status.DONE'):
                            return '<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">' . $row['order_status_name'] . '</label>
                                     </div>';
                        case (int)Config::get('constants.type.order_status.MERGED'):
                            return '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">' . $row['order_status_name'] . '</label>
                                     </div>';
                        case (int)Config::get('constants.type.order_status.WAITING_COMPLETE'):
                        case (int)Config::get('constants.type.order_status.DEBT'):
                        return '<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">' . $row['order_status_name'] . '</label>
                                     </div>';
                        case (int)Config::get('constants.type.order_status.DELIVERING'):
                            return '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">' . $row['order_status_name'] . '</label>
                                     </div>';
                        default:
                            return '<div class="seemt-blue seemt-border-blue status-new" style="display: inline !important; max-width: max-content;">
                                        <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                        <label class="m-0">' . $row['order_status_name'] . '</label>
                                     </div>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-is-print="1" data-id="'. $row['id'] .'" data-cancel="0" onclick="openBillDetail($(this))"><i class="fi-rr-eye"></i></button></div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['order_status_name', 'action'])
                ->addIndexColumn()
                ->make(true);
            $data = $configAll[2]['data']['list'];
            $dataAds = [];
            $dataFoods = [];
            $a = 0;
            $b = 0;
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['type'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    $dataAds[$a] = $data[$i];
                    $a++;
                } elseif ($data[$i]['type'] === (int)Config::get('constants.type.checkbox.DIS_SELECTED')) {
                    $dataFoods[$b] = $data[$i];
                    $b++;
                }
            }
            $dataTableAds = $this->drawTableCustomer($dataAds);
            $dataTableFoods = $this->drawTableCustomer($dataFoods);
            $data = $configAll[3]['data']['list'];
            $dataTableRechangeCards = DataTables::of($data)
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('bonus_amount', function ($row) {
                    return $this->numberFormat($row['bonus_amount']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['amount', 'bonus_amount'])
                ->addIndexColumn()
                ->make(true);
            $dataCount['total_record_ads'] = $this->numberFormat(count($dataAds));
            $dataCount['total_record_foods'] = $this->numberFormat(count($dataFoods));
            $dataCount['total_record_recharge_cards'] = $this->numberFormat(count($data));
            return [$dataDetail, $dataTableOrder, $dataTableRechangeCards, $dataTableAds, $dataTableFoods, $configAll, $dataTotal, $dataCount];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function listCardTag(Request $request)
    {
        $isDelete = $request->get('is_delete');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_CARD_TAG_GET, $isDelete);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $data = $config['data']['list'];
        $selectCardTag = '';
        if (count($data) === 0) {
            $selectCardTag = '<option value="-2" selected>' . TEXT_NULL_OPTION . '</option>';
        } else {
            $selectCardTag .= '<option value="-1" selected>Thẻ tag</option>';
            foreach ($data as $db) {
                $selectCardTag .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
        }
        return [$selectCardTag, $config];
    }

    public function drawTableCustomer($data)
    {
        return DataTables::of($data)
            ->addColumn('note', function ($row) {
                if (mb_strlen($row['note']) > 30) {
                    return mb_substr($row['note'], 0, 27) . '...';
                } else {
                    return $row['note'];
                }
            })
            ->addColumn('point', function ($row) {
                return $this->numberFormat($row['point']);
            })
            ->addColumn('accumulate_point', function ($row) {
                return $this->numberFormat($row['accumulate_point']);
            })
            ->addColumn('promotion_point', function ($row) {
                return $this->numberFormat($row['promotion_point']);
            })
            ->addColumn('total_all_point', function ($row) {
                return $this->numberFormat($row['total_all_point']);
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->addColumn('action', function ($row) {
                if ($row['type'] == (int)Config::get('constants.type.checkbox.DIS_SELECTED')) {
                    return '<div class="btn-group btn-group-sm">
                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-is-print="1" data-id="'. $row['order_id'] .'" data-cancel="0" onclick="openBillDetail($(this))"><i class="fi-rr-eye"></i></button></div>';
                } else {
                    return '';
                }
            })
            ->rawColumns(['order_status_name', 'note', 'action'])
            ->addIndexColumn()
            ->make(true);
    }
    public function listCustomer(Request $request){
        $type = $request->get('type');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = 100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $api = sprintf(API_CUSTOMERS_GET, $type, $page, $limit, $key);
        $body = null;
        $dataListCustomer = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $id = $request->get('id');
        $api = sprintf(API_CARD_TAG_GET_DETAIL, $id);
        $body = null;
        $listCustomerCardTag = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$dataListCustomer, $listCustomerCardTag]);
        $cardTagMember = collect($configAll[0]['data']['list'])->pluck('id')->toArray();
        $data = $configAll[0]['data']['list'];
        $detail = TEXT_DETAIL;
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['name'] = '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain .$data[$i]['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $data[$i]['avatar'] . "'" . ')">
                                                        <label class="title-name-new-table" >'.$data[$i]['name'].'</label>';
            if ($data[$i]['gender'] === TEXT_FEMALE_VALUE){
                $data[$i]['gender'] = '<i class="ion-female mr-1 "></i>'.TEXT_FEMALE;
            } else {
                $data[$i]['gender'] = '<i class="ion-male mr-1 text-primary"></i>'.TEXT_MALE;
            }
            $data[$i]['point'] = $this->numberFormat($data[$i]['point']);
            $data[$i]['alo_point'] = $this->numberFormat($data[$i]['alo_point']);
            $data[$i]['accumulate_point'] = $this->numberFormat($data[$i]['accumulate_point']);
            $data[$i]['total_point_use'] = $this->numberFormat($data[$i]['total_point_use']);
            $data[$i]['detail'] = '<div class="btn-group btn-group-sm">
                                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-phone="' . $data[$i]['phone'] . '" data-id="' . $data[$i]['id'] . '" onclick="openDetailCustomers($(this))"><i class="fi-rr-eye"></i></button>
                                                             </div>';
            $data[$i]['keysearch'] = $this->keySearchDatatableTemplate($data[$i]);
        }
        $dataTable = array(
            'draw' => $request->get('draw'),
            'recordsTotal' =>$configAll[0]['data']['total_record'],
            'recordsFiltered' => $configAll[0]['data']['total_record'],
            'data' => $data,
            'total_record' => $this->numberFormat($configAll[0]['data']['total_record']),
            'key' => $key,
            'page' => $page,
            'config' => $configAll[0]
        );
        return json_encode($dataTable);
    }
    public function assignRestaurantCustomer(Request $request){
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_CARD_TAG_GET_ASSIGN_RESTAURANT_CUSTOMER_TAG_FOR_CUSTOMERS);
        $body = [
            "restaurant_tag_id" => $request->get('restaurant_tag_id'),
            "customer_insert_ids" => $request->get('customer_insert'),
            "customer_delete_ids" => $request->get('customer_delete'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
