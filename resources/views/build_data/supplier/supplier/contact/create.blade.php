<div class="modal fade" id="modal-create-contact-supplier-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-data.supplier.contact.create.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalCreateContactSupplier()" onkeypress="closeModalCreateContactSupplier()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="load-modal-create-contact-supplier-data">
                <div class="">
                    <div class="card card-block m-0">
                        <div class="form-group validate-group">
                            <div class="form-validate-input form-left">
                                <input id="name-contact-supplier-data" class="form-control" type="text" data-empty="1" data-max-length="50" data-min-length="2">
                                <label for="name-contact-supplier-data">
                                    @lang('app.supplier-data.supplier.contact.create.name-contact')
                                    @include('layouts.start')
                                </label>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="form-group validate-group">
                            <div class="form-validate-input form-left">
                                <input id="phone-contact-supplier-data" class="form-control" type="text" data-max-length="10" data-empty="1" data-phone="1">
                                <label for="phone-contact-supplier-data">
                                    @lang('app.supplier-data.supplier.contact.create.phone-contact')
                                    @include('layouts.start')
                                </label>
                            </div>
                            <div class="link-href"></div>
                        </div>

                        <div class="form-group validate-group">
                            <div class="form-validate-input form-left">
                                <input id="email-contact-supplier-data" class="form-control" type="text" data-mail="1" data-max-length="50">
                                <label for="email-contact-supplier-data">
                                    @lang('app.supplier-data.supplier.contact.create.email')
                                </label>
                            </div>
                            <div class="link-href"></div>
                        </div>

                        <div class="form-group select2_theme validate-group" id="select-restaurant-membership-card-id">
                            <div class="form-validate-select">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="pr-0 select-material-box">
                                        <select id="select-role-contact-supplier" class="select-not-select2 select2-hidden-accessible" data-select="1" data-empty="1" tabindex="-1" aria-hidden="true">
                                        </select>
                                        <label class="icon-validate">
                                           @lang('app.supplier-data.supplier.contact.create.role')
                                            @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateContactSupplier()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div id="save-create-btn-kitchen-data" type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveCreateContactSupplier()" onkeypress="saveCreateContactSupplier()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/supplier/supplier/contact/create.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
