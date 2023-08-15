<div class="modal fade" id="modal-detail-supplier-payment-debt-treasurer" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.supplier-payment-debt.detail.title')</h4>
                <div>
                    <label class="label label-lg" id="status-text-detail"></label>
                    <button type="button" class="close" onclick="closeModalDetailPaymentDebtTreasurer()"
                            onkeypress="closeModalDetailPaymentDebtTreasurer()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body background-body-color py-0" id="loading-modal-detail-bill-liabilities">
                <div class="row" id="sub-detail-liabilities-treasurer">
                    <div class="col-lg-8 edit-flex-auto-fill px-0">
                        <div class="card card-block2 w-100">
                            <h5 class="text-bold sub-title mt-4b f-w-600">@lang('app.supplier-payment-debt.detail.title-right')</h5>
                            <div class="table-responsive new-table px-1">
                                <table id="table-order-payment-debt-treasurer"
                                       class="table fix-size-table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-payment-debt.detail.stt')</th>
                                        <th>@lang('app.supplier-payment-debt.detail.code')</th>
                                        <th>@lang('app.supplier-payment-debt.detail.amount')</th>
                                        <th>@lang('app.supplier-payment-debt.detail.data-order')</th>
                                        <th>@lang('app.supplier-payment-debt.detail.status')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill pr-0">
                        <div class="card card-block flex-sub pl-4" id="boxlist-detail-payment-debt">
                            <h5 class="text-bold sub-title f-w-600">@lang('app.supplier-payment-debt.detail.title-left')</h5>
                            <div class="row">
                                <div class="col-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15 mb-1">@lang('app.bill-liabilities.detail.name')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted"
                                        id="name-detail-payment-debt"></h6>
                                </div>
                                <div class="col-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15 mb-1">@lang('app.bill-liabilities.detail.branch')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted"
                                        id="branch-name-detail-payment-debt"></h6>
                                </div>
                            </div>
                            <div class="row border-dashed">
                                <div class="col-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-payment-debt.detail.date-time')</label>
                                    : <span class="f-w-400 col-form-label-fz-15 text-muted"
                                            id="date-detail-payment-debt">{{date('d/m/Y')}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-2">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-payment-debt.detail.amount')</label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right"
                                           id="payment-amount-detail-payment-debt">0</label>
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
    @include('manage.supplier_order.detail_order')
    @push('scripts')
        <script type="text/javascript"
                src="{{asset('js/treasurer/supplier_payment_debt/detail.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
