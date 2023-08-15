@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row font-15 text-center justify-content-center align-items-center">
                <div class="col-lg-2 card p-3">
                    <div class="font-weight-bold">
                        @lang('app.cash-book.first-money')
                        <i class="fi-rr-exclamation pointer text-inverse"
                           data-toggle="tooltip" data-placement="top" style="display: initial; vertical-align: middle"
                           data-original-title="@lang('app.cash-book.first-money-title')"></i>
                    </div>
                    <div id="before-amount-cash-book-treasurer">0</div>
                </div>
                <div class="col-lg-1 font-weight-bold">
                    <br/>
                    <i class="fa fa-plus" style="vertical-align: top"></i>
                </div>
                <div class="col-lg-2 card p-3">
                    <div class="font-weight-bold">
                        @lang('app.cash-book.total-revenue')
                        <i class="fi-rr-exclamation pointer text-inverse"
                           data-toggle="tooltip" data-placement="top" style="display: initial; vertical-align: middle"
                           data-original-title="@lang('app.cash-book.total-revenue-title')"></i>
                    </div>
                    <div id="in-amount-cash-book-treasurer">0</div>
                </div>
                <div class="col-lg-1 font-weight-bold">
                    <br/>
                    <i class="fa fa-minus" style="vertical-align: top"></i>
                </div>
                <div class="col-lg-2 card p-3">
                    <div class="font-weight-bold">
                        @lang('app.cash-book.total-expenditure')
                        <i class="fi-rr-exclamation pointer text-inverse"
                           data-toggle="tooltip" data-placement="top" style="display: initial; vertical-align: middle"
                           data-original-title="@lang('app.cash-book.total-expenditure-title')"></i>
                    </div>
                    <div id="out-amount-cash-book-treasurer">0</div>
                </div>
                <div class="col-lg-1 font-weight-bold">
                    <br/>
                    <i class="fa fa-pause fa-rotate-90" style="vertical-align: top"></i>
                </div>
                <div class="col-lg-2 card p-3">
                    <div class="font-weight-bold">@lang('app.cash-book.last-money')</div>
                    <div id="after-amount-cash-book-treasurer">0</div>
                </div>
            </div>
            <ul class="col-12 nav nav-tabs md-tabs mt-2" id="nav-tab-cash-book" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab1-cash-book" role="tab"
                       data-id="1"
                       onclick="changeTabCashBook(1)" aria-expanded="true">
                        @lang('app.cash-book.tab1') <span class="label label-warning"
                                                          id="total-record-tab1-cash-book-treasurer">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2-cash-book" role="tab"
                       data-id="0"
                       onclick="changeTabCashBook(0)" aria-expanded="false">
                        @lang('app.cash-book.tab2') <span class="label label-success"
                                                          id="total-record-tab2-cash-book-treasurer">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-cash-book" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive new-table">
                                @include('treasurer.cash_book.filter')
                                <table id="table-payment-cash-book-treasurer" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.cash-book.stt')</th>
                                        <th rowspan="2">@lang('app.cash-book.code')</th>
                                        <th class="text-left" rowspan="2">@lang('app.cash-book.employee')</th>
                                        <th rowspan="2">@lang('app.cash-book.target')</th>
                                        <th rowspan="2">@lang('app.cash-book.reason-payment')</th>
                                        <th rowspan="2">@lang('app.cash-book.date')</th>
                                        <th class="text-right">@lang('app.cash-book.amount')</th>
                                        <th style="z-index: 0" rowspan="2">@lang('app.cash-book.status')</th>
                                        <th style="z-index: 0" rowspan="2">@lang('app.cash-book.action')</th>
                                    </tr>
                                    <tr>
                                        <th id="total-tab1-cash-book-treasurer" class="text-right seemt-fz-16">0</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-cash-book" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive new-table">
                                @include('treasurer.cash_book.filter')
                                <table id="table-receipt-cash-book-treasurer" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.cash-book.stt')</th>
                                        <th rowspan="2">@lang('app.cash-book.code')</th>
                                        <th class="text-left" rowspan="2">@lang('app.cash-book.employee')</th>
                                        <th rowspan="2">@lang('app.cash-book.target')</th>
                                        <th rowspan="2">@lang('app.cash-book.reason-receipt')</th>
                                        <th rowspan="2">@lang('app.cash-book.date')</th>
                                        <th class="text-right">@lang('app.cash-book.amount')</th>
                                        <th rowspan="2">@lang('app.cash-book.status')</th>
                                        <th rowspan="2">@lang('app.cash-book.action')</th>
                                    </tr>
                                    <tr>
                                        <th id="total-tab2-cash-book-treasurer" class="text-right seemt-fz-16">0</th>
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
    @include('treasurer.payment_bill.detail')
    @include('treasurer.receipts_bill.detail')
    @include('manage.inventory.in_inventory.detail')
    @include('manage.supplier_order.detail_order')
    @include('manage.bill.detail')
    @include('manage.bill.detail_employee')

@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\treasurer\cash_book\index.js?version=7', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
