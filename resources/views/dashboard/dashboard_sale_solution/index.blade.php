@extends('layouts.layout')
@section('content')
    <style>
        .seemt-container .seemt-main {
            overflow-y: hidden;
        }

        .page-wrapper::-webkit-scrollbar {
            width: 4px;
        }

        .seemt-container .select2-container--default .select2-selection--single .select2-selection__rendered {
            margin-top: 5px !important;
        }

        .seemt-container .page-body-dashboard .select-material-box {
            padding: 3px 0 !important;
        }

        .content-revenue-month-chart-report {
            background: #ffffff !important;
        }
    </style>
    <head>
        <!-- radial chart.css -->
        <link rel="stylesheet" href="{{asset('files\assets\pages\chart\radial\css\radial.css?version=')}}"
              type="text/css" media="all">
        <link rel="stylesheet" type="text/css"
              href="{{asset('files\bower_components\select2\css\select2.min.css?version=')}}">
        <!-- Chartlist chart css -->
        <link rel="stylesheet" type="text/css"
              href="{{asset('files\bower_components\chartist\css\chartist.css?version=')}}">
        <!-- Nvd3 chart css -->
        <link rel="stylesheet" href="{{asset('files\bower_components\nvd3\css\nv.d3.css?version=')}}"
              type="text/css" media="all">
        <!-- C3 chart -->
        <link rel="stylesheet" href="{{asset('files\bower_components\c3\css\c3.css?version=')}}" type="text/css"
              media="all">
        <link rel="stylesheet" type="text/css" href="{{asset('files\assets\pages\timeline\style.css?version=')}}">
    </head>
    <div class="main-body">
        <div class="card card-block mt-0" id="filter-brand-header">
            <div class="select-filter-dataTable d-flex justify-content-end">
                <div class="form-validate-select mr-1" style="min-width: 242px;">
                    <div class="pr-0 select-material-box">
                        <select class="js-example-basic-single select-brand">
                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                    <option value="{{$db['id']}}"
                                            selected>{{$db['name']}}</option>
                                @else
                                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-validate-select" style="min-width: 242px;">
                    <div class="pr-0 select-material-box">
                        <select class="js-example-basic-single select-branch select-branch-area-data">
                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                                @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                    <option value="{{$db['id']}}"
                                            selected>{{$db['name']}}</option>
                                @else
                                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-wrapper" style="overflow: auto;max-height: calc(100vh - 177px);overflow-x: hidden;">
            <div class="cd-timeline cd-container"
                 style="width: 45px; position: fixed;height: calc(100vh - 100px);display: block;overflow-y: auto;">
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default current-day-report active"
                         data-position="0" data-key="current-day-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="@lang('app.branch-dashboard.current-day-report.title')">
                        <i class="fi-rr-chart-pie-alt"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default revenue-report"
                         data-position="1" data-key="revenue-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="@lang('app.branch-dashboard.revenue-report.title')">
                        <i class="icofont icofont-chart-line"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default area-report"
                         data-position="2" data-key="area-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="@lang('app.branch-dashboard.area-report.title')">
                        <i class="icofont icofont-pie"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default employee-report"
                         data-position="3" data-key="employee-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="@lang('app.branch-dashboard.employee-report.title')">
                        <i class="icofont icofont-ui-user"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default food-drink-report"
                         data-position="4" data-key="food-drink-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="@lang('app.branch-dashboard.food-drink-report.title')">
                        <i class="fi-rr-drumstick"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default drink-report"
                         data-position="5" data-key="drink-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="@lang('app.branch-dashboard.food-drink-report.title-drink')">
                        <i class="fi-rr-drink-alt"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default category-report"
                         data-position="6" data-key="category-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="@lang('app.branch-dashboard.category-report.title')">
                        <i class="icofont icofont-papers"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default gift-food-report"
                         data-position="7" data-key="gift-food-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="@lang('app.branch-dashboard.gift-food-report.title')">
                        <i class="icofont icofont-gift"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default dishes-report"
                         data-position="8" data-key="dishes-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="@lang('app.branch-dashboard.dishes-report.title')">
                        <i class="icofont icofont-papers"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default food-cancel-report"
                         data-position="9" data-key="food-cancel-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="Báo cáo món huỷ">
                        <i class="icofont icofont-papers"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default take-away-report"
                         data-position="10" data-key="take-away-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="Báo cáo món mang về">
                        <i class="icofont icofont-papers"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default vat-food-report"
                         data-position="11" data-key="vat-food-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="Báo cáo VAT">
                        <i class="icofont icofont-papers"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default discount-report"
                         data-position="12" data-key="discount-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="@lang('app.branch-dashboard.discount-report.title')">
                        <i class="icofont icofont-download-alt"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default surcharge-report"
                         data-position="12" data-key="surcharge-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="@lang('app.branch-dashboard.surcharge-report.title')">
                        <i class="icofont icofont-zipped"></i>
                    </div>
                </div>
            </div>

            <div class="page-body page-body-dashboard" style="padding-left: 50px">
                @include('dashboard.branch.current_day_report')
                @include('dashboard.branch.revenue_report')
                @include('dashboard.branch.area_report')
                @include('dashboard.branch.employee_report')
                @include('dashboard.branch.food_drink_report')
                @include('dashboard.branch.drink_report')
                @include('dashboard.branch.category_report')
                @include('dashboard.branch.gift_food_report')
                @include('dashboard.branch.off_menu_dishes_report')
                @include('dashboard.branch.food_cancel_report')
                @include('dashboard.branch.take_away_report')
                @include('dashboard.branch.vat_report')
                @include('dashboard.branch.discount_report')
                @include('dashboard.branch.surcharge_report')
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- c3 chart js -->
    <script src="{{asset('files\bower_components\c3\js\c3.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <!-- Chart js -->
    <script type="text/javascript"
            src="{{asset('files\bower_components\chart.js\js\Chart.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
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
    <script src="{{asset('js/dashboard/dashboard_sale_solution/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"
            type="text/javascript"></script>
@endpush
