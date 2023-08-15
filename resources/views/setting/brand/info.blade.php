<div class="card card-block mt-2 bg-white-border" id="validate-brand">
    <div class="row text-right d-flex justify-content-end">
        <div class="col-lg-6 text-left">
            <div class="sub-title">Thông tin thương hiệu</div>
        </div>
        <div class="col-lg-6 text-right d-flex justify-content-end">
            <div class="layout-index-button-new mb-3">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveUpdateInfoBrand()">
                    <i class="fi-rr-disk" style="font-size: 17.5px;vertical-align: middle;"></i>
                    <span>Cập nhật</span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group validate-group">
        <div class="form-validate-input">
            <div class="line"></div>
            <input type="text" id="name-update-brand-setting" data-max-length="50" data-empty="1" data-spec="1"
                   disabled>
            <label>
                <div class="hide-long-text">
                    @lang('app.brand-setting.tab1.name')
                </div>
                @include('layouts.start')
            </label>
            <div class="line"></div>
        </div>
        <div class="link-href"></div>
    </div>

    <div class="form-group validate-group">
        <div class="form-validate-input">
            <div class="line"></div>
            <input type="text" id="phone-update-brand-setting" data-phone="1" data-empty="1">
            <label>
                <div class="hide-long-text">
                    Hotline
                </div>
                @include('layouts.start')
            </label>
            <div class="line"></div>
        </div>
        <div class="link-href"></div>
    </div>
        <div class="row">
            <div class="form-group validate-group col-lg-6 pl-0">
                <div class="form-validate-input pos-relative">
                    <input id="website-update-brand-setting" name="Country" type="text" data-icon="icofont-web"
                           style="width: 80%"/>
                    <a href="https://www.dashboard.techres.vn/" id="link-url-web" target="_blank" class="pos-absolute" style="right: 2px; top: 50px;">
                        <button class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue page-redirects-website"
                                style="border-radius: 50%; width: 40px;height: 40px;" type="button" data-toggle="tooltip"
                                data-placement="top"
                                data-trigger="hover"
                                data-original-title="@lang('app.branch-setting.update.tabs.service-info-tab.redirect-web')">
                            <i class="fi-rr-share" style="font-size: 20px!important"></i>
                        </button>
                    </a>
                    <label for="website-update-brand-setting">@lang('app.branch-setting.update.tabs.service-info-tab.website')
                    </label>
                    <div class="line"></div>
                </div>
                <div class="link-href"></div>
            </div>
            <div class="form-group validate-group col-lg-6 pr-0">
                <div class="form-validate-input pos-relative">
                    <input id="facebook-update-brand-setting" name="Degree level" type="text"
                           data-icon="icofont-social-facebook" style="width: 80%"/>
                    <a href="https://www.facebook.com" id="link-url-facebook" target="_blank" class="pos-absolute" style="right: 2px; top: 50px;">
                        <button class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue page-redirects-website"
                                style="border-radius: 50%;width: 40px;height: 40px;" type="button" data-toggle="tooltip"
                                data-placement="top"
                                data-trigger="hover"
                                data-original-title="@lang('app.branch-setting.update.tabs.service-info-tab.redirect-web')">
                            <i class="fi-rr-share" style="font-size: 20px!important"></i>
                        </button>
                    </a>
                    <label for="facebook-update-brand-setting">@lang('app.branch-setting.update.tabs.service-info-tab.facebook')
                    </label>
                    <div class="line"></div>
                </div>
                <div class="link-href"></div>
            </div>
        </div>

    <div class="form-group validate-group">
        <div class="form-validate-textarea">
            <div class="form__group pt-2">
                <textarea class="form__field" id="description-update-brand-setting" cols="5" rows="5" data-note-max-length="300"></textarea>
                <label for="description-create-payment-bill" class="form__label icon-validate d-flex">
                    <div class="hide-long-text" style="width: max-content !important;">
                        @lang('app.brand-setting.tab1.description')
                    </div>
                </label>
                <div class="textarea-character" id="char-count">
                    <span>0/300</span>
                </div>
                <div class="line"></div>
            </div>
        </div>
    </div>
</div>
