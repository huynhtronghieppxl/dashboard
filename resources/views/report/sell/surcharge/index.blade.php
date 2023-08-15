@extends('layouts.layout')
@section('content')
    <style>
        .seemt-main {
            overflow: hidden !important;
        }

        #chart-sell-surcharge-report-vertical {
            height: calc(100vh - 200px);
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('files\assets\pages\timeline\style.css?version=')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card" id="content-detail">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-center">
                        <div class="col-lg-12">
                            @include('report.filter')
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex align-items-center justify-content-end mt-2"
                         id="detail-value-surcharge-report-box">
                        <div class="form-validate-checkbox d-flex flex-row-reverse p-0">
                            <div class="checkbox-form-group">
                                <input type="checkbox" value="" id="detail-value-surcharge-report" required="">
                                <label class="name-checkbox" for="detail-value-surcharge-report"> Xem Chi tiết </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row scroll-containers">
                    <div class="col-lg-12 ">
                        <div class="card-block selections row pt-0">
                            <div class="col-lg-12">
                                <div id="chart-sell-surcharge-report-vertical"
                                     class="mt-0 vertical-chart count-loading-chart"
                                     style="height:calc(100vh - 200px)">
                                    <div id="chart-sell-report-vertical-empty"
                                         class="empty-datatable-custom center-loading d-none"><img style="width: 200px"
                                                                                                   src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}">
                                    </div>
                                    <div id="chart-sell-surcharge-report-vertical-main" style="height: 100%; width: 98%"
                                         class="mt-0 vertical-chart count-loading-chart center-loading">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body selections">
                            <div class="table-responsive new-table" id="table-card5">
                                <table id="table-sell-surcharge-report" class="table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2"
                                            class="text-center">@lang('app.sell-report.card5.stt-table')</th>
                                        <th rowspan="2" class="text-center">@lang('app.sell-report.card9.name')</th>
                                        <th class="text-center">@lang('app.sell-report.card8.total-amount-table')</th>
                                        <th rowspan="2"></th>
                                        <th class="d-none" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center seemt-fz-14" id="total-value">0</th>
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
    @include('report.sell.surcharge.detail')
    @include('report.sell.surcharge.excel')
@endsection
@push('scripts')
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.3/echarts.min.js"></script>--}}
    <script type="text/javascript"
            src="{{ asset('..\js\report\sell\surcharge\index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
