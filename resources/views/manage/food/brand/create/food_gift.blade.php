<div class="modal fade" id="modal-create-gift-food-brand-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom" id="loading-modal-create-food-brand-manage">
            <div class="modal-header">
                <h4 class=" modal-title">@lang('app.food-brand-manage.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateGiftFoodBradManage()" onkeypress="closeModalCreateGiftFoodBradManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" >
                <div class="row">
                    <div class="col-lg-12 edit-flex-auto-fill pr-1">
                        <div class="card-block flex-sub col-lg-12">
                            <div class="row col-lg-12 justify-content-lg-between align-items-center">
                                <div class="col-lg-8 row p-0">
                                    <div class="form-group col-lg-6 m-0">
                                        <label class="col-lg-4 col-form-label">@lang('app.food-brand-manage.create.name')</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="name-create-gift-food-brand-manage" class="form-control" data-validate="empty,max-length-255" data-icon="fa-cutlery" >
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6 m-0">
                                        <label class="col-lg-4 col-form-label">@lang('app.food-brand-manage.create.code')</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="code-create-gift-food-brand-manage" class="form-control" data-validate="empty,max-length-255" data-icon="fa-code-fork">
                                        </div>
                                    </div> <!-- code -->
                                    <div class="form-group col-lg-6 m-0 ">
                                        <label class="col-lg-4 col-form-label">@lang('app.food-brand-manage.create.unit')</label>
                                        <div class="col-lg-8">
                                            <select data-icon="fa-cubes" class="js-example-basic-single" id="unit-create-gift-food-brand-manage" data-validate="select" >
                                                <option>@lang('app.component.option_default')</option>
                                            </select>
                                        </div>
                                    </div> <!-- unit -->
                                    <div class="form-group col-lg-6 m-0">
                                        <label class="col-lg-4 col-form-label">@lang('app.food-brand-manage.create.category')</label>
                                        <div class="col-lg-8">
                                            <select data-icon="fa-book" class="js-example-basic-single" id="category-create-gift-food-brand-manage" data-validate="select">
                                                <option>@lang('app.component.option_default')</option>
                                            </select>
                                        </div>
                                    </div> <!-- category -->
                                    <!-- print -->
                                    <div class="form-group col-lg-6 d-none">
                                        <label class="col-lg-4 col-form-label">@lang('app.food-brand-manage.create.review')</label>
                                        <div class="col-lg-8">
                                            <div class="checkbox-zoom zoom-primary">
                                                <label>
                                                    <input type="checkbox" id="review-create-gift-food-brand-manage">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div> <!-- review -->

                                    <div class="form-group col-lg-6" id="cook-create-gift-food-brand-manage">
                                        <label class="col-lg-12 font-weight-bold py-2 col-form-label">@lang('app.food-brand-manage.create.cook')</label>
                                        <div class="form-radio ">
                                            <div class="row col-lg-12">
                                                <div class="radio radio-inline col-lg-4">
                                                    <label>
                                                        <input type="radio" name="cook_gift" value="0" checked>
                                                        <i class="helper"></i>@lang('app.food-brand-manage.create.option-food-cook')
                                                    </label>
                                                </div>
                                                <div class="radio radio-inline col-lg-4">
                                                    <label>
                                                        <input type="radio" name="cook_gift" value="1">
                                                        <i class="helper"></i>@lang('app.food-brand-manage.create.option-grill-cook')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- cook -->
                                    <div class="form-group col-lg-6">
                                        <label class="col-lg-4 col-form-label">@lang('app.food-brand-manage.create.time')</label>
                                        <div class="col-lg-8">
                                            <input id="time-create-gift-food-brand-manage" class="form-control text-right" data-type="currency-edit" type="text" placeholder="0" value="1" data-validate="number,min-value-1,max-value-999999999999" data-icon="icofont-ui-timer">
                                        </div>
                                    </div>
                                    <!-- time -->
                                    <div class="form-group col-lg-6">
                                        <label class="col-lg-12 font-weight-bold py-2 col-form-label">@lang('app.food-brand-manage.create.sell-by')</label>
                                        <div class="form-radio ">
                                            <div class="row col-lg-12" id="sell-by-create-gift-food-brand-manage">
                                                <div class="radio radio-inline col-lg-6">
                                                    <label>
                                                        <input type="radio" name="sell_gift" value="0" data-icon=" " checked>
                                                        <i class="helper"></i>@lang('app.food-brand-manage.create.option-sell-by-lot')
                                                    </label>
                                                </div>
                                                <div class="radio radio-inline col-lg-6">
                                                    <label>
                                                        <input type="radio" name="sell_gift" value="1">
                                                        <i class="helper"></i>@lang('app.food-brand-manage.create.option-sell-by-weight')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6" id="check-note-create-gift-food-brand-manage">
                                        <label class="col-lg-4 col-form-label">@lang('app.food-brand-manage.create.note-food')</label>
                                        <div class="col-lg-8">
                                            <select id="note-gift-food-brand-manage" class="js-example-basic-single col-sm-12" multiple data-icon="fa-cutlery"></select>
                                        </div>
                                    </div>
                                    <!-- restaurant -->--}}
                                    <div class="form-group col-lg-12">
                                        <label class="col-lg-4 col-form-label">@lang('app.food-brand-manage.create.description')</label>
                                        <div class="col-lg-8">
                                            <textarea id="description-create-gift-food-brand-manage" class="form-control" rows="6" cols="5" data-validate=""></textarea>
                                        </div>
                                    </div>
                                    <!-- note -->
                                    @if(Session::get(SESSION_KEY_TMS) === 1 && Session::get(SESSION_KEY_LEVEL) === 3)

                                    <div class="col-lg-6"
                                         id="check-note-create-gift-food-brand-manage">
                                        <div class="form-group">
                                            <label class="col-lg-4 col-form-label">@lang('app.food-brand-manage.create.quantitative')</label>
                                            <div class="col-lg-2">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" id="quantitative-create-gift-food-brand-manage">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- addition -->
                                    @endif
                                    <div class="col-lg-4 d-none" id="show-div-quantitative-create-gift-food-brand-manage">
                                        <div class="form-group " >
                                            <label class="text text-warning text-right" id="text-quantitive-food">(*) 1 <span class="unit-name"></span> <span class="food-name"></span> = 1 <span class="unit-material-name"></span> <span class="material-name"></span></label>
                                            <div class="col-lg-6 " >
                                                <select id="material-create-gift-food-brand-manage" class="js-example-basic-single" ></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 avatar-food p-0 mb-4">
                                    <div class="profile-author-thumb">
                                        <img alt="" src="{{asset('images/food_file.jpg',env('IS_DEPLOY_ON_SERVER'))}}"
                                             id="picture-create-gift-food-brand-manage" data-url-avt="" data-url-thumb>
                                        <div class="edit-dp pointer">
                                            <label class="fileContainer">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" id="input-picture-create-gift-food-brand-manage" accept="image/*">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div >
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-primary waves-effect" id="btn-save-create-gift-food-brand-manage" onclick="saveGiftFoodCreateFoodBrandManage()"
                        onkeypress="saveGiftFoodCreateFoodBrandManage()"
                        title="@lang('app.component.title-button.save')">@lang('app.component.button.save')</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/create/food_gift.js?version=7',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
