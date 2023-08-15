<div class="report-revenue card-inview-dashboard" id="cost-freight-report" data-key="cost-freight-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>Báo cáo C&F</p>
        </div>
        <div class="d-flex" id="select-type-cost-freight-report">
            @include('dashboard.branch.filter')
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadCostFreightReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content">
        <div class="content-revenue-month-sub">
            <div class="row m-0 content-revenue-month-group">
                <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                    <div id="chart-cost-freight-report" class="count-loading-chart style-large-chart-dashboard"></div>
                    <div id="chart-cost-freight-report-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">
                        <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/dashboard/company/cost_freight_report.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
