<div class="report-revenue card-inview-dashboard" id="revenue-report" data-key="revenue-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>@lang('app.branch-dashboard.revenue-report.title')</p>
        </div>
        <div class="d-flex" id="select-type-revenue-report">
            <div class="checkbox-zoom zoom-primary d-flex align-items-center">
                <label class="mr-2 title-detail-checkbox mb-0 mt-1" style="vertical-align: sub">Xem Chi tiết</label>
                <label class="focus-validate mb-0">
                    <input type="checkbox" name="check-food" class="js-switch" id="detail-value-revenue-report">
                </label>
            </div>
            @include('dashboard.branch.filter')
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadRevenueReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="revenue-content">
        <div class="content-revenue-month-sub">
            <div class="row m-0 content-revenue-month-group">
                <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                    <div id="chart-revenue-current" class="count-loading-chart h-100 w-100" style="height: 60vh !important;"></div>
                    <div id="chart-revenue-current-empty" class="count-loading-chart d-flex align-center justify-content-center d-none">
                        <img src="{{asset('images/tms/empty.png', env('IS_DEPLOY_ON_SERVER'))}}" style="width: 200px; height: auto; object-fit: contain;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/dashboard/branch/revenue_report.js?version=83')}}" type="text/javascript"></script>
@endpush
