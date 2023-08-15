@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="row">
                                <div class="col-lg-12 second-col-date-report">
                                    <div class="card-block btn-group" id="btn-type-time-business-result-report">
                                        <button id="btn-month"
                                                class="btn btn-warning btn-outline-warning btn-edit-display border-radius-first-20">@lang('app.business-results-report.button-month')</button>
                                        <button id="btn-year"
                                                class="btn btn-warning btn-edit-display border-radius-last-20">@lang('app.business-results-report.button-year')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="input-group col-lg-3 m-auto add-display d-none border-group px-0" id='month'>
                                <input id="calendar-month" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"
                                       placeholder="{{date('m/Y')}}" value="{{date('m/Y')}}">
                                <button class="input-group-addon cursor-pointer custom-button-search"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="input-group col-lg-3 m-auto add-display border-group px-0" id='year'>
                                <input id="calendar-year" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text"
                                       placeholder="{{date('Y')}}" value="{{date('Y')}}">
                                <button class="input-group-addon cursor-pointer custom-button-search"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-block row">
                            <div class="col-lg-12 card-block">
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <h5 class="text-center text-inverse font-weight-bold mb-0" style="font-size: 15px!important">
                                            <span style="font-size: 20px!important;">Tổng doanh thu: </span>
                                            <span class="font-weight-bold" style="color: #fa6342;font-size: 20px!important" id="total-revenue-business-results-report">0</span> VNĐ</h5>
                                    </div>
                                </div>
                                <div id="chart-business-results-report-vertical-card-revenue" class="mt-0 vertical-chart count-loading-chart"
                                     style="height:400px">
                                    <div id="chart-business-results-report-vertical-card-revenue-center"
                                         class="empty-datatable-custom center-loading d-none"><img
                                            src="../../../../images/tms/empty.png"></div>
                                    <div id="chart-business-results-report-vertical-card-revenue-main" style="height: 100%; width: 98%"
                                         class="mt-4 vertical-chart count-loading-chart center-loading">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 card-block">
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <h5 class="text-center text-inverse font-weight-bold mb-0" style="font-size: 15px!important">
                                            <span style="font-size: 20px!important;">Tổng chi phí: </span>
                                            <span class="font-weight-bold" style="color: #fa6342;font-size: 20px!important" id="total-profit-business-results-report">0</span> VNĐ</h5>
                                    </div>
                                </div>
                                <div id="chart-business-results-report-vertical-card-profit" class="mt-0 vertical-chart count-loading-chart"
                                     style="height:400px">
                                    <div id="chart-business-results-report-vertical-card-profit-center"
                                         class="empty-datatable-custom center-loading d-none"><img
                                            src="../../../../images/tms/empty.png"></div>
                                    <div id="chart-business-results-report-vertical-card-profit-main" style="height: 100%; width: 98%"
                                         class="mt-4 vertical-chart count-loading-chart center-loading">
                                    </div>
                                </div>
                            </div>
                            <h4 class="sub-title m-t-10px m-l-10px">@lang('app.business-results-report.chart-card1')</h4>
                            <div id="div-card" class="card-block row"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none">
        <input id="type" value="5"/>
        <input id="time" value="{{date('Y')}}"/>
    </div>
@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="/js/report/business_results/index.js?version=1"></script>
    <script type="text/javascript" src="/js/report/business_results/action.js?version="></script>
    <script type="text/javascript" src="/js/report/business_results/chart.js?version="></script>
@endpush
