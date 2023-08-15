<div class="modal fade" id="modal-create-payment-recurring-bill" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document" id="size-modal-create-payment-recurring-bill">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.payment-recurring-bill.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreatePaymentRecurringBill()" onkeypress="closeModalCreatePaymentRecurringBill()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-create-payment-recurring-bill">
                <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input class="form-control" id="input-target-create-payment-recurring-bill" data-empty="1" data-min-length="2" data-max-length="50" data-spec="1"/>
                            <label>
                                @lang('app.payment-recurring-bill.create.target')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select id="select-type-create-payment-recurring-bill" class="js-example-basic-single select2-hidden-accessible" data-select="1" tabindex="-1" aria-hidden="true">
                                        <option value="-2" disabled selected hidden>@lang('app.component.option_default')</option>
                                    </select>
                                    <label>
                                        @lang('app.payment-recurring-bill.create.type')
                                        @include('layouts.start')
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="row">
                        <div class="form-group validate-group col-6 pl-0">
                            <div class="form-validate-input">
                                <input class="form-control" id="input-recurring-create-payment-recurring-bill" value="1" data-number="1" data-max="12"  data-type="currency-edit"/>
                                <label>
                                    @lang('app.payment-recurring-bill.create.type-recurring')
                                </label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="form-group select2_theme validate-group col-6 pr-0">
                            <div class="form-validate-select">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 pr-0 select-material-box">
                                        <select id="select-type-recurring-create-payment-recurring-bill" class="js-example-basic-single select2-hidden-accessible" data-select="1" tabindex="-1" aria-hidden="true">
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
                                    <span class="text text-warning ml-auto"> @lang('app.payment-recurring-bill.create.type-date') <span class="font-1-em" id="type-date-create-payment-recurring-bill">{{date("d/m/Y", time() + 86400)}}</span></span><br>
                                </div>
                        </div>
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <div class="form-validate-input form-validate-input-addon" id="get-div-validate-create-payment-recurring-bill">--}}
{{--                            <label class="col-form-label" style="top: -9px;">@lang('app.payment-recurring-bill.create.type-recurring')</label>--}}
{{--                            <div class="col-sm-12 input-group align-items-center" style="padding: 0!important">--}}
{{--                                <input class="text-center border h-28 col-lg-3" style="margin-left: auto !important;" id="input-recurring-create-payment-recurring-bill" value="1" data-number="1" data-max="12"  data-type="currency-edit" />--}}
{{--                                <select id="select-type-recurring-create-payment-recurring-bill" class="select2-add-on input-group-addon col-lg-9 select2-hidden-accessible" tabindex="-1" aria-hidden="true">--}}
{{--                                    <option value="1">@lang('app.payment-recurring-bill.create.daily')</option>--}}
{{--                                    <option value="3">@lang('app.payment-recurring-bill.create.monthly')</option>--}}
{{--                                    <option value="4">@lang('app.payment-recurring-bill.create.quarterly')</option>--}}
{{--                                    <option value="5">@lang('app.payment-recurring-bill.create.yearly')</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="link-href text-right">--}}
{{--                            <span class="text text-warning ml-auto"> @lang('app.payment-recurring-bill.create.type-date') <span class="font-1-em" id="type-date-create-payment-recurring-bill">{{date("d/m/Y", time() + 86400)}}</span></span><br>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="row">
                        <div class="col-6 form-group validate-group p-0">
                            <div class="form-validate-input">
                                <input class="form-control text-right" id="value-create-payment-recurring-bill" value="100" data-min="100" data-max="999999999"/>
                                <label> Số tiền</label>
                                <div class="line"></div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="col-6 form-group select2_theme validate-group pr-0">
                            <div class="form-validate-select">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 pr-0 select-material-box">
                                        <select class="js-example-basic-single form-control select2-hidden-accessible" id="select-value-create-payment-recurring-bill" tabindex="-1" aria-hidden="true">
                                            <option value="1">@lang('app.payment-recurring-bill.create.opt-cash')</option>
                                            <option value="6">@lang('app.payment-recurring-bill.create.opt-bank')</option>
                                        </select>
                                        <label> @lang('app.payment-recurring-bill.create.type-money')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-checkbox pb-0 py-2">
                            <div class="checkbox-form-group">
                                <input type="checkbox" id="accounting-create-payment-recurring-bill"  checked="" data-toggle="tooltip" data-placement="top" data-original-title="" data-tooltip="1" class="input-tooltip" required="" data-tooltip="1">
                                <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">@lang('app.payment-recurring-bill.create.accounting')
                                    <div class="tool-tip">
                                        <i class="fi-rr-exclamation tooltip_formula" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.receipts-bill.accounting-title')"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea class="form__field" id="description-create-payment-recurring-bill"  data-note-max-length="255" cols="5" rows="5" placeholder=""></textarea>
                                <label for="description-create-payment-recurring-bill" class="form__label icon-validate">Ghi chú </label>
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
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreatePaymentRecurringBill()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalCreatePaymentRecurringBill()" onkeypress="saveModalCreatePaymentRecurringBill()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js\treasurer\payment_recurring_bill\create.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
