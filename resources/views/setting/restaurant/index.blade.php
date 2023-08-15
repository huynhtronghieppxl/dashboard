@extends('layouts.layout')
@section('content')
    <style>
        #restaurant-setting-tab-setting input[type=checkbox] {
            height: 20px !important;
        }

        .star {
            margin: auto;
        }

        .number-level-setting-branch {
            margin-left: 5px;
        }
    </style>
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row mt-2" id="restaurant-general-configuration">
                    <div class="col-lg-12">
                        <div class="cover-profile">
                            <div class="profile-bg-img bg-white-border box-image" id="branch-cover-image"
                                 style="background-color: white;">
                                <figure class="box-image-banner-branch" style="min-height: 180px">
                                    <div class="edit-pp ">
                                        <label class="fileContainer pointer">
                                            <i class="fa fa-camera"></i>
                                            <input type="file" id="upload-restaurant-banner">
                                        </label>
                                    </div>
                                    <img onerror="this.src='/images/tms/default_background.jpeg'" id="thumbnail-restaurant-banner"
                                         src="" alt="">
                                    <div class="row">
                                        <ol class="pit-rate-setting-branch" onclick="openDetailSettingBranch()">
                                            <li class="star"><i class="fa fa-star"></i></li>
                                            <li class="star"><i class="fa fa-star"></i></li>
                                            <li class="star"><i class="fa fa-star"></i></li>
                                            <li class="star"><i class="fa fa-star"></i></li>
                                            <li class="star"><i class="fa fa-star"></i></li>
                                            <li class="star"><i class="fa fa-star"></i></li>
                                            <li class="star"><i class="fa fa-star"></i></li>
                                            <li class="star"><i class="fa fa-star"></i></li>
                                            <li class="star"><i class="fa fa-star"></i></li>
                                            <li class="number-level-setting-branch"><span
                                                        class="title-review-setting-branch seemt-orange">@lang('app.restaurant-setting.tab-info.level') </span>
                                                <span
                                                        id="level-restaurant" class="seemt-orange"></span></li>
                                        </ol>
                                    </div>
                                    <ul class="profile-controls">
                                        <li data-toggle="tooltip"
                                            data-placement="top"
                                            data-original-title="@lang('app.restaurant-setting.tab-info.title')">
                                            <a class="nav-link btn-p-0" data-type="0"
                                               href="#restaurant-setting-tab-info" role="tab"
                                               data-toggle="tab"
                                               onclick="activeTab($(this))"><i class="fi-rr-home"></i></a>
                                        </li>
                                        <li data-toggle="tooltip"
                                            data-placement="top"
                                            data-original-title="@lang('app.restaurant-setting.tab-setting.title')">
                                            <a class="nav-link btn-p-0" data-type="1"
                                               href="#restaurant-setting-tab-setting" role="tab"
                                               data-toggle="tab"
                                               onclick="activeTab($(this))"><i class="fi-rr-settings"></i></a>
                                        </li>
                                    </ul>
                                </figure>
                                <div class="col-lg-12 profile-section" style="position: absolute; bottom: 20px">
                                    <div class="row">
                                        <div class="col-lg-2 col-sm-2">
                                            <div class="profile-branch">
                                                <div class="profile-branch-thumb">
                                                    <img onerror="this.src='/images/tms/default.jpeg'" alt="author"
                                                         id="thumbnail-restaurant-logo" data-src=""
                                                         src="">
                                                    <div class="edit-branch pointer">
                                                        <label class="fileContainer pointer">
                                                            <i class="fa fa-camera"></i>
                                                            <input type="file" class="d-none"
                                                                   id="upload-restaurant-logo" accept="image/*">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-sm-10">
                                            <div class="author-content row" style="min-width: max-content !important;background-color: rgba(255, 255, 255, 0.8)">
                                                <a class="custom-name" id="restaurant-setting-name"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="tab-content p-0">
                            <div class="tab-pane active" id="restaurant-setting-tab-info"
                                 role="tabpanel" aria-expanded="true">
                                <div class="card card-block mt-2 bg-white-border">
                                    <div class="row">
                                        <div class="col-lg-6 text-left">
                                            <div class="sub-title">@lang('app.restaurant-setting.tab-info.title')</div>
                                        </div>
                                        <div class="col-lg-6 text-right d-flex justify-content-end">
                                            <div class="layout-index-button-new ml-2">
                                                <button class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                                                     id="save-update-info-restaurant"
                                                     onclick="saveUpdateInfoRestaurant()">
                                                    <i class="fi-rr-disk"
                                                       style="font-size: 17.5px;vertical-align: middle;"></i>
                                                    <span>Cập nhật (F4)</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-10">
                                        <div class="col-lg-6">
                                            <div class="form-group validate-group">
                                                <div class="form-validate-input">
                                                    <input type="text" id="name-update-restaurant-setting"
                                                           data-empty="1" data-min-length="2" data-spec="1"
                                                           data-max-length="50" disabled style="cursor: not-allowed">
                                                    <label>
                                                        <div class="hide-long-text">
                                                            @lang('app.restaurant-setting.tab-info.name')
                                                        </div>
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                            <div class="form-group validate-group">
                                                <div class="form-validate-input">
                                                    <input type="text"
                                                           id="phone-update-restaurant-setting"
                                                           data-phone="1" data-empty="1">
                                                    <label>
                                                        Hotline
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                            <div class="form-group validate-group">
                                                <div class="form-validate-input">
                                                    <input type="text" id="email-update-restaurant-setting"
                                                           data-check="0" data-mail="1" data-max-length="255">
                                                    <label>
                                                        <div class="hide-long-text">
                                                            @lang('app.restaurant-setting.tab-info.email')
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                            <div class="form-group validate-group">
                                                <div class="form-validate-input">
                                                    <input type="text" id="website-update-restaurant-setting"
                                                           data-max-length="255" data-check="0">
                                                    <label>
                                                        <div class="hide-long-text">
                                                            @lang('app.restaurant-setting.tab-info.website')
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                            <div class="form-group validate-group">
                                                <div class="form-validate-input">
                                                    <input type="text" id="address-update-restaurant-setting"
                                                           data-check="0">
                                                    <label>
                                                        <div class="hide-long-text">
                                                            Địa chỉ
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-validate-textarea">
                                                <div class="form__group pt-2">
                                                    <textarea cols="6" rows="11" id="info-update-restaurant-setting"
                                                              data-check="0"></textarea>
                                                    <label for="info-update-restaurant-setting"
                                                           class="form__label icon-validate">
                                                        <div class="hide-long-text">
                                                            @lang('app.restaurant-setting.tab-info.info')
                                                        </div>
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
                            <div class="tab-pane" id="restaurant-setting-tab-setting"
                                 role="tabpanel">
                                <div class="card card-block mt-2 bg-white-border"
                                     style=" min-height: calc(100vh - 440px)">
                                    <div class="row mb-2">
                                        <div class="col-lg-6 text-left">
                                            <div
                                                    class="sub-title">@lang('app.restaurant-setting.tab-setting.title')</div>
                                        </div>
                                        <div class="col-lg-6 text-right d-flex justify-content-end">
                                            <div class="layout-index-button-new ml-2">
                                                <button class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                                                     id="btn-save-update-restaurant-setting"
                                                     onclick="saveUpdateSettingRestaurant()">
                                                    <i class="fi-rr-disk"
                                                       style="font-size: 17.5px;vertical-align: middle;"></i>
                                                    <span>Cập nhật (F4)</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 form-group validate-group">
                                            <div class="form-validate-input">
                                                <input class="form-control border-0 input-tooltip" id="username-prefix"
                                                       data-min-length="2"
                                                       data-max-length="4"
                                                       data-empty="1"
                                                       data-spec="1">
                                                <label>
                                                    <div class="hide-long-text">
                                                        @lang('app.restaurant-setting.tab-setting.prefix')
                                                    </div>
                                                    @include('layouts.start')
                                                </label>
                                                <div class="tool-tip">
                                                    <i class="fi-rr-exclamation text-inverse pointer"
                                                       data-toggle="tooltip"
                                                       data-placement="top"
                                                       data-original-title="@lang('app.restaurant-setting.tab-setting.exp-prefix')">
                                                    </i>
                                                </div>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                        @if(Session::get(SESSION_KEY_LEVEL) >= 5)
                                            <div class="col-lg-8 row px-0">
                                                <div class="col-lg-6 form-group validate-group">
                                                    <div class="form-validate-input">
                                                        <input
                                                                class="form-control border-0 border-right text-right input-tooltip"
                                                                id="point_invite_customer"
                                                                data-min="0"
                                                                data-max="999999"
                                                                data-empty="1"
                                                                data-tooltip="1"
                                                                data-type="currency-edit" data-check="1">
                                                        <label>
                                                            <div class="hide-long-text">
                                                                @lang('app.restaurant-setting.tab-setting.point')
                                                            </div>
                                                            @include('layouts.start')
                                                        </label>
                                                        <div class="tool-tip"><i
                                                                    class="fi-rr-exclamation text-inverse pointer"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    data-original-title="@lang('app.restaurant-setting.tab-setting.exp-point')"></i>
                                                        </div>
                                                        <div class="tool-tip">
                                                            <i class="fi-rr-exclamation text-inverse pointer"
                                                               data-toggle="tooltip" data-placement="top"
                                                               data-original-title="@lang('app.restaurant-setting.tab-setting.exp-point-to-money')"></i>
                                                        </div>
                                                    </div>
                                                    <div class="link-href"></div>
                                                </div>
                                                <div class="col-lg-6 form-group validate-group">
                                                    <div class="form-validate-input">
                                                        <input
                                                                class="form-control border-0 border-right text-right input-tooltip"
                                                                id="point_to_money"
                                                                data-empty="1" data-min="100"
                                                                data-max="999999999"
                                                                data-money="1" value="100" data-tooltip="1"
                                                                data-type="currency-edit"
                                                                data-check="0">
                                                        <label>
                                                            <div class="hide-long-text">
                                                                @lang('app.restaurant-setting.tab-setting.point-to-money')
                                                                (@lang('app.sweet_alert.unit.vnd'))
                                                            </div>
                                                            @include('layouts.start')
                                                        </label>
                                                        <div class="tool-tip">
                                                            <i class="fi-rr-exclamation text-inverse pointer"
                                                               data-toggle="tooltip" data-placement="top"
                                                               data-original-title="@lang('app.restaurant-setting.tab-setting.exp-point-to-money')"></i>
                                                        </div>
                                                    </div>
                                                    <div class="link-href"></div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-lg-4 form-group validate-group d-none">
                                            <div class="form-validate-input">
                                                <input type="text"
                                                       class="form-control border-0 border-right text-right input-tooltip"
                                                       id="alo-point-allow-use-in-each-bill"
                                                       data-empty="1"
                                                       data-percent="1" value="0" data-tooltip="1"
                                                       data-type="currency-edit" data-check="1">
                                                <label>
                                                    <div class="hide-long-text">
                                                        @lang('app.restaurant-setting.tab-setting.maximum-alo-use')
                                                        @lang('app.sweet_alert.unit.percent')
                                                    </div>
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                        <div class="col-lg-4 form-group validate-group">
                                            <div class="form-validate-input">
                                                <input type="text"
                                                       class="form-control border-0 text-right border-right input-tooltip"
                                                       id="number-minute-allow-booking-before-open-order" value="30"
                                                       data-empty="1"
                                                       data-min="30"
                                                       data-max="1440"
                                                       data-type="currency-edit" data-tooltip="1" data-check="30">
                                                <label>
                                                    <div class="hide-long-text">
                                                        @lang('app.restaurant-setting.tab-setting.booking')
                                                        (@lang('app.sweet_alert.unit.minute'))
                                                    </div>
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                        @if(Session::get(SESSION_KEY_LEVEL) >= 5)
                                            <div class="col-lg-4 form-group validate-group">
                                                <div class="form-validate-input">
                                                    <input type="text"
                                                           class="form-control border-0 border-right text-right input-tooltip"
                                                           id="minute-after-register-member-ship-card-allow-to-use-promotion-point"
                                                           data-number="1"
                                                           value="1"
                                                           data-empty="1"
                                                           data-check="1"
                                                           data-max="24"
                                                           data-min="0"
                                                           data-spec="1"
                                                           data-tooltip="1"
                                                    >
                                                    <label>
                                                        <div class="hide-long-text">
                                                            @lang('app.restaurant-setting.tab-setting.time-membership-card')
                                                            (@lang('app.sweet_alert.unit.hour'))
                                                        </div>
                                                        @include('layouts.start')
                                                    </label>
                                                    <div class="tool-tip">
                                                        <i class="fi-rr-exclamation text-inverse pointer"
                                                           data-toggle="tooltip" data-placement="top"
                                                           data-original-title="Sau 1 giờ kể từ lúc đăng ký thì thẻ thành viên mới có giá trị sử dụng"></i>
                                                    </div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                        @endif
                                        @if(Session::get(SESSION_KEY_LEVEL) >= 2)
                                            <div class="col-lg-4 form-group validate-group">
                                                <div class="form-validate-input">
                                                    <input
                                                            class="form-control border-right text-right input-tooltip"
                                                            id="lat-brand" data-type="currency-edit"
                                                            data-empty="1"
                                                            data-tooltip="1" data-float="1" data-check="0">
                                                    <label>
                                                        <div class="hide-long-text">
                                                            @lang('app.setting.setting-employees.lat')
                                                            (@lang('app.sweet_alert.unit.meters'))
                                                        </div>
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                        @endif

                                        @if(Session::get(SESSION_KEY_LEVEL) >= 2)
                                            <div class="col-lg-4 form-group validate-group">
                                                <div class="form-validate-input ">
                                                    <input
                                                            class="form-control border-0 border-right text-right input-tooltip"
                                                            id="number_month_leave_day" data-type="currency-edit"
                                                            data-empy="1"
                                                            data-min="0"
                                                            data-max="31"
                                                            data-number="1" data-tooltip="1" data-check="1">
                                                    <label>
                                                        <div class="hide-long-text">
                                                            @lang('app.restaurant-setting.tab-setting.leave-day')
                                                            (@lang('app.sweet_alert.unit.month'))
                                                        </div>
                                                        @include('layouts.start')
                                                    </label>
                                                    <div class="tool-tip">
                                                        <i class="fi-rr-exclamation text-inverse pointer"
                                                           data-toggle="tooltip" data-placement="top"
                                                           data-original-title=" @lang('app.restaurant-setting.tab-setting.leave-day-tool-tip')"></i>
                                                    </div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="row">
                                        @if(Session::get(SESSION_KEY_LEVEL) >= 5)
                                            <div class="form-group col-lg-4 validate-group">
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="checkbox" id="is-share-customer-on-app-aloline"
                                                               checked="" class="input-tooltip" required=""
                                                               data-check="1">
                                                        <label class="name-checkbox"
                                                               for="is-share-customer-on-app-aloline">
                                                            @lang('app.restaurant-setting.tab-setting.share')
                                                        </label>
                                                        <div class="tool-tip"><i
                                                                    class="fi-rr-exclamation text-inverse pointer"
                                                                    data-toggle="tooltip"
                                                                    data-placement="top"
                                                                    data-original-title="@lang('app.restaurant-setting.tab-setting.exp-share')"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-4 validate-group">
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="checkbox" id="is_enable_membership_card"
                                                               checked="" class="input-tooltip" required=""
                                                               data-check="1">
                                                        <label class="name-checkbox"
                                                               for="is_enable_membership_card">
                                                            @lang('app.restaurant-setting.tab-setting.member-ship-card')
                                                        </label>
                                                        <div class="tool-tip"><i
                                                                    class="fi-rr-exclamation text-inverse pointer"
                                                                    data-toggle="tooltip"
                                                                    data-placement="top"
                                                                    data-original-title="@lang('app.restaurant-setting.tab-setting.exp-member-ship-card')"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if(Session::get(SESSION_KEY_LEVEL) >= 3)
                                            <div class="form-group col-lg-4 validate-group">
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="checkbox" id="is-enable-kai-zen-bonus-level"
                                                               checked=""
                                                               class="input-tooltip" required=""
                                                               data-check="1">
                                                        <label class="name-checkbox"
                                                               for="is-enable-kai-zen-bonus-level">
                                                            @lang('app.restaurant-setting.tab-setting.kaizen-bonus')
                                                        </label>
                                                        <div class="tool-tip"><i
                                                                    class="fi-rr-exclamation text-inverse pointer"
                                                                    data-toggle="tooltip"
                                                                    data-placement="top"
                                                                    data-original-title="@lang('app.restaurant-setting.tab-setting.exp-kaizen-bonus')"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if(Session::get(SESSION_KEY_LEVEL) >= 2)
                                            <div class="col-lg-4 py-2 mb-0">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="checkbox"
                                                                   id="is-quit-job-setting-restaurant"
                                                                   checked=""
                                                                   data-tooltip="1" class="input-tooltip"
                                                                   required=""
                                                                   data-check="1">
                                                            <label class="name-checkbox"
                                                                   for="is-quit-job-setting-restaurant">
                                                                @lang('app.restaurant-setting.tab-setting.quit-job')
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" form-group validate-group d-none"
                                                     id="setting-quit-job-setting-restaurant">
                                                    <div class="form-validate-input">
                                                        <input
                                                                class="form-control border-0 border-right text-right input-tooltip "
                                                                id="quit-job-setting-restaurant"
                                                                data-type="currency-edit"
                                                                data-min="1"
                                                                data-max="365"
                                                                data-empty="1"
                                                                data-check="2">
                                                        <label>
                                                            <div class="hide-long-text">
                                                                @lang('app.restaurant-setting.tab-setting.quit-job')
                                                                (@lang('app.sweet_alert.unit.day'))
                                                            </div>
                                                            @include('layouts.start')
                                                        </label>
                                                        <div class="tool-tip"><i
                                                                    class="fi-rr-exclamation text-inverse pointer"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    data-original-title="@lang('app.restaurant-setting.tab-setting.exp-quit-job')"></i>
                                                        </div>
                                                    </div>
                                                    <div class="link-href"></div>

                                                </div>
                                            </div>
                                            <div class="col-lg-4 py-2 mb-0">
                                                <div class="form-group validate-group">
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="checkbox"
                                                                   id="is-lock-checkin-setting-restaurant"
                                                                   data-type="currency-edit" data-check="0">
                                                            <label class="name-checkbox"
                                                                   for="is-lock-checkin-setting-restaurant">
                                                                @lang('app.restaurant-setting.tab-setting.lock-checkin')
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group validate-group d-none"
                                                     id="setting-lock-checkin-setting-restaurant">
                                                    <div class="form-validate-input">
                                                        <input
                                                                class="form-control border-0 border-right text-right input-tooltip"
                                                                id="number_day_not_checkin"
                                                                data-check="1"
                                                                data-min="1"
                                                                data-max="365"
                                                                data-tooltip="1"
                                                                data-empty="1">
                                                        <label>
                                                            <div class="hide-long-text">
                                                                @lang('app.restaurant-setting.tab-setting.not-checkin')
                                                                @lang('app.sweet_alert.unit.day')
                                                            </div>
                                                            @include('layouts.start')
                                                        </label>
                                                        <div class="tool-tip"><i
                                                                    class="fi-rr-exclamation text-inverse pointer"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    data-original-title="@lang('app.restaurant-setting.tab-setting.exp-not-checkin')"></i>
                                                        </div>
                                                    </div>
                                                    <div class="link-href"></div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('setting.restaurant.setting')
    @include('setting.restaurant.detail')
@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript"
            src="{{ asset('js\setting\restaurant\index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
