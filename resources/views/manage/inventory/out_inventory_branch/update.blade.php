<div class="modal fade" id="modal-update-out-inventory-internal-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.out-inventory-internal-manage.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateOutInventoryInternalManage()" onkeypress="closeModalUpdateOutInventoryInternalManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-update-out-inventory-internal-manage">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill">
                        <div class="card card-block">
                            <h5 class="text-bold sub-title">@lang('app.out-inventory-internal-manage.update.title-left')</h5>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label class="col-form-label">@lang('app.out-inventory-internal-manage.update.material')</label>
                                </div>
                                <div class="col-lg-9">
                                    <select id="select-material-update-out-inventory-internal-manage"
                                            class="js-example-basic-single col-sm-12" data-select-not-empty>
                                        <option value="-2" disabled hidden>@lang('app.component.option_default')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-fixed-30"
                                       id="table-material-update-out-inventory-internal-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.out-inventory-internal-manage.update.name')</th>
                                        <th>@lang('app.out-inventory-internal-manage.update.material-supplier')</th>
                                        <th>@lang('app.out-inventory-internal-manage.update.remain-quantity')</th>
                                        <th>@lang('app.out-inventory-internal-manage.update.unit')</th>
                                        <th>@lang('app.out-inventory-internal-manage.update.quantity')</th>
                                        <th>@lang('app.out-inventory-internal-manage.update.price')</th>
                                        <th>@lang('app.out-inventory-internal-manage.update.total-price')</th>
                                        <th>@lang('app.out-inventory-internal-manage.update.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill">
                        <div class="card card-block flex-sub">
                            <h5 class="text-bold sub-title">@lang('app.out-inventory-internal-manage.update.title-right')</h5>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">@lang('app.out-inventory-internal-manage.update.code')</label>
                                <div class="col-sm-8">
                                    : <label id="code-update-out-inventory-internal-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">@lang('app.out-inventory-internal-manage.update.branch')</label>
                                <div class="col-sm-8">
                                    : <label id="branch-update-out-inventory-internal-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">@lang('app.out-inventory-internal-manage.update.target-branch')</label>
                                <div class="col-sm-8">
                                    : <label id="target-branch-update-out-inventory-internal-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">@lang('app.out-inventory-internal-manage.update.inventory')</label>
                                <div class="col-sm-8">
                                    : <label id="inventory-update-out-inventory-internal-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">@lang('app.out-inventory-internal-manage.update.employee')</label>
                                <div class="col-sm-8">
                                    : <label id="employee-update-out-inventory-internal-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">@lang('app.out-inventory-internal-manage.update.create')</label>
                                <div class="col-sm-8">
                                    : <label id="create-update-out-inventory-internal-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">@lang('app.out-inventory-internal-manage.update.delivery')</label>
                                <div class="col-sm-8">
                                    : <label id="date-update-out-inventory-internal-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">@lang('app.out-inventory-internal-manage.update.total-record')</label>
                                <div class="col-sm-8">
                                    : <label id="total-record-update-out-inventory-internal-manage">0</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">@lang('app.out-inventory-internal-manage.update.total-final')</label>
                                <div class="col-sm-8">
                                    : <label id="total-final-update-out-inventory-internal-manage">0</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">@lang('app.out-inventory-internal-manage.update.note')</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="note-update-out-inventory-internal-manage"
                                              cols="5" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-danger waves-effect" onclick="cancelOutInventoryInternalManage()"
                        onkeypress="cancelOutInventoryInternalManage()">@lang('app.component.button.cancel')</button>
                <button type="button"
                        class="btn btn-primary waves-effect" onclick="saveModalUpdateOutInventoryInternalManage()"
                        title="@lang('app.out-inventory-internal-manage.update.title-save')"
                        onkeypress="saveModalUpdateOutInventoryInternalManage()">@lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/out_inventory_branch/update.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
