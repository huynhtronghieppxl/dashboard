<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-update-food-vat-setting">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa VAT</h4>
                <button type="button" class="close" onclick="closeModalUpdateVatSetting()" onkeypress="closeModalUpdateVatSetting()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left create-unit-data" id="loading-modal-update-food-vat-setting">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input class="form-control" id="name-update-vat-setting" data-empty="1" data-min-length="2" data-max-length="50"/>
                            <label>
                                Tên VAT
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="percent-update-vat-setting" class="form-control" type="text" data-empty="1" data-percent="1" data-number="1" />
                            <label for="percent-update-vat-setting">
                                Thuế(%)
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalUpdateVatSetting()"
                     onkeypress="saveModalUpdateVatSetting()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.title-button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\setting\vat_manage\vat_config\update.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
