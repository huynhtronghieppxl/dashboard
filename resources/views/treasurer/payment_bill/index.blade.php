@extends('layouts.layout')
@section('content')
    <style>
        #select2-select-fund-payment-bill-treasurer-container,
        #select2-select-multi-fund-payment-bill-treasurer-container,
        #select2-select-payment-fund-payment-bill-treasurer-container,
        #select2-confirm-multi-payment-bill-treasurer-container{
            font-size: 14px !important;
        }

        .select2-container--default .select2-dropdown .select2-search__field {
            width: 100% !important;
        }

        .seemt-container .new-table .checkbox-form-group {
            justify-content: center !important;
        }

        .seemt-main-content .new-table .toolbar-button-datatable1 > label {
            font-size: 13px !important;
            margin-top: 0px !important;
            margin-bottom: 16px !important;
        }

        .seemt-main-content .new-table .toolbar-button-datatable1 label {
            display: flex;
            flex-direction: row !important;
            justify-content: center !important;
            align-items: center !important;
            padding: 8px 16px !important;
            height: 32px !important;
            background: #E3ECF5;
            border-radius: 6px !important;
            flex: none !important;
            order: 1 !important;
            flex-grow: 0 !important;
            border: none !important;
            text-transform: uppercase;
            margin-bottom: 10px !important;
        }

        .new-table .toolbar-button-datatable1 {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist"
                id="nav-tab-payment-bill">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab"
                       href="#tab-waiting-confirm-payment-payment-treasurer" role="tab"
                       data-id="1"
                       onclick="changeTabPaymentBill(1)"
                       aria-expanded="true">@lang('app.payment-bill.tab0') <span
                                class="label label-primary"
                                id="total-record-tab-waiting-confirm-payment-payment-treasurer">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab-waiting-payment-payment-treasurer" role="tab"
                       data-id="3"
                       onclick="changeTabPaymentBill(3)"
                       aria-expanded="true">@lang('app.payment-bill.tab1') <span
                                class="label label-info"
                                id="total-record-tab-waiting-payment-payment-treasurer">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab-done-payment-treasurer" role="tab"
                       data-id="4"
                       onclick="changeTabPaymentBill(4)"
                       aria-expanded="false">@lang('app.payment-bill.tab4') <span
                                class="label label-success"
                                id="total-record-tab-done-payment-treasurer">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab-cancel-payment-treasurer" role="tab"
                       data-id="5"
                       onclick="changeTabPaymentBill(5)"
                       aria-expanded="false">@lang('app.payment-bill.tab5') <span
                                class="label label-danger"
                                id="total-record-tab-cancel-payment-treasurer">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block" id="body-payment-bill-treasurer">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-waiting-confirm-payment-payment-treasurer" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('treasurer.payment_bill.filter')
                            <table id="table-waiting-confirm-payment-payment-treasurer" class="table">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.payment-bill.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.code')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.employee')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.target')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.note')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.reason')</th>
                                    <th rowspan="2">@lang('app.payment-bill.date')</th>
                                    <th class="text-right">@lang('app.payment-bill.amount')</th>
                                    <th rowspan="2">
                                        <div class="toolbar-button-datatable1 align-items-start">
                                            <label onclick="confirmMultiPaymentBill($(this))"
                                                   class="mb-1 pointer mr-1 d-flex align-items-center d-none check-confirm-muti-payment  ">
                                                <span class="mr-1">Xác nhận</span>
                                            </label>
                                            <label onclick="hideCheckAllWaitingConfirmPaymentBill()"
                                                   class="mb-1 pointer mr-1 d-flex align-items-center d-none checkbox-all-confirm-waiting-payment  ">
                                                <span class="mr-1">Hủy</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-form-group d-none  checkbox-all-confirm-waiting-payment  "
                                             style="align-content: end !important;margin-left: 20px  ">
                                            <input type="checkbox" id="checkbox-all-confirm-waiting-payment">
                                            <p id="total-count-confirm-waiting-payment">0/0</p>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-right total-payment-bill seemt-fz-14"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-waiting-payment-payment-treasurer" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('treasurer.payment_bill.filter')
                            <table id="table-waiting-payment-payment-treasurer" class="table">
                                <thead>
                                <tr>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.code')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.employee')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.target')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.note')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.reason')</th>
                                    <th rowspan="2">@lang('app.payment-bill.date')</th>
                                    <th class="text-right">@lang('app.payment-bill.amount')</th>
                                    <th rowspan="2">
                                        <div class="toolbar-button-datatable1 align-items-start">
                                            <label onclick="paymentMultiPaymentBill($(this))"
                                                   class="mb-1 pointer mr-1 d-flex align-items-center d-none check-muti-payment  ">
                                                <span class="mr-1">Xác nhận</span>
                                            </label>
                                            <label onclick="hideCheckAllWaitingPaymentBill()"
                                                   class="mb-1 pointer mr-1 d-flex align-items-center d-none checkbox-all-waiting-payment  ">
                                                <span class="mr-1">Hủy</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-form-group d-none checkbox-all-waiting-payment  "
                                             style="align-content: end !important;margin-left: 20px  ">
                                            <input type="checkbox" id="checkbox-all-waiting-payment">
                                            <p id="total-count-waiting-payment">0/0</p>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-right total-payment-bill seemt-fz-14"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-done-payment-treasurer" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('treasurer.payment_bill.filter')
                            <table id="table-done-payment-treasurer" class="table">
                                <thead>
                                <tr>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.code')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.employee')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.target')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.note')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.reason')</th>
                                    <th rowspan="2">@lang('app.payment-bill.date')</th>
                                    <th class="text-right">@lang('app.payment-bill.amount')</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th class="text-right total-payment-bill seemt-fz-14"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-cancel-payment-treasurer" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('treasurer.payment_bill.filter')
                            <table id="table-cancel-payment-treasurer" class="table">
                                <thead>
                                <tr>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.code')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.employee')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.target')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.note')</th>
                                    <th class="text-left" rowspan="2">@lang('app.payment-bill.reason')</th>
                                    <th rowspan="2">@lang('app.payment-bill.date')</th>
                                    <th class="text-right">@lang('app.payment-bill.amount')</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th class="text-right total-payment-bill seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('treasurer.payment_bill.create')
        @include('treasurer.payment_bill.detail')
        @include('manage.supplier_order.detail_order')
        @include('treasurer.payment_bill.update')
        @include('manage.inventory.in_inventory.detail')
        @include('manage.inventory_internal.return_inventory.detail')
    </div>

@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('..\js\treasurer\payment_bill\index.js?version=13', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{asset('..\js\treasurer\payment_bill\confirm.js?version=7', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
