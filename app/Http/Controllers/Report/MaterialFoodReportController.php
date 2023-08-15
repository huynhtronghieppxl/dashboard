<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class MaterialFoodReportController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = $this->checkPermission(['OWNER', 'VIEW_ALL', 'ACCOUNTING_MANAGER', 'ACCOUNTANT_ACCESS', 'ADDITION_FEE_MANAGER']);
        if($checkPermission[0] === false) {
            $notify_permission = $checkPermission[1];
            return view('errors.403', compact('notify_permission'));
        }
        $checkLevel = $this->checkLevel(1);
        if($checkLevel[0] === false) {
            $notify_permission = $checkLevel[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $check_is_office = $this->checkOffice(0);
        if($check_is_office[0] === false) {
            $notify_permission = $check_is_office[1];
            return view('errors.403_1', compact('notify_permission'));
        }
        $active_nav = 'Nguyên liệu món ăn';
        return view('report.material_food.index', compact('active_nav'));
    }

    public function data(Request $request)
    {
        $branch = $request->get('branch');
        $type = $request->get('type');
        $time = $request->get('time');
        $from = $request->get('from_date');
        $to = $request->get('to_date');
        $inventory = Config::get('constants.type.inventory.MATERIAL');
        $api = sprintf(API_REPORT_GET_MATERIAL_FOOD_V2, $branch, $inventory, $type, $time, $from, $to);
        $body = null;
        $requestMaterial = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $inventory = Config::get('constants.type.inventory.GOODS');
        $api = sprintf(API_REPORT_GET_MATERIAL_FOOD_V2, $branch, $inventory, $type, $time, $from, $to);
        $body = null;
        $requestGoods = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $inventory = Config::get('constants.type.inventory.INTERNAL');
        $api = sprintf(API_REPORT_GET_MATERIAL_FOOD_V2, $branch, $inventory, $type, $time, $from, $to);
        $body = null;
        $requestInternal = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $inventory = Config::get('constants.type.inventory.OTHER');
        $api = sprintf(API_REPORT_GET_MATERIAL_FOOD_V2, $branch, $inventory, $type, $time, $from, $to);
        $body = null;
        $requestOther = [
            'project' => ENUM_PROJECT_ID_JAVA_REPORT,
            'method' => ENUM_METHOD_GET,
            'api' => $api,
            'body' => $body,
        ];
        $configAll = $this->callApiMultiGatewayTemplate2([$requestMaterial, $requestGoods, $requestInternal, $requestOther]);
        try {
            $dataMaterial = [];
            $dataGoods = [];
            $dataMaterialInternal = [];
            $dataOther = [];
            $index1 = 1;
            $index2 = 1;
            $index3 = 1;
            $index4 = 1;
            for ($i = 0; $i < count($configAll[0]['data']); $i++) {
                $dataMaterial[$i] = $configAll[0]['data'][$i];
                $dataMaterial[$i]['index'] = 1;
                if ($i > 0) {
                    if ($dataMaterial[$i]['restaurant_material_id'] === $dataMaterial[$i - 1]['restaurant_material_id']) {
                        $dataMaterial[$i]['index'] = $index1;
                    } else {
                        $index1++;
                        $dataMaterial[$i]['index'] = $index1;
                    }
                }
            }
            for ($i = 0; $i < count($configAll[1]['data']); $i++) {
                $dataGoods[$i] = $configAll[1]['data'][$i];
                $dataGoods[$i]['index'] = 1;
                if ($i > 0) {
                    if ($dataGoods[$i]['restaurant_material_id'] === $dataGoods[$i - 1]['restaurant_material_id']) {
                        $dataGoods[$i]['index'] = $index2;
                    } else {
                        $index2++;
                        $dataGoods[$i]['index'] = $index2;
                    }
                }
            }
            for ($i = 0; $i < count($configAll[2]['data']); $i++) {
                $dataMaterialInternal[$i] = $configAll[2]['data'][$i];
                $dataMaterialInternal[$i]['index'] = 1;
                if ($i > 0) {
                    if ($dataMaterialInternal[$i]['restaurant_material_id'] === $dataMaterialInternal[$i - 1]['restaurant_material_id']) {
                        $dataMaterialInternal[$i]['index'] = $index3;
                    } else {
                        $index3++;
                        $dataMaterialInternal[$i]['index'] = $index3;
                    }
                }
            }
            for ($i = 0; $i < count($configAll[3]['data']); $i++) {
                $dataOther[$i] = $configAll[3]['data'][$i];
                $dataOther[$i]['index'] = 1;
                if ($i > 0) {
                    if ($dataOther[$i]['restaurant_material_id'] === $dataOther[$i - 1]['restaurant_material_id']) {
                        $dataOther[$i]['index'] = $index4;
                    } else {
                        $index4++;
                        $dataOther[$i]['index'] = $index4;
                    }
                }
            }
            $dataTableMaterial = $this->drawTableMaterialFoodReport($dataMaterial);
            $dataTableGoods = $this->drawTableMaterialFoodReport($dataGoods);
            $dataTableInternal = $this->drawTableMaterialFoodReport($dataMaterialInternal);
            $dataTableOther = $this->drawTableMaterialFoodReport($dataOther);
            if (count($dataMaterial) === 0) $index1 = 0;
            if (count($dataGoods) === 0) $index2 = 0;
            if (count($dataMaterialInternal) === 0) $index3 = 0;
            if (count($dataOther) === 0) $index4 = 0;
            $dataTotal = [
                'total_record_material' => $this->numberFormat($index1),
                'total_record_goods' => $this->numberFormat($index2),
                'total_record_internal' => $this->numberFormat($index3),
                'total_record_other' => $this->numberFormat($index4),
            ];
            return $data_res = [$dataTableMaterial, $dataTableGoods, $dataTableInternal, $dataTableOther, $dataTotal, $configAll];
        } catch (Exception $e) {
            return $this->catchTemplate($configAll, $e);
        }
    }

    public function drawTableMaterialFoodReport($data)
    {
        return DataTables::of($data)
            ->addColumn('restaurant_material_name', function ($row) {
                return (mb_strlen($row['restaurant_material_name']) > 30) ? $row['restaurant_material_name'] = mb_substr($row['restaurant_material_name'], 0, 27) . '...' : $row['restaurant_material_name'];
            })
            ->addColumn('material_category_type_name', function ($row) {
                return (mb_strlen($row['material_category_type_name']) > 30) ? $row['material_category_type_name'] = mb_substr($row['material_category_type_name'], 0, 27) . '...' : $row['material_category_type_name'];
            })
            ->addColumn('food_name', function ($row) {
                $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
//                if (mb_strlen($row['food_name']) > 30) {
//                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')" style="object-fit:cover;"/>
//                            <label class="name-inline-data-table">' . mb_substr($row['food_name'], 0, 27) . '...</label>';
//                }else{
//                    return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['food_avatar'] . '" class="img-inline-name-data-table" onclick="modalImageComponent(' . "'" . $domain . $row['food_avatar'] . "'" . ')" style="object-fit:cover;"/>
//                         <label class="name-inline-data-table">' . $row['food_name'] . '</label>';
//                }
                return mb_strlen($row['food_name']) > 30 ? mb_substr($row['food_name'], 0, 27) . '...' : $row['food_name'];
            })
            ->addColumn('system_last_big_quantity', function ($row) {
                return $this->numberFormat($row['system_last_big_quantity']);
            })
            ->addColumn('food_total_quantity', function ($row) {
                return $this->numberFormat($row['food_total_quantity']);
            })
            ->addColumn('material_quantity_in_recipe', function ($row) {
                return $this->numberFormat($row['material_quantity_in_recipe']);
            })
            ->addColumn('material_total_quantity', function ($row) {
                return $this->numberFormat($row['material_total_quantity']);
            })
            ->addColumn('material_total_quantity_used', function ($row) {
                return $this->numberFormat($row['material_total_quantity_used']);
            })
            ->addColumn('material_total_big_quantity_used', function ($row) {
                return $this->numberFormat($row['material_total_big_quantity_used']);
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['food_avatar', 'food_name', 'system_last_big_quantity'])
            ->addIndexColumn()
            ->make(true);
    }
}
