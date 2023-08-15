<div class="modal fade" id="modal-e-invoice-update" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.e-invoice.update.title')</h4>
                <button type="button" class="close" onclick="closeModalEInvoiceUpdate()" onkeypress="closeModalEInvoiceUpdate()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color px-0 pb-0" id="loading-modal-update-e-invoice" style="overflow-x: auto">
                <div class="">
                    <div class="row d-flex">
                        <div class="col-lg-12 edit-flex-auto-fill px-0">
                            <div class="card-block flex-sub card" id="form-header-bonus-punish">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group validate-group">
                                            <div class="form-validate-input form-left">
                                                <input id="name-update-e-invoice" class="form-control" type="text" data-max-length="50" data-min-length="2" data-spec="1" data-empty="1" disabled>
                                                <label for="name-update-e-invoice">
                                                    @lang('app.e-invoice.update.name')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group validate-group">
                                            <div class="form-validate-input form-left">
                                                <input id="phone-update-e-invoice" class="form-control" type="text" data-phone="1" disabled>
                                                <label for="phone-update-e-invoice">
                                                    @lang('app.e-invoice.update.phone')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group validate-group">
                                            <div class="form-validate-input form-left">
                                                <input id="company-update-e-invoice" class="form-control" type="text" data-max-length="255" data-min-length="2" data-spec="1" data-empty="1" disabled>
                                                <label for="company-update-e-invoice">
                                                    @lang('app.e-invoice.update.company')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group validate-group">
                                            <div class="form-validate-input form-left">
                                                <input id="tax-update-e-invoice" class="form-control" type="text" data-empty="1" disabled>
                                                <label for="tax-update-e-invoice">
                                                    @lang('app.e-invoice.update.tax-code')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group validate-group">
                                            <div class="form-validate-input form-left">
                                                <input id="email-update-e-invoice" class="form-control" type="text" data-max-length="255" data-mail="1" data-empty="1" data-emoji="1" disabled>
                                                <label for="email-update-e-invoice">
                                                    @lang('app.e-invoice.update.email')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group validate-group">
                                            <div class="form-validate-input form-left">
                                                <input id="address-update-e-invoice" class="form-control" type="text" data-max-length="255" data-min-length="2" data-empty="1" disabled>
                                                <label for="address-update-e-invoice">
                                                    @lang('app.e-invoice.update.address')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                            <div class="">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-checkbox m-0 p-0">
                                                        <div class="checkbox-form-group">
                                                            <input id="send-mail-update-e-invoice" class="chb"
                                                                   name="send-mail-update-e-invoice" type="checkbox" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <label class="p-0 col-form-label"> @lang('app.e-invoice.update.send-email')</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col-lg-8 edit-flex-auto-fill">
                            <div class="card-block flex-sub card mx-0">
                                <div class="col-lg-12 px-0">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single"
                                                            id="select-food-update-invoice-order">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table table-bordered dataTable no-footer" id="table-food-e-invoice-update">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">@lang('app.e-invoice.update.stt')</th>
                                                <th rowspan="2">@lang('app.e-invoice.update.food')</th>
                                                <th rowspan="2">@lang('app.e-invoice.update.unit')</th>
                                                <th rowspan="2">@lang('app.e-invoice.update.price')</th>
                                                <th rowspan="2">@lang('app.e-invoice.update.quantity')</th>
                                                <th>@lang('app.e-invoice.update.total')</th>
                                                <th rowspan="2">@lang('app.e-invoice.update.vat')</th>
                                                <th rowspan="2">Giảm giá
                                                    <div class="f-w-100">
                                                        (<span id="discount-text-update-e-invoice"></span>)
                                                    </div>
                                                </th>
                                                <th rowspan="2"></th>
                                                <th rowspan="2" class="d-none"></th>
                                            </tr>
                                            <tr>
                                                <th class="text-center seemt-fz-14" id="total-e-invoice-update">0</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 edit-flex-auto-fill pl-0">
                            <div class="card card-block flex-sub mx-0">
                                <h5 class="text-bold sub-title mx-0 f-w-600"
                                    id="boxlist-update-e-invoice">@lang('app.e-invoice.update.title-info')</h5>
                                <div class="row px-3">
                                    <div class="form-group col-6 mb-0 px-0">
                                        <label class="f-w-600 col-form-label-fz-15">@lang('app.e-invoice.update.code')</label>
                                        <h6 class="col-form-label-fz-15 text-muted f-w-400" id="code-update-e-invoice">---</h6>
                                    </div>
                                    <div class="form-group col-6 mb-0 px-0">
                                        <label class="f-w-600 col-form-label-fz-15">@lang('app.e-invoice.update.payment-date')</label>
                                        <h6 class="col-form-label-fz-15 text-muted f-w-400" id="payment-date-update-e-invoice">---</h6>
                                    </div>
                                </div>
                                <div class="border-dashed"></div>
                                <div class="row mt-2 mb-2">
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.e-invoice.update.total')</label>
                                        <label class="f-w-400 col-form-label-fz-15 f-right mt-1" id="money-update-e-invoice">0</label>
                                    </div>

                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.e-invoice.update.vat')</label>
                                        <label class="f-w-400 col-form-label-fz-15 f-right"
                                        >
                                            <span style="font-size:15px !important" id="vat-amount-update-e-invoice"></span>
                                        </label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.e-invoice.update.discount')</label>
                                        <label class="f-w-400 col-form-label-fz-15 f-right mt-1">
                                            <span style="font-size:15px !important" id="discount-amount-update-e-invoice">0</span>
                                            (<span style="font-size:15px !important" id="discount-percent-update-e-invoice">0</span> %)
                                        </label>
                                    </div>
                                </div>
                                <div class="border-dashed"></div>
                                <div class="px-3 mt-2">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.e-invoice.update.total-amount')</label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right"
                                           id="total-amount-update-e-invoice">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại"
                        onclick="resetModalEInvoiceUpdate()"
                        onkeypress="resetModalEInvoiceUpdate()">
                    <i class="fa fa-eraser"></i>
                </button>
                <div id="btn-save-modal-e-invoice-update" type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalEInvoiceUpdate()" onkeypress="saveModalEInvoiceUpdate()" disabled>
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js\manage\e_invoice\update.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
