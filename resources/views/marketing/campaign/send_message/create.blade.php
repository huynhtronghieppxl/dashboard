<div class="modal fade" id="modal-create-send-message-campaign" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">THÊM MỚI TIN NHẮN</h4>
                <button type="button" class="close" onclick="closeModalCreateSendMessageCampaign()" onkeypress="closeModalCreateSendMessageCampaign()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color pb-0" id="loading-create-send-message-campaign">
                <div class="row">
                    <div class="col-lg-6 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub">
                            <div class="cover-profile" style="margin-bottom: 10px">
                                <div class="profile-bg-img bg-white-border box-image bg-white" id="branch-cover-image">
                                    <figure style="height: 20vh">
                                        <div class="edit-pp">
                                            <label class="fileContainer pointer">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" id="upload-gift-banner">
                                            </label>
                                        </div>
                                        <img id="thumbnail-gift-banner" src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" alt="" style="background-color: #f2f2f2; object-fit: contain"
                                             data-src>
                                    </figure>
                                </div>
                            </div>
                            <div>
{{--                                <div class="col-12 form-group" id="type-customer-create-send-message-campaign" style="margin-bottom: 0px !important;">--}}
{{--                                    <div class="form-group checkbox-group">--}}
{{--                                        <label class="title-checkbox">Gửi cho</label>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="form-validate-checkbox" style="width: 40%">--}}
{{--                                                <div class="checkbox-form-group">--}}
{{--                                                    <input type="radio" id="create-send-message-campaign-to-all" name="gender" value="2" checked=""/>--}}
{{--                                                    <label class="name-checkbox" for="create-send-message-campaign-to-all">Tất cả</label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-validate-checkbox" style="width: 40%">--}}
{{--                                                <div class="checkbox-form-group">--}}
{{--                                                    <input type="radio" id="create-send-message-campaign-to-personal" name="gender" value="1"/>--}}
{{--                                                    <label class="name-checkbox" for="create-send-message-campaign-to-personal">Cá nhân </label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select data-validate="" id="select-type-create-send-message-campaign"
                                                        class="js-example-basic-single">
                                                    <option value="2">Tất cả</option>
                                                    <option value="1">Cá nhân</option>
                                                    <option value="6" {{Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['is_enable_membership_card'] === 0 ? 'disabled' : ''}}> Khách hàng theo level</option>
                                                    <option value="3">Khách hàng theo thời gian của lần gần nhất ăn tại quán</option>
                                                    <option value="4">Khách hàng theo giới tính</option>
                                                    <option value="5">Khách hàng theo số điểm tích lũy</option>
                                                </select>
                                                <label>
                                                   Gửi cho
                                                </label>
                                                <div class="line"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="form-group d-none option-item-type-send-message-campaign" id="box-input-accumulate-send-message-campaign">
                                    <div class="form-validate-input">
                                        <input class="form-control" id="acc-points-create-send-message-campaign"
                                               data-min="1" data-float="1" data-type="currency-edit"  data-max="999999"/>
                                        <label> Điểm tích lũy @include('layouts.start') </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="col-12 form-group mt-3 d-none option-item-type-send-message-campaign" id="time-last-used-create-send-message-campaign">
                                    <div class="form-group checkbox-group">
                                        <label class="title-checkbox">Thời gian</label>
                                        <div class="row">
                                            <div class="form-validate-checkbox mr-0 pl-0 col-lg-4">
                                                <div class="checkbox-form-group" >
                                                    <input type="radio" id="month-last-used-create-send-message-campaign" name="time-last-used-create-send-message-campaign" value="0" checked=""/>
                                                    <label class="name-checkbox" for="month-last-used-create-send-message-campaign">Tháng hiện tại</label>
                                                </div>
                                            </div>
                                            <div class="form-validate-checkbox mr-0 col-lg-4">
                                                <div class="checkbox-form-group">
                                                    <input type="radio" id="3-month-last-used-create-send-message-campaign" name="time-last-used-create-send-message-campaign" value="1"/>
                                                    <label class="name-checkbox" for="3-month-last-used-create-send-message-campaign"> 3 tháng </label>
                                                </div>
                                            </div>
                                            <div class="form-validate-checkbox mr-0 col-lg-4">
                                                <div class="checkbox-form-group">
                                                    <input type="radio" id="6-month-last-used-create-send-message-campaign" name="time-last-used-create-send-message-campaign" value="2"/>
                                                    <label class="name-checkbox" for="6-month-last-used-create-send-message-campaign"> 6 tháng </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group select2_theme validate-group d-none option-item-type-send-message-campaign" id="box-select-level-send-message-campaign">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select data-validate="" id="select-level-create-send-message-campaign" data-select="1"
                                                        class="js-example-basic-single">
                                                </select>
                                                <label>
                                                    Chọn level @include('layouts.start')
                                                </label>
                                                <div class="line"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="form-group select2_theme validate-group d-none option-item-type-send-message-campaign" id="box-select-gender-send-message-campaign">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select data-validate="" id="select-gender-send-message-campaign" data-select="1"
                                                        class="js-example-basic-single">
                                                    <option value="1">Nam</option>
                                                    <option value="0">Nữ</option>
                                                </select>
                                                <label>
                                                    Chọn giới tính @include('layouts.start')
                                                </label>
                                                <div class="line"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="d-none option-item-type-send-message-campaign option-item-type-send-message-campaign" id="div-customer-create-send-message-campaign">
                                    <div class="form-validate-input mb-0" >
                                        <input type="text" id="phone-create-send-message-campaign"
                                               class="form-control" data-empty="1" data-phone="1" autocomplete="off">
                                        <label for="phone-create-send-message-campaign">
                                            @lang('app.send-message-campaign.create.phone')
                                            @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="name-search-customer float-right row text-right d-none">
                                        <p id="name-search-customer" style="color: #2b579a">Tên KH:</p>
                                    </div>
                                    <div class="link-href">
                                        <ul class="search-customer-send-message-campaign d-none"
                                            id="data-search-customer-send-message-campaign"></ul>
                                    </div>
                                </div>
                                <div class="" id="type-time-create-send-message-campaign">
                                    <div class="form-group checkbox-group">
                                        <label class="title-checkbox">@lang('app.send-message-campaign.create.type-time')</label>
                                        <div class="row">
{{--                                            <div class="form-validate-checkbox" style="width: 40%">--}}
{{--                                                <div class="checkbox-form-group" >--}}
{{--                                                    <input type="radio" id="create-send-message-campaign-send-now" name="type-time-create-send-message-campaign" value="0" checked=""/>--}}
{{--                                                    <label class="name-checkbox" for="create-send-message-campaign-send-now">@lang('app.send-message-campaign.create.type-time-1')                                   <div class="tool-tip">--}}
{{--                                                        </div>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="form-validate-checkbox" style="width: 40%">
                                                <div class="checkbox-form-group">
                                                    <input type="radio" id="create-send-message-campaign-send-by-day" checked name="type-time-create-send-message-campaign" value="1"/>
                                                    <label class="name-checkbox" for="create-send-message-campaign-send-by-day">@lang('app.send-message-campaign.create.type-time-2')                                     <div class="tool-tip">
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="div-time-create-send-message-campaign">
                                <div class=" col-lg-6 pl-0">
                                    <div class="form-validate-input mb-0">
                                        <input type="text" id="time-create-send-message-campaign"
                                               class="input-sm form-control text-center input-datetimepicker p-1" value=""
                                               autocomplete="off">
                                        <label for="time-create-send-message-campaign">
                                            @lang('app.send-message-campaign.create.time')
                                            @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="pr-0 col-lg-6">
                                    <div class="form-validate-input mb-0">
                                        <input type="text" id="hour-create-send-message-campaign"
                                               class="input-sm form-control text-center input-datetimepicker p-1"
                                                autocomplete="off">
                                        <label for="hour-create-send-message-campaign">
                                             @lang('app.send-message-campaign.create.hour')
                                            @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 edit-flex-auto-fill p-0">
                        <div class="card card-block flex-sub">
                            <div class="form-group">
                                <div class="form-validate-input">
                                    <input class="form-control" id="name-create-send-message-campaign" tabindex="0"
                                           data-empty="1" data-max-length="50"/>
                                    <label>@lang('app.send-message-campaign.create.name')@include('layouts.start')</label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select data-validate="" id="select-type-gift-create-send-message-campaign"
                                                    class="js-example-basic-single select2-hidden-accessible">
                                                <option selected value="0" >Không chọn quà</option>
                                                <option value="1">Quà tặng</option>
                                                <option value="2">Link URL </option>
                                            </select>
                                            <label>
                                              @lang('app.send-message-campaign.create.gift')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group d-none">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select data-validate="" data-select="1" id="select-gift-create-send-message-campaign"
                                                    class="js-example-basic-single select2-hidden-accessible">
                                            </select>
                                            <label> Chọn quà @include('layouts.start')</label>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group d-none">
                                <div class="form-validate-input">
                                    <input class="form-control" id="url-gift-create-send-message-campaign" data-url="1" tabindex="0"
                                           data-empty="1" data-max-length="50"/>
                                    <label> Link URL @include('layouts.start') </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                <textarea class="form__field" id="content-create-send-message-campaign" cols="5"
                                          rows="10"></textarea>
                                        <label for="content-create-send-message-campaign"
                                               class="form__label icon-validate">Nội dung @include('layouts.start')</label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateSendMessageCampaign()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateSendMessageCampaign()"
                     onkeypress="saveModalCreateSendMessageCampaign()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\marketing\campaign\send_message\create.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

