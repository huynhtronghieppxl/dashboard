@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" id="tabs-form-material-internal" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-tab="1" data-toggle="tab"
                       href="#tab1-material-internal-report"
                       role="tab" aria-expanded="true">@lang('app.material-internal-report.tab1')
                        <span class="label label-success" id="total-record-kitchen">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-tab="2" data-toggle="tab"
                       href="#tab2-material-internal-report"
                       role="tab" aria-expanded="false">@lang('app.material-internal-report.tab2')
                        <span class="label label-warning" id="total-record-bar">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-material-internal-report" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('report.material_internal.filter')
                            <table class="table"
                                   id="table-material-material-internal-report">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.material-internal-report.stt')</th>
                                    <th rowspan="2">@lang('app.material-internal-report.name')</th>
                                    {{--                                    <th>@lang('app.material-internal-report.type')</th>--}}
                                    <th class="text-right">@lang('app.material-internal-report.before')</th>
                                    <th class="text-right">@lang('app.material-internal-report.import')</th>
                                    <th class="text-right">@lang('app.material-internal-report.export')</th>
                                    <th class="text-right">@lang('app.material-internal-report.return')</th>
                                    <th class="text-right">@lang('app.material-internal-report.cancel')</th>
                                    <th class="text-right"
                                        rowspan="2">@lang('app.material-internal-report.wastage-rate')</th>
                                    <th class="text-right">@lang('app.material-internal-report.wastage-allow')</th>
                                    <th class="text-right">@lang('app.material-internal-report.current-quantity')</th>
                                    <th rowspan="2"></th>
                                    <th rowspan="2" class="d-none"></th>
                                </tr>
                                <tr>
                                    <th class="seemt-fz-14" id="total-confirm-system-quantity-kitchen">0</th>
                                    <th class="seemt-fz-14" id="total-import-quantity-kitchen">0</th>
                                    <th class="seemt-fz-14" id="total-export-quantity-kitchen">0</th>
                                    <th class="seemt-fz-14" id="total-return-quantity-kitchen">0</th>
                                    <th class="seemt-fz-14" id="total-cancel-quantity-kitchen">0</th>
                                    <th class="seemt-fz-14" id="total-wastage-allow-quantity-kitchen">0</th>
                                    <th class="seemt-fz-14" id="total-system-last-kitchen">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-material-internal-report" role="tabpanel">
                        <div class="table-responsive new-table">
                            @include('report.material_internal.filter')
                            <table class="table" id="table-goods-material-internal-report">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.material-internal-report.stt')</th>
                                    <th rowspan="2">@lang('app.material-internal-report.name')</th>
                                    {{--                                    <th>@lang('app.material-internal-report.type')</th>--}}
                                    <th class="text-right">@lang('app.material-internal-report.before')</th>
                                    <th class="text-right">@lang('app.material-internal-report.import')</th>
                                    <th class="text-right">@lang('app.material-internal-report.export')</th>
                                    <th class="text-right">@lang('app.material-internal-report.return')</th>
                                    <th class="text-right">@lang('app.material-internal-report.cancel')</th>
                                    <th class="text-right"
                                        rowspan="2">@lang('app.material-internal-report.wastage-rate')</th>
                                    <th class="text-right">@lang('app.material-internal-report.wastage-allow')</th>
                                    <th class="text-right">@lang('app.material-internal-report.current-quantity')</th>
                                    <th rowspan="2"></th>
                                    <th rowspan="2" class="d-none"></th>
                                </tr>
                                <tr>
                                    <th class="seemt-fz-14" id="total-confirm-system-quantity-bar">0</th>
                                    <th class="seemt-fz-14" id="total-import-quantity-bar">0</th>
                                    <th class="seemt-fz-14" id="total-export-quantity-bar">0</th>
                                    <th class="seemt-fz-14" id="total-cancel-quantity-bar">0</th>
                                    <th class="seemt-fz-14" id="total-return-quantity-bar">0</th>
                                    <th class="seemt-fz-14" id="total-wastage-allow-quantity-bar">0</th>
                                    <th class="seemt-fz-14" id="total-system-last-bar">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('report.material_internal.excel')
    @include('build_data.material.material.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\report\material_internal\index.js?version=3')}}"></script>
@endpush
