<style>
    #chart-pie-category-report,
    #chart-vertical-category-report {
        background: #ffffff !important;
        height: 60vh !important;
    }
</style>
<div class="report-revenue card-inview-dashboard" id="category-report" data-key="category-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>@lang('app.branch-dashboard.category-report.title')</p>
        </div>
        <div class="d-flex" id="select-type-category-report">
            <div class="checkbox-zoom zoom-primary d-flex align-items-center">
                <label class="mr-2 title-detail-checkbox mb-0 mt-1" style="vertical-align: sub">Xem Chi tiết</label>
                <label class="focus-validate mb-0">
                    <input type="checkbox" name="check-food" class="js-switch"
                           id="detail-value-category-report">
                </label>
            </div>
            @include('dashboard.branch.filter')
            <div style="margin-left: 10px">
                <div class="select-filter-type-date">
                    <div class="select-material-box">
                        <select id="select-sort-category-report"
                                class="form-control js-example-basic-single select2-hidden-accessible">
                            <option
                                value="0" selected>Giá vốn
                            </option>
                            <option
                                value="1">Giá bán
                            </option>
                            <option
                                value="2">Số lượng
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadCategoryReport()">
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
                        <div id="chart-vertical-category-report" class="count-loading-chart h-100 w-100"></div>
                        <div id="chart-vertical-category-report-empty"
                             class="d-flex align-center justify-content-center d-none">
                            <img src="{{asset('images/tms/empty.png')}}"
                                 style="width: 200px; height: auto; object-fit: contain;" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content">
        <div class="revenue-content-sub mb-0">
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div id="chart-pie-category-report" class="count-loading-chart h-100 w-100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/dashboard/branch/category_report.js?version=83', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
