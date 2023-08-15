<style>
    #chart-recharge-card-point-report {
        background: #ffffff !important;
        height: 60vh !important;
    }
</style>
<div class="report-revenue card-inview-dashboard" id="recharge-cart-point-report" data-key="recharge-cart-point-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>Báo cáo nạp thẻ</p>
        </div>
        <div class="d-flex" id="select-type-recharge-card-point-report">
            <div class="checkbox-zoom zoom-primary d-flex align-items-center">
                <label class="mr-2 title-detail-checkbox mb-0 mt-1" style="vertical-align: sub">Xem Chi tiết</label>
                <label class="focus-validate mb-0">
                    <input type="checkbox" name="check-food" class="js-switch detail-value-recharge-card-report">
                </label>
            </div>
            @include('dashboard.branch.filter')
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green"
                    onclick="reloadRechargePointCardReport()">
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
                        {{--                        <div class="col-lg-12 text-right"> --}}
                        {{--                            <h5 class="text-center text-inverse font-weight-bold mb-0" style="font-size: 15px!important"> --}}
                        {{--                                <span class="font-weight-bold" style="color: #fa6342;font-size: 20px!important" id="total-employee-report">0</span> @lang('app.component.unit-money.vnd')</h5> --}}
                        {{--                        </div> --}}
                        <div id="chart-recharge-card-point-report" class="count-loading-chart h-100 w-100"></div>
                        <div id="chart-recharge-card-point-report-empty"
                            class="d-flex align-center justify-content-center d-none">
                            <img src="{{ asset('images/tms/empty.png') }}"
                                style="width: 200px; height: auto; object-fit: contain;" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-lg-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div class="table-responsive new-table">
                            <table id="table-recharge-cart-point-report" class="table table-bemployeeed">
                                <thead>
                                    <tr>
                                        <th>@lang('app.branch-dashboard.employee-report.stt')</th>
                                        <th>@lang('app.branch-dashboard.employee-report.avatar')</th>
                                        <th>@lang('app.branch-dashboard.employee-report.name')</th>
                                        <th>Level</th>
                                        <th>Tổng tiền đã nạp</th>
                                        <th>Số tiền đã nạp</th>
                                        <th>Tổng tiền sử dụng</th>
                                        <th>Số tiền sử dụng</th>
                                        <th>Số tiền còn lại</th>
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






















{{-- <div class="card card-block card-inview-dashboard pt-2" id="recharge-cart-point-report" data-key="recharge-cart-point-report"> --}}
{{--    <div class="row"> --}}
{{--        <div class="sub-title p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2"> --}}
{{--            <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">Báo cáo nạp thẻ</h4> --}}
{{--            <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select" id="select-type-recharge-card-point-report"> --}}
{{--                @include('dashboard.branch.filter') --}}
{{--                <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report" onclick="reloadRechargePointCardReport()"></i> --}}
{{--            </div> --}}
{{--        </div> --}}
{{--    </div> --}}
{{--    <div class="card card-block statustic-card card-shadow-custom"> --}}
{{--        <div class="card-block p-t-0 loading-recharge-cart-point-report"> --}}
{{--            <div id="chart-recharge-card-point-report" class="style-large-chart-dashboard"></div> --}}
{{--            <div id="chart-recharge-card-point-report-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none"> --}}
{{--                <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt=""> --}}
{{--            </div> --}}
{{--        </div> --}}
{{--    </div> --}}
{{--    <div class="card card-block statustic-card card-shadow-custom loading-point-customer-report" > --}}
{{--        <div class="card-block p-t-0 loading-recharge-cart-point-report"> --}}
{{--            <div class="table-responsive new-table"> --}}
{{--                <table id="table-recharge-cart-point-report" class="table table-bordered"> --}}
{{--                    <thead> --}}
{{--                    <tr> --}}
{{--                        <th>STT</th> --}}
{{--                        <th>Ảnh</th> --}}
{{--                        <th>Tên</th> --}}
{{--                        <th>Level</th> --}}
{{--                        <th>Tổng tiền đã nạp</th> --}}
{{--                        <th>Số tiền đã nạp</th> --}}
{{--                        <th>Tổng tiền sử dụng</th> --}}
{{--                        <th>Số tiền sử dụng</th> --}}
{{--                        <th>Số tiền còn lại</th> --}}
{{--                        <th></th> --}}
{{--                    </tr> --}}
{{--                    </thead> --}}
{{--                </table> --}}
{{--            </div> --}}
{{--        </div> --}}
{{--    </div> --}}
{{-- </div> --}}
@push('scripts')
    <script src="{{ asset('js/dashboard/branch/recharge_card_report.js?version=81', env('IS_DEPLOY_ON_SERVER')) }}" type="text/javascript"></script>
@endpush
