@extends('layouts.layout') @section('content')
    <style>
        .seemt-container .seemt-main i {
            vertical-align: initial !important;
        }
    </style>
    <div class="page-wrapper">
{{--        @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) >= 1 || in_array('BOOKING_MANAGER', Session::get(SESSION_PERMISSION)) )--}}
            <div class="page-body" id="form-list-branch-booking">
                <div class="card">
                    <div class="col-sm-12 mb-4">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable d-flex" style="right: 15px">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand" data-brand-current-id="{{Session::get(SESSION_KEY_BRAND_ID)}}">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->where('is_office', ENUM_DIS_SELECTED)->all() as $db)
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
                                <div class="form-validate-select d-none">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-branch select-branch-employee-manage-data">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->where('is_office', ENUM_DIS_SELECTED)->all() as $db)
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
                            <div class="dataTables_wrapper d-flex d-none">
                                <div id="table-enable-area-data_filter" class="dataTables_filter">
                                    <label><i class="fi-rr-search"></i>
                                        <input type="search" class="" placeholder="Tìm kiếm"
                                               aria-controls="table-enable-area-data">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row mt-3 d-none" id="list-branch-booking">
                        </div>
                    </div>
                </div>
            </div>
{{--        @endif--}}
        <div class="page-body" id="form-list-booking">
{{--            @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) >= 1)--}}
                <div id="data-visible-booking-manage" class="d-none">
{{--                    @else--}}
                        <div id="data-visible-booking-manage">
{{--                            @endif--}}
                            <input type="text" class="d-none"
                                   value="{{ Session::get(SESSION_JAVA_ACCOUNT)['branch_id'] }}" id="branch_id"/>
                            <ul class="nav nav-tabs md-tabs" id="nav-tabs-booking-table" role="tablist">
{{--                                @if(Session::get(SESSION_KEY_PERMISSION_TALLEST) >= 1)--}}
                                    <button type="button" class="btn btn-inverse font-weight-bold mr-2"
                                            id="btn-back-list-branch"
                                            style="height: 33px; margin-top: 12px;margin-left: 10px;">
                                        <i class="fa fa-chevron-left"></i> Quay lại
                                    </button>
{{--                                @endif--}}
                                <li class="nav-item">
                                    <a class="nav-link" data-tab="1" data-toggle="tab" href="#booking-table-manage-tab1"
                                       role="tab" aria-expanded="true">
                                        @lang('app.booking-table-manage.tab1') <span class="label label-warning"
                                                                                     id="total-record-processing"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-tab="2" data-toggle="tab" href="#booking-table-manage-tab2"
                                       role="tab" aria-expanded="false">
                                        @lang('app.booking-table-manage.tab2') <span class="label label-success"
                                                                                     id="total-record-done"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-tab="3" data-toggle="tab" href="#booking-table-manage-tab3"
                                       role="tab" aria-expanded="false">
                                        @lang('app.booking-table-manage.tab3') <span class="label label-danger"
                                                                                     id="total-record-cancel"></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="card card-block">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="booking-table-manage-tab1" role="tabpanel">
                                        <div class="table-responsive new-table">
                                            @include('manage.booking_table.filter')
                                            <table id="table-processing-booking-table-manage" class="table">
                                                <thead>
                                                <tr>
                                                    <th rowspan="2"
                                                        class="text-center">@lang('app.booking-table-manage.stt-table')</th>
                                                    <th rowspan="2"
                                                        class="text-left">@lang('app.booking-table-manage.customer-name-table')</th>
                                                    <th rowspan="2"
                                                        class="text-left">@lang('app.booking-table-manage.phone-table')</th>
                                                    <th rowspan="2"
                                                        class="text-left">@lang('app.booking-table-manage.booking-type-table')</th>
                                                    <th rowspan="2"
                                                        class="text-left">@lang('app.booking-table-manage.employee-table')</th>
                                                    <th class="text-right">@lang('app.booking-table-manage.deposit_amount-table')</th>
                                                    <th class="text-right">@lang('app.booking-table-manage.return-deposit_amount')</th>
                                                    <th>@lang('app.booking-table-manage.total-customer-table')</th>
                                                    <th rowspan="2"
                                                        class="text-center">@lang('app.booking-table-manage.booking-time-table')</th>
                                                    <th rowspan="2"
                                                        class="text-center">@lang('app.booking-table-manage.status-table')</th>
                                                    <th rowspan="2"
                                                        class="text-center">@lang('app.booking-table-manage.action-table')</th>
                                                </tr>
                                                <tr>
                                                    <th id="total-deposit-amount-booking-manage-in-processing-table"
                                                        class="seemt-fz-14">0
                                                    </th>
                                                    <th id="total-return-deposit-amount-booking-manage-in-processing-table"
                                                        class="seemt-fz-14">0
                                                    </th>
                                                    <th id="total-customer-booking-manage-in-processing-table"
                                                        class="seemt-fz-14">0
                                                    </th>
                                                    <th class="d-none"></th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="booking-table-manage-tab2" role="tabpanel">
                                        <div class="table-responsive new-table">
                                            @include('manage.booking_table.filter')
                                            <table id="table-done-booking-table-manage" class="table">
                                                <thead>
                                                <tr>
                                                    <th rowspan="2"
                                                        class="text-center">@lang('app.booking-table-manage.stt-table')</th>
                                                    <th rowspan="2"
                                                        class="text-left">@lang('app.booking-table-manage.customer-name-table')</th>
                                                    <th rowspan="2"
                                                        class="text-left">@lang('app.booking-table-manage.phone-table')</th>
                                                    <th rowspan="2"
                                                        class="text-left">@lang('app.booking-table-manage.booking-type-table')</th>
                                                    <th rowspan="2"
                                                        class="text-left">@lang('app.booking-table-manage.employee-table')</th>
                                                    <th class="text-right">@lang('app.booking-table-manage.deposit_amount-table')</th>
                                                    <th class="text-right">@lang('app.booking-table-manage.return-deposit_amount')</th>
                                                    <th>@lang('app.booking-table-manage.total-customer-table')</th>
                                                    <th rowspan="2"
                                                        class="text-center">@lang('app.booking-table-manage.booking-time-table')</th>
                                                    <th rowspan="2"
                                                        class="text-center">@lang('app.booking-table-manage.status-table')</th>
                                                    <th rowspan="2"
                                                        class="text-center">@lang('app.booking-table-manage.action-table')</th>
                                                </tr>
                                                <tr>
                                                    <th id="total-deposit-amount-booking-manage-in-completed-table"
                                                        class="seemt-fz-14">0
                                                    </th>
                                                    <th id="total-return-deposit-amount-booking-manage-in-completed-table"
                                                        class="seemt-fz-14">0
                                                    </th>
                                                    <th id="total-customer-booking-manage-in-completed-table"
                                                        class="seemt-fz-14">0
                                                    </th>
                                                    <th class="d-none"></th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="booking-table-manage-tab3" role="tabpanel">
                                        <div class="table-responsive new-table">
                                            <table id="table-cancel-booking-table-manage" class="table">
                                                <thead>
                                                <tr>
                                                    <th rowspan="2"
                                                        class="text-center">@lang('app.booking-table-manage.stt-table')</th>
                                                    <th rowspan="2"
                                                        class="text-left">@lang('app.booking-table-manage.customer-name-table')</th>
                                                    <th rowspan="2"
                                                        class="text-left">@lang('app.booking-table-manage.phone-table')</th>
                                                    <th rowspan="2"
                                                        class="text-left">@lang('app.booking-table-manage.booking-type-table')</th>
                                                    <th rowspan="2"
                                                        class="text-left">@lang('app.booking-table-manage.employee-table')</th>
                                                    <th class="text-right">@lang('app.booking-table-manage.deposit_amount-table')</th>
                                                    <th class="text-right">@lang('app.booking-table-manage.return-deposit_amount')</th>
                                                    <th>@lang('app.booking-table-manage.total-customer-table')</th>
                                                    <th rowspan="2"
                                                        class="text-center">@lang('app.booking-table-manage.booking-time-table')</th>
                                                    <th rowspan="2"
                                                        class="text-center">@lang('app.booking-table-manage.status-table')</th>
                                                    <th rowspan="2"
                                                        class="text-center">@lang('app.booking-table-manage.action-table')</th>
                                                </tr>
                                                <tr>
                                                    <th id="total-deposit-amount-booking-manage-in-cancel-table"
                                                        class="seemt-fz-14">0
                                                    </th>
                                                    <th id="total-return-deposit-amount-booking-manage-in-cancel-table"
                                                        class="seemt-fz-14">0
                                                    </th>
                                                    <th id="total-customer-booking-manage-in-cancel-table"
                                                        class="seemt-fz-14">0
                                                    </th>
                                                    <th class="d-none"></th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('manage.booking_table.setting')
                </div>
        </div>

        @include('manage.booking_table.detail')
        @include('manage.booking_table.confirm_table')
        @include('manage.booking_table.create')
        @include('manage.booking_table.update')
        @include('manage.booking_table.gift')
        @include('manage.booking_table.gift_update')
        @include('marketing.gift.gift.detail')
    </div>
@endsection
@push('scripts')
    @include('layouts.datatable')
    <script type="text/javascript" src="/js/template_custom/dataTable.js?version=1"></script>
    <script type="text/javascript" src="/js/manage/booking_table/index.js?version=4"></script>
@endpush
