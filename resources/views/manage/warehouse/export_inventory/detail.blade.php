<div class="modal fade" id="modal-detail-export-warehouse" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.out-inventory-manage.detail.title')</h4>
                <div class="d-flex">
                    <h5 id="status-detail-export-warehouse"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailExportWarehouse()" onkeypress="closeModalDetailExportWarehouse()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-modal-detail-export-warehouse">
                <div id="body-detail-export-warehouse">
                    <div class="row d-flex">
                        <div class="col-lg-8 edit-flex-auto-fill">
                            <div class="card card-block w-100 my-1" id="box-table-material-detail-export-warehouse">
                                <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600 ml-0">@lang('app.out-inventory-manage.detail.title-left')</h5>
                                <div class="table-responsive new-table">
                                    <table id="table-material-detail-export-warehouse" class="table">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">@lang('app.out-inventory-manage.detail.stt')</th>
                                            <th rowspan="2" class="col-name-material">@lang('app.out-inventory-manage.detail.name')</th>
                                            <th rowspan="2">@lang('app.out-inventory-manage.detail.quantity')</th>
                                            <th rowspan="2">@lang('app.out-inventory-manage.detail.price')</th>
                                            <th class="text-right ">@lang('app.out-inventory-manage.detail.total-price')</th>
                                            <th rowspan="2">@lang('app.out-inventory-manage.detail.action')</th>
                                            <th rowspan="2" class="text-center d-none"></th>
                                        </tr>
                                        <tr>
                                            <th id="total-amount-material-export-inventory-warehouse"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 edit-flex-auto-fill pl-0">
                            <div class="card card-block flex-sub my-1" id="box-list-detail-export-warehouse">
                                <h5 class="text-bold sub-title col-form-label-fz-15 f-w-600">@lang('app.out-inventory-manage.detail.title-right')</h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.detail.branch')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="branch-detail-export-warehouse"></h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.detail.code')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="code-detail-export-warehouse"></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.detail.inventory')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="inventory-detail-export-warehouse"></h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.detail.target')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="target-detail-export-warehouse"></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.detail.employee')</label>
                                        <div class="d-flex mb-1">
                                            <img class="image-size-detail img-radius" id="image-employee-detail-export-warehouse" onerror="this.src='/images/tms/default.jpeg'">
                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-detail-export-warehouse"></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.detail.create')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15 mt-2" id="create-detail-export-warehouse"></h6>
                                    </div>
                                </div>
                                <div class="row d-none" id="div-cancel-detail-export-warehouse">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.detail.employee-cancel')</label>
                                        <div class="d-flex mb-1">
                                            <img class="image-size-detail img-radius" id="image-employee-cancel-detail-export-warehouse" onerror="this.src='/images/tms/default.jpeg'">
                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-cancel-detail-export-warehouse"></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.detail.cancel')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="cancel-detail-export-warehouse"></h6>
                                    </div>
                                </div>
                                <div class="row d-none" id="div-confirm-detail-export-warehouse">
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.detail.employee-confirm')</label>
                                        <div class="d-flex mb-1">
                                            <img class="image-size-detail img-radius" id="image-employee-confirm-detail-export-warehouse" onerror="this.src='/images/tms/default.jpeg'">
                                            <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-confirm-detail-export-warehouse"></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.detail.delivery')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15 mt-2" id="date-detail-export-warehouse"></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.detail.note')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="note-detail-export-warehouse">---</h6>
                                    </div>
                                </div>
                                <div class="row d-none" id="div-cancel-reason-detail-export-warehouse">
                                    <div class="col-lg-12">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-manage.detail.cancel-reason')</label>
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15" id="cancel-reason-detail-export-warehouse">---</h6>
                                    </div>
                                </div>
                                <div class="border-dashed"></div>
                                <div class="row">
                                    <div class="col-lg-12 mt-2">
                                        <label
                                            class="f-w-600 col-form-label-fz-15">@lang('app.out-inventory-internal-manage.detail.total')</label>
                                        <label class="f-w-600 col-form-label-fz-15 f-right" id="total-final-detail-export-warehouse"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@include('build_data.material.material.detail')
@include('manage.employee.info')
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/warehouse/export_inventory/detail.js?version=1"></script>
@endpush
