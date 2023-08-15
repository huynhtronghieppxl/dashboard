@extends('layouts.layout')
@section('content')
    <style>
        #chart-sell-cost-report-rounded,
        #table-card2 {
            height: calc(100vh - 200px) !important;
        }

        #chart-cost-report-main {
            height: 100% !important;
        }

        .seemt-main {
            overflow: hidden !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}"/>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-center">
                        <div class="col-lg-12" id="filter-sell-food-report">
                            @include('report.filter_2')
                        </div>
                    </div>
                </div>
                <div class="row mt-2 scroll-containers">
                    <div class="col-lg-12">
                        <div class="col-xl-12 col-sm-12 selections">
                            <div class="card-block p-t-25">
                                <div id="chart-sell-cost-report-rounded">
                                    <div id="chart-cost-report-center" class="center-loading d-none">
                                        <img style="width: 200px"
                                             src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}">
                                    </div>
                                    <div id="chart-cost-report-main" class="h-100 w-100 count-loading-chart"
                                         style="width: 100%; height: 100% !important;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 selections">
                            <div class="table-responsive new-table" id="table-card2">
                                <table id="table-cost-report" class="table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.cost-report.stt')</th>
                                        <th rowspan="2">@lang('app.cost-report.name')</th>
                                        <th>@lang('app.cost-report.amount')</th>
                                        <th rowspan="2"></th>
                                        <th rowspan="2" class="d-none"></th>
                                    </tr>
                                    <tr>
                                        <th class="seemt-fz-14" id="total-amount-cost-report">0</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal detail --}}
        @include('report.cost.excel')
        @include('report.cost.detail')
        @endsection
        @push('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.3/echarts.min.js"></script>
            <script type="text/javascript"
                    src="{{ asset('js\report\cost\index.js?version=7', env('IS_DEPLOY_ON_SERVER')) }}"></script>
    @endpush
{{--        <script type="text/javascript" src="{{ asset('js\report\cost\action.js?version=1', env('IS_DEPLOY_ON_SERVER')) }}"></script>--}}
