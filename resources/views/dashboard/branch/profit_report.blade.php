<div class="card card-block card-inview-dashboard pt-2" id="profit-report" data-key="profit-report">
    <div class="row">
        <div class="sub-title p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2">
            <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">@lang('app.branch-dashboard.profit-report.title')
                <label class="title-header-dashboard-report" id="text-label-type-profit-report"></label>
            </h4>
            <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select" id="select-type-profit-report">
{{--                <div class="select-filter-type-date" id="time-bar-filter-order-manage">--}}
{{--                    <div class="form-validate-select position-relative">--}}
{{--                        <div class="select-material-box">--}}
{{--                            <select id="select-type-profit-report" class="js-example-basic-single select2-hidden-accessible form-control" tabindex="-1" aria-hidden="true">--}}
{{--                                <option value="1" data-time="{{date('d/m/Y')}}">@lang('app.branch-dashboard.select.option1')</option>--}}
{{--                                <option value="1" data-time="{{date('d/m/Y', strtotime('yesterday'))}}">@lang('app.branch-dashboard.select.option2')</option>--}}
{{--                                <option value="2" data-time="{{date('W/Y')}}">@lang('app.branch-dashboard.select.option3')</option>--}}
{{--                                <option value="3" data-time="{{date('m/Y')}}" selected="">@lang('app.branch-dashboard.select.option5')</option>--}}
{{--                                <option value="3" data-time="{{date('m/Y', strtotime('-1 month'))}}">@lang('app.branch-dashboard.select.option6')</option>--}}
{{--                                <option value="4" data-time="{{date('m/Y')}}">@lang('app.branch-dashboard.select.option7')</option>--}}
{{--                                <option value="5" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option8')</option>--}}
{{--                                <option value="5" data-time="{{date('Y', strtotime('-1 year'))}}">@lang('app.branch-dashboard.select.option11')</option>--}}
{{--                                <option value="6" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option9')</option>--}}
{{--                                <option value="8" data-time="{{substr(Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['created_at'], 6, 4)}}">@lang('app.branch-dashboard.select.option10')</option>--}}
{{--                            </select>--}}
{{--                            <div class="line"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                @include('dashboard.branch.filter')
                <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report" onclick="reloadProfitReport()"></i>
            </div>
        </div>
    </div>
{{--    <div class="card card-block statustic-card card-shadow-custom pt-2">--}}
{{--        <h4 class="sub-title font-weight-bold">@lang('app.branch-dashboard.profit-report.title-all-profit')</h4>--}}
        <div class="card-block p-t-0 load-chart-profit-day">
            <div class="row">
{{--                <div class="col-sm-4">--}}
{{--                    <div class="form-radio">--}}
{{--                        <form>--}}
{{--                            <div class="radio radio-inline">--}}
{{--                                <label>--}}
{{--                                    <input type="radio" id="show-vertical-all-profit-report" name="radio" checked>--}}
{{--                                    <i class="helper"></i>@lang('app.component.chart.vertical-chart')--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="radio radio-inline">--}}
{{--                                <label>--}}
{{--                                    <input type="radio" id="show-horizontal-all-profit-report" name="radio">--}}
{{--                                    <i class="helper"></i>@lang('app.component.chart.horizontal-chart')--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-4 text-center">--}}
{{--                    <h5 class="text-center text-inverse font-weight-bold">@lang('app.component.chart.total')--}}
{{--                        <span class="font-weight-bold"--}}
{{--                              id="total-profit-report">0</span> @lang('app.component.unit-money.vnd')</h5>--}}
{{--                </div>--}}
                <div class="col-sm-12 text-center">
                    <h5 class="text-center text-inverse font-weight-bold mb-0" style="font-size: 15px!important">
                        <span class="font-weight-bold" style="color: #fa6342;font-size: 20px!important" id="total-profit-report">0</span>  @lang('app.component.unit-money.vnd')</h5>
                </div>
                <div  class="col-sm-12 text-right">
                    <div class="checkbox-zoom zoom-primary">
                        <label class="focus-validate">
                            <input type="checkbox" value="" id="detail-value-profit-report">
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                            <span>Xem Chi tiết</span>
                        </label>
                    </div>
                </div>
{{--                <div class="col-sm-4">--}}
{{--                    <div class="checkbox-fade fade-in-primary float-right">--}}
{{--                        <label>--}}
{{--                            <input type="checkbox" id="label-chart-all-profit-report" checked>--}}
{{--                            <span class="cr"><i--}}
{{--                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
{{--                            <span>@lang('app.component.chart.check-detail')</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div id="chart-profit-report" class="vertical-chart style-large-chart-dashboard "></div>
        </div>
{{--    </div>--}}
{{--    <div class="card card-block statustic-card card-shadow-custom pt-2">--}}
{{--        <h4 class="sub-title font-weight-bold">@lang('app.branch-dashboard.profit-report.title-adjacent-profit')</h4>--}}
{{--        <div class="card-block p-t-0 load-chart-profit-day">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-3"></div>--}}
{{--                <div class="col-sm-6"></div>--}}
{{--                <div class="col-sm-3">--}}
{{--                    <div class="checkbox-fade fade-in-primary float-right">--}}
{{--                        <label>--}}
{{--                            <input type="checkbox" id="label-chart-adjacent-profit-report" checked>--}}
{{--                            <span class="cr"><i--}}
{{--                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
{{--                            <span>@lang('app.component.chart.check-detail')</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div id="chart-adjacent-profit-report" class="vertical-chart style-large-chart-dashboard"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="card card-block statustic-card card-shadow-custom pt-2">--}}
{{--        <h4 class="sub-title font-weight-bold">@lang('app.branch-dashboard.profit-report.title-same-period-profit')</h4>--}}
{{--        <div class="card-block p-t-0 load-chart-profit-day">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-3"></div>--}}
{{--                <div class="col-sm-6 row">--}}
{{--                    <div class="col-lg-4 text-center">--}}
{{--                        <h5 class="text-center text-inverse font-weight-bold">@lang('app.branch-dashboard.profit-report.total-profit')--}}
{{--                            :--}}
{{--                            <span class="font-weight-bold" id="total-revenue-profit-report">0</span>--}}
{{--                        </h5>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 text-center">--}}
{{--                        <h5 class="text-center text-inverse font-weight-bold">@lang('app.branch-dashboard.profit-report.total-same-period-profit')--}}
{{--                            :--}}
{{--                            <span class="font-weight-bold" id="total-same-period-profit-report">0</span>--}}
{{--                        </h5>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 text-center">--}}
{{--                        <h5 class="text-center text-inverse font-weight-bold">@lang('app.branch-dashboard.profit-report.total-rate-same-period-profit')--}}
{{--                            :--}}
{{--                            <span class="font-weight-bold" id="total-rate-same-period-profit-report">0</span>--}}
{{--                        </h5>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-3">--}}
{{--                    <div class="checkbox-fade fade-in-primary float-right">--}}
{{--                        <label>--}}
{{--                            <input type="checkbox" id="label-chart-same-period-profit-report" checked>--}}
{{--                            <span class="cr"><i--}}
{{--                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
{{--                            <span>@lang('app.component.chart.check-detail')</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div id="chart-same-period-profit-report" class="style-large-chart-dashboard"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
{{--<div class="font-18 font-weight-bold row" style="margin-bottom: 30px">--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--<div class="col-lg-4 text-center" style="color: #4c4c4c">@lang('app.branch-dashboard.profit-report.last-title')</div>--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--</div>--}}
@push('scripts')
    <script src="{{asset('js/dashboard/branch/profit_report.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
