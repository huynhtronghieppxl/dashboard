@extends('layouts.layout')
@section('content')
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
    <div class="main-body">
        <div class="page-wrapper">
            <div class="cd-timeline cd-container" style="width: 45px; position: fixed">
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default real-profit-report"
                         data-position="1" data-key="real-profit-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="@lang('app.restaurant-dashboard.real-profit-report.title')">
                        <i class="icofont icofont-chart-flow"></i>
                    </div>
                </div>
            </div>
            <div class="page-body page-body-dashboard" style="padding-left: 50px">
                @include('transport.dashboard.order')
                @include('transport.dashboard.order_complete')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- c3 chart js -->
    <script src="{{asset('files\bower_components\c3\js\c3.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{asset('files\bower_components\chart.js\js\Chart.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <!-- c3 chart js -->
    <script src="{{asset('files\bower_components\c3\js\c3.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\assets\pages\chart\c3\c3-custom-chart.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <!-- Chartlist charts -->
    <script src="{{asset('files\bower_components\chartist\js\chartist.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\assets\pages\chart\chartlist\js\chartist-plugin-threshold.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <!-- NVD3 chart -->
    <script src="{{asset('files\bower_components\d3\js\d3.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\bower_components\nvd3\js\nv.d3.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\assets\pages\chart\nv-chart\js\stream_layers.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <!-- gauge js -->
    <script src="{{asset('files\assets\pages\widget\gauge\gauge.min.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\assets\pages\widget\amchart\amcharts.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\assets\pages\widget\amchart\serial.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\assets\pages\widget\amchart\gauge.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\assets\pages\widget\amchart\pie.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script src="{{asset('files\assets\pages\widget\amchart\light.js?version=', env('IS_DEPLOY_ON_SERVER'))}}."></script>

    <script src="{{asset('js/transport/dashboard/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"
            type="text/javascript"></script>
@endpush
