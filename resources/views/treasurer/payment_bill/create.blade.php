<div class="modal fade" id="modal-create-payment-bill" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document" id="size-modal-create-payment-bill">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.payment-bill.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreatePaymentBill()" onkeypress="closeModalCreatePaymentBill()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-create-payment-bill">
                <div class="row m-0">
                    @if(Session::get(SESSION_KEY_LEVEL) > 0)
                        <div class="edit-flex-auto-fill d-none p-0" id="left-create-payment-bill">
                            <div class="card card-block mb-0 flex-sub">
                                <h5 class="sub-title">@lang('app.payment-bill.create.title-left')</h5>
                                <div class="table-responsive new-table">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single"
                                                        id="select-status-create-payment-bill">
                                                    <option value="0" selected>@lang('app.payment-bill.create.otp-status-0')</option>
                                                    <option value="1">@lang('app.payment-bill.create.otp-status-1')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="table-supplier-order-create-payment-bill" class="table">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">@lang('app.payment-bill.create.stt')</th>
                                            <th rowspan="2">
{{--                                                <div class="checkbox-fade fade-in-primary m-0">--}}
{{--                                                    <label>--}}
{{--                                                        <input type="checkbox" id="check-all-supplier-order-create-payment-bill" onclick="checkAllItemSupplierOrderCreatePaymentBill($(this))"/>--}}
{{--                                                        <span class="cr" data-toggle="tooltip" data-placement="top" data-original-title="Chọn tất cả"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="checkbox" onclick="checkAllItemSupplierOrderCreatePaymentBill($(this))" id="check-all-supplier-order-create-payment-bill">
                                                    </div>
                                                </div>
                                            </th>
                                            <th rowspan="2">@lang('app.payment-bill.create.code')</th>
                                            <th rowspan="2">Người nhận</th>
                                            <th>@lang('app.payment-bill.create.total-amount')</th>
                                            <th rowspan="2">@lang('app.payment-bill.create.retention-money')</th>
                                            <th rowspan="2">@lang('app.payment-bill.create.created')</th>
                                            <th rowspan="2"></th>
                                            <th class="d-none" rowspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <span id="total-debt-create-payment-bill" class="seemt-fz-16">0</span>
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-12 edit-flex-auto-fill p-0" id="right-create-payment-bill">
                        <div class="card-block m-0 flex-sub card">
                            <div class="px-0">
                                <h5 class="sub-title d-none"
                                    id="title-right-create-payment-bill">@lang('app.payment-bill.create.title-right')</h5>
                                <div class="row m-t-10">
                                    <div class="col-lg-6 form-group validate-group pl-0" id="div-select-group-create-payment-bill">
                                        <div class="form-validate-select">
                                            <div class="col-lg-12 select-material-box">
                                                <select id="select-group-create-payment-bill" data-select="1"
                                                        class="js-example-basic-single select2-hidden-accessible">
                                                    <option value="-2" disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                    @if(Session::get(SESSION_KEY_LEVEL) > 0)
                                                        <option
                                                            value="1">@lang('app.payment-bill.create.supplier')</option>
                                                    @endif
                                                    <option
                                                        value="2">@lang('app.payment-bill.create.employee')</option>
                                                    <option
                                                        value="5">@lang('app.payment-bill.create.other')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.payment-bill.create.group')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>

                                    <div class="col-lg-6 form-group validate-group pr-0" id="div-select-target-create-payment-bill">
                                        <div class="form-validate-select">
                                            <div class="col-lg-12 select-material-box">
                                                <select id="select-target-create-payment-bill" data-select="1"
                                                        class="js-example-basic-single select2-hidden-accessible">
                                                    <option value="-2" disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.payment-bill.create.target')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>

                                    <div class="form-group col-lg-6 row d-none validate-group pr-0" id="div-input-target-create-payment-bill">
                                        <div class="form-validate-input form-left">
                                            <input type="text" class="form-control"
                                                   id="input-target-create-payment-bill"
                                                   data-empty="1" data-min-length="2" data-max-length="50"/>
                                            <label for="name-create-specifications-data">
                                                </i>@lang('app.payment-bill.create.target')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 select-material-box">
                                            <select id="select-type-create-payment-bill" data-select="1"
                                                    class="js-example-basic-single select2-hidden-accessible">
                                                <option value="-2" disabled selected
                                                        hidden>@lang('app.component.option_default')</option>
                                            </select>
                                            <label class="icon-validate">
                                                @lang('app.payment-bill.create.type')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>

                                <div class="row">

                                    <div class="col-lg-6 form-group validate-group pl-0"
                                         id="form-price-create-payment-bill">
                                        <div class="form-validate-input form-left">
                                            <input type="text" class="form-control text-right"
                                                   id="value-create-payment-bill"
                                                   data-money="1" value="100" data-max="999999999">                                            <label for="name-create-specifications-data">
                                                @lang('app.payment-bill.create.value')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>


                                    <div class="col-lg-6 form-group select2_theme validate-group pr-0"
                                         id="type-price-create-payment-bill">
                                        <div class="form-validate-select">
                                            <div class="col-lg-12 select-material-box">
                                                <select id="select-value-create-payment-bill"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1">
                                                    <option value="1">@lang('app.payment-bill.create.opt-cash')</option>
                                                    <option value="6">@lang('app.payment-bill.create.opt-bank')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.payment-bill.create.type-money')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                                <div class="form-group validate-group">
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="checkbox" id="accounting-create-payment-bill"
                                                   checked="">
                                            <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">@lang('app.payment-bill.create.accounting')
                                                <div class="tool-tip" style="margin-top: 2px">
                                                    <i class="fi-rr-exclamation pointer text-inverse" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.payment-bill.accounting-title')" style="color: #E96012"></i>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                @if(Session::get(SESSION_KEY_LEVEL) > 0)
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input type="text" id="date-create-payment-bill"
                                                   class="input-sm form-control text-center input-datetimepicker date-create-payment-bill"
                                                   value="{{date('d/m/Y')}}">
                                            <label for="name-create-specifications-data">
                                                @lang('app.payment-bill.create.date')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                @else
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input form-left">
                                            <input type="text" id="date-create-payment-bill"
                                                   class="input-sm form-control text-center input-datetimepicker date-create-payment-bill-sales-solution"
                                                   value="{{date('d/m/Y')}}">
                                            <label for="date-create-payment-bill">
                                                </i>@lang('app.payment-bill.create.date')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                @endif
                                <div class="form-group validate-group">
                                    <div class="form-validate-textarea">
                                        <div class="form__group pt-2">
                                            <textarea class="form__field" id="description-create-payment-bill" cols="5" rows="5" data-note-max-length="255"></textarea>
                                            <label for="description-create-payment-bill" class="form__label icon-validate">
                                                @lang('app.payment-bill.create.note')
                                            </label>
                                            <div class="textarea-character" id="char-count">
                                                <span>0/300</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 pt-1 d-none" id="div-total-amount-create-payment-bill-group-supplier">
                                    <div class="border-dashed"></div>
                                    <label class="f-w-600 col-form-label-fz-15 col-form-label-fz-15">Tổng thanh toán:</label>
                                    <label class="f-w-600 f-right col-form-label-fz-15" id="total-amount-create-payment-bill-group-supplier">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalCreatePaymentBill()"
                        onkeypress="resetModalCreatePaymentBill()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalCreatePaymentBill()" onkeypress="saveModalCreatePaymentBill()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
{{--    <script type="text/javascript" src="/js/treasurer/payment_bill/create.js?version=9')}}" defer></script>--}}
    <script type="text/javascript" src="{{ asset('../js/treasurer/payment_bill/create.js?version=9',env('IS_DEPLOY_ON_SERVER'))}}"></script>

@endpush

