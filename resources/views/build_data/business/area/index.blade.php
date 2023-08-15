@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class=" mb-0 pt-0">
                <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tab-area-data">
                    <li class="nav-item active">
                        <a class="nav-link" data-toggle="tab" id="tab-area-data-1" data-id="1" href="#area-tab1"
                           role="tab"
                           aria-expanded="true">@lang('app.area-data.tab1') <span class="label label-success"
                                                                                  id="total-record-enable">0</span></a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" id="tab-area-data-2" data-id="2" href="#area-tab2"
                           role="tab"
                           aria-expanded="false">@lang('app.area-data.tab2') <span class="label label-inverse"
                                                                                   id="total-record-disable">0</span></a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="card-block card">
                    <div class="tab-content mb-0">
                        <div class="tab-pane active" id="area-tab1" role="tabpanel">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand select-brand-area-data">
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
                                            <select class="js-example-basic-single select-branch select-branch-area-data">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-enable-area-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.area-data.stt-table')</th>
                                        <th>@lang('app.area-data.name-table')</th>
                                        <th>@lang('app.area-data.table-number')</th>
                                        <th>@lang('app.area-data.function-table')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="area-tab2" role="tabpanel">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand select-brand-material-data">
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
                                            <select class="js-example-basic-single select-branch select-branch-area-data">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-disable-area-data" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.area-data.stt-table')</th>
                                        <th>@lang('app.area-data.name-table')</th>
                                        <th>@lang('app.area-data.table-number')</th>
                                        <th>@lang('app.area-data.function-table')</th>
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
        <span id="msg-title-status-area">@lang('app.area-data.title-status')</span>
        <span id="msg-content-status-area">@lang('app.area-data.content-status')</span>
        <span id="msg-success-status-area">@lang('app.area-data.success-status')</span>
    </div>
    @include('build_data.business.area.create')
    @include('build_data.business.area.update')
    @include('build_data.business.area.notify')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/business/area/index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

