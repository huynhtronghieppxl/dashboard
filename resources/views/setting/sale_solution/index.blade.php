@extends('layouts.layout')
<style>
    .show-more-detail-procedure {
        text-transform: capitalize;
        margin-left: 10px;
        color: #fa6342;
        font-weight: 500;
        font-size: 12px !important;
        float: right;
    }
</style>
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row mt-2" id="restaurant-sale-solution-general-configuration">
                    <div class="col-lg-12">
                        <div class="cover-profile">
                            <div class="profile-bg-img bg-white-border box-image"
                                 style="background-color: white;">
                                <figure class="box-image-banner-branch" style="min-height: 180px">
                                    <div class="edit-pp ">
                                        <label class="fileContainer pointer">
                                            <i class="fa fa-camera"></i>
                                            <input type="file" id="upload-restaurant-banner-sale-solution">
                                        </label>
                                    </div>
                                    <img onerror="this.src='/images/tms/default.jpeg'"
                                         id="thumbnail-restaurant-banner-sale-solution"
                                         src="" alt="">

                                    <ul class="profile-controls">
                                        <li data-toggle="tooltip"
                                            data-placement="top"
                                            data-original-title="@lang('app.restaurant-setting.tab-info.title')">
                                            <a class="nav-link btn-p-0" data-type="0"
                                               href="#restaurant-sale-solution-setting-tab-info" role="tab"
                                               data-toggle="tab"
                                               onclick="activeTab($(this))"><i class="fi-rr-exclamation"></i></a>
                                        </li>
                                        <li data-toggle="tooltip"
                                            data-placement="top"
                                            data-original-title="@lang('app.restaurant-setting.tab-setting.title')">
                                            <a class="nav-link btn-p-0" data-type="1"
                                               href="#restaurant-sale-solution-setting-tab-setting" role="tab"
                                               data-toggle="tab"
                                               onclick="activeTab($(this))"><i class="fi-rr-settings"></i></a>
                                        </li>
                                        {{--                                        <li data-toggle="tooltip"--}}
                                        {{--                                            data-placement="top"--}}
                                        {{--                                            data-original-title="@lang('app.sweet_alert.button.save')">--}}
                                        {{--                                            <a class="btn-p-0 bg-primary d-none" style="cursor: pointer" onclick="saveUpdateInfoRestaurant()"--}}
                                        {{--                                               id="btn-save-update-restaurant-setting" ><i--}}
                                        {{--                                                    class="typcn typcn-download-outline"></i></a>--}}
                                        {{--                                        </li>--}}
                                    </ul>
                                </figure>
                                <div class="col-lg-12 profile-section" style="position: absolute; bottom: 20px">
                                    <div class="row">
                                        <div class="col-lg-2 col-sm-2">
                                            <div class="profile-branch">
                                                <div class="profile-branch-thumb">
                                                    <img onerror="this.src='/images/tms/default.jpeg'" alt="author"
                                                         id="thumbnail-restaurant-logo-sale-solution" data-src=""
                                                         src="">
                                                    <div class="edit-branch pointer">
                                                        <label class="fileContainer pointer">
                                                            <i class="fa fa-camera"></i>
                                                            <input type="file" class="d-none"
                                                                   id="upload-restaurant-logo-sale-solution"
                                                                   accept="image/*">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-sm-10">
                                            <div class="author-content row" style="min-width: max-content !important;">
                                                <a class="custom-name" id="restaurant-sale-solution-setting-name"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="tab-content p-0">
                            <div class="tab-pane active" id="restaurant-sale-solution-setting-tab-info"
                                 role="tabpanel" aria-expanded="true">
                                <div class="card card-block mt-2 bg-white-border">
                                    <div class="row">
                                        <div class="col-lg-6 text-left">
                                            <div class="sub-title">@lang('app.restaurant-setting.tab-info.title')</div>
                                        </div>
                                        <div class="col-lg-6 text-right d-flex justify-content-end">
                                            <div class="layout-index-button-new ml-2">
                                                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                                                     id="btn-save-update-restaurant-setting"
                                                     onclick="saveUpdateSettingRestaurant()">
                                                    <i class="fi-rr-disk" style="font-size: 17.5px;vertical-align: middle;"></i>
                                                    <span>Cập nhật</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-10">
                                        <div class="col-lg-6">
                                            <div class="form-group validate-group">
                                                <div class="form-validate-input">
                                                    <input type="text" id="name-update-restaurant-sale-solution-setting"
                                                           data-empty="1" data-min-length="2" data-spec="1"
                                                           data-max-length="50" disabled>
                                                    <label>
                                                        @lang('app.restaurant-setting.tab-info.name')
                                                        @include('layouts.start')
                                                    </label>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                            <div class="form-group validate-group">
                                                <div class="form-validate-input">
                                                    <input type="text"
                                                           id="address-update-restaurant-sale-solution-setting"
                                                           class="form-control"
                                                           data-max-length="255" data-min-length="2"
                                                           data-empty="1"
                                                    >
                                                    <label for="address-update-restaurant-sale-solution-setting">
                                                        Địa chỉ
                                                        @include('layouts.start')
                                                    </label>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                            <div class="form-group validate-group">
                                                <div class="form-validate-input">
                                                    <div class="line"></div>
                                                    <input type="text"
                                                           id="phone-update-restaurant-sale-solution-setting"
                                                           data-phone="1" data-empty="1">
                                                    <label>
                                                        Hotline
                                                        @include('layouts.start')
                                                    </label>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                            <div class="form-group validate-group">
                                                <div class="form-validate-input">
                                                    <input type="text"
                                                           id="email-update-restaurant-sale-solution-setting"
                                                           data-check="0" data-mail="1" data-max-length="255">
                                                    <label>
                                                        @lang('app.restaurant-setting.tab-info.email')
                                                    </label>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                            <div class="form-group validate-group">
                                                <div class="form-validate-input">
                                                    <input type="text"
                                                           id="website-update-restaurant-sale-solution-setting"
                                                           data-max-length="255" data-min-length="2">
                                                    <label>
                                                        @lang('app.restaurant-setting.tab-info.website')
                                                    </label>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group validate-group">
                                                <div class="form-validate-textarea">
                                                    <div class="form__group pt-2">
                                                    <textarea cols="5" rows="12" data-note-max-length="300"
                                                              id="info-update-restaurant-sale-solution-setting"
                                                              data-check="0"></textarea>
                                                        <label for="info-update-restaurant-sale-solution-setting">
                                                            @lang('app.restaurant-setting.tab-info.info')
                                                        </label>
                                                        <div class="textarea-character" id="char-count">
                                                            <span>0/300</span>
                                                        </div>
                                                        <div class="line"></div>
                                                    </div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="restaurant-sale-solution-setting-tab-setting"
                                 role="tabpanel">
                                <div class="card card-block mt-2 bg-white-border pb-4">
                                    <div class="row">
                                        <div class="col-lg-6 text-left">
                                            <div
                                                    class="sub-title">@lang('app.restaurant-setting.tab-setting.title')</div>
                                        </div>
                                        <div class="col-lg-6 text-right d-flex justify-content-end">
                                            <div class="layout-index-button-new ml-2">
                                                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                                                     id="btn-save-update-restaurant-setting"
                                                     onclick="saveUpdateSettingRestaurant()">
                                                    <i class="fi-rr-disk" style="font-size: 17.5px;vertical-align: middle;"></i>
                                                    <span>Cập nhật</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-10">
                                        <div class="col-lg-6 form-group validate-group">
                                            <div class="form-validate-input">
                                                <input
                                                        class="form-control border-0 border-right text-left input-tooltip"
                                                        id="username-prefix-sale-solution"
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
                                                <div class="line"></div>
                                                <div class="tool-tip">
                                                    <i class="fi-rr-exclamation text-inverse pointer"
                                                       data-toggle="tooltip" data-placement="top"
                                                       data-original-title="@lang('app.restaurant-setting.tab-setting.exp-prefix')"></i>
                                                </div>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                        <div class="col-sm-6 form-group validate-group">
                                            <div class="form-validate-input">
                                                <input id="hour-to-take-report-sale-solution"
                                                       class="input-sm form-control border-0 p-1" data-spec="1"
                                                       value="15" data-empty="1">
                                                <label>
                                                    Khung giờ chốt báo cáo
                                                    @include('layouts.start')
                                                </label>
                                                <div class="line"></div>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 form-group validate-group">
                                            <div class="form-validate-input">
                                                <input type="text"
                                                       class="form-control border-0 text-right border-right input-tooltip"
                                                       id="number-minute-allow-booking-sale-solution" value="30"
                                                       data-empty="1"
                                                       data-min="30"
                                                       data-max="1440"
                                                       data-type="currency-edit" data-tooltip="1" data-check="30">
                                                <label>
                                                    @lang('app.restaurant-setting.tab-setting.booking')
                                                    (@lang('app.sweet_alert.unit.minute'))
                                                    @include('layouts.start')</label>
                                                <div class="line"></div>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <a class="col-lg-12 font-weight-bold py-2">Thời gian hoạt động</a>
                                        <div class="col-lg-5">
                                            <div id="form-radio-check-day-of-week-sale-solution">
                                                <div class="radio radio-inline">
                                                    <div class="checkbox-form-group">
                                                        <input type="radio"
                                                               name="dayOfWeek"
                                                               value="-1">
                                                        <label class="name-checkbox">
                                                            @lang('app.branch-setting.update.tabs.service-info-tab.all-week')
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <div class="checkbox-form-group">
                                                        <input type="radio"
                                                               name="dayOfWeek"
                                                               value="0">
                                                        <label class="name-checkbox">
                                                            @lang('app.branch-setting.update.tabs.service-info-tab.chose-date')
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-lg-12 px-0" id="day-of-week-update-branch-setting">
                                            <label class="input-group m-auto col-4"
                                                   id="select-all-week-update-branch-sale-solution-setting"
                                                   style="margin-left: 0!important; margin-top: 10px!important">
                                                <div class="input-group border-group">
                                                    <input type="text" id="" placeholder="Giờ bắt đầu"
                                                           class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-open-of-day start-time-date-time-picker"
                                                           value="00:00">
                                                    <span
                                                            class="input-group-addon custom-find">@lang('app.component.button.to')</span>
                                                    <input type="text" id="" placeholder="Giờ kết thúc"
                                                           class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-close-of-day time-out-date-time-picker"
                                                           value="23:59">
                                                </div>
                                            </label>
                                            <div class="col-lg-12 d-none px-0"
                                                 id="select-date-update-branch-sale-solution-setting">
                                                <div class="row">
                                                    <div class="col-lg-3 px-0">
                                                        <div class="row parent-node">
                                                            <div class="col-lg-12 form-group pt-4 validate-group"
                                                                 style="margin-bottom: 10px!important">
                                                                <div class="checkbox-form-group">
                                                                    <input type="checkbox" value="0"
                                                                           required="">
                                                                    <label class="name-checkbox"
                                                                           for="print-kitchen-create-food-brand-manage">
                                                                        @lang('app.branch-setting.setting.monday')
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 m-auto d-none">
                                                                <label class="input-group">
                                                                    <div class="input-group border-group">
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-open-of-day start-time-date-time-picker"
                                                                               value="00:00">
                                                                        <span
                                                                                class="input-group-addon custom-find">@lang('app.component.button.to')</span>
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-close-of-day time-out-date-time-picker"
                                                                               value="23:59">
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 px-0">
                                                        <div class="row parent-node">
                                                            <div class="form-group col-lg-12 pt-4 validate-group"
                                                                 style="margin-bottom: 10px!important">
                                                                <div class="checkbox-form-group">
                                                                    <input type="checkbox" value="1"
                                                                           required="">
                                                                    <label class="name-checkbox"
                                                                           for="print-kitchen-create-food-brand-manage">
                                                                        @lang('app.branch-setting.setting.tuesday')
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 m-auto d-none">
                                                                <label class="input-group">
                                                                    <div class="input-group border-group">
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-open-of-day start-time-date-time-picker"
                                                                               value="00:00">
                                                                        <span
                                                                                class="input-group-addon custom-find">@lang('app.component.button.to')</span>
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-close-of-day time-out-date-time-picker"
                                                                               value="23:59">
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 px-0">
                                                        <div class="row parent-node">
                                                            <div class="col-lg-12 form-group pt-4 validate-group"
                                                                 style="margin-bottom: 10px!important">
                                                                <div class="checkbox-form-group">
                                                                    <input type="checkbox" value="2"
                                                                           required="">
                                                                    <label class="name-checkbox"
                                                                           for="print-kitchen-create-food-brand-manage">
                                                                        @lang('app.branch-setting.setting.wednesday')
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 m-auto d-none">
                                                                <label class="input-group">
                                                                    <div class="input-group border-group">
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-open-of-day start-time-date-time-picker"
                                                                               value="00:00">
                                                                        <span
                                                                                class="input-group-addon custom-find">@lang('app.component.button.to')</span>
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-close-of-day time-out-date-time-picker"
                                                                               value="23:59">
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 px-0">
                                                        <div class="row parent-node">
                                                            <div class="col-lg-12 form-group pt-4 validate-group"
                                                                 style="margin-bottom: 10px!important">
                                                                <div class="checkbox-form-group">
                                                                    <input type="checkbox" value="3"
                                                                           required="">
                                                                    <label class="name-checkbox"
                                                                           for="print-kitchen-create-food-brand-manage">
                                                                        @lang('app.branch-setting.setting.thursday')
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 m-auto d-none">
                                                                <label class="input-group">
                                                                    <div class="input-group border-group">
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-open-of-day start-time-date-time-picker"
                                                                               value="00:00">
                                                                        <span
                                                                                class="input-group-addon custom-find">@lang('app.component.button.to')</span>
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-close-of-day time-out-date-time-picker"
                                                                               value="23:59">
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 px-0">
                                                        <div class="row parent-node">
                                                            <div class="col-lg-12 form-group pt-4 validate-group"
                                                                 style="margin-bottom: 10px!important">
                                                                <div class="checkbox-form-group">
                                                                    <input type="checkbox" value="4"
                                                                           required="">
                                                                    <label class="name-checkbox"
                                                                           for="print-kitchen-create-food-brand-manage">
                                                                        @lang('app.branch-setting.setting.friday')
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 m-auto d-none">
                                                                <label class="input-group">
                                                                    <div class="input-group border-group">
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-open-of-day start-time-date-time-picker"
                                                                               value="00:00">
                                                                        <span
                                                                                class="input-group-addon custom-find">@lang('app.component.button.to')</span>
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-close-of-day time-out-date-time-picker"
                                                                               value="23:59">
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 px-0">
                                                        <div class="row parent-node">
                                                            <div class="col-lg-12 form-group pt-4 validate-group"
                                                                 style="margin-bottom: 10px!important">
                                                                <div class="checkbox-form-group">
                                                                    <input type="checkbox" value="5"
                                                                           required="">
                                                                    <label class="name-checkbox"
                                                                           for="print-kitchen-create-food-brand-manage">
                                                                        @lang('app.branch-setting.setting.saturday')
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 m-auto d-none">
                                                                <label class="input-group">
                                                                    <div class="input-group border-group">
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-open-of-day start-time-date-time-picker"
                                                                               value="00:00">
                                                                        <span
                                                                                class="input-group-addon custom-find">@lang('app.component.button.to')</span>
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-close-of-day time-out-date-time-picker"
                                                                               value="23:59">
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 px-0">
                                                        <div class="row parent-node">
                                                            <div class="col-lg-12 form-group pt-4 validate-group"
                                                                 style="margin-bottom: 10px!important">
                                                                <div class="checkbox-form-group">
                                                                    <input type="checkbox" value="6"
                                                                           required="">
                                                                    <label class="name-checkbox"
                                                                           for="print-kitchen-create-food-brand-manage">
                                                                        @lang('app.branch-setting.setting.sunday')
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 m-auto d-none">
                                                                <label class="input-group">
                                                                    <div class="input-group border-group">
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-open-of-day start-time-date-time-picker"
                                                                               value="00:00">
                                                                        <span
                                                                                class="input-group-addon custom-find">@lang('app.component.button.to')</span>
                                                                        <input type="text" id=""
                                                                               class="input-sm form-control text-center input-datetimepicker p-1 custom-form-search time-close-of-day time-out-date-time-picker"
                                                                               value="23:59">
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card box-shadow-div">
                                    <h2 class="sub-title">Thiết lập chung</h2>
                                    <div class="row setting-form-group m-t-20">
                                        <div class="form-group col-sm-6 validate-group">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" value=""
                                                       id="enable-booking-sale-solution" data-tooltip="1"
                                                       data-original-title="@lang('app.setting.setting-brand.exp-put-table')"
                                                       required="">

                                                <label class="name-checkbox">
                                                    @lang('app.setting.setting-brand.put-table')
                                                </label>
                                                <div class="tool-tip">
                                                    <i class="fi-rr-exclamation text-inverse pointer"
                                                       data-toggle="tooltip" data-placement="top"
                                                       data-original-title="@lang('app.setting.setting-brand.exp-put-table')"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6 validate-group">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" value="" id="hidden-amount-sale-solution"
                                                       data-tooltip="1"
                                                       data-original-title="@lang('app.setting.setting-brand.exp-hide-total-amount')"
                                                       required="">

                                                <label class="name-checkbox">
                                                    @lang('app.setting.setting-brand.hide-total-amount')
                                                </label>
                                                <div class="tool-tip">
                                                    <i class="fi-rr-exclamation text-inverse pointer"
                                                       data-toggle="tooltip" data-placement="top"
                                                       data-original-title="@lang('app.setting.setting-brand.exp-hide-total-amount')"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card box-shadow-div">
                                    <h2 class="sub-title">@lang('app.setting.setting-brand.bill')</h2>
                                    <div class="row setting-form-group m-t-20">
{{--                                        <div class="form-group col-sm-4 validate-group">--}}
{{--                                            <div class="checkbox-form-group">--}}
{{--                                                <input type="checkbox" value=""--}}
{{--                                                       id="temporary-bill-sale-solution" data-tooltip="1"--}}
{{--                                                       data-original-title="@lang('app.setting.setting-brand.exp-temp-bill')"--}}
{{--                                                       required="">--}}

{{--                                                <label class="name-checkbox">--}}
{{--                                                    @lang('app.setting.setting-brand.temp-bill')--}}
{{--                                                </label>--}}
{{--                                                <div class="tool-tip">--}}
{{--                                                    <i class="fi-rr-exclamation text-inverse pointer"--}}
{{--                                                       data-toggle="tooltip" data-placement="top"--}}
{{--                                                       data-original-title="@lang('app.setting.setting-brand.exp-temp-bill')"></i>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="form-group col-sm-6 validate-group">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" value="" id="logo-bill-sale-solution"
                                                       data-tooltip="1"
                                                       data-original-title="@lang('app.setting.setting-brand.exp-bill-logo')"
                                                       required="">

                                                <label class="name-checkbox">
                                                    @lang('app.setting.setting-brand.bill-logo')
                                                </label>
                                                <div class="tool-tip">
                                                    <i class="fi-rr-exclamation text-inverse pointer"
                                                       data-toggle="tooltip" data-placement="top"
                                                       data-original-title="@lang('app.setting.setting-brand.exp-bill-logo')"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-4 validate-group">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" value=""
                                                       id="stamp-sprint-sale-solution"
                                                       required="">
                                                <label for="stamp-sprint-sale-solution" class="name-checkbox">
                                                    In Stamp
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row setting-form-group">
                                        <div class="form-group col-sm-6 validate-group">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" value=""
                                                       id="wifi-free"
                                                       required="">
                                                <label class="name-checkbox">
                                                    In Wifi trên bill
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6 validate-group">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" value=""
                                                       id="print-lake-seafood-sale-solution" data-tooltip="1"
                                                       data-original-title="@lang('app.setting.setting-brand.exp-bill-logo')"
                                                       required="">
                                                <label class="name-checkbox">
                                                    In hồ hải sản
                                                </label>
                                                <div class="tool-tip">
                                                    <i class="fi-rr-exclamation text-inverse pointer"
                                                       data-toggle="tooltip" data-placement="top"
                                                       data-original-title="@lang('app.setting.setting-brand.exp-bill-logo')"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-10 wifi d-none">
                                        <div class="col-lg-6 form-group validate-group">
                                            <div class="form-validate-input">
                                                <input class="form-control border-0 input-tooltip"
                                                       id="wifi-name-sale-solution"
{{--                                                       data-min-length="2"--}}
{{--                                                       data-max-length="4"--}}
                                                       data-tooltip="1"
                                                       data-empty="1">
                                                <label>
                                                    tên wifi
                                                    @include('layouts.start')
                                                </label>
                                                <div class="line"></div>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                        <div class="col-sm-6 form-group validate-group">
                                            <div class="form-validate-input">
                                                <input class="input-sm form-control border-0 p-1" data-spec="1" data-min-length="8"
                                                      id="password-wifi-sale-solution" data-max-length="20" data-empty="1">
                                                <label>
                                                    mật khẩu wifi
                                                    @include('layouts.start')
                                                </label>
                                                <div class="line"></div>
                                            </div>
                                            <div class="link-href"></div>
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
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\setting\sale_solution\index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
