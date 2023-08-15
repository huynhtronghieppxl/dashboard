@extends('layouts.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            @if(Session::get(SESSION_KEY_LEVEL) > 1)
                <div class="page-body">
                    <ul class="nav nav-tabs md-tabs md-5-tabs" id="nav-tabs-employee" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-id="1" data-toggle="tab"
                               href="#tab1-employee-manage" role="tab"
                               aria-expanded="false">@lang('app.employee-manage.check-in-employ') <span
                                        class="label label-success"
                                        id="total-record-check-in-employee">0</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-id="2" data-toggle="tab"
                               href="#tab3-employee-manage" role="tab"
                               aria-expanded="true">@lang('app.employee-manage.not-check-in-employ')
                                <span class="label label-warning"
                                      id="total-record-not-check-in-employee">0</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-id="3" data-toggle="tab"
                               href="#tab2-employee-manage" role="tab"
                               aria-expanded="true">@lang('app.employee-manage.bypass-employ')
                                <span class="label label-primary"
                                      id="total-record-bypass-employee">0</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-id="4" data-toggle="tab"
                               href="#tab5-employee-manage" role="tab"
                               aria-expanded="false">@lang('app.employee-manage.employ-off') <span
                                        class="label label-danger"
                                        id="total-record-employee-off">0</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-id="5" data-toggle="tab"
                               href="#tab6-employee-manage" role="tab"
                               aria-expanded="false">@lang('app.employee-manage.employ-off-job') <span
                                        class="label label-inverse"
                                        id="total-record-employee-quit-job">0</span></a>
                        </li>
                    </ul>
                    <div class="card card-block">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1-employee-manage" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-brand select-brand-employee-manage-data">
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
                                                <select class="js-example-basic-single select-branch select-branch-employee-manage-data">
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
                                    <table class="table" id="tab1-table-employee">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.employee-manage.stt')</th>
                                            <th class="text-left">@lang('app.employee-manage.name')</th>
                                            <th>@lang('app.employee-manage.user')</th>
                                            <th>@lang('app.employee-manage.gender')</th>
                                            <th>@lang('app.employee-manage.phone')</th>
                                            <th>@lang('app.employee-manage.branch')</th>
                                            <th>@lang('app.employee-manage.action')</th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2-employee-manage" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-brand select-brand-employee-manage-data">
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
                                                <select class="js-example-basic-single select-branch select-branch-employee-manage-data">
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
                                    <table class="table" id="tab2-table-employee">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.employee-manage.stt')</th>
                                            <th class="text-left">@lang('app.employee-manage.name')</th>
                                            <th>@lang('app.employee-manage.user')</th>
                                            <th>@lang('app.employee-manage.gender')</th>
                                            <th>@lang('app.employee-manage.phone')</th>
                                            <th>@lang('app.employee-manage.branch')</th>
                                            <th>@lang('app.employee-manage.action')</th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3-employee-manage" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-brand select-brand-employee-manage-data">
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
                                                <select class="js-example-basic-single select-branch select-branch-employee-manage-data">
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
                                    <table class="table" id=tab3-table-employee>
                                        <thead>
                                        <tr>
                                            <th class="">@lang('app.employee-manage.stt')</th>
                                            <th class="" class="text-left">@lang('app.employee-manage.name')</th>
                                            <th class="">@lang('app.employee-manage.user')</th>
                                            <th class="">@lang('app.employee-manage.gender')</th>
                                            <th class="">@lang('app.employee-manage.phone')</th>
                                            <th class="">@lang('app.employee-manage.branch')</th>
                                            <th class="">@lang('app.employee-manage.action')</th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab5-employee-manage" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-brand select-brand-employee-manage-data">
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
                                                <select class="js-example-basic-single select-branch select-branch-employee-manage-data">
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
                                    <table class="table" id=tab5-table-employee>
                                        <thead>
                                        <tr>
                                            <th>@lang('app.employee-manage.stt')</th>
                                            <th class="text-left">@lang('app.employee-manage.name')</th>
                                            <th>@lang('app.employee-manage.user')</th>
                                            <th>@lang('app.employee-manage.gender')</th>
                                            <th>@lang('app.employee-manage.phone')</th>
                                            <th>@lang('app.employee-manage.branch')</th>
                                            <th>@lang('app.employee-manage.action')</th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab6-employee-manage" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-brand select-brand-employee-manage-data">
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
                                                <select class="js-example-basic-single select-branch select-branch-employee-manage-data">
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
                                    <table class="table" id="tab6-table-employee">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.employee-manage.stt')</th>
                                            <th class="text-left">@lang('app.employee-manage.name')</th>
                                            <th>@lang('app.employee-manage.user')</th>
                                            <th>@lang('app.employee-manage.gender')</th>
                                            <th>@lang('app.employee-manage.phone')</th>
                                            <th>@lang('app.employee-manage.branch')</th>
                                            <th>@lang('app.employee-manage.action')</th>
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
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab"
                               href="#tab1-not-tms-employee-manage" role="tab"
                               aria-expanded="true">@lang('app.employee-manage.employ-enable')
                                <span class="label label-success"
                                      id="total-record-enable-employee-not-tms">0</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab"
                               href="#tab2-not-tms-employee-manage" role="tab"
                               aria-expanded="false">@lang('app.employee-manage.employ-disable') <span
                                        class="label label-danger"
                                        id="total-record-disable-employee-not-tms">0</span></a>
                        </li>
                    </ul>
                    <div class="card card-block">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1-not-tms-employee-manage" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-brand select-brand-employee-manage-data">
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
                                                <select class="js-example-basic-single select-branch select-branch-employee-manage-data">
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
                                    <table class="table" id="tab1-not-tms-table-employee">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.employee-manage.stt')</th>
                                            <th class="text-left">@lang('app.employee-manage.name')</th>
                                            <th>@lang('app.employee-manage.user')</th>
                                            <th>@lang('app.employee-manage.gender')</th>
                                            <th>@lang('app.employee-manage.phone')</th>
                                            <th>@lang('app.employee-manage.branch')</th>
                                            <th>@lang('app.employee-manage.action')</th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2-not-tms-employee-manage" role="tabpanel">
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-brand select-brand-employee-manage-data">
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
                                                <select class="js-example-basic-single select-branch select-branch-employee-manage-data">
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
                                    <table class="table" id="tab2-not-tms-table-employee">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.employee-manage.stt')</th>
                                            <th class="text-left">@lang('app.employee-manage.name')</th>
                                            <th>@lang('app.employee-manage.user')</th>
                                            <th>@lang('app.employee-manage.gender')</th>
                                            <th>@lang('app.employee-manage.phone')</th>
                                            <th>@lang('app.employee-manage.branch')</th>
                                            <th>@lang('app.employee-manage.action')</th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @include('manage.employee.create')
    @include('manage.employee.detail')
    @include('manage.employee.qr_code')
    @include('manage.employee.update')
    @include('manage.employee.update_off')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/employee/index.js?version=4',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
