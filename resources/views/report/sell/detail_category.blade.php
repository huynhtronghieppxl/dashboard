<div class="modal fade" id="modal-detail-category-sell-report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.sell-report.detail-category.title')</h4>
                <h5 id="status-detail-category-sell-report"></h5>
                <button type="button" class="close" onclick="closeModalDetailCategorySellReport()" onkeypress="closeModalDetailCategorySellReport()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color" id="loading-modal-detail-category-sell-report">
                <div class="row">
                    <div class="col-lg-8 pr-0 edit-flex-auto-fill">
                        <div class="card card-block w-100">
                            <h5 class="ml-0 mb-2 text-bold sub-title f-w-600">@lang('app.sell-report.detail-category.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-detail-category-sell-report">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.sell-report.detail-category.stt-table')</th>
                                        <th>@lang('app.sell-report.detail-category.name-table')</th>
                                        <th>@lang('app.sell-report.detail-category.quantity-table')</th>
                                        <th>@lang('app.sell-report.detail-category.total-original-table')<br>(1)</th>
                                        <th>@lang('app.sell-report.detail-category.total-money-table')<br>(2)</th>
                                        <th>@lang('app.sell-report.detail-category.profit-table')<br>(3)</th>
                                        <th>@lang('app.sell-report.detail-category.profit-rate-table')<br>(4=(3/2)*100)</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 pl-0 edit-flex-auto-fill">
                        <div class="card card-block flex-sub">
                            <h5 class="text-bold sub-title f-w-600">@lang('app.sell-report.detail-category.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.sell-report.detail-category.name')</label>
                                    <h6 class="text-muted f-w-400" id="name-detail-category-sell-report"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.sell-report.detail-food.time')</label>
                                    <h6 class="text-muted f-w-400" id="time-detail-category-sell-report"></h6>
                                </div>
                            </div>
                            <div class="row border-dashed pb-2 mb-1">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.sell-report.detail-category.original')</label>
                                    <h6 class="text-muted f-w-400" id="original-detail-category-sell-report"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.sell-report.detail-category.rate-profit')</label>
                                    <h6 class="text-muted f-w-400" id="rate-profit-detail-category-sell-report"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.sell-report.detail-category.price')</label>
                                    <h6 class="text-muted f-w-400" id="price-detail-category-sell-report"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.sell-report.detail-category.profit')</label>
                                    <h6 class="text-muted f-w-400" id="profit-detail-category-sell-report"></h6>
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
            src="{{ asset('js/report/sell/detail_category.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
