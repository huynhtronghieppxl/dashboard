<style>
    .select2-selection__arrow {
        transform: translateY(12px);
    }

    .search-date-filter-time-bar:hover,
    .search-date-option-filter-time-bar:hover {
        background: #0072bc !important;
        border-radius: 0 6px 6px 0 !important;
    }

    .search-date-filter-time-bar:hover.search-date-filter-time-bar>i,
    .search-date-option-filter-time-bar:hover.search-date-option-filter-time-bar>i {
        color: #fff !important;
    }
</style>
<div class="filter-report row">
    <div class="form-group select2_theme validate-group col-lg-4" style="margin: 0 !important;">
        <div class="form-validate-select">
            <div class="col-lg-12 mx-0 px-0">
                <div class="col-lg-12 pr-0 select-material-box">
                    <select id="select-time-report" class="form-control js-example-basic-single select2-hidden-accessible"
                        data-select="1">
                        <option value="day" selected>@lang('app.area-report.button-day')</option>
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
    </div>
    <div class="col-lg-8 d-flex align-items-center justify-content-center justify-content-start">
        <div class=" input-group m-auto add-display border-0 p-0 form-day-time-filter d-flex"
            id="day" style="margin-top: 0px!important; height: 40px;">
            <div class="time-filer-dataTale time-input-filter-time-bar custom-date border-0">
                <div class="filter-date d-flex align-items-center">
                    <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center" style="height: 40px !important;">
                        <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
                        <input
                            class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200"
                            id="calendar-day" style="margin: 1px" type="text"
                            style="height: 40px !important;"
                            placeholder="{{ date('d/m/Y') }}" value="{{ date('d/m/Y') }}">
                    </div>
                    <button
                        class="icon-filter-component search-date-filter-time-bar seemt-bg-blue custom-button-search seemt-btn-hover-blue  m-0" style="height: 40px !important;">
                        <i class="fi-rr-filter"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class=" input-group m-auto add-display d-none border-0 p-0 form-month-time-filter d-flex form-month-time-filter"
            id="month" style="margin-top: 0px!important">
            <div class="time-input-filter-time-bar custom-date border-0">
                <div class="filter-date d-flex align-items-center">
                    <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center" style="height: 40px !important;">
                        <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
                        <input
                            class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200"
                            id="calendar-month" style="margin: 1px" type="text"
                            style="height: 40px !important;"
                            placeholder="{{ date('m') }}" value="{{ date('m') }}">
                    </div>
                    <button
                        class="icon-filter-component search-date-filter-time-bar seemt-bg-blue seemt-btn-hover-blue custom-button-search m-0" style="height: 40px !important;">
                        <i class="fi-rr-filter seemt-blue"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class=" input-group m-auto add-display d-none border-0 p-0 d-flex form-year-time-filter"
            id='year' style="margin-top: 0px!important">
            <div class="time-input-filter-time-bar custom-date border-0">
                <div class="filter-date d-flex align-items-center">
                    <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center" style="height: 40px !important;">
                        <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
                        <input class="year-filter-time-bar custom-year from-date-filter-input seemt-bg-gray-w200"
                            id="calendar-year" type="text" placeholder="{{ date('Y') }}" style="height: 40px !important;"
                            value="{{ date('Y') }}">
                    </div>
                    <button
                        class="icon-filter-component search-date-filter-time-bar seemt-bg-blue seemt-btn-hover-blue custom-button-search m-0" style="height: 40px !important;">
                        <i class="fi-rr-filter seemt-blue"></i>
                    </button>
                </div>
            </div>
        </div>
        @include('report.report_type_option')
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/report/sell/filter.js?version=1', env('IS_DEPLOY_ON_SERVER')) }}"></script>
@endpush
