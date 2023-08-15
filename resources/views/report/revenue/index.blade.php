@extends('layouts.layout')
@section('content')
    <style>
        .seemt-main {
            overflow: hidden !important;
        }

        #chart-sell-report-rounded {
            height: calc(100vh - 200px) !important;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-center">
                        <div class="col-lg-12" id="filter-sell-gift-food-report">
                            @include('report.filter')
                        </div>
                    </div>
                </div>
                <div class="row mt-2 scroll-containers">
                    <div class="col-lg-12">
                        <div class="col-xl-12 selections">
                            <div class="">
                                <div id="chart-sell-report-rounded">
                                    <div id="chart-revenue-report-center"
                                         style="top: 30%!important; left: 52% !important;"
                                         class="center-loading d-none">
                                        <img style="width: 200px"
                                             src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}">
                                    </div>
                                    <div id="chart-revenue-report-main" class="h-100 w-100 count-loading-chart"
                                         style="width: 100%; height: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 selections">
                            <div class="table-responsive new-table">
                                <table id="table-revenue-report" class="table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.revenue-report.stt')</th>
                                        <th rowspan="2">@lang('app.revenue-report.name')</th>
                                        <th>@lang('app.revenue-report.amount')</th>
                                        <th rowspan="2"></th>
                                        <th rowspan="2" class="d-none"></th>
                                    </tr>
                                    <tr>
                                        <th class="seemt-fz-14" id="total-amount-revenue-report">0</th>
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
    {{--Modal detail--}}
    @include('report.revenue.detail')
    @include('report.revenue.excel')
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.3/echarts.min.js"></script>
    <script type="text/javascript"
            src="{{ asset('..\js\report\revenue\index.js?version=12', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{ asset('..\js\report\revenue\action.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
