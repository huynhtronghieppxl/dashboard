<style>
    #chart-vertical-employee-report {
        background: #ffffff !important;
        height: 60vh !important;
    }
</style>
<div class="report-revenue card-inview-dashboard"  id="employee-report" data-key="employee-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>@lang('app.branch-dashboard.employee-report.title')</p>
        </div>
        <div class="d-flex"  id="select-type-employee-report">
            <div class="checkbox-zoom zoom-primary d-flex align-items-center">
                <label class="mr-2 title-detail-checkbox">Xem Chi tiết</label>
                <label class="focus-validate">
                    <input type="checkbox" name="check-food" class="js-switch detail-value-employee-report">
                </label>
            </div>
            @include('dashboard.branch.filter')
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadEmployeeReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content">
        <div class="revenue-content-sub mb-0">
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div id="chart-vertical-employee-report" class="count-loading-chart h-100 w-100"></div>
                        <div id="chart-vertical-employee-report-empty" class="d-flex align-center justify-content-center d-none">
                            <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div class="table-responsive new-table">
                            <table id="table-employee-report" class="table table-bemployeeed">
                                <thead>
                                <tr>
                                    <th>@lang('app.branch-dashboard.employee-report.stt')</th>
                                    <th>@lang('app.branch-dashboard.employee-report.avatar')</th>
                                    <th>@lang('app.branch-dashboard.employee-report.name')</th>
                                    <th>@lang('app.branch-dashboard.employee-report.role')</th>
                                    <th>@lang('app.branch-dashboard.employee-report.revenue')</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/dashboard/branch/employee_report.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
