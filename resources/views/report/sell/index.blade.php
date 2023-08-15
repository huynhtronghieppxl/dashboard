{{--@extends('layouts.layout')--}}
{{--@section('content')--}}
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">--}}
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}"/>--}}
{{--    <head>--}}
{{--        <link rel="stylesheet" type="text/css" href="{{asset('files\assets\pages\timeline\style.css?version=')}}">--}}
{{--    </head>--}}
{{--    <div class="page-wrapper">--}}
{{--        <div class="cd-timeline cd-container"--}}
{{--             style="width: 45px; position: fixed;height: calc(100vh - 100px);display: block;overflow-y: auto;padding-top: 0">--}}
{{--            <div class="cd-timeline-block">--}}
{{--                <div class="cd-timeline-icon bg-customer-default active"--}}
{{--                     data-type="1"--}}
{{--                     data-toggle="tooltip" data-placement="right"--}}
{{--                     data-original-title="@lang('app.sell-report.card1.title')"--}}
{{--                     onclick="changeDataSell($(this)); loadData()">--}}
{{--                    <i class="icofont icofont-restaurant-menu"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="cd-timeline-block">--}}
{{--                <div class="cd-timeline-icon bg-customer-default"--}}
{{--                     data-type="2"--}}
{{--                     data-toggle="tooltip" data-placement="right"--}}
{{--                     data-original-title="@lang('app.sell-report.card2.title')"--}}
{{--                     onclick="changeDataSell($(this)); loadData()">--}}
{{--                    <i class="icofont icofont-restaurant"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="cd-timeline-block">--}}
{{--                <div class="cd-timeline-icon bg-customer-default"--}}
{{--                     data-type="4" data-key="business-growth-report"--}}
{{--                     data-toggle="tooltip" data-placement="right"--}}
{{--                     data-original-title="@lang('app.sell-report.card4.title')"--}}
{{--                     onclick="changeDataSell($(this)); loadData()">--}}
{{--                    <i class="icofont icofont-gift"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="cd-timeline-block">--}}
{{--                <div class="cd-timeline-icon bg-customer-default"--}}
{{--                     data-type="5" data-key="revenue-cost-profit-report"--}}
{{--                     data-toggle="tooltip" data-placement="right"--}}
{{--                     data-original-title="@lang('app.sell-report.card5.title')"--}}
{{--                     onclick="changeDataSell($(this)); loadData()">--}}
{{--                    <i class="icofont icofont-chart-line-alt"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="cd-timeline-block">--}}
{{--                <div class="cd-timeline-icon bg-customer-default"--}}
{{--                     data-type="6" data-toggle="tooltip"--}}
{{--                     data-placement="right"--}}
{{--                     data-original-title="@lang('app.sell-report.card6.title')"--}}
{{--                     onclick="changeDataSell($(this)); loadData()">--}}
{{--                    <i class="icofont icofont-fast-food"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="cd-timeline-block">--}}
{{--                <div class="cd-timeline-icon bg-customer-default"--}}
{{--                     data-type="7"--}}
{{--                     data-toggle="tooltip" data-placement="right"--}}
{{--                     data-original-title="@lang('app.sell-report.card7.title')"--}}
{{--                     onclick="changeDataSell($(this)); loadData()">--}}
{{--                    <i class="icofont icofont-ui-delete"></i>--}}
{{--                </div>--}}
{{--            </div><div class="cd-timeline-block">--}}
{{--                <div class="cd-timeline-icon bg-customer-default"--}}
{{--                     data-type="8"--}}
{{--                     data-toggle="tooltip" data-placement="right"--}}
{{--                     data-original-title="@lang('app.sell-report.card8.title')"--}}
{{--                     onclick="changeDataSell($(this)); loadData()">--}}
{{--                    <i class="icofont icofont-file-alt"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="page-body" style="padding-left: 50px";>--}}
{{--            <div class="card card-block" id="data-null-detail">--}}
{{--                <div class="text-center">--}}
{{--                    <h4>@lang('app.sell-report.message_data_null')</h4>--}}
{{--                    <div class="count-loading-chart">--}}
{{--                        <div class='empty-datatable-custom'><img--}}
{{--                                src='../../../../files/assets/images/nodata-datatable2.png'></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card d-none" id="content-detail">--}}
{{--                <div class="card-header">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-12 text-center">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-2 first-col-date-report">--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-8 second-col-date-report">--}}
{{--                                    <div class="card-block btn-group pb-0" id="btn-type-time-sell-report">--}}
{{--                                        <button id="btn-day"--}}
{{--                                                class="btn btn-grd-warning btn-warning btn-outline-warning btn-edit-display border-radius-first-20">@lang('app.sell-report.button-day')</button>--}}
{{--                                        <button id="btn-week"--}}
{{--                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.sell-report.button-week')</button>--}}
{{--                                        <button id="btn-month"--}}
{{--                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.sell-report.button-month')</button>--}}
{{--                                        <button id="btn-3month"--}}
{{--                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.sell-report.button-3-month')</button>--}}
{{--                                        <button id="btn-year"--}}
{{--                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.sell-report.button-year')</button>--}}
{{--                                        <button id="btn-3year"--}}
{{--                                                class="btn btn-warning btn-outline-warning btn-edit-display">@lang('app.sell-report.button-3-year')</button>--}}
{{--                                        <button id="btn-allyear"--}}
{{--                                                class="btn btn-warning btn-outline-warning btn-edit-display border-radius-last-20">@lang('app.sell-report.button-all-year')</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-12 row">--}}
{{--                            <div class="input-group col-lg-3 m-auto add-display border-group px-0" id='day' style="margin-top: 15px!important">--}}
{{--                                <input id="calendar-day"--}}
{{--                                       class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate"--}}
{{--                                       type="text"--}}
{{--                                       placeholder="{{date('d/m/Y')}}" value="{{date('d/m/Y')}}">--}}
{{--                                <button class="input-group-addon cursor-pointer custom-button-search"><i--}}
{{--                                        class="fa fa-search"></i></button>--}}
{{--                            </div>--}}
{{--                            <div class="input-group col-lg-3 m-auto add-display d-none border-group px-0" id='month' style="margin-top: 15px!important">--}}
{{--                                <input id="calendar-month"--}}
{{--                                       class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate"--}}
{{--                                       type="text"--}}
{{--                                       placeholder="{{date('m')}}" value="{{date('m')}}">--}}
{{--                                <button class="input-group-addon cursor-pointer custom-button-search"><i--}}
{{--                                        class="fa fa-search"></i></button>--}}
{{--                            </div>--}}
{{--                            <div class="input-group col-lg-3 m-auto add-display d-none border-group px-0" id='year' style="margin-top: 15px!important">--}}
{{--                                <input id="calendar-year"--}}
{{--                                       class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate"--}}
{{--                                       type="text"--}}
{{--                                       placeholder="{{date('Y')}}" value="{{date('Y')}}">--}}
{{--                                <button class="input-group-addon cursor-pointer custom-button-search"><i--}}
{{--                                        class="fa fa-search"></i></button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}

{{--                    <div id="total-card-all-sell-report" class="col-sm-12">--}}
{{--                        <h5 class="text-center text-inverse font-weight-bold mb-0" style="font-size: 15px!important"><span class="font-weight-bold" style="color: #fa6342;font-size: 20px!important"--}}
{{--                                    id="total">0</span> @lang('app.component.unit-money.vnd')</h5>--}}
{{--                    </div>--}}
{{--                    <div id="total-card-2-sell-report" class="col-sm-8 row d-none">--}}
{{--                        <div class="col-sm-4">--}}
{{--                            <h5 class="text-center text-inverse font-weight-bold" style="font-size: 17px!important; line-height: 30px">@lang('app.sell-report.card2.material')--}}
{{--                               :<br> <span class="font-weight-bold" style="font-size: 17px!important"--}}
{{--                                      id="total-material-card2">0</span> @lang('app.component.unit-money.vnd')--}}
{{--                            </h5>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                            <h5 class="text-center text-inverse font-weight-bold" style="font-size: 17px!important; line-height: 30px">@lang('app.sell-report.card2.goods')--}}
{{--                               :<br> <span class="font-weight-bold" style="font-size: 17px!important"--}}
{{--                                      id="total-goods-card2">0</span> @lang('app.component.unit-money.vnd')</h5>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-4">--}}
{{--                            <h5 class="text-center text-inverse font-weight-bold" style="font-size: 17px!important; line-height: 30px">@lang('app.sell-report.total')--}}
{{--                               :<br> <span class="font-weight-bold" style="font-size: 17px!important"--}}
{{--                                      id="total-total-card2">0</span> @lang('app.component.unit-money.vnd')</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <div class="card-block-big pt-0" id="data-chart">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-4 text-left">--}}
{{--                                    <div class="form-radio" id="chart-input-radio-sell-report">--}}
{{--                                        <form>--}}
{{--                                            <div class="radio radio-inline-report">--}}
{{--                                                <label>--}}
{{--                                                    <input type="radio" id="chart_vertical" name="radio"--}}
{{--                                                           checked="checked">--}}
{{--                                                    <i class="helper"></i>@lang('app.component.chart.vertical-chart')--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="radio radio-inline-report">--}}
{{--                                                <label>--}}
{{--                                                    <input type="radio" id="chart_horizontal" name="radio">--}}
{{--                                                    <i class="helper"></i>@lang('app.component.chart.horizontal-chart')--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-4">--}}
{{--                                    <div class="form-group select2_theme validate-group d-none" id="select-category-card2-div">--}}
{{--                                        <div class="form-validate-select">--}}
{{--                                            <div class="col-lg-12 mx-0 px-0">--}}
{{--                                                <div class="col-lg-12 pr-0 select-material-box">--}}
{{--                                                    <select class="js-example-basic-single select2-hidden-accessible" id="select-category-card2" tabindex="-1" aria-hidden="true">--}}
{{--                                                        <option--}}
{{--                                                            value="@lang('app.component.option_value.all')">@lang('app.component.option-all')</option>--}}
{{--                                                        <option value="0">@lang('app.sell-report.card2.material-inventory')</option>--}}
{{--                                                        <option value="1">@lang('app.sell-report.card2.goods-inventory')</option>--}}
{{--                                                    </select>--}}
{{--                                                    <div class="line"></div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="link-href"></div>--}}
{{--                                    </div>--}}
{{--                                    <div class="input-group col-md-12 col-lg-6 add-display m-auto d-none"--}}
{{--                                         id="select-food-card3-div">--}}
{{--                                        <select class="js-example-basic-single float-left" id="select-food-card3">--}}
{{--                                            <option--}}
{{--                                                value="@lang('app.component.option_value.all')">@lang('app.component.option_default')</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-4">--}}
{{--                                    <div class="checkbox-fade fade-in-primary float-right">--}}
{{--                                        <label>--}}
{{--                                            <input type="checkbox" id="label-chart"--}}
{{--                                                   checked>--}}
{{--                                            <span class="cr"><i--}}
{{--                                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
{{--                                            <span>@lang('app.component.chart.check-detail')</span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div id="chart-sell-report-vertical" class="mt-0 vertical-chart count-loading-chart"--}}
{{--                                 style="height:400px">--}}
{{--                                <div id="chart-sell-report-vertical-center"--}}
{{--                                     class="empty-datatable-custom center-loading d-none"><img--}}
{{--                                        src="../../../../files/assets/images/nodata-datatable2.png"></div>--}}
{{--                                <div id="chart-sell-report-vertical-main" style="height: 100%" class="mt-0 vertical-chart count-loading-chart center-loading">--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div id="chart-sell-report-horizontal" class="d-none count-loading-chart"--}}
{{--                                 style="height:800px">--}}
{{--                                <div class="empty-datatable-custom center-loading"><img--}}
{{--                                        src="../../../../files/assets/images/nodata-datatable2.png"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-3">--}}
{{--                            <h5 class="sub-title-2 text-center mb-0" style="font-weight: 600!important;">@lang('app.sell-report.table')</h5>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            @include('report.sell.table')--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="d-none">--}}
{{--        <input id="name-card1" value="@lang('app.sell-report.card1.name')"/>--}}
{{--        <input id="name-card2" value="@lang('app.sell-report.card2.name')"/>--}}
{{--        <input id="name-card3" value="@lang('app.sell-report.card3.name')"/>--}}
{{--        <input id="name-card4" value="@lang('app.sell-report.card4.name')"/>--}}
{{--        <input id="name-card5" value="@lang('app.sell-report.card5.name')"/>--}}
{{--        <input id="name-card6" value="@lang('app.sell-report.card6.name')"/>--}}
{{--        <input id="name-card7" value="@lang('app.sell-report.card7.name')"/>--}}
{{--    </div>--}}
{{--    @include('manage.bill.detail')--}}
{{--    @include('report.sell.detail_category')--}}
{{--    @include('report.sell.detail_food')--}}
{{--    @include('report.sell.detail_gift_food')--}}
{{--    @include('report.sell.detail_discount')--}}
{{--@endsection--}}
{{--@push('scripts')--}}
{{--    @include('layouts.datatable')--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.3/echarts.min.js"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('js\template_custom\dataTable.js?version=1')}}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('..\js\report\sell\index.js?version=4')}}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('..\js\report\sell\chart.js?version=')}}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('..\js\report\sell\table.js?version=2')}}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('..\js\report\sell\action.js?version=1')}}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('..\js\report\sell\total.js?version=')}}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('..\js\report\sell\detail.js?version=')}}"></script>--}}
{{--@endpush--}}
