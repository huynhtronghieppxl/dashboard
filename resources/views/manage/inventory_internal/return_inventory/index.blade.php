@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body" id="div-cancel-inventory-internal-manage">
            <ul class="nav nav-tabs md-tabs md-5-tabs" role="tablist"
                id="nav-tab-return-inventory-internal-manage">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab1-return-inventory-internal-manage"
                       data-id="1"
                       role="tab"
                       id="tab-return-inventory-internal-manage-1"
                       aria-expanded="true">@lang('app.return-inventory-internal-manage.tab1') <span
                                class="label label-success" id="total-record-kitchen">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2-return-inventory-internal-manage"
                       role="tab"
                       data-id="2"
                       id="tab-return-inventory-internal-manage-2"
                       aria-expanded="false">@lang('app.return-inventory-internal-manage.tab2') <span
                                class="label label-warning" id="total-record-bar">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab3-return-inventory-internal-manage"
                       data-id="3"
                       role="tab"
                       id="tab-return-inventory-internal-manage-3"
                       aria-expanded="true">@lang('app.return-inventory-internal-manage.tab3') <span
                                class="label label-primary" id="total-record-business-employee">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab4-return-inventory-internal-manage"
                       role="tab"
                       data-id="4"
                       id="tab-return-inventory-internal-manage-4"
                       aria-expanded="false">@lang('app.return-inventory-internal-manage.tab4') <span
                                class="label label-inverse" id="total-record-food-employee">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-return-inventory-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory_internal.return_inventory.filter')
                            <table class="table"
                                   id="table-kitchen-return-inventory-internal-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.return-inventory-internal-manage.stt')</th>
                                    <th>Mã Phiếu</th>
                                    <th>@lang('app.return-inventory-internal-manage.employee')</th>
                                    <th>@lang('app.return-inventory-internal-manage.date')</th>
                                    <th>@lang('app.return-inventory-internal-manage.material')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-return-inventory-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory_internal.return_inventory.filter')
                            <table class="table" id="table-bar-return-inventory-internal-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.return-inventory-internal-manage.stt')</th>
                                    <th>Mã Phiếu</th>
                                    <th>@lang('app.return-inventory-internal-manage.employee')</th>
                                    <th>@lang('app.return-inventory-internal-manage.date')</th>
                                    <th>@lang('app.return-inventory-internal-manage.material')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-return-inventory-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory_internal.return_inventory.filter')
                            <table class="table" id="table-business-employee-return-inventory-internal-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.return-inventory-internal-manage.stt')</th>
                                    <th>Mã Phiếu</th>
                                    <th>@lang('app.return-inventory-internal-manage.employee')</th>
                                    <th>@lang('app.return-inventory-internal-manage.date')</th>
                                    <th>@lang('app.return-inventory-internal-manage.material')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-return-inventory-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory_internal.return_inventory.filter')
                            <table class="table" id="table-employee-food-return-inventory-internal-manage">
                                <thead>
                                <tr>
                                    <th>@lang('app.return-inventory-internal-manage.stt')</th>
                                    <th>Mã Phiếu</th>
                                    <th>@lang('app.return-inventory-internal-manage.employee')</th>
                                    <th>@lang('app.return-inventory-internal-manage.date')</th>
                                    <th>@lang('app.return-inventory-internal-manage.material')</th>
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
    @include('manage.inventory_internal.return_inventory.create')
    @include('manage.inventory_internal.return_inventory.detail')
    @include('manage.employee.info')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory_internal/return_inventory/index.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
