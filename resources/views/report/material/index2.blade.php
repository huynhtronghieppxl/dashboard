@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block">
                <div class="row">
                    <div class="col-lg-8">
                        <ul class="nav nav-tabs md-tabs" id="tabs-form-material" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab1-material-report"
                                   role="tab" aria-expanded="true">@lang('app.material-report.tab1') <span
                                            class="label label-success" id="total-record-material">0</span></a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-type="2" data-toggle="tab" href="#tab2-material-report"
                                   role="tab" aria-expanded="false">@lang('app.material-report.tab2') <span
                                            class="label label-warning" id="total-record-goods">0</span></a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" data-type="3" href="#tab3-material-report"
                                   role="tab" aria-expanded="false">@lang('app.material-report.tab3') <span
                                            class="label label-primary"
                                            id="total-record-internal">0</span></a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" data-type="4" href="#tab4-material-report"
                                   role="tab" aria-expanded="false">@lang('app.material-report.tab4') <span
                                            class="label label-inverse" id="total-record-other">0</span></a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 card-block">
                        <label class="input-group m-auto">
                            <input type="text" id="from-date-material-report" data-validate="search"
                                   class="input-sm form-control text-center input-datetimepicker p-1"
                                   name="start" value="1/{{date('m/Y')}}">
                            <span class="input-group-addon">@lang('app.component.button.to')</span>
                            <input type="text" id="to-date-material-report" data-validate="search"
                                   class="input-sm form-control text-center input-datetimepicker"
                                   name="end" value="{{date('d/m/Y')}}">
                            <button class="input-group-addon cursor-pointer" style="outline: none!important;"
                                    id="search-btn-material-report"><i
                                        class="fa fa-search p-r-0px"></i></button>
                        </label>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-material-report" role="tabpanel">
                        <div class="">
                            <table class="table table-bordered" id="table-material-material-report">
                                <thead>
                                <tr>
                                    <th class="text-center fixed-column-table"
                                        rowspan="3">@lang('app.material-report.stt')</th>
                                    <th class="text-center fixed-column-table"
                                        rowspan="3">@lang('app.material-report.name')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="3">@lang('app.material-report.type')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="3">@lang('app.material-report.unit')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.before')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="4">@lang('app.material-report.import')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="12">@lang('app.material-report.export')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.return')
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.cancel')
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.wastage-allow')
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.after')
                                    <th
                                        colspan="4">@lang('app.material-report.note')
                                </tr>
                                <tr>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.branch')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.supplier')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.branch')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.kitchen')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.bar')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.employee')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.inner')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.other')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.note-kitchen')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.note-bar')</th>
                                </tr>
                                <tr>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="fixed-column-table">@lang('app.material-report.total')</th>
                                    <th class="border-right-column-table"></th>
                                    <th class="border-right-column-table"></th>
                                    <th id="total-quantity-before-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-before-material">0
                                    </th>
                                    <th id="total-quantity-import-branch-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-branch-material">0
                                    </th>
                                    <th id="total-quantity-import-supplier-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-supplier-material">0
                                    </th>
                                    <th id="total-quantity-export-branch-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-branch-material">0
                                    </th>
                                    <th id="total-quantity-export-kitchen-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-kitchen-material">0
                                    </th>
                                    <th id="total-quantity-export-bar-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-bar-material">0
                                    </th>
                                    <th id="total-quantity-export-employee-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-employee-material">0
                                    </th>
                                    <th id="total-quantity-export-inner-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-inner-material">0
                                    </th>
                                    <th id="total-quantity-export-other-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-other-material">0
                                    </th>
                                    <th id="total-quantity-return-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-return-material">0
                                    </th>
                                    <th id="total-quantity-cancel-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-cancel-material">0
                                    </th>
                                    <th id="total-quantity-wastage-allow-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-wastage-allow-material">0
                                    </th>
                                    <th id="total-quantity-after-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-after-material">0
                                    </th>
                                    <th id="total-quantity-import-kitchen-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-kitchen-material">0
                                    </th>
                                    <th id="total-quantity-import-bar-material">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-bar-material">0
                                    </th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-material-report" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-goods-material-report">
                                <thead>
                                <tr>
                                    <th
                                        rowspan="3">@lang('app.material-report.stt')</th>
                                    <th
                                        rowspan="3">@lang('app.material-report.name')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="3">@lang('app.material-report.type')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="3">@lang('app.material-report.unit')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.before')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="4">@lang('app.material-report.import')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="12">@lang('app.material-report.export')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.return')
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.cancel')
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.wastage-allow')
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.after')
                                    <th
                                        colspan="4">@lang('app.material-report.note')
                                </tr>
                                <tr>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.branch')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.supplier')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.branch')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.kitchen')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.bar')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.employee')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.inner')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.other')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.note-kitchen')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.note-bar')</th>
                                </tr>
                                <tr>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                </tr>
                                <tr>
                                    <th colspan="2">@lang('app.material-report.total')</th>
                                    <th></th>
                                    <th></th>
                                    <th id="total-quantity-before-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-before-goods">0
                                    </th>
                                    <th id="total-quantity-import-branch-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-branch-goods">0
                                    </th>
                                    <th id="total-quantity-import-supplier-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-supplier-goods">0
                                    </th>
                                    <th id="total-quantity-export-branch-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-branch-goods">0
                                    </th>
                                    <th id="total-quantity-export-kitchen-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-kitchen-goods">0
                                    </th>
                                    <th id="total-quantity-export-bar-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-bar-goods">0
                                    </th>
                                    <th id="total-quantity-export-employee-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-employee-goods">0
                                    </th>
                                    <th id="total-quantity-export-inner-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-inner-goods">0
                                    </th>
                                    <th id="total-quantity-export-other-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-other-goods">0
                                    </th>
                                    <th id="total-quantity-return-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-return-goods">0
                                    </th>
                                    <th id="total-quantity-cancel-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-cancel-goods">0
                                    </th>
                                    <th id="total-quantity-wastage-allow-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-wastage-allow-goods">0
                                    </th>
                                    <th id="total-quantity-after-goods">0</th>
                                    <th class="text-center border-right-column-table" id="total-amount-after-goods">
                                        0
                                    </th>
                                    <th id="total-quantity-import-kitchen-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-kitchen-goods">0
                                    </th>
                                    <th id="total-quantity-import-bar-goods">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-bar-goods">0
                                    </th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-material-report" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-internal-material-report">
                                <thead>
                                <tr>
                                    <th
                                        rowspan="3">@lang('app.material-report.stt')</th>
                                    <th
                                        rowspan="3">@lang('app.material-report.name')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="3">@lang('app.material-report.type')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="3">@lang('app.material-report.unit')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.before')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="4">@lang('app.material-report.import')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="12">@lang('app.material-report.export')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.return')
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.cancel')
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.wastage-allow')
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.after')
                                    <th
                                        colspan="4">@lang('app.material-report.note')
                                </tr>
                                <tr>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.branch')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.supplier')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.branch')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.kitchen')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.bar')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.employee')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.inner')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.other')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.note-kitchen')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.note-bar')</th>
                                </tr>
                                <tr>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                </tr>
                                <tr>
                                    <th colspan="2">@lang('app.material-report.total')</th>
                                    <th></th>
                                    <th></th>
                                    <th id="total-quantity-before-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-before-internal">0
                                    </th>
                                    <th id="total-quantity-import-branch-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-branch-internal">0
                                    </th>
                                    <th id="total-quantity-import-supplier-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-supplier-internal">0
                                    </th>
                                    <th id="total-quantity-export-branch-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-branch-internal">0
                                    </th>
                                    <th id="total-quantity-export-kitchen-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-kitchen-internal">0
                                    </th>
                                    <th id="total-quantity-export-bar-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-bar-internal">0
                                    </th>
                                    <th id="total-quantity-export-employee-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-employee-internal">0
                                    </th>
                                    <th id="total-quantity-export-inner-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-inner-internal">0
                                    </th>
                                    <th id="total-quantity-export-other-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-other-internal">0
                                    </th>
                                    <th id="total-quantity-return-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-return-internal">0
                                    </th>
                                    <th id="total-quantity-cancel-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-cancel-internal">0
                                    </th>
                                    <th id="total-quantity-wastage-allow-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-wastage-allow-internal">0
                                    </th>
                                    <th id="total-quantity-after-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-after-internal">0
                                    </th>
                                    <th id="total-quantity-import-kitchen-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-kitchen-internal">0
                                    </th>
                                    <th id="total-quantity-import-bar-internal">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-bar-internal">0
                                    </th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-material-report" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-other-material-report">
                                <thead>
                                <tr>
                                    <th
                                        rowspan="3">@lang('app.material-report.stt')</th>
                                    <th
                                        rowspan="3">@lang('app.material-report.name')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="3">@lang('app.material-report.type')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="3">@lang('app.material-report.unit')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.before')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="4">@lang('app.material-report.import')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="12">@lang('app.material-report.export')</th>
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.return')
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.cancel')
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.wastage-allow')
                                    <th class="text-center border-right-column-table"
                                        rowspan="2" colspan="2">@lang('app.material-report.after')
                                    <th
                                        colspan="4">@lang('app.material-report.note')
                                </tr>
                                <tr>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.branch')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.supplier')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.branch')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.kitchen')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.bar')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.employee')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.inner')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.other')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.note-kitchen')</th>
                                    <th class="text-center border-right-column-table"
                                        colspan="2">@lang('app.material-report.note-bar')</th>
                                </tr>
                                <tr>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                    <th>@lang('app.material-report.quantity')</th>
                                    <th class="text-center border-right-column-table">@lang('app.material-report.value')</th>
                                </tr>
                                <tr>
                                    <th colspan="2">@lang('app.material-report.total')</th>
                                    <th></th>
                                    <th></th>
                                    <th id="total-quantity-before-other">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-before-other">0
                                    </th>
                                    <th id="total-quantity-import-branch-other">0
                                    </th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-branch-other">0
                                    </th>
                                    <th id="total-quantity-import-supplier-other">0
                                    </th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-supplier-other">0
                                    </th>
                                    <th id="total-quantity-export-branch-other">0
                                    </th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-branch-other">0
                                    </th>
                                    <th id="total-quantity-export-kitchen-other">0
                                    </th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-kitchen-other">0
                                    </th>
                                    <th id="total-quantity-export-bar-other">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-bar-other">0
                                    </th>
                                    <th id="total-quantity-export-employee-other">0
                                    </th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-employee-other">0
                                    </th>
                                    <th id="total-quantity-export-inner-other">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-inner-other">0
                                    </th>
                                    <th id="total-quantity-export-other-other">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-export-other-other">0
                                    </th>
                                    <th id="total-quantity-return-other">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-return-other">0
                                    </th>
                                    <th id="total-quantity-cancel-other">0</th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-cancel-other">0
                                    </th>
                                    <th id="total-quantity-wastage-allow-other">0
                                    </th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-wastage-allow-other">0
                                    </th>
                                    <th id="total-quantity-after-other">0</th>
                                    <th class="text-center border-right-column-table" id="total-amount-after-other">
                                        0
                                    </th>
                                    <th id="total-quantity-import-kitchen-other">0
                                    </th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-import-kitchen-other">0
                                    </th>
                                    <th id="total-quantity-import-bar-other">0
                                    </th>
                                    <th class="text-center border-right-column-table"
                                        id="total-amount-bar-supplier-other">0
                                    </th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-body end -->
    </div>
@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript"
            src="{{ asset('..\js\report\material\index2.js?version=')}}"></script>
@endpush
