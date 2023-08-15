<div class="modal fade" id="modal-detail-inventory-warehouse-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.warehouse-manage.detail-inventory-warehouse.title')</h4>
                <div class="d-flex align-items-center">
                <h5 id="status-detail-inventory-warehouse-manage"></h5>
                <button type="button" class="close ml-4" onclick="closeModalDetailInventoryWarehouseManage()" onkeypress="closeModalDetailInventoryWarehouseManage()">
                    <i class="fi-rr-cross"></i>
                </button>
                </div>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-modal-detail-inventory-warehouse-manage">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub">
                            <h5 class="sub-title">@lang('app.warehouse-manage.detail-inventory-warehouse.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-material-detail-inventory-warehouse-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.warehouse-manage.detail-inventory-warehouse.stt')</th>
                                        <th class="text-left">@lang('app.warehouse-manage.detail-inventory-warehouse.name')</th>
                                        <th>@lang('app.warehouse-manage.detail-inventory-warehouse.system')</th>
                                        <th>@lang('app.warehouse-manage.detail-inventory-warehouse.confirm')</th>
                                        <th>@lang('app.warehouse-manage.detail-inventory-warehouse.difference')</th>
                                        <th>@lang('app.warehouse-manage.detail-inventory-warehouse.note')</th>
                                        <th></th>
                                        <th class="text-center d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub" id="boxlist-detail-inventory-warehouse-manage">
                            <h5 class="sub-title">@lang('app.warehouse-manage.detail-inventory-warehouse.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.branch')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="branch-detail-inventory-warehouse-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.code')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="code-detail-inventory-warehouse-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.inventory')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="inventory-detail-inventory-warehouse-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.time')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="time-detail-inventory-warehouse-manage">{{date('d/m/Y')}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.employee-create')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius"  src="" id="image-employee-create-detail-inventory-warehouse-manage" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-create-detail-inventory-warehouse-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.time-create')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted"
                                        id="time-create-detail-inventory-warehouse-manage">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.employee-update')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="" id="image-employee-update-detail-inventory-warehouse-manage" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2"  id="employee-update-detail-inventory-warehouse-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.time-update')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted"
                                        id="time-update-detail-inventory-warehouse-manage">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                            </div>
                            <div class="row d-none" id="div-confirm-detail-inventory-warehouse-manage">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.employee-confirm')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="" id="image-employee-confirm-detail-inventory-warehouse-manage" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-confirm-detail-inventory-warehouse-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.time-confirm')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted"
                                        id="time-confirm-detail-inventory-warehouse-manage">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                            </div>
                            <div class="row d-none" id="div-cancel-detail-inventory-warehouse-manage">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.employee-cancel')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="" id="image-employee-cancel-detail-inventory-warehouse-manage"  onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-cancel-detail-inventory-warehouse-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.time-cancel')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted"
                                        id="time-cancel-detail-inventory-warehouse-manage">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.reason')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="reason-detail-inventory-warehouse-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.warehouse-manage.detail-inventory-warehouse.note')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="note-detail-inventory-warehouse-manage"></h6>
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
            src="/js/manage/warehouse/inventory/detail.js?version=2"></script>
@endpush
