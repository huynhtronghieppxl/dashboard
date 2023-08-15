<div class="modal fade" id="modal-detail-work-history" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.work-history-treasurer.detail.title')</h4>
                <button type="button" class="close" onclick="closeModalDetailWorkHistory()" onkeypress="closeModalDetailWorkHistory()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color">
                <div class="row">
                    <div class="col-lg-8 row m-0 px-0">
                        <div class="col-lg-6 d-flex">
                            <div class="card card-block w-100">
                                <h4 class="sub-title">@lang('app.work-history-treasurer.detail.title-revenue')</h4>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.total-revenue')</label>
                                    <div class="col-lg-6">
                                        <label id="total-revenue-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label ">&emsp;@lang('app.work-history-treasurer.detail.cash-revenue')</label>
                                    <div class="col-lg-6">
                                        <label id="cash-revenue-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.bank-revenue')</label>
                                    <div class="col-lg-6">
                                        <label id="bank-revenue-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.transfer-revenue')</label>
                                    <div class="col-lg-6">
                                        <label id="transfer-revenue-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.debt-revenue')</label>
                                    <div class="col-lg-6">
                                        <label id="debt-revenue-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.point-revenue')</label>
                                    <div class="col-lg-6">
                                        <label id="point-revenue-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.point-accumulate')</label>
                                    <div class="col-lg-6">
                                        <label id="point-accumulate-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.point-aloline')</label>
                                    <div class="col-lg-6">
                                        <label id="point-aloline-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.point-promotion')</label>
                                    <div class="col-lg-6">
                                        <label id="point-promotion-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="h-100 text-right">
                                    <u class="text-primary cursor-pointer font-weight-bold font-italic m-t-100"
                                       onclick="openModalRevenueDetailWorkHistory()">@lang('app.work-history-treasurer.detail.detail')</u>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 pl-0 d-flex">
                            <div class="card card-block w-100">
                                <h4 class="sub-title">@lang('app.work-history-treasurer.detail.title-in-addtionfee')</h4>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.total-in-addtionfee')</label>
                                    <div class="col-lg-6">
                                        <label id="total-in-addtionfee-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.cash-in-addtionfee')</label>
                                    <div class="col-lg-6">
                                        <label id="cash-in-addtionfee-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.bank-in-addtionfee')</label>
                                    <div class="col-lg-6">
                                        <label id="bank-in-addtionfee-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.transfer-in-addtionfee')</label>
                                    <div class="col-lg-6">
                                        <label id="transfer-in-addtionfee-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="h-100 text-right">
                                    <u class="text-primary cursor-pointer font-weight-bold font-italic m-t-50"
                                       onclick="openModalReceiptDetailWorkHistory()">@lang('app.work-history-treasurer.detail.detail')</u>
                                </div>
                                <h4 class="sub-title">@lang('app.work-history-treasurer.detail.title-out-addtionfee')</h4>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.total-out-addtionfee')</label>
                                    <div class="col-lg-6">
                                        <label id="total-out-addtionfee-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.cash-out-addtionfee')</label>
                                    <div class="col-lg-6">
                                        <label id="cash-out-addtionfee-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.transfer-out-addtionfee')</label>
                                    <div class="col-lg-6">
                                        <label id="transfer-out-addtionfee-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="h-100 text-right">
                                    <u class="text-primary cursor-pointer font-weight-bold font-italic"
                                       onclick="openModalPaymentDetailWorkHistory()">@lang('app.work-history-treasurer.detail.detail')</u>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex">
                            <div class="card card-block w-100 mt-0">
                                <h4 class="sub-title">@lang('app.work-history-treasurer.detail.title-deposit')</h4>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.total-deposit')</label>
                                    <div class="col-lg-6">
                                        <label id="total-deposit-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.cash-deposit')</label>
                                    <div class="col-lg-6">
                                        <label id="cash-deposit-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.bank-deposit')</label>
                                    <div class="col-lg-6">
                                        <label id="bank-deposit-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.transfer-deposit')</label>
                                    <div class="col-lg-6">
                                        <label id="transfer-deposit-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="h-100 text-right">
                                    <u class="text-primary cursor-pointer font-weight-bold font-italic"
                                       onclick="openModalDepositDetailWorkHistory()">@lang('app.work-history-treasurer.detail.detail')</u>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.total-return-deposit')</label>
                                    <div class="col-lg-6">
                                        <label id="total-return-deposit-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.cash-return-deposit')</label>
                                    <div class="col-lg-6">
                                        <label id="cash-return-deposit-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.transfer-return-deposit')</label>
                                    <div class="col-lg-6">
                                        <label id="transfer-return-deposit-detail-work-history-treasurer" class="float-right reset-text"></label>
                                    </div>
                                </div>
                                <div class="h-100 text-right">
                                    <u class="text-primary cursor-pointer font-weight-bold font-italic"
                                       onclick="openModalReturnDepositDetailWorkHistory()">@lang('app.work-history-treasurer.detail.detail')</u>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 pl-0 d-flex">
                            <div class="card card-block w-100 mt-0">
                                <h4 class="sub-title">@lang('app.work-history-treasurer.detail.title-price')</h4>
                                <div class="table-responsive new-table">
                                    <table id="table-value-detail-work-history-treasurer" class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.work-history-treasurer.detail.stt')</th>
                                            <th>@lang('app.work-history-treasurer.detail.value')</th>
                                            <th>@lang('app.work-history-treasurer.detail.quantity')</th>
                                            <th>@lang('app.work-history-treasurer.detail.amount')</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 pl-0 d-flex">
                        <div class="card card-block w-100">
                            <h4 class="sub-title">@lang('app.work-history-treasurer.detail.title-total')</h4>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.open-employee')</label>
                                <div class="col-lg-6">
                                    <label id="open-employee-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.open-time')</label>
                                <div class="col-lg-6">
                                    <label id="open-time-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.close-employee')</label>
                                <div class="col-lg-6">
                                    <label id="close-employee-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.close-time')</label>
                                <div class="col-lg-6">
                                    <label id="close-time-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.order-total')</label>
                                <div class="col-lg-6">
                                    <label id="order-total-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.before-total')</label>
                                <div class="col-lg-6">
                                    <label id="before-total-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.in-additionfee-total')</label>
                                <div class="col-lg-6">
                                    <label id="in-additionfee-total-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.cash-in-additionfee-total')</label>
                                <div class="col-lg-6">
                                    <label id="cash-in-additionfee-total-detail-work-history-treasurer" class="float-right reset-text"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.bank-in-additionfee-total')</label>
                                <div class="col-lg-6">
                                    <label id="bank-in-additionfee-total-detail-work-history-treasurer" class="float-right reset-text"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.transfer-in-additionfee-total')</label>
                                <div class="col-lg-6">
                                    <label id="transfer-in-additionfee-total-detail-work-history-treasurer" class="float-right reset-text"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.debt-in-additionfee-total')</label>
                                <div class="col-lg-6">
                                    <label id="debt-in-additionfee-total-detail-work-history-treasurer" class="float-right reset-text"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.point-in-additionfee-total')</label>
                                <div class="col-lg-6">
                                    <label class="float-right reset-text point-in-additionfee-total-detail-work-history-treasurer"></label>
                                </div>
                            </div>

                            <div class="sub-title"
                                 style="border-bottom: 3px solid rgba(204, 204, 204, 0.35)!important;"></div>

                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.out-additionfee-total')</label>
                                <div class="col-lg-6">
                                    <label id="out-additionfee-total-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.cash-out-additionfee-total')</label>
                                <div class="col-lg-6">
                                    <label id="cash-out-additionfee-total-detail-work-history-treasurer" class="float-right reset-text"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.transfer-out-additionfee-total')</label>
                                <div class="col-lg-6">
                                    <label id="transfer-out-additionfee-total-detail-work-history-treasurer" class="float-right reset-text"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label">&emsp;@lang('app.work-history-treasurer.detail.point-in-additionfee-total')</label>
                                <div class="col-lg-6">
                                    <label class="float-right reset-text point-in-additionfee-total-detail-work-history-treasurer"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.cash-total')</label>
                                <div class="col-lg-6">
                                    <label id="cash-total-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.cash-time-total')</label>
                                <div class="col-lg-6">
                                    <label id="cash-time-total-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.cash-current-total')</label>
                                <div class="col-lg-6">
                                    <label id="cash-current-total-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label font-weight-bold">@lang('app.work-history-treasurer.detail.difference-total')</label>
                                <div class="col-lg-6">
                                    <label id="difference-total-detail-work-history-treasurer" class="float-right reset-text font-weight-bold"></label>
                                </div>
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
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\treasurer\work_history\detail.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
