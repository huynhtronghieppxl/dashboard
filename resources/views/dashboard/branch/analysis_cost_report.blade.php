<div class="report-revenue  card-inview-dashboard" id="analysis-cost-report" data-key="analysis-cost-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>@lang('app.branch-dashboard.analysis-cost-report.title')</p>
        </div>
        <div class="d-flex" id="select-type-analysis-cost-report">
            @include('dashboard.branch.filter')
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadAnalysisCostReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content">
        <div class="content-revenue-month-sub">
            <div class="row m-0 content-revenue-month-group">
                <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                    <div id="chart-analysis-cost-report" class="count-loading-chart h-100 w-100" style="height: 36vh !important;"></div>
                    <div id="chart-analysis-cost-report-empty" class="count-loading-chart d-flex align-center justify-content-center d-none">
                        <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



{{--<div class="card card-block card-shadow-custom-dashboard card-inview-dashboard"--}}
{{--     id="analysis-cost-report" data-key="analysis-cost-report">--}}
{{--    <div class="row">--}}
{{--        <div class="sub-title p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2" id="select-type-analysis-cost-report">--}}
{{--            <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">@lang('app.branch-dashboard.analysis-cost-report.title')--}}
{{--                <label class="title-header-dashboard-report" id="text-label-type-analysis-cost-report"></label>--}}
{{--            </h4>--}}
{{--            <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select" id="select-type-analysis-report">--}}
{{--                @include('dashboard.branch.filter')--}}
{{--                <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report"--}}
{{--                   onclick="reloadAnalysisCostReport()"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    --}}{{--    <div class="row">--}}
{{--    --}}{{--        <div class="col-sm-12 col-lg-12 edit-flex-auto-fill card-shadow-custom">--}}
{{--    --}}{{--            <div class="card-block statustic-card flex-sub">--}}
{{--    <div id="chart-analysis-cost-report" class="count-loading-chart style-large-chart-dashboard"></div>--}}
{{--    <div id="chart-analysis-cost-report-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">--}}
{{--        <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">--}}
{{--    </div>--}}
{{--    --}}{{--            </div>--}}
{{--    --}}{{--        </div>--}}
{{--    --}}{{--    </div>--}}
{{--</div>--}}
@push('scripts')
    <script src="{{asset('js/dashboard/branch/analysis_cost_report.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
