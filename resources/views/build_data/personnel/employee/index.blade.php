@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        @if(Session::get(SESSION_KEY_LEVEL) > 1)
            <div class="page-body">
                <ul class="nav nav-tabs md-tabs" id="nav-tab-employee-data" role="tablist">
                    <li class="nav-item" d>
                        <a class="nav-link active" data-id="1" data-toggle="tab" href="#tab1-employee-data" role="tab"
                           aria-expanded="false">
                            @lang('app.employee-data.check-in-employ') <span class="label label-success"
                                                                             id="total-record-check-in-employee">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-id="2" data-toggle="tab" href="#tab2-employee-data" role="tab"
                           aria-expanded="true">
                            @lang('app.employee-data.not-check-in-employ') <span class="label label-warning"
                                                                                 id="total-record-not-check-in-employee">0</span>
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-id="3" data-toggle="tab" href="#tab3-employee-data" role="tab"
                           aria-expanded="false">@lang('app.employee-data.bypass-checkin') <span
                                class="label label-primary" id="total-record-bypass-check-in">0</span></a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="card card-block">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1-employee-data" role="tabpanel">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand select-employee-data">
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
                                            <select
                                                class="js-example-basic-single select-branch select-branch-employee-data">
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
                                <table class="table" id="tab-check-in-table-employee">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.employee-data.stt')</th>
                                        <th>@lang('app.employee-data.name')</th>
                                        <th>@lang('app.employee-data.user')</th>
                                        <th>@lang('app.employee-data.gender')</th>
                                        <th>@lang('app.employee-data.phone')</th>
                                        <th>@lang('app.employee-data.branch')</th>
                                        <th>@lang('app.employee-data.action')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-employee-data" role="tabpanel">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand select-employee-data">
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
                                            <select
                                                class="js-example-basic-single select-branch select-branch-employee-data">
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
                                <table class="table" id="tab-not-check-in-table-employee">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.employee-data.stt')</th>
                                        <th>@lang('app.employee-data.name')</th>
                                        <th>@lang('app.employee-data.user')</th>
                                        <th>@lang('app.employee-data.gender')</th>
                                        <th>@lang('app.employee-data.phone')</th>
                                        <th>@lang('app.employee-data.branch')</th>
                                        <th>@lang('app.employee-data.action')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3-employee-data" role="tabpanel">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand select-employee-data">
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
                                            <select
                                                class="js-example-basic-single select-branch select-branch-employee-data">
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
                                <table class="table" id="tab-by-pass-table-employee">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.employee-data.stt')</th>
                                        <th>@lang('app.employee-data.name')</th>
                                        <th>@lang('app.employee-data.user')</th>
                                        <th>@lang('app.employee-data.gender')</th>
                                        <th>@lang('app.employee-data.phone')</th>
                                        <th>@lang('app.employee-data.branch')</th>
                                        <th>@lang('app.employee-data.action')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="page-body">
                <div class="card-block card">
                    <div class="table-responsive new-table">
                        <div class="select-filter-dataTable">
                            <div class="form-validate-select">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select-brand select-employee-data">
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
                            <div class="form-validate-select" style="margin-right: 23px">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select-branch select-branch-employee-data">
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
                        <table class="table" id="table-all-employee">
                            <thead>
                            <tr>
                                <th>@lang('app.employee-data.stt')</th>
                                <th>@lang('app.employee-data.name')</th>
                                <th>@lang('app.employee-data.user')</th>
                                <th>@lang('app.employee-data.gender')</th>
                                <th>@lang('app.employee-data.phone')</th>
                                <th>@lang('app.employee-data.branch')</th>
                                <th>@lang('app.employee-data.action')</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    @include('manage.employee.create')
    @include('manage.employee.qr_code')
    @include('manage.employee.update')
    @include('manage.employee.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js\build_data\personnel\employee\index.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

