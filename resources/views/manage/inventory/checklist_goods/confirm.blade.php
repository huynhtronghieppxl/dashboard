<div class="modal fade" id="modal-confirm-checklist-goods-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.checklist-goods-manage.confirm.title')</h4>
                <button type="button" class="close" onclick="closeModalConfirmCheckListGoodsManage()" onkeypress="closeModalConfirmCheckListGoodsManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-modal-confirm-checklist-goods-manage">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub" id="box-table-confirm-checklist-goods-manage">
                            <h5 class="sub-title">@lang('app.checklist-goods-manage.confirm.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-material-confirm-checklist-goods-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.checklist-goods-manage.confirm.stt')</th>
                                        <th>@lang('app.checklist-goods-manage.confirm.name')</th>
                                        <th>@lang('app.checklist-goods-manage.confirm.system')</th>
                                        <th>@lang('app.checklist-goods-manage.confirm.confirm')</th>
                                        <th>@lang('app.checklist-goods-manage.confirm.difference')</th>
                                        <th>@lang('app.checklist-goods-manage.confirm.note')</th>
                                        <th></th>
                                        <th class="text-center d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub" id="box-list-zero-confirm-checklist-goods-manage">
                            <h5 class="sub-title">@lang('app.checklist-goods-manage.confirm.title-right')</h5>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.confirm.branch')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="branch-confirm-checklist-goods-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.confirm.code') </label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="code-confirm-checklist-goods-manage"></h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.confirm.inventory')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="inventory-confirm-checklist-goods-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.confirm.time')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="time-confirm-checklist-goods-manage"></h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.confirm.employee-create')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="" id="image-employee-create-confirm-checklist-goods-manage" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-create-confirm-checklist-goods-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.confirm.time-create')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="time-create-confirm-checklist-goods-manage"></h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.confirm.employee-update')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="" id="image-employee-update-confirm-checklist-goods-manage" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-update-confirm-checklist-goods-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.confirm.time-update')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="time-update-confirm-checklist-goods-manage"></h6>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                        <textarea class="form__field" id="note-confirm-checklist-goods-manage" cols="5" rows="3" data-note-max-length="255"></textarea>
                                        <label for="note-confirm-checklist-goods-manage" class="form__label icon-validate">
                                            @lang('app.checklist-goods-manage.confirm.note')
                                        </label>
                                        <div class="textarea-character" id="char-count">
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
                <div type="button" class="btn seemt-red seemt-bg-red seemt-btn-hover-red" onclick="cancelUpdateCheckListGoodsManage()" onkeypress="cancelUpdateCheckListGoodsManage()">
                    <i class="fi-rr-trash"></i>
                    <span>@lang('app.component.button.cancel-vote')</span>
                </div>
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalConfirmCheckListGoodsManage()" onkeypress="saveModalConfirmCheckListGoodsManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/inventory/checklist_goods/confirm.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
