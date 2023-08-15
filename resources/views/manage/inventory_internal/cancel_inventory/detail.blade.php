<div class="modal fade" id="modal-detail-cancel-inventory-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.cancel-inventory-internal-manage.detail.title')</h4>
                <button type="button" class="close" onclick="closeModalDetailCancelInventoryManage()" onkeypress="closeModalDetailCancelInventoryManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-detail-cancel-inventory-manage">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill p-0">
                        <div class="card card-block w-100 my-1 mr-0">
                            <h5 class="text-bold sub-title f-w-600">@lang('app.cancel-inventory-internal-manage.detail.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-material-detail-cancel-inventory-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.cancel-inventory-internal-manage.detail.stt')</th>
                                        <th>@lang('app.cancel-inventory-internal-manage.detail.name')</th>
                                        <th>@lang('app.cancel-inventory-internal-manage.detail.quantity')</th>
                                        <th>@lang('app.cancel-inventory-internal-manage.detail.note')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block w-100 my-1" id="box-list-detail-cancel-inventory-manage">
                            <h5 class="text-bold sub-title f-w-600">@lang('app.cancel-inventory-internal-manage.detail.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.cancel-inventory-manage.detail.branch')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="branch-detail-cancel-inventory-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.cancel-inventory-manage.detail.code')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="code-detail-cancel-inventory-manage"></h6>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.cancel-inventory-manage.detail.inventory')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="inventory-detail-cancel-inventory-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.cancel-inventory-manage.detail.delivery')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="date-detail-cancel-inventory-manage">{{date('d/m/Y')}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.cancel-inventory-manage.detail.employee')</label>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-employee-detail-cancel-inventory-manage" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem">
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-2 ml-1 class-link" id="employee-detail-cancel-inventory-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.cancel-inventory-manage.detail.create')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted mt-2" id="create-detail-cancel-inventory-manage">{{date('d/m/Y')}} {{date('H:m')}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.cancel-inventory-manage.detail.note')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="note-detail-cancel-inventory-manage"></h6>
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
            src="/js/manage/inventory_internal/cancel_inventory/detail.js?version=7"></script>
@endpush
