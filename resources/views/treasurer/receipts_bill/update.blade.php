<div class="modal fade" id="modal-update-receipts-bill" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" id="modal-detail">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="exampleModalLabel">@lang('app.receipts-bill.update.title')</h4>
                <label class="label label-lg" id="payment-bill-label-check-status"></label>
                <button type="button" class="close" onclick="closeModalUpdateReceiptsBill()" onkeypress="closeModalUpdateReceiptsBill()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-update-receipts-bill">
                <div class="card-block card m-0">
                    <div class="form-group row align-items-center mb-2">
                        <label
                            class="col-sm-3 f-w-600 col-form-label-fz-15 mb-0">@lang('app.receipts-bill.detail.id-info')</label>
                        <div class="col-sm-9">: <span class="col-form-label-fz-15 text-muted" id="code-update-receipts-bill"></span></div>
                    </div>
                    <div class="form-group row align-items-center mb-2">
                        <label
                            class="col-sm-3 f-w-600 col-form-label-fz-15 mb-0">@lang('app.receipts-bill.create.group')</label>
                        <div class="col-sm-9">: <span class="col-form-label-fz-15 text-muted" id="group-update-receipts-bill"></span></div>
                    </div>
                    <div class="form-group row align-items-center mb-3">
                        <label
                        class="col-sm-3 f-w-600 col-form-label-fz-15 mb-0">@lang('app.receipts-bill.create.target')</label>
                        <div class="col-sm-9">: <span class="col-form-label-fz-15 text-muted" id="target-update-receipts-bill"></span></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input class="form-control text-right" id="value-update-receipts-bill" data-money="1" value="0" data-type="currency-edit" data-max="999999999" data-min="100">
                            <label>
                                @lang('app.receipts-bill.create.value')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group row align-items-center mb-2">
                        <label
                            class="col-sm-3 f-w-600 col-form-label-fz-15 mb-1">@lang('app.receipts-bill.create.type-money')</label>
                        <div class="col-sm-9">: <span class="col-form-label-fz-15 text-muted" id="value-type-update-receipts-bill"></span></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-checkbox">
                            <div class="checkbox-form-group">
                                <input type="checkbox" id="accounting-update-receipts-bill" checked="" data-toggle="tooltip" data-placement="top"   data-tooltip="1" class="input-tooltip" required="" data-tooltip="1">
                                <label class="name-checkbox"
                                       for="print-kitchen-create-food-brand-manage">@lang('app.payment-bill.create.accounting')
                                    <div class="tool-tip">
                                        <i class="fi-rr-exclamation text-inverse pointer"
                                           data-toggle="tooltip" data-placement="top"
                                           data-original-title="@lang('app.receipts-bill.accounting-title')"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select id="select-type-update-receipts-bill" class="js-example-basic-single select2-hidden-accessible" data-select="1">
                                        <option value="" disabled selected hidden>@lang('app.component.option_default')</option>
                                    </select>
                                    <label>
                                        @lang('app.receipts-bill.create.type')@include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    @if(Session::get(SESSION_KEY_LEVEL) > 0)
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input type="text" id="date-update-receipts-bill" class="input-sm form-control text-center input-datetimepicker p-1 date-update-receipts-bill" value="{{date('d/m/Y')}}">
                            <label>
                                @lang('app.receipts-bill.create.date')@include('layouts.start')</label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    @else
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input type="text" id="date-update-receipts-bill" class="input-sm form-control text-center input-datetimepicker p-1 date-update-receipts-bill-sales-solution" value="{{date('d/m/Y')}}">
                            <label>
                                @lang('app.receipts-bill.create.date')@include('layouts.start')</label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    @endif
                    <div class="form-group validate-group pt-2">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea class="form__field" id="description-update-receipts-bill" data-note-max-length="255" cols="5" rows="5"></textarea>
                                <label for="description-update-receipts-bill" class="form__label icon-validate">
                                    @lang('app.receipts-bill.create.note')
                                </label>
                                <div class="textarea-character">
                                    <span>0/300</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalUpdateReceiptsBill()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js\treasurer\receipts_bill\update.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

