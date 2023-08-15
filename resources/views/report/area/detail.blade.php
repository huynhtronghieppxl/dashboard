<div class="modal fade" id="modal-detail-area-report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.area-report.detail.title')</h4>
                <h5 id="status-detail-area-report"></h5>
                <button type="button" class="close" onclick="closeModalDetailAreaReport()" onkeypress="closeModalDetailAreaReport()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color" id="loading-modal-detail-area-report">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill">
                        <div class="card card-block w-100">
                            <h5 class="text-bold sub-title f-w-600">@lang('app.area-report.detail.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-detail-area-report">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.area-report.detail.stt')</th>
                                        <th>@lang('app.area-report.detail.code')</th>
                                        <th>@lang('app.area-report.detail.table')</th>
                                        <th>@lang('app.area-report.detail.employee')</th>
                                        <th>@lang('app.area-report.detail.amount')</th>
                                        <th>@lang('app.area-report.detail.vat')</th>
                                        <th>@lang('app.area-report.detail.discount')</th>
                                        <th>@lang('app.area-report.detail.point')</th>
                                        <th>@lang('app.area-report.detail.total-amount')</th>
                                        <th>@lang('app.area-report.detail.date')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill">
                        <div class="card card-block flex-sub f-w-600">
                            <h5 class="text-bold sub-title">@lang('app.area-report.detail.title-right')</h5>
                            <div class="row">
                                <div class="col-12">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.area-report.detail.time')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="time-detail-area-report"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.area-report.detail.name')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="name-detail-area-report"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.area-report.detail.amount')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="amount-detail-area-report"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.area-report.detail.discount')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="discount-detail-area-report"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.area-report.detail.point')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="point-detail-area-report"></h6>
                                </div>
                            </div>
                            <div class="row border-dashed pb-2 mb-1">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.area-report.detail.vat')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="vat-detail-area-report"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.area-report.detail.total-amount')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="total-amount-detail-area-report"></h6>
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
@include('manage.bill.detail')
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('/js/report/area/detail.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
