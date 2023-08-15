<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-detail-send-message">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="content-modal">
                <div class="modal-header">
                    <h4 class="my-2 modal-title">Chi tiết tin nhắn</h4>
                    <button type="button" class="close" onclick="closeModalDetailSendMessage()" onkeypress="closeModalDetailSendMessage()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
                <div class="modal-body text-left" id="loading-modal-detail-send-message">
                    <div class="row card card-block align-items-center" style="flex-direction: inherit !important;">
                        <div class="col-lg-4 col-sm-12">
                            <div id="image-gift-detail-send-message-campaign" style="width: 200px;height: 200px">
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">Tiêu đề</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="title-detail-send-message"></h6>
                                </div>
                                <div class="col-md-4">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">Tên quà tặng</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="name-gift-detail-send-message"></h6>
                                </div>
                                <div class="col-md-4">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">Ngày tạo</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="created-at-detail-send-message"></h6>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">Người nhận</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="receiver-detail-send-message"></h6>
                                </div>
                                <div class="col-md-4">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">Mô tả quà tặng</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="des-gift-detail-send-message"></h6>
                                </div>
                                <div class="col-md-4">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">Số lượng quà tặng</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="quantity-detail-send-message"></h6>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">Thông tin</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="content-detail-send-message"></h6>
                                </div>
                                <div class="col-md-4">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">Ngày gửi</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="sent-at-detail-send-message"></h6>
                                </div>
                                <div class="col-md-4">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">Thương hiệu</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="restaurant-at-detail-send-message"></h6>
                                </div>
                                <div class="col-md-12 d-none">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">Lý do hủy</p>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="reason-cancel-send-message"></h6>
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
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\marketing\campaign\send_message\detail.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
