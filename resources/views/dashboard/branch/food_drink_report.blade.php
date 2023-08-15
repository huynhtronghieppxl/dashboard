<style>
    #chart-vertical-food-food-drink-report {
        background: #ffffff !important;
        height: 60vh !important;
    }
</style>
<div class="report-revenue card-inview-dashboard" id="food-drink-report" data-key="food-drink-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p id="title-card1">@lang('app.branch-dashboard.food-drink-report.title-food')</p>
        </div>
        <div class="d-flex" id="select-type-food-drink-report">
            <div class="checkbox-zoom zoom-primary d-flex align-items-center">
                <label class="mr-2 title-detail-checkbox mb-0 mt-1">Xem Chi tiết</label>
                <label class="focus-validate mb-0">
                    <input type="checkbox" name="check-food" id="detail-value-food-drink-report" class="js-switch detail-value-food-report">
                </label>
            </div>
            @include('dashboard.branch.filter')
            <div style="margin-left: 10px">
                <div class="select-filter-type-date">
                    <div class="select-material-box">
                        <select id="select-sort-food-report"
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
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadFoodDrinkReport()">
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
                        <div id="chart-vertical-food-food-drink-report"
                             class="count-loading-chart h-100 w-100"></div>
                        <div id="chart-vertical-food-food-drink-report-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">
                            <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">
                        </div>                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/dashboard/branch/food_drink_report.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"
            type="text/javascript"></script>
@endpush
