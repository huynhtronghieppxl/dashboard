<div class="content-filter-time-bar d-flex align-items-center add-display justify-content-start d-none" id="btn-custom-time-filter" style="height: 32px">
    <div class="time-input-filter-time-bar border-0">
        <div class="filter-date d-flex align-items-center">
            <div class="custom-date d-flex add-display d-none ">
                <div class="filter-form-date seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
                    <input class="from-date-filter-time-bar custom-date from-date-filter-input seemt-gray-w600 seemt-bg-gray-w200"
                           type="text" value="{{date('d/m/Y')}}">
                </div>
                <div class="icon-form-to seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-angle-double-small-right seemt-gray-w600 seemt-border-none"></i>
                </div>
                <div class="filter-to-date seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
                    <input class="to-date-filter-time-bar custom-date from-date-filter-input seemt-gray-w600 seemt-bg-gray-w200"
                           type="text" value="{{date('d/m/Y')}}" >
                </div>
                <div class="icon-filter-component search-date-option-filter-time-bar seemt-bg-blue h40">
                    <i class="fi-rr-filter seemt-gray-w600 seemt-blue"></i>
                </div>
            </div>
            <div class="custom-month d-flex add-display d-none">
                <div class="filter-form-date seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
                    <input class="from-month-filter-time-bar custom-month from-date-filter-input seemt-gray-w600 seemt-bg-gray-w200"
                           type="text" value="{{date('m/Y')}}">
                </div>
                <div class="icon-form-to seemt-bg-gray-w200">
                    <i class="fi-rr-angle-double-small-right seemt-gray-w600 seemt-border-none"></i>
                </div>
                <div class="filter-to-date seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
                    <input class="to-month-filter-time-bar custom-month from-date-filter-input seemt-gray-w600 seemt-bg-gray-w200"
                           type="text" value="{{date('m/Y')}}" >
                </div>
                <div class="icon-filter-component search-date-option-filter-time-bar seemt-bg-blue">
                    <i class="fi-rr-filter seemt-gray-w600  seemt-blue"></i>
                </div>
            </div>
            <div class="custom-year d-flex add-display d-none">
                <div class="filter-form-date seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
                    <input class="from-year-filter-time-bar custom-year from-date-filter-input seemt-gray-w600 seemt-bg-gray-w200"
                           type="text" value="{{date('Y')}}">
                </div>
                <div class="icon-form-to seemt-bg-gray-w200">
                    <i class="fi-rr-angle-double-small-right seemt-gray-w600 seemt-border-none"></i>
                </div>
                <div class="filter-to-date seemt-bg-gray-w200 align-items-center">
                    <i class="fi-rr-calendar seemt-gray-w600 pr-2" style="transform: translateY(2px);"></i>
                    <input class="to-year-filter-time-bar custom-year from-date-filter-input seemt-gray-w600 seemt-bg-gray-w200"
                           type="text" value="{{date('Y')}}" >
                </div>
                <div class="search-date-option-filter-time-bar icon-filter-component seemt-bg-blue">
                    <i class="fi-rr-filter"></i>
                </div>
            </div>
        </div>
    </div>
</div>
