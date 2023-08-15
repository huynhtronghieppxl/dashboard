@extends('layouts.layout')
@section('content')
    <style>
        #chart-sell-point-report-point-vertical, #table-card9 {
            height: calc(100vh - 200px) !important;
        }

        #chart-sell-report-vertical-main {
            height: 100% !important;
        }

        .seemt-main {
            overflow: hidden !important;
        }

        .seemt-container .filter-report .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 0 !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" type="text/css" href="{{asset('files\assets\pages\timeline\style.css?version=')}}">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card" id="content-detail">
                <div class="filter-report row seemt-green" style="height: 32px">
                    <div class="form-group select2_theme validate-group col-lg-2 col-md-3"
                         style="margin: 0 !important;">
                        <div class="form-validate-select">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 p-0"
                                     style="height: 32px!important;background: var(--bg-color);border-radius: 6px;">
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
                    <div class="col-lg-6 col-md-5  pl-0 d-flex align-items-center justify-content-start"
                         style="height: 32px">
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
                    <div class="d-flex col-lg-4 col-md-4 justify-content-end">
                        <div class="form-group select2_theme validate-group"
                             style=" width: 194px; margin-left: 16px">
                            <div class="form-validate-select">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 p-0"
                                         style="height: 32px!important;background: var(--bg-color);border-radius: 6px;">
                                        <select id="select-point-type"
                                                class="form-control js-example-basic-single select2-hidden-accessible">
                                            <option
                                                    value="0">Điểm tích luỹ
                                            </option>
                                            <option
                                                    value="1">Điểm khuyến mãi
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group select2_theme validate-group"
                             style=" width: 194px; margin-left: 16px">
                            <div class="form-validate-select">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 p-0"
                                         style="height: 32px!important;background: var(--bg-color);border-radius: 6px;">
                                        <select id="select-point-sort"
                                                class="form-control js-example-basic-single select2-hidden-accessible">
                                            <option
                                                    value="-1">Theo tất cả
                                            </option>
                                            <option
                                                    value="0">Theo level
                                            </option>
                                            <option
                                                    value="1">Theo tổng điểm đã nhận
                                            </option>
                                            <option
                                                    value="2">Theo số điểm đã nhận
                                            </option>
                                            <option
                                                    value="3">Theo tổng điểm sử dụng
                                            </option>
                                            <option
                                                    value="4">Theo số điểm sử dụng
                                            </option>
                                            <option
                                                    value="5">Theo số điểm còn lại
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row scroll-containers">
                    <div class="col-lg-12">
                        <div class="col-lg-12 selections">
                            <div class="card-block row pt-0">
                                <div class="col-lg-12 mt-4">
                                    <div class="row justify-content-end" id="detail-value-point-report-box">
                                        <div class="form-validate-checkbox d-flex flex-row-reverse p-0 mr-0">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" value="" id="detail-value-point-report"
                                                       required="">
                                                <label class="name-checkbox" style="line-height: 21px"
                                                       for="detail-value-point-report"> Xem Chi tiết </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="chart-sell-point-report-point-vertical"
                                         class="mt-0 vertical-chart count-loading-chart"
                                         style="height:calc(100vh - 250px)">
                                        <div id="chart-sell-report-vertical-empty"
                                             class="empty-datatable-custom center-loading d-none">
                                            <img style="width: 200px"
                                                 src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}">
                                        </div>
                                        <div id="chart-sell-report-vertical-main" style="height: 100%; width: 98%"
                                             class="mt-0 vertical-chart count-loading-chart center-loading">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 selections">
                            <div class="card-body">
                                <div class="table-responsive new-table" id="table-card9">
                                    <table id="table-sell-card9-report" class="table">
                                        <thead>
                                        <tr>
                                            <th rowspan="2"
                                                class="text-center">@lang('app.sell-report.card9.stt-table')</th>
                                            <th rowspan="2"
                                                class="text-center">@lang('app.sell-report.card9.avatar-table')</th>
                                            <th rowspan="2"
                                                class="text-left">@lang('app.sell-report.card9.name')</th>
                                            <th rowspan="2"
                                                class="text-left">@lang('app.sell-report.card9.level')</th>
                                            <th
                                                    class="text-right">@lang('app.sell-report.card9.point-revenue')</th>
                                            <th
                                                    class="text-right">@lang('app.sell-report.card9.point-number')</th>
                                            <th
                                                    class="text-right">@lang('app.sell-report.card9.point-use')</th>
                                            <th
                                                    class="text-right">@lang('app.sell-report.card9.total-point-use')</th>
                                            <th
                                                    class="text-right">@lang('app.sell-report.card9.remaining-point')</th>
                                            <th rowspan="2"></th>
                                            <th class="d-none" rowspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th class="seemt-fz-14 text-right" id="point-revenue">0</th>
                                            <th class="seemt-fz-14 text-right" id="point-number">0</th>
                                            <th class="seemt-fz-14 text-right" id="total-point-use">0</th>
                                            <th class="seemt-fz-14 text-right" id="point-use">0</th>
                                            <th class="seemt-fz-14 text-right" id="remaining-point">0</th>
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
    </div>
    @include('customer.customers.detail')
    @include('report.sell.point.excel')
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.3/echarts.min.js"></script>
    <script type="text/javascript"
            src="{{ asset('..\js\report\sell\point\index.js?version=7', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{ asset('../js/report/sell/filter.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
