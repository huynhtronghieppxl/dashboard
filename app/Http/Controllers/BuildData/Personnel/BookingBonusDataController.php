<?php

namespace App\Http\Controllers\BuildData\Personnel;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class BookingBonusDataController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission( ['OWNER', 'VIEW_ALL', 'SETTING_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(3);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Thưởng booking';
        return view('build_data.personnel.booking_bonus.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $id = ENUM_ID_NONE;
        $brand = $request->get('brand');
        $status = ENUM_GET_ALL;
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BOOKING_BONUS_GET, $id, $brand, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $collection = collect($config['data']);
            $dataEnable = $collection->where('is_applied', ENUM_SELECTED)->all();
            $dataDisable = $collection->where('is_applied', ENUM_DIS_SELECTED)->all();
            $tableEnable = DataTables::of($dataEnable)
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                                <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-id=" ' . $row['id'] . '" data-status=" ' . $row['is_applied'] . '" onclick="changeStatusBookingBonusData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                <button class="tabledit-edit-button btn  seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $row['id'] . '" data-brand="' . $row['restaurant_brand_id'] . '" data-name="' . $row['name'] . '" data-description="' . $row['description'] . '" data-amount="' . $this->numberFormat($row['amount']) . '"  data-bonus="' . $this->numberFormat($row['bonus_percent']) . '" onclick="openModalUpdateBookingBonusData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
                })
                ->addColumn('description', function ($row) {
                    return (mb_strlen($row['description']) > 30) ? mb_substr($row['description'], 0, 27) . '...' :  $row['description'];
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('bonus_percent', function ($row) {
                    return $this->numberFormat($row['bonus_percent']);
                })
                ->addColumn('keysearch', function ($row) {
                    $keysearch = [$row['name'], $row['amount'], $row['bonus_percent'], $row['description']];
                    return $this->keySearchDatatableTemplate($keysearch);
                })
                ->rawColumns(['action', 'description'])
                ->addIndexColumn()
                ->make(true);
            $tableDisable = DataTables::of($dataDisable)
                ->addColumn('action', function ($row){
                    return '<div class="btn-group btn-group-sm">
                                 <button class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light"  data-id=" ' . $row['id'] . '" data-status=" ' . $row['is_applied'] . '"onclick="changeStatusBookingBonusData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                            </div>';
                })
                ->addColumn('amount', function ($row) {
                    return $this->numberFormat($row['amount']);
                })
                ->addColumn('bonus_percent', function ($row) {
                    return $this->numberFormat($row['bonus_percent']);
                })
                ->addColumn('keysearch', function ($row) {
                    $keysearch = [$row['name'], $row['amount'], $row['bonus_percent'], $row['description']];
                    return $this->keySearchDatatableTemplate($keysearch);
                })
                ->addColumn('description', function ($row) {
                    return (mb_strlen($row['description']) > 30) ? mb_substr($row['description'], 0, 27) . '...' :  $row['description'];
                })
                ->rawColumns(['action', 'description'])
                ->addIndexColumn()
                ->make(true);

            $total = [
                'total_record_enable' => $this->numberFormat(count($dataEnable)),
                'total_record_disable' => $this->numberFormat(count($dataDisable))
            ];

            return [$tableEnable, $tableDisable, $total, $config];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function create(Request $request)
    {
        $brand = $request->get('brand');
        $name = $request->get('name');
        $description = $request->get('description');
        $amount = $request->get('amount');
        $bonus = $request->get('bonus');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_BONUS_POST_CREATE);
        $body = [
            'restaurant_brand_id' => $brand,
            'name' => $name,
            'description' => $description,
            'amount' => $amount,
            'bonus_percent' => $bonus,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
           if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS){
               $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" onclick="changeStatusBookingBonusData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                                                <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-name="' . $config['data']['name'] . '" data-description="' . $config['data']['description'] . '" data-amount="' . $config['data']['amount'] . '"  data-bonus="' . $config['data']['bonus_percent'] . '" data-brand="' . $config['data']['restaurant_brand_id'] . '" onclick="openModalUpdateBookingBonusData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                                            </div>';
               if (mb_strlen($config['data']['description']) > 30) $config['data']['description'] = mb_substr($config['data']['description'], 0, 27) . '...';
               $config['data']['amount'] = $this->numberFormat($config['data']['amount']);
               $config['data']['bonus_percent'] = $this->numberFormat($config['data']['bonus_percent']);
               $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
           }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $brand = $request->get('brand');
        $name = $request->get('name');
        $description = $request->get('description');
        $amount = $request->get('amount');
        $bonus = $request->get('bonus');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_BONUS_POST_UPDATE, $id);
        $body = [
            'restaurant_brand_id' => $brand,
            'name' => $name,
            'description' => $description,
            'amount' => $amount,
            'bonus_percent' => $bonus,
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try{
        if($config['status']===ENUM_HTTP_STATUS_CODE_SUCCESS) {
            if ($config['data']['is_applied'] === ENUM_SELECTED) {
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                            <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" onclick="changeStatusBookingBonusData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                            <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-brand="' . $config['data']['restaurant_brand_id'] . '" data-name="' . $config['data']['name'] . '" data-description="' . $config['data']['description'] . '" data-amount="' . $config['data']['amount'] . '"  data-bonus="' . $config['data']['bonus_percent'] . '" onclick="openModalUpdateBookingBonusData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><span class="fi-rr-pencil"></span></button>
                            </div>';
            } else {
                $config['data']['action'] = '<div class="btn-group btn-group-sm">
                                                <button class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '"  onclick="changeStatusBookingBonusData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>
                                            </div>';
            }
            if (mb_strlen($config['data']['description']) > 30) $config['data']['description'] = mb_substr($config['data']['description'], 0, 27) . '...';
            $config['data']['amount'] = $this->numberFormat($config['data']['amount']);
            $config['data']['bonus_percent'] = $this->numberFormat($config['data']['bonus_percent']);
            return $config;
        } else {
            return $config;
        }
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $api = sprintf(API_BOOKING_BONUS_POST_CHANGE_STATUS, $id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            if ($config['status'] === ENUM_HTTP_STATUS_CODE_SUCCESS) {
                if ($config['data']['is_applied'] === ENUM_SELECTED) {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                            <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-status=" ' . $config['data']['is_applied'] . '" onclick="changeStatusBookingBonusData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DISABLE_STATUS . '"><i class="fi-rr-cross"></i></button>
                            <button class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-brand="' . $config['data']['restaurant_brand_id'] . '" data-name="' . $config['data']['name'] . '" data-description="' . $config['data']['description'] . '" data-amount="' . $config['data']['amount'] . '"  data-bonus="' . $config['data']['bonus_percent'] . '" onclick="openModalUpdateBookingBonusData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><i class="fi-rr-pencil"></i></button>
                            </div>';
                } else {
                    $config['data']['action'] = '<div class="btn-group btn-group-sm">
                            <button class="tabledit-edit-button btn seemt-green seemt-btn-hover-green waves-effect waves-light"  data-id=" ' . $config['data']['id'] . '" data-status=" ' . $config['data']['is_applied'] . '" onclick="changeStatusBookingBonusData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_ENABLE . '"><i class="fi-rr-check"></i></button>

                            </div>';
                }
                if (mb_strlen($config['data']['description']) > 30) $config['data']['description'] = mb_substr($config['data']['description'], 0, 27) . '...';
                $config['data']['amount'] = $this->numberFormat($config['data']['amount']);
                $config['data']['bonus_percent'] = $this->numberFormat($config['data']['bonus_percent']);
                $config['data']['keysearch'] = $this->keySearchDatatableTemplate($config['data']);
            }
            return $config;
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }

    public function updateSetting(Request $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_POST;
        $minimum_order_amount_to_claim_bonus_from_booking = $request->get('price');
        $amount_bonus_booking_order_for_employee = $request->get('price_first');
        $maximum_bonus_count_booking_for_employee_second_phase = $request->get('second');
        $amount_bonus_booking_order_for_employee_second_phase = $request->get('price_second');
        $amount_bonus_booking_order_for_employee_third_phase = $request->get('price_three');
        $api =sprintf(API_CHANGE_BOOKING_BONUS_POST_DATA_EMPLOYEE, $id,);
        $body = [
            'minimum_order_amount_to_claim_bonus_from_booking' => $minimum_order_amount_to_claim_bonus_from_booking,
            'amount_bonus_booking_order_for_employee' => $amount_bonus_booking_order_for_employee,
            'maximum_bonus_count_booking_for_employee_second_phase' => $maximum_bonus_count_booking_for_employee_second_phase,
            'amount_bonus_booking_order_for_employee_third_phase' => $amount_bonus_booking_order_for_employee_third_phase,
            'amount_bonus_booking_order_for_employee_second_phase' => $amount_bonus_booking_order_for_employee_second_phase
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
    public function dataBookingSetting (Request  $request)
    {
        $id = $request->get('id');
        $project = ENUM_PROJECT_ID_ORDER;
        $method = ENUM_METHOD_GET;
        $api = sprintf(API_BRAND_GET_SETTING, $id);
        $body = null;
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
