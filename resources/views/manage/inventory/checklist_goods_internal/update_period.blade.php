<div class="modal fade" id="modal-update-period-checklist-goods-internal-manage" data-keyboard="false"
     data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.checklist-goods-internal-manage.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdatePeriodChecklistGoodsInternalManage()" onkeypress="closeModalUpdatePeriodChecklistGoodsInternalManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color text-left"
                 id="loading-update-period-checklist-goods-internal-manage">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub mr-0">
                            <h5 class="text-bold sub-title">@lang('app.checklist-goods-internal-manage.update.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-material-update-period-checklist-goods-internal-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.checklist-goods-internal-manage.update.name')</th>
                                        <th>@lang('app.checklist-goods-internal-manage.update.remain-quantity')</th>
                                        <th>@lang('app.checklist-goods-internal-manage.update.quantity-treasurer')</th>
                                        <th>@lang('app.checklist-goods-internal-manage.update.deficiency-system')</th>
                                        <th>@lang('app.checklist-goods-internal-manage.update.note')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub" id="box-list-update-period-checklist-goods-internal-manage">
                            <h5 class="text-bold sub-title">@lang('app.checklist-goods-internal-manage.update.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.update.branch')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="branch-update-period-checklist-goods-internal-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.update.code')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="code-update-period-checklist-goods-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.update.type')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="type-update-period-checklist-goods-internal-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.update.inventory')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="inventory-update-period-checklist-goods-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.update.employee-create')</label>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-employee-create-update-period-checklist-goods-internal-manage" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem">
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-2 ml-1 class-link" id="employee-create-update-period-checklist-goods-internal-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.update.create')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="create-update-period-checklist-goods-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.update.employee-update')</label>
                                    <div class="d-flex mb-1">
                                        <img src="" id="image-employee-update-update-period-checklist-goods-internal-manage" onerror="this.src='/images/tms/default.jpeg'" class="img-radius" alt="" style="width: 2rem;height: 2rem">
                                        <h6 class="f-w-400 text-muted col-form-label-fz-15 mb-0 mt-2 ml-1 class-link" id="employee-update-update-period-checklist-goods-internal-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.update.update')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="update-update-period-checklist-goods-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-internal-manage.update.check-note')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="note-from-kitchen-update-period-checklist-goods-internal-manage"></h6>
                                </div>
                            </div>
                            <div class="border-dashed"></div>
                            <div class="form-group validate-group m-t-10">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2 mb-2">
                                        <textarea class="form__field" rows="5" cols="6" data-note-max-length="255"
                                                  id="note-update-period-checklist-goods-internal-manage"></textarea>
                                        <label for="note-update-period-checklist-goods-internal-manage"
                                               class="form__label icon-validate">@lang('app.checklist-goods-internal-manage.update.note')
                                        </label>
                                        <div class="textarea-character" id="char-count">
                                            <span>0/255</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-red seemt-bg-red seemt-btn-hover-red" onclick="cancelUpdatePeriodChecklistGoodsInternalManage()"
                        onkeypress="cancelUpdatePeriodChecklistGoodsInternalManage()">
                        <i class="fi-rr-trash"></i>
                        <span>@lang('app.component.button.cancel-vote')</span>
                </div>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdatePeriodChecklistGoodsInternalManage()" title="Lưu lại"
                        onkeypress="saveModalUpdatePeriodChecklistGoodsInternalManage()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/checklist_goods_internal/update_period.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
