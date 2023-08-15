<div class="modal fade" id="modal-detail-return-order" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.supplier-order.detail-return-order.title')</h4>
                <button type="button" class="close" onclick="closeModalDetailReturnOrder()" onkeypress="closeModalDetailReturnOrder()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-detail-return-order-supplier-order">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block w-100 mr-0">
                            <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.supplier-order.detail-return-order.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-material-detail-return-order">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.supplier-order.detail-return-order.stt')</th>
                                        <th>@lang('app.supplier-order.detail-return-order.name')</th>
                                        <th>@lang('app.supplier-order.detail-return-order.return-quantity')</th>
                                        <th>@lang('app.supplier-order.detail-return-order.price')</th>
                                        <th>@lang('app.supplier-order.detail-return-order.total-price')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub col-form-label-fz-15 f-w-600" id="box-list-return-order-supplier-order">
                            <h5 class="text-bold sub-title">@lang('app.supplier-order.detail-return-order.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-return-order.branch')</label>
                                    <h6 class="col-form-label-fz-15 f-w-400 text-muted" id="branch-detail-return-order-supplier-order"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-return-order.code')</label>
                                    <h6 class="col-form-label-fz-15 f-w-400 text-muted" id="code-detail-return-order-supplier-order"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-return-order.supplier')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="/images/tms/default.jpeg" id="image-supplier-detail-return-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill" id="supplier-detail-return-order-supplier-order" style="margin: auto 5px"></h6>
                                    </div>
                                    <h6 class="col-form-label-fz-15 f-w-400 text-muted" ></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-return-order.employee-return')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="/images/tms/default.jpeg" id="image-employee-detail-return-order-supplier-order" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill class-link" id="employee-return-detail-return-order-supplier-order" style="margin: auto 5px"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-return-order.date-return')</label>
                                    <h6 class="col-form-label-fz-15 f-w-400 text-muted" id="date-return-detail-return-order-supplier-order">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-return-order.reason')</label>
                                    <h6 class="col-form-label-fz-15 f-w-400 text-muted" id="reason-detail-return-order-supplier-order"></h6>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="row mt-2">
                                <div class="col-lg-12 border-dashed">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-return-order.total-price')</label>
                                    <label class="f-w-600 f-right col-form-label-fz-15"
                                           id="amount-detail-return-order-supplier-order">0</label>
                                </div>
{{--                                <div class="col-lg-12">--}}
{{--                                    <label--}}
{{--                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-return-order.discount')</label>--}}
{{--                                    <label class="col-form-label-fz-15 f-w-400 text-muted f-right"--}}
{{--                                           id="discount-detail-return-order-supplier-order">0</label> <span class="col-form-label-fz-15 f-w-400" id="discount-percent-detail-return-order-supplier-order"></span>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-12 border-dashed">--}}
{{--                                    <label--}}
{{--                                        class="f-w-600 col-form-label-fz-15">@lang('app.supplier-order.detail-return-order.vat')</label>--}}
{{--                                    <label class="col-form-label-fz-15 f-w-400 text-muted f-right" id="vat-detail-return-order-supplier-order">0</label> <span class="col-form-label-fz-15 f-w-400 " id="vat-percent-detail-return-order-supplier-order"></span>--}}
{{--                                </div>--}}
                                <div class="col-lg-12 pt-1">
                                    <label
                                        class="f-w-600 col-form-label-fz-15 col-form-label-fz-15">@lang('app.supplier-order.detail-return-order.total-amount')</label>
                                    <label class="f-w-600 f-right col-form-label-fz-15"
                                           id="total-amount-detail-return-order-supplier-order">0</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/supplier_order/detail_return.js?version=3"></script>
@endpush
