@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body" id="div-out-inventory-branch-manage">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tab-out-inventory-branch">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab0-out-inventory-internal-manage"
                       onclick="changeActiveTabOutInventoryInternalManage(0)"
                       data-id="0"
                       role="tab"
                       aria-expanded="true">@lang('app.out-inventory-branch-manage.tab0') <span
                                class="label label-success" id="total-record-waiting">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab1-out-inventory-internal-manage"
                       onclick="changeActiveTabOutInventoryInternalManage(1)"
                       data-id="1"
                       role="tab"
                       aria-expanded="true">@lang('app.out-inventory-branch-manage.tab1') <span
                                class="label label-success" id="total-record-material">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2-out-inventory-internal-manage"
                       onclick="changeActiveTabOutInventoryInternalManage(2)"
                       data-id="2"
                       role="tab"
                       aria-expanded="false">@lang('app.out-inventory-internal-manage.tab2') <span
                                class="label label-warning" id="total-record-goods">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab3-out-inventory-internal-manage"
                       onclick="changeActiveTabOutInventoryInternalManage(3)"
                       data-id="3"
                       role="tab"
                       aria-expanded="false">@lang('app.out-inventory-internal-manage.tab3') <span
                                class="label label-primary" id="total-record-material-internal">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab4-out-inventory-internal-manage"
                       onclick="changeActiveTabOutInventoryInternalManage(4)"
                       data-id="4"
                       role="tab"
                       aria-expanded="false">@lang('app.out-inventory-internal-manage.tab4') <span
                                class="label label-inverse" id="total-record-other">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab5-out-inventory-internal-manage"
                       onclick="changeActiveTabOutInventoryInternalManage(5)"
                       data-id="5"
                       role="tab"
                       aria-expanded="false">@lang('app.out-inventory-internal-manage.tab5') <span
                                class="label label-danger" id="total-record-cancel">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab0-out-inventory-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.out_inventory_branch.filter')
                            <table class="table "
                                   id="table-material-waiting-inventory-internal-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.id')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.target-branch')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.date')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.material')</th>
                                    <th class="text-right">@lang('app.out-inventory-internal-manage.detail.total')</th>
                                    <th rowspan="2"></th>
                                    <th rowspan="2" class="d-none"></th>
                                </tr>
                                <tr>
                                    <th id="total-amount-waiting-confirm-out-inventory-branch" class="seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab1-out-inventory-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.out_inventory_branch.filter')
                            <table class="table "
                                   id="table-material-out-inventory-internal-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.id')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.target-branch')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.date')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.material')</th>
                                    <th class="text-right">@lang('app.out-inventory-internal-manage.detail.total')</th>
                                    <th rowspan="2"></th>
                                    <th rowspan="2" class="d-none"></th>
                                </tr>
                                <tr>
                                    <th id="total-amount-material-out-inventory-branch" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-out-inventory-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.out_inventory_branch.filter')
                            <table class="table "
                                   id="table-goods-out-inventory-internal-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.id')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.target-branch')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.date')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.material')</th>
                                    <th class="text-right">@lang('app.out-inventory-internal-manage.detail.total')</th>
                                    <th rowspan="2"></th>
                                    <th rowspan="2" class="d-none"></th>
                                </tr>
                                <tr>
                                    <th id="total-amount-goods-out-inventory-branch" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-out-inventory-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.out_inventory_branch.filter')
                            <table class="table "
                                   id="table-internal-out-inventory-internal-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.id')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.target-branch')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.date')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.material')</th>
                                    <th class="text-right">@lang('app.out-inventory-internal-manage.detail.total')</th>
                                    <th rowspan="2"></th>
                                    <th rowspan="2" class="d-none"></th>
                                </tr>
                                <tr>
                                    <th id="total-amount-internal-out-inventory-branch" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-out-inventory-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.out_inventory_branch.filter')
                            <table class="table "
                                   id="table-other-out-inventory-internal-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.id')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.target-branch')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.date')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.material')</th>
                                    <th class="text-right">@lang('app.out-inventory-internal-manage.detail.total')</th>
                                    <th rowspan="2"></th>
                                    <th rowspan="2" class="d-none"></th>
                                </tr>
                                <tr>
                                    <th id="total-amount-other-out-inventory-branch" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab5-out-inventory-internal-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.out_inventory_branch.filter')
                            <table class="table "
                                   id="table-cancel-out-inventory-internal-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.stt')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.id')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.employee')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.target-branch')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.date')</th>
                                    <th rowspan="2">@lang('app.out-inventory-internal-manage.material')</th>
                                    <th class="text-right">@lang('app.out-inventory-internal-manage.detail.total')</th>
                                    <th rowspan="2"></th>
                                    <th rowspan="2" class="d-none"></th>
                                </tr>
                                <tr>
                                    <th id="total-amount-other-cancel-out-inventory-branch" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.inventory.out_inventory_branch.create')
    @include('manage.inventory.out_inventory_branch.update')
    @include('manage.inventory.out_inventory_branch.detail')
    @include('manage.employee.info')

@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/out_inventory_branch/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
