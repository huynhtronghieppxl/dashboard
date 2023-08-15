<div class="modal fade" id="modal-qr-card-membership" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Mã code thẻ nạp</h4>
                <button type="button" class="close" onclick="closeModalQrCodeCardMembership()" onkeypress="closeModalQrCodeCardMembership()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="card card-block">
                    <div class="form-group justify-content-center">
                        <div id="code-qr-card-membership" class="text-center"></div>
                        <div class="row justify-content-center mt-3">
                            <label
                                class="f-w-600 col-form-label-fz-15">MÃ SỐ: <span style="font-size: 18px !important;" id="code-number-qr-card-membership"></span>
                                <span id="copy-text-code-qr" data-toggle="tooltip" data-placement="top" data-original-title="Sao chép mã QR" style="cursor: pointer"><i class="fi-rr-copy" style="font-size: 19px !important; margin-left: 5px;"></i></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
