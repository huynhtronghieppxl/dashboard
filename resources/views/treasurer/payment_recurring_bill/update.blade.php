<div class="modal fade" id="modal-update-payment-recurring-bill" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document" id="size-modal-update-payment-recurring-bill">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.payment-recurring-bill.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdatePaymentRecurringBill()" onkeypress="closeModalUpdatePaymentRecurringBill()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-update-payment-recurring-bill">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input class="form-control" id="input-target-update-payment-recurring-bill" data-min-length="2" data-max-length="50" data-empty="1" data-spec="1"/>
                            <label>
                                @lang('app.payment-recurring-bill.update.target')
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select id="select-type-update-payment-recurring-bill" data-select="1" class="js-example-basic-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        <option value="" disabled selected>@lang('app.component.option_default')
                                    </select>
                                    <label>
                                        @lang('app.payment-recurring-bill.update.type')
                                        @include('layouts.start')
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="row" id="get-div-validate-recurring-update-payment-recurring-bill">
                        <div class="form-group validate-group col-6 pl-0">
                            <div class="form-validate-input">
                                <input class="form-control" id="input-recurring-update-payment-recurring-bill" value="1" data-number="1" data-max="12"  data-type="currency-edit"/>
                                <label>
                                    @lang('app.payment-recurring-bill.update.type-recurring')
                                </label>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="form-group select2_theme validate-group col-6 pr-0">
                            <div class="form-validate-select">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 pr-0 select-material-box">
                                        <select id="select-type-recurring-update-payment-recurring-bill" class="js-example-basic-single select2-hidden-accessible" data-select="1" tabindex="-1" aria-hidden="true">
                                            <option value="1">@lang('app.payment-recurring-bill.create.daily')</option>
                                            <option value="3">@lang('app.payment-recurring-bill.create.monthly')</option>
                                            <option value="4">@lang('app.payment-recurring-bill.create.quarterly')</option>
                                            <option value="5">@lang('app.payment-recurring-bill.create.yearly')</option>
                                        </select>
                                        <label>
                                            @lang('app.payment-recurring-bill.create.type-recurring-repeat')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="link-href text-right">
                                <span class="text text-warning ml-auto"> @lang('app.payment-recurring-bill.update.type-date')<span class="font-1-em ml-1" id="type-date-create-payment-recurring-bill">{{date("d/m/Y", time() + 86400)}}</span></span><br>
                            </div>
                        </div>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <div class="form-validate-input form-validate-input-addon" id="get-div-validate-recurring-update-payment-recurring-bill">--}}
{{--                            <label class="col-form-label" style="top: -9px;">@lang('app.payment-recurring-bill.update.type-recurring')</label>--}}
{{--                            <div class="col-sm-12 input-group align-items-center" style="padding: 0!important">--}}
{{--                                <input class="text-center border h-28 col-lg-3" id="input-recurring-update-payment-recurring-bill" value="1"  data-max="12" data-number="1"  data-type="currency-edit" />--}}
{{--                                <select id="select-type-recurring-update-payment-recurring-bill" class="select2-add-on input-group-addon col-lg-9 select2-hidden-accessible" tabindex="-1" aria-hidden="true">--}}
{{--                                    <option value="1">@lang('app.payment-recurring-bill.create.daily')</option>--}}
{{--                                    <option value="3">@lang('app.payment-recurring-bill.create.monthly')</option>--}}
{{--                                    <option value="4">@lang('app.payment-recurring-bill.create.quarterly')</option>--}}
{{--                                    <option value="5">@lang('app.payment-recurring-bill.create.yearly')</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="line"></div>--}}
{{--                        </div>--}}
{{--                        <div class="link-href text-right">--}}
{{--                            <span class="text text-warning ml-auto"> @lang('app.payment-recurring-bill.update.type-date') <span class="font-1-em" id="type-date-update-payment-recurring-bill">01/08/2022</span></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="row">
                        <div class="col-6 form-group validate-group p-0">
                            <div class="form-validate-input">
                                <input class="form-control text-right" id="value-update-payment-recurring-bill" value="100" data-min="100" data-max="999999999" data-money="1" data-type="currency-edit"/>
                                <label> @lang('app.payment-recurring-bill.update.value')</label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="col-6 form-group select2_theme validate-group pr-0">
                            <div class="form-validate-select">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 pr-0 select-material-box">
                                        <select class="js-example-basic-single form-control select2-hidden-accessible" id="select-value-update-payment-recurring-bill" data-select="1" tabindex="-1" aria-hidden="true">
                                            <option value="1">@lang('app.payment-recurring-bill.update.opt-cash')</option>
                                            <option value="6">@lang('app.payment-recurring-bill.update.opt-bank')</option>
                                        </select>
                                        <label>
                                            @lang('app.payment-recurring-bill.update.type-money')
                                            @include('layouts.start')
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-checkbox pb-0 py-2">
                            <div class="checkbox-form-group">
                                <input type="checkbox" id="accounting-update-payment-recurring-bill"  checked="" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.receipts-bill.accounting-title')" data-tooltip="1" class="input-tooltip" required="" data-tooltip="1">
                                <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">@lang('app.payment-recurring-bill.update.accounting')
                                    <div class="tool-tip">
                                        <i class="fi-rr-exclamation tooltip_formula" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.receipts-bill.accounting-title')"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
{{--                    <div class="form-group validate-group"><div class="form-validate-checkbox">--}}
{{--                            <i class="icofont icofont-disc"></i>--}}
{{--                            <div class="checkbox-zoom zoom-primary">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox" id="accounting-update-payment-recurring-bill"  checked="" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.receipts-bill.accounting-title')" data-tooltip="1" class="input-tooltip" required="" data-tooltip="1">--}}
{{--                                    <span class="cr">--}}
{{--                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>--}}
{{--                                    </span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <label for=" $(this).attr(id) ">--}}
{{--                                <i class="icofont  $(this).attr(data-icon) "></i>--}}
{{--                                @lang('app.payment-recurring-bill.update.accounting')--}}
{{--                            </label>--}}
{{--                            <div class="line"></div>--}}
{{--                            <div class="tool-tip">--}}
{{--                                <i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.receipts-bill.accounting-title')"></i></div>--}}
{{--                            </div>--}}
{{--                    </div>--}}
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea class="form__field" id="description-update-payment-recurring-bill" data-note-max-length="255" cols="5" rows="5" placeholder=""></textarea>
                                <label for="description-update-payment-recurring-bill" class="form__label icon-validate"> Ghi chú </label>
                                <div class="textarea-character" id="char-count">
                                    <span>0/300</span>
                                </div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalUpdatePaymentRecurringBill()"
                     onkeypress="saveModalUpdatePaymentRecurringBill()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js\treasurer\payment_recurring_bill\update.js?version='.date('d/m/Y H').')', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
