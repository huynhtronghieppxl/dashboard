<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $active_nav = 'Tin nhắn tự động';
        return view('customer.message.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch_id = $request->get('branch_id');
        $status = -1;
        $type = -1;
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_RESTAURANT_GREETINGS_GET, $branch_id, $status, $type);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
        try {
            $data = $config['data'];
            $data_enable = [];
            $data_disable = [];
            $a = 0;
            $b = 0;
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['status'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    $data[$i]['status_text'] = '<label class="text-success">' . TEXT_STATUS_ENABLE . '</label>';
                    $data_enable[$a] = $data[$i];
                    $a++;
                } else {
                    $data[$i]['status_text'] = '<label class="text-inverse">' . TEXT_DISABLE_STATUS . '</label>';
                    $data_disable[$b] = $data[$i];
                    $b++;
                }
            }
            $data_table_enable = DataTables::of($data_enable)
                ->addColumn('branch_name', function ($row) {
                    if ($row['branch_name'] == '') {
                        return '<label class="text-inverse">Toàn bộ chi nhánh</label>';
                    } else {
                        return '<label class="text-inverse">' . $row['branch_name'] . '</label>';
                    }
                })
                ->addColumn('type', function ($row) {
                    if ($row['type'] == 2) {
                        return '<label class="text-inverse">Thông báo sinh nhật</label>';
                    } else if ($row['type'] == 1) {
                        return '<label class="text-inverse">Thông báo sau bữa ăn</label>';
                    } else if ($row['type'] == 3) {
                        return '<label class="text-inverse">Thông báo đăng ký thẻ thành viên thành công</label>';
                    } else if ($row['type'] == 4) {
                        return '<label class="text-inverse">Thông báo lên cấp thẻ thành viên</label>';
                    } else if ($row['type'] == 5) {
                        return '<label class="text-inverse">Thông báo được cộng điểm vào thẻ (nạp, tích lũy, khuyến mãi)</label>';
                    }
                })
                ->addColumn('content', function ($row) {
                    if (mb_strlen($row['content']) > 30) {
                        return mb_substr($row['content'], 0, 25) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['content'] . '"></i>';
                    } else {
                        return $row['content'];
                    }
                })
                ->addColumn('action', function ($row) {
                    $disable = TEXT_DISABLE_STATUS;
                    $update = TEXT_UPDATE;
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;" onclick="changeStatusCustomerMessage($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '">
                                <span class="icofont icofont-ui-close"></span>
                            </button>
                            <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" style="float: none;margin: 5px;" data-id="' . $row['id'] . '" data-content="' . $row['content'] . '" data-branch-id="' . $row['branch_id'] . '" data-type="' . $row['type'] . '" onclick="openModalUpdateCustomerMessage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '">
                                <span class="icofont icofont-ui-edit"></span>
                            </button>
                         </div>';
                })
                ->rawColumns(['action', 'status_text', 'type', 'content', 'branch_name'])
                ->addIndexColumn()
                ->make(true);;
            $data_table_disable = DataTables::of($data_disable)
                ->editColumn('branch_name', function ($row) {
                    if ($row['branch_name'] == '') {
                        return '<label class="text-inverse">Toàn bộ chi nhánh</label>';
                    } else {
                        return '<label class="text-inverse">' . $row['branch_name'] . '</label>';
                    }
                })
                ->editColumn('type', function ($row) {
                    if ($row['type'] == 2) {
                        return '<label class="text-inverse">Thông báo sinh nhật</label>';
                    } else if ($row['type'] == 1) {
                        return '<label class="text-inverse">Thông báo sau bữa ăn</label>';
                    } else if ($row['type'] == 3) {
                        return '<label class="text-inverse">Thông báo đăng ký thẻ thành viên thành công</label>';
                    } else if ($row['type'] == 4) {
                        return '<label class="text-inverse">Thông báo lên cấp thẻ thành viên</label>';
                    } else if ($row['type'] == 5) {
                        return '<label class="text-inverse">Thông báo được cộng điểm vào thẻ (nạp, tích lũy, khuyến mãi)</label>';
                    }
                })
                ->addColumn('content', function ($row) {
                    if (mb_strlen($row['content']) > 30) {
                        return mb_substr($row['content'], 0, 25) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['content'] . '"></i>';
                    } else {
                        return $row['content'];
                    }
                })
                ->addColumn('action', function ($row) {
                    $enable = TEXT_ENABLE;
                    $update = TEXT_UPDATE;
                    $delete = TEXT_REMOVE;
                    return '<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn btn-success waves-effect waves-light" style="float: none;margin: 5px;" onclick="changeStatusCustomerMessage($(this))" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '">
                                <span class="icofont icofont-ui-check"></span>
                            </button>
                            <button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;" onclick="removeCustomerMessage(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $delete . '">
                                <span class="icofont icofont-ui-delete" title="Xóa"></span>
                            </button>
                            <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" style="float: none;margin: 5px;" data-id="' . $row['id'] . '" data-content="' . $row['content'] . '" data-branch-id="' . $row['branch_id'] . '" data-type="' . $row['type'] . '" onclick="openModalUpdateCustomerMessage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '">
                                <span class="icofont icofont-ui-edit"></span>
                            </button>
                         </div>';
                })
                ->rawColumns(['action', 'status_text', 'type', 'content', 'branch_name'])
                ->addIndexColumn()
                ->make(true);;
            $data_total = [
                'total_record_enable' => $this->numberFormat($a),
                'total_record_disable' => $this->numberFormat($b)
            ];
            return [$data_table_enable, $data_table_disable, $data_total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }

    }

    public function create(Request $request)
    {
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_RESTAURANT_GREETINGS_POST_CREATE);
        $body = [
            'branch_id' => $request->get('branch'),
            'type' => $request->get('type'),
            'content' => $request->get('content'),
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_RESTAURANT_GREETINGS_POST_CHANGE_STATUS, $id);
        $body = [
            'branch_id' => $request->get('branch_id')
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
//        try {
//            $update = TEXT_UPDATE;
//            $enable = TEXT_ENABLE;
//            $disable = TEXT_DISABLE_STATUS;
//            $delete = TEXT_REMOVE;
//            if ($config['data']['status'] === Config::get('constants.type.checkbox.DIS_SELECTED')) {
//                $config['data']['action'] = '<div class="btn-group btn-group-sm">
//                            <button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;" onclick="changeStatusCustomerMessage(' . ['data']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $disable . '">
//                                <span class="icofont icofont-ui-close"></span>
//                            </button>
//                            <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" style="float: none;margin: 5px;" data-id="' . ['data']['id'] . '" data-content="' . ['data']['content'] . '" data-branch-id="' . ['data']['branch_id'] . '" data-type="' . ['data']['type'] . '" onclick="openModalUpdateCustomerMessage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '">
//                                <span class="icofont icofont-ui-edit"></span>
//                            </button>
//                         </div>';
//            } else {
//                $config['data']['action'] = '<div class="btn-group btn-group-sm">
//                            <button type="button" class="tabledit-edit-button btn btn-success waves-effect waves-light" style="float: none;margin: 5px;" onclick="changeStatusCustomerMessage(' . ['data']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $enable . '">
//                                <span class="icofont icofont-ui-check"></span>
//                            </button>
//                            <button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;" onclick="removeCustomerMessage(' . ['data']['id'] . ')" data-toggle="tooltip" data-placement="top" data-original-title="' . $delete . '">
//                                <span class="icofont icofont-ui-delete" title="Xóa"></span>
//                            </button>
//                            <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" style="float: none;margin: 5px;" data-id="' . ['data']['id'] . '" data-content="' . ['data']['content'] . '" data-branch-id="' . ['data']['branch_id'] . '" data-type="' . ['data']['type'] . '" onclick="openModalUpdateCustomerMessage($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . $update . '">
//                                <span class="icofont icofont-ui-edit"></span>
//                            </button>
//                         </div>';
//            }

//        }catch (Exception $e){
//            return $this->catchTemplate($config, $e);
//        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');
        $branch = $request->get('branch');
        $content = $request->get('content');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_RESTAURANT_GREETINGS_POST_UPDATE, $id);
        $body = [
            'branch_id' => $branch,
            'content' => $content,
            'type' => $type
        ];
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $project_id = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_RESTAURANT_GREETINGS_POST_DELETE, $id);
        $body = null;
        return $this->callApiGatewayTemplate2($project_id, $method, $api, $body);
    }
}
