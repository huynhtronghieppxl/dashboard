<div class="modal fade" id="modal-register-ahamove-transport-partner" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kết nối đối tác vận chuyển</h4>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-create-material">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="form-group row">
                                    <label
                                        class="col-sm-3 my-auto font-weight-bold col-form-label">Thương hiệu</label>
                                    <div class="col-sm-9" style="text-align: center">
                                        <img src="{{asset('..\images\logo\BrandingLogomoi-01-1.png')}}"
                                             style="width: auto;height: 200px;"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-3 my-auto font-weight-bold col-form-label">Họ và tên</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" data-validate="username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-3 my-auto font-weight-bold col-form-label">Số điện thoại</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" data-validate="phone-required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-3 my-auto font-weight-bold col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" data-validate="mail">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-3 my-auto font-weight-bold col-form-label">Địa chỉ</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" data-validate="address">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-3 my-auto font-weight-bold col-form-label">Thành phố</label>
                                    <div class="col-sm-9">
                                        <select id="category-create-material-data"
                                                class="js-example-basic-single" data-select-not-empty>
                                            <option value="-2" selected
                                                    disabled hidden>@lang('app.component.option_default')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-3 my-auto font-weight-bold col-form-label">Tên định danh</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" data-validate="passport">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-grd-disabled waves-effect" onclick="closeModalConnectAhamove()"
                        onkeypress="closeModalConnectAhamove()">@lang('app.component.button.close')</button>
                <button type="button"
                        class="btn btn-primary waves-effect waves-light" onclick="closeModalConnectAhamove()"
                        onkeypress="closeModalConnectAhamove()">@lang('app.component.button.save')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\transport\partner\ahamove\index.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
