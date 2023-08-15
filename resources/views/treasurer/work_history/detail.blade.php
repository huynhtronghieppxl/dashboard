<head>
    <link rel="stylesheet" href="{{asset('css/css_custom/detail_work_history/style.css')}}">
</head>
<div class="modal fade" id="modal-detail-work-history" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.work-history-treasurer.detail.title')</h4>
                <div class="d-flex">
                    <div class="float-right">
                        <label class="open-employee-detail-work-history-treasurer reset-text font-weight-bold"></label>
                        <label> - </label>
                        <label class="open-time-detail-work-history-treasurer reset-text font-weight-bold"></label>
                        <label> - </label>
                        <label class="close-time-detail-work-history-treasurer reset-text font-weight-bold"></label>
                    </div>
                    <button type="button" class="close ml-4" onclick="closeModalDetailWorkHistory()" onkeypress="closeModalDetailWorkHistory()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body background-body-color">
                <div class="row m-0">
                    <div class="col-lg-4 col-md-6 col-sm-12 d-flex p-2">
                        <div class="card card-block mx-0 flex-sub" id="card-detail-deposit-treasuer">
                            <div class="row justify-content-between sub-title align-items-center sub-title">
                                <div class="d-flex align-items-center">
                                    <div class="mr-1">
                                        <i class="icofont icofont-coins font-19 text-muted"></i>
                                    </div>
                                    <div>
                                        <span class="mb-0 f-w-600 text-muted">@lang('app.work-history-treasurer.detail.title-deposit')</span>
                                        <p class="seemt-fz-content f-w-600 font-21 text-success total-deposit-detail-work-history-treasurer">0</p>
                                    </div>
                                </div>
                                <div>
                                    <button class="bit-icon seemt-blue seemt-bg-blue seemt-btn-hover-blue" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"
                                            onclick="openModalDepositDetailWorkHistory()">
                                        <i class="fi-rr-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row pt-1">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.cash-deposit')</label>
                                <div class="col-lg-6">
                                    <label id="cash-deposit-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.bank-deposit')</label>
                                <div class="col-lg-6">
                                    <label id="bank-deposit-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.transfer-deposit')</label>
                                <div class="col-lg-6">
                                    <label id="transfer-deposit-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div style="border-bottom: 3px solid rgba(204, 204, 204, 0.35)!important;margin-bottom: 5px;"></div>

                            <div class="row justify-content-between sub-title align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="mr-1">
                                        <i class="icofont icofont-coins font-19 text-muted"></i>
                                    </div>
                                    <div>
                                        <span class="mb-0 f-w-600 text-muted">@lang('app.work-history-treasurer.detail.total-return-deposit')</span>
                                        <p class="seemt-fz-content f-w-600 font-21 text-primary total-return-deposit-detail-work-history-treasurer">0</p>
                                    </div>
                                </div>
                                <div>
                                    <button class="bit-icon seemt-blue seemt-bg-blue seemt-btn-hover-blue" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"
                                            onclick="openModalReturnDepositDetailWorkHistory()">
                                        <i class="fi-rr-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row pt-1">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.cash-return-deposit')</label>
                                <div class="col-lg-6">
                                    <label id="cash-return-deposit-detail-work-history-treasurer" class="float-right reset-text text-primary font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.transfer-return-deposit')</label>
                                <div class="col-lg-6">
                                    <label id="transfer-return-deposit-detail-work-history-treasurer" class="float-right reset-text text-primary font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex p-2">
                        <div class="card card-block mx-0 flex-sub w-100 mb-0" id="card-detail-total-revenue-treasuer">

                            <div class="row justify-content-between sub-title align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="mr-1">
                                        <i class="icofont icofont-coins font-19 text-muted"></i>
                                    </div>
                                    <div>
                                        <span class="mb-0 f-w-600 text-muted">@lang('app.work-history-treasurer.detail.title-revenue') (1+2+3+4+5-6)</span>
                                        <p class="seemt-fz-content f-w-600 font-21 text-success" id="total-revenue-detail-work-history-treasurer">0</p>                                    </div>
                                </div>
                                <div>
                                    <button class="bit-icon seemt-blue seemt-bg-blue seemt-btn-hover-blue" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"
                                            onclick="openModalRevenueDetailWorkHistory()">
                                        <i class="fi-rr-eye"></i>
                                    </button>
                                </div>
                            </div>


                            <div class="row pt-1">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.order-total')</label>
                                <div class="col-lg-6">
                                    <label id="order-total-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.cash-revenue') (1)</label>
                                <div class="col-lg-6">
                                    <label id="cash-revenue-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.transfer-revenue') (2)</label>
                                <div class="col-lg-6">
                                    <label id="transfer-revenue-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.bank-revenue') (3)</label>
                                <div class="col-lg-6">
                                    <label id="bank-revenue-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.debt-revenue') (4)</label>
                                <div class="col-lg-6">
                                    <label id="debt-revenue-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.point-recharge') (5)</label>
                                <div class="col-lg-6">
                                    <label class="float-right reset-text text-success font-14 f-w-600 point-recharge-detail-work-history-treasurer seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-7 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.tip-revenue') (6)</label>
                                <div class="col-lg-5">
                                    <label class="float-right reset-text text-primary font-14 f-w-600 tip-revenue-detail-work-history-treasurer seemt-fz-16">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex p-2">
                        <div class="card card-block mx-0 flex-sub w-100 mb-0" id="card-detail-work-treasuer">
                            <div class="row sub-title">
                                <div class="mt-1 p-2"><i class="icofont icofont-coins font-19 text-muted"></i></div>
                                <div>
                                    <span class="mb-0 f-w-600 text-muted">@lang('app.work-history-treasurer.detail.title-recharge')</span>
                                    <p class="seemt-fz-content f-w-600 font-21 text-success total-recharge-detail-work-history-treasurer">0</p>
                                </div>
                            </div>
                            <div class="row pt-1">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.cash')</label>
                                <div class="col-lg-6">
                                    <label id="cash-recharge-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.bank')</label>
                                <div class="col-lg-6">
                                    <label id="bank-recharge-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.transfer')</label>
                                <div class="col-lg-6">
                                    <label id="transfer-recharge-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex p-2 flex-wrap">
                        <div class="col-lg-12 d-flex px-0">
                            <div class="card card-block mx-0 flex-sub" id="card-detail-receipts-addtionfee-treasuer">

                                <div class="row justify-content-between sub-title align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-1">
                                            <i class="icofont icofont-coins font-19 text-muted"></i>
                                        </div>
                                        <div>
                                            <span class="mb-0 f-w-600 text-muted">@lang('app.work-history-treasurer.detail.title-in-addtionfee')</span>
                                            <p class="seemt-fz-content f-w-600 font-21 text-success" id="total-in-addtionfee-detail-work-history-treasurer">0</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="bit-icon seemt-blue seemt-bg-blue seemt-btn-hover-blue" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"
                                                onclick="openModalReceiptDetailWorkHistory()">
                                            <i class="fi-rr-eye"></i>
                                        </button>
                                    </div>
                                </div>


                                <div class="row pt-1">
                                    <label
                                        class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.cash-in-addtionfee')</label>
                                    <div class="col-lg-6">
                                        <label id="cash-in-addtionfee-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.bank-in-addtionfee')</label>
                                    <div class="col-lg-6">
                                        <label id="bank-in-addtionfee-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                    </div>
                                </div>
                                <div class="row pb-5">
                                    <label
                                        class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.transfer-in-addtionfee')</label>
                                    <div class="col-lg-6">
                                        <label id="transfer-in-addtionfee-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12 d-flex px-0">
                            <div class="card card-block mx-0 flex-sub" id="card-detail-payment-addtionfee-treasuer">

                                <div class="row justify-content-between sub-title align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-1">
                                            <i class="icofont icofont-coins font-19 text-muted"></i>
                                        </div>
                                        <div>
                                            <span class="mb-0 f-w-600 text-muted">@lang('app.work-history-treasurer.detail.title-out-addtionfee')</span>
                                            <p class="seemt-fz-content f-w-600 font-21 text-primary total-out-addtionfee-detail-work-history-treasurer">0</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="bit-icon seemt-blue seemt-bg-blue seemt-btn-hover-blue" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"
                                                onclick="openModalPaymentDetailWorkHistory()">
                                            <i class="fi-rr-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row pt-1">
                                    <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.cash-out-addtionfee')</label>
                                    <div class="col-lg-6">
                                        <label id="cash-out-addtionfee-detail-work-history-treasurer" class="float-right reset-text text-primary font-14 f-w-600 seemt-fz-16">0</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.transfer-out-addtionfee')</label>
                                    <div class="col-lg-6">
                                        <label id="transfer-out-addtionfee-detail-work-history-treasurer" class="float-right reset-text text-primary font-14 f-w-600 seemt-fz-16">0</label>
                                    </div>
                                </div>
                                <div class="row pb-5">
                                    <label class="col-lg-7 text-success f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.tip-revenue')</label>
                                    <div class="col-lg-5">
                                        <label class="float-right reset-text text-success font-14 f-w-600 tip-revenue-detail-work-history-treasurer seemt-fz-16">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex p-2">
                        <div class="card card-block mx-0 flex-sub" id="card-detail-order-total-treasuer">
                            <div class="row sub-title">
                                <div class="mt-1 p-2"><i class="icofont icofont-coins font-19 text-muted"></i></div>
                                <div>
                                    <span class="total-cash-detail-work-history-treasurer text-warning">(1)</span>
                                    <span class="mb-0 f-w-600 text-muted">@lang('app.work-history-treasurer.detail.title-total') <span class="text-warning">(A - B)</span></span>
                                    <p class="seemt-fz-content f-w-600 font-21 text-success" id="total-final-detail-work-history-treasurer">0</p>
                                </div>
                            </div>
                            <div class="row pt-1">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14 text-success">&emsp;Tổng thu tiền mặt <span class="text-success">(A)</span></label>
                                <div class="col-lg-6">
                                    <label class="float-right reset-text text-success font-14 f-w-600 font-weight-bold seemt-fz-16" id="total-cash-in">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.before-total')</label>
                                <div class="col-lg-6">
                                    <label id="before-total-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.cash-current-total')</label>
                                <div class="col-lg-6">
                                    <label class="float-right reset-text text-success font-14 f-w-600  seemt-fz-16" id="total-revenue-cash">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail-debt-order-total')</label>
                                <div class="col-lg-6">
                                    <label class="float-right reset-text text-success font-14 f-w-600  seemt-fz-16" id="total-debt-order">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.in-additionfee-total')</label>
                                <div class="col-lg-6">
                                    <label id="in-additionfee-total-detail-work-history-treasurer" class="float-right reset-text text-success font-14 f-w-600 seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.total-deposit')</label>
                                <div class="col-lg-6" >
                                    <label class="float-right reset-text text-success font-14 f-w-600 total-deposit-detail-work-history-treasurer seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.recharge-sell')</label>
                                <div class="col-lg-6">
                                    <label id="total-top-up-card-cash-amount" class="float-right reset-text text-success font-14 f-w-600   seemt-fz-16">100</label>
                                </div>
                            </div>
                            <div style="border-bottom: 3px solid rgba(204, 204, 204, 0.35)!important;margin-bottom: 5px;"></div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14 text-primary">&emsp;@lang('app.work-history-treasurer.detail.total-cash-expenditure') <span class="text-primary">(B)</span></label>
                                <div class="col-lg-6">
                                    <label class="float-right reset-text text-primary font-14 f-w-600 font-weight-bold  seemt-fz-16" id="total-cash-out">0</label>
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">Tiền quỹ để lại</label>--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <label class="float-right reset-text text-primary font-14 f-w-600 total-return-deposit-detail-work-history-treasurer seemt-fz-16">0</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;Tiền quỹ để lại</label>
                                <div class="col-lg-6">
                                    <label class="float-right reset-text text-primary font-14 f-w-600 total-before-cash-detail-work-history-treasurer seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;Trả cọc</label>
                                <div class="col-lg-6">
                                    <label class="float-right reset-text text-primary font-14 f-w-600 total-return-deposit-detail-work-history-treasurer seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-6 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.out-total')</label>
                                <div class="col-lg-6">
                                    <label class="float-right reset-text text-primary font-14 f-w-600 seemt-fz-16" id="total-cost-detail-work-history-treasurer">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-7 f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.tip-revenue')</label>
                                <div class="col-lg-5">
                                    <label class="float-right reset-text text-primary font-14 f-w-600 tip-revenue-detail-work-history-treasurer seemt-fz-16">0</label>
                                </div>
                            </div>
                            <div style="border-bottom: 3px solid rgba(204, 204, 204, 0.35)!important;margin-bottom: 5px;"></div>
                            <div class="row">
                                <label class="col-lg-6 text-warning f-w-400 seemt-fz-14 font-14">&emsp;@lang('app.work-history-treasurer.detail.difference-total')
                                    <span class="total-real-detail-work-history-treasurer">(2)</span> -
                                    <span class="total-cash-detail-work-history-treasurer">(1)</span>
                                </label>
                                <div class="col-lg-6">
                                    <label id="difference-total-detail-work-history-treasurer" class="float-right reset-text font-14 f-w-600 text-warning seemt-fz-16">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex p-2">
                        <div class="card card-block mx-0 flex-sub">
                            <div class="row">
                                <div class="mt-1 p-2"><i class="icofont icofont-coins font-19 text-muted"></i></div>
                                <div>
                                    <span class="total-real-detail-work-history-treasurer text-warning">(2)</span>
                                    <span class="mb-0 f-w-600 text-muted text-uppercase">@lang('app.work-history-treasurer.detail.real-amount')</span>
                                    <p class="seemt-fz-content f-w-600 font-21 text-warning real-amount-detail-work-history-treasurer" id="real-amount-detail-work-history-treasurer">0</p>
                                </div>
                            </div>
                            <div class="table-responsive new-table pt-1">
                                <table id="table-value-money-detail-work-history-treasurer" class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">@lang('app.work-history-treasurer.detail.value')</th>
                                        <th class="text-center">@lang('app.work-history-treasurer.detail.quantity')</th>
                                        <th class="text-center">@lang('app.work-history-treasurer.detail.amount')</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@include('treasurer.work_history.revenue_detail')
@include('treasurer.work_history.payment_detail')
@include('treasurer.work_history.receipt_detail')
@include('treasurer.work_history.deposit_detail')
@include('treasurer.work_history.return_deposit_detail')
@include('manage.bill.detail')
@include('treasurer.payment_bill.detail')
@include('treasurer.receipts_bill.detail')
@include('treasurer.receipts_bill.detail')

@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\treasurer\work_history\detail.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
