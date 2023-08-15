<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class RevenueExpenditureBookReportController extends Controller
{
    public function index(Request $request)
    {
        $isTMS = $this->checkTMS($request, Config::get('constants.is_check.level.TWO'));
        if ($isTMS === false) {
            return view('errors.404');
        }
        $active_nav = 'report.revenue_expenditure_book';
        return view('report.revenue_expenditure_book.index', compact('active_nav'));
    }
    public function data(Request $request)
    {
        $isTMS = $this->checkTMS($request, Config::get('constants.is_check.level.TWO'));
        if ($isTMS === false) {
            return false;
        }
        $client = $this->getClient($request);
        $branch_id = session()->get(SESSION_KEY_BRANCH_ID);
        $date = '';
        $from = '';
        $to = '';
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $response = $client->request('GET', $this->getBaseUrl(sprintf(API_WORK_HISTORY_GET_LIST, $branch_id, $from, $to, $page)), [
            'http_errors' => false,
        ]);
        $db = $response->getBody();
        $config = json_decode($db, true);
        try {
            $data = $config['data']['list'];
            // data table
            $data_table = DataTables::of($data)
                ->addColumn('open_employee', function ($row) {
                    return $row['open_employee']['name'];
                })
                ->addColumn('close_employee', function ($row) {
                    return $row['close_employee']['name'];
                })
                ->addColumn('before_cash', function ($row) {
                    return $this->numberFormat($row['before_cash']);
                })
                ->addColumn('after_cash', function ($row) {
                    return $this->numberFormat($row['after_cash']);
                })
                ->addColumn('cash_amount', function ($row) {
                    return $this->numberFormat($row['cash_amount']);
                })
                ->addColumn('bank_amount', function ($row) {
                    return $this->numberFormat($row['bank_amount']);
                })
                ->addColumn('total_amount', function ($row) {
                    return $this->numberFormat($row['total_amount']);
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" onclick=""><span class="icofont icofont-eye-alt"></span></button>
                         </div>';
                })
                ->rawColumns(['action', 'avatar'])
                ->addIndexColumn()
                ->make(true);
            // data total
            $data_total = [
                'total' => '',
            ];

            return $data_response = [$data_table, $data_total];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }
}
