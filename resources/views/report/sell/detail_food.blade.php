<div class="modal fade" id="modal-detail-food-sell-report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="title-detail-food-sell-report">@lang('app.sell-report.detail-food.title')</h4>
                <h5 id="status-detail-food-sell-report"></h5>
                <button type="button" class="close" onclick="closeModalDetailFoodSellReport()" onkeypress="closeModalDetailFoodSellReport()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color seemt-main-content" id="loading-modal-detail-food-sell-report">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill p-0">
                        <div class="card card-block w-100 m-0">
                            <h5 class="text-bold sub-title">@lang('app.sell-report.detail-food.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-detail-food-sell-report">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.sell-report.detail-food.stt')</th>
                                        <th rowspan="2">@lang('app.sell-report.detail-food.code')</th>
                                        <th rowspan="2">@lang('app.sell-report.detail-food.employee')</th>
                                        <th rowspan="2">@lang('app.sell-report.detail-food.table')</th>
                                        <th rowspan="2">@lang('app.sell-report.detail-food.quantity')</th>
                                        <th rowspan="2">@lang('app.sell-report.detail-food.amount')</th>
                                        <th >@lang('app.sell-report.detail-food.total-amount')</th>
                                        <th >@lang('app.sell-report.detail-food.using-slot-table')</th>
                                        <th rowspan="2">@lang('app.sell-report.detail-food.date')</th>
                                        <th rowspan="2">@lang('app.sell-report.detail-food.time-used')</th>
                                        <th rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th class="seemt-fz-14" id="total-amount-amount-detail-food-sell-report">0</th>
                                        <th class="seemt-fz-14" id="total-amount-using-slot-table-detail-food-sell-report">0</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill p-0">
                        <div class="card card-block flex-sub mr-0 mt-0 mb-0">
                            <h5 class="text-bold sub-title">@lang('app.sell-report.detail-food.title-right')</h5>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label col-form-label-fz-15">@lang('app.sell-report.detail-food.name')</label>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="name-detail-food-sell-report">---</h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label col-form-label-fz-15">@lang('app.sell-report.detail-food.rate-profit') (%)</label>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="rate-profit-detail-food-sell-report">0</h6>
                                </div>
                            </div>
                            <div class="form-group row border-dashed pb-2 mb-1">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label col-form-label-fz-15">@lang('app.sell-report.detail-food.original')</label>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="original-detail-food-sell-report">0</h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label col-form-label-fz-15">@lang('app.sell-report.detail-food.price')</label>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="price-detail-food-sell-report">0</h6>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label col-form-label-fz-15">@lang('app.sell-report.detail-food.profit')</label>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="profit-detail-food-sell-report">0</h6>
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
            src="{{ asset('js/report/sell/detail_food.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript" src="{{ asset('js/report/sell/food/detail.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript" src="{{ asset('js/report/profit/detail.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{ asset('/js/report/profit/index.js?version=7', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
