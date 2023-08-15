<?php

namespace App\Http\Controllers\Treasurer;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use PhpParser\Node\Stmt\DeclareDeclare;
use Yajra\DataTables\Facades\DataTables;

class CashFundController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ADDITION_FEE_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Quỹ tiền mặt';
        return view('treasurer.cash_fund.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $date = $request->get('date');
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_CASH_FUND_GET_LIST, $branch, $date);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $dataCashFund = [];
            $a = 0;
            $index = 1;
            $count = 0;
            for ($i = 0; $i < count($data); $i++) {
                $dataCashFund[$a] = $data[$i];
                $dataCashFund[$a]['index'] = 1;
                if ($a > 0) {
                    if ($dataCashFund[$a]['fee_month'] === $dataCashFund[$a - 1]['fee_month']) {
                        $dataCashFund[$a]['index'] = $index;
                        $count++;
                    } else {
                        $index++;
                        $dataCashFund[$a]['index'] = $index;
                    }
                }
                $a++;
            }

            $tableCashFund = DataTables::of($dataCashFund)
                ->addColumn('addition_fee_reason_content', function ($row) {
                    return $row['addition_fee_reason_content'];
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('type', function ($row) {
                    if ($row['type'] === Config::get('constants.type.addition_fee.IN')) {
                        return '<div class="tag seemt-green seemt-bg-green d-flex">
                                     <i class="fi-rr-hastag"></i>
                                     <label class="m-0">'. TEXT_ADDITION_FEE_RECEIPT. '</label>
                                </div>';
                    } else {
                        return '<div class="tag seemt-red seemt-bg-red d-flex">
                                     <i class="fi-rr-hastag"></i>
                                     <label class="m-0">'. TEXT_ADDITION_FEE_PAYMENT .'</label>
                                </div>';

                    }
                })
                ->addColumn('total_revenue', function ($row) {
                    return $this->numberFormat($row['total_revenue']);
                })
                ->addColumn('total_cost', function ($row) {
                    return $this->numberFormat($row['total_cost']);
                })
                ->addColumn('total_accumulation', function ($row) {
                    return $this->numberFormat($row['total_accumulation']);
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['type'])
                ->addIndexColumn()
                ->make();
            $dataLength = count($config['data']);
            $totalAccumulate = $dataLength === 0 ? 0 : last($config['data'])['total_accumulation'];
            $dataTotal = [
                'total_revenue' => $this->numberFormat(array_sum(array_column($config['data'], 'total_revenue'))),
                'total_cost' => $this->numberFormat(array_sum(array_column($config['data'], 'total_cost'))),
                'total_accumulate' => $this->numberFormat($totalAccumulate),
                'total_amount' => $this->numberFormat(array_sum(array_column($config['data'], 'amount'))),
            ];
            return [$tableCashFund, $dataTotal, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
