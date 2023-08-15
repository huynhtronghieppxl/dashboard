<style>
    #table-receipts-bill-vat-handle .form-validate-checkbox .checkbox-zoom {
        left: 18px;
    }
</style>
<div class="modal fade" id="modal-create-receipts-bill" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.receipts-bill.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateReceiptsBill()" onkeypress="closeModalCreateReceiptsBill()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-create-receipts-bill">
                <div class="card-block card m-0">
                    <div class="form-group select2_theme validate-group"
                         id="div-select-group-create-receipts-bill">
                        <div class="form-validate-select">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select id="select-group-create-receipts-bill"
                                            class="js-example-basic-single select2-hidden-accessible" data-select="1">
                                        <option value="-2" disabled selected
                                                hidden>@lang('app.component.option_default')</option>
                                        @if(Session::get(SESSION_KEY_LEVEL) > 0)
                                            <option
                                                value="1">@lang('app.receipts-bill.create.supplier')</option>
                                        @endif
                                        <option value="2">@lang('app.receipts-bill.create.employee')</option>
                                        <option value="5">@lang('app.receipts-bill.create.other')</option>
                                        <option value="4">@lang('app.receipts-bill.create.vat-handle')</option>
                                    </select>
                                    <label>
                                        @lang('app.receipts-bill.create.group')
                                        @include('layouts.start')
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group d-none" id="div-input-target-create-receipts-bill">
                        <div class="form-validate-input">
                            <input type="text" id="input-target-create-receipts-bill" class="form-control"
                                   data-empty="1" data-min-length="2" data-max-length="50"/>
                            <label>
                                @lang('app.receipts-bill.create.target')
                                @include('layouts.start')
                            </label>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group select2_theme validate-group" id="div-select-target-create-receipts-bill">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select id="select-target-create-receipts-bill"
                                            class="js-example-basic-single select2-hidden-accessible" data-select="1">
                                        <option value="-2" disabled selected
                                                hidden>@lang('app.component.option-null')</option>
                                    </select>
                                    <label>
                                        @lang('app.receipts-bill.create.target')
                                        @include('layouts.start')
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select id="select-type-create-receipts-bill"
                                            class="js-example-basic-single select2-hidden-accessible" data-select="1">
                                        <option value="-2" disabled selected
                                                hidden>@lang('app.component.option_default')</option>
                                    </select>
                                    <label>
                                        @lang('app.receipts-bill.create.type')
                                        @include('layouts.start')
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="row">
                        <div class="col-6 p-0 form-group validate-group">
                            <div class="form-validate-input">
                                <input class="form-control text-right" id="value-create-receipts-bill" value="100"
                                       data-min="100" data-money="1" data-max="999999999" data-type="currency-edit">
                                <label>
                                    @lang('app.receipts-bill.create.value')
                                    @include('layouts.start')
                                </label>
                            </div>
                            <div class="link-href"></div>
                        </div>
                        <div class="col-6 p-r-0 form-group select2_theme validate-group">
                            <div class="form-validate-select ">
                                <div class="col-lg-12 mx-0 px-0">
                                    <div class="col-lg-12 pr-0 select-material-box">
                                        <select id="select-value-create-receipts-bill"
                                                class="form-control js-example-basic-single select2-hidden-accessible"
                                                data-select="1">
                                            <option value="1">@lang('app.receipts-bill.create.opt-cash')</option>
                                            <option value="2">@lang('app.receipts-bill.create.opt-bank')</option>
                                            <option value="6">@lang('app.receipts-bill.create.opt-transfer')</option>
                                        </select>
                                        <label>
                                            @lang('app.receipts-bill.create.type-money')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                    </div>
                    <div class="form-group validate-group d-none" id="div-vat-additional-create-receipts-bill">
                        <div class="form-validate-checkbox">
                            <div class="checkbox-form-group">
                                <input type="checkbox" id="vat-additional-create-receipts-bill" checked
                                       class="input-tooltip" required="" disabled>
                                <label class="name-checkbox"
                                       for="print-kitchen-create-food-brand-manage">@lang('app.receipts-bill.create.vat-additional')
                                </label>
                            </div>
                        </div>

                        <div class="card card-block">
                            <div class="table-responsive new-table">
                                <table id="table-receipts-bill-vat-handle" class="table">
                                    <thead>
                                    <tr>
                                        <th>Chọn</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
{{--                                        <th>Tiền VAT</th>--}}
                                        <th>Thanh toán</th>
                                        <th>Ngày hoàn tất</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row d-none" id="div-code-create-receipts-bill">
                        <div class="col-lg-12 p-0 form-group validate-group">
                            <div class="form-validate-select">
                                <div class="mx-0 px-0">
                                    <div class="pr-0 select-material-box">
                                        <select id="code-create-receipts-bill"
                                                class="form-control js-example-basic-single select2-hidden-accessible"
                                                data-select="1">
                                            <option value="" disabled
                                                    selected>@lang('app.component.option_default')</option>
                                        </select>
                                        <label>
                                            @lang('app.receipts-bill.create.code')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="link-href"></div>
                        </div>
                    </div>
                    <div class="form-group validate-group">
{{--                                                    <div class="checkbox-zoom zoom-primary">--}}
{{--                                                        <label>--}}
{{--                                                            <input type="checkbox" id="accounting-create-receipts-bill"  checked="" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.receipts-bill.accounting-title')" class="input-tooltip" required="" data-tooltip="1">--}}
{{--                                                            <span class="cr">--}}
{{--                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>--}}
{{--                                                            </span>--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
                        <div class="form-validate-checkbox">
                            <div class="checkbox-form-group">
                                <input type="checkbox" id="accounting-create-receipts-bill" checked
                                       class="input-tooltip" required="" data-tooltip="1">
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
                    @if(Session::get(SESSION_KEY_LEVEL) > 0)
                        <div class="form-group validate-group">
                            <div class="form-validate-input">
                                <input type="text" id="date-create-receipts-bill"
                                       class="input-sm form-control text-center input-datetimepicker p-1 date-create-receipts-bill"
                                       value="{{date('d/m/Y')}}" data-validate="calendar">
                                <label>
                                    @lang('app.receipts-bill.create.date')
                                    @include('layouts.start')
                                </label>
                            </div>
                            <div class="link-href"></div>
                        </div>
                    @else
                        <div class="form-group validate-group">
                            <div class="form-validate-input">
                                <input type="text" id="date-create-receipts-bill"
                                       class="input-sm form-control text-center input-datetimepicker p-1 date-create-receipts-bill-sales-solution"
                                       value="{{date('d/m/Y')}}" data-validate="calendar">
                                <label>
                                    @lang('app.receipts-bill.create.date')
                                    @include('layouts.start')
                                </label>
                            </div>
                            <div class="link-href"></div>
                        </div>
                    @endif
                    <div class="form-group validate-group pt-3 pb-0">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea class="form__field" id="description-create-receipts-bill" cols="5"
                                          rows="5" data-note-max-length="255"></textarea>
                                <label for="description-create-receipts-bill" class="form__label icon-validate">
                                    @lang('app.receipts-bill.create.note')
                                </label>
                                <div class="textarea-character" id="char-count">
                                    <span>0/300</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateReceiptsBill()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateReceiptsBill()"
                     onkeypress="saveModalCreateReceiptsBill()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>

            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js\treasurer\receipts_bill\create.js?version=12', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

