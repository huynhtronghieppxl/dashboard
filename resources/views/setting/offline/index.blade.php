@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-body">
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-type="0" data-toggle="tab" id="enable-kitchen-data-tab"
                           href="#enable-kitchen-tab" role="tab" aria-expanded="true">
                            @lang('app.kitchen-data.enable_tab') <span class="label label-success"
                                                                       id="total-record-enable-online-data">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-type="1" data-toggle="tab" id="disable-kitchen-data-tab"
                           href="#disable-kitchen-tab" role="tab" aria-expanded="false">
                            @lang('app.kitchen-data.disable_tab') <span class="label label-inverse"
                                                                        id="total-record-disable-offline-data">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="enable-kitchen-tab" role="tabpanel">
                        <div class="table-responsive new-table">
                            <table id="table-enable-online-branch-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.offline-setting.table.stt')</th>
                                    <th>@lang('app.offline-setting.table.name')</th>
                                    <th>@lang('app.offline-setting.table.address')</th>
                                    <th>@lang('app.offline-setting.table.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="disable-kitchen-tab" role="tabpanel">
                        <div class="table-responsive new-table">
                            <table id="table-disable-offline-branch-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.offline-setting.table.stt')</th>
                                    <th>@lang('app.offline-setting.table.name')</th>
                                    <th>@lang('app.offline-setting.table.address')</th>
                                    <th>@lang('app.offline-setting.table.action')</th>
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
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\setting\offline\index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
