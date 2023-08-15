@extends('layouts.layout')
@section('content')
    <div class="page-body">
        <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tab-in-inventory-internal-manage">
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab1-in-inventory-internal-manage"
                   role="tab" onclick="changeActiveTabData(1)" data-id="1" id="tab-in-inventory-internal-manage-1"
                   aria-expanded="true">@lang('app.in-inventory-internal-manage.tab1') <span
                            class="label label-success" id="total-record-kitchen">0</span></a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab2-in-inventory-internal-manage"
                   role="tab" onclick="changeActiveTabData(2)" data-id="2" id="tab-in-inventory-internal-manage-2"
                   aria-expanded="false">@lang('app.in-inventory-internal-manage.tab2') <span
                            class="label label-warning" id="total-record-bar">0</span></a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab3-in-inventory-internal-manage"
                   role="tab" onclick="changeActiveTabData(3)" data-id="3" id="tab-in-inventory-internal-manage-3"
                   aria-expanded="false">@lang('app.in-inventory-internal-manage.tab3') <span
                            class="label label-primary" id="total-record-employee">0</span></a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab4-in-inventory-internal-manage"
                   role="tab" onclick="changeActiveTabData(4)" data-id="4" id="tab-in-inventory-internal-manage-12"
                   aria-expanded="false">@lang('app.in-inventory-internal-manage.tab4') <span
                            class="label label-inverse" id="total-record-internal">0</span></a>
                <div class="slide"></div>
            </li>
            {{--                <li class="nav-item">--}}
            {{--                    <a class="nav-link" data-toggle="tab" href="#tab5-in-inventory-internal-manage"--}}
            {{--                       id="tab-canecel-nav-in-inventory-internal-manage" role="tab" data-id="0" onclick="changeActiveTabData(0)"--}}
            {{--                       aria-expanded="false">@lang('app.in-inventory-internal-manage.tab5') <span--}}
            {{--                            class="label label-danger" id="total-record-other">0</span></a>--}}
            {{--                    <div class="slide"></div>--}}
            {{--                </li>--}}
        </ul>
        <div class="card card-block">
            <div class="tab-content">
                <div class="tab-pane active" id="tab1-in-inventory-internal-manage" role="tabpanel">
                    <div class="table-responsive new-table">
                        @include('manage.inventory_internal.in_inventory.filter')
                        <table class="table" id="table-kitchen-in-inventory-internal-manage">
                            <thead>
                            <tr>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.stt')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.code')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.employee')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.date')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.material')</th>
                                <th class="text-right">@lang('app.in-inventory-internal-manage.total-amount')</th>
                                <th rowspan="2"></th>
                                <th rowspan="2" class="d-none"></th>
                            </tr>
                            <tr>
                                <th id="total-amount-kitchen-in-inventory-internal-manage" class="seemt-fz-14"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab2-in-inventory-internal-manage" role="tabpanel">
                    <div class="table-responsive new-table">
                        @include('manage.inventory_internal.in_inventory.filter')
                        <table class="table" id="table-bar-in-inventory-internal-manage">
                            <thead>
                            <tr>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.stt')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.code')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.employee')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.date')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.material')</th>
                                <th class="text-right">@lang('app.in-inventory-internal-manage.total-amount')</th>
                                <th rowspan="2"></th>
                                <th rowspan="2" class="d-none"></th>
                            </tr>
                            <tr>
                                <th id="total-amount-bar-in-inventory-internal-manage" class="seemt-fz-14"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab3-in-inventory-internal-manage" role="tabpanel">
                    <div class="table-responsive new-table">
                        @include('manage.inventory_internal.in_inventory.filter')
                        <table class="table"
                               id="table-employee-in-inventory-internal-manage">
                            <thead>
                            <tr>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.stt')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.code')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.employee')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.date')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.material')</th>
                                <th class="text-right">@lang('app.in-inventory-internal-manage.total-amount')</th>
                                <th rowspan="2"></th>
                                <th rowspan="2" class="d-none"></th>
                            </tr>
                            <tr>
                                <th id="total-amount-employee-sale-in-inventory-internal-manage"
                                    class="seemt-fz-14"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab4-in-inventory-internal-manage" role="tabpanel">
                    <div class="table-responsive new-table">
                        @include('manage.inventory_internal.in_inventory.filter')
                        <table class="table" id="table-food-in-inventory-internal-manage">
                            <thead>
                            <tr>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.stt')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.code')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.employee')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.date')</th>
                                <th rowspan="2">@lang('app.in-inventory-internal-manage.material')</th>
                                <th class="text-right">@lang('app.in-inventory-internal-manage.total-amount')</th>
                                <th rowspan="2"></th>
                                <th rowspan="2" class="d-none"></th>
                            </tr>
                            <tr>
                                <th id="total-amount-food-in-inventory-internal-manage" class="seemt-fz-14"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.inventory_internal.in_inventory.detail')
    @include('manage.inventory.out_inventory.detail')

@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory_internal/in_inventory/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
