<div class="card card-block tour-card2 loading-profit-loss-report card-inview-dashboard pt-2"
     id="profit-loss-report" data-key="profit-loss-report">
    <div class="row">
        <div class="sub-title p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2" id="select-type-profit-loss-report">
            <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">Báo cáo P&L
                <label class="title-header-dashboard-report" id="text-label-type-profit-loss-report"></label>
            </h4>
            <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select" id="select-type-profit-loss-report">
                @include('dashboard.branch.filter')
                <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report"
                   onclick="reloadProfitLossReport()"></i>
            </div>
        </div>
    </div>
    <div id="chart-profit-loss-report" class="count-loading-chart style-large-chart-dashboard"></div>
    <div id="chart-profit-loss-report-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">
        <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/dashboard/dashboard_sale_solution/profit_loss_report.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
