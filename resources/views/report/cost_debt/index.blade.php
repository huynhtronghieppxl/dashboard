@extends('layouts.layout')
<link rel="icon" href="/images/tms/favicon2.png" type="image/png"/>
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="/css/dataTable.css"/>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card my-0">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="row">
                                <div class="col-lg-2 first-col-date-report">
                                </div>
                                <div class="col-lg-8 second-col-date-report">
                                    <div class="card-block btn-group" id="btn-type-time-cost-debt-report">
                                        <button id="btn-day"
                                                class="btn btn-warning btn-grd-warning btn-outline-warning btn-edit-display border-radius-first-20">@lang('app.cost-debt-report.button-day')</button>
                                        <button id="btn-week"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.cost-debt-report.button-week')</button>
                                        <button id="btn-month"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.cost-debt-report.button-month')</button>
                                        <button id="btn-3month"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.cost-debt-report.button-3-month')</button>
                                        <button id="btn-year"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.cost-debt-report.button-year')</button>
                                        <button id="btn-3year"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.cost-debt-report.button-3-year')</button>
                                        <button id="select_time"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.sell-report.button-select')</button>
                                        <button id="btn-allyear"
                                                class="btn btn-warning btn-outline-warning btn-edit-display border-radius-last-20">@lang('app.cost-debt-report.button-all-year')</button>
                                    </div>
                                </div>
                                <div class="col-lg-2 third-col-date-report">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" id="time-input-group">
                            <div class="input-group col-lg-3 m-auto add-display border-group px-0" id='day'>
                                <input id="calendar-day" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"
                                       placeholder="{{date('d/m/Y')}}" value="{{date('d/m/Y')}}">
                                <button class="input-group-addon cursor-pointer custom-button-search"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="input-group col-lg-3 m-auto add-display d-none border-group px-0" id='month'>
                                <input id="calendar-month" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"
                                       placeholder="{{date('m')}}" value="{{date('m')}}">
                                <button class="input-group-addon cursor-pointer custom-button-search"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="input-group col-lg-3 m-auto add-display d-none border-group px-0" id='year'>
                                <input id="calendar-year" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"
                                       placeholder="{{date('Y')}}" value="{{date('Y')}}">
                                <button class="input-group-addon cursor-pointer custom-button-search"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        @include('report.report_type_option')
                    </div>
                </div>
                <div class="row">
                    <div id="toolbar-options" class="hidden">
                        <a href="#"><label class="text-white">@lang('app.cost-debt-report.note-waiting') {{date('m/Y')}}</label></a>
                    </div>
                    <div id="toolbar-options1" class="hidden">
                        <a href="#"><label class="text-white">@lang('app.cost-debt-report.note-debt') {{date('m/Y', strtotime('-1 month'))}}</label></a>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-block row">
                            <div class="col-xl-12">
                                <div class="table-responsive new-table">
                                    <table id="table-cost-debt-report" class="table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.cost-debt-report.stt')</th>
                                        <th rowspan="2">@lang('app.cost-debt-report.reason')</th>
                                        <th>@lang('app.cost-debt-report.done')</th>
                                        <th>
                                            <div class="row m-0 p-0">
                                                <div class="col-5 m-auto">@lang('app.cost-debt-report.waiting')
                                                        <i id="not-payment-cost-debt-report" class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.cost-debt-report.note-waiting') {{date('m/Y', strtotime('-1 month'))}}"></i>
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="row m-0 p-0">
                                                <div class="col-5 m-auto">@lang('app.cost-debt-report.debt')
                                                        <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.cost-debt-report.note-debt') {{date('m/Y', strtotime('-1 month'))}}"></i>
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="d-none" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th id="total-done-cost-debt-report">0</th>
                                        <th id="total-waiting-cost-debt-report">0</th>
                                        <th id="total-debt-cost-debt-report">0</th>
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
@endsection
@include('report.cost_debt.detail')
@include('report.cost_debt.excel')
@push('scripts')
    <script type="text/javascript" src="/js/report/cost_debt/index.js?version=5"></script>
    <script type="text/javascript" src="/js/report/cost_debt/action.js?version=3"></script>
    <script type="text/javascript" src="/js/report/cost_debt/export.js?version=2"></script>
@endpush
