@extends('layouts.layout')
@section('content')
    <style>
        #time-filter-history-point-report .custom-button-search {
            border-radius: 0 !important;
            height: 32px !important;
        }

        .search-date-filter-time-bar:hover {
            background: #0072bc !important;
        }

        .search-date-filter-time-bar:hover.search-date-filter-time-bar > i {
            color: #fff !important;
        }

        #div-history-point-report .new-table .select-filter-dataTable {
            margin-right: -28px !important;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body" id="div-history-point-report">
            <div class="card" id="content-detail">
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="card-block">
                            <div class="table-responsive new-table table-container-loading">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box" style="height: 34px">
                                                <select id="select-time-report"
                                                        class="form-control js-example-basic-single select2-hidden-accessible"
                                                        data-select="1">
                                                    <option value="day"
                                                            selected>@lang('app.area-report.button-day')</option>
                                                    <option value="week">@lang('app.area-report.button-week')</option>
                                                    <option value="month">@lang('app.area-report.button-month')</option>
                                                    <option value="3month">@lang('app.area-report.button-3-month')</option>
                                                    <option value="year">@lang('app.area-report.button-year')</option>
                                                    <option value="3year">@lang('app.area-report.button-3-year')</option>
                                                    <option value="all_year">@lang('app.area-report.button-all-year')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 pl-0 d-flex align-items-center justify-content-start"
                                         style="height: 32px" id="time-filter-history-point-report">
                                        <div class=" input-group m-auto add-display d-none border-0 p-0 form-day-time-filter d-flex"
                                             id="day" style="margin-top: 0px!important;">
                                            <div class="time-filer-dataTale time-input-filter-time-bar custom-date border-0">
                                                <div class="filter-date d-flex align-items-center">
                                                    <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                                                        <i class="fi-rr-calendar seemt-gray-w600 pr-2"
                                                           style="transform: translateY(2px);"></i>
                                                        <input
                                                            class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200"
                                                                id="calendar-day" style="margin: 1px" type="text"
                                                                style=""
                                                                placeholder="{{ date('d/m/Y') }}"
                                                                value="{{ date('d/m/Y') }}">
                                                    </div>
                                                    <button
                                                            class="icon-filter-component search-date-filter-time-bar seemt-bg-blue custom-button-search seemt-btn-hover-blue  m-0"
                                                            style="">
                                                        <i class="fi-rr-filter"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" input-group m-auto add-display d-none border-0 p-0 form-month-time-filter d-flex form-month-time-filter"
                                             id="month"
                                             style="margin-top: 0px!important; margin-left: 12px !important;">
                                            <div class="time-input-filter-time-bar custom-date border-0">
                                                <div class="filter-date d-flex align-items-center">
                                                    <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                                                        <i class="fi-rr-calendar seemt-gray-w600 pr-2"
                                                           style="transform: translateY(2px);"></i>
                                                        <input
                                                                class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200"
                                                                id="calendar-month" style="margin: 1px" type="text"
                                                                placeholder="{{ date('m') }}" value="{{ date('m') }}">
                                                    </div>
                                                    <button
                                                            class="icon-filter-component search-date-filter-time-bar seemt-bg-blue seemt-btn-hover-blue custom-button-search m-0">
                                                        <i class="fi-rr-filter seemt-blue"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" input-group m-auto add-display d-none border-0 p-0 d-flex form-year-time-filter"
                                             id='year' style="margin-top: 0px!important; margin-left: 12px !important;">
                                            <div class="time-input-filter-time-bar custom-date border-0">
                                                <div class="filter-date d-flex align-items-center">
                                                    <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                                                        <i class="fi-rr-calendar seemt-gray-w600 pr-2"
                                                           style="transform: translateY(2px);"></i>
                                                        <input class="year-filter-time-bar custom-year from-date-filter-input seemt-bg-gray-w200"
                                                               id="calendar-year" type="text"
                                                               placeholder="{{ date('Y') }}"
                                                               value="{{ date('Y') }}">
                                                    </div>
                                                    <button
                                                            class="icon-filter-component search-date-filter-time-bar seemt-bg-blue seemt-btn-hover-blue custom-button-search m-0">
                                                        <i class="fi-rr-filter seemt-blue"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-history-point-report" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.history-point-report.stt')</th>
                                        <th>@lang('app.history-point-report.name')</th>
                                        <th>@lang('app.history-point-report.gender')</th>
                                        <th>
                                            <div class="row m-0 p-0">
                                                <div class="col-5 ">@lang('app.history-point-report.count-add')
                                                    <label class="mb-0 ml-1">
                                                        <div class="tool-box">
                                                            <div data-toolbar="user-options">
                                                                <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                                   data-toggle="tooltip" data-placement="top"
                                                                   data-original-title="Số điểm tích lũy được"></i>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </th>
                                        <th>@lang('app.history-point-report.point-add')</th>
                                        <th>@lang('app.history-point-report.count-subtract')</th>
                                        <th>@lang('app.history-point-report.point-subtract')</th>
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
        <input id="time" value="{{date('d/m/Y')}}">
        <input id="type" value="1">
    </div>
    @include('customer.report.history_point.excel')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/report/history_point/index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{asset('js/customer/report/history_point/action.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
