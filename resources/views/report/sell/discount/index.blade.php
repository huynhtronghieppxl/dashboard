@extends('layouts.layout') @section('content')
    <style>
        #chart-sell-report-vertical,
        #table-card5 {
            height: calc(100vh - 190px) !important;
        }

        #chart-sell-report-vertical-main {
            height: 100% !important;
        }

        .seemt-main {
            overflow: hidden !important;
        }

        /*.count-loading-chart {*/
        /*    position: relative;*/
        /*}*/

        /*#detail-value-discount-report-box {*/
        /*    position: absolute;*/
        /*    right: 0;*/
        /*    z-index: 99;*/
        /*}*/
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('files\assets\pages\timeline\style.css?version=')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card" id="content-detail">
                @include('report.filter')
                <div class="row scroll-containers">
                    <div class="col-lg-12">
                        <div class="col-lg-12 selections">
                            <div class="card-block row pt-0">
                                <div class="col-lg-12 mt-4">
                                    <div class="row justify-content-end" id="detail-value-discount-report-box">
                                        <div class="form-validate-checkbox d-flex flex-row-reverse p-0 mr-0">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" value="" id="detail-value-discount-report"
                                                       required=""/>
                                                <label class="name-checkbox" style="line-height: 21px;"
                                                       for="detail-value-discount-report"> Xem Chi tiết </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="chart-sell-report-vertical" class="mt-0 vertical-chart count-loading-chart"
                                         style="height: 400px;">
                                        <div id="chart-sell-report-vertical-center"
                                             class="empty-datatable-custom center-loading d-none"><img
                                                    style="width: 200px;"
                                                    src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}"/>
                                        </div>
                                        <div id="chart-sell-report-vertical-main" style="height: 100%; width: 98%;"
                                             class="mt-0 vertical-chart count-loading-chart center-loading"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 selections">
                            <div class="card-body">
                                <div class="table-responsive new-table" id="table-card5">
                                    <table id="table-sell-card5-report" class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.sell-report.detail-discount.stt')</th>
                                            <th>@lang('app.sell-report.detail-discount.code')</th>
                                            <th>@lang('app.sell-report.detail-discount.table')</th>
                                            <th>Số khách</th>
                                            <th>@lang('app.sell-report.detail-discount.employee')</th>
                                            <th>Tổng bill</th>
                                            <th>@lang('app.sell-report.detail-discount.discount')</th>
                                            <th>Tiền giảm</th>
                                            <th>Thanh toán</th>
                                            <th>Ngày</th>
                                            <th>Ghi chú</th>
                                            <th></th>
                                            <th></th>
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
    @include('manage.bill.detail')
    @include('report.sell.detail_discount')
    @include('report.sell.discount.excel')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\report\sell\discount\index.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
