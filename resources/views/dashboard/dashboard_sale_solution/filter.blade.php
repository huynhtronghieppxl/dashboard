<style>
    .from-date-filter-input{
        padding: 5px 4px !important;
    }

    .sub-title button{
        margin-top: 0 !important;
    }

    #filter-time-sell-solution .select-material-box {
        padding: 10px 0 0 0 !important;
    }

</style>
{{--<div class="filter-dashboard-report d-flex">--}}
{{--    <div class="filter-time-date-form-to-report">--}}
{{--        <div class="time-input-filter-time-bar time-input-filter-day-time-report d-none custom-date mr-1">--}}
{{--            <input class="from-day-filter-time-report custom-date from-date-filter-input p-1" type="text" value="{{date('d/m/Y')}}" />--}}
{{--            <span class="input-group-addon text-primary custom-find mt-0">Đến</span>--}}
{{--            <input class="to-day-filter-time-report custom-date from-date-filter-input p-1" type="text" value="{{date('d/m/Y')}}" />--}}
{{--            <div class="line-filter-time-bar"></div>--}}
{{--            <button class="search-date-filter-time-bar"><i class="fa fa-search"></i></button>--}}
{{--        </div>--}}
{{--        <div class="time-input-filter-time-bar custom-date time-input-filter-month-time-report mr-1 d-none">--}}
{{--            <input class="from-month-filter-time-report custom-date from-date-filter-input p-1" type="text" value="{{date('m/Y')}}" />--}}
{{--            <span class="input-group-addon text-primary custom-find mt-0">Đến</span>--}}
{{--            <input class="to-month-filter-time-report custom-date from-date-filter-input p-1" type="text" value="{{date('m/Y')}}" />--}}
{{--            <div class="line-filter-time-bar"></div>--}}
{{--            <button class="search-date-filter-time-bar"><i class="fa fa-search"></i></button>--}}
{{--        </div>--}}
{{--        <div class="time-input-filter-time-bar custom-date mr-1 time-input-filter-year-time-report d-none">--}}
{{--            <input class="from-year-filter-time-report custom-date from-date-filter-input p-1" type="text" value="{{date('Y')}}" />--}}
{{--            <span class="input-group-addon text-primary custom-find mt-0">Đến</span>--}}
{{--            <input class="to-year-filter-time-report custom-date from-date-filter-input p-1" type="text" value="{{date('Y')}}" />--}}
{{--            <div class="line-filter-time-bar"></div>--}}
{{--            <button class="search-date-filter-time-bar"><i class="fa fa-search"></i></button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="filter-time-date-report">--}}
{{--        <div class="select-filter-type-date">--}}
{{--            <div class="form-validate-select position-relative">--}}
{{--                <div class="select-material-box">--}}
{{--                    <select class="select-option-filter-report js-example-basic-single form-control" tabindex="-1" aria-hidden="true">--}}
{{--                        <option value="1" data-time="{{date('d/m/Y')}}">@lang('app.branch-dashboard.select.option1')</option>--}}
{{--                        <option value="1" data-time="{{date('d/m/Y', strtotime('yesterday'))}}">@lang('app.branch-dashboard.select.option2')</option>--}}
{{--                        <option value="2" data-time="{{date('W/Y')}}">@lang('app.branch-dashboard.select.option3')</option>--}}
{{--                        <option value="3" data-time="{{date('m/Y')}}" selected="">@lang('app.branch-dashboard.select.option5')</option>--}}
{{--                        <option value="3" data-time="{{date('m/Y', strtotime('-1 month'))}}">@lang('app.branch-dashboard.select.option6')</option>--}}
{{--                        <option value="4" data-time="{{date('m/Y')}}">@lang('app.branch-dashboard.select.option7')</option>--}}
{{--                        <option value="5" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option8')</option>--}}
{{--                        <option value="5" data-time="{{date('Y', strtotime('-1 year'))}}">@lang('app.branch-dashboard.select.option11')</option>--}}
{{--                        <option value="6" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option9')</option>--}}
{{--                        <option value="8" data-time="{{substr(Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['created_at'], 6, 4)}}">@lang('app.branch-dashboard.select.option10')</option>--}}
{{--                        <option value="13">--}}
{{--                            @lang('app.branch-dashboard.select.option12')</option>--}}
{{--                        <option value="15">--}}
{{--                            @lang('app.branch-dashboard.select.option13')</option>--}}
{{--                        <option value="16">--}}
{{--                            @lang('app.branch-dashboard.select.option14')</option>--}}
{{--                    </select>--}}
{{--                    <div class="line"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="filter-dashboard-report d-flex" id="filter-time-sell-solution">
    <div class="filter-time-date-form-to-report">
        <div class="time-input-filter-time-bar time-input-filter-day-time-report d-none custom-date mr-1">
            <input class="from-day-filter-time-report custom-date from-date-filter-input p-1" type="text" value="{{date('d/m/Y')}}" />
            <span class="input-group-addon text-primary custom-find mt-0">Đến</span>
            <input class="to-day-filter-time-report custom-date from-date-filter-input p-1" type="text" value="{{date('d/m/Y')}}" />
            <div class="line-filter-time-bar"></div>
            <button class="search-date-filter-time-bar"><i class="fa fa-search"></i></button>
        </div>
        <div class="time-input-filter-time-bar custom-date time-input-filter-month-time-report mr-1 d-none">
            <input class="from-month-filter-time-report custom-date from-date-filter-input p-1" type="text" value="{{date('m/Y')}}" />
            <span class="input-group-addon text-primary custom-find mt-0">Đến</span>
            <input class="to-month-filter-time-report custom-date from-date-filter-input p-1" type="text" value="{{date('m/Y')}}" />
            <div class="line-filter-time-bar"></div>
            <button class="search-date-filter-time-bar"><i class="fa fa-search"></i></button>
        </div>
        <div class="time-input-filter-time-bar custom-date mr-1 time-input-filter-year-time-report d-none">
            <input class="from-year-filter-time-report custom-date from-date-filter-input p-1" type="text" value="{{date('Y')}}" />
            <span class="input-group-addon text-primary custom-find mt-0">Đến</span>
            <input class="to-year-filter-time-report custom-date from-date-filter-input p-1" type="text" value="{{date('Y')}}" />
            <div class="line-filter-time-bar"></div>
            <button class="search-date-filter-time-bar"><i class="fa fa-search"></i></button>
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
