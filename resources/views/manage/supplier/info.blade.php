<div class="modal fade" id="modal-detail-info-supplier-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document" style="padding-bottom: 13px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-manage.detail.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalDetailInfoSupplierManage()" onkeypress="closeModalDetailInfoSupplierManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-detail-info-supplier-manage">
                <div class="card card-block m-0">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <div class="card-block text-white user-profile d-flex justify-content-center align-items-center">
                                    <div class="m-b-25">
                                        <img
                                            id="avatar-detail-info-supplier-manage"
                                            onerror="imageDefaultOnLoadError($(this))"
                                            class="img-radius img-employee-custom"
                                            style="border-radius: 50%; width: 14rem; height: 14rem;"
                                            alt="Avatar"
                                            src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.info-suplier')</h6>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.name')</p>
                                        <h6 class="text-muted f-w-400 reset-data-detail-info-employee-manage col-form-label-fz-15" id="name-detail-info-supplier-manage" style="word-break: break-all;"></h6>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.type')</p>
                                        <h6 class="text-muted f-w-400 reset-data-detail-info-employee-manage col-form-label-fz-15" id="type-detail-info-supplier-manage"></h6>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.create')</p>
                                        <h6 class="text-muted f-w-400 reset-data-detail-info-employee-manage col-form-label-fz-15" id="create-detail-info-supplier-manage"></h6>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.phone')</p>
                                        <h6 class="text-muted f-w-400 reset-data-detail-info-employee-manage col-form-label-fz-15" id="phone-detail-info-supplier-manage"></h6>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.address')</p>
                                        <h6 class="text-muted f-w-400 reset-data-detail-info-employee-manage col-form-label-fz-15" id="address-detail-info-supplier-manage"></h6>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.tax')</p>
                                        <h6 class="text-muted f-w-400 reset-data-detail-info-employee-manage col-form-label-fz-15" id="code-detail-info-supplier-manager">---</h6>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.email')</p>
                                        <h6 class="text-muted f-w-400 reset-data-detail-info-employee-manage text-break col-form-label-fz-15" id="email-detail-info-supplier-manage" style="word-break: break-all;">---</h6>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.website')</p>
                                        <a class="text-muted f-w-400 reset-data-detail-info-employee-manage col-form-label-fz-15" id="website-detail-info-supplier-manage" style="word-break: break-all;">---</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.supplier-manage.detail.description')</p>
                                        <h6 class="text-muted f-w-400 reset-data-detail-info-employee-manage col-form-label-fz-15" id="description-detail-info-supplier-manage" data-limit-text="100" style="word-break: break-all;">---</h6>
                                    </div>
                                </div>
                                <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15 mt-3">thông tin sổ mua hàng của nhà cung cấp</h6>
                                <div class="card-block pl-0">
                                    <div class="row">
                                        <label class="col-sm-5 f-w-600 reset-data-detail-info-employee-manage col-form-label-fz-15">
                                            @lang('app.supplier-manage.detail.done-order')
                                            <label for="" class="text-muted col-form-label-fz-15">(<label class="col-form-label-fz-15" id="done-order-detail-info-supplier-manage"></label> đơn)</label>
                                        </label>
                                        <label class="col-sm-7 f-w-600 reset-data-detail-info-employee-manage col-form-label-fz-15 text-right" id="done-amount-detail-info-supplier-manage">0</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-5 f-w-600 reset-data-detail-info-employee-manage col-form-label-fz-15">
                                            @lang('app.supplier-manage.detail.waiting-order')
                                            <label for="" class="text-muted col-form-label-fz-15">(<label class="col-form-label-fz-15" id="waiting-order-detail-info-supplier-manage"></label> đơn)</label>
                                        </label>
                                        <label class="col-sm-7 f-w-600 reset-data-detail-info-employee-manage col-form-label-fz-15 text-right" id="waiting-amount-detail-info-supplier-manage">0</label>
                                    </div>
                                    <div class="row" style="border-bottom: 1px solid;">
                                        <label class="col-sm-5 f-w-600 reset-data-detail-info-employee-manage col-form-label-fz-15">
                                            @lang('app.supplier-manage.detail.debt-order')
                                            <label for="" class="text-muted col-form-label-fz-15">(<label class="col-form-label-fz-15" id="debt-order-detail-info-supplier-manage"></label> đơn)</label>
                                        </label>
                                        <label class="col-sm-7 f-w-600 reset-data-detail-info-employee-manage col-form-label-fz-15 text-right" id="debt-amount-detail-info-supplier-manage">0</label>
                                    </div>
                                    <div class="row mt-2">
                                        <label class="col-sm-5 f-w-600 reset-data-detail-info-employee-manage col-form-label-fz-15">
                                            @lang('app.supplier-manage.detail.total-order')
                                            <label for="" class="text-muted col-form-label-fz-15">(<label class="col-form-label-fz-15" id="total-order-detail-info-supplier-manage"></label> đơn)</label>
                                        </label>
                                        <label class="col-sm-7 f-w-600 reset-data-detail-info-employee-manage col-form-label-fz-15 text-right" id="total-amount-detail-info-supplier-manage">0</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-5 f-w-600 reset-data-detail-info-employee-manage col-form-label-fz-15">
                                            @lang('app.supplier-manage.detail.return-order')
                                            <label for="" class="text-muted col-form-label-fz-15">(<label class="col-form-label-fz-15" id="return-order-detail-info-supplier-manage"></label> đơn)</label>
                                        </label>
                                        <label class="col-sm-7 f-w-600 reset-data-detail-info-employee-manage col-form-label-fz-15 text-right" id="return-amount-detail-info-supplier-manage">0</label>
                                    </div>
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
    <script type="text/javascript" src="{{asset('/js/manage/supplier/info.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
