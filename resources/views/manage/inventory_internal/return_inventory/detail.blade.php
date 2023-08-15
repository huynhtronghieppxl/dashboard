<div class="modal fade" id="modal-detail-return-inventory-internal-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.return-inventory-internal-manage.detail.title')</h4>
                <button type="button" class="close" onclick="closeModalDetailReturnInventoryInternalManage()" onkeypress="closeModalDetailReturnInventoryInternalManage()" >
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color"
                 id="loading-detail-return-inventory-internal-manage">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill p-0">
                        <div class="card card-block w-100 my-1 mr-0">
                            <h5 class="text-bold sub-title f-w-600 col-form-label-fz-15">@lang('app.return-inventory-internal-manage.detail.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-material-detail-return-inventory-internal-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.return-inventory-internal-manage.detail.stt')</th>
                                        <th>@lang('app.return-inventory-internal-manage.detail.name')</th>
                                        <th>@lang('app.return-inventory-internal-manage.detail.quantity')</th>
                                        <th>@lang('app.return-inventory-internal-manage.detail.price')</th>
                                        <th>@lang('app.return-inventory-internal-manage.detail.note')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block w-100 my-1" id="box-list-detail-return-inventory-internal-manage">
                            <h5 class="text-bold sub-title f-w-600 col-form-label-fz-15">@lang('app.return-inventory-internal-manage.detail.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.return-inventory-internal-manage.detail.branch')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="branch-detail-return-inventory-internal-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.cancel-inventory-manage.detail.code')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="code-detail-return-inventory-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.return-inventory-internal-manage.detail.employee')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="" id="image-employee-detail-return-inventory-internal-manage" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill class-link" id="employee-detail-return-inventory-internal-manage" style="margin: auto 5px"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.cancel-inventory-manage.detail.create')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted mt-2" id="create-detail-cancel-inventory-manage">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.return-inventory-internal-manage.detail.inventory')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="inventory-detail-return-inventory-internal-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.return-inventory-internal-manage.detail.date')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="date-detail-return-inventory-internal-manage"></h6>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.return-inventory-internal-manage.detail.note')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="note-detail-return-inventory-internal-manage"></h6>
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
@include('build_data.material.material.detail')
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/inventory_internal/return_inventory/detail.js?version=2"></script>
@endpush
