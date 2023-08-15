@extends('layouts.layout')
@section('content')
    <style>
        .vertical-chart,
        #table-card1 {
            height: calc(100vh - 190px) !important;
        }

        #chart-vertical-off-menu-report {
            background: #ffffff;
        }

        .seemt-main {
            overflow: hidden !important;
        }
        .seemt-container .off-menu-dishes-sell-report .select2-container {
            min-height: 22px !important;
        }
    </style>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
              integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link rel="stylesheet" type="text/css" href="{{asset('files\assets\pages\timeline\style.css?version=')}}">
    </head>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card off-menu-dishes-sell-report" id="content-detail">
                <div class="row">
                    <div class="col-lg-10">
                        @include('report.filter')
                    </div>
                    <div class="col-lg-2 pl-0">
                        <div style="margin-left: 10px">
                            <div class="select-filter-type-date">
                                <div class="select-material-box">
                                    <select id="select-sort-off-menu-sell-report"
                                            class="form-control js-example-basic-single select2-hidden-accessible">
                                        <option
                                            value="1">Giá bán
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
                <div class="row scroll-containers mt-2">
                    <div class="col-lg-12">
                        <div class="text-center row col-lg-12 selections">
                            <div class="col-sm-12 text-right">
                                <div class="row justify-content-end mt-4 d-none" id="detail-value-off-menu-report-box">
                                    <div class="form-validate-checkbox d-flex flex-row-reverse p-0 mr-0">
                                        <div class="checkbox-form-group">
                                            <input type="checkbox" value="" id="detail-value-off-menu-report"
                                                   required="">
                                            <label class="name-checkbox" style="line-height: 21px"
                                                   for="detail-value-off-menu-report"> Xem Chi tiết </label>
                                        </div>
                                    </div>
                                </div>
                                {{--                                <div class="col-lg-12 text-inverse font-weight-bold d-flex align-items-center justify-content-center mt-4 pt-3" style="font-size: 20px;background-color: rgb(245, 246, 250);" id="total-card-all-sell-report">--}}
                                {{--                                    <strong style="color: #fa6342;margin: 0 1px 0 6px" id="total">0</strong>--}}
                                {{--                                    <strong style="font-size: 15px">VNĐ</strong>--}}
                                {{--                                </div>--}}
                                <div class="mt-0 vertical-chart count-loading-chart" style="">
                                    <div id="chart-vertical-off-menu-report-empty"
                                         class="empty-datatable-custom center-loading d-none"><img style="width: 200px"
                                                                                                   src="{{asset('/images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}">
                                    </div>
                                    <div id="chart-vertical-off-menu-report"
                                         class="vertical-chart style-large-chart-dashboard mt-0"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body selections">
                            <div class="table-responsive new-table table-container-loading" id="table-card1">
                                <table id="table-sell-off-menu-report" class="table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2"
                                            class="text-center">@lang('app.sell-report.card6.stt-table')</th>
                                        <th rowspan="2" class="text-left">@lang('app.sell-report.card6.name-table')</th>
                                        <th class="text-right">@lang('app.sell-report.card6.quantity-table')</th>
                                        <th class="text-right">@lang('app.sell-report.card6.total-original-table')<br>(1)
                                        </th>
                                        <th class="text-right">@lang('app.sell-report.card6.total-money-table')<br>(2)
                                        </th>
                                        <th class="text-right">@lang('app.sell-report.card6.profit-table')<br>(3)</th>
                                        <th rowspan="2" class="text-right">
                                            @lang('app.sell-report.card6.profit-rate-table')<br>
                                            (4 = 3/2*100)
                                        </th>
                                        <th rowspan="2" class="text-center"></th>
                                        <th class="d-none" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th class="seemt-fz-16" id="total-quantity-card6">0</th>
                                        <th class="seemt-fz-16" id="total-original-card6">0</th>
                                        <th class="seemt-fz-16" id="total-money-card6">0</th>
                                        <th class="seemt-fz-16" id="total-profit-card6">0</th>
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
    @include('report.sell.off_menu_dishes.detail')
    @include('report.sell.off_menu_dishes.excel')
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.3/echarts.min.js"></script>
    <script type="text/javascript"
            src="{{ asset('..\js\report\sell\off_menu_dishes\index.js?version=6', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
