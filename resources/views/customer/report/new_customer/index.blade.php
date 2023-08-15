@extends('layouts.layout')
@section('content')
    <style>
        .search-date-filter-time-bar:hover {
            background: #0072bc !important;
        }

        .search-date-filter-time-bar:hover.search-date-filter-time-bar > i {
            color: #fff !important;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        {{--                        <div class="col-lg-12 text-center">--}}
                        {{--                            <div class="row">--}}
                        {{--                                <div class="col-lg-2 first-col-date-report">--}}
                        {{--                                </div>--}}
                        {{--                                <div class="col-lg-8 second-col-date-report">--}}
                        {{--                                    <div class="card-block btn-group" id="index-tab-new-customer-report">--}}
                        {{--                                        <button id="btn-day"--}}
                        {{--                                                class="btn btn-grd-warning btn-outline-warning btn-edit-display border-radius-first-20" data-index="1">@lang('app.sell-report.button-day')</button>--}}
                        {{--                                        <button id="btn-week"--}}
                        {{--                                                class="btn btn-warning btn-outline-warning btn-edit-display" data-index="2">@lang('app.sell-report.button-week')</button>--}}
                        {{--                                        <button id="btn-month"--}}
                        {{--                                                class="btn btn-warning btn-outline-warning btn-edit-display" data-index="3">@lang('app.sell-report.button-month')</button>--}}
                        {{--                                        <button id="btn-3month"--}}
                        {{--                                                class="btn btn-warning btn-outline-warning btn-edit-display" data-index="4">@lang('app.sell-report.button-3-month')</button>--}}
                        {{--                                        <button id="btn-year"--}}
                        {{--                                                class="btn btn-warning btn-outline-warning btn-edit-display" data-index="5">@lang('app.sell-report.button-year')</button>--}}
                        {{--                                        <button id="btn-3year"--}}
                        {{--                                                class="btn btn-warning btn-outline-warning btn-edit-display" data-index="6">@lang('app.sell-report.button-3-year')</button>--}}
                        {{--                                        <button id="btn-allyear"--}}
                        {{--                                                class="btn btn-warning btn-outline-warning btn-edit-display border-radius-last-20" data-index="7">@lang('app.sell-report.button-all-year')</button>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="col-lg-12">--}}
                        {{--                            <div class="input-group col-lg-3 m-auto add-display border-group p-0" id='day'>--}}
                        {{--                                <input id="calendar-day-new-customer-report" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"--}}
                        {{--                                       placeholder="{{date('d/m/Y')}}" value="{{date('d/m/Y')}}">--}}
                        {{--                                <button class="input-group-addon cursor-pointer custom-button-search"><i class="fa fa-search"></i></button>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="input-group col-lg-3 m-auto add-display d-none border-group p-0" id='month'>--}}
                        {{--                                <input id="calendar-month-new-customer-report" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"--}}
                        {{--                                       placeholder="{{date('m')}}" value="{{date('m')}}">--}}
                        {{--                                <button class="input-group-addon cursor-pointer custom-button-search"><i class="fa fa-search"></i></button>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="input-group col-lg-3 m-auto add-display d-none border-group p-0" id='year'>--}}
                        {{--                                <input id="calendar-year-new-customer-report" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"--}}
                        {{--                                       placeholder="{{date('Y')}}" value="{{date('Y')}}">--}}
                        {{--                                <button class="input-group-addon cursor-pointer custom-button-search"><i class="fa fa-search"></i></button>--}}
                        {{--                            </div>--}}
                        <div class="col-lg-12 d-none">
                            <div class="input-group col-lg-3 m-auto add-display border-0 p-0 form-day-time-filter d-flex justify-content-center"
                                 id="day"
                                 style="margin-top: 15px!important">
                                <div class="time-input-filter-time-bar custom-date border-0">
                                    <div class="filter-date d-flex align-items-center">
                                        <div class="filter-to-date seemt-bg-gray-w200 d-flex">
                                            <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                                            <input
                                                    class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200 m-0"
                                                    id="calendar-day-new-customer-report"
                                                    type="text" placeholder="{{date('d/m/Y')}}"
                                                    value="{{date('d/m/Y')}}">
                                        </div>
                                        <div
                                                class="icon-filter-component search-date-filter-time-bar seemt-bg-blue seemt-btn-hover-blue custom-button-search m-0">
                                            <i class="fi-rr-filter seemt-blue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group col-lg-3 m-auto add-display d-none border-0 p-0 form-month-time-filter d-flex justify-content-center form-month-time-filter"
                                 id="month"
                                 style="margin-top: 15px!important">
                                <div class="time-input-filter-time-bar custom-date border-0">
                                    <div class="filter-date d-flex align-items-center">
                                        <div class="filter-to-date seemt-bg-gray-w200 d-flex">
                                            <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                                            <input
                                                    class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200 m-0"
                                                    id="calendar-month-new-customer-report"
                                                    type="text" placeholder="{{date('m')}}" value="{{date('m')}}">
                                        </div>
                                        <div
                                                class="icon-filter-component search-date-filter-time-bar seemt-bg-blue seemt-btn-hover-blue custom-button-search m-0">
                                            <i class="fi-rr-filter seemt-blue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group col-lg-3 m-auto add-display d-none border-0 p-0  form-year-time-filter d-flex justify-content-center form-year-time-filter"
                                 id='year'
                                 style="margin-top: 15px!important">
                                <div class="time-input-filter-time-bar custom-date border-0">
                                    <div class="filter-date d-flex align-items-center">
                                        <div class="filter-to-date seemt-bg-gray-w200 d-flex">
                                            <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                                            <input
                                                    class="to-year-filter-time-bar custom-year from-date-filter-input seemt-bg-gray-w200"
                                                    id="calendar-year-new-customer-report"
                                                    type="text" placeholder="{{date('Y')}}" value="{{date('Y')}}">
                                        </div>
                                        <div
                                                class="icon-filter-component search-date-filter-time-bar seemt-bg-blue seemt-btn-hover-blue custom-button-search m-0">
                                            <i class="fi-rr-filter seemt-blue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <h5 class="sub-title-2 text-center font-weight-bold">@lang('app.new-customer-report.chart')</h5>
                        </div>
                        <div class="col-sm-6"></div>
                        <div class="col-sm-3">
                            <div class="d-flex align-items-center justify-content-end w-100 mr-2">
                                <div class="filter-dashboard-report d-flex">
                                    <div class="filter-time-date-form-to-report">
                                        <div class="time-input-filter-time-bar time-input-filter-day-time-report d-none custom-date mr-1">
                                            <input class="from-day-filter-time-report custom-date from-date-filter-input p-1"
                                                   type="text" value="{{date('d/m/Y')}}"/>
                                            <span class="input-group-addon text-primary custom-find mt-0">Đến</span>
                                            <input class="to-day-filter-time-report custom-date from-date-filter-input p-1"
                                                   type="text" value="{{date('d/m/Y')}}"/>
                                            <div class="line-filter-time-bar"></div>
                                            <button class="search-date-filter-time-bar"><i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                        <div class="time-input-filter-time-bar custom-date time-input-filter-month-time-report mr-1 d-none">
                                            <input class="from-month-filter-time-report custom-date from-date-filter-input p-1"
                                                   type="text" value="{{date('m/Y')}}"/>
                                            <span class="input-group-addon text-primary custom-find mt-0">Đến</span>
                                            <input class="to-month-filter-time-report custom-date from-date-filter-input p-1"
                                                   type="text" value="{{date('m/Y')}}"/>
                                            <div class="line-filter-time-bar"></div>
                                            <button class="search-date-filter-time-bar"><i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                        <div class="time-input-filter-time-bar custom-date mr-1 time-input-filter-year-time-report d-none">
                                            <input class="from-year-filter-time-report custom-date from-date-filter-input p-1"
                                                   type="text" value="{{date('Y')}}"/>
                                            <span class="input-group-addon text-primary custom-find mt-0">Đến</span>
                                            <input class="to-year-filter-time-report custom-date from-date-filter-input p-1"
                                                   type="text" value="{{date('Y')}}"/>
                                            <div class="line-filter-time-bar"></div>
                                            <button class="search-date-filter-time-bar"><i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="filter-time-date-report">
                                        <div class="select-filter-type-date">
                                            <div class="form-validate-select position-relative">
                                                <div class="select-material-box">
                                                    <select id="select-time-customer-new-report"
                                                            class="select-option-filter-report js-example-basic-single form-control"
                                                            tabindex="-1" aria-hidden="true">
                                                        <option value="1"
                                                                data-time="{{date('d/m/Y')}}">@lang('app.branch-dashboard.select.option1')</option>
                                                        <option value="1"
                                                                data-time="{{date('d/m/Y', strtotime('yesterday'))}}">@lang('app.branch-dashboard.select.option2')</option>
                                                        <option value="2"
                                                                data-time="{{date('W/Y')}}">@lang('app.branch-dashboard.select.option3')</option>
                                                        <option value="3" data-time="{{date('m/Y')}}"
                                                                selected="">@lang('app.branch-dashboard.select.option5')</option>
                                                        <option value="3"
                                                                data-time="{{date('m/Y', strtotime('-1 month'))}}">@lang('app.branch-dashboard.select.option6')</option>
                                                        <option value="4"
                                                                data-time="{{date('m/Y')}}">@lang('app.branch-dashboard.select.option7')</option>
                                                        <option value="5"
                                                                data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option8')</option>
                                                        <option value="5"
                                                                data-time="{{date('Y', strtotime('-1 year'))}}">@lang('app.branch-dashboard.select.option11')</option>
                                                        <option value="6"
                                                                data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option9')</option>
                                                        <option value="8"
                                                                data-time="{{substr(Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['created_at'], 6, 4)}}">@lang('app.branch-dashboard.select.option10')</option>
                                                        <option value="13">
                                                            @lang('app.branch-dashboard.select.option12')</option>
                                                        <option value="15">
                                                            @lang('app.branch-dashboard.select.option13')</option>
                                                        <option value="16">
                                                            @lang('app.branch-dashboard.select.option14')</option>
                                                    </select>
                                                    <div class="line"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card-block-big" id="data-chart">
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-sm-4 text-left d-flex">--}}
                                {{--                                    <div class="form-radio">--}}
                                {{--                                        <form>--}}
                                {{--                                            <div class="radio radio-inline">--}}
                                {{--                                                <label>--}}
                                {{--                                                    <input type="radio" id="chart_vertical" name="radio"--}}
                                {{--                                                           checked="checked">--}}
                                {{--                                                    <i class="helper"></i>@lang('app.component.chart.vertical-chart')--}}
                                {{--                                                </label>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="radio radio-inline">--}}
                                {{--                                                <label>--}}
                                {{--                                                    <input type="radio" id="chart_horizontal" name="radio">--}}
                                {{--                                                    <i class="helper"></i>@lang('app.component.chart.horizontal-chart')--}}
                                {{--                                                </label>--}}
                                {{--                                            </div>--}}
                                {{--                                        </form>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="form-validate-checkbox">--}}
                                {{--                                        <div class="checkbox-form-group">--}}
                                {{--                                            <input type="radio" id="chart_vertical" name="radio" checked="checked">--}}
                                {{--                                            <label class="name-checkbox">@lang('app.component.chart.vertical-chart')</label>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="form-validate-checkbox">--}}
                                {{--                                        <div class="checkbox-form-group">--}}
                                {{--                                            <input type="radio" id="chart_horizontal" name="radio">--}}
                                {{--                                            <label class="name-checkbox">@lang('app.component.chart.horizontal-chart')</label>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                                <div class="col-sm-3"></div>--}}
                                {{--                                <div class="col-sm-5">--}}
                                {{--                                        <div class="checkbox-fade fade-in-primary float-right">--}}
                                {{--                                            <label>--}}
                                {{--                                                <input type="checkbox" id="label-chart"--}}
                                {{--                                                       checked>--}}
                                {{--                                                <span class="cr"><i--}}
                                {{--                                                            class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
                                {{--                                                <span>@lang('app.component.chart.check-detail')</span>--}}
                                {{--                                            </label>--}}
                                {{--                                        </div>--}}
                                {{--                                    <div class="checkbox-zoom zoom-primary float-right">--}}
                                {{--                                        <div class="form-validate-checkbox mt-2">--}}
                                {{--                                            <div class="checkbox-form-group">--}}
                                {{--                                                <input id="label-chart" type="checkbox">--}}
                                {{--                                                <label class="name-checkbox">--}}
                                {{--                                                    <span>@lang('app.component.chart.check-detail')</span>--}}
                                {{--                                                </label>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                    </div>--}}
                                {{--                            </div>--}}
                                <div id="chart-new-customer-report" class="vertical-chart count-loading-chart"
                                     style="height:400px">
                                    <div id="load-chart-new-customer-report-vertical" style="height: 400px"></div>
                                </div>
                                <div id="chart-customer-empty"
                                     class="style-large-chart-dashboard align-center justify-content-center d-none">
                                    <img src="{{asset('images/admin/empty.png')}}"
                                         style="width: 200px; height: auto; object-fit: contain;" alt="">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <h5 class="sub-title-2 text-center font-weight-bold">@lang('app.new-customer-report.table')</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive new-table table-container-loading">
                                    <table id="table-new-customer-report" class="table">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">@lang('app.new-customer-report.stt')</th>
                                            <th rowspan="2">@lang('app.new-customer-report.name')</th>
                                            <th rowspan="2">@lang('app.new-customer-report.gender')</th>
                                            <th rowspan="2">@lang('app.new-customer-report.date')</th>
                                            <th rowspan="2">@lang('app.new-customer-report.type')</th>
                                            <th>
                                                <div class="row m-0 p-0">
                                                    <div class="col-5 m-auto">@lang('app.new-customer-report.point')
                                                        <label class="mb-0 ml-1">
                                                            <div class="tool-box">
                                                                <div data-toolbar="user-options">
                                                                    <i class="fi-rr-exclamation"
                                                                       style="vertical-align: sub"
                                                                       data-toggle="tooltip" data-placement="top"
                                                                       data-original-title="Số điểm tích lũy được"></i>
                                                                </div>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </th>
                                            <th rowspan="2" class="d-none"></th>
                                        </tr>
                                        <tr>
                                            <th id="total-accumulate-point-new-customer-report">0</th>
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
    <div class="d-none">
        <input id="time" value="{{date('d/m/Y')}}">
        <input id="type" value="1">
    </div>
    @include('customer.report.new_customer.excel')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/report/new_customer/index.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{asset('js/customer/report/new_customer/action.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
