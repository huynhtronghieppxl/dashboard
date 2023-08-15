<div class="card card-block card-shadow-custom-dashboard card-inview-dashboard" id="cost-report" data-key="cost-report">
    <div class="row">
        <div class="sub-title p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2">
            <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">@lang('app.branch-dashboard.cost-report.title')
                <label class="title-header-dashboard-report" id="text-label-type-cost-report"></label>
            </h4>
            <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select" id="select-type-cost-report">
                @include('dashboard.branch.filter')
                <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report" onclick="reloadCostReport()"></i>
            </div>
        </div>
    </div>

{{--    <h4 class="m-b-20 p-b-5 b-b-default f-w-600">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-9">--}}
{{--                <h4 class="font-weight-bold">@lang('app.branch-dashboard.cost-report.title')</h4>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 text-right row justify-content-end">--}}
{{--                <div class="select2_theme validate-group">--}}
{{--                    <div class="form-validate-select ">--}}
{{--                        <div class="col-lg-12 mx-0 px-0">--}}
{{--                            <div class="col-lg-12 pr-0 select-material-box pr-2">--}}
{{--                                <select id="select-type-cost-report" class="form-control border-0 select-not-select2">--}}
{{--                                    <option value="1" data-time="{{date('d/m/Y')}}">@lang('app.branch-dashboard.select.option1')</option>--}}
{{--                                    <option value="1" data-time="{{date('d/m/Y', strtotime('yesterday'))}}">@lang('app.branch-dashboard.select.option2')</option>--}}
{{--                                    <option value="2" data-time="{{date('W/Y')}}">@lang('app.branch-dashboard.select.option3')</option>--}}
{{--                                    <option value="3" data-time="{{date('m/Y')}}" selected="">@lang('app.branch-dashboard.select.option5')</option>--}}
{{--                                    <option value="3" data-time="{{date('m/Y', strtotime('-1 month'))}}">@lang('app.branch-dashboard.select.option6')</option>--}}
{{--                                    <option value="4" data-time="{{date('m/Y')}}">@lang('app.branch-dashboard.select.option7')</option>--}}
{{--                                    <option value="5" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option8')</option>--}}
{{--                                    <option value="5" data-time="{{date('Y', strtotime('-1 year'))}}">@lang('app.branch-dashboard.select.option11')</option>--}}
{{--                                    <option value="6" data-time="{{date('Y')}}">@lang('app.branch-dashboard.select.option9')</option>--}}
{{--                                    <option value="8" data-time="{{substr(Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['created_at'], 6, 4)}}">@lang('app.branch-dashboard.select.option10')</option>--}}
{{--                                </select>--}}
{{--                                <div class="line"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="pl-3 pt-1">--}}
{{--                    <i class="zmdi zmdi-refresh-sync d-inline fa-hover" onclick="reloadCostReport()"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </h4>--}}
{{--    <div class="card card-block statustic-card card-shadow-custom pt-2">--}}
{{--        <h4 class="sub-title font-weight-bold">@lang('app.branch-dashboard.cost-report.title-all-cost')</h4>--}}
        <div class="card-block p-t-0 load-chart-cost-day">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h5 class="text-center text-inverse font-weight-bold mb-0" style="font-size: 15px !important;"><span class="font-weight-bold" style="color: #fa6342; font-size: 20px !important;" id="total-cost-report">0</span> VNĐ</h5>
                </div>
                <div  class="col-sm-12 text-right">
                    <div class="checkbox-zoom zoom-primary">
                        <label class="focus-validate">
                            <input type="checkbox" value="" id="detail-value-cost-report">
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                            <span>Xem Chi tiết</span>
                        </label>
                    </div>
                </div>
            </div>
            <div id="chart-cost-current" class="style-large-chart-dashboard"></div>
            <div id="chart-cost-current-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">
                <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">
            </div>
        </div>
{{--    </div>--}}
{{--    <div class="card card-block statustic-card card-shadow-custom pt-2">--}}
{{--        <h4 class="sub-title font-weight-bold">@lang('app.branch-dashboard.cost-report.title-adjacent-cost')</h4>--}}
{{--        <div class="card-block p-t-0 load-chart-cost-day">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-4"></div>--}}
{{--                <div class="col-sm-8">--}}
{{--                    <div class="checkbox-fade fade-in-primary float-right">--}}
{{--                        <label>--}}
{{--                            <input type="checkbox" id="label-chart-adjacent-cost-report" checked>--}}
{{--                            <span class="cr"><i--}}
{{--                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
{{--                            <span>@lang('app.component.chart.check-detail')</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div id="chart-adjacent-cost-report" class="vertical-chart style-large-chart-dashboard"></div>--}}
{{--            <div id="chart-cost-adjacent" class="style-large-chart-dashboard"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="card card-block statustic-card card-shadow-custom pt-2">--}}
{{--        <h4 class="sub-title font-weight-bold">@lang('app.branch-dashboard.cost-report.title-same-period-cost')</h4>--}}
{{--        <div class="card-block p-t-0 load-chart-cost-day">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-3"></div>--}}
{{--                <div class="col-sm-6 row">--}}
{{--                    <div class="col-lg-4 text-center">--}}
{{--                        <h5 class="text-center text-inverse font-weight-bold">@lang('app.branch-dashboard.cost-report.total-cost')--}}
{{--                            :--}}
{{--                            <span class="font-weight-bold" id="total-revenue-cost-report">0</span>--}}
{{--                        </h5>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 text-center">--}}
{{--                        <h5 class="text-center text-inverse font-weight-bold">@lang('app.branch-dashboard.cost-report.total-same-period-cost')--}}
{{--                            :--}}
{{--                            <span class="font-weight-bold" id="total-same-period-cost-report">0</span>--}}
{{--                        </h5>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 text-center">--}}
{{--                        <h5 class="text-center text-inverse font-weight-bold">@lang('app.branch-dashboard.cost-report.total-rate-same-period-cost')--}}
{{--                            :--}}
{{--                            <span class="font-weight-bold" id="total-rate-same-period-cost-report">0</span>--}}
{{--                        </h5>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-3">--}}
{{--                    <div class="checkbox-fade fade-in-primary float-right">--}}
{{--                        <label>--}}
{{--                            <input type="checkbox" id="label-chart-same-period-cost-report" checked>--}}
{{--                            <span class="cr"><i--}}
{{--                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
{{--                            <span>@lang('app.component.chart.check-detail')</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div id="chart-same-period-cost-report" class="style-large-chart-dashboard"></div>--}}
{{--            <div id="chart-cost-same-period" class="style-large-chart-dashboard"></div>--}}

{{--        </div>--}}
{{--    </div>--}}
</div>
@push('scripts')
    <script src="{{asset('js/dashboard/branch/cost_report.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
