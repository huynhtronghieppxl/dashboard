<style>

</style>
<div class="report-revenue card-inview-dashboard" id="business-growth-report" data-key="business-growth-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>@lang('app.branch-dashboard.business-growth-report.title')</p>
        </div>
        <div class="d-flex">
            <div class="form-validate-select position-relative">
                <div class="select-material-box">
                    <select id="select-type-business-growth-report" class="js-example-basic-single select2-hidden-accessible form-control" tabindex="-1" aria-hidden="true">
                        <option value="3" data-time="{{date('m/Y')}}" data-val="1" data-time-val="{{date('m/Y')}}" selected>
                            @lang('app.branch-dashboard.select.option5')</option>
                        <option value="3" data-time="{{date('m/Y', strtotime('-1 month'))}}" data-val="2" data-time-val="{{date('m/Y', strtotime('-1 month'))}}">
                            @lang('app.branch-dashboard.select.option6')</option>
                        <option value="5" data-time="{{date('Y')}}" data-val="3" data-time-val="{{date('Y')}}">
                            @lang('app.branch-dashboard.select.option8')</option>
                        <option value="5" data-time="{{date('Y', strtotime('-1 year'))}}" data-val="4" data-time-val="{{date('Y', strtotime('-1 year'))}}">
                            @lang('app.branch-dashboard.select.option11')</option>
                    </select>
                    <div class="line"></div>
                </div>
            </div>
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadBusinessGrowthReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content">
        <div class="content-revenue-month-sub">
            <div class="row m-0 content-revenue-month-group">
                <div
                    class="col-lg-9 col-md-6 col-sm-12 seemt-border-radius-6 content-revenue-month-chart-report">
                    <div id="chart-test2-business-growth-report" class="count-loading-chart h-100 w-100"></div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pr-0">
                    <div class="revenue seemt-report-item">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-green mt-1">
                                <i class="fi-rr-stats seemt-green"></i>
                            </div>
                            <div class="content-revenue seemt-green d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 mr-1">@lang('app.branch-dashboard.business-growth-report.revenue')</label>
                                </div>
                                <div class="col-1 p-0 text-center">
                                    <i class="fi-rr-exclamation"></i>
                                </div>
                                <div class="total-revenue col-12 text-right">
                                    <label class="m-0 float-right font-weight-bold" id="total-test2-1">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="revenue seemt-report-item">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-orange mt-1">
                                <i class="fi-rr-chat-arrow-down seemt-orange"></i>
                            </div>
                            <div class="content-revenue seemt-orange d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 mr-1">@lang('app.branch-dashboard.business-growth-report.cost')</label>
                                </div>
                                <div class="col-1 p-0 text-center">
                                    <i class="fi-rr-exclamation"></i>
                                </div>
                                <div class="total-revenue col-12 seemt-orange text-right">
                                    <label class="m-0 float-right font-weight-bold" id="total-test2-2">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="revenue seemt-report-item">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-blue mt-1">
                                <i class="fi-rr-chat-arrow-grow seemt-blue"></i>
                            </div>
                            <div class="content-revenue seemt-orange d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 seemt-blue mr-1">@lang('app.branch-dashboard.business-growth-report.profit')</label>
                                </div>
                                <div class="col-1 p-0 text-center seemt-blue">
                                    <i class="fi-rr-exclamation"></i>
                                </div>
                                <div class="total-revenue col-12 text-right">
                                    <label class="m-0 float-right font-weight-bold seemt-blue" id="total-test2-3">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


























{{--<div class="card card-block tour-card2 card-inview-dashboard pt-2" id="business-growth-report" data-key="business-growth-report">--}}
{{--    <div class="row">--}}
{{--        <div class="sub-title p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2">--}}
{{--            <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">@lang('app.branch-dashboard.business-growth-report.title')--}}
{{--                <label class="title-header-dashboard-report" id="text-label-type-business-growth-report"></label>--}}
{{--            </h4>--}}
{{--            <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select">--}}
{{--                <div class="select-filter-type-date" id="time-bar-filter-order-manage">--}}
{{--                    <div class="form-validate-select position-relative">--}}
{{--                        <div class="select-material-box">--}}
{{--                            <select id="select-type-business-growth-report" class="js-example-basic-single select2-hidden-accessible form-control" tabindex="-1" aria-hidden="true">--}}
{{--                                <option value="3" data-time="{{date('m/Y')}}" data-val="1" data-time-val="{{date('m/Y')}}" selected>--}}
{{--                                    @lang('app.branch-dashboard.select.option5')</option>--}}
{{--                                <option value="3" data-time="{{date('m/Y', strtotime('-1 month'))}}" data-val="2" data-time-val="{{date('m/Y', strtotime('-1 month'))}}">--}}
{{--                                    @lang('app.branch-dashboard.select.option6')</option>--}}
{{--                                <option value="5" data-time="{{date('Y')}}" data-val="3" data-time-val="{{date('Y')}}">--}}
{{--                                    @lang('app.branch-dashboard.select.option8')</option>--}}
{{--                                <option value="5" data-time="{{date('Y', strtotime('-1 year'))}}" data-val="4" data-time-val="{{date('Y', strtotime('-1 year'))}}">--}}
{{--                                    @lang('app.branch-dashboard.select.option11')</option>--}}
{{--                            </select>--}}
{{--                            <div class="line"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report" onclick="reloadBusinessGrowthReport()"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12 col-lg-7 col-xl-8 edit-flex-auto-fill">--}}
{{--            <div class="card statustic-card card-shadow-custom flex-sub">--}}
{{--                <div class="card-block chart-container" style="height: 330px;">--}}
{{--                    <div id="chart-test2-business-growth-report" class="count-loading-chart h-100 w-100"></div>--}}
{{--                </div>--}}
{{--                <div class="sub-title p-b-0 m-b-0"></div>--}}
{{--                <div class="padding-edit-5-10 d-flex">--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-primary px-2"></i> <b class="reset-fz-chart">@lang('app.branch-dashboard.business-growth-report.revenue')</b></span>--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-danger px-2"></i> <b class="reset-fz-chart">@lang('app.branch-dashboard.business-growth-report.cost')</b></span>--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-success px-2"></i> <b class="reset-fz-chart">@lang('app.branch-dashboard.business-growth-report.profit')</b></span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-12 col-lg-5 col-xl-4 edit-flex-auto-fill">--}}
{{--            <div class="row w-100">--}}
{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-business-growth-report">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-primary reset-fontsize-icon label-actual">--}}
{{--                                        <i class="icofont icofont-chart-histogram icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-primary font-weight-bold text-right font-17 mr-0">--}}
{{--                                        @lang('app.branch-dashboard.business-growth-report.revenue')--}}
{{--                                        <div class="tool-box" style="width: max-content; display: inline-block;" data-toggle="tooltip" data-placement="top" data-original-title="Doanh thu từ toàn bộ đơn hàng(bao gồm cả VAT)">--}}
{{--                                            <i class="fa fa-exclamation-circle"></i>--}}
{{--                                        </div>--}}
{{--                                    </h5>--}}
{{--                                    <h4 class="text-primary font-weight-bold text-right reset-fontsize count-loading" id="total-test2-1">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12 p-0 mt-2">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-business-growth-report">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-danger reset-fontsize-icon label-actual">--}}
{{--                                        <i class="icofont icofont-chart-histogram icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-danger font-weight-bold text-right font-17 mr-0">@lang('app.branch-dashboard.business-growth-report.cost')</h5>--}}
{{--                                    <h4 class="text-danger font-weight-bold text-right reset-fontsize count-loading" id="total-test2-2">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12 p-0 mt-2">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-business-growth-report">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-success reset-fontsize-icon label-actual">--}}
{{--                                        <i class="icofont icofont-chart-bar-graph icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-success font-weight-bold text-right font-17 mr-0">@lang('app.branch-dashboard.business-growth-report.profit')</h5>--}}
{{--                                    <h4 class="text-success font-weight-bold text-right reset-fontsize count-loading" id="total-test2-3">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@push('scripts')
    <script src="{{asset('js/dashboard/branch/business_growth_report.js?version=82', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush

