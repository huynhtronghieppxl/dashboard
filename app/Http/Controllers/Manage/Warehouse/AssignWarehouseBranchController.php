<?php

namespace App\Http\Controllers\Manage\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class AssignWarehouseBranchController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(1);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Gán kho chi nhánh';
        return view('manage.warehouse.assign.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $status = ENUM_STATUS_GET_ACTIVE; // Lấy tất cả trạng thái
        $is_office = -1;
        $restaurant_brand_id = -1;
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_GET_WAREHOUSE_CENTER_BRANCH, $restaurant_brand_id, $status, $is_office);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $data = $config['data'];
            $collection = collect($data);
            $dataBranch = $collection->where('is_office', 0)->where('branch_office_id', 0)->all();
            $dataWarehouse = $collection->where('is_office', 1)->all();
            $dataTable = DataTables::of($dataBranch)
                ->addColumn('name', function ($row) {
                    return '<div>' . $row['name'] . '<i class="fi-rr-marker" style="display: block;font-size: 12px;">' . $row['address'] . '</i></div>';
                    return $row['address'];
                })
                ->addColumn('location', function ($row) {
                    return '0.1Km';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-type="0" onclick="checkAssignBranch($(this))" data-id="' . $row['id'] . '"><i class="fi-rr-arrow-small-right"></i></button> </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'name'])
                ->addIndexColumn()
                ->make(true);

            $option = '<option value="" disabled selected >' . TEXT_DEFAULT_OPTION . '</option>';
            foreach ($dataWarehouse as $db) {
                $option .= '<option value="' . $db['id'] . '">' . $db['name'] . '</option>';
            }
            return [$dataTable, $option, $config];

        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function dataBranchAssignWarehouse(Request $request)
    {
        $branch_office_id = $request->get('warehouse');
        $key_search = "";
        $api = sprintf(API_GET_WAREHOUSE_CENTER_BRANCH_OFFICE, $branch_office_id, $key_search);
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $dataTableBranch = DataTables::of($config['data'])
                ->addColumn('name', function ($row) {
                    return '<div>' . $row['name'] . '<i class="fi-rr-marker" style="display: block;font-size: 12px;">' . $row['address'] . '</i></div>';
                    return $row['address'];
                })
                ->addColumn('location', function ($row) {
                    return '0.1Km';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-type="1" onclick="unCheckAssignBranch($(this))" data-id="' . $row['id'] . '"><i class="fi-rr-arrow-small-left"></i></button></div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'name'])
                ->addIndexColumn()
                ->make(true);
            return [$dataTableBranch, $config];

        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function assign(Request $request)
    {
        $id = $request->get('warehouse');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_ASSIGN_WAREHOUSE_CENTER_BRANCH, $id);
        $body = [
            "branch_ids" => $request->get('branch_id_assign'),
            "branch_ids_unassign" => $request->get('branch_id_un_assign'),
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }
}
