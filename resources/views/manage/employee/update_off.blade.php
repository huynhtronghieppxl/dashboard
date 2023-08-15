<div class="modal fade" id="modal-update-off-employee-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.employee-manage.update-off.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateOffEmployeeManage()" onkeypress="closeModalUpdateOffEmployeeManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-update-off-employee-manage">
                <div class="card">
                    <div class="card-block">
                        <div class="form-group row">
                            <label class="col-md-6 col-form-label">@lang('app.employee-manage.update-off.used-month')</label>
                            <div class="col-md-6">
                                <input id="used-month-update-off-employee-manage" class="form-control" data-type="currency-edit" value="0" data-validate-number>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-6 col-form-label">@lang('app.employee-manage.update-off.total-month')</label>
                            <div class="col-md-6">
                                <input id="total-month-update-off-employee-manage" class="form-control" data-type="currency-edit" value="0" data-validate-number>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-6 col-form-label">@lang('app.employee-manage.update-off.available-month')</label>
                            <div class="col-md-6">
                                <input id="available-month-update-off-employee-manage" class="form-control" data-type="currency-edit" value="0" data-validate-number>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-6 col-form-label">@lang('app.employee-manage.update-off.used-year')</label>
                            <div class="col-md-6">
                                <input id="used-year-update-off-employee-manage" class="form-control" data-type="currency-edit" value="0" data-validate-number>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-6 col-form-label">@lang('app.employee-manage.update-off.total-year')</label>
                            <div class="col-md-6">
                                <input id="total-year-update-off-employee-manage" class="form-control" data-type="currency-edit" value="0" data-validate-number>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-6 col-form-label">@lang('app.employee-manage.update-off.available-year')</label>
                            <div class="col-md-6">
                                <input id="available-year-update-off-employee-manage" class="form-control" data-type="currency-edit" value="0" data-validate-number>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-primary waves-effect waves-light" onclick="saveModalUpdateOffEmployeeManage()"
                        onkeypress="saveModalUpdateOffEmployeeManage()">@lang('app.component.button.save')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('/js/manage/employee/update_off.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
