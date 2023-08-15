@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="tab-change-cancel-inventory-manage">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       data-id="0"
                       href="#tab1-cancel-inventory-manage"
                       onclick="changeActiveTabCancelInventoryInternalManage(0)"
                       role="tab"
                       aria-expanded="true">@lang('app.cancel-inventory-manage.tab1') <span
                                class="label label-success" id="total-record-material">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2-cancel-inventory-manage"
                       onclick="changeActiveTabCancelInventoryInternalManage(1)"
                       role="tab"
                       data-id="1"
                       aria-expanded="false">@lang('app.cancel-inventory-manage.tab2') <span
                                class="label label-warning" id="total-record-goods">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab3-cancel-inventory-manage"
                       onclick="changeActiveTabCancelInventoryInternalManage(2)"
                       role="tab"
                       data-id="2"
                       aria-expanded="false">@lang('app.cancel-inventory-manage.tab3') <span
                                class="label label-primary" id="total-record-material-internal">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab4-cancel-inventory-manage"
                       onclick="changeActiveTabCancelInventoryInternalManage(3)"
                       role="tab"
                       data-id="3"
                       aria-expanded="false">@lang('app.cancel-inventory-manage.tab4') <span
                                class="label label-inverse" id="total-record-other">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-cancel-inventory-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.cancel_inventory.filter')
                            <table class="table"
                                   id="table-material-cancel-inventory-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.cancel-inventory-manage.stt')</th>
                                    <th>@lang('app.cancel-inventory-manage.id')</th>
                                    <th>@lang('app.cancel-inventory-manage.employee')</th>
                                    <th>@lang('app.cancel-inventory-manage.date')</th>
                                    <th>@lang('app.cancel-inventory-manage.material')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-cancel-inventory-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.cancel_inventory.filter')
                            <table class="table"
                                   id="table-goods-cancel-inventory-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.cancel-inventory-manage.stt')</th>
                                    <th>@lang('app.cancel-inventory-manage.id')</th>
                                    <th>@lang('app.cancel-inventory-manage.employee')</th>
                                    <th>@lang('app.cancel-inventory-manage.date')</th>
                                    <th>@lang('app.cancel-inventory-manage.material')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-cancel-inventory-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.cancel_inventory.filter')
                            <table class="table"
                                   id="table-internal-cancel-inventory-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.cancel-inventory-manage.stt')</th>
                                    <th>@lang('app.cancel-inventory-manage.id')</th>
                                    <th>@lang('app.cancel-inventory-manage.employee')</th>
                                    <th>@lang('app.cancel-inventory-manage.date')</th>
                                    <th>@lang('app.cancel-inventory-manage.material')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-cancel-inventory-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.cancel_inventory.filter')
                            <table class="table"
                                   id="table-other-cancel-inventory-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.cancel-inventory-manage.stt')</th>
                                    <th>@lang('app.cancel-inventory-manage.id')</th>
                                    <th>@lang('app.cancel-inventory-manage.employee')</th>
                                    <th>@lang('app.cancel-inventory-manage.date')</th>
                                    <th>@lang('app.cancel-inventory-manage.material')</th>
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
    @include('manage.inventory.cancel_inventory.create')
    @include('manage.inventory.cancel_inventory.detail')

@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/cancel_inventory/index.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
