<div class="modal fade" id="modal-update-supplier-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-data.supplier.update.title')</h4>
                <div class="d-flex">
                    <h5 id="status-update-supplier-data"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalUpdateSupplierData()" onkeypress="closeModalUpdateSupplierData()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body text-left " id="loading-modal-update-supplier-data">
                <div class="card card-block m-0">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <div class="profile-thumb mb-2" style="width: 223px">
                                <img
                                    class="profile-image-avatar"
                                    alt=""
                                    src="http://127.0.0.1:8000/images/tms/default.jpeg"
                                    id="picture-update-supplier-list-supplier"
                                    data-url-avt=""
                                    data-url-thumb=""
                                    style="border-radius: 50%; border: 3px solid #c1c1c1; width: 11rem; height: 11rem;"
                                />
                                <div class="edit-profile pointer" style="right: 45px;">
                                    <label class="fileContainer">
                                        <i class="fa fa-camera"></i>
                                        <input type="file" id="input-picture-update-supplier-list-supplier" accept="image/*" />
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 pr-0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input id="name-update-supplier-data" class="form-control" type="text" data-spec="1" data-empty="1" data-max-length="50" data-min-length="2">
                                            <label for="name-update-supplier-data">
                                                @lang('app.supplier-data.supplier.update.name')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input id="tax-update-supplier-data" class="form-control" type="text"  data-number="1" data-tax-code="1" data-max-length="15">
                                            <label for="tax-update-supplier-data">
                                                @lang('app.supplier-data.supplier.update.tax')
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
                                            <input id="phone-update-supplier-data" class="form-control" type="text" data-phone="1" data-empty="1">
                                            <label for="phone-update-supplier-data">
                                                @lang('app.supplier-data.supplier.update.phone')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input id="website-update-supplier-data" class="form-control" type="text" data-max-length="1000">
                                            <label for="website-update-supplier-data">
                                                @lang('app.supplier-data.supplier.update.website')
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
                                            <input id="email-update-supplier-data" class="form-control" type="text" data-max-length="50"  data-mail="1">
                                            <label for="email-update-supplier-data">
                                                @lang('app.supplier-data.supplier.update.email')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input id="address-update-supplier-data" class="form-control" type="text" data-min-length="2" data-max-length="255" data-empty="1">
                                            <label for="address-update-supplier-data">
                                                @lang('app.supplier-data.supplier.update.address')
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
                                                <textarea class="form__field" id="note-update-supplier-data" rows="5" cols="6" data-note-max-length="1000"></textarea>
                                                <label for="note-update-supplier-data" class="form__label icon-validate">
                                                    @lang('app.supplier-data.supplier.update.note')
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
                <div id="btn-update-supplier-data" type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateSupplierData()" onkeypress="saveModalUpdateSupplierData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <span id="status-id-update-supplier-data"></span>
    <span id="id-update-supplier-data"></span>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/supplier/supplier/update.js?version=6', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
