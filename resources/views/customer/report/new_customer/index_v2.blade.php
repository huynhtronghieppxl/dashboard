@extends('layouts.layout')
@section('content')
    <head>
        <link rel="stylesheet" type="text/css" href="/files\assets\pages\timeline\style.css?version=">
        <style>
            .tooltip_formula {
                opacity: 0.9;
                position: relative;
            }

            /*.tooltip_formula:hover .tooltip_formula_wrapper{*/
            /*    display: block;*/
            /*}*/
            .tooltip_formula_wrapper {
                cursor: pointer;
                visibility: hidden;
                background: #333;
                position: absolute;
                top: 50%;
                right: 18px;
                transform: translateY(-50%);
                display: flex;
                width: max-content;
                color: white;
                align-items: center;
                padding: 6px;
                border-radius: 4px;
                gap: 10px;
                transition: .25s ease-in;
            }

            .tooltip_formula_wrapper:before {
                content: "";
                position: absolute;
                right: -6px;
                top: 50%;
                transform: translateY(-50%);
                width: 0;
                height: 0;
                border-top: 6px solid transparent;
                border-bottom: 6px solid transparent;
                border-left: 6px solid #333
            }

            .tooltip_formula:hover .tooltip_formula_wrapper {
                visibility: visible;
            }

            #chart-new-customer-report-main,
            #table-card2 {
                height: calc(100vh - 190px) !important;
            }

            #chart-new-customer-report {
                height: 100% !important;
            }

            .icon-filter-component {
                border-radius: 0 6px 6px 0 !important;
            }

            .seemt-main {
                overflow: hidden !important;
            }
        </style>
    </head>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card" id="content-detail">
                @include('customer.report.new_customer.filter')
                <div class="row mt-5 justify-content-center scroll-containers">
                    <div class="col-lg-12">
                        <div class="card-block-big pt-0 pb-2 selections" id="data-chart">
                            <div id="chart-new-customer-report-main" class="mt-0 vertical-chart count-loading-chart"
                                 style="height:400px">
                                <div id="chart-customer-empty"
                                     class="empty-datatable-custom center-loading d-none"><img style="width: 200px"
                                                                                               src="../../../../images/tms/empty.png">
                                </div>
                                <div id="chart-new-customer-report" style="height: 400px"
                                     class="mt-0 vertical-chart count-loading-chart center-loading">
                                </div>
                            </div>
                        </div>
                        <div class="card-body selections">
                            <div class="table-responsive new-table table-container-loading" id="table-card2">
                                <table id="table-new-customer-report" class="table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.new-customer-report.stt')</th>
                                        <th rowspan="2">@lang('app.new-customer-report.name')</th>
                                        <th rowspan="2">@lang('app.new-customer-report.gender')</th>
                                        <th rowspan="2">@lang('app.new-customer-report.date')</th>
                                        <th rowspan="2">@lang('app.new-customer-report.type')</th>
                                        <th class="text-right">
                                            <div class="row m-0 p-0">
                                                <div class="col-5 ml-auto pr-0">@lang('app.new-customer-report.point')
                                                    <label class="mb-0 ml-1">
                                                        <div class="tool-box">
                                                            <div data-toolbar="user-options">
                                                                <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                                   data-toggle="tooltip" data-placement="top"
                                                                   data-original-title="Số điểm tích lũy được"></i>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </th>
                                        <th rowspan="2" class="d-none"></th>
                                    </tr>
                                    <tr>
                                        <th class="seemt-fz-16" id="total-accumulate-point-new-customer-report">0</th>
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
    @include('customer.report.new_customer.excel')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/report/new_customer/index.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{asset('js/customer/report/new_customer/action.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
