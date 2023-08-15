<div class="modal fade" id="modal-detail-receipts-bill" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.receipts-bill.detail.title')</h4>
                <div class="d-flex">
                    <h5 id="status-detail-receipts-bill"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailReceiptsBill()" onkeypress="closeModalDetailReceiptsBill()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body" id="loading-modal-detail-receipts-bill">
                <div class="card-block card m-0">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.receipts-bill.detail.id-info')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill"
                                id="code-detail-receipts-bill"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.receipts-bill.detail.branch')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill"
                                id="branch-detail-receipts-bill"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.receipts-bill.detail.type')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill"
                                id="type-detail-receipts-bill"></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.receipts-bill.detail.date')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill"
                                id="date-detail-receipts-bill">{{date('d/m/Y')}}</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.receipts-bill.detail.object-type')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill"
                                id="object-type-detail-receipts-bill"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.receipts-bill.detail.object-name-detail')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill"
                                id="object-name-detail-receipts-bill"></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.receipts-bill.detail.create-employee')</p>
                            <div class="row m-0 mt-2">
                                <img onerror="this.src='/images/tms/default.jpeg'" class="image-size-detail rounded-circle" src=""
                                     id="create-employee-avatar-detail-receipts-bill">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15  reset-data-detail-receipts-bill"
                                    id="create-employee-name-detail-receipts-bill" style="margin: auto 5px"></h6>
                            </div>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill mt-2"
                                id="date-create-detail-receipts-bill">{{date('d/m/Y')}}</h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.receipts-bill.detail.update-employee')</p>
                            <div class="row m-0 mt-2">
                                <img onerror="this.src='/images/tms/default.jpeg'" class="image-size-detail rounded-circle" src=""
                                     id="update-employee-avatar-detail-receipts-bill">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill"
                                    id="update-employee-name-detail-receipts-bill" style="margin: auto 5px"></h6>
                            </div>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill mt-2"
                                id="date-update-detail-receipts-bill">{{date('d/m/Y')}}</h6>
                        </div>
                       <div class="col-lg-4 col-md-6 col-xs-12 d-none" id="cancel-detail-receipts-bill">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.receipts-bill.detail.cancel-employee')</p>
                            <div class="row m-0 mt-2">
                                <img onerror="this.src='/images/tms/default.jpeg'" class="image-size-detail rounded-circle" src=""
                                     id="update-employee-avatar-detail-receipts-bill">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill"
                                    id="confirm-employee-name-detail-receipts-bill" style="margin: auto 5px"></h6>
                            </div>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill mt-2"
                                id="date-confirm-detail-receipts-bill">{{date('d/m/Y')}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="f-w-600 col-form-label-fz-15" style="display: flex" >@lang('app.receipts-bill.detail.count-detail')
                                <i class="fi-rr-exclamation text-inverse pointer pl-1" style="margin-top: 1px"
                                   data-toggle="tooltip" data-placement="top"
                                   data-original-title="@lang('app.receipts-bill.accounting-title')"></i>
                            </p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill"
                                id="count-detail-receipts-bill"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.receipts-bill.detail.amount')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill"
                                id="amount-detail-receipts-bill"></h6>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.receipts-bill.detail.note-detail')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill"
                                id="note-detail-receipts-bill"></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-xs-12" id="cancel-reason-detail-receipts-bill-div">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.receipts-bill.detail.cancel-reason')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-receipts-bill"
                                id="cancel-reason-detail-receipts-bill"></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('..\js\treasurer\receipts_bill\detail.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
