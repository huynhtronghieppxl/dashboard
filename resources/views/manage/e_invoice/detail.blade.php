<div class="modal fade" id="modal-e-invoice-detail" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.e-invoice.detail.title')</h4>
                <button type="button" class="close" onclick="closeModalEInvoiceDetail()" onkeypress="closeModalEInvoiceDetail()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color px-0 pb-0" id="loading-modal-detail-e-invoice" style="overflow-x: auto">
                <div class="">
                    <div class="row d-flex">
                        <div class="col-lg-12 edit-flex-auto-fill px-0">
                            <div class="card-block flex-sub card">
                                <div class="row" id="form-header-bonus-punish">
                                    <div class="col-lg-6 px-0">
                                        <div class="col-lg-12 row">
                                            <label
                                                class="f-w-600 col-form-label-fz-15 col-lg-5">@lang('app.e-invoice.detail.name'): </label>
                                            <label class="f-w-400 col-form-label-fz-15 col-lg-7 f-right mt-1"
                                                   id="name-detail-e-invoice">---</label>
                                        </div>
                                        {{--                                    <div class="form-group validate-group">--}}
                                        {{--                                        <div class="form-validate-input">--}}
                                        {{--                                            <input id="name-detail-e-invoice" data-max-length="50" data-min-length="2" data-spec="1" data-empty="1"--}}
                                        {{--                                                   class="form-control"/>--}}
                                        {{--                                            <label><i class="typcn typcn-document-text"></i>@lang('app.e-invoice.detail.name')<span class="text-danger">(*)</span></label>--}}
                                        {{--                                            <div class="line"></div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="link-href"></div>--}}
                                        {{--                                    </div>--}}
                                        <div class="col-lg-12 row">
                                            <label
                                                class="f-w-600 col-form-label-fz-15 col-lg-5">@lang('app.e-invoice.detail.company'): </label>
                                            <label class="f-w-400 col-form-label-fz-15 col-lg-7 f-right mt-1"
                                                   id="company-detail-e-invoice">---</label>
                                        </div>
                                        {{--                                    <div class="form-group validate-group">--}}
                                        {{--                                        <div class="form-validate-input">--}}
                                        {{--                                            <input id="company-detail-e-invoice" data-max-length="255" data-min-length="2" data-spec="1" data-empty="1"--}}
                                        {{--                                                   class="form-control"/>--}}
                                        {{--                                            <label><i class="typcn typcn-document-text"></i>@lang('app.e-invoice.detail.company')<span class="text-danger">(*)</span></label>--}}
                                        {{--                                            <div class="line"></div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="link-href"></div>--}}
                                        {{--                                    </div>--}}
                                        <div class="col-lg-12 row">
                                            <label
                                                class="f-w-600 col-form-label-fz-15 col-lg-5">@lang('app.e-invoice.detail.email'): </label>
                                            <label class="f-w-400 col-form-label-fz-15 col-lg-7 f-right mt-1"
                                                   id="email-detail-e-invoice">---</label>
                                        </div>
                                        {{--                                    <div class="form-group validate-group">--}}
                                        {{--                                        <div class="form-validate-input">--}}
                                        {{--                                            <input id="email-detail-e-invoice" data-max-length="255" data-mail="1" data-empty="1" data-emoji="1"--}}
                                        {{--                                                   class="form-control"/>--}}
                                        {{--                                            <label><i class="typcn typcn-document-text"></i>@lang('app.e-invoice.detail.email')<span class="text-danger">(*)</span></label>--}}
                                        {{--                                            <div class="line"></div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="link-href"></div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="form-group validate-group mt-5 px-4">--}}
                                        {{--                                        <div class="form-validate-checkbox">--}}
                                        {{--                                            <i class="icofont icofont-disc"></i>--}}
                                        {{--                                            <div class="checkbox-zoom zoom-primary">--}}
                                        {{--                                                <label>--}}
                                        {{--                                                    <input type="checkbox" id="send-mail-detail-e-invoice"--}}
                                        {{--                                                           checked="" class="input-tooltip" disabled required="">--}}
                                        {{--                                                    <span class="cr">--}}
                                        {{--                                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>--}}
                                        {{--                                                </span>--}}
                                        {{--                                                </label>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <label for=" $(this).attr(id) ">--}}
                                        {{--                                                <i class="icofont  $(this).attr(data-icon) "></i>--}}
                                        {{--                                                @lang('app.e-invoice.detail.send-email')--}}
                                        {{--                                            </label>--}}
                                        {{--                                            <div class="line"></div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        <div class="col-lg-12 row" style="margin-left: 16px">
                                            <div class="">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-checkbox m-0 p-0">
                                                        <div class="checkbox-form-group">
                                                            <input id="send-mail-detail-e-invoice" class="chb" disabled required=""
                                                                   name="send-mail-detail-e-invoice" type="checkbox">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <label class="p-0 col-form-label">@lang('app.e-invoice.detail.send-email')</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 px-0">
                                        <div class="col-lg-12 row">
                                            <label
                                                class="f-w-600 col-form-label-fz-15 col-lg-5">SĐT khách hàng: </label>
                                            <label class="f-w-400 col-form-label-fz-15 col-lg-7 f-right mt-1"
                                                   id="phone-detail-e-invoice">---</label>
                                        </div>
                                        {{--                                    <div class="form-group validate-group">--}}
                                        {{--                                        <div class="form-validate-input">--}}
                                        {{--                                            <input id="phone-detail-e-invoice" data-phone="1"--}}
                                        {{--                                                   class="form-control" />--}}
                                        {{--                                            <label><i class="typcn typcn-document-text"></i>@lang('app.e-invoice.detail.phone')<span class="text-danger">(*)</span></label>--}}
                                        {{--                                            <div class="line"></div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="link-href"></div>--}}
                                        {{--                                    </div>--}}
                                        <div class="col-lg-12 row">
                                            <label
                                                class="f-w-600 col-form-label-fz-15 col-lg-5">@lang('app.e-invoice.detail.tax-code'): </label>
                                            <label class="f-w-400 col-form-label-fz-15 col-lg-7 f-right mt-1"
                                                   id="tax-code-detail-e-invoice">---</label>
                                        </div>
                                        {{--                                    <div class="form-group validate-group">--}}
                                        {{--                                        <div class="form-validate-input disabled">--}}
                                        {{--                                            <input id="tax-detail-e-invoice" data-empty="1"--}}
                                        {{--                                                   class="form-control" value="3702848646" disabled />--}}
                                        {{--                                            <label><i class="typcn typcn-document-text"></i>@lang('app.e-invoice.detail.tax-code')<span class="text-danger">(*)</span></label>--}}
                                        {{--                                            <div class="line"></div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="link-href"></div>--}}
                                        {{--                                    </div>--}}
                                        <div class="col-lg-12 row">
                                            <label
                                                class="f-w-600 col-form-label-fz-15 col-lg-5">@lang('app.e-invoice.detail.address'): </label>
                                            <label class="f-w-400 col-form-label-fz-15 col-lg-7 f-right mt-1"
                                                   id="address-detail-e-invoice">---</label>
                                        </div>
                                        {{--                                    <div class="form-group validate-group">--}}
                                        {{--                                        <div class="form-validate-input">--}}
                                        {{--                                            <input id="address-detail-e-invoice" data-max-length="255" data-min-length="2"--}}
                                        {{--                                                   class="form-control"/>--}}
                                        {{--                                            <label><i class="typcn typcn-document-text"></i>@lang('app.e-invoice.detail.address')</label>--}}
                                        {{--                                            <div class="line"></div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="link-href"></div>--}}
                                        {{--                                    </div>--}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col-lg-8 edit-flex-auto-fill">
                            <div class="card-block flex-sub card mx-0">
                                <div class="col-lg-12 px-0">
                                    <div class="table-responsive new-table">
                                        <table class="table table-bordered dataTable no-footer" id="table-food-e-invoice-detail">
                                            <thead>
                                            <tr>
                                                <th rowspan="2" class="text-center">@lang('app.e-invoice.detail.stt')</th>
                                                <th rowspan="2" class="text-center">@lang('app.e-invoice.detail.food')</th>
                                                <th rowspan="2" class="text-center">@lang('app.e-invoice.detail.unit')</th>
                                                <th rowspan="2" class="text-center">@lang('app.e-invoice.detail.price')</th>
                                                <th rowspan="2" class="text-center">@lang('app.e-invoice.detail.quantity')</th>
                                                <th class="text-center">@lang('app.e-invoice.detail.total')</th>
                                                <th rowspan="2" class="text-center">@lang('app.e-invoice.detail.vat') (%)</th>
                                                <th rowspan="2" class="text-center">Giảm giá
                                                    <div class="f-w-100">
                                                        (<span id="discount-text-detail-e-invoice"></span>)
                                                    </div>
                                                </th>
{{--                                                <th rowspan="2" class=text-center></th>--}}
                                                <th rowspan="2" class="text-center" class="d-none"></th>
                                            </tr>
                                            <tr>
                                                {{--                                                <th class="text-center" ><span id="total-vat-e-invoice"></span> %</th>--}}
                                                <th class="text-center" id="total-e-invoice-detail">0</th>
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
                                    id="boxlist-detail-e-invoice">@lang('app.e-invoice.detail.title-info')</h5>
                                <div class="row px-3">
                                    <div class="form-group col-6 mb-0 px-0">
                                        <label class="f-w-600 col-form-label-fz-15">@lang('app.e-invoice.detail.code')</label>
                                        <h6 class="col-form-label-fz-15 text-muted f-w-400" id="code-detail-e-invoice">---</h6>
                                    </div>
                                    <div class="form-group col-6 mb-0 px-0">
                                        <label class="f-w-600 col-form-label-fz-15">@lang('app.e-invoice.detail.payment-date')</label>
                                        <h6 class="col-form-label-fz-15 text-muted f-w-400" id="payment-date-detail-e-invoice">---</h6>
                                    </div>
                                </div>
                                <div class="border-dashed"></div>
                                <div class="row mt-2 mb-2">
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">Thành tiền</label>
                                        <label class="f-w-400 col-form-label-fz-15 f-right mt-1" id="money-detail-e-invoice">0</label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">VAT (%)</label>
                                        <label class="f-w-400 col-form-label-fz-15 f-right"
                                        >
                                            <span style="font-size:15px !important" id="vat-amount-detail-e-invoice"></span>
                                            {{--                                            (<span style="font-size:15px !important" id="vat-percent-detail-e-invoice"></span>--}}
                                            {{--                                            %)--}}
                                        </label>
                                    </div>
                                    <div class="col-lg-12">
{{--                                        <label--}}
{{--                                            class="f-w-600 col-form-label-fz-15">Giảm giá</label>--}}
{{--                                        <label class="f-w-400 col-form-label-fz-15 f-right mt-1"--}}
{{--                                               id="discount-detail-e-invoice">0</label>--}}
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.e-invoice.update.discount')</label>
                                        <label class="f-w-400 col-form-label-fz-15 f-right mt-1">
                                            <span style="font-size:15px !important" id="discount-detail-e-invoice">0</span>
                                            (<span style="font-size:15px !important" id="discount-percent-detail-e-invoice">0</span> %)
                                        </label>
                                    </div>

                                </div>
                                <div class="border-dashed"></div>
                                <div class="px-3 mt-2">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">Thanh toán</label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right"
                                           id="total-amount-detail-e-invoice">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js\manage\e_invoice\detail.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
