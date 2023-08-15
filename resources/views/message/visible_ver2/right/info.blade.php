<div class="modal fade" id="modal-info-employee-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" id="loading-modal-info-employee-manage">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('app.employee-manage.detail.title')</h4>
                <div class="d-flex align-items-center">
                    <h5 id="date-status-info-employee-manage"   class="date-reset-data-info-employee-manage"  style="margin-left: auto"></h5>
                    <h5 id="status-info-employee-manage" class="reset-data-info-employee-manage float-right" style="margin-left: auto"></h5>
                    <button type="button" class="close" onclick="closeModalInfoEmployeeManage()" onkeypress="closeModalInfoEmployeeManage()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>

            </div>
            <div class="modal-body text-left">
                <div class="card-block card m-0">
                    <div class="tab-content">
                        <div id="tab0-employee-manage-info">
                            <div class="p-0 col-xl-12 col-md-12">
                                <div class="user-card-full">
                                    <div class="row m-l-0 m-r-0 justify-content-center">
                                        <div class="col-lg-12 user-profile d-flex justify-content-center align-items-center p-0" id="color-detail-employee-manage">
                                            <div class="  text-center text-white">
                                                <div class="group-image-info">
                                                    <img style="width: 200px !important; height: 200px !important;" id="avatar-info-employee-manage" onerror="imageDefaultOnLoadError($(this))" class="img-radius img-employee-custom w-100" alt="Avatar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-l-0 m-r-0">
                                        <div class="col-lg-12 pl-0 pr-0">
                                            <div class="card-block pl-0 pr-0 m-0" id="boxlist-info-employee-manage">
                                                <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.title-info')</h6>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-6 col-sm-12 d-flex align-items-center">
                                                        <p style="width: 130px" class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.name')</p>
                                                        <h6 class="m-0 text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                            id="name-info-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-12 col-md-6 col-sm-12 d-flex align-items-center">
                                                        <p style="width: 130px" class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.birthday')</p>
                                                        <h6 class="m-0 text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                            id="birthday-info-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-12 col-md-6 col-sm-12 d-flex align-items-center">
                                                        <p style="width: 130px" class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.gender')</p>
                                                        <h6 class="m-0 text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                            id="gender-info-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-12 col-md-6 col-sm-12 d-flex align-items-center">
                                                        <p style="width: 130px"   class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.phone')</p>
                                                        <h6 class="m-0 text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                            id="phone-info-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-12 col-md-6 col-sm-12 d-flex align-items-center">
                                                        <p style="width: 130px" class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.branch')</p>
                                                        <h6 class="m-0 text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                            id="branch-info-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-12 col-md-6 col-sm-12 d-flex align-items-center">
                                                        <p style="width: 130px" class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.role')</p>
                                                        <h6 class="m-0 text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                            id="role-info-employee-manage"></h6>
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
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/message/visible_v2/info.js?version=3',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
