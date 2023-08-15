<div class="modal fade" id="modal-detail-payment-recurring-bill" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center">Chi tiết phiếu chi định kỳ</h4>
                <button type="button" class="close" onclick="closeModalDetailPaymentRecurringBill()" onkeypress="closeModalDetailPaymentRecurringBill()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-detail-payment-recurring-bill">
                <div class="card card-block">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Đối tượng chi</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="object-name-detail-payment-recurring-bill">0</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Hạng mục chi</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="fee-reason-name-detail-payment-recurring-bill">0</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Kỳ hạn</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="type-detail-payment-recurring-bill">0</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Ngày bắt đầu</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="start-from-detail-payment-recurring-bill">0</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Số tiền</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="amount-at-detail-payment-recurring-bill">0</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Hạch toán</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="revenue-detail-payment-recurring-bill">0</h6>
                        </div>
                        <div class="col-sm-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Ghi chú</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="note-detail-payment-recurring-bill" style="word-break: break-all"></h6>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/treasurer/payment_recurring_bill/detail.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
