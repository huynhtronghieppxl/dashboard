<div class="modal fade" id="modal-create-surcharge-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.surcharge-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateSurchargeData()" onkeypress="closeModalCreateSurchargeData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-create-surcharge-data">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="name-create-surcharge-data" autocomplete="off" data-empty="1" data-min-length="2"
                                   data-max-length="50">
                            <label for="name-create-surcharge-data">
                                @lang('app.surcharge-data.create.name') @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input class="text-right" id="price-create-surcharge-data" data-empty="1"
                                   data-max="999999999" data-min="1000" value="0">
                            <label for="price-create-surcharge-data">
                                @lang('app.surcharge-data.create.price') @include('layouts.start')</label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-select position-relative">
                            <div class="select-material-box" id="box-select-option-type-point">
                                <select class="js-example-basic-single form-control"
                                        id="select-option-vat-surcharge-data" tabindex="-1" aria-hidden="true">
                                    <option value="" disabled>Vui lòng chọn</option>
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
                                <textarea id="description-create-surcharge-data" cols="5" data-note-max-length="255" rows="5"
                                          class="form__field"></textarea>
                                <label for="description-create-surcharge-data"
                                       class="form__label icon-validate seemt-gray-w600">
                                    @lang('app.surcharge-data.create.description')</label>
                                <div class="line"></div>
                            </div>
                            <div class="textarea-character" id="char-count">
                                <span>0/255</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalCreateSurchargeData()"
                        onkeypress="resetModalCreateSurchargeData()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     id="save-create-surcharge-button"
                     onclick="saveCreateSurchargeData()"
                     onkeypress="saveCreateSurchargeData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/business/surcharge/create.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

