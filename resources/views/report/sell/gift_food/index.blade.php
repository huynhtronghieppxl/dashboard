@extends('layouts.layout')
@section('content')
    <style>
        .vertical-chart, #table-card1 {
            height: calc(100vh - 190px) !important;
        }

        #chart-vertical-gift-food-report {
            height: 100% !important;
            background: #ffffff !important;
        }

        .seemt-main {
            overflow: hidden !important;
        }

        .seemt-main-content .new-table .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: -16px !important;
        }

        .count-loading-chart {
            position: relative;
        }

        #detail-value-gift-food-report-box {
            position: absolute;
            right: 0;
            z-index: 1;
        }
        .seemt-container .gift-food-sell-report .select2-container {
            min-height: 22px !important;
        }
    </style>
    <head>
        <link rel="stylesheet" type="text/css" href="{{asset('files\assets\pages\timeline\style.css?version=')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
              integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
    </head>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card gift-food-sell-report" id="content-detail">
                <div class="row">
                    <div class="col-lg-10">
                        @include('report.filter')
                    </div>
                    <div class="col-lg-2 pl-0">
                        <div style="margin-left: 10px">
                            <div class="select-filter-type-date">
                                <div class="select-material-box">
                                    <select id="select-sort-gift-food-sell-report"
                                            class="form-control js-example-basic-single select2-hidden-accessible">
                                        <option
                                            value="0" selected>Giá vốn
                                        </option>
                                        <option
                                            value="2">Số lượng
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 scroll-containers">
                    <div class="col-lg-12">
                        <div class="text-center row col-lg-12 selections">
                            <div class="col-sm-12 text-right">
                                <div class="mt-0 vertical-chart count-loading-chart">
                                    <div class="row justify-content-end mt-4 d-none"
                                         id="detail-value-gift-food-report-box">
                                        <div class="form-validate-checkbox d-flex flex-row-reverse p-0 mr-0">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" value="" id="detail-value-gift-food-report"
                                                       required="">
                                                <label class="name-checkbox" style="line-height: 21px"
                                                       for="detail-value-gift-food-report"> Xem Chi tiết </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="chart-vertical-gift-food-report-empty"
                                         class="empty-datatable-custom center-loading d-none"><img style="width: 200px"
                                                                                                   src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}">
                                    </div>
                                    <div id="chart-vertical-gift-food-report"
                                         class="vertical-chart style-large-chart-dashboard mt-0"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 selections">
                            <div class="card-body">
                                <div class="table-responsive new-table table-container-loading" id="table-card1">
                                    <div class="table-responsive new-table table-container-loading" id="table-card4">
                                        <table id="table-sell-card4-report" class="table">
                                            <thead>
                                            <tr>
                                                <th rowspan="2"
                                                    class="text-center">@lang('app.sell-report.card4.stt-table')</th>
                                                <th rowspan="2"
                                                    class="text-left">@lang('app.sell-report.card4.employee-table')</th>
                                                <th rowspan="2"
                                                    class="text-left">@lang('app.sell-report.card4.food-table')</th>
                                                <th class="text-right">@lang('app.sell-report.card4.quantity-table')</th>
                                                <th rowspan="2"
                                                    class="text-right">@lang('app.sell-report.card4.price-table')</th>
                                                <th class="text-right">@lang('app.sell-report.card4.total-amount-table')</th>
                                                <th rowspan="2"
                                                    class="text-center">@lang('app.sell-report.card4.date-table')</th>
                                                <th rowspan="2"
                                                    class="text-left">@lang('app.sell-report.card4.name-table')</th>
                                                <th rowspan="2"
                                                    class="text-right">@lang('app.sell-report.card4.customer-table')</th>
                                                <th rowspan="2" class="text-center"></th>
                                                <th class="d-none" rowspan="2"></th>
                                            </tr>
                                            <tr>
                                                <th class="seemt-fz-16" id="total-quantity">0</th>
                                                <th class="seemt-fz-16" id="total-total">0</th>
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
    </div>
    {{--    @include('report.sell.detail_gift_food')--}}
    @include('manage.bill.detail')
    @include('report.sell.gift_food.excel')
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.3/echarts.min.js"></script>
    <script type="text/javascript" src="{{ asset('..\js\report\sell\gift_food\index.js?version=8')}}"></script>
@endpush
