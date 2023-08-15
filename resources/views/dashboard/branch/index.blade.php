@extends('layouts.layout')
@section('content')
    <style>
        .seemt-container .seemt-main {
            overflow-y: hidden;
        }

        .cd-timeline {
            padding: 0 21px 9px 9px !important;
        }

        .page-wrapper::-webkit-scrollbar {
            width: 4px;
        }

        .cd-timeline::-webkit-scrollbar {
            width: 0;
        }

        .seemt-container .select2-container--default .select2-selection--single .select2-selection__rendered {
            margin-top: 5px !important;
        }

        #select-type-business-growth-report ~ .select2-container--default .select2-selection--single .select2-selection__arrow,
        #select-option-type-point-filter-report ~ .select2-container--default .select2-selection--single .select2-selection__arrow,
        #select-option-type-sort-filter-report ~ .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 0 !important;
        }

        @media screen and (max-width: 1500px) {
            .seemt-container .revenue .paid-revenue {
                align-items: center;
                justify-content: space-between;
            }

            .seemt-container .revenue .logo-revenue {
                width: 50px;
                height: 50px;
                padding: 10px 18.33px 18.33px 11.33px;
                border-radius: 6px;
            }

            .seemt-container .revenue .logo-revenue i {
                font-size: 26.33px !important;
            }

            .seemt-container .revenue .paid-revenue .content-revenue .total-revenue label {
                font-size: 20px;
            }
        }

        @media screen and (max-width: 1300px) {
            .seemt-container .revenue .logo-revenue {
                width: 40px;
                height: 40px;
                padding: 8px 18.33px 18.33px 11.33px;
                border-radius: 6px;
            }

            .seemt-container .revenue .logo-revenue i {
                font-size: 20.33px !important;
            }
        }

        @media screen and (min-width: 1201px) and (max-width: 1300px) {
            .seemt-container .revenue .paid-revenue .content-revenue .total-revenue label {
                font-size: 18px;
            }
        }

        @media screen and (max-width: 1200px) {
            .seemt-container .revenue .paid-revenue .content-revenue .total-revenue label {
                font-size: 18px;
            }
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
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
                  integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
                  crossorigin="anonymous" referrerpolicy="no-referrer"/>
        </head>
    <div class="main-body">
        <div class="page-wrapper" style=" overflow: auto; max-height: calc(100vh - 62px); overflow-x: hidden">
            <span class="fi-rr-caret-up d-none"
                  style="position: fixed; top: 70px; z-index: 9999; margin-left: 7px; font-size: 18px !important;"></span>
                <div class="cd-timeline cd-container"
                     style="width: 45px; position: fixed;height: calc(100vh - 90px);display: block;overflow-y: auto;">
                    <div class="cd-timeline-block caret-up">
                        <div class="cd-timeline-icon bg-customer-default current-day-report active"
                             data-position="0" data-key="current-day-report"
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="@lang('app.branch-dashboard.current-day-report.title')">
                            <i class="fi-rr-chart-pie-alt"></i>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default business-growth-report"
                             data-position="1" data-key="business-growth-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="@lang('app.branch-dashboard.business-growth-report.title')">
                            <i class="fi-rr-chart-histogram"></i>
                        </div>
                    </div>
                    @if(count(array_intersect(Session::get(SESSION_PERMISSION), $permission)) > 1)
                        <div class="cd-timeline-block">
                            <div class="cd-timeline-icon bg-customer-default revenue-cost-profit-report"
                                 data-position="2" data-key="revenue-cost-profit-report" title=""
                                 data-toggle="tooltip" data-placement="right"
                                 data-original-title="@lang('app.branch-dashboard.revenue-cost-profit-report.title')">
                                <i class="fi-rr-chat-arrow-grow"></i>
                            </div>
                        </div>
                        <div class="cd-timeline-block">
                            <div class="cd-timeline-icon bg-customer-default inventory-report"
                                 data-position="3" data-key="inventory-report" title="" data-toggle="tooltip"
                                 data-placement="right"
                                 data-original-title="@lang('app.branch-dashboard.inventory-report.title')">
                                <i class="fi-rr-chart-pie-alt"></i>
                            </div>
                        </div>
                        <div class="cd-timeline-block">
                            <div class="cd-timeline-icon bg-customer-default customer-report"
                                 data-position="4" data-key="customer-report" title=""
                                 data-toggle="tooltip" data-placement="right"
                                 data-original-title="@lang('app.branch-dashboard.customer-report.title')">
                                <i class="fi-rr-user"></i>
                            </div>
                        </div>
                    @else
                        @if(collect(array_intersect(Session::get(SESSION_PERMISSION), $permission))->first() !== 'SALE_REPORT')
                            <div class="cd-timeline-block">
                                <div class="cd-timeline-icon bg-customer-default revenue-cost-profit-report"
                                     data-position="2" data-key="revenue-cost-profit-report" title=""
                                     data-toggle="tooltip" data-placement="right"
                                     data-original-title="@lang('app.branch-dashboard.revenue-cost-profit-report.title')">
                                    <i class="fi-rr-chat-arrow-grow"></i>
                                </div>
                            </div>
                            <div class="cd-timeline-block">
                                <div class="cd-timeline-icon bg-customer-default inventory-report"
                                     data-position="3" data-key="inventory-report" title="" data-toggle="tooltip"
                                     data-placement="right"
                                     data-original-title="@lang('app.branch-dashboard.inventory-report.title')">
                                    <i class="fi-rr-chart-pie-alt"></i>
                                </div>
                            </div>
                            <div class="cd-timeline-block">
                                <div class="cd-timeline-icon bg-customer-default customer-report"
                                     data-position="4" data-key="customer-report" title=""
                                     data-toggle="tooltip" data-placement="right"
                                     data-original-title="@lang('app.branch-dashboard.customer-report.title')">
                                    <i class="fi-rr-user"></i>
                                </div>
                            </div>
                        @endif
                    @endif
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default revenue-report"
                             data-position="5" data-key="revenue-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="@lang('app.branch-dashboard.revenue-report.title')">
                            <i class="icofont icofont-chart-line"></i>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default area-report"
                             data-position="6" data-key="area-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="@lang('app.branch-dashboard.area-report.title')">
                            <i class="icofont icofont-pie"></i>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default employee-report"
                             data-position="7" data-key="employee-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="@lang('app.branch-dashboard.employee-report.title')">
                            <i class="icofont icofont-ui-user"></i>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default food-drink-report"
                             data-position="8" data-key="food-drink-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="@lang('app.branch-dashboard.food-drink-report.title-food')">
                            <i class="fi-rr-drumstick"></i>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default drink-report"
                             data-position="9" data-key="drink-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="@lang('app.branch-dashboard.food-drink-report.title-drink')">
                            <i class="fi-rr-drink-alt"></i>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default category-report"
                             data-position="10" data-key="category-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="@lang('app.branch-dashboard.category-report.title')">
                            <i class="icofont icofont-papers"></i>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default gift-food-report"
                             data-position="11" data-key="gift-food-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="@lang('app.branch-dashboard.gift-food-report.title')">
                            <i class="icofont icofont-gift"></i>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default dishes-report"
                             data-position="12" data-key="dishes-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="@lang('app.branch-dashboard.dishes-report.title')">
                            <i class="icofont icofont-papers"></i>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default food-cancel-report"
                             data-position="13" data-key="food-cancel-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="Báo cáo món huỷ">
                            <i class="icofont icofont-papers"></i>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default take-away-report"
                             data-position="14" data-key="take-away-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="Báo cáo món mang về">
                            <i class="icofont icofont-papers"></i>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default vat-food-report"
                             data-position="15" data-key="vat-food-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="Báo cáo VAT">
                            <i class="icofont icofont-papers"></i>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default discount-report"
                             data-position="16" data-key="discount-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="@lang('app.branch-dashboard.discount-report.title')">
                            <i class="icofont icofont-download-alt"></i>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-icon bg-customer-default surcharge-report"
                             data-position="17" data-key="surcharge-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="@lang('app.branch-dashboard.surcharge-report.title')">
                            <i class="icofont icofont-zipped"></i>
                        </div>
                    </div>
                    @if(count(array_intersect(Session::get(SESSION_PERMISSION), $permission)) > 1)
                        <div class="cd-timeline-block">
                            <div class="cd-timeline-icon bg-customer-default profit-loss-report"
                                 data-position="18" data-key="profit-loss-report" title=""
                                 data-toggle="tooltip" data-placement="right"
                                 data-original-title="Báo cáo P&L">
                                <i class="icofont icofont-papers"></i>
                            </div>
                        </div>
                    @else
                        @if(collect(array_intersect(Session::get(SESSION_PERMISSION), $permission))->first() !== 'SALE_REPORT')
                            <div class="cd-timeline-block">
                                <div class="cd-timeline-icon bg-customer-default profit-loss-report"
                                     data-position="18" data-key="profit-loss-report" title=""
                                     data-toggle="tooltip" data-placement="right"
                                     data-original-title="Báo cáo P&L">
                                    <i class="icofont icofont-papers"></i>
                                </div>
                            </div>
                        @endif
                    @endif
                    @if(Session::get(SESSION_KEY_LEVEL) > 6)
                        <div class="cd-timeline-block caret-down">
                        <div class="cd-timeline-icon bg-customer-default recharge-cart-point-report"
                             data-position="19" data-key="recharge-cart-point-report" title=""
                             data-toggle="tooltip" data-placement="right"
                             data-original-title="Báo cáo nạp thẻ">
                            <i class="icofont icofont-papers"></i>
                        </div>
                    </div>
                    @endif
                    @if(Session::get(SESSION_KEY_LEVEL) > 2)
                        <div class="cd-timeline-block ">
                            <div class="cd-timeline-icon bg-customer-default customer-use-point-report"
                                 data-position="20" data-key="customer-use-point-report" title=""
                                 data-toggle="tooltip" data-placement="right"
                                 data-original-title="Báo cáo điểm">
                                <i class="icofont icofont-papers"></i>
                            </div>
                        </div>
                    @endif
                    <span class="fi-rr-caret-down"
                          style="position: fixed; bottom: 0; z-index: 9999; font-size: 18px !important;"></span>
                </div>
                <div class="page-body page-body-dashboard" style="padding-left: 50px">
                    @include('dashboard.branch.current_day_report')
                    @include('dashboard.branch.business_growth_report')
                    @if(count(array_intersect(Session::get(SESSION_PERMISSION), $permission)) > 1)
                        @include('dashboard.branch.revenue_cost_profit_report')
                        @include('dashboard.branch.inventory_report')
                        @include('dashboard.branch.customer_report')
                    @else
                        @if(collect(array_intersect(Session::get(SESSION_PERMISSION), $permission))->first() !== 'SALE_REPORT')
                            @include('dashboard.branch.revenue_cost_profit_report')
                            @include('dashboard.branch.inventory_report')
                            @include('dashboard.branch.customer_report')
                        @endif
                    @endif
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
{{--                    @include('dashboard.branch.order_report')--}}
                    @if(count(array_intersect(Session::get(SESSION_PERMISSION), $permission)) > 1)
                        @include('dashboard.branch.profit_loss_report')
                    @else
                        @if(collect(array_intersect(Session::get(SESSION_PERMISSION), $permission))->first() !== 'SALE_REPORT')
                            @include('dashboard.branch.profit_loss_report')
                        @endif
                    @endif
                    @if(Session::get(SESSION_KEY_LEVEL) > 6)
                        @include('dashboard.branch.recharge_card_report')
                    @endif
                    @if(Session::get(SESSION_KEY_LEVEL) > 2)
                        @include('dashboard.branch.point_report')
                    @endif
                </div>
        </div>
    </div>
    @include('dashboard.branch.detail.cost_estimate')
    @include('dashboard.branch.detail.cost_current')
    @include('dashboard.branch.detail.cost')
    @include('customer.customers.detail')
    @include('dashboard.branch.detail.other_cost')
    @include('dashboard.branch.detail.debt')
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
        <script src="{{asset('js/dashboard/branch/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"
                type="text/javascript"></script>
@endpush
