<?php

namespace App\Http\Controllers\Marketing\Gift;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class NewCustomerGiftMarketingController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'MARKETING_MANAGER', 'RESTAURANT_GIFT_MANAGER']);
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
        $active_nav = 'Quà tặng marketing';
        return view('marketing.gift.new_customer.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $type = Config::get('constants.type.checkbox.DIS_SELECTED');
        $api = sprintf(API_GIFT_MARKETING_GET_NEW_CUSTOMER, $type);
        $body = null;
        $requestDisSelected = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $type = Config::get('constants.type.checkbox.SELECTED');
        $api = sprintf(API_GIFT_MARKETING_GET_NEW_CUSTOMER, $type);
        $body = null;
        $requestSelected = [
            'project' => Config::get('constants.GATEWAY.PROJECT_ID.ORDER'),
            'method' => Config::get('constants.GATEWAY.METHOD.GET'),
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestDisSelected, $requestSelected]);
        try {
            $dataTableDisSelected = DataTables::of($configAll[0]['data']['list'])
                ->addColumn('action', function ($row) {
//                    return '<i class="fi-rr-arrow-right btn-convert-gift-left-to-right btn seemt-btn-hover-gray seemt-bg-gray-w200" data-gift-type="'. $row['gift_type'] .'" onclick="checkNewCustomerGift($(this))" data-id="' . $row['restaurant_gift_id'] . '" data-type="0"></i>';
                      return '<div class="btn-group btn-group-sm"> <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" data-gift-type="'. $row['gift_type'] .'" onclick="checkNewCustomerGift($(this))" data-id="' . $row['restaurant_gift_id'] . '" data-type="0"><i class="fi-rr-arrow-small-right"></i></button></div>';
                })
                ->addColumn('gift_type', function ($row) {
                    return $row['gift_type'] ? 'Quà điểm' : 'Quà món ăn';
                })
                ->addColumn('description', function ($row) {
                    if (mb_strlen($row['description']) > 50) {
                        return mb_substr($row['description'], 0, 50) . '...';
                    } else {
                        return $row['description'];
                    }
                })
                ->addColumn('name', function ($row) {
                    if (mb_strlen($row['name']) > 20) {
                        return mb_substr($row['name'], 0, 50) . '...';
                    } else {
                        return $row['name'];
                    }
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'description', 'name'])
                ->make(true);

            $dataTableSelected = DataTables::of($configAll[1]['data']['list'])
                ->addColumn('action', function ($row) {
//                    return '<i class="fi-rr-arrow-left btn-convert-gift-left-to-right btn seemt-btn-hover-gray seemt-bg-gray-w200" data-gift-type="'. $row['gift_type'] .'" onclick="unCheckNewCustomerGift($(this))" data-id="' . $row['id'] . '" data-type="1"></i>';
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                 data-gift-type="'. $row['gift_type'] .'" onclick="unCheckNewCustomerGift($(this))" data-id="' . $row['id'] . '" data-type="1">
                                    <i class="fi-rr-arrow-small-left"></i>
                                </button>
                            </div>';
                })
                ->addColumn('name', function ($row) {
                    if (mb_strlen($row['name']) > 20) {
                        return mb_substr($row['name'], 0, 50) . '...';
                    } else {
                        return $row['name'];
                    }
                })
                ->addColumn('gift_type', function ($row) {
                    return $row['gift_type'] ? 'Quà điểm' : 'Quà món ăn';
                })
                ->addColumn('description', function ($row) {
                    if (mb_strlen($row['description']) > 20) {
                        return mb_substr($row['description'], 0, 50) . '...';
                    } else {
                        return $row['description'];
                    }

                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'description', 'name'])
                ->make(true);
            return [$dataTableDisSelected, $dataTableSelected, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function update(Request $request)
    {
        $giftInsert = $request->get('gift_insert');
        $giftDelete = $request->get('gift_delete');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_GIFT_MARKETING_POST_UPDATE_NEW_CUSTOMER;
        $body = [
            "list_insert_ids" => $giftInsert,
            "list_delete_ids" => $giftDelete,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
