@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs md-5-tabs" role="tablist" id="nav-tab-inventory-warehouse">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab1-inventory-warehouse-manage"
                       role="tab"
                       data-id="1"
                       aria-expanded="true">@lang('app.warehouse-manage.tab1') <span
                                class="label label-success" id="total-record-material">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2-inventory-warehouse-manage"
                       role="tab"
                       data-id="2"
                       aria-expanded="false">@lang('app.warehouse-manage.tab2') <span
                                class="label label-warning" id="total-record-goods">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab3-inventory-warehouse-manage"
                       role="tab"
                       data-id="3"
                       aria-expanded="false">@lang('app.warehouse-manage.tab3') <span
                                class="label label-primary"
                                id="total-record-internal">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab4-inventory-warehouse-manage"
                       id="tab-cancel-inventory-warehouse"
                       data-id="12"
                       role="tab" aria-expanded="false">@lang('app.warehouse-manage.tab4')
                        <span
                                class="label label-inverse" id="total-record-other">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab5-inventory-warehouse-manage"
                       id="tab-cancel-inventory-warehouse"
                       data-id="5"
                       role="tab" aria-expanded="false">@lang('app.warehouse-manage.tab5')
                        <span
                                class="label label-danger" id="total-record-cancel">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-inventory-warehouse-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.inventory.filter')
                            <table class="table" id="table-material-inventory-warehouse-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.warehouse-manage.stt')</th>
                                    <th>@lang('app.warehouse-manage.id')</th>
                                    <th>@lang('app.warehouse-manage.employee')</th>
                                    <th>@lang('app.warehouse-manage.employee-confirm')</th>
                                    <th>@lang('app.warehouse-manage.date')</th>
                                    <th>@lang('app.warehouse-manage.status')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-inventory-warehouse-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.inventory.filter')
                            <table class="table" id="table-goods-inventory-warehouse-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.warehouse-manage.stt')</th>
                                    <th>@lang('app.warehouse-manage.id')</th>
                                    <th>@lang('app.warehouse-manage.employee')</th>
                                    <th>@lang('app.warehouse-manage.employee-confirm')</th>
                                    <th>@lang('app.warehouse-manage.date')</th>
                                    <th>@lang('app.warehouse-manage.status')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-inventory-warehouse-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.inventory.filter')
                            <table class="table" id="table-internal-inventory-warehouse-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.warehouse-manage.stt')</th>
                                    <th>@lang('app.warehouse-manage.id')</th>
                                    <th>@lang('app.warehouse-manage.employee')</th>
                                    <th>@lang('app.warehouse-manage.employee-confirm')</th>
                                    <th>@lang('app.warehouse-manage.date')</th>
                                    <th>@lang('app.warehouse-manage.status')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-inventory-warehouse-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.inventory.filter')
                            <table class="table"
                                   id="table-other-inventory-warehouse-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.warehouse-manage.stt')</th>
                                    <th>@lang('app.warehouse-manage.id')</th>
                                    <th>@lang('app.warehouse-manage.employee')</th>
                                    <th>@lang('app.warehouse-manage.employee-confirm')</th>
                                    <th>@lang('app.warehouse-manage.date')</th>
                                    <th>@lang('app.warehouse-manage.status')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab5-inventory-warehouse-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.warehouse.inventory.filter')
                            <table class="table"
                                   id="table-cancel-inventory-warehouse-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.warehouse-manage.stt')</th>
                                    <th>@lang('app.warehouse-manage.id')</th>
                                    <th>@lang('app.warehouse-manage.employee')</th>
                                    <th>@lang('app.warehouse-manage.employee-confirm')</th>
                                    <th>@lang('app.warehouse-manage.date')</th>
                                    {{--                                        <th>@lang('app.checklist-goods-manage.status')</th>--}}
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.warehouse.inventory.create')
    @include('manage.warehouse.inventory.detail')
    @include('manage.warehouse.inventory.confirm')
    @include('manage.employee.info')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/warehouse/inventory/index.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
