@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body" id="div-return-inventory-internal-manage">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tab-cancel-inventory-internal-manage">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       data-id="1"
                       href="#tab1-cancel-inventory-internal-manage"
                       role="tab"
                       id="tab-cancel-inventory-internal-manage-1"
                       aria-expanded="true">@lang('app.cancel-inventory-internal-manage.tab1') <span
                                class="label label-success" id="total-record-kitchen">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2-cancel-inventory-internal-manage"
                       role="tab"
                       data-id="2"
                       id="tab-cancel-inventory-internal-manage-2"
                       aria-expanded="false">@lang('app.cancel-inventory-internal-manage.tab2') <span
                                class="label label-warning" id="total-record-bar">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-cancel-inventory-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory_internal.cancel_inventory.filter')
                            <table class="table"
                                   id="table-kitchen-cancel-inventory-internal-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.cancel-inventory-internal-manage.stt')</th>
                                    <th>@lang('app.cancel-inventory-internal-manage.id')</th>
                                    <th>@lang('app.cancel-inventory-internal-manage.employee')</th>
                                    <th>@lang('app.cancel-inventory-internal-manage.date')</th>
                                    <th>@lang('app.cancel-inventory-internal-manage.material')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-cancel-inventory-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory_internal.cancel_inventory.filter')
                            <table class="table" id="table-bar-cancel-inventory-internal-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.cancel-inventory-internal-manage.stt')</th>
                                    <th>@lang('app.cancel-inventory-internal-manage.id')</th>
                                    <th>@lang('app.cancel-inventory-internal-manage.employee')</th>
                                    <th>@lang('app.cancel-inventory-internal-manage.date')</th>
                                    <th>@lang('app.cancel-inventory-internal-manage.material')</th>
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
    @include('manage.inventory_internal.cancel_inventory.create')
    @include('manage.inventory_internal.cancel_inventory.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory_internal/cancel_inventory/index.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
