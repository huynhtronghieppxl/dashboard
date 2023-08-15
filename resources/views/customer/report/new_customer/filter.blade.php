<style>
    .select2-selection__arrow {
        transform: translateY(9px);
    }

    .search-date-filter-time-bar:hover,
    .search-date-option-filter-time-bar:hover {
        background: #0072bc !important;
    }

    .search-date-filter-time-bar:hover.search-date-filter-time-bar>i,
    .search-date-option-filter-time-bar:hover.search-date-option-filter-time-bar>i {
        color: #fff !important;
    }
</style>
<div class="filter-report row seemt-green" style="height: 32px">
    <div class="form-group select2_theme validate-group col-lg-2" style="margin: 0 !important;">
        <div class="form-validate-select">
            <div class="col-lg-12 mx-0 px-0">
                <div class="col-lg-12 p-0" style="height: 32px!important;background: var(--bg-color);border-radius: 6px;">
                    <select id="select-time-customer-new-report" class="select-option-filter-report js-example-basic-single form-control" tabindex="-1" aria-hidden="true">
                        <option value="1" data-time="{{date('d/m/Y')}}"selected>@lang('app.area-report.button-day')</option>
                        <option value="2" data-time="{{date('W/Y')}}">@lang('app.area-report.button-week')</option>
                        <option value="3" data-time="{{date('m/Y')}}">@lang('app.area-report.button-month')</option>
                        <option value="4" data-time="{{date('m/Y')}}">@lang('app.area-report.button-3-month')</option>
                        <option value="5" data-time="{{date('Y')}}">@lang('app.area-report.button-year')</option>
                        <option value="6" data-time="{{date('Y')}}">@lang('app.area-report.button-3-year')</option>
                        <option value="13">Ngày - Ngày</option>
                        <option value="15">Tháng - Tháng</option>
                        <option value="16">Năm - Năm</option>
                        <option value="8" data-time="{{substr(Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['created_at'], 6, 4)}}">@lang('app.area-report.button-all-year')</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 pl-0 d-flex align-items-center justify-content-start" style="height: 32px">
        <div class=" input-group m-auto add-display border-0 p-0 form-day-time-filter d-flex"
             id="day" style="margin-top: 0px!important;">
            <div class="time-filer-dataTale time-input-filter-time-bar custom-date border-0">
                <div class="filter-date d-flex align-items-center">
                    <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                        <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
                        <input
                            class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200"
                            id="calendar-day" style="margin: 1px" type="text"
                            style="height: 40px !important;"
                            placeholder="{{ date('d/m/Y') }}" value="{{ date('d/m/Y') }}">
                    </div>
                    <button
                        class="icon-filter-component search-date-filter-time-bar seemt-bg-blue custom-button-search seemt-btn-hover-blue  m-0">
                        <i class="fi-rr-filter"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class=" input-group m-auto add-display d-none border-0 p-0 form-month-time-filter d-flex form-month-time-filter"
             id="month" style="margin-top: 0px!important">
            <div class="time-input-filter-time-bar custom-date border-0">
                <div class="filter-date d-flex align-items-center">
                    <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                        <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
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
             id='year' style="margin-top: 0px!important">
            <div class="time-input-filter-time-bar custom-date border-0">
                <div class="filter-date d-flex align-items-center">
                    <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                        <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
                        <input class="year-filter-time-bar custom-year from-date-filter-input seemt-bg-gray-w200"
                               id="calendar-year" type="text" placeholder="{{ date('Y') }}"
                               value="{{ date('Y') }}">
                    </div>
                    <button
                        class="icon-filter-component search-date-filter-time-bar seemt-bg-blue seemt-btn-hover-blue custom-button-search m-0">
                        <i class="fi-rr-filter seemt-blue"></i>
                    </button>
                </div>
            </div>
        </div>
        @include('report.report_type_option')
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/report/new_customer/filter.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
