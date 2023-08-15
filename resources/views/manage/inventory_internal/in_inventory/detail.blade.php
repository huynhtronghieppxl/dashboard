<div class="modal fade" id="modal-detail-in-inventory-internal-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.in-inventory-internal-manage.detail.title')</h4>
                <button type="button" class="close" onclick="closeDetailInInventoryInventoryManage()" onkeypress="closeDetailInInventoryInventoryManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-detail-cancel-inventory-manage">
                <div class="row d-flex">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block w-100 my-1">
                            <h5 class="sub-title f-w-600 ml-0">@lang('app.in-inventory-internal-manage.detail.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-material-detail-in-inventory-internal-manage">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('app.cancel-inventory-manage.detail.stt')</th>
                                        <th rowspan="2">@lang('app.cancel-inventory-manage.detail.name')</th>
                                        <th rowspan="2">@lang('app.cancel-inventory-manage.detail.quantity')
                                        <th rowspan="2">@lang('app.cancel-inventory-manage.detail.price')</th>
                                        <th>@lang('app.cancel-inventory-manage.detail.amount')</th>
                                        <th rowspan="2"></th>
                                        <th rowspan="2" class="d-none"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" id="total-amount-detail-in-inventory-internal-manage">0</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub my-1" id="box-list-detail-in-inventory-internal-manage">
                            <h5 class="sub-title f-w-600">@lang('app.in-inventory-internal-manage.detail.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-internal-manage.detail.branch')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="branch-name-detail-in-inventory-internal-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-internal-manage.detail.inventory')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="inventory-detail-in-inventory-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-internal-manage.detail.code-in')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="code-in-detail-in-inventory-internal-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-internal-manage.detail.code-out')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted class-link" id="code-out-detail-in-inventory-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-internal-manage.detail.employee')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" id="image-employee-detail-in-inventory-internal-manage" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-detail-in-inventory-internal-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-internal-manage.detail.create')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted mt-2" id="date-detail-in-inventory-internal-manage"></h6>
                                </div>
                                <div class="col-lg-12 my-2">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-internal-manage.detail.note')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="note-name-detail-in-inventory-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="row">
                                <div class="col-lg-12 mt-2">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.in-inventory-internal-manage.detail.total-final')</label>
                                    <label class="f-w-600 col-form-label-fz-15 f-right" id="total-final-detail-inventory-internal-manage"></label>
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
{{--@include('build_data.material.material.detail')--}}
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/inventory_internal/in_inventory/detail.js?version=1"></script>
@endpush
