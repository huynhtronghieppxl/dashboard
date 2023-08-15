<?php

namespace App\Http\Controllers\BuildData\AssignSupplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class  AssignBranchSupplierDataController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Gán nhà cung cấp về chi nhánh';
        return view('build_data.assign_supplier.branch.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $is_restaurant_supplier = ENUM_GET_ALL;
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_SUPPLIER_GET_ASSIGNED_TO_BRANCH, $branch_id, $is_restaurant_supplier, $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $collection = collect($data);
            $data_enable = $collection->where('status', ENUM_SELECTED);
            $data_selected = $data_enable->where('is_take_my_supplier', ENUM_SELECTED)->all();
            $data_unselected = $data_enable->where('is_take_my_supplier', ENUM_DIS_SELECTED)->all();

            $data_table_selected = DataTables::of($data_selected)
                ->addColumn('name', function ($row) {
                    $type_supplier = $row['is_restaurant_supplier']  == 0 ? '<label class="label label-success">'. TEXT_SYSTEM_SUPPLIER .'</label>' :  '';
                    return '<label> ' . $row['name'] . '</label><br>'. $type_supplier .'<input class="d-none" value="' . $row['id'] . '"/>';
                })
                ->addColumn('supplier-type', function ($row) {
                    if ($row['is_restaurant_supplier'] == ENUM_SELECTED) {
                        return TEXT_RESTAURANT_SUPPLIER;
                    } else {
                        return TEXT_SYSTEM_SUPPLIER;
                    }
                })
                ->addColumn('address', function ($row) {
                    return $row['address'] === null ? '' : $row['address'];
                })
                ->addColumn('action', function ($row) {
                    return '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer" onclick="unCheckBranchSupplierData($(this))" data-id="' . $row['id'] . '"></i>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'name'])
                ->make(true);

            $data_table_unselected = DataTables::of($data_unselected)
                ->addColumn('name', function ($row) {
                    $type_supplier  = $row['is_restaurant_supplier']  == 0 ? '<label class="label label-success">'. TEXT_SYSTEM_SUPPLIER .'</label>' :  '';
                    return '<label> ' . $row['name'] . '</label><br>'. $type_supplier .'<input class="d-none" value="' . $row['id'] . '"/>';
                })
                ->addColumn('supplier-type', function ($row) {
                    if ($row['is_restaurant_supplier'] == ENUM_SELECTED) {
                        return TEXT_RESTAURANT_SUPPLIER;
                    } else {
                        return TEXT_SYSTEM_SUPPLIER;
                    }
                })
                ->addColumn('address', function ($row) {
                    $address = ($row['address'] === null) ? '' : $row['address'];
                    return $address;
                })
                ->addColumn('action', function ($row) {
                    return '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" onclick="checkBranchSupplierData($(this))" data-id="' . $row['id'] . '"></i>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'name'])
                ->make(true);

            return [$data_table_selected, $data_table_unselected, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_SUPPLIER_POST_ASSIGN_TO_RESTAURANT_BRANCH;
        $body = [
            "supplier_ids" => $request->get('supplier_ids'),
            "branch_id" => $request->get('branch_id')
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }

    public function updateAll(Request $request)
    {
        $project = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_SUPPLIER_POST_ASSIGN_TO_RESTAURANT_BRANCHES;
        $body = [
            "restaurant_brand_id" => $request->get('restaurant_brand_id'),
            "branch_ids" => $request->get('branch_ids')
        ];
        return $this->callApiGatewayTemplate($project, $method, $api, $body);
    }
}
