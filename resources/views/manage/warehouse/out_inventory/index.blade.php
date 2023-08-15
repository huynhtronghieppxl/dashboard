@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block">
                <ul class="nav nav-tabs md-tabs" id="nav-out-inventory-manage"
                    role="tablist">
                    <li class="nav-item" id="tab-out-inventory-manage-1">
                        <a class="nav-link" data-toggle="tab"
                           data-id="1"
                           href="#tab1-out-inventory-manage"
                           role="tab" onclick="changeActiveTabMaterialData(1)"
                           aria-expanded="true">@lang('app.out-inventory-manage.tab1') <span
                                class="label label-success" id="total-record-material">0</span></a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item" id="tab-out-inventory-manage-2">
                        <a class="nav-link" data-toggle="tab" href="#tab2-out-inventory-manage"
                           data-id="2"
                           role="tab" onclick="changeActiveTabMaterialData(2)"
                           aria-expanded="false">@lang('app.out-inventory-manage.tab2') <span
                                class="label label-warning" id="total-record-goods">0</span></a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item" id="tab-out-inventory-manage-3">
                        <a class="nav-link" data-toggle="tab" href="#tab3-out-inventory-manage"
                           data-id="3"
                           role="tab" onclick="changeActiveTabMaterialData(3)"
                           aria-expanded="false">@lang('app.out-inventory-manage.tab3') <span
                                class="label label-primary"
                                id="total-record-material-internal">0</span></a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item" id="tab-out-inventory-manage-12">
                        <a class="nav-link" data-toggle="tab" href="#tab4-out-inventory-manage"
                           data-id="12"
                           role="tab" onclick="changeActiveTabMaterialData(12)"
                           aria-expanded="false">@lang('app.out-inventory-manage.tab4') <span
                                class="label label-inverse" id="total-record-other">0</span></a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item" id="tab-out-inventory-manage-5">
                        <a class="nav-link" data-toggle="tab" href="#tab5-out-inventory-manage"
                           data-id="5"
                           role="tab" onclick="changeActiveTabMaterialData(5)"
                           aria-expanded="false">@lang('app.out-inventory-manage.tab5') <span
                                class="label label-danger" id="total-cancel-other">0</span></a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-out-inventory-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.out_inventory.filter')
                            <table class="table" id="table-material-out-inventory-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.id')</th>
                                    <th class="col-name-avatar" rowspan="2">@lang('app.out-inventory-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.target')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.date')</th>
                                    <th
                                        rowspan="2">@lang('app.out-inventory-manage.total-quantity')</th>
                                    <th>@lang('app.out-inventory-manage.amount')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.status')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-material-out-inventory-manage" class="seemt-fz-14">
                                        0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-out-inventory-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.out_inventory.filter')
                            <table class="table" id="table-goods-out-inventory-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.id')</th>
                                    <th class="col-name-avatar" rowspan="2">@lang('app.out-inventory-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.target')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.date')</th>
                                    <th
                                        rowspan="2">@lang('app.out-inventory-manage.total-quantity')</th>
                                    <th>@lang('app.out-inventory-manage.amount')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.status')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-goods-out-inventory-manage" class="seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-out-inventory-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.out_inventory.filter')
                            <table class="table" id="table-internal-out-inventory-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.id')</th>
                                    <th class="col-name-avatar" rowspan="2">@lang('app.out-inventory-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.target')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.date')</th>
                                    <th
                                        rowspan="2">@lang('app.out-inventory-manage.total-quantity')</th>
                                    <th>@lang('app.out-inventory-manage.amount')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.status')</th>
                                    <th class="text-center " rowspan="2">@lang('app.out-inventory-manage.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-internal-out-inventory-manage" class="seemt-fz-14">
                                        0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-out-inventory-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.out_inventory.filter')
                            <table class="table" id="table-other-out-inventory-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.id')</th>
                                    <th class="col-name-avatar" rowspan="2">@lang('app.out-inventory-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.target')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.date')</th>
                                    <th
                                        rowspan="2">@lang('app.out-inventory-manage.total-quantity')</th>
                                    <th>@lang('app.out-inventory-manage.amount')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.status')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-other-out-inventory-manage" class="seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab5-out-inventory-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.out_inventory.filter')
                            <table class="table" id="table-cancel-out-inventory-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.id')</th>
                                    <th class="col-name-avatar" rowspan="2">@lang('app.out-inventory-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.target')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.date')</th>
                                    <th
                                        rowspan="2">@lang('app.out-inventory-manage.total-quantity')</th>
                                    <th>@lang('app.out-inventory-manage.amount')</th>
                                    <th rowspan="2">@lang('app.out-inventory-manage.action')</th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-cancel-out-inventory-manage" class="seemt-fz-14">0
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
    @if(Session::get(SESSION_KEY_LEVEL) > 3)
        @include('manage.inventory.out_inventory.create_request')
    @endif
    @include('manage.inventory.out_inventory.create')
    @include('manage.inventory.out_inventory.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('/js/manage/inventory/out_inventory/index.js?version=23',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
