@extends('layouts.layout')
@section('content')
    <style>
        #chart-category-sell-report-vertical, #table-card1 {
            height: calc(100vh - 200px) !important;
        }

        .seemt-main {
            overflow: hidden !important;
        }

        .search-date-option-filter-time-bar {
            z-index: 1;
        }

        #time-filter-category-report .custom-button-search:hover.custom-button-search > i,
        #time-filter-category-report .search-date-option-filter-time-bar:hover.search-date-option-filter-time-bar > i {
            color: #fff !important;
        }

        #time-filter-category-report .search-date-option-filter-time-bar:hover {
            background-color: #0072bc !important;;
        }

        .seemt-container .filter-report .select2-container--default .select2-selection--single .select2-selection__arrow,
        .seemt-main-content .filter-report .select-filter-dataTable .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: -5px !important;
        }

        .seemt-main-content .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding: 2px 38px 2px 16px !important;
        }

        #chart-category-sell-report-vertical {
            position: relative;
        }

        #detail-value-category-report-box {
            position: absolute;
            right: 0;
            z-index: 1;
        }
    </style>
    <head>
        <link rel="stylesheet" type="text/css" href="{{asset('files\assets\pages\timeline\style.css?version=')}}">
    </head>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card" id="content-detail">
                <div class="filter-report row seemt-green" style="height: 32px">
                    <div class="form-group select2_theme validate-group col-lg-2" style="margin: 0 !important;">
                        <div class="form-validate-select">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 p-0 select-material-box"
                                     style="height: 32px!important;min-height: unset !important;">
                                    <select id="select-time-report"
                                            class="form-control js-example-basic-single select2-hidden-accessible"
                                            data-select="1">
                                        <option value="day" selected>@lang('app.area-report.button-day')</option>
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
                    </div>
                    <div class="col-lg-3 pl-0 d-flex align-items-center justify-content-start" style="height: 32px"
                         id="time-filter-category-report">
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
                                                style=""
                                                placeholder="{{ date('d/m/Y') }}" value="{{ date('d/m/Y') }}">
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
                                               id="calendar-year" type="text" placeholder="{{ date('Y') }}"
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
                    <div class="col-lg-7">
                        <div class="select-filter-dataTable d-flex justify-content-end">
                            <div class="form-validate-select">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select-brand select-brand-report">
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
                            <div class="form-validate-select ml-3">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select-branch select-branch-report">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group select2_theme validate-group" style="margin-left: 10px">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select class="js-example-basic-single select2-hidden-accessible"
                                                    id="select-category-name-food-sell-report">
                                                <option value="-1" data-category-type="-1" disabled selected
                                                        hidden>@lang('app.component.option-null')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group select2_theme validate-group" style="margin-left: 10px">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-sort-sell-category-food-report"
                                                    class="form-control js-example-basic-single select2-hidden-accessible">
                                                <option
                                                        value="0" selected>Doanh thu
                                                </option>
                                                <option
                                                        value="1">Giá vốn
                                                </option>
                                                <option
                                                        value="2">Lợi nhuận
                                                </option>
                                                <option
                                                        value="3">Tỷ suất lợi nhuận
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col-lg-12 scroll-containers mt-3">
                        <div class="card-block-big selections pt-0">
                            <div id="chart-category-sell-report-vertical"
                                 class="mt-0 vertical-chart count-loading-chart"
                                 style="height:calc(100vh - 50px)">
                                <div class="row justify-content-end d-none" id="detail-value-category-report-box">
                                    <div class="form-validate-checkbox d-flex flex-row-reverse p-0 mr-0">
                                        <div class="checkbox-form-group">
                                            <input type="checkbox" value="" id="detail-value-category-report"
                                                   required="">
                                            <label class="name-checkbox" style="line-height: 21px"
                                                   for="detail-value-category-report"> Xem Chi tiết </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="chart-category-sell-report-vertical-empty"
                                     class="empty-datatable-custom center-loading d-none"><img style="width: 200px"
                                                                                               src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}">
                                </div>
                                <div id="chart-category-sell-report-vertical-main" style="height: 100%; width: 98%"
                                     class="mt-0 vertical-chart count-loading-chart center-loading">
                                </div>
                            </div>
                        </div>
                        <div class="card-body selections">
                            <div class="table-responsive new-table table-container-loading" id="table-card1">
                                <table id="table-sell-card1-report" class="table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2"
                                            class="text-center">@lang('app.sell-report.card1.stt-table')</th>
                                        <th rowspan="2"
                                            class="text-left">@lang('app.sell-report.card1.name-table')</th>
                                        <th class="text-right">@lang('app.sell-report.card1.total-original-table')<br>(1)
                                        </th>
                                        <th class="text-right">@lang('app.sell-report.card1.total-money-table')<br>(2)
                                        </th>
                                        <th class="text-right">@lang('app.sell-report.card1.profit-table')<br>(3)</th>
                                        <th rowspan="2"
                                            class="text-right">@lang('app.sell-report.card1.profit-rate-table')<br>(4=(3/2)*100)
                                        </th>
                                        <th rowspan="2" class="text-center"></th>
                                        <th class="d-none" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th class="seemt-fz-14" id="total-original-card1">0</th>
                                        <th class="seemt-fz-14" id="total-money-card1">0</th>
                                        <th class="seemt-fz-14" id="total-profit-card1">0</th>
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
    @include('report.sell.detail_category')
    @include('report.sell.category.excel')
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.3/echarts.min.js"></script>
    <script type="text/javascript"
            src="{{ asset('..\js\report\sell\category\index.js?version=7', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
