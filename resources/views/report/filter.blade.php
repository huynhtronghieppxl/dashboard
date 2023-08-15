<style>
    .select2-selection__arrow {
        transform: translateY(12px);
    }

    .search-date-option-filter-time-bar {
        z-index: 1;
    }

    .search-date-filter-time-bar:hover,
    .search-date-option-filter-time-bar:hover {
        background: #0072bc !important;
        border-radius: 0 6px 6px 0 !important;
    }

    .search-date-filter-time-bar:hover.search-date-filter-time-bar > i,
    .search-date-option-filter-time-bar:hover.search-date-option-filter-time-bar > i {
        color: #fff !important;
    }

    .seemt-container .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: -13px !important;
    }

    .amount-total-header-report {
        font-size: 22px;
        color: #fa6342;
        line-height: 32px;
        text-align: center;
    }

    .seemt-container .select2-container--default .select2-selection--single .select2-selection__rendered span {
        padding-right: 10px;
    }
</style>
<div class="filter-report seemt-green " style="height: 32px; display: flex; justify-content: space-between">
    <div class="col-lg-8 d-flex">
        <div class="form-group select2_theme validate-group col-lg-4" style="margin: 0 !important;">
            <div class="form-validate-select">
                <div class="col-lg-12 mx-0 px-0">
                    <div class="col-lg-12 p-0"
                         style="height: 32px!important;background: var(--bg-color);border-radius: 6px;">
                        <select id="select-time-report"
                                class="form-control js-example-basic-single select2-hidden-accessible"
                                data-select="1">
                            <option value="day" selected>@lang('app.area-report.button-day')</option>
                            <option value="week">@lang('app.area-report.button-week')</option>
                            <option value="month">@lang('app.area-report.button-month')</option>
                            <option value="3month">@lang('app.area-report.button-3-month')</option>
                            <option value="year">@lang('app.area-report.button-year')</option>
                            <option value="3year">@lang('app.area-report.button-3-year')</option>
                            <option value="13">Ngày - Ngày</option>
                            <option value="15">Tháng - Tháng</option>
                            <option value="16">Năm - Năm</option>
                            <option value="all_year">@lang('app.area-report.button-all-year')</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 pl-0 d-flex align-items-center justify-content-start" style="height: 32px">
            <div class=" input-group m-auto add-display border-0 p-0 form-day-time-filter d-flex"
                 id="day" style="margin-top: 0px!important;">
                <div class="time-filer-dataTale time-input-filter-time-bar custom-date border-0">
                    <div class="filter-date d-flex align-items-center">
                        <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                            <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
                            <input
                                class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200"
                                id="calendar-day" style="margin: 1px" type="text"
                                style=""
                                placeholder="{{ date('d/m/Y') }}" value="{{ date('d/m/Y') }}">
                        </div>
                        <button
                            class="icon-filter-component search-date-filter-time-bar seemt-bg-blue custom-button-search seemt-btn-hover-blue  m-0"
                            style="">
                            <i class="fi-rr-filter"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div
                class=" input-group m-auto add-display d-none border-0 p-0 form-month-time-filter d-flex form-month-time-filter"
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
    <div class="col-lg-4">
        <div class="select-filter-dataTable d-flex justify-content-end">
            <div class="form-validate-select">
                <div class="pr-0 select-material-box">
                    <select class="js-example-basic-single select-brand select-brand-report">
                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                            @if($db['is_office'] === 0)
                                @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                    <option value="{{$db['id']}}"
                                            selected>{{$db['name']}}</option>
                                @else
                                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-validate-select ml-3">
                <div class="pr-0 select-material-box">
                    <select class="js-example-basic-single select-branch select-branch-report">
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\report\sell\filter.js?version=1', env('IS_DEPLOY_ON_SERVER')) }}"></script>
@endpush
