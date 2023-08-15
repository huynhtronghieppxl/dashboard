<div class="modal fade" id="modal-update-contact-supplier-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-data.supplier.contact.update.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalUpdateContactSupplier()" onkeypress="closeModalUpdateContactSupplier()">
                    <i class="fi-rr-cross"></i>
                </button>

            </div>
            <div class="modal-body text-left" id="load-modal-update-contact-supplier-data">
                <div class="card card-block m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="name-update-contact-supplier-data" class="form-control" type="text" data-empty="1" data-max-length="50" data-min-length="2">
                            <label for="name-update-contact-supplier-data">
                                @lang('app.supplier-data.supplier.contact.update.name-contact')
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>

                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="phone-update-contact-supplier-data" class="form-control" type="text" data-max-length="10" data-empty="1" data-phone="1">
                            <label for="phone-update-contact-supplier-data">
                                @lang('app.supplier-data.supplier.contact.update.phone-contact')
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="email-update-contact-supplier-data" class="form-control" type="text" data-mail="1" data-max-length="50">
                            <label for="email-update-contact-supplier-data">
                                @lang('app.supplier-data.supplier.contact.update.email')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group select2_theme validate-group" id="select-restaurant-membership-card-id">
                        <div class="form-validate-select">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="pr-0 select-material-box">
                                    <select id="select-role-update-contact-supplier" class="select-not-select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true"></select>
                                    <label class="icon-validate">
                                        @lang('app.supplier-data.supplier.contact.update.role')
                                    </label>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="save-update-btn-kitchen-data" type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="updateContact()" onkeypress="updateContact()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/supplier/supplier/contact/update.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
