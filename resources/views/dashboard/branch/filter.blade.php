<style>
    .from-date-filter-input{
        padding: 5px 4px !important;
    }

    .sub-title button{
        margin-top: 0 !important;
    }

    .filter-form-date, .filter-to-date {
        display: flex;
        padding-left: 10px;
    }

    .icon-form-to {
        margin: 0 1px;
    }

    .icon-filter-component {
        margin: 0 10px 0 1px;
        color: var(--blue-color);
    }

    .icon-filter-component:hover {
        background: var(--blue-color) !important;
    }

    .icon-filter-component:hover i {
        color: #ffffff !important;
    }

</style>
<div class="filter-dashboard-report d-flex">
    <div class="filter-time-date-form-to-report filter-date" style="height: 32px">
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
                <i class="fi-rr-filter"></i>
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
                <i class="fi-rr-filter"></i>
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
    <div class="filter-time-date-report">
        <div class="select-filter-type-date">
            <div class="form-validate-select position-relative">
                <div class="select-material-box">
                    <select class="select-option-filter-report js-example-basic-single form-control" tabindex="-1" aria-hidden="true">
                        <option value="1" data-time="{{date('d/m/Y')}}">@lang('app.branch-dashboard.select.option1')</option>
                        <option value="1" data-time="{{date('d/m/Y', strtotime('yesterday'))}}">@lang('app.branch-dashboard.select.option2')</option>
                        <option value="2" data-time="{{date('W/Y')}}">@lang('app.branch-dashboard.select.option3')</option>
                        <option value="3" data-time="{{date('m/Y')}}" selected="">@lang('app.branch-dashboard.select.option5')</option>
                        <option value="3" data-time="{{date('m/Y', strtotime('-1 month'))}}">@lang('app.branch-dashboard.select.option6')</option>
                        <option value="4" data-time="{{date('m/Y')}}">@lang('app.branch-dashboard.select.option7')</option>
                        <option value="5" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option8')</option>
                        <option value="5" data-time="{{date('Y', strtotime('-1 year'))}}">@lang('app.branch-dashboard.select.option11')</option>
                        <option value="6" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option9')</option>
                        <option value="8" data-time="{{substr(Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['created_at'], 6, 4)}}">@lang('app.branch-dashboard.select.option10')</option>
                        <option value="13">
                            @lang('app.branch-dashboard.select.option12')</option>
                        <option value="15">
                            @lang('app.branch-dashboard.select.option13')</option>
                        <option value="16">
                            @lang('app.branch-dashboard.select.option14')</option>
                    </select>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </div>
</div>

