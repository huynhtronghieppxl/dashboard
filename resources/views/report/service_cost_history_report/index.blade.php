@extends('layouts.layout')
@section('content')
    <style>
        #table-service-cost-history-minus .class-link:hover {
            font-weight: 500;
        }

        .seemt-main-content .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: 14px !important;
        }

        #total-amount-service-cost-history-add, #total-amount-service-cost-history-minus {
            font-size: 14px;
        }

        .revenue {
            /*min-width: 270px;*/
            margin: 0;
        }

        .card-report-item-content-group-content {
            width: -webkit-fill-available;
        }

        .popup-service-cost-history-report {
            display: flex;
            justify-content: space-between;
            padding: 10px 12px;
        }

        .icon-card {
            font-size: 14px !important;
            margin-right: 5px;
        }

        .card-report-item {
            background: #fff;
        }

        .card-report-item-title span {
            font-weight: 500;
        }

    </style>
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body" id="div-service-cost-history">
                <div class="row font-15 text-center align-items-center"
                     id="box-service-cost-balance-total" style="margin-bottom: 7px">
                    <div class="col-4 revenue seemt-report-item">
                        <div class="paid-revenue d-flex justify-content-between">
                            <div class="logo-revenue seemt-bg-orange mt-1">
                                <i class="fi-rr-sort-amount-up-alt seemt-orange"></i>
                            </div>
                            <div class="content-revenue seemt-orange d-flex flex-wrap">
                                <div class="text-revenue col-12 p-0 text-right">
                                    <label class="m-0">Tổng số đơn hàng</label>
                                </div>
                                <div class="total-revenue col-12 pr-0 text-right">
                                    <label class="m-0 float-right font-weight-bold" id="total-order">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 revenue seemt-report-item">
                        <div class="paid-revenue d-flex justify-content-between">
                            <div class="logo-revenue seemt-bg-orange mt-1">
                                <i class="fi-rr-sack-dollar seemt-orange"></i>
                            </div>
                            <div class="content-revenue seemt-orange d-flex flex-wrap">
                                <div class="text-revenue col-12 p-0 text-right">
                                    <label class="m-0">Tổng chi phí</label>
                                </div>
                                {{--                                    <div class="col-1 p-0 text-center">--}}
                                {{--                                        <i class="fi-rr-exclamation"></i>--}}
                                {{--                                    </div>--}}
                                <div class="total-revenue col-12 pr-0 text-right">
                                    <label class="m-0 float-right font-weight-bold" id="total-service-cost">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 revenue seemt-report-item">
                        <div class="paid-revenue d-flex justify-content-between">
                            <div class="logo-revenue seemt-bg-blue mt-1">
                                <i class="fi-rr-chart-pie-alt seemt-blue"></i>
                            </div>
                            <div class="content-revenue seemt-blue d-flex flex-wrap">
                                <div class="text-revenue col-12 p-0 text-right">
                                    <label class="m-0">Còn lại</label>
                                </div>
                                {{--                                    <div class="col-1 p-0 text-center">--}}
                                {{--                                        <i class="fi-rr-exclamation"></i>--}}
                                {{--                                    </div>--}}
                                <div class="total-revenue col-12 pr-0 text-right">
                                    <label class="m-0 float-right font-weight-bold"
                                           id="total-after-service-cost-history">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs md-tabs" role="tablist" id="service-cost-history-nav">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" data-tab="1" href="#tab1-service-cost-history"
                           role="tab" aria-expanded="true" onclick="changeTabServiceCostHistory(1)">
                            @lang('app.service-cost.history-add')
                            <span class="label label-success" id="total-record-service-cost-history-add">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" data-tab="2" href="#tab2-service-cost-history" role="tab"
                           aria-expanded="false" onclick="changeTabServiceCostHistory(2)">
                            @lang('app.service-cost.history-minus') <span class="label label-inverse"
                                                                          id="total-record-service-cost-history-minus">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item"></li>
                </ul>
                <div class="card card-block">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1-service-cost-history" role="tabpanel">
                            <div class="col-lg-12">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        @include('setting.service_cost_history.filter')
                                    </div>
                                    <table id="table-service-cost-history-add" class="table">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">@lang('app.service-cost.stt')</th>
                                            <th class="text-right">@lang('app.service-cost.total-amount')</th>
                                            <th rowspan="2">@lang('app.service-cost.payment-date')</th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label class="seemt-fz-14" id="total-amount-service-cost-history-add"></label>
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-service-cost-history" role="tabpanel">
                            <div class="col-lg-12">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select
                                                    class="js-example-basic-single select-brand select-brand-service-cost-history">
                                                    <option selected value="-1">Toàn Thương Hiệu</option>
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->where('is_office', 0)->all() as $db)
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-validate-select select-branch-service-cost-history d-none"
                                             style="transform: translateX(-6px) !important;">
                                            <div class="pr-0 select-material-box">
                                                <select
                                                    class="js-example-basic-single select-branch">
                                                </select>
                                            </div>
                                        </div>
                                        @include('setting.service_cost_history.filter')
                                    </div>
                                    <table id="table-service-cost-history-minus" class="table">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">@lang('app.service-cost.stt')</th>
                                            <th class="text-left" rowspan="2">@lang('app.service-cost.brand')</th>
                                            <th class="text-left" rowspan="2">@lang('app.service-cost.branch')</th>
                                            <th class="text-left" rowspan="2">@lang('app.service-cost.code')</th>
                                            <th class="text-right">@lang('app.service-cost.total-amount')</th>
                                            <th rowspan="2">@lang('app.service-cost.time')</th>
                                            <th rowspan="2" class="text-right">Level/ Quy mô</th>
                                        </tr>
                                        <tr>
                                            <th class="text-right seemt-fz-14">
                                                <label id="total-amount-service-cost-history-minus"></label>
                                            </th>
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
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/report/service_cost_history_report/index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
