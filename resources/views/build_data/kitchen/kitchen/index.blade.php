@extends('layouts.layout')
@section('content')
    <style>
        .fi-rr-user-add:hover {
            color: #fff;
        }
    </style>

    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tabs-kitchen">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="enable-kitchen-data-tab"
                       href="#enable-kitchen-tab" role="tab" aria-expanded="true" data-id="1">
                        @lang('app.kitchen-data.enable_tab')
                        <span class="label label-success" id="total-record-enable-kitchen-data">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-id="2" data-toggle="tab" id="disable-kitchen-data-tab"
                       href="#disable-kitchen-tab" role="tab" aria-expanded="false">
                        @lang('app.kitchen-data.disable_tab')
                        <span class="label label-inverse" id="total-record-disable-kitchen-data">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content mb-0">
                    <div class="tab-pane active" id="enable-kitchen-tab" role="tabpanel">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand">
                                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                    @if($db['is_office'] === 0)
                                                        @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                            <option value="{{$db['id']}}"
                                                                    selected>{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-branch">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-enable-kitchen-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.kitchen-data.table.stt')</th>
                                        <th>@lang('app.kitchen-data.table.name')</th>
                                        <th>@lang('app.kitchen-data.table.type')</th>
                                        <th>@lang('app.kitchen-data.table.description')</th>
                                        <th>@lang('app.kitchen-data.table.action')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="disable-kitchen-tab" role="tabpanel">
                        <div class="col-sm-12 col-md-12 col-xl-12 p-0">
                            <div class="table-responsive new-table">
                                <table id="table-disable-kitchen-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.kitchen-data.table.stt')</th>
                                        <th>@lang('app.kitchen-data.table.name')</th>
                                        <th>@lang('app.kitchen-data.table.type')</th>
                                        <th>@lang('app.kitchen-data.table.description')</th>
                                        <th>@lang('app.kitchen-data.table.action')</th>
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
    @include('build_data.kitchen.kitchen.create')
    @include('build_data.kitchen.kitchen.update')
    @include('build_data.kitchen.kitchen.detail')
    @include('build_data.kitchen.kitchen.kitchen_assign')
    <div class="d-none">
        <span id="msg-name-kitchen-data">@lang('app.kitchen-data.msg.name')</span>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/kitchen/kitchen/index.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
