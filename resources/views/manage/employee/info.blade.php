<div class="modal fade" id="modal-info-employee-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg-big" role="document">
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
                            <div class="card-block col-xl-12 col-md-12">
                                <div class="user-card-full">
                                    <div class="row m-l-0 m-r-0">
                                        <div class="col-lg-4 user-profile d-flex justify-content-center align-items-center" id="color-detail-employee-manage">
                                            <div class="card-block text-center text-white">
                                                <div class="m-b-25 group-image-info">
                                                    <img id="avatar-info-employee-manage" onerror="imageDefaultOnLoadError($(this))" class="img-radius img-employee-custom w-100" alt="Avatar">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card-block" id="boxlist-info-employee-manage">
                                                <h6 class="sub-title m-b-0 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.title-info')</h6>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.name')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                            id="name-info-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.birthday')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                            id="birthday-info-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.gender')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                            id="gender-info-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.phone')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                            id="phone-info-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.passport')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                            id="passport-info-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.email')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                            id="email-info-employee-manage"></h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.birth-place')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-info-employee-manage text-break col-form-label-fz-15"
                                                            id="birth-place-info-employee-manage" style="word-break: break-all;" ></h6>
                                                    </div>
                                                    <div class="col-lg-8 col-md-6 col-sm-12">
                                                        <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.address')</p>
                                                        <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                            id="address-info-employee-manage"></h6>
                                                    </div>
                                                </div>
                                                <h6 class="sub-title m-b-0 m-t-10px f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.title-restaurant')</h6>
                                                @if(Session::get(SESSION_KEY_LEVEL) > 3)
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.branch')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="branch-info-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.role')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="role-info-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.group-role')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="group-role-info-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12 d-none" id="show-rank-info-employee-manage">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15"> @lang('app.employee-manage.detail.rank') </p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="rank-info-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.work')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="work-info-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.point')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="point-info-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.salary')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="salary-info-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.area')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="area-info-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.area-control')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="area-control-info-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.date-work')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="date-work-info-employee-manage"></h6>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.role')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="role-info-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.group-role')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="group-role-info-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12 d-none" id="show-rank-detail-employee-manage">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.rank')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="rank-info-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.work')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="work-info-employee-manage"></h6>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">@lang('app.employee-manage.detail.date-work')</p>
                                                            <h6 class="text-muted f-w-400 reset-data-info-employee-manage col-form-label-fz-15"
                                                                id="date-work-info-employee-manage"></h6>
                                                        </div>
                                                    </div>
                                                @endif
                                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                           data-original-title="facebook"><i
                                                                class="feather icon-facebook facebook"
                                                                aria-hidden="true"></i></a></li>
                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                           data-original-title="twitter"><i class="feather icon-twitter twitter"
                                                                                            aria-hidden="true"></i></a></li>
                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                           data-original-title="instagram"><i
                                                                class="feather icon-instagram instagram"
                                                                aria-hidden="true"></i></a>
                                                    </li>
                                                </ul>
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
    <script type="text/javascript" src="{{asset('/js/manage/employee/info.js?version=3',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
