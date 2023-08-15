@extends('layouts.layout')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}"/>
    <div class="page-wrapper">
        <div class="page-body">
            <div class=" card report-revenue card-inview-dashboard">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-center">
                        <div class="col-lg-12">
                            @include('report.detail_revenue_sell.filter')
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 pt-2 d-flex justify-content-center">
                    <div class="total-sell">
                        <strong class="seemt-fz-14" style="color: #000">DOANH THU BÁN HÀNG (Đã bao gồm VAT):
                            <span id="total-revenue-sell" class="seemt-fz-14 seemt-red"></span> VND
                        </strong>
                    </div>
                </div>
                <div class="revenue-content pb-0 row">
                    <div class="revenue-content-sub col-6">
                        <div class="revenue-month seemt-green seemt-border-bottom">
                            <div class="title-revenue-month-sub seemt-before-green">
                                <p class="d-flex align-items-center" id="title-card1">TĂNG DOANH THU BÁN HÀNG <i
                                            class="fi-rr-exclamation pl-2"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            data-original-title="@lang('app.branch-dashboard.revenue-cost-profit-report.increase_revenue')"></i>
                                </p>
                            </div>
                        </div>
                        <div class="content-revenue-month-sub">
                            <div class="row m-0 content-revenue-month-group">
                                <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                                    <div id="rate-increase-detail-revenue-sell-report"
                                         class="count-loading-chart h-100 w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="revenue-content-sub col-6">
                        <div class="revenue-month seemt-green seemt-border-bottom">
                            <div class="title-revenue-month-sub seemt-before-green">
                                <p class="d-flex align-items-center">GIẢM DOANH THU BÁN HÀNG <i
                                            class="fi-rr-exclamation pl-2"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            data-original-title="@lang('app.branch-dashboard.revenue-cost-profit-report.decrease_revenue')"></i>
                                </p>
                            </div>
                        </div>
                        <div class="content-revenue-month-sub">
                            <div class="row m-0 content-revenue-month-group">
                                <div
                                        class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                                    <div id="rate-decrease-detail-revenue-sell-report"
                                         class="count-loading-chart h-100 w-100">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('layouts.datatable')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.3/echarts.min.js"></script>
    <script type="text/javascript" src="{{ asset('js\template_custom\dataTable.js?version=1')}}"></script>
    <script type="text/javascript" src="{{ asset('..\js\report\sell\detail_revenue\index.js?version=2')}}"></script>
@endpush
