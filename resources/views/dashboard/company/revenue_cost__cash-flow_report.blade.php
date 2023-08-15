<style>
    #revenue-cost-cash-flow-report .select2-selection__arrow {
        top: 0 !important;
    }
</style>
<div class="report-revenue card-inview-dashboard" id="revenue-cost-cash-flow-report" data-key="revenue-cost-cash-flow-report">
    <div class="revenue-month seemt-blue seemt-border-bottom seemt-bg-white d-flex">
        <div class="content-revenue-month seemt-before-blue">
            <p>@lang('app.branch-dashboard.revenue-cost-profit-report.title1')</p>
        </div>
        <div class="d-flex">
            <div class="form-validate-select position-relative">
                <div class="select-material-box">
                    <select id="select-type-revenue-cost-cash-flow-report" class="js-example-basic-single select2-hidden-accessible form-control" tabindex="-1" aria-hidden="true">
                        <option value="3" data-time="{{date('m/Y')}}" data-val="1" data-time-val="{{date('m/Y')}}" selected>
                            @lang('app.branch-dashboard.select.option5')</option>
                        <option value="3" data-time="{{date('m/Y', strtotime('-1 month'))}}" data-val="2" data-time-val="{{date('m/Y', strtotime('-1 month'))}}">
                            @lang('app.branch-dashboard.select.option6')</option>
                        <option value="5" data-time="{{date('Y')}}" data-val="3" data-time-val="{{date('Y')}}">
                            @lang('app.branch-dashboard.select.option8')</option>
                        <option value="5" data-time="{{date('Y', strtotime('-1 year'))}}" data-val="4" data-time-val="{{date('Y', strtotime('-1 year'))}}">
                            @lang('app.branch-dashboard.select.option11')</option>
                    </select>
                    <div class="line"></div>
                </div>
            </div>
            <div class="bell ml-4">
                <div class="bit-icon seemt-green seemt-bg-green seemt-btn-hover-green" onclick="reloadRevenueCostCashFlowReport()">
                    <i class="fi-rr-refresh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="revenue-content pb-0">
        <div class="revenue-content-sub mb-0">
            <div class="content-revenue-month-sub">
                <div class="row m-0 content-revenue-month-group">
                    <div
                        class="col-lg-9 col-md-6 col-sm-12 seemt-border-radius-6 content-revenue-month-chart-report">
                        <div id="chart-revenue-cost-cash-flow" class="count-loading-chart h-100 w-100"></div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 pr-0">
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-blue mt-1">
                                    <i class="fi-rr-chat-arrow-grow seemt-blue"></i>
                                </div>
                                <div class="content-revenue seemt-orange d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 seemt-blue mr-1">Doanh thu tổng hợp</label>
                                    </div>
                                    <div class="col-1 p-0 text-center seemt-blue" data-toggle="tooltip" data-placement="top" data-original-title="Các hóa đơn ở trọng thái hoàn tất(bao gồm VAT) và các phiếu thu có hạch toán">
                                        <i class="fi-rr-exclamation"></i>
                                    </div>
                                    <div class="total-revenue col-12 text-right">
                                        <label class="m-0 float-right font-weight-bold seemt-blue" id="revenue_present">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="revenue seemt-report-item">
                            <div class="paid-revenue d-flex">
                                <div class="logo-revenue seemt-bg-red mt-1" >
                                    <i class="fi-rr-chat-arrow-grow seemt-red"></i>
                                </div>
                                <div class="content-revenue seemt-orange d-flex flex-wrap">
                                    <div class="text-revenue col-11 p-0 text-right">
                                        <label class="m-0 seemt-red mr-1">Chi phí thực tế</label>
                                    </div>
                                    <div class="col-1 p-0 text-center seemt-red" data-toggle="tooltip" data-placement="top" data-original-title="Bao gồm các phiếu chi ở trạng thái đã chi">
                                        <i class="fi-rr-exclamation"></i>
                                    </div>
                                    <div class="total-revenue col-12 text-right">
                                        <label class="m-0 float-right font-weight-bold seemt-red" id="cost_present">0</label>
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
                                        <label class="m-0 mr-1">Quỹ tiền còn lại</label>
                                    </div>
                                    <div class="total-revenue col-12 text-right">
                                        <label class="m-0 float-right font-weight-bold" id="profit_present">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/dashboard/company/revenue_cost_cash_flow.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
