<style>
    #chart-vertical-area-report {
        background: #ffffff !important;
        height: 60vh !important;
    }
</style>
<div class="report-revenue card-inview-dashboard" id="area-report" data-key="area-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>@lang('app.branch-dashboard.area-report.title')</p>
        </div>
        <div class="d-flex" id="select-type-area-report">
            <div class="seemt-green seemt-border-bottom d-flex justify-content-end p-0">
                <div class="checkbox-zoom zoom-primary d-flex align-items-center">
                    <label class="mr-2 mb-0 title-detail-checkbox">Xem Chi tiết</label>
                    <label class="focus-validate" style="margin-bottom: 5px">
                        <input type="checkbox" name="check-food" class="js-switch" id="detail-value-area-report">
                    </label>
                </div>
            </div>
            @include('dashboard.branch.filter')
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadAreaReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 d-flex p-0">
        <div class="revenue-content col-lg-7 pr-0">
            <div class="revenue-content-sub mb-0">

                <div class="content-revenue-month-sub mb-0">
                    <div class="row m-0 content-revenue-month-group">
                        <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                            <div id="chart-vertical-area-report" class="count-loading-chart h-100 w-100"></div>
                            <div id="chart-vertical-area-report-empty"
                                 class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">
                                <img src="{{asset('images/tms/empty.png')}}"
                                     style="width: 200px; height: auto; object-fit: contain;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="revenue-content col-lg-5 pb-0">
            <div class="revenue-content-sub mb-0">
                <div class="content-revenue-month-sub">
                    <div class="row m-0 content-revenue-month-group">
                        <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                            <div id="chart-pie-area-report"
                                 class="count-loading-chart h-100 w-100" style="height: 60vh !important;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{asset('js/dashboard/branch/area_report.js?version=83', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
