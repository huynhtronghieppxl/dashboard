@extends('layouts.layout')
@section('content')
    <style>
        .swal-size-50 {
            width: 50rem !important;
        }

        .swal-lg-50 {
            width: 50rem !important;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-specification-data">
                <li class="nav-item">
                    <a class="nav-link" data-tab="0" data-toggle="tab" href="#specifications-tab1" role="tab"
                       aria-expanded="true"> @lang('app.specifications-data.tab1') <span class="label label-success"
                                                                                         id="total-record-enable">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-tab="1" data-toggle="tab" href="#specifications-tab2" role="tab"
                       aria-expanded="false">@lang('app.specifications-data.tab2') <span class="label label-inverse"
                                                                                         id="total-record-disable">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="specifications-tab1" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive new-table">
                                <table id="table-enable-specifications-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.specifications-data.stt')</th>
                                        <th>@lang('app.specifications-data.name')</th>
                                        <th>@lang('app.specifications-data.value')</th>
                                        <th>@lang('app.specifications-data.value-name')</th>
                                        <th>@lang('app.specifications-data.action')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="specifications-tab2" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive new-table">
                                <table id="table-disable-specifications-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.specifications-data.stt')</th>
                                        <th>@lang('app.specifications-data.name')</th>
                                        <th>@lang('app.specifications-data.value')</th>
                                        <th>@lang('app.specifications-data.value-name')</th>
                                        <th>@lang('app.specifications-data.action')</th>
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
    </div>
    <div class="d-none">
        <span id="msg-title-status-specifications-data">@lang('app.specifications-data.title-status')</span>
        <span id="msg-content-status-specifications-data">@lang('app.specifications-data.content-status')</span>
        <span id="msg-success-status-specifications-data">@lang('app.specifications-data.success-status')</span>
    </div>
    @include('build_data.material.material.detail')
    @include('build_data.material.specifications.create')
    @include('build_data.material.specifications.update')
    @include('build_data.material.specifications.notify')
@endsection @push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\material\specifications\index.js?version=6', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
