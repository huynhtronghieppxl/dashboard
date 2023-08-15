<?php

namespace App\Http\Controllers\Marketing\Promotion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class HappyHourController extends Controller
{
    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $promotion_campaign_id = 3; //hardcode
        $restaurant_object_promotion_campaign_id = 1; //hardcode
        $restaurant_voucher_id = -1; //hardcode
        $customer_id = -1; //hardcode
        $from_date = Config::get('constants.type.date.NONE');
        $to_date = Config::get('constants.type.date.NONE');
        $is_registed = -1;
        $key_search = '';
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.PROMOTION');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_HAPPY_HOUR_GET_DATA, $brand, $promotion_campaign_id, $restaurant_object_promotion_campaign_id, $restaurant_voucher_id, $customer_id, $from_date, $to_date, $is_registed, $key_search);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $register = collect($data)->where('restaurant_voucher_id', '!=', 0)->toArray();
            $notRegister = collect($data)->where('restaurant_voucher_id', 0)->toArray();
            $detail = TEXT_DETAIL;
            $update = TEXT_UPDATE;
            $gift = TEXT_GIFT;
            $tableRegister = DataTables::of($register)
                ->addColumn('action', function ($row) use ($update, $detail, $gift) {
                    if ($row['is_registed'] === Config::get('constants.type.checkbox.DIS_SELECTED')) {
                        return '<div class="btn-group btn-group-sm">
                                   <button type="button" class="tabledit-edit-button btn btn-success waves-effect waves-light" onclick="openModalGiftHappyHourPromotion(' . "'" . $row['customer_phone'] . "'" . ', ' . $row['restaurant_voucher_id'] . ', ' . $row['restaurant_brand_id'] . ', ' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $gift . '"><span class="icofont icofont-gift"></span></button>
                                </div>';
                    } else {
                        return '';
                    }
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            $tableNotRegister = DataTables::of($notRegister)
                ->addColumn('action', function ($row) use ($update,$gift) {
                    if ($row['is_registed'] === Config::get('constants.type.checkbox.DIS_SELECTED')) {
                        return '<div class="btn-group btn-group-sm">
                                   <button type="button" class="tabledit-edit-button btn btn-success waves-effect waves-light" onclick="openModalGiftHappyHourPromotion(' . "'" . $row['customer_phone'] . "'" . ', ' . $row['restaurant_voucher_id'] . ', ' . $row['restaurant_brand_id'] . ', ' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $gift . '"><span class="icofont icofont-gift"></span></button>
                                </div>';
                    } else {
                        return '';
                    }
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            $data_total = [
                'total_record_register' => $this->numberFormat(count($register)),
                'total_record_not_register' => $this->numberFormat(count($notRegister)),
            ];

            return [$tableRegister, $tableNotRegister, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.PROMOTION');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $id = $request->get('id');
        $note = $request->get('note');
        $api = sprintf(API_HAPPY_HOUR_POST_UPDATE_HAPPY_HOUR, $id);
        $body = [
            'call_history' => $note
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function create(Request $request)
    {
        $id = 1;
        $brand = $request->get('brand_id');
        $discount = $request->get('discount');
        $condition = $request->get('note');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.PROMOTION');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_HAPPY_HOUR_POST_CREATE_HAPPY_HOUR, $id);
        $body = [
            'restaurant_brand_id' => $brand,
            'discount_percent' => $discount,
            'information' => implode(',', $condition)
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function dataGift(Request $request)
    {
        $id = 1;
        $brand = $request->get('brand_id');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.PROMOTION');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_HAPPY_HOUR_GET_GIFT_HAPPY_HOUR, $brand, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $gift = '';
            foreach ($config['data']['list'] as $db) {
                $condition = str_replace(',', '</li><li><i class="ti-check"></i>', $db['information']);
                $gift .= ' <div class="col-sm-12 col-md-6 col-lg-4" style="padding-right: 0 !important;">
                        <div class="price-box">
                            <span class="bg-red">Voucher giảm giá</span>
                            <div class="pricings">
                                <h1>' . $db['discount_percent'] . '%</h1>
                                <ul class="price-features"><li><i class="ti-check"></i>' . $condition . '</li><li></ul>
                                <a class="main-btn register-button-happy-hour" href="javascript:void(0)"
                                   data-value="' . $db['id'] . '">Chọn</a>
                            </div>
                        </div>
                    </div>';
            }
            return [$gift, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function gift(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand_id');
        $voucher = $request->get('gift');
        $phone = $request->get('phone');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.PROMOTION');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_HAPPY_HOUR_POST_GIFT_HAPPY_HOUR, 1);
        $body = [
            'restaurant_brand_id' => $brand,
            'restaurant_voucher_id' => $voucher,
            'customer_phone' => $phone,
            'restaurant_pc_customer_register_id' => $id,
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }
}
