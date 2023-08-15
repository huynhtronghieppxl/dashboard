@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="row">
                                <div class="col-lg-2 first-col-date-report">
                                </div>
                                <div class="col-lg-8 second-col-date-report">
                                    <div class="card-block btn-group" id="btn-type-time-profit-report">
                                        <button id="btn-day" data-id="1"
                                                class="btn btn-grd-warning btn-warning btn-outline-warning btn-edit-display border-radius-first-20">@lang('app.profit-report.button-day')</button>
                                        <button id="btn-week" data-id="2"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.profit-report.button-week')</button>
                                        <button id="btn-month" data-id="3"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.profit-report.button-month')</button>
                                        <button id="btn-3month" data-id="4"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.profit-report.button-3-month')</button>
                                        <button id="btn-year" data-id="5"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.profit-report.button-year')</button>
                                        <button id="btn-3year" data-id="6"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.profit-report.button-3-year')</button>
                                        <button id="select_time" data-id="6"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.sell-report.button-select')</button>
                                        <button id="btn-allyear" data-id="7"
                                                class="btn btn-warning btn-outline-warning btn-edit-display border-radius-last-20">@lang('app.profit-report.button-all-year')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="input-group col-lg-3 m-auto add-display border-group pr-0" id='day'>
                                <input id="calendar-day" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"
                                       placeholder="{{date('d/m/Y')}}" value="{{date('d/m/Y')}}">
                                <button class="input-group-addon cursor-pointer custom-button-search">
                                    <i class="fa fa-search">
                                    </i></button>
                            </div>
                            <div class="input-group col-lg-3 m-auto add-display d-none border-group pr-0" id='month'>
                                <input id="calendar-month" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"
                                       placeholder="{{date('m/Y')}}" value="{{date('m/Y')}}">
                                <button class="input-group-addon cursor-pointer custom-button-search"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="input-group col-lg-3 m-auto add-display d-none border-group pr-0" id='year'>
                                <input id="calendar-year" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"
                                       placeholder="{{date('Y')}}" value="{{date('Y')}}">
                                <button class="input-group-addon cursor-pointer custom-button-search"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        @include('report.report_type_option')
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-block pt-0">
                            <div id="chart-profit-report-vertical" class="vertical-chart count-loading-chart"
                                 style="height:400px">
                                <div id="chart-profit-report-vertical-center"
                                     class="empty-datatable-custom center-loading d-none"><img style="width: 200px"
                                                                                               src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}"></div>
                                <div id="chart-profit-report-vertical-main" style="height: 100%; width: 98%" class="mt-4 vertical-chart count-loading-chart center-loading">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body">
                            <h5 class="sub-title-2 text-center" style="font-weight: bold;">@lang('app.profit-report.table')</h5>
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable mr-3">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single" id="select-type-profit-report">
                                                <option value="" selected>@lang('app.component.option-all')</option>
                                                <option value="1">@lang('app.profit-report.option-food')</option>
                                                <option value="2">@lang('app.profit-report.option-drink')</option>
{{--                                                <option value="3">@lang('app.profit-report.option-sea-food')</option>--}}
                                                <option value="3">@lang('app.profit-report.option-other')</option>
                                            </select>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-profit-report" class="table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">@lang('app.profit-report.stt-table')</th>
                                        <th rowspan="2" class="text-center">@lang('app.profit-report.name-table')</th>
                                        <th rowspan="2" class="text-center">@lang('app.profit-report.type-table')</th>
                                        <th>@lang('app.profit-report.quantity-table')</th>
{{--                                        <th rowspan="2" class="text-center">@lang('app.profit-report.unit-table')</th>--}}
                                        <th>@lang('app.profit-report.total-original-table')</th>
                                        <th>@lang('app.profit-report.total-row-table')</th>
                                        <th>@lang('app.profit-report.profit-table')</th>
                                        <th rowspan="2" class="text-center">@lang('app.profit-report.profit-rate-table')</th>
                                        <th rowspan="2"></th>
                                        <th rowspan="2" class="d-none"></th>
                                    </tr>
                                    <tr>
                                        <th id="total-quantity">0</th>
                                        <th id="total-original">0</th>
                                        <th id="total-revenue">0</th>
                                        <th id="total-profit">0</th>
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
    @include('report.sell.detail_food')
    @include('report.profit.excel')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\report\profit\index.js?version=10', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{ asset('..\js\report\profit\action.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
