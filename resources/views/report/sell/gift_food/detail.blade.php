<div class="modal fade" id="modal-detail-food-gift" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.bill-manage.detail.title')</h4>
                <h5 id="status-detail-bill-manage"></h5>
            </div>
            <div class="modal-body text-left background-body-color pb-0 py-0" id="loading-modal-detail-bill-manage">
                <div class="row d-flex py-0">
                    <div class="col-lg-8 edit-flex-auto-fill m-0" style="flex-direction: column">
{{--                        <ul class="nav nav-tabs md-tabs" role="tablist">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" data-toggle="tab" href="#tab1-detail-bill-manage" role="tab" id="tab-detail-bill-manage-1" aria-expanded="true">--}}
{{--                                    <span class="label label-success" id="total-record-food-detail-bill-manage">0</span></a>--}}
{{--                                <div class="slide"></div>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" data-toggle="tab" href="#tab2-detail-bill-manage" role="tab" id="tab-detail-bill-manage-2" aria-expanded="false">@lang('app.bill-manage.detail.tab2')--}}
{{--                                    <span class="label label-primary" id="total-record-receipt-detail-bill-manage">0</span></a>--}}
{{--                                <div class="slide"></div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                        <div class="card m-0 flex-sub">
                            <div class="tab-content m-t-5px">
                                <div class="card-block tab-pane active" id="tab1-detail-bill-manage" role="tabpanel">
                                    <h5 class="text-bold sub-title">@lang('app.bill-manage.detail.tab1')</h5>
                                    <div class="table-responsive new-table">
                                        <table id="table-detail-order" class="table">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">@lang('app.bill-manage.stt')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.name-table')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.category_food')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.original_price')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.quantity-table')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.price')</th>
                                                <th rowspan="1">@lang('app.bill-manage.detail.money-table')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.vat-amount')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.status-table')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.action-table')</th>
                                                <th rowspan="2" class="d-none"></th>
                                            </tr>
                                            <tr>
                                                <th class="seemt-fz-16" id="total-amount-detail-bill-treasurer"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="table-responsive new-table d-none">
                                        <table id="table-detail-order-export" class="table">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">@lang('app.bill-manage.stt')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.name-table')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.category_food')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.original_price')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.quantity-table')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.price')</th>
                                                <th rowspan="1">@lang('app.bill-manage.detail.money-table')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.vat-amount')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.status-table')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.action-table')</th>
                                                <th rowspan="2" class="d-none"></th>
                                            </tr>
                                            <tr>
                                                <th class="seemt-fz-16" id="total-amount-detail-bill-treasurer"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
{{--                                <div class="card-block tab-pane" id="tab2-detail-bill-manage" role="tabpanel">--}}
{{--                                    <div class="table-responsive new-table">--}}
{{--                                        <div class="select-filter-dataTable">--}}
{{--                                            <div class="form-validate-select">--}}
{{--                                                <div class="pr-0 select-material-box">--}}
{{--                                                    <select class="js-example-basic-single select-accounting-list-bill">--}}
{{--                                                        <option value="-1" selected>@lang('app.payment-bill.accounting')</option>--}}
{{--                                                        <option value="1">@lang('app.payment-bill.option-accounting')</option>--}}
{{--                                                        <option value="0">@lang('app.payment-bill.option-not-accounting')</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <table class="table" id="table-receipt-detail-bill-manage">--}}
{{--                                            <thead>--}}
{{--                                            <tr>--}}
{{--                                                <th rowspan="2">@lang('app.bill-manage.detail.stt')</th>--}}
{{--                                                <th rowspan="2">@lang('app.bill-manage.detail.code')</th>--}}
{{--                                                <th rowspan="2">@lang('app.bill-manage.detail.target')</th>--}}
{{--                                                <th rowspan="2">@lang('app.bill-manage.detail.note')</th>--}}
{{--                                                <th rowspan="2">@lang('app.bill-manage.detail.reason')</th>--}}
{{--                                                <th rowspan="2">@lang('app.bill-manage.detail.date-receipt')</th>--}}
{{--                                                <th>@lang('app.bill-manage.detail.amount')</th>--}}
{{--                                                <th rowspan="2">@lang('app.bill-manage.detail.action')</th>--}}
{{--                                                <th class="d-none" rowspan="2"></th>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <th id="total-receipt-detail-bill-manage" class="seemt-fz-16"></th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="tab-pane" id="tab3-detail-bill-manage" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <table class="table" id="table-payment-detail-bill-manage">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">@lang('app.bill-manage.detail.stt')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.code')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.target')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.note')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.reason')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.date-payment')</th>
                                                <th>@lang('app.bill-manage.detail.amount')</th>
                                                <th rowspan="2">@lang('app.bill-manage.detail.action')</th>
                                                <th class="d-none" rowspan="2"></th>
                                            </tr>
                                            <tr>
                                                <th id="total-payment-detail-bill-manage"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub">
                            <h5 class="text-bold sub-title mx-0 f-w-600"
                                id="boxlist-detail-bill-manage">@lang('app.bill-manage.detail.information-order')</h5>
                            <div class="row px-3">
                                <div class="form-group col-6 mb-0 px-0">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.bill-manage.detail.code')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="code-detail-bill-manage"></h6>
                                </div>
                                <div class="form-group col-6 mb-0 px-0">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.bill-manage.detail.cashier')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="cashier-detail-bill-manage"></h6>
                                </div>
                            </div>
                            <div class="row px-3">
                                <div class="form-group col-6 mb-0 px-0">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.bill-manage.detail.table')</label>
                                    <h6>
                                        <label class="col-form-label-fz-15 text-muted f-w-400" for="" id="table-detail-bill-manage">

                                        </label>
                                        ( @lang('app.bill-manage.detail.customer'): <span id="customer-detail-bill-manage"></span> )
                                    </h6>
                                </div>
                                <div class="form-group col-6 mb-0 px-0">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.bill-manage.detail.employee')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="employee-detail-bill-manage"></h6>
                                </div>
                            </div>
                            {{--                            <div class="row px-3">--}}
                            {{--                                <div class="form-group col-6 mb-0 px-0">--}}
                            {{--                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.bill-manage.detail.customer')</label>--}}
                            {{--                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="customer-detail-bill-manage"></h6>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="form-group col-6 mb-0 px-0">--}}
                            {{--                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.bill-manage.detail.update-at')</label>--}}
                            {{--                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="date-detail-bill-manage"></h6>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="row px-3">
                                <div class="form-group col-6 mb-0 px-0">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.bill-manage.detail.in')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="in-detail-bill-manage"></h6>
                                </div>
                                <div class="form-group col-6 mb-0 px-0">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.bill-manage.detail.out')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="out-detail-bill-manage"></h6>
                                </div>
                            </div>
                            <div class="row px-3 d-none" id="employee-debt-detail-bill-manage-div">
                                <div class="form-group col-12 mb-0 px-0">
                                    <label class="f-w-600 col-form-label-fz-15">Người ghi nợ</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="employee-debt-detail-bill-manage"></h6>
                                </div>
                            </div>
                            <div class="row px-3">
                                <div class="form-group col-12 mb-0 px-0">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.bill-manage.detail.note')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="note-detail-bill-manage"></h6>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="row mt-2 mb-2">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">Giá vốn</label>
                                    <label class="f-w-400 col-form-label-fz-15 f-right mt-1" id="original-price-detail-bill-manage">0</label>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">Thành tiền</label>
                                    <label class="f-w-400 col-form-label-fz-15 f-right mt-1" id="money-detail-bill-manage">0</label> <span class="col-form-label-fz-15 f-w-400" id="discount-percent-detail-order-supplier-order"></span>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">Tỷ suất LN theo thanh toán</label>
                                    <a class="mytooltip"><i
                                            class="fa fa-external-link-square"></i>
                                        <span class="tooltip-content5">
                                            <span class="tooltip-text3">
                                                <span class="tooltip-inner2 d-flex align-items-center justify-content-center" style="gap: 10px">
                                                    <span class="d-inline-block">TSLN theo thanh toán = </span>
                                                    <div class="d-inline-block"><span style="border-bottom: 1px solid #333">(Thanh toán - giá vốn)</span><span>Thanh toán</span></div>
                                                    <span class="d-inline-block">x100</span>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                    <label class="f-w-400 col-form-label-fz-15 f-right mt-1" id="rate-profit-detail-bill-manage">0</label> <span class="col-form-label-fz-15 f-w-400" id="vat-percent-detail-order-supplier-order"></span>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">Giảm giá</label>
                                    <label class="f-w-400 col-form-label-fz-15 f-right mt-1" id="discount-detail-bill-manage">
                                    </label>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">VAT</label>
                                    <label class="f-w-400 col-form-label-fz-15 f-right"
                                           id="vat-detail-bill-manage">0</label>
                                </div>
                                <div class="col-lg-12 d-none" id="bonus-point-detail-bill-manage-div">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">Điểm nạp</label>
                                    <label class="f-w-400 col-form-label-fz-15 f-right"
                                           id="bonus-point-detail-bill-manage">0</label>
                                </div>
                                <div class="col-lg-12 d-none" id="accumulated-point-detail-bill-manage-div">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">Điểm tích luỹ</label>
                                    <label class="f-w-400 col-form-label-fz-15 f-right"
                                           id="accumulated-point-detail-bill-manage">0</label>
                                </div>
                                <div class="col-lg-12 d-none" id="discount-point-detail-bill-manage-div">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">Điểm khuyến mãi</label>
                                    <label class="f-w-400 col-form-label-fz-15 f-right"
                                           id="discount-point-detail-bill-manage">0</label>
                                </div>
                                <div class="col-lg-12 d-none" id="value-point-detail-bill-manage-div">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">Điểm value</label>
                                    <label class="f-w-400 col-form-label-fz-15 f-right"
                                           id="value-point-detail-bill-manage">0</label>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="px-3 mt-2">
                                <label
                                    class="f-w-600 col-form-label-fz-15">Thanh toán</label>
                                <label class="f-w-600 col-form-label-fz-15 f-right"
                                       id="total-detail-bill-manage">0</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{--                <button type="button" class="btn btn-grd-disabled waves-effect " onclick="closeModalDetailBillManage()"--}}
                {{--                        onkeypress="closeModalDetailBillManage()">@lang('app.component.button.close')</button>--}}
                {{--                <button type="button" class="btn btn-grd-primary"--}}
                {{--                        onclick="openModalHistory()"--}}
                {{--                        onkeypress="openModalHistory()">@lang('app.component.button.history')--}}
                {{--                </button>--}}
                {{--                <button type="button" class="btn btn-grd-warning"--}}
                {{--                        onclick="exportModalDetailBillManage()"--}}
                {{--                        onkeypress="exportModalDetailBillManage()">@lang('app.component.excel.export')</button>--}}

                <div class="btn seemt-btn-hover-gray seemt-bg-gray-w200" onclick="closeModalDetailBillManage()" onkeypress="closeModalDetailBillManage()">
                    <i class="fi-rr-cross"></i>
                    <span>@lang('app.component.button.close')</span>
                </div>
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="openModalHistory()" onkeypress="openModalHistory()">
                    <i class="fi-rr-hourglass"></i>
                    <span>@lang('app.component.button.history')</span>
                </div>
                <div type="button" class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange" onclick="exportModalDetailBillManage()" onkeypress="exportModalDetailBillManage()">
                    <i class="fi-rr-print"></i>
                    <span>@lang('app.component.excel.export')</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <span id="id-cashier-detail-bill-manage"></span>
    <span id="id-employee-detail-bill-manage"></span>
    <span id="branch-phone-detail-bill-manage"></span>
    <span id="branch-address-detail-bill-manage"></span>
    <span id="branch-name-detail-bill-manage"></span>
</div>
@include('manage.bill.history')
@include('treasurer.payment_bill.detail')
@include('treasurer.receipts_bill.detail')
@include('manage.food.brand.detail')
@include('manage.bill.excel')
@include('manage.supplier_order.detail_return')
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('/js/report/sell/gift_food/detail.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
