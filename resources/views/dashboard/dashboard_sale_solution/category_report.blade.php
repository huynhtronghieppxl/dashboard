{{--<div class="card card-block card-inview-dashboard pt-2" id="category-report" data-key="category-report">--}}
{{--    <div class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--            <div class="row">--}}
{{--                <div class="sub-title p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2">--}}
{{--                    <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">@lang('app.branch-dashboard.category-report.title')--}}
{{--                        <label class="title-header-dashboard-report" id="text-label-type-surcharge-report"></label>--}}
{{--                    </h4>--}}
{{--                    <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select" id="select-type-category-report">--}}
{{--                        @include('dashboard.branch.filter')--}}
{{--                        <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report" onclick="reloadCategoryReport()"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-12 col-lg-12 edit-flex-auto-fill">--}}
{{--            <div class="card card-block statustic-card card-shadow-custom w-100">--}}
{{--                <div class="card-block p-t-0 loading-category-report">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-sm-12 text-center">--}}
{{--                            <h5 class="text-center text-inverse font-weight-bold mb-0" style="font-size: 15px!important"><span class="font-weight-bold total-category-report" style="color: #fa6342;font-size: 20px!important" id="total-category-report">0</span> @lang('app.component.unit-money.vnd')</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="chart-vertical-category-report" class="vertical-chart style-large-chart-dashboard count-loading-chart"></div>--}}
{{--                    <div id="chart-vertical-category-report-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">--}}
{{--                        <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-12 col-lg-12 edit-flex-auto-fill">--}}
{{--            <div class="card card-block statustic-card card-shadow-custom flex-sub">--}}
{{--                <div id="chart-pie-category-report" class="count-loading-chart style-large-chart-dashboard"></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="font-18 font-weight-bold row" style="margin-bottom: 30px">--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--<div class="col-lg-4 text-center" style="color: #4c4c4c">@lang('app.branch-dashboard.category-report.last-title')</div>--}}
{{--<div class="col-lg-4 m-auto">--}}
{{--<div style="border: 2px solid #4c4c4c"></div>--}}
{{--</div>--}}
{{--</div>--}}
<div class="report-revenue card-inview-dashboard" id="category-report" data-key="category-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>@lang('app.branch-dashboard.category-report.title')</p>
        </div>
        <div class="d-flex" id="select-type-category-report">
            @include('dashboard.dashboard_sale_solution.filter')
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadCategoryReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content pb-0">
        <div class="revenue-content-sub">
            <div class="revenue-month seemt-green seemt-border-bottom d-flex">
                <div class="title-revenue-month-sub seemt-before-green">
                    <p id="title-card1"></p>
                </div>
                <div class="checkbox-zoom zoom-primary">
                    <label class="mr-2 title-detail-checkbox">Xem Chi tiết</label>
                    <label class="focus-validate">
                        <input type="checkbox" name="check-food" class="js-switch"  id="detail-value-category-report">
                    </label>
                </div>
            </div>
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div class="col-lg-12 text-right">
                            <h5 class="text-center text-inverse font-weight-bold mb-0" style="font-size: 15px!important">
                                <span class="font-weight-bold total-category-report" style="color: #fa6342;font-size: 20px!important"  id="total-category-report">0</span> @lang('app.component.unit-money.vnd')</h5>
                        </div>
                        <div id="chart-vertical-category-report" class="vertical-chart style-large-chart-dashboard count-loading-chart"></div>
                        <div id="chart-vertical-category-report-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">
                            <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content pb-0">
        <div class="revenue-content-sub">
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div id="chart-pie-category-report" class="count-loading-chart style-large-chart-dashboard"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/dashboard/dashboard_sale_solution/category_report.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
