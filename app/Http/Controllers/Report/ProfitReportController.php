<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class ProfitReportController extends Controller
{
    public function index(Request $request)
    {

        $active_nav = 'Lợi nhuận món ăn';
        return view('report.profit.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $category = $request->get('category');
        $categoryID = ENUM_GET_ALL;
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $isGift = ENUM_GET_ALL;
        $isCombo = ENUM_GET_ALL;
        $isCancel = ENUM_GET_ALL;
        $isTakeAway = ENUM_GET_ALL;
        $isGoods = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_PROFIT_FOOD, $brand, $branch, $category, $categoryID, $type, $time, $from, $to, $isGift, $isCombo, $isCancel, $isTakeAway, $isGoods);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_chart = [];
            $collection = collect($config['data']['list']);
            $data = $collection->SortByDesc('profit_ratio');
            if (count($data) === 0) {
                $data_chart = null;
            } else {
                $data_mix = $data->all();
                $i = 0;
                foreach ($data_mix as $db) {
                    $data_chart[$i] = array(
                        "timeline" => $db['food_name'],
                        "profit_ratio" => $db['profit_ratio']);
                    $i++;
                }
            }
            $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
            $detail = TEXT_DETAIL;
            $data_table = DataTables::of($data)
                ->addColumn('quantity', function ($row) {
                    return $this->numberFormat($row['quantity']);
                })
                ->addColumn('total_original_amount', function ($row) {
                    return $this->numberFormat($row['total_original_amount']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('profit', function ($row) {
                    return $this->numberFormat($row['profit']);
                })
                ->addColumn('total_profit', function ($row) {
                    return $this->numberFormat($row['total_profit']);
                })
                ->addColumn('profit_ratio', function ($row) {
                    return $this->numberFormat($row['profit_ratio']) . '%';
                })
                ->addColumn('type', function ($row) {
                    switch ($row['category_type']) {
                        case (int)Config::get('constants.type.category.FOOD'):
                            return TEXT_FOOD_FOOD;
                        case (int)Config::get('constants.type.category.DRINK'):
                            return TEXT_FOOD_DRINK;
                        case (int)Config::get('constants.type.category.OTHER'):
                            return TEXT_OTHER;
                        case (int)Config::get('constants.type.category.SEA_FOOD'):
                            return TEXT_SEA_FOOD;
                        default:
                            return '---';
                    }
                })
                ->addColumn('avatar', function ($row) use ($domain) {
                    $unit_name = $row['unit_name'] !== '' ? '<label class="label label-info m-t-2">'.$row['unit_name'] . '</label>' : '<label class="text text-warning">[Món ngoài menu]</label>';
                    if(mb_strlen($row['food_name']) > 30){
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . mb_substr($row['food_name'], 0, 27)  . '...' . '<br><label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i></label>'. $unit_name .'</label>';
                    } else {
                        return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')"/>
                         <label class="name-inline-data-table">' . $row['food_name'] . '<br><label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i></label>'.$unit_name.'</label>';
                    }
                })
                ->addColumn('action', function ($row) use ($brand, $branch, $type, $time, $detail, $isGift, $isCancel, $from, $to) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '" data-id="' . $row['food_id'] . '" data-name="' . $row['food_name'] . '" data-gift="' . $isGift . '" data-cancel="' . $isCancel . '" data-brand="' . $brand . '" data-branch="' . $branch . '" data-type="' . $type . '" data-time="' . $time . '" data-from="' . $from . '" data-to="' . $to . '" data-title="Chi tiết món ăn" onclick="openDetailProfitReport($(this))"><span class="icofont icofont-eye-alt"></span></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'avatar', 'profit_ratio'])
                ->addIndexColumn()
                ->make(true);
            $data_total = [
                'sum_quantity' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'quantity'))),
                'sum_total_original' => $this->numberFormat($config['data']['total_original_amount']),
                'sum_total' => $this->numberFormat($config['data']['total_amount']),
                'sum_profit' => $this->numberFormat($config['data']['total_profit_amount']),
            ];
            $data_total_chart = [
                'total_profit_ratio' => $this->numberFormat(array_sum(array_column($config['data']['list'], 'profit_ratio'))),
            ];
            return [$data_chart, $data_table, $data_total, $config, $data_total_chart];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
