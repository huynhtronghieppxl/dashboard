<div class="modal fade" id="modal-detail-surcharge-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center">Chi tiết phụ thu</h4>
                <button type="button" class="close" onclick="closeModalDetailSurchargeData()" onkeypress="closeModalDetailSurchargeData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-detail-surcharge-data">
                <div class="card-block card m-0">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600 seemt-fz-16">Tên phụ thu</p>
                            <h6 class="text-muted f-w-400 seemt-fz-16 reset-data-detail-payment-bill"
                                id="name-detail-surcharge-data"></h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600 seemt-fz-16">Giá</p>
                            <h6 class="text-muted f-w-400 seemt-fz-16 reset-data-detail-payment-bill"
                                id="price-detail-surcharge-data"></h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600 seemt-fz-16">VAT</p>
                            <h6 class="text-muted f-w-400 seemt-fz-16 reset-data-detail-payment-bill"
                                id="vat-detail-surcharge-data"></h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600 seemt-fz-16">Ngày tạo</p>
                            <h6 class="text-muted f-w-400 seemt-fz-16 reset-data-detail-payment-bill"
                                id="create-at-detail-surcharge-data"></h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600 seemt-fz-16">Ngày cập nhật</p>
                            <h6 class="text-muted f-w-400 seemt-fz-16 reset-data-detail-payment-bill"
                                id="update-at-size-detail-surcharge-data"></h6>
                        </div>
                        <div class="col-sm-12">
                            <p class="m-b-10 f-w-600 seemt-fz-16">Mô tả</p>
                            <h6 class="text-muted f-w-400 seemt-fz-16 reset-data-detail-payment-bill"
                                id="description-detail-surcharge-data" style="word-break: break-all"></h6>
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
            src="{{ asset('js/build_data/business/surcharge/detail.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
