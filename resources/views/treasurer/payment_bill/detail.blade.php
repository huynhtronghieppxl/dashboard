<div class="modal fade" id="modal-detail-payment-bill" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.payment-bill.detail.title')</h4>
                <div class="d-flex">
                    <h5 id="status-detail-payment-bill"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailPaymentBill()" onkeypress="closeModalDetailPaymentBill()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body" id="loading-modal-detail-payment-bill">
                <div class="card card-block m-0">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.detail.id-info')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="code-detail-payment-bill">---</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.detail.branch')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="branch-detail-payment-bill">---</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.detail.type')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="type-detail-payment-bill">---</h6>
                        </div>
                    </div>
{{--                    </div>--}}
{{--                    <div class="row">--}}
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.detail.date')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="date-detail-payment-bill">{{date('d/m/Y')}}</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.detail.object-type')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="object-type-detail-payment-bill">---</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.detail.object-name-detail')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="object-name-detail-payment-bill">---</h6>
                        </div>
                    </div>
{{--                    </div>--}}
{{--                    <div class="row">--}}
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.detail.create-employee')</p>
                            <div class="d-flex mb-1">
                                <img class="image-size-detail img-radius" src=""
                                     id="create-employee-avatar-detail-payment-bill"
                                     onerror="this.src='/images/tms/default.jpeg'">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                    id="create-employee-name-detail-payment-bill" style="margin: auto 5px">---</h6>
                            </div>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="date-create-detail-payment-bill">{{date('d/m/Y')}}</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12" id="div-update-detail-payment-bill">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.detail.update-employee')</p>
                            <div class="d-flex mb-1">
                                <img class="image-size-detail img-radius" src=""
                                     onerror="this.src='/images/tms/default.jpeg'"
                                     id="update-employee-avatar-detail-payment-bill">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                    id="update-employee-name-detail-payment-bill" style="margin: auto 5px">---</h6>
                            </div>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill mt-2 mr-2"
                                id="date-update-detail-payment-bill">{{date('d/m/Y')}}</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12 d-none" id="confirm-detail-payment-bill-div">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15" id="confirm-employee-detail-payment-bill">@lang('app.payment-bill.detail.confirm-employee')</p>
                            <p class="m-b-10 f-w-600 col-form-label-fz-15 d-none" id="cancel-employee-detail-payment-bill">@lang('app.payment-bill.detail.cancel-employee')</p>
                            <div class="d-flex mb-1">
                                <img class="image-size-detail img-radius" src=""
                                     onerror="this.src='/images/tms/default.jpeg'"
                                     id="update-employee-avatar-detail-payment-bill">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                    id="confirm-employee-name-detail-payment-bill" style="margin: auto 5px">---</h6>
                            </div>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="date-confirm-detail-payment-bill">{{date('d/m/Y')}}</h6>
                        </div>
                    </div>
{{--                    </div>--}}
{{--                    <div class="row">--}}
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="f-w-600 col-form-label-fz-15 ">@lang('app.payment-bill.detail.count-detail')
                                <i class="fi-rr-exclamation pointer text-inverse" style="display: initial !important;"
                                   data-toggle="tooltip" data-placement="top"
                                   data-original-title="@lang('app.payment-bill.accounting-title')"></i>
                            </p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15  reset-data-detail-payment-bill"
                                id="count-detail-payment-bill">---</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.detail.amount')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="amount-detail-payment-bill">0</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12 d-none" id="box-fund-payment-bill-treasurer">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Nguồn tiền</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="fund-payment-bill-treasurer" style="word-break: break-word !important;"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.detail.note-detail')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="note-detail-payment-bill" style="word-break: break-word !important;"></h6>
                        </div>
                        <div class="col-12 d-none" id="cancel-reason-detail-payment-bill-div">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.payment-bill.detail.cancel-reason')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="cancel-reason-detail-payment-bill" style="word-break: break-word !important;"></h6>
                        </div>
                    </div>
                </div>
                <div class="card card-block m-0" id="div-inventory-detail-payment-bill" style="margin-top: 10px !important;">
                    <h6 class="f-w-600 sub-title">
                        DANH SÁCH ĐƠN HÀNG</h6>
                    <div class="table-responsive new-table">
                        <table class="table " id="table-inventory-detail-payment-bill">
                            <thead>
                            <tr>
                                <th class="text-center" rowspan="2">@lang('app.payment-bill.detail.stt')</th>
                                <th class="text-center" rowspan="2">@lang('app.payment-bill.detail.code')</th>
                                <th class="text-center" rowspan="2">@lang('app.payment-bill.detail.delivery_date')</th>
                                <th class="text-center" rowspan="2">@lang('app.payment-bill.detail.supplier')</th>
{{--                                <th class="text-center d-none" rowspan="2">@lang('app.payment-bill.detail.inventory')</th>--}}
                                <th class="text-center">@lang('app.payment-bill.detail.amount')</th>
                                <th class="text-center" rowspan="2">@lang('app.payment-bill.detail.retention-money')</th>
                                <th class="text-center" rowspan="2"></th>
                                <th class="d-none" rowspan="2"></th>
                            </tr>
                            <tr>
                                <th id="total-amount-detail-payment-bill" class="seemt-fz-16">0</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript"
            src="{{ asset('..\js\treasurer\payment_bill\detail.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
