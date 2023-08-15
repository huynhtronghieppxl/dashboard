@extends('layouts.layout')
@section('content')
    <style>
        .seemt-main-content .new-table .select-filter-dataTable {
            z-index: 100 !important;
        }

        #div-advance-salary-employee .new-table .select-filter-dataTable {
            right: 24px !important;
        }
    </style>
    <div class="page-wrapper" id="div-advance-salary-employee">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-advance-salary-employee">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       data-id="1"
                       href="#tab1-advance-salary-employee" role="tab"
                       aria-expanded="true">@lang('app.advance-salary-employee.tab1') <span
                                class="label label-warning"
                                id="total-record-waiting-advance-salary-employee">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       data-id="2"
                       href="#tab2-advance-salary-employee" role="tab"
                       aria-expanded="true">@lang('app.advance-salary-employee.tab2') <span
                                class="label label-success"
                                id="total-record-done-advance-salary-employee">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       data-id="3"
                       href="#tab3-advance-salary-employee" role="tab"
                       aria-expanded="true">@lang('app.advance-salary-employee.tab3') <span
                                class="label label-danger"
                                id="total-record-reject-advance-salary-employee">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-advance-salary-employee" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand"
                                                    id="select-brand-advance-salary-employee">
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
                                            <select class="js-example-basic-single select-branch"
                                                    id="select-branch-advance-salary-employee">
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
                                    <div class="time-input-filter-time-bar custom-date border-0"
                                         style="margin-left: 10px">
                                        <div class="filter-date d-flex align-items-center">
                                            <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                                                <i class="fi-rr-calendar seemt-gray-w600 pr-2"
                                                   style="transform: translateY(2px);"></i>
                                                <input
                                                        class="filter-advance-salary by-month form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200"
                                                        id="" style="margin: 1px" type="text"
                                                        placeholder="{{ date('m') }}" value="{{ date('m') }}">
                                            </div>
                                            <button
                                                    class="icon-filter-component search-date-filter-time-bar seemt-bg-blue seemt-btn-hover-blue custom-button-search m-0">
                                                <i class="fi-rr-filter seemt-blue"
                                                   style="color: inherit !important;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-waiting-advance-salary-employee" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-left" rowspan="2">@lang('app.advance-salary-employee.stt')</th>
                                        <th class="text-left"
                                            rowspan="2">@lang('app.advance-salary-employee.employee')</th>
                                        <th class="text-left"
                                            rowspan="2">@lang('app.advance-salary-employee.employee_approved')</th>
                                        <th class="text-left"
                                            rowspan="2">@lang('app.advance-salary-employee.reason')</th>
                                        <th>@lang('app.advance-salary-employee.amount')</th>
                                        <th rowspan="2">@lang('app.advance-salary-employee.time')</th>
                                        <th rowspan="2">@lang('app.advance-salary-employee.approved_at')</th>
                                        <th rowspan="2">@lang('app.advance-salary-employee.action')</th>
                                        <th class="d-none" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th id="total-waiting-advance-salary-employee" class="seemt-fz-14"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-advance-salary-employee" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand"
                                                    id="select-brand-advance-salary-employee">
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
                                            <select class="js-example-basic-single select-branch"
                                                    id="select-branch-advance-salary-employee">
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
                                    <div class="time-input-filter-time-bar custom-date border-0"
                                         style="margin-left: 10px">
                                        <div class="filter-date d-flex align-items-center">
                                            <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                                                <i class="fi-rr-calendar seemt-gray-w600 pr-2"
                                                   style="transform: translateY(2px);"></i>
                                                <input
                                                        class="filter-advance-salary by-month form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200"
                                                        id="" style="margin: 1px" type="text"
                                                        placeholder="{{ date('m') }}" value="{{ date('m') }}">
                                            </div>
                                            <button class="icon-filter-component search-date-filter-time-bar seemt-bg-blue seemt-btn-hover-blue custom-button-search m-0">
                                                <i class="fi-rr-filter seemt-blue"
                                                   style="color: inherit !important;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-done-advance-salary-employee" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-center"
                                            rowspan="2">@lang('app.advance-salary-employee.stt')</th>
                                        <th class="text-center"
                                            rowspan="2">@lang('app.advance-salary-employee.employee')</th>
                                        <th rowspan="2">@lang('app.advance-salary-employee.employee_paid')</th>
                                        <th rowspan="2">@lang('app.advance-salary-employee.reason')</th>
                                        <th>@lang('app.advance-salary-employee.amount')</th>
                                        <th rowspan="2">@lang('app.advance-salary-employee.time')</th>
                                        <th rowspan="2">@lang('app.advance-salary-employee.paid-time')</th>
                                        <th rowspan="2">@lang('app.advance-salary-employee.action')</th>
                                        <th class="d-none" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th id="total-done-advance-salary-employee" class="seemt-fz-14"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-advance-salary-employee" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand"
                                                    id="select-brand-advance-salary-employee">
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
                                            <select class="js-example-basic-single select-branch"
                                                    id="select-branch-advance-salary-employee">
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
                                    <div class="time-input-filter-time-bar custom-date border-0"
                                         style="margin-left: 10px">
                                        <div class="filter-date d-flex align-items-center">
                                            <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                                                <i class="fi-rr-calendar seemt-gray-w600 pr-2"
                                                   style="transform: translateY(2px);"></i>
                                                <input
                                                        class="filter-advance-salary by-month form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200"
                                                        id="" style="margin: 1px" type="text"
                                                        placeholder="{{ date('m') }}" value="{{ date('m') }}">
                                            </div>
                                            <button class="icon-filter-component search-date-filter-time-bar seemt-bg-blue seemt-btn-hover-blue custom-button-search m-0">
                                                <i class="fi-rr-filter seemt-blue"
                                                   style="color: inherit !important;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-reject-advance-salary-employee" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-center"
                                            rowspan="2">@lang('app.advance-salary-employee.stt')</th>
                                        <th class="text-center"
                                            rowspan="2">@lang('app.advance-salary-employee.employee')</th>
                                        <th rowspan="2">@lang('app.advance-salary-employee.employee_cancel')</th>
                                        <th rowspan="2">@lang('app.advance-salary-employee.reason')</th>
                                        <th>@lang('app.advance-salary-employee.amount')</th>
                                        <th rowspan="2">@lang('app.advance-salary-employee.time')</th>
                                        <th rowspan="2">@lang('app.advance-salary-employee.cancel_at')</th>
                                        <th rowspan="2">@lang('app.advance-salary-employee.action')</th>
                                        <th class="d-none" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th id="total-reject-advance-salary-employee" class="seemt-fz-14"></th>
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
    @include('treasurer.advance_salary_employee.detail')

@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('..\js\treasurer\advance_salary_employee\index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
