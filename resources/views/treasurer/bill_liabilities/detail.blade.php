<head>
    <link rel="stylesheet" href="{{asset('css/css_custom/detail_work_history/style.css')}}"/>
</head>
<div class="modal fade" id="modal-detail-bill-liabilities-treasurer" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <div class="d-flex">
                    <h4 class="modal-title text-center"
                        id="modal-detail-bill-liabilities-treasurer-title">@lang('app.bill-liabilities.detail.title')
                        của <span style="" class="modal-title"></span>
                    </h4>
                    <div class="d-flex align-items-center ml-3">
                        <a href="javascript:void(0)" class="showmore underline-detail" id="detail-supplier-treasurer">Xem
                            chi tiết</a>
                    </div>
                </div>
                <button type="button" class="close" onclick="closeModalDetailBillLiabilities()"
                        onkeypress="closeModalDetailBillLiabilities()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color" style="max-height: 85vh;"
                 id="loading-modal-detail-bill-liabilities">
                <div class="row" id="sub-detail-liabilities-treasurer">
                    <div class="col-lg-12 edit-flex-auto-fill d-flex flex-column"
                         id="table-tab-detail-bill-liabilities">
                        <ul class="nav nav-tabs md-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active " data-id="2" id="tab-2" data-toggle="tab"
                                   href="#bill-liabilities-tab2" role="tab" onclick="changeTabPaymentBill(1)"
                                   aria-expanded="false">
                                    @lang('app.bill-liabilities.detail.order-processing') <span
                                        class="label label-warning" id="total-record-pending">0</span>
                                </a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-id="1" id="tab-1" data-toggle="tab"
                                   href="#bill-liabilities-tab1" role="tab" onclick="changeTabPaymentBill(2)"
                                   aria-expanded="true">
                                    @lang('app.bill-liabilities.detail.order-done') <span class="label label-success"
                                                                                          id="total-record-complete">0</span>
                                </a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-id="3" id="tab-3" data-toggle="tab"
                                   href="#bill-liabilities-tab3" role="tab" onclick="changeTabPaymentBill(3)"
                                   aria-expanded="false">
                                    @lang('app.bill-liabilities.detail.order-cancel') <span class="label label-danger"
                                                                                            id="total-record-cancel">0</span>
                                </a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   id="tab-4" data-id="4" data-toggle="tab" href="#bill-liabilities-tab4" role="tab"
                                   onclick="changeTabPaymentBill(4)" aria-expanded="false">
                                    @lang('app.bill-liabilities.detail.order-liabilities') <span
                                        class="label label-warning" id="total-record-liabilities">0</span>
                                </a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <div class="card w-100 my-0">
                            <div class="tab-content">
                                <div class="card-block tab-pane active" id="bill-liabilities-tab2" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <table id="table-bill-liabilities2" class="table fix-size-table"
                                               style="overflow-y:auto; height: 50px ">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.index')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.code')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.employee')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.date-table')</th>
                                                <th class="text-right">@lang('app.bill-liabilities.detail.amount')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.retention-money')</th>
                                                <th rowspan="2"></th>
                                                <th class="d-none"></th>
                                            </tr>
                                            <tr>
                                                <th id="total-pending" class="seemt-fz-16"></th>
                                                <th class="text-center d-none"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-block tab-pane" id="bill-liabilities-tab1" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <table id="table-bill-liabilities1" class="table fix-size-table">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.index')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.code')</th>
                                                <th class="text-left"
                                                    rowspan="2">@lang('app.bill-liabilities.detail.employee')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.date-table')</th>
                                                <th class="text-right">@lang('app.bill-liabilities.detail.amount')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.action')</th>
                                                <th class="d-none" rowspan="2"></th>
                                            </tr>
                                            <tr>
                                                <th id="total-complete" class="seemt-fz-16"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-block tab-pane" id="bill-liabilities-tab3" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <table id="table-bill-liabilities3" class="table fix-size-table">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.index')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.code')</th>
                                                <th class="text-left"
                                                    rowspan="2">@lang('app.bill-liabilities.detail.employee-cancel')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.date-cancel')</th>
                                                <th class="text-right">@lang('app.bill-liabilities.detail.amount')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.action')</th>
                                                <th class="d-none" rowspan="2"></th>
                                            </tr>
                                            <tr>
                                                <th id="total-cancel" class="seemt-fz-16"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-block tab-pane" id="bill-liabilities-tab4" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <table id="table-bill-liabilities4" class="table fix-size-table">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.index')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.code')</th>
                                                <th class="text-left" rowspan="2"
                                                    class="col-name-avatar">@lang('app.bill-liabilities.detail.employee')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.date-table')</th>
                                                <th class="text-right">@lang('app.bill-liabilities.detail.amount')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.retention-money')</th>
                                                <th rowspan="2">@lang('app.bill-liabilities.detail.action')</th>
                                                <th class="d-none" rowspan="2"></th>
                                            </tr>
                                            <tr>
                                                <th id="total-liabilities" class="seemt-fz-16">0</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-block p-0 d-none" id="create-detail-liabilities-treasurer">
                    <div class="row d-flex">
                        <div class="col-lg-8 edit-flex-auto-fill pr-1 pl-0">
                            <div class="card card-block my-0 flex-sub">
                                <div class="table-responsive new-table">
                                    <table id="table-inventory-detail-bill-liabilities" class="table ">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">@lang('app.bill-liabilities.detail.stt')</th>
                                            <th rowspan="2">
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="checkbox"
                                                               id="check-all-supplier-order-detail-bill-liabilities"
                                                               onclick="checkAllPaymentDetailBillLiabilities($(this))">
                                                    </div>
                                                </div>
                                            </th>
                                            <th class="text-left" rowspan="2">@lang('app.bill-liabilities.detail.code')</th>
                                            <th class="text-left" rowspan="2">Người nhận</th>
                                            <th>@lang('app.bill-liabilities.detail.total-amount')</th>
                                            <th rowspan="2">@lang('app.bill-liabilities.detail.retention-money')</th>
                                            <th class="text-left" rowspan="2">@lang('app.bill-liabilities.detail.created')</th>
                                            <th rowspan="2">@lang('app.bill-liabilities.detail.action')</th>
                                            <th class="d-none" rowspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <span id="total-debt-payment-bill-liabilities"
                                                      class="seemt-fz-16">0</span>
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 edit-flex-auto-fill pl-1 pr-0">
                            <div class="card card-block my-0 flex-sub">
                                <h5 class="sub-title m-0 py-1">@lang('app.bill-liabilities.detail.title-right')</h5>
                                <div class="row pt-3">
                                    <div class="col-6 mx-0 pl-0">
                                        <div class="form-group select2_theme validate-group">
                                            <div class="form-validate-select">
                                                <div class="col-lg-12 mx-0 px-0">
                                                    <div class="col-lg-12 pr-0 select-material-box">
                                                        <select id="select-status-detail-bill-liabilities"
                                                                class="js-example-basic-single col-sm-12 select2-hidden-accessible"
                                                                data-select-not-empty="" tabindex="-1"
                                                                aria-hidden="true">
                                                            <option
                                                                value="0">@lang('app.bill-liabilities.detail.otp-status-0')</option>
                                                            <option
                                                                value="1">@lang('app.bill-liabilities.detail.otp-status-1')</option>
                                                        </select>
                                                        <label>@lang('app.bill-liabilities.detail.status')</label>
                                                        <div class="line"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    </div>
                                    <div class="col-6 mx-0 pr-0">
                                        <div class="form-group select2_theme validate-group">
                                            <div class="form-validate-select">
                                                <div class="col-lg-12 mx-0 px-0">
                                                    <div class="col-lg-12 pr-0 select-material-box">
                                                        <select id="select-value-detail-bill-liabilities"
                                                                class="js-example-basic-single col-sm-12 select2-hidden-accessible"
                                                                data-select-not-empty="" tabindex="-1"
                                                                aria-hidden="true">
                                                            <option
                                                                value="1">@lang('app.bill-liabilities.detail.opt-cash')</option>
                                                            <option
                                                                value="2">@lang('app.bill-liabilities.detail.opt-bank')</option>
                                                        </select>
                                                        <label>Loại tiền</label>
                                                        <div class="line"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="select-type-detail-bill-liabilities"
                                                        class="js-example-basic-single select2-hidden-accessible"
                                                        data-select="1">
                                                    <option value="-1" disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label>@lang('app.bill-liabilities.detail.type-create') @include('layouts.start')</label>
                                                <div class="line"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="form-group validate-group" id="div-review-create-food-brand-manage">
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="checkbox" id="accounting-detail-bill-liabilities">
                                            <label class="name-checkbox" for="print-kitchen-update-food-brand-manage">
                                                @lang('app.payment-bill.create.accounting')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group validate-group">
                                    <div class="form-validate-input">
                                        <input type="text" id="date-detail-bill-liabilities"
                                               class="input-sm form-control text-center input-datetimepicker p-1"
                                               value="{{date('d/m/Y')}}" data-empty="1"/>
                                        <label>
                                            @lang('app.bill-liabilities.detail.date')
                                            @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="form-group validate-group border-dashed pb-3"
                                     style="margin-bottom: 0px !important;">
                                    <div class="form-validate-textarea">
                                        <div class="form__group pt-2">
                                            <textarea class="form__field" id="description-detail-bill-liabilities"
                                                      cols="5" rows="5" data-note-max-length="1000"></textarea>
                                            <label for="description-detail-bill-liabilities"
                                                   class="form__label icon-validate">Ghi chú </label>
                                            <div class="line"></div>
                                            <div class="textarea-character" id="char-count">
                                                <span>0/300</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <label class="f-w-600 col-form-label-fz-15">Tiền thanh toán</label>
                                        : <span class="f-w-400 col-form-label-fz-15" id="debt-payment-bill-liabilities">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange  d-none"
                     id="detail-bill-liabilities"
                     onclick="detailModalDetailBillLiabilities()"
                     onkeypress="detailModalDetailBillLiabilities()">
                    <i class="fi-rr-undo"></i>
                    <span>Trở lại</span>
                </div>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" id="payment-bill-liabilities"
                     onclick="paymentModalDetailBillLiabilities()"
                     onkeypress="paymentModalDetailBillLiabilities()">
                    <i class="fi-rr-browser"></i>
                    <span>@lang('app.bill-liabilities.detail.save')</span>
                </div>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-none"
                     id="save-payment-bill-liabilities"
                     onclick="saveModalDetailBillLiabilities()"
                     onkeypress="saveModalDetailBillLiabilities()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>

            </div>
        </div>
    </div>
</div>
@include('manage.supplier.detail')
@include('build_data.material.material.detail')
@push('scripts')
    <script type="text/javascript" src="{{asset('js\treasurer\bill_liabilities\detail.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript" src="{{asset('js\treasurer\bill_liabilities\payment.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

