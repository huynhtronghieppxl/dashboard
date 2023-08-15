<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PartnerInvoiceController extends Controller
{
    public function index()
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
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
        $active_nav = 'Hóa đơn điện tử';
        return view('setting.partner_invoice.index', compact('active_nav'));
    }

    public function data(Request $request){
        $restaurant_id = $request->get('restaurant_brand_id');
        $branch_id = $request->get('branch');
        $key_search = '';
        $status = ENUM_SELECTED;
        $partner_invoice_type = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_RESTAURANT_PARTNER_INVOICE_GET_LIST, $branch_id, $status, $partner_invoice_type, $key_search, $restaurant_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data_table = DataTables::of($config['data'])
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addColumn('action', function ($row){
                    return '<div class="btn-group btn-group-sm text-center">
                               <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdatePartnerInvoice($(this))"  data-type="'. $row['partner_electronic_invoice_type'] .'" data-id="'. $row['id'] .'" data-branch-id="'. $row['branch_id'] .'" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                           </div>';
                })
                ->rawColumns(['action', 'name'])
                ->addIndexColumn()
                ->make(true);
            return [$data_table, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataPartnerInvoice(Request $request){
        $type = ENUM_GET_ALL;
        $status = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_RESTAURANT_PARTNER_INVOICE_GET_LIST_PARTNER_INVOICE,$type, $status);
        $body = [];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $select = '<option value="" disabled selected>' . TEXT_DEFAULT_OPTION . '</option>';;
            foreach ($config['data'] as $db) {
                $select .= '<option data-type="'. $db['type'] .'" value="' . $db['id'] . '">' . $db['name'] . '</option>';
            };
            return [$select, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataUpdate(Request $request){
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_RESTAURANT_PARTNER_INVOICE_DETAIL, $id);
        $body = [];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $brand_id = $request->get('brand_id');
        $partner_invoice_id = $request->get('partner_invoice_id');
        $branch_id = $request->get('branch_id');
        $partner_electronic_invoice_type = $request->get('partner_electronic_invoice_type');
        $tax_code = $request->get('tax_code');
        $username = $request->get('username');
        $partner_identify_name = $request->get('partner_identify_name');
        $password = $request->get('password');
        $invoice_series = $request->get('invoice_series');
        $invoice_denominator = $request->get('invoice_denominator');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = API_RESTAURANT_PARTNER_INVOICE_POST_CREATE;
        $body = [
            'restaurant_brand_id' => $brand_id,
            'branch_id' => $branch_id,
            'partner_identify_name' => $partner_identify_name,
            'partner_electronic_invoice_type' => $partner_electronic_invoice_type,
            'tax_code' => $tax_code,
            'username' => $username,
            'password' => $password,
            'invoice_series' => $invoice_series,
            'invoice_denominator' => $invoice_denominator,
            'partner_invoice_id' => $partner_invoice_id
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }

    public function update(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $partner_electronic_invoice_type = $request->get('partner_electronic_invoice_type');
        $tax_code = $request->get('tax_code');
        $username = $request->get('username');
        $partner_identify_name = $request->get('partner_identify_name');
        $password = $request->get('password');
        $partner_invoice_id = $request->get('partner_invoice_id');
        $invoice_series = $request->get('invoice_series');
        $invoice_denominator = $request->get('invoice_denominator');
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_RESTAURANT_PARTNER_INVOICE_POST_UPDATE, $id);
        $body = [
            'branch_id' => $branch_id,
            'partner_electronic_invoice_type' => $partner_electronic_invoice_type,
            'partner_identify_name' => $partner_identify_name,
            'tax_code' => $tax_code,
            'username' => $username,
            'password' => $password,
            'invoice_series' => $invoice_series,
            'invoice_denominator' => $invoice_denominator,
            'partner_invoice_id' => $partner_invoice_id,
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
