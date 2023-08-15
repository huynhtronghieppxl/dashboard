<div class="modal fade" id="modal-update-send-message-campaign" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">CHỈNH SỬA TIN NHẮN</h4>
                <button type="button" class="close" onclick="closeModalUpdateSendMessageCampaign()" onkeypress="closeModalUpdateSendMessageCampaign()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color" id="loading-update-send-message-campaign">
                <div class="row">
                    <div class="col-lg-6 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub">
                            <div class="cover-profile" style="margin-bottom: 10px">
                                <div class="profile-bg-img bg-white-border box-image bg-white">
                                    <figure class="box-image-banner-branch" style="height: 19vh">
                                        <div class="edit-pp ">
                                            <label class="fileContainer pointer">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" id="upload-logo-update-send-message-campaign">
                                            </label>
                                        </div>
                                        <img id="thumbnail-logo-update-send-message-campaign" src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" alt="" style="background-color: #f2f2f2; object-fit: contain">
                                    </figure>
                                </div>
                            </div>
                            <div>
                                <div class="form-group select2_theme validate-group">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select data-validate="" id="select-type-update-send-message-campaign"
                                                        class="js-example-basic-single">
                                                    <option value="2">Tất cả</option>
                                                    <option value="1">Cá nhân</option>
                                                    <option value="6" {{Session::get(SESSION_KEY_IS_ENABLE_RESTAURANT_MEMBERSHIP_CARD) !== 0 ? 'disabled' : ''}}> Khách hàng theo level</option>
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
                                <div class="form-group d-none option-item-type-send-message-campaign" id="box-input-update-accumulate-send-message-campaign">
                                    <div class="form-validate-input">
                                        <input class="form-control" id="acc-points-update-send-message-campaign"
                                               data-min="1" data-float="1" data-type="currency-edit"  data-max="999999"/>
                                        <label> Điểm tích lũy @include('layouts.start') </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="col-12 form-group mt-3 d-none option-item-type-send-message-campaign" id="time-last-used-update-send-message-campaign">
                                    <div class="form-group checkbox-group">
                                        <label class="title-checkbox">Thời gian</label>
                                        <div class="row">
                                            <div class="form-validate-checkbox mr-0 pl-0 col-lg-4">
                                                <div class="checkbox-form-group" >
                                                    <input type="radio" id="month-last-used-update-send-message-campaign" name="time-last-used-update-send-message-campaign" value="0" checked=""/>
                                                    <label class="name-checkbox" for="month-last-used-update-send-message-campaign">Tháng hiện tại</label>
                                                </div>
                                            </div>
                                            <div class="form-validate-checkbox mr-0 col-lg-4">
                                                <div class="checkbox-form-group">
                                                    <input type="radio" id="3-month-last-used-update-send-message-campaign" name="time-last-used-update-send-message-campaign" value="1"/>
                                                    <label class="name-checkbox" for="3-month-last-used-update-send-message-campaign"> 3 tháng </label>
                                                </div>
                                            </div>
                                            <div class="form-validate-checkbox mr-0 col-lg-4">
                                                <div class="checkbox-form-group">
                                                    <input type="radio" id="6-month-last-used-update-send-message-campaign" name="time-last-used-update-send-message-campaign" value="2"/>
                                                    <label class="name-checkbox" for="6-month-last-used-update-send-message-campaign"> 6 tháng </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group select2_theme validate-group d-none option-item-type-send-message-campaign" id="box-select-update-level-send-message-campaign">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select data-validate="" id="select-level-update-send-message-campaign" data-select="1"
                                                        class="js-example-basic-single">
                                                </select>
                                                <label>
                                                    Chọn level
                                                    @include('layouts.start')
                                                </label>
                                                <div class="line"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="form-group select2_theme validate-group d-none option-item-type-send-message-campaign" id="box-select-update-gender-send-message-campaign">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select data-validate="" id="select-gender-update-send-message-campaign" data-select="1"
                                                        class="js-example-basic-single">
                                                    <option value="1">Nam</option>
                                                    <option value="0">Nữ</option>
                                                </select>
                                                <label>
                                                    Chọn giới tính
                                                    @include('layouts.start')
                                                </label>
                                                <div class="line"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="option-item-type-send-message-campaign option-item-type-send-message-campaign d-none" id="div-customer-update-send-message-campaign">
                                    <div class="form-validate-input mb-0" >
                                        <input type="text" id="phone-update-send-message-campaign"
                                               class="form-control" data-empty="1" data-phone="1" autocomplete="off">
                                        <label for="phone-update-send-message-campaign">
                                            @lang('app.send-message-campaign.create.phone')
                                            @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="name-search-customer-update float-right row text-right d-none">
                                        <p id="name-search-update-customer" style="color: #2b579a">Tên KH:</p>
                                    </div>
                                    <div class="link-href">
                                        <ul class="search-customer-send-message-campaign d-none"
                                            id="data-search-customer-update-send-message-campaign"></ul>
                                    </div>
                                </div>
                                <div class="" id="type-time-update-send-message-campaign">
                                    <div class="form-group checkbox-group row">
                                        <label class="title-checkbox col-lg-3 mt-2 mb-0">
                                            @lang('app.send-message-campaign.update.type-time')
                                        </label>
                                        {{--                                        <div class="col-lg-9 row">--}}
                                        {{--                                            <div class="form-validate-checkbox mr-0 w-50">--}}
                                        {{--                                                <div class="checkbox-form-group">--}}
                                        {{--                                                    <input type="radio" id="update-send-message-campaign-send-now" name="radio" value="0" checked>--}}
                                        {{--                                                    <label for="update-send-message-campaign-send-now" class="name-checkbox">--}}
                                        {{--                                                        <i class="helper"></i>@lang('app.send-message-campaign.update.type-time-1')--}}
                                        {{--                                                    </label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="form-validate-checkbox mr-0 w-50">--}}
                                        {{--                                                <div class="checkbox-form-group">--}}
                                        {{--                                                    <input type="radio" id="update-send-message-campaign-send-by-day" name="radio" value="1">--}}
                                        {{--                                                    <label for="update-send-message-campaign-send-by-day" class="name-checkbox">--}}
                                        {{--                                                        <i class="helper"></i>@lang('app.send-message-campaign.update.type-time-2')--}}
                                        {{--                                                    </label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="div-time-update-send-message-campaign">
                                <div class="col-lg-6 pl-0">
                                    <div class="form-validate-input ">
                                        <input type="text" id="time-update-send-message-campaign" class="input-sm form-control text-center input-datetimepicker p-1" value="{{date('d/m/Y')}}" data-validate="calendar" autocomplete="off">
                                        <label>@lang('app.send-message-campaign.update.time')</label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                                <div class="col-lg-6 pr-0">
                                    <div class="form-validate-input ">
                                        <input type="text" id="hour-update-send-message-campaign" class="input-sm form-control text-center input-datetimepicker p-1" value="{{date('d/m/Y')}}" data-validate="calendar" autocomplete="off">
                                        <label> @lang('app.send-message-campaign.create.hour') </label>
                                        <div class="line"></div>
                                    </div>
                                    <div class="link-href"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 edit-flex-auto-fill pl-0">
                        <div class="card card-block flex-sub">
                            <div class="form-group validate-group">
                                <div class="form-validate-input">
                                    <input type="text" id="name-update-send-message-campaign" class="form-control" data-empty="1" data-max-length="50">
                                    <label>
                                        @lang('app.send-message-campaign.update.name')
                                        @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group select2_theme validate-group">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select data-validate="" id="select-type-gift-update-send-message-campaign"
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
                                            <select data-validate="" data-select="1" id="select-gift-update-send-message-campaign"
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
                                    <input class="form-control" id="url-gift-update-send-message-campaign" data-url="1" tabindex="0"
                                           data-empty="1" data-max-length="50"/>
                                    <label> Link URL @include('layouts.start') </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="form-group validate-group">
                                <div class="form-validate-textarea">
                                    <div class="form__group pt-2">
                                <textarea class="form__field" id="content-update-send-message-campaign" cols="5"
                                          rows="10"></textarea>
                                        <label for="content-update-send-message-campaign" class="form__label icon-validate f-w-600" >
                                            @lang('app.send-message-campaign.update.content') @include('layouts.start')
                                        </label>
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                        onclick="saveModalUpdateSendMessageCampaign()"
                        onkeypress="saveModalUpdateSendMessageCampaign()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/marketing/campaign/send_message/update.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

