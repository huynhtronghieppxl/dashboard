@extends('layouts.layout')
<link rel="icon" href="{{ asset('images/tms/favicon2.png') }}" type="image/png"/>
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}"/>
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
                                    <div class="card-block btn-group" id="btn-type-time-debt-report">
                                        <button id="btn-day"
                                                class="btn btn-warning btn-grd-warning btn-outline-warning btn-edit-display border-radius-first-20">@lang('app.debt-report.button-day')</button>
                                        <button id="btn-week"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.debt-report.button-week')</button>
                                        <button id="btn-month"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.debt-report.button-month')</button>
                                        <button id="btn-3month"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.debt-report.button-3-month')</button>
                                        <button id="btn-year"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.debt-report.button-year')</button>
                                        <button id="btn-3year"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.debt-report.button-3-year')</button>
                                        <button id="select_time"
                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.sell-report.button-select')</button>
                                        <button id="btn-allyear"
                                                class="btn btn-warning btn-outline-warning btn-edit-display border-radius-last-20">@lang('app.debt-report.button-all-year')</button>
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
                                       placeholder="{{date('m/Y')}}" value="{{date('m/Y')}}">
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
                    <div class="col-lg-12">
                        <div class="card-block row">
                            <div class="col-xl-12">
                                <div class="table-responsive new-table">
                                    <table id="table-debt-report" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.debt-report.stt')</th>
                                        <th>@lang('app.debt-report.code')</th>
                                        <th>@lang('app.debt-report.name')</th>
                                        <th>@lang('app.debt-report.first-debt')</th>
                                        <th>@lang('app.debt-report.grow-in')</th>
                                        <th>@lang('app.debt-report.dis-in')</th>
                                        <th>@lang('app.debt-report.last-debt')</th>
                                        <th></th>
                                        <th class="d-none"></th>
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
@include('dashboard.branch.detail.supplier_debt')
@include('report.debt.excel')
@push('scripts')
    @include('layouts.datatable')
    <script type="text/javascript" src="{{ asset('js\template_custom\dataTable.js?version=1')}}"></script>
    <script type="text/javascript" src="{{ asset('..\js\report\debt\index.js?version=1')}}"></script>
    <script type="text/javascript" src="{{ asset('..\js\report\debt\action.js?version=1')}}"></script>
    <script type="text/javascript" src="{{ asset('..\js\report\debt\export.js?version=1')}}"></script>
@endpush
