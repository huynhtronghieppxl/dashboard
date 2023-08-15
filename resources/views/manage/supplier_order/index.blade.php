@extends('layouts.layout')
@section('content')
    <style>
        .text-blue {
            color: #1462B0;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs mb-7-tabs" role="tablist" id="nav-supplier-order-manage">
                @if(Session::get(SESSION_KEY_LEVEL) > 3)
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-request-supplier-order"
                           data-id="0"
                           onclick="changeActiveTabSupplierOrder(0)"
                           role="tab"
                           aria-expanded="true">@lang('app.supplier-order.tab0') <span
                                    class="label label-info" id="total-record-order">0</span></a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item" id="nav-create-supplier-order">
                        <a class="nav-link" data-toggle="tab" href="#tab-waiting-supplier-order"
                           data-id="1"
                           onclick="changeActiveTabSupplierOrder(1)"
                           role="tab"
                           aria-expanded="false">@lang('app.supplier-order.tab1') <span
                                    class="label label-warning" id="total-record-waiting">0</span></a>
                        <div class="slide"></div>
                    </li>
                @else
                    <li class="nav-item" id="nav-create-supplier-order">
                        <a class="nav-link active" data-toggle="tab" href="#tab-waiting-supplier-order"
                           data-id="1"
                           onclick="changeActiveTabSupplierOrder(1)"
                           role="tab"
                           aria-expanded="false">@lang('app.supplier-order.tab1') <span
                                    class="label label-warning" id="total-record-waiting">0</span></a>
                        <div class="slide"></div>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-order-supplier-order"
                       data-id="2"
                       onclick="changeActiveTabSupplierOrder(2)"
                       role="tab"
                       aria-expanded="false">@lang('app.supplier-order.tab2') <span
                                class="label label-primary" id="total-record-received">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-done-supplier-order"
                       data-id="3"
                       onclick="changeActiveTabSupplierOrder(3)"
                       role="tab"
                       aria-expanded="false">@lang('app.supplier-order.tab3') <span
                                class="label label-success" id="total-record-done">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-cancel-supplier-order"
                       data-id="4"
                       onclick="changeActiveTabSupplierOrder(4)"
                       role="tab" aria-expanded="false">@lang('app.supplier-order.tab4') <span
                                class="label label-danger" id="total-record-cancel">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item" id="nav-return-supplier-order">
                    <a class="nav-link" data-toggle="tab" href="#tab-return-supplier-order"
                       data-id="5"
                       onclick="changeActiveTabSupplierOrder(5)"
                       role="tab" aria-expanded="false">@lang('app.supplier-order.tab5') <span
                                class="label label-inverse" id="total-record-return">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item" id="nav-return-supplier-order">
                    <a class="nav-link" data-toggle="tab" href="#tab-history-request-supplier-order"
                       data-id="6"
                       onclick="changeActiveTabSupplierOrder(6)"
                       role="tab" aria-expanded="false">@lang('app.supplier-order.tab6')<span
                                class="label" style="background: linear-gradient(to right, #6f0303, #644)"
                                id="total-record-request-history">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    @if(Session::get(SESSION_KEY_LEVEL) > 3)
                        <div class="tab-pane active" id="tab-request-supplier-order" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('manage.supplier_order.filter')
                                <table class="table" id="table-request-supplier-order">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-order.stt')</th>
                                        <th>@lang('app.supplier-order.code')</th>
                                        <th>@lang('app.supplier-order.inventory')</th>
                                        <th>@lang('app.supplier-order.employee')</th>
                                        <th>@lang('app.supplier-order.quantity')</th>
                                        <th>@lang('app.supplier-order.created')</th>
                                        <th>@lang('app.supplier-order.action')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-waiting-supplier-order" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('manage.supplier_order.filter')
                                <table class="table" id="table-waiting-supplier-order">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.supplier-order.stt')</th>
                                        <th rowspan="2">@lang('app.supplier-order.code')</th>
                                        <th class="text-left" rowspan="2">@lang('app.supplier-order.supplier')</th>
                                        <th class="text-left" rowspan="2">@lang('app.supplier-order.employee')</th>
                                        <th rowspan="2">@lang('app.supplier-order.quantity')</th>
                                        <th class="text-right">@lang('app.supplier-order.amount')</th>
                                        <th rowspan="2">@lang('app.supplier-order.time')</th>
                                        <th rowspan="2">@lang('app.supplier-order.action')</th>
                                        <th class="d-none" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th id="total-amount-request-supplier-order" class="seemt-fz-14">0</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="tab-pane active" id="tab-waiting-supplier-order" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('manage.supplier_order.filter')
                                <table class="table" id="table-waiting-supplier-order">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.supplier-order.stt')</th>
                                        <th class="text-left" rowspan="2">@lang('app.supplier-order.supplier')</th>
                                        <th class="text-left" rowspan="2">@lang('app.supplier-order.employee')</th>
                                        <th rowspan="2">@lang('app.supplier-order.quantity')</th>
                                        <th class="text-right">@lang('app.supplier-order.amount')</th>
                                        <th rowspan="2">@lang('app.supplier-order.time')</th>
                                        <th rowspan="2">@lang('app.supplier-order.action')</th>
                                        <th class="d-none" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th id="amount-waiting" class="seemt-fz-14">0</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @endif
                    <div class="tab-pane" id="tab-order-supplier-order" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.supplier_order.filter')
                            <table class="table" id="table-order-supplier-order">
                                <thead>
                                <tr style="background-color: #fff !important;">
                                    <th rowspan="2">@lang('app.supplier-order.stt')</th>
                                    <th rowspan="2">@lang('app.supplier-order.code')</th>
                                    <th class="text-left" rowspan="2">Đơn vị cung cấp</th>
                                    <th class="text-left" rowspan="2">@lang('app.supplier-order.employee')</th>
                                    <th rowspan="2">@lang('app.supplier-order.quantity')</th>
                                    <th class="text-right">@lang('app.supplier-order.amount')
                                        <i class="fi-rr-exclamation pointer ml-1 d-inline" data-toggle="tooltip"
                                           data-placement="top"
                                           data-original-title="@lang('app.supplier-order.amount-des')"></i>
                                    </th>
                                    <th class="text-right">@lang('app.supplier-order.discount')</th>
                                    <th class="text-right">@lang('app.supplier-order.vat')</th>
                                    <th class="text-right">@lang('app.supplier-order.total-amount')
                                        <i class="fi-rr-exclamation pointer ml-1 d-inline" data-toggle="tooltip"
                                           data-placement="top"
                                           data-original-title="@lang('app.supplier-order.total-amount-des')"></i>
                                    </th>
                                    <th rowspan="2">@lang('app.supplier-order.delivery-expected')</th>
                                    <th rowspan="2">@lang('app.supplier-order.created')</th>
                                    <th rowspan="2">@lang('app.supplier-order.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="amount-received" class="seemt-fz-14">0</th>
                                    <th id="discount-received" class="seemt-fz-14">0</th>
                                    <th id="vat-received" class="seemt-fz-14">0</th>
                                    <th id="total-amount-received" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-done-supplier-order" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.supplier_order.filter')
                            <table class="table" id="table-done-supplier-order">
                                <thead>
                                <tr style="background-color: #fff !important;">
                                    <th rowspan="2">@lang('app.supplier-order.stt')</th>
                                    <th rowspan="2"
                                        style="text-align: left !important;">@lang('app.supplier-order.code')</th>
                                    <th rowspan="2" style="text-align: left !important;">Đơn vị cung cấp</th>
                                    <th rowspan="2"
                                        style="text-align: left !important;">@lang('app.supplier-order.employee-done')</th>
                                    <th rowspan="2">@lang('app.supplier-order.quantity')</th>
                                    <th class="text-right">@lang('app.supplier-order.amount')
                                        <i class="fi-rr-exclamation pointer ml-1 d-inline" data-toggle="tooltip"
                                           data-placement="top"
                                           data-original-title="@lang('app.supplier-order.amount-des')"></i>
                                    </th>
                                    <th class="text-right">@lang('app.supplier-order.return-amount')</th>
                                    <th class="text-right">@lang('app.supplier-order.total-amount')
                                        <i class="fi-rr-exclamation pointer ml-1 d-inline" data-toggle="tooltip"
                                           data-placement="top"
                                           data-original-title="@lang('app.supplier-order.total-amount-des')"></i>
                                    </th>
                                    <th class="text-right">@lang('app.supplier-order.discount')</th>
                                    <th class="text-right">@lang('app.supplier-order.vat')</th>
                                    <th class="text-right">@lang('app.supplier-order.payment-amount')
                                        <i class="fi-rr-exclamation pointer ml-1 d-inline" data-toggle="tooltip"
                                           data-placement="top"
                                           data-original-title="@lang('app.supplier-order.payment-amount-des')"></i>
                                    </th>
                                    <th rowspan="2">@lang('app.supplier-order.time')</th>
                                    <th rowspan="2">@lang('app.supplier-order.date')</th>
                                    <th rowspan="2">@lang('app.supplier-order.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="amount-done" class="seemt-fz-16" class="seemt-fz-14">0</th>
                                    <th id="total-return-done" class="seemt-fz-16" class="seemt-fz-14">0</th>
                                    <th id="total-amount-done" class="seemt-fz-16" class="seemt-fz-14">0</th>
                                    <th id="discount-done" class="seemt-fz-16" class="seemt-fz-14">0</th>
                                    <th id="vat-done" class="seemt-fz-16" class="seemt-fz-14">0</th>
                                    <th id="total-payment-done" class="seemt-fz-16" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-cancel-supplier-order" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.supplier_order.filter')
                            <table class="table" id="table-cancel-supplier-order">
                                <thead>
                                <tr style="background-color: #fff !important;">
                                    <th rowspan="2">@lang('app.supplier-order.stt')</th>
                                    <th rowspan="2">@lang('app.supplier-order.code')</th>
                                    <th class="text-left" rowspan="2">Đơn vị cung cấp</th>
                                    <th class="text-left" rowspan="2">@lang('app.supplier-order.employee-cancel')</th>
                                    <th rowspan="2">@lang('app.supplier-order.quantity')</th>
                                    <th class="text-right">@lang('app.supplier-order.amount')
                                        <i class="fi-rr-exclamation pointer ml-1 d-inline" data-toggle="tooltip"
                                           data-placement="top"
                                           data-original-title="@lang('app.supplier-order.amount-des')"></i>
                                    </th>
                                    <th class="text-right">@lang('app.supplier-order.discount')</th>
                                    <th class="text-right">@lang('app.supplier-order.vat')</th>
                                    <th class="text-right">@lang('app.supplier-order.total-amount')
                                        <i class="fi-rr-exclamation pointer ml-1 d-inline" data-toggle="tooltip"
                                           data-placement="top"
                                           data-original-title="@lang('app.supplier-order.total-amount-des')"></i>
                                    </th>
                                    <th rowspan="2">@lang('app.supplier-order.time')</th>
                                    <th rowspan="2">@lang('app.supplier-order.date-cancel')</th>
                                    <th rowspan="2">@lang('app.supplier-order.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="amount-cancel" class="seemt-fz-14">0</th>
                                    <th id="discount-cancel" class="seemt-fz-14">0</th>
                                    <th id="vat-cancel" class="seemt-fz-14">0</th>
                                    <th id="total-amount-cancel" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-return-supplier-order" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.supplier_order.filter')
                            <table class="table" id="table-return-supplier-order">
                                <thead>
                                <tr style="background-color: #fff !important;">
                                    <th rowspan="2">@lang('app.supplier-order.stt')</th>
                                    <th rowspan="2">@lang('app.supplier-order.code')</th>
                                    <th class="text-left" rowspan="2">Đơn vị cung cấp</th>
                                    <th class="text-left" rowspan="2">@lang('app.supplier-order.employee-return')</th>
                                    <th rowspan="2">@lang('app.supplier-order.quantity')</th>
                                    <th class="text-right">@lang('app.supplier-order.amount')
                                        <i class="fi-rr-exclamation pointer ml-1 d-inline" data-toggle="tooltip"
                                           data-placement="top"
                                           data-original-title="@lang('app.supplier-order.amount-des')"></i>
                                    </th>
                                    {{--                                    <th class="text-right">@lang('app.supplier-order.discount')</th>--}}
                                    {{--                                    <th class="text-right">@lang('app.supplier-order.vat')</th>--}}
                                    <th class="text-right">@lang('app.supplier-order.total-amount')
                                        <i class="fi-rr-exclamation pointer ml-1 d-inline" data-toggle="tooltip"
                                           data-placement="top"
                                           data-original-title="@lang('app.supplier-order.total-amount-des')"></i>
                                    </th>
                                    <th rowspan="2">@lang('app.supplier-order.date-return')</th>
                                    <th rowspan="2">@lang('app.supplier-order.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="amount-return" class="seemt-fz-14">0</th>
                                    {{--                                    <th id="discount-return">0</th>--}}
                                    {{--                                    <th id="vat-return">0</th>--}}
                                    <th id="total-amount-return" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-history-request-supplier-order" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.supplier_order.filter')
                            <table class="table" id="table-history-request-supplier-order">
                                <thead>
                                <tr>
                                    <th>@lang('app.supplier-order.stt')</th>
                                    <th>@lang('app.supplier-order.code')</th>
                                    <th>@lang('app.supplier-order.inventory')</th>
                                    <th class="text-left">@lang('app.supplier-order.employee')</th>
                                    <th>@lang('app.supplier-order.request-date-create')</th>
                                    <th>@lang('app.supplier-order.quantity')</th>
                                    <th>@lang('app.supplier-order.time')</th>
                                    <th>@lang('app.supplier-order.status')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.supplier_order.return_order')
    @include('manage.supplier_order.detail_return')
    @include('manage.supplier_order.create')
    @include('manage.supplier_order.update_request')
    @include('manage.supplier_order.detail_request')
    @include('manage.supplier_order.update_restaurant')
    @include('manage.supplier_order.detail_restaurant')
    @include('manage.supplier_order.received_order')
    @include('manage.inventory.out_inventory.create')
    @if(Session::get(SESSION_KEY_LEVEL) > 3)
        @include('manage.inventory.out_inventory.create_request')
    @endif
    @include('manage.supplier_order.detail_order')

@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/supplier_order/index.js?version=6',env('IS_DEPLOY_ON_SERVER'))}}"></script>

@endpush
