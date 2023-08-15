<style>
    .title-p-l th{
        font-size: 17px !important;
        font-weight: bold !important;
    }
</style>
<div class="report-revenue card-inview-dashboard" id="profit-loss-report" data-key="profit-loss-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>Báo cáo P&L</p>
        </div>
        <div class="d-flex" id="select-type-profit-loss-report">
            @include('dashboard.branch.filter')
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadProfitLossReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content">
        <div class="revenue-content-sub mb-0">
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-9 d-flex">
                        <div class="card card-block statustic-card content-revenue-month-chart-report flex-sub">
                            <div id="chart-cost-P-l-report" class="count-loading-chart style-large-chart-dashboard"></div>
                            <div id="chart-cost-P-l-report-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">
                                <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div class="revenue seemt-report-item" style="margin-top: 10%">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-blue mt-1">
                                    <i class="fi-rr-chat-arrow-grow seemt-blue"></i>
                                </div>
                                <div class="content-revenue seemt-blue d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 mr-1">DOANH THU BÁN HÀNG</label>
                                    </div>
                                    <div class="col-1 p-0 text-center" data-toggle="tooltip" data-placement="top" data-original-title="Gồm hóa đơn ở trạng thái hoàn tất (bao gồm VAT)">
                                        <i class="fi-rr-exclamation"></i>
                                    </div>
                                    <div class="total-revenue col-12 seemt-blue text-right">
                                        <label class="m-0 float-right font-weight-bold" id="sell-revenue-P-L">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-red mt-1">
                                    <i class="fi-rr-chat-arrow-grow seemt-red"></i>
                                </div>
                                <div class="content-revenue seemt-red d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 mr-1">CHI PHÍ ƯỚC TÍNH</label>
                                    </div>
                                    <div class="col-1 p-0 text-center" data-toggle="tooltip" data-placement="top" data-original-title="Bao gồm các đơn hàng NCC , chi phí lương ước tính, phiếu chi có hạch toán">
                                        <i class="fi-rr-exclamation"></i>
                                    </div>
                                    <div class="total-revenue col-12 seemt-red text-right">
                                        <label class="m-0 float-right font-weight-bold" id="sell-total-cost-P-L">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-green mt-1">
                                    <i class="fi-rr-stats seemt-green"></i>
                                </div>
                                <div class="content-revenue seemt-green d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 mr-1">lỢI NHUẬN GỘP</label>
                                    </div>
                                    <div class="col-1 p-0 text-center" data-toggle="tooltip" data-placement="top" data-original-title="Doanh thu bán hàng - Chi phí ước tính">
                                        <i class="fi-rr-exclamation"></i>
                                    </div>
                                    <div class="total-revenue col-12 seemt-green text-right">
                                        <label class="m-0 float-right font-weight-bold" id="sell-total-profit-P-L">0</label>
                                    </div>
                                </div>
                            </div>
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
                                    <th></th>
                                    <th class="text-right">Tổng tiền</th>
                                    <th class="text-center">Tỷ trọng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="title-p-l seemt-blue">
                                    <th>1. Tổng doanh thu bán hàng</th>
                                    <th class="text-right">300,000,000</th>
                                    <th class="text-center">100%</th>
                                </tr>
                                <tr class="title-p-l seemt-blue">
                                    <th>2. Chi phí nguyên liệu</th>
                                    <th class="text-right">100,000,000</th>
                                    <th class="text-center">600%</th>
                                </tr>
                                <tr>
                                    <th>Kho nguyên liệu</th>
                                    <th class="text-right">25,000,000</th>
                                    <th class="text-center">12%</th>
                                </tr>
                                <tr>
                                    <th>Kho hàng hoá</th>
                                    <th class="text-right">25,000,000</th>
                                    <th class="text-center">12%</th>
                                </tr>
                                <tr>
                                    <th>Kho khác</th>
                                    <th class="text-right">25,000,000</th>
                                    <th class="text-center">12%</th>
                                </tr>
                                <tr class="title-p-l seemt-blue">
                                    <th>3. Chi phí quản lý</th>
                                    <th class="text-right">50,000,000</th>
                                    <th class="text-center">40%</th>
                                </tr>
                                <tr>
                                    <th>Chi phí lương nhân viên</th>
                                    <th class="text-right">25,000,000</th>
                                    <th class="text-center">25%</th>
                                </tr>
                                <tr>
                                    <th>Chi phí bảo vệ</th>
                                    <th class="text-right">25,000,000</th>
                                    <th class="text-center">25%</th>
                                </tr>
                                <tr class="title-p-l seemt-blue">
                                    <th>4. Lãi gộp (1) - (2)</th>
                                    <th colspan="2" class="text-right">200,000,000</th>
                                </tr>
                                <tr class="title-p-l seemt-blue">
                                    <th>5. Lợi nhuận (3) - (4)</th>
                                    <th colspan="2" class="text-right">150,000,000</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


























{{--<div class="card card-block card-shadow-custom-dashboard card-inview-dashboard"--}}
{{--     id="profit-loss-report" data-key="profit-loss-report">--}}
{{--    <div class="col-lg-12">--}}
{{--        <div class="row">--}}
{{--            <div class="sub-title p-0 col-lg-12 d-flex align-items-center justify-content-between pb-2" id="select-type-profit-loss-report">--}}
{{--                <h4 class="title-header-dashboard-report ml-0 mt-0 p-2 w-100">Báo cáo P&L--}}
{{--                    <label class="title-header-dashboard-report" id="text-label-type-profit-loss-report"></label>--}}
{{--                </h4>--}}
{{--                <div class="d-flex align-items-center justify-content-end w-100 mr-2 icon-header-dashboard-report-select" id="select-type-analysis-report">--}}
{{--                    @include('dashboard.branch.filter')--}}
{{--                    <i class="icofont icofont-refresh d-inline fa-hover icon-header-dashboard-report"--}}
{{--                       onclick="reloadProfitLossReport()"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="sub-title w-100 mt-2"></div>--}}
{{--    <div class="col-lg-12">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-6 col-xl-6 edit-flex-auto-fill p-l-0">--}}
{{--                <div class="app-design card-shadow-custom feed-card flex-sub  loading-reveneu-report">--}}
{{--                    <div class="row m-0 p-0 sub-title">--}}
{{--                        <h5>DOANH THU--}}
{{--                        </h5>--}}
{{--                    </div>--}}
{{--                    <div class="card-block " id="rate-revenue-profit-loss-report" style="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6 col-xl-6 edit-flex-auto-fill p-r-0">--}}
{{--                <div class="app-design card-shadow-custom feed-card flex-sub loading-reveneu-report">--}}
{{--                    <div id="chart-profit-loss-report" class="count-loading-chart style-large-chart-dashboard"></div>--}}
{{--                    <div id="chart-profit-loss-report-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">--}}
{{--                        <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="sub-title w-100 mt-2"></div>--}}
{{--    <div class="col-lg-12">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-6 col-xl-6 edit-flex-auto-fill p-l-0">--}}
{{--                <div class="app-design card-shadow-custom feed-card flex-sub loading-reveneu-report">--}}
{{--                    <div class="row m-0 p-0 sub-title">--}}
{{--                        <h5>Chi phí</h5>--}}
{{--                    </div>--}}
{{--                    <div class="card-block " id="rate-cost-profit-lost-report" style=""></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6 col-xl-6 edit-flex-auto-fill p-r-0">--}}
{{--                <div class="app-design card-shadow-custom feed-card flex-sub loading-cost-report">--}}
{{--                    <div id="chart-cost-P-l-report" class="count-loading-chart style-large-chart-dashboard"></div>--}}
{{--                    <div id="chart-cost-P-l-report-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">--}}
{{--                        <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="sub-title w-100 mt-2"></div>--}}
{{--    <div class="col-lg-12">--}}
{{--        <div class="row">--}}
{{--            <div class="app-design card-shadow-custom feed-card flex-sub loading-reveneu-report">--}}
{{--                <div class="row m-0 p-0 sub-title">--}}
{{--                    <h5>Lợi nhuận <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="top" data-original-title="Doanh thu - Chi phí"></i>--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--                <div class="col-sm-12 text-center">--}}
{{--                    <h5 class="text-center text-inverse font-weight-bold mb-0" style="font-size: 15px!important"><span class="font-weight-bold total-category-report" style="color: #fa6342;font-size: 20px!important" id="total-profit-P-l-report">0</span> @lang('app.component.unit-money.vnd')</h5>--}}
{{--                </div>--}}
{{--                <div id="chart-profit-P-l-report" class="count-loading-chart style-large-chart-dashboard"></div>--}}
{{--                <div id="chart-profit-P-l-report-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">--}}
{{--                    <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@push('scripts')
    <script src="{{asset('js/dashboard/branch/profit_loss_report.js?version=81', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
