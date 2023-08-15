@extends('layouts.layout')
@section('content')
    <head>
        <link rel="stylesheet" type="text/css" href="{{asset('files\assets\pages\timeline\style.css?version=')}}">
    </head>
    <style>
        #table-export-food-cancel-report .hidden {
            display: none;
        }

        #table-card7 {
            /*height: calc(100vh - 300px);*/
        }

        .seemt-main-content .new-table .select-filter-dataTable {
            margin-right: -28px !important;
        }

        #time-filter-food-cancel-report .custom-button-search {
            border-radius: 0 6px 6px 0 !important;
            height: 32px !important;
        }

        #time-filter-food-cancel-report .custom-button-search:hover.custom-button-search > i,
        #time-filter-food-cancel-report .search-date-option-filter-time-bar:hover.search-date-option-filter-time-bar > i {
            color: #fff !important;
        }

        #time-filter-food-cancel-report .search-date-option-filter-time-bar:hover {
            background-color: #0072bc !important;;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card" id="content-detail">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <div class="table-responsive new-table table-container-loading" id="table-card7">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand select-brand-supplier-order">
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
                                            <select class="js-example-basic-single select-branch select-branch-supplier-order">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="pl-0 d-flex align-items-center justify-content-start"
                                         style="height: 32px; margin-left: 10px" id="time-filter-food-cancel-report">
                                        <div class=" input-group m-auto add-display border-0 p-0 form-day-time-filter d-flex"
                                             id="day" style="margin-top: 0px!important;">
                                            <div class="time-filer-dataTale time-input-filter-time-bar custom-date border-0">
                                                <div class="filter-date d-flex align-items-center">
                                                    <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                                                        <i class="fi-rr-calendar seemt-gray-w600 pr-2"
                                                           style="transform: translateY(2px);"></i>
                                                        <input
                                                                class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200"
                                                                id="calendar-day" style="margin: 1px" type="text"
                                                                placeholder="{{ date('d/m/Y') }}"
                                                                value="{{ date('d/m/Y') }}">
                                                    </div>
                                                    <button
                                                            class="icon-filter-component search-date-filter-time-bar seemt-bg-blue custom-button-search seemt-btn-hover-blue  m-0"
                                                            style="">
                                                        <i class="fi-rr-filter"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" input-group m-auto add-display d-none border-0 p-0 form-month-time-filter d-flex form-month-time-filter"
                                             id="month" style="margin-top: 0px!important">
                                            <div class="time-input-filter-time-bar custom-date border-0">
                                                <div class="filter-date d-flex align-items-center">
                                                    <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                                                        <i class="fi-rr-calendar seemt-gray-w600 pr-2"
                                                           style="transform: translateY(2px);"></i>
                                                        <input
                                                                class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200"
                                                                id="calendar-month" style="margin: 1px" type="text"
                                                                placeholder="{{ date('m') }}" value="{{ date('m') }}">
                                                    </div>
                                                    <button
                                                            class="icon-filter-component search-date-filter-time-bar seemt-bg-blue seemt-btn-hover-blue custom-button-search m-0">
                                                        <i class="fi-rr-filter seemt-blue"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" input-group m-auto add-display d-none border-0 p-0 d-flex form-year-time-filter"
                                             id='year' style="margin-top: 0px!important">
                                            <div class="time-input-filter-time-bar custom-date border-0">
                                                <div class="filter-date d-flex align-items-center">
                                                    <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                                                        <i class="fi-rr-calendar seemt-gray-w600 pr-2"
                                                           style="transform: translateY(2px);"></i>
                                                        <input class="year-filter-time-bar custom-year from-date-filter-input seemt-bg-gray-w200"
                                                               id="calendar-year" type="text"
                                                               placeholder="{{ date('Y') }}"
                                                               value="{{ date('Y') }}">
                                                    </div>
                                                    <button
                                                            class="icon-filter-component search-date-filter-time-bar seemt-bg-blue seemt-btn-hover-blue custom-button-search m-0">
                                                        <i class="fi-rr-filter seemt-blue"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @include('report.report_type_option')
                                    </div>
                                    <div class="form-validate-select mr-3">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box" style="height: 34px">
                                                <select id="select-time-report"
                                                        class="form-control js-example-basic-single select2-hidden-accessible"
                                                        data-select="1">
                                                    <option value="day"
                                                            selected>@lang('app.area-report.button-day')</option>
                                                    <option value="week">@lang('app.area-report.button-week')</option>
                                                    <option value="month">@lang('app.area-report.button-month')</option>
                                                    <option value="3month">@lang('app.area-report.button-3-month')</option>
                                                    <option value="year">@lang('app.area-report.button-year')</option>
                                                    <option value="3year">@lang('app.area-report.button-3-year')</option>
                                                    <option value="13">Ngày - Ngày</option>
                                                    <option value="15">Tháng - Tháng</option>
                                                    <option value="16">Năm - Năm</option>
                                                    <option value="all_year">@lang('app.area-report.button-all-year')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-validate-select mr-3">
                                        <div class="select-material-box">
                                            <select id="select-sort-cancel-food-sell-report"
                                                    class="form-control js-example-basic-single select2-hidden-accessible">
                                                <option
                                                    value="0" selected>Giá vốn
                                                </option>
                                                <option
                                                    value="2">Số lượng
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-sell-card7-report" class="table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2"
                                            class="text-center">@lang('app.sell-report.card7.stt-table')</th>
                                        <th rowspan="2"
                                            class="text-left">@lang('app.sell-report.card7.employee-table')</th>
                                        <th rowspan="2" class="text-left">@lang('app.sell-report.card7.food-table')</th>
                                        <th class="text-right">@lang('app.sell-report.card7.quantity-table')</th>
                                        <th rowspan="2"
                                            class="text-right">@lang('app.sell-report.card7.price-table')</th>
                                        <th class="text-right">@lang('app.sell-report.card7.total-amount-table')</th>
                                        <th rowspan="2"
                                            class="text-center">@lang('app.sell-report.card7.date-table')</th>
                                        <th rowspan="2" class="text-left">@lang('app.sell-report.card7.name-table')</th>
                                        <th rowspan="2" class="text-center"></th>
                                        <th class="d-none" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th class="seemt-fz-14" id="total-quantity-card7">0</th>
                                        <th class="seemt-fz-14" id="total-amount-card7">0</th>
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
    @include('manage.bill.detail')
    @include('report.sell.food_cancel.excel')
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.3/echarts.min.js"></script>
    <script type="text/javascript"
            src="{{ asset('..\js\report\sell\food_cancel\index.js?version=6', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
