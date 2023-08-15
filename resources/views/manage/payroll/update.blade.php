<div class="modal fade" id="modal-update-employee-basic-salary" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.employee_monthly_information.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateEmployeeMonthlyInformation()" onkeypress="closeModalUpdateEmployeeMonthlyInformation()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-update-employee-monthly-information">
                <div class="card card-block m-0">
                    <div class="form-group row">
                        <div class="col-6">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee_monthly_information.update.name')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill" id="name-update-basic_salary"></h6>
                        </div>
                        <div class="col-6">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee_monthly_information.update.time')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill" id="time-update-basic_salary"></h6>
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="col-6">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee_monthly_information.update.basic_salary')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill" id="basic_salary-update-basic_salary"></h6>
                        </div>
                        <div class="col-6">
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="edit_monthly_salary" class="select-parent-modal js-example-basic-single select2-hidden-accessible" data-select="1" tabindex="-1" aria-hidden="true">

                                            </select>

                                            <label class="icon-validate">@lang('app.employee_monthly_information.update.edit_salary')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="btn-confirm-update-employee-monthly-information" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalUpdateEmployeeMonthlyInformation()"
                     onkeypress="saveModalUpdateEmployeeMonthlyInformation()">
                    <i class="fi-rr-document"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@include('welcome')
@push('scripts')
    <script type="text/javascript" src="{{asset('/js/manage/payroll/update.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
