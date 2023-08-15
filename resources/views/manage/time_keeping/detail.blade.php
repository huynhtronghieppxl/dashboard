<div class="modal fade" id="modal-detail-time-keeping-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.time-keeping-manage.detail.title')</h4>
                <button type="button" class="close" onclick="closeModalDetailTimeKeepingManage()" onkeypress="closeModalDetailTimeKeepingManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-detail-time-keeping-manage">
                <div class="card-block card m-0">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="f-w-600 col-form-label-fz-15">@lang('app.time-keeping-manage.detail.date')</label>
                            <div class="f-w-400 col-form-label-fz-15 text-muted">
                                <label class="col-form-label-fz-15" id="date-detail-time-keeping-manage"></label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="f-w-600 col-form-label-fz-15">@lang('app.time-keeping-manage.detail.work')</label>
                            <div class="f-w-400 col-form-label-fz-15 text-muted">
                                <label id="work-detail-time-keeping-manage" class="col-form-label-fz-15"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row border-dashed mb-2">
                        <div class="col-lg-12">
                            <label class="f-w-600 col-form-label-fz-15">Vị trí chấm công</label>
                            <div class="f-w-400 col-form-label-fz-15 text-muted">
                                <label id="address-check-in-detail-time-keeping-manage" class="font-1-rem"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="f-w-600 col-sm-6 col-form-label-fz-15">@lang('app.time-keeping-manage.detail.late-minute')</label>
                        <label class="col-sm-6 col-form-label-fz-15">: <span class="col-form-label-fz-15 text-muted" id="late-minute-detail-time-keeping-manage"></span></label>
                    </div>
                    <div class="form-group row">
                        <label class="f-w-600 col-sm-6 col-form-label-fz-15">@lang('app.time-keeping-manage.detail.leave-status')</label>
                        <label class="col-sm-6 col-form-label-fz-15">: <span class="col-form-label-fz-15 text-muted" id="leave-status-detail-time-keeping-manage"></span></label>
                    </div>
                    <div class="form-group validate-group mt-2">
                        <div class="col-lg-6">
                            <label class="f-w-600 col-form-label-fz-15">@lang('app.time-keeping-manage.detail.note')</label>
                            <div class="f-w-400 col-form-label-fz-15 text-muted">
                                <label class="col-form-label-fz-15" id="note-detail-time-keeping-manage"></label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src=/js/manage/time_keeping/detail.js?version="></script>
@endpush
