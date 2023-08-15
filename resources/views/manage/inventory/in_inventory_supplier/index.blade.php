@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-in-inventory-supplier">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab1-in-inventory-supplier"
                       data-id="1"
                       role="tab" onclick="changeActiveTabMaterialData(1)"
                       id="tab-in-inventory-supplier-1"
                       aria-expanded="true">@lang('app.in-inventory-supplier.tab1') <span
                                class="label label-success" id="total-record-material">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2-in-inventory-supplier"
                       data-id="2"
                       role="tab" onclick="changeActiveTabMaterialData(2)"
                       id="tab-in-inventory-supplier-2"
                       aria-expanded="false">@lang('app.in-inventory-supplier.tab2') <span
                                class="label label-warning" id="total-record-goods">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab3-in-inventory-supplier"
                       data-id="3"
                       role="tab" onclick="changeActiveTabMaterialData(3)"
                       id="tab-in-inventory-supplier-3"
                       aria-expanded="false">@lang('app.in-inventory-supplier.tab3') <span
                                class="label label-primary"
                                id="total-record-material-internal">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab4-in-inventory-supplier"
                       data-id="12"
                       role="tab" onclick="changeActiveTabMaterialData(12)"
                       id="tab-in-inventory-supplier-12"
                       aria-expanded="false">@lang('app.in-inventory-supplier.tab4') <span
                                class="label label-inverse" id="total-record-other">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-in-inventory-supplier" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.in_inventory_supplier.filter')
                            <table class="table" id="table-material-in-inventory-supplier">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.stt')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.id')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.employee')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.supplier')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.date')</th>
                                    <th class="text-right">
                                        <div class="row m-0 p-0">
                                            <div class="col-lg-12 ml-3">@lang('app.in-inventory-supplier.amount')
                                                <label class="mb-0 ml-auto">
                                                    <div class="tool-box">
                                                        <div data-toolbar="user-options">
                                                            <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                               data-toggle="tooltip" data-placement="top"
                                                               data-original-title="@lang('app.supplier-order.amount-des')"></i>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </th>
                                    <th class="text-right">@lang('app.in-inventory-supplier.discount')</th>
                                    <th class="text-right">@lang('app.in-inventory-supplier.vat')</th>
                                    <th class="text-right">
                                        <div class="row m-0 p-0">
                                            <div class="col-lg-12 ml-3">@lang('app.in-inventory-supplier.total')
                                                <label class="mb-0 ml-auto">
                                                    <div class="tool-box">
                                                        <div data-toolbar="user-options">
                                                            <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                               data-toggle="tooltip" data-placement="top"
                                                               data-original-title="@lang('app.supplier-order.total-amount-des')"></i>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.status')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th class="seemt-fz-14" id="amount-material-in-inventory-supplier">0</th>
                                    <th class="seemt-fz-14" id="discount-material-in-inventory-supplier">0</th>
                                    <th class="seemt-fz-14" id="vat-material-in-inventory-supplier">0</th>
                                    <th class="seemt-fz-14" id="total-material-in-inventory-supplier">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-in-inventory-supplier" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.in_inventory_supplier.filter')
                            <table class="table" id="table-goods-in-inventory-supplier">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.stt')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.id')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.employee')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.supplier')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.date')</th>
                                    <th class="text-right">
                                        <div class="row m-0 p-0">
                                            <div class="col-lg-12 ml-3">@lang('app.in-inventory-supplier.amount')
                                                <label class="mb-0 ml-auto">
                                                    <div class="tool-box">
                                                        <div data-toolbar="user-options">
                                                            <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                               data-toggle="tooltip" data-placement="top"
                                                               data-original-title="@lang('app.supplier-order.amount-des')"></i>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </th>
                                    <th class="text-right">@lang('app.in-inventory-supplier.discount')</th>
                                    <th class="text-right">@lang('app.in-inventory-supplier.vat')</th>
                                    <th class="text-right">
                                        <div class="row m-0 p-0">
                                            <div class="col-lg-12 ml-3">@lang('app.in-inventory-supplier.total')
                                                <label class="mb-0 ml-auto">
                                                    <div class="tool-box">
                                                        <div data-toolbar="user-options">
                                                            <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                               data-toggle="tooltip" data-placement="top"
                                                               data-original-title="@lang('app.supplier-order.total-amount-des')"></i>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </th>
                                    <th
                                            rowspan="2">@lang('app.in-inventory-supplier.status')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th class="seemt-fz-14" id="amount-goods-in-inventory-supplier">0</th>
                                    <th class="seemt-fz-14" id="discount-goods-in-inventory-supplier">0</th>
                                    <th class="seemt-fz-14" id="vat-goods-in-inventory-supplier">0</th>
                                    <th class="seemt-fz-14" id="total-goods-in-inventory-supplier">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-in-inventory-supplier" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.in_inventory_supplier.filter')
                            <table class="table" id="table-internal-in-inventory-supplier">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.stt')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.id')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.employee')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.supplier')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.date')</th>
                                    <th class="text-right">
                                        <div class="row m-0 p-0">
                                            <div class="col-lg-12 ml-3">@lang('app.in-inventory-supplier.amount')
                                                <label class="mb-0 ml-auto">
                                                    <div class="tool-box">
                                                        <div data-toolbar="user-options">
                                                            <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                               data-toggle="tooltip" data-placement="top"
                                                               data-original-title="@lang('app.supplier-order.amount-des')"></i>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </th>
                                    <th class="text-right">@lang('app.in-inventory-supplier.discount')</th>
                                    <th class="text-right">@lang('app.in-inventory-supplier.vat')</th>
                                    <th class="text-right">
                                        <div class="row m-0 p-0">
                                            <div class="col-lg-12 ml-3">@lang('app.in-inventory-supplier.total')
                                                <label class="mb-0 ml-auto">
                                                    <div class="tool-box">
                                                        <div data-toolbar="user-options">
                                                            <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                               data-toggle="tooltip" data-placement="top"
                                                               data-original-title="@lang('app.supplier-order.total-amount-des')"></i>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.status')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th class="seemt-fz-14" id="amount-internal-in-inventory-supplier">0</th>
                                    <th class="seemt-fz-14" id="discount-internal-in-inventory-supplier">0</th>
                                    <th class="seemt-fz-14" id="vat-internal-in-inventory-supplier">0</th>
                                    <th class="seemt-fz-14" id="total-internal-in-inventory-supplier">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-in-inventory-supplier" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('manage.inventory.in_inventory_supplier.filter')
                            <table class="table" id="table-other-in-inventory-supplier">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.stt')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.id')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.employee')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.supplier')</th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.date')</th>
                                    <th class="text-right">
                                        <div class="row m-0 p-0">
                                            <div class="col-lg-12 ml-3">@lang('app.in-inventory-supplier.amount')
                                                <label class="mb-0 ml-auto">
                                                    <div class="tool-box">
                                                        <div data-toolbar="user-options">
                                                            <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                               data-toggle="tooltip" data-placement="top"
                                                               data-original-title="@lang('app.supplier-order.amount-des')"></i>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </th>
                                    <th class="text-right">@lang('app.in-inventory-supplier.discount')</th>
                                    <th class="text-right">@lang('app.in-inventory-supplier.vat')</th>
                                    <th class="text-right">
                                        <div class="row m-0 p-0">
                                            <div class="col-lg-12 ml-3">@lang('app.in-inventory-supplier.total')
                                                <label class="mb-0 ml-auto">
                                                    <div class="tool-box">
                                                        <div data-toolbar="user-options">
                                                            <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                               data-toggle="tooltip" data-placement="top"
                                                               data-original-title="@lang('app.supplier-order.total-amount-des')"></i>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </th>
                                    <th rowspan="2">@lang('app.in-inventory-supplier.status')</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th class="seemt-fz-14" id="amount-other-in-inventory-supplier">0</th>
                                    <th class="seemt-fz-14" id="discount-other-in-inventory-supplier">0</th>
                                    <th class="seemt-fz-14" id="vat-other-in-inventory-supplier">0</th>
                                    <th class="seemt-fz-14" id="total-other-in-inventory-supplier">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.inventory.in_inventory_supplier.detail')
    @include('manage.employee.info')
@endsection
@push('scripts')
    @include('layouts.datatable')
    <script type="text/javascript"
            src="{{asset('/js/template_custom/dataTable.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/in_inventory_supplier/index.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
