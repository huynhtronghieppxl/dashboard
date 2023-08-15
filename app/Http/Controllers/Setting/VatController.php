<?php

namespace App\Http\Controllers\Setting;

use Akaunting\Money\Money;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\Double;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CoursesTemplateExport;
use Yajra\DataTables\Html\Editor\Fields\Number;
use function GuzzleHttp\json_decode;

class VatController extends Controller
{
    public function index()
    {
        $active_nav = 'VAT';
        return view('setting.vat.index', compact('active_nav'));
    }

    public function data()
    {
        $status = Config::get('constants.type.checkbox.SELECTED');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.TMS');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_VAT_BRAND_MANAGE, $status);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        try {
            $dataNotUpdate = count($config['data']);
            $tableNotVatUpdate = Datatables::of($config['data'])
                ->addColumn('percent', function ($row) {
                    return $row['percent'] . '%';
                })
                ->addColumn('admin_percent', function ($row) {
                    return $row['admin_percent'] . '%';
                })
                ->addColumn('vat_config_id', function ($row) {
                    return $row['vat_config_id'];
                })
                ->addColumn('action', function ($row) {
                    if ($row['is_updated'] == 1) {
                        return '<div class="btn-group btn-group-sm text-center">
                            <button type="button" class="tabledit-edit-button  btn btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_NO_ACTIVE_STATUS . '" onclick="confirmVatSetting($(this))" data-id="' . $row['vat_config_id'] . '"  data-vat-admin="' . $row['admin_percent'] . "%" . '" data-is-updated="' . $row['is_updated'] . '">
                                 <span class="text-danger icofont icofont-warning-alt"></span>
                            </button>
                        </div>';
                    }
                })
                ->addColumn('detail_food', function ($row){
                    return '<div class="btn-group btn-group-sm text-center">
                        <button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" data-id="' . $row['id'] . '" onclick="openModalUpdateVATConfig($(this))" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_UPDATE . '"><span class="icofont icofont-ui-edit"></span></button>
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="' . TEXT_DETAIL . '" onclick="openModalDetailVatSetting($(this))" data-id="' . $row['id'] . '"><span class="icofont icofont-eye-alt" ></span></button>
                           </div>';
                })
                ->addColumn('keysearch', function ($row) {
                    return $this->keySearchDatatableTemplate($row);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'detail_food'])
                ->make(true);

            $data_total = [
                'total_not_update' => ($dataNotUpdate),
            ];
            return [$tableNotVatUpdate, $data_total, $config];
        } catch (Exception $e) {
            $this->catchTemplate($config, $e);
        }
    }

    public function detail(Request $request)
    {
        $branch_id = Config::get('constants.type.checkbox.GET_ALL');
        $restaurant_brand_id = $request->get('restaurant_brand_id');
        $status = Config::get('constants.type.checkbox.SELECTED');
        $category_type = Config::get('constants.type.id.GET_ALL');
        $category_id = Config::get('constants.type.id.GET_ALL');
        $is_take_away = Config::get('constants.type.is_take_away.GET_ALL');
        $is_count_material = Config::get('constants.type.checkbox.GET_ALL');
        $is_addition = Config::get('constants.type.checkbox.GET_ALL');
        $page = Config::get('constants.type.default.PAGE_DEFAULT');
        $limit = Config::get('constants.type.default.LIMIT_DEFAULT');
        $is_bestseller = Config::get('constants.type.checkbox.GET_ALL');
        $is_combo = Config::get('constants.type.checkbox.GET_ALL');
        $is_kitchen = Config::get('constants.type.checkbox.GET_ALL');
        $is_special_gift = Config::get('constants.type.checkbox.DIS_SELECTED');
        $key_search = '';
        $restaurant_vat_config_id = $request->get('restaurant_vat_config_id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.TMS');
        $method = Config::get('constants.GATEWAY.METHOD.GET');
        $api = sprintf(API_FOOD_GET_ALL_VAT_MANAGE, $status, $is_take_away, $is_addition, $category_type, $category_id, $restaurant_brand_id, $branch_id, $is_count_material, $page, $limit, $is_bestseller, $is_combo, $is_kitchen, $is_special_gift, $key_search, $restaurant_vat_config_id);
        $body = null;
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        $data_table_selected = DataTables::of($config['data']['list'])
            ->addColumn('avatar', function ($row) use ($domain) {
             return '<img onerror="imageDefaultOnLoadError($(this))" src="' . $domain . $row['avatar'] . '" class="img-inline-name-data-table">
                                                             <label class="name-inline-data-table">' . $row['name'] . '<br>
                                                                  <label class="department-inline-name-data-table">
                                                                    <i class="fa fa-cutlery"></i>' . $row['code'] . '
                </label>';
            })
            ->addColumn('name', function ($row) {
                if (mb_strlen($row['name']) > 30) {
                    return mb_substr($row['name'], 0, 25) . '...<i class="f-16 fa fa-comment-o text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="' . $row['name'] . '"></i>';
                } else {
                    return $row['name'];
                }
            })
            ->addColumn('action', function ($row){
                $row['type_food'] = TEXT_NORMAL_FOOD;
                $row['id_type_food'] = Config::get('constants.type.TypeFood.FOOD');

                if ($row['is_combo'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    $row['type_food'] = TEXT_COMBO_FOOD;
                    $row['id_type_food'] = Config::get('constants.type.TypeFood.COMBO');
                }

                if ($row['is_addition'] === (int)Config::get('constants.type.checkbox.SELECTED')) {
                    $row['type_food'] = TEXT_ADDITION;
                    $row['id_type_food'] = Config::get('constants.type.TypeFood.ADDITION');
                }
                return '<div class="btn-group btn-group-sm">
                                <button type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light" title="' . TEXT_DETAIL . '" onclick="openModalDetailFoodBrandManage($(this))" data-id="' . $row['id'] . '" data-type="' . $row['id_type_food'] . '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><span class="icofont icofont-eye-alt"></span></button>
                            </div>';
            })
            ->addColumn('keysearch', function ($row) {
                return $this->keySearchDatatableTemplate($row);
            })
            ->rawColumns(['avatar', 'name', 'action'])
            ->addIndexColumn()
            ->make(true);

        return [$data_table_selected, $config];
    }


    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $project = Config::get('constants.GATEWAY.PROJECT_ID.TMS');
        $method = Config::get('constants.GATEWAY.METHOD.POST');
        $api = sprintf(API_VAT_SETTING_CHANGE_STATUS);
        $body = [
            'vat_config_id' => $id
        ];
        return $this->callApiGatewayTemplate2($project, $method, $api, $body);
    }
}
