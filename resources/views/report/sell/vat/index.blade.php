@extends('layouts.layout')
@section('content')
    <style>
        #chart-sell-vat-report-vertical,
        #table-vat {
            height: calc(100vh - 200px) !important;
        }

        .seemt-main {
            overflow: hidden !important;
        }

        .count-loading-chart {
            position: relative;
        }

        #detail-value-vat-report-box {
            position: absolute;
            right: 0;
            z-index: 1;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('files\assets\pages\timeline\style.css?version=')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card" id="content-detail" class="sell-vat-report">
                @include('report.filter')
                <div class="row justify-content-center scroll-containers">
                    <div class="col-lg-12">
                        <div class="card-block row pt-0 selections">
                            <div class="col-lg-12 mt-4">
                                <div id="chart-sell-vat-report-vertical" class="mt-0 vertical-chart count-loading-chart"
                                     style="height:400px">
                                    <div class="row justify-content-end" id="detail-value-vat-report-box">
                                        <div class="form-validate-checkbox d-flex flex-row-reverse p-0 mr-0">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" value="" id="detail-value-vat-report"
                                                       required="">
                                                <label class="name-checkbox" style="line-height: 21px"
                                                       for="detail-value-vat-report"> Xem Chi tiết </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="chart-sell-report-vertical-center"
                                         class="empty-datatable-custom center-loading d-none"><img style="width: 200px"
                                                                                                   src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}">
                                    </div>
                                    <div id="chart-sell-vat-report-vertical-main" style="height: 100%; width: 100%"
                                         class="mt-0 vertical-chart count-loading-chart center-loading">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body selections">
                            <div class="table-responsive new-table" id="table-vat">
                                <table id="table-sell-vat-report" class="table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2"
                                            class="text-center">@lang('app.sell-report.card5.stt-table')</th>
                                        <th rowspan="2"
                                            class="text-center">@lang('app.sell-report.card5.create-table')</th>
                                        <th>Số Tiền (VAT)</th>
                                        <th rowspan="2" class="text-center"></th>
                                        <th class="d-none" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th class="seemt-fz-16" id="total-value">0</th>
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
    @include('report.sell.vat.detail')
    @include('report.sell.vat.excel')
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.3/echarts.min.js"></script>
    <script type="text/javascript"
            src="{{ asset('../js/report/sell/vat/index.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
