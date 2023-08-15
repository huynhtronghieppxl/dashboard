<style>
    .vertical-chart {
        margin-top: 0;
    }

    #chart-vertical-gift-food-report {
        background: #ffffff !important;
        height: 60vh !important;
    }
</style>
<div class="report-revenue card-inview-dashboard"  id="gift-food-report" data-key="gift-food-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>@lang('app.branch-dashboard.gift-food-report.title')</p>
        </div>
        <div class="d-flex" id="select-type-gift-food-report">
            <div class="checkbox-zoom zoom-primary d-flex align-items-center">
                <label class="mr-2 title-detail-checkbox mb-0 mt-1">Xem Chi tiết</label>
                <label class="focus-validate mb-0">
                    <input type="checkbox" id="detail-value-gift-food-report" name="check-food" class="js-switch detail-value-gift-food-report">
                </label>
            </div>
            @include('dashboard.branch.filter')
            <div style="margin-left: 10px">
                <div class="select-filter-type-date">
                    <div class="select-material-box">
                        <select id="select-sort-gift-food-report"
                                class="form-control js-example-basic-single select2-hidden-accessible">
                            <option
                                value="0" selected>Giá vốn
                            </option>
                            <option
                                value="2">Số lượng
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadGiftFoodReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content">
        <div class="revenue-content-sub mb-0">
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-lg-12 col-md-6 col-sm-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div id="chart-vertical-gift-food-report" class="count-loading-chart h-100 w-100"></div>
                        <div id="chart-vertical-gift-food-report-empty" class="d-flex align-center justify-content-center d-none">
                            <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-lg-12 d-flex">
                        <div class="card card-block statustic-card content-revenue-month-chart-report flex-sub">
                            <div class="table-responsive loading-order-report new-table">
                                <table id="table-gift-food-report" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.branch-dashboard.gift-food-report.stt')</th>
                                        <th>@lang('app.branch-dashboard.gift-food-report.name')</th>
                                        <th>@lang('app.branch-dashboard.gift-food-report.quantity')</th>
                                        <th>@lang('app.branch-dashboard.gift-food-report.amount')</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th class="seemt-fz-14" id="total-quantity-gift-food-report"></th>
                                        <th class="text-center seemt-fz-14 total-gift-food-report"></th>
                                        <th></th>
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
</div>
@include('manage.bill.detail')
@push('scripts')
    <script src="{{asset('js/dashboard/branch/gift_food_report.js?version=85', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
