<div class="modal fade" id="modal-detail-after-payment" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chi tiết thông báo</h4>
                <div class="d-flex align-items-center">
                    <button type="button" class="close ml-4" onclick="closeModalDetailCustomerMessage()" onkeypress="closeModalDetailCustomerMessage()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body text-left" id="loading-modal-detail-after-payment">
                <div class="flex-sub card card-block">
                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel">
                            <div class="row">
                                <div class="col-md-7">
                                    <p class="f-w-600 col-form-label-fz-15">Tên thương hiệu</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="name-branch-detail-after-payment"></h6>
                                </div>
                                <div class="col-md-5">
                                    <p class="f-w-600 col-form-label-fz-15">Loại thông báo</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="type-detail-after-payment"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <p class="f-w-600 col-form-label-fz-15">Nội dung</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="content-detail-after-payment"></h6>
                                </div>
                                <div class="col-md-5">
                                    <p class="f-w-600 col-form-label-fz-15">Ngày tạo</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="create-at-detail-after-payment"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/campaign/after_payment/detail.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
