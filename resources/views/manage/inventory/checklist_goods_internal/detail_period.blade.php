<div class="modal fade" id="modal-detail-period-checklist-goods-internal-manage" data-keyboard="false"
     data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.checklist-goods-internal-manage.detail.title')</h4>
                <button type="button" class="close" onclick="closeModalDetailPeriodChecklistGoodsInternalManage()" onkeypress="closeModalDetailPeriodChecklistGoodsInternalManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left"
                 id="loading-detail-period-checklist-goods-internal-manage">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub mr-0">
                            <h5 class="text-bold sub-title f-w-600">@lang('app.checklist-goods-internal-manage.detail.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table"
                                       id="table-detail-period-checklist-goods-internal-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.checklist-goods-internal-manage.detail.stt')</th>
                                        <th>@lang('app.checklist-goods-internal-manage.detail.name')</th>
                                        <th>@lang('app.checklist-goods-internal-manage.detail.remain-quantity')</th>
                                        <th>@lang('app.checklist-goods-internal-manage.detail.quantity-treasurer')</th>
                                        <th>@lang('app.checklist-goods-internal-manage.detail.deficiency-system')</th>
                                        <th>@lang('app.checklist-goods-internal-manage.detail.note')</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub" id="box-info-right-detail-period-checklist-goods-internal-manage">
                            <h5 class="text-bold sub-title f-w-600">@lang('app.checklist-goods-internal-manage.detail.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.branch')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="branch-detail-period-checklist-goods-internal-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.code')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="code-detail-period-checklist-goods-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.type')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="type-detail-period-checklist-goods-internal-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.inventory')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted"
                                        id="inventory-detail-period-checklist-goods-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.employee-create')</label>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-employee-create-detail-period-checklist-goods-internal-manage" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem">
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-2 ml-1 class-link" id="employee-create-detail-period-checklist-goods-internal-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.create')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted mt-2" id="create-detail-period-checklist-goods-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.employee-update')</label>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-employee-update-detail-period-checklist-goods-internal-manage" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem">
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-2 ml-1 class-link" id="employee-update-detail-period-checklist-goods-internal-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.update')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted mt-2" id="update-detail-period-checklist-goods-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row d-none" id="div-confirm-detail-period-checklist-goods-internal-manage">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.employee-confirm')</label>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-employee-confirm-detail-period-checklist-goods-internal-manage" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem">
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-2 ml-1 class-link" id="employee-confirm-detail-period-checklist-goods-internal-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.confirm')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted mt-2" id="confirm-detail-period-checklist-goods-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row d-none" id="div-cancel-detail-period-checklist-goods-internal-manage">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.employee-cancel')</label>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-employee-cancel-detail-period-checklist-goods-internal-manage" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem">
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-2 ml-1 class-link" id="employee-cancel-detail-period-checklist-goods-internal-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.cancel')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted mt-2" id="cancel-detail-period-checklist-goods-internal-manage"></h6>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.reason')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="reason-detail-period-checklist-goods-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.detail.confirm-note')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted"
                                        id="confirm-note-detail-period-checklist-goods-internal-manage"></h6>
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
@push('scripts')
    <script type="text/javascript"
            src="/js/manage/inventory/checklist_goods_internal/detail_period.js?version=2"></script>
@endpush
