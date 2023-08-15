{{--<div class="card card-block tour-card2 card-inview-dashboard pt-2" id="revenue-cost-profit-report" data-key="revenue-cost-profit-report">--}}
{{--    <div class="row">--}}
{{--        <div class="p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2">--}}
{{--            <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">@lang('app.branch-dashboard.revenue-cost-profit-report.title')--}}
{{--                <label class="title-header-dashboard-report" id="text-label-type-revenue-cost-profit-report"></label>--}}
{{--            </h4>--}}
{{--            <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select">--}}
{{--                <div class="select-filter-type-date" id="time-bar-filter-order-manage">--}}
{{--                    <div class="form-validate-select position-relative">--}}
{{--                        <div class="select-material-box">--}}
{{--                            <select id="select-type-revenue-cost-profit-report" class="js-example-basic-single select2-hidden-accessible form-control" tabindex="-1" aria-hidden="true">--}}
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
{{--                <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report" onclick="reloadRevenueCostProfitReport()"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12 col-lg-7 col-xl-8 edit-flex-auto-fill">--}}
{{--            <div class="card statustic-card card-shadow-custom flex-sub">--}}
{{--                <h5 class="sub-title">@lang('app.branch-dashboard.revenue-cost-profit-report.title2')</h5>--}}
{{--                <div class="card-block chart-container h-100 loading-card2">--}}
{{--                    <div id="chart-revenue-card2" class="count-loading-chart h-100 w-100"></div>--}}
{{--                </div>--}}
{{--                <div class="sub-title p-b-0 m-b-0"></div>--}}
{{--                <div class="padding-edit-5-10 d-flex">--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-primary px-2"></i> <b class="reset-fz-chart">@lang('app.branch-dashboard.revenue-cost-profit-report.chart1_card2_revenue')</b></span>--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-danger px-2"></i> <b class="reset-fz-chart">@lang('app.branch-dashboard.revenue-cost-profit-report.chart1_card2_cost')</b></span>--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-success px-2"></i> <b class="reset-fz-chart">@lang('app.branch-dashboard.revenue-cost-profit-report.chart1_card2_profit')</b></span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-12 col-lg-5 col-xl-4 edit-flex-auto-fill">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-reveneu-report height-card-block-custom">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-primary reset-fontsize-icon label-actual">--}}
{{--                                        <i class="icofont icofont-coins icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-primary font-weight-bold text-right font-17 mr-0">--}}
{{--                                        @lang('app.branch-dashboard.revenue-cost-profit-report.estimate.revenue')--}}
{{--                                        <div class="tool-box" style="width: max-content; display: inline-block;" data-toggle="tooltip" data-placement="top" data-original-title="Doanh thu từ toàn bộ đơn hàng">--}}
{{--                                            <i class="fa fa-exclamation-circle"></i>--}}
{{--                                        </div>--}}
{{--                                    </h5>--}}
{{--                                    <h4 class="text-primary font-weight-bold text-right reset-fontsize count-loading" id="revenue_total">0</h4>--}}
{{--                                    <div class="text-right">--}}
{{--                                        <a href="javascript:void(0)" class="showmore underline-detail" onclick="openModalDetailRevenueCostProfit(0, 4)">Chi tiết</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-reveneu-report height-card-block-custom">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-danger reset-fontsize-icon label-actual">--}}
{{--                                        <i class="feather ion-cash icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-danger font-weight-bold text-right font-17 mr-0">--}}
{{--                                        @lang('app.branch-dashboard.revenue-cost-profit-report.estimate.cost')--}}
{{--                                    </h5>--}}
{{--                                    <h4 class="text-danger font-weight-bold text-right reset-fontsize count-loading" id="cost_total">0</h4>--}}
{{--                                    <div class="text-right">--}}
{{--                                        <a href="javascript:void(0)" class="showmore underline-detail" onclick="openModalDetailCostEstimate()">Chi tiết</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-reveneu-report height-card-block-custom">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-success reset-fontsize-icon label-actual">--}}
{{--                                        <i class="icofont icofont-chart-histogram-alt icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-success font-weight-bold text-right font-17 mr-0">--}}
{{--                                        @lang('app.branch-dashboard.revenue-cost-profit-report.estimate.profit')--}}
{{--                                    </h5>--}}
{{--                                    <h4 class="text-success font-weight-bold text-right reset-fontsize count-loading" id="profit_total">0</h4>--}}
{{--                                    <div class="text-right">--}}
{{--                                        <a href="javascript:void(0)" class="showmore underline-detail" onclick=""></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12 p-0" id="profit-rates-estimate">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-reveneu-report">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-warning reset-fontsize-icon label-actual">--}}
{{--                                        <i class="typcn typcn-chart-pie icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-warning font-weight-bold text-right font-17 mr-0">--}}
{{--                                        @lang('app.branch-dashboard.revenue-cost-profit-report.estimate.rate_profit')--}}
{{--                                    </h5>--}}
{{--                                    <h4 class="text-warning font-weight-bold text-right reset-fontsize count-loading" id="profit_rates_total">0</h4>--}}
{{--                                    <div class="progress m-t-15 reset-width reset-m-t">--}}
{{--                                        <div class="progress-bar progress-profit-rates-total"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="sub-title w-100 mt-2"></div>--}}
{{--        <div class="col-md-12 col-lg-7 col-xl-8 edit-flex-auto-fill">--}}
{{--            <div class="card statustic-card card-shadow-custom flex-sub">--}}
{{--                <h5 class="sub-title">@lang('app.branch-dashboard.revenue-cost-profit-report.title1')</h5>--}}
{{--                <div class="card-block chart-container h-100 loading-card2">--}}
{{--                    <div id="chart-revenue-card2-1" class="count-loading-chart h-100 w-100"></div>--}}
{{--                </div>--}}
{{--                <div class="sub-title p-b-0 m-b-0"></div>--}}
{{--                <div class="padding-edit-5-10 d-flex">--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-primary px-2"></i> <b class="reset-fz-chart">@lang('app.branch-dashboard.revenue-cost-profit-report.chart1_card2_revenue')</b></span>--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-danger px-2"></i> <b class="reset-fz-chart">@lang('app.branch-dashboard.revenue-cost-profit-report.chart1_card2_cost')</b></span>--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-success px-2"></i> <b class="reset-fz-chart">@lang('app.branch-dashboard.revenue-cost-profit-report.chart1_card2_profit')</b></span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-12 col-lg-5 col-xl-4 edit-flex-auto-fill">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-reveneu-report height-card-block-custom">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-primary reset-fontsize-icon label-actual">--}}
{{--                                        <i class="icofont icofont-coins icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-primary font-weight-bold text-right font-17 mr-0">--}}
{{--                                        @lang('app.branch-dashboard.revenue-cost-profit-report.present.revenue')--}}
{{--                                        <div class="tool-box" style="width: max-content; display: inline-block;" data-toggle="tooltip" data-placement="top" data-original-title="Doanh thu từ toàn bộ đơn hàng">--}}
{{--                                            <i class="fa fa-exclamation-circle"></i>--}}
{{--                                        </div>--}}
{{--                                    </h5>--}}
{{--                                    <h4 class="text-primary font-weight-bold text-right reset-fontsize count-loading" id="revenue_present">0</h4>--}}
{{--                                    <div class="text-right">--}}
{{--                                        <a href="javascript:void(0)" class="showmore underline-detail" onclick="openModalDetailRevenueCostProfit(0, 4)">Chi tiết</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-reveneu-report height-card-block-custom">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-danger reset-fontsize-icon label-actual">--}}
{{--                                        <i class="feather ion-cash icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-danger font-weight-bold text-right font-17 mr-0">--}}
{{--                                        @lang('app.branch-dashboard.revenue-cost-profit-report.present.cost')--}}
{{--                                        <div class="tool-box" style="width: max-content; display: inline-block;" data-toggle="tooltip" data-placement="top" data-original-title="Bao gồm các phiếu chi ở trạng thái đã chi">--}}
{{--                                            <i class="fa fa-exclamation-circle"></i>--}}
{{--                                        </div>--}}
{{--                                    </h5>--}}
{{--                                    <h4 class="text-danger font-weight-bold text-right reset-fontsize count-loading" id="cost_present">0</h4>--}}
{{--                                    <div class="text-right">--}}
{{--                                        <a href="javascript:void(0)" class="showmore underline-detail" onclick="openModalDetailCostCurrent()">Chi tiết</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-reveneu-report height-card-block-custom">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-success reset-fontsize-icon label-actual">--}}
{{--                                        <i class="icofont icofont-chart-histogram-alt icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-success font-weight-bold text-right font-17 mr-0">--}}
{{--                                        @lang('app.branch-dashboard.revenue-cost-profit-report.present.profit')--}}
{{--                                    </h5>--}}
{{--                                    <h4 class="text-success font-weight-bold text-right reset-fontsize count-loading" id="profit_present">0</h4>--}}
{{--                                    <div class="text-right">--}}
{{--                                        <a href="javascript:void(0)" class="showmore underline-detail" onclick=""></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                --}}{{----}}
{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--                    --}}{{-- --}}{{----}}
{{--            <div class="card statustic-progress-card card-shadow-custom feed-card" --}}{{-- --}}{{-- id="profit-rates-card-present">--}}
{{--                --}}{{-- --}}{{----}}
{{--                <h5 class="sub-title m-10">@lang('app.branch-dashboard.revenue-cost-profit-report.present.rate_profit')--}}{{-- --}}{{--</h5>--}}
{{--                --}}{{-- --}}{{----}}
{{--                <div class="card-block p-t-0">--}}
{{--                    --}}{{-- --}}{{----}}
{{--                    <div class="row align-items-center loading-card2">--}}
{{--                        --}}{{-- --}}{{----}}
{{--                        <div class="col-sm-3">--}}
{{--                            --}}{{-- --}}{{-- <label class="label label-warning label-circle reset-fontsize-icon">--}}{{-- --}}{{-- <i class="typcn typcn-chart-pie"></i>--}}{{-- --}}{{-- </label>--}}{{-- --}}{{----}}
{{--                        </div>--}}
{{--                        --}}{{-- --}}{{----}}
{{--                        <div class="col-sm-9">--}}
{{--                            --}}{{-- --}}{{----}}
{{--                            <div class="col text-right">--}}
{{--                                --}}{{-- --}}{{----}}
{{--                                <h4 class="text-c-yellow count-loading loading-reveneu-report" --}}{{-- --}}{{-- id="profit_rates_present">0</h4>--}}
{{--                                --}}{{-- --}}{{----}}
{{--                            </div>--}}
{{--                            --}}{{-- --}}{{----}}
{{--                            <div class="progress m-t-15 reset-width reset-m-t">--}}
{{--                                --}}{{-- --}}{{----}}
{{--                                <div class="progress-bar progress-profit-rates-present"></div>--}}
{{--                                --}}{{-- --}}{{----}}
{{--                            </div>--}}
{{--                            --}}{{-- --}}{{----}}
{{--                        </div>--}}
{{--                        --}}{{-- --}}{{----}}
{{--                    </div>--}}
{{--                    --}}{{-- --}}{{----}}
{{--                </div>--}}
{{--                --}}{{-- --}}{{----}}
{{--            </div>--}}
{{--            --}}{{-- --}}{{----}}
{{--        </div>--}}
{{--        --}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="sub-title w-100 mt-2"></div>--}}
{{--        <div class="col-md-12 col-lg-7 col-xl-8 edit-flex-auto-fill">--}}
{{--            <div class="card statustic-card card-shadow-custom flex-sub" id="chart_card3_wrapper">--}}
{{--                <h5 class="sub-title">@lang('app.branch-dashboard.revenue-cost-profit-report.title3')</h5>--}}
{{--                <div class="card-block chart-container h-100 loading-card2">--}}
{{--                    <div id="chart-revenue-card2-3" class="count-loading-chart h-100 w-100"></div>--}}
{{--                </div>--}}
{{--                <div class="sub-title p-b-0 m-b-0"></div>--}}
{{--                <div class="padding-edit-5-10 d-flex">--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-primary px-2"></i> <b class="reset-fz-chart">@lang('app.branch-dashboard.revenue-cost-profit-report.chart1_card2_revenue')</b></span>--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-danger px-2"></i> <b class="reset-fz-chart">@lang('app.branch-dashboard.revenue-cost-profit-report.chart1_card2_cost')</b></span>--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-success px-2"></i> <b class="reset-fz-chart">@lang('app.branch-dashboard.revenue-cost-profit-report.chart1_card2_profit')</b></span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-12 col-lg-5 col-xl-4 edit-flex-auto-fill">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-reveneu-report height-card-block-custom">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-primary reset-fontsize-icon label-actual">--}}
{{--                                        <i class="icofont icofont-coins icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-primary font-weight-bold text-right font-17 mr-0">--}}
{{--                                        @lang('app.branch-dashboard.revenue-cost-profit-report.total.revenue')--}}
{{--                                        <div class="tool-box" style="width: max-content; display: inline-block;" data-toggle="tooltip" data-placement="top" data-original-title="Gồm doanh thu bán hàng + Phiếu thu">--}}
{{--                                            <i class="fa fa-exclamation-circle"></i>--}}
{{--                                        </div>--}}
{{--                                    </h5>--}}
{{--                                    <h4 class="text-primary font-weight-bold text-right reset-fontsize count-loading" id="revenue_present_total">0</h4>--}}
{{--                                    <div class="text-right">--}}
{{--                                        <a href="javascript:void(0)" class="showmore underline-detail" onclick="openModalDetailRevenueCostProfit(0, -1)">Chi tiết</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-reveneu-report height-card-block-custom">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-danger reset-fontsize-icon label-actual">--}}
{{--                                        <i class="feather ion-cash icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-danger font-weight-bold text-right font-17 mr-0">--}}
{{--                                        @lang('app.branch-dashboard.revenue-cost-profit-report.total.cost')--}}
{{--                                    </h5>--}}
{{--                                    <h4 class="text-danger font-weight-bold text-right reset-fontsize count-loading" id="cost_present_total">0</h4>--}}
{{--                                    <div class="text-right">--}}
{{--                                        <a href="javascript:void(0)" class="showmore underline-detail" onclick="openModalDetailCost()">Chi tiết</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-reveneu-report height-card-block-custom">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-success reset-fontsize-icon label-actual">--}}
{{--                                        <i class="icofont icofont-chart-histogram-alt icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-success font-weight-bold text-right font-17 mr-0">--}}
{{--                                        @lang('app.branch-dashboard.revenue-cost-profit-report.total.profit')--}}
{{--                                    </h5>--}}
{{--                                    <h4 class="text-success font-weight-bold text-right reset-fontsize count-loading" id="profit_present_total">0</h4>--}}
{{--                                    <div class="text-right">--}}
{{--                                        <a href="javascript:void(0)" class="showmore underline-detail" onclick=""></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12 p-0" id="reveneu-cost-profit-rate-total">--}}
{{--                    <div class="card status-progress-card card-shadow-custom feed-card p-0 count-loading loading-reveneu-report height-card-block-custom">--}}
{{--                        <div class="card-block">--}}
{{--                            <div class="row align-items-center loading-card2 estimate-card-report-loading">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-warning reset-fontsize-icon label-actual">--}}
{{--                                        <i class="typcn typcn-chart-pie icon-actual"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <h5 class="text-warning font-weight-bold text-right font-17 mr-0">--}}
{{--                                        @lang('app.branch-dashboard.revenue-cost-profit-report.total.rate_profit')--}}
{{--                                    </h5>--}}
{{--                                    <h4 class="text-warning font-weight-bold text-right reset-fontsize count-loading" id="profit_rates_present_total">0</h4>--}}
{{--                                    <div class="progress m-t-15 reset-width reset-m-t">--}}
{{--                                        <div class="progress-bar progress-profit-rates-total"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        --}}{{--        <div class="sub-title w-100 d-none chart-card2-office"></div>--}}
{{--        --}}{{--        <div class="col-md-12 col-lg-8 col-xl-9 edit-flex-auto-fill d-none chart-card2-office">--}}
{{--        --}}{{--            <div class="card statustic-card card-shadow-custom flex-sub">--}}
{{--        --}}{{--                <h5 class="sub-title">@lang('app.branch-dashboard.revenue-cost-profit-report.title4')</h5>--}}
{{--        --}}{{--                <div class="card-block chart-container h-100 loading-card2">--}}
{{--        --}}{{--                    <div id="chart-revenue-card2-4" class="count-loading-chart h-100 w-100">--}}
{{--        --}}{{--                    </div>--}}
{{--        --}}{{--                </div>--}}
{{--        --}}{{--                <div class="sub-title p-b-0 m-b-0"></div>--}}
{{--        --}}{{--                <div class="padding-edit-5-10 d-flex">--}}
{{--        --}}{{--                    <span><i class="ion-arrow-graph-up-right text-primary px-2"></i> <b--}}
{{--        --}}{{--                                class="reset-fz-chart">@lang('app.branch-dashboard.revenue-cost-profit-report.chart1_card2_revenue')</b></span>--}}
{{--        --}}{{--                    <span><i class="ion-arrow-graph-up-right text-danger px-2"></i> <b--}}
{{--        --}}{{--                                class="reset-fz-chart">@lang('app.branch-dashboard.revenue-cost-profit-report.chart1_card2_cost')</b></span>--}}
{{--        --}}{{--                    <span><i class="ion-arrow-graph-up-right text-success px-2"></i> <b--}}
{{--        --}}{{--                                class="reset-fz-chart">@lang('app.branch-dashboard.revenue-cost-profit-report.chart1_card2_profit')</b></span>--}}
{{--        --}}{{--                </div>--}}
{{--        --}}{{--            </div>--}}
{{--        --}}{{--        </div>--}}
{{--        --}}{{--        <div class="col-md-12 col-lg-4 col-xl-3 edit-flex-auto-fill d-none chart-card2-office">--}}
{{--        --}}{{--            <div class="row">--}}
{{--        --}}{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--        --}}{{--                    <div class="card statustic-progress-card card-shadow-custom feed-card">--}}
{{--        --}}{{--                        <h5 class="sub-title m-10">@lang('app.branch-dashboard.revenue-cost-profit-report.office.revenue') <i--}}
{{--        --}}{{--                                    class="typcn typcn-info-large-outline font-size-1rem  float-right cursor-pointer"--}}
{{--        --}}{{--                                    onclick="openTooltioModal()"></i></h5>--}}
{{--        --}}{{--                        <div class="card-block p-t-0">--}}
{{--        --}}{{--                            <div class="row align-items-center loading-card2">--}}
{{--        --}}{{--                                <div class="col-sm-3">--}}
{{--        --}}{{--                                    <label class="label label-primary label-circle reset-fontsize-icon">--}}
{{--        --}}{{--                                        <i class="icofont icofont-coins"></i>--}}
{{--        --}}{{--                                    </label>--}}
{{--        --}}{{--                                </div>--}}
{{--        --}}{{--                                <div class="col-sm-9 text-right reset-p-r">--}}
{{--        --}}{{--                                    <h4 class="text-primary font-weight-bold reset-fontsize count-loading"--}}
{{--        --}}{{--                                        id="revenue_present_total_office">0</h4>--}}
{{--        --}}{{--                                </div>--}}
{{--        --}}{{--                            </div>--}}
{{--        --}}{{--                        </div>--}}
{{--        --}}{{--                    </div>--}}
{{--        --}}{{--                </div>--}}
{{--        --}}{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--        --}}{{--                    <div class="card statustic-progress-card card-shadow-custom feed-card">--}}
{{--        --}}{{--                        <h5 class="sub-title m-10">@lang('app.branch-dashboard.revenue-cost-profit-report.office.cost') <i--}}
{{--        --}}{{--                                    class="typcn typcn-info-large-outline font-size-1rem float-right cursor-pointer"--}}
{{--        --}}{{--                                    onclick="openTooltioModal()"></i></h5>--}}
{{--        --}}{{--                        <div class="card-block p-t-0">--}}
{{--        --}}{{--                            <div class="row align-items-center loading-card2">--}}
{{--        --}}{{--                                <div class="col-sm-3">--}}
{{--        --}}{{--                                    <label class="label label-danger label-circle reset-fontsize-icon">--}}
{{--        --}}{{--                                        <i class="feather ion-cash"></i>--}}
{{--        --}}{{--                                    </label>--}}
{{--        --}}{{--                                </div>--}}
{{--        --}}{{--                                <div class="col-sm-9 text-right reset-p-r">--}}
{{--        --}}{{--                                    <h4 class="text-c-pink font-weight-bold reset-fontsize count-loading"--}}
{{--        --}}{{--                                        id="cost_present_total_office">0</h4>--}}
{{--        --}}{{--                                </div>--}}
{{--        --}}{{--                            </div>--}}
{{--        --}}{{--                        </div>--}}
{{--        --}}{{--                    </div>--}}
{{--        --}}{{--                </div>--}}
{{--        --}}{{--                <div class="col-md-6 col-lg-12 p-0">--}}
{{--        --}}{{--                    <div class="card statustic-progress-card card-shadow-custom feed-card">--}}
{{--        --}}{{--                        <h5 class="sub-title m-10">@lang('app.branch-dashboard.revenue-cost-profit-report.office.profit') <i--}}
{{--        --}}{{--                                    class="typcn typcn-info-large-outline font-size-1rem  float-right cursor-pointer"--}}
{{--        --}}{{--                                    onclick="openTooltioModal()"></i></h5>--}}
{{--        --}}{{--                        <div class="card-block p-t-0">--}}
{{--        --}}{{--                            <div class="row align-items-center loading-card2">--}}
{{--        --}}{{--                                <div class="col-sm-3">--}}
{{--        --}}{{--                                    <label class="label label-success label-circle reset-fontsize-icon">--}}
{{--        --}}{{--                                        <i class="icofont icofont-chart-histogram-alt"></i>--}}
{{--        --}}{{--                                    </label>--}}
{{--        --}}{{--                                </div>--}}
{{--        --}}{{--                                <div class="col-sm-9 text-right reset-p-r">--}}
{{--        --}}{{--                                    <h4 class="text-c-green font-weight-bold reset-fontsize count-loading"--}}
{{--        --}}{{--                                        id="profit_present_total_office">0</h4>--}}
{{--        --}}{{--                                </div>--}}
{{--        --}}{{--                            </div>--}}
{{--        --}}{{--                        </div>--}}
{{--        --}}{{--                    </div>--}}
{{--        --}}{{--                </div>--}}
{{--        --}}{{--            </div>--}}
{{--        --}}{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<style>
    .seemt-container .seemt-main i {
        font-size: 16.5px;
        vertical-align: sub;
        display: inline-block !important;
    }
    #revenue-cost-profit-report .select2-selection__arrow {
        transform: translateY(-11px);
    }
</style>
<div class="report-revenue card-inview-dashboard" id="revenue-cost-profit-report" data-key="revenue-cost-profit-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>@lang('app.branch-dashboard.revenue-cost-profit-report.title')</p>
        </div>
        <div class="d-flex">
            <div class="form-validate-select position-relative">
                <div class="select-material-box" style="padding: 10px 0 0 0 !important;">
                    <select id="select-type-revenue-cost-profit-report" class="js-example-basic-single select2-hidden-accessible form-control" tabindex="-1" aria-hidden="true">
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
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadRevenueCostProfitReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content pb-0">
        <div class="revenue-content-sub">
            <div class="revenue-month seemt-green seemt-border-bottom">
                <div class="title-revenue-month-sub seemt-before-green">
                    <p id="title-card1">@lang('app.branch-dashboard.revenue-cost-profit-report.title2')</p>
                </div>
            </div>
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div
                        class="col-lg-9 col-md-6 col-sm-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div id="chart-revenue-card2" class="count-loading-chart h-100 w-100"></div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-blue mt-1">
                                    <i class="fi-rr-chat-arrow-grow seemt-blue"></i>
                                </div>
                                <div class="content-revenue seemt-orange d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 seemt-blue mr-1">Doanh thu bán hàng</label>
                                    </div>
                                    <div class="col-1 p-0 text-center seemt-blue" data-toggle="tooltip" data-placement="top" data-original-title="Doanh thu từ toàn bộ đơn hàng">
                                        <i class="fi-rr-exclamation" ></i>
                                    </div>
                                    <div class="total-revenue col-12 text-right">
                                        <label class="m-0 float-right font-weight-bold seemt-blue" id="revenue_total">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-red mt-1">
                                    <i class="fi-rr-chat-arrow-grow seemt-red"></i>
                                </div>
                                <div class="content-revenue seemt-orange d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 seemt-red mr-1">Chi phí ước tính</label>
                                    </div>
                                    <div class="total-revenue col-12 text-right">
                                        <label class="m-0 float-right font-weight-bold seemt-red" id="cost_total">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-green mt-1">
                                    <i class="fi-rr-stats seemt-green"></i>
                                </div>
                                <div class="content-revenue seemt-green d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 mr-1">Lợi nhuận bán hàng ước tính</label>
                                    </div>
                                    <div class="total-revenue col-12 text-right">
                                        <label class="m-0 float-right font-weight-bold" id="profit_total">0</label>
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
                                        <label class="m-0 mr-1">Tỷ suất lợi nhuận bán ước tính</label>
                                    </div>
                                    <div class="total-revenue col-12 seemt-orange text-right">
                                        <label class="m-0 float-right font-weight-bold" id="profit_rates_total">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content pb-0">
        <div class="revenue-content-sub">
            <div class="revenue-month seemt-green seemt-border-bottom">
                <div class="title-revenue-month-sub seemt-before-green">
                    <p id="title-card1">@lang('app.branch-dashboard.revenue-cost-profit-report.title1')</p>
                </div>
            </div>
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div
                        class="col-lg-9 col-md-6 col-sm-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div id="chart-revenue-card2-1" class="count-loading-chart h-100 w-100"></div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-blue mt-1">
                                    <i class="fi-rr-chat-arrow-grow seemt-blue"></i>
                                </div>
                                <div class="content-revenue seemt-orange d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 seemt-blue mr-1">Doanh thu tổng hợp</label>
                                    </div>
                                    <div class="col-1 p-0 text-center seemt-blue" data-toggle="tooltip" data-placement="top" data-original-title="Doanh thu từ toàn bộ đơn hàng">
                                        <i class="fi-rr-exclamation"></i>
                                    </div>
                                    <div class="total-revenue col-12 text-right">
                                        <label class="m-0 float-right font-weight-bold seemt-blue" id="revenue_present">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-red mt-1" >
                                    <i class="fi-rr-chat-arrow-grow seemt-red"></i>
                                </div>
                                <div class="content-revenue seemt-orange d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 seemt-red mr-1">Chi phí thực tế</label>
                                    </div>
                                    <div class="col-1 p-0 text-center seemt-red" data-toggle="tooltip" data-placement="top" data-original-title="Bao gồm các phiếu chi ở trạng thái đã chi">
                                        <i class="fi-rr-exclamation"></i>
                                    </div>
                                    <div class="total-revenue col-12 text-right">
                                        <label class="m-0 float-right font-weight-bold seemt-red" id="cost_present">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-green mt-1">
                                    <i class="fi-rr-stats seemt-green"></i>
                                </div>
                                <div class="content-revenue seemt-green d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 mr-1">Quỹ tiền còn lại</label>
                                    </div>
                                    <div class="total-revenue col-12 text-right">
                                        <label class="m-0 float-right font-weight-bold" id="profit_present">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content pb-0">
        <div class="revenue-content-sub">
            <div class="revenue-month seemt-green seemt-border-bottom">
                <div class="title-revenue-month-sub seemt-before-green">
                    <p id="title-card1">@lang('app.branch-dashboard.revenue-cost-profit-report.title3')</p>
                </div>
            </div>
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div
                        class="col-lg-9 col-md-6 col-sm-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div id="chart-revenue-card2-3" class="count-loading-chart h-100 w-100"></div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-blue mt-1">
                                    <i class="fi-rr-chat-arrow-grow seemt-blue"></i>
                                </div>
                                <div class="content-revenue seemt-orange d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 seemt-blue mr-1">Doanh thu tổng hợp</label>
                                    </div>
                                    <div class="col-1 p-0 text-center seemt-blue" data-toggle="tooltip" data-placement="top" data-original-title="Doanh thu từ toàn bộ đơn hàng">
                                        <i class="fi-rr-exclamation"></i>
                                    </div>
                                    <div class="total-revenue col-12 text-right">
                                        <label class="m-0 float-right font-weight-bold seemt-blue" id="revenue_present_total">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-red mt-1" data-toggle="tooltip" data-placement="top" data-original-title="Bao gồm các phiếu chi ở trạng thái đã chi">
                                    <i class="fi-rr-chat-arrow-grow seemt-red"></i>
                                </div>
                                <div class="content-revenue seemt-orange d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 seemt-red mr-1">Chi phí ước tính</label>
                                    </div>
                                    <div class="total-revenue col-12 text-right">
                                        <label class="m-0 float-right font-weight-bold seemt-red" id="cost_present_total">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-green mt-1">
                                    <i class="fi-rr-stats seemt-green"></i>
                                </div>
                                <div class="content-revenue seemt-green d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 mr-1">Lợi nhuận tổng</label>
                                    </div>
                                    <div class="total-revenue col-12 text-right">
                                        <label class="m-0 float-right font-weight-bold" id="profit_present_total">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-orange mt-1">
                                    <i class="fi-rr-stats seemt-orange"></i>
                                </div>
                                <div class="content-revenue seemt-orange d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 mr-1">Tỷ suất lợi nhuận tổng</label>
                                    </div>
                                    <div class="total-revenue col-12 text-right">
                                        <label class="m-0 float-right font-weight-bold" id="profit_rates_present_total">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content pb-0 row">
        <div class="revenue-content-sub col-6">
            <div class="revenue-month seemt-green seemt-border-bottom">
                <div class="title-revenue-month-sub seemt-before-green seemt-fz-20 d-flex" style="margin-top: -4px">
                    <div id="title-card1" style="font-weight: 500">TỶ TRỌNG DOANH THU
                        {{--                        <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.branch-dashboard.revenue-cost-profit-report.note-revenue')"></i>--}}
                    </div>
                    <div class="pr-0 pl-0">
                        <label class="mb-0 ml-1">
                            <div class="tool-box">
                                <div data-toolbar="user-options">
                                    <i class="fi-rr-exclamation" style="vertical-align: sub"
                                       data-toggle="tooltip" data-placement="top"
                                       data-original-title="@lang('app.branch-dashboard.revenue-cost-profit-report.note-revenue')"></i>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div
                        class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div id="rate-one-revenue-cost-profit-report" class="count-loading-chart h-100 w-100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="revenue-content-sub col-6">
            <div class="revenue-month seemt-green seemt-border-bottom">
                <div class="title-revenue-month-sub seemt-before-green seemt-fz-20 d-flex" style="margin-top: -4px">
                    <div id="title-card1" style="font-weight: 500">TỶ TRỌNG LỢI NHUẬN
                        {{--                        <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.branch-dashboard.revenue-cost-profit-report.note-revenue')"></i>--}}
                    </div>
                    <div class="pr-0 pl-0">
                        <label class="mb-0 ml-1">
                            <div class="tool-box">
                                <div data-toolbar="user-options">
                                    <i class="fi-rr-exclamation" style="vertical-align: sub"
                                       data-toggle="tooltip" data-placement="top"
                                       data-original-title="@lang('app.branch-dashboard.revenue-cost-profit-report.note-revenue')"></i>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div id="rate-two-revenue-cost-profit-report" class="count-loading-chart h-100 w-100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <span id="rate-percent-text-revenue-cost-profit-report">@lang('app.branch-dashboard.revenue-cost-profit-report.chart.rate-percent')</span>
    <span id="money-fund-text-revenue-cost-profit-report">@lang('app.branch-dashboard.revenue-cost-profit-report.chart.money-fund')</span>
    <span id="revenue-text-revenue-cost-profit-report">@lang('app.branch-dashboard.revenue-cost-profit-report.chart.revenue')</span>
    <span id="cost-text-revenue-cost-profit-report">@lang('app.branch-dashboard.revenue-cost-profit-report.chart.cost')</span>
    <span id="profit-text-revenue-cost-profit-report">@lang('app.branch-dashboard.revenue-cost-profit-report.chart.profit')</span>
    <span id="unit-text-revenue-cost-profit-report">@lang('app.branch-dashboard.revenue-cost-profit-report.chart.unit')</span>
</div>
{{--<div class="font-18 font-weight-bold row" style="margin-bottom: 30px">--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--<div class="col-lg-4 text-center" style="color: #4c4c4c">@lang('app.branch-dashboard.revenue-cost-profit-report.last-title')</div>--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--</div>--}}
@push('scripts')
    <script src="{{asset('js/dashboard/dashboard_sale_solution/revenue_cost_profit_report.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
