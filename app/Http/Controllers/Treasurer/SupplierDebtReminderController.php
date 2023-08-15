<?php

namespace App\Http\Controllers\Treasurer;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class SupplierDebtReminderController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'treasurer.supplier-debt-reminder';
        return view('treasurer.supplier_debt_reminder.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $supplier = Config::get('constants.type.id.NONE');
        $branch = $request->get('branch');
        $status = Config::get('constants.type.checkbox.GET_ALL');
        $from = Config::get('constants.type.data.NONE');
        $to = Config::get('constants.type.data.NONE');
        $page = ($request->get('start') + $request->get('length')) / $request->get('length');
        $limit = 100;
        $key = $this->keySearch(($request->get('search'))['value']);
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(Config::get('constants.api.API_GET_SUPPLIER_DEBT_REMINDER'), $supplier, $branch, $status, $from, $to, $page, $limit, $key);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $detail = TEXT_DETAIL;
            for ($i = 0; $i < count($config['data']['list']); $i++) {
                $config['data']['list'][$i]['index'] = ($page - 1) * $limit + $i + 1;
                $config['data']['list'][$i]['keysearch'] = $this->keySearchDatatableTemplate($config['data']['list']);
                $config['data']['list'][$i]['code'] = '<label class="text-primary">' . $config['data']['list'][$i]['code'] . '</label>';
                $config['data']['list'][$i]['employee_created_full_name'] = '---';
                $config['data']['list'][$i]['total_amount_reality'] = $this->numberFormat($config['data']['list'][$i]['amount']);
                $config['data']['list'][$i]['action'] = '<div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="openDetailOrderSupplierOrder(' . $config['data']['list'][$i]['order_id'] . ',' . $config['data']['list'][$i]['branch_id'] . ', ' . $config['data']['list'][$i]['restaurant_brand_id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $detail . '"><span class="icofont icofont-eye-alt"></span></button>
                                                </div>';
                if ($config['data']['list'][$i]['is_retention_money'] === Config::get('constants.type.checkbox.SELECTED')) {
                    $config['data']['list'][$i]['retention_money'] = '<div class="checkbox-fade fade-in-primary m-0"><label>
                                                                           <input type="checkbox" value="' . $config['data']['list'][$i]['order_id'] . '" class="checkbox-order-retention-money-bill-liabilities" checked/>
                                                                           <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                      </label></div>';
                } else {
                    $config['data']['list'][$i]['retention_money'] = '<div class="checkbox-fade fade-in-primary m-0"><label>
                                                                           <input type="checkbox" value="' . $config['data']['list'][$i]['order_id'] . '" class="checkbox-order-retention-money-bill-liabilities"/>
                                                                           <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                      </label></div>';
                }

            }
            $dataTable = array(
                'draw' => $request->get('draw'),
                'recordsTotal' => $config['data']['total_record'],
                'recordsFiltered' => $config['data']['total_record'],
                'data' => $config['data']['list'],
                'totalAmount' => $this->numberFormat($config['data']['total_amount']),
                'key' => $key,
                'page' => $page,
                'config' => $config
            );
            return json_encode($dataTable);
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
