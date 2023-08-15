<?php

namespace App\Http\Controllers\Marketing\Promotion;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class VoucherController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'marketing.voucher';
        return view('marketing.voucher.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand_id = $request->get('brand_id');
        $branch_id = $request->get('branch_id');
        $from = $request->get('from');
        $to = $request->get('to');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $status = Config::get('constants.type.status.GET_ALL');
        $key_search = '';
        $api = sprintf(API_VOUCHER_PROMOTION_GET_DATA, $brand_id, $branch_id, $status, $limit, $page, $from, $to, $key_search);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data'];

            $dataApplying = collect($data)->where('status', (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.APPLYING'))->toArray();
            $dataPending = collect($data)->where('status', (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.PENDDING'))->toArray();
            $dataPausing = collect($data)->where('status', (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.PAUSING'))->toArray();
            $dataExpired = collect($data)->where('status', (int)Config::get('constants.type.RestaurantPromotionTypeStatusEnum.EXPIRED'))->toArray();

            $dataTableApplying = $this->drawTableVoucherPromotion($dataApplying);
            $dataTablePending = $this->drawTableVoucherPromotion($dataPending);
            $dataTablePausing = $this->drawTableVoucherPromotion($dataPausing);
            $dataTableExpired = $this->drawTableVoucherPromotion($dataExpired);

            $data_total = [
                'total_record_pending' => $this->numberFormat(count($dataPending)),
                'total_record_applying' => $this->numberFormat(count($dataApplying)),
                'total_record_pausing' => $this->numberFormat(count($dataPausing)),
                'total_record_expired' => $this->numberFormat(count($dataExpired)),
            ];

            return [$dataTableApplying, $dataTablePending, $dataTablePausing, $dataTableExpired, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = API_VOUCHER_PROMOTION_POST_CREATE;
        $body = [
            'promotion_campaign_id' => [(int)$request->get('promotion_campaign_id')],
            'restaurant_brand_id' => $request->get('restaurant_brand_id'),
            'branch_ids' => $request->get('branch_ids'),
            'name' => sprintf($request->get('name')),
            'information' => sprintf($request->get('information')),
            'banner_image_url' => $request->get('banner_image_url'),
            'discount_percent' => $request->get('discount_percent'),
            'day_of_weeks' => $request->get('day_of_weeks'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'category_types' => $request->get('category_types'),
            'maximum_use_time_per_voucher' => (int)$request->get('maximum_use_time_per_voucher'),
            'is_actived' => (int)$request->get('is_actived'),
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function drawTableVoucherPromotion($data)
    {
        return DataTables::of($data)
            ->addColumn('hour', function ($row) {
                return '9:00 - 18:00';
            })
            ->addColumn('time', function ($row) {
                return 'Thứ 2, Thứ 3';
            })
            ->addColumn('date', function ($row) {
                return $row['from_date'] . ' - ' . $row['to_date'];
            })
            ->addColumn('count', function ($row) {
                return '15';
            })
            ->addColumn('action', function ($row) {
                return '';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
