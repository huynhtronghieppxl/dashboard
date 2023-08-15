<?php

namespace App\Http\Controllers\Manage\EInvoice;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class EInvoiceController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(2);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Quản lý hoá đơn điện tử';
        return view('manage.e_invoice.index', compact('active_nav'));
    }

    public function check(Request $request){
        $branchID = $request->get('branch');
        $project = ENUM_PROJECT_ID_ORDER_VERSION;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_INVOICES_CHECK_BRANCH_HAS_PARTNER , $branchID);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function data(Request $request)
    {
        $status = $request->get('status');
        $cctDuyet = $request->get('invoice_confirm');
        $branchID = $request->get('branch_id');
        $from = $request->get('from');
        $to = $request->get('to');
        $key = $this->keySearch(($request->get('search'))['value']);
        $limit = ENUM_DEFAULT_LIMIT_100;
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $api = sprintf(API_INVOICES_GET, $page, $limit, $key, $cctDuyet, $branchID, $status, $from, $to);
        $body = null;
        $requestListInvoices = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $api = sprintf(API_INVOICES_GET_COUNT_TAB, $key, $branchID, $from, $to);
        $body = null;
        $requestCountTabInvoices = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestListInvoices, $requestCountTabInvoices]);
        try {
            for ($i = 0; $i < count($configAll[0]['data']['list']); $i++) {
                $configAll[0]['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $configAll[0]['data']['list'][$i]['amount'] = $this->numberFormat($configAll[0]['data']['list'][$i]['amount']);
                $configAll[0]['data']['list'][$i]['vat_amount'] = $this->numberFormat($configAll[0]['data']['list'][$i]['vat_amount']);
                $configAll[0]['data']['list'][$i]['discount_amount'] = $this->numberFormat($configAll[0]['data']['list'][$i]['discount_amount']);
                $configAll[0]['data']['list'][$i]['total_amount'] = $this->numberFormat($configAll[0]['data']['list'][$i]['total_amount']);
                switch($configAll[0]['data']['list'][$i]['partner_type']){
                    case 1:
                        $configAll[0]['data']['list'][$i]['partner_type'] = 'MINVOICE';
                        break;
                    case 2:
                        $configAll[0]['data']['list'][$i]['partner_type'] = 'FPT';
                        break;
                    case 3:
                        $configAll[0]['data']['list'][$i]['partner_type'] = 'MIFI';
                        break;
                    default:
                        $configAll[0]['data']['list'][$i]['partner_type'] = '';
                }
                $oldDate = Date_create( $configAll[0]['data']['list'][$i]['payment_date']);
                $newDate = Date_format($oldDate, "d/m/Y H:i:s");
                $configAll[0]['data']['list'][$i]['payment_date'] = '<label>' . $this->convertDateTime($newDate) . '</label>'  == null ? '---' : '<label>' . $this->convertDateTime($newDate) . '</label>';
                switch ($configAll[0]['data']['list'][$i]['invoice_status']) {
                    case 0:
                        $configAll[0]['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_BILL_SEND . '" data-id="' . $configAll[0]['data']['list'][$i]['order_id'] . '" data-id-invoice="' . $configAll[0]['data']['list'][$i]['_id'] . '" data-cancel="0" onclick="openModalEInvoiceExport($(this))"><i class="fi-rr-paper-plane"></i></button>
                                                         </div>';
                        break;
                    case 1:
                        if ($configAll[0]['data']['list'][$i]['cct_duyet']) {
                            $configAll[0]['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" data-id="' . $configAll[0]['data']['list'][$i]['order_id'] . '" data-cancel="0" data-id-invoice="' . $configAll[0]['data']['list'][$i]['_id'] . '" onclick="openModalEInvoiceDetail($(this))"><i class="fi-rr-eye"></i></button>
                                                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  onclick="openModalEInvoiceUpdate($(this))" data-id="' . $configAll[0]['data']['list'][$i]['order_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id-invoice="' . $configAll[0]['data']['list'][$i]['_id'] . '" ><i class="fi-rr-pencil"></i></button>
                                                         </div>';
                        } else {
                            $configAll[0]['data']['list'][$i]['action'] = '
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id-invoice="' . $configAll[0]['data']['list'][$i]['_id'] . '" onclick="cancelEInvoiceManage($(this))" data-id="' . $configAll[0]['data']['list'][$i]['order_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CANCEL . '"><i class="fi-rr-cross"></i></button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  onclick="openModalEInvoiceUpdate($(this))" data-id="' . $configAll[0]['data']['list'][$i]['order_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id-invoice="' . $configAll[0]['data']['list'][$i]['_id'] . '" ><i class="fi-rr-pencil"></i></button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" data-id="' . $configAll[0]['data']['list'][$i]['order_id'] . '" data-cancel="0" data-id-invoice="' . $configAll[0]['data']['list'][$i]['_id'] . '" onclick="openModalEInvoiceDetail($(this))"><i class="fi-rr-eye"></i></button>
                                        </div>';
                        }
                        break;
                    case 3:
                        $configAll[0]['data']['list'][$i]['action'] = '
                                        <div class="btn-group btn-group-sm">
                                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" data-id="' . $configAll[0]['data']['list'][$i]['order_id'] . '" data-cancel="0" data-id-invoice="' . $configAll[0]['data']['list'][$i]['_id'] . '" onclick="openModalEInvoiceDetail($(this))"><i class="fi-rr-eye"></i></button>
                                     </div>';
                        break;
                    case 2 :
                        $configAll[0]['data']['list'][$i]['action'] = '
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" data-id-invoice="' . $configAll[0]['data']['list'][$i]['_id'] . '" onclick="cancelEInvoiceManage($(this))" data-id="' . $configAll[0]['data']['list'][$i]['order_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_CANCEL . '"><i class="fi-rr-cross"></i></button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  onclick="openModalEInvoiceUpdate($(this))" data-id="' . $configAll[0]['data']['list'][$i]['order_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '" data-id-invoice="' . $configAll[0]['data']['list'][$i]['_id'] . '"><i class="fi-rr-pencil"></i></button>
                                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" data-id="' . $configAll[0]['data']['list'][$i]['order_id'] . '" data-cancel="0" data-id-invoice="' . $configAll[0]['data']['list'][$i]['_id'] . '" onclick="openModalEInvoiceDetail($(this))"><i class="fi-rr-eye"></i></button>
                                         </div>';
                }
                $configAll[0]['data']['list'][$i]['order_id'] = '<label class="class-link" data-id="'. $configAll[0]['data']['list'][$i]['order_id'] .'" data-is-print="1" onclick="openBillDetail($(this))">'. $configAll[0]['data']['list'][$i]['order_id'] .'</label>';
            }
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $configAll[0]['data']['total_record'],
                'recordsFiltered' => $configAll[0]['data']['total_record'],
                'data' => $configAll[0]['data']['list'],
                'total_record' => $configAll[0]['data']['total_record'],
                'key' => $key,
                'page' => $page,
                'config' => $configAll
            );

            $dataTable['total_canceled'] = $this->numberFormat($configAll[1]['data']['canceled']);
            $dataTable['total_exported'] = $this->numberFormat($configAll[1]['data']['exported']);
            $dataTable['total_have_update_in_partner'] = $this->numberFormat($configAll[1]['data']['have_update_in_partner']);
            $dataTable['total_waiting_browse'] = $this->numberFormat($configAll[1]['data']['waiting_browse']);
            $dataTable['total_waiting_export'] = $this->numberFormat($configAll[1]['data']['waiting_export']);
            return json_encode($dataTable);
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function dataCreate(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $status = ENUM_SELECTED;
        $category = ENUM_GET_ALL;
        $isCombo = ENUM_GET_ALL;
        $isSpecialGift = ENUM_GET_ALL;
        $isAddition = ENUM_GET_ALL;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = '';
        $branchID = ENUM_GET_ALL;
        $categoryID = $request->get('category_id');
        $isTakeAway = ENUM_GET_ALL;
        $isCountMaterial = ENUM_SELECTED;
        $isBestseller = ENUM_GET_ALL;
        $isKitchen = ENUM_GET_ALL;
        $isGetFoodContainAddition = ENUM_GET_ALL;
        $alertOriginalFoodID = $request->get('alert_original_price');
//        chi tiết thông tin hoá đơn
        $body = null;
        $api = sprintf(API_INVOICES_GET_DETAIL, $id);
        $dataDetailInvoice = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];
        //    danh sách món ăn của hoá đơn
        $body = null;
        $api = sprintf(API_INVOICES_GET_DETAIL_INVOICE, $id);
        $dataFoodDetailInvoice = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];
        $configAllInvoice = $this->callApiMultiGatewayTemplate2([$dataDetailInvoice, $dataFoodDetailInvoice]);
//        danh sách món ăn
        $body = null;
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $isTakeAway, $isAddition, $category, $categoryID, $brand, $branchID, $isCountMaterial, $page, $limit, $isBestseller, $isCombo, $isKitchen, $isSpecialGift, $key, $isGetFoodContainAddition, $alertOriginalFoodID);
        $dataFoodBrand = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];
//        danh sách đơn vị
        $api = API_FOOD_UNIT_GET;
        $body = [];
        $requestDataUnit = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];
        $configAllOrder = $this->callApiMultiGatewayTemplate2([$dataFoodBrand, $requestDataUnit]);
        try {
            $listFood = $configAllOrder[0]['data']['list'];
            $dataUnit = collect($configAllOrder[1]['data']);
            $discountPercent = $configAllInvoice[0]['data']['discount_percent'];
            $discountType = $configAllInvoice[0]['data']['discount_type'];
            switch($configAllInvoice[0]['data']['discount_type']){
                case 1 :
                    $configAllInvoice[0]['data']['discount_text'] = 'Theo tổng bill';
                    break;
                case 2 :
                    $configAllInvoice[0]['data']['discount_text'] = 'Theo món ăn';
                    break;
                case 3 :
                    $configAllInvoice[0]['data']['discount_text'] = 'Theo nước';
                    break;
                default:
                    $configAllInvoice[0]['data']['discount_text'] = '---';
            }

            $dataDetail = $configAllInvoice[0]['data'];
            $data = $this->compareTwoArrayTemplate($configAllOrder[0]['data']['list'],$configAllInvoice[1]['data']['list'], 'name' ,'food_name');
            $optionFood = '<option disabled selected value="" >' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($data as $value) {
                $discountMoneyFood = $value['price']  * $discountPercent / 100;
                switch($discountType){
                    case 2:
                        $discountFood = $value['category_type'] === 1 ? $discountMoneyFood : 0;
                        break;
                    case 3:
                        $discountFood = $value['category_type'] === 2 ? $discountMoneyFood : 0;
                        break;
                    default :
                        $discountFood = $discountMoneyFood;
                }
                $optionFood .= '<option value="' . $value['id'] . '" data-discount-cal="'. $discountFood .'" data-unit="'. $value['unit_type'] .'" data-invoice-id="0" data-price="'. $value['price'] .'" data-gift="'. $value['is_special_gift'] .'" data-type="'. $value['category_type'] .'" data-vat="'. $value['restaurant_vat_config_percent'] .'" data-name="'. $value['name'] .'">' . $value['name'] . '</option>';
            }
            $optionUnitSelect = '<option disabled selected value="" >' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($configAllOrder[1]['data'] as $value) {
                $optionUnitSelect .= '<option value="' . $value['name'] . '" >' . $value['name'] . '</option>';
            }
            $dataTable = Datatables::of($configAllInvoice[1]['data']['list'])
                ->addColumn('food_unit', function ($row) use ($dataUnit) {
                    $optionUnit = '<option value="" disabled>' . TEXT_DEFAULT_OPTION . '</option>';
                    $optionUnit .= '<option value="'. $row['food_unit'].'" selected>'. $row['food_unit'].'</option>';
                    $dataUnit = $dataUnit->where('food_name', '!=' , $row['food_unit'])->all();
                    foreach ($dataUnit as $value) {
                        $optionUnit .= '<option value="'. $value['name'].'">' . $value['name'] . '</option>';
                    }
                    return '<select class="js-example-basic-single select-unit-create-e-invoice col-sm-12">
                                '. $optionUnit .'
                            </select> ';
                })
                ->addColumn('quantity', function ($row) {
                    return '<div class="input-group border-group validate-table-validate ">
                              <input class="form-control adjustment text-center rounded border-0 w-100 quantity-food-create-invoice" data-float="1" data-max="999999" data-value-min-value-of="0" value="' . $this->numberFormat($row['quantity']) . '" data-type="currency-edit">
                            </div>';
                })
                ->addColumn('unit_price', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input class="form-control adjustment text-center rounded border-0 w-100 price-food-create-invoice" data-float="1" data-max="999999999" data-value-min-value-of="0" value="' . $this->numberFormat($row['price']) . '" data-type="currency-edit">
                            </div>';
                })
                ->addColumn('vat_percent', function ($row) {
                    return '<div class="input-group border-group validate-table-validate" style="z-index: 0 !important;">
                                <input class="form-control adjustment text-center rounded border-0 w-100 vat-food-create-invoice" value="' . $this->numberFormat($row['vat']) . '" data-percent="1">
                            </div>';
                })
                ->addColumn('discount_cal', function ($row) use($discountType, $discountPercent) {
                    $discountMoney = $row['total_amount_without_vat'] * ($discountPercent / 100) ;
                    switch($discountType){
                        case ENUM_DISCOUNT_FOOD:
                            $discountCal = $row['category_type'] == ENUM_FOOD_CATEGORY_FOOD ? $discountMoney : 0;
                            break;
                        case ENUM_DISCOUNT_DRINK:
                            $discountCal = $row['category_type'] == ENUM_FOOD_CATEGORY_DRINK ? $discountMoney : 0;
                            break;
                        case ENUM_DISCOUNT_BILL:
                            $discountCal = $discountMoney;
                            break;
                        default:
                            $discountCal = 0;
                    }
                    return '<label data-cal="'. $discountCal .'">'. $this->numberFormat($discountCal) .'</label>';
                })
                ->addColumn('total_price', function ($row) {
                    return '<label>' . $this->numberFormat($row['total_amount_without_vat']) . '</label>';
                })
                ->addColumn('action', function ($row) use($discountType, $discountPercent, $listFood) {
                    $discountMoney = $row['total_amount_without_vat'] * ($discountPercent / 100) ;
                    switch($discountType){
                        case ENUM_DISCOUNT_FOOD:
                            $discountCal = $row['category_type'] == ENUM_FOOD_CATEGORY_FOOD ? $discountMoney : 0;
                            break;
                        case ENUM_DISCOUNT_DRINK:
                            $discountCal = $row['category_type'] == ENUM_FOOD_CATEGORY_DRINK ? $discountMoney : 0;
                            break;
                        case ENUM_DISCOUNT_BILL:
                            $discountCal = $discountMoney;
                            break;
                        default:
                            $discountCal = 0;
                    }
                    $vat = collect($listFood)->where('id', $row['food_id'])->first();
                    if (empty($vat)) {
                        $vat['restaurant_vat_config_percent'] = 0;
                    }
                    return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeFoodCreateInvoice($(this))" data-toggle="tooltip" data-placement="top" data-food-id="'. $row['food_id'] .'" data-discount-cal="'. $discountCal .'" data-category-type="'. $row['category_type'] .'" data-price="'. $row['price'] .'"  data-vat="'. $vat['restaurant_vat_config_percent'] .'" data-gift="'. $row['is_gift'] .'" data-name="'. $row['food_name'] .'" data-invoice-id="'. $row['_id'] .'" data-unit="'. $row['food_unit'] .'" data-original-title="' . TEXT_REMOVE . '"><i class="fi-rr-trash"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['status', 'action', 'food_unit', 'total_price', 'unit_price','quantity', 'vat_percent', 'discount_cal'])
                ->make(true);
            $dataTotal = [
                'total_amount' => $this->numberFormat(collect($configAllInvoice[1]['data']['list'])->sum('total_amount_without_vat')),
                'total_vat' => $this->numberFormat(collect($configAllInvoice[1]['data']['list'])->sum('vat')),
            ];
            return [$dataTable, $optionFood, $optionUnitSelect ,$dataDetail, $dataTotal, $configAllOrder, $configAllInvoice];
        } catch (Exception $e) {
            return $this->catchTemplate($configAllOrder, $e);
        }
    }

    public function dataUpdate(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $status = ENUM_SELECTED;
        $category = ENUM_GET_ALL;
        $isCombo = ENUM_GET_ALL;
        $isSpecialGift = ENUM_GET_ALL;
        $isAddition = ENUM_GET_ALL;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_100;
        $key = '';
        $branchID = ENUM_GET_ALL;
        $categoryID = $request->get('category_id');
        $isTakeAway = ENUM_GET_ALL;
        $isCountMaterial = ENUM_SELECTED;
        $isBestseller = ENUM_GET_ALL;
        $isKitchen = ENUM_GET_ALL;
        $isGetFoodContainAddition = ENUM_GET_ALL;
        $alertOriginalFoodID = $request->get('alert_original_price');
//        chi tiết thông tin hoá đơn
        $body = null;
        $api = sprintf(API_INVOICES_GET_DETAIL, $id);
        $dataDetailInvoice = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];
        //    danh sách món ăn của hoá đơn
        $body = null;
        $api = sprintf(API_INVOICES_GET_DETAIL_INVOICE, $id);
        $dataFoodDetailInvoice = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];

        $configAllInvoice = $this->callApiMultiGatewayTemplate2([$dataDetailInvoice, $dataFoodDetailInvoice]);
//        danh sách món ăn
        $body = null;
        $api = sprintf(API_FOOD_GET_ALL_MANAGE, $status, $isTakeAway, $isAddition, $category, $categoryID, $brand, $branchID, $isCountMaterial, $page, $limit, $isBestseller, $isCombo, $isKitchen, $isSpecialGift, $key, $isGetFoodContainAddition, $alertOriginalFoodID);
        $dataFoodBrand = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];
//        danh sách đơn vị
        $api = API_FOOD_UNIT_GET;
        $body = [];
        $requestDataUnit = [
            'project' => ENUM_PROJECT_ID_ORDER,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];
        $configAllOrder = $this->callApiMultiGatewayTemplate2([$dataFoodBrand, $requestDataUnit]);
        try {
            $dataUnit = collect($configAllOrder[1]['data']);
            $discountPercent = $configAllInvoice[0]['data']['discount_percent'];
            $discountType = $configAllInvoice[0]['data']['discount_type'];
            switch($discountType){
                case 1 :
                    $configAllInvoice[0]['data']['discount_text'] = 'Theo tổng bill';
                    break;
                case 2 :
                    $configAllInvoice[0]['data']['discount_text'] = 'Theo món ăn';
                    break;
                case 3 :
                    $configAllInvoice[0]['data']['discount_text'] = 'Theo nước';
                    break;
                default:
                    $configAllInvoice[0]['data']['discount_text'] = '---';
            }
            $dataDetail = $configAllInvoice[0]['data'];
            $listFood = $configAllOrder[0]['data']['list'];
            $data = $this->compareTwoArrayTemplate( $configAllOrder[0]['data']['list'],$configAllInvoice[1]['data']['list'], 'name' ,'food_name');
            $optionFood = '<option disabled selected value="" >' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($data as $value) {
                $discountMoneyFood = $value['price'] * $discountPercent / 100;
                switch($discountType){
                    case 2:
                        $discountFood = $value['category_type'] === 1 ? $discountMoneyFood : 0;
                        break;
                    case 3:
                        $discountFood = $value['category_type'] === 2 ? $discountMoneyFood : 0;
                        break;
                    default:
                        $discountFood = $discountMoneyFood;
                }
                $optionFood .= '<option value="' . $value['id'] . '" data-discount-cal="'. $discountFood .'" data-unit="'. $value['unit_type'] .'" data-invoice-id="0" data-price="'. $value['price'] .'" data-gift="'. $value['is_special_gift'] .'" data-type="'. $value['category_type'] .'" data-vat="'. $value['restaurant_vat_config_percent'] .'" data-name="'. $value['name'] .'">' . $value['name'] . '</option>';
            }
            $optionUnitSelect = '<option disabled selected value="" >' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($configAllOrder[1]['data'] as $value) {
                $optionUnitSelect .= '<option value="' . $value['id'] . '" >' . $value['name'] . '</option>';
            }
            $dataTable = Datatables::of($configAllInvoice[1]['data']['list'])
                ->addColumn('food_unit', function ($row) use ($dataUnit) {
                    $optionUnit = '<option value="" disabled>' . TEXT_DEFAULT_OPTION . '</option>';
                    $optionUnit .= '<option value="'. $row['food_unit'].'" selected>'. $row['food_unit'].'</option>';
                    $dataUnit = $dataUnit->where('food_name', '!=' , $row['food_unit'])->all();

                    foreach ($dataUnit as $value) {
                        $optionUnit .= '<option value="'. $value['name'].'">' . $value['name'] . '</option>';
                    }
                    return '<select class="js-example-basic-single select-unit-update-e-invoice col-sm-12">
                                '. $optionUnit .'
                            </select> ';
                })
                ->addColumn('quantity', function ($row) {
                    return '<div class="input-group border-group validate-table-validate ">
                              <input class="form-control adjustment text-center rounded border-0 w-100 quantity-food-update-invoice" data-float="1" data-max="999999" data-value-min-value-of="0" value="' . $this->numberFormat($row['quantity']) . '" data-type="currency-edit">
                            </div>';
                })
                ->addColumn('unit_price', function ($row) {
                    return '<div class="input-group border-group validate-table-validate">
                                <input class="form-control adjustment text-center rounded border-0 w-100 price-food-update-invoice" data-float="1" data-max="999999999" data-value-min-value-of="0" value="' . $this->numberFormat($row['price']) . '" data-type="currency-edit">
                            </div>';
                })
                ->addColumn('discount_cal', function ($row) use($discountType, $discountPercent) {
                    $discountMoney = $row['total_amount_without_vat'] * ($discountPercent / 100) ;
                    switch($discountType){
                        case ENUM_DISCOUNT_FOOD:
                            $discountCal = $row['category_type'] == ENUM_FOOD_CATEGORY_FOOD ? $discountMoney : 0;
                            break;
                        case ENUM_DISCOUNT_DRINK:
                            $discountCal = $row['category_type'] == ENUM_FOOD_CATEGORY_DRINK ? $discountMoney : 0;
                            break;
                        case ENUM_DISCOUNT_BILL:
                            $discountCal = $discountMoney;
                            break;
                        default:
                            $discountCal = 0;
                    }
                    return '<label data-cal="'. $discountCal .'">'. $this->numberFormat($discountCal) .'</label>';
                })
                ->addColumn('vat_percent', function ($row) {
                    return '<div class="input-group border-group validate-table-validate" style="z-index: 0 !important;">
                                <input class="form-control adjustment text-center rounded border-0 w-100 vat-food-update-invoice" value="' . $this->numberFormat($row['vat']) . '" data-percent="1">
                            </div>';
                })
                ->addColumn('total_price', function ($row) {
                    return '<label>' . $this->numberFormat($row['total_amount_without_vat']) . '</label>';
                })
                ->addColumn('action', function ($row) use($discountPercent, $discountType, $listFood) {
                    $discountMoney = $row['total_amount_without_vat'] * ($discountPercent / 100) ;
                    switch($discountType){
                        case ENUM_DISCOUNT_FOOD:
                            $discountCal = $row['category_type'] == ENUM_FOOD_CATEGORY_FOOD ? $discountMoney : 0;
                            break;
                        case ENUM_DISCOUNT_DRINK:
                            $discountCal = $row['category_type'] == ENUM_FOOD_CATEGORY_DRINK ? $discountMoney : 0;
                            break;
                        case ENUM_DISCOUNT_BILL:
                            $discountCal = $discountMoney;
                            break;
                        default:
                            $discountCal = 0;
                    }
                    if($row['food_id'] == 0){
                        $vat = 10;
                    }
                    else{
                        $vat_food = collect($listFood)->where('id', $row['food_id'])->first();
                        $vat = $vat_food['restaurant_vat_config_percent'];
                    }
                    return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeFoodUpdateInvoice($(this))" data-toggle="tooltip" data-placement="top" data-food-id="'. $row['food_id'] .'" data-price="'. $row['price'] .'"  data-vat="'. $vat .'" data-gift="'. $row['is_gift'] .'" data-name="'. $row['food_name'] .'" data-invoice-id="'. $row['_id'] .'" data-unit="'. $row['food_unit'] .'" data-discount-cal="'. $discountCal .'" data-original-title="' . TEXT_REMOVE . '"><i class="fi-rr-trash"></i></button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['status', 'action', 'food_unit', 'total_price', 'unit_price','quantity', 'vat_percent', 'discount_cal'])
                ->make(true);
            $dataTotal = [
                'total_amount' => $this->numberFormat(collect($configAllInvoice[1]['data']['list'])->sum('total_amount_without_vat')),
                'total_vat' => $this->numberFormat(collect($configAllInvoice[1]['data']['list'])->sum('vat')),
            ];
            return [$dataTable, $optionFood, $optionUnitSelect, $dataDetail, $dataTotal, $configAllOrder, $configAllInvoice];
        } catch (Exception $e) {
            return $this->catchTemplate($configAllOrder, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');

        // thêm mới món ăn
        $body = [
            "id" => $id,
            "foods" => $request->get('data_create_food')
        ];
        $api = API_INVOICES_POST_CREATE_FOODS;
        $dataCreateFoods = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body
        ];

//      update món ăn
        $api = API_INVOICES_POST_UPDATE_FOODS_DASHBOARD;
        $body = [
            "invoice_id" => $id,
            "foods" => $request->get('data_food')
        ];
        $requestUpdateFoods = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body
        ];

        //      update thông tin khách hàng
        $api = API_INVOICES_POST_UPDATE_INFO;
        $body = [
            "id" => $id,
            "payment_method_id" => "",
            "customer_name" => $request->get('name'),
            "invoice_series" => '1C23TYY',
            "customer_phone" => $request->get('phone'),
            "customer_company_name" => $request->get('name_company'),
            "customer_company_tax_code" => $request->get('tax'),
            "customer_company_address" => $request->get('address'),
            "customer_company_email" => $request->get('email'),
            "is_send_mail" => $request->get('is_send_mail')
        ];
        $requestUpdateInfo = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body
        ];
        if (count($request->get('data_food')) > 0) {
            return $this->callApiMultiGatewayTemplate2([$dataCreateFoods, $requestUpdateFoods, $requestUpdateInfo]);
        }else{
            return $this->callApiMultiGatewayTemplate2([$dataCreateFoods, $requestUpdateInfo]);
        }
    }

    public function updateWaitingAccept(Request $request)
    {
        $id = $request->get('id');

        // thêm mới món ăn
        $body = [
            "id" => $id,
            "foods" => $request->get('data_update_food')
        ];
        $api = API_INVOICES_POST_CREATE_FOODS;
        $dataCreateFoods = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body
        ];

//      update món ăn
        $api = API_INVOICES_POST_UPDATE_FOODS;
        $body = [
            "invoice_id" => $id,
            "foods" => $request->get('data_food')
        ];
        $requestUpdateFoods = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body
        ];
        return $this->callApiMultiGatewayTemplate2([$dataCreateFoods, $requestUpdateFoods]);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
//        chi tiết thông tin hoá đơn
        $body = null;
        $api = sprintf(API_INVOICES_GET_DETAIL, $id);
        $dataDetailInvoice = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];
        //    danh sách món ăn của hoá đơn
        $body = null;
        $api = sprintf(API_INVOICES_GET_DETAIL_INVOICE, $id);
        $dataFoodDetailInvoice = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body
        ];

        $configAllInvoice = $this->callApiMultiGatewayTemplate2([$dataDetailInvoice, $dataFoodDetailInvoice]);
        try {
            $discountPercent = $configAllInvoice[0]['data']['discount_percent'];
            $discountType = $configAllInvoice[0]['data']['discount_type'];
            switch($discountType){
                case 1 :
                    $configAllInvoice[0]['data']['discount_text'] = 'Theo tổng bill';
                    break;
                case 2 :
                    $configAllInvoice[0]['data']['discount_text'] = 'Theo món ăn';
                    break;
                case 3 :
                    $configAllInvoice[0]['data']['discount_text'] = 'Theo nước';
                    break;
                default:
                    $configAllInvoice[0]['data']['discount_text'] = '---';
            }

            $dataDetail = $configAllInvoice[0]['data'];
            $dataTable = Datatables::of($configAllInvoice[1]['data']['list'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('quantity', function ($row) {
                    return '<label>' . $this->numberFormat($row['quantity']) . '</label>';
                })
                ->addColumn('unit_price', function ($row) {
                    return '<label>' . $this->numberFormat($row['price']) . '</label>';
                })
                ->addColumn('total_price', function ($row) {
                    return '<label>' . $this->numberFormat($row['total_amount_without_vat']) . '</label>';
                })
                ->addColumn('discount_cal', function ($row) use($discountType, $discountPercent) {
                    $discountMoney = $row['total_amount_without_vat'] * ($discountPercent / 100) ;
                    switch($discountType){
                        case ENUM_DISCOUNT_FOOD:
                            $discountCal = $row['category_type'] == ENUM_FOOD_CATEGORY_FOOD ? $discountMoney : 0;
                            break;
                        case ENUM_DISCOUNT_DRINK:
                            $discountCal = $row['category_type'] == ENUM_FOOD_CATEGORY_DRINK ? $discountMoney : 0;
                            break;
                        case ENUM_DISCOUNT_BILL:
                            $discountCal = $discountMoney;
                            break;
                        default:
                            $discountCal = 0;
                    }
                    return '<label data-cal="'. $discountCal .'">'. $this->numberFormat($discountCal) .'</label>';
                })
                ->addIndexColumn()
                ->rawColumns(['keysearch', 'quantity', 'unit_price', 'total_price', 'discount_cal'])
                ->make(true);
            $dataTotal = [
                'total_amount' => $this->numberFormat(collect($configAllInvoice[1]['data']['list'])->sum('total_amount_without_vat')),
                'total_vat' => $this->numberFormat(collect($configAllInvoice[1]['data']['list'])->sum('vat')),
            ];
            return [$dataTable, $dataDetail, $dataTotal, $configAllInvoice];
        } catch (Exception $e) {
            return $this->catchTemplate($configAllInvoice, $e);
        }
    }

    public function export(Request $request)
    {
        $id = $request->get('id');
        // thêm mới món ăn
        $body = [
            "id" => $id,
            "foods" => $request->get('data_create_food')
        ];
        $api = API_INVOICES_POST_CREATE_FOODS;
        $dataCreateFoods = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body
        ];
//      update món ăn
        $api = API_INVOICES_POST_UPDATE_FOODS_DASHBOARD;
        $body = [
            "invoice_id" => $id,
            "foods" => $request->get('data_food')
        ];
        $requestUpdateFoods = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body
        ];
        //xuất hoá đơn
        $api = API_INVOICES_POST_EXPORT;
        $body = [
            "id" => $id,
            "customer_name" => $request->get('name'),
            "customer_phone" => $request->get('phone'),
            "customer_company_name" => $request->get('name_company'),
            "customer_company_tax_code" => $request->get('tax'),
            "customer_company_address" => $request->get('address'),
            "customer_company_email" => $request->get('email'),
            "is_send_mail" => $request->get('is_send_mail')
        ];
        $exportInvoice = [
            'project' => ENUM_PROJECT_ID_INVOICES,
            'method' => ENUM_METHOD_POST,
            'api' => $api,
            'body' => $body
        ];
        return $this->callApiMultiGatewayTemplate2([$dataCreateFoods, $requestUpdateFoods, $exportInvoice]);
    }

    public function cancel(Request $request)
    {
        $project = ENUM_PROJECT_ID_INVOICES;
        $method = ENUM_METHOD_POST;
        $api = API_INVOICES_POST_CANCEL;
        $body = [
            "id" => $request->get('id'),
            'note' => $request->get('note'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function changeStatus(Request $request)
    {
        $project = ENUM_PROJECT_ID_INVOICES;
        $method = ENUM_METHOD_POST;
        $api = API_INVOICES_CHANGE_STATUS_FOOD;
        $body = [
            "invoice_detail_id" => $request->get('id'),
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

}
