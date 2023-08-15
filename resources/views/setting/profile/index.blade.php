@extends('layouts.layout')
@section('content')
    <style>
        .border-info-profile {
            border-left: 1px solid var(--blue-color);
        }
    </style>
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card card-block">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center justify-content-center">
                            <input class="d-none" id="img_id">
                            <div class="text-center">
                                <div class="col-lg-2 pl-4">
                                    <div class="profile-thumb">
                                        <img alt="author" onerror="this.src='/images/tms/default.jpeg'"
                                             id="thumbnail-profile-logo"
                                             class="profile-image-avatar" src="" data-url="">
                                        <div class="edit-profile pointer">
                                            <label class="fileContainer pointer">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" class="d-none" id="upload-avatar"
                                                       accept="image/*"/>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{--<span id="name-avatar"></span>--}}
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="view-info">
                                <div class="general-info" id="boxlist-index-profile-setting">
                                    <div class="border-left-success-box border-info-profile mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-input mt-3">
                                                        <input type="text" id="name-label"
                                                               class="input-sm form-control input-datetimepicker p-1"
                                                               data-empty="1" data-emoji="1" data-spec="1"
                                                               data-min-length="2" data-max-length="50">
                                                        <label>
                                                            @lang('app.profile.name')
                                                            @include('layouts.start')
                                                        </label>
                                                    </div>
                                                    <div class="link-href"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-input mt-3">
                                                        <input type="text" id="email-label"
                                                               class="input-sm form-control input-datetimepicker p-1"
                                                               data-mail="1" data-empty="1" data-emoji="1"
                                                               data-min-length="2" data-max-length="50">
                                                        <label>
                                                            @lang('app.profile.email')
                                                            @include('layouts.start')
                                                        </label>
                                                    </div>
                                                    <div class="link-href"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-input mt-3">
                                                        <input type="text" id="place-birth-label" data-min-length="2"
                                                               class="input-sm form-control input-datetimepicker p-1"
                                                               data-empty="1"
                                                               data-max-length="255" data-emoji="1" data-spec="1">
                                                        <label>
                                                            @lang('app.profile.place-birthday')
                                                            @include('layouts.start')
                                                        </label>
                                                    </div>
                                                    <div class="link-href"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-input mt-3">
                                                        <input type="text" id="birthday-label"
                                                               class="input-sm form-control input-datetimepicker p-1"
                                                               data-empty="1">
                                                        <label>
                                                            @lang('app.profile.birthday')
                                                            @include('layouts.start')
                                                        </label>
                                                    </div>
                                                    <div class="link-href"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-input mt-3">
                                                        <input type="text" id="phone-label"
                                                               class="input-sm form-control input-datetimepicker p-1"
                                                               data-empty="1"
                                                               data-phone="1">
                                                        <label>
                                                            @lang('app.profile.phone')
                                                            @include('layouts.start')
                                                        </label>
                                                    </div>
                                                    <div class="link-href"></div>
                                                </div>
                                            </div>
                                            <div class=" col-lg-6 d-flex align-items-center">
                                                <div class="form-group checkbox-group "
                                                     style="margin: 10px 0 0 0!important;">
                                                    <label class="title-checkbox">@lang('app.profile.sex') </label>
                                                    <div class="row" id="gender-label">
                                                        <div class="form-validate-checkbox col-lg-3 pl-0">
                                                            <div class="checkbox-form-group">
                                                                <input type="radio" name="gender" value="1">
                                                                <label class="name-checkbox"
                                                                       for="print-kitchen-create-food-brand-manage">@lang('app.employee-manage.update.male')
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-validate-checkbox col-lg-3">
                                                            <div class="checkbox-form-group">
                                                                <input type="radio" name="gender" value="0">
                                                                <label class="name-checkbox"
                                                                       for="print-kitchen-create-food-brand-manage">@lang('app.employee-manage.update.female')
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group select2_theme validate-group">
                                                    <div class="form-validate-select mt-3 ">
                                                        <div class="col-lg-12 mx-0 px-0">
                                                            <div class="col-lg-12 pr-0 select-material-box">
                                                                <select id="select-city-update-profile"
                                                                        class="js-example-basic-single select2-hidden-accessible"
                                                                        data-select="1" tabindex="-1"
                                                                        aria-hidden="true">
                                                                    <option value="-2" selected disabled
                                                                            hidden>@lang('app.component.option_default')</option>
                                                                </select>
                                                                <label class="icon-validate">
                                                                    @lang('app.employee-manage.update.city')
                                                                    @include('layouts.start')
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group select2_theme validate-group">
                                                    <div class="form-validate-select mt-3 ">
                                                        <div class="col-lg-12 mx-0 px-0">
                                                            <div class="col-lg-12 pr-0 select-material-box">
                                                                <select id="select-district-update-profile"
                                                                        class="js-example-basic-single select2-hidden-accessible"
                                                                        data-select="1" tabindex="-1"
                                                                        aria-hidden="true">
                                                                    <option value="-2" selected disabled
                                                                            hidden>@lang('app.component.option_default')</option>
                                                                </select>
                                                                <label class="icon-validate">
                                                                    @lang('app.employee-manage.update.district')
                                                                    @include('layouts.start')
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group select2_theme validate-group"
                                                     id="select-ward-profile">
                                                    <div class="form-validate-select mt-3 ">
                                                        <div class="col-lg-12 mx-0 px-0">
                                                            <div class="col-lg-12 pr-0 select-material-box">
                                                                <select id="select-ward-update-profile"
                                                                        class="js-example-basic-single select2-hidden-accessible"
                                                                        data-select="1" tabindex="-1"
                                                                        aria-hidden="true">
                                                                    <option value="-2" selected disabled
                                                                            hidden>@lang('app.component.option_default')</option>
                                                                </select>
                                                                <label class="icon-validate">
                                                                    @lang('app.employee-manage.update.ward')
                                                                    @include('layouts.start')
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-input mt-3 ">
                                                        <input type="text" id="address-label" class="form-control"
                                                               data-max-length="255" data-min-length="2" data-empty="1">
                                                        <label for="address-update-employee-manage">
                                                            {{--                                            @lang('app.employee-manage.update.address')--}}
                                                            @lang('app.employee-manage.update.street')
                                                            @include('layouts.start')
                                                        </label>
                                                    </div>
                                                    <div class="link-href"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-left-success-box b-l-warning">
                                        <div class="row mb-3">
                                            <div class="col-md-6 row align-items-center">
                                                <div
                                                        class="col-md-4 font-weight-bold col-form-label">@lang('app.profile.role')</div>
                                                <div
                                                        class="col-md-8">{{Session::get(SESSION_JAVA_ACCOUNT)['employee_role_name']}}</div>
                                            </div>
                                            @if(Session::get(SESSION_KEY_LEVEL) > 3)
                                                <div class="col-md-6 row align-items-center">
                                                    <div
                                                            class="ml-3 font-weight-bold col-form-label">@lang('app.profile.rank')</div>
                                                    <div class="col-md-8"></div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6 row align-items-center">
                                                <div
                                                        class="col-md-6 font-weight-bold col-form-label">@lang('app.profile.note-role')</div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            @if(Session::get(SESSION_KEY_LEVEL) > 3)
                                                <div class="col-md-6 row align-items-center">
                                                    <div
                                                            class="col-md-6 font-weight-bold col-form-label">@lang('app.profile.point')</div>
                                                    <div class="col-md-6"></div>
                                                </div>
                                            @endif
                                        </div>
                                        @if(Session::get(SESSION_KEY_LEVEL) > 3)
                                            <div class="row">
                                                <div class="col-md-6 row align-items-center">
                                                    <div
                                                            class="col-md-6 font-weight-bold col-form-label">@lang('app.profile.total-point')</div>
                                                    <div class="col-md-6"></div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <div class="btn seemt-orange seemt-btn-hover-orange seemt-bg-orange d-flex align-items-center mr-3"
                             onclick="openModalUpdatePassword()">
                            <i class="fi-rr-refresh"></i>
                            <span>@lang('app.profile.password-title')</span>
                        </div>
                        <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-flex align-items-center"
                             onclick="updateProfile()">
                            <i class="fi-rr-disk"></i>
                            <span>@lang('app.component.button.save')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('setting.profile.password')
@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript"
            src="/js/setting/profile/index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
