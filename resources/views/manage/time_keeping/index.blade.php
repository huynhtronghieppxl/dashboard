@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" id="nav-tabs-time-keeping" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link" data-id="1" data-toggle="tab" href="#tab-date-time-keeping-manage" role="tab"
                       onclick="changeTabTimeKeepingManage(1)"
                       aria-expanded="true">@lang('app.time-keeping-manage.tab-date')
                        <span class="label label-success" id="total-record-date-time-keeping-manage">0</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-id="2" data-toggle="tab" href="#tab-month-time-keeping-manage" role="tab"
                       onclick="changeTabTimeKeepingManage(2)"
                       aria-expanded="true">@lang('app.time-keeping-manage.tab-month')
                        <span class="label label-warning" id="total-record-month-time-keeping-manage">0</span></a>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-date-time-keeping-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="filter-date d-flex align-items-center">
                                    <div class="time-filer-dataTale">
                                        <div class="seemt-group-date">
                                            <i class="fi-rr-calendar"></i>
                                            <input class="time-bonus-punish-index" id="date-time-keeping-manage"
                                                   style="color:#28282b !important; " value="{{date('d/m/Y')}}">
                                        </div>
                                        <button class="search-btn-date-time-keeping" style="width: 32px"><i
                                                    class="fi-rr-filter"></i></button>
                                    </div>
                                </div>
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-time-keeping-data">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                    <option value="{{$db['id']}}"
                                                            selected>{{$db['name']}}</option>
                                                @else
                                                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-branch select-branch-time-keeping-data">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                    <option value="{{$db['id']}}"
                                                            selected>{{$db['name']}}</option>
                                                @else
                                                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="table-date-time-keeping-manage" class="table  mb-0">
                                <thead>
                                <tr>
                                    <th>@lang('app.time-keeping-manage.stt')</th>
                                    <th class="text-left">@lang('app.time-keeping-manage.name')</th>
                                    <th>@lang('app.time-keeping-manage.work')</th>
                                    <th>@lang('app.time-keeping-manage.date')</th>
                                    <th>@lang('app.time-keeping-manage.open')</th>
                                    <th>@lang('app.time-keeping-manage.close')</th>
                                    <th class="text-left">@lang('app.time-keeping-manage.miss')</th>
                                    <th>@lang('app.time-keeping-manage.address')</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-month-time-keeping-manage" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="filter-date d-flex align-items-center">
                                    <div class="time-filer-dataTale">
                                        <div class="seemt-group-date">
                                            <i class="fi-rr-calendar"></i>
                                            <input class="time-bonus-punish-index" style="color: #28282b !important;"
                                                   id="month-time-keeping-manage" type="text"
                                                   value="{{date('m/Y')}}">
                                        </div>
                                        <button class="search-btn-month-time-keeping" style="width: 32px"><i
                                                    class="fi-rr-filter"></i></button>
                                    </div>
                                </div>
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select id="select-employee-time-keeping-manage" data-select="1"
                                                class="form-control js-example-basic-single select2-hidden-accessible"
                                                tabindex="-1" aria-hidden="true">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-time-keeping-data">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                    <option value="{{$db['id']}}"
                                                            selected>{{$db['name']}}</option>
                                                @else
                                                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-branch select-branch-time-keeping-data">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                                    <option value="{{$db['id']}}"
                                                            selected>{{$db['name']}}</option>
                                                @else
                                                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <table id="table-month-time-keeping-manage" class="table mb-0">
                                <thead>
                                <tr>
                                    <th>@lang('app.time-keeping-manage.stt')</th>
                                    <th class="text-left">@lang('app.time-keeping-manage.name')</th>
                                    <th>@lang('app.time-keeping-manage.work')</th>
                                    <th>@lang('app.time-keeping-manage.date')</th>
                                    <th>@lang('app.time-keeping-manage.open')</th>
                                    <th>@lang('app.time-keeping-manage.close')</th>
                                    <th>@lang('app.time-keeping-manage.miss')</th>
                                    <th class="text-left">@lang('app.time-keeping-manage.address')</th>
                                    <th>@lang('app.time-keeping-manage.status')</th>
                                    <th></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.time_keeping.update')
    @include('manage.time_keeping.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/time_keeping/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
