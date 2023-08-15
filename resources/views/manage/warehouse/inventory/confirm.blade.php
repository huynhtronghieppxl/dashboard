<div class="modal fade" id="modal-confirm-inventory-warehouse-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.warehouse-manage.confirm.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalConfirmInventoryWarehouseManage()" onkeypress="closeModalConfirmInventoryWarehouseManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-modal-confirm-inventory-warehouse-manage">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub" id="box-table-confirm-inventory-warehouse-manage">
                            <h5 class="sub-title">@lang('app.warehouse-manage.confirm.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-material-confirm-inventory-warehouse-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.checklist-goods-manage.confirm.stt')</th>
                                        <th class="text-left">@lang('app.warehouse-manage.confirm.name')</th>
                                        <th>@lang('app.warehouse-manage.confirm.system')</th>
                                        <th>@lang('app.warehouse-manage.confirm.confirm')</th>
                                        <th>@lang('app.warehouse-manage.confirm.difference')</th>
                                        <th>@lang('app.warehouse-manage.confirm.note')</th>
                                        <th></th>
                                        <th class="text-center d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub" id="box-list-zero-confirm-inventory-warehouse-manage">
                            <h5 class="sub-title">@lang('app.warehouse-manage.confirm.title-right')</h5>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.confirm.branch')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="branch-confirm-inventory-warehouse-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.confirm.code') </label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="code-confirm-inventory-warehouse-manage"></h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.confirm.inventory')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="inventory-confirm-inventory-warehouse-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.confirm.time')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="time-confirm-inventory-warehouse-manage">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.employee-create')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="" id="image-employee-create-confirm-inventory-warehouse-manage" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-create-confirm-inventory-warehouse-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.confirm.time-create')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="time-create-confirm-inventory-warehouse-manage">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.confirm.employee-update')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="" id="image-employee-update-confirm-inventory-warehouse-manage" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-update-confirm-inventory-warehouse-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.confirm.time-update')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="time-update-confirm-inventory-warehouse-manage">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                            </div>

                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="note-confirm-inventory-warehouse-manage" data-note-max-length="255" cols="5" rows="3"></textarea>
                                        <label for="note-confirm-inventory-warehouse-manage" class="form__label icon-validate">
                                            @lang('app.warehouse-manage.confirm.note')
                                        </label>
                                        <div class="textarea-character">
                                            <span>0/300</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
{{--                <div type="button" class="btn seemt-btn-hover-gray seemt-bg-gray-w200" onclick="closeModalConfirmInventoryWarehouseManage()" onkeypress="closeModalConfirmInventoryWarehouseManage()">--}}
{{--                    <i class="fi-rr-cross"></i>--}}
{{--                    <span>@lang('app.component.button.close')</span>--}}
{{--                </div>--}}
                <div type="button" class="btn seemt-red seemt-bg-red seemt-btn-hover-red" onclick="cancelUpdateInventoryWarehouseManage()" onkeypress="cancelUpdateInventoryWarehouseManage()">
                    <i class="fi-rr-trash"></i>
                    <span>@lang('app.component.button.cancel-vote')</span>
                </div>
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalConfirmInventoryWarehouseManage()" onkeypress="saveModalConfirmInventoryWarehouseManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/warehouse/inventory/confirm.js?version=5"></script>
@endpush
