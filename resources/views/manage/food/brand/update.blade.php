
<div class="modal fade" id="modal-update-food-brand-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom" id="loading-modal-update-food-brand-manage">
            <div class="modal-header">
                <h4 class="modal-title"
                    id="check-title-food-update-food-brand-manage">@lang('app.food-brand-manage.update.tab1')</h4>
                <button type="button" class="close ml-4" onclick="closeModalUpdateFoodBrandManage()" onkeypress="closeModalUpdateFoodBrandManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id='tab-info-update-food-manager'>
                <div class="row">
                    <div class="col-lg-12 m-0">
                        <div class="card-block card m-0">
                            <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15" id="title-update-info-food-brand-manage">
                                @lang('app.food-brand-manage.update.food-info')
                            </h6>
                            <div class="row pt-4">
                                <div class="col-lg-3 p-0 text-center">
                                    <div class="profile-thumb">
                                        <img class="profile-image-avatar" alt=""
                                             onerror="imageDefaultOnLoadError($(this))"
                                             src="{{asset('images/food_file.jpg', env('IS_DEPLOY_ON_SERVER'))}}"
                                             id="picture-update-food-brand-manage" data-url-avt="" data-url-thumb
                                             style="border-radius: 50%;border: 3px solid #c1c1c1;width: 11rem;height: 11rem">
                                        <div class="edit-profile pointer" style="right: 45px">
                                            <label class="fileContainer">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" id="input-picture-update-food-brand-manage"
                                                       accept="image/*">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 pt-1 px-0">
                                    <div class="row">
                                        <!--tên món-->
                                        <div class="form-group col-lg-12 m-0 validate-group">
                                            <div class="form-validate-input">
                                                <input id="name-update-food-brand-manage" class="form-control"
                                                       type="text" data-empty="1" data-spec="1" data-min-length="2" data-emoji="1"
                                                       data-max-length="50">
                                                <label for="name-update-food-brand-manage">
                                                    @lang('app.food-brand-manage.update.name')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                        <!--mã món-->
                                        <div class="form-group col-lg-6 m-0 validate-group d-none">
                                            <div class="form-validate-input">
                                                <input id="code-update-food-brand-manage" disabled class="form-control"
                                                       data-spec="1" data-emoji="1" data-empty="1" data-min-length="2"
                                                       data-max-length="50">
                                                <label for="code-update-food-brand-manage">
                                                    @lang('app.food-brand-manage.update.code')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--đơn vị-->
                                        <div class="form-group col-lg-6 m-0 validate-group">
                                            <div class="form-validate-select">
                                                <div class="select-material-box">
                                                    <select data-icon="fa-book"
                                                            class="js-example-basic-single select2-hidden-accessible"
                                                            data-select="1" id="unit-update-food-brand-manage">
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.food-brand-manage.update.unit')
                                                        @include('layouts.start')</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- category -->
                                        <div class="form-group col-lg-6 m-0 select2_theme validate-group">
                                            <div class="form-validate-select">
                                                <div class="select-material-box">
                                                    <select data-icon="fa-book"
                                                            class="js-example-basic-single select2-hidden-accessible"
                                                            data-select="1" id="category-update-food-brand-manage">
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.food-brand-manage.update.category')
                                                        @include('layouts.start')</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 select2_theme validate-group"
                                             id="check-col-node-food-addition-update-food-brand-manage">
                                            <!--sở thích món thường-->
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select id="note-update-food-brand-manage"
                                                            class="js-example-basic-single col-sm-12 select2-hidden-accessible"
                                                            multiple="">
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.food-brand-manage.update.note-food')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--món bán kèm-->
                                        <div class="form-group col-lg-6 select2_theme validate-group"
                                             id="check-additional-update-food-brand-manage">
                                            <div class="form-validate-select">
                                                <div class=" pr-0 select-material-box">
                                                    <select id="additional-update-food-brand-manage"
                                                            class="js-example-basic-single col-sm-12 select2-hidden-accessible"
                                                            multiple="">
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.food-brand-manage.update.additional')
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="link-href">
                                                <span
                                                    class="text-warning">(*) @lang('app.food-brand-manage.update.sub-additional')</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 pt-1">
                                    <div class="row">
                                        <!-- time -->
                                        <div class="form-group w-100 validate-group">
                                            <div class="form-validate-input">
                                                <input id="time-update-food-brand-manage"
                                                       class="form-control" type="text"
                                                       data-max="120" data-number="1">
                                                <label for="time-update-food-brand-manage">
                                                    @lang('app.food-brand-manage.update.time')
                                                </label>
                                            </div>
                                        </div>
                                        <!-- ghi chú -->
                                        <div class="form-group validate-group w-100">
                                            <div class="form-validate-textarea">
                                                <div class="form__group pt-2">
                                                    <textarea id="description-update-food-brand-manage"
                                                              class="form__field"
                                                              rows="3" cols="1"
                                                              data-note-max-length="1000"></textarea>
                                                    <label for="description-update-food-brand-manage"
                                                           class="form__label icon-validate">
                                                        @lang('app.food-brand-manage.update.description')
                                                    </label>
                                                    <div class="textarea-character" id="char-count">
                                                        <span>0/300</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100" id="tab-food-brand-manage">
                                    <div class="row w-100">
                                        <div class="form-group col-lg-3 hidden-item class-food-create-food-manage class-addition-create-food-manage class-gift-create-food-manage pl-0" style="margin-bottom: 0 !important">
                                            <div class=" col-lg-12 form-group checkbox-group pl-0" >
                                                <label class="title-checkbox">@lang('app.food-brand-manage.update.sell-by') </label>
                                                <div class="row" id="sell-by-update-food-brand-manage">
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name="sell" value="0"
                                                                   data-icon=" " >
                                                            <label class="name-checkbox" >@lang('app.food-brand-manage.update.option-sell-by-lot')
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name="sell" value="1">
                                                            <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">@lang('app.food-brand-manage.update.option-sell-by-weight')
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- hình thức bán--}}
                                        <div class="form-group col-lg-4 pl-0 d-none" style="margin-bottom: 0 !important">
                                            <div class=" col-lg-12 form-group checkbox-group  pl-0">
                                                <label class="title-checkbox"> @lang('app.food-brand-manage.update.take-away')</label>
                                                <div class="row" id="take-away-update-food-brand-manage">
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name="take-food" value="0"  data-icon="icofont-ui-file" >
                                                            <label class="name-checkbox"  >@lang('app.food-brand-manage.create.option-no-take-away')
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name="take-food" value="1"
                                                                   data-icon="icofont-ui-file" >
                                                            <label class="name-checkbox"  >@lang('app.food-brand-manage.update.option-take-away')
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name="take-food" value="2"
                                                                   data-icon="icofont-ui-file">
                                                            <label class="name-checkbox"  >@lang('app.food-brand-manage.update.option-take-all')
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  <!-- takeaway -->
                                        <!--In bếp/kho bia(Bar)-->
                                        <div class="form-group col-lg-3 validate-group">
                                            <div class="form-validate-checkbox" style="padding-top: 21px">
                                                <div class="checkbox-form-group">
                                                    <input type="checkbox" id="print-kitchen-update-food-brand-manage">
                                                    <label class="name-checkbox"
                                                           for="print-kitchen-create-food-brand-manage">
                                                        @lang('app.food-brand-manage.update.print')
                                                    </label>
                                                </div>
                                            </div>
                                            <!--In hồ hải sản-->
                                            <div class="form-validate-checkbox  pb-0 d-none disabled"
                                                 id="print-lake-update-food-brand-manage-div">
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="checkbox" id="print-lake-update-food-brand-manage">
                                                        <label class="name-checkbox"
                                                               for="print-lake-update-food-brand-manage">
                                                            @lang('app.food-brand-manage.update.print-lake')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--In tem-->
                                            <div class="form-validate-checkbox  disabled pb-0"
                                                 id="print-tem-update-food-brand-manage-div">
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="checkbox" class="disabled"
                                                               id="print-tem-update-food-brand-manage" disabled>
                                                        <label class="name-checkbox"
                                                               >
                                                            @lang('app.food-brand-manage.update.print-stamp')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15 w-100">
                                        @lang('app.food-brand-manage.update.food-price')
                                        <label class="text-lowercase text-warning">(*) Nhập giá chính xác sẽ cho báo cáo
                                            chính xác </label>
                                    </h6>
                                    <div class="row pt-4 w-100">
                                        <!--Giá Vốn-->
                                        <div class="form-group col-lg-3 m-0 validate-group">
                                            <div class="form-validate-input">
                                                <input id="original-update-food-brand-manage" type="text"
                                                       class="form-control text-right" data-number="1"
                                                       data-max="999999999">
                                                <label for="original-update-food-brand-manage">
                                                    @lang('app.food-brand-manage.update.original-price')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                        <!--Giá bán-->
                                        <div class="form-group col-lg-3 m-0 validate-group">
                                            <div class="form-validate-input">
                                                <input type="text" class="form-control text-right" data-number="1"
                                                       id="price-update-food-brand-manage" data-min="1000"
                                                       data-max="999999999">
                                                <label for="price-update-food-brand-manage">
                                                    @lang('app.food-brand-manage.update.price')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="d-flex align-items-center mt-1 float-right">
                                                @if( Session::get(SESSION_KEY_LEVEL) >= 8)
                                                    @lang('app.food-brand-manage.update.point'):
                                                     <div style="width: auto" class="seemt-orange ml-1" id="point-update-food-brand-manage">0</div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--lợi nhuân-->
                                        <div class="mb-0 form-group col-lg-3">
                                            <div class="form-validate-input">
                                                <input type="text" class="form-control text-right" disabled
                                                       id="profit-update-food-brand-manage">
                                                <label for="undefined">
                                                    @lang('app.food-brand-manage.update.profit')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="d-flex align-items-center mt-1 float-right">
                                                @lang('app.food-brand-manage.create.profit_margin')
                                                @include('manage.food.brand.tooltip.profit_rate_by_price'):
                                                <div style="width: auto" class="seemt-orange ml-1" id="profit-margin-update-food-brand-manage">   0%</div>
                                            </div>
                                        </div>
                                        <!-- VAT -->
                                        <div class="form-group col-lg-3 select2_theme validate-group"
                                             id="check-vat-update-food-brand-manage">
                                            <div class="form-validate-select ">
                                                <div class="col-lg-12 mx-0 px-0">
                                                    <div class="col-lg-12 pr-0 select-material-box">
                                                        <select id="vat-update-food-brand-manage"
                                                                class="js-example-basic-single col-sm-12 select2-hidden-accessible">
                                                        </select>
                                                        <label class="icon-validate">
                                                            @lang('app.food-brand-manage.update.vat')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(Session::get(SESSION_KEY_LEVEL) >= 8)
                                        <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15 w-100 div-review-update-food-brand-manage">
                                            @lang('app.food-brand-manage.update.food-admin')
                                        </h6>
                                        <div class="row pt-4 w-100 div-review-update-food-brand-manage">
                                            <!-- đánh giá món -->
                                            <div class="form-group col-lg-3 validate-group">
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="checkbox" id="review-update-food-brand-manage">
                                                        <label class="name-checkbox"
                                                              >
                                                            @lang('app.food-brand-manage.update.review')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(Session::get(SESSION_KEY_TMS) === 1 && Session::get(SESSION_KEY_LEVEL) === 3)
                                        <div class="col-lg-3"
                                             id="check-note-update-food-brand-manage">
                                            <div class="form-group">
                                                <label
                                                    class="col-lg-4 col-form-label">@lang('app.food-brand-manage.update.quantitative')</label>
                                                <div class="col-lg-2">
                                                    <div class="checkbox-zoom zoom-primary">
                                                        <label>
                                                            <input type="checkbox"
                                                                   id="quantitative-update-food-brand-manage">
                                                            <span class="cr"><i
                                                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  <!-- addition -->
                                    @endif
                                    @if(Session::get(SESSION_KEY_TMS) === 1 && Session::get(SESSION_KEY_LEVEL) === 3)
                                        <div class="col-lg-3 d-none"
                                             id="show-div-quantitative-update-food-brand-manage">
                                            <div class="form-group ">
                                                <label class="text text-warning text-right" id="text-quantitive-food">(*)
                                                    1 <span class="unit-name"></span> <span class="food-name"></span> =
                                                    1 <span class="unit-material-name"></span> <span
                                                        class="material-name"></span></label>
                                                <div class="col-lg-6 ">
                                                    <select id="material-update-food-brand-manage"
                                                            class="js-example-basic-single"></select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row col-lg-12 justify-content-lg-between align-items-center">
                                <div class="col-lg-8 row p-0">
                                    @if(Session::get(SESSION_KEY_TMS) === 1 && Session::get(SESSION_KEY_LEVEL))
                                        === 3)
                                        <!-- print -->
                                        <div class="form-group col-lg-6 m-0">
                                            <label
                                                class="col-lg-12 font-weight-bold py-2 col-form-label">@lang('app.food-brand-manage.update.point-method')</label>
                                            <div class="form-radio ">
                                                <div class="row col-lg-12">
                                                    <div class="radio radio-inline col-lg-6">
                                                        <label>
                                                            <input type="radio" name="point" value="0" checked
                                                                   data-icon="icofont-shrimp">
                                                            <i class="helper"></i>@lang('app.food-brand-manage.update.option-bill-point-method')
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline col-lg-6">
                                                        <label>
                                                            <input type="radio" name="point" value="1">
                                                            <i class="helper"></i>@lang('app.food-brand-manage.update.option-order-point-method')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(Session::get(SESSION_KEY_TMS) === 1 && Session::get(SESSION_KEY_LEVEL) === 3)
                                        <div class="form-group  col-lg-6 m-0">
                                            <label
                                                class="col-lg-4 col-form-label">@lang('app.food-brand-manage.update.party')</label>
                                            <div class="col-lg-8 col-form-label">
                                                <div class="checkbox-zoom zoom-primary">
                                                    <label>
                                                        <input type="checkbox" id="party-update-food-brand-manage">
                                                        <span class="cr"><i
                                                                class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div> <!-- aloline -->
                                    @endif
                                    <!-- sell by -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalFoodUpdateFoodManage()"
                     onkeypress="saveModalFoodUpdateFoodManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@include('manage.food.brand.update.food')

@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/update.js?version=6',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
