<div class="card card-block" id="branch-info-setting-on">
    <div class="row text-right d-flex justify-content-end">
        <div class="col-lg-6 text-left">
            <h2 class="sub-title">Thông tin chi nhánh</h2>
        </div>
        <div class="col-lg-6">
            <div class="layout-index-button-new mr-3 mb-3">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="updateInfoBranchSetting()">
                    <i class="fi-rr-disk"></i>
                    <span>Cập nhật (F4)</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group validate-group">
                <div class="form-validate-input ">
                    <input class="class-branch-on" type="text" id="name-update-branch-setting"
                           data-empty="1"
                           data-max-length="50" disabled>
                    <label for="name-update-branch-setting">
                        <div class="hide-long-text">
                            @lang('app.branch-setting.update.tabs.res-info-tab.name-branch')
                        </div>
                        @include('layouts.start')
                    </label>
                    <div class="line"></div>
                </div>
                <div class="link-href"></div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group validate-group">
                <div class="form-validate-input">
                    <input class="class-branch-on" type="text" id="phone-update-branch-setting" autocomplete="off"
                           data-phone="1" data-empty="1">
                    <label for="phone-update-branch-setting">
                        <div class="hide-long-text">
                            @lang('app.branch-setting.update.tabs.res-info-tab.phone-branch')
                        </div>
                        @include('layouts.start')
                    </label>
                    <div class="line"></div>
                </div>
                <div class="link-href"></div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group validate-group">
                <div class="form-validate-input">
                    <input class="class-branch-on" type="text"
                           id="branch-avg-amount-customer-update-branch-setting" data-type="currency-edit"
                           data-money="1" value="0" data-min="100" data-max="999999999"
                           data-empty="1">
                    <label for="branch-avg-amount-customer-update-branch-setting">
                        <div class="hide-long-text">
                            @lang('app.branch-setting.update.tabs.res-info-tab.avg-amount-customer-branch')
                        </div>
                        @include('layouts.start')
                    </label>
                    <div class="line"></div>
                </div>
                <div class="link-href"></div>
            </div>
        </div>
        <div class="col-sm-4 form-group select2_theme validate-group">
            <div class="form-validate-select ">
                <div class="col-lg-12 mx-0 px-0">
                    <div class="col-lg-12 pr-0 select-material-box">
                        <select class="js-example-basic-single select2-hidden-accessible"
                                data-select="1"
                                id="select-city-update-branch-setting">
                            <option value="-2" selected disabled
                                    hidden>@lang('app.component.option_default')</option>
                        </select>
                        <label class="icon-validate d-flex">
                            <div class="hide-long-text">
                                @lang('app.branch-setting.update.tabs.res-info-tab.city')
                            </div>
                            @include('layouts.start')
                        </label>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="link-href"></div>
        </div>
        <div class="col-sm-4 form-group select2_theme validate-group">
            <div class="form-validate-select ">
                <div class="col-lg-12 mx-0 px-0">
                    <div class="col-lg-12 pr-0 select-material-box">
                        <select
                            data-select="1"
                            class="js-example-basic-single select2-hidden-accessible"
                            id="select-district-update-branch-setting">
                            <option value="-2" selected disabled
                                    hidden>@lang('app.component.option_default')</option>
                        </select>
                        <label class="icon-validate d-flex">
                            <div class="hide-long-text">
                                @lang('app.branch-setting.update.tabs.res-info-tab.district')
                            </div>
                            @include('layouts.start')
                        </label>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="link-href"></div>
        </div>
        <div class="col-sm-4 form-group select2_theme validate-group">
            <div class="form-validate-select ">
                <div class="col-lg-12 mx-0 px-0">
                    <div class="col-lg-12 pr-0 select-material-box">
                        <select
                            data-select="1"
                            data-empty="1"
                            class="js-example-basic-single class-branch-on select2-hidden-accessible"
                            id="select-ward-update-branch-setting">
                            <option value="-2" selected disabled hidden>@lang('app.component.option_default')</option>
                        </select>
                        <label class="icon-validate d-flex">
                            <div class="hide-long-text">
                                @lang('app.branch-setting.update.tabs.res-info-tab.ward')
                            </div>
                            @include('layouts.start')
                        </label>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="link-href"></div>
        </div>
        <div class="col-12 form-group validate-group">
            <div class="form-validate-input">
                <input class="class-branch-on" type="text" id="address-update-branch-setting"
                       data-empty="1" data-min-length="2" data-max-length="255" autocomplete="off">
                <label for="address-update-branch-setting">
                    <div class="hide-long-text">
                        @lang('app.branch-setting.update.tabs.res-info-tab.streets')
                    </div>
                        @include('layouts.start')
                </label>
                <div class="line"></div>
            </div>
            <div class="link-href"></div>
            <div class="d-none" id="box-search-address-restaurant-create-client" style="
                                       position: absolute;
                                        background-color: #fff;
                                        max-height: 148px;
                                        overflow: auto;
                                        z-index: 100;
                                        left: 0;
                                        right: 0;
                                        margin: 0 14px;
                                        border-bottom-left-radius: 8px;
                                        box-shadow: 1px 1px 4px #000;
                                        border-bottom-right-radius: 8px;
                                        min-height: max-content;
                                ">
            </div>
        </div>
        <div class="col-lg-12">
            <div id="map_address_branch"></div>
        </div>
    </div>
</div>
