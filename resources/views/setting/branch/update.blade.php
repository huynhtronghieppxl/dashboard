{{--<div class="modal fade" id="modal-update-branch-setting" data-keyboard="false" data-backdrop="static">--}}
{{--    <div class="modal-dialog modal-xl" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-body mb-0" id="loading-modal-update-branch-setting">--}}
{{--                <div class="col-md-12">--}}
{{--                    <h4>@lang('app.branch-setting.update.title')</h4>--}}
{{--                    <div class="sub-title"></div>--}}

{{--                    <div class="col-lg-12 col-xl-12">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <ul class="nav nav-tabs md-tabs border-0" role="tablist">--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link active" data-toggle="tab" href="#res-info-tab" role="tab" aria-expanded="true">@lang('app.branch-setting.update.tabs.res-info')</a>--}}
{{--                                        <div class="slide"></div>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" data-toggle="tab" href="#service-info-tab" role="tab" aria-expanded="false">@lang('app.branch-setting.update.tabs.service-info')</a>--}}
{{--                                        <div class="slide"></div>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" data-toggle="tab" href="#image-tab" role="tab" aria-expanded="false">@lang('app.branch-setting.update.tabs.image')</a>--}}
{{--                                        <div class="slide"></div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row p-4">--}}
{{--                            <div class="tab-content card-block w-100">--}}
{{--                                <div class="tab-pane active" id="res-info-tab" role="tabpanel">--}}
{{--                                    <div class="row sub-title">--}}
{{--                                        <label>@lang('app.branch-setting.update.tabs.res-info-tab.title') </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-sm-2 col-form-label">@lang('app.branch-setting.update.tabs.res-info-tab.name-branch')</label>--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            <input type="text" class="form-control" id="name-update-branch-setting" >--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-sm-2">@lang('app.branch-setting.update.tabs.res-info-tab.phone-branch')</label>--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            <input type="text" class="form-control" id="phone-update-branch-setting">--}}
{{--                                        </div>--}}
{{--                                        <label class="col-sm-2">@lang('app.branch-setting.update.tabs.res-info-tab.avg-amount-customer-branch')</label>--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            <input type="text" class="form-control" id="branch-avg-amount-customer-update-branch-setting"--}}
{{--                                                   data-max="999999999" data-type="currency-edit">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <div class="col-lg-6">--}}
{{--                                            <div class="row">--}}
{{--                                                <label class="col-sm-4">@lang('app.branch-setting.update.tabs.res-info-tab.logo')</label>--}}
{{--                                                <div class="col-sm-8">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-12">--}}
{{--                                                            <form class="dropzone2 dropzone-customs text-center border-primary py-2" method="post" id="logo-update-branch-setting">--}}
{{--                                                                @csrf--}}
{{--                                                                <div id="previews-logo">--}}
{{--                                                                    <div id="template-review-logo">--}}
{{--                                                                        <div class="row">--}}
{{--                                                                            <div class="col-sm-12 col-md-12 col-lg-12 text-center">--}}
{{--                                                                                <img class="rounded" data-dz-thumbnail id="thumbnail-logo" style="width: 300px; height: 200px; object-fit: cover;">--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </form>--}}
{{--                                                            <form hidden id='data_url' action="" name="name_file[]"></form>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-6">--}}
{{--                                            <div class="row">--}}
{{--                                                <label class="col-sm-4">@lang('app.branch-setting.update.tabs.res-info-tab.banner')</label>--}}
{{--                                                <div class="col-sm-8">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-12">--}}
{{--                                                            <form class="dropzone2 dropzone-customs text-center border-primary py-2" method="post" id="banner-update-branch-setting">--}}
{{--                                                                @csrf--}}
{{--                                                                <div id="previews-banner">--}}
{{--                                                                    <div id="template-review-banner">--}}
{{--                                                                        <div class="row">--}}
{{--                                                                            <div class="col-sm-12 col-md-12 col-lg-12 text-center">--}}
{{--                                                                                <img class="rounded" data-dz-thumbnail id="thumbnail-banner" style="width: 300px; height: 200px; object-fit: cover;">--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </form>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="row pt-2">--}}
{{--                                        <div class="col-md-7" id="loading-address-branch-setting">--}}
{{--                                            <div class="form-group row">--}}
{{--                                                <label class="col-sm-2">@lang('app.branch-setting.update.tabs.res-info-tab.streets')</label>--}}
{{--                                                <div class="col-sm-10">--}}
{{--                                                    <input type="text" class="form-control" id="address-update-branch-setting">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group row">--}}
{{--                                                <label class="col-sm-2">@lang('app.branch-setting.update.tabs.res-info-tab.country')</label>--}}
{{--                                                <div class="col-sm-4">--}}
{{--                                                    <select class="js-example-basic-single" id="select-country-update-branch-setting"> </select>--}}
{{--                                                </div>--}}

{{--                                                <label class="col-sm-2">@lang('app.branch-setting.update.tabs.res-info-tab.city')</label>--}}
{{--                                                <div class="col-sm-4">--}}
{{--                                                    <select class="js-example-basic-single" id="select-city-update-branch-setting">--}}
{{--                                                        <option disabled selected hidden>@lang('app.component.option_default')</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class=" row">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label class="col-sm-2 col-form-label">@lang('app.branch-setting.update.tabs.res-info-tab.district')</label>--}}
{{--                                                    <div class="col-sm-8">--}}
{{--                                                        <select class="js-example-basic-single" id="select-district-update-branch-setting">--}}
{{--                                                            <option disabled selected hidden>@lang('app.component.option_default')</option>--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label class="col-sm-2 col-form-label">@lang('app.branch-setting.update.tabs.res-info-tab.ward')</label>--}}
{{--                                                    <div class="col-sm-8">--}}
{{--                                                        <select class="js-example-basic-single" id="select-ward-update-branch-setting">--}}
{{--                                                            <option disabled selected hidden>@lang('app.component.option_default')</option>--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group row">--}}
{{--                                                <label class="col-sm-2">@lang('app.branch-setting.update.tabs.res-info-tab.address-note')</label>--}}
{{--                                                <div class="col-sm-10">--}}
{{--                                                    <textarea class="form-control" rows="5" cols="6" id="note-address-update-branch-setting" data-note="1"></textarea>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group row d-none">--}}
{{--                                                <label class="col-sm-2">@lang('app.branch-setting.update.tabs.res-info-tab.address')</label>--}}
{{--                                                <div class="col-sm-10">--}}
{{--                                                    <input type="text" class="form-control" id="full-address-update-branch-setting" readonly>--}}
{{--                                                    <div class="d-none address-gg"></div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-5">--}}
{{--                                            <div class="form-group row">--}}
{{--                                                <label class="col-sm-2">@lang('app.branch-setting.update.tabs.res-info-tab.location')</label>--}}
{{--                                                <div class="col-sm-10">--}}
{{--                                                    <div class="w-40-h-25-vh max-height-40vh branch-location-edit form-control" id="map-update-branch-setting">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="tab-pane" id="service-info-tab" role="tabpanel">--}}
{{--                                    <div class="row sub-title">--}}
{{--                                        <label>@lang('app.branch-setting.update.tabs.service-info-tab.title') </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-info">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" value="" id="is-wifi-edit">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                                                    <span>@lang('app.branch-setting.update.tabs.service-info-tab.is-have-wifi')</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-info">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" value="" id="is-parking-edit">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                                                    <span>@lang('app.branch-setting.update.tabs.service-info-tab.is-have-free-parking')</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-info">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" value=""id="is-air-conditioner-edit">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                                                    <span>@lang('app.branch-setting.update.tabs.service-info-tab.is-have-air-conditioner')</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-info">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" value="" id="is-booking-online-edit">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                                                    <span>@lang('app.branch-setting.update.tabs.service-info-tab.is-have-booking-online')</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-info">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" value="" id="is-car-parking-edit">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                                                    <span>@lang('app.branch-setting.update.tabs.service-info-tab.is-have-car-parking')</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-info">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" value="" id="is-card-payment-edit">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                                                    <span>@lang('app.branch-setting.update.tabs.service-info-tab.is-have-card-payment')</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-info">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" value="" id="is-child-corner-edit">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                                                    <span>@lang('app.branch-setting.update.tabs.service-info-tab.is-have-child-corner')</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-info">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" value="" id="is-invoice-edit">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                                                    <span>@lang('app.branch-setting.update.tabs.service-info-tab.is-have-invoice')</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-info">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" value="" id="is-karaoke-edit">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                                                    <span>@lang('app.branch-setting.update.tabs.service-info-tab.is-have-karaoke')</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-info">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" value="" id="is-live-music-edit">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                                                    <span>@lang('app.branch-setting.update.tabs.service-info-tab.is-have-live-music')</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-info">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" value="" id="is-order-food-online-edit">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                                                    <span>@lang('app.branch-setting.update.tabs.service-info-tab.is-have-order-food-online')</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-info">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" value="" id="is-outdoor-edit">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                                                    <span>@lang('app.branch-setting.update.tabs.service-info-tab.is-have-outdoor')</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-info">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" value="" id="is-private-room-edit">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>--}}
{{--                                                    <span>@lang('app.branch-setting.update.tabs.service-info-tab.is-have-private-room')</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row d-none" id="display-if-have-wifi">--}}
{{--                                        <label class="col-sm-2">@lang('app.branch-setting.update.tabs.service-info-tab.wifi-name')</label>--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            <input type="text" class="form-control" id="wifi-name-update-branch-setting">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row d-none" id="display-if-have-password">--}}
{{--                                        <label class="col-sm-2">@lang('app.branch-setting.update.tabs.service-info-tab.wifi-password')</label>--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            <input type="password" class="form-control" id="wifi-password-update-branch-setting">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-lg-2">@lang('app.branch-setting.update.tabs.service-info-tab.uptime')</label>--}}
{{--                                        <div class="col-lg-9">--}}
{{--                                            <div class="row ml-1">--}}
{{--                                                <div class="form-radio">--}}
{{--                                                    <div class="radio radio-inline">--}}
{{--                                                        <label>--}}
{{--                                                            <input type="radio" name="dayOfWeek" checked="checked" value="-1" >--}}
{{--                                                            <i class="helper"></i> @lang('app.branch-setting.update.tabs.service-info-tab.all-week')--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="radio radio-inline">--}}
{{--                                                        <label>--}}
{{--                                                            <input type="radio" name="dayOfWeek" value="0">--}}
{{--                                                            <i class="helper"></i> @lang('app.branch-setting.update.tabs.service-info-tab.chose-date')--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="row mt-2" id="day-of-week-update-branch-setting">--}}
{{--                                                <div id="select-all-week-update-branch-setting" class="row w-100">--}}
{{--                                                    <div class="row w-30 ml-3">--}}
{{--                                                        <div class="col-lg-6 mt-1">--}}
{{--                                                            <input class="form-control start-time-date-time-picker time-open-of-day" placeholder="Giờ bắt đầu">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-6 mt-1">--}}
{{--                                                            <input class="form-control time-out-date-time-picker time-close-of-day" placeholder="Giờ kết thúc">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div id="select-date-update-branch-setting" class="d-none row w-100 ml-3"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row sub-title mt-4">--}}
{{--                                        <label>@lang('app.branch-setting.update.tabs.service-info-tab.other-information') </label>--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group row">--}}
{{--                                        <div class="col-sm-2">--}}
{{--                                            <label for="Country-2" class="block">@lang('app.branch-setting.update.tabs.service-info-tab.website')</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-10">--}}
{{--                                            <input id="website-update-branch-setting" name="Country" type="text" class="form-control">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group row">--}}
{{--                                        <div class="col-sm-2">--}}
{{--                                            <label for="Degreelevel-2" class="block">@lang('app.branch-setting.update.tabs.service-info-tab.facebook')</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-10">--}}
{{--                                            <input id="facebook-update-branch-setting" name="Degree level" type="text" class="form-control" >--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="tab-pane" id="image-tab" role="tabpanel">--}}
{{--                                    <div class="row sub-title"><label>@lang('app.branch-setting.update.tabs.image-urls-tab.title')</label></div>--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <span class="col-lg-8">@lang('app.branch-setting.update.tabs.image-urls-tab.note-info')</span>--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group row">--}}
{{--                                        <span class="col-lg-8">@lang('app.branch-setting.update.tabs.image-urls-tab.photo-format')--}}
{{--                                            <span class="text-danger">@lang('app.branch-setting.update.type-img')</span>.--}}
{{--                                            @lang('app.branch-setting.update.tabs.image-urls-tab.size-format')--}}
{{--                                            <span class="text-danger">@lang('app.branch-setting.update.tabs.image-urls-tab.size')</span>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group row d-none" id="review-branch-image-url"></div>--}}
{{--                                    <div class="form-group row mb-0">--}}
{{--                                        <div class="col-sm-12">--}}
{{--                                            <form method="POST" enctype="multipart/form-data" class="text-center row" id="branch-banner-multiple-edit" name='file[]'>--}}
{{--                                                @csrf--}}
{{--                                                <div id="content-branch-banner-multiple-edit" class="w-100 py-2 px-3"></div>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-grd-disabled waves-effect" onclick="closeModalUpdateBranchSetting()">--}}
{{--                    @lang('app.branch-setting.close-modal')--}}
{{--                </button>--}}
{{--                <button type="button" class="btn btn-primary waves-effect" onclick="saveUpdateBranchSetting()">--}}
{{--                    @lang('app.branch-setting.save-modal')--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@push('scripts')--}}
{{--    <script type="text/javascript" src="{{asset('js\setting\branch_v2\update.js?version=')}}"></script>--}}
{{--    <script type="text/javascript" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDufLLFr5vYdj5F-f8-tMiYrUWKwbGMCOs&libraries=places&v=weekly"></script>--}}
{{--@endpush--}}
