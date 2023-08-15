<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class AssginCustomerController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'MARKETING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Gán khách hàng';
        return view('customer.assgin_customer.index', compact('active_nav'));
    }
    public function data(Request $request)
    {
        $is_assinge = ENUM_GET_ALL;
        $employee_id = $request->get('employee_id');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $page = ENUM_DEFAULT_PAGE;
        $limit = ENUM_DEFAULT_LIMIT_50000;
        $project_id = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_GET_CUSTOMER_EMPLOYEE_ASSIGN_CUSTOMER, $restaurant_brand_id , $is_assinge  , $page, $limit);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $collect = collect($config['data']['list']);
            $dataCustomerEmployee = $collect->where('is_assinge', ENUM_SELECTED)->where('employee_id', $employee_id);
            $dataCustomerNotEmployee = $collect->where('is_assinge', ENUM_DIS_SELECTED);
            $dataTableEmployee = DataTables::of($dataCustomerEmployee)
                ->addColumn('avatar', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    if (mb_strlen($row['name']) > 20) {
                        return '<div data-toggle="tooltip" data-placement="top" data-original-title="'. $row['name'] .'"><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                                    <label class="name-inline-data-table">'. (mb_substr($row['name'], 0, 20) . '...') .'<br>
                                          <label class="department-inline-name-data-table"><i class="icofont icofont-phone-circle"></i>'. $row['phone'] .'</label>
                                    </label>
                                </div>';
                    } else {
                        return '<div>
                                    <img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                                    <label class="name-inline-data-table">'. $row['name'] .'<br>
                                          <label class="department-inline-name-data-table"><i class="icofont icofont-phone-circle"></i>'. $row['phone'] .'</label>
                                    </label>
                                </div>';
                    }
                })

                ->addColumn('tag', function ($row) {
                    return $row['customer_tag_name'];
                })
                ->addColumn('gender', function ($row) {
                    if ($row['gender'] === TEXT_FEMALE_VALUE){
                        return  '<i class="ion-female mr-1 "></i>'.TEXT_FEMALE;
                    } else {
                        return '<i class="ion-male mr-1 text-primary"></i>'.TEXT_MALE;
                    }
                })
                ->addColumn('action', function ($row) {
//                    return '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer" data-type="1" onclick="unCheckAssignCustomerEmployee($(this))" data-id="' . $row['customer_id'] . '"></i>';
                    return '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-type="1" onclick="unCheckAssignCustomerEmployee($(this))" data-id="' . $row['customer_id'] . '"><i class="fi-rr-arrow-small-left"></i></button></div>';

                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['avatar', 'action' ,'gender'])
                ->addIndexColumn()
                ->make(true);
            $dataTableNotEmployee = DataTables::of($dataCustomerNotEmployee)
                ->addColumn('avatar', function ($row) {
                    $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA);
                    if (mb_strlen($row['name']) > 20) {
                        return '<div data-toggle="tooltip" data-placement="top" data-original-title="'. $row['name'] .'"><img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                                    <label class="name-inline-data-table">'. (mb_substr($row['name'], 0, 20) . '...') .'<br>
                                          <label class="department-inline-name-data-table"><i class="icofont icofont-phone-circle"></i>'. $row['phone'] .'</label>
                                    </label>
                                </div>';
                    } else {
                        return '<div>
                                    <img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['avatar'] . "'" . ')">
                                    <label class="name-inline-data-table">'. $row['name'] .'<br>
                                          <label class="department-inline-name-data-table"><i class="icofont icofont-phone-circle"></i>'. $row['phone'] .'</label>
                                    </label>
                                </div>';
                    }
                })
                ->addColumn('tag', function ($row) {
                    return $row['customer_tag_name'];
                })
                ->addColumn('gender', function ($row) {
                    if ($row['gender'] === TEXT_FEMALE_VALUE){
                        return  '<i class="ion-female mr-1 "></i>'.TEXT_FEMALE;
                    } else {
                        return '<i class="ion-male mr-1 text-primary"></i>'.TEXT_MALE;
                    }
                })
                ->addColumn('action', function ($row) {
//                    return '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" data-type="0" onclick="checkAssignCustomerEmployee($(this))" data-id="' . $row['customer_id'] . '"></i>';
                    return '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-type="0" onclick="checkAssignCustomerEmployee($(this))" data-id="' . $row['customer_id'] . '"><i class="fi-rr-arrow-small-right"></i></button> </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['avatar', 'action' , 'gender'])
                ->addIndexColumn()
                ->make(true);

            return [$dataTableNotEmployee,$dataTableEmployee , $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
    public function employee(Request $request)
    {
        $branch_id = $request->get('branch');
        $brand_id = $request->get('restaurant_brand_id');
        $is_include_restaurant_manager = Config::get('constants.type.checked.SELECTED');
        $status = Config::get('constants.type.status.GET_ALL');
        $is_take_myself = Config::get('constants.type.status.GET_ALL');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_EMPLOYEE_GET_DATA, $branch_id, $status, $is_include_restaurant_manager, $is_take_myself, $brand_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try{
            $collect = collect($config['data']['list']);
            $dataEmployee = $collect->where('status', ENUM_SELECTED)->all();
            $dataOption = '';
            foreach ($dataEmployee as $data){
                $dataOption .= '<option value="' . $data['id'] . '">' . $data['name'] . '</option>';
            }
            if ($dataOption === '') {
                $dataOption = '<option value="">' . TEXT_NULL_OPTION . '</option>';
            }
            return [$dataOption , $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
    public function assign(Request $request){
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_POST_ASSIGN_CUSTOMER_EMPLOYEE);
        $body = [
            "restaurant_brand_id" => $request->get('restaurant_brand_id'),
            "employee_id" => $request->get('employee_id'),
            "customer_insert_ids" => $request->get('customer_insert_ids'),
            "customer_delete_ids" => $request->get('customer_delete_ids')
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }
}
