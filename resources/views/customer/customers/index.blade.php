@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs " role="tablist" id="nav-tab-customer-aloline">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="tab-customer-1" href="#customer-1"
                       data-id="1"
                       role="tab" onclick="changeActiveTabCustomer(1)"
                       aria-expanded="true">@lang('app.customers.tab1') <span class="label label-success"
                                                                              id="total-customer">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="tab-customer-2" href="#customer-2" role="tab"
                       onclick="changeActiveTabCustomer(2)"
                       data-id="2"
                       aria-expanded="false">@lang('app.customers.tab2') <span class="label label-info"
                                                                               id="total-customer-use-points">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content mt-3 mb-0">
                    <div class="tab-pane active" id="customer-1" role="tabpanel">
                        <div class="table-responsive new-table">
                            <table id="table-customers" class="table">
                                <thead>
                                <tr>
                                    <th rowspan="2" class="text-center">@lang('app.customers.stt')</th>
                                    <th rowspan="2" class="">@lang('app.customers.name')</th>
                                    <th rowspan="2">@lang('app.customers.phone')</th>
                                    <th class="text-right">@lang('app.customers.point')</th>
                                    <th class="text-right">@lang('app.customers.accumulate-point')</th>
                                    <th class="text-right">@lang('app.customers.promotion-point')</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="point-customer">0</th>
                                    <th id="accumulate-point-customer">0</th>
                                    <th id="promotion-point-customer">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="customer-2" role="tabpanel">
                        <div class="table-responsive new-table">
                            <table id="table-customers-use-points" class="table">
                                <thead>
                                <tr>
                                    <th rowspan="2" class="text-center">@lang('app.customers.stt')</th>
                                    <th rowspan="2" class="">@lang('app.customers.name')</th>
                                    <th rowspan="2">@lang('app.customers.phone')</th>
                                    <th class="text-right">@lang('app.customers.point')</th>
                                    <th class="text-right">@lang('app.customers.accumulate-point')</th>
                                    <th class="text-right">@lang('app.customers.promotion-point')</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="point-customer-use-point">0</th>
                                    <th id="accumulate-point-customer-use-point">0</th>
                                    <th id="promotion-point-customer-use-point">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('customer.customers.assign_customer')
    @include('customer.customers.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/customers/index.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
