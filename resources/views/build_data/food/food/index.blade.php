@extends('layouts.layout')
@section('content')
    <style>
        .tooltip_formula {
            opacity: 0.9;
            position: relative;
        }
        
        .tooltip_formula_wrapper {
            cursor: pointer;
            visibility: hidden;
            background: #333;
            position: absolute;
            top: 50%;
            right: 18px;
            transform: translateY(-50%);
            display: flex;
            width: max-content;
            color: white;
            align-items: center;
            padding: 6px;
            border-radius: 4px;
            gap: 10px;
            transition: .25s ease-in;
        }

        .tooltip_formula_wrapper:before {
            content: "";
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent;
            border-left: 6px solid #333
        }

        .tooltip_formula:hover .tooltip_formula_wrapper {
            visibility: visible;
        }
    </style>
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <ul class="nav nav-tabs md-tabs md-6-tabs"
                    id="tabs-food-data" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="tab-food-data-1" data-toggle="tab"
                           data-type="1" href="#tab1-food-data" role="tab"
                           aria-expanded="true" data-category-type="1"
                           data-combo="0" data-special_gift="0" data-addition="0"
                           data-index="0" data-column="1" data-type="1" data-val="1">
                            @lang('app.food-data.tab1')
                            <span class="label label-success" id="total-record-food">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="tab-food-drink-data-2" data-toggle="tab"
                           href="#tab2-food-data" role="tab" aria-expanded="false"
                           data-category-type="2" data-combo="0" data-special_gift="0" data-addition="0"
                           data-index="1" data-column="1" data-type="1" data-val="2">
                            @lang('app.food-data.tab2')
                            <span class="label label-warning" id="total-record-drink">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-food-other-data-4" data-toggle="tab"
                           href="#tab4-food-data" role="tab" aria-expanded="false" data-category-type="3"
                           data-combo="0" data-special_gift="0" data-addition="0"
                           data-index="3" data-column="1" data-type="1" data-val="3">
                            @lang('app.food-data.tab4')
                            <span class="label label-inverse" id="total-record-other">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-food-combo-data-5" data-toggle="tab"
                           href="#tab5-food-data" data-category-type="1"
                           data-combo="1" data-special_gift="0" data-addition="0"
                           role="tab" aria-expanded="false" data-index="4" data-column="2" data-type="2" data-val="4">
                            @lang('app.food-data.tab5')
                            <span class="label label-success" id="total-record-combo">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-food-addition-data-7" data-toggle="tab" data-val="5"
                           href="#tab7-food-data" data-category-type="1"
                           data-combo="0" data-special_gift="0" data-addition="1"
                           role="tab" aria-expanded="false" data-index="5" data-column="2" data-type="4">
                            @lang('app.food-data.tab7')
                            <span class="label label-info" id="total-record-addition" data-type="4">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="card card-block">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1-food-data" role="tabpanel">
                            <div class="table-responsive new-table">
                                {{--                                @include('build_data.food.food.filter')--}}
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand">
                                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                    @if($db['is_office'] === 0)
                                                        @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                            <option value="{{$db['id']}}"
                                                                    selected>{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-category-food-data-food"
                                                    id="select-category-food-data-food">
                                                <option value="" disabled selected
                                                        hidden>@lang('app.component.option-null')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="table-food-food-data">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-data.stt')</th>
                                        <th>@lang('app.food-data.name')</th>
                                        <th>@lang('app.food-data.category')</th>
                                        <th>@lang('app.food-data.price')</th>
                                        <th>@lang('app.food-data.vat')</th>
                                        <th>@lang('app.food-data.profit')</th>
                                        <th>
                                            @lang('app.food-data.profit_rate_by_original_price')
                                            @include('build_data.food.food.tooltip.profit_rate_by_original_price')
                                        </th>
                                        <th>
                                            @lang('app.food-data.profit_rate_by_price')
                                            @include('build_data.food.food.tooltip.profit_rate_by_price')
                                        </th>
                                        <th>@lang('app.food-data.action')</th>
                                        <th class="d-none text-center"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-food-data" role="tabpanel">
                            <div class="table-responsive new-table">
                                {{--                                @include('build_data.food.food.filter')--}}
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand">
                                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                    @if($db['is_office'] === 0)
                                                        @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                            <option value="{{$db['id']}}"
                                                                    selected>{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single" id="select-category-food-data-drink"
                                                    data-validate="">
                                                <option value="" disabled selected
                                                        hidden>@lang('app.component.option-null')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="table-drink-food-data">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-data.stt')</th>
                                        <th>@lang('app.food-data.name')</th>
                                        <th>@lang('app.food-data.category')</th>
                                        <th>@lang('app.food-data.price')</th>
                                        <th>@lang('app.food-data.vat')</th>
                                        <th>@lang('app.food-data.profit')</th>
                                        <th>
                                            @lang('app.food-data.profit_rate_by_original_price')
                                            @include('build_data.food.food.tooltip.profit_rate_by_original_price')
                                        </th>
                                        <th>
                                            @lang('app.food-data.profit_rate_by_price')
                                            @include('build_data.food.food.tooltip.profit_rate_by_price')
                                        </th>
                                        <th>@lang('app.food-data.action')</th>
                                        <th class="d-none text-center"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4-food-data" role="tabpanel">
                            <div class="table-responsive new-table">
                                {{--                                @include('build_data.food.food.filter')--}}
                                <div class="select-filter-dataTable">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if($db['is_office'] === 0)
                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single" id="select-category-food-data-other"
                                                    data-validate="">
                                                <option value="" disabled selected
                                                        hidden>@lang('app.component.option-null')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="table-other-food-data">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-data.stt')</th>
                                        <th>@lang('app.food-data.name')</th>
                                        <th>@lang('app.food-data.category')</th>
                                        <th>@lang('app.food-data.price')</th>
                                        <th>@lang('app.food-data.vat')</th>
                                        <th>@lang('app.food-data.profit')</th>
                                        <th>
                                            @lang('app.food-data.profit_rate_by_original_price')
                                            @include('build_data.food.food.tooltip.profit_rate_by_original_price')
                                        </th>
                                        <th>
                                            @lang('app.food-data.profit_rate_by_price')
                                            @include('build_data.food.food.tooltip.profit_rate_by_price')
                                        </th>
                                        <th>@lang('app.food-data.action')</th>
                                        <th class="d-none text-center"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab5-food-data" role="tabpanel">
                            <div class="table-responsive new-table">
                                {{--                                @include('build_data.food.food.filter')--}}
                                <div class="select-filter-dataTable">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand  ">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if($db['is_office'] === 0)
                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-category-food-data-food"
                                                    id="select-category-food-data-food"
                                                    data-validate="">
                                                <option value="" disabled selected
                                                        hidden>@lang('app.component.option-null')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="table-combo-food-data">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-data.stt')</th>
                                        <th>@lang('app.food-data.name')</th>
                                        <th>@lang('app.food-data.category')</th>
                                        <th>@lang('app.food-data.price')</th>
                                        <th>@lang('app.food-data.vat')</th>
                                        <th>@lang('app.food-data.profit')</th>
                                        <th>
                                            @lang('app.food-data.profit_rate_by_original_price')
                                            @include('build_data.food.food.tooltip.profit_rate_by_original_price')
                                        </th>
                                        <th>
                                            @lang('app.food-data.profit_rate_by_price')
                                            @include('build_data.food.food.tooltip.profit_rate_by_price')
                                        </th>
                                        <th>@lang('app.food-data.action')</th>
                                        <th class="d-none text-center"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab7-food-data" role="tabpanel">
                            <div class="table-responsive new-table">
                                {{--                                @include('build_data.food.food.filter')--}}
                                <div class="select-filter-dataTable">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if($db['is_office'] === 0)
                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-category-food-data-food"
                                                    id="select-category-food-data-food"
                                                    data-validate="">
                                                <option value="" disabled selected
                                                        hidden>@lang('app.component.option-null')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table class="table"
                                       id="table-addition-food-data">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.food-data.stt')</th>
                                        <th>@lang('app.food-data.name')</th>
                                        <th>@lang('app.food-data.category')</th>
                                        <th>@lang('app.food-data.price')</th>
                                        <th>@lang('app.food-data.vat')</th>
                                        <th>@lang('app.food-data.profit')</th>
                                        <th>
                                            @lang('app.food-data.profit_rate_by_original_price')
                                            @include('build_data.food.food.tooltip.profit_rate_by_original_price')
                                        </th>
                                        <th>
                                            @lang('app.food-data.profit_rate_by_price')
                                            @include('build_data.food.food.tooltip.profit_rate_by_price')
                                        </th>
                                        <th>@lang('app.food-data.action')</th>
                                        <th class="d-none text-center"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.food.brand.create')
    @include('manage.food.brand.create.food_combo')
    @include('manage.food.brand.create.food_addtion')
    @include('manage.food.brand.detail')
    @include('manage.food.brand.upload_image')
    @include('manage.food.brand.import_excel')
    @include('manage.food.brand.update')
    @include('manage.food.brand.update.combo')
    @include('manage.food.brand.update.addtion')


    <div class="d-none">
        <span id="processing">@lang('app.food-data.mess.processing')</span>
        <span id="branch">@lang('app.food-data.mess.branch')</span>
        <span id="food">@lang('app.food-data.mess.food')</span>
        <span id="category_food">@lang('app.food-data.mess.category_food')</span>
        <span id="time_cooking">@lang('app.food-data.mess.time_cooking')</span>
        <span id="last_price">@lang('app.food-data.mess.last_price')</span>
        <span id="price">@lang('app.food-data.mess.price')</span>
        <span id="unit">@lang('app.food-data.mess.unit')</span>
        <span id="use_point">@lang('app.food-data.mess.use_point')</span>
        <span id="notify_1m">@lang('app.food-data.mess.notify_1m')</span>
        <span id="notify_100m">@lang('app.food-data.mess.notify_100m')</span>
        <span id="max_image">@lang('app.food-data.mess.max_image')</span>
        <span id="not_type">@lang('app.food-data.mess.not_type')</span>
        <span id="check_branch">@lang('app.food-data.mess.check_branch')</span>
        <span id="error_file">@lang('app.food-data.mess.error_file')</span>
        <span id="text_fail_food">@lang('app.food-data.mess.text_fail_food')</span>
        <span id="check_file">@lang('app.food-data.mess.check_file')</span>
        <span id="error_file">@lang('app.food-data.mess.error_file')</span>
        <span id="type_food_text">@lang('app.food-data.option_type')</span>
        <span id="error-food">@lang('app.food-data.inport.error-food')</span>
        <span id="success-food">@lang('app.food-data.inport.success-food')</span>
        <span
                id="notify-on-update-status-component">@lang('app.component.sweet_alert.status.change-status-on')</span>
        <span
                id="notify-off-update-status-component">@lang('app.component.sweet_alert.status.change-status-off')</span>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/food/food/index.js?version=7', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
