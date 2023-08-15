@extends('layouts.layout')
@section('content')
    <style>
        .border-right-supplier {
            right: 0px !important;
            height: auto !important;
            border-right: 1px solid #e9ecef;
            position: absolute;
            top: 12px !important;
            bottom: 12px !important;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" id="tabs-form-material" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-tab="1" data-toggle="tab" href="#tab1-material-report"
                       role="tab" aria-expanded="true">@lang('app.material-report.tab1') <span
                                class="label label-success" id="total-record-material">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-tab="2" data-toggle="tab" href="#tab2-material-report"
                       role="tab" aria-expanded="false">@lang('app.material-report.tab2') <span
                                class="label label-warning" id="total-record-goods">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-tab="3" href="#tab3-material-report"
                       role="tab" aria-expanded="false">@lang('app.material-report.tab3') <span
                                class="label label-primary"
                                id="total-record-internal">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-tab="4" href="#tab4-material-report"
                       role="tab" aria-expanded="false">@lang('app.material-report.tab4') <span
                                class="label label-inverse" id="total-record-other">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-material-report" role="tabpanel"
                         style="border-right: none!important;">
                        <div class="table-responsive new-table">
                            @include('report.material.filter')
                            <table class="table" id="table-material-material-report">
                                <thead>
                                <tr>
                                    <th rowspan="3">@lang('app.material-report.stt')</th>
                                    <th class="text-left" rowspan=3>@lang('app.material-report.name')</th>
                                    <th class="text-right" rowspan="2">@lang('app.material-report.before')</th>
                                    <th class="text-right" style="position: relative"
                                        colspan="2">@lang('app.material-report.import')
                                        <div class="border-right-supplier"></div>
                                    </th>
                                    <th class="text-right" colspan="5">@lang('app.material-report.export')</th>
                                    <th class="text-right" rowspan="2">@lang('app.material-report.cancel')</th>
                                    <th class="text-right" rowspan="2">@lang('app.material-report.return')</th>
                                    <th class="text-right" rowspan="2">@lang('app.material-report.after')</th>
                                    <th class="text-right" colspan="2">@lang('app.material-report.note')</th>
                                    <th rowspan="3"></th>
                                    <th rowspan="3"></th>
                                </tr>
                                <tr>
                                    <th class="text-right">@lang('app.material-report.branch')</th>
                                    <th class="text-right"
                                        style="position: relative">@lang('app.material-report.supplier')
                                        <div class="border-right-supplier"></div>
                                    </th>
                                    <th class="text-right">@lang('app.material-report.branch')</th>
                                    <th class="text-right">@lang('app.material-report.kitchen')</th>
                                    <th class="text-right">@lang('app.material-report.bar')</th>
                                    <th class="text-right">@lang('app.material-report.employee')</th>
                                    <th class="text-right">@lang('app.material-report.inner')</th>
                                    <th class="text-right">@lang('app.material-report.note-kitchen')</th>
                                    <th class="text-right">@lang('app.material-report.note-bar')</th>
                                </tr>
                                <tr>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-before-material"></label>
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14"
                                               id="total-amount-import-branch-material"></label>
                                    </th>
                                    <th style="position: relative">
                                        <label class="mb-0 seemt-fz-14"
                                               id="total-amount-import-supplier-material"></label>
                                        <div class="border-right-supplier"></div>
                                    </th>
                                    <th><label class="mb-0 seemt-fz-14"
                                               id="total-amount-export-branch-material"></label></th>
                                    <th><label class="mb-0 seemt-fz-14"
                                               id="total-amount-export-kitchen-material"></label></th>
                                    <th><label class="mb-0 seemt-fz-14" id="total-amount-export-bar-material"></label>
                                    </th>
                                    <th><label class="mb-0 seemt-fz-14"
                                               id="total-amount-export-employee-material"></label></th>
                                    <th><label class="mb-0 seemt-fz-14" id="total-amount-export-inner-material"></label>
                                    </th>
                                    <th><label class="mb-0 seemt-fz-14" id="total-amount-cancel-material"></label></th>
                                    <th><label class="mb-0 seemt-fz-14" id="total-amount-return-material"></label></th>
                                    <th><label class="mb-0 seemt-fz-14" id="total-amount-after-material"></label></th>
                                    <th><label class="mb-0 seemt-fz-14"
                                               id="total-amount-import-kitchen-material"></label></th>
                                    <th><label class="mb-0 seemt-fz-14" id="total-amount-import-bar-material"></label>
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-material-report" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('report.material.filter')
                            <table class="table" id="table-goods-material-report">
                                <thead>
                                <tr>
                                    <th rowspan="3">@lang('app.material-report.stt')</th>
                                    <th class="text-left" rowspan="3">@lang('app.material-report.name')</th>
                                    <th class="text-right" rowspan="2">@lang('app.material-report.before')</th>
                                    <th class="text-right" style="position: relative"
                                        colspan="2">@lang('app.material-report.import')
                                        <div class="border-right-supplier"></div>
                                    </th>
                                    <th class="text-right" colspan="5">@lang('app.material-report.export')</th>
                                    <th class="text-right" rowspan="2">@lang('app.material-report.cancel')</th>
                                    <th class="text-right" rowspan="2">@lang('app.material-report.return')</th>
                                    <th class="text-right" rowspan="2">@lang('app.material-report.after')</th>
                                    <th class="text-right" colspan="2">@lang('app.material-report.note')</th>
                                    <th rowspan="3"></th>
                                    <th rowspan="3"></th>
                                </tr>
                                <tr>
                                    <th class="text-right"
                                    >@lang('app.material-report.branch')</th>
                                    <th class="text-right" style="position: relative"
                                    >@lang('app.material-report.supplier')
                                        <div class="border-right-supplier"></div>
                                    </th>
                                    <th class="text-right"
                                    >@lang('app.material-report.branch')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.kitchen')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.bar')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.employee')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.inner')</th>
                                    {{--                                    <th--}}
                                    {{--                                    >@lang('app.material-report.other')</th>--}}
                                    <th class="text-right"
                                    >@lang('app.material-report.note-kitchen')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.note-bar')</th>
                                </tr>
                                <tr>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-before-goods"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-before-goods"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-import-branch-goods"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-import-branch-goods"></label>--}}
                                    </th>
                                    <th style="position: relative">
                                        <label class="mb-0 seemt-fz-14" id="total-amount-import-supplier-goods"></label>
                                        <div class="border-right-supplier"></div>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-import-supplier-goods"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-export-branch-goods"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-export-branch-goods"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-export-kitchen-goods"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-export-kitchen-goods"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-export-bar-goods"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-export-bar-goods"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-export-employee-goods"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-export-employee-goods"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-export-inner-goods"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-export-inner-goods"></label>--}}
                                    </th>
                                    {{--                                    <th>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 id="total-amount-export-other-goods"></label>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                    {{--                                               id="total-quantity-export-other-goods"></label>--}}
                                    {{--                                    </th>--}}
                                    {{--                                    <th>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 id="total-amount-return-goods"></label>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-return-goods"></label>--}}
                                    {{--                                    </th>--}}
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-cancel-goods"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-cancel-goods"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-return-goods"></label>
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-after-goods"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-after-goods"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-import-kitchen-goods"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-import-kitchen-goods"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-import-bar-goods"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-import-bar-goods"></label>--}}
                                    </th>
                                </tr>

                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-material-report" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('report.material.filter')
                            <table class="table" id="table-internal-material-report">
                                <thead>
                                <tr>
                                    <th
                                            rowspan="3">@lang('app.material-report.stt')</th>
                                    <th
                                            rowspan="3">@lang('app.material-report.name')</th>
                                    {{--                                    <th--}}
                                    {{--                                        rowspan="3">@lang('app.material-report.type')</th>--}}
                                    <th class="text-right"
                                        rowspan="2">@lang('app.material-report.before')</th>
                                    <th class="text-right" style="position: relative"
                                        colspan="2">@lang('app.material-report.import')
                                        <div class="border-right-supplier"></div>
                                    </th>
                                    <th class="text-right"
                                        colspan="5">@lang('app.material-report.export')</th>
                                    {{--                                    <th--}}
                                    {{--                                        rowspan="2">@lang('app.material-report.return')</th>--}}
                                    <th class="text-right" rowspan="2">@lang('app.material-report.cancel')</th>
                                    <th class="text-right" rowspan="2">@lang('app.material-report.return')</th>
                                    {{--                                    <th--}}
                                    {{--                                        rowspan="3">@lang('app.material-report.wastage-rate')</th>--}}
                                    {{--                                    <th--}}
                                    {{--                                        rowspan="2">@lang('app.material-report.wastage-allow')</th>--}}
                                    <th class="text-right"
                                        rowspan="2">@lang('app.material-report.after')</th>
                                    <th class="text-right"
                                        colspan="2">@lang('app.material-report.note')</th>
                                    <th
                                            rowspan="3"></th>
                                    <th
                                            rowspan="3"></th>
                                </tr>
                                <tr>
                                    <th class="text-right"
                                    >@lang('app.material-report.branch')</th>
                                    <th class="text-right" style="position: relative"
                                    >@lang('app.material-report.supplier')
                                        <div class="border-right-supplier"></div>
                                    </th>
                                    <th class="text-right"
                                    >@lang('app.material-report.branch')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.kitchen')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.bar')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.employee')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.inner')</th>
                                    {{--                                    <th--}}
                                    {{--                                    >@lang('app.material-report.other')</th>--}}
                                    <th class="text-right"
                                    >@lang('app.material-report.note-kitchen')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.note-bar')</th>
                                </tr>
                                <tr>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-before-internal"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-before-internal"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14"
                                               id="total-amount-import-branch-internal"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-import-branch-internal"></label>--}}
                                    </th>
                                    <th style="position: relative">
                                        <label class="mb-0 seemt-fz-14"
                                               id="total-amount-import-supplier-internal"></label>
                                        <div class="border-right-supplier"></div>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-import-supplier-internal"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14"
                                               id="total-amount-export-branch-internal"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-export-branch-internal"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14"
                                               id="total-amount-export-kitchen-internal"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-export-kitchen-internal"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-export-bar-internal"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-export-bar-internal"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14"
                                               id="total-amount-export-employee-internal"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-export-employee-internal"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-export-inner-internal"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-export-inner-internal"></label>--}}
                                    </th>
                                    {{--                                    <th>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 id="total-amount-export-other-internal"></label>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                    {{--                                               id="total-quantity-export-other-internal"></label>--}}
                                    {{--                                    </th>--}}
                                    {{--                                    <th>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 id="total-amount-return-internal"></label>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                    {{--                                               id="total-quantity-return-internal"></label>--}}
                                    {{--                                    </th>--}}
                                    <th><label class="mb-0 seemt-fz-14" id="total-amount-cancel-internal"></label></th>
                                    <th><label class="mb-0 seemt-fz-14" id="total-amount-return-internal"></label></th>
                                    {{--                                    <th>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 id="total-amount-wastage-allow-internal"></label>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                    {{--                                               id="total-quantity-wastage-allow-internal"></label>--}}
                                    {{--                                    </th>--}}
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-after-internal"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-after-internal"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14"
                                               id="total-amount-import-kitchen-internal"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-import-kitchen-internal"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-import-bar-internal"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-import-bar-internal"></label>--}}
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-material-report" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('report.material.filter')
                            <table class="table" id="table-other-material-report">
                                <thead>
                                <tr>
                                    <th
                                            rowspan="3">@lang('app.material-report.stt')</th>
                                    <th class="text-left"
                                        rowspan="3">@lang('app.material-report.name')</th>
                                    {{--                                    <th--}}
                                    {{--                                        rowspan="3">@lang('app.material-report.type')</th>--}}
                                    <th class="text-right"
                                        rowspan="2">@lang('app.material-report.before')</th>
                                    <th class="text-right" style="position: relative"
                                        colspan="2">@lang('app.material-report.import')
                                        <div class="border-right-supplier"></div>
                                    </th>
                                    <th class="text-right"
                                        colspan="5">@lang('app.material-report.export')</th>
                                    {{--                                    <th--}}
                                    {{--                                        rowspan="2">@lang('app.material-report.return')</th>--}}
                                    <th class="text-right" rowspan="2">@lang('app.material-report.cancel')</th>
                                    <th class="text-right" rowspan="2">@lang('app.material-report.return')</th>
                                    <th class="text-right"
                                        rowspan="2">@lang('app.material-report.after')</th>
                                    <th class="text-right"
                                        colspan="2">@lang('app.material-report.note')</th>
                                    <th
                                            rowspan="3"></th>
                                    <th
                                            rowspan="3"></th>
                                </tr>
                                <tr>
                                    <th class="text-right"
                                    >@lang('app.material-report.branch')</th>
                                    <th class="text-right" style="position: relative"
                                    >@lang('app.material-report.supplier')
                                        <div class="border-right-supplier"></div>
                                    </th>
                                    <th class="text-right"
                                    >@lang('app.material-report.branch')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.kitchen')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.bar')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.employee')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.inner')</th>
                                    {{--                                    <th--}}
                                    {{--                                    >@lang('app.material-report.other')</th>--}}
                                    <th class="text-right"
                                    >@lang('app.material-report.note-kitchen')</th>
                                    <th class="text-right"
                                    >@lang('app.material-report.note-bar')</th>
                                </tr>
                                <tr>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-before-other"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-before-other"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-import-branch-other"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-import-branch-other"></label>--}}
                                    </th>
                                    <th style="position: relative">
                                        <label class="mb-0 seemt-fz-14" id="total-amount-import-supplier-other"></label>
                                        <div class="border-right-supplier"></div>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-import-supplier-other"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-export-branch-other"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-export-branch-other"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-export-kitchen-other"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-export-kitchen-other"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-export-bar-other"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-export-bar-other"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-export-employee-other"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-export-employee-other"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-export-inner-other"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-export-inner-other"></label>--}}
                                    </th>
                                    {{--                                    <th>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 id="total-amount-export-other-other"></label>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                    {{--                                               id="total-quantity-export-other-other"></label>--}}
                                    {{--                                    </th>--}}
                                    {{--                                    <th>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 id="total-amount-return-other"></label>--}}
                                    {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-return-other"></label>--}}
                                    {{--                                    </th>--}}
                                    <th><label class="mb-0 seemt-fz-14" id="total-amount-cancel-other"></label></th>
                                    <th><label class="mb-0 seemt-fz-14" id="total-amount-return-other"></label></th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-after-other"></label>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-after-other"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14"
                                               id="total-amount-import-kitchen-other"></label><br>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header" id="total-quantity-import-kitchen-other"></label>--}}
                                    </th>
                                    <th>
                                        <label class="mb-0 seemt-fz-14" id="total-amount-import-bar-other"></label><br>
                                        {{--                                        <label class=mb-0 seemt-fz-14 class="number-order-header"--}}
                                        {{--                                               id="total-quantity-import-bar-other"></label>--}}
                                    </th>
                                </tr>

                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-body end -->
    </div>
    @include('report.material.excel')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\report\material\index.js?version=3')}}"></script>
@endpush
