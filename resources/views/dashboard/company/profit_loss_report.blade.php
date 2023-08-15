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
    <div class="revenue-content pb-0">
        <div class="revenue-content-sub">
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div class="col-lg-3 col-md-6 col-sm-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div class="revenue seemt-report-item" style="margin-top: 10%">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-blue mt-1">
                                    <i class="fi-rr-chat-arrow-grow seemt-blue"></i>
                                </div>
                                <div class="content-revenue seemt-blue d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 mr-1">DOANH THU BÁN HÀNG</label>
                                    </div>
                                    <div class="col-1 p-0 text-center">
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
                                    <div class="col-1 p-0 text-center" data-toggle="tooltip" data-placement="top" data-original-title="Tỷ suất ước tính = ( Lợi nhuận ước tính / Doanh thu ước tính) * 100">
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
                                    <div class="col-1 p-0 text-center">
                                        <i class="fi-rr-exclamation"></i>
                                    </div>
                                    <div class="total-revenue col-12 seemt-green text-right">
                                        <label class="m-0 float-right font-weight-bold" id="sell-total-profit-P-L">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 d-flex">
                        <div class="card card-block statustic-card content-revenue-month-chart-report flex-sub">
                            <div id="chart-cost-P-l-report" class="count-loading-chart style-large-chart-dashboard"></div>
                            <div id="chart-cost-P-l-report-empty" class="style-large-chart-dashboard d-flex align-center justify-content-center d-none">
                                <img src="{{asset('images/tms/empty.png')}}" style="width: 200px; height: auto; object-fit: contain;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/dashboard/company/profit_loss_report.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}" type="text/javascript"></script>
@endpush
