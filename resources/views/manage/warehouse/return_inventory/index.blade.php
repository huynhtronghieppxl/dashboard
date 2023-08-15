@extends('layouts.layout')
@section('content')
    <style>
        .card-block-swal-alert {
            width: 300px !important;
            margin-bottom: 0 !important;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tab-return-inventory-warehouse">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       onclick="changeActiveTabMaterialData(4)"
                       data-id="4"
                       href="#tab5-return-inventory-warehouse-manage"
                       role="tab"
                       aria-expanded="true">@lang('app.warehouse-manage.return-inventory.tab5') <span
                                class="label label-warning" id="total-record-waiting">0</span></a>
                    <div class="slide slide-6"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       onclick="changeActiveTabMaterialData(1)"
                       data-id="1"
                       href="#tab1-return-inventory-warehouse-manage"
                       role="tab"
                       aria-expanded="false">@lang('app.warehouse-manage.return-inventory.tab1') <span
                                class="label label-success" id="total-record-material">0</span></a>
                    <div class="slide slide-6"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2-return-inventory-warehouse-manage"
                       onclick="changeActiveTabMaterialData(2)"
                       data-id="2"
                       role="tab"
                       aria-expanded="false">@lang('app.warehouse-manage.return-inventory.tab2') <span
                                class="label label-warning" id="total-record-goods">0</span></a>
                    <div class="slide slide-6"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab3-return-inventory-warehouse-manage"
                       onclick="changeActiveTabMaterialData(3)"
                       data-id="3"
                       role="tab"
                       aria-expanded="false">@lang('app.warehouse-manage.return-inventory.tab3') <span
                                class="label label-primary" id="total-record-material-internal">0</span></a>
                    <div class="slide slide-6"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab4-return-inventory-warehouse-manage"
                       onclick="changeActiveTabMaterialData(12)"
                       data-id="12"
                       role="tab"
                       aria-expanded="false">@lang('app.warehouse-manage.return-inventory.tab4') <span
                                class="label label-inverse" id="total-record-other">0</span></a>
                    <div class="slide slide-6"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab6-return-inventory-warehouse-manage"
                       onclick="changeActiveTabMaterialData(5)"
                       data-id="5"
                       role="tab"
                       aria-expanded="false">@lang('app.warehouse-manage.return-inventory.tab6') <span
                                class="label label-danger" id="total-record-cancel">0</span></a>
                    <div class="slide slide-6"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab5-return-inventory-warehouse-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.return_inventory.filter')
                            <table class="table "
                                   id="table-waiting-return-inventory-warehouse-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.stt')</th>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.id')</th>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.employee')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.branch')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.date-create')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.material')</th>
                                    <th class="text-right">@lang('app.warehouse-manage.return-inventory.total')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th
                                            id="total-waiting-in-inventory-branch-manage" class="seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane " id="tab1-return-inventory-warehouse-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.return_inventory.filter')
                            <table class="table "
                                   id="table-material-return-inventory-warehouse-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.stt')</th>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.id')</th>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.employee')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.branch')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.date')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.material')</th>
                                    <th class="text-right">@lang('app.warehouse-manage.return-inventory.total')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th
                                            id="total-material-return-inventory-warehouse-manage" class="seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-return-inventory-warehouse-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.in_inventory_branch.filter')
                            <table class="table "
                                   id="table-goods-return-inventory-warehouse-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.stt')</th>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.id')</th>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.employee')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.branch')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.date')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.material')</th>
                                    <th class="text-right">@lang('app.warehouse-manage.return-inventory.total')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th
                                            id="total-goods-return-inventory-warehouse-manage" class="seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-return-inventory-warehouse-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.in_inventory_branch.filter')
                            <table class="table "
                                   id="table-internal-in-inventory-branch-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.stt')</th>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.id')</th>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.employee')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.branch')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.date')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.material')</th>
                                    <th class="text-right">@lang('app.warehouse-manage.return-inventory.total')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th
                                            id="total-internal-return-inventory-warehouse-manage" class="seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-return-inventory-warehouse-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.return_inventory.filter')
                            <table class="table "
                                   id="table-other-return-inventory-warehouse-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.stt')</th>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.id')</th>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.employee')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.branch')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.date')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.material')</th>
                                    <th class="text-right">@lang('app.warehouse-manage.return-inventory.total')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th
                                            id="total-other-return-inventory-warehouse-manage" class="seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab6-return-inventory-warehouse-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.return_inventory.filter')
                            <table class="table"
                                   id="table-cancel-return-inventory-warehouse-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.stt')</th>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.id')</th>
                                    <th rowspan="2">@lang('app.warehouse-manage.return-inventory.employee')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.branch')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.date-cancel')</th>
                                    <th
                                            rowspan="2">@lang('app.warehouse-manage.return-inventory.material')</th>
                                    <th class="text-right">@lang('app.warehouse-manage.return-inventory.total')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th
                                            id="total-cancel-return-inventory-warehouse-manage" class="seemt-fz-14">0
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
    @include('manage.warehouse.return_inventory.detail')
    @include('manage.employee.info')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/warehouse/return_inventory/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
