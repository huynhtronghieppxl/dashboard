<div class="modal fade" id="modal-detail-gift-food-sell-report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center"
                    id="title-detail-gift-food-sell-report">@lang('app.sell-report.detail-food.title')</h4>
                <h5 id="status-detail-gift-food-sell-report"></h5>
                <button type="button" class="close" onclick="closeModalDetailGiftFoodSellReport()" onkeypress="closeModalDetailGiftFoodSellReport()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color" id="loading-modal-detail-gift-food-sell-report">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill">
                        <div class="card card-block w-100">
                            <h5 class="text-bold sub-title">@lang('app.sell-report.detail-food.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-detail-gift-food-sell-report">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.sell-report.detail-food.stt')</th>
                                        <th>@lang('app.sell-report.detail-food.code')</th>
                                        <th>@lang('app.sell-report.detail-food.employee')</th>
                                        <th>@lang('app.sell-report.detail-food.table')</th>
                                        <th>@lang('app.sell-report.detail-food.quantity')</th>
                                        <th>@lang('app.sell-report.detail-food.amount')</th>
                                        <th>@lang('app.sell-report.detail-food.total-amount')</th>
                                        <th>@lang('app.sell-report.detail-food.using-slot-table')</th>
                                        <th>@lang('app.sell-report.detail-food.date')</th>
                                        <th>@lang('app.sell-report.detail-food.time-used')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill">
                        <div class="card card-block flex-sub">
                            <h5 class="text-bold sub-title">@lang('app.sell-report.detail-food.title-right')</h5>
                            <div class="row border-dashed pb-2 mb-1">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.sell-report.detail-food.name')</label>
                                    <h6 class="text-muted f-w-400" id="name-detail-gift-food-sell-report"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.sell-report.detail-food.time')</label>
                                    <h6 class="text-muted f-w-400" id="time-detail-gift-food-sell-report"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label">@lang('app.sell-report.detail-food.total-gift')</label>
                                    <h6 class="text-muted f-w-400" id="price-detail-gift-food-sell-report"></h6>
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
            src="{{ asset('..\js\report\sell\detail_gift.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
