@extends('layouts.layout')
@section('content')
    <style>
        #chart-area-report-vertical,
        #table2 {
            height: calc(100vh - 190px) !important;
        }

        #chart-sell-report-vertical-center {
            height: 100% !important;
        }

        .seemt-main {
            overflow: hidden !important;
        }

        #chart-area-report-vertical {
            position: relative;
        }

        #detail-value-area-report-box {
            position: absolute;
            right: 0;
            z-index: 1;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-center">
                        <div class="col-lg-12" id="filter-sell-food-report">
                            @include('report.filter')
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center scroll-containers mt-2">
                    <div class="col-lg-12">
                        <div class="card-block selections pt-0" id="div-chart-area-report-vertical">
                            <div id="chart-area-report-vertical" class="mt-0 vertical-chart count-loading-chart"
                                 style="height:400px">
                                <div class="col-lg-12 mt-2 d-flex align-items-center justify-content-end d-none"
                                     id="detail-value-area-report-box">
                                    <div class="form-validate-checkbox d-flex flex-row-reverse p-0">
                                        <div class="checkbox-form-group">
                                            <input type="checkbox" value="" id="detail-chart-area-report-vertical"
                                                   required="">
                                            <label class="name-checkbox" for="detail-chart-area-report-vertical"> Xem
                                                Chi
                                                tiết </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="chart-sell-report-vertical-center"
                                     class="empty-datatable-custom center-loading d-none"><img style="width: 200px"
                                                                                               src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}">
                                </div>
                                <div id="chart-area-report-vertical-main" style="height: 100%; width: 98%"
                                     class="mt-4 vertical-chart count-loading-chart center-loading">
                                </div>
                            </div>
                        </div>
                        <div class="card-body selections" id="div-table-area-report-vertical">
                            <div class="table-responsive new-table" id="table2">
                                <table id="table-area-report" class="table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.area-report.stt-table')</th>
                                        <th rowspan="2">@lang('app.area-report.area-table')</th>
                                        <th class="text-right">@lang('app.area-report.order-table')</th>
                                        <th class="text-right">@lang('app.area-report.revenue-table')</th>
                                        <th rowspan="2"></th>
                                        <th rowspan="2" class="d-none"></th>
                                    </tr>
                                    <tr>
                                        <th class="seemt-fz-16" id="total-order-area-report">0</th>
                                        <th class="seemt-fz-16" id="total-revenue-area-report">0</th>
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
    @include('report.area.detail')
    @include('report.area.excel')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/report/area/index.js?version=13', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    {{--    <script type="text/javascript" src="{{assert('/js/report/sell/filter.js?version=1', env('IS_DEPLOY_ON_SERVER')}}"></script>--}}
@endpush
