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

    </style>
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body" id="div-service-cost-history">
                <div class="row font-15 text-center justify-content-center align-items-center"
                     id="box-service-cost-balance-total" style="margin-bottom: 7px">
                    <div class="seemt-fz-16 col-lg-3 card p-3">
                        <div class="font-weight-bold">@lang('app.service-cost.total-add')
                            <i class="fi-rr-exclamation text-inverse pointer d-inline" data-toggle="tooltip"
                               data-placement="top" data-original-title="Tổng tiền nạp"
                               style="vertical-align: text-top; !important;"> </i></div>
                        <div id="total-add-service-cost-history">0</div>
                    </div>
                    <div class="col-lg-1 font-weight-bold" style="margin-top: -34px !important;">
                        <br/>
                        <i class="fa fa-minus"></i>
                    </div>
                    <div class="seemt-fz-16 col-lg-3 card p-3">
                        <div class="font-weight-bold">@lang('app.service-cost.total-minus') <i
                                    class="fi-rr-exclamation text-inverse pointer d-inline" data-toggle="tooltip"
                                    data-placement="top" data-original-title="Tổng tiền sử dụng"
                                    style="vertical-align: text-top; !important;"> </i></div>
                        <div id="total-minus-service-cost-history">0</div>
                    </div>
                    <div class="col-lg-1 font-weight-bold seemt-fz-16" style="margin-top: -34px !important;">
                        <br/>
                        <i class="fa fa-pause fa-rotate-90"></i>
                    </div>
                    <div class="seemt-fz-16 col-lg-3 card p-3">
                        <div class="font-weight-bold">@lang('app.service-cost.total-after')</div>
                        <div id="total-after-service-cost-history">0</div>
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
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-brand select-brand-service-cost-history">
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                        @if($db['is_office'] === 0)
                                                            @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                                <option value="{{$db['id']}}"
                                                                        selected>{{$db['name']}}</option>
                                                            @else
                                                                <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-validate-select"
                                             style="transform: translateX(-6px) !important;">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-branch select-branch-service-cost-history">
                                                </select>
                                            </div>
                                        </div>
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
                                                <label id="total-amount-service-cost-history-add"></label>
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
                                                <select class="js-example-basic-single select-brand select-brand-service-cost-history">
                                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                        @if($db['is_office'] === 0)
                                                            @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                                <option value="{{$db['id']}}"
                                                                        selected>{{$db['name']}}</option>
                                                            @else
                                                                <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-validate-select"
                                             style="transform: translateX(-6px) !important;">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-branch select-branch-service-cost-history">
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
                                        </tr>
                                        <tr>
                                            <th class="text-right">
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
            src="{{ asset('js\setting\service_cost_history\index.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
