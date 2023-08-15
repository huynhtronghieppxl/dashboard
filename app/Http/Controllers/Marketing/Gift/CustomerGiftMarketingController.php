<?php

namespace App\Http\Controllers\Marketing\Gift;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class CustomerGiftMarketingController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'marketing.gift.customer';
        return view('marketing.gift.customer.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GIFT_MARKETING_GET_CUSTOMER, $brand);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $collect = collect($data);
            $dataNotUse = $collect->where('is_used', Config::get('constants.type.checkbox.DIS_SELECTED'))->all();
            $dataUse = $collect->where('is_used', Config::get('constants.type.checkbox.SELECTED'))->all();
            $dataExpired = $collect->where('is_expired', Config::get('constants.type.checkbox.SELECTED'))->all();

            $tableNotUse = $this->drawDataTableCustomerGiftMarketing($dataNotUse);
            $tableUse = $this->drawDataTableCustomerGiftMarketing($dataUse);
            $tableExpired = $this->drawDataTableCustomerGiftMarketing($dataExpired);

            $total = [
                'total_record_not_use' => $this->numberFormat(count($dataNotUse)),
                'total_record_use' => $this->numberFormat(count($dataUse)),
                'total_record_expired' => $this->numberFormat(count($dataExpired))
            ];

            return [$tableNotUse, $tableUse, $tableExpired, $total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function drawDataTableCustomerGiftMarketing($data)
    {
        return DataTables::of($data)
            ->addColumn('quantity', function ($row) {
                return $this->numberFormat($row['restaurant_gift_object_quantity']);
            })
            ->addColumn('open', function ($row) {
                if ($row['is_opened'] === Config::get('constants.type.checkbox.SELECTED')) {
                    return '<i class="fa fa-2x fa-dropbox text-success"></i>';
                } else {
                    return '<i class="fa fa-2x fa-gift text-warning"></i>';
                }
            })
            ->addColumn('type', function ($row) {
                if ($row['restaurant_gift_type'] === 0) {
                    return 'Món ăn';
                } else {
                    return 'Điểm';
                }
            })
            ->addColumn('value', function ($row) {
                if ($row['restaurant_gift_type'] === 0) {
                    return $row['food']['name'];
                } else {
                    return $this->numberFormat($row['restaurant_gift_object_value']);
                }
            })
            ->rawColumns(['open'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create(Request $request)
    {
        $customer = $request->get('customer');
        $gift = $request->get('gift');
        $brand = $request->get('brand');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_GIFT_MARKETING_POST_CREATE_CUSTOMER;
        $body = [
            "customer_id" => $customer,
            "restaurant_brand_id" => $brand,
            "restaurant_gift_id" => $gift,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if($customer !== -1){
                $config['data']['quantity'] = $this->numberFormat($config['data']['restaurant_gift_object_quantity']);
                if ($config['data']['restaurant_gift_type'] === 0) {
                    $config['data']['type'] = 'Món ăn';
                    $config['data']['value'] = $config['data']['food']['name'];
                } else {
                    $config['data']['type'] = 'Điểm';
                    $config['data']['value'] = $this->numberFormat($config['data']['restaurant_gift_object_value']);
                }
                if ($config['data']['is_opened'] === Config::get('constants.type.checkbox.SELECTED')) {
                    $config['data']['open'] = '<i class="fa fa-2x fa-dropbox text-success"></i>';
                } else {
                    $config['data']['open'] = '<i class="fa fa-2x fa-gift text-warning"></i>';
                }
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function customer(Request $request)
    {
        $phone = $request->get('phone');
        $name = Config::get('constants.type.data.NONE');
        $branch = Config::get('constants.type.data.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_BOOKING_SEARCH_CUSTOMER,$name,$phone,$branch);
        $body = [];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function gift(Request $request)
    {
        $brand = $request->get('brand');
        $isActive = Config::get('constants.type.checkbox.SELECTED');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $api = sprintf(API_GIFT_MARKETING_GET, $brand, $isActive , $limit , $page);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $gift = '<option hidden disabled selected value="0">' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($config['data']['list'] as $db) {
                $gift .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
            if (count($config['data']['list']) === 0) {
                $gift = '<option selected>' . TEXT_NULL_OPTION . '</option>';
            }

            return [$gift, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
