<div class="modal fade" id="modal-update-time-keeping-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.time-keeping-manage.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateTimeKeepingManage()" onkeypress="closeModalUpdateTimeKeepingManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-update-time-keeping-manage">
                <div class="card-block card m-0">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="f-w-600 col-form-label-fz-15">@lang('app.time-keeping-manage.update.date')</label>
                            <div class="f-w-400 col-form-label-fz-15 text-muted">
                                <label id="date-update-time-keeping-manage" class="font-1-rem"></label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="f-w-600 col-form-label-fz-15">@lang('app.time-keeping-manage.update.work')</label>
                            <div class="f-w-400 col-form-label-fz-15 text-muted">
                                <label id="work-update-time-keeping-manage" class="font-1-rem"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row border-dashed mb-3">
                        <div class="col-lg-12">
                            <label class="f-w-600 col-form-label-fz-15">Vị trí chấm công</label>
                            <div class="f-w-400 col-form-label-fz-15 text-muted">
                                <label id="address-check-in-time-keeping-manage" class="font-1-rem"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group  row">
                        <div class=" col-lg-12 form-group checkbox-group p-0 " style="margin-bottom: 0 !important;">
                            <div class="" id="check-timekeeping-update-time-keeping-manage">
                                <div class="form-validate-checkbox">
                                    <div class="checkbox-form-group">
                                        <input type="radio" name="check-timekeeping-update-time-keeping" value="0" data-icon="" checked="">
                                        <label class="name-checkbox" for="">Có chấm công                                                   </label>
                                    </div>
                                </div>
                                <div class="form-group d-none" id="time-checkin-in-out" style="margin-bottom: 40px">
                                    <label class="input-group m-auto" style="height: 44px">
                                        <div class="input-group border-group" style="border-radius: 6px !important;" id="div-check-update-time-keeping-manage">
                                            <input class="form-control text-center input-sm p-1 custom-form-search" id="check-in-update-time-keeping-manage" type="text" placeholder="00:00" autocomplete="off">
                                            <span class="input-group-addon custom-find">@lang('app.component.button.to')</span>
                                            <input class="form-control text-center input-sm p-1 custom-form-search" id="check-out-update-time-keeping-manage" type="text" placeholder="00:00" autocomplete="off">
                                        </div>
                                    </label>
                                    <div class="link-href float-right pr-5">
                             <span class="f-w-600">@lang('app.time-keeping-manage.update.late-minute')
                             </span>: <span class="font-1-rem" id="late-minute-update-time-keeping-manage"></span>
                                    </div>
                                </div>
                                <div class="form-validate-checkbox pt-2">
                                    <div class="checkbox-form-group">
                                        <input type="radio" name="check-timekeeping-update-time-keeping" value="1" data-icon=" "  >
                                        <label class="name-checkbox" for="">Nghỉ không phép                                                  </label>
                                    </div>
                                </div>
                                <div class="form-validate-checkbox pt-2">
                                    <div class="checkbox-form-group">
                                        <input type="radio" name="check-timekeeping-update-time-keeping" value="2" data-icon=" "  >
                                        <label class="name-checkbox" for=""> @lang('app.time-keeping-manage.update.leave')                                                </label>
                                    </div>
                                </div>
                                <div class="form-validate-checkbox pt-2" style="margin-right: 0 !important;">
                                    <div class="checkbox-form-group">
                                        <input type="radio" id="leave-salary-update-time-keeping-manage" name="check-timekeeping-update-time-keeping" value="3" data-icon=""  >
                                        <label class="name-checkbox" for=""> @lang('app.time-keeping-manage.update.leave-salary')
                                        </label>
                                    </div>
                                    <span id="noti-leave-salary-update-time-keeping-manage" class="d-none seemt-red" style="padding-left: 30px !important;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea class="form__field" data-note-max-length="255" id="note-update-time-keeping-manage" rows="5" cols="5"></textarea>
                                <label for="note-update-time-keeping-manage" class="form__label icon-validate">
                                    @lang('app.time-keeping-manage.update.note')
                                </label>
                                <div class="textarea-character" id="char-count">
                                    <span>0/300</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     id="save-modal-update-time-keeping-manage" onclick="saveModalUpdateTimeKeepingManage()"
                     onkeypress="saveModalUpdateTimeKeepingManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="/js/manage/time_keeping/update.js?version=4"></script>
@endpush
