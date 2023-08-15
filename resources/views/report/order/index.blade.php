@extends('layouts.layout')
@section('content')
    <style>
        .seemt-main {
            overflow: hidden !important;
        }

        #chart-sell-report-vertical {
            height: calc(100vh - 190px) !important;
        }

        #chart-sell-report-vertical {
            position: relative;
        }

        #detail-order-time {
            position: absolute;
            right: 0;
            z-index: 1;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card" style="height:calc(100vh - 90px);">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-center">
                        <div class="col-lg-12" id="filter-sell-food-report">
                            @include('report.filter')
                        </div>
                    </div>
                </div>
                <div class="row scroll-containers" style="scroll-behavior: unset">
                    <div class="col-lg-12 edit-flex-auto-fill flex-wrap">
                        <div class="card-block statustic-card w-100">
                            <div class="p-t-0">
                                <div id="chart-sell-report-vertical"
                                     class="mt-0 vertical-chart count-loading-chart">
                                    <div class="col-lg-12 d-flex align-items-center justify-content-end mt-2"
                                         id="detail-order-time">
                                        <div class="form-validate-checkbox d-flex flex-row-reverse p-0">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" value="" id="detail-value-order-report"
                                                       required=""/>
                                                <label class="name-checkbox" for="detail-value-order-report"> Xem
                                                    Chi tiết </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="chart-sell-report-vertical-center"
                                         class="empty-datatable-custom center-loading d-none"><img
                                                style="width: 200px;"
                                                src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}"/>
                                    </div>
                                    <div id="chart-vertical-order-report" class="mt-0 vertical-chart"
                                         style="height: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body w-100" style="">
                                <div class="table-responsive new-table table-container-loading" id="table-card2">
                                    <table id="table-sell-order-report-by-time" class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.sell-report.card2.stt-table')</th>
                                            <th>Nội dung</th>
                                            <th>Đơn hàng</th>
                                            <th>Doanh thu bán hàng (Chưa VAT)</th>
                                            <th>Tiền VAT thu của khách</th>
                                            <th>Doanh thu bán hàng (Có VAT)</th>
                                            <th class="d-none"></th>
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
    @include('report.order.excel')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/report/order/index.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{asset('js/report/sell/filter.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
