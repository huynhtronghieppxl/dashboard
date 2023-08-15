<div class="modal fade" id="modal-detail-cost-debt-report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.cost-debt-report.detail.title')
                    <span class="span-covert-size-parent date-detail"></span></h4>
            </div>
            <div class="modal-body background-body-color" id="loading-modal-detail-cost-debt-report">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill">
                        <div class="card card-block mb-0 flex-sub">
                            <div class="card card-block">
                                <div class="table-responsive">
                                    <table id="table-detail-cost-debt-report"
                                           class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.cost-debt-report.detail.stt')</th>
                                            <th>@lang('app.cost-debt-report.detail.code')</th>
                                            <th>@lang('app.cost-debt-report.detail.employee')</th>
                                            <th>@lang('app.cost-debt-report.detail.target')</th>
                                            <th>@lang('app.cost-debt-report.detail.date')</th>
                                            <th>@lang('app.cost-debt-report.detail.amount')</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill">
                        <div class="card card-block mb-0 flex-sub">
                            <div class="col-md-12">
                                <h5 class="sub-title">@lang('app.cost-debt-report.detail.title-right')</h5>
                                <div class="form-group row">
                                    <label class="col-sm-4">@lang('app.cost-debt-report.detail.name')</label>
                                    <div class="col-sm-8">: <span class="font-1-em" id="name-detail-cost-debt-report"></span></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4">@lang('app.cost-debt-report.detail.type')</label>
                                    <div class="col-sm-8">: <span class="font-1-em" id="type-detail-cost-debt-report"></span></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4">@lang('app.cost-debt-report.detail.time')</label>
                                    <div class="col-sm-8">: <span class="font-1-em" id="time-detail-cost-debt-report"></span></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4">@lang('app.cost-debt-report.detail.total-amount')</label>
                                    <div class="col-sm-8">: <span class="font-1-em" id="amount-detail-cost-debt-report"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled waves-effect "
                        onclick="closeModalDetailCostDebtReport()">@lang('app.component.button.close')</button>
            </div>
        </div>
    </div>
</div>
@include('treasurer.payment_bill.detail')
@push('scripts')
    <script type="text/javascript" src="{{asset('/js/report/cost_debt/detail.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

