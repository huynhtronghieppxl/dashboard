@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" id="nav-export-inventory-warehouse"
                role="tablist">
                <li class="nav-item" id="tab-export-inventory-warehouse-1">
                    <a class="nav-link" data-toggle="tab"
                       data-id="1"
                       href="#tab1-export-inventory-warehouse"
                       role="tab" onclick="changeActiveTabExportInventory(1)"
                       aria-expanded="true">@lang('app.out-inventory-manage.tab1') <span
                                class="label label-success" id="total-record-material">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item" id="tab-export-inventory-warehouse-2">
                    <a class="nav-link" data-toggle="tab" href="#tab2-export-inventory-warehouse"
                       data-id="2"
                       role="tab" onclick="changeActiveTabExportInventory(2)"
                       aria-expanded="false">@lang('app.out-inventory-manage.tab2') <span
                                class="label label-warning" id="total-record-goods">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item" id="tab-export-inventory-warehouse-3">
                    <a class="nav-link" data-toggle="tab" href="#tab3-export-inventory-warehouse"
                       data-id="3"
                       role="tab" onclick="changeActiveTabExportInventory(3)"
                       aria-expanded="false">@lang('app.out-inventory-manage.tab3') <span
                                class="label label-primary"
                                id="total-record-material-internal">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item" id="tab-export-inventory-warehouse-12">
                    <a class="nav-link" data-toggle="tab" href="#tab4-export-inventory-warehouse"
                       data-id="12"
                       role="tab" onclick="changeActiveTabExportInventory(12)"
                       aria-expanded="false">@lang('app.out-inventory-manage.tab4') <span
                                class="label label-inverse" id="total-record-other">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item" id="tab-export-inventory-warehouse-5">
                    <a class="nav-link" data-toggle="tab" href="#tab5-export-inventory-warehouse"
                       data-id="5"
                       role="tab" onclick="changeActiveTabExportInventory(5)"
                       aria-expanded="false">@lang('app.out-inventory-manage.tab5') <span
                                class="label label-danger" id="total-cancel-other">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-export-inventory-warehouse" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.export_inventory.filter')
                            <table class="table" id="table-material-export-inventory-warehouse">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-manage.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.out-inventory-manage.id')</th>
                                    <th class="text-left" rowspan="2">@lang('app.out-inventory-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.target')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.date')</th>
                                    <th
                                            rowspan="2">@lang('app.out-inventory-manage.total-quantity')</th>
                                    <th class="text-right">@lang('app.out-inventory-manage.amount')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.status')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-material-export-inventory-warehouse">
                                        0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-export-inventory-warehouse" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.export_inventory.filter')
                            <table class="table" id="table-goods-export-inventory-warehouse">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.id')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.target')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.date')</th>
                                    <th
                                            rowspan="2">@lang('app.out-inventory-manage.total-quantity')</th>
                                    <th class="text-right">@lang('app.out-inventory-manage.amount')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.status')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-goods-export-inventory-warehouse">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-export-inventory-warehouse" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.export_inventory.filter')
                            <table class="table" id="table-internal-export-inventory-warehouse">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.id')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.target')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.date')</th>
                                    <th
                                            rowspan="2">@lang('app.out-inventory-manage.total-quantity')</th>
                                    <th class="text-right">@lang('app.out-inventory-manage.amount')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.status')</th>
                                    <th class="text-center " rowspan="2">@lang('app.out-inventory-manage.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-internal-export-inventory-warehouse">
                                        0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-export-inventory-warehouse" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.export_inventory.filter')
                            <table class="table" id="table-other-export-inventory-warehouse">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.id')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.target')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.date')</th>
                                    <th
                                            rowspan="2">@lang('app.out-inventory-manage.total-quantity')</th>
                                    <th class="text-right">@lang('app.out-inventory-manage.amount')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.status')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-other-export-inventory-warehouse">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab5-export-inventory-warehouse" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.export_inventory.filter')
                            <table class="table" id="table-cancel-export-inventory-warehouse">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.id')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.target')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.date')</th>
                                    <th
                                            rowspan="2">@lang('app.out-inventory-manage.total-quantity')</th>
                                    <th class="text-right">@lang('app.out-inventory-manage.amount')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-cancel-export-inventory-warehouse">0
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
    @include('manage.warehouse.export_inventory.create')
    @include('manage.warehouse.export_inventory.create_request')
    @include('manage.warehouse.export_inventory.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/warehouse/export_inventory/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
