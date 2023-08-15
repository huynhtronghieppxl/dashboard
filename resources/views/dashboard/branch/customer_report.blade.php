<style>
    .card-revenue-sub {
        margin-bottom: 5px !important;
    }
</style>
<div class="report-revenue card-inview-dashboard" id="customer-report" data-key="customer-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>@lang('app.branch-dashboard.customer-report.title')</p>
        </div>
        <div class="d-flex"  id="select-filter-custom-report">
            @include('dashboard.branch.filter')
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadCustomerReport()">
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
                    <div id="chart-customer-report" class="count-loading-chart h-100 w-100"></div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pr-0">
                    <div class="revenue seemt-report-item card-revenue-sub">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-green mt-1">
                                <i class="fi-rr-coins seemt-green"></i>
                            </div>
                            <div class="content-revenue seemt-green d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 mr-1">@lang('app.branch-dashboard.customer-report.checkin')</label>
                                </div>
                                <div class="total-revenue col-12 text-right">
                                    <label class="m-0 float-right font-weight-bold" id="checkin-customer-report">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="revenue seemt-report-item card-revenue-sub">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-orange mt-1">
                                <i class="fi-rr-sack-dollar seemt-orange"></i>
                            </div>
                            <div class="content-revenue seemt-orange d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 mr-1">Đăng ký thẻ thành viên</label>
                                </div>
                                <div class="total-revenue col-12 seemt-orange text-right">
                                    <label class="m-0 float-right font-weight-bold" id="app-customer-report">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="revenue seemt-report-item card-revenue-sub">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-blue mt-1">
                                <i class="fi-rr-chart-pie-alt seemt-blue"></i>
                            </div>
                            <div class="content-revenue seemt-orange d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 seemt-blue mr-1">@lang('app.branch-dashboard.customer-report.accumulate-point')</label>
                                </div>
                                <div class="total-revenue col-12 text-right">
                                    <label class="m-0 float-right font-weight-bold seemt-blue" id="accumulate-point-customer-report">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="revenue seemt-report-item card-revenue-sub">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-green mt-1">
                                <i class="fi-rr-chart-histogram seemt-green"></i>
                            </div>
                            <div class="content-revenue seemt-green d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 mr-1">@lang('app.branch-dashboard.customer-report.use-point')</label>
                                </div>
                                <div class="total-revenue col-12 text-right">
                                    <label class="m-0 float-right font-weight-bold" id="use-point-customer-report">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="revenue seemt-report-item card-revenue-sub">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-orange mt-1">
                                <i class="fi-rr-sort-amount-up-alt seemt-orange"></i>
                            </div>
                            <div class="content-revenue seemt-orange d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 mr-1">Tổng số đơn hàng</label>
                                </div>
                                <div class="total-revenue col-12 seemt-orange text-right">
                                    <label class="m-0 float-right font-weight-bold" id="total-orders-customer-report">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="revenue seemt-report-item card-revenue-sub">
                        <div class="paid-revenue d-flex">
                            <div class="logo-revenue seemt-bg-blue mt-1">
                                <i class="fi-rr-chart-pie-alt seemt-blue"></i>
                            </div>
                            <div class="content-revenue seemt-orange d-flex flex-wrap">
                                <div class="text-revenue col-11 p-0 text-right">
                                    <label class="m-0 seemt-blue mr-1">@lang('app.branch-dashboard.customer-report.gift')</label>
                                </div>
                                <div class="total-revenue col-12 text-right">
                                    <label class="m-0 float-right font-weight-bold seemt-blue" id="gift-customer-report">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







{{--<div class="card card-block tour-card2 card-inview-dashboard pt-2" id="customer-report" data-key="customer-report">--}}
{{--    <div class="row">--}}
{{--        <div class="sub-title p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2">--}}
{{--            <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">@lang('app.branch-dashboard.customer-report.title')--}}
{{--                <label class="title-header-dashboard-report" id="text-label-type-customer-report"></label>--}}
{{--            </h4>--}}
{{--            <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select" id="select-filter-custom-report">--}}
{{--                @include('dashboard.branch.filter')--}}
{{--                <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report" onclick="reloadCustomerReport()"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12 col-lg-8 col-xl-9 edit-flex-auto-fill">--}}
{{--            <div class="card statustic-card card-shadow-custom flex-sub">--}}
{{--                <div class="card-block chart-container h-100">--}}
{{--                    <div id="chart-customer-report" class="h-100 w-100"></div>--}}
{{--                </div>--}}
{{--                <div class="sub-title p-b-0 m-b-0"></div>--}}
{{--                <div class="padding-edit-5-10 d-flex">--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-instagram px-2"></i> <b--}}
{{--                                class="reset-fz-chart">@lang('app.branch-dashboard.customer-report.checkin')</b></span>--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-danger px-2"></i> <b--}}
{{--                                class="reset-fz-chart">@lang('app.branch-dashboard.customer-report.app')</b></span>--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-success px-2"></i> <b--}}
{{--                                class="reset-fz-chart">@lang('app.branch-dashboard.customer-report.use-point')</b></span>--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-primary px-2"></i> <b--}}
{{--                                class="reset-fz-chart">@lang('app.branch-dashboard.customer-report.accumulate-point')</b></span>--}}
{{--                    <span><i class="ion-arrow-graph-up-right text-warning px-2"></i> <b--}}
{{--                                class="reset-fz-chart">@lang('app.branch-dashboard.customer-report.gift')</b></span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-12 col-lg-4 col-xl-3 edit-flex-auto-fill">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6 col-lg-12">--}}
{{--                    <div class="card statustic-progress-card card-shadow-custom feed-card">--}}
{{--                        <h5 class="sub-title m-10">@lang('app.branch-dashboard.customer-report.checkin')</h5>--}}
{{--                        <div class="card-block p-t-0">--}}
{{--                            <div class="row align-items-center ">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label bg-instagram label-circle reset-fontsize-icon">--}}
{{--                                        <i class="icofont icofont-coins"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9 reset-p-r ">--}}
{{--                                    <h4 class="text-instagram font-weight-bold text-right reset-fontsize count-loading loading-customer-report"--}}
{{--                                        id="checkin-customer-report">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12">--}}
{{--                    <div class="card statustic-progress-card card-shadow-custom feed-card">--}}
{{--                        <h5 class="sub-title m-10">@lang('app.branch-dashboard.customer-report.app')</h5>--}}
{{--                        <div class="card-block p-t-0">--}}
{{--                            <div class="row align-items-center ">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-danger label-circle reset-fontsize-icon">--}}
{{--                                        <i class="feather ion-cash"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9 reset-p-r">--}}
{{--                                    <h4 class="text-c-pink font-weight-bold text-right reset-fontsize count-loading loading-customer-report"--}}
{{--                                        id="app-customer-report">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12">--}}
{{--                    <div class="card statustic-progress-card card-shadow-custom feed-card">--}}
{{--                        <h5 class="sub-title m-10">@lang('app.branch-dashboard.customer-report.accumulate-point')</h5>--}}
{{--                        <div class="card-block p-t-0">--}}
{{--                            <div class="row align-items-center">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-primary label-circle reset-fontsize-icon">--}}
{{--                                        <i class="typcn typcn-chart-pie"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9 text-right reset-p-r">--}}
{{--                                    <h4 class="text-c-blue count-loading loading-customer-report"--}}
{{--                                        id="accumulate-point-customer-report">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12">--}}
{{--                    <div class="card statustic-progress-card card-shadow-custom feed-card">--}}
{{--                        <h5 class="sub-title m-10">@lang('app.branch-dashboard.customer-report.use-point')</h5>--}}
{{--                        <div class="card-block p-t-0">--}}
{{--                            <div class="row align-items-center ">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-success label-circle reset-fontsize-icon">--}}
{{--                                        <i class="icofont icofont-chart-histogram-alt"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9 text-right reset-p-r">--}}
{{--                                    <h4 class="text-c-green font-weight-bold reset-fontsize count-loading loading-customer-report"--}}
{{--                                        id="use-point-customer-report">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12">--}}
{{--                    <div class="card statustic-progress-card card-shadow-custom feed-card">--}}
{{--                        <h5 class="sub-title m-10">Tổng số đơn hàng</h5>--}}
{{--                        <div class="card-block p-t-0">--}}
{{--                            <div class="row align-items-center ">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label bg-custom label-circle reset-fontsize-icon">--}}
{{--                                        <i class="icofont icofont-coins"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9 reset-p-r ">--}}
{{--                                    <h4 class="text-custom font-weight-bold text-right reset-fontsize count-loading loading-customer-report"--}}
{{--                                        id="total-orders-customer-report">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-12">--}}
{{--                    <div class="card statustic-progress-card card-shadow-custom feed-card">--}}
{{--                        <h5 class="sub-title m-10">@lang('app.branch-dashboard.customer-report.gift')</h5>--}}
{{--                        <div class="card-block p-t-0">--}}
{{--                            <div class="row align-items-center">--}}
{{--                                <div class="col-sm-3">--}}
{{--                                    <label class="label label-warning label-circle reset-fontsize-icon">--}}
{{--                                        <i class="typcn typcn-chart-pie"></i>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-9 text-right reset-p-r">--}}
{{--                                    <h4 class="text-c-yellow count-loading loading-customer-report" id="gift-customer-report">0</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="d-none">
    <span id="text-checkin-customer-report">@lang('app.branch-dashboard.customer-report.checkin'): </span>
    <span id="text-app-customer-report">@lang('app.branch-dashboard.customer-report.app'): </span>
    <span id="text-use-point-customer-report">@lang('app.branch-dashboard.customer-report.use-point'): </span>
    <span id="text-accumulate-point-customer-report">@lang('app.branch-dashboard.customer-report.accumulate-point'): </span>
    <span id="text-gift-customer-report">@lang('app.branch-dashboard.customer-report.gift'): </span>
</div>
{{--<div class="font-18 font-weight-bold row" style="margin-bottom: 30px">--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--<div class="col-lg-4 text-center" style="color: #4c4c4c">@lang('app.branch-dashboard.customer-report.last-title')</div>--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--</div>--}}
@push('scripts')
    <script src="{{asset('js/dashboard/branch/customer_report.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"
            type="text/javascript"></script>
@endpush
