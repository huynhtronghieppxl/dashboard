<div class="modal fade" id="modal-update-info-partner-invoice" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật thông tin đối tác</h4>
                <button type="button" class="close" onclick="closeModalUpdatePartnerInvoice()" onkeypress="closeModalUpdatePartnerInvoice()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
                <div class="modal-body text-left">
                    <div class="tab-content central-meta" id="content-form-partner-invoice-contact">
                            <div class="tab-pane fade active show" id="terms">
                                <div class="col-lg-12 px-0">
                                    <div class="card card-block m-0">
                                        <div class="mt-1">
                                            <div class="row">
                                                <div class="col-lg-6 text-left" style="font-weight: 700;font-size: 16px">
                                                    Thông tin cấu hình để xuất hóa đơn cho:
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group select2_theme validate-group">
                                                        <div class="form-validate-select ">
                                                            <div class="col-lg-12 select-material-box">
                                                                <select id="select-update-partner-invoice" data-select="1"
                                                                        class="js-example-basic-single select2-hidden-accessible">
                                                                    <option disabled selected>Vui lòng chọn</option>
                                                                </select>
                                                                <label class="icon-validate">
                                                                    Chọn đối tác
                                                                    @include('layouts.start')
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="link-href"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-1">
{{--                                            <h5 class="text-left mt-4" style="font-weight: 700;font-size: 16px">Thông tin cấu hình của chi nhánh: </h5>--}}
                                            <div class="row">
                                                <div class="col-lg-6 text-left" style="font-weight: 700;font-size: 16px">
                                                    Thông tin cấu hình của chi nhánh:
                                                </div>
                                                <div class="col-lg-6">
                                                    <span id="name-update-branch-partner-invoice-contact" class="text-primary seemt-fz-16">----</span>
                                                </div>
                                            </div>
                                            <div class="mt-3" id="form-update-partner-invoice">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group validate-group">
                                                            <div class="form-validate-input">
                                                                <input id="account-update-partner-invoice" class="form-control" data-empty="1" data-min-length="2" data-max-length="50" data-dot="1">
                                                                <label for="account-update-partner-invoice">
                                                                    Tài khoản
                                                                    @include('layouts.start')
                                                                </label>
                                                                <div class="line"></div>
                                                            </div>
                                                            <div class="link-href"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 d-none" id="form-group-password-update-partner-invoice">
                                                        <div class="form-group validate-group">
                                                            <div class="form-validate-input">
                                                                <input id="password-update-partner-invoice" type="password" autocomplete="off"
                                                                       class="form-control" data-empty="1" data-min-length="2"
                                                                       data-max-length="50">
                                                                <label for="password-create-partner-invoice">
                                                                    Mật khẩu
                                                                    @include('layouts.start')
                                                                </label>
                                                                <div class="line"></div>
                                                                <div style="position: absolute;
                                                                right: 2%;
                                                                top: 35%;
                                                                bottom: 35%;
                                                                 height: 0px;
                                                                transform: translate(-50%, -50%);
                                                                cursor: pointer;
                                                                z-index: 99 !important;">
                                                                    <i class="fi-rr-eye-crossed"></i>
                                                                </div>
                                                            </div>
                                                            <div class="link-href"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group validate-group">
                                                            <div class="form-validate-input">
                                                                <input id="tax-code-update-partner-invoice" class="form-control" data-empty="1" data-min-length="10" data-max-length="15" data-spec-all="1" data-number="1">
                                                                <label for="tax-code-update-partner-invoice">
                                                                    Mã số thuế doanh nghiệp
                                                                    @include('layouts.start')
                                                                </label>
                                                                <div class="line"></div>
                                                            </div>
                                                            <div class="link-href"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group validate-group">
                                                            <div class="form-validate-input">
                                                                <input id="denominator-update-partner-invoice" class="form-control" data-empty="1" data-min-length="1" data-max-length="6" data-spec-all="1">
                                                                <label for="denominator-update-partner-invoice">
                                                                    Mẫu số hóa đơn
                                                                    @include('layouts.start')
                                                                </label>
                                                                <div class="line"></div>
                                                            </div>
                                                            <div class="link-href"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group validate-group">
                                                            <div class="form-validate-input">
                                                                <input id="symbol-bill-update-partner-invoice" class="form-control" data-empty="1" data-min-length="1" data-max-length="7" data-spec-all="1">
                                                                <label for="symbol-bill-update-partner-invoice">
                                                                    Chữ ký điện tử
                                                                    @include('layouts.start')
                                                                </label>
                                                                <div class="line"></div>
                                                            </div>
                                                            <div class="link-href"></div>
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
            <div class="modal-footer">
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="savePartnerInvoiceUpdate()" onkeypress="savePartnerInvoiceUpdate()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\setting\partner_invoice\update.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
