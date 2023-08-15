<div class="modal fade" id="modal-detail-employee-bonus-punish" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.employee-bonus-punish.detail.title')</h4>
                <div class="d-flex">
                    <h5 id="status-detail-employee-bonus-punish"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailEmployeeBonusPunish()" onkeypress="closeModalDetailEmployeeBonusPunish()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 card-block card m-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.employee')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="employee-detail-employee-bonus-punish">---</h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Chi nhánh</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="branch-detail-employee-bonus-punish">---</h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.role')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="role-detail-employee-bonus-punish">---</h6>
                        </div>
                    </div>
                    <div class="row">
{{--                        đề xuất--}}
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.proposer')</p>
                            <div class="row m-0 mt-2">
                                <img onerror="this.src='/images/tms/default.jpeg'" class="image-size-detail img-radius" src=""
                                     id="proposer-avatar-detail-employee-bonus-punish">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15  reset-data-detail-employee-bonus-punish"
                                    id="proposer-detail-employee-bonus-punish" style="margin: auto 5px">---</h6>
                            </div>
                        </div>
{{--                        tạo--}}
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.creator')</p>
                            <div class="row m-0 mt-2">
                                <img onerror="this.src='/images/tms/default.jpeg'" class="image-size-detail img-radius" src=""
                                     id="create-employee-avatar-detail-employee-bonus-punish">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15  reset-data-detail-employee-bonus-punish"
                                    id="create-employee-name-detail-employee-bonus-punish" style="margin: auto 5px">---</h6>
                            </div>
                        </div>
{{--                        chỉnh sửa gần nhất--}}
                        <div class="col-sm-4" id="tab-waiting-approved-employee-bonus-punish">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.editor')</p>
                            <div class="row m-0 mt-2">
                                <img onerror="this.src='/images/tms/default.jpeg'" class="image-size-detail img-radius" src=""
                                     id="update-employee-avatar-detail-employee-bonus-punish">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15  reset-data-detail-employee-bonus-punish"
                                    id="update-employee-name-detail-employee-bonus-punish" style="margin: auto 5px">---</h6>
                            </div>
                        </div>
{{--                        xác nhận--}}
                        <div class="col-sm-4 d-none" id="tab-approved-employee-bonus-punish">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.approved')</p>
                            <div class="row m-0 mt-2">
                                <img onerror="this.src='/images/tms/default.jpeg'" class="image-size-detail img-radius" src=""
                                     id="employee-approved-avatar-detail-employee-bonus-punish">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-employee-bonus-punish"
                                    id="employee-approved-name-detail-employee-bonus-punish" style="margin: auto 5px">---</h6>
                            </div>
                        </div>
                        <div class="col-sm-4 d-none" id="tab-cancel-employee-bonus-punish">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.cancel')</p>
                            <div class="row m-0 mt-2">
                                <img onerror="this.src='/images/tms/default.jpeg'" class="image-size-detail img-radius" src=""
                                     id="employee-cancel-avatar-detail-employee-bonus-punish">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-employee-bonus-punish"
                                    id="employee-cancel-name-detail-employee-bonus-punish" style="margin: auto 5px">---</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.time')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15"
                                id="time-detail-employee-bonus-punish">{{date('d/m/Y')}}</h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.time-create')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-employee-bonus-punish"
                                id="date-create-detail-employee-bonus-punish">{{date('d/m/Y')}}</h6>
                        </div>
                        <div class="col-sm-4 d-none" id="date-update-detail-employee-bonus-punish-div">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.time-update')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-employee-bonus-punish"
                                id="date-update-detail-employee-bonus-punish">{{date('d/m/Y')}}</h6>
                        </div>
                        <div class="col-sm-4 d-none" id="date-approved-detail-employee-bonus-punish-div">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.time-approved')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="date-approved-detail-employee-bonus-punish">{{date('d/m/Y')}}</h6>
                        </div>
                        <div class="col-sm-4 d-none" id="date-cancel-detail-employee-bonus-punish-div">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.time-cancel')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="date-cancel-detail-employee-bonus-punish">{{date('d/m/Y')}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.amount')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="amount-detail-employee-bonus-punish">0</h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.type')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="type-detail-employee-bonus-punish">---</h6>
                        </div>
                        <div class="col-sm-4">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.note')</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15" style="word-break: break-all" id="note-detail-employee-bonus-punish">---</h6>
                        </div>
                    </div>
                    <div class="col-12" id="cancel-reason-detail-employee-bonus-punish-div">
                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-bonus-punish.detail.cancel-reason')</p>
                        <h6 class="text-muted f-w-400 col-form-label-fz-15" id="cancel-reason-detail-employee-bonus-punish" style="word-break: break-all">0</h6>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\treasurer\employee_bonus_punish\detail.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
