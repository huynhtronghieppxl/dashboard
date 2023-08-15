<div class="modal fade" id="modal-detail-employee-report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.employee-report.detail.title')</h4>
                <h5 id="status-detail-employee-report"></h5>
            </div>
            <div class="modal-body background-body-color" id="loading-modal-detail-employee-report">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill">
                        <div class="card card-block w-100">
                            <h5 class="text-bold sub-title f-w-600">@lang('app.employee-report.detail.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-detail-employee-report">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.employee-report.detail.stt')</th>
                                        <th>@lang('app.employee-report.detail.code')</th>
                                        <th>@lang('app.employee-report.detail.table')</th>
                                        <th>@lang('app.employee-report.detail.amount')</th>
                                        <th>@lang('app.employee-report.detail.vat')</th>
                                        <th>@lang('app.employee-report.detail.discount')</th>
                                        <th>@lang('app.employee-report.detail.point')</th>
                                        <th>@lang('app.employee-report.detail.total-amount')</th>
                                        <th>@lang('app.employee-report.detail.date')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill">
                        <div class="card card-block flex-sub">
                            <h5 class="text-bold sub-title f-w-600">@lang('app.employee-report.detail.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="col-form-label-fz-15 f-w-600">@lang('app.employee-report.detail.name')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="name-detail-employee-report"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.employee-report.detail.role')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="role-detail-employee-report"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.employee-report.detail.time')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="time-detail-employee-report"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.employee-report.detail.amount')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="amount-detail-employee-report"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.employee-report.detail.vat')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="vat-detail-employee-report"></h6>
                                </div>
                            </div>
                            <div class="row border-dashed pb-2 mb-1">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.employee-report.detail.discount')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="discount-detail-employee-report"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.employee-report.detail.point')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="point-detail-employee-report"></h6>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.employee-report.detail.total-amount')</label>
                                    <h6 class="col-form-label-fz-15 text-muted f-w-400" id="total-amount-detail-employee-report"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-btn-hover-gray seemt-bg-gray-w200" onclick="closeModalDetailEmployeeReport()">
                    <i class="fi-rr-cross"></i>
                    <span>@lang('app.component.button.close')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@include('manage.bill.detail')
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/report/employee/detail.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
