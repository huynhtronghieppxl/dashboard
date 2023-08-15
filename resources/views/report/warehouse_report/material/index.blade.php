@extends('layouts.layout')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}"/>
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" id="tabs-form-material" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-tab="1" data-toggle="tab" href="#tab1-material-report"
                       role="tab" aria-expanded="true">@lang('app.material-report.tab1') <span
                                class="label label-success" id="total-record-warehouse-material">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-tab="2" data-toggle="tab" href="#tab2-material-report"
                       role="tab" aria-expanded="false">@lang('app.material-report.tab2') <span
                                class="label label-warning" id="total-record-warehouse-goods">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-tab="3" href="#tab3-material-report"
                       role="tab" aria-expanded="false">@lang('app.material-report.tab3') <span
                                class="label label-primary"
                                id="total-record-warehouse-internal">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-tab="4" href="#tab4-material-report"
                       role="tab" aria-expanded="false">@lang('app.material-report.tab4') <span
                                class="label label-inverse" id="total-record-warehouse-other">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-material-report" role="tabpanel"
                         style="border-right: none!important;">
                        <div class="table-responsive new-table">
                            @include('report.material.filter')
                            <table class="table" id="table-material-warehouse-report">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.material-report.stt')</th>
                                    <th rowspan="2">@lang('app.material-report.name')</th>
                                    <th class="text-right">@lang('app.material-report.before')</th>
                                    <th class="text-right">@lang('app.material-report.import')</th>
                                    <th class="text-right">@lang('app.material-report.export')</th>
                                    <th class="text-right">@lang('app.material-report.cancel')</th>
                                    <th class="text-right">@lang('app.material-report.after')</th>
                                    <th class="text-right">Kho chi nhánh trả hàng</th>
                                    <th rowspan="2"></th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th><label id="total-amount-before-warehouse-material" class="seemt-fz-14"></label>
                                    </th>
                                    <th><label id="total-quantity-import-materials" class="seemt-fz-14"></label></th>
                                    <th><label id="total-quantity-exports-materials" class="seemt-fz-14"></label></th>
                                    <th><label id="total-amount-destroy-materials" class="seemt-fz-14"></label></th>
                                    <th><label id="total-system-inventory" class="seemt-fz-14"></label></th>
                                    <th><label id="total-amount-warehouses-branch-to-pay" class="seemt-fz-14"></label>
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-material-report" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('report.material.filter')
                            <table class="table" id="table-goods-warehouse-report">
                                <thead>
                                <tr>
                                    <th
                                            rowspan="2">@lang('app.material-report.stt')</th>
                                    <th
                                            rowspan="2">@lang('app.material-report.name')</th>
                                    <th class="text-right">@lang('app.material-report.before')</th>
                                    <th class="text-right">@lang('app.material-report.import')</th>
                                    <th class="text-right">@lang('app.material-report.export')</th>
                                    <th class="text-right">@lang('app.material-report.cancel')</th>
                                    <th class="text-right">@lang('app.material-report.after')</th>
                                    <th class="text-right">Kho chi nhánh trả hàng</th>
                                    <th rowspan="2"></th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th><label id="total-amount-before-warehouse-goods" class="seemt-fz-14"></label>
                                    </th>
                                    <th><label id="total-amount-import-goods" class="seemt-fz-14"></label></th>
                                    <th><label id="total-quantity-exports-goods" class="seemt-fz-14"></label></th>
                                    <th><label id="total-amount-destroy-goods" class="seemt-fz-14"></label></th>
                                    <th><label id="total-system-inventory-goods" class="seemt-fz-14"></label></th>
                                    <th><label id="total-amount-warehouses-branch-to-pay-goods"
                                               class="seemt-fz-14"></label></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-material-report" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('report.material.filter')
                            <table class="table" id="table-internal-warehouse-report">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.material-report.stt')</th>
                                    <th rowspan="2">@lang('app.material-report.name')</th>
                                    <th class="text-right">@lang('app.material-report.before')</th>
                                    <th class="text-right">@lang('app.material-report.import')</th>
                                    <th class="text-right">@lang('app.material-report.export')</th>
                                    <th class="text-right">@lang('app.material-report.cancel')</th>
                                    <th class="text-right">@lang('app.material-report.after')</th>
                                    <th class="text-right">Kho chi nhánh trả hàng</th>
                                    <th rowspan="2"></th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th><label id="total-amount-before-warehouse-internal" class="seemt-fz-14"></label>
                                    </th>
                                    <th><label id="total-amount-import-internal" class="seemt-fz-14"></label></th>
                                    <th><label id="total-quantity-exports-internal" class="seemt-fz-14"></label></th>
                                    <th><label id="total-amount-destroy-internal" class="seemt-fz-14"></label></th>
                                    <th><label id="total-system-inventory-internal" class="seemt-fz-14"></label></th>
                                    <th><label id="total-amount-warehouses-branch-to-pay-internal"
                                               class="seemt-fz-14"></label></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-material-report" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('report.material.filter')
                            <table class="table" id="table-other-warehouse-report">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.material-report.stt')</th>
                                    <th rowspan="2">@lang('app.material-report.name')</th>
                                    <th class="text-right">@lang('app.material-report.before')</th>
                                    <th class="text-right">@lang('app.material-report.import')</th>
                                    <th class="text-right">@lang('app.material-report.export')</th>
                                    <th class="text-right">@lang('app.material-report.cancel')</th>
                                    <th class="text-right">@lang('app.material-report.after')</th>
                                    <th class="text-right">Kho chi nhánh trả hàng</th>
                                    <th rowspan="2"></th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th><label id="total-amount-before-warehouse-other" class="seemt-fz-14"></label>
                                    </th>
                                    <th><label id="total-amount-import-other" class="seemt-fz-14"></label></th>
                                    <th><label id="total-quantity-exports-other" class="seemt-fz-14"></label></th>
                                    <th><label id="total-amount-destroy-other" class="seemt-fz-14"></label></th>
                                    <th><label id="total-system-inventory-other" class="seemt-fz-14"></label></th>
                                    <th><label id="total-amount-warehouses-branch-to-pay-other"
                                               class="seemt-fz-14"></label></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-body end -->
    </div>
    @include('report.material.excel')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('../js/report/warehouse_report/material/index.js?version=1')}}"></script>
@endpush
