@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tab-in-inventory-branch">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       onclick="changeActiveTabMaterialData(4)"
                       data-id="4"
                       href="#tab5-in-inventory-branch-manage"
                       role="tab"
                       aria-expanded="true">@lang('app.in-inventory-branch-manage.tab5') <span
                                class="label label-warning" id="total-record-waiting">0</span></a>
                    <div class="slide slide-6"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       onclick="changeActiveTabMaterialData(1)"
                       data-id="1"
                       href="#tab1-in-inventory-branch-manage"
                       role="tab"
                       aria-expanded="false">@lang('app.in-inventory-branch-manage.tab1') <span
                                class="label label-success" id="total-record-material">0</span></a>
                    <div class="slide slide-6"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2-in-inventory-branch-manage"
                       onclick="changeActiveTabMaterialData(2)"
                       data-id="2"
                       role="tab"
                       aria-expanded="false">@lang('app.in-inventory-branch-manage.tab2') <span
                                class="label label-warning" id="total-record-goods">0</span></a>
                    <div class="slide slide-6"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab3-in-inventory-branch-manage"
                       onclick="changeActiveTabMaterialData(3)"
                       data-id="3"
                       role="tab"
                       aria-expanded="false">@lang('app.in-inventory-branch-manage.tab3') <span
                                class="label label-primary" id="total-record-material-internal">0</span></a>
                    <div class="slide slide-6"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab4-in-inventory-branch-manage"
                       onclick="changeActiveTabMaterialData(12)"
                       data-id="12"
                       role="tab"
                       aria-expanded="false">@lang('app.in-inventory-branch-manage.tab4') <span
                                class="label label-inverse" id="total-record-other">0</span></a>
                    <div class="slide slide-6"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab6-in-inventory-branch-manage"
                       onclick="changeActiveTabMaterialData(5)"
                       data-id="5"
                       role="tab"
                       aria-expanded="false">@lang('app.in-inventory-branch-manage.tab6') <span
                                class="label label-danger" id="total-record-cancel">0</span></a>
                    <div class="slide slide-6"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab5-in-inventory-branch-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.in_inventory_branch.filter')
                            <table class="table "
                                   id="table-waiting-in-inventory-branch-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.stt')</th>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.id')</th>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.employee')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.branch')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.date-create')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.material')</th>
                                    <th class="text-right">@lang('app.in-inventory-branch-manage.total')</th>
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
                    <div class="tab-pane " id="tab1-in-inventory-branch-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.in_inventory_branch.filter')
                            <table class="table "
                                   id="table-material-in-inventory-branch-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.stt')</th>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.id')</th>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.employee')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.branch')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.date')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.material')</th>
                                    <th class="text-right">@lang('app.in-inventory-branch-manage.total')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th
                                            id="total-material-in-inventory-branch-manage" class="seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-in-inventory-branch-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.in_inventory_branch.filter')
                            <table class="table "
                                   id="table-goods-in-inventory-branch-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.stt')</th>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.id')</th>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.employee')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.branch')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.date')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.material')</th>
                                    <th class="text-right">@lang('app.in-inventory-branch-manage.total')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th
                                            id="total-goods-in-inventory-branch-manage" class="seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-in-inventory-branch-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.in_inventory_branch.filter')
                            <table class="table "
                                   id="table-internal-in-inventory-branch-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.stt')</th>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.id')</th>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.employee')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.branch')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.date')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.material')</th>
                                    <th class="text-right">@lang('app.in-inventory-branch-manage.total')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th
                                            id="total-internal-in-inventory-branch-manage" class="seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-in-inventory-branch-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.in_inventory_branch.filter')
                            <table class="table "
                                   id="table-other-in-inventory-branch-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.stt')</th>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.id')</th>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.employee')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.branch')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.date')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.material')</th>
                                    <th class="text-right">@lang('app.in-inventory-branch-manage.total')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th
                                            id="total-other-in-inventory-branch-manage" class="seemt-fz-14">0
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab6-in-inventory-branch-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.in_inventory_branch.filter')
                            <table class="table "
                                   id="table-cancel-in-inventory-branch-manage">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.stt')</th>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.id')</th>
                                    <th rowspan="2">@lang('app.in-inventory-branch-manage.employee')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.branch')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.date-cancel')</th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-branch-manage.material')</th>
                                    <th class="text-right">@lang('app.in-inventory-branch-manage.total')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th
                                            id="total-cancel-in-inventory-branch-manage" class="seemt-fz-14">0
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
    @include('manage.inventory.in_inventory_branch.detail')
    @include('manage.employee.info')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/in_inventory_branch/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
