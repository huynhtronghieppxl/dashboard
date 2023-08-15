@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-id="0" data-toggle="tab" href="#tab2-employee-bonus-punish"
                       role="tab" aria-expanded="false">@lang('app.employee-bonus-punish.tab2')
                        <span class="label label-warning" id="total-record-confirmed">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-id="1" data-toggle="tab" href="#tab3-employee-bonus-punish"
                       role="tab" aria-expanded="false">@lang('app.employee-bonus-punish.tab3')
                        <span class="label label-success"
                              id="total-record-approved">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-id="2" data-toggle="tab" href="#tab4-employee-bonus-punish"
                       role="tab" aria-expanded="false">@lang('app.employee-bonus-punish.tab4')
                        <span class="label label-danger" id="total-record-cancel">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab2-employee-bonus-punish" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="time-filer-dataTale">
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="time-bonus-punish-index" type="text" value="{{date('m/Y')}}">
                                    </div>
                                    <button class="search-btn-payment-bill"><i class="fi-rr-filter"></i></button>
                                </div>
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-type-employee-bonus-punish"
                                                data-validate="">
                                            <option value="" selected
                                                    data-punish="0"
                                                    data-value="">Tất cả
                                            </option>
                                            <option value="0"
                                                    data-punish="0"
                                                    data-value="0">Thưởng
                                            </option>
                                            <option value="1"
                                                    data-punish="1"
                                                    data-value="0">@lang('app.employee-bonus-punish.other-punish')</option>
                                            <option value="2"
                                                    data-punish="0"
                                                    data-value="1">@lang('app.employee-bonus-punish.support')</option>
                                            <option value="3"
                                                    data-punish="0"
                                                    data-value="2">@lang('app.employee-bonus-punish.uniform')</option>
                                            <option value="4"
                                                    data-punish="0"
                                                    data-value="10">@lang('app.employee-bonus-punish.bonus-work-day')</option>
                                            <option value="5"
                                                    data-punish="1"
                                                    data-value="11">@lang('app.employee-bonus-punish.punish-work-day')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand"
                                                id="select-brand-employee-bonus-punish">
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
                                                id="select-branch-employee-bonus-punish">
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
                            <table class="table table-bordered"
                                   id="table-confirmed-employee-bonus-punish">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.employee-bonus-punish.stt')</th>
                                    <th class="" rowspan="2">@lang('app.employee-bonus-punish.name_employee')</th>
                                    <th rowspan="2">@lang('app.employee-bonus-punish.type')</th>
                                    <th>@lang('app.employee-bonus-punish.bonus_amount')</th>
                                    <th>@lang('app.employee-bonus-punish.punish_amount')</th>
                                    <th rowspan="2">@lang('app.employee-bonus-punish.note')</th>
                                    <th rowspan="2">@lang('app.employee-bonus-punish.month')</th>
                                    <th rowspan="2">Trạng thái</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-bonus-amount-confirmed-bonus-punish" class="seemt-fz-14">0</th>
                                    <th id="total-punish-amount-confirmed-bonus-punish" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-employee-bonus-punish" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="time-filer-dataTale">
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="time-bonus-punish-index" type="text" value="{{date('m/Y')}}">
                                    </div>
                                    <button class="search-btn-payment-bill"><i class="fi-rr-filter"></i></button>
                                </div>
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-type-employee-bonus-punish"
                                                data-validate="">
                                            <option value="" selected
                                                    data-punish="0"
                                                    data-value="">Tất cả
                                            </option>
                                            <option value="0"
                                                    data-punish="0"
                                                    data-value="0">Thưởng
                                            </option>
                                            <option value="1"
                                                    data-punish="1"
                                                    data-value="0">@lang('app.employee-bonus-punish.other-punish')</option>
                                            <option value="2"
                                                    data-punish="0"
                                                    data-value="1">@lang('app.employee-bonus-punish.support')</option>
                                            <option value="3"
                                                    data-punish="0"
                                                    data-value="2">@lang('app.employee-bonus-punish.uniform')</option>
                                            <option value="4"
                                                    data-punish="0"
                                                    data-value="10">@lang('app.employee-bonus-punish.bonus-work-day')</option>
                                            <option value="5"
                                                    data-punish="1"
                                                    data-value="11">@lang('app.employee-bonus-punish.punish-work-day')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand"
                                                id="select-brand-employee-bonus-punish">
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
                                                id="select-branch-employee-bonus-punish">
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
                            <table class="table table-bordered"
                                   id="table-approved-employee-bonus-punish">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.employee-bonus-punish.stt')</th>
                                    <th class="" rowspan="2">@lang('app.employee-bonus-punish.name_employee')</th>
                                    <th rowspan="2">@lang('app.employee-bonus-punish.type')</th>
                                    <th class=" ">@lang('app.employee-bonus-punish.bonus_amount')</th>
                                    <th class=" ">@lang('app.employee-bonus-punish.punish_amount')</th>
                                    <th rowspan="2">@lang('app.employee-bonus-punish.note')</th>
                                    <th rowspan="2">@lang('app.employee-bonus-punish.month')</th>
                                    <th rowspan="2">Trạng thái</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-bonus-amount-approved-bonus-punish" class="seemt-fz-14">0</th>
                                    <th id="total-punish-amount-approved-bonus-punish" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-employee-bonus-punish" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="time-filer-dataTale">
                                    <div class="seemt-group-date">
                                        <i class="fi-rr-calendar"></i>
                                        <input class="time-bonus-punish-index" type="text" value="{{date('m/Y')}}">
                                    </div>
                                    <button class="search-btn-payment-bill"><i class="fi-rr-filter"></i></button>
                                </div>
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-type-employee-bonus-punish"
                                                data-validate="">
                                            <option value="" selected
                                                    data-punish="0"
                                                    data-value="">Tất cả
                                            </option>
                                            <option value="0"
                                                    data-punish="0"
                                                    data-value="0">Thưởng
                                            </option>
                                            <option value="1"
                                                    data-punish="1"
                                                    data-value="0">@lang('app.employee-bonus-punish.other-punish')</option>
                                            <option value="2"
                                                    data-punish="0"
                                                    data-value="1">@lang('app.employee-bonus-punish.support')</option>
                                            <option value="3"
                                                    data-punish="0"
                                                    data-value="2">@lang('app.employee-bonus-punish.uniform')</option>
                                            <option value="4"
                                                    data-punish="0"
                                                    data-value="10">@lang('app.employee-bonus-punish.bonus-work-day')</option>
                                            <option value="5"
                                                    data-punish="1"
                                                    data-value="11">@lang('app.employee-bonus-punish.punish-work-day')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand"
                                                id="select-brand-employee-bonus-punish">
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
                                                id="select-branch-employee-bonus-punish">
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
                            <table class="table table-bordered"
                                   id="table-cancel-employee-bonus-punish">
                                <thead>
                                <tr>
                                    <th rowspan="2">@lang('app.employee-bonus-punish.stt')</th>
                                    <th class="" rowspan="2">@lang('app.employee-bonus-punish.name_employee')</th>
                                    <th rowspan="2">@lang('app.employee-bonus-punish.type')</th>
                                    <th class=" ">@lang('app.employee-bonus-punish.bonus_amount')</th>
                                    <th class=" ">@lang('app.employee-bonus-punish.punish_amount')</th>
                                    <th rowspan="2">@lang('app.employee-bonus-punish.note')</th>
                                    <th rowspan="2">@lang('app.employee-bonus-punish.month')</th>
                                    <th rowspan="2">Trạng thái</th>
                                    <th rowspan="2"></th>
                                    <th class="d-none" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th id="total-bonus-amount-cancel-bonus-punish" class="seemt-fz-14">0</th>
                                    <th id="total-punish-amount-cancel-bonus-punish" class="seemt-fz-14">0</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('treasurer.employee_bonus_punish.create_holiday')
    @include('treasurer.employee_bonus_punish.create')
    @include('treasurer.employee_bonus_punish.update')
    @include('treasurer.employee_bonus_punish.detail')
    <div style="z-index: 99999; position: relative">
        @include('manage.employee.info')
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\treasurer\employee_bonus_punish\index.js?version=6', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

