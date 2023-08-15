@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tab-receipts-bill">
                <li class="nav-item">
                    <a class="nav-link remove-draw-table" data-toggle="tab"
                       data-id="0"
                       href="#tab1-receipts-bill" role="tab"
                       onclick="changeTabReceiptsBill(0)"
                       aria-expanded="true">@lang('app.receipts-bill.tab1') <span
                                class="label label-success"
                                id="total-record-tab1-receipts-bill">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link remove-draw-table" data-toggle="tab"
                       data-id="1"
                       href="#tab3-receipts-bill" role="tab"
                       onclick="changeTabReceiptsBill(1)"
                       aria-expanded="false">@lang('app.receipts-bill.tab3') <span
                                class="label label-danger"
                                id="total-record-tab3-receipts-bill">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-receipts-bill" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('treasurer.receipts_bill.filter')
                            <table id="table-receipts-bill1" class="table">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.receipts-bill.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.code')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.employee')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.target')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.note')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.reason')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.object_id')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.date')</th>
                                    <th class="text-right">@lang('app.receipts-bill.amount')</th>
                                    <th rowspan="2">@lang('app.receipts-bill.action')</th>
                                </tr>
                                <tr>
                                    <th id="total-tab1-receipts-bill" class="text-right seemt-fz-14"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-receipts-bill" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('treasurer.receipts_bill.filter')
                            <table id="table-receipts-bill3" class="table">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.receipts-bill.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.code')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.employee')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.target')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.note')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.reason')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.object_id')</th>
                                    <th class="text-left" rowspan="2">@lang('app.receipts-bill.date')</th>
                                    <th class="text-right">@lang('app.receipts-bill.amount')</th>
                                    <th rowspan="2">@lang('app.receipts-bill.action')</th>
                                </tr>
                                <tr>
                                    <th id="total-tab3-receipts-bill" class="text-right seemt-fz-14"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('treasurer.receipts_bill.create')
    @include('treasurer.receipts_bill.detail')
    @include('treasurer.receipts_bill.update')
    @include('manage.bill.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\treasurer\receipts_bill\index.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
