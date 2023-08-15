<div class="modal fade" id="modal-detail-take-away-sell-report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
{{--                <h4 class="modal-title text-center">@lang('app.sell-report.detail-food.title')</h4>--}}
                <h5 id="status-detail-take-away-sell-report"></h5>
                <button type="button" class="close" onclick="closeModalDetailTakeAwaySellReport()" onkeypress="closeModalDetailTakeAwaySellReport()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color" id="loading-modal-detail-take-away-sell-report">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill">
                        <div class="card card-block w-100 m-0">
                            <h5 class="text-bold sub-title">@lang('app.sell-report.detail-food.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-detail-take-away-sell-report">
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
{{--                                        <th></th>--}}
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill">
                        <div class="card card-block flex-sub m-0">
                            <h5 class="text-bold sub-title">@lang('app.sell-report.detail-food.title-right')</h5>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label col-form-label-fz-15">@lang('app.sell-report.detail-food.name')</label>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="name-detail-take-away-sell-report"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label col-form-label-fz-15">@lang('app.sell-report.detail-food.time')</label>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="time-detail-take-away-sell-report"></h6>
                                </div>
                            </div>
                            <div class="form-group row border-dashed pb-2 mb-1">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label col-form-label-fz-15">@lang('app.sell-report.detail-food.original')</label>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="original-detail-take-away-sell-report"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label col-form-label-fz-15">@lang('app.sell-report.detail-food.rate-profit')(%)</label>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="rate-profit-detail-take-away-sell-report"></h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label col-form-label-fz-15">@lang('app.sell-report.detail-food.price')</label>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="price-detail-take-away-sell-report"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label col-form-label-fz-15">@lang('app.sell-report.detail-food.profit')</label>
                                    <h6 class="text-muted f-w-400 col-form-label-fz-15" id="profit-detail-take-away-sell-report"></h6>
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
            src="{{ asset('..\js\report\sell\detail_take_away.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
