@extends('layouts.layout')
@section('content')
    <style>
        #chart-employee-report-vertical,
        #table2 {
            height: calc(100vh - 190px) !important;
        }

        .seemt-main {
            overflow: hidden !important;
        }

        #chart-employee-report-vertical {
            position: relative;
        }

        #detail-employee-report {
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
                <div class="row scroll-containers">
                    <div class="col-lg-12">
                        <div class="selections">
                            <div class="row">
                                <div class="col-lg-12 d-flex align-items-center">
                                    <div class="col-lg-12" id="filter-sell-food-report">
                                        @include('report.filter')
                                    </div>
                                </div>
                            </div>
                            <div id="chart-employee-report-vertical" class="mt-0 vertical-chart count-loading-chart">
                                <div class="col-lg-12 d-flex align-items-center justify-content-end mt-2"
                                     id="detail-employee-report">
                                    <div class="form-validate-checkbox d-flex flex-row-reverse p-0">
                                        <div class="checkbox-form-group">
                                            <input type="checkbox" value="" id="detail-value-order-report" required=""/>
                                            <label class="name-checkbox" for="detail-value-order-report"> Xem Chi
                                                tiết </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="chart-employee-report-vertical-empty" class="center-loading d-none">
                                    <img style="width: 200px"
                                         src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}">
                                </div>
                                <div id="chart-employee-report-vertical-main"
                                     class="h-100 mt-0 vertical-chart count-loading-chart center-loading"
                                     style="height: 100%;">
                                </div>
                            </div>
                            {{--                            <div id="chart-employee-report-horizontal" class="d-none count-loading-chart" style="height:400px"></div>--}}
                        </div>
                        <div class="card-body selections">
                            <div class="table-responsive new-table" id="table2">
                                <table id="table-employee-report" class="table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.employee-report.stt-table')</th>
                                        <th rowspan="2">@lang('app.employee-report.name-table')</th>
                                        <th>@lang('app.employee-report.order-table')</th>
                                        <th>@lang('app.employee-report.revenue-table')</th>
                                        <th rowspan="2"></th>
                                        <th rowspan="2" class="d-none"></th>
                                    </tr>
                                    <tr>
                                        <th id="total-order-employee-report">0</th>
                                        <th id="total-revenue-employee-report">0</th>
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
    @include('report.employee.detail')
    @include('report.employee.excel')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/report/employee/index.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
