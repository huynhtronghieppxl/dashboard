@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body" id="div-goods-purchase-warehouse">
            <ul class="nav nav-tabs mb-7-tabs" role="tablist" id="nav-goods-purchase-warehouse">
                @if(Session::get(SESSION_KEY_LEVEL) > 3)
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-request-goods-purchase"
                           data-id="0"
                           onclick="changeActiveTabGoodsPurchase(0)"
                           role="tab"
                           aria-expanded="true">@lang('app.supplier-order.tab0') <span
                                    class="label label-info" id="total-record-order">0</span></a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item" id="nav-create-goods-purchase">
                        <a class="nav-link" data-toggle="tab" href="#tab-waiting-goods-purchase"
                           data-id="1"
                           onclick="changeActiveTabGoodsPurchase(1)"
                           role="tab"
                           aria-expanded="false">@lang('app.supplier-order.tab1') <span
                                    class="label label-warning" id="total-record-waiting">0</span></a>
                        <div class="slide"></div>
                    </li>
                @else
                    <li class="nav-item" id="nav-create-goods-purchase">
                        <a class="nav-link active" data-toggle="tab" href="#tab-waiting-goods-purchase"
                           data-id="1"
                           onclick="changeActiveTabGoodsPurchase(1)"
                           role="tab"
                           aria-expanded="false">@lang('app.supplier-order.tab1') <span
                                    class="label label-warning" id="total-record-waiting">0</span></a>
                        <div class="slide"></div>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-order-goods-purchase"
                       data-id="2"
                       onclick="changeActiveTabGoodsPurchase(2)"
                       role="tab"
                       aria-expanded="false">@lang('app.supplier-order.tab2') <span
                                class="label label-primary" id="total-record-received">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-done-goods-purchase"
                       data-id="3"
                       onclick="changeActiveTabGoodsPurchase(3)"
                       role="tab"
                       aria-expanded="false">@lang('app.supplier-order.tab3') <span
                                class="label label-success" id="total-record-done">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-cancel-goods-purchase"
                       data-id="4"
                       onclick="changeActiveTabGoodsPurchase(4)"
                       role="tab" aria-expanded="false">@lang('app.supplier-order.tab4') <span
                                class="label label-danger" id="total-record-cancel">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item" id="nav-return-goods-purchase">
                    <a class="nav-link" data-toggle="tab" href="#tab-return-goods-purchase"
                       data-id="5"
                       onclick="changeActiveTabGoodsPurchase(5)"
                       role="tab" aria-expanded="false">@lang('app.supplier-order.tab5') <span
                                class="label label-inverse" id="total-record-return">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item" id="nav-return-goods-purchase">
                    <a class="nav-link" data-toggle="tab" href="#tab-history-request-goods-purchase"
                       data-id="6"
                       onclick="changeActiveTabGoodsPurchase(6)"
                       role="tab" aria-expanded="false">@lang('app.supplier-order.tab6')<span
                                class="label" style="background: linear-gradient(to right, #6f0303, #644)"
                                id="total-record-request-history">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    @if(Session::get(SESSION_KEY_LEVEL) > 3)
                        <div class="tab-pane active" id="tab-request-goods-purchase" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('manage.warehouse.goods_purchase.filter')
                                <table class="table" id="table-request-goods-purchase">
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
                        <div class="tab-pane" id="tab-waiting-goods-purchase" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('manage.warehouse.goods_purchase.filter')
                                <table class="table" id="table-waiting-goods-purchase">
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
                                        <th id="total-amount-request-goods-purchase" class="seemt-fz-14">0</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="tab-pane active" id="tab-waiting-goods-purchase" role="tabpanel">
                            <div class="table-responsive new-table">
                                @include('manage.warehouse.goods_purchase.filter')
                                <table class="table" id="table-waiting-goods-purchase">
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
                    <div class="tab-pane" id="tab-order-goods-purchase" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.goods_purchase.filter')
                            <table class="table" id="table-order-goods-purchase">
                                <thead>
                                <tr style="background-color: #fff !important;">
                                    <th rowspan="2">@lang('app.supplier-order.stt')</th>
                                    <th rowspan="2">@lang('app.supplier-order.code')</th>
                                    <th class="text-left" rowspan="2">@lang('app.supplier-order.supplier')</th>
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
                    <div class="tab-pane" id="tab-done-goods-purchase" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.goods_purchase.filter')
                            <table class="table" id="table-done-goods-purchase">
                                <thead>
                                <tr style="background-color: #fff !important;">
                                    <th rowspan="2">@lang('app.supplier-order.stt')</th>
                                    <th rowspan="2"
                                        style="text-align: left !important;">@lang('app.supplier-order.code')</th>
                                    <th rowspan="2"
                                        style="text-align: left !important;">@lang('app.supplier-order.supplier')</th>
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
                                    <th id="amount-done" class="seemt-fz-14">0</th>
                                    <th id="total-return-done" class="seemt-fz-14">0</th>
                                    <th id="total-amount-done" class="seemt-fz-14">0</th>
                                    <th id="discount-done" class="seemt-fz-14">0</th>
                                    <th id="vat-done" class="seemt-fz-14">0</th>
                                    <th id="total-payment-done" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-cancel-goods-purchase" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.goods_purchase.filter')
                            <table class="table" id="table-cancel-goods-purchase">
                                <thead>
                                <tr style="background-color: #fff !important;">
                                    <th rowspan="2">@lang('app.supplier-order.stt')</th>
                                    <th rowspan="2">@lang('app.supplier-order.code')</th>
                                    <th class="text-left" rowspan="2">@lang('app.supplier-order.supplier')</th>
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
                    <div class="tab-pane" id="tab-return-goods-purchase" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.goods_purchase.filter')
                            <table class="table" id="table-return-goods-purchase">
                                <thead>
                                <tr style="background-color: #fff !important;">
                                    <th rowspan="2">@lang('app.supplier-order.stt')</th>
                                    <th rowspan="2">@lang('app.supplier-order.code')</th>
                                    <th class="text-left" rowspan="2">@lang('app.supplier-order.supplier')</th>
                                    <th class="text-left" rowspan="2">@lang('app.supplier-order.employee-return')</th>
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
                                    <th rowspan="2">@lang('app.supplier-order.date-return')</th>
                                    <th rowspan="2">@lang('app.supplier-order.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="amount-return" class="seemt-fz-14">0</th>
                                    <th id="discount-return" class="seemt-fz-14">0</th>
                                    <th id="vat-return" class="seemt-fz-14">0</th>
                                    <th id="total-amount-return" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-history-request-goods-purchase" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.goods_purchase.filter')
                            <table class="table" id="table-history-request-goods-purchase">
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
    @include('manage.warehouse.goods_purchase.create')
    {{--@include('manage.warehouse.goods_purchase.create_request')--}}
    @include('manage.warehouse.goods_purchase.update_order_supplier')
    @include('manage.warehouse.goods_purchase.update_request')
    @include('manage.supplier_order.detail_restaurant')
    @include('manage.supplier_order.detail_order')
    @include('manage.warehouse.goods_purchase.detail_request')
    @include('manage.employee.info')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/warehouse/goods_purchase/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
