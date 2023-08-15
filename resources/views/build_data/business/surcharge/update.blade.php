<div class="modal fade" id="modal-update-surcharge-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.surcharge-data.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateSurchargeData()" onkeypress="closeModalUpdateSurchargeData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-update-surcharge-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="name-update-surcharge-data" autocomplete="off" data-empty="1" data-min-length="2" data-max-length="50">
                            <label for="name-update-surcharge-data">
                                @lang('app.surcharge-data.update.name') @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="price-update-surcharge-data" class="text-right" data-empty="1" data-min="1000" data-max="999999999" data-money="1" value="0" >
                            <label for="price-update-surcharge-data">
                                @lang('app.surcharge-data.update.price') @include('layouts.start')</label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-select position-relative">
                            <div class="select-material-box" id="box-select-option-type-point">
                                <select class="js-example-basic-single form-control" id="select-option-update-vat-surcharge-data" tabindex="-1" aria-hidden="true">
                                    <option disabled hidden selected >Vui lòng chọn</option>
                                </select>
                                <label class="icon-validate">
                                    VAT
                                </label>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea id="description-update-surcharge-data" cols="5" rows="5" data-note-max-length="255" class="form__field"></textarea>
                                <label for="description-update-surcharge-data" class="form__label icon-validate">
                                    @lang('app.surcharge-data.update.description') </label>
                                <div class="line"></div>
                            </div>
                            <div class="textarea-character" id="char-count">
                                <span>0/2000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     id="save-update-surcharge-button"
                     onclick="saveUpdateSurchargeData()"
                     onkeypress="saveUpdateSurchargeData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/business/surcharge/update.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

