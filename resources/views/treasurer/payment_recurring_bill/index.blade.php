@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tab-payment-recurring-bill">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab"
                       data-id="1"
                       href="#tab1-payment-recurring-bill" role="tab"
                       aria-expanded="true">@lang('app.payment-recurring-bill.tab1') <span
                                class="label label-success"
                                id="total-record-tab1-payment-recurring-bill">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       data-id="2"
                       href="#tab2-payment-recurring-bill" role="tab"
                       aria-expanded="false">@lang('app.payment-recurring-bill.tab2') <span
                                class="label label-inverse"
                                id="total-record-tab2-payment-recurring-bill">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content m-t-5px">
                    <div class="tab-pane active" id="tab1-payment-recurring-bill" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand"
                                                id="select-brand-payment-bill-treasurer">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                    <option value="{{$db['id']}}"
                                                            selected>{{$db['name']}}</option>
                                                @else
                                                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-branch"
                                                id="select-branch-payment-bill-treasurer">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                    <option value="{{$db['id']}}"
                                                            selected>{{$db['name']}}</option>
                                                @else
                                                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="table-payment-recurring-bill1" class="table ">
                                <thead>
                                <tr>
                                    <th rowspan="2" class="text-center">@lang('app.payment-recurring-bill.stt')</th>
                                    <th class="text-left" rowspan="2"
                                        class="text-center">@lang('app.payment-recurring-bill.object')</th>
                                    <th class="text-left" rowspan="2"
                                        class="text-center">@lang('app.payment-recurring-bill.name')</th>
                                    <th class="text-right">@lang('app.payment-recurring-bill.amount')</th>
                                    <th class="text-left" rowspan="2"
                                        class="text-center">@lang('app.payment-recurring-bill.type')</th>
                                    <th class="text-left" rowspan="2"
                                        class="text-center">@lang('app.payment-recurring-bill.note')</th>
                                    <th rowspan="2" class="text-center">@lang('app.payment-recurring-bill.action')</th>
                                    <th class="text-right d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-amount-tab1-payment-recurring-bill" class="text-right seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-payment-recurring-bill" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand"
                                                    id="select-brand-payment-bill-treasurer">
                                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-branch"
                                                    id="select-branch-payment-bill-treasurer">
                                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                                                    @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-payment-recurring-bill2" class="table ">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">@lang('app.payment-recurring-bill.stt')</th>
                                        <th class="text-left" rowspan="2"
                                            class="text-center">@lang('app.payment-recurring-bill.object')</th>
                                        <th class="text-left" rowspan="2"
                                            class="text-center">@lang('app.payment-recurring-bill.name')</th>
                                        <th class="text-right">@lang('app.payment-recurring-bill.amount')</th>
                                        <th class="text-left" rowspan="2"
                                            class="text-center">@lang('app.payment-recurring-bill.type')</th>
                                        <th class="text-left" rowspan="2"
                                            class="text-center">@lang('app.payment-recurring-bill.note')</th>
                                        <th rowspan="2"
                                            class="text-center">@lang('app.payment-recurring-bill.action')</th>
                                        <th class="text-right d-none" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th id="total-amount-tab2-payment-recurring-bill"
                                            class="text-right seemt-fz-14">0
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
    {{--Modal create--}}
    @include('treasurer.payment_recurring_bill.create')
    {{--Modal update--}}
    @include('treasurer.payment_recurring_bill.update')
    {{--Modal detal--}}
    @include('treasurer.payment_recurring_bill.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\treasurer\payment_recurring_bill\index.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
