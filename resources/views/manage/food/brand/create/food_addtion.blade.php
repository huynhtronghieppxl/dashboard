<div class="modal fade" id="modal-create-food-addition-brand-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom" id="loading-modal-create-food-addition-brand-manage">
            <div class="modal-header">
                <h4 class=" modal-title" >@lang('app.food-brand-manage.create.title-addition')</h4>
                <button type="button" class="close ml-4" onclick="closeModalCreateFoodAdditionManage()" onkeypress="closeModalCreateFoodAdditionManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" style="text-align: left !important;"
                 id='tab-setting-food-addition-create-food-manager'>
                <div class="row">
                    <div class="col-lg-12 edit-flex-auto-fill pr-1">
                        <div class="card-block card m-0 flex-sub pb-0">
                            <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15" id="title-create-info-food-addition-brand-manage" >
                                @lang('app.food-brand-manage.create.food-info')
                            </h6>
                            <div class="pt-4 row">
                                <div class="col-lg-3 p-0 text-center">
                                    <div class="profile-thumb">
                                        <img class="profile-image-avatar" alt="" src="{{asset('images/food_file.jpg',env('IS_DEPLOY_ON_SERVER'))}}"
                                             id="picture-create-food-addition-brand-manage" data-url-avt=""
                                             data-url-thumb
                                             style="border-radius: 50%;border: 3px solid #c1c1c1;width: 11rem;height: 11rem">
                                        <div class="edit-profile pointer" style="right: 45px">
                                            <label class="fileContainer">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" id="input-picture-create-food-addition-brand-manage"
                                                       accept="image/*">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 pt-1 px-0">
                                    <div class="row">
                                        <!--tên món ăn-->
                                        <div class="form-group col-lg-6 m-0 validate-group">
                                            <div class="form-validate-input">
                                                <input type="text" id="name-create-food-addition-brand-manage"
                                                       class="form-control" data-emoji="1" data-spec="1"
                                                       data-max-length="50" data-empty="1" data-min-length="2">
                                                <label for="name-create-food-addition-brand-manage">
                                                    @lang('app.food-brand-manage.create.name')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                        <!-- code -->
                                        <div class="form-group col-lg-6 m-0 validate-group">
                                            <div class="form-validate-input">
                                                <input type="text" id="code-create-food-addition-brand-manage"
                                                       data-spec="1" data-emoji="1" class="form-control"
                                                       data-min-length="2" data-empty="1" data-max-length="50">
                                                <label for="code-create-food-brand-manage">
                                                    @lang('app.food-brand-manage.create.code')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                        <!-- unit -->
                                        <div class="form-group col-lg-6 m-0 hidden-item select2_theme validate-group">
                                            <div class="form-validate-select ">
                                                <div class="col-lg-12 mx-0 px-0">
                                                    <div class="col-lg-12 pr-0 select-material-box">
                                                        <select data-icon="fa-book"
                                                                class="js-example-basic-single select2-hidden-accessible"
                                                                data-select="1"
                                                                id="unit-create-food-addition-brand-manage"
                                                                tabindex="-1" aria-hidden="true">
                                                            <option disabled selected
                                                                    hidden>@lang('app.component.option_default')</option>
                                                        </select>
                                                        <label class="icon-validate">
                                                            @lang('app.food-brand-manage.create.unit')
                                                            @include('layouts.start')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- category -->
                                        <div class="form-group col-lg-6 m-0 select2_theme validate-group"
                                             id="id-addition-create-food-manage">
                                            <div class="form-validate-select ">
                                                <div class="col-lg-12 mx-0 px-0">
                                                    <div class="col-lg-12 pr-0 select-material-box">
                                                        <select data-icon="fa-book"
                                                                class="js-example-basic-single select2-hidden-accessible"
                                                                data-select="1"
                                                                id="category-create-food-addition-brand-manage"
                                                                tabindex="-1" aria-hidden="true">
                                                            <option disabled selected
                                                                    hidden>@lang('app.component.option_default')</option>
                                                        </select>
                                                        <label class="icon-validate">
                                                            @lang('app.food-brand-manage.create.category')
                                                            @include('layouts.start')
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12 select2_theme validate-group"
                                             id="check-note-create-food-brand-manage">
                                            <div class="form-validate-select ">
                                                <div class="col-lg-12 mx-0 px-0">
                                                    <div class="col-lg-12 pr-0 select-material-box">
                                                        <select id="note-addition-food-brand-manage"
                                                                class="js-example-basic-single col-sm-12 select2-hidden-accessible"
                                                                multiple="" tabindex="-1" aria-hidden="true">
                                                        </select>
                                                        <label class="icon-validate">
                                                            @lang('app.food-brand-manage.create.note-food')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <!-- time -->
                                        <div class="form-group w-100 validate-group">
                                            <div class="form-validate-input ">
                                                <input id="time-create-addition-food-brand-manage" type="text"
                                                       class="form-control text-right" value="0" data-max="120"
                                                       data-empty="1" data-number="1">
                                                <label>
                                                    @lang('app.food-brand-manage.create.time')
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group validate-group w-100">
                                            <div class="form-validate-textarea">
                                                <div class="form__group pt-2">
                                                    <textarea rows="3" cols="1"
                                                              id="description-create-food-addition-brand-manage"
                                                              data-note-max-length="1000"></textarea>
                                                    <label for="description-create-food-addition-brand-manage"
                                                           class="form__label icon-validate d-flex">
                                                        @lang('app.food-brand-manage.create.description')
                                                    </label>
                                                    <div class="textarea-character" id="char-count">
                                                        <span>0/300</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-4 w-100">
                                    <!--sell by-->
                                    <div class="form-group col-lg-3 hidden-item class-food-create-food-manage class-combo-create-food-manage pl-0 class-addtion-create-food-manage">
                                        <div class=" col-lg-12 form-group checkbox-group pl-0">
                                            <label
                                                class="title-checkbox">@lang('app.food-brand-manage.update.sell-by')</label>
                                            <div class="row col-lg-12 pl-0"
                                                 id="sell-by-create-addition-food-brand-manage">
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="radio" name='sell-by-create-addition' value="0"
                                                               data-icon="" checked>
                                                        <label class="name-checkbox"
                                                               for="print-kitchen-create-food-brand-manage">@lang('app.food-brand-manage.create.option-sell-by-lot')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 validate-group pl-0" >
                                            <div class="form-validate-checkbox ">
                                                <div class="checkbox-form-group">
                                                    <input type="checkbox" id="is-like-addition-food-brand-manage">
                                                    <label class="name-checkbox">
                                                        @lang('app.food-brand-manage.create.like-food')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- take away -->
                                    <div class="d-none">
                                    <div class="form-group col-lg-3 hidden-item class-food-create-food-manage class-combo-create-food-manage class-addtion-create-food-manage d-none pl-0">
                                        <div class=" col-lg-12 form-group checkbox-group pl-0">
                                            <label
                                                class="title-checkbox">@lang('app.food-brand-manage.create.take-away')</label>
                                            <div class="row col-lg-12 pl-0"
                                                 id="take-away-addition-create-food-brand-manage">
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="radio" name='take-addition' value="0"
                                                               data-icon=" " checked>
                                                        <label class="name-checkbox"
                                                               for="print-kitchen-create-food-brand-manage">@lang('app.food-brand-manage.create.option-no-take-away')
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="radio" name='take-addition' value="1"
                                                               data-icon=" ">
                                                        <label class="name-checkbox"
                                                               for="print-kitchen-create-food-brand-manage">@lang('app.food-brand-manage.create.option-take-away')
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="radio" name='take-addition' value="2"
                                                               data-icon=" ">
                                                        <label class="name-checkbox"
                                                               for="print-kitchen-create-food-brand-manage">@lang('app.food-brand-manage.create.option-take-all')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    </div>
                                    <!-- print kitchen -->
                                    <div class="form-group col-lg-3 validate-group">
                                        <div class="form-validate-checkbox" style="padding-top: 23px">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" id="print-create-addition-food-brand-manage"
                                                       required="">
                                                <label class="name-checkbox">
                                                    @lang('app.food-brand-manage.create.print-kitchen')
                                                </label>
                                            </div>
                                        </div>
                                        <!-- stamp -->
                                        <div class="form-validate-checkbox" style="padding-top: 10px">
                                            <div class="checkbox-form-group">
                                                <input type="checkbox" id="print-stamp-addition-food-brand-manage"
                                                       disabled
                                                       required="">
                                                <label class="name-checkbox"
                                                        >
                                                    @lang('app.food-brand-manage.create.print-stamp')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15">
                                @lang('app.food-brand-manage.create.food-price')
                                <label class="text-lowercase text-warning">(*) Nhập giá chính xác sẽ cho báo cáo chính
                                    xác </label>
                            </h6>
                            <div class="row pt-4">
                                <!--giá vốn-->
                                <div class="form-group col-lg-3 m-0 hidden-item validate-group pl-0">
                                    <div class="form-validate-input ">
                                        <input id="original-create-addition-food-brand-manage" type="text"
                                               class="form-control text-right" value="0" data-number="1" data-max="999999999">
                                        <label for="original-create-addition-food-brand-manage">
                                            @lang('app.food-brand-manage.create.original-price')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                </div>
                                <!--giá bán-->
                                <div
                                    class="form-group col-lg-3 m-0 hidden-item class-food-create-food-manage class-combo-create-food-manage class-addtion-create-food-manage validate-group">
                                    <div class="form-validate-input ">
                                        <input type="text" class="form-control text-right" placeholder="0"
                                               id="price-create-addition-food-brand-manage" data-number="1" data-max="999999999"
                                               value="0">
                                        <label for="price-create-addition-food-brand-manage">
                                            @lang('app.food-brand-manage.create.price')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center mt-1 float-right">
                                        @if( Session::get(SESSION_KEY_LEVEL) >= 8)
                                            @lang('app.food-brand-manage.create.point'):
                                            <div style="width: auto" class="seemt-orange ml-1"
                                                 id="point-create-addition-food-brand-manage">0
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!--lợi nhuận-->
                                <div class="form-group col-lg-3 validate-group" style="margin-bottom: 0px !important;">
                                    <div class="form-validate-input">
                                        <input type="text" class="form-control text-right" disabled
                                               id="profit-create-addition-food-brand-manage" value="0">
                                        <label for="undefined">
                                            @lang('app.food-brand-manage.create.profit')
                                            @include('layouts.start')
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center mt-1 float-right">
                                        @lang('app.food-brand-manage.create.profit_margin')
                                        @include('manage.food.brand.tooltip.profit_rate_by_price'):
                                        <div style="width: auto" class="seemt-orange ml-1"
                                             id="profit-margin-create-addition-food-brand-manage">0%
                                        </div>
                                    </div>
                                </div>
                                <!-- VAT -->
                                <div
                                    class="form-group col-lg-3 hidden-item class-food-create-food-manage select2_theme validate-group"
                                    id="check-vat-create-food-brand-manage">
                                    <div class="form-validate-select ">
                                        <div class="col-lg-12 mx-0 px-0">
                                            <div class="col-lg-12 pr-0 select-material-box">
                                                <select id="vat-create-addition-food-brand-manage"
                                                        class="col-sm-12 select-not-select2 select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option value="0" disabled selected
                                                            hidden>@lang('app.component.option_default')</option>
                                                </select>
                                                <label class="icon-validate">
                                                    @lang('app.food-brand-manage.create.vat')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Session::get(SESSION_KEY_LEVEL) > 3)
                                <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15">
                                    @lang('app.food-brand-manage.create.food-admin')
                                </h6>
                                <div class="row pt-4 ">
                                    <!-- review -->
                                    @if(Session::get(SESSION_KEY_LEVEL) >= 8)
                                    <div class="form-validate-checkbox  col-lg-3 pl-0 m-0  ">
                                        <div class="checkbox-form-group">
                                            <input type="checkbox"
                                                   id="review-create-addition-food-brand-manage">
                                            <label class="name-checkbox"
                                                   >
                                                @lang('app.food-brand-manage.create.review')
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                    <!--định lượng hàng hóa-->
                                    <div class="form-validate-checkbox  m-0 col-lg-3">
                                        <div class="checkbox-form-group">
                                            <input type="checkbox"
                                                   id="quantitative-create-addition-food-brand-manage">
                                            <label class="name-checkbox">
                                                @lang('app.food-brand-manage.create.quantitative')
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-none"
                                         id="show-div-quantitative-create-addition-food-brand-manage">
                                        <div class="form-group select2_theme validate-group">
                                            <div class="form-validate-select ">
                                                <div class="col-lg-12 mx-0 px-0">
                                                    <div class="col-lg-12 pr-0 select-material-box">
                                                        <select id="material-create-addition-food-brand-manage"
                                                                class="js-example-basic-single select2-hidden-accessible"
                                                                data-select="1" tabindex="-1" aria-hidden="true">
                                                            <option selected
                                                                    disabled>@lang('app.component.option_default')</option>
                                                        </select>
                                                        <label>
                                                            @lang('app.food-brand-manage.create.quantitative')
                                                            @include('layouts.start')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-none" id="show-div-material-unit-create-addtion-brand-manage">
                                        <div class="form-group select2_theme validate-group">
                                            <div class="form-validate-select ">
                                                <div class="col-lg-12 mx-0 px-0">
                                                    <div class="col-lg-12 pr-0 select-material-box">
                                                        <select id="material-unit-create-addtion-brand-manage"
                                                                class="js-example-basic-single select2-hidden-accessible"
                                                                data-select="1" tabindex="-1" aria-hidden="true">
                                                            <option selected
                                                                    disabled>@lang('app.component.option_default')</option>
                                                        </select>
                                                        <label>
                                                            @lang('app.food-brand-manage.create.material-unit')
                                                            @include('layouts.start')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if((Session::get(SESSION_KEY_LEVEL) === 1 && Session::get(SESSION_KEY_LEVEL) === 3))
                                        <!-- cách tính điểm -->
                                        <div class="form-group col-lg-3 m-0 hidden-item">
                                            <label
                                                class="col-lg-12 font-weight-bold py-2 col-form-label">@lang('app.food-brand-manage.create.point-method')</label>
                                            <div class="form-radio ">
                                                <div class="row col-lg-12">
                                                    <div class="radio radio-inline col-lg-6">
                                                        <label>
                                                            <input type="radio" name="point" value="0" checked
                                                                   data-icon="icofont-shrimp">
                                                            <i class="helper"></i>@lang('app.food-brand-manage.create.option-bill-point-method')
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline col-lg-6">
                                                        <label>
                                                            <input type="radio" name="point" value="1">
                                                            <i class="helper"></i>@lang('app.food-brand-manage.create.option-order-point-method')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- aloline -->
                                        <div
                                            class="form-group col-lg-3 m-0 hidden-item class-food-create-food-manage class-combo-create-food-manage class-addtion-create-food-manage">
                                            <label
                                                class="col-lg-4 col-form-label">@lang('app.food-brand-manage.create.party')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" id="party-create-food-brand-manage">
                                                        <span class="cr"><i
                                                                class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 d-none"
                                             id="show-div-quantitative-create-food-brand-manage">
                                            <div class="form-group ">
                                                <label class="text text-warning text-right" id="text-quantitive-food">(*)
                                                    1 <span
                                                        class="unit-name"></span> <span class="food-name"></span> = 1
                                                    <span
                                                        class="unit-material-name"></span> <span
                                                        class="material-name"></span></label>
                                                <div class="col-lg-6 ">
                                                    <select id="material-create-food-brand-manage"
                                                            class="js-example-basic-single"></select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalCreateFoodAdditionManage()"
                        onkeypress="resetModalCreateFoodAdditionManage()" data-toggle="tooltip" data-placement="top"
                        data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     id="btn-save-create-food-combo-brand-manage"
                     onclick="saveAdditionFoodCreateFoodBrandManage()"
                     onkeypress="saveAdditionFoodCreateFoodBrandManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>

            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/create/food_addtion.js?version=27',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
