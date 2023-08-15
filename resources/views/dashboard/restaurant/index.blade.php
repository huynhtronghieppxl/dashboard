@extends('layouts.layout')
@section('content')
    @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) > 1)
        <head>
            <!-- radial chart.css -->
            <link rel="stylesheet" href="{{asset('files\assets\pages\chart\radial\css\radial.css?version=', env('IS_DEPLOY_ON_SERVER'))}}"
                  type="text/css" media="all">
            <link rel="stylesheet" type="text/css"
                  href="{{asset('files\bower_components\select2\css\select2.min.css?version=', env('IS_DEPLOY_ON_SERVER'))}}">
            <!-- Chartlist chart css -->
            <link rel="stylesheet" type="text/css"
                  href="{{asset('files\bower_components\chartist\css\chartist.css?version=', env('IS_DEPLOY_ON_SERVER'))}}">
            <!-- Nvd3 chart css -->
            <link rel="stylesheet" href="{{asset('files\bower_components\nvd3\css\nv.d3.css?version=', env('IS_DEPLOY_ON_SERVER'))}}"
                  type="text/css" media="all">
            <!-- C3 chart -->
            <link rel="stylesheet" href="{{asset('files\bower_components\c3\css\c3.css?version=', env('IS_DEPLOY_ON_SERVER'))}}" type="text/css"
                  media="all">
            <link rel="stylesheet" type="text/css" href="{{asset('files\assets\pages\timeline\style.css?version=', env('IS_DEPLOY_ON_SERVER'))}}">
        </head>
    @endif
    <div id="pcoded" class="pcoded">
        <div class="pcoded-container navbar-wrapper">
            <div class="pcoded-main-container edit-margin-content">
                <div class="pcoded-wrapper">
                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) > 1)
                                    <div class="cd-timeline cd-container" style="width: 45px; position: fixed">
                                        <div class="cd-timeline-block">
                                            <div class="cd-timeline-icon bg-customer-default real-profit-report"
                                                 data-position="1" data-key="real-profit-report" title=""
                                                 data-toggle="tooltip" data-placement="right"
                                                 data-original-title="@lang('app.restaurant-dashboard.real-profit-report.title')">
                                                <i class="icofont icofont-chart-flow"></i>
                                            </div>
                                        </div>
{{--                                        <div class="cd-timeline-block">--}}
{{--                                            <div class="cd-timeline-icon bg-customer-default supplier-report"--}}
{{--                                                 data-position="2" data-key="supplier-report" title=""--}}
{{--                                                 data-toggle="tooltip" data-placement="right"--}}
{{--                                                 data-original-title="@lang('app.restaurant-dashboard.supplier-report.title')">--}}
{{--                                                <i class="icofont icofont-chart-flow"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="page-body page-body-dashboard" style="padding-left: 50px">
                                        @include('dashboard.restaurant.real_profit_report')
{{--                                        @include('dashboard.restaurant.supplier_report')--}}
                                    </div>
                                @else
                                    <div class="page-body">

                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('layouts.oldDatatable')
    @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) > 1)
        <!-- c3 chart js -->
        <script src="{{asset('files\bower_components\c3\js\c3.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <!-- Chart js -->
        <script type="text/javascript" src="{{asset('files\bower_components\chart.js\js\Chart.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <!-- c3 chart js -->
        <script src="{{asset('files\bower_components\c3\js\c3.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <script src="{{asset('files\assets\pages\chart\c3\c3-custom-chart.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <!-- Chartlist charts -->
        <script src="{{asset('files\bower_components\chartist\js\chartist.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <script src="{{asset('files\assets\pages\chart\chartlist\js\chartist-plugin-threshold.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <!-- NVD3 chart -->
        <script src="{{asset('files\bower_components\d3\js\d3.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <script src="{{asset('files\bower_components\nvd3\js\nv.d3.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <script src="{{asset('files\assets\pages\chart\nv-chart\js\stream_layers.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <!-- gauge js -->
        <script src="{{asset('files\assets\pages\widget\gauge\gauge.min.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <script src="{{asset('files\assets\pages\widget\amchart\amcharts.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <script src="{{asset('files\assets\pages\widget\amchart\serial.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <script src="{{asset('files\assets\pages\widget\amchart\gauge.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <script src="{{asset('files\assets\pages\widget\amchart\pie.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
        <script src="{{asset('files\assets\pages\widget\amchart\light.js?version=', env('IS_DEPLOY_ON_SERVER'))}}."></script>

        <script src="{{asset('js/dashboard/restaurant/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"
                type="text/javascript"></script>
    @endif
@endpush
