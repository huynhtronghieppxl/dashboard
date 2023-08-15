<div class="modal fade" id="modal-update-out-inventory-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.out-inventory-manage.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateOutInventoryManage()" onkeypress="closeModalUpdateOutInventoryManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-update-out-inventory-manage">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill">
                        <div class="card card-block">
                            <h5 class="text-bold sub-title">@lang('app.out-inventory-manage.update.title-left')</h5>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label class="col-form-label">@lang('app.out-inventory-manage.update.material')</label>
                                </div>
                                <div class="col-lg-9">
                                    <select id="select-material-update-out-inventory-manage"
                                            class="js-example-basic-single col-sm-12">
                                        <option value="-2" disabled selected
                                                hidden>@lang('app.component.option_default')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-fixed-50" id="table-material-update-out-inventory-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.out-inventory-manage.update.name')</th>
                                        <th class="text-center d-none">@lang('app.out-inventory-manage.update.material-supplier')</th>
                                        <th>@lang('app.out-inventory-manage.update.remain-quantity')</th>
                                        <th>@lang('app.out-inventory-manage.update.unit')</th>
                                        <th>@lang('app.out-inventory-manage.update.quantity')</th>
                                        <th class="text-center d-none">@lang('app.out-inventory-manage.update.price')</th>
                                        <th class="text-center d-none">@lang('app.out-inventory-manage.update.total-price')</th>
                                        <th>@lang('app.out-inventory-manage.update.action')</th>
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
                            <h5 class="text-bold sub-title">@lang('app.out-inventory-manage.update.title-right')</h5>
                            <div class="form-group row">
                                <label class="col-sm-4">@lang('app.out-inventory-manage.update.branch')</label>
                                <div class="col-sm-8">
                                    : <label id="branch-update-out-inventory-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">@lang('app.out-inventory-manage.update.code')</label>
                                <div class="col-sm-8">
                                    : <label id="code-update-out-inventory-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">@lang('app.out-inventory-manage.update.inventory')</label>
                                <div class="col-sm-8">
                                    : <label id="inventory-update-out-inventory-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">@lang('app.out-inventory-manage.update.target')</label>
                                <div class="col-sm-8">
                                    : <label id="target-update-out-inventory-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">@lang('app.out-inventory-manage.update.employee')</label>
                                <div class="col-sm-8">
                                    : <label id="employee-update-out-inventory-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">@lang('app.out-inventory-manage.update.create')</label>
                                <div class="col-sm-8">
                                    : <label id="create-update-out-inventory-manage"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">@lang('app.out-inventory-manage.update.delivery')</label>
                                <div class="col-sm-8 row">
                                    <input type="text" id="date-update-out-inventory-manage"
                                           class="input-sm form-control text-center input-datetimepicker p-1 float-right"
                                           value="{{date('d/m/Y')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">@lang('app.out-inventory-manage.update.total-record')</label>
                                <div class="col-sm-8">
                                    : <label id="total-record-update-out-inventory-manage"></label>
                                </div>
                            </div>
{{--                            <div class="form-group row">--}}
{{--                                <label class="col-sm-4">@lang('app.out-inventory-manage.update.total-sum-price')</label>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    : <label id="total-sum-price-update-out-inventory-manage"></label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group row">
                                <label class="col-sm-4">@lang('app.out-inventory-manage.update.note')</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="note-update-out-inventory-manage" cols="5"
                                              rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-danger waves-effect" onclick="cancelOutInventoryManage()"
                        onkeypress="cancelOutInventoryManage()">@lang('app.component.button.cancel')</button>
                <button type="button"
                        class="btn btn-primary waves-effect" onclick="saveModalUpdateOutInventoryManage()"
                        title="@lang('app.out-inventory-manage.update.title-save')"
                        onkeypress="saveModalUpdateOutInventoryManage()">@lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <span id="sub-inventory-id-update-out-inventory-manage"></span>
    <span id="inventory-id-update-out-inventory-manage"></span>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/out_inventory/update.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
