<style>
    .btn-send-feedback {
        border-bottom-right-radius: 12px !important;
        border-top-right-radius: 12px !important;
        padding: 12px !important;
        height: 100%;
    }

    .btn-send-feedback i {
        font-size: 20px !important;
        margin: 0 !important;
    }

    /*input {*/
        /*width: calc(100% - 60px) !important;*/
    /*}*/
</style>
<div class="modal fade" id="modal-notify-payroll" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" id="content-notify-payroll">
            <div class="modal-header header-modal-payroll" style="">
                <h4 class="modal-title">@lang('app.payroll-manage.title_notify') <span
                        class="span-covert-size-parent date-detail" id="notify-title"></span></h4>
                <button type="button" class="close" onclick="closeModalNotify()" onkeypress="closeModalNotify()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body loading-modal-detail-payroll-manage" id="body-message-payroll">
                <div class="row">
                    <div class="col-md-12" style="padding-bottom: 66px;">
                        <div class="row timeline-right">
                                <div class="card-block min-height-vh-30 w-100">
                                    <div id="data-notify-payroll-manage">
                                    </div>
                                </div>
                            <div class="card-block w-100 m-0" id="input-notify-salary" style="position: fixed; bottom: 90px; right: 0; padding: 0 1px">
                                <div class="card-block m-0" style="background: #ffff">
                                    <div class="media user-box-img">
                                        <div class="media-body">
                                            <div class="d-none" id="id-employee-reply"></div>
                                            <div class="form-group mb-0">
                                                <div class="m-t-5 form-validate-input">
                                                    <input class="form-control" id="reply-message" type="text" data-validate="" placeholder="Nhập phản hồi..."/>
                                                    <div class="text-right button-send-reply-message">
                                                        <span href="#" class="btn btn-inverse waves-effect waves-light btn-send-feedback"
                                                              id="reply-message-payroll"><i class="ion-android-send"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
<div class="d-none">
    <span id="post-message-success">@lang('app.payroll-manage.post-message-success')</span>
    <span id="post-message-error">@lang('app.payroll-manage.post-message-error')</span>
    <span id="post-message-error-null">@lang('app.payroll-manage.post-message-error-null')</span>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('/js/manage/payroll/notify.js?version=3',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

