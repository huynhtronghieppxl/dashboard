<div class="modal fade" id="modal-create-info-partner-invoice" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tạo thông tin đối tác</h4>
                <button type="button" class="close" onclick="closeModalCreatePartnerInvoice()" onkeypress="closeModalCreatePartnerInvoice()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="tab-content central-meta form-create-partner-invoice">
                    <div class="tab-pane fade active show" id="terms">
                        <div class="col-lg-12 px-0">
                            <div class="card card-block m-0">
                                <div class="">
                                    <div class="row">
                                        <div class="col-lg-6 text-left" style="font-weight: 700;font-size: 16px">Thông tin cấu hình để xuất hóa đơn cho:</div>
                                        <div class="col-lg-6">
                                            <div class="form-group select2_theme validate-group">
                                                <div class="form-validate-select">
                                                    <div class="col-lg-12 mx-0 px-0">
                                                        <div class="col-lg-12 pr-0 select-material-box">
                                                            <select id="select-create-partner-invoice" data-select="1"
                                                                    class="js-example-basic-single select2-hidden-accessible"
                                                                    tabindex="-1" aria-hidden="true">
                                                                <option disabled selected>Vui lòng chọn</option>
                                                            </select>
                                                            <label class="icon-validate">
                                                                Chọn đối tác
                                                                @include('layouts.start')
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="row">
                                        <div class="col-lg-6 text-left" style="font-weight: 700;font-size: 16px">
                                            Thông tin cấu hình của chi nhánh:
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group select2_theme validate-group">
                                                <div class="form-validate-select">
                                                    <div class="mx-0 px-0 select-material-box">
                                                        <select id="select-branch-create-partner-invoice" class="js-example-basic-single select2-hidden-accessible">


                                                        </select>
                                                        <label class="icon-validate">Chi nhánh</label>
                                                        <div class="line"></div>
                                                    </div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-create-partner-invoice">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-input">
                                                        <input id="account-create-partner-invoice" class="form-control" data-empty="1" data-min-length="2" data-max-length="50" data-dot="1">
                                                        <label for="name-create-employee-manage">
                                                            Tài khoản
                                                            @include('layouts.start')
                                                        </label>
                                                        <div class="line"></div>
                                                    </div>
                                                    <div class="link-href"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" id="form-group-password-create-partner-invoice">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-input">
                                                        <input id="password-create-partner-invoice" type="password" autocomplete="off"
                                                               class="form-control" data-empty="1" data-min-length="2"
                                                               data-max-length="50">
                                                        <label for="name-create-employee-manage">
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
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-input">
                                                        <input id="tax-code-create-partner-invoice" class="form-control" data-empty="1" data-min-length="10" data-max-length="15" data-spec-all="1" data-number="1">
                                                        <label for="name-create-employee-manage">
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
                                                        <input id="denominator-create-partner-invoice" class="form-control" data-empty="1" data-min-length="1" data-max-length="7" data-spec-all="1">
                                                        <label for="name-create-employee-manage">
                                                            Mẫu số hóa đơn
                                                            @include('layouts.start')
                                                        </label>
                                                        <div class="line"></div>
                                                    </div>
                                                    <div class="link-href"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-input">
                                                        <input id="symbol-bill-create-partner-invoice" class="form-control" data-empty="1" data-min-length="1" data-max-length="6" data-spec-all="1">
                                                        <label for="name-create-employee-manage">
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
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="savePartnerInvoiceCreate()" onkeypress="savePartnerInvoiceCreate()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\setting\partner_invoice\create.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
