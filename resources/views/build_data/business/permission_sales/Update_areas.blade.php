<div class="modal fade" id="modal-update-permission-sales-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_modal_update">@lang('app.permission-sales.update.title1') </h4>
            </div>
            <div class="modal-body background-body-color text-left" id="load-modal-update-permission-sales-data">
                <div class="row">
                    <div class="col-sm-8 edit-flex-auto-fill">
                        <div class="card card-block flex-sub">
                            <h5 class="sub-title ml-0" style="font-size: 13px">@lang('app.permission-sales.update.list')</h5>
                            <div class="table-responsive">
                                <table id="table-list-all-employee-data" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('app.permission-sales.update.stt')</th>
                                            <th>@lang('app.permission-sales.update.choose')</th>
                                            <th>@lang('app.permission-sales.update.image')</th>
                                            <th>@lang('app.permission-sales.update.name')</th>
                                            <th>@lang('app.permission-sales.update.role')</th>
                                            <th class="d-none"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 edit-flex-auto-fill">
                        <div class="card card-block flex-sub" id="info-employee-permission-sales" style="position: relative">
                            <h5 class="sub-title" style="font-size: 13px"> @lang('app.permission-sales.update.title2')</h5>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label f-w-600">@lang('app.permission-sales.update.name') : </label>
                                <label class="col-sm-6 col-form-label text-left" id="name-employee-permission-sales">@lang('app.permission-sales.update.no-permission-sales')</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label f-w-600">@lang('app.permission-sales.update.phone') : </label>
                                <label class="col-sm-6 col-form-label text-left" id="phone-employee-permission-sales">@lang('app.permission-sales.update.no-permission-sales')</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label f-w-600">@lang('app.permission-sales.update.address') : </label>
                                <label class="col-sm-6 col-form-label text-left" id="address-employee-permission-sales">@lang('app.permission-sales.update.no-permission-sales')</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label f-w-600">@lang('app.permission-sales.update.branch') : </label>
                                <label class="col-sm-6 col-form-label text-left" id="branch-employee-permission-sales">@lang('app.permission-sales.update.no-permission-sales')</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label f-w-600">@lang('app.permission-sales.update.position') : </label>
                                <label class="col-sm-6 col-form-label text-left" id="role-employee-permission-sales">@lang('app.permission-sales.update.no-permission-sales')</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label f-w-600 text-left">@lang('app.permission-sales.update.employee-image')</label>
                                <div class="col-sm-6" style="width: 150px; height: 150px">
                                    <img onerror="imageDefaultOnLoadError($(this))" id="image-employee-permission-sales" src="../images/techres_logo.jpg" style="width: 100%; height: 100%">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-9"></div>
                                <div class="" style="position: absolute;bottom: 8px">
                                    <button type="button" id="cancel-employee-permission-sales" class="btn btn-grd-disabled"
                                          onclick="cancelModalUpdatePermissionSales()" onkeypress="closeModalUpdatePermissionSales()">@lang('app.permission-sales.update.cancel')
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled"
                        onclick="closeModalUpdatePermissionSales()" onkeypress="closeModalUpdatePermissionSales()">@lang('app.component.button.close')
                </button>
                <button type="button" class="btn btn-grd-primary" onclick="saveModalUpdatePermissionSales()"
                        onkeypress="saveModalUpdatePermissionSales()">@lang('app.component.button.update')
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/build_data/business/permission_sales/update_areas.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
