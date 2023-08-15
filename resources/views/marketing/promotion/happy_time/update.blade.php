<div class="modal fade" id="modal-update-happy-time-promotion" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.happy-time-promotion.update.title')</h4>
                <h5 id="status-update-happy-time-promotion"></h5>
            </div>
            <div class="modal-body" id="loading-modal-update-customer-happy-time-promotion">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card card-block">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input">
                                            <input id="name-update-happy-time-promotion" class="form-control"
                                                   type="text" data-empty="1" data-max-length="255"/>
                                            <label for="name-update-happy-time-promotion"> <i
                                                    class="icofont icofont icofont-file-alt"></i>@lang('app.happy-time-promotion.update.name')
                                                <span class="text-danger">(*)</span> </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.update.short-description')</label>
                                        <div class="col-lg-8">
                                            <textarea id="short-description-update-happy-time-promotion"
                                                      class="form-control" rows="4" cols="5"
                                            ></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.update.description')</label>
                                        <div class="col-lg-8">
                                            <textarea id="description-update-happy-time-promotion" class="form-control"
                                                      rows="5" cols="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input">
                                            <input id="min-order-total-update-happy-time-promotion"
                                                   class="form-control text-right" data-type="currency-edit" value="0"
                                                   data-empty="1"/>
                                            <label for="min-order-total-update-happy-time-promotion"> <i
                                                    class="icofont icofont-sale-discount"></i>@lang('app.happy-time-promotion.update.min-order-total')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>

                                    <div class="form-group validate-group">
                                        <div class="form-validate-input">
                                            <input id="discount-update-happy-time-promotion"
                                                   class="form-control text-right" data-type="currency-edit" value="0"
                                                   data-validate="percent" data-percent="1"/>
                                            <label for="discount-update-happy-time-promotion"> <i
                                                    class="icofont icofont-sale-discount"></i>@lang('app.happy-time-promotion.update.discount')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>

                                    <div class="form-group validate-group" id="div-max-promotion-update-promotion">
                                        <div class="form-validate-input">
                                            <input id="max-happy-time-promotion-update-happy-time-promotion"
                                                   class="form-control text-right" data-type="currency-edit" value="0"
                                                   data-money="1"/>
                                            <label for="max-happy-time-promotion-update-happy-time-promotion"> <i
                                                    class="icofont icofont-sale-discount"></i>@lang('app.happy-time-promotion.update.max-happy-time-promotion')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>

                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group select2_theme validate-group">
                                        <div class="form-validate-select">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select id="type-update-happy-time-promotion" data-select="1"
                                                            class="js-example-basic-single select2-hidden-accessible"
                                                            tabindex="-1" aria-hidden="true">
                                                        <option selected
                                                                disabled>@lang('app.component.option_default')</option>
                                                        <option
                                                            value="0">@lang('app.happy-time-promotion.update.option-type.unknow')</option>
                                                        <option
                                                            value="1">@lang('app.happy-time-promotion.update.option-type.happy-time-promotion-food')</option>
                                                        <option
                                                            value="2">@lang('app.happy-time-promotion.update.option-type.happy-time-promotion-order')</option>
                                                        <option
                                                            value="3">@lang('app.happy-time-promotion.update.option-type.happy-time-promotion-golden-hour')</option>
                                                        <option
                                                            value="4">@lang('app.happy-time-promotion.update.option-type.happy-time-promotion-donate')</option>
                                                    </select>
                                                    <label>
                                                        <i class="typcn typcn-document-text"></i>@lang('app.happy-time-promotion.update.type')
                                                        <span class="text-danger">(*)</span>
                                                    </label>
                                                    <div class="line"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="form-group select2_theme validate-group">
                                        <div class="form-validate-select">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select id="branches-update-happy-time-promotion" multiple=""
                                                            data-select-not-empty=""
                                                            class="select-not-select2 select2-hidden-accessible"
                                                            tabindex="-1" aria-hidden="true">
                                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endforeach
                                                    </select>

                                                    <label class="icon-validate"> <i
                                                            class="icofont icofont-location-pin"></i>@lang('app.happy-time-promotion.update.branches')
                                                    </label>
                                                    <div class="line"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 form-group validate-group pl-0">
                                            <div class="form-validate-input">
                                                <input type="text" id="from-hour-update-happy-time-promotion"
                                                       class="input-sm form-control text-center input-datetimepicker p-1"
                                                       value="{{date('H')}}" data-empty="1" autocomplete="off">
                                                <label for="from-hour-update-happy-time-promotion">
                                                    <i class="icofont icofont-ui-alarm"></i>@lang('app.happy-time-promotion.update.from-hour')
                                                </label>
                                                <div class="line"></div>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>

                                        <div class="col-6 form-group validate-group px-0">
                                            <div class="form-validate-input">
                                                <input type="text" id="to-hour-update-happy-time-promotion"
                                                       class="input-sm form-control text-center input-datetimepicker p-1"
                                                       value="{{date('H')}}" data-empty="1" autocomplete="off">
                                                <label for="to-hour-update-happy-time-promotion">
                                                    <i class="icofont icofont-ui-alarm"></i>@lang('app.happy-time-promotion.update.to-hour')
                                                </label>
                                                <div class="line"></div>
                                            </div>
                                            <div class="link-href"></div>
                                        </div>
                                    </div>

                                    <div class="form-group validate-group">
                                        <div class="form-validate-input">
                                            <input type="text" id="from-date-update-happy-time-promotion"
                                                   class="input-sm form-control text-center input-datetimepicker p-1"
                                                   value="{{date('d/m/Y')}}" data-validate="calendar"
                                                   autocomplete="off"/>
                                            <label> <i
                                                    class="typcn typcn-document-text"></i>@lang('app.happy-time-promotion.update.from-date')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input">
                                            <input type="text" id="to-date-update-happy-time-promotion"
                                                   class="input-sm form-control text-center input-datetimepicker p-1"
                                                   value="{{date('d/m/Y')}}" data-validate="calendar"
                                                   autocomplete="off"/>
                                            <label> <i
                                                    class="typcn typcn-document-text"></i>@lang('app.happy-time-promotion.update.to-date')
                                            </label>
                                            <div class="line"></div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-lg-12 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.update.day-of-week')</label>
                                    </div>
                                    <div class="row" id="day-of-week-update-happy-time-promotion ">
                                        <div class="col-sm-3 form-group row">
                                            <label
                                                class="col-lg-4 col-form-label">@lang('app.happy-time-promotion.update.option-day-of-week.monday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="0">
                                                        <span class="cr"><i
                                                                class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label
                                                class="col-lg-4 col-form-label">@lang('app.happy-time-promotion.update.option-day-of-week.tuesday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="1">
                                                        <span class="cr"><i
                                                                class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label
                                                class="col-lg-4 col-form-label">@lang('app.happy-time-promotion.update.option-day-of-week.wednesday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="2"/>
                                                        <span class="cr"><i
                                                                class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label
                                                class="col-lg-4 col-form-label">@lang('app.happy-time-promotion.create.option-day-of-week.thursday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="3"/>
                                                        <span class="cr"><i
                                                                class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label
                                                class="col-lg-4 col-form-label">@lang('app.happy-time-promotion.create.option-day-of-week.friday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="4"/>
                                                        <span class="cr"><i
                                                                class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label
                                                class="col-lg-4 col-form-label">@lang('app.happy-time-promotion.create.option-day-of-week.saturday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="5"/>
                                                        <span class="cr"><i
                                                                class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label
                                                class="col-lg-4 col-form-label">@lang('app.happy-time-promotion.create.option-day-of-week.sunday')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="day-of-week" value="6"/>
                                                        <span class="cr"><i
                                                                class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 form-group row">
                                            <label
                                                class="col-lg-4 col-form-label">@lang('app.happy-time-promotion.create.all-day')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" name="all-day"/>
                                                        <span class="cr"><i
                                                                class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group  row px-3">
                                        <label
                                            class="col-lg-12 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.allow-uwop')</label>
                                        <div class="col-lg-8 col-form-label">
                                            <div class="checkbox-zoom zoom-primary">
                                                <label>
                                                    <input type="checkbox" id="allow-uwop-update-happy-time-promotion"/>
                                                    <span class="cr"><i
                                                            class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="central-meta">
                                    <div class="row merged5" id="data-upload-media-marketing-promotion-update">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"
                                             id="update-media-marketing-promotion ">
                                            <div class="item-box" id="div-upload-media-marketing-promotion-update">
                                                <div class="item-upload album">
                                                    <i class="fa fa-plus-circle"></i>
                                                    <div class="upload-meta">
                                                        <h5>Upload photo or album</h5>
                                                        <span>its only take a few seconds!</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <input class="d-none" type="file" multiple=""
                                                   id="upload-media-marketing-promotion-update" name="file[]"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="closeModalUpdateHappyTimePromotion()"
                        onkeypress="closeModalUpdateHappyTimePromotion()">
                    @lang('app.component.button.close')
                </button>
                <button type="button" class="btn btn-primary" onclick="saveModalUpdateHappyTimePromotion()"
                        onkeypress="saveModalUpdateHappyTimePromotion()" id="btn-update-customer-happy-time-promotion">
                    @lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>

<div class="d-none">
    <span id="msg-name-update-happy-time-promotion">@lang('app.happy-time-promotion.msg.name')</span>
    <span id="msg-description-update-happy-time-promotion">@lang('app.happy-time-promotion.msg.description')</span>
    <span id="msg-reusable-count-happy-time-promotion">@lang('app.happy-time-promotion.msg.reusable-count')</span>
    <span id="msg-type-update-happy-time-promotion">@lang('app.happy-time-promotion.msg.type')</span>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/promotion/happy_time/update.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
