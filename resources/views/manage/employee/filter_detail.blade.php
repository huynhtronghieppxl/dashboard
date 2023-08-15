<style>
    i[class^=fi-rr-calendar]:before{
        display: flex;
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
<div   style="height: 32px">
    <div class="col-lg-3 pl-0 d-flex align-items-center justify-content-start" style="height: 32px">
        <div class=" input-group m-auto add-display   border-0 p-0 form-month-time-filter d-flex form-month-time-filter"
             id="month" style="margin-top: 0px!important">
            <div class="time-input-filter-time-bar custom-date border-0">
                <div class="filter-date d-flex align-items-center">
                    <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center" style="border-radius: 6px 0 0 6px !important;">
                        <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
                        <input
                            class="calendar-month form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate seemt-bg-gray-w200"
                            id="calendar-month" style="margin: 1px; font-size: 14px !important;"  type="text"
                            placeholder="{{ date('m') }}" value="{{ date('m') }}">
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
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/manage/employee/filter_month.js?version=1',env('IS_DEPLOY_ON_SERVER')) }}"></script>
@endpush
