@extends('layouts.layout')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="/css/dataTable.css"/>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="row">
                                <div class="col-lg-2 first-col-date-report">
                                </div>
                                <div class="col-lg-8 second-col-date-report" id="btn-group-time-detail-money-report">
                                    <div class="card-block btn-group">
                                        <button id="btn-day" data-type="1"
                                                class="btn btn-grd-warning btn-outline-warning btn-edit-display border-radius-first-20">@lang('app.detail-money-report.button-day')</button>
                                        <button id="btn-week" data-type="2"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.detail-money-report.button-week')</button>
                                        <button id="btn-month" data-type="3"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.detail-money-report.button-month')</button>
                                        <button id="btn-3month" data-type="4"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.detail-money-report.button-3-month')</button>
                                        <button id="btn-year" data-type="5"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.detail-money-report.button-year')</button>
                                        <button id="btn-3year" data-type="6"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.detail-money-report.button-3-year')</button>
                                        <button id="btn-allyear" data-type="7"
                                                class="btn btn-warning btn-outline-warning btn-edit-display border-radius-last-20">@lang('app.detail-money-report.button-all-year')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="input-group col-lg-3 m-auto add-display border-group p-0" id='day'>
                                <input id="calendar-day" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"
                                       placeholder="{{date('d/m/Y')}}" value="{{date('d/m/Y')}}">
                                <button class="input-group-addon cursor-pointer custom-button-search"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="input-group col-lg-3 m-auto add-display d-none border-group p-0" id='month'>
                                <input id="calendar-month" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"
                                       placeholder="{{date('m')}}" value="{{date('m')}}">

                                <button class="input-group-addon cursor-pointer custom-button-search"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="input-group col-lg-3 m-auto add-display d-none border-group p-0" id='year'>
                                <input id="calendar-year" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"
                                       placeholder="{{date('Y')}}" value="{{date('Y')}}">
                                <button class="input-group-addon cursor-pointer custom-button-search"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-block mb-0 pt-0">
                    <ul class="nav nav-tabs md-tabs border-bottom-none" id="nav-tabs-detail-money" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-tab="1" data-toggle="tab" href="#tab1-detail"
                               role="tab"
                               aria-expanded="true" onclick="tabContent(0)">@lang('app.detail-money-report.tab1.title')
                                <span class="label label-success" id="total-receipt">0</span></a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-tab="2" data-toggle="tab" href="#tab2-detail" role="tab"
                               aria-expanded="false" onclick="tabContent(1)">@lang('app.detail-money-report.tab2.title')
                                <span class="label label-warning" id="total-payment">0</span></a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                    <div class="tab-content p-2 mb-0">
                        <div class="tab-pane active" id="tab1-detail" role="tabpanel">
                            <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                                <div class="table-responsive new-table">
                                    <table id="table-tab1-report"
                                           class="table nowrap table-ajax-reload mb-0">
                                        <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">@lang('app.detail-money-report.tab1.stt-table')</th>
                                            <th rowspan="2" class="text-center">@lang('app.detail-money-report.tab1.code-table')</th>
                                            <th rowspan="2" class="text-center">@lang('app.detail-money-report.tab1.employee-table')</th>
                                            <th rowspan="2" class="text-center">@lang('app.detail-money-report.tab1.date-table')</th>
                                            <th rowspan="2" class="text-center">@lang('app.detail-money-report.tab1.object_name-table')</th>
                                            <th rowspan="2" class="text-center">@lang('app.detail-money-report.tab1.reason_name-table')</th>
                                            <th>@lang('app.detail-money-report.tab1.amount-table')</th>
                                            <th rowspan="2" class="text-center"></th>
                                            <th class="d-none" rowspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th id="total-in-amount">0</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-detail" role="tabpanel">
                            <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                                <div class="table-responsive new-table">
                                    <table id="table-tab2-report"
                                           class="table nowrap table-ajax-reload mb-0">
                                        <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">@lang('app.detail-money-report.tab2.stt-table')</th>
                                            <th rowspan="2" class="text-center">@lang('app.detail-money-report.tab2.code-table')</th>
                                            <th rowspan="2" class="text-center">@lang('app.detail-money-report.tab2.employee-table')</th>
                                            <th rowspan="2" class="text-center">@lang('app.detail-money-report.tab2.date-table')</th>
                                            <th rowspan="2" class="text-center">@lang('app.detail-money-report.tab2.object_name-table')</th>
                                            <th rowspan="2" class="text-center">@lang('app.detail-money-report.tab2.reason_name-table')</th>
                                            <th>@lang('app.detail-money-report.tab2.amount-table')</th>
                                            <th rowspan="2" class="text-center"></th>
                                            <th class="d-none" rowspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th id="total-out-amount">0</th>
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
    @include('treasurer.receipts_bill.detail')
    @include('treasurer.payment_bill.detail')
    @include('report.detail_money.excel')
@endsection
@push('scripts')
    @include('layouts.datatable')
    <script type="text/javascript" src="/js/template_custom/dataTable.js?version=1"></script>
    <script type="text/javascript" src="/js/report/detail_money/index.js?version=4"></script>
    <script type="text/javascript" src="/js/report/detail_money/action.js?version="></script>
    <script type="text/javascript" src="/js/report/detail_money/export.js?version="></script>
    <script type="text/javascript" src="/js/report/detail_money/table.js?version="></script>
@endpush
