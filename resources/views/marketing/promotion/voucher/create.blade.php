<div class="modal fade" id="modal-create-voucher-promotion" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.voucher-promotion.create.title')</h4>
            </div>
            <div class="modal-body" id="loading-modal-create-voucher-promotion">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card card-block">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input">
                                            <input id="name-create-voucher-promotion" style="line-height:23px" data-empty="1">
                                            <label for="name-create-voucher-promotion">@lang('app.voucher-promotion.create.name') <span class="text-danger">(*)</span>
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.voucher-promotion.create.detail')</label>
                                        <div class="col-lg-8">
                                            <textarea id="detail-create-voucher-promotion"
                                                      class="form-control" rows="8"
                                                      data-note="1"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.voucher-promotion.create.user-manual')</label>
                                        <div class="col-lg-8 col-form-label"><a target="_blank"
                                                                                id="user-manual-create-voucher-promotion"
                                                                                class="link-custom"
                                                                                href="http://techres.com">techres.com</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group select2_theme validate-group">
                                        <div class="form-validate-select ">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select id="branches-create-voucher-promotion" class="js-example-basic-single select2-hidden-accessible" multiple="" data-empty="1" tabindex="-1" aria-hidden="true">
                                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>
                                                        <i class="typcn typcn-document-text"></i>@lang('app.voucher-promotion.create.branches') <span class="text-danger">(*)</span></label>
                                                    <div class="line"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 form-group validate-group pl-0">
                                            <div class="form-validate-input">
                                                <input type="text" id="from-hour-create-voucher-promotion" class="input-sm form-control text-center input-datetimepicker p-1" value="{{date('H')}}" data-empty="1" autocomplete="off">
                                                <label for="from-hour-create-voucher-promotion">
                                                    <i class="icofont icofont-ui-alarm"></i>@lang('app.voucher-promotion.create.from-hour') <span class="text-danger">(*)</span></label>
                                                <div class="line"></div>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                        <div class="col-6 form-group validate-group pl-0">
                                            <div class="form-validate-input">
                                                <input type="text" id="to-hour-create-voucher-promotion" class="input-sm form-control text-center input-datetimepicker p-1" value="{{date('H')}}" data-empty="1" autocomplete="off">
                                                <label for="to-hour-create-voucher-promotion">
                                                    <i class="icofont icofont-ui-alarm"></i>@lang('app.voucher-promotion.create.to-hour') <span class="text-danger">(*)</span></label>
                                                <div class="line"></div>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    </div>

                                    <div class="form-group validate-group">
                                        <div class="form-validate-input ">
                                            <input type="text" id="from-date-create-voucher-promotion" class="input-sm form-control text-center input-datetimepicker p-1" value="{{date('d/m/Y')}}" autocomplete="off">
                                            <label>
                                                <i class="typcn typcn-document-text"></i>@lang('app.voucher-promotion.create.from-date') </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input">
                                            <input type="text" id="to-date-create-voucher-promotion" class="input-sm form-control text-center input-datetimepicker p-1" value="{{date('d/m/Y')}}" autocomplete="off">
                                            <label>
                                                <i class="typcn typcn-document-text"></i>@lang('app.voucher-promotion.create.to-date') </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>

                                    <div class="form-group row validate-group">
                                        <label class="col-lg-12 col-form-label font-weight-bold my-auto">@lang('app.voucher-promotion.create.day-of-week')</label>
                                    </div>
                                    <div class="row" id="day-of-week-create-voucher-promotion">
                                        <div class="col-sm-3 form-group row">
                                            <label class="col-lg-4 col-form-label">@lang('app.voucher-promotion.create.option-day-of-week.monday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="0">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label class="col-lg-4 col-form-label">@lang('app.voucher-promotion.create.option-day-of-week.tuesday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="1">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label class="col-lg-4 col-form-label">@lang('app.voucher-promotion.create.option-day-of-week.wednesday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="2">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label class="col-lg-4 col-form-label">@lang('app.voucher-promotion.create.option-day-of-week.thursday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="3">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label class="col-lg-4 col-form-label">@lang('app.voucher-promotion.create.option-day-of-week.friday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="4">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label class="col-lg-4 col-form-label">@lang('app.voucher-promotion.create.option-day-of-week.saturday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="5"/>
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label class="col-lg-4 col-form-label">@lang('app.voucher-promotion.create.option-day-of-week.sunday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="6"/>
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label class="col-lg-4 col-form-label">@lang('app.happy-time-promotion.create.all-day')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="all-day"/>
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row validate-group">
                                        <label class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.voucher-promotion.create.category')</label>
                                    </div>
                                    <div class="row" id="day-of-week-create-voucher-promotion">
                                        <div class="col-sm-3 form-group row">
                                            <label class="col-lg-4 col-form-label">@lang('app.voucher-promotion.create.option-apply-type.foods')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="0">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label class="col-lg-4 col-form-label">@lang('app.happy-time-promotion.create.food-voucher.drinks')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="1">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label class="col-lg-4 col-form-label">@lang('app.happy-time-promotion.create.food-voucher.seafood')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="2">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label class="col-lg-4 col-form-label">@lang('app.happy-time-promotion.create.food-voucher.other')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="2">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group validate-group" id="div-reward-bonus-amount">
                                        <div class="form-validate-input">
                                            <input data-type="currency-edit" id="min-order-total-create-voucher-promotion" class="form-control text-right" data-money="1" value="0">
                                            <label>
                                                <i class="fa fa-money"></i>@lang('app.voucher-promotion.create.min-order-total') </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>

                                    <div class="form-group select2_theme validate-group">
                                        <div class="form-validate-select">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select class="form-control js-example-basic-single py-1 select2-hidden-accessible" id="discount-type-create-voucher-promotion" tabindex="-1" aria-hidden="true">
                                                        <option
                                                            value="1">@lang('app.voucher-promotion.create.discount-percent')</option>
                                                        <option value="2">@lang('app.voucher-promotion.create.discount-amount')</option>
                                                    </select>
                                                    <label>
                                                        <i class="typcn typcn-document-text"></i>@lang('app.voucher-promotion.create.discount') </label>
                                                    <div class="line"></div>
                                                </div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="form-group validate-group" id="div-reward-bonus-amount">
                                        <div class="form-validate-input">
                                            <input data-type="currency-edit" id="max-voucher-promotion-create-voucher-promotion" class="form-control text-right" data-price="1">
                                            <label>
                                                <i class="fa fa-money"></i>@lang('app.voucher-promotion.create.max-promotion') </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="central-meta">
                                    <div class="row merged5" id="data-upload-media-marketing-voucher-promotion">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" id="create-media-marketing-voucher-promotion">
                                            <div class="item-box" id="div-upload-media-marketing-voucher-promotion">
                                                <div class="item-upload album">
                                                    <i class="fa fa-plus-circle"></i>
                                                    <div class="upload-meta">
                                                        <h5>Upload photo or album</h5>
                                                        <span>its only take a few seconds!</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <input class="d-none" type="file" multiple id="upload-media-marketing-voucher-promotion" name="file[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew"
                        onclick="resetModalCreateVoucherPromotion()"
                        onkeypress="resetModalCreateVoucherPromotion()">
                    <i class="fa fa-eraser"></i>
                </button>
                <button type="button" class="btn btn-grd-disabled" onclick="closeModalCreateVoucherPromotion()"
                        onkeypress="closeModalCreateVoucherPromotion()">
                    @lang('app.component.button.close')
                </button>
                <button type="button" class="btn btn-primary" onclick="saveModalCreateVoucherPromotion()"
                        onkeypress="saveModalCreateVoucherPromotion()">
                    @lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>

<div class="d-none">
    <span id="msg-name-create-voucher-promotion">@lang('app.voucher-promotion.msg.name')</span>
    <span id="msg-description-create-voucher-promotion">@lang('app.voucher-promotion.msg.description')</span>
    <span id="msg-reusable-count-voucher-promotion">@lang('app.voucher-promotion.msg.reusable-count')</span>
    <span id="msg-type-create-voucher-promotion">@lang('app.voucher-promotion.msg.type')</span>
    <span id="current-date">{{date('d/m/Y')}}</span>
    <span id="current-hour">{{date('H')}}</span>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/promotion/voucher/create.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
