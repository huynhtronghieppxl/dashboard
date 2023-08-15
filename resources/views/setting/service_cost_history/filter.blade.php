<style>
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

<div class="d-flex align-items-center add-display" id="form-time-custom" style="height: 32px">
    <div class="time-input-filter-time-bar border-0">
        <div class="filter-date d-flex">
            <div class="d-flex d-none form-time-service-cost-history form-time-option-date">
                <div class="filter-form-date seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                    <input class="from-day-service-cost from-date-filter-input seemt-bg-gray-w200"
                           type="text" value="{{date('d/m/Y')}}">
                </div>
                <div class="icon-form-to seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-angle-double-small-right seemt-gray-w600 seemt-border-none"></i>
                </div>
                <div class="filter-to-date seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                    <input class="to-day-service-cost from-date-filter-input seemt-bg-gray-w200"
                           type="text" value="{{date('d/m/Y')}}" >
                </div>
                <div class="icon-filter-component seemt-bg-blue seemt-btn-hover-blue custom-search-day-to-day" data-type="13">
                    <i class="fi-rr-filter" style="color: inherit"></i>
                </div>
            </div>
            <div class="d-flex d-none form-time-service-cost-history form-time-option-month">
                <div class="filter-form-date seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                    <input class="from-month-service-cost from-date-filter-input seemt-bg-gray-w200"
                           type="text" value="{{date('m/Y')}}">
                </div>
                <div class="icon-form-to seemt-bg-gray-w200">
                    <i class="fi-rr-angle-double-small-right seemt-gray-w600 seemt-border-none"></i>
                </div>
                <div class="filter-to-date seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                    <input class="to-month-service-cost from-date-filter-input seemt-bg-gray-w200"
                           type="text" value="{{date('m/Y')}}" >
                </div>
                <div class="icon-filter-component seemt-bg-blue seemt-btn-hover-blue custom-search-month-to-month" data-type="15">
                    <i class="fi-rr-filter" style="color: inherit"></i>
                </div>
            </div>
            <div class="d-flex d-none form-time-service-cost-history form-time-option-year">
                <div class="filter-form-date seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                    <input class="from-year-service-cost from-date-filter-input seemt-bg-gray-w200"
                           type="text" value="{{date('Y')}}">
                </div>
                <div class="icon-form-to seemt-bg-gray-w200">
                    <i class="fi-rr-angle-double-small-right seemt-gray-w600 seemt-border-none"></i>
                </div>
                <div class="filter-to-date seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                    <input class="to-year-service-cost from-date-filter-input seemt-bg-gray-w200"
                           type="text" value="{{date('Y')}}" >
                </div>
                <div class="icon-filter-component seemt-bg-blue seemt-btn-hover-blue custom-search-year-to-year" data-type="16">
                    <i class="fi-rr-filter" style="color: inherit"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="time-filer-dataTale form-time-service-cost-history by-day">
    <div class="filter-date d-flex align-items-center">
        <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
            <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
            <input
                class="input-time-day-service-cost form-control text-center custom-form-search"
                id="calendar-day" type="text"
                placeholder="{{ date('d/m/Y') }}" value="{{ date('d/m/Y') }}">
        </div>
        <button class="icon-filter-component seemt-btn-hover-blue search-by-date">
            <i class="fi-rr-filter" style="color: inherit"></i>
        </button>
    </div>
</div>
<div class="time-filer-dataTale form-time-service-cost-history by-month d-none">
    <div class="filter-date d-flex align-items-center">
        <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
            <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
            <input
                class="input-time-month-service-cost form-control text-center custom-form-search"
                id="calendar-month" type="text"
                placeholder="{{ date('m') }}" value="{{ date('m') }}">
        </div>
        <button
            class="icon-filter-component seemt-btn-hover-blue search-by-month">
            <i class="fi-rr-filter" style="color: inherit"></i>
        </button>
    </div>
</div>
<div class="time-filer-dataTale form-time-service-cost-history by-year d-none">
        <div class="filter-date d-flex align-items-center">
            <div class="filter-to-date seemt-bg-gray-w200 d-flex align-items-center">
                <i class="fi-rr-calendar seemt-gray-w600 pr-2"></i>
                <input
                    class="input-time-year-service-cost form-control text-center custom-form-search"
                    id="calendar-year" type="text" placeholder="{{ date('Y') }}"
                    value="{{ date('Y') }}" style="text-align: left !important;">
            </div>
            <button
                class="icon-filter-component seemt-btn-hover-blue custom-button-search search-by-year">
                <i class="fi-rr-filter" style="color: inherit"></i>
            </button>
        </div>
    </div>
<div class="form-validate-select">
    <div class="pr-0 select-material-box">
        <select class="js-example-basic-single select-time-service-cost-history select2-hidden-accessible" data-validate="">
            <option value="1">Theo Ngày</option>
            <option value="2">Tuần Này</option>
            <option value="3">Theo Tháng</option>
            <option value="4">3 tháng</option>
            <option value="5">Theo năm</option>
            <option value="6">3 năm</option>
            <option value="13">Ngày - Ngày</option>
            <option value="15">Tháng - Tháng</option>
            <option value="16">Năm - Năm</option>
        </select>
    </div>
</div>
