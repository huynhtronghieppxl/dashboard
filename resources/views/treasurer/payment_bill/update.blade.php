<div class="modal fade" id="modal-update-payment-bill" data-keyboard="false" data-backdrop="static" >
    <div class="modal-dialog modal-md" role="document" id="size-modal-update-payment-bill">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.payment-bill.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdatePaymentBill()" onkeypress="closeModalUpdatePaymentBill()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color p-0" id="loading-update-payment-bill">
                <div class="card-block p-0 m-0">
                    <div class="row d-flex">
                        @if(Session::get(SESSION_KEY_LEVEL) > 0)
                            <div class="edit-flex-auto-fill d-none" id="left-update-payment-bill">
                                <div class="card card-block mb-0 flex-sub">
                                    <h5 class="sub-title">@lang('app.payment-bill.update.title-left')</h5>
                                    <div class="table-responsive new-table">
                                        <table id="table-supplier-order-update-payment-bill"
                                               class="table">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">STT</th>
                                                <th rowspan="2">
                                                    <div class="checkbox-fade fade-in-primary m-0">
                                                        <label>
                                                            <input type="checkbox" id="check-all-supplier-order-update-payment-bill" onclick="checkAllItemSupplierOrderUpdatePaymentBill($(this))" checked/>
                                                            <span class="cr" data-toggle="tooltip" data-placement="top" data-original-title="Chọn tất cả"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                        </label>
                                                    </div>
                                                </th>
                                                <th rowspan="2">@lang('app.payment-bill.update.code')</th>
                                                <th rowspan="2">@lang('app.payment-bill.update.supplier')</th>
                                                <th rowspan="2">@lang('app.payment-bill.update.employee_complete')</th>
                                                <th>@lang('app.payment-bill.update.total-amount')</th>
                                                <th rowspan="2">@lang('app.payment-bill.update.updated')</th>
                                                <th rowspan="2">@lang('app.payment-bill.update.retention-money')</th>
                                                <th rowspan="2">@lang('app.payment-bill.update.action')</th>
                                                <th rowspan="2" class="d-none"></th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <span id="total-debt-update-payment-bill">0</span>
                                                </th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-12 edit-flex-auto-fill p-0" id="right-update-payment-bill">
                            <div class="card card-block flex-sub m-0">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.update.id')</label>
                                            <div class="f-w-400">
                                                <label> <span class="text-muted col-form-label-fz-15" id="code-update-payment-bill"></span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.update.branch')</label>
                                            <div class="f-w-400">
                                                <label> <span class="text-muted col-form-label-fz-15" id="branch-update-payment-bill"></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-lg-6">
                                            <label class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.update.group')</label>
                                            <div class="f-w-400">
                                                <label><span class="text-muted col-form-label-fz-15" id="group-update-payment-bill"></span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="mb-1 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.update.target')</label>
                                            <div class="f-w-400">
                                                <label><span class="text-muted col-form-label-fz-15" id="target-update-payment-bill"></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-dashed mb-3 mt-1"></div>
                                    <div class="form-group row mb-3 pt-1" id="div-status-update-payment-bill">
                                        <label class="col-sm-4 mb-1 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.update.status')</label>
                                        <label class="col-sm-8 mb-0 pt-2">: <span class="text-muted col-form-label-fz-15" id="status-update-payment-bill"></span></label>
                                    </div>
                                    <div class="form-group select2_theme validate-group">
                                        <div class="form-validate-select ">
                                            <div class="col-lg-12 mx-0 px-0">
{{--                                                <div class="col-lg-12 pr-0 select-material-box">--}}
{{--                                                    <select id="select-type-update-payment-bill" data-select="1" class="js-example-basic-single select2-hidden-accessible">--}}
{{--                                                        <option value="" disabled selected>@lang('app.component.option_default')</option>--}}
{{--                                                    </select>--}}
{{--                                                    <label>--}}
{{--                                                        <i class="icofont icofont-tag"></i>@lang('app.payment-bill.update.type')<span class="text-danger">(*)</span>--}}
{{--                                                    </label>--}}
{{--                                                    <div class="line"></div>--}}
{{--                                                </div>--}}
                                                <div class="col-lg-12 select-material-box">
                                                    <select id="select-type-update-payment-bill" data-select="1"
                                                            class="js-example-basic-single select2-hidden-accessible">
                                                        <option value="-2" disabled selected
                                                                hidden>@lang('app.component.option_default')</option>
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.payment-bill.update.type')
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="form-group row hidden-class d-none">
                                        <label
                                            class="col-sm-4 col-form-label">@lang('app.payment-bill.update.original-amount')</label>
                                        <div class="col-sm-8 col-form-label">:
                                            <label class="font-1-rem" id="original-price-update-payment-bill">0</label>
                                        </div>
                                    </div>
                                    <div class="form-group row hidden-class d-none">
                                        <label
                                            class="col-sm-4 col-form-label">@lang('app.payment-bill.update.return-amount')</label>
                                        <div class="col-sm-8 col-form-label">:
                                            <label class="font-1-rem" id="return-price-update-payment-bill">0</label>
                                        </div>
                                    </div>
                                    <div class="row">
{{--                                        <div class="form-group validate-group col-lg-6 pl-0">--}}
{{--                                            <div class="form-validate-input">--}}
{{--                                                <input type="text" class="form-control text-right" id="value-update-payment-bill" data-money="1" value="100" data-min="100" data-max="999999999" data-type="currency-edit" >--}}
{{--                                                <label>--}}
{{--                                                    <i class="icofont icofont-money-bag"></i>@lang('app.payment-bill.update.value')<span class="text-danger">(*)</span></label>--}}
{{--                                                <div class="line"></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="link-href"></div>--}}
{{--                                        </div>--}}
                                        <div class="col-lg-6 form-group validate-group pl-0">
                                            <div class="form-validate-input form-left">
                                                <input type="text" class="form-control text-right"
                                                       id="value-update-payment-bill"
                                                       data-money="1" value="100" data-max="999999999">                                            <label for="name-update-specifications-data">
                                                    @lang('app.payment-bill.update.value')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>

{{--                                        <div class="form-group select2_theme validate-group col-lg-6 pr-0">--}}
{{--                                            <div class="form-validate-select ">--}}
{{--                                                <div class="col-lg-12 mx-0 px-0">--}}
{{--                                                    <div class="col-lg-12 pr-0 select-material-box">--}}
{{--                                                        <select id="select-value-update-payment-bill" data-select="1" class="js-example-basic-single select2-hidden-accessible">--}}
{{--                                                            <option value="1">@lang('app.payment-bill.update.opt-cash')</option>--}}
{{--                                                            <option value="6">@lang('app.payment-bill.update.opt-bank')</option>--}}
{{--                                                        </select>--}}
{{--                                                        <label>--}}
{{--                                                            <i class="icofont icofont-money-bag"></i>@lang('app.payment-bill.update.type-money')<span class="text-danger">(*)</span>--}}
{{--                                                        </label>--}}
{{--                                                        <div class="line"></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="link-href"></div>--}}
{{--                                        </div>--}}
                                        <div class="col-lg-6 form-group select2_theme validate-group pr-0">
                                            <div class="form-validate-select">
                                                <div class="col-lg-12 select-material-box">
                                                    <select id="select-value-update-payment-bill"
                                                            class="js-example-basic-single select2-hidden-accessible"
                                                            data-select="1">
                                                        <option value="1">@lang('app.payment-bill.update.opt-cash')</option>
                                                        <option value="6">@lang('app.payment-bill.update.opt-bank')</option>
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.payment-bill.update.type-money')
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    </div>
{{--                                    <div class="form-group validate-group"><div class="form-validate-checkbox">--}}
{{--                                            <i class="icofont icofont-disc"></i>--}}
{{--                                        <div class="checkbox-zoom zoom-primary">--}}
{{--                                            <label>--}}
{{--                                                <input type="checkbox" id="accounting-update-payment-bill"  checked="" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.payment-bill.accounting-title')" data-tooltip="1" class="input-tooltip" required="" data-tooltip="1">--}}
{{--                                                <span class="cr">--}}
{{--                                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>--}}
{{--                                                </span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                            <label for=" $(this).attr(id) "><i class="icofont  $(this).attr(data-icon) "></i>--}}
{{--                                                @lang('app.payment-bill.update.accounting')--}}
{{--                                            </label>--}}
{{--                                        <div class="line">--}}
{{--                                        </div>--}}
{{--                                            <div class="tool-tip">--}}
{{--                                                <i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.payment-bill.accounting-title')"></i>--}}
{{--                                            </div>--}}
{{--                                        </div></div>--}}
                                    <div class="form-group validate-group">
                                        <div class="form-validate-checkbox">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" id="accounting-update-payment-bill"
                                                       checked="">
                                                <label class="name-checkbox" for="print-kitchen-update-food-brand-manage">@lang('app.payment-bill.update.accounting')
                                                    <div class="tool-tip" style="margin-top: 2px">
                                                        <i class="fi-rr-exclamation pointer text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.payment-bill.accounting-title')"></i>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if(Session::get(SESSION_KEY_LEVEL) > 0)
{{--                                    <div class="form-group validate-group">--}}
{{--                                        <div class="form-validate-input">--}}
{{--                                            <input type="text" id="date-update-payment-bill" class="input-sm form-control text-center input-datetimepicker p-1 date-update-payment-bill" value="{{date('d/m/Y')}}">--}}
{{--                                            <label>--}}
{{--                                                <i class="icofont icofont-ui-calendar"></i>@lang('app.payment-bill.update.date')</label>--}}
{{--                                            <div class="line"></div>--}}
{{--                                        </div>--}}
{{--                                        <div class="link-href"></div>--}}
{{--                                    </div>--}}
                                        <div class="form-group validate-group">
                                            <div class="form-validate-input form-left">
                                                <input type="text" id="date-update-payment-bill"
                                                       class="input-sm form-control text-center input-datetimepicker date-update-payment-bill"
                                                       value="{{date('d/m/Y')}}">
                                                <label for="name-update-specifications-data">
                                                    @lang('app.payment-bill.update.date')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    @else
{{--                                        <div class="form-group validate-group">--}}
{{--                                            <div class="form-validate-input">--}}
{{--                                                <input type="text" id="date-update-payment-bill" class="input-sm form-control text-center input-datetimepicker p-1 date-update-payment-bill-sales-solution" value="{{date('d/m/Y')}}">--}}
{{--                                                <label>--}}
{{--                                                    <i class="icofont icofont-ui-calendar"></i>@lang('app.payment-bill.update.date')</label>--}}
{{--                                                <div class="line"></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="link-href"></div>--}}
{{--                                        </div>--}}
                                        <div class="form-group validate-group">
                                            <div class="form-validate-input form-left">
                                                <input type="text" id="date-update-payment-bill"
                                                       class="input-sm form-control text-center input-datetimepicker date-update-payment-bill-sales-solution"
                                                       value="{{date('d/m/Y')}}">
                                                <label for="date-update-payment-bill">
                                                    </i>@lang('app.payment-bill.update.date')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    @endif
{{--                                    <div class="form-group validate-group pt-3 pb-1">--}}
{{--                                        <div class="form-validate-textarea">--}}
{{--                                            <div class="form__group pt-2">--}}
{{--                                                <textarea class="form__field" id="description-update-payment-bill" cols="5" rows="5" data-max-length="1000"></textarea>--}}
{{--                                                <label for="description-update-payment-bill" class="form__label icon-validate">--}}
{{--                                                    <i class="fa fa-pencil-square-o pr-1"></i>@lang('app.payment-bill.update.note')--}}
{{--                                                </label>--}}
{{--                                                <div class="line"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="form-group validate-group">
                                        <div class="form-validate-textarea">
                                            <div class="form__group pt-2">
                                                <textarea class="form__field" id="description-update-payment-bill" data-note-max-length="255" cols="5" rows="5"></textarea>
                                                <label for="description-update-payment-bill" class="form__label icon-validate">
                                                    @lang('app.payment-bill.update.note')
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
                <div class="btn seemt-red seemt-bg-red seemt-btn-hover-red" id="btn-cancel-update-payment-bill">
                    <i class="fi-rr-trash"></i>
                    <span>Hủy</span>
                </div>
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdatePaymentBill()" onkeypress="saveModalUpdatePaymentBill()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script type="text/javascript" src="{{asset('js\treasurer\payment_bill\update.js?version=4',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{ asset('../js/manage/supplier_order/index.js?version=6', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush


