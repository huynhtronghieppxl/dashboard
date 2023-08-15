@extends('layouts.layout')
@section('content')
    <div class="page-body">
        <ul class="nav nav-tabs md-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link " data-type="0" data-toggle="tab" id="tab-card-value-customer-1" href="#cards-tab1"
                   role="tab" aria-expanded="true">
                    @lang('app.card-value-customer.tab1') <span class="label label-success"
                                                                id="total-record-enable">0</span>
                </a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" data-type="1" id="tab-card-value-customer-2" href="#cards-tab2"
                   role="tab"
                   aria-expanded="false">
                    @lang('app.card-value-customer.tab2') <span class="label label-inverse"
                                                                id="total-record-disable">0</span>
                </a>
                <div class="slide"></div>
            </li>
            <li class="nav-item"></li>
        </ul>
        <div class="card card-block">
            <div class="tab-content m-t-5px">
                <div class="tab-pane active" id="cards-tab1" role="tabpanel">
                    <div class="table-responsive new-table">
                        <table id="table-enable-card-value-customer" class="table ">
                            <thead>
                            <tr>
                                <th>@lang('app.card-value-customer.stt')</th>
                                <th>@lang('app.card-value-customer.name')</th>
                                <th>@lang('app.card-value-customer.amount')</th>
                                <th>@lang('app.card-value-customer.bonus')</th>
                                <th>@lang('app.card-value-customer.action')</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="cards-tab2" role="tabpanel">
                    <div class="table-responsive new-table">
                        <table id="table-disable-card-value-customer" class="table ">
                            <thead>
                            <tr>
                                <th>@lang('app.card-value-customer.stt')</th>
                                <th>@lang('app.card-value-customer.name')</th>
                                <th>@lang('app.card-value-customer.amount')</th>
                                <th>@lang('app.card-value-customer.bonus')</th>
                                <th>@lang('app.card-value-customer.action')</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('customer.card_value.create')
    @include('customer.card_value.update')
@endsection @push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/card_value/index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
