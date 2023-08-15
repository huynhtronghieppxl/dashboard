<div class="modal fade" id="modal-detail-vat-sell-report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.sell-report.detail-discount.title')</h4>
                <h5 id="status-detail-discount-sell-report"></h5>
                <button type="button" class="close" onclick="closeModalDetailVatSellReport()" onkeypress="closeModalDetailVatSellReport()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color" id="loading-modal-detail-vat-sell-report">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill">
                        <div class="card card-block w-100">
                            <h5 class="text-bold sub-title">@lang('app.sell-report.detail-discount.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-detail-vat-sell-report">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.sell-report.detail-discount.stt')</th>
                                        <th class="text-left">@lang('app.sell-report.detail-discount.code')</th>
                                        <th class="text-left">@lang('app.sell-report.detail-discount.employee')</th>
                                        <th class="text-left">@lang('app.sell-report.detail-discount.table')</th>
                                        <th class="text-right">@lang('app.sell-report.detail-discount.amount')</th>
                                        <th class="text-right">@lang('app.sell-report.detail-discount.vat')</th>
                                        <th class="text-right">@lang('app.sell-report.detail-discount.discount')</th>
                                        <th class="text-right">@lang('app.sell-report.detail-discount.point')</th>
                                        <th class="text-right">@lang('app.sell-report.detail-discount.total-amount')</th>
                                        <th>@lang('app.sell-report.detail-discount.date')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill">
                        <div class="card card-block flex-sub">
                            <h5 class="text-bold sub-title">Thông tin VAT</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.employee-report.detail.amount')</label>
                                    <h6 class="text-muted f-w-400" id="amount-detail-vat-sell-report">0</h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.employee-report.detail.discount')</label>
                                    <h6 class="text-muted f-w-400" id="discount-detail-discount-sell-report">0</h6>
                                </div>
                            </div>
                            <div class="row border-dashed pb-2 mb-1">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.employee-report.detail.vat')</label>
                                    <h6 class="text-muted f-w-400" id="vat-detail-vat-sell-report">0</h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.employee-report.detail.point')</label>
                                    <h6 class="text-muted f-w-400" id="point-detail-vat-sell-report">0</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.employee-report.detail.total-amount')</label>
                                    <h6 class="text-muted f-w-400" id="total-amount-detail-vat-sell-report">0</h6>
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
            src="{{asset('/js/report/sell/vat/detail.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
