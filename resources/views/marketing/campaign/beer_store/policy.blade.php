<style>
    .banner-policy-beer-campaign--label {
        font-weight: 500;
        font-size: 12px;
        line-height: 14px;
        color: #7D7E81;
        text-transform: uppercase;
    }

    .heading-notification {
        font-size: 20px;
        font-weight: 500;
        color: #1462B0;
    }
    .condition-noti {
        font-size: 18px;
        font-weight: 400;
        color: #7D7E81;
        text-transform: uppercase;
    }
</style>
<div class="modal fade" id="modal-set-policy-beer-campaign" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Chính sách</h4>
                <button type="button" class="close" onclick="closeModalSetpolicyBeerCampaign()" onkeypress="closeModalSetpolicyBeerCampaign()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color" id="">
                <div class="row">
                    <div class="col-6 edit-flex-auto-fill">
                        <div class="card card-block flex-sub m-0">
                            <div class="cover-profile" style="height: 50%; margin-bottom: 18px">
                                <div class="profile-bg-img bg-white-border box-image bg-white" id="banner-policy-beer-campaign">
                                    <label for="" class="banner-policy-beer-campaign--label mb-0">
                                        Banner
                                        @include('layouts.start')
                                    </label>
                                    <figure class="box-image-banner-branch">
                                        <div class="edit-pp">
                                            <label class="fileContainer pointer">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" accept="image/png, image/jpeg,image/jpg, image/webp" id="upload-banner-set-policy">
                                            </label>
                                        </div>
                                        <img id="thumbnail-banner-set-policy" onerror="imageDefaultOnLoadError($(this))" src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" alt="" data-url-avt="" data-url-thumb="">
                                    </figure>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                <textarea class="form__field" id="information-set-policy-beer-campaign" cols="5"
                                          rows="10"></textarea>
                                        <label for="use-guide-create-gift-marketing"
                                               class="form__label icon-validate">
                                            Mô tả
                                            @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                <textarea class="form__field" id="term-set-policy-beer-campaign" cols="5"
                                          rows="10"></textarea>
                                        <label for="use-guide-create-gift-marketing"
                                               class="form__label icon-validate">
                                            Quy định
                                            @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                <textarea class="form__field" id="tutorial-set-policy-beer-campaign" cols="5"
                                          rows="10"></textarea>
                                        <label for="" class="form__label icon-validate">
                                            Hướng dẫn sử dụng
                                            @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub m-0">
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="select-category-material-beer-store-campaign" data-select="1" class="js-example-basic-single select2-hidden-accessible">
                                                <option value="-1" selected>Vui lòng chọn</option>
                                            </select>
                                            <label class="icon-validate">
                                                Bia tặng
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group card p-3" style="box-shadow: 0 0 0.3rem lightgrey; border-radius: 0.5rem;">
                                <h4 class="heading-notification mb-1">THÔNG BÁO</h4>
                                <div class="form-validate-input mt-2 mb-3">
                                    <input type="text" id="hour-send-notification-campaign"
                                           class="input-sm form-control text-center input-datetimepicker p-1"
                                           autocomplete="off">
                                    <label for="hour-send-notification-campaign">
                                        @lang('app.send-message-campaign.create.hour')
                                        @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="set-notification-policy">
                                    <label class="icon-validate d-flex align-items-center justify-content-between">
                                        <h4 class="condition-noti">KHI TẶNG BIA MỖI NGÀY @include('layouts.start')</h4>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-validate-textarea">
                                            <div class="form__group pt-2">
                                                <textarea id="content-noti-beer-campaign-policy-data" class="form__field" rows="5" cols="5" data-note-max-length="1000"></textarea>
                                                <label for="content-noti-beer-campaign-policy-data" class="form__label icon-validate"> @lang('app.message.update.content')</label>
                                                <div class="textarea-character char-count">
                                                    <span>0/1000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center mt-2">
                                        <label class="col-lg-12 font-weight-bold pr-0 ">@lang('app.message.update.add-target'): </label>
                                        <div class="col-lg-12 row px-0">
                                            <div class="col-lg-3 pt-2 pr-0">
                                                <button type="button"
                                                        class="btn border-radius-20 btn-outline-dark w-100"
                                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                                        onclick="appendCompanyName($(this))">Tên công ty
                                                </button>
                                            </div>
                                            <div class="col-lg-3 pt-2 pr-0">
                                                <button type="button"
                                                        class="btn border-radius-20 btn-outline-dark w-100"
                                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                                        onclick="appendBrandName($(this))">Tên thương hiệu
                                                </button>
                                            </div>
                                            <div class="col-lg-3 pt-2 pr-0">
                                                <button type="button"
                                                        class="btn border-radius-20 btn-outline-dark w-100"
                                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                                        onclick="appendCustomerName($(this))">@lang('app.message.update.name-customer')
                                                </button>
                                            </div>
                                            <div class="col-lg-3 pt-2 pr-0">
                                                <button type="button"
                                                        class="btn border-radius-20 btn-outline-dark w-100"
                                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                                        onclick="appendBeerName($(this))">tên bia được tặng
                                                </button>
                                            </div>
                                            <div class="col-lg-3 pt-2 pr-0">
                                                <button type="button"
                                                        class="btn border-radius-20 btn-outline-dark w-100"
                                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                                        onclick="appendBeerUnit($(this))">Đơn vị bia
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="set-notification-policy">
                                    <label class="icon-validate d-flex align-items-center justify-content-between my-3">
                                        <h4 class="condition-noti">KHI KHO BIA ĐẾN HẠN RESET @include('layouts.start')</h4>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-validate-textarea form-group">
                                            <div class="form__group pt-2">
                                                <textarea id="content-noti-when-reset-beer-campaign-policy-data" class="form__field" rows="5" cols="5" data-note-max-length="1000"></textarea>
                                                <label for="content-noti-when-reset-beer-campaign-policy-data" class="form__label icon-validate"> @lang('app.message.update.content')</label>
                                                <div class="textarea-character">
                                                    <span>0/1000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center mt-2">
                                        <label class="col-lg-12 font-weight-bold pr-0">@lang('app.message.update.add-target'): </label>
                                        <div class="col-lg-12 row px-0">
                                            <div class="col-lg-3 pt-2 pr-0">
                                                <button type="button"
                                                        class="btn border-radius-20 btn-outline-dark w-100"
                                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                                        onclick="appendCompanyName($(this))">Tên công ty
                                                </button>
                                            </div>
                                            <div class="col-lg-3 pt-2 pr-0">
                                                <button type="button"
                                                        class="btn border-radius-20 btn-outline-dark w-100"
                                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                                        onclick="appendBrandName($(this))">Tên thương hiệu
                                                </button>
                                            </div>
                                            <div class="col-lg-3 pt-2 pr-0">
                                                <button type="button"
                                                        class="btn border-radius-20 btn-outline-dark w-100"
                                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                                        onclick="appendCustomerName($(this))">@lang('app.message.update.name-customer')
                                                </button>
                                            </div>
                                            <div class="col-lg-3 pt-2 pr-0">
                                                <button type="button"
                                                        class="btn border-radius-20 btn-outline-dark w-100"
                                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                                        onclick="appendBeerName($(this))">tên bia được tặng
                                                </button>
                                            </div>
                                            <div class="col-lg-3 pt-2 pr-0" id="div-update-greeting-restaurant">
                                                <button type="button"
                                                        class="btn border-radius-20 btn-outline-dark w-100"
                                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                                        onclick="appendBeerUnit($(this))">Đơn vị bia
                                                </button>
                                            </div>
                                            <div class="col-lg-3 pt-2 pr-0" id="div-update-greeting-restaurant">
                                                <button type="button"
                                                        class="btn border-radius-20 btn-outline-dark w-100"
                                                        onMouseOver="this.style.background='#f9a236'; this.style.transform='scale(1.1)'"
                                                        onMouseOut="this.style.background='#fff'; this.style.transform='scale(1)'"
                                                        onclick="appendRemainingDays($(this))">Số ngày còn lại
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3 align-items-center">
                                        <div class="col-lg-12">
                            <span class="cursor-pointer" onclick="open_modal_more_information()"
                                  style="font-style: italic; color: #095a9b">@lang('app.message.update.learn-more')</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalSetpolicyBeerCampaign()"
                     onkeypress="saveModalSetpolicyBeerCampaign()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/marketing/campaign/beer_store/policy.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

