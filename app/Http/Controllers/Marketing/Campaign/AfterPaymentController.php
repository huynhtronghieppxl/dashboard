<?php

namespace App\Http\Controllers\Marketing\Campaign;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use PhpParser\Node\Stmt\DeclareDeclare;
use Yajra\DataTables\DataTables;

class AfterPaymentController extends Controller
{

    public function index(Request $request)
    {
        $active_nav = 'Tin nhắn chăm sóc khách hàng';
        return view('customer.message.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $restaurant_brand_id = $request->get('brandId');
        $status = ENUM_STATUS_GET_ALL;
        $type = ENUM_STATUS_GET_ALL;
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_RESTAURANT_GREETINGS_GET, $restaurant_brand_id, $status, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate($project_id, $method, $api, $body);
        try {
            $data = collect($config['data']['list']);
            $data_table_pending = $data->where('status', 1)->all();
            $data_table_approved = $data->where('status', 2)->all();
            $data_table_enable = $data->where('status', 2)->where('is_running', 1)->all();
            $data_table_disable = $data->where('status', 2)->where('is_running', 0)->all();
            $data_table_denied = $data->where('status', 3)->all();
            $table_pending = DataTables::of($data_table_pending)
                ->addColumn('branch_name', function ($row) {
//                    if ($row['branch_id'] === 0) {
//                        return '<label class="text-inverse">Toàn bộ chi nhánh</label>';
//                    } else {
//                        return '<label class="text-inverse">' . $row['branch_name'] . '</label>';
//                    }
                    return '<label class="text-inverse">' . $row['restaurant_brand_name'] . '</label>';
                })
                ->addColumn('type', function ($row) {
                    switch ($row['type']){
                        case 2 :
                            $type = '<label class="text-inverse">Thông báo sinh nhật</label>';
                            break;
                        case 1 :
                            $type = '<label class="text-inverse">Thông báo sau bữa ăn</label>';
                            break;
                        case 3 :
                            $type = '<label class="text-inverse">Thông báo đăng ký thẻ thành viên thành công</label>';
                            break;
                        case 4 :
                            $type = '<label class="text-inverse">Thông báo lên cấp thẻ thành viên</label>';
                            break;
                        case 5 :
                            $type = '<label class="text-inverse">Thông báo được cộng điểm vào thẻ (nạp, tích lũy, khuyến mãi)</label>';
                            break;
                    }
                    return $type;
                })
                ->addColumn('content', function ($row) {
                    if (mb_strlen($row['content']) > 30) {
                        return mb_substr($row['content'], 0, 27) . '...';
                    } else {
                        return $row['content'];
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" style="float: none;margin: 5px;" onclick="removeCustomerMessage(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="Hủy duyệt thông báo">
                                    <i class="fi-rr-trash"></i>
                            </button>
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" style="float: none;margin: 5px;" data-id="' . $row['id'] . '" data-content="' . $row['content'] . '" data-branch-id="' . $row['restaurant_brand_id'] . '" data-restaurant-brand="' . $row['restaurant_id'] . '" data-type="' . $row['type'] . '" onclick="openModalUpdateCustomerMessage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '">
                                <i class="fi-rr-pencil"></i>
                            </button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailCustomerMessage($(this))" data-id="' . $row['id'] . '" data-content="' . $row['content'] . '" data-branch-id="' . $row['restaurant_brand_id'] . '" data-restaurant-brand-name="' . $row['restaurant_brand_name'] . '" data-type="' . $row['type'] . '" data-create="' . $row['create_at'] . '">
                                <i class="fi-rr-eye"></i>
                           </button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'type', 'content', 'branch_name'])
                ->addIndexColumn()
                ->make(true);
            $table_approved = DataTables::of($data_table_approved)
                ->addColumn('branch_name', function ($row) {
//                    if ($row['branch_id'] === 0) {
//                        return '<label class="text-inverse">Toàn bộ chi nhánh</label>';
//                    } else {
//                        return '<label class="text-inverse">' . $row['branch_name'] . '</label>';
//                    }
                    return '<label class="text-inverse">' . $row['restaurant_brand_name'] . '</label>';
                })
                ->addColumn('type', function ($row) {
                    switch ($row['type']){
                        case 2 :
                            $type = '<label class="text-inverse">Thông báo sinh nhật</label>';
                            break;
                        case 1 :
                            $type = '<label class="text-inverse">Thông báo sau bữa ăn</label>';
                            break;
                        case 3 :
                            $type = '<label class="text-inverse">Thông báo đăng ký thẻ thành viên thành công</label>';
                            break;
                        case 4 :
                            $type = '<label class="text-inverse">Thông báo lên cấp thẻ thành viên</label>';
                            break;
                        case 5 :
                            $type = '<label class="text-inverse">Thông báo được cộng điểm vào thẻ (nạp, tích lũy, khuyến mãi)</label>';
                            break;
                    }
                    return $type;
                })
                ->addColumn('content', function ($row) {
                    if (mb_strlen($row['content']) > 30) {
                        return mb_substr($row['content'], 0, 27) . '...';
                    } else {
                        return $row['content'];
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" style="float: none;margin: 5px;" onclick="changeIsRunningCustomerMessage($(this))" data-branch-id="' . $row['restaurant_brand_id'] . '" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '">
                                <i class="fi-rr-check"></i>
                            </button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" style="float: none;margin: 5px;" onclick="removeCustomerMessage(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_REMOVE . '">
                                    <i class="fi-rr-trash"></i>
                                </button>
                           <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailCustomerMessage($(this))" data-id="' . $row['id'] . '" data-content="' . $row['content'] . '" data-branch-id="' . $row['restaurant_brand_id'] . '" data-restaurant-brand-name="' . $row['restaurant_brand_name'] . '" data-type="' . $row['type'] . '" data-create="' . $row['create_at'] . '">
                                <i class="fi-rr-eye"></i>
                           </button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'type', 'content', 'branch_name'])
                ->addIndexColumn()
                ->make(true);
            $table_enable= DataTables::of($data_table_enable)
                ->addColumn('branch_name', function ($row) {
//                    if ($row['branch_id'] === 0) {
//                        return '<label class="text-inverse">Toàn bộ chi nhánh</label>';
//                    } else {
//                        return '<label class="text-inverse">' . $row['branch_name'] . '</label>';
//                    }
                    return '<label class="text-inverse">' . $row['restaurant_brand_name'] . '</label>';
                })
                ->addColumn('type', function ($row) {
                    switch ($row['type']){
                        case 2 :
                            $type = '<label class="text-inverse">Thông báo sinh nhật</label>';
                            break;
                        case 1 :
                            $type = '<label class="text-inverse">Thông báo sau bữa ăn</label>';
                            break;
                        case 3 :
                            $type = '<label class="text-inverse">Thông báo đăng ký thẻ thành viên thành công</label>';
                            break;
                        case 4 :
                            $type = '<label class="text-inverse">Thông báo lên cấp thẻ thành viên</label>';
                            break;
                        case 5 :
                            $type = '<label class="text-inverse">Thông báo được cộng điểm vào thẻ (nạp, tích lũy, khuyến mãi)</label>';
                            break;
                    }
                    return $type;
                })
                ->addColumn('content', function ($row) {
                    if (mb_strlen($row['content']) > 30) {
                        return mb_substr($row['content'], 0, 27) . '...';
                    } else {
                        return $row['content'];
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" style="float: none;margin: 5px;" onclick="changeStatusCustomerMessage($(this))" data-branch-id="' . $row['restaurant_brand_id'] . '" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '">
                                <i class="fi-rr-cross"></i>
                            </button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailCustomerMessage($(this))" data-id="' . $row['id'] . '" data-content="' . $row['content'] . '" data-branch-id="' . $row['restaurant_brand_id'] . '" data-restaurant-brand-name="' . $row['restaurant_brand_name'] . '" data-type="' . $row['type'] . '" data-create="' . $row['create_at'] . '">
                                <i class="fi-rr-eye"></i>
                           </button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'type', 'content', 'branch_name'])
                ->addIndexColumn()
                ->make(true);
            $table_disable = DataTables::of($data_table_disable)
                ->editColumn('branch_name', function ($row) {
//                    if ($row['branch_id'] === 0) {
//                        return '<label class="text-inverse">Toàn bộ chi nhánh</label>';
//                    } else {
//                        return '<label class="text-inverse">' . $row['branch_name'] . '</label>';
//                    }
                    return '<label class="text-inverse">' . $row['restaurant_brand_name'] . '</label>';
                })
                ->addColumn('type', function ($row) {
//                    $type;
                    switch ($row['type']){
                        case 2 :
                            $type = '<label class="text-inverse">Thông báo sinh nhật</label>';
                            break;
                        case 1 :
                            $type = '<label class="text-inverse">Thông báo sau bữa ăn</label>';
                            break;
                        case 3 :
                            $type = '<label class="text-inverse">Thông báo đăng ký thẻ thành viên thành công</label>';
                            break;
                        case 4 :
                            $type = '<label class="text-inverse">Thông báo lên cấp thẻ thành viên</label>';
                            break;
                        case 5 :
                            $type = '<label class="text-inverse">Thông báo được cộng điểm vào thẻ (nạp, tích lũy, khuyến mãi)</label>';
                            break;
                    }
                    return $type;
                })
                ->addColumn('content', function ($row) {
                    if (mb_strlen($row['content']) > 30) {
                        return mb_substr($row['content'], 0, 27) . '...';
                    } else {
                        return $row['content'];
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" style="float: none;margin: 5px;" onclick="changeStatusCustomerMessage($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-branch-id="' . $row['restaurant_brand_id'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '">
                                    <i class="fi-rr-check"></i>
                                </button>
                                 <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailCustomerMessage($(this))" data-id="' . $row['id'] . '" data-content="' . $row['content'] . '" data-branch-id="' . $row['restaurant_brand_id'] . '" data-restaurant-brand-name="' . $row['restaurant_brand_name'] . '" data-type="' . $row['type'] . '" data-create="' . $row['create_at'] . '">
                                <i class="fi-rr-eye"></i>
                           </button>
                            </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'type', 'content', 'branch_name'])
                ->addIndexColumn()
                ->make(true);
            $table_denied = DataTables::of($data_table_denied)
                ->addColumn('branch_name', function ($row) {
                    return '<label class="text-inverse">' . $row['restaurant_brand_name'] . '</label>';
                })
                ->addColumn('type', function ($row) {
                    switch ($row['type']){
                        case 2 :
                            $type = '<label class="text-inverse">Thông báo sinh nhật</label>';
                            break;
                        case 1 :
                            $type = '<label class="text-inverse">Thông báo sau bữa ăn</label>';
                            break;
                        case 3 :
                            $type = '<label class="text-inverse">Thông báo đăng ký thẻ thành viên thành công</label>';
                            break;
                        case 4 :
                            $type = '<label class="text-inverse">Thông báo lên cấp thẻ thành viên</label>';
                            break;
                        case 5 :
                            $type = '<label class="text-inverse">Thông báo được cộng điểm vào thẻ (nạp, tích lũy, khuyến mãi)</label>';
                            break;
                    }
                    return $type;
                })
                ->addColumn('content', function ($row) {
                    if (mb_strlen($row['content']) > 30) {
                        return mb_substr($row['content'], 0, 27) . '...';
                    } else {
                        return $row['content'];
                    }
                })
                ->addColumn('reason', function ($row) {
                    $reason = isset($row['reason']) ? $row['reason'] : '';
                    return $reason;
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light " data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" onclick="openModalDetailCustomerMessage($(this))" data-id="' . $row['id'] . '" data-content="' . $row['content'] . '" data-branch-id="' . $row['restaurant_brand_id'] . '" data-restaurant-brand-name="' . $row['restaurant_brand_name'] . '" data-type="' . $row['type'] . '" data-create="' . $row['create_at'] . '">
                                <i class="fi-rr-eye"></i>
                           </button>
                         </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->rawColumns(['action', 'type', 'content', 'branch_name'])
                ->addIndexColumn()
                ->make(true);
            $data_total = [
                'total_record_pending' => $this->numberFormat(count($data_table_pending)),
                'total_record_approved' => $this->numberFormat(count($data_table_approved)),
                'total_record_enable' => $this->numberFormat(count($data_table_enable)),
                'total_record_disable' => $this->numberFormat(count($data_table_disable)),
                'total_record_reason' => $this->numberFormat(count($data_table_denied))
            ];
            return [$table_pending, $table_approved, $table_enable, $table_disable, $table_denied, $config, $data_total];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function create(Request $request)
    {
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = API_RESTAURANT_GREETINGS_POST_CREATE;
        $body = [
            'restaurant_brand_id' => (int)$request->get('restaurant_brand_id'),
            'branch_id' => (int)$request->get('branch'),
            'type' => (int)$request->get('type'),
            'content' => $request->get('content'),
            'restaurant_greeting_image_template_id' => 0,
        ];
        return $this->callApiGatewayTemplate($project_id, $method, $api, $body);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_RESTAURANT_GREETINGS_POST_CHANGE_STATUS, $id);
        $body = [
            'branch_id' => (int)$request->get('branch_id'),
            'status' => $status
        ];
        $config = $this->callApiGatewayTemplate($project_id, $method, $api, $body);
//        if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
//            $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
//            if($config['data']['status'] === ENUM_SELECTED){
//                $config['data']['action'] = '<div class="btn-group btn-group-sm">
//                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" style="float: none;margin: 5px;" onclick="changeStatusCustomerMessage($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '">
//                                <i class="fi-rr-cross"></i>
//                            </button>
//                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" style="float: none;margin: 5px;" data-id="' . $config['data']['id'] . '" data-content="' . $config['data']['content'] . '" data-branch-id="' . $config['data']['branch_id'] . '" data-type="' . $config['data']['type'] . '" onclick="openModalUpdateCustomerMessage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '">
//                                <i class="fi-rr-pencil"></i>
//                            </button>
//                         </div>';
//            }else{
//                $config['data']['action'] = '<div class="btn-group btn-group-sm">
//                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" style="float: none;margin: 5px;" onclick="changeStatusCustomerMessage($(this))" data-id="' . $config['data']['id'] . '" data-status="' . $config['data']['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '">
//                                                    <i class="fi-rr-check"></i>
//                                                </button>
//                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" style="float: none;margin: 5px;" data-id="' . $config['data']['id'] . '" data-content="' . $config['data']['content'] . '" data-branch-id="' . $config['data']['branch_id'] . '" data-type="' . $config['data']['type'] . '" onclick="openModalUpdateCustomerMessage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '">
//                                                    <i class="fi-rr-pencil"></i>
//                                                </button>
//
//                                                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" style="float: none;margin: 5px;" onclick="removeCustomerMessage(' . $config['data']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_REMOVE . '">
//                                                    <i class="fi-rr-trash"></i>
//                                                </button>
//                                            </div>';
//            }
//            switch ($config['data']['type']){
//                case 2 :
//                    $config['data']['type'] = '<label class="text-inverse">Thông báo sinh nhật</label>';
//                    break;
//                case 1 :
//                    $config['data']['type'] = '<label class="text-inverse">Thông báo sau bữa ăn</label>';
//                    break;
//                case 3 :
//                    $config['data']['type'] = '<label class="text-inverse">Thông báo đăng ký thẻ thành viên thành công</label>';
//                    break;
//                case 4 :
//                    $config['data']['type'] = '<label class="text-inverse">Thông báo lên cấp thẻ thành viên</label>';
//                    break;
//                case 5 :
//                    $config['data']['type'] = '<label class="text-inverse">Thông báo được cộng điểm vào thẻ (nạp, tích lũy, khuyến mãi)</label>';
//                    break;
//            }
//            if (mb_strlen($config['data']['content']) > 30) {
//                $config['data']['content'] =  mb_substr($config['data']['content'], 0, 27) . '...';
//            }
//            if ($config['data']['branch_id'] === 0 ) {
//                $config['data']['branch_name'] = '<label class="text-inverse">Toàn bộ chi nhánh</label>';
//            } else {
//                $config['data']['branch_name'] = '<label class="text-inverse">' . $config['data']['branch_name'] . '</label>';
//            }
//        }
        return $config;
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');
        $branch = (int)$request->get('branch');
        $content = $request->get('content');
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_RESTAURANT_GREETINGS_POST_UPDATE, $id);
        $body = [
            'restaurant_brand_id' => $request->get('restaurant_brand_id'),
            'branch_id' => $branch,
            'content' => $content,
            'type' => $type,
            'restaurant_greeting_image_template_id' => 0,
        ];
        return $this->callApiGatewayTemplate($project_id, $method, $api, $body);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_RESTAURANT_GREETINGS_POST_DELETE, $id);
        $body = null;
        return $this->callApiGatewayTemplate($project_id, $method, $api, $body);
    }
    public function changeIsRunning(Request $request)
    {
        $id = $request->get('id');
        $project_id = ENUM_PROJECT_ID_JAVA_DASHBOARD;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_RESTAURANT_GREETINGS_POST_CHANGE_IS_RUNNING, $id);
        $body = [
//            'status' => 2,
//            'is_running' => 1
        ];
        return $this->callApiGatewayTemplate($project_id, $method, $api, $body);
    }

}
