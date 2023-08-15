@extends('layouts.layout')
@section('content')
    <style>
        .swal-lg-50 {
            width: 50rem !important;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-unit-data">
                <li class="nav-item">
                    <a class="nav-link active" data-tab="0" data-toggle="tab" href="#unit-tab1" role="tab"
                       aria-expanded="true">@lang('app.unit-data.tab1') <span class="label label-success"
                                                                              id="total-record-enable">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-tab="1" data-toggle="tab" href="#unit-tab2" role="tab"
                       aria-expanded="false">@lang('app.unit-data.tab2') <span class="label label-inverse"
                                                                               id="total-record-disable">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="unit-tab1" role="tabpanel">
                        <div class="table-responsive new-table">
                            <table id="table-enable-unit-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.unit-data.stt')</th>
                                    <th>@lang('app.unit-data.name')</th>
                                    <th>@lang('app.unit-data.specification')</th>
                                    <th>@lang('app.unit-data.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="unit-tab2" role="tabpanel">
                        <div class="table-responsive new-table">
                            <table id="table-disable-unit-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.unit-data.stt')</th>
                                    <th>@lang('app.unit-data.name')</th>
                                    <th>@lang('app.unit-data.specification')</th>
                                    <th>@lang('app.unit-data.action')</th>
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
    <div class="d-none">
        <span id="msg-title-status-unit-data">@lang('app.unit-data.title-status')</span>
        <span id="msg-content-status-unit-data">@lang('app.unit-data.content-status')</span>
        <span id="msg-success-status-unit-data">@lang('app.unit-data.success-status')</span>
    </div>
    @include('build_data.material.material.detail')
    @include('build_data.material.unit.detail')
    @include('build_data.material.unit.update')
    @include('build_data.material.unit.create')
    @include('build_data.material.unit.notify')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\material\unit\index.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
