<div class="modal fade" id="modal-create-customer-promotion" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.happy-time-promotion.create.title')</h4>
            </div>
            <div class="modal-body background-body-color" id="loading-modal-create-customer-promotion">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card card-block">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group row">
                                        <label
                                            class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.name')</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="name-create-happy-time-promotion" class="form-control"
                                                   data-empty="1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.short-description')</label>
                                        <div class="col-lg-8">
                                            <textarea id="short-description-create-happy-time-promotion" class="form-control" rows="4" cols="5" data-validate="note"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.description')</label>
                                        <div class="col-lg-8">
                                            <textarea id="description-create-happy-time-promotion" class="form-control" rows="5" cols="5" data-validate="note"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.min-order-total')</label>
                                        <div class="col-lg-8">
                                            <input id="min-order-total-create-happy-time-promotion" type="text" class="form-control text-right" data-type="currency-edit" placeholder="0" data-validate="price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.discount')</label>
                                        <div class="col-lg-6 pr-1">
                                            <input id="discount-create-happy-time-promotion"
                                                   class="form-control text-right" data-type="currency-edit" value="0"
                                                   data-validate-number>
                                        </div>
                                        <div class="col-lg-2 pl-1">
                                            <select class="form-control" id="discount-type-create-happy-time-promotion" border-select-template>
                                                <option
                                                    value="1">@lang('app.happy-time-promotion.create.discount-percent')</option>
                                                <option value="2">@lang('app.happy-time-promotion.create.discount-amount')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="div-max-promotion-create-happy-time-promotion">
                                        <label
                                            class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.max-promotion')</label>
                                        <div class="col-lg-8">
                                            <input id="max-promotion-create-happy-time-promotion" class="form-control text-right"
                                                   data-type="currency-edit" value="0" data-validate="price">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.branches')</label>
                                        <div class="col-lg-8">
                                            <select id="branches-create-happy-time-promotion" class="js-example-basic-single" multiple data-select-not-empty>
                                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', (int)Config::get('constants.type.checkbox.SELECTED'))->all() as $db)
                                                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.type')</label>
                                        <div class="col-lg-8">
                                            <select id="type-create-happy-time-promotion" class="js-example-basic-single" data-select-not-empty>
                                                <option selected disabled>@lang('app.component.option_default')</option>
                                                <option
                                                    value="0">@lang('app.happy-time-promotion.create.option-type.unknow')</option>
                                                <option
                                                    value="1">@lang('app.happy-time-promotion.create.option-type.promotion-food')</option>
                                                <option
                                                    value="2">@lang('app.happy-time-promotion.create.option-type.promotion-order')</option>
                                                <option
                                                    value="3">@lang('app.happy-time-promotion.create.option-type.promotion-golden-hour')</option>
                                                <option
                                                    value="4">@lang('app.happy-time-promotion.create.option-type.promotion-donate')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.from-hour')</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="from-hour-create-happy-time-promotion"
                                                   class="input-sm form-control text-center input-datetimepicker p-1"
                                                   value="{{date('H')}}" time-24 autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.to-hour')</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="to-hour-create-happy-time-promotion"
                                                   class="input-sm form-control text-center input-datetimepicker p-1"
                                                   value="{{date('H')}}" time-24 autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.from-date')</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="from-date-create-happy-time-promotion"
                                                   class="input-sm form-control text-center input-datetimepicker p-1"
                                                   value="{{date('d/m/Y')}}" data-validate="calendar" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.to-date')</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="to-date-create-happy-time-promotion"
                                                   class="input-sm form-control text-center input-datetimepicker p-1"
                                                   value="{{date('d/m/Y')}}" data-validate="calendar" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.day-of-week')</label>
                                        <div class="col-lg-8">
                                            <div class="checkbox-zoom zoom-primary" id="day-of-week-create-happy-time-promotion">
                                                <label class="mr-1">
                                                    <input type="checkbox" name="day-of-week" value="0">
                                                    <span class="cr"><i
                                                            class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span>@lang('app.happy-time-promotion.create.option-day-of-week.monday')</span>
                                                </label>
                                                <label class="mr-1">
                                                    <input type="checkbox" name="day-of-week" value="1">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span>@lang('app.happy-time-promotion.create.option-day-of-week.tuesday')</span>
                                                </label>
                                                <label class="mr-1">
                                                    <input type="checkbox" name="day-of-week" value="2">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span>@lang('app.happy-time-promotion.create.option-day-of-week.wednesday')</span>
                                                </label>
                                                <label class="mr-1">
                                                    <input type="checkbox" name="day-of-week" value="3">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span>@lang('app.happy-time-promotion.create.option-day-of-week.thursday')</span>
                                                </label>
                                                <label class="mr-1">
                                                    <input type="checkbox" name="day-of-week" value="4">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span>Thứ sáu</span>
                                                </label>
                                                <label class="mr-1">
                                                    <input type="checkbox" name="day-of-week" value="5">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span>Thứ bảy</span>
                                                </label>
                                                <label class="mr-1">
                                                    <input type="checkbox" name="day-of-week" value="6">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span>Chủ nhật</span>
                                                </label>
                                                <label class="mr-1">
                                                    <input type="checkbox" name="all-day">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span>Tất cả</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label font-weight-bold my-auto">@lang('app.happy-time-promotion.create.allow-uwop')</label>
                                        <div class="col-lg-8">
                                            <div class="checkbox-fade fade-in-primary m-auto">
                                                <label class="my-0">
                                                    <input type="checkbox" id="allow-uwop-create-happy-time-promotion"/>
                                                    <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="font-weight-bold mx-3 mb-3">Ảnh chương trình</div>

                                <div class="dropzone-vcustom-input w-100 mx-4">
                                    <div class="dropzone-vcustom-input-inner">
                                        <div id="dropzone-content" >
                                            <div class="dropzone-vcustom-input-icon">
                                                <i class="ti-cloud-up"></i>
                                            </div>
                                            <label for="choose-file-upload-promotion-img" class="dropzone-vcustom-input-choose-btn btn btn-success waves-effect waves-light">
                                                @lang('app.component.button.choose-img')
                                                <input type="file" name="promotion-img-list" multiple id="choose-file-upload-promotion-img" class="d-none">
                                            </label>
                                        </div>
                                        <div id="preview-promotion-image" class="row d-none">
                                            <label class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 mb-4" style="cursor: pointer" for="choose-file-upload-promotion-img">
                                                <div class="">
                                                    <div class="form-image" style="width: 0!important;">
                                                        <label for="choose-file-upload-promotion-img" class="" href="javascript:void(0)">
                                                            <div class="fa p-0 m-0 fa fa-plus-circle icon-tooltip rounded-circle text-green-gg-custom" style="display: contents!important;font-size: 3rem!important;cursor: pointer!important;"></div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled" onclick="closeModalCreateHappyTimePromotion()" onkeypress="closeModalCreateHappyTimePromotion()">
                    @lang('app.component.button.close')
                </button>
                <button type="button" class="btn btn-primary" onclick="saveModalCreateHappyTimePromotion()" onkeypress="saveModalCreateHappyTimePromotion()" id="btn-create-customer-promotion">
                    @lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>

<div class="d-none">
    <span id="msg-name-create-happy-time-promotion">@lang('app.happy-time-promotion.msg.name')</span>
    <span id="msg-description-create-happy-time-promotion">@lang('app.happy-time-promotion.msg.description')</span>
    <span id="msg-reusable-count-promotion">@lang('app.happy-time-promotion.msg.reusable-count')</span>
    <span id="msg-type-create-happy-time-promotion">@lang('app.happy-time-promotion.msg.type')</span>
    <span id="current-date">{{date('d/m/Y')}}</span>
    <span id="current-hour">{{date('H')}}</span>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/promotion/happy_time/create.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
