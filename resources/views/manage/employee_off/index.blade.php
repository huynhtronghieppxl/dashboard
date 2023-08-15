@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body" id="data-list-employee-off-manage">
            <ul class="nav nav-tabs md-tabs" id="nav-tabs-employee-off" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-id="1" data-toggle="tab" href="#data-by-month" role="tab"
                       aria-expanded="true" onclick="changeTabEmployeeOff(1)">
                        @lang('app.employee-off-manage.month-tab')
                        <span class="label label-success" id="total-record-month-employee-off">0</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-id="2" data-toggle="tab" href="#data-by-year" role="tab"
                       aria-expanded="false"
                       onclick="changeTabEmployeeOff(2)">
                        @lang('app.employee-off-manage.year-tab')
                        <span class="label label-warning" id="total-record-year-employee-off">0</span>
                    </a>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="data-by-month" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-employee-off-data">
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
                                        <select class="js-example-basic-single select-branch select-branch-employee-off-data">
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
                                <div class="time-filer-dataTale">
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="time-bonus-punish-index" id="month-employee-off" type="text"
                                               value="{{date('m/Y')}}">
                                    </div>
                                    <button class="search-btn-employee-off-manage-by-month"><i class="fi-rr-filter"></i>
                                    </button>
                                </div>
                                @include('manage.employee_off.filter')
                            </div>
                            <table class="table" id="table-employee-off-manage-by-month">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.employee-off-manage.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.employee-off-manage.name')</th>
                                    <th class="text-left" rowspan="2">@lang('app.employee-off-manage.branch')</th>
                                    <th colspan="3">@lang('app.employee-off-manage.monthly')</th>
                                    <th rowspan="2">@lang('app.employee-off-manage.diligence')</th>
                                    <th rowspan="2">@lang('app.employee-off-manage.create')</th>
                                    <th class="text-left" rowspan="2">@lang('app.employee-off-manage.seniority')</th>
                                    <th rowspan="2">@lang('app.employee-off-manage.status')</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th>@lang('app.employee-off-manage.total')</th>
                                    <th>@lang('app.employee-off-manage.used')</th>
                                    <th>@lang('app.employee-off-manage.available')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="data-by-year" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-employee-off-data">
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
                                        <select class="js-example-basic-single select-branch select-branch-employee-off-data">
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
                                <div class="time-filer-dataTale">
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="time-bonus-punish-index" id="year-employee-off" type="text"
                                               value="{{date('Y')}}">
                                    </div>
                                    <button class="search-btn-employee-off-manage-by-year"><i class="fi-rr-filter"></i>
                                    </button>
                                </div>
                                @include('manage.employee_off.filter')
                            </div>
                            <table class="table" id="table-employee-off-manage-by-year">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.employee-off-manage.stt')</th>
                                    <th class="text-left" rowspan="2">@lang('app.employee-off-manage.name')</th>
                                    <th class="text-left" rowspan="2">@lang('app.employee-off-manage.branch')</th>
                                    <th colspan="3">@lang('app.employee-off-manage.yearly')</th>
                                    <th rowspan="2">@lang('app.employee-off-manage.diligence')</th>
                                    <th rowspan="2">@lang('app.employee-off-manage.create')</th>
                                    <th class="text-left" rowspan="2">@lang('app.employee-off-manage.seniority')</th>
                                    <th rowspan="2">@lang('app.employee-off-manage.status')</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th>@lang('app.employee-off-manage.total')</th>
                                    <th>@lang('app.employee-off-manage.used')</th>
                                    <th>@lang('app.employee-off-manage.available')</th>
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
    @include('manage.employee.update_off')
    @include('manage.employee.detail')
    @include('manage.employee_off.diligence')
@endsection

@push('scripts')
    <script type="text/javascript" src="/js/manage/employee_off/index.js?version=5"></script>
@endpush
