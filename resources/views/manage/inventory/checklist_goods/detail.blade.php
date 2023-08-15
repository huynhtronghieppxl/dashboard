<div class="modal fade" id="modal-detail-checklist-goods-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.checklist-goods-manage.detail.title')</h4>
                <div class="d-flex align-items-center">
                    <h5 class="m-0" id="status-detail-checklist-goods-manage"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailCheckListGoodsManage()" onkeypress="closeModalDetailCheckListGoodsManage()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body text-left background-body-color" id="loading-modal-detail-checklist-goods-manage">
                <div class="row">
                    <div class="col-lg-8 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub">
                            <h5 class="sub-title">@lang('app.checklist-goods-manage.detail.title-left')</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-material-detail-checklist-goods-manage">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.checklist-goods-manage.detail.stt')</th>
                                        <th>@lang('app.checklist-goods-manage.detail.name')</th>
                                        <th>@lang('app.checklist-goods-manage.detail.system')</th>
                                        <th>@lang('app.checklist-goods-manage.detail.confirm')</th>
                                        <th>@lang('app.checklist-goods-manage.detail.difference')</th>
                                        <th>@lang('app.checklist-goods-manage.detail.note')</th>
                                        <th></th>
                                        <th class="text-center d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub" id="boxlist-detail-checklist-goods-manage">
                            <h5 class="sub-title">@lang('app.checklist-goods-manage.detail.title-right')</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.branch')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="branch-detail-checklist-goods-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.code')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="code-detail-checklist-goods-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.inventory')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="inventory-detail-checklist-goods-manage"></h6>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.time')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="time-detail-checklist-goods-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.employee-create')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius"  src="" id="image-mployee-create-detail-checklist-goods-manage" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-create-detail-checklist-goods-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.time-create')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted"
                                        id="time-create-detail-checklist-goods-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.employee-update')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="" id="image-employee-update-detail-checklist-goods-manage" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2"  id="employee-update-detail-checklist-goods-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.time-update')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted"
                                        id="time-update-detail-checklist-goods-manage"></h6>
                                </div>
                            </div>
                            <div class="row d-none" id="div-confirm-detail-checklist-goods-manage">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.employee-confirm')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="" id="image-employee-confirm-detail-checklist-goods-manage" onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-confirm-detail-checklist-goods-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.time-confirm')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted"
                                        id="time-confirm-detail-checklist-goods-manage"></h6>
                                </div>
                            </div>
                            <div class="row d-none" id="div-cancel-detail-checklist-goods-manage">
                                <div class="col-lg-6">
                                    <label class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.employee-cancel')</label>
                                    <div class="d-flex mb-1">
                                        <img class="image-size-detail img-radius" src="" id="image-employee-cancel-detail-checklist-goods-manage"  onerror="this.src='/images/tms/default.jpeg'">
                                        <h6 class="text-muted f-w-400 col-form-label-fz-15 class-link m-2" id="employee-cancel-detail-checklist-goods-manage"></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.time-cancel')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted"
                                        id="time-cancel-detail-checklist-goods-manage"></h6>
                                </div>
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.reason')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="reason-detail-checklist-goods-manage"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label
                                        class="f-w-600 col-form-label-fz-15">@lang('app.checklist-goods-manage.detail.note')</label>
                                    <h6 class="f-w-400 col-form-label-fz-15 text-muted" id="note-detail-checklist-goods-manage"></h6>
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
            src="{{asset('/js/manage/inventory/checklist_goods/detail.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
