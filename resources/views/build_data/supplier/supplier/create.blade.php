<?php header('Access-Control-Allow-Origin: *'); ?>
<div class="modal fade" id="modal-create-supplier-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-data.supplier.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateSupplierData()" onkeypress="closeModalCreateSupplierData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-create-supplier-data">
                <div class="card card-block m-0">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <div class="profile-thumb mb-2" style="width: 223px">
                                <img
                                    class="profile-image-avatar"
                                    alt=""
                                    src="http://127.0.0.1:8000/images/tms/default.jpeg"
                                    id="picture-create-supplier-list-supplier"
                                    data-url-avt=""
                                    data-url-thumb=""
                                    style="border-radius: 50%; border: 3px solid #c1c1c1; width: 11rem; height: 11rem;"
                                />
                                <div class="edit-profile pointer" style="right: 45px;">
                                    <label class="fileContainer">
                                        <i class="fa fa-camera"></i>
                                        <input type="file" id="input-picture-create-supplier-list-supplier" accept="image/*" />
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 pr-0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input id="name-create-supplier-data" class="form-control" type="text" tabindex="0" data-spec="1" data-empty="1" data-max-length="50" data-min-length="2">
                                            <label for="name-create-supplier-data">
                                                @lang('app.supplier-data.supplier.create.name')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input id="tax-create-supplier-data" class="form-control" type="text" tabindex="1" data-number="1" data-tax-code="1" data-max-length="15">
                                            <label for="tax-create-supplier-data">
                                                @lang('app.supplier-data.supplier.create.tax')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input id="phone-create-supplier-data" class="form-control" type="text" tabindex="2" data-phone="1" data-empty="1">
                                            <label for="phone-create-supplier-data">
                                                @lang('app.supplier-data.supplier.create.phone')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input id="website-create-supplier-data" class="form-control" type="text" tabindex="3" data-max-length="1000">
                                            <label for="website-create-supplier-data">
                                                @lang('app.supplier-data.supplier.create.website')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input id="email-create-supplier-data" class="form-control" type="text" tabindex="4" data-max-length="50"  data-mail="1">
                                            <label for="email-create-supplier-data">
                                                @lang('app.supplier-data.supplier.create.email')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input id="address-create-supplier-data" class="form-control" type="text" tabindex="5" data-min-length="2" data-max-length="255" data-empty="1">
                                            <label for="address-create-supplier-data">
                                                @lang('app.supplier-data.supplier.create.address')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-textarea">
                                            <div class="form__group pt-2">
                                                <textarea class="form__field" id="note-create-supplier-data" rows="5" cols="6" tabindex="6" data-note-max-length="1000"></textarea>
                                                <label for="note-create-supplier-data" class="form__label icon-validate">
                                                    @lang('app.supplier-data.supplier.create.note')
                                                </label>
                                                <div class="textarea-character">
                                                    <span>0/300</span>
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
                <button type="button" class="btn-renew d-none" onclick="resetModalCreateSupplierData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div id="btn-create-supplier-data" type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalCreateSupplierData()" onkeypress="saveModalCreateSupplierData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>

            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/supplier/supplier/create.js?version=8', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
