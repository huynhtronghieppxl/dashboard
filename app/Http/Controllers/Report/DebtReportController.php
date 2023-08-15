<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class DebtReportController extends Controller
{
    public function index()
    {
        $active_nav = 'Báo cáo công nợ';
        return view('report.debt.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $brand = $request->get('brand');
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $supplier = ENUM_ID_NONE;
        $project = ENUM_PROJECT_ID_JAVA_REPORT;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_REPORT_GET_SUPPLIER_DEBT, $brand, $branch, $type, $time, $from, $to, $supplier);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data']['list'];
            $dataTable = DataTables::of($data)
                ->addColumn('debt_amount', function ($row) {
                    return $this->numberFormat($row['debt_amount']);
                })
                ->addColumn('watting_payment', function ($row) {
                    return $this->numberFormat($row['watting_payment']);
                })
                ->addColumn('paid_amount', function ($row) {
                    return $this->numberFormat($row['paid_amount']);
                })
                ->addColumn('owed_amount', function ($row) {
                    return $this->numberFormat($row['owed_amount']);
                })
                ->addColumn('action', function ($row) use ($type) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" data-id="' . $row['supplier_id'] .'" data-type="'. $type .'" onclick="openModalDetailSupplierDebtReport($(this))"><span class="icofont icofont-eye-alt"></span></button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'debt_amount', 'watting_payment', 'paid_amount', 'owed_amount', 'keysearch'])
                ->addIndexColumn()
                ->make(true);
            return [$dataTable, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
